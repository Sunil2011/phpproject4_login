<!DOCTYPE HTML>
<html>
    <head>
        <title> Sign-In </title>
        <style>
            body{
                background-color:#eeeeee; 
            }
        </style>
    </head>
    <body>
        <div>
            <fieldset style="width:25% "> 
                <legend > LOG-IN HERE : </legend>
                <form method="POST" action="p2_connect.php">
                    UserId : <br>
                    <input type="text" name="userId"> <br>
                    Password : <br>
                    <input type="password" name="pass" > <br>
                    <input type="submit" name="submit" value="log-in">
                </form>
            </fieldset>
        </div>
    </body>
</html>

