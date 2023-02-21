<?php

require 'db_con.php';
include 'a_menu.php';
include '../Additional_Libraries.php';
if (!isset($_SESSION)) session_start();

if (isset($_GET['upbtn'])) {
    $search = mysqli_real_escape_string($conn, $_GET["ufid"]);
    $query = "
    SELECT * FROM faculty1 where id ='" . $search . "'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $id = $row['id'];
            $image_src = $row['f_pic'];
            $name = $row['f_title'] . " " . $row['f_name'];
            $role = $row['f_role'];
            $qual = $row['f_qualification'];
            $cno = $row['f_cno'];
            $mail = $row['f_mailid'];
            echo ('<!DOCTYPE html>
      <html lang="en">
      <head>
          <meta charset="UTF-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>Update Faculty Profile</title>
      </head>
      <body>
      <div class="mb-3 m" >
                <form action="../actions/update_faculty.php" method="POST" enctype="multipart/form-data">
                <h5 >Update Faculty Profile</h5>
                <hr>
                        <div class="row g-3">
                                <div class="col-md">
                                    <div class="form-floating mb-3 col-sm">
                                        <input type="text" class="form-control" id="fid" name="fid" placeholder="a" value="' . $id . '" required readonly>
                                        <label for="fid">Id</label>
                                    </div>
                                </div>
                                 <div class="col-md">
                                    <div class="form-floating mb-3 col-sm">
                                        <input type="text" class="form-control" id="ftitle" name="ftitle" placeholder="a" value="' . $row['f_title'] . '" required>
                                        <label for="ftitle">Title</label>
                                    </div>
                                </div>
                                <div class="col-md">
                                <div class="form-floating mb-3 ">
                                    <input type="text" class="form-control" id="ffname" name="ffname" placeholder="a" value="' . $row['f_name'] . '" required>
                                    <label for="ffname"> Name</label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating mb-3 ">
                                    <input type="text" class="form-control" id="fgen" name="fgen" placeholder="a" value="' . $row['f_sex'] . '" required>
                                    <label for="fgen">Gender</label>
                                </div>
                             </div>
                             </div>
                             <div class="row g-3">
                             <div class="col-md">
                                <div class="form-floating mb-3 ">
                                    <input type="text" class="form-control" id="frole" name="frole" placeholder="a" value="' . $row['f_role'] . '" required>
                                    <label for="frole">Role</label>
                                </div>
                             </div>
                             <div class="col-md">
                             <div class="form-floating mb-3 ">
                                 <input type="text" class="form-control" id="fqual" name="fqual" placeholder="a" value="' . $row['f_qualification'] . '" required>
                                 <label for="fqual">Qualification</label>
                             </div>
                          </div>
                          </div>
                          <div class="row g-3">
                          <div class="col-md">
                          <div class="form-floating mb-3 ">
                              <input type="text" class="form-control" id="fcno" name="fcno" placeholder="a" value="' . $row['f_cno'] . '" required>
                              <label for="fcno">Contact No</label>
                          </div>
                       </div>
                        <div class="col-md">
                       <div class="form-floating mb-3 ">
                           <input type="text" class="form-control" id="fmail" name="fmail" placeholder="a" value="' . $row['f_mailid'] . '" required>
                           <label for="fmail">Mamil ID</label>
                       </div>
                    </div>
                        </div>
                        <div class="row g-3">
                        <div class="col-md">
                        <div class="form-floating mb-3 ">
                            <input type="text" class="form-control" id="fdept" name="fdept" placeholder="a" value="' . $row['f_department'] . '" style="height:max-content" cols="1" required>
                            <label for="fdept">Department</label>
                        </div>
                    </div>
                            <div class="col-md">
                                <div class="form-floating mb-3 ">
                                    <input type="text" class="form-control" id="fadds" name="fadds" placeholder="a" value="' . $row['f_add'] . '" style="height:max-content" cols="1" required>
                                    <label for="fadds">Address</label>
                                </div>
                            </div>
                                <div class="col-md">
                         
                                    <input type="file" class="form-control" name="file" accept="image/gif, image/jpeg, image/png" id="src" aria-describedby="inputGroupFileAddon04" aria-label="Upload Photo of the Faculty" >
                              
                                    </div>
                                    <div class="col-md">
                                 
                                        <img id="target" src="../upload/facultys_profile_img/' .   $image_src . '" alt="proficle pic" style="width:200px; height: 200px; border-radius: 15px; border:1px solid" >

                                             </div>
                                        </div>
                        <div class=" mb-3">
                        <button type="submit" class="btn btn-outline-primary" name="upfac" id="upfac">Update &nbsp;<i class="fa fa-wrench" aria-hidden="true"></i></button>
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