<?php
 session_start();
 $user=$_SESSION['user'];
 $token=$_SESSION['token'];
echo "hello $user"; 

?>