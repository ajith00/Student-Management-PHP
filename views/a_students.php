<?php
require 'db_con.php';
include_once '../Additional_Libraries.php';
if (!isset($_SESSION)) session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students</title>
</head>
<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type=number] {
        -moz-appearance: textfield;
    }

    * {
        margin: 0;
    }

    .card {
        box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;
        width: 200px;
        margin: 10px;
        text-align: center;
        font-family: arial;
        height: 350px;
        border-radius: 15px !important;
        transition: all 0.3s;
    }

    .card:hover {
        transform: translateY(-20px);
    }

    .card p {
        font-size: 13px;
        line-height: 0px;
    }

    .title {
        color: grey;
        font-size: 18px;
    }

    .m {
        width: 100%;
        height: max-content;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    .tp {
        display: flex;
        margin: 10px;
        padding: 5px;
        justify-content: space-evenly;
    }

    .card:hover .flip-card-inner {
        transform: rotateY(180deg);
    }

    .flip-card-inner {
        position: relative;
        width: 100%;
        height: 100%;
        text-align: center;
        transition: transform 0.6s;
        transform-style: preserve-3d;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        border-radius: 15px !important;

    }

    .flip-card-front,
    .flip-card-back {
        position: absolute;
        width: 100%;
        height: 100%;
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
        border-radius: 15px !important;

    }

    .flip-card-back {
        display: flex;
        flex-direction: column;
        justify-content: space-evenly;
        padding: 10px;
        transform: rotateY(180deg);
        background-color: #58aced;
    }

    .flip-card-front>p {


        word-wrap: break-word;
        line-height: 10px;
    }


    @media screen and (max-width: 500px) and (min-width: 300px) {
        .tp {
            display: inline-block;
            width: 100%;
        }

        .tp>button,
        #search_text {
            margin: 10px;
            font-size: 12px;
            margin-left: 5px;
            height: 40px;
        }
.tb>#search_text{
    width: 200px;
}

        .card {

            width: 250px;
            height: 400px;
        }
    }
</style>
<?php

include 'a_menu.php'; ?>

