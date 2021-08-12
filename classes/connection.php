<?php
 class Login{
    public $user;
    public $password;
    public $token;

     public function __construct($user, $password){
         $this->user = $user;
        $this->password = $password;
     
     }     

function default()
{
    $url = 'https://api-ssl.bitly.com/oauth/access_token';
    $headervar = 'Content-Type: application/x-www-form-urlencoded';

    $defaults = array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => 1,
          CURLOPT_POST => 1,
          CURLOPT_POSTFIELDS => "grant_type=password&username=$this->user&password=$this->password",
          CURLOPT_USERPWD => 'f97b78b88672bed06cf629bba45612ae076468b4' . ':' . '535808a84244c9f55248a178690294691b1f2db9',
        );

    $ch = curl_init();
      curl_setopt_array($ch, ($defaults));
      
    $headers = array();
    $headers[] = $headervar;
    
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

      $result = curl_exec($ch);
      if (curl_errno($ch)) 
        {
          echo 'Error:' . curl_error($ch);
        }
      
      //json omzetten naar array
       $this->token=json_decode($result,true);
      
       curl_close($ch);
}
 }






?>