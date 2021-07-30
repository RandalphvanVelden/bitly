<?php
// ophalen van group links die niet verborgen zijn
 $ch = curl_init();
 
 curl_setopt($ch, CURLOPT_URL, "https://api-ssl.bitly.com/v4/groups/$group/bitlinks?size=10&page=1");
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
 
 
 $headers = array();
 $headers[] = "Authorization: Bearer {$token}";
 curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
 
 $result = curl_exec($ch);
 if (curl_errno($ch)) 
    {
        echo 'Error:' . curl_error($ch);
    }
 curl_close($ch);
 
 $links=json_decode($result,true);


 // deel van de table dat word weergegeven als je voor zichtbaar kiest
 foreach($links['links'] as $link )
    { if (!isset($link['title'])){$link['title']="";}
   
        $info= array('id' =>$link['id'],'title'=>$link['title'],'long_url'=>$link['long_url']);
        $url = "singleLink.php?".http_build_query(Array("link"=> $info)); 
        $url2 = "removeLink.php?".http_build_query(Array("link" => $info)); 
            
        ?>
        <tr>
            <td class = "id-table-content"><?php echo $link['id'];?></td>
            <td class = "title-table-content"><?php if (isset($link['title'])){ echo $link['title'];}
            else {echo '';}?></td>
            <td class = "link-table-content"><a href='<?php echo $link['long_url'];?>'><?php echo $link['long_url'];?></a></td>
            <td class="btn-table"><button type="submit" class="button" onClick="parent.location='<?php echo $url ?>'" >bewerken</button></td>
            <td class="btn-table "><button type="submit" class="button visibility" onClick="parent.location='<?php echo $url2 ?>'" >verbergen</button></td>
        </tr>
    <?php 
    } ?>
       