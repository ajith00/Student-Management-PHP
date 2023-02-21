<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/mobilemenu.css">
</head>
<body>
<?php  $logourl="../img/logo_1.png"?>
<div id="main">
<img src="<?php echo $logourl; ?> " width="200px" height="50px">  
<span style="font-size:30px;cursor:pointer" class="openbtn" onclick="openNav()">&#9776;</span>

</div>
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()" style="display: inline;">&times;</a>
  <a href="#">Home</a>
  <a href="#">Register</a>
  <a href="#">Teachers Login</a>
  <a href="#">Student Login</a>
  <a href="#">Help</a>
  <a href="#">Admin</a>
</div>



<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
}
</script>
   
</body>
</html> 
