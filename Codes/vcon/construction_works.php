<?php
    session_start();

if(
    isset($_SESSION['useremail']) &&
    !empty($_SESSION['useremail'])

    ){
    $loginmail=$_SESSION['useremail'];
    $loginid=$_SESSION['loginid'];
    ?>


<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <title>Work list</title>
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
            background-color: #009879;
            color: #ffffff;
            text-align: left;
        }

        .styled-table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        .styled-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        .styled-table tbody tr:last-of-type {
            border-bottom: 2px solid #009879;
        }

        .button_th {
            display: flex;
            justify-content: flex-end;
        }
        .message{
            margin-top: 200px;
            text-align: center;
            color:gray;
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
                        <a class="nav-link active" href="http://localhost/vcon/profile.php">Profile</a>
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
                                bq.status AS t2,
                                bq.date AS t3,
                                bq.details AS t4,
                                cg.group_name AS t5,
                                cg.manager_email AS t6
                        FROM user AS us 
                            LEFT JOIN
                            booking_req AS bq
                            ON bq.userid=us.id
                            LEFT JOIN
                            ct_group AS cg 
                            ON bq.ct_groupid=cg.id
                         WHERE cg.id='$loginid' AND bq.status='approved' ";
        $test=$conn->query($selectquery);
        $returned=$test->fetchAll();
        
        if($test->rowCount()==0){
            ?>
            <div class="message">
            <h4>Whoops! seems like nobody hired you.</h4>
            <img src="images/sad1.png" alt="sad" width="50" height="50">
            </div>
            <?php
        }else{
    ?>
    <div>
        <div class="container emp-profile">
         
        <div>
           <?php
                foreach($returned AS $data){
                    $user_name=$data['t1'];
                    $work_status=$data['t2'];
                    $date=$data['t3'];
                    $details=$data['t4'];
                    $group=$data['t5'];
                }
            ?>
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>
                       
                            <?php echo $group; ?>
                        </th>
                    </tr>
                </thead>
            </table> <br />
            
            <table class="styled-table">
                <thead>
                    <tr>
                        <th colspan="2">
                           <h5> Hired by: 
                            <?php echo $user_name;?>
                            </h5>
                        </th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Hired Request</td>
                        <td><?php echo $work_status; ?> </td>
                    </tr>
                    <tr class="active-row">
                        <td>Request Date</td>
                        <td><?php echo $date; ?> </td>
                    </tr>
                    <tr>
                        <td>Work Details</td>
                        <td><?php echo $details; ?> </td>
                    </tr>
                

                </tbody>
            </table>
        </div>

        </div>
    </div>
    <?php  
            }
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
