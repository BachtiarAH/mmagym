<?php
class App
{
    protected $controller = 'Home';
    protected $method = 'index';
    protected $params = [];


    public function __construct()
    {
        $url = $this->ParseUrl();

        //set controller jika url null dengan controller default
        if($url == NULL)
               {
			$url = [$this->controller];
		}

        //set controller dengan url key 0 atau setelah public di url
        //contoh host/public/[controller]
        //lalu hapus array key 0 yang ada di dalam url
        if (file_exists("../app/controllers/".$url[0].".php")) {
            $this->controller = $url[0];
            unset($url[0]);
        }

        require_once "../app/controllers/".$this->controller.".php";
        $this->controller = new $this->controller;

        //set method dengan value dari url key 1 atau setelah dan seltelahanya lagi dari public
        //contoh host/public/[controller]/[method]
        //lalu hapus array key 1 yang ada didalam url
        if (isset($url[1])) {
            if (method_exists($this->controller,$url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        //mengambil sisa dari array url dan masukan ke aray params
        if (!empty($url)) {
            $this->params = array_values($url);
        }

        call_user_func_array([$this->controller,$this->method],$this->params);
    }

    public function ParseUrl()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'],'/');
            $url = filter_var($url,FILTER_SANITIZE_URL);
            $url = explode('/',$url);
            return $url;
        }
    }
}
