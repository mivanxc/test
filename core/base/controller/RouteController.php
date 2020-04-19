<?php


namespace core\base\controller;

use core\base\settings\Settings;
use core\base\settings\ShopSettings;

class RouteController
{
    static private $_instance;


    protected $routes;
    protected $controller;
    protected $inputMethod;
    protected $outputMethod;
    protected $parameters;

    private function __clone()
    {
    }

    static public function getInstance(){
        if(self::$_instance instanceof self){
            return self::$_instance;
        }

        return self::$_instance = new self;
    }

    private function __construct()
    {
        //вызов адрестно строки
     $adress_atr = $_SERVER['REQUEST_URI'];

        //разбирает строку Url и разлогает по полочкам, что контролер что
       //поиск последнего вхождения подстроки в строку
        //если стоит в конце и это не корневой фаил то отпровляем на адрес без /
     if(strrpos($adress_atr, '/') === strlen($adress_atr) -1 && strrpos($adress_atr, '/') !== 0){
         $this->redirect(rtrim($adress_atr, '/'), 301);
     }

     $path = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'], 'index.php'));

     if($path === PATH){

         $this->routes = Settings::get('routes');

         if (!$this->routes) throw new \RangeException('Сат находится на обслуживании');
//если длина строки URL ровна длине админ
         if (strpos($adress_atr, $this->routes['admin']['alias']) === strlen(PATH)){

         }else{
             $url = explode('/', substr($adress_atr, strlen(PATH)));

             $hrUrl = $this->routes['user']['hrUrl'];

             $this->controller = $this->routes['user']['path'];

             $route = 'user';
         }

          $this->createRoute($route, $url);

         exit();

     }else{
         try {
             throw new \Exception('Не корректная дериктория сайта');
         }
         catch (\Exception $e){
             exit($e->getMessage());
         }
     }

    }

    private function createRoute($var, $arr){
        $route = [];

        if (!empty($arr[0])){
            if ($this->routes[$var]['routes'][$arr[0]]){
                $route = explode('/', $this->routes[$var]['routes'][$arr[0]]);

                $this->controller .= ucfirst($route[0].'Controller');
            }else{
                $this->controller .= ucfirst($arr[0].'Controller');
            }
        }else{
            $this->controller .= $this->routes['default']['controller'];
        }

    }

}