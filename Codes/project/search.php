<?php
    session_start();

if(
    isset($_SESSION['usermail'])
    && !empty($_SESSION['usermail'])
    ){
     $loginmail=$_SESSION['usermail'];
        if($_SERVER['REQUEST_METHOD']=="POST"){
            
            if(
                isset($_POST['key']) &&
                !empty($_POST['key'])
               ){
                $key=$_POST['key'];
       ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Search results</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        body {
            background-color: aliceblue;
        }

        .res {
            text-align: center;
        }

        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }
        

        .bt{
            background-color: white;
            color: black;
            width: 100px;
            text-align: center;

        }

        .back {
            display: block;
            text-align: center;
        }

    </style>
</head>

<body>


    <nav class="navbar navbar-inverse ">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">VIRTUAL CONSTRUCTOR</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="http://localhost/project/logout.php">log out</a></li>
                <li><a href="http://localhost/project/profile.php">Profile</a></li>
            </ul>

        </div>

    </nav>

    <table id="customers">
        <tr>
            <td>
                <h4 class="res">
                    Results for : <?php echo $key; ?>
                </h4>
            </td>

        </tr>
    </table>


    <?php        
                
      try{
                    $conn=new PDO('mysql:host=localhost:3306;dbname=vcon','root','');
                    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                    $search_query="SELECT * FROM ct_group WHERE working_area LIKE '%$key%'  AND active_status='yes'";
                        $test=$conn->query( $search_query);
                        $data=$test->fetchAll();
                        foreach($data AS $data1){
                            $ct_id=$data1['id'];
                            $aid=$data1['agentid'];
                            $name=$data1['group_name'];
                            $area=$data1['working_area'];
                            $exp=$data1['experience'];
                            $ratings=$data1['ratings'];
                            $active=$data1['active_status'];
                            $salary=$data1['mason_salary'];
                            $worker=$data1['total_worker'];
                            $payment=$data1['payment_system'];
                            
                       ?>
    <div class="container">

        <div>
            <table id="customers">
                <tr>
                    <th>
                        <h3>
                            <?php echo $name;?>
                        </h3>
                    </th>
                    <th>
                        <button type="button" class="bt" onclick="hire(<?php echo $ct_id ?>,<?php echo $aid ?>);">Hire</button>
                    </th>

                </tr>
                <tr>
                    <td>
                        <h4>
                            <?php echo "Area: ".$area; ?>
                        </h4>
                    </td>
                    <td>
                        <h4>
                            <?php echo "Active: ".$active; ?>
                        </h4>
                    </td>

                </tr>

                <tr>
                    <td>Ratings</td>
                    <td>
                        <?php
                            echo $ratings;
                        ?> /5
                    </td>
                </tr>
                <tr>
                    <td>Experience</td>
                    <td>
                        <?php
                            echo $exp;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Salary</td>
                    <td>
                        <?php
                            echo $salary;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Worker</td>
                    <td>
                        <?php
                            echo $worker;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Payment Taking</td>
                    <td>
                        <?php
                            echo $payment;
                        ?>
                    </td>
                </tr>
                <br /><br />
            </table>
            <br />
        </div>
    </div>


    <?php
            }
?>
    <a href="http://localhost/project/profile.php" class="back">Back</a>
    <script>
        function hire(id,a) {
            location.assign('hire_process.php?hire_id='+id+'&agentid='+a);
        }

    </script>
</body>

</html>

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
        } else{
                   ?>
<script>
    location.assign('profile.php')

</script>
<?php
            }
    }else{
            ?>
<script>
    location.assign('profile.php')

</script>
<?php 
}
?>
