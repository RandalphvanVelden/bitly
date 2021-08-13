
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
 <div class ="content">
 <?php

include 'include.php';
$long_url = ''; 
$title = '';
$var= '0';
$ch = '';
$method = '';
$visibility = '';
$group = '';
$id = '';
$data ='';
 

//formulier voor het toevoegen van een bitly
$newLink = new NewLink($token);
$newLink->form();

//voor meerdere groepen
$groupChoice= new GroupChoice($groups, $group);
$groupChoice->groupChoice();
$group = $groupChoice->group;

// tabel met weergave van de links
$choice=new TableHeader($token, $group);
$choice->tableHeader();

?>




