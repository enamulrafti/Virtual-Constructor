<?php
    session_start();
    @$check=$_SESSION["check"];
if(
    isset($_SESSION['useremail1'])
    && !empty($_SESSION['useremail1'])
    ){
    ?>


<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <title>add Agent</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        * {
            margin: 0px;
            padding: 0px;
            box-sizing: border-box
        }

        /*
        .navbar {
            margin-bottom: 50px;
        }
*/

        body {
            padding-top: 100px;
            background-color: azure;
        }

        h3 {
            text-align: center;
        }

        #cont {
            border-radius: 24px;
            padding: 70px 50px 20px 50px;
            border: 5px;
            background-color: beige;
            box-shadow: 10px 10px 5px grey;

        }

    </style>
</head>

<body>
    <!--for navber-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="http://localhost/vcon/home.php">VIRTUAL CONSTRUCTOR</a>
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
    <!--SignUp form-->

    <div class="w-50 m-auto" id="cont">
        <h3>Add Agent Form</h3>
        <form action="addagentprocess.php" method="POST">
            <div class="form-group">
                <label for="cgname">Agent Name</label>
                <input type="text" id="aname" name="aname" autocomplete="off" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="aemail">Agent Mail</label>
                <input type="text" id="aemail" name="aemail" autocomplete="off" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="acontact">Agent Contact No</label>
                <input type="text" id="acontact" name="acontact" autocomplete="off" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="servearea">Agent Serving Area</label>
                <input type="text" id="servearea" name="servearea" autocomplete="off" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="apass">Agent Password</label>
                <input type="password" id="apass" name="apass" autocomplete="off" class="form-control" required>
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

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
