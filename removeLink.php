<?php
include 'session.php';


$link = $_GET['link'];
$id= $link['id'];

   

$data= array('archived'=>true);

  $ch = curl_init();

  curl_setopt($ch, CURLOPT_URL, "https://api-ssl.bitly.com/v4/bitlinks/$id");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
  
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
  
  $headers = array();
  $headers[] = "Authorization: Bearer $token";
  $headers[] = 'Content-Type: application/json';
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  
  $result = curl_exec($ch);
  if (curl_errno($ch)) {
      echo 'Error:' . curl_error($ch);
  }
  curl_close($ch);
  


header('Location:index.php');
?>