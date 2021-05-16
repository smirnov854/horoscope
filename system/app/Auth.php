<?php

class Auth
{
    const SESSION_NAME = 'horoscopeUser';

    static function user()
    {
        return $_SESSION[self::SESSION_NAME] ?? [];
    }

    static function logout()
    {
        unset($_SESSION[self::SESSION_NAME]);
    }

    static function loginForm()
    {
        
        self::logout();

        Template::render('login', ['failure' => isset($_GET['failure'])]);
    }

    static function login()
    {        
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = Db::row("select id, role, email, info from users where email = ? and status = 'active'", [$email]);
        if (!$user) {
            Util::redirect('/login?failure');
        }

        $info = json_decode($user['info'], true);
        if (!password_verify($password, $info['passwordHash'])) {
            Util::redirect('/login?failure');
        }

        unset($user['info']);
        $_SESSION[self::SESSION_NAME] = $user;

        Util::redirect('/');
    }

    static function registerForm()
    {
        self::logout();

        Template::render('register');
    }

    static function register()
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';        

        $user = Db::row("select id from users where email = ?", [$email]);
        if ($user) {
            Util::json(['error' => 'Такой email уже зарегистрирован']);
        }

        $emailVerificationHash = md5(mt_rand());
        $info = json_encode([
            'passwordHash' => password_hash($password, PASSWORD_DEFAULT),
            'emailVerified' => true,
            'emailVerificationHash' => $emailVerificationHash,
            'forgotPasswordHash' => '',
            'forgotPasswordHashValidTo' => '',
        ]);

        $subject = 'Регистрация в сервисе';
        $body = sprintf(
            '<p>Для активации профиля пройдите по этой <a href="%s/verify-email?%s">ссылке</a></p>',
            Config::SERVER_NAME,
            http_build_query(['code' => $emailVerificationHash, 'email' => $email])
        );
        $ok = Mail::send($email, $subject, $body);
        if (!$ok) {
            Util::json(['error' => 'Регистрация в данный момент недоступна. Попробуйте позже.']);
        }

        $quizTemplate = Quiz::emptyTemplate();
        Db::exec(
            "insert users set status = 'new', role = 'user', email = ?, info = ?, quiz_template = ?",
            [$email, $info, $quizTemplate]
        );

        Util::json([
            'message' => '
                Мы выслали на указанный адрес письмо со ссылкой для активации профиля.
                Пройдите по ссылке из письма.
            '
        ]);
    }

    static function forgotForm()
    {
        self::logout();

        Template::render('forgot');
    }

    static function forgot()
    {
        $email = $_POST['email'] ?? '';

        $info = Db::field("select info from users where email = ?", [$email]);
        if (!$info) {
            Util::json(['error' => 'Такой email не зарегистрирован']);
        }

        $info = json_decode($info, true);
        $hash = md5(mt_rand());
        $info['forgotPasswordHash'] = $hash;
        $info['forgotPasswordHashValidTo'] = date('Y-m-d H:i:s', time() + 60 * 60);
        $info = json_encode($info);
        Db::exec("update users set info = ? where email = ?", [$info, $email]);

        $subject = 'Восстановление доступа';
        $body = sprintf(
            '<p>Для восстановления доступа пройдите по этой <a href="%s/reset?%s">ссылке</a></p>',
            Config::SERVER_NAME,
            http_build_query(['code' => $hash, 'email' => $email])
        );
        $ok = Mail::send($email, $subject, $body);
        if (!$ok) {
            Util::json(['error' => 'Восстановление в данный момент недоступно. Попробуйте позже.']);
        }

        Util::json([
            'message' => '
                Мы выслали на указанный адрес письмо со ссылкой для восстановления доступа.
                Пройдите по ссылке из письма. Ссылка действительна в течение одного часа.
            '
        ]);
    }

    static private function validateResetPasswordCode($email, $code) {
        $info = Db::field("select info from users where email = ?", [$email]);
        if (!$info) {
            return false;
        }

        $info = json_decode($info, true);

        $hash = $info['forgotPasswordHash'] ?? '';
        if ($hash !== $code) {
            return false;
        }

        $validTo = strtotime($info['forgotPasswordHashValidTo'] ?? '');
        if (time() > $validTo) {
            return false;
        }

        return true;
    }

    static function resetPasswordForm()
    {
        self::logout();

        $email = $_GET['email'] ?? '';
        $code = $_GET['code'] ?? '';

        if (!self::validateResetPasswordCode($email, $code)) {
            Template::render('resetPasswordFailed');
        } else {
            Template::render('resetPasswordForm', ['email' => $email, 'code' => $code]);
        }
    }

    static function resetPassword()
    {
        $email = $_POST['email'] ?? '';
        $code = $_POST['code'] ?? '';
        $password = $_POST['password'] ?? '';
        $password2 = $_POST['password2'] ?? '';

        if (!$email || !$code) {
            Util::redirect('/reset');
        }

        if (!self::validateResetPasswordCode($email, $code)) {
            Util::redirect('/reset');
        }

        $info = Db::field("select info from users where email = ?", [$email]);
        if (!$info) {
            Util::redirect('/reset');
        }

        if (!trim($password)) {
            Util::json(['error' => 'Указан пустой пароль']);
        }

        if (md5($password) != md5($password2)) {
            Util::json(['error' => 'Пароли не совпадают']);
        }

        $info = json_decode($info, true);
        $info['passwordHash'] = password_hash($password, PASSWORD_DEFAULT);
        $info = json_encode($info);

        Db::exec("update users set info = ? where email = ?", [$info, $email]);

        Util::json(['ok' => true]);
    }

    static function verifyEmail()
    {
        self::logout();

        $error = false;
        

        $email = trim($_GET['email'] ?? '');
        $hash = trim($_GET['code'] ?? '');

        
        if (empty($hash)) {
            $error = true;
        }

        if (!$error) {
            $info = Db::field("select info from users where email = ? and status = 'new'", [$email]);
            if (!$info) {
                $error = true;
            }
        }
        
       
        if (!$error) {
            $info = json_decode($info, true);
            if (!$info['emailVerificationHash'] || $info['emailVerificationHash'] !== $hash) {
                $error = true;
            }
        }

        if (!$error) {
            if (!$info['emailVerified']) {
                $error = true;
            }
        }

        if (!$error) {
            $info['emailVerified'] = true;
            $info = json_encode($info);
            Db::exec("update users set status = 'active', info = ? where email = ?", [$info, $email]);
        }

        Template::render('verifyEmail', ['error' => $error]);
    }
}
