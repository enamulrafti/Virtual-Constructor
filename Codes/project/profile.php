<?php
    session_start();

if(
    isset($_SESSION['usermail'])
    && !empty($_SESSION['usermail'])
    ){
     $loginmail=$_SESSION['usermail'];
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Customer profile</title>
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
                <li class="active"><a href="http://localhost/project/profile.php">Profile</a></li>
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
                    User Profile
                </h4>
            </td>
        </tr>
    </table>
    <br />
    <?php 
    
    try{
       $conn=new PDO('mysql:host=localhost:3306;dbname=vcon;','root','');
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        
        
        $selectquery="SELECT * FROM user WHERE email='$loginmail' ";
        $test=$conn->query($selectquery);
        $returnobj=$test->fetchAll();
        foreach($returnobj AS $userdata){
            $name=$userdata['user_name'];
            $address=$userdata['address'];
            $email=$userdata['email'];
            $bankac=$userdata['bank_account'];
            $contact=$userdata['contact_no'];
            $user=$userdata['id'];
        }
            
            
        
    ?>
    <div class="container">
        <div>
            <form action="editprofile.php" method="POST">

                <table id="customers">
                    <tr>
                        <th colspan="2">
                            <h3>
                                <?php echo $name;?>

                            </h3>
                        </th>

                    </tr>
                    <tr>
                        <td colspan="2">
                            <h4>
                                <?php echo $email; ?>
                            </h4>
                        </td>

                    </tr>

                    <tr>
                        <td> Address</td>
                        <td>
                            <?php
                            echo $address;
                        ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Contact No</td>
                        <td>
                            <?php
                            echo $contact;
                        ?>
                        </td>
                    </tr>
                    <tr>
                        <td> Bank Account</td>
                        <td>
                            <?php
                            echo $bankac;
                        ?>
                        </td>
                    </tr>
                </table>
                <br />
                <input class="submit-button" type="submit" value="Edit Profile" />
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
