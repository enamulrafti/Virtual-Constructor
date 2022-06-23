<?php
session_start();
if($_SERVER['REQUEST_METHOD']=="GET"){
    if(
        isset($_SESSION['useremail1'])
        && !empty($_SESSION['useremail1'])
    ){      
         
        if(
            isset($_GET['book']) &&
            !empty($_GET['book'])
        ){
          echo  $book_id=$_GET['book']; 
        echo    $clicked=$_GET['eve'];
            try{    
                
                
                $conn=new PDO('mysql:host=localhost:3306;dbname=vcon;','root','');
                $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $query1="SELECT * FROM booking_req WHERE id='$book_id'";
                $return_obj=$conn->query($query1);
                if($return_obj->rowcount()==1){
            
                    if($clicked==0){
                        $in_query1="UPDATE booking_req SET status='denied' WHERE id='$book_id'";
                        $conn->exec($in_query1);
                ?>
                        <script>location.assign('booking_approval.php')</script>
                <?php
                    }
                    elseif($clicked==1){
                        $in_query2="UPDATE booking_req SET status='approved' WHERE id='$book_id' ";
                        $conn->exec($in_query2);
                        ?>
                    <script>location.assign('booking_approval.php')</script>
                    <?php
                    }
            }
            else{
                echo 'No data Found!';
            }
        }
            catch(PDOException $ex){
                ?>
                <script>location.assign('booking_approval.php')</script>
                <?php
            }
        }
        else{
            ?>
<script>
    location.assign('booking_approval.php')

</script>
<?php
        }
        
        
        
        
        
            
            
        }
            
       }else{
        
        ?>
<script>
    location.assign('profile1.php')

</script>
<?php
    
    }
?>
