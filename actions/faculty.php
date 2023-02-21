<?php
require '../views/db_con.php';
include '../Additional_Libraries.php';
if (!isset($_SESSION)) session_start();

//load faculty data
$output = '';
if (isset($_POST["query"])) {
          $search = mysqli_real_escape_string($conn, $_POST["query"]);
          $query = "
          SELECT * FROM faculty1 
          WHERE f_name LIKE '%" . $search . "%'
          OR f_role LIKE '%" . $search . "%' 
          OR id LIKE '%" . $search . "%' 

        ";
        } else {
          $query = "
          SELECT * FROM faculty1
        ";
        }
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
                  $output .= '<div class="card" id="result">
                  <div class="flip-card-inner">
                  <div class="flip-card-front">
                                  <img src="../upload/facultys_profile_img/' .   $image_src . '" loading="lazy" alt="proficle pic" style="width:100%; height: 55%;border-top-left-radius: 15px;
                                  border-top-right-radius: 15px;">
                                  <h4>' . $name . '</h4>

                                  <p class="title">' . "(" . '' . $id . '' . ") " . '' . $role . '</p>
                                  <p><i class="bi bi-mortarboard-fill"></i>&nbsp;' . $qual . '</p>
                                  <p><i class="bi bi-phone-fill"></i>&nbsp;' . $cno . '</p>
                                  <p><i class="bi bi-envelope-fill"></i>&nbsp' . $mail . '</p>
                                  </div>
                                  <div class="flip-card-back">
                                  <a href="updatefaculty.php?ufid='.$id.'&upbtn="><button class="btn btn-outline-warning"><i class="bi bi-pencil-square"></i>&nbsp;&nbsp;Edit</button></a>
                                  <a href="../actions/update_faculty.php?fid='.$id.'&rbtn="><button class="btn btn-outline-danger"><i class="bi bi-trash"></i>&nbsp;&nbsp;Remove</button></a>

                                  </div>
                              </div>
                                </div>';
                }


                echo $output;
                $_POST=array();
                } else {
                  echo 'Data Not Found';
}





// add new faculty to database

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
           
            }
        
        }
    




//Remove the faculty from database

if (isset($_GET['rbtn'])) {

$search = mysqli_real_escape_string($conn, $_GET["fid"]);
$query = "DELETE FROM faculty1 WHERE id = '".$search."'";
$result = mysqli_query($conn, $query);
if ( $result) {

 $_SESSION['status']="Faculty removerd Sucessfully...!";
  $_SESSION['status_code']="success";
  header('Location: ../views/a_Facultys.php');  

/*echo('<script>
alert("Faculty removerd Sucessfully...!");

location.href="../views/a_Facultys.php";


</script>');*/
}else {
  $_SESSION['status']="Somthing Went Wrong unable to delete Try Again!";
  $_SESSION['status_code']="error";
  header('Location: ../views/a_Facultys.php');  
/*echo('<script>
alert("Somthing Went Wrong Try Again!");

location.href="../views/a_Facultys.php";


</script>');*/

}
}


