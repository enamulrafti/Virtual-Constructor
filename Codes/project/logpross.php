<?php 
if($_SERVER['REQUEST_METHOD']=="POST"){
	if( 
	   isset($_POST['u2']) && 
       isset($_POST['u4']) &&
	   !empty($_POST['u2']) &&
	   !empty($_POST['u4'])
	 
   ){  
	
	
	    $email=$_POST['u2'];
        $pass=$_POST['u4'];  
        $enc_pass=md5($pass);
	    //user_name	email	contact_no	password	bank_account	address


	    try{
	    	 $con=new PDO('mysql:host=localhost:3306;dbname=vcon;', 'root',''); 
	    	 $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            
	    	 $codes= "SELECT * FROM user WHERE email='$email' and password='$enc_pass'"; 
	    	 $ret=$con->query($codes); 
            $obj=$ret->fetchAll();
            
              if($ret->rowCount()==1){
             session_start();  
                  
            $_SESSION['usermail']=$email;
                  
                  foreach($obj AS $data){
                      $userid=$data['id'];
                  }
            $_SESSION['userid']=$userid;
//            echo $userid; 
//        echo $_SESSION['userid']; 
             
           ?>
<script>
       
    location.assign('profile.php')

</script>
<?php 


              } else{
              	 ?>
<script>
    location.assign('login.php')

</script>
<?php 

              }

//jodi thik thak taky taholy login ay jaby
	    	 ?>
<script>
location.assign('login.php')

</script>
<?php 

       }catch(PDOException $e){
       	?>
<script>
    location.assign('signup.php')

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
  echo "<script>location.assign('login.php')</script>"; //bahirer ta "" holy vitory '' & viceversa
  
}
?>
