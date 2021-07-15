<?php
// ophalen van de hidden links
$ch = curl_init();

 curl_setopt($ch, CURLOPT_URL, "https://api-ssl.bitly.com/v4/groups/$group/bitlinks?size=10&page=1&archived=on");
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
;

// deel van de table dat word weergegeven als je voor hidden kiest
foreach($links['links'] as $link )
    { 
        $data= array('id' =>$link['id'],'title'=>$link['title'],'long_url'=>$link['long_url']);
        $url = "singleLink.php?".http_build_query(Array("link"=> $data)); 
        $url2 = "removeLink.php?".http_build_query(Array("link" => $data)); 
        ?>

        <tr>
        <td><?php echo $link['id'];?></td>
        <td><?php if (isset($link['title'])){ echo $link['title'];}
            else {echo '';}?></td>
        <td><a href='<?php echo $link['long_url'];?>'><?php echo $link['long_url'];?></a></td>
        <td><button type="submit" class="button" onClick="parent.location='<?php echo $url ?>'" >bewerken</button></td>
        <td><button type="submit" class="button" onClick="parent.location='<?php echo $url2 ?>'" >zichtbaar maken</button></td>
        </tr>
        <?php 
    } ?>
       


