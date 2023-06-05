<?php
include("connection.php");

$id = $_GET['id'];
$query = "Delete From FORM Where id = '$id'";

$data =mysqli_query($conn, $query);

if($data)
{
    echo "<script> alert('REcord Deleted') </script>";

    ?>
    <meta http-equiv = "refresh" content = "0; url = http://localhost/CRUD/display.php" />

      <?php
}
else
{
    echo "Failed To Delete";
}

?>

