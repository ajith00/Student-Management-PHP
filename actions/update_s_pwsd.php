<?php 
session_start();
require '../views/db_con.php'; 
if(isset($_SESSION['slogin']) || isset($_SESSION['tlogin'])){

        if(isset($_POST['supbtn'])){

            $oldpwsd=$_POST['old'];
            $newpwsd=$_POST['new'];
            $cnewpwsd=$_POST['cnew'];
            if($newpwsd===$cnewpwsd){
            $newhash = password_hash($newpwsd,PASSWORD_DEFAULT);
            $res = mysqli_query($conn, "select * from student where id='".$_SESSION['sid']."'");
            if (mysqli_num_rows($res) > 0) {
            $result = mysqli_fetch_array($res);
            $hash=$result['pwsd']; 
            $verify = password_verify($oldpwsd, $hash);
            }
            if($verify){
                $res = mysqli_query($conn, "UPDATE `student` SET `pwsd`='".$newhash."',`summa`='".$newpwsd."' where id='".$_SESSION['sid']."'");
            $_SESSION['status_code']='info';
            $_SESSION['status']='done';
            }else{
                $_SESSION['status_code']='error';
                $_SESSION['status']='Wrong Password';
            }
        header("location:../views/updatepwsd.php");

        }else{
            $_SESSION['status_code']='info';
            $_SESSION['status']='Confirm Password is not Matching';
            header("location:../views/updatepwsd.php");

        }
        }elseif (isset($_POST['tupbtn'])) {
            
            $oldpwsd=$_POST['old'];
            $newpwsd=$_POST['new'];
            $cnewpwsd=$_POST['cnew'];
            if($newpwsd===$cnewpwsd){
            $newhash = password_hash($newpwsd,PASSWORD_DEFAULT);
            $res = mysqli_query($conn, "select * from faculty where id='".$_SESSION['tid']."'");
            if (mysqli_num_rows($res) > 0) {
            $result = mysqli_fetch_array($res);
            $hash=$result['pwsd']; 
            $verify = password_verify($oldpwsd, $hash);
            }
            if($verify){
                $res = mysqli_query($conn, "UPDATE `faculty` SET `pwsd`='".$newhash."',`summa`='".$newpwsd."' where id='".$_SESSION['tid']."'");
            $_SESSION['status_code']='info';
            $_SESSION['status']='done';
            }else{
                $_SESSION['status_code']='error';
                $_SESSION['status']='Wrong Password';
            }
        header("location:../views/updatepwsd.php");

        }else{
            $_SESSION['status_code']='info';
            $_SESSION['status']='Confirm Password is not Matching';
            header("location:../views/updatepwsd.php");

        }
   
        }
}
else{
    $_SESSION['status_code']='warning';
    $_SESSION['status']='Unauthorized Access Please Login ';
}
?>