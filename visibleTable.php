<?php
// ophalen van group links die niet verborgen zijn
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


 // deel van de table dat word weergegeven als je voor zichtbaar kiest
 foreach($links['links'] as $link ){ 

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
        <td><button type="submit" class="button" onClick="parent.location='<?php echo $url2 ?>'" >verbergen</button></td>
        </tr>
        <?php } ?>
       