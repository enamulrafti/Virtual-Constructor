<?php

if($_SERVER['REQUEST_METHOD']=="POST"){
    
    if(
        isset($_POST['cmmail']) &&
        isset($_POST['cmpass'])  &&
        
        !empty($_POST['cmmail']) &&
        !empty($_POST['cmpass'])
    )
    {
        $email=$_POST['cmmail'];
        $pass=$_POST['cmpass'];
        $enc_pass=md5($pass);
        
        ///tries to communicate with the database and store the data
        
        try{
            $conn=new PDO('mysql:host=localhost:3306;dbname=vcon;','root','');
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            
            //database code execute, default : warning generate
            $sqlquerystring="SELECT * FROM ct_group WHERE manager_email='$email' and password='$enc_pass'";
            
            ///executing the mysql code
            $returnobj=$conn->query($sqlquerystring);
            
            if($returnobj->rowCount()==1){
                ///login successful
                //saving login 
                session_start();
                $_SESSION['useremail']=$email;
                
                    ?>
                    <script>location.assign('profile.php')</script>
                    <?php
            }
            else{
                ///invalid user
                ?>
                <script>location.assign('login.php')</script>
                <?php
                }
        }
        catch (PDOException $ex){
            ?>
            <script>location.assign('login.php')</script>
            <?php
            }
    }
    else{
       
        ?>
<script>
    location.assign('login.php')

</script>
<?php
    }
}
else{
    ?>
<script>
    location.assign('login.php')

</script>
<?php
}
?>
