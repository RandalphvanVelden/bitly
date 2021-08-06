<!-- weergave van de links in een tabel -->
<?php
class Table{ 
    public $data;
    public $id;
    public $token;
    public $method;
    public $visibility;
    public $group;
    public $links;

    function __construct($data, $id, $token, $method, $visibility, $group)
    {
        $this->data = $data;
        $this->id = $id;
        $this->token = $token;
        $this->method = $method;
        $this->visibility = $visibility;
        $this->group = $group;
    }

    function table()
    {
        $this->method ='get';
 
        $getInfo = new Connect($this->data, $this->id, $this->token, $this->method, $this->visibility, $this->group);
        $getInfo->connect();
        $this->links = $getInfo->links;
        
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
                    <td> </td>
                </tr>
            <?php 
            foreach($this->links['links'] as $link ) 
                { if (!isset($link['title'])){$link['title']="";}
            
                    $info= array('id' =>$link['id'],'title'=>$link['title'],'long_url'=>$link['long_url']);
                    $url = "singleLink.php?".http_build_query(Array("link"=> $info)); 
                    if ($this->visibility == 'visible'){$url2 = "removeLink.php?".http_build_query(Array("link" => $info));}
                    if ($this->visibility == 'hidden'){$url2 = "restoreLink.php?".http_build_query(Array("link" => $info));}
                    
                    if ($this->visibility == 'visible'){$btext = "verbergen";}
                    if ($this->visibility == 'hidden'){$btext = "zichtbaar maken";}

                    ?>
                    <tr>
                        <td class = "id-table-content"><?php echo $link['id'];?></td>
                        <td class = "title-table-content"><?php if (isset($link['title'])){ echo $link['title'];}
                                else {echo '';}?></td>
                        <td class = "link-table-content"><a href='<?php echo $link['long_url'];?>'><?php echo $link['long_url'];?></a></td>
                        <td class="btn-table"><button type="submit" class="button" onClick="parent.location='<?php echo $url ?>'" >bewerken</button></td>
                        <td class="btn-table "><button type="submit" class="button visibility" onClick="parent.location='<?php echo $url2 ?>'"><?php echo $btext ?></button>
                       
                        </td>
                    </td>
                    </tr>
                <?php 
                } ?>  
            
            
            
            </tbody>
            </table>
<?php } 
}

?>