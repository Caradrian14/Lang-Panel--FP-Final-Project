<?php


class langController{

    /**
     * Obtenemos un idioma en base a su tag ($langTag)
     */
    public function getLang($langTag){
        $conn = $this->getConexion();
        $langDao = new LangDAO();
        $langArray = $langDao->getLangByTag($langTag, $conn);
        $langObject = $this->createObjectLang($langArray);
        return $langObject;
    }

    /**
     * Almacena un idioma en la base de datos y crea traducciones vacias para todas las etiquetas
     */
    public function store($lang){
        $langDao = new LangDAO();
        $conn = $this->getConexion();
        $langDao->create($lang, $conn);
        $langTextController = new lang_textController();
        $langTextController->addNewLangToAll($lang);
    }

    /**
     * Actualiza el idioma con los nuevos datos
     */
    public function update($newAbreviationLang, $newNameLang, $id)
    {
        $langObject = new Lang($newNameLang, $newAbreviationLang, $id);
        $conn = $this->getConexion();
        $dao = new LangDAO();
        $dao->update($langObject, $conn);
    }

    /**
     * Borra el idioma con la etiqueta indicada
     */
    public function destroy($langTag){
        $langDAO = new LangDAO();
        $conn = $this->getConexion();
        $langDAO->destroy($langTag, $conn);
    }

    /**
     * Obtenemos todos los idiomas en un array de objetos de Idiomas
     */
    public function getAllLang()
    {
        $conn = $this->getConexion();
        $dao = new LangDAO();
        $array = $dao->getAll($conn);
        $arrayLangs = [];
        foreach ($array as $element) {
            $objectLang = $this->createObjectLang($element);
            array_push($arrayLangs, $objectLang);
        }
        return $arrayLangs;
    }

    /**
     * Crea un objeto de tipo Idioma (Lang)
     */
    private function createObjectLang($rowSQL)
    {
        $lang = new Lang($rowSQL['name'], $rowSQL['tag'], $rowSQL['id']);
        return $lang;
    }

    /**
     * Crea la conexion a la base de datos
     */
    protected function getConexion()
    {
        $conn = new dbConnection();
        return $conn->connectDb();
    }
}
?>