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
    <title>Monitor</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        body {
            background-color: aliceblue;
        }

        .form_ {
            margin-top: 70px;
            width: 500px;
            background-color: black;
            color: white;
            padding: 50px;
            margin: auto;
        }

        .out {

            color: white;


        }

        output {
            display: inline;

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
                <li><a href="http://localhost/project/profile.php">Profile</a></li>
            </ul>
            <ul class="nav navbar-nav">
                <li><a href="http://localhost/project/request.php">Request</a></li>
            </ul>
            <ul class="nav navbar-nav">
                <li class="active"><a href="http://localhost/project/monitor.php">Monitor</a></li>
            </ul>
            <ul class="nav navbar-nav">
                <li><a href="http://localhost/project/see_report.php">Reports</a></li>
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
    <?php 
    
    try{
       $conn=new PDO('mysql:host=localhost:3306;dbname=vcon;','root','');
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $selectquery="SELECT * FROM packages";
        
        $query1="SELECT p.type AS u1,
                pp.end_date AS u2
        FROM package_pay AS pp
            LEFT JOIN 
            packages AS p 
            ON pp.packagesid=p.id
        WHERE userid=$loginid AND ispaid=1
        ORDER BY pp.end_date ASC";
        $test1=$conn->query($query1);
        $object=$test1->fetchall();
        
        if($test1->rowCount()==0){
            ?>
    <table id="customers">
        <tr>
            <td>
                <h4 class="res">
                    Choose A Package
                </h4>
            </td>
        </tr>
    </table>

    <?php
            
        }else{
        
        foreach($object AS $object1){
            $type=$object1['u1'];
            $end=$object1['u2'];
        }
            ?>
    <table id="customers">
        <tr>
            <td>
                <h4 class="res">
                  Existing <?php echo $type; ?> Package Valid till:<?php echo $end; ?>
                </h4>
            </td>
        </tr>
    </table> 
    <hr />
    <?php
    }
        
        $test=$conn->query($selectquery);
        $row = $test->fetchall();
        
    ?>
    <div class="container">
        <div class="form_">
            <form action="monitor_1.php" method="POST" oninput="u3.value=parseInt(a.value)*parseInt(b.value)">

                <div class="form-group">
                    <label for="u1">Package Type</label>
                    <select name="u1" class="form-control">
                        <?php
                        foreach($row AS $data){
                            ?>
                        <option value="<?php echo $data['type']?>">
                            <?php echo $data['type']?>
                        </option>
                        <?php
                        }
                    ?>
                    </select>

                    <div>

                        <label>For Days</label>
                        <input type="number" id="a" value="1" name="u2" class="form-control">
                        <input type="hidden" id="b" value="300">
                        <br />
                        <label>This will cost:&nbsp;&nbsp; </label>
                        <output class="out" name="u3" for="a b">300</output>


                    </div>
                </div>


                <input type="submit" class="btn btn-primary" value="proceed to payment">

            </form>
        </div>

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
