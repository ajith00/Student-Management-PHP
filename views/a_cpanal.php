<?php
if (!isset($_SESSION)) session_start();
include_once '../Additional_Libraries.php';
require 'db_con.php';
include 'a_menu.php';


$res = mysqli_query($conn, 'select * from access_control');
if (mysqli_num_rows($res) > 0) {
    $control = mysqli_fetch_array($res);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>C-Panal</title>
</head>
<style>
    .main-bord {
        display: flex;
        justify-content: center;
        padding: 5px;
        flex-wrap: wrap;
        height: auto;
    }

    .bord {
        padding: 10px;
        box-shadow: rgba(50, 50, 93, 0.25) 0px 30px 60px -12px inset, rgba(0, 0, 0, 0.3) 0px 18px 36px -18px inset;
        margin: 4px;
        border-radius: 10px;
        height: max-content;
        transition: all ease-in 0.2s;
    }

    .bord:hover {
        transform: translateY(-10px);
    }

    .main-bord>.lbl {
        font-size: 30px;
        font-weight: bold;
    }

    button {
        position: relative;
        left: 45%;
    }

    @media screen and (max-width: 500px) and (min-width: 300px) {

        #sem,
        #dept {
            display: flex;
            flex-wrap: wrap;
            flex-direction: column;
        }

        #sem>label,
        #dept>label {
            margin: 5px;
        }

        #dept>label {
            width: 100px;
        }
    }


</style>

<body>
    <form action="../actions/a_cpanal.php" method="post" enctype="multipart/form-data">
        <div class="main-bord">
            <div class="bord">
                <label class="lbl" for="">IA Marks</label>
                <hr>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="ia_teacher" onclick='handleClick(this);' value="0" <?php if ($control['ia_teacher'] == '1') {
                                                                                                                                                                echo ('checked');
                                                                                                                                                            } ?>>
                    <label class="form-check-label" for="flexSwitchCheckChecked">Enable IA For Faculty</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="ia_student" onclick='handleClick(this);' value="0" <?php if ($control['ia_student'] == '1') {
                                                                                                                                                                echo ('checked');
                                                                                                                                                            } ?>>
                    <label class="form-check-label" for="flexSwitchCheckChecked">Visible IA for Students</label>
                </div>
            </div>
            <div class="bord">
                <label class="lbl" for="">Attendence</label>
                <hr>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="aten_for_tech" onclick='handleClick(this);' value="0" <?php if ($control['aten_for_tech'] == '1') {
                                                                                                                                                                echo ('checked');
                                                                                                                                                            } ?>>
                    <label class="form-check-label" for="flexSwitchCheckChecked">Enable Attendence For Faculty</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="aten_for_student" onclick='handleClick(this);' value="0" <?php if ($control['aten_for_student'] == '1') {
                                                                                                                                                                    echo ('checked');
                                                                                                                                                                } ?>>
                    <label class="form-check-label" for="flexSwitchCheckChecked">Visible Attendence for Students</label>
                </div>
            </div>
        </div>
        <button type="submit" name="accbtn" class="btn btn-outline-success">Save</button>
    </form>
    <hr>
    <form action="../actions/a_cpanal.php" method="POST" enctype="multipart/form-data">
        <div class="main-bord">
            <div class="bord">
                <label class="lbl" for="">Select the Department</label>
                <hr>
                <div class="btn-group" id="dept" role="group" aria-label="Basic radio toggle button group">
                    <input type="radio" class="btn-check" name="1" value="BA" id="btnradio1" autocomplete="off" required checked>
                    <label class="btn btn-outline-primary" for="btnradio1">BA</label>

                    <input type="radio" class="btn-check" name="1" value="B.Com" id="btnradio2" required autocomplete="off">
                    <label class="btn btn-outline-primary" for="btnradio2">B.Com</label>

                    <input type="radio" class="btn-check" name="1" value="BBA" id="btnradio3" required autocomplete="off">
                    <label class="btn btn-outline-primary" for="btnradio3">BBA</label>

                    <input type="radio" class="btn-check" name="1" value="BCA" id="btnradio4" autocomplete="off">
                    <label class="btn btn-outline-primary" for="btnradio4">BCA</label>

                    <input type="radio" class="btn-check" name="1" value="M.Com" id="btnradio5" autocomplete="off">
                    <label class="btn btn-outline-primary" for="btnradio5">M.Com</label>
                </div>
            </div>
            <div class="bord">
                <label class="lbl" for="">Select From & To Semester Accordingly</label>
                <hr>


                <div class="col-md">
                    <div class="form-floating mb-3">
                        <select class="form-select" id="fsem" name="fsem" aria-label="Floating label select example" required>
                            <option value="">--Select--</option>
                            <option value="1 Semester" selected>1 Semester</option>
                            <option value="2 Semester">2 Semester</option>
                            <option value="3 Semester">3 Semester</option>
                            <option value="4 Semester">4 Semester</option>
                            <option value="5 Semester">5 Semester</option>
                            <option value="6 Semester">6 Semester</option>

                        </select>
                        <label for="ssem">Select Present Semester</label>
                    </div>

                </div>
                <div class="col-md">
                    <div class="form-floating mb-3">
                        <select class="form-select" id="tsem" name="tsem" aria-label="Floating label select example" required>
                            <option value="">--Select--</option>
                            <option value="1 Semester">1 Semester</option>
                            <option value="2 Semester" selected>2 Semester</option>
                            <option value="3 Semester">3 Semester</option>
                            <option value="4 Semester">4 Semester</option>
                            <option value="5 Semester">5 Semester</option>
                            <option value="6 Semester">6 Semester</option>

                        </select>
                        <label for="ssem">Select Next Semester</label>
                    </div>
                </div>
            </div>

        </div>        <button type="submit" name="upbtn" class="btn btn-outline-success">Save</button>

    </form>

</body>

<script>
    window.onload = xyz()

    function xyz() {
        var box = document.querySelectorAll('.form-check-input');
        for (i = 0; i < box.length; i++) {
            if (box[i].checked) {
                box[i].value = '1';
            } else {
                box[i].value = '0';
            }
        }

    }

    function handleClick(cb) {
        if (cb.checked) {
            cb.value = '1';
        } else {
            cb.value = '0';
        }
    }
</script>

<footer>
    <?php include 'footer.php' ?>
</footer>

</html>