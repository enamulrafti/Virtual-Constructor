<?php
    session_start();

if(
    isset($_SESSION['usermail']) && 
    isset($_SESSION['userid']) &&
    !empty($_SESSION['usermail']) &&
    !empty($_SESSION['userid'])
    ){
     $loginmail=$_SESSION['usermail'];
    $loginid=$_SESSION['userid'];
    ?>

<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <title>Payment</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
        body {
            background-color: aliceblue;
        }

        .res {
            text-align: center;
        }

        .bt {}

        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }

        .qform {
            background-color: black;
            color: white;
            margin-left: 150px;
            margin-right: 150px;

            padding: 25px;
        }

        .form_ {
            margin-left: 300px;
            margin-right: 300px;
        }

        .prev_q {
            margin: 20px;
        }

        .txt_box {
            width: 100%;

            padding-left: 20px;
            padding-right: 20px;
            margin-left: 20%;
        }

        .container {
            border: 2px solid #dedede;
            background-color: #f1f1f1;
            border-radius: 5px;
            padding: 10px;
            width: 50%;
            /*            padding-right: 100px;*/
            margin: 10px 0;
        }

        .darker {
            margin-left: 700px;
            width: 45%;
            border-color: #ccc;
            background-color: #ddd;
        }

        .time-right {
            float: right;
            color: #aaa;
        }

        .message {
            margin-top: 50px;
            text-align: center;
            color: gray;
        }

    </style>
</head>

<body>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">VIRTUAL CONSTRUCTOR</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="http://localhost/project/logout.php">log out</a></li>
            </ul>
            <ul class="nav navbar-nav">
                <li><a href="http://localhost/project/profile.php">Profile</a></li>
            </ul>
            <ul class="nav navbar-nav">
                <li><a href="http://localhost/project/request.php">Request</a></li>
            </ul>
            <ul class="nav navbar-nav">
                <li><a href="http://localhost/project/monitor.php">Monitor</a></li>
            </ul>
            <ul class="nav navbar-nav">
                <li><a href="http://localhost/project/see_report.php">Reports</a></li>
            </ul>
            <ul class="nav navbar-nav">
                <li><a href="http://localhost/project/ask_quest.php">Quesion</a></li>
            </ul>
            <ul class="nav navbar-nav">
                <li class="active"><a href="http://localhost/project/payment.php">Payment</a></li>
            </ul>


            <form class="navbar-form navbar-right" action="http://localhost/project/search.php" method="POST">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Enter Area" name="key">
                </div>
                <button type="submit" class="btn btn-default">search</button>
            </form>
        </div>
    </nav>
    <table id="customers">
        <tr>
            <td>
                <h4 class="res">
                    Payment
                </h4>
            </td>
        </tr>
    </table>
    <br />
    <div class="cont">

        <div class="qform">
            <form action="payment_process.php" method="POST" class="form_">
                <div class="form-group">
                    <label for="u1">Paid Days</label>
                    <input type="number" class="form-control" id="u1" name="u1" placeholder="Enter Paid days">
                </div>
                <div class="form-group">
                    <label for="u1">Worker Number</label>
                    <input type="number" class="form-control" id="u2" name="u2" placeholder="Enter Worker Number">
                </div>
                <div class="form-group">
                    <label for="u1">Amount</label>
                    <input type="number" class="form-control" id="u5" name="u5" placeholder="Enter amount">
                </div>
                <div class="form-group">
                    <label for="u1">Bank Name</label>
                    <input type="text" class="form-control" id="u3" name="u3" placeholder="Enter Bank Name">
                </div>
                <div class="form-group">
                    <label for="u1">Transanction Number</label>
                    <input type="text" class="form-control" id="u4" name="u4" placeholder="Enter Transanction Number">
                </div>

                <input type="submit" class="btn btn-default" value="Proceed">
                <br>
            </form>

        </div>
        <hr />
        <div class="prev_q">
            <?php
            try{
                $conn=new PDO('mysql:host=localhost:3306;dbname=vcon;','root','');
                $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);


                $selectquery="SELECT p.paid_days AS p1,
                                p.transanction_id AS p2,
                                p.worker AS p3,
                                p.pay_date AS p4,
                                p.bank_name AS p5,
                                p.amount AS p6,
                                c.group_name AS p7
                        FROM payments AS p 
                        	LEFT JOIN
                            ct_group AS c 
                            ON p.ct_groupid=c.id
                        WHERE userid=$loginid
                        ORDER BY pay_date DESC";
                $test=$conn->query($selectquery);
                $obj=$test->fetchAll();
                
                if($test->rowCount()==0){
                    ?>
            <div class="message">
                <h4>Whoops! seems like this will your first peyment.</h4>
                <img src="images/sad1.png" alt="sad" width="50" height="50">
            </div>
            <?php
                }
                else{
                    
                    foreach($obj AS $q){
                            $day=$q['p1'];
                            $tid=$q['p2'];
                            $worker=$q['p3'];
                            $date=$q['p4'];
                            $bank=$q['p5'];
                            $amnt=$q['p6'];
                            $group=$q['p7'];
                        
                        ?>
            <div class="txt_box">

                <div class="container">
                    <h4>Paid : <?php echo $amnt; ?> to <?php echo $group; ?></h4>

                    <small>For <?php echo $worker; ?> Workers </small>
                    <small>For <?php echo $day; ?> days </small>
                    <p>Txn Number: <?php echo $tid; ?> - <?php echo $bank; ?> </p>
                    <span class="time-right"><?php echo $date; ?></span>
                </div>


                <hr />
            </div>

            <?php
                    }
                }
            }catch(PDOException $ex){
                ?>
            <script>
                location.assign('profile.php')

            </script>
            <?php
            }
        
        ?>

        </div>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</body>


</html>





<?php
    }
    else{
    ?>
<script>
    location.assign('login.php')

</script>
<?php
}

?>
