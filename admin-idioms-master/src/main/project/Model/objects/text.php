<?php
include_once("./src/main/project/Model/DAO/dbConnection.php");
include_once("./src/main/project/Model/objects/lang_text.php");
class Text{

    private $id;
    private $tag;
    private $active;
    private $lang_text = [];

    public function __construct($tag , $active, $id="")
    {
        $this->id = $id;
        $this->tag = $tag;
        $this->active = $active;
    }

    public function getId(){
        return $this->id;
    }

    public function getTag(){
        return $this->tag;
    }

    public function setTag($tag){
        $this->tag = $tag;
    }

    public function getLang_text(){
        return $this->lang_text;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getActive(){
        return $this->active;
    }

    public function setActive($active){
        return $this->active;
    }

    public function addLang_Text(Lang_text $langText)
    {
        array_push($this->lang_text, $langText);
    }
    
}

?>