<?php
namespace core\database;

use PDOException;

class PdoConnection {

    /**
     * Instancia de la clase
     *
     * @var PDOConnection
     */
    private static $instance = null;
    /**
     * conexión con la bbdd
     *
     * @var PDO
     */
    public $bbdd;
    

    private function __construct(){
        $conn=$GLOBALS["config"]["BD"]["CONNECTION"];
        $host=$GLOBALS["config"]["BD"]["HOST"];
        $port=$GLOBALS["config"]["BD"]["PORT"];
        $dbname=$GLOBALS["config"]["BD"]["NAME"];
        $usuario=$GLOBALS["config"]["BD"]["USERNAME"];
        $password=$GLOBALS["config"]["BD"]["PASSWORD"];
        try {
            $this->bbdd= new \PDO("$conn:host=$host;dbname=$dbname",$usuario,$password);
            //echo "conectado";
        } catch (\Throwable $th) {
            echo "no conectado";
        }
    }

    public static function getInstance() {
        if(self::$instance == null){
            self::$instance=new PdoConnection();
        }
        return self::$instance;
        
    }


    public function select($query, $params = null){
        return $this->execQuery($query,$params);
    }

    public function insert($query, $params){
        return $this->execQueryNoResult($query,$params);
    }

    public function lastInsertId($sql) { 
        $params=null;
        return $this->execQuery($sql,$params)[0]["codigo"];
    }

    public function update($query, $params){
        return $this->execQueryNoResult($query,$params);
    }


    public function delete($query, $params){ 
        return $this->execQueryNoResult($query,$params);   
    }

    private function execQuery($query, $params) {
        $ps=$this->bbdd->prepare($query);
        $ps->execute($params);
        return $ps->fetchAll(\PDO::FETCH_ASSOC);
    }

    private function execQueryNoResult($query, $params) {
        $ps=$this->bbdd->prepare($query);
        return $ps->execute($params);
    }

};