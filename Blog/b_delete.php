<?php
include("connection.php");
session_start();
$id = $_GET['id'];

$queryDeleteBlog = "DELETE FROM blog WHERE id = '$id'";
$dataDeleteBlog = mysqli_query($conn, $queryDeleteBlog);

if ($dataDeleteBlog) {

    // session for msg
    $_SESSION['msg'] = " Record has been deleted successfully";
    header("refresh:0; url=http://localhost/CRUD/Blog/btable.php");
} else {
    echo "Failed to delete blog record";
}
?>

