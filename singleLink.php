<?php
include 'session.php';

include 'header.php';


$link = $_GET['link'];
$id= $link['id'];
$title = $link['title']; 
$long_url = $link['long_url'];     

?>


    <form action="" method="POST">

id: <input type = "text" name = "id" value= "<?php echo $link['id']?>" disabled>
title<input type = "text" name = "title"  value="<?php echo $link['title']?>">
url<input type = "text" name = "long_url"  value="<?php echo $link['long_url']?>"disabled>
<button type = "submit" class="button">edit</button>
</form>

<?php


$title = $_POST['title'];


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



$url = "index.php?".http_build_query(Array(
  "result" => $result)); 
?>
<button class="button" onClick="parent.location='<?php echo $url ?>'" >overzicht</button>

