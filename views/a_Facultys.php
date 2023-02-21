<?php
if (!isset($_SESSION)) session_start();
include_once '../Additional_Libraries.php';
require 'db_con.php';
include_once '../views/support.php';
include 'a_menu.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facultys</title>
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
        height: 360px;
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
 
        }
        .tp>button {
            margin: 10px;
            font-size: 12px;
            margin-left: 5px;
            height: 40px;
        }

        .tp>#search_text {
            height: 50px;
            width: 200px !important;

        }

        .card {

            width: 250px;
            height: 400px;
        }
    }
</style>

<body>

    <div class="tp">
        <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#addfaculty"><i class="bi bi-person-plus-fill"></i>&nbsp;&nbsp;</i>Add Faculty</button>
        <!-- <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#editfaculty"><i class="fa fa-wrench" aria-hidden="true">&nbsp;&nbsp;</i>Update Faculty Profile</button>
        <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#deletefaculty"><i class="fa fa-user-times" aria-hidden="true">&nbsp;&nbsp;</i>Remove Faculty</button>-->
        <input class="form-control me-2" type="search" name="search_text" id="search_text" style="width: 400px;" placeholder="Search Ex:ID,Name,Mail-Id,Role" aria-label="Search">
    </div>
    <hr>
    <div id="result" class="m">

    </div>
    <div id="addfaculty" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-person-plus-fill"></i>&nbsp; Add New Faculty</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../actions/add_faculty.php" method="POST" enctype="multipart/form-data">
                        <div class="row g-3">
                            <div class="col-md">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="fdept" name="title" aria-label="Floating label select example" required>
                                        <option value="">--Select--</option>
                                        <option value="Dr">Dr</option>
                                        <option value="Sri">Sri</option>
                                        <option value="Smt">Smt</option>
                                        <option value="Mrs">Mrs</option>
                                    </select>
                                    <label for="fdept">Title</label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating mb-3 ">
                                    <input type="text" class="form-control" id="ffname" name="ffname" placeholder="a" required>
                                    <label for="ffname">First Name</label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating mb-3 ">
                                    <input type="text" class="form-control" id="flname" name="flname" placeholder="a" required>
                                    <label for="flname">Last Name</label>
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
                                    <select class="form-select" id="fdept" name="fdept" aria-label="Floating label select example" required>
                                        <option value="">--Select--</option>
                                        <option value="Arts">Arts</option>
                                        <option value="Commerce & Management">Commerce & Management </option>
                                        <option value="Science">Science</option>

                                    </select>
                                    <label for="fdept">Department</label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="frole" name="frole" aria-label="Floating label select example" required>
                                        <option value="">--Select--</option>
                                        <option value="Principal">Principal</option>
                                        <option value="Vice Principal & HOD">Vice Principal & HOD</option>
                                        <option value="Associate Prof & HOD">Associate Prof & HOD</option>
                                        <option value="Associate Prof">Associate Prof</option>
                                        <!--<option value="Placement Co-ordinator">Placement Co-ordinator</option>-->
                                    </select>
                                    <label for="frole">Role</label>
                                </div>
                            </div>

                        </div>
                        <div class="row g-3">
                            <div class="col-md">
                                <div class="form-floating mb-3 ">
                                    <input type="text" class="form-control" id="fqal" name="fqal" placeholder="a" required>
                                    <label for="fqal">Qualification</label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating mb-3 ">
                                    <input type="text" class="form-control" id="fcno" name="fcno" pattern="^\d{10}$" minlength="10" placeholder="a" required>
                                    <label for="fcno">Contact No&nbsp;<em>Only 10 digits</em></label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating mb-3 ">
                                    <input type="email" class="form-control" id="fmail" name="fmail" placeholder="a" required>
                                    <label for="fmail">E-Mail Id</label>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="file" class="form-control" name="file" accept="image/gif, image/jpeg, image/png" id="src" aria-describedby="inputGroupFileAddon04" aria-label="Upload Photo of the Faculty" required>

                        </div>
                        <div class=" mb-3" style=" position:absolute;left:65%">
                            <img id="target" width="100" height="100" alt="Faculty Picture" src="../img/maleicon.jpg" style=" border-radius: 10px;">

                        </div>
                        <div class=" mb-3">
                            <div class="col-md">
                                <div class="form-floating mb-3 ">
                                    <input type="text" class="form-control" id="fadd" name="fadd" placeholder="a" style="height:max-content; width:60%" required>
                                    <label for="fadd">Address</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-outline-primary" name="addfac" id="Submit">Add &nbsp;<i class="bi bi-plus" aria-hidden="true"></i></button>
                            <button type="reset" class="btn btn-outline-dark" data-bs-dismiss="modal">Cancle</button>
                        </div>


                </div>
                </form>

            </div>
        </div>
    </div>
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
    <div class="modal">
        <!-- Place at bottom of page -->
    </div>

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
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
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

        load_data();
        $('#search_text').keyup(function() {

            var search = $(this).val();

            if (search != '') {
                load_data(search);
            } else {
                load_data();
            }
        });

        function load_data(query) {
            $.ajax({
                url: "../actions/faculty.php",
                method: "POST",
                data: {
                    query: query
                },
                success: function(data) {
                    $('#result').html(data);
                }
            });
        }
        /*$('#updtn').click(function() { 
           
            var ufid=$('#ufid').val();
           
            if(ufid !=''){
                load_fdata(ufid);
            }else{
                alert('Invalid Factlty id');
            }
         });
        function load_fdata(query1){
            $.ajax({
                url:"../supportive_php/facultysearch.php",
                method:"POST",
                data:{
                    query1:query1
                },
                success: function(data){
                    $('#result1').html(data);
                }
            });
        }*/

    });
</script>

<footer>
    <?php include 'footer.php' ?>
</footer>

</html>