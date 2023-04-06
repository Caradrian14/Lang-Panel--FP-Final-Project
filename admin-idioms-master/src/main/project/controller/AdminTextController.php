<?php
include_once("./src/main/project/Model/DAO/dbConnection.php");

include_once("./src/main/project/Model/DAO/textDao.php");
include_once("./src/main/project/Model/DAO/textLangDAO.php");
include_once("./src/main/project/Model/DAO/LangDao.php");

include_once("./src/main/project/Model/objects/text.php");
include_once("./src/main/project/Model/objects/lang_text.php");
include_once("./src/main/project/Model/objects/lang.php");
class AdminTextController
{
    public function goLanding()
    {
        $tag = 'es';
        if (isset($_GET['lang'])) {
            $tag = $_GET['lang'];
        }
       $text = '%landing%';
        //Obtener todos los idiomas disponibles
        $arrayLangs =  $this->getAllLang();
        //obtendra las etiquetas con landing
        $dao = new textLangDAO();
        $conn = $this->getConexion();
        $arrayTextLangs = $dao->getBodysByLangAndText($tag, $text, $conn);
        require_once("./src/main/project/views/public/index.php");
    }

    public function getAll()
    {
        $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
        $conn = $this->getConexion();
        $dao = new textDAO();
        $array = $dao->getAll($conn, $page);
        $arrayLangs =  $this->getAllLang();
        $total_paginas = $dao->getCountTotalText($conn);
        require_once("./src/main/project/views/index.php");
    }

    public function getLangListPage()
    {
        $arrayLangs = $this->getAllLang();
        require_once("./src/main/project/views/langList.php");
    }

    public function searcher()
    {
        $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
        if (isset($_GET['searcher'])) {
            $searcher = $_GET['searcher'];
        } else {
            header('Location: /?Controller=AdminText&method=getAll');
        }
        $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
        $conn = $this->getConexion();
        $dao = new textLangDAO();
        $total_paginas = $dao->getCountTotalLang_Text($searcher, $conn);
        $results = $dao->searcher($searcher, $conn, $page);
        require_once("./src/main/project/views/searcherResults.php");
    }

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

    private function createObjectLang($rowSQL)
    {
        $lang = new Lang($rowSQL['name'], $rowSQL['tag'], $rowSQL['id']);
        return $lang;
    }

    private function createTextWithLang($rowSQL)
    {
        $text = new Text($rowSQL['tag'], $rowSQL['active'], $rowSQL['id']);
        $lang_text = new Lang_text($rowSQL['tag'], $rowSQL['lang'], $rowSQL['body'], $rowSQL['idtextLang']);
        $text->addLang_Text($lang_text);
        return $text;
    }

    private function checkTextsExists($tagRow, $arrayObjects)
    {
        foreach ($arrayObjects as $object) {
            if ($object->getTag() === $tagRow) {
                return false;
            }
        }
        return true;
    }


    public function createText()
    {
        $arrayLangs = $this->getAllLang();
        require_once("./src/main/project/views/createTextForm.php");
    }

    public function storeText()
    {
        $text = new Text($_POST['textTag'], $_POST['active']);
        $textDao = new textDAO();
        $conn = $this->getConexion();
        $textDao->createText($text, $conn);
        $this->storeAllLang_TextByTag($_POST['textTag'], $conn);
        header('Location: /?Controller=AdminText&method=showLang_Text&tag=' . $_POST['textTag']);
    }

    private function storeAllLang_TextByTag($tagText, $conn)
    {
        $arrayLangs = $this->getAllLang();
        foreach ($arrayLangs as $lang) {
            $this->storeLang_Text($tagText, $lang->getTag(), '', $conn);
        }
    }

    public function createLang()
    {
        $arrayLang = $this->getAllLang();
        require_once("./src/main/project/views/langForm.php");
    }

    public function storeLang()
    {
        $tag = $_POST['textTag'];
        $name = $_POST['name'];
        $lang = new Lang($name, $tag);
        $langDao = new LangDAO();
        $conn = $this->getConexion();
        $langDao->create($lang, $conn);
        header('Location: /?Controller=AdminText&method=getAll');
    }

