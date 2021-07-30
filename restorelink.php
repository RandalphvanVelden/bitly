<?php
include 'session.php';

include 'bitlyconnect.php';

// ophalen meegestuurde data
$link = $_GET['link'];
$id= $link['id'];

   
// de link word terug gezet naar zichtbaar
$data= array('archived'=>false);
$method ='patch';

$newLink = new Connect($data, $id, $token, $method, $visibility, $group);
$newLink->connect();
  

// redirect naar index.php
header('Location:index.php');
?>