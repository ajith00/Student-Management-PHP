<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Home</title>
  <?php require 'db_con.php';
  include 'a_menu.php';
  include_once '../Additional_Libraries.php';

  $sql = "SELECT COUNT(*) as TotalStudents,COUNT(if( s_sex='Male',1,null)) as Total_Boys ,COUNT(if(s_sex='Female',1,null)) as Total_girls,COUNT(if(s_sex='Others',1,null)) as Total_others,
  COUNT(if(s_course='BA',1,null)) as BAtotal,COUNT(if(s_course='BA' AND s_sex='Male',1,null)) as BAboys ,COUNT(if(s_course='BA' AND s_sex='Female',1,null)) as BAgirls,COUNT(if(s_course='BA' AND s_sex='Others',1,null)) as BAothers,
  
  COUNT(if(s_course='BCA',1,null)) as BCAtotal,COUNT(if(s_course='BCA' AND s_sex='Male',1,null)) as BCAboys ,COUNT(if(s_course='BCA' AND s_sex='Female',1,null)) as BCAgirls,COUNT(if(s_course='BCA' AND s_sex='Others',1,null)) as BCAothers,
  
  COUNT(if(s_course='B.Com',1,null)) as BCOMtotal ,COUNT(if(s_course='B.Com' AND s_sex='Male',1,null)) as BCOMboys ,COUNT(if(s_course='B.Com' AND s_sex='Female',1,null)) as BCOMgirls,COUNT(if(s_course='B.Com' AND s_sex='Others',1,null)) as BCOMothers,
  
  COUNT(if(s_course='BBA',1,null)) as BBAtotal ,COUNT(if(s_course='BBA' AND s_sex='Male',1,null)) as BBAboys ,COUNT(if(s_course='BBA' AND s_sex='Female',1,null)) as BBAgirls,COUNT(if(s_course='BBA' AND s_sex='Others',1,null)) as BBAothers,
  
  COUNT(if(s_course='M.Com',1,null)) as MCOMtotal ,COUNT(if(s_course='M.Com' AND s_sex='Male',1,null)) as MCOMboys ,COUNT(if(s_course='M.Com' AND s_sex='Female',1,null)) as MCOMgirls,COUNT(if(s_course='M.Com' AND s_sex='Others',1,null)) as MCOMothers
  
  FROM `student`";
  $res = mysqli_query($conn, $sql);
  if (mysqli_num_rows($res) > 0) {
    $count = mysqli_fetch_array($res);
  }
  $sql1 = "SELECT COUNT(*) as TotalFaculty,COUNT(if(f_sex='Male',1,null)) as MaleFaculty,COUNT(if(f_sex='Female',1,null)) as FemaleFaculty,COUNT(if(f_sex='Others',1,null)) as OtherFaculty FROM faculty1";
  $res1 = mysqli_query($conn, $sql1);
  if (mysqli_num_rows($res1) > 0) {
    $faculty = mysqli_fetch_array($res1);
  }
  ?>
</head>


