<?php 
include("connect.php");

$id=  $_GET['id'];

$query = "SELECT * FROM form where id= '$id'";
$data =mysqli_query($conn, $query);

$total= mysqli_num_rows($data);
$result= mysqli_fetch_assoc($data);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Document</title>
    
    <style>
        
        .container{width: 600px;margin-top: 100px;font-weight: bold;}
        </style>
</head>
<body>


    <div class="container">
  
<form  action="#" method="POST">


<h4 style="text-align: center;color:blue"> Register Form</h4>
   <div class="form-group">
    <label for="name">Name</label>
    <input type="name" value="<?php echo $result['name']; ?>" class="form-control" id="name" aria-describedby="nameHelp" name="name" required>
  </div>


  <div class="form-group">
    <label for="address">Address</label>
    <input type="address" value="<?php echo $result['address']; ?>" class="form-control" id="address" aria-describedby="addressHelp" name="address" required>
</div>



  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" value="<?php echo $result['email']; ?>"  class="form-control" id="email" aria-describedby="emailHelp" name="email" required>
  </div>

  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" value="<?php echo $result['password']; ?>"  class="form-control" id="password" name="password" required>
  </div>
  
  <!-- <button type="submit" class="btn btn-primary" name="button">Submit</button> -->
  <input type="submit" class="btn btn-primary" value="update" name="update">
  
</form>
</div>

</body>
</html>




<!-- php  -->

<?php

// error_reporting(0);

if(isset($_POST['update'])) 
{
    $name      = $_POST['name'];
    $address   = $_POST['address'];
    $email     = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

 if($name !="" &&  $address !="" && $email !="" && $password !="")
 {
     $query ="UPDATE form set name='$name', address='$address', email='$email', password='$password' WHERE id='$id'";
     $data = mysqli_query($conn,$query);

     if ($data)
      {
        echo "<script> alert('REcord Updated') </script>";
        ?>
        <meta http-equiv = "refresh" content = "1; url = http://localhost\CRUD-PHP\phpcrud\display.php" />

          <?php
     }
      else 
      {
         echo 'failed';
     }
     
 }
 else{
    echo "Please fill the form";
 }

}
?>






