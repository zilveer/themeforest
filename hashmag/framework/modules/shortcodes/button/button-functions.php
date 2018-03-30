<?php

if(!function_exists('hashmag_mikado_get_button_html')) {
    /**
     * Calls button shortcode with given parameters and returns it's output
     * @param $params
     *
     * @return mixed|string
     */
    function hashmag_mikado_get_button_html($params) {
        $button_html = hashmag_mikado_execute_shortcode('mkdf_button', $params);
        $button_html = str_replace("\n", '', $button_html);
        return $button_html;
    }
}