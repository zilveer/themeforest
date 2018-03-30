<?php
use QodeStartit\Modules\Header\Lib;

if(!function_exists('qode_startit_set_header_object')) {
    function qode_startit_set_header_object() {
        $header_type = qode_startit_get_meta_field_intersect('header_type', qode_startit_get_page_id());

        $object = Lib\HeaderFactory::getInstance()->build($header_type);

        if(Lib\HeaderFactory::getInstance()->validHeaderObject()) {
            $header_connector = new Lib\HeaderConnector($object);
            $header_connector->connect($object->getConnectConfig());
        }
    }

    add_action('wp', 'qode_startit_set_header_object', 1);
}