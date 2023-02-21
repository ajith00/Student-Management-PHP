<?php
if (!isset($_SESSION)) session_start();
include_once '../Additional_Libraries.php';
require 'db_con.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/menu.css">

    <title>Help</title>
</head>
<style>
    .m {
        width: 90%;
        height: 80%;
        text-align: center;
        justify-content: center;
        display: flex;
        flex-wrap: wrap;
        flex-direction: column;
        margin-left: auto;
    margin-right: auto;
    }
</style>
<?php $logourl = "../img/logo_1.png" ?>
<div id="menu" class="header main">
    <img src="<?php echo $logourl; ?> " width="200px" height="50px" style="margin: 5px;">

</div>

<!--mobile menu-->
<div id="main">
    <img src="<?php echo $logourl; ?> " width="200px" height="50px">
</div>
<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()" style="border: none;">&times;</a>

</div>



<script>
    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
        //document.getElementById("main").style.marginLeft = "250px";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
        document.getElementById("main").style.marginLeft = "0";
    }
</script>

<body>
    <div class="m">
        <form action="../actions/help.php" method="post" enctype="multipart/form-data">
        <h5>Help/Feedback</h5>
        <div class="row g-2">
            <div class="col-md">
                <div class="form-floating mb-3">
                    <input type="text" name="name" class="form-control" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">Your Name</label>
                </div>
            </div>
            <div class="col-md">
                <div class="form-floating mb-3">
                    <select class="form-select" name="type" id="floatingSelect" aria-label="Floating label select example">
                        <option selected>Select</option>
                        <option value="Feedback">Feedback</option>
                        <option value="Technical Support ">Technical Support </option>
                    </select>
                    <label for="floatingSelect">Type</label>
                </div>
            </div>
            <div class="form-floating mb-3">
                <textarea class="form-control" name="desc" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                <label for="floatingTextarea2">Describe in Detail </label>
            </div>
            <div class="col-md">
                <button type="button" class="btn btn-outline-primary">Submit</button>
                <button type="button" class="btn btn-outline-danger">Cancle</button>

            </div>
        </div>
    </div>
    </form>
</body>
<footer><?php include 'footer.php' ?> </footer>

</html>

<?php



?>