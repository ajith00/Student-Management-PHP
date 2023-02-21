<?php
session_start();
include_once '../Additional_Libraries.php';
require 'db_con.php'; 
        
include_once '../bootstrapalert.php';

if(isset($_SESSION['slogin'] )){

     
        $res = mysqli_query($conn, "select * from student where id='".$_SESSION['sid']."'");
        if (mysqli_num_rows($res) > 0) {
          $result = mysqli_fetch_array($res);
          }
        
    ?> 


    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Update Password</title>
        <?php
        include 's_menu.php'; ?>
    </head>
    <style>
      html> body{
        background-color: #c9e9f6;
      }
        .mainpanal{
            padding: 10px;
            width: max-content;
            height: auto;
            position:relative;
            display: block;
            left: 40%; 
        }
        span{
            text-decoration: underline;
        }
      
    </style>
    <body>
        <div class="mainpanal">
        <p>Hello <span> <?php echo ($result['s_name']);?></span> Update Your Password</p>
        <form action="../actions/update_s_pwsd.php"  method="POST" enctype="multipart/form-data" id="myform">
            <div class="form-floating mb-3">
      <input type="password" class="form-control" id="oldpwsd" name="old" placeholder="nm" required>
      <label for="oldpwsd">Current Password</label>
    </div>
    <div class="form-floating  mb-3">
      <input type="password" class="form-control" id="newpwsd" name="new" placeholder="Password" required>
      <label for="newpwsd">New Password</label>
    </div>
    <div class="form-floating  mb-3">
      <input type="password" class="form-control" id="cnewpwsd" name="cnew"  placeholder="Password" required>
      <label for="cnewpwsd">Confiem New Password</label>
    </div>
    <button type="submit" class="btn btn-outline-primary" name="supbtn" >Update</button>
    <button type="button" class="btn btn-outline-danger">Cancle</button>
    </form>
    </div>

    </body>
    <footer>
        <?php include 'footer.php' ?>
    </footer>
    </html>

  <?php 
}elseif (isset($_SESSION['tlogin'] )) { 
      $res = mysqli_query($conn, "select * from faculty1 where id='".$_SESSION['tid']."'");
      if (mysqli_num_rows($res) > 0) {
        $result = mysqli_fetch_array($res);
        }
      ?>

      <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Update Password</title>
        <?php
        include 't_menu.php'; ?>
    </head>
    <style>
    
        .mainpanal{
            padding: 10px;
            width: max-content;
            height: auto;
            position:relative;
            display: block;
            left: 40%; 
        }
        span{
            text-decoration: underline;
        }
        @media  screen and (max-width: 1400px) and (min-width: 200px)  {
          .mainpanal{
left: 25%;
          }
        }
      
    </style>
    <body>
        <div class="mainpanal">
        <p>Hello <span> <?php echo ($result['f_name']);?></span> Update Your Password</p>
        <form action="../actions/update_s_pwsd.php"  method="POST" enctype="multipart/form-data" id="myform">
            <div class="form-floating mb-3">
      <input type="password" class="form-control" id="oldpwsd" name="old" placeholder="nm" required>
      <label for="oldpwsd">Current Password</label>
    </div>
    <div class="form-floating  mb-3">
      <input type="password" class="form-control" id="newpwsd" name="new" placeholder="Password" required>
      <label for="newpwsd">New Password</label>
    </div>
    <div class="form-floating  mb-3">
      <input type="password" class="form-control" id="cnewpwsd" name="cnew"  placeholder="Password" required>
      <label for="cnewpwsd">Confiem New Password</label>
    </div>
    <button type="submit" class="btn btn-outline-primary" name="tupbtn" >Update</button>
    <button type="button" class="btn btn-outline-danger">Cancle</button>
    </form>
    </div>

    </body>
    <footer>
        <?php include 'footer.php' ?>
    </footer>
    </html>
     <?php
        }
    
    
        else {
 
    echo('<script>
    alert("Unauthorised Access");
location.href="homepage.php";
</script>');
    
    
    }
     ?>
 
