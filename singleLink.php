<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
 <div class ="content">
   
   <?php
include 'session.php';

include 'header.php';

include 'bitlyconnect.php';

// weergeven meegestuurde data die nodig is
$link = $_GET['link'];
$id= $link['id'];

if (isset($link['title'])){ $title = $link['title'];}
else {$title = '';}
$long_url = $link['long_url'];     

?>

<!-- formulier voor het aanpassen van de link -->
    <form class="change-link"action="" method="POST">

id: <input type = "text" name = "id" value= "<?php echo $link['id']?>" disabled>
naam: <input type = "text" name = "title"   value="<?php echo $title?>">
url: <input type = "text" name = "long_url"  value="<?php echo $link['long_url']?>"disabled>
<button type = "submit" class="button">edit</button>
</form>

<?php
$title = '';

if(isset($_POST['title']))
  {
    $title = htmlspecialchars($_POST['title']);
  }


// versturen van de aangepaste dat naar bitly
$data= array('title'=>$title );
$method ='patch';

$newLink = new Connect($data, $id, $token, $method, $visibility, $group);
$newLink->connect();

  
?>

<!-- knop om weer naar index.php te gaan -->
<button class="button return-overzicht" onClick="parent.location='index.php'" >overzicht</button>

  </div>