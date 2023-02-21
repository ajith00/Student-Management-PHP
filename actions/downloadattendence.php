<?php

use PDF as GlobalPDF;

require '../views/db_con.php';
include_once '../Additional_Libraries.php';
if (!isset($_SESSION)) session_start();

//Downlod Attendence
if (isset($_GET['downloadatn'])) {

  $cource = mysqli_escape_string($conn, $_GET['a1']);
  $sub = mysqli_escape_string($conn, $_GET['b1']);
  $dt = mysqli_escape_string($conn, $_GET['c1']);

  $data = explode("-", $cource);
  class PDF extends FPDF
  {
   // Page header
    function Header()
    {
      // Logo
      $this->Image('../img/logo_1.png', 10, 5, 70);
      $this->SetFont('Arial', 'B', 13);
      // Move to the right
      $this->Cell(150);
      // Title
      $this->Cell(80, 10, 'Attendence Register', 1, 0, 'C');
      // Line break
      $this->Ln(20);
    }
  
    // Page footer
    function Footer()
    {
      // Position at 1.5 cm from bottom
      $this->SetY(-15);
      // Arial italic 8
      $this->SetFont('Arial', 'I', 8);
      // Page number
      $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
      $this->Cell(5,5, 'Downloaded On ' . date("Y-m-d h:i:sa") . '/{nb}',0, 0,'R');

    }
  }
  
  
  if($dt!=""){
    $sql = "select `a_id`, `a_date`, `dept`, `c_name`, `sub_name`, `s_name`, `attendence` from attadence where dept='" . $data[0] . "' and c_name='" . $data[1] . "' and sub_name='" . $sub . "' and a_date='" . $dt . "'";
  }else{
    $sql = "select `a_id`, `a_date`, `dept`, `c_name`, `sub_name`, `s_name`, `attendence` from attadence where dept='" . $data[0] . "' and c_name='" . $data[1] . "' and sub_name='" . $sub . "' ORDER BY a_date Desc";
   
  }
  $rows = mysqli_query($conn, $sql);
  $header = mysqli_query($conn, "SELECT UCASE(`COLUMN_NAME`) 
  FROM `INFORMATION_SCHEMA`.`COLUMNS` 
  WHERE `TABLE_NAME`='attadence'");
  
  $pdf = new PDF();
  ob_clean();
  //header
  $pdf->AddPage('L');
  //foter page
  $pdf->AliasNbPages();
  $pdf->SetFont('Arial', 'B', 10);
  $pdf->Cell(10,10,'Sl.No','LT',0,'C');
  $pdf->Cell(30,10,'ID', 'LT',0,'C');
  $pdf->Cell(30,10,'Date', 'LT',0,'C');
  $pdf->Cell(30,10,'Course', 'LT',0,'C');
  $pdf->Cell(30,10,'Semester', 'LT',0,'C');
  $pdf->Cell(30,10,'Subject', 'LT',0,'C');
  $pdf->Cell(30,10,'Name', 'LT',0,'C');
  $pdf->Cell(30,10,'Remark', 'LTR',0,'C');
  $pdf->SetFont('Arial', '', 8);

  $j=1;


  foreach ($rows as $row) {

  $pdf->Ln();
  $pdf->Cell(10,10,$j, 'LTB',0,'C');
  foreach ($row as $column)

    $pdf->Cell(30,10, $column, 'LTB',0,'C');
    $pdf->Cell(.5,10,'', 'R',0,'C');
    $j++;
  }
  $pdf->Output('D',"AttendenceRecord.pdf",true); 
}


//Download Ia Marks Record
if (isset($_GET['downloadia'])) {

  $cource = mysqli_escape_string($conn, $_GET['a1']);
  $sub = mysqli_escape_string($conn, $_GET['b1']);


  $data = explode("-", $cource);
  class PDF extends FPDF
  {
   // Page header
    function Header()
    {
      // Logo
      $this->Image('../img/logo_1.png', 10, 5, 70);
      $this->SetFont('Arial', 'B', 13);
      // Move to the right
      $this->Cell(150);
      // Title
      $this->Cell(80, 10, 'IA Marks Register', 1, 0, 'C');
      // Line break
      $this->Ln(20);
    }
  
    // Page footer
    function Footer()
    {
      // Position at 1.5 cm from bottom
      $this->SetY(-15);
      // Arial italic 8
      $this->SetFont('Arial', 'I', 8);
      // Page number
      $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
      $this->Cell(5,5, 'Downloaded On ' . date("Y-m-d h:i:sa") . '/{nb}',0, 0,'R');

    }
  }
  
  
  $sql = "select `ia_id`, `subject`, `s_name`, `attendence`, `assignment`, `test_mark`, `ia_mark`, `max_mark`, `added_on` from ia_marks where dept='" . $data[0] . "' and sem='" . $data[1] . "' and subject='" . $sub . "'";
 
  $rows = mysqli_query($conn, $sql);
  $header = mysqli_query($conn, "SELECT UCASE(`COLUMN_NAME`) 
  FROM `INFORMATION_SCHEMA`.`COLUMNS` 
  WHERE `TABLE_NAME`='ia_marks'");
  
  $pdf = new PDF();
  ob_clean();
  //header
  $pdf->AddPage('L');
  //foter page
  $pdf->AliasNbPages();
  $pdf->SetFont('Arial', 'B', 10);

  $pdf->Cell(10,10,'Sl.No','LT',0,'C');
  $pdf->Cell(30,10,'ID', 'TL',0,'C');
  $pdf->Cell(30,10,'Subject', 'TL',0,'C');
  $pdf->Cell(30,10,'Name', 'TL',0,'C');
  $pdf->Cell(30,10,'Atn-Mark', 'TL',0,'C');
  $pdf->Cell(30,10,'Assi-Mark', 'TL',0,'C');
  $pdf->Cell(30,10,'Test-Mark', 'TL',0,'C');
  $pdf->Cell(30,10,'Total/IA-Mark', 'TL',0,'C');
  $pdf->Cell(30,10,'Max Mark', 'TL',0,'C');
  $pdf->Cell(30,10,'Date', 'LTR',0,'C');
  $pdf->SetFont('Arial', '', 8);
  $j=1;
  foreach ($rows as $row) {
 
    $pdf->Ln();
    $pdf->Cell(10,10,$j, 'LTB',0,'C');
    foreach ($row as $column)
 
      $pdf->Cell(30,10, $column, 'TBL',0,'C');
      $pdf->Cell(1,10,'', 'R',0,'C');
      $j++;
  }
  $pdf->Output('D',"IAMarks.pdf",true); 
}



//Download Faculty Record
if (isset($_GET['downloadfaculty'])) {

  class PDF extends FPDF
  {
   // Page header
    function Header()
    {
      // Logo
      $this->Image('../img/logo_1.png', 10, 5, 70);
      $this->SetFont('Arial', 'B', 13);
      // Move to the right
      $this->Cell(150);
      // Title
      $this->Cell(80, 10, 'Faculty List', 1, 0, 'C');
      // Line break
      $this->Ln(20);
    }
  
    // Page footer
    function Footer()
    {
      // Position at 1.5 cm from bottom
      $this->SetY(-15);
      // Arial italic 8
      $this->SetFont('Arial', 'I', 8);
      // Page number
      $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
      $this->Cell(5,5, 'Downloaded On ' . date("Y-m-d h:i:sa") . '/{nb}',0, 0,'R');

    }
  }
  
  
  $sql = "SELECT `id`, `f_name`, `f_department`, `f_role`, `f_qualification`, `f_cno`, `f_mailid`, `last_scene` FROM `faculty1`";
  $rows = mysqli_query($conn, $sql);
  $header = mysqli_query($conn, "SELECT UCASE(`COLUMN_NAME`) 
  FROM `INFORMATION_SCHEMA`.`COLUMNS` 
  WHERE `TABLE_NAME`='faculty1'");
  
  $pdf = new PDF();
  ob_clean();
  //header
  $pdf->AddPage('L');

  //foter page
  $pdf->AliasNbPages();
  $pdf->SetFont('Arial', 'B', 10);

  $pdf->Cell(10,10,'Sl.No','LT',0,'C');
  $pdf->Cell(33,10,'ID', 'T',0,'C');
  $pdf->Cell(33,10,'Name', 'T',0,'C');
  $pdf->Cell(33,10,'Department', 'T',0,'C');
  $pdf->Cell(33,10,'Role', 'T',0,'C');
  $pdf->Cell(33,10,'Qualification', 'T',0,'C');
  $pdf->Cell(33,10,'Contact No', 'T',0,'C');
  $pdf->Cell(33,10,'Mail Id', 'T',0,'C');
  $pdf->Cell(33,10,'Last Seen', 'TR',0,'C');
  $pdf->SetFont('Arial', '', 8);
  $j=1;
  foreach ($rows as $row) {
 
    $pdf->Ln();
    $pdf->Cell(10,10,$j, 'LTB',0,'C');
    foreach ($row as $column)
 
      $pdf->Cell(33,10, $column, 'TB',0,'C');
      $pdf->Cell(1,10,'', 'R',0,'C');
      $j++;
  }
  $pdf->Output('D',"Facultylist.pdf",true); 
}

//Download Students Record
if (isset($_GET['downloadstudents'])) {
  $course=mysqli_escape_string($conn,$_GET['dept']);
  class PDF extends FPDF
  {
 // Page header
  function Header()
  {
    // Logo
    $this->Image('../img/logo_1.png', 10, 5, 70);
    $this->SetFont('Arial', 'B', 13);
    // Move to the right
    $this->Cell(150);
    // Title
    $this->Cell(80, 10, 'Students List', 1, 0, 'C');
    // Line break
    $this->Ln(20);
  }

  // Page footer
  function Footer()
  {
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial', 'I', 8);
    // Page number
    $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    $this->Cell(5,5, 'Downloaded On ' . date("Y-m-d h:i:sa") . '/{nb}',0, 0,'R');

  }
  }


  $sql = "SELECT `id`, `s_name`, `s_sex`,`s_course`, `s_sem`, `s_cno`, `s_mailid`, `last_scean` FROM `student` where s_course='".$course."' order by s_sem";
  $rows = mysqli_query($conn, $sql);

  $pdf = new PDF();
  ob_clean();
  //header
  $pdf->AddPage('L');

  //foter page
  $pdf->AliasNbPages();
  $pdf->SetFont('Arial', 'B', 10);
  $pdf->Cell(10,10,'Sl.No','LT',0,'L');
  $pdf->Cell(33,10,'ID', 'T',0,'L');
  $pdf->Cell(33,10,'Name', 'T',0,'L');
  $pdf->Cell(33,10,'Gender', 'T',0,'L');
  $pdf->Cell(33,10,'Course', 'T',0,'L');
  $pdf->Cell(33,10,'Semester', 'T',0,'L');
  $pdf->Cell(33,10,'Contact No', 'T',0,'L');
  $pdf->Cell(33,10,'Mail Id', 'T',0,'L');
  $pdf->Cell(33,10,'Last Seen', 'TR',0,'L');
  $pdf->SetFont('Arial', '', 8);
  $j=1;


  foreach ($rows as $row) {

    $pdf->Ln();
    $pdf->Cell(10,10,$j, 'LTB',0,'L');
    foreach ($row as $column)

      $pdf->Cell(33,10, $column, 'TB',0,'L');
      $pdf->Cell(.5,10,'', 'R',0,'C');
      $j++;
  }
  $pdf->Output('D',"StudentsList.pdf",true); 
}