    public function storeLang_Text($text, $lang, $body, $conn)
    {
        $lang_text = new Lang_text($text, $lang, $body);
        $lang_textDAO = new textLangDAO();
        $lang_textDAO->create($lang_text, $conn);
    }

    public function editLang()
    {
        $langTag = $_GET['tag'];
        $conn = $this->getConexion();
        $langDao = new LangDAO();
        $langArray = $langDao->getLangByTag($langTag, $conn);
        $langObject = new Lang($langArray['name'], $langArray['tag'], $langArray['id']);
        require_once("./src/main/project/views/editLangForm.php");
    }

    public function editText()
    {
        $tagText = $_GET['tagText'];
        $conn = $this->getConexion();
        $dao = new textDAO();
        $sqlRow = $dao->getTextByTag($tagText, $conn);
        $text = new Text($sqlRow['tag'], $sqlRow['active'], $sqlRow['id']);
        require_once('./src/main/project/views/editTextForm.php');
    }

    public function updateLang()
    {
        $newAbreviationLang = $_POST['abreviationLang'];
        $newNameLang = $_POST['nameLang'];
        $id = $_POST['idLang'];
        $langObject = new Lang($newNameLang, $newAbreviationLang, $id);
        $conn = $this->getConexion();
        $dao = new LangDAO();
        $dao->update($langObject, $conn);
        header('Location: /?Controller=AdminText&method=getLangListPage');
    }

    public function updateTextTag()
    {
        $id = $_POST['id'];
        $textTag = $_POST['textTag'];
        $active = $_POST['active'];
        $text = new Text($textTag, $active, $id);
        $dao = new textDAO();
        $conn = $this->getConexion();
        $dao->update($text, $conn);
        header('Location: /?Controller=AdminText&method=showLang_Text&tag=' . $textTag);
    }

    public function updateAllLang_TextByTag()
    {
        $postText_langs = $_POST['arrayLang_Text'];
        $conn = $this->getConexion();
        $langDAO = new LangDAO();
        $tagText = $_POST['tag'];
        $arrayLang = $langDAO->getAll($conn);
        $this->updateAllLang_Text($postText_langs, $tagText, $arrayLang, $conn);
        header('Location: /?Controller=AdminText&method=showLang_Text&tag=' . $_POST['tag']);
    }

    public function updateAllLang_TextByTagAndRedirect()
    {
        $postText_langs = $_POST['arrayLang_Text'];
        $conn = $this->getConexion();
        $langDAO = new LangDAO();
        $tagText = $_POST['tag'];
        $arrayLang = $langDAO->getAll($conn);
        $this->updateAllLang_Text($postText_langs, $tagText, $arrayLang, $conn);
        header('Location: /?Controller=AdminText&method=getAll');
    }

    private function updateAllLang_Text($postText_langs, $tagText, $arrayLang, $conn)
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

    public function destroyText()
    {
        $textTag = $_GET['textTag'];
        $textDAO = new textDAO();
        $conn = $this->getConexion();
        $textDAO->destroyTextBytag($textTag, $conn);
        header('Location: /?Controller=AdminText&method=getAll');
    }

    public function destroyLang()
    {
        $langTag = $_GET['tag'];
        $langDAO = new LangDAO();
        $conn = $this->getConexion();
        $langDAO->destroy($langTag, $conn);
        header('Location: /?Controller=AdminText&method=getLangListPage');
    }

    public function showLang_Text()
    {
        $tagName = $_GET['tag'];
        $conn = $this->getConexion();
        $langDAO = new LangDAO();
        $arrayLang = $langDAO->getAll($conn);
        $daoText = new textDAO();
        $textRowSql = $daoText->getTextByTag($tagName, $conn);
        $dao = new textLangDAO();
        $array = $dao->show($tagName, $conn);
        require_once("./src/main/project/views/showlang_Text.php");
    }

    protected function getConexion()
    {
        $conn = new dbConnection();
        return $conn->connectDb();
    }
}
