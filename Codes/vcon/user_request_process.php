<?php
    session_start();
if($_SERVER['REQUEST_METHOD']=="POST"){
    if(
        isset($_POST['q_id']) &&
        isset($_POST['content']) &&
        !empty($_POST['q_id']) &&
        !empty($_POST['content'])
        
      ){
        $comment=$_POST['content'];
        $question_id=$_POST['q_id'];
        
        try{
        $conn=new PDO('mysql:host=localhost:3306;dbname=vcon;','root','');
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $selectquery="SELECT * FROM user_questions WHERE id='$question_id'";
            $test=$conn->query($selectquery);
            
           
            if($test->rowCount()==1){
               $update_query="UPDATE user_questions SET feedback='$comment' WHERE id=$question_id ";
               $conn->exec($update_query);
               ?>
               <script>location.assign('user_request.php')</script>
               <?php
           }
            else{
                echo 'No data Found!';
            }
            
        } catch(PDOExption $ex){
            ?>
            <script>location.assign('profile1.php')</script>
            <?php
            }
        }
        else{
        ?>
            <script>location.assign('user_request.php')</script>
        <?php
       
            }
        }
    else{

    ?>
<script>location.assign('login.php')</script>
    <?php
}

?>
