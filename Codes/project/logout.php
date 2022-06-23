<?php
session_start();
if(
  isset($_SESSION['useremail']) &&
  !empty ($_SESSION['useremail'])   
){
   //logout ar kaj korby
    unset($_SESSION['useremail']);
    //delete kory dilam
    session_destroy();
    
     ?> 
	<script>location.assign('home.php')</script>
		<?php
   
}else{
    ?> 
	<script>location.assign('home.php')</script>
		<?php
}

?>
