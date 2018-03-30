<?php

$language = of_get_option('lang_event');
switch ($language) {
    case "lang_EN":
        require('language/EN.php');
        break;
		
    case "lang_RO":
        require('language/RO.php');
        break;
		
    case "lang_ES":
        require('language/ES.php');
        break;
		
    case "lang_IT":
        require('language/IT.php');
        break;
		
    case "lang_PT":
        require('language/PT.php');
        break;
		
    case "lang_DE":
        require('language/DE.php');
        break;
		
    case "lang_NE":
        require('language/NL.php');
        break;
		
    case "lang_FR":
        require('language/FR.php');
        break;
}

?>