<?php
    session_start();

if(
    isset($_SESSION['useremail1']) &&
    isset($_SESSION['agent_id']) &&
    isset($_SESSION['agent_name']) &&
    !empty($_SESSION['useremail1']) &&
    !empty($_SESSION['agent_id']) &&
    !empty($_SESSION['agent_name'])
    ){
    $loginmail=$_SESSION['useremail1'];
    $loginid=$_SESSION['agent_id'];
    $loginname=$_SESSION['agent_name'];
    ?>


<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <title>report</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        * {
            margin: 0px;
            padding: 0px;
            box-sizing: border-box
        }

        body {
            padding-top: 60px;
            background: azure;
        }

        .emp-profile {
            padding: 3%;
            margin-top: 3%;
            margin-bottom: 3%;
            border-radius: 0.5rem;
            box-shadow: 10px 10px 5px grey;
            background-color: beige;
        }

        .profile-head h5 {
            color: #333;
        }

        .profile-head h6 {
            color: #0062cc;
        }

        .form-control {
            width: 50%;
            margin-bottom: 5px;
        }

        .submit-button {
            margin-top: 10px;
            color: white;
            background-color: cornflowerblue;
            width: 50%
        }

        .styled-table {

            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            font-family: sans-serif;
            min-width: 100%;
            box-shadow: 10px 10px 5px grey;
        }

        .styled-table th,
        .styled-table td {
            padding: 12px 15px;
        }

        .styled-table thead tr {
            background-color: black;
            color: #ffffff;
/*            text-align: left;*/
        }

        .cont {
            background-color: azure;
            box-shadow: rgba(6, 24, 44, 0.4) 0px 0px 0px 2px, rgba(6, 24, 44, 0.65) 0px 4px 6px -1px, rgba(255, 255, 255, 0.08) 0px 1px 0px inset;
        }

        .inner_cont {
            margin: 20px;
            padding: 15px;
        }

        p {
            color: grey;
        }

        h4 {
            color: blue;
        }

        h5 {
            text-align: center;
        }

        .buttons {
            background-color: black;
            color: white;
            width: 200px;
        }

        .buttons:hover {
            background-color: white;
            color: black;

        }

        .back {
            display: block;
            text-align: center;
        }

    </style>
</head>

<body>
    <!--for navber-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="http://localhost/vcon/home_out.php">VIRTUAL CONSTRUCTOR</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a class="nav-link active" href="http://localhost/vcon/logout.php">Logout</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="http://localhost/vcon/profile1.php">Profile</a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>

    <?php 
    
    try{
       $conn=new PDO('mysql:host=localhost:3306;dbname=vcon;','root','');
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $selectquery="SELECT us.user_name AS t1,
                            us.address AS t2,
                            pp.id AS t3,
                            pp.agentid AS t4,
                            pp.userid AS t5,
                            pp.packagesid AS t6,
                            pp.ispaid AS t7,
                            pp.end_date AS t8,
                            p.id as t9,
                            p.package_days AS t10,
                            p.type AS t11,
                            pp.start_date AS t12,
                            cg.group_name AS t13
                    FROM user AS us 
                        LEFT JOIN
                        package_pay AS pp
                        ON pp.userid=us.id 
                        LEFT JOIN
                        packages AS p 
                        ON p.id=pp.packagesid
                        LEFT JOIN
                        booking_req AS bq
                        ON us.id=bq.userid
                        LEFT JOIN 
                        ct_group AS cg 
                        ON bq.ct_groupid=cg.id
                    WHERE pp.agentid=$loginid AND pp.ispaid=1 ";
        $test=$conn->query($selectquery);
        $returned=$test->fetchAll();
    ?>
    <div>
        <div class="container emp-profile">
            <h5>Working Progress Reports</h5>
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>
                            <h5> Agent:
                                <?php echo $loginname;?>
                            </h5>
                        </th>
                        <th>
                            <h5>
                                Agent Mail:
                                <?php echo $loginmail;?>
                            </h5>
                        </th>

                    </tr>
                </thead>
            </table>
            <?php
        foreach($returned AS $data){
            
            $user_name=$data['t1'];
            $user_address=$data['t2'];
            $package_pay_id=$data['t3'];
            $package_pay_agentid=$data['t4'];
            $package_pay_userid=$data['t5'];
            $package_pay_packageid=$data['t6'];
            $package_pay_ispaid=$data['t7'];
            $package_pay_startdate=$data['t12'];
            $package_pay_enddate=$data['t8'];
            $package_id=$data['t9'];
            $package_days=$data['t10'];
            $package_type=$data['t11'];
            $group_name=$data['t13'];
            
                  
     ?>
            <div class="cont">

                <table class="styled-table">
                    <thead>
                        <tr>

                            <th>
                                <h6>
                                    <?php
                
                                       echo $user_name. "&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp" .$package_type."&nbsp; update    &nbsp;&nbsp;&nbsp Group:".$group_name;
                                        ?>
                                </h6>
                            </th>
                            <th style="width: 50px;">
                                <input type="button" class="buttons" value="report" onclick="report(<?php echo $package_pay_userid ?>,<?php echo $package_pay_agentid ?>,<?php echo $package_pay_id ?>,'<?php echo $user_name ?>');" />

                            </th>
                        </tr>
                    </thead>
                </table>



            </div>

            <?php
            
    }
                                

            ?>
        </div>
    </div>
    <?php  
        }
    catch(PDOException $ex ){
        ?>
    <script>
        location.assign('profile1.php')

    </script>
    <?php
    }
?>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function report(v1, v2, v3, v4) {
            console.log('HELLO');
            location.assign('agent_report_display.php?user_id=' + v1 + '&agent_id=' + v2 + '&pack_pay_id=' + v3 + '&user_name=' + v4);
        }

    </script>
    <a href="http://localhost/vcon/profile1.php" class="back">Back</a>
</body>


</html>

<?php
    
}
    else{
    ?>
<script>
    location.assign('login1.php')

</script>
<?php
}

?>
