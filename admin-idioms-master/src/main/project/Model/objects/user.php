<?php
include_once("./src/main/project/Model/objects/dbConnection.php");
class User{
    private $user;

    private $name;

    private $email;

    private $hashedPassword;

    public function __construct($email, $user = "", $name= "")
    {
       $this->user = $user;
       $this->name = $name;
       $this->email = $email;
    }

    public function setHashPassword($password){
        $this->hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    }

    public function getUser(){
        return $this->user;
    }

    public function getName(){
        return $this->name;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getHasPassword(){
        return $this->hashedPassword;
    }

    public function setUser($newUser){
        $this->user = $newUser;
    }

    public function setName($newName){
        $this->name = $newName;
    }

    public function setEmail($newEmail){
        $this->email = $newEmail;
    }

    /*
    *  Funcion para insertar usuarios a la db, llama a $this->connectDb() para crear el objeto $conn. Recibe los parametros necesarios para despues
    *  poder insertarlos
    */
    public function insertUser(){
        $dbConn = new dbConection();
        $conn = $dbConn->connectDb();

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "INSERT INTO users (user, name, email, password) VALUES (" . $this->user . ", " . $this->name . ", " . $this->email . ", " . $this->hashedPassword . ")";
        
        if(mysqli_query($conn, $sql)){
            echo "Datos insertados correctamente";
        }else{
            echo "Error: ". mysqli_error($conn); 
        }
        mysqli_close($conn);
    }

    public function create(){
        $dbConn = new dbConection();
        $conn = $dbConn->connectDb();
        $sql = "INSERT INTO users (user, name, email, password) VALUES (" . $this->user . ", " . $this->name . ", " . $this->email .", " . $this->hashedPassword . ")";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
            return true;
        }else{
            return false;
        }
    }

    public function login(){
        $dbConn = new dbConection();  
        $conn = $dbConn->connectDb();
        $sql = "SELECT * FROM users where email = " . $this->email . " AND password = " . $this->hashedPassword;
     
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
            return true;
        }else{
            return false;
        }
    }

    public function destroy($email){
        $dbConn = new dbConection();
        $conn = $dbConn->connectDb();
        $sql = "DELETE FROM users WHERE email = " . $email;
        if(mysqli_query($conn, $sql)){
            return true;
        }else{ 
            echo "No se ha encontrado el resultado"; 
            return false;
        }
    }
}

?>