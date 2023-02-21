<?php require 'db_con.php'; ?>
<?php

session_start();
if (isset($_POST['login'])) {
    $suname = $_POST['username'];
    $spwsd = $_POST['pass'];
    $res = mysqli_query($conn, "select * from teacher_login where username='$suname'and pwsd='$spwsd'");
    $result = mysqli_fetch_array($res);
    if ($result) {
        if (isset($_POST["remember"]) && $_POST["remember"] == 1) {
            setcookie("ausername", $_POST["username"], time() + 3600);
            setcookie("apassword", $_POST["pass"], time() + 3600);
            setcookie("login", "1", time() + 60); // second on page time 
        } else
            setcookie("login", "1");
            date_default_timezone_set('Asia/Kolkata');
            $date = date('Y/m/d H:i:s');
             $res=mysqli_query($conn,"UPDATE `faculty1` SET last_scene='".$date."' where f_mailid='".$suname."'");
        header("location:admin_home.php");
    } else {
        header("location:admin_login.php?err=1");
    }
}

?>