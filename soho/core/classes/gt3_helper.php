<?php

class gt3Helper
{
    protected static $_instance;
    protected static $alreayShowedArray = array();
    private function __construct(){

    }

    private function __clone(){}

    public static function getInstance() {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
}

?>