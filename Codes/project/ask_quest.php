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
    <title>ask question</title>
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


            width: 100%;
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

            padding-left: 70px;
            padding-right: 70px;
            margin: auto;
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
        .message{
            margin-top: 100px;
            text-align: center;
            color:gray;
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
                <li class="active"><a href="http://localhost/project/ask_quest.php">Quesion</a></li>
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
                    User Questions
                </h4>
            </td>
        </tr>
    </table>
    <div class="cont">

        <div class="qform">
            <form action="ask_quest_process.php" method="POST" class="form_">
                <div class="form-group">
                    <label for="u1">Ask Here</label>

                    <textarea type="text" class="form-control" id="u1" name="u1" rows="5" placeholder="Write your question"></textarea>
                </div>

                <input type="submit" class="btn btn-default" value="Ask">
                <br>
            </form>

        </div>
        <div class="prev_q">
            <?php
            try{
                $conn=new PDO('mysql:host=localhost:3306;dbname=vcon;','root','');
                $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);


                $selectquery="SELECT question AS u1,
                                    time AS u2,
                                    feedback AS u3
                            FROM user_questions
                            WHERE userid=$loginid 
                            ORDER BY time DESC";
                $test=$conn->query($selectquery);
                $obj=$test->fetchAll();
                
                if($test->rowCount()==0){
                    ?>
            <div class="message">
                <h4>Whoops! seems like every Group have an agent.</h4>
                <img src="images/sad1.png" alt="sad" width="50" height="50">
            </div>
            <?php
                }
                else{
                    
                    foreach($obj AS $q){
                        $question=$q['u1'];
                        $time=$q['u2'];
                        $rep=$q['u3'];
                        
                        ?>
            <div class="txt_box">
                <div class="container darker">
                    <h4>Agent</h4>
                    <p> <?php echo $rep; ?></p>

                </div>

                <div class="container">
                    <h4>You</h4>
                    <p><?php echo $question; ?></p>
                    <span class="time-right"><?php echo $time; ?></span>
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
