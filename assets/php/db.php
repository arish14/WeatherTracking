<?php


function OpenCon(){
    $dbuser="root";
    $dbpass="";
    $dbhost="localhost";
    $dbname = 'SL';

    // connecting the DB
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass);
    mysqli_select_db($conn, $dbname);

    return $conn;
}

function CloseCon($conn){
    mysqli_close($conn);
}

?>