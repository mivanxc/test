<?php


namespace core\base\settings;

use core\base\setting\Settings;

class ShopSettings
{

    static private $_instance;
    private $baseSettings;

    private $routes = [
        'admin' => [
            'name'=> 'sudo'
        ],
        'vasya' => [
            'name' => 'vasya'
        ]
    ];

    private $tepmplateArr = [
        'text' => ['price', 'short', 'name'],
        'textarea' => ['goods_content']
    ];

    static public function get ($property){
        return self::$_instance()->$property;
    }

    static public function instance(){
        if (self::$_instance instanceof self){
            return self::$_instance;
        }
        self::$_instance = new self;
        self::$_instance->baseSettings = Settings::instance();
        $baseSettings = self::$_instance->baseSettings->clueProprerties(get_class());
        self::$_instance->setProperty($baseSettings);

        return self::$_instance;
    }

    protected function setProperty($properties){
        if ($properties){
            foreach ($properties as $name => $property){
                $this->$name = $property;
            }
        }
    }

}