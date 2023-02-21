<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" type="text/css" href="../css/s_login.css">
    <link rel="stylesheet" href="../css/menu.css">

    <?php require 'db_con.php';
    include_once '../Additional_Libraries.php';
    if (!isset($_SESSION)) session_start();
    //include 'a_menu.php'; 
    ?>

</head>


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/menu.css">
</head>
<!-- desktop menu-->
<?php  $logourl="../img/logo_1.png"?>
<div id="menu" class="header main">
    <img src="<?php echo $logourl; ?> " width="200px" height="50px" style="margin: 5px;">  
        
</div>

<!--mobile menu-->
<div id="main">
<img src="<?php echo $logourl; ?> " width="200px" height="50px">  
</div>
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()" style="border: none;">&times;</a>
 
</div>



<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
  //document.getElementById("main").style.marginLeft = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
}
</script>
   



<body>


    <form action="authalogin.php" method="POST" enctype="multipart/form-data">

        <div class="loginpanal">
            <h2>Admin Sign In</h2>
            <div class="textbox "><i class="bi bi-person-circle" aria-hidden="true"></i><input type="text" name="username" value="<?php if (isset($_COOKIE["ausername"])) {
                                                                                                                                        echo $_COOKIE["ausername"];
                                                                                                                                    } ?>" placeholder="Enter UserName" required></div>
            <div class="textbox"><i class="bi bi-shield-lock" aria-hidden="true"></i><input type="password" name="pass" id="" value="<?php if (isset($_COOKIE["apassword"])) {
                                                                                                                                            echo $_COOKIE["apassword"];
                                                                                                                                        } ?>" placeholder="Entet the Password" required></div>

            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="remember" value="1" checked>
                <label class="form-check-label" for="flexSwitchCheckChecked">Remember me</label>
            </div>
            <div class="button">
                <div><input type="submit" name=" login" class="btn btn-outline-primary" value="Sign In" style="margin-right: 16px;"></div>
                <div><input type="reset" class="btn btn-outline-secondary " value="Cancle"></div>
            </div>
        </div>
    </form>

    <footer><?php include 'footer.php' ?> </footer>
</body>


</html>