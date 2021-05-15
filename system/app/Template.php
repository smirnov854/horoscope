<?php

class Template
{
    static function render(string $template, array $variables = [])
    {
        extract($variables);
        unset($variables);

        include __DIR__ . '/../templates/' . $template . '.php';
    }
}
