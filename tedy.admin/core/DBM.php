<?php

class DBM {

    private $db;
    private $db_errors;
    public $errors;

    public function __construct($host, $user, $password, $database, $db_errors)
    {
        $this->db = new mysqli($host, $user, $password, $database);
        $this->db->query("SET NAMES 'utf8' COLLATE 'utf-8' ");
        $this->db->query("SET character_set_server='utf8'; ");
        $this->db->query("SET character_set_client='utf8'; ");
        $this->db->query("SET character_set_results='utf8'; ");
        $this->db->query("SET character_set_connection='utf8'; ");
        $this->db->query("SET character_set_database='utf8'; ");
        $this->db->query("SET collation_connection='utf8_general_ci'; ");
        $this->db->query("SET collation_database='utf8_general_ci'; ");
        $this->db->query("SET collation_server='utf8_general_ci'; ");
        $this->db_errors = $db_errors;
    }

    private function equalTo($parameters, $i, $brackets){
        $j = 0;
        $x = "";
        if($i !== 0){
            $x = "AND ";
        }else{
            $x = "WHERE ";
        }
        foreach ($parameters as $key => $value) {
            $column = $key;
            if($j > 0){
                $x .= "AND ";
            }
            if(is_array($value)){
                $k = 0;
                foreach ($value as $key => $value2) {
                    if($k > 0){$x .= "OR ";}
                    $x .= "$column = '$value2' ";
                    ++$k;
                }
            }else{
                $x .= "$column = '$value' ";
            }
            ++$j;
        }
        return $x;
    }

    private function equalOrTo($parameters, $i, $brackets){
        $j = 0;
        $x = "";
        if($i !== 0){
            $x = "AND ";
        }else{
            $x = "WHERE ";
        }
        if($brackets == 1){$x .= " ( ";}
        foreach ($parameters as $key => $value) {
            $column = $key;
            if($j > 0){
                $x .= "OR ";
            }
            if(is_array($value)){
                $k = 0;
                foreach ($value as $key => $value2) {
                    if($k > 0){$x .= "OR ";}
                    $x .= "$column = '$value2' ";
                    ++$k;
                }
            }else{
                $x .= "$column = '$value' ";
            }
            ++$j;
        }
        if($brackets == 1){$x .= " ) ";}
        return $x;
    }

    private function notEqualTo($parameters, $i, $brackets){
        $j = 0;
        $x = "";
        if($i !== 0){
            $x = "AND ";
        }else{
            $x = "WHERE ";
        }
        if($brackets == 1){$x .= " ( ";}
        foreach ($parameters as $key => $value) {
            $column = $key;
            if($j > 0){
                $x .= "AND ";
            }
            if(is_array($value)){
                $k = 0;
                foreach ($value as $key => $value2) {
                    if($k > 0){$x .= "AND ";}
                    $x .= "$column != '$value2' ";
                    ++$k;
                }
            }else{
                $x .= "$column != '$value' ";
            }
            ++$j;
        }
        if($brackets == 1){$x .= " ) ";}
        return $x;
    }

    private function like($parameters, $i, $brackets){
        $j = 0;
        $x = "";
        if($i !== 0){
            $x = "AND ";
        }else{
            $x = "WHERE ";
        }
        if($brackets == 1){$x .= " ( ";}
        foreach ($parameters as $key => $value) {
            $column = $key;
            if($j > 0){
                $x .= "AND ";
            }
            if(is_array($value)){
                $k = 0;
                foreach ($value as $key => $value2) {
                    if($k > 0){$x .= "AND ";}
                    $x .= "$column LIKE '%$value2%' ";
                    ++$k;
                }
            }else{
                $x .= "$column LIKE '%$value%' ";
            }
            ++$j;
        }
        if($brackets == 1){$x .= " ) ";}
        return $x;
    }

    private function notLike($parameters, $i, $brackets){
        $j = 0;
        $x = "";
        if($i !== 0){
            $x = "AND ";
        }else{
            $x = "WHERE ";
        }
        if($brackets == 1){$x .= " ( ";}
        foreach ($parameters as $key => $value) {
            $column = $key;
            if($j > 0){
                $x .= "AND ";
            }
            if(is_array($value)){
                $k = 0;
                foreach ($value as $key => $value2) {
                    if($k > 0){$x .= "AND ";}
                    $x .= "$column NOT LIKE '%$value2%' ";
                    ++$k;
                }
            }else{
                $x .= "$column NOT LIKE '%$value%' ";
            }
            ++$j;
        }
        if($brackets == 1){$x .= " ) ";}
        return $x;
    }

