<?php

if($_SERVER['REQUEST_METHOD']=="POST"){
    if(
        isset($_POST['cgname']) &&
        isset($_POST['cmname']) &&
        isset($_POST['cmmail']) &&
        isset($_POST['cpass']) &&
        isset($_POST['cmcontact']) &&
        isset($_POST['cmbankac']) &&
        isset($_POST['area']) &&
        isset($_POST['exp']) &&
        isset($_POST['worker']) &&
        isset($_POST['salary']) &&
        isset($_POST['cmbank']) &&
        
        !empty($_POST['cgname']) &&
        !empty($_POST['cmname']) &&
        !empty($_POST['cmmail']) &&
        !empty($_POST['cpass']) &&
        !empty($_POST['cmcontact']) &&
        !empty($_POST['cmbankac']) &&
        !empty($_POST['area']) &&
        !empty($_POST['exp']) &&
        !empty($_POST['worker']) &&
        !empty($_POST['salary']) &&
        !empty($_POST['cmbank'])
        
      ){
        $groupname=$_POST['cgname'] ;
        $managername=$_POST['cmname'];
        $mail=$_POST['cmmail'];
        $password=$_POST['cpass'];
        $contact=$_POST['cmcontact'];
        $bankac=$_POST['cmbankac'];
        $bank=$_POST['cmbank'];
        $area=$_POST['area'];
        $exp=$_POST['exp'];
        $worker=$_POST['worker'];
        $salary=$_POST['salary'];

        $enc_pass=md5($password);
        try{
        $conn=new PDO('mysql:host=localhost:3306;dbname=vcon;','root','');
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
//            $selectquery="SELECT id FROM agent WHERE id!=1 AND area LIKE '%$area%' ORDER BY RAND() LIMIT 1";
//            
//            $test=$conn->query($selectquery);
//            $returnobj= $test->fetchAll();
//            foreach($returnobj AS $data){
//                $agentid=$data['id'];
//            }
            $sqlquerystring="INSERT INTO ct_group VALUES (NULL,NULL,'$groupname','$managername','$mail','$contact','$enc_pass','$bankac','$area','$exp',DEFAULT,'Yes','$worker','$salary',DEFAULT,'$bank')";
            $conn->exec($sqlquerystring);
             ?>
            <script>location.assign('login.php')</script>
            <?php
            
        } catch(PDOException $ex){
            ?>
            <script>location.assign('signup.php')</script>
            <?php
            }
        }
        else{
        ?>
        <script>location.assign('signup.php')</script>
        <?php
            }
        }
    else{

    ?>
<script>location.assign('signup.php')</script>
    <?php
}

?>
