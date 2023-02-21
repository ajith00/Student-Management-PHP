 <?php require 'db_con.php'; 
 include_once '../Additional_Libraries.php';
 if (!isset($_SESSION)) session_start();
 ?>
<?php


if (isset($_POST['login'])) {
    $suname = $_POST['username'];
    $spwsd = $_POST['pass'];
    $res = mysqli_query($conn, "select* from admin_login where username='$suname'and pwsd='$spwsd'");
    $result = mysqli_fetch_array($res);
    if ($result) {
        if (isset($_POST["remember"]) && $_POST["remember"] == 1) {
            setcookie("ausername", $_POST["username"], time() + 3600);
            setcookie("apassword", $_POST["pass"], time() + 3600);
         //  setcookie("login", "1", time() + 60); // second on page time 
         header("location:admin_home.php");
        } else
          //  setcookie("login", "1");
        header("location:admin_home.php");
    } else {
        $_SESSION['status']="Login Failed";
        $_SESSION['status_code']="error";
        header("location:admin_login.php?err=1");
    }
}

?>