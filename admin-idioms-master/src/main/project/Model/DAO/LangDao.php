<?php


include_once("./src/main/project/Model/DAO/dbConnection.php");
include_once("./src/main/project/Model/objects/lang.php");
class LangDAO
{

    /**
     * Obtenemos todos los idiomas de la base de datos en forma de array
     */
    public function getAll($conn)
    {
        $sql = "SELECT * FROM lang";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        $arrayResults = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $array = array(
                    "name" => $row['name'],
                    "tag" => $row['tag'],
                    "id" => $row['id'],
                );
                array_push($arrayResults, $array);
            }
        }
        $stmt->close();
        return $arrayResults;
    }

    /**
     * Obtenemos un array con la informacion de la base de datos en base al $tag indicado
     */
    public function getLangByTag($tag, $conn)
    {
        $sql = "SELECT * FROM lang where lang.tag like ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $tag);
        $stmt->execute();
        $result = $stmt->get_result();
        $array = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $array = array(
                    "name" => $row['name'],
                    "tag" => $row['tag'],
                    "id" => $row['id'],
                );
            }
        }
        $stmt->close();
        return $array;
    }

    /**
     * Crea una entrada en la base de datos en la tabla de idiomas, en base al objeto Idioma indicado
     */
    public function create(Lang $lang, $conn)
    {
        $sql = "INSERT INTO lang (name, tag) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $name = $lang->getName();
        $tag = $lang->getTag();
        $stmt->bind_param("ss", $name, $tag);
        $stmt->execute();

        $stmt->close();
    }

    /**
     * Elimina un idioma en la base de datos en base a su tag o etiqueta
     */
    public function destroy($lang, $conn)
    {
        $sql = "DELETE FROM lang where lang.tag LIKE ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $lang);
        $stmt->execute();

        $stmt->close();
    }

    /**
     * Actualiza un idioma en la base de datos.
     */
    public function update($lang, $conn){
        $sql = "UPDATE lang set tag = ?, name = ? where id = ?";
        $stmt = $conn->prepare($sql);
        $tag = $lang->getTag();
        $name = $lang->getName();
        $id = $lang->getId();
        $stmt->bind_param("ssi", $tag, $name, $id);
        $stmt->execute();

        $stmt->close();
    }
}
