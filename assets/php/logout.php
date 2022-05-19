<?php

session_start();
session_destroy();

include 'db.php';
CloseCon($conn);

header('location: ../../index.php');


?>