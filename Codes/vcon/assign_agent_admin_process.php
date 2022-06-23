<?php
session_start();

    if(     isset($_SESSION['useremail1'])
        && !empty($_SESSION['useremail1']) ){
        
            if($_SERVER['REQUEST_METHOD']=="POST"){
                
            $aid=$_POST['u1'];
            $ctid=$_POST['u2'];
            
                try{
                    
                    $conn=new PDO('mysql:host=localhost:3306;dbname=vcon;','root','');
                    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                    
                    $query1="UPDATE ct_group SET agentid =$aid WHERE id =$ctid";
                    $conn->exec($query1);
                    ?>
                    <script>location.assign('assign_agent_admin.php')</script>
                    <?php
                }catch(PDOException $ex){
                    ?>
                    <script>location.assign('assign_agent_admin.php')</script>
                    <?php
                }
            
        
            
        }else{
              ?>
                <script> location.assign('profile1.php')</script>
                <?php   
                    
            }
    
        
    }
else{
    ?>
    <script> location.assign('login1.php')</script>
    <?php
}

?>
