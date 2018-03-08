<?php
/**
 * Created by PhpStorm.
 * User: Mhamdi. R
 * Date: 22/01/2018
 * Time: 00:50
 */

class Database {

    private  $server = "mysql:host=localhost;dbname=creativereservation";
    private  $user = "root";
    private  $pass = "";
    private  $options  = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,);
    protected $con;

    public function openConnection(){
        try{
            $this->con = new PDO($this->server, $this->user,$this->pass,$this->options);
            return $this->con;
        }
        catch (PDOException $e){
            echo "There is some problem in connection: " . $e->getMessage();
        }
    }

    public function closeConnection() {
        $this->con = null;
    }
}