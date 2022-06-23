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

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Reports</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        body {
            background-color: aliceblue;
        }

        .res {
            text-align: center;
        }

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

        .bt {
            background-color: white;
            color: black;
            width: 100px;
            text-align: center;

        }

        .box {
            background-color: lightblue;
            width: 100%;
            padding: 25px;

        }

        .innbox {
            margin-left: 90px;
        }

        .image {
            margin-left: 200px;
        }

        .back {
            display: block;
            text-align: center;
        }

    </style>
</head>

<body>

    <nav class="navbar navbar-inverse ">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">VIRTUAL CONSTRUCTOR</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="http://localhost/project/logout.php">log out</a></li>
            </ul>
            <ul class="nav navbar-nav">
                <li ><a href="http://localhost/project/profile.php">Profile</a></li>
            </ul>
            <ul class="nav navbar-nav">
                <li><a href="http://localhost/project/request.php">Request</a></li>
            </ul>
            <ul class="nav navbar-nav">
                <li><a href="http://localhost/project/monitor.php">Monitor</a></li>
            </ul>
            <ul class="nav navbar-nav">
                <li class="active"><a href="http://localhost/project/see_report.php">Reports</a></li>
            </ul>
            <ul class="nav navbar-nav">
                <li><a href="http://localhost/project/ask_quest.php">Quesion</a></li>
            </ul>
            <ul class="nav navbar-nav">
                <li><a href="http://localhost/project/payment.php">Payment</a></li>
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
                    Reports
                </h4>
            </td>
        </tr>
    </table>
    <br />
    <?php 
    
    try{
       $conn=new PDO('mysql:host=localhost:3306;dbname=vcon;','root','');
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        
        
        $selectquery="SELECT content AS u1,
                            time AS u2,
                            file AS u3,
                            title AS u4
                    FROM reports AS r
                    WHERE userid=$loginid
                    ORDER BY time DESC";
        $test=$conn->query($selectquery);
        $returnobj=$test->fetchAll();
        if($test->rowcount()==0){
            ?>
                <table id="customers">
                    <tr>
                        <td>
                            <h4 class="res">
                                You haven't subscribed any packages <br /> <br />
                                Or You haven't received any reports till now.
                            
                            </h4>
                        </td>
                    </tr>
                </table>
    <?php
        }
        else{
        foreach($returnobj AS $userdata){
            
            $content=$userdata['u1'];
            $time=$userdata['u2'];
            $file=$userdata['u3'];
            $title=$userdata['u4'];
            
        

        
    ?>
    <div class="container">
        <div class="box">
            <div class="innbox">
                <h2><?php echo $title; ?></h2>
                <small>Report date: <?php echo $time; ?></small>
                <hr />
                <div class="image">
                    <img src="images/<?php echo $file;?>" alt="Progress" width="500" height="300">
                </div>
                <br /> <br />
                <h4> <?php echo $content; ?></h4>
            </div>

        </div>
        <br />
    </div>
    <?php
    }
            }
        ?>
    <a href="http://localhost/project/profile.php" class="back">Back</a>
    <br />

    <script>
        function deletefn(id) {
            location.assign('request_delete.php?hire_id=' + id);
        }

    </script>
</body>

</html>
<?php
        }
    catch(PDOException $ex ){
        ?>
<script>
    location.assign('home.php')

</script>
<?php
    }

}
    else{
    ?>
<script>
    location.assign('login.php')

</script>
<?php
}

?>
