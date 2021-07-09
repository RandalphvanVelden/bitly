<?php
 include 'session.php';

 include 'header.php';
 
 // ophalen van group links
 $ch = curl_init();

 curl_setopt($ch, CURLOPT_URL, 'https://api-ssl.bitly.com/v4/groups/Bl6o9ACPoCZ/bitlinks?size=10&page=1');
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
 
 
 $headers = array();
 $headers[] = "Authorization: Bearer {$token}";
 curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
 
 $result = curl_exec($ch);
 if (curl_errno($ch)) {
     echo 'Error:' . curl_error($ch);
 }
 curl_close($ch);
 
 $links=json_decode($result,true);
?>

<table>
<thead>
 <tr>
 <th> tabel </th>
 </tr>
 </thead>
 <tbody>
 <tr>
 <td>id</td>
 <td>naam</td>
 <td> link</td>
 </tr>

 <?php 
foreach($links['links'] as $link){ 

$url = "singleLink.php?".http_build_query(Array(
    "link" => $link)); 
$url2 = "removeLink.php?".http_build_query(Array(
        "link" => $link)); 
    
 ?>
    <tr>
    <td><?php echo $link['id'];?></td>
    <td><?php echo $link['title'];?></td>
    <td><a href='<?php echo $link['long_url'];?>'><?php echo $link['long_url'];?></a></td>
    <td><button type="submit" class="button" onClick="parent.location='<?php echo $url ?>'" >bewerken</button></td>
    <td><button type="submit" class="button" onClick="parent.location='<?php echo $url2 ?>'" >verbergenn</button></td>
    </tr>
    <?php } ?>
    </tbody>
    </table>

 <form action="" method="POST">

 URL: <input type = "text" placeholder = "paste long URL" name = "long_url" value = '' required>
 Title: <input type = "text" placeholder = "titel" name = "title" required>
 
 <button type = "submit" class="button">Save</button>
 
 </form>

<?php

$long_url = ''; 
$title = '';

if(isset($_POST['long_url'])){
    $long_url = $_POST['long_url'];
}

if(isset($_POST['title'])){
    $title = $_POST['title'];
}
 
$data= array('title'=>$title, 'long_url'=>$long_url );
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://api-ssl.bitly.com/v4/bitlinks');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

$headers = array();
$headers[] = "Authorization: Bearer {$token}";
$headers[] = 'Content-Type: application/json';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);
?>
