<?php
class TaskModel extends Model {
    public $_table = 'TASK';

    // public function getList(){
    //     $data = $this->db->query("select * from $this->_table")->fetchAll(PDO::FETCH_ASSOC);
    //     return $data;
    // }

    public function getList($page, $limit) {
        $offset = ($page - 1) * $limit;
        $data = $this->db->query("SELECT * FROM $this->_table LIMIT $limit OFFSET $offset")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getTotalRecords() {
        $data = $this->db->query("SELECT COUNT(*) FROM $this->_table")->fetchColumn();
        return $data;
    }

    public function deleteTask($task_id){

        $sql = "DELETE FROM $this->_table WHERE id = $task_id";
        $result = $this->db->query($sql);
        return $result;
    }
}