

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
        <ul class="nav  flex-column flex-sm-row">
            <li><a href="../views/admin_home.php" target="_top"  >Home</a></li>
            <li><a href="../views/a_Facultys.php" target="_top">Faculties</a></li>
            <li><a href="../views/a_students.php" target="_top"  >Students</a></li>
            <li><a href="../views/logout.php" target="_top">Logout</a></li>
        </ul> 
</div>

<!--mobile menu-->
<div id="main">
<img src="<?php echo $logourl; ?> " width="200px" height="50px">  
<span style="font-size:30px;cursor:pointer" class="openbtn" onclick="openNav()">&#9776;</span>
</div>
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()" style="border: none;">&times;</a>
  <a href="../views/homepage.php" target="_top"  >Home</a>
  <a href="../views/a_Facultys.php" target="_top">Faculties</a>
  <a href="../views/a_students.php" target="_top" >Students</a>
  <a href="../views/logout.php" target="_top">Logout</a>
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
   
