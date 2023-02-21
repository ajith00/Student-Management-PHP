
<?php
require '../views/db_con.php';
include_once '../Additional_Libraries.php';
include_once '../additionallib/PDF_maker/fpdf.php';
if (!isset($_SESSION)) session_start();



//load Subject list
if (isset($_POST['x1'])) {

  $x = mysqli_escape_string($conn, $_POST['x1']);
  $data = explode("-", $x);
  $sql = "select * from classes where c_name='" . $x . "'";
  $sub_list .= ' <option value="">--Select Subject--</option>';
  $row = mysqli_query($conn, $sql);
  if (mysqli_num_rows($row) > 0) {
    $sub = mysqli_fetch_array($row);
    $sub_list .= "<option value=" . $sub['sub1'] . ">" . $sub['sub1'] . "</option>";
    $sub_list .= "<option value=" . $sub['sub2'] . ">" . $sub['sub2'] . "</option>";
    $sub_list .= "<option value=" . $sub['sub3'] . ">" . $sub['sub3'] . "</option>";
    $sub_list .= "<option value=" . $sub['sub4'] . ">" . $sub['sub4'] . "</option>";
    $sub_list .= "<option value=" . $sub['sub5'] . ">" . $sub['sub5'] . "</option>";
    $sub_list .= "<option value=" . $sub['sub6'] . ">" . $sub['sub6'] . "</option>";
    $sub_list .= "<option value=" . $sub['sub7'] . ">" . $sub['sub7'] . "</option>";
    $sub_list .= "<option value=" . $sub['sub8'] . ">" . $sub['sub8'] . "</option>";
  }
  echo ($sub_list);
}



