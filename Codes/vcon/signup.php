<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <title>Sign Up</title>
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
                        <a class="nav-link active" href="http://localhost/vcon/login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="http://localhost/vcon/signup.php">Sign Up</a>
                    </li>

                </ul>
 
            </div>
        </div>
    </nav>

    <!--SignUp form-->

    <div class="w-50 m-auto" id="cont">
        <h3>Construction Group Sign Up</h3>
        
        <form action="signup_proc.php" method="POST">
            <div class="form-group">
                <label for="cgname">Group Name</label>
                <input type="text" id="cgname" name="cgname" autocomplete="off" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="cmname">Manager Name</label>
                <input type="text" id="cmname" name="cmname" autocomplete="off" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="cmmail">Manager Email</label>
                <input type="email" id="cmmail" name="cmmail" autocomplete="off" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="cpass">Password</label>
                <input type="password" id="cpass" name="cpass" autocomplete="off" class="form-control" pattern="(?=.*\d)(?=.*[a-z]).{8,}" title="Must contain at least one number and lowercase letter, and at least 8 or more characters" required>
            </div>
            <div class="form-group">
                <label for="cmcontact">Manager Contact No.</label>
                <input type="text" id="cmcontact" name="cmcontact" autocomplete="off" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="cmbankac">Manager Bank Account No.</label>
                <input type="text" id="cmbankac" name="cmbankac" autocomplete="off" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="cmbank">Bank Name</label>
                <input type="text" id="cmbankcmbank" name="cmbank" autocomplete="off" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="area">Wroking Area</label>
                <input type="text" id="area" name="area" autocomplete="off" class="form-control">
            </div>
            <div class="form-group">
                <label for="exp">Working Experience</label>
                <input type="text" id="exp" name="exp" autocomplete="off" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="worker">Total Worker</label>
                <input type="text" id="worker" name="worker" autocomplete="off" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="salary">Mason Salary</label>
                <input type="text" id="salary" name="salary" autocomplete="off" class="form-control" required>
            </div>
<!--
            <div class="form-group">
                <label for="pay">Payment System</label>
                <input type="text" id="pay" name="pay" placeholder="Daily" autocomplete="off" class="form-control" required>
            </div>
-->

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>


</html>
