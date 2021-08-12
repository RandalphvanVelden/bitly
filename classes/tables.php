<!-- weergave van de links in een tabel -->
<?php

class TableHeader{
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

function tableHeader(){
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
                    <td> 
<?php
                        // inhoud van de tabel afhankelijk van wat je wil laten zien
                        if(isset($_POST['var']))
                        {
                            $var = $_POST['var'];
                            switch ($var){
                            case 1:
                                 $var = 'visible';
                                 break;
                            case 2:
                                 $var = 'hidden';
                                 break;
                            case 3:
                                 $var = 'both';
                                 break;
                            }
                        }
                       
                        else $var = 'visible';
?>
                        <form action="" method="post">
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
            if($var=='visible')include 'visibleTable.php';
            if($var=='hidden')include 'hiddenTable.php'; 
            // Als visibility is beide run de table eerst als visible en dan als hidden
            if($var=='both'){include 'visibleTable.php'; include 'hiddenTable.php';}
?> 
            </tbody>
        </table>
<?php
    }
}


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
         
        foreach($this->links['links'] as $link ) 
            { if (!isset($link['title'])){$link['title']="";}
            
                $info= array('id' =>$link['id'],'title'=>$link['title'],'long_url'=>$link['long_url'],'group'=>$this->group);
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
            <td class="btn-table "><button type="submit" class="button visibility" onClick="parent.location='<?php echo $url2 ?>'"><?php echo $btext ?></button></td>
        </tr>
<?php 
            } 
    } 
}
?>