<?php
include 'session.php';

session_destroy();
header('Location:title.php');
?>