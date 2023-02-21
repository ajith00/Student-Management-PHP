<?php

require '../views/db_con.php';
include '../Additional_Libraries.php';
$output = '';
if (isset($_POST["query"])) {
  $search = mysqli_real_escape_string($conn, $_POST["query"]);
  $query = "
  SELECT * FROM faculty 
  WHERE f_name LIKE '%" . $search . "%'
  OR f_role LIKE '%" . $search . "%' 
  OR f_mailid LIKE '%" . $search . "%' 
 ";
} else {
  $query = "
  SELECT * FROM faculty
 ";
}
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {

  while ($row = mysqli_fetch_array($result)) {
    $id = $row['id'];
    $image_src = $row['f_pic'];
    $name = $row['f_title'] . " " . $row['f_name'];
    $role = $row['f_role'];
    $qual = $row['f_qualification'];
    $cno = $row['f_cno'];
    $mail = $row['f_mailid'];

    $output .= '<div class="card id="result">
    <div class="flip-card-inner">
    <div class="flip-card-front">
                    <img src="../upload/facultys_profile_img/' .   $image_src . '" alt="proficle pic" style="width:100%; height: 55%;border-top-left-radius: 15px;
                    border-top-right-radius: 15px;">
                    <h4>' . $name . '</h4>

                    <p class="title">' . "(" . '' . $id . '' . ") " . '' . $role . '</p>
                    <p><i class="fa fa-graduation-cap" aria-hidden="true"></i>&nbsp;' . $qual . '</p>
                    <p><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;' . $cno . '</p>
                    <p><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp' . $mail . '</p>
                    </div>
                    <div class="flip-card-back">
                    <a href="updatefaculty.php?ufid='.$id.'&upbtn="><button class="btn btn-outline-warning"><i class="bi bi-pencil-square"></i>Edit</button></a>
                    <a href="../actions/faculty.php?fid='.$id.'&rbtn="><button class="btn btn-outline-danger"><i class="bi bi-trash"></i>Remove</button></a>

                    </div>
                 </div>
                  </div>';
  }


  echo $output;
  $_POST=array();
  exit();
} else {
  echo 'Data Not Found';
}


