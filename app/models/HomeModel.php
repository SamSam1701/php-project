<?php
class HomeModel extends Model{
    public $_table = 'TASK';

    public function getList(){
        $data = $this->db->query("select * from $this->_table")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

}