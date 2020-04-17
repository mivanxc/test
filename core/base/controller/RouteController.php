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
       // $adress_atr = $_SERVER['REQUEST_URI'];

        $a = Settings::instance();
        $a1 = ShopSettings::instance();

        exit();
    }

}