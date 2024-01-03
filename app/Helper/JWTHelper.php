<?php

namespace App\Helper;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;

class JWTHelper
{

    public static function CreateToken($userEmail, $userID){
        $key="123-xyz-abc";
        $payload=[
            'iss' =>'laravel-demo',
            'iat' => time(),
            'exp' => time()+60*60,
            'userEmail' =>$userEmail,
            'userID' =>$userID


        ];

        return JWT::encode($payload, $key, 'HS256');

    }

    public static function DecodeToken($token){
        try{
            if( $token === null ){
                return "unsuthorized";
            }else{
                $key="123-xyz-abc";
                return JWT::decode($token, new Key($key,'HS256'));
            }

        }catch(Exception $exception){

            return "unsuthorized";
        }

    }
}