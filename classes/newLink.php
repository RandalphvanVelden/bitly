<?php
class NewLink{
    public $token;
    public $long_url;
    public $title;
    public $data;

    function __construct($token)
    {
        $this->token = $token;
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
        $this->data= array('title'=>$this->title, 'long_url'=>$this->long_url );
        
        $newLink = new Post($this->data, $this->token);
        $newLink->post();
        $newLink->default();
        $newLink->headers();
        $newLink->result();
    
    }
}
?>