<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <title>Sign up</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
        body {
            background-color: aliceblue;
        }

        .cont {
            margin-top: 50px;
            width: 600px;
            background-color:black;
            color: white;
            padding: 50px;
            margin: auto;
        }
        .bt{
            color: black;
        }

    </style>
</head>

<body>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="http://localhost/project/home.php">VIRTUAL CONSTRUCTOR</a>
            </div>
            <ul class="nav navbar-nav">
               <li><a href="http://localhost/project/login.php">Login</a></li>
                <li class="active"><a href="http://localhost/project/signup.php">Sign Up</a></li>
                

            </ul>
        </div>
    </nav>

    <div class="cont">
           <h4>User signup</h4>

            <form action="reg.php" method="POST">
                <div class="form-group">
                <label for="u1">User Name: </label>
                <input type="name" class="form-control" id="u1" name="u1" placeholder="Enter Your Name">
                </div>
                
                <div class="form-group">
                <label for="u2">Email: </label>
                <input type="email" class="form-control" id="u2" name="u2"  placeholder="Enter Your Email here" title="Give Valid Email">
                </div>

               <div class="form-group">
                <label for="u3">Mobile Number: </label>
                <input type="tel" class="form-control" id="u3" name="u3" placeholder="Enter Your Mobile Number">
                </div>
                
               
                <div class="form-group">
                <label for="u5">Bank Account: </label>
                <input type="number" class="form-control" id="u5" name="u5" placeholder="Enter Bank Account">
                </div>
                
                <div class="form-group">
                <label for="u6">Address: </label>
                <input type="text" class="form-control" id="u6" name="u6" placeholder="Enter Address">
                </div>
                
                 <div class="form-group">
                <label for="u4">Password: </label>
                <input type="password" class="form-control" id="u4" name="u4" placeholder="Enter Password">
                </div>

                
                <input type="submit" class="bt" value="Click to Signup">
                <br>
            </form>



    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</body>


</html>

