<?php 
require '../views/db_con.php';
include_once '../Additional_Libraries.php';
include_once '../additionallib/PDF_maker/fpdf.php';
if (!isset($_SESSION)) session_start();




//Insert the attendence to database

if (isset($_POST['addia'])) {

    $sidd =    $_POST['sid'];
    $name =    $_POST['sname'];
    $atmark =  $_POST['attendencemarks'];
    $asmark =  $_POST['assignmentmarks'];
    $tstmark=  $_POST['textmarks'];
  
    date_default_timezone_set('Asia/Kolkata');
    //$date = date('Y/m/d H:i:s');
    $date = date('Y-m-d');
    $data = explode("-", $_POST['class']);
  
    for ($i = 0; $i < count($_POST['sid']); $i++) {

      $sid = mysqli_escape_string($conn, $sidd[$i]);
      $sname = mysqli_escape_string($conn, $name[$i]);
      $atenmark=mysqli_escape_string($conn,$atmark[$i]);
      $asignmark=mysqli_escape_string($conn,$asmark[$i]);
      $testmark=mysqli_escape_string($conn,$tstmark[$i]);
      $max_mark=mysqli_escape_string($conn,$_POST['maxmark']);
      $securedmark=$atenmark+$asignmark+$testmark;
      $subname = mysqli_escape_string($conn, $_POST['sub']);
        $query = ' INSERT INTO `ia_marks`(`dept`, `sem`, `subject`, `s_id`, `s_name`, `attendence`, `assignment`, `test_mark`, `ia_mark`,`max_mark`, `t_id`, `added_on`) 
      VALUES ("' . $data[0] . '","' . $data[1] . '","' . $subname . '","' . $sid . '","' . $sname . '","'.$atenmark.'","'.$asignmark.'","'.$testmark.'","'.$securedmark.'","'.$max_mark.'","'.$_SESSION['tid'].'","'.$date.'")';
      $res = mysqli_query($conn, $query);
    }
    if ($res) {
      $_SESSION['status'] = "IA Marks Added Sucessfully...!";
      $_SESSION['status_code'] = "success";
      header('Location: ../views/IA_Marks.php');
    } else {
      $_SESSION['status'] = "Somthing Went Wrong...!'".mysqli_error($conn)."'";
      $_SESSION['status_code'] = "error";
      header('Location: ../views/IA_Marks.php');
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
  
    $sql = "select * from ia_marks where dept='" . $data[0] . "' and sem='" . $data[1] . "' and subject='" . $sub . "' ";
    $row = mysqli_query($conn, $sql);
    if (mysqli_num_rows($row) > 0) {
      $_SESSION['status'] = "IA Marks Already Submited...!";
      $_SESSION['status_code'] = "info";
      echo ('<script>window.location.replace("../views/IA_Marks.php");
      </script>');
      exit();
    } else {
    }
  }







//load IA marks register
if (isset($_POST['y1'])) {
 
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
        <th class="text-center"> Attendence  </th>
        <th class="text-center"> Assignment Marks  </th>
          <th class="text-center"> Test Marks  </th>
   
      </tr>
      </thead>
      <tbody>');
    if (mysqli_num_rows($row) > 0) {
      $i = 1;
      $j = 0;
      while ($s = mysqli_fetch_array($row)) {
        echo ("<div>");
        echo (" <tr>");
        echo (' <td>' . $i . '<input type="hidden" name="count" value=' . $i . '></td>');
        echo (' <td>' . $s['id'] . '<input type="hidden" name="sid[]" value=' . $s['id'] . '></td>');
        echo (' <td>' . $s['s_name'] . '<input type="hidden" name="sname[]" value=' . $s['s_name'] . '></td>');
        echo (' <td><input type="text" name="attendencemarks[]" class="form-control"  placeholder="Attendence Marks" ></td>');
        echo (' <td><input type="text" name="assignmentmarks[]" class="form-control"  placeholder="Assignment Marks"></td>');
        echo (' <td><input type="text" name="textmarks[]" class="form-control" id="" placeholder="Test Marks"></td>');
        echo (" </tr>");
        echo ("</div>");
        $i++;
        $j++;
      }
      echo (" </tbody>");
      echo ('</table>');
      echo ('<button type="submit"  name="addia" id="downloadatn" class="btn btn-outline-primary">Submit</button>');

    }
}
  


  

  //view IAmarks
if (isset($_POST['a1'])) {
  // $x = $_POST['y1'];
  $cource = mysqli_escape_string($conn, $_POST['a1']);
  $sub = mysqli_escape_string($conn, $_POST['b1']);


  $data = explode("-", $cource);

  $sql = "select * from ia_marks where dept='" . $data[0] . "' and sem='" . $data[1] . "' and subject='" . $sub . "'";
 

  $rows = mysqli_query($conn, $sql);
  echo ('  <table class="table table-hover table-striped " id="myTable">
   <thead class="table-dark">
   <tr>
   <th class="text-center"> Sl.No </th>
   <th class="text-center"> Student ID </th>
   <th class="text-center"> Student Name  </th>
   <th class="text-center"> Attendence  </th>
   <th class="text-center"> Assignment Marks  </th>
  <th class="text-center"> Test Marks  </th>
  <th class="text-center">Secured Marks  </th>
  <th class="text-center"> Max Marks  </th>
 </tr>
     <tbody>');
  if (mysqli_num_rows($rows) > 0) {
    $i = 1;
    $j = 0;

    while ($s = mysqli_fetch_array($rows)) {
      echo ("<div>");

      echo (" <tr>");
      echo (' <td>' . $i . '<input type="hidden" name="count" value=' . $i . '></td>');
      echo (' <td>' . $s['s_id'] . '<input type="hidden" name="sname[]" value=' . $s['s_id'] . '></td>');
      echo (' <td>' . $s['s_name'] . '<input type="hidden" name="sname[]" value=' . $s['s_name'] . '></td>');
      echo (' <td><input type="text" name="attendencemarks[]" class="form-control" value="'.$s['attendence'].'"  placeholder="Attendence Marks" readonly></td>');
      echo (' <td><input type="text" name="assignmentmarks[]" class="form-control" value="'.$s['assignment'].'" placeholder="Assignment Marks" readonly></td>');
      echo (' <td><input type="text" name="textmarks[]" class="form-control" id="" value="'.$s['test_mark'].'" placeholder="Test Marks" readonly></td>');
      echo (' <td><input type="text" name="secmark[]" class="form-control"         value="'.$s['ia_mark'].'" placeholder="Secured Marks" readonly></td>');
      echo (' <td><input type="text" name="maxmark[]" class="form-control" id=""   value="'.$s['max_mark'].'" placeholder="Max Marks" readonly></td>');

    echo (" </tr>");
      echo ("</div>");
      $i++;
      $j++;
    }
    echo (" </tbody>");
    echo ('</table>');
    echo ('<button type="button"  name="downloadia" class="btn btn-outline-primary">  <a href="../actions/downloadattendence.php?a1=' . $cource . '&b1='.$sub.'&downloadia="> Download &nbsp;<i class="bi bi-download"></i></button>');
  } else {
    echo ("<tr><td colspan='5'>No data Found</td></tr>");
  }
}
?>