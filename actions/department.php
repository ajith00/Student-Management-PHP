

<?php
require '../views/db_con.php';
include '../Additional_Libraries.php';
if (!isset($_SESSION)) session_start();
$output = '';


// Load the students list as table
if (isset($_POST["x1"])) {

  $search1 = mysqli_real_escape_string($conn, $_POST["x1"]);

  $search2 = mysqli_real_escape_string($conn, $_POST["y1"]);

  $query = "
      SELECT * FROM student 
      WHERE
       s_course = '" . $search1 . "' 
    
      and s_sem LIKE '" . $search2 . "' 
    ";
} 
 else {
  $query = " SELECT * FROM student ";
}

      $result = mysqli_query($conn, $query);
      echo('  <table class="table table-hover table-striped " id="myTable">
      <thead class="table-dark">
        <tr>
          <th class="text-center"> Sl.No </th>
          <th class="text-center"> Student ID </th>
          <th class="text-center"> Name  </th>
          <th class="text-center"> Class  </th>
          <th class="text-center">Contact No</th>
        </tr>
        <tbody>');

      if (mysqli_num_rows($result) > 0) {
          $i=1;
        while ($row = mysqli_fetch_array($result)) {

      echo(" <tr>");
      echo(" <td>".$i."</td>");
      echo(" <td>".$row['id']."</td>");
      echo(" <td>".$row['s_name']."</td>");
      echo(" <td>".$row['s_course']."-".$row['s_sem']."</td>");
      echo(" <td>".$row['s_cno']."</td>");
      echo(" </tr>"); 
      $i++;
        }
        echo(" </tbody>");
        echo('</table>');

      // echo $output;
        unset($_POST);
      } else {
        echo 'Data Not Found';
        unset($_POST);
      }



?>