<?php
include 'session.php';

// ophalen benodigde gegevens
$link = $_GET['link'];
$id= $link['id'];

   
// de link word op hidden gezet
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
  if (curl_errno($ch)) 
    {
      echo 'Error:' . curl_error($ch);
    }
  curl_close($ch);
  

// redirect naar de index.php
header('Location:index.php');
?>