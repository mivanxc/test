<?php


namespace core\admin\controller;


use core\base\controller\BaseController;

use core\admin\model\Model;

class IndexController extends BaseController
{

    protected function inputData(){

        $db = Model::instance();
        
        $table = 'teachers';
        $color = ['rer', 'blue', 'gialo'];

        $res = $db->get($table, [
            'fields'=> ['id', 'name'],
            'where' => ['name' => 'masha, sveta, dasha', 'surname' => 'Sergheevna',
                'fio' => 'andrei', 'car' => 'porshe', 'color' => $color ],
            'operand' => ['IN', 'LIKE%', '<>', '=', 'NOT IN'],
            'condition' => ['AND', 'OR', 'AND'],
            'order' => ['fio', 'name'],
            'order_direction' => ['DESC'],
            'limit' => '1'
        ]);

        exit('I am admin panel');
    }
}