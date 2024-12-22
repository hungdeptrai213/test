<?php
trait QueryBuilder
{
    public $tableName = '';
    public $where = '';
    public $operator = '';
    public $selectField = '*';
    public $limit ='';
    public $orderBy='';
    public $innerJoin='';

    public function table($tableName)
    {
        $this->tableName = $tableName;
        return $this;
    }


    public function where($field, $compare, $value)
    {
        if (empty($this->where)) {
            $this->operator = ' WHERE';
        } else {
            $this->operator = ' AND';
        }
        if (is_numeric($value)) {
            $this->where .= "$this->operator $field $compare $value";
        } else {
            $this->where .= "$this->operator $field $compare '$value'";
        }

        return $this;
    }

    public function orWhere($field, $compare, $value)
    {
        if (empty($this->where)) {
            $this->operator = ' WHERE';
        } else {
            $this->operator = ' OR';
        }
        if (is_numeric($value)) {
            $this->where .= "$this->operator $field $compare $value";
        } else {
            $this->where .= "$this->operator $field $compare '$value'";
        }

        return $this;
    }

    public function whereLike($field, $value)
    {
        if (empty($this->where)) {
            $this->operator = ' WHERE';
        } else {
            $this->operator = ' AND';
        }
     
        $this->where .= "$this->operator $field LIKE '$value'";

        return $this;
    }

    public function limit($number, $offset = 0){
        $this->limit = " LIMIT $offset, $number";
        return $this;
    }

    public function orderBy($field, $type ='ASC'){
        $fieldArr = array_filter(explode(',', $field));
        if(!empty($fieldArr) && count($fieldArr) >= 2){
            $this->orderBy = " ORDER BY $field";
        }else {
            $this->orderBy = " ORDER BY $field $type";
        }
        return $this;
       
    }

    public function innerJoin($tableName, $relationship){
        $this->innerJoin .= " INNER JOIN $tableName ON $relationship";
        return $this;
    }

    public function select($field = '*')
    {
        $this->selectField = $field;
        return $this;
    }


    public function get()
    {

        $sqlQuery = "SELECT $this->selectField FROM $this->tableName $this->innerJoin $this->where $this->orderBy $this->limit ";
        $query = $this->query($sqlQuery, '', true);
        echo $sqlQuery;
        //reset field
        $this->resetField();

        if (!empty($query)) {
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        return false;
    }

    public function first()
    {

        $sqlQuery = "SELECT $this->selectField FROM $this->tableName $this->innerJoin $this->where $this->orderBy $this->limit";
        $query = $this->query($sqlQuery, '', true);
        
        //reset field
        $this->resetField();
        
        if (!empty($query)) {
            return $query->fetch(PDO::FETCH_ASSOC);
        }
        return false;
    }

    public function insert($data){
        $tableN = $this->tableName;
        $insertStatus = $this->insertData($tableN, $data);
        return $insertStatus;
    }

    public function update($data){
        $whereUpdate = str_replace('WHERE', ' ', $this->where);
        $whereUpdate = trim($whereUpdate);
        $tableN = $this->tableName;
        $updateStatus = $this->updateData($tableN, $data, $whereUpdate);
        return $updateStatus;
    }

    public function delete(){
        $whereDelete = str_replace('WHERE', ' ', $this->where);
        $whereDelete = trim($whereDelete);
        $tableN = $this->tableName;
        $deleteStatus = $this->deleteData($tableN, $whereDelete);
        return $deleteStatus;
    }


    public function lastID(){
        return $this->insertId();
    }

    public function resetField(){
        $this->tableName = '';
        $this->where = '';
        $this->operator = '';
        $this->selectField = '*';
        $this->limit='';  
        $this->orderBy='';   
    }
}
