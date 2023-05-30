<?php
include_once("./src/main/project/Model/DAO/dbConnection.php");

include_once("./src/main/project/Model/DAO/textDao.php");;

include_once("./src/main/project/Model/objects/text.php");


class TextController{

    /**
     * retorna el objeto text indicado en el parametro $tagText
     */
    public function getText($tagText)
    {
        $conn = $this->getConexion();
        $dao = new textDAO();
        $sqlRow = $dao->getTextByTag($tagText, $conn);
        $text = new Text($sqlRow['tag'], $sqlRow['active'], $sqlRow['id']);
        return $text;
    }

    /**
     * Retorna todas las etiquetas de una pagina dada en formato array
     */
    public function getAll($page){
        $conn = $this->getConexion();
        $dao = new textDAO();
        $array = $dao->getAll($conn, $page);
        $langController = new langController();
        $arrayLangs = $langController->getAllLang();
        $total_paginas = $dao->getCountTotalText($conn);
        $arrayData = [
            "array" => $array,
            "arrayLangs" => $arrayLangs,
            "total_paginas" => $total_paginas,
        ];
        return $arrayData;
    }
    
    /**
     * Crea una etiqueta nueva en base a el objeto etiqueta $text
     */
    public function createText($text){
        $textDao = new textDAO();
        $conn = $this->getConexion();
        $textDao->createText($text, $conn);
    }


    /**
     * Actualiza una etiqueta, primero crea el objeto etiqueta (Text) y luego 
     */
    public function update($id, $textTag, $active){
        $text = new Text($textTag, $active, $id);
        $dao = new textDAO();
        $conn = $this->getConexion();
        $dao->update($text, $conn);
    }

    /**
     * En base al tag de la etiqueta conseguida por GET llama al Dao para destruirlo y redirigir al usuario.
     */
    public function destroyText()
    {
        $textTag = $_GET['textTag'];
        $textDAO = new textDAO();
        $conn = $this->getConexion();
        $textDAO->destroyTextBytag($textTag, $conn);
        header('Location: /?Controller=front&method=getAll');
    }

    /**
     * Crea el objeto de conexion a la base de datos
     */
    protected function getConexion()
    {
        $conn = new dbConnection();
        return $conn->connectDb();
    }
}
