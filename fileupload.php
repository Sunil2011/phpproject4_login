<?php
session_start();
include 'info.php'; // including info file in this file 
//echo $usrid . $passwrd . $dbname;exit();
// $usrid n $password is not found because 3 POST mthd is used and
//post array is not able to find required value
$usrid = $_SESSION['username'];

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

$filename = $_FILES['fileToUpload']['name'];
//print_r($target_file);exit();
//print_r($filename);exit();

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".".'<br>';
        $uploadOk = 1;
    } else {
        echo "File is not an image.".'<br>';
        $uploadOk = 0;
    }
}
// Check if file already exists
/*if (file_exists($target_file)) {
    echo "Sorry, file already exists.".'<br>';
    $uploadOk = 0;
} */
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.".'<br>';
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.".'<br>';
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.".'<br>';
// if everything is ok, try to upload file
} else {
   // move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file);
    
    if ( move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file) ) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.".'<br>';
      
        
    } else {
        echo "Sorry, there was an error uploading your file.".'<br>';
        $uploadOk = 0 ;
    }
}
//echo $_FILES['fileToUpload']['error'];
// connecting to mysql ( accessing data base )

       
if($uploadOk==1){
    
    try {
            $conn2 = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password );
            $conn2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
           // echo 'connected sucessfuly'; 
           
            $stmt2 = $conn2->prepare(" UPDATE user SET imgFileName = :flnm WHERE UserId = :urid ");
            $stmt2->bindParam(':urid', $usrid);
            $stmt2->bindParam(':flnm', $filename);
            $stmt2->execute();
            echo 'file '. $filename .' updated successfuly '.'to UserId: '. $usrid ;
          
        } catch (Exception $e) {
            echo 'connection failed'.$e->getMessage();
            
        }
}
?>
