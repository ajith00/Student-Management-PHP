<?php
if (!isset($_SESSION)) session_start();
if (isset($_SESSION['tlogin'])) {
  require 'db_con.php';
  include_once '../Additional_Libraries.php';



  $res = mysqli_query($conn, "select * from faculty1 where id='" . $_SESSION['tid'] . "'");
  if (mysqli_num_rows($res) > 0) {
    $result = mysqli_fetch_array($res);
  
  $cpanal = mysqli_query($conn, "select * from access_control where id='1'");
  $c_panal = mysqli_fetch_array($cpanal);
  if($c_panal['ia_teacher']=="1"){

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
    <title>IA_Marks</title>
    <?php require 'db_con.php';
    include 't_menu.php'; ?>
  </head>

  <body>
    <style>
      tr,
      td {
        text-align: center;
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
        width: 100px !important;
      }

      table>input {
        width: 100px !important;

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

        table>input {
          width: 100px !important;

        }

        #myTable {
          font-size: 12px;
          width: 90%;
        }


      }
    </style>
    <div class="addaten">
      <form method="POST" action="../actions/ia_marks.php" enctype="multipart/form-data">
        <div class="row g-3">
          <div class="col-md" id="G1">
            <select class="form-select" id="class" name="class" aria-label="Floating label select example" required>
              <option value="">--Select--</option>
              <?php echo $class_list; ?>
            </select>

            <select class="form-select" id="sub" name="sub" aria-label="Floating label select example" required>
              <option value="">--Select--</option>
            </select>
            <input type="text" name="maxmark" class="form-control" pattern="^\d{2}$" minlength="2" required placeholder="Max Marks">
          </div>
        </div>


        <div id="stdlist" class="table-responsive">

        </div>
      </form>
    </div>
  </body>
  <footer>
    <?php include 'footer.php' ?>
  </footer>

  <script>
    $(document).ready(function() {
      $(document).on("change", '#class', function() {
        var x = $('#class').find("option:selected").val();
        if (x != '') {
          load_sub(x);
          load_iamarks_list(x);
        }
      });

      $(document).on("change", '#sub', function() {
        var x = $('#class').find("option:selected").val();
        var y = $('#sub').find("option:selected").val();
        if (x != '') {
          duplicatecheck(x, y);
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

    function load_iamarks_list(a) {
      $.ajax({
        url: "../actions/ia_marks.php",
        method: "POST",
        data: {
          y1: a
        },
        success: function(data) {

          $('#stdlist').html(data);

        }

      });
    }

    function duplicatecheck(x, y) {
      $.ajax({
        url: "../actions/ia_marks.php",
        method: "POST",
        data: {
          p1: x,
          q1: y
        },
        success: function(data) {

          $("#stdlist").append(data);
        }
      });
    }
  </script>

  </html>

<?php
  
  }else{
    echo "<script>
        
    alert('IA Marks is Desabled By College.....!Contact Admin');
    window.location.href ='t_home.php';

    </script>";
  }
  }
} else {
  echo "<script>
        
  alert('Plese Login First');
  window.location.href ='t_login.php';

  </script>";

} ?>