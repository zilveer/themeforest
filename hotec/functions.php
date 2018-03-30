<?php

/**
 * @author smooththemes - http://www.smooththemes.com
 * @copyright 2012
 */

define('ST_DEBUG',false);


if ( ! isset( $content_width ) ){
     $content_width = 900;
}

if(!defined('ST_DEBUG') || ST_DEBUG !== true){
    error_reporting(0);
}

require_once('st-framework/st-load.php');

