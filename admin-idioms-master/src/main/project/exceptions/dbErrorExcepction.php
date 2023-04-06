<?php

class dbErrorExcepction extends Exception{
    public function __construct($message, $code = 0, Exception $previus = null)
    {
        parent:: __construct($message, $code, $previus);
    }

    public function __toString(): string
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}" . PHP_EOL;
    }
}

?>