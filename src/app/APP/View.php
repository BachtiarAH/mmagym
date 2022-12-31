<?php

namespace LearnPhpMvc\APP;

use LearnPhpMvc\Config\Url;
// use LearnPhpMvc\Exeptions\RestClient;
use RestClient as GlobalRestClient;

// use LearnPhpMvc\Exeptions\RestClientException;

class View
{
    public static function render(string $view, $model)
    {
        session_start();
        if (!isset($_SESSION['id'])) {
            View::redirect('/admin/login');
        } 
        $api = new GlobalRestClient([
            'base_url' => Url::BaseUrl(),
        ]);

        require __DIR__ . '../../view/componen/' . 'header.php';
        require __DIR__ . '../../view/componen/' . 'style.php';
        require __DIR__ . '../../view/componen/' . 'bodyStart.php';
        require __DIR__ . '../../view/template/' . 'navbar.php';
        require __DIR__ . '../../view/template/' . 'sidebar.php';
        require __DIR__ . '../../view/componen/' . 'scriptFirst.php';
        require __DIR__ . '/../view/' . $view . '.php';
        require __DIR__ . '../../view/componen/' . 'script.php';
        require __DIR__ . '/../view/componen/' . 'footer.php';
    }
    public static function redirect(string $url)
    {
        $baseUrl = Url::BaseUrl();
        header("location:" . "$baseUrl" . "$url");
        if (getenv('mode') != 'test') {
            exit();
        }
    }


    public static function getUrl($url)
    {
        return Url::BaseUrl() . $url;
    }

    public static function renderWithoutNavbar(string $view, $model)
    {
        session_start();
        require __DIR__ . '../../view/componen/' . 'header.php';
        require __DIR__ . '../../view/componen/' . 'style.php';
        require __DIR__ . '../../view/componen/' . 'scriptFirst.php';
        // require __DIR__ . '../../view/template/' .'navbar.php';
        require __DIR__ . '/../view/' . $view . '.php';
        require __DIR__ . '../../view/componen/' . 'script.php';
        require __DIR__ . '/../view/componen/' . 'footer.php';
    }

    public static function renderOnly(string $view, $model)
    {
        session_start();
        // require __DIR__ . '../../view/componen/' .'header.php';
        // require __DIR__ . '../../view/componen/' .'style.php';
        // require __DIR__ . '../../view/template/' .'navbar.php';
        require __DIR__ . '/../view/' . $view . '.php';
        // require __DIR__ . '../../view/componen/' .'script.php';
        // require __DIR__ . '/../view/componen/' . 'footer.php';
    }
}