<style>
  .main-container {
    display: flex;
    background-image: url("../img/abg.jpg");
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    justify-content: center;
    min-height: 500px;
    height: auto;
    flex-wrap: wrap;
  }

  .card {
    margin: 20px;
    padding: 20px;
    width: 400px;
    min-height: 200px;
    display: grid;
    grid-template-rows: 20px 50px 1fr 50px;
    border-radius: 10px;
    box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.25);
    box-shadow: rgba(50, 50, 93, 0.25) 0px 30px 60px -12px inset, rgba(0, 0, 0, 0.3) 0px 18px 36px -18px inset;
    transition: all 0.2s;
    justify-content: center;
    color: aliceblue;
    height: max-content;
  }

  .card>span {
    transition: all 0.5s;
    font-size: 16px;

  }

  .link {
    text-decoration: wavy !important;
    position: absolute;
    right: 0;
    bottom: 0;
    padding: 10px;
  }


  .card:hover {
    box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.4);
    transform: scale(1.01);
    transform: translateY(20px);
  }

  .card-1 {
    background: radial-gradient(#1fe4f5, #3fbafe);
  }

  .card-2 {
    background: radial-gradient(#fbc1cc, #fa99b2);
  }

  .card-3 {
    background: radial-gradient(#76b2fe, #b69efe);
  }

  .card-4 {
    background: radial-gradient(#60efbc, #58d5c9);
  }

  .card-5 {
    background: radial-gradient(#f588d8, #c0a3e5);
  }

  .heading {
    font-size: 30px !important;
    text-transform: capitalize;
  }

  hr {
    margin: 1px;
  }
</style>

<body>
  <div class="w3-container main-container">
    <div class="w3-center w3-animate-zoom card card-5 ">
      <span class="heading">All Students</span>
      <hr>
      <span><i class="bi bi-collection"></i>&nbsp;&nbsp; Total:<?php echo ($count['TotalStudents']); ?></span>
      <span><i class="bi bi-gender-male"></i>&nbsp;&nbsp;Male:<?php echo ($count['Total_Boys']); ?></span>
      <span><i class="bi bi-gender-female"></i>&nbsp;&nbsp; Feamle:<?php echo ($count['Total_girls']); ?></span>
      <span> <i class="bi bi-gender-trans"></i>&nbsp;&nbsp;Others:<?php echo ($count['Total_others']); ?></span>
      <br>
    </div>
    <div class="w3-center w3-animate-zoom card card-4 ">
      <span class="heading">All Faculty</span>
      <hr>
      <span><i class="bi bi-collection"></i>&nbsp;&nbsp; Total:<?php echo ($faculty['TotalFaculty']); ?></span>
      <span><i class="bi bi-gender-male"></i>&nbsp;&nbsp;Male:<?php echo ($faculty['MaleFaculty']); ?></span>
      <span><i class="bi bi-gender-female"></i>&nbsp;&nbsp; Feamle:<?php echo ($faculty['FemaleFaculty']); ?></span>
      <span> <i class="bi bi-gender-trans"></i>&nbsp;&nbsp;Others:<?php echo ($faculty['OtherFaculty']); ?></span>
      <span class="link"><a href="../actions/downloadattendence.php?downloadfaculty=?">Download&nbsp;<i class="bi bi-cloud-download-fill"></i></a></span>
      <br>
    </div>
    <div class="w3-center w3-animate-top card card-1">
      <span class="heading">B.Com</span>
      <hr>
      <span><i class="bi bi-collection"></i>&nbsp;&nbsp; Total:<?php echo ($count['BCOMtotal']); ?></span>
      <span><i class="bi bi-gender-male"></i>&nbsp;&nbsp;Male:<?php echo ($count['BCOMboys']); ?></span>
      <span><i class="bi bi-gender-female"></i>&nbsp;&nbsp; Feamle:<?php echo ($count['BCOMgirls']); ?></span>
      <span> <i class="bi bi-gender-trans"></i>&nbsp;&nbsp;Others:<?php echo ($count['BCOMothers']); ?></span>
      <span class="link"><a href="../actions/downloadattendence.php?downloadstudents=?&dept=B.Com">Download&nbsp;<i class="bi bi-cloud-download-fill"></i></a></span>
<br>
    </div>
    <div class="w3-center w3-animate-bottom card card-2">
      <span class="heading">BCA</span>
      <hr>
      <span><i class="bi bi-collection"></i>&nbsp;&nbsp; Total:<?php echo ($count['BCAtotal']); ?></span>
      <span><i class="bi bi-gender-male"></i>&nbsp;&nbsp;Male:<?php echo ($count['BCAboys']); ?></span>
      <span><i class="bi bi-gender-female"></i>&nbsp;&nbsp; Feamle:<?php echo ($count['BCAgirls']); ?></span>
      <span> <i class="bi bi-gender-trans"></i>&nbsp;&nbsp;Others:<?php echo ($count['BCAothers']); ?></span>
      <span class="link"><a href="../actions/downloadattendence.php?downloadstudents=?&dept=BCA">Download&nbsp;<i class="bi bi-cloud-download-fill"></i></a></span>
<br>
    </div>
    <div class="w3-center w3-animate-left card card-3 ">
      <span class="heading">BA</span>
      <hr>
      <span><i class="bi bi-collection"></i>&nbsp;&nbsp; Total:<?php echo ($count['BAtotal']); ?></span>
      <span><i class="bi bi-gender-male"></i>&nbsp;&nbsp;Male:<?php echo ($count['BAboys']); ?></span>
      <span><i class="bi bi-gender-female"></i>&nbsp;&nbsp; Feamle:<?php echo ($count['BAgirls']); ?></span>
      <span> <i class="bi bi-gender-trans"></i>&nbsp;&nbsp;Others:<?php echo ($count['BAothers']); ?></span>
      <span class="link"><a href="../actions/downloadattendence.php?downloadstudents=?&dept=BA">Download&nbsp;<i class="bi bi-cloud-download-fill"></i></a></span>
<br>
    </div>
    <div class="w3-center w3-animate-right card card-4 ">
      <span class="heading">BBA</span>
      <hr>
      <span><i class="bi bi-collection"></i>&nbsp;&nbsp; Total:<?php echo ($count['BBAtotal']); ?></span>
      <span><i class="bi bi-gender-male"></i>&nbsp;&nbsp;Male:<?php echo ($count['BBAboys']); ?></span>
      <span><i class="bi bi-gender-female"></i>&nbsp;&nbsp; Feamle:<?php echo ($count['BBAgirls']); ?></span>
      <span> <i class="bi bi-gender-trans"></i>&nbsp;&nbsp;Others:<?php echo ($count['BBAothers']); ?></span>
      <span class="link"><a href="../actions/downloadattendence.php?downloadstudents=?&dept=BBA">Download&nbsp;<i class="bi bi-cloud-download-fill"></i></a></span>
<br>
    </div>
    <div class="w3-center w3-animate-zoom card card-5 ">
      <span class="heading">M.Com</span>
      <hr>
      <span><i class="bi bi-collection"></i>&nbsp;&nbsp; Total:<?php echo ($count['MCOMtotal']); ?></span>
      <span><i class="bi bi-gender-male"></i>&nbsp;&nbsp;Male:<?php echo ($count['MCOMboys']); ?></span>
      <span><i class="bi bi-gender-female"></i>&nbsp;&nbsp; Feamle:<?php echo ($count['MCOMgirls']); ?></span>
      <span> <i class="bi bi-gender-trans"></i>&nbsp;&nbsp;Others:<?php echo ($count['MCOMothers']); ?></span>
      <span class="link"><a href="../actions/downloadattendence.php?downloadstudents=?&dept=M.Com">Download&nbsp;<i class="bi bi-cloud-download-fill"></i></a></span>
<br>
    </div>

  </div>





</body>
<footer>
  <?php include 'footer.php' ?>
</footer>

</html>