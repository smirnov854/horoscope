<?php

use PHPMailer\PHPMailer\PHPMailer;

class Mail
{
    static function send(string $to, string $subject, string $body)
    {
        $mail = new PHPMailer();

        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';

        $mail->isSMTP();
        $mail->Host = Config::SMTP['host'];
        $mail->SMTPAuth = true;
        $mail->Username = Config::SMTP['username'];
        $mail->Password = Config::SMTP['password'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom($mail->Username);
        $mail->addAddress($to);

        $mail->isHTML(true);
        $mail->Subject = '=?UTF-8?B?' . base64_encode($subject) . '?=';
        $mail->Body = $body;

        return $mail->send();
    }
}
