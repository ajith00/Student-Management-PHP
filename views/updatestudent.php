<?php
/*session_start();
if (isset($_SESSION['ffid'])){
    $fid=$_SESSION['ffid'];
    echo($fid);
}
else {
  echo('fid not found');   
  echo($_GET['ufid']);
}*/
require 'db_con.php';
include 'a_menu.php';
include '../Additional_Libraries.php';
if (!isset($_SESSION)) session_start();
if (isset($_GET['upbtn'])) {
    $search = mysqli_real_escape_string($conn, $_GET["sid"]);
    $query = "
    SELECT * FROM student where id like '%" . $search . "%'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
           // $id = $row['id'];
            $image_src = $row['s_pic'];
           // $name = $row['f_title'] . " " . $row['f_name'];
           // $role = $row['f_role'];
           // $qual = $row['f_qualification'];
           // $cno = $row['f_cno'];
           // $mail = $row['f_mailid'];
            echo ('<!DOCTYPE html>
      <html lang="en">
      <head>
          <meta charset="UTF-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>Update Student Profile</title>
      </head>
      <body>
      <div class="mb-3 m" >
                <form action="../actions/update_student.php" method="POST" enctype="multipart/form-data">
                <h5 >Update Student Profile</h5>
                <hr>
                        <div class="row g-3">
                                <div class="col-md">
                                    <div class="form-floating mb-3 col-sm">
                                        <input type="text" class="form-control" id="sid" name="sid" placeholder="a" value="' . $row['id'] . '" required readonly>
                                        <label for="fid">Id</label>
                                    </div>
                                </div>
                                 
                                <div class="col-md">
                                <div class="form-floating mb-3 ">
                                    <input type="text" class="form-control" id="sname" name="sname" placeholder="a" value="' . $row['s_name'] . '" required>
                                    <label for="ffname"> Name</label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating mb-3 ">
                                    <input type="text" class="form-control" id="sgen" name="sgen" placeholder="a" value="' . $row['s_sex'] . '" required>
                                    <label for="fgen">Gender</label>
                                </div>
                             </div>
                             </div>
                             <div class="row g-3">
                             <div class="col-md">
                             <div class="form-floating mb-3 ">
                                 <input type="text" class="form-control" id="scourse" name="scourse" placeholder="a" value="' . $row['s_course'] . '" required>
                                 <label for="frole">Couese</label>
                             </div>
                          </div>
                             <div class="col-md">
                                <div class="form-floating mb-3 ">
                                    <input type="text" class="form-control" id="ssem" name="ssem" placeholder="a" value="' . $row['s_sem'] . '" required>
                                    <label for="frole">Semester</label>
                                </div>
                             </div>
                            
                          </div>
                          <div class="row g-3">
                          <div class="col-md">
                          <div class="form-floating mb-3 ">
                              <input type="text" class="form-control" id="scno" name="scno" placeholder="a" value="' . $row['s_cno'] . '" required>
                              <label for="fcno">Contact No</label>
                          </div>
                       </div>
                        <div class="col-md">
                       <div class="form-floating mb-3 ">
                           <input type="text" class="form-control" id="smail" name="smail" placeholder="a" value="' . $row['s_mailid'] . '" required>
                           <label for="fmail">Mamil ID</label>
                       </div>
                    </div>
                        </div>
                        <div class="row g-3">
                        
                            <div class="col-md">
                                <div class="form-floating mb-3 ">
                                    <input type="text" class="form-control" id="sadds" name="sadds" placeholder="a" value="' . $row['s_add'] . '" style="height:max-content" cols="1" required>
                                    <label for="fadds">Address</label>
                                </div>
                            </div>
                                <div class="col-md">
                         
                                    <input type="file" class="form-control" name="file" accept="image/gif, image/jpeg, image/png" id="src" aria-describedby="inputGroupFileAddon04" aria-label="Upload Photo of the Student" >
                              
                                    </div>
                                    <div class="col-md">
                                 
                                        <img id="target" src="../upload/students_profile_img/' .   $image_src . '" alt="proficle pic" style="width:200px; height: 200px; border-radius: 15px; border:1px solid" >

                                             </div>
                                        </div>
                        <div class=" mb-3">
                        <button type="submit" class="btn btn-outline-primary" name="upstdu" id="Submit">Update &nbsp;<i class="fa fa-wrench" aria-hidden="true"></i></button>
                        <button type="submit" class="btn btn-outline-secondary" name="resetpwsd">Reset the Password&nbsp;<i class="bi bi-arrow-clockwise"></i></button>
                    </div>
              </form>
        </div>
      </body>
      </html>');
        }
    } else {
        echo 'Data Not Found';
    }
}
?>
<script>
                     var src = document.getElementById("src");
    var target = document.getElementById("target");
    showImage(src, target);

    function showImage(src, target) {
        var fr = new FileReader();
        // when image is loaded, set the src of the image where you want to display it
        fr.onload = function(e) {
            target.src = this.result;
        };
        src.addEventListener("change", function() {
            // fill fr with image data    
            fr.readAsDataURL(src.files[0]);
        });
    }
                </script>
<style>
    .m {
        width: 80%;
        height: max-content;
        padding: 10px;
        margin: 10px auto;
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        text-align: center;
        border-radius: 15px;
        overflow: auto;
    }
</style>
<footer>
    <?php include 'footer.php' ?>
</footer>