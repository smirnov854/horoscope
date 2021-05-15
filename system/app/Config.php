<?php

class Config
{
    const SERVER_NAME = '';
    const BASE_DIR = __DIR__ . '/../..';

    const DB = [
        'host' => 'localhost',
        'name' => 'horoscope',
        'user' => 'root',
        'password' => 'root',
        'charset' => 'utf8',
    ];

    const SMTP = [
        'host' => 'smtp.yandex.ru',
        'username' => 'm9-x@yandex.ru',
        'password' => 'eqnedrfqjukzllsm',
    ];
}
