<?php

class Page
{
    static function notFound($message = '')
    {
        http_response_code(404);
        Template::render('notFound', ['message' => $message]);
    }

    static function index()
    {
        Template::render('index');
    }

    static function terms()
    {
        Template::render('terms');
    }

    static function privacy()
    {
        Template::render('privacy');
    }

    static function tariff()
    {
        $tariffs = Db::all("select id, info from tariffs order by id");
        foreach ($tariffs as $k => $v) {
            $tariffs[$k]['info'] = json_decode($v['info'], true);
        }

        Template::render('tariff', ['tariffs' => $tariffs]);
    }
}
