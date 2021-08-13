<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
 <div class ="content">

<!--log in form -->
<form class="login-form" action="" method="POST">
    Name: <input type = "text" placeholder = "Gebruikersnaam" name = "username" required>
    Password<input type = "password" placeholder = "wachtwoord" name = "password" required>

    <button type = "submit" class="button">Inloggen</button>
</form>


<?php
include 'classes/connection.php';

$user = '';
$password = '';

if(isset($_POST['username']))
  {
    $user =($_POST['username']);
  }

if(isset($_POST['password']))
  {
    $password= ( $_POST ['password']);
  }

$login = new Login($user, $password);
$login->login();
$login->default();
$login->headers();
$login->result();
$login->token();
$token = $login->token;
 

if(isset($token["access_token"])){

  $getGroups = new GetGroups($token);
  $getGroups->getGroups();
  $getGroups->default();
  $getGroups->headers();
  $getGroups->result();
  $getGroups->groups();
  $groups = $getGroups->groups;
 
  
 //sessie starten met token en user name en redirecten naar index.php
session_start();
  $_SESSION['user'] =  htmlspecialchars($user);
  $_SESSION['token'] = $token["access_token"];
  $_SESSION['groups'] = $groups;
      
     
  header('Location:index.php');  
  }


  


?>
</div>
</body>