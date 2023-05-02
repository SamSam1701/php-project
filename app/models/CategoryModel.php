<?php
class CategoryModel extends Model {
    public $_table = 'CATEGORY';

    public function getListCategories() {
       $data = $this->db->query("SELECT * from $this->_table");
        return $data;
    }

}