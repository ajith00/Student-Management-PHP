<?php
if (!isset($_SESSION)) session_start();

if (isset($_SESSION['slogin'])) {
  require 'db_con.php';
  include_once '../Additional_Libraries.php';
  $res = mysqli_query($conn, "select * from student where id='" . $_SESSION['sid'] . "'");
  if (mysqli_num_rows($res) > 0) {
    $result = mysqli_fetch_array($res);
    $cpanal = mysqli_query($conn, "select * from access_control where id='1'");
    $c_panal = mysqli_fetch_array($cpanal);
    if($c_panal['ia_student']=="1"){
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View IA Marks</title>
    <?php require 'db_con.php';
    include 's_menu.php'; ?>
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

      #G1>select {
        width: 300px !important;
      }

      #stdlist>input {
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

        #myTable {
          font-size: 12px;
          width: 90%;
        }

        #stdlist>input {
          width: 100px !important;
        }


      }
    </style>



    <?php



    $sql = "select * from ia_marks where dept='" . $result['s_course'] . "' and sem='" . $result['s_sem'] . "' and s_id='" . $_SESSION['sid'] . "'";

    $rows = mysqli_query($conn, $sql);
    echo ('  
  <div class="table-responsive">
  <table class="table table-hover table-striped " id="myTable">
  <thead class="table-dark">
  <tr><td colspan="5">' . $result['s_name'] . '  (' . $result['s_course'] . '/' . $result['s_sem'] . ') IA Marks</td></tr>

  <tr>
  <th class="text-center"> Sl.No </th>

  <th class="text-center"> Subject </th>

  <th class="text-center"> Max Marks  </th>
  <th class="text-center"> Attendence  </th>
  <th class="text-center"> Assignment Marks  </th>
    <th class="text-center"> Test Marks  </th>
  <th class="text-center">Secured Marks  </th>
  </tr>
    <tbody>
    
    ');
    if (mysqli_num_rows($rows) > 0) {
      $i = 1;
      $j = 0;

      while ($s = mysqli_fetch_array($rows)) {
        echo ("<div>");

        echo (" <tr>");
        echo (' <td>' . $i . '<input type="hidden" name="count" value=' . $i . '></td>');
        echo (' <td><input type="text" name="textmarks[]" class="form-control" id="" value="' . $s['subject'] . '" placeholder="Subject Name" readonly></td>');
        echo (' <td><input type="text" name="maxmark[]" class="form-control" id=""   value="' . $s['max_mark'] . '" placeholder="Max Marks" readonly></td>');
        echo (' <td><input type="text" name="maxmark[]" class="form-control" id=""   value="' . $s['attendence'] . '" placeholder="Max Marks" readonly></td>');
        echo (' <td><input type="text" name="maxmark[]" class="form-control" id=""   value="' . $s['assignment'] . '" placeholder="Max Marks" readonly></td>');
        echo (' <td><input type="text" name="maxmark[]" class="form-control" id=""   value="' . $s['test_mark'] . '" placeholder="Max Marks" readonly></td>');

        echo (' <td><input type="text" name="secmark[]" class="form-control"         value="' . $s['ia_mark'] . '" placeholder="Secured Marks" readonly></td>');

        echo (" </tr>");
        echo ("</div>");
        $i++;
        $j++;
      }
      echo (" </tbody>");
      echo ('</table>');
      echo ('</div>');
      // echo ('<button type="button"  name="downloadia" class="btn btn-outline-primary">  <a href="../actions/downloadattendence.php?a1=' . $cource . '&b1='.$sub.'&downloadia="> Download &nbsp;<i class="bi bi-download"></i></button>');
    } else {
      echo ("<tr><td colspan='5'>No data Found</td></tr>");
    }

    ?>

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

        }
      });

      $(document).on("click", '#findbtn', function() {
        var x = $('#class').find("option:selected").val();
        var y = $('#sub').find("option:selected").val();

        if (x != '') {
          // load_sub(x);
          load_Ia_list(x, y);
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

    function load_Ia_list(a, b) {
      $.ajax({
        url: "../actions/ia_marks.php",
        method: "POST",
        data: {
          a1: a,
          b1: b,

        },
        success: function(data) {

          $('#stdlist').html(data);

        }

      });
    }
  </script>

  </html>

<?php
    }else{
      echo "<script>
        
      alert('IA Marks is Desabled By College.....!Contact Admin');
      window.location.href ='s_home.php';
   
      </script>";
    }

} }else {
  echo "<script>
        
  alert('Plese Login First');
  window.location.href ='s_login.php';

  </script>";
} ?>