<?php
if (!isset($_SESSION)) session_start();
if (isset($_SESSION['tlogin'])) {
    require 'db_con.php';
    include_once '../Additional_Libraries.php';
    include 't_menu.php';
    include_once '../views/support.php';
    $res = mysqli_query($conn, "SELECT * FROM `asignment` WHERE created_by='" . $_SESSION['tid'] . "' ORDER BY added_on DESC");
?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Assignments</title>
    </head>
    <style>
        #m {
            display: block;
            flex-direction: column;
            justify-content: center;
            text-align: center;
            position: relative;
            align-items: baseline;
            width: 100%;
            padding: 10px;
            flex-wrap: wrap;
            height: auto;

        }

        a {
            text-decoration: none !important;

        }
    </style>

    <body>
        <div id="m">
            <button type="button" class="btn btn-dark"><a href="../views/createassignment.php"> Crete Assignment</a></button>
        </div>
        <?php
        if (mysqli_num_rows($res) > 0) {
            $i = 1;
            while ($assign = mysqli_fetch_array($res)) {
        ?>
                <div class="accordion" id="accordionExample">

                    <div class="card">
                        <div class="card-header" id="heading<?php echo ($i); ?>">
                            <div class="row">

                                <div class="col">
                                    <h6 class="mb-0"> Name:&nbsp;<?php echo ($assign['assignment_name']) ?>&nbsp;&nbsp;-&nbsp;&nbsp; Key:&nbsp;<?php echo ($assign['assign_key']) ?> </h6>
                                </div>

                                <div class="col">
                                    <h2 class="mb-0">
                                        <button class="btn btn-outline-danger" type="button" name="viewbtn" id="viewbtn" aria-expanded="true">
                                            <a href="../upload//assignments/qp/<?php echo ($assign['qp']) ?> " target="_blank"> View Questions</a>
                                        </button>
                                    </h2>
                                </div>

                                <div class="col">
                                    <h2 class="mb-0">
                                        <button class="btn btn-outline-danger" type="button" name="dltbtn" id="dltbtn" aria-expanded="true">
                                            <a href="../actions/assignments.php?deltasign='null'&id=<?php echo $assign['asign_id'] ?>"> Delete</a>
                                        </button>
                                    </h2>
                                </div>
                                <div class="col">
                                    <h2 class="mb-0">
                                        <button class="btn btn-outline-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo ($i); ?>" aria-expanded="true" aria-controls="collapse<?php echo ($i); ?>">
                                            <i class="bi bi-arrow-90deg-down"></i>&nbsp; Expand
                                        </button>
                                    </h2>
                                </div>
                            </div>
                        </div>

                        <div id="collapse<?php echo ($i); ?>" class="collapse" aria-labelledby="heading<?php echo ($i); ?>" data-parent="#accordionExample">
                            <div class="card-body">
                                <table class="table table-hover table-striped " id="myTable">
                                    <thead class="table-dark">
                                        <tr>
                                            <th class="text-center"> Sl.No </th>
                                            <th class="text-center"> Class Name </th>
                                            <th class="text-center"> Student Name </th>
                                            <th class="text-center"> Submitted On </th>
                                            <th class="text-center"> View Assignments </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $res1 = mysqli_query($conn, "SELECT * FROM submit_asign where asign_id='" . $assign['asign_id'] . "'");
                                        if(mysqli_num_rows($res)>0){
                                            $i=1;
                                            while($row=mysqli_fetch_array($res1)){
                                                ?>
                                                <tr><td class="text-center"><?php echo($i); ?></td>
                                              <td class="text-center"><?php echo($assign['class_name']); ?></td>
                                              <td class="text-center"><?php echo($row['s_name']); ?></td>
                                              <td class="text-center"><?php echo($row['submited_on']); ?></td>
                                              <td class="text-center"><a href="../upload/assignments/responce/<?php echo ($row['asign_ans']) ?>" target="_blank">View</a></td>

                                            </tr>

                                          <?php      
                                            $i++;
                                            }

                                        }else{
                                            echo (' <tr class="text-center"><td colspan="4" rowspan="4">Responce Not Found</td></tr> ');

                                        }
                                        ?>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>

                </div>


        <?php
                $i++;
            }
        } else {
            echo ("Assignments Not Found");
        }

        ?>
    </body>

    <footer>
        <?php include 'footer.php' ?>
    </footer>

    </html>
<?php


} else {

    echo "<script>
                  
                  alert('Access Denied');
                  window.location.href ='t_login.php';
                  </script>";
}
?>