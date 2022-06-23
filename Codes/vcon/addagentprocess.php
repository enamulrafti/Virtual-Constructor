<?php

if($_SERVER['REQUEST_METHOD']=="POST"){
    if(
        isset($_POST['aname']) &&
        isset($_POST['aemail']) &&
        isset($_POST['acontact']) &&
        isset($_POST['servearea']) &&
        isset($_POST['apass']) &&
        
        
        
        !empty($_POST['aname']) &&
        !empty($_POST['aemail']) &&
        !empty($_POST['apass']) &&
        !empty($_POST['servearea']) &&
        !empty($_POST['acontact'])
        
      ){
        $name=$_POST['aname'] ;
        $email=$_POST['aemail'];
        $password=$_POST['apass'];
        $contact=$_POST['acontact'];
        $area=$_POST['servearea'];
        
        
        try{
        $conn=new PDO('mysql:host=localhost:3306;dbname=vcon;','root','');
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            
            $sqlquerystring="INSERT INTO agent VALUES(NULL,'$name','$email','$password','$contact','$area')";
            $conn->exec($sqlquerystring);
            
            ?>
            <script>location.assign('addagent.php')</script>
            <?php
            
        } catch(PDOExption $ex){
               
            ?>
            <script>location.assign('profile1.php')</script>
            <?php
            }
        }
        else{
             session_start();
            $_SESSION["check"] =false;
        ?>
        
        <script>location.assign('addagent.php')</script>
        <?php
            }
        }
    else{

    ?>
<script>location.assign('signup.php')</script>
    <?php
}

?>
