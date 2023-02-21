<?php
if (!isset($_SESSION)) session_start();
if (isset($_SESSION['tlogin'])) {
    require 'db_con.php';
    include_once '../Additional_Libraries.php';
    include 't_menu.php';
    include_once '../views/support.php';
    $res = mysqli_query($conn, "select * from faculty1 where id='" . $_SESSION['tid'] . "'");
    if (mysqli_num_rows($res) > 0) {
        $result = mysqli_fetch_array($res);

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
        <title>Create Assignment</title>
    </head>
    <style>
        #m {
            display: block;
            flex-direction: column;
            justify-content: center;
            text-align: center;
            position: relative;
            align-items: baseline;
            width: 100%;
            padding: 10px;
            flex-wrap: wrap;
            min-height: 300px;
         
        }
        #qpper{
      
        min-height: 500px;
        height: auto;
        margin-bottom: 10px;
         
        }

        @media screen and (max-width: 500px) and (min-width: 300px) {
            #m{
                display: block;
            }
        }
    </style>

    <body>
        <div id="m">
            <form action="../actions/assignments.php" method="POST"  enctype="multipart/form-data">
            <h5>Crete an Assignment</h5><hr>
            <div class="row">
                   <!-- <input type="hidden" class="form-control" id="floatingPassword" name="key" value=" <?php echo generateRandomString(); ?>">-->
                <div class="col-md mb-3" id="G1">
                <label for="class" class="form-label">Class</label>
            <select class="form-select" id="class" name="class" aria-label="Floating label select example" required>
              <option value="">--Select Class--</option>
              <?php echo $class_list; ?>
            </select>
                </div>
                <div class="mb-3 col">
                <label for="floatingInput" class="form-label">Name of the Assignment</label>

                    <input type="text" class="form-control" id="floatingInput" name="assignment_name" >
                </div>
        <div class="col mb-3">
            <label for="dtpicker" class="form-label">Last Date to submit</label>
            <input type="date" name="submit_date" id="dtpicker" class="form-control">
        </div>
        <div class="col mb-3">
        <label for="qp" class="form-label">Upload Assignment Questions</label>

        <input type="file" name="file" id="qp" accept="application/pdf" class="btn btn-outline-dark" required></input>

        </div>
        <iframe src="" frameborder="1" id="qpper" ></iframe>  
            </div>

          <!--  <div style="margin-bottom: 10px;" class=" mb-3">
                <textarea name="editor" id="editor" class="form-control" placeholder="Start Typing the Questions"></textarea>
            </div>-->
      

            <button type="submit" name="createassignment" class="btn btn-Success">Create</button>
            <button type="reset" class="btn btn-dark">Cancel</button>

            </form>
        </div>

    </body>
    <script src="../ckeditor5-build-classic/ckeditor.js"></script>
    <script>
        dtpicker.min=new Date().toISOString().split("T")[0];
        
        
        ClassicEditor
            .create(document.querySelector('#editor'), {})
            .then(editor => {
                window.editor = editor;
            })
            .catch(err => {
                console.error(err.stack);
            });



            var src = document.getElementById("qp");
    var target = document.getElementById("qpper");
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

    <footer>
        <?php include 'footer.php' ?>
    </footer>

    </html>
<?php
}} else {

    echo "<script>
                  
                  alert('Access Denied');
                  window.location.href ='t_login.php';
                  </script>";
}




?>