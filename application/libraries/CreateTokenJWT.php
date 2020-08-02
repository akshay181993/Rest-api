<?php 

require APPPATH . '/libraries/JWT.php';//jwt token class


class CreateTokenJWT
{
    PRIVATE $key = "codeigniter_task"; //static key
    // To encode and generate new token 
    public function GenerateToken($data)
    {         
        $jwt = JWT::encode($data, $this->key);
        return $jwt;
    }
   //To decode token  
    public function DecodeToken($token)
    {         
        $decoded = JWT::decode($token, $this->key, array('HS256'));
        $decodedData = (array) $decoded;
        return $decodedData;
    }
}


 ?>