<?php
session_start();

if($_SERVER['REQUEST_METHOD']=="POST"){
    if(
        isset($_SESSION['usermail'])
        && !empty($_SESSION['usermail'])
    ){
            
            $newname=$_POST['uname'];
            $newaddress=$_POST['uaddress'];
            $newcontact=$_POST['ucontact'];
            $newbankac=$_POST['ubankac'];
          
            $newpass=$_POST['upass'];
            $oldpass=$_POST['oldpass'];
            $enc_oldpass=md5($oldpass);
            $enc_pass=md5($newpass);
  $loginmail=$_SESSION['usermail'];
       
        try{
            $conn=new PDO('mysql:host=localhost:3306;dbname=vcon;','root','');
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            
            $selectquery="SELECT * FROM user WHERE email='$loginmail' AND password='$enc_oldpass'";
            $returned=$conn->query($selectquery);

            if($returned->rowCount()==1){
                
                if(empty($newpass)){
                    
                    $querystr="UPDATE user SET user_name='$newname',contact_no='$newcontact',bank_account='$newbankac',address='$newaddress' WHERE email='$loginmail' AND password='$enc_oldpass'";
                    $conn->exec($querystr);
                ?>
            <script>location.assign('profile.php')</script>
                <?php 
                    
                } else{
                    
                    $querystr="UPDATE user SET user_name='$newname',contact_no='$newcontact',password='$enc_pass',bank_account='$newbankac', address='$newaddress' WHERE email='$loginmail' AND password='$enc_oldpass'";
                    $conn->exec($querystr);
                     ?>
                    <script>location.assign('profile.php')</script>
                    <?php
                    
            }
                }
            
            }
                catch (PDOException $ex ){
            ?>
            <script>location.assign('profile.php')</script>
            <?php
        }
            
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