<body>

    <div class="tp ">

        <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#addfaculty"><i class="bi bi-person-plus-fill"></i>&nbsp;&nbsp;</i>Add Student</button>


        <!-- <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#editfaculty"><i class="fa fa-wrench" aria-hidden="true">&nbsp;&nbsp;</i>Update Faculty Profile</button>
        <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#deletefaculty"><i class="fa fa-user-times" aria-hidden="true">&nbsp;&nbsp;</i>Remove Faculty</button>-->


        <div class="form-floating mb-3">
            <select class="form-select" id="scource" name="scource" aria-label="Floating label select example" required>
                <option value="">--Select--</option>
                <option value="BA">BA</option>
                <option value="B.Com">B.Com</option>
                <option value="BBA">BBA</option>
                <option value="BCA">BCA</option>
                <option value="M.Com">M.Com</option>
            </select>
            <label for="scource">Course</label>
        </div>
        <div class="form-floating mb-3">
            <select class="form-select" id="ssem" name="ssem" aria-label="Floating label select example" required>
                <option value="">--Select--</option>
                <option value="1 Semester">1 Semester</option>
                <option value="2 Semester">2 Semester</option>
                <option value="3 Semester">3 Semester</option>
                <option value="4 Semester">4 Semester</option>
                <option value="5 Semester">5 Semester</option>
                <option value="6 Semester">6 Semester</option>
            </select>
            <label for="ssem">Semester</label>
        </div>



        <div>
            <input class="form-control me-2" type="search" name="search_text" id="search_text" style="width: 400px;" placeholder="Search Ex:ID,Name,Mail-Id" aria-label="Search">
            <label for=""></label>
        </div>
    </div>
    <hr>
    <div id="result" class="m">

    </div>
    <?php
    /* $sql = "SELECT * FROM `faculty`";
    if ($result = mysqli_query($conn, $sql)) {
        echo '<div class="m";>';
        while ($row = mysqli_fetch_array($result)) {
            $image_src = $row['f_pic'];
            $name = $row['f_title'] . " " . $row['f_name'];
            $role = $row['f_role'];
            $qual = $row['f_qualification'];
            $cno = $row['f_cno'];
            $mail = $row['f_mailid'];
            echo '<div class="card id="result">
    <img src="../upload/' .   $image_src . '" alt="proficle pic" style="width:100%; height: 55%;border-top-left-radius: 15px;
    border-top-right-radius: 15px;">
    <h4>' . $name . '</h4>
    <p class="title">' . $role . '</p>
    <p><i class="fa fa-graduation-cap" aria-hidden="true"></i>&nbsp;' . $qual . '</p>
    <p><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;' . $cno . '</p>
    <p><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp' . $mail . '</p>
 
  </div>';
        }
        echo '</div>';
        $result->free();
    }*/
    ?>
    <div id="addfaculty" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-person-plus-fill"></i>&nbsp; Add New Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../actions/students.php" method="POST" enctype="multipart/form-data">
                        <div class="row g-3">

                            <div class="col-md">
                                <div class="form-floating mb-3 ">
                                    <input type="text" class="form-control" id="sfname" name="sfname" placeholder="a" required>
                                    <label for="sfname">First Name</label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating mb-3 ">
                                    <input type="text" class="form-control" id="slname" name="slname" placeholder="a">
                                    <label for="slname">Last Name</label>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <p> Gender &nbsp;</p>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="inlineCheckbox1" name="gender" value="Male" required>
                                <label class="form-check-label" for="inlineCheckbox1">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="inlineCheckbox2" name="gender" value="Female" required>
                                <label class="form-check-label" for="inlineCheckbox2">Female</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="inlineCheckbox3" name="gender" value="Others" required>
                                <label class="form-check-label" for="inlineCheckbox3">Others</label>
                            </div>
                        </div>
                        <div class="row g-3">

                            <div class="col-md">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="cource" name="scource" aria-label="Floating label select example" required>
                                        <option value="">--Select--</option>
                                        <option value="BA">BA</option>
                                        <option value="B.Com">B.Com</option>
                                        <option value="BBA">BBA</option>
                                        <option value="BCA">BCA</option>
                                        <option value="M.Com">M.Com</option>
                                    </select>
                                    <label for="scource">Course</label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="sem" name="ssem" aria-label="Floating label select example" required>
                                        <option value="">--Select--</option>
                                        <option value="1 Semester">1 Semester</option>
                                        <option value="2 Semester">2 Semester</option>
                                        <option value="3 Semester">3 Semester</option>
                                        <option value="4 Semester">4 Semester</option>
                                        <option value="5 Semester">5 Semester</option>
                                        <option value="6 Semester">6 Semester</option>

                                    </select>
                                    <label for="ssem">Semester</label>
                                </div>
                            </div>

                        </div>
                        <div class="row g-3">

                            <div class="col-md">
                                <div class="form-floating mb-3 ">
                                    <input type="text" class="form-control" id="scno" name="scno" pattern="^\d{10}$" minlength="10" placeholder="a" required>
                                    <label for="scno">Contact No &nbsp;<em>Only 10 digits</em></label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating mb-3 ">
                                    <input type="email" class="form-control" id="smail" name="smail" placeholder="a" required>
                                    <label for="smail">E-Mail Id</label>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="file" class="form-control" name="file" accept="image/gif, image/jpeg, image/png" id="src" aria-describedby="inputGroupFileAddon04" aria-label="Upload Photo of the Faculty" onchange="OnFileValidation()" required>

                        </div>
                        <div class=" mb-3" style=" position:absolute;left:65%">
                            <img id="target" width="100" height="100" alt="Faculty Picture" src="../img/maleicon.jpg" style=" border-radius: 10px;">

                        </div>
                        <div class=" mb-3">
                            <div class="col-md">
                                <div class="form-floating mb-3 ">
                                    <input type="text" class="form-control" id="sadd" name="sadd" placeholder="a" style="height:max-content; width:60%" required>
                                    <label for="fadd">Address</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-outline-primary" name="addstudent" id="Submit">Add &nbsp;<i class="bi bi-plus" aria-hidden="true"></i></button>
                            <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Cancle</button>
                        </div>


                </div>
                </form>

            </div>
        </div>
    </div>
    </div>
    <div class="modal">
        <!-- Place at bottom of page -->
    </div>


    <!--<div class="modal fade" id="editfaculty" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
 <form action="updatefaculty.php" method="get">   
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Update Faculty Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                             <div class="col-md">
                        <div class="form-floating mb-3 ">
                            <input type="text" class="form-control" id="ufid" name="ufid" placeholder="a" required>
                            <label for="ufid">Faculty Id</label>
                        </div>
                    </div>
                </div>
               
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="upbtn" id="updtn">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancle </button>

                </div>
                 <div id="result1">

                </div>
            </div>
        </div>
        </form>
    </div>-->

    <!--<div class="modal fade" id="deletefaculty" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
       <form action="../actions/removefaculty.php" method="POST" enctype="multipart/form-datas">
           <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Remove Faculty</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-md">
                        <div class="form-floating mb-3 ">
                            <input type="text" class="form-control" id="fid" name="fid" placeholder="a" required>
                            <label for="fid">Faculty Id</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="rbtn" id="rbtn" class="btn btn-primary">Remove</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancle</button>

                </div>
            </div>
        </div>
        </form>
 
</div>-->
</body>


<script>
 

    $("#addfaculty").click(function() {

        $("#myModal1").modal("show");
    });


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

    function OnFileValidation() {
        var image = document.getElementById("target");

        var size = parseFloat(image.files[0].size / (1024 * 1024)).toFixed(2);
        if (size > 2) {
            alert('Please select image size less than 2 MB');
        } else {
            alert('success');
        }
    }
</script>

<script>
    $body = $("body");

    $(document).on({
        ajaxStart: function() {
            $body.addClass("loading");
        },
        ajaxStop: function() {
            $body.removeClass("loading");
        }
    });
    $(document).ready(function() {
        var x
        var y
        load_data();

        $('#search_text').keyup(function() {
            var search = $(this).val();
            if (search != '') {
                load_data(search);
            } else {
                load_data();
            }
        });

        $(document).on("change", "#scource", function() {
            var y = $(this).find("option:selected").val();
            load_data(y);


        });

        $(document).on("change", "#ssem", function() {
            var x = $('#scource').find("option:selected").val();
            var y = $('#ssem').find("option:selected").val();

            if (x != '' && y != null) {

                load_data2(x, y);
            } else {
                // load_data1();
                alert('Plese Choose the department ')
            }

        });

        /*  function load_data(query) {
              $.ajax({
                  url: "../actions/students.php",
                  method: "POST",
                  data: {
                      query: query
                  },
                  success: function(data) {
                      $('#result').html(data);
                  }
              });
          }*/


        function load_data(query) {
            $.ajax({
                url: "../actions/students.php",
                method: "POST",
                data: {
                    query: query

                },
                success: function(data) {
                    $('#result').html(data);
                }
            });
        }

        function load_data2(x, y) {
            $.ajax({
                url: "../actions/students.php",
                method: "POST",
                data: {
                    x1: x,
                    y1: y

                },
                success: function(data) {
                    $('#result').html(data);
                }
            });
        }



    });
</script>

<footer>
    <?php include 'footer.php' ?>
</footer>

</html>