<?php
session_start();
if(
    isset($_SESSION['useremail1'])
    && !empty($_SESSION['useremail1'])
    ){
    if($_SERVER['REQUEST_METHOD']=="POST"){
            if(
        
        isset($_POST['del_id']) &&
        !empty($_POST['del_id'])
        
      ){

        $key_id=$_POST['del_id'];
        
        
        try{
        $conn=new PDO('mysql:host=localhost:3306;dbname=vcon;','root','');
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            
            $sqlquerystring="DELETE FROM ct_group WHERE id='$key_id' ";
            $conn->exec($sqlquerystring);
            
                    ?>
                <script>location.assign('profile1.php')</script>
                    <?php
            
        } catch(PDOExption $ex){
               
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

}
else{
    ?>
<script>
    location.assign('login1.php')

</script>
<?php
}
?>
