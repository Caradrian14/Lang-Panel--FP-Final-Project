<?php

include_once("./src/main/project/controller/lang_textController.php");
include_once("./src/main/project/controller/langController.php");
include_once("./src/main/project/controller/textController.php");
/**
 * Controlador que se encarga de redirigir a las paginas web
 */
class frontController
{
    /**
     * Manda al usuario a la pagina de landing, llamando a los datos necesarios
     */
    public function goLanding()
    {
        $tag = 'es';
        if (isset($_GET['lang'])) {
            $tag = $_GET['lang'];
        }
        $text = '%landing%';
        $lang_textController = new lang_textController();
        $arrayData = $lang_textController->getBodysByLangAndText($tag, $text);
        $arrayLangs = $arrayData['arrayLangs'];
        $arrayTextLangs = $arrayData['arrayTextLangs'];
        require_once("./src/main/project/views/public/index.php");
    }

    /**
     * Manda al usuario a la pagina del listado de etiquetas del Panel de Idiomas
     */
    public function getAll()
    {
        $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
        $textController = new TextController();
        $arrayData = $textController->getAll($page);
        $array = $arrayData["array"];
        $arrayLangs = $arrayData["arrayLangs"];
        $total_paginas = $arrayData["total_paginas"];
        require_once("./src/main/project/views/index.php");
    }

    /**
     * Manda al usuario a la pagina del listado de idiomas del Panel de Idiomas
     */
    public function getLangListPage()
    {
        $langController = new langController();
        $arrayLangs = $langController->getAllLang();
        require_once("./src/main/project/views/langList.php");
    }

    /**
     * Manda al usuario a la pagina del buscador en base a las palabras clave insertadas
     */
    public function searcher()
    {
        $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
        if (isset($_GET['searcher'])) {
            $searcher = $_GET['searcher'];
        } else {
            header('Location: /?Controller=front&method=getAll');
        }
        $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
        $langTextController = new lang_textController();
        $array = $langTextController->searcher($searcher, $page);
        $results = $array['results'];
        $total_paginas = $array['total_paginas'];
        require_once("./src/main/project/views/searcherResults.php");
    }

    /**
     * Procesa la solicitud de añadir un nuevo Idioma a la base de datos
     */
    public function storeLang()
    {
        $tag = $_POST['textTag'];
        $name = $_POST['name'];
        $lang = new Lang($name, $tag);
        $langController = new langController();
        $langController->store($lang);
        header('Location: /?Controller=front&method=getAll');
    }

    /**
     * Procesa la solicitud de eliminar un Idioma.
     */
    public function destroyLang()
    {
        $langTag = $_GET['tag'];
        $langController = new langController();
        $langController->destroy($langTag);
        header('Location: /?Controller=front&method=getLangListPage');
    }

    /**
     * Dirige al usuario al formulario de creacion de una nueva etiqueta
     */
    public function createText()
    {
        $langController = new langController();
        $arrayLangs = $langController->getAllLang();
        require_once("./src/main/project/views/createTextForm.php");
    }

    /**
     * Procesa la creación de una nueva etiqueta.
     */
    public function storeText()
    {
        $text = new Text($_POST['textTag'], $_POST['active']);
        $textController = new TextController();
        $textController->createText($text);
        $langTextController = new lang_textController();
        $langTextController->storeAllLang_TextByTag($_POST['textTag']);
        header('Location: /?Controller=front&method=showLang_Text&tag=' . $_POST['textTag']);
    }
    /**
     * Manda al usuario al formulario de creación de Idiomas
     */
    public function createLang()
    {
        require_once("./src/main/project/views/langForm.php");
    }

    /**
     * Obtenemos la información del idioma al que vamos a editar, con estos datos redirigimos al usuario a la pagina
     */
    public function editLang()
    {
        $langTag = $_GET['tag'];
        $langController = new langController();
        $langObject = $langController->getLang($langTag);
        require_once("./src/main/project/views/editLangForm.php");
    }

    /**
     * Obtenemos la información de la etiqueta al que vamos a editar, con estos datos redirigimos al usuario a la pagina
     */
    public function editText()
    {
        $tagText = $_GET['tagText'];
        $textController = new TextController();
        $text = $textController->getText($tagText);
        require_once('./src/main/project/views/editTextForm.php');
    }

    /**
     * Actualiza la informacion del idioma en la base de datos, a continuacion redirige al usuario a la 
     * pagina del listado de etiquetas del panel de idiomas
     */
    public function updateLang()
    {
        $newAbreviationLang = $_POST['abreviationLang'];
        $newNameLang = $_POST['nameLang'];
        $id = $_POST['idLang'];
        $langController = new langController();
        $langController->update($newAbreviationLang, $newNameLang, $id);
        header('Location: /?Controller=front&method=getLangListPage');
    }

    /**
     * Actualiza la informacion de la etiqueta en la base de datos, a continuacion redirige al usuario a la 
     * pagina del listado de etiquetas del panel de idiomas
     */
    public function updateTextTag()
    {
        $id = $_POST['id'];
        $textTag = $_POST['textTag'];
        $active = $_POST['active'];
        $textController = new TextController();
        $textController->update($id, $textTag, $active);
        header('Location: /?Controller=front&method=showLang_Text&tag=' . $textTag);
    }

    /**
     * Actualiza las traducciones de una etiqueta y redirige a la misma pagina
     */
    public function updateAllLang_TextByTag()
    {
        $postText_langs = $_POST['arrayLang_Text'];
        $tagText = $_POST['tag'];
        $lang_textController = new lang_textController();
        $lang_textController->update($postText_langs, $tagText);
        header('Location: /?Controller=AdminText&method=showLang_Text&tag=' . $_POST['tag']);
    }

    /**
     * Actualiza las traducciones de una etiqueta y redirige a la pagina inicial del panel de idiomas
     */
    public function updateAllLang_TextByTagAndRedirect()
    {
        $postText_langs = $_POST['arrayLang_Text'];
        $tagText = $_POST['tag'];
        $lang_textController = new lang_textController();
        $lang_textController->update($postText_langs, $tagText);
        header('Location: /?Controller=front&method=getAll');
    }

    /**
     * Redirige al usuario a la pagina de las traducciones de la etiqueta
     */
    public function showLang_Text()
    {
        $tagName = $_GET['tag'];
        $langTextController = new lang_textController();
        $arrayData = $langTextController->getLang_Text($tagName);
        $arrayLang = $arrayData["arrayLang"];
        $array = $arrayData["array"];
        $textRowSql = $arrayData['textRowSql'];
        require_once("./src/main/project/views/showLang_Text.php");
    }

    /**
     * Obtiene las conexion a la base de datos para usarla en otros métodos
     */
    protected function getConexion()
    {
        $conn = new dbConnection();
        return $conn->connectDb();
    }
}
