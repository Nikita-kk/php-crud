<?php
include("connect.php");
// error_reporting(0);



$query = "SELECT* FROM form";
$data =mysqli_query($conn, $query);

$total= mysqli_num_rows($data);
$result= mysqli_fetch_assoc($data);




if ($total != 0) {
?>
<html>
    <head>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    </head>
<body>
    
<table border="3" >
    <tr>
    <th>Id</th>
    <th>Name</th>
   <th>Address</th>
   <th>Email</th>
   <th>Action</th>

</tr>
<?php

    while ($result = mysqli_fetch_assoc($data)){
        echo "<tr>
                 <td>" . $result['id'] . "</td>
                 <td>" . $result['name'] . "</td>
                 <td>" . $result['address'] . "</td>
                 <td>". $result['email'] . "</td>
                 <td>
                     <a href='update_design.php?id=" . $result['id']  . "'><input type='submit' value='update' class='btn btn-success'></a>
                     <a href='delete.php?id=" . $result['id']  . "'><input type='submit' value='delete' class='btn btn-danger' onclick = 'return checkdelete()'></a>
                </td> 
              </tr>";
    }

} else {
    echo "no record found";
}
?>  
</table>
</body>
</html>

<script>
    function checkdelete()
    {
         return confirm('are you sure you want to delete this delete')
    }

    </script>``

