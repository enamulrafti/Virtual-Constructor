<?php
    session_start();

if(
    isset($_SESSION['useremail'])
    && !empty($_SESSION['useremail'])
    ){
    ?>
    
<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <title>virtual constructor</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        * {
            margin: 0px;
            padding: 0px;
            box-sizing: border-box
        }

        .carousel-inner img {
            width: 100%;
            height: 100%;
        }

        .carousel-caption {
            position: absolute;
            top: 200px
        }
        h4{
            background-color: gray;
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
                        <a class="nav-link active" href="http://localhost/vcon/logout.php">Logout</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link active" href="http://localhost/vcon/profile.php">Profile</a>
                    </li>
                    
                   

                </ul>

            </div>
        </div>
    </nav>

    <!--for Home image-->
    <div id="demo" class="carousel slide" data-ride="carousel">

        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/bg3.png" alt="bg" width="1100" height="500">
                <div class="carousel-caption">
                    <h2 class="p-3 bg-secondary text-white align-top">Welcome To Virtual Constructor</h2>
                    <h4>We are always dedicated and devoted.</h4>
                </div>
            </div>

        </div>

    </div>

    <div>
        <footer>
            <p class="p-3 bg-dark text-white text-center">@virtualconstructor</p>
        </footer>
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
    location.assign('login.php')

</script>
<?php
}

?>
