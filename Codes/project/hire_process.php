<?php
    session_start();

if(
    isset($_SESSION['usermail'])
    && !empty($_SESSION['usermail'])
    ){
     $loginmail=$_SESSION['usermail'];
        
        if($_SERVER['REQUEST_METHOD']=="GET"){
            
            if(
                isset($_GET['hire_id']) &&
                isset($_GET['agentid']) &&
                
                !empty($_GET['hire_id']) &&
                 !empty($_GET['agentid'])
               ){
               $ctid=$_GET['hire_id'];
                $agentid=$_GET['agentid'];
                
       ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>hire process</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js">
    </script>
    <style>
        body {
            background-color: aliceblue;
        }
        .cont {
            margin-top: 50px;
            width: 600px;
            background-color:black;
            color: white;
            padding: 50px;
            margin: auto;
        }

        .res {
            text-align: center;
        }



        .bt {
            background-color: white;
            color: black;
            width: 100px;
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
                <li><a href="http://localhost/project/profile.php">Profile</a></li>
            </ul>

        </div>

    </nav>
    <div class="cont">
        <div class="form-group">
        <form action="hire_data_insert.php" method="POST">
                <label for="u1"><h4>Request Details</h4></label>
            
                <label for="u2">Details: </label>
                <input type="hidden" id="groupid" name="u3" value="<?php echo $ctid; ?>">
                <input type="hidden" id="agentid" name="u2" value="<?php echo $agentid; ?>">
                <textarea type="text" class="form-control" id="u4" name="u4" rows="5" placeholder="Enter details"></textarea>
                <p>Don't put your address and contact no.</p>
             <input type="submit" class="bt" value="Confirm">
            
            
        </form>


    </div>
    <?php        
            }
            else{
                
                ?>
    <script>
        location.assign('profile.php')

    </script>
    <?php
                }
        } else{
                   ?>
    <script>
        location.assign('profile.php')

    </script>
    <?php
            }
    }else{
            ?>
    <script>
        location.assign('profile.php')

    </script>
    <?php 
}

?>
