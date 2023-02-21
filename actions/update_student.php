<?php
if (!isset($_SESSION)) session_start();
require '../views/db_con.php';
include_once '../Additional_Libraries.php';

if (isset($_POST['upstdu'])) {
  $id = $_POST['sid'];
  $sname = $_POST['sname'];
  $ssex = $_POST['sgen'];
  $scourse = $_POST['scourse'];
  $ssem = $_POST['ssem'];
  $scno = $_POST['scno'];
  $smail = $_POST['smail'];
  $sadd = $_POST['sadds'];
  $name = $_FILES['file']['name'];
  $target_dir = "../upload/students_profile_img/";
  $target_file = $target_dir . basename($_FILES["file"]["name"]);

  // Select file type
  // $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

  // Valid file extensions
  // $extensions_arr = array("jpg", "jpeg", "png", "gif");

  // Check extension
  //if (in_array($imageFileType, $extensions_arr)) {
  // Upload file

  if (move_uploaded_file($_FILES['file']['tmp_name'], $target_dir . $name)) {
    // Convert to base64 
    // $image_base64 = base64_encode(file_get_contents('../upload/' . $name));
    //$image = 'data:image/' . $imageFileType . ';base64,' . $image_base64;
    // Insert record
    // $query = "insert into images(image) values('" . $image . "')";
    // $query = "INSERT INTO faculty ( `f_title`, `f_name`,`f_sex`, `f_department`, `f_role`, `f_qualification`, `f_cno`, `f_mailid`, `f_pic`) 
    // VALUES ('".$ftitle."', '".$fname."','".$fsex."', '".$fdept."', '".$froel."', '".$fqal."', '".$fcno."', '".$fmail."','" . $name . "')";
    // $query="UPDATE faculty SET f_title = '".$ftitle."', f_name = '".$id."',f_sex = '".$fsex."',f_department = '".$fdept."',f_role = '".$froel."',f_qualification = '".$fqal."',f_cno = '".$fcno."',f_mailid = '".$fmail."',f_add = '".$fadd."',f_pic = '".$name."' WHERE id = '".$id."' ";
  }
  if ($name != '') {
    $query = "UPDATE student SET  s_name = '" . $sname . "',s_sex = '" . $ssex . "',s_course='".$scourse."',s_sem='".$ssem."',s_cno = '" . $scno . "',s_mailid = '" . $smail . "',s_add = '" . $sadd . "',s_pic = '" . $name . "' WHERE id = " . $id . " ";
  } else {
    $query = "UPDATE student SET  s_name = '" . $sname . "',s_sex = '" . $ssex . "',s_course='".$scourse."',s_sem='".$ssem."',s_cno = '" . $scno . "',s_mailid = '" . $smail . "',s_add = '" . $sadd . "' WHERE id = " . $id . " ";
  }
  $ok =  mysqli_query($conn, $query);
  if ($ok) {

    $_SESSION['status_code'] = 'success';
    $_SESSION['status'] = 'Student Dedails was sucessfully updated';
    header("location:../views/a_students.php");
exit;
  } else {
    $_SESSION['status_code'] = 'error';
    $_SESSION['status'] = 'Somthing went wrong unbale to Update try again...';
    header("location:../views/a_students.php");
  }
}
// }

//Reset Student login password

if (isset($_POST['resetpwsd'])) {
  $id = $_POST['sid'];
  $scno = $_POST['scno'];
  $smail = $_POST['smail'];

  $pwsd = (substr($smail, 0, 5) . substr($scno, 0, 5));
  $hash = password_hash($pwsd, PASSWORD_DEFAULT);
  $query = "UPDATE `student` SET `pwsd`='" . $hash . "',`summa`='" . $pwsd . "' WHERE `id`='" . $id . "'";

  $result =  mysqli_query($conn, $query);
  if ($result) {
    $_SESSION['status_code'] = 'success';
    $_SESSION['status'] = 'Password was sucessfully updated';
    header("location:../views/a_students.php");
  } else {
    $_SESSION['status_code'] = 'error';
    $_SESSION['status'] = 'Somthing went wrong try again...';
    header("location:../views/a_students.php");
  }
}




//Remove the faculty from database

if (isset($_GET['rbtn'])) {

  $search = mysqli_real_escape_string($conn, $_GET["sid"]);
  $query = "DELETE FROM student WHERE id = '" . $search . "'";
  $result = mysqli_query($conn, $query);
  if ($result) {

    $_SESSION['status'] = "Faculty removerd Sucessfully...!";
    $_SESSION['status_code'] = "success";
    header('Location: ../views/a_students.php');

    /*echo('<script>
  alert("Faculty removerd Sucessfully...!");
  
  location.href="../views/a_Facultys.php";
  
  
  </script>');*/
  } else {
    $_SESSION['status'] = "Somthing Went Wrong Try Again!";
    $_SESSION['status_code'] = "error";
    header('Location: ../views/a_students.php');
    /*echo('<script>
  alert("Somthing Went Wrong Try Again!");
  
  location.href="../views/a_Facultys.php";
  
  
  </script>');*/
  }
}
