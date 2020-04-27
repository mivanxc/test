<?php


namespace core\base\controller;

use core\base\exceptions\RouteException;

abstract class BaseController
{
    protected $page;
    protected $errors;

    protected $controller;
    protected $inputMethod;
    protected $outputMethod;
    protected $parameters;


    public function route(){

        $controller = str_replace('/', '\\', $this->controller);

        try {

            $object = new \ReflectionMethod($controller, 'request');

            $args = [
                'parameters' => $this->parameters,
                'inputMethod' => $this->inputMethod,
                'outputMethod' => $this->outputMethod
            ];
                     /** invoke вызов метода ()обект класса и масив свойств */
            $object->invoke(new $controller, $args);
        }

        catch (\ReflectionException $e) {
            throw new RouteException($e->getMessage());
        }

    }

    public function request($args){

        $this->parameters = $args['parameters'];

        $inputData = $args['inputMethod'];
        $outputData = $args['outputMethod'];

         $data = $this->$inputData();

         if (method_exists($this, $outputData)) {

             $page = $this->$outputData($data);
             if ($page)  $this->page = $data;

         }elseif ($data) {
             $this->page = $data;
         }

        if ($this->errors){
            $this->writeLog();
        }

        $this->getPage();
    }

    protected function render($path = '', $parameters = []){

        extract($parameters);

        if (!$path){

            $path = TEMPLATE . explode('controller', strtolower((new \ReflectionClass($this))->getShortName()))[0];
        }

        ob_start();

        if (!@include_once $path . '.php') throw new RouteException('отсутствует шаблон-' .$path);

        return ob_get_clean();
    }

    protected function getPage(){

        if (is_array($this->page)){
            foreach ($this->page as $block) echo $block;
        }else {
            echo $this->page;
        }
        exit();
    }

}
