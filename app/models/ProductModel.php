<?php
class ProductModel {
    public function getProductLists() {
        return [
            'san pham 1',
            'san pham 2',
            'san pham 3'
        ];
    }

    public function getDetail($id){
        $data = [
            'sp1',
            'sp2',
            'sp3'
        ];
        return $data[$id];
    }
}