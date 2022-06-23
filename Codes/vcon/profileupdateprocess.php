<?php
session_start();
if($_SERVER['REQUEST_METHOD']=="POST"){
    if(
        isset($_SESSION['useremail'])
        && !empty($_SESSION['useremail'])
    ){
        
            $newactivity=$_POST['newactivity'] ;
            $newmanagername=$_POST['newmanagername'];
            $newmanagercontact=$_POST['newmanagercontact'];
            $newbankac=$_POST['newbankac'];
            $newarea=$_POST['newarea'];
            $newexp=$_POST['newexperience'];
            $newsalary=$_POST['newsalary'];
            $newworkerno=$_POST['newworker'];
            $newpas=$_POST['newcgpass'];
            $encoded_newpass=md5($newpas);
            $oldpass=$_POST['oldpass'];
            $enc_oldpass=md5($oldpass);
        
            $email=$_SESSION['useremail'];
           
        
//        echo $newactivity; echo "\n";
//        echo $newmanagername; echo "\n";
//        echo $newmanagercontact; echo "\n";
//        echo $newbankac; echo "\n";
//        echo $newarea; echo "\n";
//        echo $newexp; echo "\n";
//        echo $newsalary; echo "\n";
//        echo $newworkerno; echo "\n";
//        echo $newpas; echo "\n";
        try{
            $conn=new PDO('mysql:host=localhost:3306;dbname=vcon;','root','');
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $selectquery="SELECT * From ct_group WHERE manager_email='$email' and password='$enc_oldpass'";
            $returned=$conn->query($selectquery);

            if($returned->rowCount()==1){
                
                if(empty($newpas)){
                    
                    $querystr="UPDATE ct_group SET manager_name='$newmanagername',manager_contact='$newmanagercontact',man_bank_account='$newbankac',working_area='$newarea',experience='$newexp',active_status='$newactivity',total_worker='$newworkerno',mason_salary='$newsalary' WHERE manager_email='$email' AND password='$enc_oldpass'";
                    $conn->exec($querystr);
                ?>
                    <script>
                        location.assign('profile.php')

                    </script>
                    <?php 
                    
                } else{
                    
                    $querystr="Update ct_group SET manager_name='$newmanagername', password='$encoded_newpass',manager_contact='$newmanagercontact',man_bank_account='$newbankac',working_area='$newarea',experience='$newexp',active_status='$newactivity',total_worker='$newworkerno',mason_salary='$newsalary' WHERE manager_email='$email' AND password='$enc_oldpass' ";
                    $conn->exec($querystr);
                     ?>
                    <script>
                        location.assign('profile.php')

                    </script>
                    <?php
                    
            }
                }
            
            }
        catch (PDOException $ex ){
            ?>
<script>
    location.assign('profile.php')

</script>
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
