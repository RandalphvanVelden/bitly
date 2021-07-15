<?php
include 'session.php';

include 'header.php';

// weergeven meegestuurde data die nodig is
$link = $_GET['link'];
$id= $link['id'];
$title = $link['title']; 
$long_url = $link['long_url'];     

?>

<!-- formulier voor het aanpassen van de link -->
    <form action="" method="POST">

id: <input type = "text" name = "id" value= "<?php echo $link['id']?>" disabled>
title<input type = "text" name = "title"  value="<?php echo $link['title']?>">
url<input type = "text" name = "long_url"  value="<?php echo $link['long_url']?>"disabled>
<button type = "submit" class="button">edit</button>
</form>

<?php
$title = '';

if(isset($_POST['title'])){
$title =htmlspecialchars($_POST['title']);
}


// versturen van de aangepaste dat naar bitly
$data= array('title'=>$title );

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
?>

<!-- knop om weer naar index.php te gaan -->
<button class="button" onClick="parent.location='index.php'" >overzicht</button>

