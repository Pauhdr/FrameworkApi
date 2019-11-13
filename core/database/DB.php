<?php
namespace core\database;
class DB {

    private static $instance;
    private $table;
    private $fields = [];
    private $wheres = [];
    private $operators = [
        '=',
        '<',
        '>',
        '<=',
        '>='
    ];

    /**
     * Método para devolver una instancia de DB con la tabla que toca
     *
     * @param [type] $table
     * @return void
     */
    public static function table($table) {
        $instance = new static;
        $instance->setTable($table);
        return $instance;
    }

    private function setTable($table){
        $this->table = $table;
    }

    private function getTable(){
        return $this->table;
    }

    /**
     * selecciona los campos de la tabla para el select
     * ...$fields para que el número de los argumentos pueda ser variable (0,1,2...)
     *
     * @param string ...$fields
     * @return void
     */
    public function select(...$fields){
        foreach ($fields as $field) {
            $this->setField($field);
        }
        return $this;
    }

    private function setField($field) {
        array_push($this->fields, $this->sanitize($field));
    }

    private function sanitize($value) {
        return preg_replace('/[^0-9a-zA-Z_-]/', '', $value);
    }

    public function where($field, $operator, $value) {
        $condition = [
            "field" => $this->sanitize($field),
            "operator" => $this->sanitizeOperator($operator),
            "value" => $this->sanitize($value)
        ];
        $this->setWhere($condition);
        return $this;
    }

    private function sanitizeOperator($operator) {
        if (in_array($operator, $this->operators))
            return $operator;
            else return '=';
    }

    private function setWhere($condition) {
        array_push($this->wheres, $condition);
    }

    //se monta la sentencia sql y el array de parametros para pasarselo a PDOConnection y se retornan los datos del select
    public function get() {
        $where="";
        $field="";
        $params=array();
        if(!empty($this->wheres)){
            $where="WHERE ";
            for($i=0;$i<count($this->wheres);$i++){
              if($i==0){
                $where.=$this->wheres[$i]["field"].
                $this->wheres[$i]["operator"].":".
                $this->wheres[$i]["field"];
                $params[":".$this->wheres[$i]["field"]]= $this->wheres[$i]["value"];
              }else{
                $where=$this->wheres[$i]["field"].
                $this->wheres[$i]["operator"].":".
                $this->wheres[$i]["field"];
                $params[":".$this->wheres[$i]["field"]]= $this->wheres[$i]["value"];
              }

                if($i!=count($this->wheres)-1){
                    $where.=" AND ";
                }
            }
        }
        if(empty($this->fields)){
            $field="*";
        }else{
            for($i=0;$i<count($this->fields);$i++){
                if($i!=count($this->fields)-1){
                    $field.=$this->fields[$i].",";
                }else{
                    $field.=$this->fields[$i];
                }
            }
        }
        $ps="SELECT $field FROM $this->table $where;";
        $connection = PdoConnection::getInstance();
        return $connection->select($ps,$params);
    }

    //se monta la sentencia sql y el array de parametros para pasarselo a PDOConnection y se retorna un boolean que nos indica el resultado del insert
    public function insert($record) {
        $params=array();
        if(!empty($record)){
            $i=0;
            $fields="";
            $vals="";
            foreach ($record as $key => $value) {
                $fields.=$key;
                $vals.=":".$key;
                $params[":".$key]=$value;
                if($i!=count($record)-1){
                    $fields.=", ";
                    $vals.=", ";
                }
                $i++;
            }

        }
        $ps="INSERT INTO $this->table ($fields)VALUES($vals);";
        $connection = PdoConnection::getInstance();
        return $connection->insert($ps,$params);
    }

    public function lastInsertId() {
        $sql="SELECT codigo FROM $this->table ORDER BY codigo DESC LIMIT 1";
        $connection = PdoConnection::getInstance();
        return $connection->lastInsertId($sql);
    }

    //se monta la sentencia sql y el array de parametros para pasarselo a PDOConnection y se retorna un boolean que nos indica el resultado del delete
    public function delete() {
        $where="";
        $params=array();

        if(!empty($this->wheres)){
            for($i=0;$i<count($this->wheres);$i++){
                $where=$this->wheres[$i]["field"].
                $this->wheres[$i]["operator"].":".
                $this->wheres[$i]["field"];
                $params[":".$this->wheres[$i]["field"]]= $this->wheres[$i]["value"];
                if($i!=count($this->wheres)-1){
                    $where.=" AND ";
                }
            }
        }

        $ps="DELETE FROM $this->table WHERE $where";


        $connection = PdoConnection::getInstance();
        return $connection->delete($ps,$params);
    }

    //se monta la sentencia sql y el array de parametros para pasarselo a PDOConnection y se retorna un boolean que nos indica el resultado del update
    public function update($record) {
        $params=array();
        $where="";
        $new="";
        if(!empty($record)){
            $i=0;
            foreach ($record as $key => $value) {
                $new.=$key."=:".$key;
                $params[":".$key]=$value;
                if($i!=count($record)-1){
                    $new.=", ";
                }
                $i++;
            }
        }
        if(!empty($this->wheres)){
            for($i=0;$i<count($this->wheres);$i++){
                $where=$this->wheres[$i]["field"].
                $this->wheres[$i]["operator"].":".
                $this->wheres[$i]["field"];
                $params[":".$this->wheres[$i]["field"]]= $this->wheres[$i]["value"];
                if($i!=count($this->wheres)-1){
                    $where.=" AND ";
                }
            }
        }
        $ps="UPDATE $this->table SET $new WHERE $where;";
        $connection = PdoConnection::getInstance();
        return $connection->update($ps,$params);
    }


}
