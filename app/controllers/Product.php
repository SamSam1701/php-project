<?php
class Product extends Controller{

    public $data = [];

    public function index(){
        echo 'list products';
    }

    public function listProduct(){
        $product = $this->model('ProductModel');
        $dataProduct = $product->getProductLists();
        
        $title = 'Danh Sach San Pham';
        $this->data['sub_content']['product_list'] = $dataProduct;
        $this->data['sub_content']['page_title'] = $title;
        $this->data['page_title'] = $title;
        $this->data['content'] = 'products/list';
        // render view
        $this->render('layouts/client_layout', $this->data);
    }

    public function detail ($id=0) {
        $product = $this->model('ProductModel');
        $this->data['sub_content']['info'] = $product->getDetail($id);
        $this->data['sub_content']['title'] = 'Chi tiet san pham';
        $this->data['page_title'] = 'Chi tiet san pham';

        $this->data['content'] = 'products/detail';
        $this->render('layouts/client_layout', $this->data);
    }
}