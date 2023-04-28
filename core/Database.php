<?php
class Database{
    private $__conn;
    function __construct() {
        global $db_config;
        $this->__conn = Connection::getInstance($db_config);
    }

    function insert($table, $data){
        if(!empty($data)){
            $fieldStr = '';
            $valueStr = '';
            foreach ($data as $key=>$value) {
                $fieldStr.=$key.',';
                $valueStr.="'".$value."',";
            }
            $fieldStr = rtrim($fieldStr, ',');
            $valueStr = rtrim($valueStr, ',');

            $sql = "Insert into $table($fieldStr) values ($valueStr)";

            $status = $this->query($sql);
            
            if($status){
                return true;
            }
        }
        return false;
    }

    function update($table, $data, $condition=''){
        if(!empty($data)){
            $updateStr='';
            foreach ($data as $key=>$value){
                $updateStr.="$key='$value',";
            }
            $updateStr = rtrim($updateStr, ',');

            if(!empty($condition)){
                $sql = "Update $tale set $updateStr where $condition";
            }else{
                $sql = "Update $tale set $updateStr";
            }
            $status = $this->query($sql);
            if($status){
                return true;
            }
        }
        return false;
    }

    function delete($table, $condition=''){

        if(!empty($condition)){
            $sql = 'delete from '.$tale.' where '.$condition;
        }else {
            $sql = 'delete from'.$table;
        }
        
        $status = $this->query($sql);

        if(status){
            return true;
        }
        return false;
    }

    function query($sql) {

        try {
            $statement = $this->__conn->prepare($sql);
            $statement->execute();
            return $statement;
        } catch(Exception $exception) {
            $mess = $exception->getMessage();
            die($mess);
        }
    }

    function lastInsertID(){
        return $this->__conn->lastInsertID();
    }
}