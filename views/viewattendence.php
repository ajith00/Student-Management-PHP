<?php
if (!isset($_SESSION)) session_start();

if (isset($_SESSION['tlogin'])) {
  require 'db_con.php';
  include_once '../Additional_Libraries.php';


  $res = mysqli_query($conn, "select * from faculty1 where id='" . $_SESSION['tid'] . "'");
  if (mysqli_num_rows($res) > 0) {
    $result = mysqli_fetch_array($res);
  }
  $q1 = "select * from classes where (prof1='" . $result['f_name'] . "') or (prof2='" . $result['f_name'] . "') or (prof3='" . $result['f_name'] . "') or (prof4='" . $result['f_name'] . "') or (prof5='" . $result['f_name'] . "') or (prof6='" . $result['f_name'] . "') or (prof7='" . $result['f_name'] . "') or (prof8='" . $result['f_name'] . "')   ";
  $res1 = mysqli_query($conn, $q1);

  if (mysqli_num_rows($res1) > 0) {

    $class_list = "";
    while ($class = mysqli_fetch_array($res1)) {
      $class_list .= '<option value="' . $class['c_name'] . '">' . $class['c_name'] . '</option>';
    }
  }
 

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>View Attendence</title>
      <?php require 'db_con.php';
      include 't_menu.php'; ?>
    </head>

    <body>
      <style>
        tr,
        td {
          text-align: center;
          width: 100px;
        }

        .addaten {

          justify-content: center;
          text-align: center;
        }

        #G1 {
          display: flex;
          justify-content: center;
          text-align: center;

        }

        #G1>select,
        input {
          width: 300px !important;
        }

        .addaten * {

          margin: 5px;
        }

        @media screen and (max-width: 930px) and (min-width: 200px) {
          #G1 {
            flex-wrap: wrap;

          }

          #G1>select,
          input {
            width: 200px !important;
          }

          #myTable {
            font-size: 12px;
            width: 90%;
          }


        }
      </style>
      <div class="addaten">
        <form method="POST" enctype="multipart/form-data">
          <div class="row g-3">
            <div class="col-md" id="G1">
              <select class="form-select" id="class" name="class" aria-label="Floating label select example" required>
                <option value="">--Select--</option>
                <?php echo $class_list; ?>
              </select>

              <select class="form-select" id="sub" name="sub" aria-label="Floating label select example" required>
                <option value="">--Select--</option>
              </select>
              <input type="date" class="form-control" id="datePickerId1" name="dtpicker" min="2020-11-23" value="" required>
              <input type="date" class="form-control" id="datePickerId2" name="dtpicker" min="2020-11-23" value="" required>

              <button type="button" class="btn btn-outline-success" id="findbtn">Find &nbsp;<i class="bi bi-search"></i></button>
              <button type="button" class="btn btn-outline-danger" id="deltbtn">Delete Today`s Attendance &nbsp;<i class="bi bi-search"></i></button>

            </div>
          </div>
        </form>

        <div id="stdlist" class="table-responsive">

        </div>
      </div>
    </body>
    <footer>
      <?php include 'footer.php' ?>
    </footer>

    <script>
      datePickerId.max = new Date().toISOString().split("T")[0];
      $(document).ready(function() {

        $(document).on("change", '#class', function() {
          var x = $('#class').find("option:selected").val();
          if (x != '') {
            load_sub(x);

          }
        });

        $(document).on("click", '#findbtn', function() {
          var x = $('#class').find("option:selected").val();
          var y = $('#sub').find("option:selected").val();
          var dt1 = $('#datePickerId1').val();
          var dt2 = $('#datePickerId2').val();

          if (x != '') {
            // load_sub(x);
            load_atd_list(x, y, dt1,dt2);
          }
        });


        $(document).on("click", '#downloadatn', function() {
          var x = $('#class').find("option:selected").val();
          var y = $('#sub').find("option:selected").val();
          $.ajax({
            url: "../actions/attendence.php",
            method: "POST",
            data: {
              dltcourse: x,
              dltsub:y
            },
            success: function(data) {
     

            }

          });

        });
  

       $(document).on("click", '#deltbtn', function() {
        if(confirm("Are You Shure You Want to Delete Todays Attendance for this particular Subject")){
          $.ajax({
            url: "../actions/attendence.php",
            method: "POST",
            data: {
              downloadatn: null
            },
            success: function(data) {
              console.log(data)

            },
          
          });
        }

        });
      });

      function load_sub(x) {
        $.ajax({
          url: "../actions/attendence.php",
          method: "POST",
          data: {
            x1: x
          },
          success: function(data) {

            $('#sub').html(data);

          }
        });
      }

      function load_atd_list(a, b, c,d) {
        $.ajax({
          url: "../actions/attendence.php",
          method: "POST",
          data: {
            a1: a,
            b1: b,
            c1: c,
            d1:d
          },
          success: function(data) {

            $('#stdlist').html(data);

          }

        });
      }
    </script>

    </html>

<?php

} else {
  echo "<script>
            
alert('Access Denied');
window.location.href ='t_login.php';
</script>";
} ?>