    private function greater($parameters, $i, $brackets){
        $j = 0;
        $x = "";
        if($i !== 0){
            $x = "AND ";
        }else{
            $x = "WHERE ";
        }
        if($brackets == 1){$x .= " ( ";}
        foreach ($parameters as $key => $value) {
            $column = $key;
            if($j > 0){
                $x .= "AND ";
            }
            if(is_array($value)){
                $k = 0;
                foreach ($value as $key => $value2) {
                    if($k > 0){$x .= "AND ";}
                    $x .= "$column > $value2 ";
                    ++$k;
                }
            }else{
                $x .= "$column > $value ";
            }
            ++$j;
        }
        if($brackets == 1){$x .= " ) ";}
        return $x;
    }

    private function less($parameters, $i, $brackets){
        $j = 0;
        $x = "";
        if($i !== 0){
            $x = "AND ";
        }else{
            $x = "WHERE ";
        }
        if($brackets == 1){$x .= " ( ";}
        foreach ($parameters as $key => $value) {
            $column = $key;
            if($j > 0){
                $x .= "AND ";
            }
            if(is_array($value)){
                $k = 0;
                foreach ($value as $key => $value2) {
                    if($k > 0){$x .= "AND ";}
                    $x .= "$column < $value2 ";
                    ++$k;
                }
            }else{
                $x .= "$column < $value ";
            }
            ++$j;
        }
        if($brackets == 1){$x .= " ) ";}
        return $x;
    }

    private function eog($parameters, $i, $brackets){
        $j = 0;
        $x = "";
        if($i !== 0){
            $x = "AND ";
        }else{
            $x = "WHERE ";
        }
        if($brackets == 1){$x .= " ( ";}
        foreach ($parameters as $key => $value) {
            $column = $key;
            if($j > 0){
                $x .= "AND ";
            }
            if(is_array($value)){
                $k = 0;
                foreach ($value as $key => $value2) {
                    if($k > 0){$x .= "AND ";}
                    $x .= "$column >= $value2 ";
                    ++$k;
                }
            }else{
                $x .= "$column >= $value ";
            }
            ++$j;
        }
        if($brackets == 1){$x .= " ) ";}
        return $x;
    }

    private function eol($parameters, $i, $brackets){
        $j = 0;
        $x = "";
        if($i !== 0){
            $x = "AND ";
        }else{
            $x = "WHERE ";
        }
        if($brackets == 1){$x .= " ( ";}
        foreach ($parameters as $key => $value) {
            $column = $key;
            if($j > 0){
                $x .= "AND ";
            }
            if(is_array($value)){
                $k = 0;
                foreach ($value as $key => $value2) {
                    if($k > 0){$x .= "AND ";}
                    $x .= "$column <= $value2 ";
                    ++$k;
                }
            }else{
                $x .= "$column <= $value ";
            }
            ++$j;
        }
        if($brackets == 1){$x .= " ) ";}
        return $x;
    }

    private function setForUpdate($parameters){
        $x = "SET ";
        $j = 0;
        foreach ($parameters as $key => $value) {
            $column = $key;
            if($j > 0){
                $x .= ", ";
            }
            $x .= "`$column` = '$value' ";
            ++$j;
        }
        return $x;
    }

    private function orderBy($parameters){
        return " ORDER BY " . $parameters[0] . " " . $parameters[1];
    }

    private function limit($parameters){
        $x = " Limit " . $parameters[0];
        if(!empty($parameters[1])){
            $x .= ", " . $parameters[1];
        }
        return $x;
    }

    private function groupBy($parameters){
        $x = " GROUP BY " . $parameters[0];
        return $x;
    }

