<?php
session_start();
include './db.php';
$conn = open();
$row = [];
$uname = $_POST['uname'];
$pass = $_POST['pass'];
if(isset($_POST['uname'])){
    $query = "select * from login where uname = '$uname' and pass = '$pass'";
    $result = mysqli_query($conn, $query);
    while ($row=mysqli_fetch_assoc($result)){
        $uname_check=$row['uname'];
    }
    if($uname_check == $uname){
       $_SESSION['uname']=$uname;
        echo"<script>
        window.alert('Login Successfull');
        window.location.href='../../home.html'
        </script>";
    }else{
        echo"<script>
        window.alert('Username or password is wrong');
        window.location.href='../../index.html'
        </script>";
    }
}else{
    echo"<script>
    window.alert('Login Again😥');
    </script>";
}
?>