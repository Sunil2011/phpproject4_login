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
    
function upload(){
    echo '------';
}    

