

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../css/menu.css">

</head>
<!-- desktop menu-->
<?php include_once "../Additional_Libraries.php";
 $logourl="../img/logo_1.png"?>
<div id="menu" class="header main">
    <img src="<?php echo $logourl; ?> " width="200px" height="50px" style="margin: 5px;">  
        <ul class="nav  flex-column flex-sm-row">
            <li><a href="../views/t_home.php" target="_top"  >Home</a></li>
            <li><a href="../views/createclasses.php" target="_top"  >Create Class</a></li>
            <li><a href="../views/attendence.php" target="_top"  >Mark Todays Attendence</a></li>
            <li><a href="../views/viewattendence.php" target="_top"  >View Attendence</a></li>
            <li><a href="../views/IA_Marks.php" target="_top"  >IA Marks</a></li>
            <li><a href="../views/viewiamarks.php" target="_top"  >View IA Marks</a></li>
            <li><a href="../views/view_assignments.php" target="_top"  > Assignment</a></li>
            <li><a href="../views/logout.php" target="_top">Logout</a></li>

        </ul>
</div>

<!--mobile menu-->
<div id="main">
<img src="<?php echo $logourl; ?> " width="200px" height="50px">  
<span style="font-size:30px;cursor:pointer" class="openbtn" onclick="openNav()">&#9776;</span>
</div>
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()" style="border: none; font-size: 20px !important;">&times;</a>
  <a href="../views/t_home.php"  target="_top" >Home</a>
  <a href="../views/createclasses.php" target="_top"  >Create Class</a>
  <a href="../views/attendence.php" target="_top"  >Mark Todays Attendence</a>
  <a href="../views/viewattendence.php" target="_top"  >View Attendence</a>
  <a href="../views/IA_Marks.php" target="_top"  >IA Marks</a>
  <a href="../views/viewiamarks.php" target="_top"  >View IA Marks</a>
  <a href="../views/view_assignments.php" target="_top"  > Assignments</a>
  <a href="../views/logout.php" target="_top">Logout</a>
  <a href="../views/updatepwsd.php">Change the Password</a>
  

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
   
