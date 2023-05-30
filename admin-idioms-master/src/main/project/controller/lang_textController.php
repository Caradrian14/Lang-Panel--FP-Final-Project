<?php
include_once("./src/main/project/Model/DAO/dbConnection.php");

include_once("./src/main/project/controller/textController.php");

include_once("./src/main/project/Model/DAO/textLangDAO.php");
include_once("./src/main/project/Model/DAO/textDao.php");
include_once("./src/main/project/Model/DAO/LangDao.php");

include_once("./src/main/project/Model/objects/lang_text.php");

class lang_textController{

    /**
     * Obtenemos la lista de de traducciones y la lista de idiomas disponibles en un array de arrays
     */
    public function getBodysByLangAndText($tag, $text){
        $langController = new langController();
        $arrayLangs = $langController->getAllLang();
        $dao = new textLangDAO();
        $conn = $this->getConexion();
        $arrayTextLangs = $dao->getBodysByLangAndText($tag, $text, $conn);
        $arrayData = [
            "arrayLangs" => $arrayLangs,
            "arrayTextLangs" => $arrayTextLangs
        ];
        return $arrayData;
    }

    /**
     * 
     */
    public function getLang_Text($tagName){
        $conn = $this->getConexion();
        $langDAO = new LangDAO();
        $arrayLang = $langDAO->getAll($conn);
        $daoText = new textDAO();
        $textRowSql = $daoText->getTextByTag($tagName, $conn);
        $dao = new textLangDAO();
        $array = $dao->show($tagName, $conn);
        $return = [
            "array" => $array,
            "arrayLang" => $arrayLang,
            "textRowSql" => $textRowSql,
        ];
        return $return;
    }

    /**
     * Retorna un array con las etiquetas resultntes de la busqueda con la palabra $searcher
     */
    public function searcher($searcher, $page){
        $conn = $this->getConexion();
        $dao = new textLangDAO();
        $total_paginas = $dao->getCountTotalLang_Text($searcher, $conn);
        $results = $dao->searcher($searcher, $conn, $page);
        $array = [
            "total_paginas" => $total_paginas,
            "results" => $results
        ];
        return $array;
    }

    /**
     * Crea traducciones vacias para cada idioma en base a una nueva etiqueta
     */
    public function storeAllLang_TextByTag($tagText)
    {
        $conn = $this->getConexion();
        $langController = new langController();
        $arrayLangs = $langController->getAllLang();
        foreach ($arrayLangs as $lang) {
            $this->storeLang_Text($tagText, $lang->getTag(), '', $conn);
        }
    }

    /**
     * Almacena una nueva traduccion, crea el objeto y luego lo almacena
     */
    public function storeLang_Text($text, $lang, $body, $conn)
    {
        $lang_text = new Lang_text($text, $lang, $body);
        $lang_textDAO = new textLangDAO();
        $lang_textDAO->create($lang_text, $conn);
    }

    /**
     * Actualiza la etiqueta con las traducciones, obtiene valores necesarios para que
     * la actualizacion se haga ne otro metodo
     */
    public function update($postText_langs, $tagText){
        $conn = $this->getConexion();
        $langDAO = new LangDAO();
        $arrayLang = $langDAO->getAll($conn);
        $langtextController = new lang_textController();
        $langtextController->updateAllLang_Text($postText_langs, $tagText, $arrayLang, $conn);
    }

    /**
     * Actualiza todas las traducciones de una etiqueta en la base de datos
     */
    public function updateAllLang_Text($postText_langs, $tagText, $arrayLang, $conn)
    {
        $arrayText_LangForUpdate = [];
        if (count($postText_langs) === count($arrayLang)) {
            for ($i = 0; $i < count($arrayLang); $i++) {
                $text_lang = new Lang_text($tagText, $arrayLang[$i]['tag'], trim($postText_langs[$i]));
                array_push($arrayText_LangForUpdate, $text_lang);
            }
            if (!empty($arrayText_LangForUpdate)) {
                $lang_textDao = new textLangDAO();
                foreach ($arrayText_LangForUpdate as $text_langForUpdate) {
                    $lang_textDao->updateOrInsert($text_langForUpdate, $conn);
                }
            }
        }
    }

    /**
     *Crea un nuevo lang_text vacio para todas las etiquetas con el idioma indicado $lang 
     */
    public function addNewLangToAll($lang){
        $conn = $this->getConexion();
        $textDao = new textDAO();
        //Obtenemos todos los tags para poder insertar
        $allTextTag = $textDao->getAllWitOutPage($conn);
        $langTextDao = new textLangDAO();
        foreach($allTextTag as $arrayText){
            $langTextObject = new Lang_text( $arrayText["tag"], $lang->getTag(), "");
            $langTextDao->create($langTextObject, $conn);
        }
    }

    /**
     * Retorna la conexion de la base de datos 
     */
    protected function getConexion()
    {
        $conn = new dbConnection();
        return $conn->connectDb();
    }
}
?>