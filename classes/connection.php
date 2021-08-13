<?php
// abstract parent class voor de verbindingen met bitly
abstract class Connection{
  
    public $token;
    public $result;
    public $url;
    public $options;
    public $ch;
    public $headers;
  
  public function default()
  {
    $defaults = array(
          CURLOPT_URL => $this->url,
          CURLOPT_RETURNTRANSFER => 1, 
        );

    $this->ch = curl_init();
      curl_setopt_array($this->ch, ($defaults + $this->options));
  }

  public function headers(){
    $this->headers = array();
    $this->headers[] =$this->headervar;
  }

  public function result(){ 
    curl_setopt($this->ch, CURLOPT_HTTPHEADER, $this->headers);
    $this->result = curl_exec($this->ch);
    if (curl_errno($this->ch)) 
      {
        echo 'Error:' . curl_error($this->ch);
      }
      curl_close($this->ch);
  }
}

// inloggen bij bitly en het ophalen van het token
 class Login extends Connection{
    public $user;
    public $password;
  
    public function __construct($user, $password){
        $this->user = $user;
        $this->password = $password;
    }

    function login(){
      $this->url = 'https://api-ssl.bitly.com/oauth/access_token';
      $this->headervar = 'Content-Type: application/x-www-form-urlencoded';

      $this->options = array(
      CURLOPT_POST => 1,
      CURLOPT_POSTFIELDS => "grant_type=password&username=$this->user&password=$this->password",
      CURLOPT_USERPWD => 'f97b78b88672bed06cf629bba45612ae076468b4' . ':' . '535808a84244c9f55248a178690294691b1f2db9',
      );
    }

    public function token(){
    //json omzetten naar array
       $this->token=json_decode($this->result,true);
    }
}

//ophalen van de groepen van bitly
class GetGroups extends Connection{
    public $groups;

    public function __construct($token){
    $this->token = $token;
    }

    function getGroups(){
      $this->url = 'https://api-ssl.bitly.com/v4/groups';
      $this->headervar = "Authorization: Bearer {$this->token['access_token']}";

      $this->options = array(
      CURLOPT_CUSTOMREQUEST => 'GET',
      );
    }

    public function groups(){
    //json omzetten naar array
      $this->groups = json_decode($this->result,true);
    }
}


// de verbinding voor het toevoegen van een link
class Post extends Connection{
    public $data;

    public function __construct($data, $token){
      $this->token = $token;
      $this->data = $data;
    }

    public function post(){
   
      $this->url = 'https://api-ssl.bitly.com/v4/bitlinks';
 
      $this->headervar = "'Authorization: Bearer {$this->token}', 'Content-Type: application/json'"; 

      $this->options = array(
        CURLOPT_POST => 1,
        CURLOPT_POSTFIELDS => json_encode($this->data),
      );   
    }

    public function headers(){
      $this->headers = array();
      $this->headers[] = "Authorization: Bearer $this->token";
      $this->headers[] = 'Content-Type: application/json';
    }
}

// link voor alle niet verborgen links
class Visible extends Connection{
    public $group;
    public $links;

  public function __construct($group, $token){
    $this->token = $token;
    $this->group = $group;
  }

  public function get(){
   
    $this->url = "https://api-ssl.bitly.com/v4/groups/$this->group/bitlinks?size=10&page=1";
    $this->headervar = "Authorization: Bearer {$this->token}"; 

    $this->options = array(
      CURLOPT_CUSTOMREQUEST=> 'GET',
    );   
  } 

  public function links(){
    $this->links=json_decode($this->result,true);
  }
}


// link voor alle verborgen links
class Hidden extends Connection{
    public $group;
    public $links;

  public function __construct($group, $token){
    $this->token = $token;
    $this->group = $group;
  }

  public function get(){
   
    $this->url = "https://api-ssl.bitly.com/v4/groups/$this->group/bitlinks?size=10&page=1&archived=on";
    $this->headervar = "Authorization: Bearer {$this->token}"; 

    $this->options = array(
      CURLOPT_CUSTOMREQUEST=> 'GET',
    );   
  }

  public function links(){
    $this->links=json_decode($this->result,true);
  }
}

// aanpassen van de links
class Patch extends Connection{
    public $id;
    public $data;
    public $token;

  public function __construct($id, $data, $token){
    $this->id = $id;
    $this->data = $data;
    $this->$token = $token;
  }

  public function patch(){
   
    $this->url = "https://api-ssl.bitly.com/v4/bitlinks/$this->id";
  
    $this->options = array(
    CURLOPT_CUSTOMREQUEST=> 'PATCH',
    CURLOPT_POSTFIELDS => json_encode($this->data),
    );   
  }

  public function headers(){
    $this->headers = array();
    $this->headers[] = "Authorization: Bearer $this->token";
    $this->headers[] = 'Content-Type: application/json';
  }
}


?>