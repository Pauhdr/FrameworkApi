<?php
namespace core\MVC;
use core\database\DB as DB;
abstract class Model {

    protected $table;

    protected $key;

    protected static $instance;

    protected $exists = false;

    protected $new = true;

    protected $attributes = [];

    protected $originals = [];

    private $wheres = [];

    //busca el atributo en el array de atributos en caso de que no exista en la clase
    public function __get($attribute){
        if(array_key_exists($attribute,$this->attributes)){
            $res=$this->attributes[$attribute];
        }else{
            $res="el atributo no existe";
        }
        return $res;
    }

    //añade el atributo al array de atributos en caso de que no lo encuentre
    //aqui haria falta una comprobacion pero no sabia como hacerla sin que me diese error
    public function __set($attribute, $value){
        //if(array_key_exists($attribute,$this->attributes)){
            $this->attributes[$attribute]=$value;
        //}
    }

    private static function getNewInstance(){
        self::$instance = new static;
        return self::$instance;
    }

    public static function getAllToApi(){
      $instance = self::getNewInstance();
      $results = DB::table($instance->getTable())->get();
      return $results;
    }

    public static function getAll() {
        $instance = self::getNewInstance();
        $results = DB::table($instance->getTable())->get();
        return $instance->toInstances($results);
    }

    private function toInstances($results, $exits=true) {
        $instances = [];
        $i=0;
        foreach ($results as $row) {
            $instance = $this->getNewInstance();
            $j= 0;
            foreach ($row as $key => $value) {
                $instance->attributes[$key] = $value;
                $instance->originals[$key] = $value;
                $j++;
            }
            $instance->exists = $exits;
            $instance->new = false;
            $instances[$i] = $instance;
            $i++;
        }
        return $instances;
    }

    public static function find($id) {
        $instance = self::getNewInstance();
        $res=DB::table($instance->getTable())->where($instance->getKey(),"=",$id)->get();
        return $instance->toInstances($res)[0];
    }

    public static function findToApi($id){
      $instance = self::getNewInstance();
      $res=DB::table($instance->getTable())->where($instance->getKey(),"=",$id)->get();
      return $res[0];
    }

    protected function getTable() {
        $table = preg_replace('/[^0-9a-zA-Z_]/', '', $this->table);
        return $table;
    }

    protected function getKey() {
        return $this->key;
    }

    private function setWhere($condition) {
        array_push($this->wheres, $condition);

    }

    protected function where($field, $operator, $value) {
        $condition = [
            "field" => $field,
            "operator" => $operator,
            "value" => $value
        ];
        $this->setWhere($condition);

        return $this;
    }



    public static function __callStatic($method, $arguments){
        return (new static)->$method(...$arguments);
    }

    public function __call($method, $arguments){
        return self::$method(...$arguments);
    }

    protected function get() {
        $instance = self::getNewInstance();
        $res=DB::table($instance->getTable());
        if(isset($this->wheres)){
            foreach ($this->wheres as $value) {
               $res->where($value["field"],$value["operator"],$value["value"]);
            }
        }
        $result=$res->get();
        return $instance->toInstances($result);
    }

    protected function getToApi(){
      $instance = self::getNewInstance();
      $res=DB::table($instance->getTable());
      if(isset($this->wheres)){
          foreach ($this->wheres as $value) {
             $res->where($value["field"],$value["operator"],$value["value"]);
          }
      }
      $result=$res->get();
      return $result;
    }

    public function save(){
        $instance = self::getNewInstance();
        $res=DB::table($instance->getTable());
        if($this->new==true){
            $res->insert($this->attributes);
        }else{

            $res->where($this->key,"=",$this->attributes[$this->key]);
            if(isset($instance->wheres)){
                foreach ($this->wheres as $key) {

                }
            }
            $res->update($this->attributes);
        }
        return $res;
    }

    public function lastInsertId() {
        $instance = self::getNewInstance();
        return DB::table($instance->getTable())->lastInsertId();
    }

    public function delete() {
        $instance = self::getNewInstance();
        $res=DB::table($instance->getTable())->where($this->key,"=",$this->attributes[$this->key]);
        // if(isset($this->wheres)){
        //     foreach ($this->wheres as $key) {
        //         $res->where($key["field"],$key["operator"],$key["value"]);
        //      }$thi
        // }
        return $res->delete();
    }

    /**
     * Devuelve el valor original de la clave primaria
     *
     * @return string
     */
    private function getKeyValue() {
        return $this->originals[$this->getKey()];
    }

}
