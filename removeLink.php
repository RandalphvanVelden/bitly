<?php
include 'include.php';

// ophalen benodigde gegevens
$link = $_GET['link'];
$id= $link['id'];

   
// de link word op hidden gezet
$data= array('archived'=>true);
$method ='patch';

$newLink = new Connect($data, $id, $token, $method, $visibility, $group);
$newLink->connect();

  

// redirect naar de index.php
header('Location:index.php');
?>