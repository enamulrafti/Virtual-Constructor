<?php
    session_start();
if(
    isset($_SESSION['useremail']) &&
    !empty($_SESSION['useremail'])
 
    ){
    unset($_SESSION['useremail']);
    session_destroy();
    ?>
    <script>location.assign('login.php')</script>
    <?php
}
elseif(
    isset($_SESSION['useremail1']) &&
    !empty($_SESSION['useremail1'])
 
    ){
    unset($_SESSION['useremail1']);
    session_destroy();
    ?>
    <script>location.assign('login1.php')</script>
    <?php
}
else{
    ?>
    <script>location.assign('login.php')</script>
    <?php
}

?>