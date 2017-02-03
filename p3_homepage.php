<?php

session_start();
// var_dump($_SESSION);exit;
if(!isset($_SESSION['username']) || $_SESSION['username']==""){
   header("location:p1_login.php");
   exit;
   
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <style>
            div{
                float:right;
            }
        </style>
    </head>
    <body>
        
        <?php
echo " <h2> welcome to home page ! </h2> " ;
//echo $_SESSION['username'];

?>
        
        <div>
            <form method ="POST" action="p4_logout.php">
                  <input id="buttn" type="submit" name="submt" value="Log-Out">
            </form>
        </div>
        
         <form action="fileupload.php" method="post" enctype="multipart/form-data" >
                Select image to upload:<br>
                <input type="file" name="fileToUpload" id="fileToUpload"> <br> 
                <br>
                <input type="submit" value="Upload Image" name="submit">
         
            </form>
                
                <?php
                include 'info.php';
                session_start();
                $usrid = $_SESSION['username'];
                try {
                    $conn3 = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password );
                    $conn3->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
                    // echo 'connected sucessfuly'; 
                    $stmt3 = $conn3->prepare(" SELECT imgFileName FROM user WHERE UserId=:urid");
                    $stmt3->bindParam(':urid', $usrid);
                    
                    $stmt3->execute();
                    $row = $stmt3->fetch(PDO::FETCH_ASSOC);
                    //var_dump($row);
                    $flname = $row['imgFileName'];
                    $img = "uploads/".$flname;
                    //echo $img .'<br>';
                    echo '<br>';
                    echo '<img src=" '.$img.' "   alt = "profile pic" style="width:200px;height:200px;"> ';
                    
                    } catch (Exception $e) {
                        echo 'connection failed'.$e->getMessage();
                       }
                    ?>
         
        
    </body>
</html>

