<?php
session_start();
if (isset($_SESSION['tlogin'])) {
  require 'db_con.php';
  include_once '../Additional_Libraries.php';
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Class</title>
  <?php require 'db_con.php';
        include 't_menu.php'; ?>
</head>
<style>
  .mainnn{
    display: flex;
    flex-wrap: wrap;
    width: 95%;
    height: max-content;
    overflow: auto;
  }
  .mainnn >.card{
    flex-basis: 25%;
  }
</style>
<body>
 <div class="mainnn" id="main">

 

 </div> 
</body>
<footer>
        <?php include 'footer.php' ?>
      </footer>

</html>


<?php }

else{
    echo ("File Not Found");
}
?>