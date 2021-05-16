<?php

class ShortLinkRebrandly
{
    
    private $api_key = "cbb387f8116d4ccbb4bb7a63ecd565d4";


    static public function generate_quiz($link){
        $link = "http://project.telegrammbots.ru/quiz";
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.rebrandly.com/v1/links');

        $params = [
            "Content-Type"=>"application/json",
            "apikey"=> self::api_key,            
        ];

        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $data = curl_exec($ch);
        curl_close($ch);
        var_dump($data);
    }
}
