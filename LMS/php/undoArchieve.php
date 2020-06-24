<?php
    #restore the archieved logs
session_start();
if(isset($_SESSION['loggedin']) && isset($_SESSION['userhod']) && isset($_SESSION['idhod'])){

    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Undo Archieve</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

        <script src="https://kit.fontawesome.com/164b99a598.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
        <style type="text/css">
            .search{
                margin-top: 30px;
                margin-left: 50px;
            }
            caption{
                caption-side: top;
            }
            body{
                background: linear-gradient(to right, #33bdff 0%, #ccffff 100%);
            }
            input{
            border:none;
            outline: none;
            }
            input:hover{
                border-color: #117bc2;
                transform: scale(1.1);
            }
        </style>
    </head>
    <body>
    <div class="search">
        <h3><i class="zmdi zmdi-search-in-file"></i> Search Logs</h3>
        <form method="post" action="#">
            <!-- form to search log by teacher name -->
            <div class="form-row">
                <div class="col-sm-2">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="zmdi zmdi-account"></i></div>
                        </div>
                        <input type="text" class="form-control form-control-sm" placeholder="Teacher Name" name="tname">
                    </div>
                </div>
                <div class="form-group ml-1 mr-2">
                    <input type="date" class="form-control-sm" id="fromdate" name="fromdate">
                </div>
                <div class="form-group">
                    <span>To</span>
                </div>
                <div class="form-group ml-2 mr-1">
                    <input type="date" class="form-control-sm" id="todate" name="todate">
                </div>
                <div class="input-group mr-2 col-sm-2">
                    <input type="submit" class="form-control form-control-sm btn-primary" name="submit" value="Search Logs">
                </div>
            </div>
        </form>
    </div>
    </body>
    </html>
    <?php

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        require_once("connect.php");

        $from=$_POST['fromdate'];
        $to=$_POST['todate'];

        if(!empty($_POST['tname'])){
            #logs of a specific teacher
            $tname=$_POST['tname'];

            #get logs that are archieved
            $query="SELECT * FROM logsheet where tname='$tname' and status='archieved' and date between '$from' AND '$to' ORDER BY date DESC";
        }
        else{
            #logs of all teachers
            #get logs that are not approved
            $query="SELECT * FROM logsheet where status='archieved' and date between '$from' AND '$to' ORDER BY date DESC";
        }

        $result=mysqli_query($conn,$query);
        $numrows=mysqli_num_rows($result);
        if($numrows>=1){
            ?>
            <div id="logsarchieved" class="m-4" style="line-height: 1">
                <table class="table table-dark table-bordered table-striped w-auto">
                    <caption class="text-danger ">Logs Archieved</caption>
                    <tr>
                        <th>Class taken</th>
                        <th>Name</th>
                        <th>Subjects</th>
                        <th>Topics</th>
                        <th>Class Type</th>
                        <th>Time</th>
                        <th>NOP</th>
                        <th>NOS</th>
                        <th>Remarks</th>
                        <th>Status</th>
                        <th>Actions</th>

                    </tr>
                    <?php
                    while($row=mysqli_fetch_assoc($result)){
                        ?>
                        <tr>
                            <form method="POST" action="processUndoarchieve.php">
                                <input type="number" name="rowid" value="<?php echo $row['id'] ?>" style="visibility: hidden" readonly>
                                <td><?php echo $row['date']; ?></td>
                                <td><?php echo $row['tname']; ?></td>
                                <td><?php echo $row['subject']; ?></td>
                                <td><?php echo $row['topics']; ?></td>
                                <td><?php echo $row['class_type']; ?></td>
                                <td><?php echo $row['time']; ?></td>
                                <td><?php echo $row['nop']; ?></td>
                                <td><?php echo $row['nos']; ?></td>
                                <td><?php echo $row['remarks']; ?></td>
                                <td><?php echo $row['status']; ?></td>
                                <td ><button class="btn-primary">Restore Log</button></td>
                            </form>
                        </tr>
                        <?php
                    }
                    ?>
                </table>

            </div>
            <?php
        }
        else{
            ?>
            <div class="alert-info">No Data to Show!</div>
            <?php
        }
    }
    else{
        #not post method
    }
}
else{
    #not hod!
    header('location:index.php');
}
?>
