<?php
namespace Src\jwt;
class Handler{
    protected function base64UrlEncode($text){
        return str_replace(['+','/','='],['-','_',''],base64_encode($text));
    }

    public function attempt($credentials){
        //we will verify user info and fetch the user with the specified data
        //i assume the returned user has id 1
        $secret=getenv('SECRET');

        $user_id=1;
        $exp=strtotime(date('Y-m-d H:i:s').'+ 5 minute');

        $payload=json_encode([
            'user_id'=>$user_id,
            'exp'=>$exp
        ]);

        $header=json_encode([
            'typ'=>'JWT',
            'alg'=>'HS256'
        ]);

        //encode the individual parts
        $base64header=$this->base64UrlEncode($header);
        $base64payload=$this->base64UrlEncode($payload);
        $signature=hash_hmac('sha256',$base64header.".".$base64payload,$secret);

        //encode the signature
        $base64signature=$this->base64UrlEncode($signature);

        //now create the JWT token
        $jwt=$base64header.".".$base64payload.".".$base64signature;

        return $jwt;
    }

   
}