<?php include('connection.php');

// (step 2) ( relation ) data bolwt ahe  category cha blog mde  
$query="SELECT * FROM category";
$data=mysqli_query($conn ,$query);

// msg
session_start();
$title = '';
$description = '';
if(isset($_POST['submit'])) 
{
    $title  = $_POST['title'];
    $description   = $_POST['description'];
    $filename = $_FILES["image"]["name"];
    $tmpname = $_FILES["image"]["tmp_name"];
    $folder = "images/". $filename;
    move_uploaded_file($tmpname, $folder); 

//    for validaion 
    if ($title != "" && $description != "" && $folder != "") {
    $query = "INSERT INTO blog(title, description, image) VALUES('$title', '$description', '$folder')";
    $data =mysqli_query($conn,$query);

    if($data) 
    {


       $_SESSION['msg'] = " Record has been  successfully";
        header("refresh:0; url=http://localhost/CRUD/Blog/btable.php");

    }
    else
    {
        echo "<script>alert('failed')</script>";
    }
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

                <!-- step1(dd) relation  -->
                <select class="form-control" name="title" id="title">
                    <option value=""> select id</option>
                    <?php foreach($data as $d){ ?>
                    <option value="<?php echo $d['category_id'] ?>" <?php echo ( $d['category_id'] == $title) ? 'selected' : ''  ?>><?php echo $d['title'] ?></option>
                    <?php } ?>
                </select>
                <!-- vlidatio code message -->
                <?php if (isset($_POST['submit']) && empty($title)) { ?>
                <span class="text-danger">Please select Title</span>
                <?php } ?>
            </div>

            <br><br>
            <div class="form-group">
                <label for="description">Description</label>
                <div>
                    <input type="text" name="description" class="form-control" id="description" value="<?php echo $description ?>">
                </div>
                 <!-- vlidatio code message -->
                <?php if (isset($_POST['submit']) && empty($description)) { ?>
                <span class="text-danger">Please fill the description.</span>
                <?php } ?>
                <div>

                    <br><br>
                    <div class="form-group">
                        <label for="image">image:</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>

                    <br><br>
                    <input type="submit" class="btn btn-primary" value="submit" name="submit">
        </form>
    </div>
</body>

</html>

