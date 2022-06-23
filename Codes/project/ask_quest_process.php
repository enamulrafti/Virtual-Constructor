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
                  !empty($_POST['u1']) 	
                    ){  
		      $q=$_POST['u1'];  
	    try{
	    	 $con=new PDO('mysql:host=localhost:3306;dbname=vcon;', 'root',''); 
	    	 $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            
                $codes1="SELECT agentid AS u2
                        FROM booking_req 
                        WHERE userid=$loginid AND status='Approved'";
                $test=$con->query($codes1);
                $obj=$test->fetchAll();
                foreach($obj AS $data){
                    $aid=$data['u2'];
                }
            
	    	 $codes= "INSERT INTO user_questions VALUES(NULL,$loginid,$aid,'$q',NOW(),DEFAULT)";
	    	 $con->exec($codes); 
	    	 ?>
            <script>
                location.assign('ask_quest.php')

            </script>
        <?php 

        }catch(PDOException $e){
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

