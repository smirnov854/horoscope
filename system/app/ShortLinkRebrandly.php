<?php

class ShortLinkRebrandly
{
    
    static $api_key = "cbb387f8116d4ccbb4bb7a63ecd565d4";


    static public function genarate_quiz_link($link){
        
        $ch = curl_init();
        $headers = [];
        $headers[] = "Content-Type: application/json";
        $headers[] = 'apikey:'.self::$api_key;
            
        curl_setopt($ch, CURLOPT_URL, 'https://api.rebrandly.com/v1/links');
        //curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $params = [
            "domain"=>["fullName"=>"rebrand.ly"],
            "destination"=>$link
        ];

        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $data = curl_exec($ch);
        curl_close($ch);
        $decoded = json_decode($data);
        $result = [
            "link"=>$decoded->shortUrl,
            "slashtag"=>$decoded->slashtag,
        ];
        return $result;
    }
}
