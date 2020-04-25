<?php
use \Firebase\JWT\JWT;

if(!function_exists('create_jwt')){
    function create_jwt($user){
        $key = "geek#secret#!23";
        $payload = array(
            "context" => array(
                "user" => array(
                    "name" => $user->name,
                    "email" => $user->email,
                    "id" => $user->id
                ),
            ),
            "iss" => "geekuser",
            "aud" => "webchat",
            "sub" => "webchat.geekworkx.net",
            "room" => "Geekworkx"
        );

        $jwt = JWT::encode($payload, $key);
        return $jwt;
    }
}