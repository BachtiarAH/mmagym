<?php
    namespace LearnPhpMvc\APP;
    require_once __DIR__.'/../../../vendor/autoload.php';
 
    class Router{
        private static array $routes = [];
        
        public static function add(string $method , string $path , string $controller , string $function) :void
        {
            self::$routes[]=[
                'method'=>$method , 
                'path'=>$path,
                'controller'=>$controller,
                'function'=>$function
            ];
        }
        public static function run() :void{
            $path = "/";
            if(isset($_SERVER['PATH_INFO'])){
                $path=$_SERVER['PATH_INFO'];
            }
            $method = $_SERVER['REQUEST_METHOD'];
            foreach(self::$routes as $route){
                $patern = '#^'.$route['path'].'$#';
                if(preg_match($patern , $path , $variables) && $method == $route['method']){
                    $controller = new $route['controller'];
                    $function = $route['function'];
                    array_shift($variables);
                    call_user_func_array([$controller , $function] , $variables);
                    return;
                }
            }
            http_response_code(400);
            echo "404";
        }
    }


?>