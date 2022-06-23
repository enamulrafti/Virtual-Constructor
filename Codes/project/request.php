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
    <title>Hire request</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        body {
            background-color: aliceblue;
        }
        .res{
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
        .bt{
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
                <li><a href="http://localhost/project/logout.php">log out</a></li>
            </ul>
            <ul class="nav navbar-nav">
                <li ><a href="http://localhost/project/profile.php">Profile</a></li>
            </ul>
            <ul class="nav navbar-nav">
                <li class="active"><a href="http://localhost/project/request.php">Request</a></li>
            </ul>
            <ul class="nav navbar-nav">
                <li><a href="http://localhost/project/monitor.php">Monitor</a></li>
            </ul>
            <ul class="nav navbar-nav">
                <li ><a href="http://localhost/project/see_report.php">Reports</a></li>
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
                    You are requested for
                </h4>
            </td>
        </tr>
    </table>
    <br />
    <?php 
    
    try{
       $conn=new PDO('mysql:host=localhost:3306;dbname=vcon;','root','');
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $query2="SELECT id FROM user WHERE `email` ='$loginmail'";
        $test2=$conn->query($query2);
        
            $returnobj2=$test2->fetchAll();
            foreach($returnobj2 AS $udata){
                $loginid=$udata['id'];
            }
        
        
        $selectquery="SELECT c.group_name AS u1,
                             b.status AS u2,
                               b.id AS u3
                    FROM booking_req AS b
                        LEFT JOIN
                        ct_group AS c
                        ON b.ct_groupid=c.id
                    WHERE b.userid='$loginid' ";
        $test=$conn->query($selectquery);
        $returnobj=$test->fetchAll();
        foreach($returnobj AS $userdata){
            
            $group=$userdata['u1'];
            $status=$userdata['u2'];
            $hire_id=$userdata['u3'];
        

        
    ?>    
    <div class="container">
        <div>
            

                <table id="customers">
                    <tr>
                        <th>
                            <h3>
                                <?php echo $group;?>
                                
                            </h3>
                        </th>
                        <th>
                        <?php 
                            if(strcmp('$status','Approved')==1){
                                ?>
                                
                            <button type="button" class="bt" onclick="deletefn(<?php echo $hire_id ?>);">Delete</button>   
                        
                                <?php
                            } else{
                                ?>
                                
                            <button type="button" class="bt" onclick="deletefn(<?php echo $hire_id ?>);">Delete</button>   
                        
                                <?php
                            }
                        ?>
                         </th>
                        
                    </tr>
                    <tr>
                       <td>
                            <h4>
                                Status
                            </h4>
                        </td>
                        <td>
                            <h4>
                                <?php echo $status; ?>
                            </h4>
                        </td>

                    </tr>

                </table>
                <br />
           
        </div>
    </div>
    <?php
    }
        ?>
        <a href="http://localhost/project/profile.php" class="back">Back</a>
        <script>
        function deletefn(id) {
            location.assign('request_delete.php?hire_id='+id);
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
