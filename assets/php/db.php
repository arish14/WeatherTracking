<?php
function open(){
    $con=mysqli_connect("localhost","root","");
    if(!$con){
        echo "Not connected to database";
    }
    mysqli_select_db($con,"SL");
    return $con;
}
function close($con){
    mysqli_close($con);
}
?>