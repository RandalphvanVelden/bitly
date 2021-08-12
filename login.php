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


  //inloggen met bitly
 $login = new Login ($user, $password);
 $login->default();
 $token = $login->token;
 
 



      // $defaults = array(
      //   CURLOPT_URL => $url,
      //   CURLOPT_RETURNTRANSFER => 1,
      //   CURLOPT_POST => 1,
      //   CURLOPT_POSTFIELDS => "grant_type=password&username=$user&password=$password",
      //   CURLOPT_USERPWD => 'f97b78b88672bed06cf629bba45612ae076468b4' . ':' . '535808a84244c9f55248a178690294691b1f2db9',
      // );
      

      // $ch = curl_init();
      // curl_setopt_array($ch, ($defaults));
      
      // $result = curl_exec($ch);
      // if (curl_errno($ch)) 
      //   {
      //     echo 'Error:' . curl_error($ch);
      //   }
      
      // //json omzetten naar array
      //  $token=json_decode($result,true);
      
      //  curl_close($ch);


if(isset($token["access_token"])){
 // ophalen group
 $ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://api-ssl.bitly.com/v4/groups');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');


$headers = array();
$headers[] = "Authorization: Bearer {$token['access_token']}";
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);


$groups = json_decode($result,true);

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