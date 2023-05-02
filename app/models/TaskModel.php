<?php
class TaskModel extends Model {
    public $_table = 'TASK';

    public function getList($page, $limit) {
        $offset = ($page - 1) * $limit;
        $data = $this->db->query("SELECT t.*, c.name as category_name FROM $this->_table t 
        JOIN CATEGORY c ON t.category_id = c.id 
        LIMIT $limit OFFSET $offset")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getTotalRecords() {
        $data = $this->db->query("SELECT COUNT(*) FROM $this->_table")->fetchColumn();
        return $data;
    }

    public function deleteTask($task_id){
        return $this->db->delete($this->_table, 'id = '.$task_id);
    }

    public function getDetail($task_id){
        $data = $this->db->query("SELECT t.*, c.name as category_name FROM $this->_table t
        JOIN CATEGORY c ON t.category_id = c.id
        WHERE t.id = '$task_id'")->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
    public function updateTask($task_id, $data, $condition = '') {
        return $this->db->update($this->_table, $data, "id = '$task_id' $condition");
    }

}