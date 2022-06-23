<?php
    session_start();

if(
    isset($_SESSION['useremail1']) &&
    isset($_SESSION['agent_id']) &&
    isset($_SESSION['agent_name']) &&
    !empty($_SESSION['useremail1']) &&
    !empty($_SESSION['agent_id']) &&
    !empty($_SESSION['agent_name'])
    ){
    $loginmail=$_SESSION['useremail1'];
    $loginid=$_SESSION['agent_id'];
    $loginname=$_SESSION['agent_name'];
    ?>


<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <title>booking request</title>
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
            background-color: cornflowerblue;
            width: 50%
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

        .button_th {
            display: flex;
            justify-content: flex-end;
        }
        .back {
            display: block;
            text-align: center;
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
        $selectquery="SELECT * FROM booking_req WHERE agentid='$loginid' AND status='pending' ";
        $test=$conn->query($selectquery);
        $returned=$test->fetchAll();
    ?>
    <div>
        <div class="container emp-profile">
            <h4>Booking Request From Customer:</h4>
            <table class="styled-table">
                <thead>
                    <tr>
                        <th> Agent:
                            <?php echo $loginname;?>
                        </th>
                        <th> Agent Mail:
                            <?php echo $loginmail;?>
                        </th>

                    </tr>
                </thead>
            </table>
            <?php
        foreach($returned AS $bookdata){
            $book_id=$bookdata['id'];
            $user_id=$bookdata['userid'];
            $ctgroup_id=$bookdata['ct_groupid'];
            $date=$bookdata['date'];
            $details=$bookdata['details'];
            
            $_SESSION['book_id']=$book_id;
            
        $ctgroup_query="SELECT * FROM ct_group WHERE id='$ctgroup_id'" ;
        $user_query="SELECT * FROM user WHERE id='$user_id' ";
        $test_ctgroup=$conn->query($ctgroup_query);
        $test_user=$conn->query($user_query);   
        $returned_ctgroup=$test_ctgroup->fetchAll();
        $returned_user=$test_user->fetchAll();
            foreach($returned_ctgroup AS $group_data){
                $group_name=$group_data['group_name'];
                $group_manager=$group_data['manager_name'];
                $group_active=$group_data['active_status'] ;
            }
            foreach($returned_user AS $user_data){
                $user_name=$user_data['user_name'];
                $user_contact=$user_data['contact_no'];
                $user_address=$user_data['address'];
                
            }
     ?>
            <table class="styled-table">
                <thead>
                    <tr>
                        <th colspan="3">
                            <div class="button_th">
                                    
                                <input type="button" value="Deny" onclick="approval(<?php echo $book_id ?>,'0');" />

                                <input type="button" value="Approve" onclick="approval(<?php echo $book_id ?>,'1');" />
                            </div>
                        </th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Customer</td>
                        <td> </td>
                        <td>Construction Group</td>
                    </tr>
                    <tr class="active-row">
                        <td>
                            Name: <?php echo $user_name; ?> <br />
                            Contact: <?php echo $user_contact; ?> <br />
                            Address: <?php echo $user_address; ?> <br />
                            Details: <?php echo $details; ?>
                        </td>
                        <td>Request to hire</td>
                        <td>
                            Name: <?php echo $group_name; ?> <br />
                            Manager: <?php echo $group_manager; ?> <br />
                            Active: <?php echo $group_active; ?>
                        </td>
                    </tr>

                </tbody>
            </table>

            <?php
            
    }
                                

            ?>
        </div>
        <a href="http://localhost/vcon/profile1.php" class="back">Back</a>
    </div>
    <?php  
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
    <script>
        function approval(id,str) {
            location.assign('approval_process.php?book='+id+'&eve='+str);
        }

    </script>
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
