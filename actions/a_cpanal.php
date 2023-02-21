<?php
require '../views/db_con.php';
include '../Additional_Libraries.php';
if (!isset($_SESSION)) session_start();

if (isset($_POST['accbtn'])){
$iat=$_POST['ia_teacher'];
$ias=$_POST['ia_student'];
$at= $_POST['aten_for_tech'];
$as= $_POST['aten_for_student'];

$sql="UPDATE `access_control` SET `ia_teacher`='".$iat."',`ia_student`='".$ias."',`aten_for_tech`='".$at."',`aten_for_student`='".$as."' WHERE id='1'";
$res=mysqli_query($conn,$sql);
if($res){
    $_SESSION['status']="Changes Saved SucessFully..!";
    $_SESSION['status_code']="success";  
   header('Location: ../views/a_cpanal.php');  
   $_POST=array();
exit();
}else{
    $_SESSION['status']="Somthing Went Wrong unable to Update C-Panal!";
    $_SESSION['status_code']="error";  
   header('Location: ../views/a_cpanal.php');  
   $_POST=array();
exit();
}}
?>