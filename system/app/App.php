<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once __DIR__ . '/../vendor/autoload.php';
 
require_once __DIR__ . '/Config.php';
require_once __DIR__ . '/Util.php';
require_once __DIR__ . '/Mail.php';
require_once __DIR__ . '/Db.php';
require_once __DIR__ . '/Route.php';
require_once __DIR__ . '/Template.php';
require_once __DIR__ . '/Page.php';
require_once __DIR__ . '/Auth.php';
require_once __DIR__ . '/Quiz.php';
require_once __DIR__ . '/Admin.php';
require_once __DIR__ . '/ShortLinkRebrandly.php';

class App
{
    static function run()
    {
        date_default_timezone_set('Europe/Moscow');

        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }       
        Route::dispatch();
    }
}
