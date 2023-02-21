

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="../css/menu.css">

</head>
<!-- desktop menu-->
<?php  $logourl="../img/logo_1.png"?>
<div id="menu" class="header main">
    <img src="<?php echo $logourl; ?> " width="200px" height="50px" style="margin: 5px;">  
        <ul class="nav  flex-column flex-sm-row">
            <li><a href="../views/s_home.php" target="_top"  >Home</a></li>
            <li><a href="../views/s_view_ia.php" target="_top">IA Marks</a></li>
            <li><a href="../views/s_view_assignments.php" target="_top"  > Assignment</a></li>
            <li><a href="../views/updatepwsd.php" target="_top">Update the Password</a></li>
            <li><a href="../views/logout.php" target="_top">Logout</a></li>
            <li>  <a href="#" target="_top">Report the Problem</a>
</li>
        </ul>
 
</div>

<!--mobile menu-->
<div id="main">
<img src="<?php echo $logourl; ?> " width="200px" height="50px">  
<span style="font-size:30px;cursor:pointer" class="openbtn" onclick="openNav()">&#9776;</span>

</div>
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()" style="border: none;">&times;</a>
  <a href="../views/s_home.php">Home</a>
  <a href="../views/s_view_ia.php">IA Marks</a>
  <a href="../views/s_view_assignments.php" target="_top"  > Assignments</a>
  <a href="../views/updatepwsd.php" target="_top">Update the Password</a>
  <a href="../views/logout.php">Logout</a>
  <a href="#" target="_top">Report the Problem</a>

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
   
