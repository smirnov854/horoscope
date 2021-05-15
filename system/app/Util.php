<?php

class Util
{
    static function redirect(string $path)
    {       
        header('Location: ' . $path);        
        exit;
    }

    static function json($data)
    {
        header('Content-Type: text/json');
        echo json_encode($data);
        exit;
    }
}
