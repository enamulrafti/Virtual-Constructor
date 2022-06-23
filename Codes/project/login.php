<!DOCTYPE html>
<html lang="en">

<head>
    <title>Customer Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    
    <style>
        body{
            background-color: aliceblue;
        }
        .form_ {
            margin-top: 70px;
            width: 600px;
            background-color:black;
            color: white;
            padding: 50px;
             margin: auto;
        }

    </style>
</head>

<body>

    <nav class="navbar navbar-inverse ">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="http://localhost/project/home.php">VIRTUAL CONSTRUCTOR</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="http://localhost/project/login.php">Login</a></li>
                <li><a href="http://localhost/project/signup.php">Sign Up</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="form_">
            <h4>User Login</h4>
            <form action="logpross.php" method="POST">

                <div class="form-group">
                    <label for="u2">Email</label>
                    <input type="email" class="form-control" id="u2" name="u2" placeholder="Enter Email">
                </div>
                <div class="form-group">
                    <label for="u2">Password</label>
                    <input type="password" class="form-control" id="u4" name="u4" placeholder="Enter Password">
                </div>

                <input type="submit" class="btn btn-primary" value="login">
             
            </form>

        </div>



    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</body>

</html>
