<?php
    session_start();

if(
    isset($_SESSION['usermail'])
    && !empty($_SESSION['usermail'])
    ){
     $loginmail=$_SESSION['usermail'];
        
        if($_SERVER['REQUEST_METHOD']=="POST"){
            
            if(
                isset($_POST['u1']) &&
                isset($_POST['u2']) &&
                
                !empty($_POST['u1']) &&
                !empty($_POST['u2'])
               
                
               ){
            $p_type=$_POST['u1'];
            $p_days=$_POST['u2'];
            $p_cost=$p_days * 300;
                
       ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Monitor</title>
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
            background-color: black;
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

            </ul>

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

        <form action="monitor_2.php" method="POST">

            <div class="form-group">
                <p>Chosen Package Type</p>
                <input class="form-control" type="text" class="u" id="u1" name="u1" value="<?php echo $p_type ?>" readonly />
            </div>

            <div class="form-group">
                <p>Days</p>
                <input class="form-control" type="text" class="u" id="u2" name="u2" value="<?php echo $p_days ?>" readonly />
            </div>

            <div class="form-group">
                <p>Cost</p>
                <input class="form-control" type="text" class="u" id="u3" name="u3" value="<?php echo $p_cost ?>" readonly />
            </div>

            <div class="form-group">
                <p>Transanction Number</p>
                <input class="form-control" type="text" id="u4" name="u4" placeholder="Enter Transanction Number" />
            </div>

            <input class="btn btn-primary" type="submit" value="Continue" />


        </form>
             <a href="http://localhost/project/monitor.php" class="back">Back</a>
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
        location.assign('login.php')

    </script>
    <?php 
}

?>
