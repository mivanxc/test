<?php


namespace core\admin\controller;


class ShowController extends BaseAdmin
{

    protected function inputData(){

        $this->execBase();

        $this->createTableData();

        $this->createData();

        return $this->expansion(get_defined_vars());   //get_defined_vars()-получение масива переменных из облости видимости

    }


    protected function outputData(){


    }
}