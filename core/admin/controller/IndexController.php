<?php


namespace core\admin\controller;


use core\base\controller\BaseController;

use core\admin\model\Model;

class IndexController extends BaseController
{

    protected function inputData(){

        $db = Model::instance();
        
        $table = 'teachers';

        $files['gallerry_img'] = ["new_red.jpg"];
        $files['img'] = 'main_img.jpg';

        $res = $db->edit($table, [
           'fields' => ['name' => 'ossfsdia'],
            'where' => ['id' => 2]
        ]);

        exit('id=' . $res['id'] . ' Name = ' . $res['name']);
    }
}