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
                    echo '<img src=" '.$img.' "   alt = "profile pic"> ';
                    
                    } catch (Exception $e) {
                        echo 'connection failed'.$e->getMessage();
                       }
                    ?>