    private function generateMySQL($action, $table, $column, $parameters = null){
        if(is_array($column)){
            $columns = $column;
            $column = "";
            $c = 0;
            foreach ($columns as $key => $value) {
                $column .= ($c > 0) ? ", " . $value : $value;
                ++$c;
            }
        }
        switch ($action) {
            case 'select':
                $q = "SELECT $column FROM $table ";
                break;
            case 'update':
                $q = "UPDATE $table ";
                break;
            case 'join':
                switch ($parameters['join']['type']) {
                    case 'left':
                        $join = "LEFT";
                        break;
                    case 'right':
                        $join = "RIGHT";
                        break;
                    case 'inner':
                        $join = "INNER";
                        break;
                    case 'outer':
                        $join = "FULL OUTER";
                        break;
                }
                $q = "SELECT $column FROM $table[0] " . $join . " JOIN $table[1] ON " . $parameters['join']['on'][0] . " =  " . $parameters['join']['on'][1] . " ";
                break;
            case 'delete':
                $q = "DELETE FROM $table ";
                break;
        }
        if(isset($parameters)){
            $brackets = 0;
            if(in_array('brackets', $parameters)){
                $brackets = 1;
            }
            if(!isset($i)){
                $i = 0;
            }
            if(isset($parameters['set'])){
                $q .= $this->setForUpdate($parameters['set']);
            }
            if(isset($parameters['eq'])){
                $q .= $this->equalTo($parameters['eq'], $i, $brackets);
                $i = 1;
            }
            if(isset($parameters['eqo'])){
                $q .= $this->equalOrTo($parameters['eqo'], $i, $brackets);
                $i = 1;
            }
            if(isset($parameters['not'])){
                $q .= $this->notEqualTo($parameters['not'], $i, $brackets);
                $i = 1;
            }
            if(isset($parameters['li'])){
                $q .= $this->like($parameters['li'], $i, $brackets);
                $i = 1;
            }
            if(isset($parameters['nl'])){
                $q .= $this->notLike($parameters['nl'], $i, $brackets);
                $i = 1;
            }
            if(isset($parameters['greater'])){
                $q .= $this->greater($parameters['greater'], $i, $brackets);
                $i = 1;
            }
            if(isset($parameters['less'])){
                $q .= $this->less($parameters['less'], $i, $brackets);
                $i = 1;
            }
            if(isset($parameters['eog'])){
                $q .= $this->eog($parameters['eog'], $i, $brackets);
                $i = 1;
            }
            if(isset($parameters['eol'])){
                $q .= $this->eol($parameters['eol'], $i, $brackets);
                $i = 1;
            }
            if(isset($parameters['order'])){
                $q .= $this->orderBy($parameters['order'],$i);
                $i = 1;
            }
            if(isset($parameters['limit'])){
                $q .= $this->limit($parameters['limit'],$i);
                $i = 1;
            }
            if(isset($parameters['group'])){
                $q .= $this->groupBy($parameters['group'],$i);
                $i = 1;
            }
        }
        return $q;
    }

    public function getData($table, $column, $parameters = null){
        $query = is_array($table) ? $this->db->query($this->generateMySQL("join", $table, $column, $parameters)) : $this->db->query($this->generateMySQL("select",$table, $column, $parameters));
        if(!$query){
            echo $this->db_errors ? $this->db->error : '';
            return false;
        }
        return json_decode(json_encode($query->fetch_all(MYSQLI_ASSOC)));
    }

    public function query($query){
        $query = $this->db->query($query);
        return json_decode(json_encode($query->fetch_all(MYSQLI_ASSOC)));
    }

    public function check($table, $parameters){
        $query = $this->db->query($this->generateMySQL("select", $table, "*", $parameters));
        return $query->num_rows ? true : false;
    }

    public function insert($table, $parameters){
        $columns = "";
        $values = "";
        $i = 0;
        foreach ($parameters as $column => $value) {
            if($i > 0){
                $columns .= ", $column";
                $values .= ", '$value'";
            }else{
                $columns .= "$column";
                $values .= "'$value'";
            }
            ++$i;
        }
        $query = "INSERT INTO $table ($columns) VALUES ($values)";
        return $this->db->query($query) ? $this->db->insert_id : 0;
    }

    public function update($table, $parameters){
        $query = $this->db->query($this->generateMySQL("update",$table, "",$parameters));
        if(!$query){
            $this->errors = $this->db_errors ? $this->db->error : '';
            return false;
        }
        return true;
    }

    public function rows($table, $parameters){
        $query = (is_array($table)) ? $this->db->query($this->generateMySQL("join", $table, '*', $parameters)) : $this->db->query($this->generateMySQL("select",$table, '*', $parameters));
        return $query->num_rows;
    }

    public function delete($table, $parameters){
        //return $this->generateMySQL("delete",$table, "",$parameters);
        return ($this->db->query($this->generateMySQL("delete",$table, "",$parameters)) == 1) ? true : false;
    }
}
