<?php
    session_start();

if(
    isset($_SESSION['useremail'])
    && !empty($_SESSION['useremail'])
    ){
     $loginmail=$_SESSION['useremail'];
    ?>


<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <title>Update Profile</title>
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

        .form-control{
            width: 50%;
            margin-bottom: 5px;
        }
        .submit-button{
            margin-top: 10px;
            color: white;
            background-color: black;
            color: white;
            width: 50%
        }
        .submit-button:hover{
            color: black;
            background-color: white;
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
        $selectquery="SELECT * FROM ct_group WHERE manager_email='$loginmail' ";
        $test=$conn->query($selectquery);
        $returned=$test->fetchAll();
        foreach($returned AS $ctgroupdata){
            
            $groupname=$ctgroupdata['group_name'];
            $managername=$ctgroupdata['manager_name'];
            $area=$ctgroupdata['working_area'];
            $experience=$ctgroupdata['experience'];
            $ratings=$ctgroupdata['ratings'];
            $activestatus=$ctgroupdata['active_status'];
            $worker=$ctgroupdata['total_worker'];
            $salary=$ctgroupdata['mason_salary'];
            $payment=$ctgroupdata['payment_system'];
            $contact=$ctgroupdata['manager_contact'];
            $bankaccount=$ctgroupdata['man_bank_account'];
            
            
        }
    ?>

    <div>
        <div class="container emp-profile">
            <form method="post">
                <div class="row">

                    <div class="col-md-6">
                        <div class="profile-head">
                            <h3>
                                <?php
                                echo $groupname;
                                ?>
                            </h3>
                            <h6>
                                <?php
                                echo $managername;
                                ?>
                            </h6>
                            <h5>Update Profile</h5>
                            <hr />
                        </div>
                    </div>

                </div>
            </form>
                <div class="updateform">
                    <form action="profileupdateprocess.php" method="POST">
                        <p>Just to Change Active status: </p>
                        <select name="newactivity" size="1">
                            <option value="Yes">Yes
                            <option value="No">No
                            </select>&nbsp;
                        <hr />
                        <p>Manger Name</p>
                        <input class="form-control" type="text" id="newmanagername" name="newmanagername" value="<?php echo $managername ?>" placeholder="Update Manager Name"  />
                        <hr />
                        <p>Manager Contact</p>
                        <input class="form-control" type="text" id="newmanagercontact" name="newmanagercontact"value="<?php echo $contact ?>" placeholder="Update Contact Number"  />
                        <hr />
                        <p>Manager Bank Account</p>
                        <input class="form-control" type="text" id="newbankac" name="newbankac" value="<?php echo  $bankaccount ?>" placeholder="Update Bank Account Number"  />
                        <hr />
                        <p>Working Area</p>
                        <input class="form-control" type="text" id="newarea" name="newarea" value="<?php echo $area ?>" placeholder="Update Working Area"  />
                        <hr />
                        <p>Experience</p>
                        <input class="form-control" type="text" id="newexperience" name="newexperience" value="<?php echo $experience ?>" placeholder="Update experience"  />
                        
                        
                        <hr />
                        <p>Mason Salary</p>
                        <input class="form-control" type="text" id="newsalary" name="newsalary" value="<?php echo $salary ?>" placeholder="Update Worker Number"  />
                        <hr />
                        <p>Worker Number</p>
                        <input class="form-control" type="text" id="newworker" name="newworker" value="<?php echo $worker ?>" placeholder="Update Worker Number"  />
                       
                        <hr />
                        <p>Want to change password?</p>
                        <input class="form-control" type="password" id="newcgpass" name="newcgpass" placeholder="Enter New Password" pattern="(?=.*\d)(?=.*[a-z]).{8,}" title="Must contain at least one number and lowercase letter, and at least 8 or more characters" />
                        <hr />
                        <p>Enter Your password to Complete Update: </p>
                        <input class="form-control" type="password" id="oldpass" name="oldpass" placeholder="Enter Password"  / required>
                        
                        <input class="submit-button" type="submit" value="Update" />
                        

                    </form>

                </div>
        </div>
    </div>

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
