<!DOCTYPE html>
<html>
<head>
</head>
<body>
<!--log in form -->
<form action="" method="POST">

Name: <input type = "text" placeholder = "Gebruikersnaam" name = "username" required>
Password<input type = "password" placeholder = "wachtwoord" name = "password" required>

<button type = "submit" class="button">Inloggen</button>

</form>

<?php
//verbinden met bitly
$user= $_POST['username'];
$password=  $_POST ['password'];


$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://api-ssl.bitly.com/oauth/access_token');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=password&username=$user&password=$password");
curl_setopt($ch, CURLOPT_USERPWD, 'f97b78b88672bed06cf629bba45612ae076468b4' . ':' . '535808a84244c9f55248a178690294691b1f2db9');

$headers = array();
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
  echo 'Error:' . curl_error($ch);
}

//json omzetten naar array
 $token=json_decode($result,true);

 //sessie starten met token en user name en redirecten naar index.php
 if(isset($token["access_token"]))
{session_start();
    $_SESSION['user'] = $user;
    $_SESSION['token'] = $token["access_token"];
    header('Location:index.php');  
}


curl_close($ch);

?>
</body>