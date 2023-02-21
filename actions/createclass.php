<?php
  if (!isset($_SESSION)) session_start();
  require '../views/db_con.php';
  include '../Additional_Libraries.php';



  //create the class
 if(isset($_POST['createclass'])){

  if(!isset($_POST['sub5'])){
        $_SESSION['status']="Minimum 5 Subjects are required...!";
      $_SESSION['status_code']="error";
    header('Location: ../views/createclasses.php');  
      $_POST=array();
    exit();
      }else{
    $q1="select * from student where s_course='".$_POST['scource']."' and s_sem='".$_POST['ssem']."'";
    $r1=mysqli_query($conn,$q1);
      $classname=$_POST['scource']."-".$_POST['ssem'];
      date_default_timezone_set('Asia/Kolkata');
      $date = date('Y/m/d H:i:s');

    if(isset($_POST['sub6'])|| isset($_POST['sub7'])|| isset($_POST['sub8'])){
      $q2="INSERT INTO `classes`( `c_name`, `sub1`, `sub2`, `sub3`, `sub4`, `sub5`, `sub6`, `sub7`, `sub8`, `prof1`, `prof2`, `prof3`, `prof4`, `prof5`, `prof6`, `prof7`, `prof8`,`createdby`, `createdon`) 
      VALUES ('".$classname."','".$_POST['sub1']."','".$_POST['sub2']."','".$_POST['sub3']."','".$_POST['sub4']."','".$_POST['sub5']."','".$_POST['sub6']."','".$_POST['sub7']."','".$_POST['sub8']."','".$_POST['Professor1']."','".$_POST['Professor2']."','".$_POST['Professor3']."','".$_POST['Professor4']."','".$_POST['Professor5']."','".$_POST['Professor6']."','".$_POST['Professor7']."','".$_POST['Professor8']."','".$_SESSION['tid']."','".$date."')";

    }else{
      $q2="INSERT INTO `classes`( `c_name`, `sub1`, `sub2`, `sub3`, `sub4`, `sub5`, `prof1`, `prof2`, `prof3`, `prof4`, `prof5`, `createdby`, `createdon`) 
      VALUES ('".$classname."','".$_POST['sub1']."','".$_POST['sub2']."','".$_POST['sub3']."','".$_POST['sub4']."','".$_POST['sub5']."','".$_POST['Professor1']."','".$_POST['Professor2']."','".$_POST['Professor3']."','".$_POST['Professor4']."','".$_POST['Professor5']."','".$_SESSION['tid']."','".$date."')";

    } 
    $res=mysqli_query($conn,$q2);

    if ($res) {
          $_SESSION['status']="Class Created Successfully...!";
          $_SESSION['status_code']="success";
          header('Location: ../views/createclasses.php');  
          $_POST=array();
        exit();
    }else{
          $_SESSION['status']="Something Went Wrong Unable to Crete the Class...!";
          $_SESSION['status_code']="error";
          header('Location: ../views/createclasses.php');  
          $_POST=array();
        exit();

    }
    }
    }

//Duplicate Class Check
 if (isset($_POST['p1'])) {
      $cource=mysqli_escape_string($conn,$_POST['p1']);
      $sem=mysqli_escape_string($conn,$_POST['q1']);
      $class=$cource."-".$sem;

      $sql = "select * from classes where c_name='" . $class. "'";
      $row = mysqli_query($conn, $sql);
      if(mysqli_num_rows($row)>0){
        $_SESSION['status']="Class Already Created...!";
        $_SESSION['status_code']="info";
        echo('<script>
        window.location.replace("../views/createclasses.php");
        alert("Class is already created");
        </script>');
        exit();
      }else{
      }
    }


 //delete the classes

 if(isset($_POST['dlid'])){
  $res=mysqli_query($conn,"DELETE FROM `classes` WHERE id='".$_POST['dlid']."'");
  
  if($res){
        $_SESSION['status']="Class Remover Successfully...!";
        $_SESSION['status_code']="success";
        echo('<script>
        window.location.replace("../views/viewclasses.php");
        alert("Class Remover Successfully...!");
        </script>');
        exit();
  }else{
        $_SESSION['status'] = "Something Went Wrong Unable to delete the Class ...!";
        $_SESSION['status_code'] = "error";
        header('Location: ../views/viewclasses.php');
        $_POST=array();
        exit();
  }
 }
?>