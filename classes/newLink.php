<?php
class NewLink{
    public $token;
    public $visibility;
    public $group;
    public $long_url;
    public $title;

    function __construct($token, $visibility, $group, $long_url, $title)
    {
        $this->token = $token;
        $this->visibility = $visibility;
        $this->group = $group;
        $this->long_url = $long_url;
        $this->$title = $title;
    }
    
    function form(){ 
    // inhoud van de tabel afhankelijk van wat je wil laten zien
?>
        <form  class= "add-content" action="index.php" method="POST">
            URL: <input type = "text" placeholder = "paste long URL" name = "long_url"  required>
            Title: <input type = "text" placeholder = "titel" name = "title" required>
            <button class ="button" type = "submit">Save</button>
        </form>
<?php
        // toevoegen van eeen link
        if(isset($_POST['long_url']))
            {
                $this->long_url = htmlspecialchars($_POST['long_url']);
            }

        if(isset($_POST['title']))
            {
                $this->title = htmlspecialchars($_POST['title']);
            }

        // toevoegen van de nieuwe link bij bitly
        $data= array('title'=>$this->title, 'long_url'=>$this->long_url );
        $id = 'none';
        $method ='post';

        $newLink = new Connect($data, $id, $this->token, $method, $this->visibility, $this->group);
        $newLink->connect();

    
    }
}
?>