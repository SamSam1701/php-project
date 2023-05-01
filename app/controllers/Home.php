<?php
class Home extends Controller{

    public $model_home;
    public function __construct(){
       $this->model_home = $this->model('HomeModel');
    }

    public function index(){
        // $data = $this->model_home->getList();
        $this->data['sub_content']['title'] = 'Chi tiet san pham';
        $this->data['content'] = 'home/index';
        $this->render('layouts/client_layout', $this->data);
    }

}