<?php
if (!isset($_SESSION)) session_start();
if (isset($_SESSION['tlogin'])) {
  require 'db_con.php';
  include_once '../Additional_Libraries.php';
  $res = mysqli_query($conn, "select * from faculty1 where id='" . $_SESSION['tid'] . "'");
  $res1 = mysqli_query($conn, "select * from faculty1");

  $options = "";
  if (mysqli_num_rows($res1) > 0) {
    while ($result1 = mysqli_fetch_assoc($res1)) {
      $options .= ' <option value="' . $result1['f_name'] . '">' . $result1['f_name'] . '</option>';
    }
  }

  if (mysqli_num_rows($res) > 0) {
    $result = mysqli_fetch_array($res);
    if ($result['f_role'] == 'Associate Prof & HOD' || $result['f_role'] == 'Vice Principal & HOD') {

?>
      <!DOCTYPE html>
      <html lang="en">

      <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Create Class</title>
        <?php require 'db_con.php';
        include 't_menu.php'; ?>
      </head>
      <style>
        .m {
          display: flex;
          flex-direction: row;
        }

        .r,
        .l {
          width: 700px;
          padding: 10px;
        border-radius: 10px;
          margin: 10px;
          margin-left: auto;
          margin-right: auto;
          position: relative;
          overflow: auto;
          height: 700px;
          box-shadow: rgba(50, 50, 93, 0.25) 0px 30px 60px -12px inset, rgba(0, 0, 0, 0.3) 0px 18px 36px -18px inset;

        }
        .b{
          position: relative;
          left: 45%;
          margin-bottom: 10px;
        }

        @media screen and (max-width: 930px) and (min-width: 200px) {
          .m {
            flex-direction: column;
          }

          .r,
          .l {
            width: 100%;
            height: auto;
          }
        }
      </style>

      <body>
        <div class="m">

          <div class="r mb-3">
            <form action="../actions/createclass.php" method="POST" enctype="multipart/form-data">
              <h5>Hello <?php echo ($result['f_name']); ?></h5>
              <div class="row g-3">
                <div class="col-md">
                  <div class="form-floating mb-3">
                    <select class="form-select" id="scource" name="scource" required>
                      <option value="">--Select--</option>
                      <?php if ($result['f_department'] === 'Science') { ?>
                        <option value="BCA" selected> BCA</option>
                      <?php } elseif ($result['f_department'] === 'Commerce & Management') { ?>
                        <option value="" disabled>UG</option>
                        <option value="B.Com" selected>B.Com</option>
                        <option value="BBA">BBA</option>
                        <option value="" disabled>PG</option>
                        <option value="M.Com">M.Com</option>
                      <?php } elseif ($result['f_department'] === 'Arts') { ?>
                        <option value="BA" selected>BA</option>
                      <?php } else { ?>
                      <?php } ?>
                    </select>
                    <label for="fdept">Name of the Class</label>
                  </div>
                </div>

                <div class="col-md">
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
                </div>
              </div>
              <div class="table-responsive" style="padding: 5px;margin:5px;">
                <table class="table table-hover table-striped " id="myTable">
                  <thead class="table-dark">
                    <tr>
                    <tr>
                      <th class="text-center"> Sl.No </th>
                      <th class="text-center"> Subject Name </th>
                      <th class="text-center"> Professor </th>
                      <th></th>
                    </tr>
                    </tr>
                  </thead>
                  <tbody id="tbody">


                    <!--     <tr id="R1">
          <td class="row-index text-center"><p>1</p></td>
          <td><input type="text" class="form-control" id="sub1" name="sub1" value="" ></td>
          <td class="text-center">
          <select class="form-select" id="fdept" name="Professor1" aria-label="Floating label select example" required>
                      <option value="">--Select--</option>
                      <?php

                      echo $options;
                      ?>
                      </select></td>
          <td class="text-center"><button class="btn btn-danger remove" type="button">Remove</button></td>
          
        </tr>
        <tr id="R2">
          <td class="row-index text-center"><p>2</p></td>
          <td><input type="text" class="form-control" id="sub2" name="sub2" value="" ></td>
          <td class="text-center">
          <select class="form-select" id="fdept" name="Professor2" aria-label="Floating label select example" required>
                      <option value="">--Select--</option>
                                <?php
                                echo $options;
                                ?>
                      </select></td>
          <td class="text-center"><button class="btn btn-danger remove" type="button">Remove</button></td>
          
        </tr>
        <tr id="R3">
          <td class="row-index text-center"><p>3</p></td>
          <td><input type="text" class="form-control" id="sub3" name="sub3" value="" ></td>
          <td class="text-center">
          <select class="form-select" id="fdept" name="Professor3" aria-label="Floating label select example" required>
                      <option value="">--Select--</option>
                      <?php
                      echo $options;
                      ?>
                      </select></td>
          <td class="text-center"><button class="btn btn-danger remove" type="button">Remove</button></td>
          
        </tr>
        <tr id="R4">
          <td class="row-index text-center"><p>4</p></td>
          <td><input type="text" class="form-control" id="sub4" name="sub4" value="" ></td>
          <td class="text-center">
          <select class="form-select" id="fdept" name="Professor4" aria-label="Floating label select example" required>
                      <option value="">--Select--</option>
                      <?php
                      echo $options; ?>
                      </select></td>
          <td class="text-center"><button class="btn btn-danger remove" type="button">Remove</button></td>
          
        </tr>
        <tr id="R5">
          <td class="row-index text-center"><p>5</p></td>
          <td><input type="text" class="form-control" id="sub5" name="sub5" value="" ></td>
          <td class="text-center">
          <select class="form-select" id="fdept" name="Professor5" aria-label="Floating label select example" required>
                      <option value="">--Select--</option>
                      <?php
                      echo $options;
                      ?>
                      </select></td>
          <td class="text-center"><button class="btn btn-danger remove" type="button">Remove</button></td>
          
        </tr>-->




                  </tbody>
                </table>

                <!--     <div class="col-md">

                  <p>Include the Students of below Department to this class </p>
                  <div style="display: flex;">
                    <input class="form-check-input" type="checkbox" value="1bca" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                     BCA 1 <sup>st</sup> Semester
                    </label>
        
                    <input class="form-check-input" type="checkbox" value="2bca" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                    BCA 2 <sup>nd</sup> Semester
                    </label>
  
                    <input class="form-check-input" type="checkbox" value="3bca" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                    BCA 3 <sup>rd</sup> Semester
                    </label>
                    <input class="form-check-input" type="checkbox" value="3bca" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                    BCA 4 <sup>th</sup> Semester
                    </label>  <input class="form-check-input" type="checkbox" value="3bca" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                    BCA 5 <sup>th</sup> Semester
                    </label>  <input class="form-check-input" type="checkbox" value="3bca" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                    BCA 6 <sup>th</sup> Semester
                    </label>
                  </div>
                  <hr>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1bcom" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                      1 B.Com
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="2bcom" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                      2 B.Com
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="3bcom" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                      3 B.com
                    </label>
                  </div>
                  <hr>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1ba" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                      1 BA
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="2ba" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                      2 BA
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="3ba" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                      3 BA
                    </label>
                  </div>
                  <hr>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1bba" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                      1 BBA
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="2bba" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                      2 BBA
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="3bba" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                      3 BBA
                    </label>
                  </div>
                  <hr>


                </div>-->

              </div>
              <p>Minimum 5 Subjects Required-Max 8 Subjects Can be Added </p>
              <input type="button" class="btn btn-outline-primary md-3" id="addBtn" value="Add Subject"></input>

          </div>

          <div class="l" id="l">
            <h5>Students of the Class</h5>
            <style>
              tr,
              td {
                text-align: center;
              }
            </style>
            <div class="table-responsive" id="tbody1" style="padding: 5px;margin:5px;">

            </div>
            <hr>
          </div>
        </div>
        <input type="submit" value="Create" class="btn btn-outline-success b" name="createclass">
        </div>
        </form>
      </body>

      <footer>
        <?php include 'footer.php' ?>
      </footer>

      </html>
      <script>
        $(document).ready(function() {
          load_data2();
          // Denotes total number of rows
          var rowIdx = 1;

          // jQuery button click event to add a row
          $('#addBtn').on('click', function() {
            if (rowIdx < 9) {
              // Adding a row inside the tbody.
              $('#tbody').append(`<tr id="R${rowIdx}">
         <td class="row-index text-center">
         <p>${rowIdx}</p>
         </td>
         <td class="text-center">
              
            <input type="text" class="form-control" id="sub${rowIdx}" name="sub${rowIdx}" value="" >
          
          </div> 
            </td>
          <td class="text-center">
          <select class="form-select" id="fdept" name="Professor${rowIdx}" aria-label="Floating label select example" required>
                      <option value="">--Select--</option>
                      <?php
                      echo $options;
                      ?>
                      </select>
          </td>
          <td class="text-center">
            <button class="btn btn-danger remove"
              type="button">Remove</button>
            </td>
          </tr>`);
              rowIdx++;
            } else {
              $('#tbody').append('<tr> <td colspan="4">Reached Max Limit</td></tr>');
            }
          });

          // jQuery button click event to remove a row.
          $('#tbody').on('click', '.remove', function() {

            // Getting all the rows next to the row
            // containing the clicked button
            var child = $(this).closest('tr').nextAll();

            // Iterating across all the rows 
            // obtained to change the index
            child.each(function() {

              // Getting <tr> id.
              var id = $(this).attr('id');

              // Getting the <p> inside the .row-index class.
              var idx = $(this).children('.row-index').children('p');

              // Gets the row number from <tr> id.
              var dig = parseInt(id.substring(1));

              // Modifying row index.
              idx.html(` ${dig - 1}`);

              // Modifying row id.
              $(this).attr('id', `R${dig - 1}`);
            });

            // Removing the current row.
            $(this).closest('tr').remove();

            // Decreasing total number of rows by 1.
            rowIdx--;
          });
        });





        $(document).on("change", "#ssem", function() {
          var x = $('#scource').find("option:selected").val();
          var y = $('#ssem').find("option:selected").val();

          if (x != '' && y != null) {
            duplicatecheck(x, y);
            load_data2(x, y);
          } else {
            // load_data1();
            alert('Plese Choose the department ')
          }

        });


        function load_data2(x, y) {
          $.ajax({
            url: "../actions/department.php",
            method: "POST",
            data: {
              x1: x,
              y1: y

            },
            success: function(data) {
              $('#tbody1').html(data);
            }
          });
        }

        function duplicatecheck(x, y) {
          $.ajax({
            url: "../actions/createclass.php",
            method: "POST",
            data: {
              p1: x,
              q1: y
            },
            success: function(data) {

              $("#tbody1").append(data);
            }
          });
        }
      </script>
<?php
    } else {
      echo "<script>
        alert('Please Login as HOD....!');
        window.location.href ='t_home.php'; 
        </script>";
    }
  } else {
    echo "<script>
              
              alert('Access Denied');
              window.location.href ='t_login.php';
              </script>";
  }
}
?>