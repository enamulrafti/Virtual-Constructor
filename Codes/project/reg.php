<?php 
if($_SERVER['REQUEST_METHOD']=="POST"){
	if(isset($_POST['u1']) && 
	   isset($_POST['u2']) && 
	   isset($_POST['u3']) &&

       isset($_POST['u4']) && 
	   isset($_POST['u5']) && 
	   isset($_POST['u6']) &&


	  !empty($_POST['u1']) && 
	  !empty($_POST['u2']) &&
	  !empty($_POST['u3']) &&


	  !empty($_POST['u4']) && 
	  !empty($_POST['u5']) &&
	  !empty($_POST['u6']) 	
   ){  
		//long name call kora pera ti store korlm short name diya
      
		$name=$_POST['u1'];  
	    $email=$_POST['u2'];
	    $cont=$_POST['u3'];


		$pass=$_POST['u4'];  
	    $account=$_POST['u5'];
	    $address=$_POST['u6'];
	    $enc_pass=md5($pass);
	    //user_name	email	contact_no	password	bank_account	address

 //jodi databse ar name vull hoi ti try catch ar moddhy likhbo
	    try{
	    	 $con=new PDO('mysql:host=localhost:3306;dbname=vcon;', 'root',''); 
	    	 $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	    	 $codes= "INSERT INTO user VALUES( NULL,'$name','$email','$cont','$enc_pass','$account','$address')";
	    	 $con->exec($codes); 
//jodi thik thak taky taholy login ay jaby
	    	 ?>
       	<script>location.assign('login.php')</script>
       	<?php 



       }catch(PDOException $e){
       	?>
       	<script>location.assign('signup.php')</script>
       	<?php 

       }

	}  
	else{
		?> 
		<script>location.assign('signup.php')</script>
		<?php

	}



}else{
  echo "<script>location.assign('signup.php')</script>"; //bahirer ta "" holy vitory '' & viceversa
  //jodi post ay data pass na kory taholy abr back korabo signup page ay

}
?>  