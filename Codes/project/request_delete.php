<?php
    session_start();
if(
    isset($_SESSION['usermail'])
    && !empty($_SESSION['usermail'])
    ){

    if($_SERVER['REQUEST_METHOD']=="GET"){
        if(
       
        isset($_GET['hire_id']) &&
        !empty($_GET['hire_id']) 

            ){

           $del_id=$_GET['hire_id'];
        try{
            $con=new PDO('mysql:host=localhost:3306;dbname=vcon;', 'root','');
            $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            
            $del_query="DELETE FROM booking_req WHERE id='$del_id' ";
            $con->exec($del_query);

            ?>
<script>
    location.assign('request.php')

</script>
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
    location.assign('profile.php')

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

?>
