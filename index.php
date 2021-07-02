<?php
 session_start();
 $user=$_SESSION['user'];
 $token=$_SESSION['token'];

 include 'header.php';





 
 // ophalen van grou[ links
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
foreach($links['links'] as $link){ ?>
    <tr>
    <td><?php echo $link['id'];?></td>
    <td><?php echo $link['title'];?></td>
    <td><?php echo $link['long_url'];?></td>
    <td><button type="" value="">bewerken</button></td>
    </tr>
    <?php } ?>
    </tbody>
    </table>

    
 


