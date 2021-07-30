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


  function __construct($data, $id, $token, $method, $visibility, $group)
  {
    $this->data = $data;
    $this->id = $id;
    $this->token = $token;
    $this->method = $method;
    $this->visibility = $visibility;
    $this->group = $group;
  }

  function connect()
  {
    $ch = curl_init();
if($this->id == 'none'){curl_setopt($ch, CURLOPT_URL, 'https://api-ssl.bitly.com/v4/bitlinks');}
if($this->visibility == 'visible'){curl_setopt($ch, CURLOPT_URL, "https://api-ssl.bitly.com/v4/groups/$group/bitlinks?size=10&page=1");}
if($this->visibility == 'hidden'){curl_setopt($ch, CURLOPT_URL, "https://api-ssl.bitly.com/v4/groups/$group/bitlinks?size=10&page=1&archived=on");}
  else{curl_setopt($ch, CURLOPT_URL, "https://api-ssl.bitly.com/v4/bitlinks/$this->id");}

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
if($this->method =='post'){curl_setopt($ch, CURLOPT_POST, 1);}
if($this->method == 'patch'){curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');}
if($this->method == 'get'){curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');}
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($this->data));

$headers = array();
$headers[] = "Authorization: Bearer {$this->token}";
$headers[] = 'Content-Type: application/json';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);

if (curl_errno($ch)) 
    {
        echo 'Error:' . curl_error($ch);
    }

curl_close($ch);
  }
}


