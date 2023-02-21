<?php
      if (!isset($_SESSION)) session_start();
      require '../views/db_con.php';
      include '../Additional_Libraries.php';
      $date = date('Y-m-d');

if (isset($_SESSION['tlogin'])) {
     

  if(isset($_POST['createassignment'])){
      $target_dir="../upload/assignments/qp/";
      $file_name=$date.$_FILES['file']['name'];

      //  $assign_key=mysqli_escape_string($conn,$_POST['key']);
      $assign_key=mysqli_escape_string($conn,generateRandomString());
        $class_name=mysqli_escape_string($conn,$_POST['class']);
        $assignment_name=mysqli_escape_string($conn,$_POST['assignment_name']);
        $qp=mysqli_escape_string ($conn,$file_name);
        $last_date=mysqli_escape_string($conn,$_POST['submit_date']);
        $crete_by=mysqli_escape_string($conn,$_SESSION['tid']);
        $added_on=mysqli_escape_string($conn,$date);


      $sql="INSERT INTO `asignment`(`assign_key`, `class_name`, `assignment_name`, `qp`, `last_date`, `created_by`, `added_on`) VALUES 
      ('".$assign_key."','".$class_name."','".$assignment_name."','".$qp."','".$last_date."','".$crete_by."','".$added_on."')";
        $res=mysqli_query($conn,$sql);
        if (move_uploaded_file($_FILES['file']['tmp_name'], $target_dir.$file_name)) {
        }
        if($res){
          $_SESSION['status']="Assignment Created Successfully...!";
          $_SESSION['status_code']="success";
          header('Location: ../views/t_home.php');  
          $_POST=array();
      exit();
        }else{
          $_SESSION['status']="Somthing Went Wrong unable to Create Assignment Try Again!";
          $_SESSION['status_code']="error";  
          header('Location: ../views/t_home.php');  
          $_POST=array();
      exit();
       }
  }

  if(isset($_GET['deltasign'])){
    $id=mysqli_escape_string($conn,$_GET['id']);
   $res= mysqli_query($conn,"SELECT * FROM asignment WHERE asign_id='".$id."'");
   $row=mysqli_fetch_array($res);
   $res1=mysqli_query($conn,"DELETE FROM asignment WHERE asign_id='".$id."'");
    unlink("../upload/assignments/qp/".$row['qp']);

    if($res1){
      $_SESSION['status']="Assignment Deleted Successfully...!";
      $_SESSION['status_code']="success";
      header('Location: ../views/t_home.php');  
      $_POST=array();
    exit();
    }else{
      $_SESSION['status']="Somthing Went Wrong Unable to Delete the Assignment Try Again!";
      $_SESSION['status_code']="error";  
      header('Location: ../views/t_home.php');  
    $_POST=array();
    exit();
   }
  }
}

if (isset($_SESSION['slogin'])) {

 if(isset($_POST['x1'])){
    $k=mysqli_escape_string($conn,$_POST['x1']);
    $res=mysqli_query($conn,"SELECT * FROM asignment where assign_key='".$k."'");
    if(mysqli_num_rows($res)>0){
   $row=mysqli_fetch_array($res);
   $tid=$row['created_by'];
   $res1=mysqli_query($conn,"SELECT * from faculty1 where id='".$tid."'");
   $row1=mysqli_fetch_array($res1);
   echo('
   <div class="d-flex flex-wrap justify-content-evenly" >
   <input type="hidden" name="aid" value="'.$row['asign_id'].'">
   <input type="hidden" name="aname" value="'.$row['assignment_name'].'">
   <label>Assignment Key: &nbsp;'.$row['assign_key'].'</label><br>
   <input type="hidden" name="akey" value="'.$row['assign_key'].'">
   <label>Class Name: &nbsp;'.$row['class_name'].'</label><br>
   <label>Professor Name: &nbsp;'.$row1['f_title'].'&nbsp;'.$row1['f_name'].'</label><br>
   <label>Created On: &nbsp;'.$row['added_on'].'</label><br>
   <label>Submission Date: &nbsp;'.$row['last_date'].'</label><br>
 
   </div>
   <div id="pdf">
   <iframe src="../upload/assignments/qp/'.$row['qp'].'" frameborder="1" id="qpr" >
   </iframe> 

   </div>
   <input type="file" name="file" id="qp" accept="application/pdf" class="btn btn-outline-dark" required></input>

   <button type="submit" name="Submitasign" class="btn btn-Success">Submit</button>
   <button type="reset" class="btn btn-dark">Cancel</button>
   ');
  }else{
   echo("Invalid Assignment Key....!");
  }
 } 

    if(isset($_POST['Submitasign'])){
      $target_dir="../upload/assignments/responce/";
      $file_name=$date.$_FILES['file']['name'];

      $res=mysqli_query($conn,"SELECT * FROM student where id='".$_SESSION['sid']."'");
      $row=mysqli_fetch_array($res);

      $aid=mysqli_escape_string($conn,$_POST['aid']);
      $aname=mysqli_escape_string($conn,$_POST['aname']);
      $sid=mysqli_escape_string($conn,$_SESSION['sid']);
      $sname=mysqli_escape_string($conn,$row['s_name']);
      $ans=mysqli_escape_string($conn,$file_name);
      $submitted_on=mysqli_escape_string($conn,$date);

      $sql="INSERT INTO `submit_asign`(`asign_id`, `asign_name`, `s_id`, `s_name`, `submited_on`, `asign_ans`)VALUES
      ('".$aid."','".$aname."','".$sid."','".$sname."','".$submitted_on."','".$ans."')";
      $res=mysqli_query($conn,$sql);
     
      if($res){
        if (move_uploaded_file($_FILES['file']['tmp_name'], $target_dir.$file_name)) {
        }
        $_SESSION['status']="Assignment Submitted Successfully...!";
        $_SESSION['status_code']="success";
        header('Location: ../views/s_home.php');  
        $_POST=array();
       exit();
      }else{
        $_SESSION['status']="Somthing Went Wrong unable to Submit the Assignment Try Again!'";
        $_SESSION['status_code']="error";  
        echo('<script>console.log("'.mysqli_error($conn).'")</script>');
       // header('Location: ../views/s_home.php');  
       $_POST=array();
       exit();
    }

  }


  if(isset($_GET['sdtasign'])){
    $id=mysqli_escape_string($conn,$_GET['subid']);

   $res= mysqli_query($conn,"SELECT * FROM submit_asign WHERE sa_id='".$id."'");
   $row=mysqli_fetch_array($res);

   $res1=mysqli_query($conn,"DELETE FROM submit_asign WHERE sa_id='".$id."'");


    if($res1){
      unlink("../upload/assignments/responce/".$row['asign_ans']);

      $_SESSION['status']="Assignment Deleted Successfully...!";
      $_SESSION['status_code']="success";
      header('Location: ../views/s_home.php');  
      $_POST=array();
    exit();
    }else{
      $_SESSION['status']="Somthing Went Wrong Unable to Delete the Assignment Try Again!";
      $_SESSION['status_code']="error";  
      header('Location: ../views/s_home.php');  
    $_POST=array();
    exit();
   }
  }
}
?>