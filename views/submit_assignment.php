<?php
if (!isset($_SESSION)) session_start();
if (isset($_SESSION['slogin'])) {
  require 'db_con.php';
  include_once '../Additional_Libraries.php';
?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/s_home.css">
    <link rel="stylesheet" href="../css/progressbar.css">
    <title>Submit Assignment</title>
    <?php require 'db_con.php';
    include 's_menu.php'; ?>
  </head>

  <body>
    <form action="../actions/assignments.php" method="POST" enctype="multipart/form-data">
      <div class="input-group mb-3" style="margin-top: 10px;">
        <input type="text" class="form-control" id="key" placeholder="Enter the Assignment Key" aria-label="Enter the Assignment Key" aria-describedby="button-addon2">
        <button class="btn btn-outline-primary" type="button" id="findbtn">Find <i class="bi bi-search"></i></button>
      </div>
      <div id="workarea">
      </div>

    </form>
  </body>
  <footer>
    <?php include 'footer.php' ?>
  </footer>

  <style>
    #workarea {
      display: block;
      flex-direction: column;
      justify-content: center;
      text-align: center;
      position: relative;
      align-items: baseline;
      width: 100%;
      padding: 10px;
      flex-wrap: wrap;

    }

    #qpr,
    #qpper {
      border-top: cadetblue 2px solid;
      min-height: 500px;
      height: auto;
      margin-bottom: 10px;
      width: 100%;
    }
  </style>


  <script>
    $(document).ready(function() {
      //get data from database through ajx call
      $(document).on("click", "#findbtn", function() {

        var x = $('#key').val();
        if (x != '') {
          load_sub(x);

        }

      });
    });

    function load_sub(x) {
      $.ajax({
        url: "../actions/assignments.php",
        method: "POST",
        data: {
          x1: x
        },
        success: function(data) {
          $('#workarea').html(data);
        }
      });
    }

  </script>

  </html>
<?php
} else {
  echo "<script>
        
    alert('Please Login First');
    window.location.href ='s_login.php';

    </script>";
} ?>