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
    <title>user request</title>
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
            background-color:black;
            color: #ffffff;
            text-align: left;
        }

        .cont{
            background-color:azure;
            box-shadow: rgba(6, 24, 44, 0.4) 0px 0px 0px 2px, rgba(6, 24, 44, 0.65) 0px 4px 6px -1px, rgba(255, 255, 255, 0.08) 0px 1px 0px inset;
        }
        .inner_cont{
            margin: 20px;
            padding: 15px;
        }
        p{
            color: grey;
        }
        h4{
            color: blue;
        }
        h5{
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
        $selectquery="SELECT uq.id AS t1,
                            us.user_name AS t2,
                            cg.group_name AS t3,
                            uq.question AS t4,
                            uq.time AS t5,
                            uq.feedback AS t6
                    FROM user_questions AS uq
                        LEFT JOIN 
                        user AS us
                        ON uq.userid=us.id
                        LEFT JOIN 
                        booking_req as bq 
                        ON bq.userid=us.id
                        LEFT JOIN
                        ct_group AS cg
                        ON bq.ct_groupid=cg.id
                        LEFT JOIN
                        agent as ag	
                        ON cg.agentid=ag.id

                    WHERE uq.agentid=$loginid AND bq.status='approved'
                    ORDER BY uq.time DESC";
        $test=$conn->query($selectquery);
        $returned=$test->fetchAll();
    ?>
    <div>
        <div class="container emp-profile">
            <h5>Request From Customer:</h5>
            <table class="styled-table">
                <thead>
                    <tr>
                        <th> <h5> Agent:
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

            $question_id=$data['t1'];
            $user_name=$data['t2'];
            $group_name=$data['t3'];
            $time=$data['t5'];
            $question=$data['t4'];
            $feedback=$data['t6'];
            
     ?>
          <div class="cont">
               <div class="inner_cont">
                <div class="form-group">
                  <h4><?php echo $user_name ?></h4>
                  <p> <small>Construction Group: </small><?php echo $group_name ?><br />
                  <small>posted at- </small><?php echo $time ?></p>
                  <hr />
                </div>
                <div>
                    <h6>
                        <?php echo $question ?>
                        
                    </h6>
                    <hr />
                </div>
                <?php
                   if($feedback=='will reply soon...'){
                       ?>
                       <div class="form-group">
                    <form action="http://localhost/vcon/user_request_process.php" method="POST" >
                        <textarea class="form-control" name="content" id="exampleFormControlTextarea1" placeholder="Write your reply" rows="3"></textarea>
                        <input type="hidden" name="q_id" value="<?php echo $question_id; ?>">
                        <button type="submit" class="btn btn-primary">Reply</button>
                    </form>
                </div>
                  <?php
                   }
            else{
                echo $loginname .": ".$feedback;
            }
                   
                   ?>
                
                </div>
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
