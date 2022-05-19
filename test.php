<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header('location: ./login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>
    <link rel="stylesheet" href="test.css">
    <script src="app.js" defer></script>
</head>

<body>


    <section class="top-banner">
        <div class="container">
            <h1 class="heading">Simple Weather App</h1>
            <form>
                <input type="text" placeholder="Search for a city" autofocus>
                <button type="submit">SUBMIT</button>
                <span class="msg"></span>
            </form>
            <form action="./assets/php/logout.php" method="post">
                <input type="submit" name="logout" value="logout"/>
            </form>
        </div>
    </section>
    <section class="ajax-section">
        <div class="container">
            <ul class="cities"></ul>
        </div>
    </section>
</body>

</html>