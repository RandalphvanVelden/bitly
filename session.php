<?php
session_start();
$token=$_SESSION['token'];


if (isset($token)){
   $user=$_SESSION['user'];
}

else{
     header('Location:titlepage.php');   
}