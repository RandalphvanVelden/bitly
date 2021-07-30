<!-- weergave van de links in een tabel -->
<?php
class Table
{
        public $group;

function __construct($group)
        {
          $this->group = $group;
        }

function table()
{
    // inhoud van de tabel afhankelijk van wat je wil laten zien
        if(isset($_POST['var']))
            {
                $var = $_POST['var'];
                if ($var == 1) $visibility = 'visible';
                if ($var == 2) $visibility = 'hidden';
                if ($var == 3);
            }

        else $visibility = 'visible';
        
$method ='get';
$newLink = new Connect($data, $id, $token, $method, $visibility, $this->group);
$newLink->connect();
  
    ?> 
    <div class= "table">
    <table id="bitlylinks">
        <thead>
            <tr>
                <th> Bitly links </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>id:</td>
                <td>naam:</td>
                <td> url:</td> 
                <td> </td>
                <td class= "visibility-choice"><form action="" method="post">
                        <select name="var" onchange="this.form.submit();">
                            <option value="0">visibility</option>
                            <option value="1">zichtbaar</option>
                            <option value="2">verborgen</option>
                            <option value="3">beide</option>
                        </select>
                    </form> 
                </td>
            </tr>
        <?php 
    foreach($links['links'] as $link )
        { if (!isset($link['title'])){$link['title']="";}
    
            $info= array('id' =>$link['id'],'title'=>$link['title'],'long_url'=>$link['long_url']);
            $url = "singleLink.php?".http_build_query(Array("link"=> $info)); 
            $url2 = "removeLink.php?".http_build_query(Array("link" => $info)); 
            $url3 = "restoreLink.php?".http_build_query(Array("link" => $info));   
            ?>
            <tr>
                <td class = "id-table-content"><?php echo $link['id'];?></td>
                <td class = "title-table-content"><?php if (isset($link['title'])){ echo $link['title'];}
                        else {echo '';}?></td>
                <td class = "link-table-content"><a href='<?php echo $link['long_url'];?>'><?php echo $link['long_url'];?></a></td>
                <td class="btn-table"><button type="submit" class="button" onClick="parent.location='<?php echo $url ?>'" >bewerken</button></td>
                <td class="btn-table "><button type="submit" class="button visibility" 
                <?php   if ($visibility = 'visible'){?> onClick="parent.location='<?php echo $url2 ?>'" >verbergen</button><?php;}    
                        if ($visibility = 'visible'){?> onClick="parent.location='<?php echo $url3 ?>'" >verbergen</button><?php;}?>
            </td>
            </tr>
        <?php 
        } ?>   
        </tbody>
    </table>
<?php}
}?>