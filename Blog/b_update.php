<?php
include 'connection.php';
session_start();
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM blog where id= '$id'";
    $data = mysqli_query($conn, $query);
    $result = mysqli_fetch_assoc($data);

    $data1 = [];
    $query1 = "SELECT * FROM CATEGORY";
    $result1 = mysqli_query($conn, $query1);

    while ($row = mysqli_fetch_assoc($result1)) {
        $data1[] = $row;
    }
} else {
    echo "Invalid ID.";
    exit;
}

// udate code
$title = '';
$description = '';
if (isset($_POST['update'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $filename = $_FILES["image"]["name"];
    $tmpname = $_FILES["image"]["tmp_name"];
    $folder = "images/" . $filename;
    move_uploaded_file($tmpname, $folder);
    if ($title != "" && $description != "" && $folder != "") {
        $query = "UPDATE blog SET title='$title', description='$description', image='$folder' WHERE id='$id'";
        $data = mysqli_query($conn, $query);
        if ($data) {
            echo "<script>alert('Data updated')</script>";
            ?>
<meta http-equiv="refresh" content="0; url = http://localhost/CRUD/Blog/btable.php">
<?php
         // session for msg
            if ($data) {
                $_SESSION['msg'] = " Record has been  updated successfully";
                header("refresh:0; url=http://localhost/CRUD/Blog/btable.php");
            }
        } else {
            echo "<script>alert('failed')</script>";
        }
    } else {
        echo "Please fill the form";

    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

</head>

<body>
    <style>
        .container {
            width: 500px;
            padding: 30px
        }
    </style>
    <br> <br>
    <div class="container">
        <h2>Blog form</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title:</label>
                <!-- Step 1 (dd) relation -->
                <select class="form-control" name="title" id="title">
                    <option value="">Select ID</option>
                    <?php foreach ($data1 as $d) {?>
                    <option value="<?php echo $d['category_id']; ?>"
                        <?php echo (isset($_POST['title']) ? ($_POST['title'] == $d['category_id']) : ($result['title'] == $d['category_id'])) ? 'selected' : '' ?>>
                        <?php echo $d['title']; ?></option>
                    <?php }?>
                </select>
                
                <?php if (isset($_POST['submit']) && empty($_POST['title'])) {?>
                <span class="text-danger">Please select Title</span>
                <?php }?>
            </div>

            <br><br>
            <div class="form-group">
                <label for="description">Description</label>
                <div>
                    <input type="text" name="description" class="form-control" id="description"
                        value="<?php echo (isset($_POST['description']) ? $_POST['description'] : $result['description']) ?>">
                </div>
                <!-- validation -->
                <?php if (isset($_POST['submit']) && empty($_POST['description'])) {?>
                    
                <span class="text-danger">Please select Title</span>
                <?php }?>
                <div>

                    <br><br>

                    <div class="form-group">
                        <label for="image">image:</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>

                    <br><br>
                    <input type="submit" class="btn btn-primary" value="update" name="update">
        </form>
    </div>
</body>

</html>