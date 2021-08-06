<?php
class Choice{
    public $visibility;

    

function form(){
// inhoud van de tabel afhankelijk van wat je wil laten zien
if(isset($_POST['var']))
{
    $var = $_POST['var'];
    if ($var == 1) $this->visibility = 'visible';
    if ($var == 2) $this->visibility = 'hidden';
    if ($var == 3) $this->visibility = '';
}
// Als visibility is beide run de table eerst als visible en dan als hidden
else $this->visibility = 'visible';

?>
<form action="" method="post">
                            <select name="var" onchange="this.form.submit();">
                                <option value="0">visibility</option>
                                <option value="1">zichtbaar</option>
                                <option value="2">verborgen</option>
                                <option value="3">beide</option>
                            </select>
                        </form> 

<?php
}
}