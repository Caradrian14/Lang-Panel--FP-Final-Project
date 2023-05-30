<?php
/**
 * Representa un idioma sobre el que realizar las traducciones
 */
class Lang{

    private $id;
    private $tag;
    private $name;

    public function __construct($name, $tag, $id = "")
    {
        $this->id = $id;
        $this->tag = $tag;
        $this->name = $name;
    }

    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }

    public function getTag(){
        return $this->tag;
    }

    public function setId($id){
        $this->id = $id;
    }
    
    public function setName($name){
        $this->name = $name;
    }

    public function setTag($tag){
        $this->tag = $tag;
    }
}

?>