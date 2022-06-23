<?php
    session_start();
if(
    isset($_SESSION['usermail'])
    && !empty($_SESSION['usermail'])
    ){
     $loginmail=$_SESSION['usermail'];

if(
    isset($_SESSION['usermail'])
    && !empty($_SESSION['usermail'])
    ){
     $loginmail=$_SESSION['usermail'];

    if($_SERVER['REQUEST_METHOD']=="POST"){
        if(
       
        isset($_POST['u2']) &&
        isset($_POST['u3']) &&
        isset($_POST['u4']) &&

        !empty($_POST['u2']) &&
        !empty($_POST['u3']) &&
        !empty($_POST['u4']) 

            ){

           $agentid=$_POST['u2'];
           $groupid=$_POST['u3'];
            $details=$_POST['u4'];
        try{
            $con=new PDO('mysql:host=localhost:3306;dbname=vcon;', 'root','');
            $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            
            $idquery="SELECT id FROM user WHERE `email` ='$loginmail'" ;
            $test1=$con->query($idquery);
            $id_object=$test1->fetchAll();
            foreach($id_object AS $user){
                $userid=$user['id'];
            }
            
            $_SESSION['userid']=$userid;
            $codes= "INSERT INTO booking_req VALUES( NULL,$userid,$agentid,$groupid,DEFAULT,NOW(),'$details')";
            $con->exec($codes);

            ?>
            <script>location.assign('search.php')</script>
            <?php 



       }catch(PDOException $ex){
       	?>
<script>
    location.assign('profile.php')

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



}else{
  echo "<script>location.assign('signup.php')</script>"; 

}
}else{
            ?>
<script>
    location.assign('login.php')

</script>
<?php 
}
        }else{
              ?>
<script>
    location.assign('login.php')

</script>
<?php 
            
        }

?>
