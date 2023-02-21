<?php 

require '../views/db_con.php';
include '../Additional_Libraries.php';
if (!isset($_SESSION)) session_start();


if (isset($_POST['addfac'])) {
    $ftitle=$_POST['title'];
    $fname=$_POST['ffname']." ".$_POST['flname'];
    $fsex=$_POST['gender'];
    $fdept=$_POST['fdept'];
    $froel=$_POST['frole'];
    $fqal=$_POST['fqal'];
    $fcno=$_POST['fcno'];
    $fmail=$_POST['fmail'];
    $fadd=$_POST['fadd'];
    $name = $_FILES['file']['name'];
    $target_dir = "../upload/facultys_profile_img/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $pwsd=(substr($fmail,0,5).substr($fcno,0,5));
    $hash = password_hash($pwsd,PASSWORD_DEFAULT);
    // Select file type
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Valid file extensions
    $extensions_arr = array("jpg", "jpeg", "png", "gif");

    // Check extension
    if (in_array($imageFileType, $extensions_arr)) {
        // Upload file
        if (move_uploaded_file($_FILES['file']['tmp_name'], $target_dir.$name)) {
            // Convert to base64 
            //$image_base64 = base64_encode(file_get_contents('../upload/facultys_profile_img/' . $name));
           // $image = 'data:image/' . $imageFileType . ';base64,' . $image_base64;
            // Insert record
           // $query = "insert into images(image) values('" . $image . "')";
        }}


           $query = "INSERT INTO faculty1 (`f_title`, `f_name`,`f_sex`, `f_department`, `f_role`, `f_qualification`, `f_cno`, `f_mailid`, `f_pic`,`f_add`,`pwsd`,`summa`) 
           VALUES ('".$ftitle."', '".$fname."','".$fsex."', '".$fdept."', '".$froel."', '".$fqal."', '".$fcno."', '".$fmail."','" . $name . "','".$fadd."','".$hash."','".$pwsd."')";
          $result=  mysqli_query($conn, $query);
           // echo("Records Inserted ..."."\n");
           if ($result) {
           $_SESSION['status']="Faculty Added Sucessfully...!";
            $_SESSION['status_code']="success";
            header('Location: ../views/a_Facultys.php');  
            $_POST=array();
         exit();
           /* echo('<script>
            alert("Faculty Added Sucessfully...!");
            function sayHi() {
                location.href="../views/a_Facultys.php";
              }
              
              setTimeout(sayHi, 1000);
            
            </script>');
            unset($_POST);*/
            }else {
               /* echo('<script>
                alert("Somthing Went Wrong Try Again!");
                function sayHi() {
                    location.href="../views/a_Facultys.php";
                  }
                  
                  setTimeout(sayHi, 1000);
                
                </script>');
                unset($_POST);*/
               $_SESSION['status']="Somthing Went Wrong unable to add Try Again!";
                $_SESSION['status_code']="error";  
               header('Location: ../views/a_Facultys.php');  
               $_POST=array();
           exit();
            }
        
        }
    



?>