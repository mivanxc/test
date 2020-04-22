<?php


namespace core\user\controller;


use core\base\controller\BaseController;

class IndexController extends BaseController{

    protected function inputDada(){

        $template = $this->render(false, ['name' => 'Masha']);

        exit($template);
    }

}