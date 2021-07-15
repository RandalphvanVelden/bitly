<?php
// het starten van een sessie met het doorgeven van naam van de gebruiker en het aangemaakte token
session_start();
$token=$_SESSION['token'];


if (isset($token))
   {
      $user=$_SESSION['user'];
   }

else
   {
     header('Location:titlepage.php');   
   }