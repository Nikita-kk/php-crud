<?php include('connection.php');

// msg
session_start();
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>
<body>
    
<div class="container">
  <h2>Category form</h2>
  <form  action="#" method="POST">

    <div class="form-group">
      <label for="title">Title:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter Category title" name="title" required>
    </div>

    <input type="submit" class="btn btn-primary" value="submit" name="submit">
  </form>
</div>

</body>
</html>

<?php
// error_reporting(0);

if(isset($_POST['submit'])) 


{
    $title      = $_POST['title'];

    
   
    $query ="INSERT INTO category(title ) values('$title')";
     $data =mysqli_query($conn,$query);

     if ($data)
      {
        echo  "<script> alert('Data INserted into Database')</script>";

        header("refresh:0; url=http://localhost/CRUD/Blog/ctable.php");

     }

// msg
     if($data)
    {


       $_SESSION['msg'] = " Record has been successfully";
        header("refresh:0; url=http://localhost/CRUD/Blog/ctable.php");

    }
      else 
      {
         echo 'failed';
     }
     
 }

?>