<?php
// verbinden met bitly
class Connect 
{
    public $data;
    public $id;
    public $token;
    public $method;
    public $visibility;
    public $group;
    public $links;


  public function __construct($data, $id, $token, $method, $visibility, $group)
  {
    $this->data = $data;
    $this->id = $id;
    $this->token = $token;
    $this->method = $method;
    $this->visibility = $visibility;
    $this->group = $group;
   
  }

  public function connect()
  {
    $ch = curl_init();
    if($this->id == 'none'){curl_setopt($ch, CURLOPT_URL, 'https://api-ssl.bitly.com/v4/bitlinks');}
    if($this->visibility == 'visible'){curl_setopt($ch, CURLOPT_URL, "https://api-ssl.bitly.com/v4/groups/$this->group/bitlinks?size=10&page=1");}
    elseif($this->visibility == 'hidden'){curl_setopt($ch, CURLOPT_URL, "https://api-ssl.bitly.com/v4/groups/$this->group/bitlinks?size=10&page=1&archived=on");}
    else{curl_setopt($ch, CURLOPT_URL, "https://api-ssl.bitly.com/v4/bitlinks/$this->id");}

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    
    switch($this->method){
    case 'post': 
        curl_setopt($ch, CURLOPT_POST, 1);
        break;
    case 'patch':
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
      break;
    case 'get':
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
      break;

    if($this->method !== 'get'){curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($this->data));} // niet nodig met een get request
    }
    $headers = array();
    $headers[] = "Authorization: Bearer {$this->token}";

    if($this->method !== 'get'){$headers[] = 'Content-Type: application/json';} // niet nodig met een get request

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);

    if (curl_errno($ch)) 
        {
            echo 'Error:' . curl_error($ch);
        }

    curl_close($ch);

    if($this->method == 'get'){$this->links = json_decode($result, true);}
  }
}


