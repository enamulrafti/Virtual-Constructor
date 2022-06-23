<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <title>Agent Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        * {
            margin: 0px;
            padding: 0px;
            box-sizing: border-box
        }

        .navbar {
            margin-bottom: 50px;
        }

        body {
            background-color: azure;
        }

        h3 {
            text-align: center;
        }
        

        .btn-primary,
        .btn-primary:active {
            width: 100%;
            
            background-color:black!important;
        }
        .btn-primary:hover{
            background-color:White !important;
            color: black !important;
        }
        .btn-primary:visited{
            background-color: forestgreen;
        }

        #cont {
            border-radius: 24px;
            padding: 70px 50px 20px 50px;
            border: 5px;
            background-color: beige;
            box-shadow: 10px 10px 5px grey;

        }
        .back {
            display: block;
            color: gray;
            text-align: center;
        }

    </style>
</head>

<body>
    <!--for navber-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="http://localhost/vcon/home.php">VIRTUAL CONSTRUCTOR</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a class="nav-link active" href="http://localhost/vcon/login1.php">Login</a>
                    </li>
               
                </ul>
                
            </div>
        </div>
    </nav>
    
    
<!--SignUp form-->

    <div class="w-50 m-auto" id="cont">
        <h3>Login As Agent</h3>
<!--
        <div>
            <a class="anc" href="http://localhost/vcon/login.php">
                <button class="btn btn-primary">Click for construction group login</button>
            </a>
        </div>
-->
        <form action="login1process.php" method="POST">

            <div class="form-group">
                <label for="amail">Email</label>
                <input type="email" id="amail" name="amail" autocomplete="off" class="form-control">
            </div>
            <div class="form-group">
                <label for="apass">Password</label>
                <input type="password" id="apass" name="apass" autocomplete="off" class="form-control">
            </div>


            <button type="submit" name="login" class="btn btn-primary">Login</button>
            <br /> <br />
            <a href="http://localhost/vcon/home.php" class="back">Back</a>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>


</html>
