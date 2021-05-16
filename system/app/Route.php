<?php

class Route
{
    static $routes = [
        'GET /' => ['Page::index', ['user', 'admin']],
        'GET /register' => ['Auth::registerForm', []],
        'POST /register' => ['Auth::register', []],
        'GET /verify-email/([\w\-\_]+@)' => ['Auth::verifyEmail', []],
        'GET /login' => ['Auth::loginForm', []],
        'POST /login' => ['Auth::login', []],
        'GET /forgot' => ['Auth::forgotForm', []],
        'POST /forgot' => ['Auth::forgot', []],
        'GET /reset' => ['Auth::resetPasswordForm', []],
        'POST /reset' => ['Auth::resetPassword', []],
        'GET /terms' => ['Page::terms', []],
        'GET /privacy' => ['Page::privacy', []],
        'GET /base-template' => ['Quiz::baseTemplate', ['admin']],
        'POST /base-template' => ['Quiz::saveBaseTemplate', ['admin']],
        'GET /template' => ['Quiz::template', ['user', 'admin']],
        'GET /template/(\d+)' => ['Quiz::template', ['admin']],
        'POST /template' => ['Quiz::saveTemplate', ['user', 'admin']],
        'POST /template/(\d+)' => ['Quiz::saveTemplate', ['admin']],
        'GET /tariff' => ['Page::tariff', ['user', 'admin']],
        'GET /quiz' => ['Quiz::form', ['user', 'admin']],
        'GET /quiz/(\d+)' => ['Quiz::form', ['admin']],
        'POST /quiz' => ['Quiz::save', ['user', 'admin']],
        'POST /quiz/(\d+)' => ['Quiz::save', ['admin']],
        'GET /q/([\w\-\_]+)' => ['Quiz::process', []],
        'POST /q/([\w\-\_]+)' => ['Quiz::saveProcess', []],
        'POST /q/([\w\-\_]+)/result' => ['Quiz::result', []],
        'GET /quizes' => ['Quiz::processedList', ['user', 'admin']],
        'GET /quizes/(\d+)' => ['Quiz::processedItem', ['user', 'admin']],
        'GET /domains' => ['Quiz::domains', ['admin']],        
        'POST /domains' => ['Quiz::saveDomains', ['admin']],
        'GET /admin-edit-template' => ['Admin::editTemplate', ['admin']],
        'POST /admin-edit-template' => ['Quiz::saveBaseTemplate', ['admin']],
        'GET /short_link_prepare' => ['ShortLinkRebrandly::genarate_quiz_link', []],
        
    ];

    static function dispatch()
    {
        
        $requestLine = $_SERVER['REQUEST_METHOD'] . ' ' . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        //die();
        /*
        var_dump($requestLine);
        die();*/
        foreach (self::$routes as $pattern => $info) {
            
            $parts = explode(' ', $pattern);
            $pattern = $parts[0] . ' ' . $parts[1];
            if (preg_match('#^' . $pattern . '$#', $requestLine, $params)) {

                $user = Auth::user();                
                $role = $user ? $user['role'] : '';
                
                if (!empty($info[1]) && !in_array($role, $info[1], true)) {                    
                    Util::redirect('/login');                    
                }             
                
                array_shift($params);
                call_user_func_array($info[0], array_values($params));
                return;
            }
        }    
        Page::notFound();
    }
}
