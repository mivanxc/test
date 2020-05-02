<?php


namespace core\admin\controller;


use core\base\controller\BaseController;

use core\admin\model\Model;

class IndexController extends BaseController
{

    protected function inputData(){

        $db = Model::instance();
        
        $table = 'teachers';

        $res = $db->get($table, [
            'fields'=> ['id', 'name'],
            'where' => ['fio' => 'Smernova', 'name' => 'Masha', 'surname' => 'Sergheevna'],
            'operand' => ['=', '<>'],
            'condition' => ['AND'],
            'order' => ['fio', 'name'],
            'order_direction' => ['ASC', 'DESC'],
            'limit' => '1'
        ]);

        exit('I am admin panel');
    }
}