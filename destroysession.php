<?php
include 'session.php';


// sessi word beëindigd. token word vernietigd
session_destroy();
header('Location:titlepage.php');
?>