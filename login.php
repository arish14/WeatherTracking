<?php

include './assets/php/db.php';
session_start();
session_destroy();

$conn = OpenCon();

CloseCon($conn);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/login.css">
    <title>Login</title>
</head>
<body>
        <h1>Login Page</h1>
        <form method="post" action="./assets/php/login.php">
            <input type="text" id="src" name="uname" placeholder="Username" required/>
            <input type="password" id="src" name="password" placeholder="Password" required/>
            <button type="submit" name="sub" value="login">Login</button>
        </form>
</body>
</html>