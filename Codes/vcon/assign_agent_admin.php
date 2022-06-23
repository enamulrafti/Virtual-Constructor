<?php
    session_start();

if(
    isset($_SESSION['useremail1'])
    && !empty($_SESSION['useremail1'])
    ){
     $loginmail=$_SESSION['useremail1'];
    ?>


<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <title>Assign Agent</title>
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
            background-color: black;
            color: white;
            width: 50%
        }

        .submit-button:hover {
            color: black;
            background-color: white;
        }

        .in_table {
            width: 100%;
        }
        .message{
            margin-top: 200px;
            text-align: center;
            color:gray;
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
        $selectquery="SELECT group_name AS g1,
                        manager_name AS g2,
                        manager_contact AS g3,
                        working_area AS g4,
                        id AS g5
                FROM ct_group
                WHERE agentid IS NULL";
        $test=$conn->query($selectquery);
        $returned=$test->fetchAll();
        if($test->rowCount()==0){
            ?>
            <div class="message">
            <h4>Whoops! seems like every Group have an agent.</h4>
            <img src="images/sad1.png" alt="sad" width="50" height="50">
            </div>
            <?php
        }
        else{
        foreach($returned AS $ctgroupdata){
            
            $groupname=$ctgroupdata['g1'];
            $managername=$ctgroupdata['g2'];
            $contact=$ctgroupdata['g3'];
            $area=$ctgroupdata['g4'];
            $ctid=$ctgroupdata['g5'];
        ?>
    <div>
        <div class="container emp-profile">
            <div class="updateform">
                <table class="in_table">
                    <tr>
                        <td>
                            <h4><?php echo  $groupname; ?></h4>
                            <h5>Working Area: <?php echo  $area ?> </h5>
                            <p><?php echo  $managername; ?> - <?php echo  $contact; ?> </p>
                        </td>
                        <td>
                            <?php
                        try{
                           $con=new PDO('mysql:host=localhost:3306;dbname=vcon;','root','');
                            $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 
                            $query1="SELECT id,ins_name, area FROM agent WHERE id!=1";
                            $test1=$con->query($query1) ;
                            $ret=$test1->fetchAll();
                            
                            ?>
                            
                            <form action="assign_agent_admin_process.php" method="POST">
                                
                                   <select name="u1" class="form-control">
                                    <?php 
                                foreach($ret AS $data){
                                ?>
                                    <option value="<?php echo $data['id'];?>">
                                       
                                    <?php echo $data['ins_name'];?>-<?php echo $data['area'];?>
                                    </option>
                                    <?php
                                }
                                ?>
                                </select>
                                
                                <input class="form-control" type="hidden" name="u2" value="<?php echo $ctid;?>" />
                                <input class="form-control" type="submit" value="Save" />
                            </form>

                           
                           
                            <?php
                                
                            }catch(PDOException $ex){
                            ?>
                            <script>
                                location.assign('profile1.php')

                            </script>
                            <?php
                            
                        }
                    ?>


                        </td>
                    </tr>

                </table>
            </div>
        </div>
    </div>

    <?php 
            }
        }
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
