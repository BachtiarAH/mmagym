<?php

namespace LearnPhpMvc\APP;

class View
{
    public static function render(string $view, $model)
    {
        require __DIR__ . '../../view/componen/' .'header.php';
        require __DIR__ . '../../view/componen/' .'style.php';
        require __DIR__ . '../../view/template/' .'navbar.php';
        require __DIR__ . '/../view/' . $view. '.php';
        require __DIR__ . '../../view/componen/' .'script.php';
        require __DIR__ . '/../view/componen/' . 'footer.php';
    }
    public static function redirect(string $url)
    {
        header("location:$url");
        if(getenv('mode') != 'test'){
            exit();
        }
    }
    
    public static function renderWithoutNavbar(string $view, $model)
    {
        require __DIR__ . '../../view/componen/' .'header.php';
        require __DIR__ . '../../view/componen/' .'style.php';
        // require __DIR__ . '../../view/template/' .'navbar.php';
        require __DIR__ . '/../view/' . $view. '.php';
        require __DIR__ . '../../view/componen/' .'script.php';
        require __DIR__ . '/../view/componen/' . 'footer.php';
    }
}