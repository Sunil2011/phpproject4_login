<?php
session_start();
/*
$servername = 'localhost';
$username = 'root';
$password = 'welcome';
$dbname = 'db01';
*/
$usrid = $_POST['userId'];
$passwrd = $_POST['pass'];

include 'info.php';
//echo $usrid . $passwrd . $dbname;

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password );
    // set PDO error mode
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
   // echo 'connected succussfully ';
    $stmt = $conn->prepare("select UserId,password from user where UserId = :urid and password = :pswrd");
    $stmt->bindParam(':urid',$usrid);
    $stmt->bindParam(':pswrd',$passwrd);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if(count($result)==2)
    {
        
         //var_dump($result); exit;
        $_SESSION['username'] = $result['UserId'];
	header('location:p3_homepage.php');
	exit;
        
    } else{
	//$errMsg .= 'Username and Password are not found <br>';
        echo'Username and Password are not matching <br>';
    }
    
        
} catch (PDOException $e) {
    echo 'connection failed'.$e->getMessage();   
}