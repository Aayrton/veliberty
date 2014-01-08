<?php
class PDOManager
{
    private $pdo_usr = "root";
    private $pdo_pwd = "";
    private $pdo_db = "velib";



    public function newPdo(){
        try
        {
            $pdo = new PDO('mysql:host=localhost;dbname=' . $this->pdo_db, $this->pdo_usr, $this->pdo_pwd);
            return $pdo;
        }
        catch (Exception $e)
        {

            die('Error : ' . $e->getMessage());
        }
    }
}

