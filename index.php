<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="index.php" method="post">
        <lable>User Name: </lable><input type="text" name="username"/><br>
        <lable>Password: </lable><input type="password" name="password"/>
        <br>
        <button type="submit">Login</button>

    </form>
    
</body>
</html>
<?php
    echo"<h1>Below is your login Details.</h1><br>";
    echo "User Name: {$_POST["username"]}<br>";
    echo "Password: {$_POST["password"]}<br>";
?>