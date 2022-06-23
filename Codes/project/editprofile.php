<?php
    session_start();

if(
    isset($_SESSION['usermail'])
    && !empty($_SESSION['usermail'])
    ){
     $loginmail=$_SESSION['usermail'];
    ?>


<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <title>Update Profile</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
        body {
            background-color: aliceblue;
        }

        .cont {
            margin-top: 70px;
            width: 600px;
            background-color:black;
            color: white;
            padding: 50px;
            margin: auto;
        }
        .submit-button{
            color: black;
        }
        .back {
            display: block;
            text-align: center;
        }

    </style>
</head>

<body>
    <?php 
    
    try{
       $conn=new PDO('mysql:host=localhost:3306;dbname=vcon;','root','');
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $selectquery="SELECT * FROM user WHERE email='$loginmail' ";
        $test=$conn->query($selectquery);
        $returned=$test->fetchAll();
        foreach($returned AS $userdata){
            
            $name=$userdata['user_name'];
            $address=$userdata['address'];
            $email=$userdata['email'];
            $bankac=$userdata['bank_account'];
            $contact=$userdata['contact_no'];
            
            
        }
    ?>
    <nav class="navbar navbar-inverse ">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">VIRTUAL CONSTRUCTOR</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="http://localhost/project/profile.php">profile</a></li>
                <li><a href="http://localhost/project/logout.php">Log out</a></li>
            </ul>
        </div>
    </nav>

    <div class="cont">
        <h3>Edit Profile for: <?php echo $name ?></h3>

        <form action="editprocess.php" method="POST">

            <div class="form-group">
                <p>User Name</p>
                <input class="form-control" type="text" id="uname" name="uname" value="<?php echo $name ?>" placeholder="Enter New User Name" />
            </div>

            <div class="form-group">
                <p>Address</p>
                <input class="form-control" type="text" id="uaddress" name="uaddress" value="<?php echo $address ?>" placeholder="Enter New Address" />
            </div>

            <div class="form-group">
                <p>Contact</p>
                <input class="form-control" type="text" id="ucontact" name="ucontact" value="<?php echo $contact ?>" placeholder="Enter New Contact" />
            </div>

            <div class="form-group">
                <p>Bank Account</p>
                <input class="form-control" type="text" id="ubankac" name="ubankac" value="<?php echo $bankac ?>" placeholder="Enter New Account Number" />
            </div>

            <div class="form-group">
                <p>To change password:</p>
                <input class="form-control" type="password" id="upass" name="upass" placeholder="Enter New Password" />
            </div>

            <div class="form-group">
                <p>Enter Your password to save: </p>
                <input class="form-control" type="password" id="oldpass" name="oldpass" placeholder="Enter Old Password" / required>
            </div>
            <input class="submit-button" type="submit" value="Update" />


        </form>
       
    </div>
     <br />
<a href="http://localhost/project/profile.php" class="back">Back</a>
   <br />
    <?php
        }
    catch(PDOException $ex ){
        ?>
    <script>
        location.assign('profile.php')

    </script>
    <?php
    }
?>
    
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
