<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
echo "hallo Wereld"

/*
client_id - your application's Bitly client id.
client_secret - your application's Bitly client secret.
code - the OAuth verification code acquired via OAuth's web authentication protocol.
redirect_uri - the page to which a user was redirected upon successfully authenticating.
state - optional state to include in the redirect URI.
grant_type - optional, if present must be authorization_code.
*/
?>
<form id="table1" action="dbinlog.php" method="POST">

Name: <input type = "text" placeholder = "Gebruikersnaam" name = "username" required>
Password<input type = "password" placeholder = "wachtwoord" name = "wachtwoord" required>

<button type = "submit" class="btn btn-success" id="pt">Inloggen</button>

</form>



<!--
POST /oauth/access_token HTTP/1.1
Host: api-ssl.bitly.com
Authorization: Basic czZCaGRSa3F0MzpnWDF
Content-Type: application/x-www-form-urlencoded

client_id=f97b78b88672bed06cf629bba45612ae076468b4&client_secret=535808a84244c9f55248a178690294691b1f2db9

crl -u "username:password" -X POST "https://api-ssl.bitly.com/oauth/access_token"
-->
</body>