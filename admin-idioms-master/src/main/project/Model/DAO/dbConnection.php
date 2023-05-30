<?php

require_once("src/privada/dbAcces.php");
class dbConnection
{
    private $dbAccess;
    public $serverName;
    public $userName;
    public $password;
    public $dbName;

    public function __construct()
    {
        $this->dbAccess = new dbAccesData();
        $this->serverName = $this->dbAccess->serverName;
        $this->userName = $this->dbAccess->userName;
        $this->password = $this->dbAccess->password;
        $this->dbName = $this->dbAccess->dbName;
    }

    /*
    *    Conecta con la base de datos usando los valores del objeto
    */
    public function connectDb()
    {
        $conn = new mysqli($this->serverName, $this->userName, $this->password, $this->dbName);
        if (!$conn) {
            echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
        }
        return $conn;
    }
}


class db
{

    private $serverName = "localhost";

    private $userName = "root";

    private $password = "";

    private $dbName = "adminpanel";

    public function connectDb()
    {
        $conn = new mysqli($this->serverName, $this->userName, $this->password, $this->dbName);
        if (!$conn) {
            echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
        }
        return $conn;
    }
}
