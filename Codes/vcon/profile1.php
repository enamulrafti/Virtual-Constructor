<?php
    session_start();
    
if(  
    isset($_SESSION['useremail1'])
    && !empty($_SESSION['useremail1'])
    ){
        $data=$_SESSION['useremail1'];
    ?>
<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <title>Agent Profile</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        * {
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
        }

        body {
            padding-top: 50px;
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

        .form-outline {
            width: 80%;
        }

        .in {
            width: 40%;
        }

        .styled-table {

            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            font-family: sans-serif;
            min-width: 100%;
            box-shadow: 10px 10px 5px grey;
        }

        .styled-table th,
        .styled-table td {
            padding: 12px 15px;
        }

        .styled-table thead tr {
            background-color: #009879;
            color: #ffffff;
            text-align: left;
        }

        .styled-table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        .styled-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        .styled-table tbody tr:last-of-type {
            border-bottom: 2px solid #009879;
        }

        .buttons {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            width: 250px;
        }

    </style>
</head>

<body>
    <!--for navber-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="http://localhost/vcon/home1_out.php">VIRTUAL CONSTRUCTOR</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a class="nav-link active" href="http://localhost/vcon/logout.php">Logout</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="http://localhost/vcon/Profile1.php">Profile</a>
                    </li>


                </ul>

            </div>
        </div>
    </nav>

    <!--Whole profile-->
    <?php 
    
    try{
       $conn=new PDO('mysql:host=localhost:3306;dbname=vcon;','root','');
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $selectquery1="SELECT * FROM agent WHERE ins_email='$data' ";
        $test1=$conn->query($selectquery1);
        $returned=$test1->fetchAll();
        foreach($returned AS $agentdata){
            $agentname=$agentdata['ins_name'];
            $agentmail=$agentdata['ins_email'];
            $agentcontact=$agentdata['ins_contact'];
            $agentid=$agentdata['id'];
        }
        $_SESSION['agent_id']=$agentid;
        $_SESSION['agent_name']=$agentname;
        
    ?>

    <div>
        <div class="container emp-profile">
            <form method="post">
                <div class="row">

                    <div class="col-md-6">
                        <div class="profile-head">
                            <?php
                            if($agentid==1){
                                ?>
                            <p>Hello!</p>
                            <div>

                            </div>
                            <?php
                            } else{
                                ?>
                            <p>Hello! Agent</p>
                            <?php
                            }
                            ?>
                            <h3>
                                <?php
                                echo $agentname;
                                ?>
                            </h3>
                            <h5>
                                <?php
                                    if($agentid==1){
                                        ?>
                                Admin
                                <?php
                                    }else{
                                        echo $agentcontact;
                                    }
                                ?>
                            </h5>


                            <hr />
                        </div>
                    </div>
                    <?php 
                        if($agentid==1){
                            ?>
                    <div class="buttons">
                        <div>
                            <input type="button" class="profile-edit-btn" name="btnAddMore" value="Add Agent" onclick="window.location.href='http://localhost/vcon/addagent.php' " />
                        </div>
                           <div>
                            <input type="button" class="profile-edit-btn" name="btnAddMore" value="Assign Agent" onclick="window.location.href='http://localhost/vcon/assign_agent_admin.php' " />
                        </div>
                    </div>

                </div>
                <?php
                        } 
        
                    else{
                        ?>
                <div class="buttons">
                    <div>
                        <input type="button" class="profile-edit-btn" name="btnAddMore" value="Approval" onclick="window.location.href='http://localhost/vcon/booking_approval.php' " />
                    </div><br />
                    <div>
                        <input type="button" class="profile-edit-btn" name="btnAddMore" value="Report" onclick="window.location.href='http://localhost/vcon/agent_report.php' " />
                    </div><br />
                    <div>
                        <input type="button" class="profile-edit-btn" name="btnAddMore" value="Request" onclick="window.location.href='http://localhost/vcon/user_request.php' " />
                    </div><br />
                    <div>
                        <input type="button" class="profile-edit-btn" name="btnAddMore" value="Assigned" onclick="window.location.href='http://localhost/vcon/agentassigned.php' " />
                    </div>
                </div>


                <?php
                        
                    }
                ?>
                <?php
                        if($agentid==1){
                            ?>
                <div class="about" id="home">
                    <form method="POST">

                        <input type="text" class="in" name="search" autocomplete="off" placeholder="Enter Construction Group Name to search" />
                        <input type="submit" name="submit" value="Search" />
                    </form>
                    <?php
                        $conn=new PDO('mysql:host=localhost:3306;dbname=vcon;','root','');
                        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                            if(isset($_POST["submit"])){
                                $str=$_POST["search"];
                                $sth=$conn->prepare("SELECT * FROM ct_group WHERE group_name='$str' ") ;
                                
                                $sth->setFetchMode(PDO::FETCH_OBJ);
                                $sth->execute();
                                if($row=$sth->fetch()){
                                    ?>
                    <br /> <br />
                    <hr />

                    <table class="styled-table">
                        <thead>
                            <tr>
                                <th colspan="2">
                                    <form action="http://localhost/vcon/admin_del_process.php" class="delete" method="POST">
                                        <input type="hidden" name="del_id" value="<?php echo $row->id; ?>">
                                        <input type="submit" name="deleteuser" value="Delete" />
                                    </form>
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Group Name</td>
                                <td><?php echo $row->group_name; ?> </td>
                            </tr>
                            <tr class="active-row">
                                <td>Manager Name</td>
                                <td><?php echo $row->manager_name; ?> </td>
                            </tr>
                            <tr>
                                <td>Manager Email</td>
                                <td><?php echo $row->manager_email; ?> </td>
                            </tr>
                            <tr class="active-row">
                                <td>Manager Contact</td>
                                <td><?php echo $row->manager_contact; ?> </td>
                            </tr>
                            <tr>
                                <td>Bank Account</td>
                                <td><?php echo $row->man_bank_account; ?> </td>
                            </tr>

                        </tbody>
                    </table>
                    <?php
                                }
                                else{
                                    ?>
                    <hr />
                    <p>No data found</p>
                    <?php
                                    
                                }
                                
                            }
                            
                    ?>

                </div>


                <?php     
                        }
                        ?>
            </form>
        </div>
    </div>

    <?php
        }
    catch(PDOException $ex ){
        ?>
    <script>
        location.assign('home_out.php')

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
    location.assign('login.php')

</script>
<?php
}

?>
