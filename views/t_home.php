<?php
if (!isset($_SESSION)) session_start();
if (isset($_SESSION['tlogin'])) {
  require 'db_con.php';
  $res = mysqli_query($conn, "select * from faculty1 where id='" . $_SESSION['tid'] . "'");

  if (mysqli_num_rows($res) > 0) {
    $result = mysqli_fetch_array($res);
  }
  $q1 = "select * from classes where (prof1='" . $result['f_name'] . "') or (prof2='" . $result['f_name'] . "') or (prof3='" . $result['f_name'] . "') or (prof4='" . $result['f_name'] . "') or (prof5='" . $result['f_name'] . "') or (prof6='" . $result['f_name'] . "') or (prof7='" . $result['f_name'] . "') or (prof8='" . $result['f_name'] . "')   ";
  $res1 = mysqli_query($conn, $q1);

?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/t_home.css">
    <title>Teachers Home</title>
    <?php require 'db_con.php';
    include 't_menu.php';
    include_once '../Additional_Libraries.php' ?>
  </head>



  <body>

    <div class="cmain">
      <div class="side-menu">
        <h4 style="text-align: center; background-color: rgb(113, 209, 145); padding:3px; margin: 0; border-top-left-radius:10px ;border-top-right-radius:10px ;">
          Hi...<?php echo (ucwords($result['f_name'])); ?>
        </h4>
        <a href="#" id="profilebtn" onclick="showprofile()">Profile</a>
        <div id="profilepanel" class=" w3-animate-zoom" style="padding:5px; display: none; border-bottom: 2px solid gray;">
          <img src="../upload/facultys_profile_img/<?php echo ($result['f_pic']); ?>" alt="profile pic" width="100px" height="100px"><br>

          <span>
            <?php echo (ucwords($result['f_name'])); ?>
          </span><br>
          <label style="font-size: 13px;">
            <?php echo (ucwords($result['f_mailid'])); ?>&nbsp;&nbsp;&nbsp;<i class="fas fa-envelope"></i>
          </label><br>
          <label style="font-size: 13px;">
            <?php echo (ucwords($result['f_qualification'])); ?>
          </label><br>
          <label style="font-size: 13px;">
            <?php echo (ucwords($result['f_department'])); ?>
          </label><br>
        </div>

        <a href="../views/logout.php">Log Out &nbsp;&nbsp;&nbsp;<i class="bi bi-box-arrow-right"></i></a>
        <a href="../views/updatepwsd.php">Change the Password</a>

      </div>




      <div class="stdlist">
        <h4 style="text-align: center; background-color: rgb(113, 209, 145); padding:3px; margin: 0;"> Assigned classes <span style="color: red; font: size 14px; ;"><?php echo ('(' . mysqli_num_rows($res1) . ')') ?></span></h4>

        <ul class="w3-ul w3-card-4">
          <?php
          if (mysqli_num_rows($res1) > 0) {


            while ($class = mysqli_fetch_array($res1)) {
              echo ('  <li>
  <div>
    <span>
     <label>Class Name: </label>' . $class['c_name'] . '
    </span><br>
 
  
  </div>
  </li>');
            }
          }
          // }
          ?>
        </ul>


      </div>
      <!-- <div class="examlist">
    <h4 style="text-align: center; background-color: rgb(113, 209, 145); padding:3px; margin: 0;">Created Exams</h4>
    <ul class="w3-ul w3-card-4">
      <% exam.forEach(function (et) { %>

        <li>
          <span onclick="this.parentElement.style.display='none'"
                class="w3-bar-item w3-button w3-white w3-xlarge w3-right">×</span>
          <div>
            <span>
             <label>Name: </label> <%= et.exam_name %>
            </span><br>
            <span>
             <label for=""> Max Marks:</label> <%= et.max_mark %>
            </span><br>
            <span>
             <label for="">Date:</label> <%= et.date_of_exam %>
            </span><br>
            <span>
              <label for="">Time:</label> <%= et.time_of_exam %>
             </span><br>
             <span>
              <label for="">Key:</label> <%= et.exam_key %>
             </span><br>
          
          </div>
        </li>
  
        <% })%>
    </ul>
  </div>-->
    </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <!-- <script>
    $(document).ready(function () {
      $("#myModal").modal('show');
    });
  </script>-->


    <!-- <div id="myModal" class="modal fade">
    <div class="modal-dialog  modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Welcome Back<span style="text-transform: capitalize;">
              <%= teacher[0].t_name %>
            </span></h5>
          <button type="button" class="btn-close" data-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <p>Subscribe to our mailing list to get the latest updates straight in your inbox.</p>
        </div>
      </div>
    </div>
  </div>
  
  <div id="myModal1" class="modal fade" >
    <div class="modal-dialog  modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><i class="fas fa-chalkboard-teacher fa-2x"></i>&nbsp; Valuate the the Exam</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>        
          </div>
        <div class="modal-body">
          <form action="/valuate" method="POST" enctype="multipart/form-data">
          <div class="form-floating mb-3 ">
            <input type="text" class="form-control" id="examkey" name="examkey" placeholder="a" required>
            <label for="examkey">Enter Exam Key</label>
          </div>
          <button type="submit"  class="btn btn-outline-primary">Valuate Exam</button>
          <button type="button" class="btn btn-outline-dark"  data-bs-dismiss="modal">Cancle</button>
        </form>
        </div>
      </div>
    </div>
  </div>-->

  </body>

  <footer>
    <?php include 'footer.php' ?>
  </footer>
  <script>
    function showprofile() {
      var x = document.getElementById("profilepanel");
      if (x.style.display === "none") {
        x.style.display = "block"
      } else {
        x.style.display = "none"
      }
    }

    $("#valexam").click(function() {

      $("#myModal1").modal("show");
    });
  </script>
<?php } else {
  echo "<script>
        
        alert('Plese Login First');
        window.location.href ='t_login.php';

        </script>";
}
?>

  </html>