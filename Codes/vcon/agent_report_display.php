<?php
    session_start();

if(
    isset($_SESSION['useremail1'])
    && !empty($_SESSION['useremail1'])
    ){
     $loginmail=$_SESSION['useremail1'];
        if($_SERVER['REQUEST_METHOD']=="GET"){
            if(
                isset($_GET['user_id']) &&
                isset($_GET['agent_id']) &&
                isset($_GET['pack_pay_id']) &&
                isset($_GET['user_name']) &&
                
                !empty($_GET['user_id']) &&
                !empty($_GET['agent_id']) &&
                !empty($_GET['pack_pay_id']) &&
                !empty($_GET['user_name'])
        ){
           $user_id=$_GET['user_id']; 
            $agent_id=$_GET['agent_id'];  
            $pack_id=$_GET['pack_pay_id'];
            $user_name=$_GET['user_name'];
            
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
            padding-top: 5px;
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
            background-color: black;
            color: white;
            width: 50%
        }

        .submit-button:hover {
            color: black;
            background-color: white;
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

        .form_ {
            width: 100%;
            margin-left: 25%;
        }

        .res {
            display: block;
            text-align: center;
        }

        .bt {
            background-color: white;
            color: black;
            width: 100px;
            text-align: center;

        }

        .box {
            background-color: beige;
            width: 100%;
            padding: 25px;
            border-radius: 0.5rem;
            box-shadow: 10px 10px 5px grey;

        }

        .innbox {
            margin-left: 90px;
        }

        .image {
            margin-left: 200px;
        }

        .message {
            margin-top: 80px;
            text-align: center;
            color: gray;

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


    ?>

    <div>
        <div class="container emp-profile">
            <div>
                <table class="styled-table">
                    <thead>
                        <tr>
                            <th>
                                <h5>User:
                                    <?php echo $user_name;?>
                                </h5>
                            </th>

                        </tr>
                    </thead>
                </table>
            </div>
            <div class="updateform">
                <form action="agent_repot_process.php" class="form_" method="POST">
                    <p>Title</p>
                    <input type="text" class="form-control" name="t" id="title" placeholder="Enter title">
                    <p>Details</p>
                    <textarea class="form-control" id="exampleFormControlTextarea1" name="details" rows="5" placeholder="Enter Content"></textarea>
                    <br />
                    <p>Attachment</p>
                    <input type="file" id="attach" name="attach" />
                    <hr />
                    <input type="hidden" name="uid" value="<?php echo $user_id; ?>">
                    <input type="hidden" name="aid" value="<?php echo $agent_id; ?>">
                    <input type="hidden" name="pid" value="<?php echo $pack_id; ?>">

                    <input type="submit" class="submit-button" value="Update" />
                    <br />

                </form>
                <br />
                <a class="back" href="http://localhost/vcon/agent_report.php">Back</a>
            </div>
        </div>

        <div class="prev1">
            <?php
            
                try{
       $conn=new PDO('mysql:host=localhost:3306;dbname=vcon;','root','');
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        
        
        $selectquery="SELECT r.content AS c1,
                            r.time AS c2,
                            r.file AS c3,
                            r.title AS c4
                    FROM reports AS r
                    WHERE r.userid=$user_id AND r.agentid=$agent_id
                    ORDER BY time DESC ";
        $test=$conn->query($selectquery);
        $returnobj=$test->fetchAll();
        if($test->rowcount()==0){
            ?>

            <div class="message">
                <h4>Whoops! seems like every Group have an agent.</h4>
                <img src="images/sad1.png" alt="sad" width="50" height="50">
            </div>

            <?php
        }
        else{
        foreach($returnobj AS $userdata){
            
            $content=$userdata['c1'];
            $time=$userdata['c2'];
            $file=$userdata['c3'];
            $title=$userdata['c4'];
                
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
                        <h5> <?php echo $content; ?></h5>
                    </div>

                </div>
                <br />
            </div>
            <?php
    }
            }
        ?>

            <br />

            <script>
                function deletefn(id) {
                    location.assign('request_delete.php?hire_id=' + id);
                }

            </script>
            <?php
        }
    catch(PDOException $ex ){
        ?>
            <script>
                location.assign('home.php')

            </script>
            <?php
    }
            
            
            ?>
        </div>
    </div>


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
    location.assign('profile1.php')

</script>
<?php
              
            }        
                
        }
    else{
        ?>
<script>
    location.assign('agent_report.php')

</script>
<?php
            }
       
        
    }
    else{
        ?>
<script>
    location.assign('login1.php')

</script>
<?php
    }
?>
