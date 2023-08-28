<?php 
include('connection.php');

$id=  $_GET['id'];
 
$query = "SELECT * FROM category where category_id= '$id'";
$data =mysqli_query($conn, $query);

// msg
session_start();
 

$total= mysqli_num_rows($data);
$result= mysqli_fetch_assoc($data);


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
                <input type="text" value="<?php echo $result['title']; ?>"class="form-control" id="title"  name="title" required>
            </div>

          
           
                <br><br>
                <input type="submit" class="btn btn-primary" value="update" name="update">
        </form>
    </div>
</body>
</html>




<?php
// error_reporting(0);

if(isset($_POST['update'])) 


{
    $title  = $_POST['title'];
   
   


    if($title !="" )
    {

        $query = "UPDATE category SET title='$title' WHERE category_id='$id'";
        $data = mysqli_query($conn,$query);

    if($data)
    {

        echo "<script>alert('Data updated')</script>";
        ?>
        <meta http-equiv = "refresh" content = "0; url = http://localhost/CRUD/Blog/ctable.php" >

        <?php
    }


    if($data)
    {


       $_SESSION['msg'] = " Record has been  updated successfully";
        header("refresh:0; url=http://localhost/CRUD/Blog/ctable.php");

    }
    else
    {
        echo "<script>alert('failed')</script>";
    }
    }
    else
    {
        echo "Please fill the form";

    }
}

?>


    