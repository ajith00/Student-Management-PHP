<?php
 if (!isset($_SESSION)) session_start();
if (isset($_SESSION['tlogin'])) {
  require 'db_con.php';
  include_once '../Additional_Libraries.php';
  include 't_menu.php';
 
  $res = mysqli_query($conn, "select * from faculty1 where id='" . $_SESSION['tid'] . "'");

  if (mysqli_num_rows($res) > 0) {
    $result = mysqli_fetch_array($res);
    if ($result['f_role'] == 'Associate Prof & HOD' || $result['f_role'] == 'Vice Principal & HOD') {
      $res1 = mysqli_query($conn, "SELECT * FROM `classes` WHERE createdby=" . $_SESSION['tid'] . "");
?>

      <!DOCTYPE html>
      <html lang="en">

      <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>View Classes</title>
      </head>

      <body>
        <?php
        if (mysqli_num_rows($res1) > 0) {
          $i = 1;
          while ($class = mysqli_fetch_assoc($res1)) {
     
        ?>
            <div class="accordion" id="accordionExample">

              <div class="card">
                <div class="card-header" id="heading<?php echo ($i); ?>">
                <div class="row">
              
                <div class="col">
                  <h2 class="mb-0">
                    <button class="btn btn-outline-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo ($i); ?>" aria-expanded="true" aria-controls="collapse<?php echo ($i); ?>">
                    <?php echo ($class['c_name']) ?>
                    </button>
                  </h2>
                </div>
                
                <div class="col">
                  <h2 class="mb-0">
                    <button class="btn btn-outline-danger" type="button" name="dltbtn"  id="dltbtn"   value="<?php echo($class['id']) ?>" aria-expanded="true">
                     Delete
                    </button>
                  </h2>
                </div>
                </div>
                </div>

                <div id="collapse<?php echo ($i); ?>" class="collapse" aria-labelledby="heading<?php echo ($i); ?>" data-parent="#accordionExample">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">                      
                        <h5 class="mb-0"> Subjects </h5><hr>
                        <label for=""><?php echo($class['sub1']) ?></label><br>
                        <label for=""><?php echo($class['sub2']) ?></label><br>
                        <label for=""><?php echo($class['sub3']) ?></label><br>
                        <label for=""><?php echo($class['sub4']) ?></label><br>
                        <label for=""><?php echo($class['sub5']) ?></label><br>
                        <label for=""><?php echo($class['sub6']) ?></label><br>
                        <label for=""><?php echo($class['sub7']) ?></label><br>
                        <label for=""><?php echo($class['sub8']) ?></label><br>
                      </div>
                      <div class="col">
                      <h5 class="mb-0"> Professors </h5><hr>
                        <label for=""><?php echo($class['prof1']) ?></label><br>
                        <label for=""><?php echo($class['prof2']) ?></label><br>
                        <label for=""><?php echo($class['prof3']) ?></label><br>
                        <label for=""><?php echo($class['prof4']) ?></label><br>
                        <label for=""><?php echo($class['prof5']) ?></label><br>
                        <label for=""><?php echo($class['prof6']) ?></label><br>
                        <label for=""><?php echo($class['prof7']) ?></label><br>
                        <label for=""><?php echo($class['prof8']) ?></label><br>
                      </div>
                      </div>
                  </div>
                </div>
              </div>

            </div>
        <?php
           $i++; 
          }
        
        } else {
          echo ("no data");
        }

        ?>
      </body>
      <footer>
    <?php include 'footer.php' ?>
 </footer>
      </html>
  <script>
    $(document).on("click","#dltbtn",function(e){
      e.preventDefault();
      var id=$(this).attr("value");
      if(confirm("Are You Shure You Want to Delete This data?")){
        $.ajax({
          url:"../actions/createclass.php",
          method:"POST",
          data:{
            dlid:id
          },
success:function(data){
$('#accordionExample').html(data);
}
        })
      }
    })
  </script>
<?php

    } else {
      echo "<script>
      alert('Please Login as HOD....!');
      window.location.href ='t_home.php'; 
      </script>";
    }
  }
} else {
  echo "<script>
            
            alert('Access Denied');
            window.location.href ='t_login.php';
            </script>";
}

?>