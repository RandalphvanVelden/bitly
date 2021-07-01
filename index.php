<?php
 session_start();
 $user=$_SESSION['user'];
 $token=$_SESSION['token'];
echo "hello $user"; 

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://api-ssl.bitly.com/v4/shorten');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "{\n  \"long_url\": \"https://dev.bitly.com\",\n  \"domain\": \"bit.ly\",\n  \"group_guid\": \"Ba1bc23dE4F\"\n}");

$headers = array();
$headers[] = 'Authorization: Bearer {TOKEN}';
$headers[] = 'Content-Type: application/json';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);

?>