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
</head>
<style>
    #mybutton {
        position: fixed;
        bottom: 15px;
        right: 10px;
        z-index: 9999;
        transition: all ease-in .3s;
        display: flex;
        flex-direction: column;


    }

    #helpbtn:hover {
        transform: translateY(-10px);

    }

    #to-top:hover {
        transform: translateY(-10px);
    }

    #to-top {
        border: none;
        margin-bottom: 10px;
    }

    #helpbtn {
        border: none;

    }

    #Supportfrm {
        display: none;
        width: 50%;
        height: 50%;
        background-color: blueviolet;
        position: absolute;
        justify-content: center;
        text-align: center;
        z-index: 9999;
        margin: auto;
        top: 50%;
        left: 30%;
        animation: formFade .5s ease-in-out;

    }
    .closebtn{
       position: absolute;
       top: 3px;
       right: 3px; 
       font-size: 20px;
       border: none;
    font-size: 25px !important;
    text-decoration: none;
    color: aliceblue;
    }

    @keyframes formFade {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }
    
  @media  screen and (max-width: 1400px) and (min-width: 200px)  {
    #Supportfrm{
        height: 50%;
        width: 50%;
    }  
  }

</style>

<body>

    <?php
    ?>
    <div id="mybutton">
        <button class="btn btn-outline-info btn-lg" id="to-top"><i class="bi bi-arrow-up-circle"></i> Top</button>

        <button type="menu" class=" btn btn-outline-danger btn-lg" id="helpbtn" onclick="help();"><i class="bi bi-headset"></i>
            Help
        </button>
    </div>

    <div id="Supportfrm">
        <a href="javascript:void(0)" class="closebtn" onclick="togglediv()">&times;</a>

        <input type="text" name="" id="">
        <input type="submit" value="">
        <input type="search" name="" id="">
    </div>

</body>
<script>
    document.querySelector("#to-top").addEventListener("click", function() {

        $('body').scrollTop(0);

    });

function help(){
    window.location.href='help.php';
    
}

    function togglediv() {
        var x = document.getElementById("Supportfrm");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }
</script>

</html>