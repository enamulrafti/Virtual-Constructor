<?php 
    session_start();

if(
    isset($_SESSION['usermail'])
    && !empty($_SESSION['usermail'])
    ){
     $loginmail=$_SESSION['usermail'];
    
        if($_SERVER['REQUEST_METHOD']=="POST"){
                if(isset($_POST['u1']) && 
                   isset($_POST['u2']) && 
                   isset($_POST['u3']) &&

                   isset($_POST['u4']) && 


                  !empty($_POST['u1']) && 
                  !empty($_POST['u2']) &&
                  !empty($_POST['u3']) &&
                !empty($_POST['u4'])
       
   ){  
      
		$type=$_POST['u1'];  
	    $days=$_POST['u2'];
	    $cost=$_POST['u3'];
        $txn=$_POST['u4'];  
	   
	    try{
	    	 $con=new PDO('mysql:host=localhost:3306;dbname=vcon;', 'root',''); 
	    	 $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            
                $query1="SELECT id FROM packages WHERE type='$type'";
                $query2="SELECT id FROM user WHERE `email` ='$loginmail'";
                
                
            $test2=$con->query($query2);
            $returnobj2=$test2->fetchAll();
            foreach($returnobj2 AS $udata){
                $uid=$udata['id'];
            }
            
            $test1=$con->query($query1);
            $returnobj1=$test1->fetchAll();
            foreach($returnobj1 AS $pdata){
                $pid=$pdata['id'];
            }
            
            $query3="SELECT b.agentid AS aid FROM booking_req AS b WHERE userid=$uid AND status='Approved'";
            
            $test3=$con->query($query3);
            $returnobj3=$test3->fetchAll();
            foreach($returnobj3 AS $bdata){
                $aid=$bdata['aid'];
            }
            
	    	 $codes= "INSERT INTO package_pay VALUES( NULL,$uid,$aid,$pid,$cost,NOW(),NOW(),DATE_ADD(NOW(),INTERVAL $days DAY),1,'$txn',$days)";
            
	    	 $con->exec($codes); 
            
	    	 ?>
<script>
    location.assign('monitor.php')

</script>
<?php 



       }catch(PDOException $e){
            
       	?>
<script>
    location.assign('monitor.php')

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
  echo "<script>location.assign('signup.php')</script>"; //bahirer ta "" holy vitory '' & viceversa
  //jodi post ay data pass na kory taholy abr back korabo signup page ay

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
