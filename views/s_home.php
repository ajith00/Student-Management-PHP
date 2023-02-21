<?php
if (!isset($_SESSION)) session_start();
if (isset($_SESSION['slogin'])) {
  require 'db_con.php';
  include_once '../Additional_Libraries.php';
  $res = mysqli_query($conn, "select * from student where id='" . $_SESSION['sid'] . "'");
  if (mysqli_num_rows($res) > 0) {
    $result = mysqli_fetch_array($res);
  }
  $sclass = $result['s_course'] . "-" . $result['s_sem'];

  $sql = mysqli_query($conn, "select * from classes where c_name='" . $sclass . "'");

  $student_data = mysqli_fetch_array($sql);
  $sql1 = mysqli_query($conn, "SELECT sub_name, COUNT(*) as totalclass ,COUNT(if(attendence='A',1,null)) as abesent ,COUNT(if(attendence='P',1,null)) as present FROM `attadence` WHERE  s_id='" . $_SESSION['sid'] . "' GROUP BY sub_name");
  // $sql1=mysqli_query($conn,"select * from attadence");


?>


  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/s_home.css">
    <link rel="stylesheet" href="../css/progressbar.css">
    <script src="../ckeditor5-build-classic/ckeditor.js"></script>
    <title>Student Home</title>
    <?php require 'db_con.php';
    include 's_menu.php'; ?>
  </head>


  <body>
    <div class="cmain">


      <div class="side-menu">

        <h4 style="text-align: center; background-color: rgb(113, 209, 145); padding:3px; margin: 0; border-radius: inherit;">
          Hi... <?php echo (ucwords($result['s_name'])); ?>
        </h4>
        <a href="#" id="profilebtn" onclick="showprofile()">Profile &nbsp; &nbsp;<i class="bi bi-card-heading"></i></a>

        <div id="profilepanel" class=" w3-animate-zoom" style="padding:5px; display: none;">

          <img src="../upload/students_profile_img/<?php echo ($result['s_pic']); ?>" alt="profile pic" width="100px" height="100px"><br>
          <span>
            <?php echo (ucwords($result['s_name'])); ?>
          </span><br>
          <span>
            <?php echo (ucwords($result['s_mailid'])); ?> &nbsp;&nbsp;&nbsp;<i class="bi bi-envelope-fill"></i>
          </span><br>
          <span>
            <?php echo (ucwords($result['s_course'])); ?>
          </span><br>
          <span>
            <?php echo (ucwords($result['s_sem']));  ?>&nbsp;&nbsp; <i class="bi bi-mortarboard"></i>
          </span><br>
        </div>
        <a href="#" id="profilebtn" onclick="showattendence()">Attendence &nbsp; &nbsp;<i class="bi bi-card-heading"></i></a>

        <div id="attendencepanal" class=" w3-animate-zoom" style="padding:5px; display: none;">

        <?php
          $cpanal = mysqli_query($conn, "select * from access_control where id='1'");
          $c_panal = mysqli_fetch_array($cpanal);
          if($c_panal['aten_for_student']=="1"){
        if (mysqli_num_rows($sql1) > 0) {
          while ($attendence = mysqli_fetch_array($sql1)) {
        ?>
            <div id="card">
              <div role="progressbar" aria-valuenow="<?php echo ($attendence['present']); ?>" aria-valuemin="0" aria-valuemax="<?php echo ($attendence['totalclass']); ?>" style="--value:<?php $op = $attendence['present'];
                                                                                                                                                                                          $to = $attendence['totalclass'];
                                                                                                                                                                                          $perc = ($op / $to) * 100;
                                                                                                                                                                                          echo (round($perc)); ?>;"></div>
              <div id="data">
                <label for="">Subject :<?php echo ($attendence['sub_name']); ?></label><br>
                <label for="">Total No of Classes :<?php echo ($attendence['totalclass']); ?></label><br>
                <label for="">Present :<?php echo ($attendence['present']); ?></label><br>
                <label for="">Absent :<?php echo ($attendence['abesent']); ?></label><br>

              </div>
            </div>
            <hr>
        <?php
          }
        }else{
          echo('<div id="card">
          <div id="data">
          <label>Attendence is not Available</label>
           </div>
          </div>');
        }
      }else{
        echo('<div id="card">
        <div id="data">
        <label>Attendence is Blocked By Collage</label><br> <label>Cobtact Admin</label>
         </div>
        </div>');
        }
        ?>
        </div>
      </div>
      <div class="upcmgexam">
        <h4 style="text-align: center; background-color: rgb(113, 209, 145); padding:3px; margin: 0;">Subject-->Professor
        </h4>
        <ul class="w3-ul w3-card-4">

          <?php if ($student_data != null) { ?>
            <div>
              <span><?php if ($student_data != null) echo (ucwords($student_data['sub1'])); ?></span><em>--></em><?php if ($student_data != null) echo (ucwords($student_data['prof1'])); ?></span><br>
              <span><?php if ($student_data != null) echo (ucwords($student_data['sub2'])); ?></span><em>--></em><?php if ($student_data != null) echo (ucwords($student_data['prof2'])); ?></span><br>
              <span><?php if ($student_data != null) echo (ucwords($student_data['sub3'])); ?></span><em>--></em><?php if ($student_data != null) echo (ucwords($student_data['prof3'])); ?></span><br>
              <span><?php if ($student_data != null) echo (ucwords($student_data['sub4'])); ?></span><em>--></em><?php if ($student_data != null) echo (ucwords($student_data['prof4'])); ?></span><br>
              <span><?php if ($student_data != null) echo (ucwords($student_data['sub5'])); ?></span><em>--></em><?php if ($student_data != null) echo (ucwords($student_data['prof5'])); ?></span><br>
              <span><?php if ($student_data != null) echo (ucwords($student_data['sub6'])); ?></span><em>--></em><?php if ($student_data != null) echo (ucwords($student_data['prof6'])); ?></span><br>
              <span><?php if ($student_data != null) echo (ucwords($student_data['sub7'])); ?></span><em>--></em><?php if ($student_data != null) echo (ucwords($student_data['prof7'])); ?></span><br>
              <span><?php if ($student_data != null) echo (ucwords($student_data['sub8'])); ?></span><em>--></em><?php if ($student_data != null) echo (ucwords($student_data['prof8'])); ?></span><br>
            </div>
          <?php
          } else { ?>
            <span>Class Creation is Pending</span>
          <?php } ?>
        </ul>
      </div>
    </div>


  </body>


  <footer>
    <?php include 'footer.php' ?>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

  <script>
    ClassicEditor

      .create(document.querySelector('#editor'))
      .then(editor => {
        editor.isReadOnly = true;
      })
      .catch(err => {
        console.error(err.stack);
      });

    function showprofile() {
      var x = document.getElementById("profilepanel");
      if (x.style.display === "none") {
        x.style.display = "block"
      } else {
        x.style.display = "none"
      }
    }
    function showattendence() {
      var x = document.getElementById("attendencepanal");
      if (x.style.display === "none") {
        x.style.display = "block"
      } else {
        x.style.display = "none"
      }
    }


    $("#takeexm").click(function() {

      $("#myModal").modal("show");

    });
  </script>
<?php } else {
  echo "<script>
        
        alert('Please Login First');
        window.location.href ='s_login.php';

        </script>";
}
?>

  </html>