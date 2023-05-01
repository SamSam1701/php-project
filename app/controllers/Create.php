<?php
class Create extends Controller{

    public function createTask(){
        $this->data['sub_content']['page_title'] = 'Tạo mới task';
        $this->data['content'] = 'create/create_task';
        $this->render('layouts/client_layout', $this->data);
    }

}