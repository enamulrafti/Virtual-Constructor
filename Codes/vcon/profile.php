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
    <title>group profile</title>
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

        .profile-edit-btn {
            border: none;
            border-radius: 1.5rem;
            width: 70%;
            padding: 2%;
            font-weight: 600;
            color: white;
            background-color: black;
            cursor: pointer;
        }

        .profile-edit-btn:hover {
            background-color: white;
            color: black;
        }

        .proile-rating {
            font-size: 12px;
            color: black;
            margin-top: 5%;
        }

        .proile-rating span {
            color: #495057;
            font-size: 15px;
            font-weight: 600;
        }

        .buttons {
            width: 250px;
        }

    </style>
</head>

<body>
    <!--for navber-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
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
            $loginid=$ctgroupdata['id'];
            $groupname=$ctgroupdata['group_name'];
            $managername=$ctgroupdata['manager_name'];
            $area=$ctgroupdata['working_area'];
            $experience=$ctgroupdata['experience'];
            $ratings=$ctgroupdata['ratings'];
            $activestatus=$ctgroupdata['active_status'];
            $worker=$ctgroupdata['total_worker'];
            $salary=$ctgroupdata['mason_salary'];
            $payment=$ctgroupdata['payment_system'];
            $agentid=$ctgroupdata['agentid'];
        }
        $_SESSION['loginid']=$loginid;
        
        
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
                            <hr />
                            <p>Agent</p>
                            <?php
                                if(is_null($agentid)==1){
                                    ?>
                                    <h4>Admin will assign soon!</h4>
                                    <?php
                                }else{
                                    
                                   try{
                                       $selectquery1="SELECT * FROM agent WHERE id='$agentid' ";
                                    $test1=$conn->query($selectquery1);
                                    $returned1=$test1->fetchAll();
                                    foreach($returned1 AS $agentdata){
                                        $agentname=$agentdata['ins_name'];
                                        $agentcontact=$agentdata['ins_contact'];
                                    }
                                
                                   ?> 
                                <div class="agent">
                                <h5>
                                    <?php
                                echo $agentname;
                                ?>
                                </h5>
                                <h6>
                                    <?php
                                echo $agentcontact;
                                ?>
                                </h6>
                            </div>
                            <?php
                                   }catch(PDOException $ex){
                                       ?>
                                       <script> location.assign('profile')</script>
                                       <?php
                                   }
                                }
                            ?>
                               
                                
                            
                            
                            
                            <hr />
                            <p class="proile-rating">Availabe: <span>
                                    <?php
                                echo $activestatus;
                                ?></span></p>
                            <h5>About</h5>
                            <hr />
                        </div>
                    </div>
                    <div class="buttons">
                        <div>
                            <input type="button" class="profile-edit-btn" name="btnAddMore" value="Edit Profile" onclick="window.location.href='http://localhost/vcon/profileupdate.php' " />
                        </div> <br />
                        <div>
                            <input type="button" class="profile-edit-btn" name="btnAddMore" value="Works" onclick="window.location.href='http://localhost/vcon/construction_works.php' " />
                        </div>
                    </div>
                </div>

                <div class="about" id="home">
                    <div class="row">
                        <div class="col">
                            <label>Working Area</label>
                        </div>
                        <div class="col">
                            <p>
                                <?php
                                echo $area;
                                ?>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label>Experience</label>
                        </div>
                        <div class="col">
                            <p>
                                <?php
                                echo $experience;
                                ?>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label>Ratings</label>
                        </div>
                        <div class="col">
                            <p>
                                <?php
                                echo $ratings;
                                echo "/5"
                                ?>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label>Total Worker</label>
                        </div>
                        <div class="col">
                            <p>
                                <?php
                                echo $worker;
                                ?>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label>Mason Salary</label>
                        </div>
                        <div class="col">
                            <p>
                                <?php
                                echo $salary;
                                ?>
                                Taka Per Day</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label>Payment taking</label>
                        </div>
                        <div class="col">
                            <p>Daily</p>
                        </div>
                    </div>


                </div>
            </form>
        </div>
    </div>

    <?php
        }
        catch(PDOException $ex){
        ?>
            <script>location.assign('home1_out.php')</script>
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