//load attenence register
if (isset($_POST['y1'])) {
  // $x = $_POST['y1'];
  $x = mysqli_escape_string($conn, $_POST['y1']);

  $data = explode("-", $x);

  $sql = "select * from student where s_course='" . $data[0] . "' and s_sem='" . $data[1] . "' ORDER BY s_name ASC";
  $row = mysqli_query($conn, $sql);
  echo ('  <table class="table table-hover table-striped " id="myTable">
  <thead class="table-dark">
    <tr>
      <th class="text-center"> Sl.No </th>
      <th class="text-center"> Student ID </th>
      <th class="text-center"> Student Name  </th>
      <th class="text-center"> Attendance  </th>
    </tr>
    <tbody>');
  if (mysqli_num_rows($row) > 0) {
    $i = 1;
    $j = 0;
    while ($s = mysqli_fetch_array($row)) {
      echo ("<div>");
      echo (" <tr>");
      echo (' <td>' . $i . '<input type="hidden" name="count" value=' . $i . '> </td>');
      echo (' <td>' . $s['id'] . '<input type="hidden" name="sid[]" value=' . $s['id'] . '> </td>');
      echo (' <td>' . $s['s_name'] . '<input type="hidden" name="sname[]" value=  "' . $s['s_name'] . '" > </td>');
      echo ('<th><input class="form-check-input" type="radio" name="aten' . $j . '" value="P" required>Present<input class="form-check-input" type="radio" name="aten' . $j . '" checked value="A">Absent</th>');
      echo (" </tr>");
      echo ("</div>");
      $i++;
      $j++;
    }
    echo (" </tbody>");
    echo ('</table>');
  }
}



//view attendance
if (isset($_POST['a1'])) {
  // $x = $_POST['y1'];
  $cource = mysqli_escape_string($conn, $_POST['a1']);
  $sub = mysqli_escape_string($conn, $_POST['b1']);
  $dt1 = mysqli_escape_string($conn, $_POST['c1']);
  $dt2 = mysqli_escape_string($conn, $_POST['d1']);
  $data = explode("-", $cource);

if($dt1!=""){
  $sql = "select * from attadence where dept='" . $data[0] . "' and c_name='" . $data[1] . "' and sub_name='" . $sub . "' and a_date='" . $dt1 . "'";
}else if($dt1!="" && $dt2!=""){
  
  $sql = "select * from attadence where dept='" . $data[0] . "' and c_name='" . $data[1] . "' and sub_name='" . $sub . "' and a_date BETWEEN '".$dt1."' and '".$dt2."' ORDER BY a_date Desc";

}else{
  $sql = "select * from attadence where dept='" . $data[0] . "' and c_name='" . $data[1] . "' and sub_name='" . $sub . "' ORDER BY a_date Desc";

}
  $rows = mysqli_query($conn, $sql);
  echo ('  <table class="table table-hover table-striped " id="myTable">
   <thead class="table-dark">
     <tr>
       <th class="text-center"> Sl.No </th>
       <th class="text-center"> Date(DD/MM/YYYY) </th>
       <th class="text-center"> Subject </th>

       <th class="text-center"> Student ID </th>
       <th class="text-center"> Student Name  </th>
       <th class="text-center"> Attendance  </th>
     </tr>
     <tbody>');
  if (mysqli_num_rows($rows) > 0) {
    $i = 1;
    $j = 0;

    while ($s = mysqli_fetch_array($rows)) {
      echo ("<div>");

      echo (" <tr>");
      echo (' <td>' . $i . '<input type="hidden" name="count" value=' . $i . '></td>');
      echo (' <td>' . $s['a_date'] . '<input type="hidden" name="sname[]" value=' . $s['a_date'] . '></td>');
      echo (' <td>' . $s['sub_name'] . '<input type="hidden" name="sname[]" value=' . $s['sub_name'] . '></td>');

      echo (' <td>' . $s['s_id'] . '<input type="hidden" name="sid[]" value=' . $s['s_id'] . '></td>');
      echo (' <td>' . $s['s_name'] . '<input type="hidden" name="sname[]" value=' . $s['s_name'] . '></td>');
      echo (' <td>' . $s['attendence'] . '<input type="hidden" name="sname[]" value=' . $s['attendence'] . '></td>');
      //  echo ('<th><input class="form-check-input" type="radio" name="aten' . $j . '" value="P" required>Present<input class="form-check-input" type="radio" name="aten' . $j . '" checked value="A">Absent</th>');
      echo (" </tr>");
      echo ("</div>");
      $i++;
      $j++;
    }
    echo (" </tbody>");
    echo ('</table>');
    echo ('        <button type="button" value="downloadatn" name="downloadatn" id="downloadatn" class="btn btn-outline-primary">  <a href="../actions/downloadattendence.php?a1=' . $cource . '&b1='.$sub.'&c1='.$dt.'&downloadatn="> Download &nbsp;<i class="bi bi-download"></i></button>');
  } else {
    echo ("<tr><td colspan='5'>No data Found</td></tr>");
  }
}





//Insert the attendance to database

if (isset($_POST['addattendence'])) {

  $sidd = $_POST['sid'];
  $name = $_POST['sname'];

  date_default_timezone_set('Asia/Kolkata');
  //$date = date('Y/m/d H:i:s');
  $date = date('Y-m-d');
  $data = explode("-", $_POST['class']);

  for ($i = 0; $i < count($_POST['sid']); $i++) {
    $sid = mysqli_escape_string($conn, $sidd[$i]);
    $sname = mysqli_real_escape_string($conn, $name[$i]);
    $satten = mysqli_escape_string($conn, $_POST['aten' . $i . '']);
    $subname = mysqli_real_escape_string($conn, $_POST['sub']);

    $query = 'INSERT INTO `attadence` ( `a_date`, `dept`,`c_name`, `sub_name`, `s_id`, `s_name`, `attendence`, `t_id`) 
    VALUES ("' . $date . '","' . $data[0] . '","' . $data[1] . '","' . $subname . '","' . $sid . '","' . $sname . '","' . $satten . '","' . $_SESSION['tid'] . '")';
    $res = mysqli_query($conn, $query);
  }
  if ($res) {
    $_SESSION['status'] = "Attendance Recorded Successfully...!";
    $_SESSION['status_code'] = "success";
    header('Location: ../views/attendence.php');
  } else {
    $_SESSION['status'] = "Something Went Wrong...!";
    $_SESSION['status_code'] = "error";
    header('Location: ../views/attendence.php');
    $_POST = array();
    exit();
  }
}






//Duplicate attendence Check
if (isset($_POST['p1'])) {
  $cource = mysqli_escape_string($conn, $_POST['p1']);
  $sub = mysqli_escape_string($conn, $_POST['q1']);
  $data = explode("-", $cource);

  date_default_timezone_set('Asia/Kolkata');
  //$date = date('Y/m/d H:i:s');
  $dt = date('Y-m-d');

  $sql = "select * from attadence where dept='" . $data[0] . "' and c_name='" . $data[1] . "' and sub_name='" . $sub . "' and a_date='" . $dt . "'";
  $row = mysqli_query($conn, $sql);
  if (mysqli_num_rows($row) > 0) {
    $_SESSION['status'] = "Attendence Already Marked...!";
    $_SESSION['status_code'] = "info";
    echo ('<script>window.location.replace("../views/attendence.php");
    </script>');
    exit();
  } else {
  }
}

//Delete Todays Attendance

if(isset($_POST['dltcourse'])){
  $cource = mysqli_escape_string($conn, $_POST['dltcourse']);
  $sub = mysqli_escape_string($conn, $_POST['dltsub']);
  $data = explode("-", $cource);

  date_default_timezone_set('Asia/Kolkata');
  //$date = date('Y/m/d H:i:s');
  $dt = date('Y-m-d');
  $sql="DELETE FROM `attadence` where dept='" . $data[0] . "' and c_name='" . $data[1] . "' and sub_name='" . $sub . "' and a_date='" . $dt . "'";
  $res=mysqli_query($conn,$sql);
  if($res){
    $_SESSION['status'] = "Record Deleted Successfully...!";
    $_SESSION['status_code'] = "info";
    echo ('<script>window.location.replace("../views/attendence.php");
    </script>');
    exit();
  }
}
?>