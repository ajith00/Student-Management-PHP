<?php
if (!isset($_SESSION)) session_start();
if (isset($_SESSION['slogin'])) {
    require 'db_con.php';
    include_once '../Additional_Libraries.php';
    include 's_menu.php';
    include_once '../views/support.php';
    $res = mysqli_query($conn, "SELECT * FROM `submit_asign` WHERE s_id='" . $_SESSION['sid'] . "' ORDER BY submited_on DESC");
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>View Assignments</title>
    </head>

    <body>
        <div class="card-body">
            <button class="btn btn-outline-success"><a href="../views/submit_assignment.php">Submit An Assignment </a> </button><br>
            <table class="table table-hover table-striped " id="myTable">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center"> Sl.No </th>
                        <th class="text-center"> Assignment Name </th>
                        <th class="text-center"> Submitted On </th>
                        <th class="text-center"> View Submitted Assignments </th>
                        <th class="text-center"> Delete </th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    if (mysqli_num_rows($res) > 0) {
                        while ($row = mysqli_fetch_array($res)) {
                            $i = 1;
                    ?>
                            <tr class="text-center">
                                <td class="text-center"><?php echo ($i); ?></td>
                                <td class="text-center"><?php echo ($row['asign_name']) ?></td>
                                <td class="text-center"><?php echo ($row['submited_on']) ?></td>
                                <td class="text-center"><a href="../upload/assignments/responce/<?php echo ($row['asign_ans']) ?>" target="_blank">View</a></td>
                                <td class="text-center"><a href="../actions/assignments.php?sdtasign='0'&subid=<?php echo ($row['sa_id']); ?>">Delete</a></td>
                            </tr>
                    <?php
                            $i++;
                        }
                    } else {
                        echo (' <tr class="text-center"><td colspan="4" rowspan="4">Assignments Not Found</td></tr> ');
                    }
                    ?>
                </tbody>

            </table>
        </div>
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