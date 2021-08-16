<?php
include 'include.php';


// ophalen meegestuurde data
$link = $_GET['link'];
$id= $link['id'];

   
// de link word terug gezet naar zichtbaar
$data= array('archived'=>false);

$restore = new Patch($id, $data, $token);
$restore->patch();
$restore->default();
$restore->patchHeaders();
$restore->result();


// redirect naar index.php
header('Location:index.php');
?>