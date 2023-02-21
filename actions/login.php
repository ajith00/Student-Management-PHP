<?php require '../views/db_con.php'; ?>
<?php
if (!isset($_SESSION)) session_start();
//student login
if (isset($_POST['slogin'])) {
    $suname = $_POST['susername'];
    $spwsd = $_POST['spass'];
    $res = mysqli_query($conn, "select * from student where s_mailid='$suname'");
    if (mysqli_num_rows($res) > 0) {
    $result = mysqli_fetch_array($res);
    $hash=$result['pwsd'];
    }
    $verify = password_verify($spwsd, $hash);
    
    if ($verify) {
        if (isset($_POST["remember"]) && $_POST["remember"] == 1) {
           setcookie("susername", $_POST["susername"],time() + 3600);
           setcookie("spassword", $_POST["spass"], time() + 3600);
           
      $_SESSION['slogin']=true;
      $_SESSION['sid']=$result['id'];
      $_SESSION['sname']=$result['s_name'];
        } 
        date_default_timezone_set('Asia/Kolkata');
        $date = date('Y/m/d H:i:s');
         $res=mysqli_query($conn,"UPDATE `student` SET last_scean='".$date."' where s_mailid='".$suname."'");
       header("location:../views/s_home.php");
    } else {
        echo "<script>
        window.location.href ='s_login.php';
        
        alert('Invalid username or password');
        </script>";
    //echo "<noscript>Wrong login or password</noscript>";
    // header("location:s_login.php?err=1");
    }
}


//teachers login

if (isset($_POST['tlogin'])) {
    $tuname = $_POST['tusername'];
    $tpwsd = $_POST['tpass'];
    $res = mysqli_query($conn, "select * from faculty1 where f_mailid='$tuname'");
    if (mysqli_num_rows($res) > 0) {
    $result = mysqli_fetch_array($res);
    $hash=$result['pwsd'];

    }
    $verify = password_verify($tpwsd, $hash);
    
    if ($verify) {
        if (isset($_POST["remember"]) && $_POST["remember"] == 1) {
          setcookie("tusername", $_POST["tusername"],time() + 3600);
           setcookie("tpassword", $_POST["tpass"], time() + 3600);
          
           //setcookie("login", "1", time() + 60); // second on page time 
      // header("location:../views/s_home.php");
      $_SESSION['tlogin']=true;
    $_SESSION['tid']=$result['id'];
    $_SESSION['tname']=$result['f_name'];
        } 
        date_default_timezone_set('Asia/Kolkata');
        $date = date('Y/m/d H:i:s');
         $res=mysqli_query($conn,"UPDATE `faculty1` SET last_scene='".$date."' where f_mailid='".$tuname."'");
       header("location:../views/t_home.php");
    } else {
        echo "<script>
        window.location.href ='../views/t_login.php';
        
        alert('Invalid username or password');
        </script>";
    //echo "<noscript>Wrong login or password</noscript>";
    // header("location:s_login.php?err=1");
    }
}

?>