<?php
session_start();
if(
    isset($_SESSION['useremail1'])
    && !empty($_SESSION['useremail1'])
    ){
    if($_SERVER['REQUEST_METHOD']=="POST"){
            if(
        
        isset($_POST['pid']) &&
        isset($_POST['details']) &&
        isset($_POST['attach']) &&
        isset($_POST['uid']) &&
        isset($_POST['aid']) &&
        isset($_POST['t']) &&
        
        
        !empty($_POST['pid']) &&
        !empty($_POST['details']) &&
        !empty($_POST['attach']) &&
        !empty($_POST['uid']) &&
        !empty($_POST['aid']) &&
        !empty($_POST['t'])
        
      ){
        
        $package_payid=$_POST['pid'];
        $content=$_POST['details'];
        $file=$_POST['attach'];
        $user_id=$_POST['uid'];
        $agent_id=$_POST['aid'];
        $title=$_POST['t'];
        
        
        try{
        $conn=new PDO('mysql:host=localhost:3306;dbname=vcon;','root','');
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            
            $sqlquerystring="INSERT INTO reports VALUES(NULL,$package_payid,'$content',NOW(),'$file',$user_id,$agent_id,'$title')";
            $conn->exec($sqlquerystring);
            
                    ?>
                <script>location.assign('agent_report.php')</script>
                    <?php
            
        } catch(PDOExption $ex){
               
            ?>
<script>
    location.assign('agent_report.php')

</script>
<?php
            }
        }
        else{
        ?>

<script>
    location.assign('agent_report_display.php')

</script>
<?php
            }
        }
    else{

    ?>
<script>
    location.assign('profile1.php')

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
