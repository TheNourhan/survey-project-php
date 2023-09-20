<?php

class DB_connect{
    private $user="root";
    private $pass="";

    protected function connect(){
       try{
            $dbh= new PDO("mysql:host=localhost; dbname=accounts",$this->user,$this->pass);
            return $dbh;
            
        }catch(PDOExeption $e){
            print "<br>Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

}