<?php
include("connection.php");
// error_reporting(0);

$limit = 5;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 1;
}
$offset = ($page - 1) * $limit;
$query = "SELECT * FROM BLOG 
        
        JOIN category ON blog.title = category.category_id LIMIT {$offset}, {$limit}";


$result = mysqli_query($conn, $query);
// $total = mysqli_num_rows($data);

// for msg
session_start();
?>

<html>

<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
    integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <!-- for msg -->
    <?php
    if (isset($_SESSION['msg'])) {
    ?>
    <div class="alert alert-success ">
      <?php echo $_SESSION['msg']; ?>
      <a href="" class="close" data-dismiss="alert" aria-label="close">x</a>
    </div>
    <?php
    unset($_SESSION['msg']);
    }
    ?>
    <a href="http://localhost/CRUD/Blog/blog-create.php">Add</a>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">id</th>
          <th scope="col">Title</th>
          <th scope="col">Description</th>
          <th scope="col">Image</th>
        </tr>
      </thead>
      <tbody>
        <?php

        while ($data = mysqli_fetch_assoc($result)) {
          echo "<tr>
                                <td>" . $data['id'] . "</td>
                                <td>" . $data['title'] . "</td>
                                <td>" . $data['description'] . "</td>
                                <td><img src='" . $data['image'] . "' width='200px' height='200px'></td>
                                <td>
                                    <a href='b_update.php?id=" . $data['id'] . "'><input type='submit' value='Edit' class='btn btn-success'></a>
                                    <a href='b_delete.php?id=" . $data['id'] . "'><input type='submit' value='Delete' class='btn btn-danger' onclick='return checkdelete()'></a>
                                </td>
                            </tr>";
        }
        ?>
      </tbody>
    </table>

    <?php

    $sql1 = "SELECT* FROM blog";
    $result1 = mysqli_query($conn, $sql1) or die("query failed");
    if (mysqli_num_rows($result1) > 0) {

      $total_record = mysqli_num_rows($result1);
      $total_page = ceil($total_record / $limit);
      echo '<div class = "pagination admin-pagination float-right">';

      for ($i = 1; $i <= $total_page; $i++) {

        if($i== $page){
          $active = "active";
        }else{
          $active="";
        }

        echo '<li class="'.$active.'"><a href="btable.php?page=' . $i . '" class="btn btn-primary">' . $i . '</a></li>';
      }
      echo '</div>';
    }

    ?>


  </div>
</body>

</html>

<script>
  function checkdelete() {
    return confirm('Are you sure you want to delete this record?');
  }
</script>