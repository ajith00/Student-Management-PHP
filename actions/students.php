<?php
require '../views/db_con.php';
include '../Additional_Libraries.php';
if (!isset($_SESSION)) session_start();

// add new student to database
if (isset($_POST['addstudent'])) {
  $sname = $_POST['sfname'] . " " . $_POST['slname'];
  $ssex = $_POST['gender'];
  $scource = $_POST['scource'];
  $ssem = $_POST['ssem'];
  $scno = $_POST['scno'];
  $smail = $_POST['smail'];
  $sadd = $_POST['sadd'];
  $name = $_FILES['file']['name'];
  $target_dir = "../upload/students_profile_img/";
  $target_file = $target_dir . basename($_FILES["file"]["name"]);
  $pwsd=(substr($smail,0,5).substr($scno,0,5));
  $hash = password_hash($pwsd,PASSWORD_DEFAULT);
  
  // Select file type
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

  // Valid file extensions
  $extensions_arr = array("jpg", "jpeg", "png", "gif");

  // Check extension
  if (in_array($imageFileType, $extensions_arr)) {
    // Upload file
    if (move_uploaded_file($_FILES['file']['tmp_name'], $target_dir . $name)) {
      // Convert to base64 
      // $image_base64 = base64_encode(file_get_contents('../upload/' . $name));
      // $image = 'data:image/' . $imageFileType . ';base64,' . $image_base64;
      // Insert record
      // $query = "insert into images(image) values('" . $image . "')";
      $query = "INSERT INTO student ( `s_name`, `s_sex`,`s_course`, `s_sem`, `s_cno`, `s_mailid`, `s_add`, `s_pic`,`pwsd`,`summa`) 
              VALUES ( '" . $sname . "','" . $ssex . "',  '" . $scource . "', '" . $ssem . "', " . $scno . ", '" . $smail . "','" . $sadd . "','" . $name . "','".$hash."','".$pwsd."')";
  
      $result =  mysqli_query($conn, $query);
      // echo("Records Inserted ..."."\n");
      if ($result) {
        $_SESSION['status']="Student Added Sucessfully...!";
        $_SESSION['status_code']="success";
        header('Location: ../views/a_students.php');
        exit();

       /* echo ('<script>
               alert("Student Added Sucessfully...!");
              /* function sayHi() {
                   location.href="../views/a_students.php";
                 }
                 
                 setTimeout(sayHi, 1000);
               
               </script>');*/
      } else {

        /*echo ('<script>
                   alert("Somthing Went Wrong Try Again!");
                   function sayHi() {
                       location.href="../views/a_students.php";
                     }
                     
                     setTimeout(sayHi, 1000);
                   
                   </script>');*/
                   $_SESSION['status']="Somthing Went Wrong Try Again...!";
                   $_SESSION['status_code']="error";
                  header('Location: ../views/a_students.php');  
        exit();


      }
    }
  }
}


// Remove student from database
if (isset($_GET['rbtn'])) {

  $search = mysqli_real_escape_string($conn, $_GET["sid"]);
  $query = "DELETE FROM student WHERE id = '" . $search . "'";
  $result = mysqli_query($conn, $query);
  if ($result) {

    $_SESSION['status']="Student removerd Sucessfully...!";
     $_SESSION['status_code']="success";
    header('Location: ../views/a_students.php');  


   /* echo ('<script>
      alert("Faculty removerd Sucessfully...!");
      location.href="../views/a_Facultys.php";
      </script>');*/
  } else { {
     /* echo ('<script>
      alert("Somthing Went Wrong Try Again!");
        location.href="../views/a_Facultys.php";
      </script>');*/
      $_SESSION['status']="Somthing Went Wrong Try Again...!";
      $_SESSION['status_code']="error";
     header('Location: ../views/a_students.php');  
    }
  }
}
?>






<!--Load & search the Students records-->
<?php
$output = '';
if (isset($_POST["x1"])) {

  $search1 = mysqli_real_escape_string($conn, $_POST["x1"]);

  $search2 = mysqli_real_escape_string($conn, $_POST["y1"]);

  $query = "
      SELECT * FROM student 
      WHERE
       s_course = '" . $search1 . "' 
    
      and s_sem LIKE '" . $search2 . "' 
    ";
} 
else if (isset($_POST["query"])) {
  $search = mysqli_real_escape_string($conn, $_POST["query"]);
  $query = "
            SELECT * FROM student 
            WHERE s_name LIKE '%" . $search . "%'
            OR s_mailid LIKE '%" . $search . "%' 
            OR id LIKE '%" . $search . "%' ";
} else {
  $query = " SELECT * FROM student ";
}

$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_array($result)) {
    $id = $row['id'];
    $image_src = $row['s_pic'];
    $name = $row['s_name'];
    $role = $row['s_course'];
    $qual = $row['s_sem'];
    $cno = $row['s_cno'];
    $mail = $row['s_mailid'];

    $output .= '<div class="card" id="result">
    <div class="flip-card-inner">
    <div class="flip-card-front">
                    <img src="../upload/students_profile_img/' .   $image_src . '" loading="lazy" alt="proficle pic" style="width:100%; height: 55%;border-top-left-radius: 15px;
                    border-top-right-radius: 15px;">
                    <h4>' . $name . '</h4>

                    <p class="title">' . "(" . '' . $id . '' . ") " . '' . $role . '</p>
                    <p><i class="bi bi-mortarboard-fill"></i>&nbsp;' . $qual . '</p>
                    <p><i class="bi bi-phone-fill"></i>&nbsp;' . $cno . '</p>
                    <p><i class="bi bi-envelope-fill"></i>&nbsp' . $mail . '</p>
                    </div>
                    <div class="flip-card-back">
                    <a href="updatestudent.php?sid=' . $id . '&upbtn="><button class="btn btn-outline-warning" onclick="confirmdelete()"><i class="bi bi-pencil-square"></i>&nbsp;&nbsp;Edit</button></a>
                    <a href="../actions/update_student.php?sid=' . $id . '&rbtn="><button class="btn btn-outline-danger"><i class="bi bi-trash"></i>&nbsp;&nbsp;Remove</button></a>

                    </div>
                 </div>
                  </div>';
  }


  echo $output;
  unset($_POST);
} else {
  echo 'Data Not Found';
  unset($_POST);
}
