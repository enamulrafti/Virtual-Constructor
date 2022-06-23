<?php
    session_start();

if(
    isset($_SESSION['usermail']) && 
    isset($_SESSION['userid']) &&
    !empty($_SESSION['usermail']) &&
    !empty($_SESSION['userid'])
    ){
     $loginmail=$_SESSION['usermail'];
    $loginid=$_SESSION['userid'];
    
if($_SERVER['REQUEST_METHOD']=="POST"){
	if(isset($_POST['u1']) && 
	   isset($_POST['u2']) && 
	   isset($_POST['u3']) &&
       isset($_POST['u4']) && 
       isset($_POST['u5']) && 


	  !empty($_POST['u1']) && 
	  !empty($_POST['u2']) &&
	  !empty($_POST['u3']) &&
        !empty($_POST['u4']) &&
        !empty($_POST['u5'])
   ){  
		$pdays=$_POST['u1'];  
	    $wroker=$_POST['u2'];
	    $bank=$_POST['u3'];
        $txn=$_POST['u4'];  
        $amount=$_POST['u5'];
	   
	    try{
	    	 $con=new PDO('mysql:host=localhost:3306;dbname=vcon;', 'root',''); 
	    	 $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $codes1="SELECT b.ct_groupid AS x
                    FROM user AS u
                        LEFT JOIN 
                        booking_req AS b
                        ON u.id=b.userid
                        WHERE u.id=$loginid";
            $test=$con->query($codes1);
            $return=$test->fetchAll();
            foreach($return AS $a){
                $ctid=$a['x'];
            }
            
            
	    	 $codes= "INSERT INTO  payments VALUES( NULL,$loginid,$ctid,$pdays,'$txn',$wroker,NOW(),'$bank',$amount)";
	    	 $con->exec($codes); 
	    	 ?>
       	<script>location.assign('payment.php')</script>
       	<?php 



       }catch(PDOException $e){
       	?>
       	<script>location.assign('profile.php')</script>
       	<?php 

       }

	}  
	else{
		?> 
		<script>location.assign('payment.php')</script>
		<?php

	}



}else{
  echo "<script>location.assign('login.php')</script>"; 

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
    