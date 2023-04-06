<?php

include_once("./src/main/project/Model/DAO/dbConnection.php");
include_once("./src/main/project/Model/objects/lang_text.php");
include_once("./src/main/project/Model/objects/lang.php");
include_once("./src/main/project/Model/objects/text.php");


class textLangDAO{

    private $numPage = 10;

    public function getByText($idText, $conn){
        $sql = "SELECT * FROM lang_text where lang_text.textId like ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $idText);
        $stmt->execute();
        $result = $stmt->get_result();

        $arrayResults = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $array = array(
                    "id" =>$row['id'],
                    "langTag" => $row['langTag'],
                    "body" => $row['body'],
                );
                array_push($arrayResults, $array);
            }
        }
        $stmt->close();
        return $arrayResults;
    }

    public function getLangByText($idText, $conn){
        $sql = "SELECT langTag, body FROM lang_text where lang_text.textId like ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $idText);
        $stmt->execute();
        $result = $stmt->get_result();

        $arrayResults = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $array = array(
                    "langTag" => $row['langTag'],
                    'body' => $row['body'],
                );
                array_push($arrayResults, $array);
            }
        }
        $stmt->close();
        return $arrayResults;
    }

    public function create (Lang_text $langText ,$conn){
        $sql = "INSERT INTO lang_text (id, textId, langTag, body) values ( NULL, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $tagText = $langText->getText();
        $tagLang = $langText->getLang();
        $body = $langText->getBody();
        $stmt->bind_param("sss", $tagText, $tagLang, $body);
        $stmt->execute();
        $stmt->close();
    }

    public function updateOrInsert (Lang_text $langText ,$conn){
        $sql = "UPDATE lang_text  SET body = ? WHERE textId = ? and langTag = ?";
        $stmt = $conn->prepare($sql);
        $lang = $langText->getLang();
        $text = $langText->getText();
        $body = $langText->getBody();
        $stmt->bind_param("sss", $body, $text, $lang);
        $stmt->execute();
        
        $stmt->close();

    }

    public function show ($tagTextLang ,$conn){
        $sql = "SELECT * FROM lang_text inner join lang on lang_text.langTag = lang.tag  WHERE lang_text.textId like ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $tagTextLang);
        $stmt->execute();
        $result = $stmt->get_result();
        $arrayResults = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $array = array(
                    "textId" =>$row['textId'],
                    "langTag" => $row['langTag'],
                    "body" => $row['body'],
                    "nameLang" => $row['name']
                );
                array_push($arrayResults, $array);
            }
        }
        $stmt->close();
        return $arrayResults;
        
    }

    public function destroy($tagtext, $langTag, $conn){
        $sql = "DELETE FROM lang_text where lang_text.textid like ? and lang_text.langtag like ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $tagtext, $langTag);
        $stmt->execute();
    
        $stmt->close();
    }

    public function getBodyByLangAndText($lang, $text, $conn){
        $sql = "SELECT * FROM lang_text where lang_text.langTag like ? AND lang_text.textId like ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $lang, $text);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if ($row = $result->fetch_assoc()) {
            return $row;
        } else {
            return [];
        }
    }

    public function getBodysByLangAndText($lang, $text, $conn){
        $sql = "SELECT * FROM lang_text where lang_text.langTag like ? AND lang_text.textId like ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $lang, $text);
        $stmt->execute();
        $result = $stmt->get_result();

        $arrayResults = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $lang_textObject = $this->createLangTextObject($row);
                $arrayResults[$lang_textObject->getText()] = $lang_textObject;
            }
        }
        $stmt->close();
        return $arrayResults;
    }

    public function createLangTextObject($row)
    {
        $lang_text = new Lang_text($row['textId'], $row['langTag'], $row['body'], $row['id']);
        return $lang_text;
    }

    public function getByLang($lang, $conn){
        $sql = "SELECT * FROM lang_text where lang_text.langTag like ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $lang);
        $stmt->execute();
        $result = $stmt->get_result();

        $arrayResults = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $array = array(
                    "id" =>$row['id'],
                    "textId" => $row['textId'],
                    "langTag" => $row['langTag'],
                    "body" => $row['body'],
                );
                array_push($arrayResults, $array);
            }
        }
        $stmt->close();
        return $arrayResults;
    }

    public function getCountTotalLang_Text($keywords, $conn){
        $sqlCount = "SELECT COUNT(id) FROM lang_text WHERE textId LIKE ? OR body LIKE ?";
        $stmtCount = $conn->prepare($sqlCount);
        $keywords = '%' . $keywords . '%';
        $stmtCount->bind_param("ss", $keywords, $keywords);
        $stmtCount->execute();
        $result = $stmtCount->get_result();
        $result = $result->fetch_assoc();
        $total_paginas = ceil($result['COUNT(id)'] / $this->numPage);
        return $total_paginas;
    }

    public function searcher($keywords, $conn, $actualPage = 1){
        $sql = 'SELECT * FROM lang_text WHERE textId LIKE ? OR body LIKE ? LIMIT ? OFFSET ?';
        $stmt = $conn->prepare($sql);
        $keywords = '%' . $keywords . '%';
        $indice_inicio = ($actualPage - 1) * $this->numPage;
        $stmt->bind_param("ssii", $keywords, $keywords, $this->numPage, $indice_inicio);
        $stmt->execute();
        $result = $stmt->get_result();
        $arrayResults = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $array = array(
                    "id" =>$row['id'],
                    "textId" => $row['textId'],
                    "langTag" => $row['langTag'],
                    "body" => $row['body'],
                );
                array_push($arrayResults, $array);
            }
        }
        $stmt->close();
        return $arrayResults;
    }
}
