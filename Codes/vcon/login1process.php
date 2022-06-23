<?php

if($_SERVER['REQUEST_METHOD']=="POST"){
    
    if(
        isset($_POST['amail']) &&
        isset($_POST['apass'])  &&
        
        !empty($_POST['amail']) &&
        !empty($_POST['apass'])
    )
    {
        $email=$_POST['amail'];
        $pass=$_POST['apass'];
        
        
        ///tries to communicate with the database and store the data
        
        try{
            $conn=new PDO('mysql:host=localhost:3306;dbname=vcon;','root','');
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            
            //database code execute, default : warning generate
            $sqlquerystring="SELECT * FROM agent WHERE ins_email='$email' and password='$pass'";
            
            ///executing the mysql code
            $returnobj=$conn->query($sqlquerystring);
            
            if($returnobj->rowCount()==1){
                ///login successful
                //saving login 
                session_start();
                $_SESSION['useremail1']=$email;
                
                ?>
<script>
    location.assign('profile1.php')

</script>
<?php
            }
            else{
                ///invalid user
                ?>
<script>
    location.assign('login1.php')

</script>
<?php
            }
        }
        catch (PDOException $ex){
            ?>
<script>
    location.assign('login1.php')

</script>
<?php
        }
    }
    else{
        ?>
<script>
    location.assign('login1.php')

</script>
<?php
    }
}
else{
    ?>
<script>
    location.assign('login1.php')

</script>
<?php
}
?>
