<?php
include 'include.php';

// ophalen benodigde gegevens
$link = $_GET['link'];
$id= $link['id'];

   
// de link word op hidden gezet
$data= array('archived'=>true);

$remove = new Patch($id, $data, $token);
$remove->patch();
$remove->default();
$remove->headers();
$remove->result();


// redirect naar de index.php
header('Location:index.php');
?>