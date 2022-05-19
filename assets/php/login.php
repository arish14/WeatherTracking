<?php

// starting the sesion
session_start();

// including DB connection file
include 'db.php';
$conn = OpenCon();

//getting the values
$u_name = $_POST['uname'];
$u_password = $_POST['password'];

//checking is the user exist or not
$query = "select * from login where uname = '$u_name' && pass = '$u_password'";
$result = mysqli_query($conn, $query);

//fetching the values from DB
list($id, $uname, $pass) = mysqli_fetch_row($result);

//if authentication is successfull authorize the user else try again
if($uname == $u_name){
    $_SESSION['current_user'] = $uname;
    $_SESSION['user_id'] = $id;
    echo "<script>
        window.alert('Sucessfull!');
        window.location='../../test.php';
    </script>";
}else{
    echo "<script>
        window.alert('Username or password is wrong!');
        window.location='../../login.php';
    </script>";
}

?>