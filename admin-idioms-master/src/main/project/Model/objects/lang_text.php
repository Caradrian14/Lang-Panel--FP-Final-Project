<?php
include_once("./src/main/project/Model/objects/lang.php");
/**
 * Objeto Traducción, se trata de una traducción concreta de una unica etiqueta y un idioma concreto
 */
class Lang_text{

    private $text;
    private $lang;
    private $body;
    private $id;

    public function __construct($text, $lang, $body, $id=""){
        $this->text = $text;
        $this->lang = $lang;
        $this->body = $body;
        $this->id = $id;
    }
    
    public function getText(){
        return $this->text;
    }

    public function getLang(){
        return $this->lang;
    }

    public function getBody(){
        return $this->body;
    }

    public function getId(){
        return $this->id;
    }

    public function setText($text){
        $this->text;
    }

    public function setLang(Lang $lang){
        $this->lang = $lang;
    }

    public function setbody($body){
        $this->body = $body;
    }
}