<?php
include("connection.php");
// error_reporting(0);



$query = "SELECT* FROM category";
$data =mysqli_query($conn, $query);

$total= mysqli_num_rows($data);
$result= mysqli_fetch_assoc($data);
mysqli_data_seek($data, 0); // Reset the data pointer to the beginning





if ($total != 0) {
?>
<html>
    <head>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    </head>
<body>
    

<div class="container">


<?php if (!empty($message)) { ?>
        <div class="alert alert-success" role="alert">
            <?php echo $message; ?>
        </div>
    <?php } ?>
<table border="3" >

<a href="http://localhost/CRUD/Blog/category-create.php">Add</a>

<table class="table">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Title</th>
      <th scope="col">Action</th>

     
    </tr>
  </thead>
  <tbody>
    
<?php

    while ($result = mysqli_fetch_assoc($data)){

     
        echo "<tr>

                 <td>" . $result['category_id'] . "</td>
                 <td>" . $result['title'] . "</td>
                
                   <td>  <a href='c_update.php?id=" . $result['category_id']  . "'><input type='submit' value='Edit' class='btn btn-success'></a>
                     <a href='c_delete.php?id=" . $result['category_id']  . "'><input type='submit' value='Delete' class='btn btn-danger' onclick='return checkdelete()'></a>
                 </td> 
             </tr>";
    }

}

 else
 {
    echo "No record found";
}
?>  
</table>

</div>
</body>
</html>

<script>

    function checkdelete()
    {
         return confirm('are you sure you want to delete this delete')
    }

    </script>``

