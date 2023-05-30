<?php
include_once("./src/main/project/Model/DAO/dbConnection.php");

include_once("./src/main/project/Model/objects/text.php");

class textDAO
{
    /**
     * Numero de paginas
     */
    private $numPage = 10;

    /**
     * Retorna la etiqueta por su $tag en forma de array
     */
    public function getTextByTag($tag, $conn)
    {
        $sql = "SELECT * FROM texts where texts.tag like ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $tag);
        $stmt->execute();
        $result = $stmt->get_result();
        $result = $result->fetch_assoc();
        $stmt->close();
        return $result;
    }

    /**
     * Retorna el numero total de etiquetas en la base de datos
     */
    public function getCountTotalText($conn){
        $sqlCount = "SELECT COUNT(id) FROM texts";
        $stmtCount = $conn->prepare($sqlCount);
        $stmtCount->execute();
        $result = $stmtCount->get_result();
        $result = $result->fetch_assoc();
        $total_paginas = ceil($result['COUNT(id)'] / $this->numPage);
        return $total_paginas;
    }

    /**
     * Obtenemos las etiquetas de la pagina de Landing
     */
    public function getLandingTags($conn){
        $sql = "SELECT * FROM texts where texts.tag like '%landing%'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /**
     * Obtenemos todas las etiquetas paginadas
     */
    public function getAll($conn, $actualPage = 1){
        $indice_inicio = ($actualPage - 1) * $this->numPage;
        $sql = "SELECT * FROM texts LIMIT ? OFFSET ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $this->numPage, $indice_inicio);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $arrayResults = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $daoLang_Test = new textLangDAO();
                $arrayLang = $daoLang_Test->getLangByText($row['tag'],$conn);
                $array = array(
                    $row['tag'] => $arrayLang
                );
                array_push($arrayResults, $array);
            }
        }
        return $arrayResults;
    }

    /**
     * Obtenemos todas las etiquetas sin paginacion
     */
    public function getAllWitOutPage($conn)
    {
        //$sql = "SELECT texts.id as 'id', texts.tag as 'tag', texts.active as 'active' , lang_text.body as 'body', lang.tag as 'lang' , lang_text.id as 'idtextLang' from (texts inner JOIN lang_text on texts.tag = lang_text.textId) inner join lang on lang.tag = lang_text.langTag";
        $sql = "SELECT * FROM texts";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        $arrayResults = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $array = array(
                    "id" => $row['id'],
                    "tag" => $row['tag'],
                    "active" => $row['active'],
                );
                array_push($arrayResults, $array);
            }
        }
        $stmt->close();
        
        return $arrayResults;
    }

    /**
     * Crear un nuevo campo en la tabla text, y solo eso con los valores pasados en el objeto
     */
    public function createText($text, $conn)
    {
        $sql = "INSERT INTO texts (tag, active) values (?, ?)";
        $stmt = $conn->prepare($sql);
        $tag = $text->getTag();
        $active = $text->getActive();
        $stmt->bind_param("ss", $tag, $active);
        $stmt->execute();
        $stmt->close();
    }

    /**
     * Crear un nuevo campo en la tabla text, y solo eso con los valores pasados en el objeto
     */
    public function addLangToText($text, $conn)
    {
        $sql = "INSERT INTO lang_text (langId, textId, body) values (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iis", $text->get, $text->getActive());
        $stmt->execute();
        $stmt->close();
    }

    /**
     * la idea es que se borre el texto con sus idiomas, pero el idioma en si qu eno se borre por dios!!!
     */
    public function destroyTextBytag($tag, $conn)
    {
        $sql = "DELETE FROM texts where texts.tag like ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $tag);
        $stmt->execute();
    
        $stmt->close();
    }


    /**
     * Actualiza el objeto pero solo sus campos, no las tablas que se relacionan.
     */
    public function update(Text $text,$conn)
    {
        $sql = "UPDATE texts set tag = ?, active = ? where id = ?";
        $stmt = $conn->prepare($sql);
        $tag = $text->getTag();
        $id = $text->getId();
        $active = $text->getActive();
        $stmt->bind_param("sii", $tag, $active, $id);
        $stmt->execute();
       
        $stmt->close();
    }
}
