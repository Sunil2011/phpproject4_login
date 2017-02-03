<!DOCTYPE HTML>
<html>
  
    <body>
<?php

$servername = 'localhost';
$username = 'root';
$password = 'welcome';
$dbname = 'db01';

$usrid = $_POST['userId'];
$passwrd = $_POST['pass'];

/*** check if a file was submitted ***/
if(!isset($_FILES['fileToUpload']))
    {
    echo '<p>Please select a file</p>';
    }
else
    {
    try    {
        upload();
        /*** give praise and thanks to the php gods ***/
        echo '<p>Thank you for submitting</p>';
        }
    catch(Exception $e)
        {
        echo '<h4>'.$e->getMessage().'</h4>';
        }
    }
    
 //------------------ function upload --------------------------   
 function upload(){
    global $servername,$dbname,$username,$password,$usrid ;

if(is_uploaded_file($_FILES['fileToUpload']['tmp_name']) && getimagesize($_FILES['fileToUpload']['tmp_name']) != false)
    {
    $imgfp = fopen($_FILES['fileToUpload']['tmp_name'], 'rb');
    $maxsize = 99999999;
 
    if($_FILES['userfile']['size'] < $maxsize )
        {
        $dbh = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password );
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         
        $stmt = $dbh->prepare("UPDATE user SET pic = :pict where UserId = :urid");

        $stmt->bindParam(':pict', $imgfp,PDO::PARAM_LOB);
        $stmt->bindParam(':urid',$usrid );  
        
        $stmt->execute();
        }
    else
        {
        throw new Exception("File Size Error");
        }
    }
/*else
    {
    throw new Exception("Unsupported Image Format!");
    }*/
}

//-----------showing pic --------------
try     {
        /*** connect to the database ***/
        $dbh = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

        /*** set the PDO error mode to exception ***/
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        /*** The sql statement ***/
        $sql = "SELECT pic FROM user  WHERE  Userid=$usrid";

        /*** prepare the sql ***/
        $stmt = $dbh->prepare($sql);

        /*** exceute the query ***/
        $stmt->execute(); 

        /*** set the fetch mode to associative array ***/
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

       
        $array = $stmt->fetch();

        if( count($array) == 1 )
            {
            /*** output the image ***/
            echo $array['pic'];
            }
        else
            {
            throw new Exception("Out of bounds Error");
            }
        }
    catch(PDOException $e)
        {
        echo $e->getMessage();
        }
    catch(Exception $e)
        {
        echo $e->getMessage();
        }
        
?>
</body>
</html>

