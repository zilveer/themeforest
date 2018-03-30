<?php

if(!function_exists('qode_startit_is_responsive_on')) {
    /**
     * Checks whether responsive mode is enabled in theme options
     * @return bool
     */
    function qode_startit_is_responsive_on() {
        return qode_startit_options()->getOptionValue('responsiveness') !== 'no';
    }
}

if(!function_exists('qode_startit_is_seo_enabled')) {
    /**
     * Checks if SEO is enabled in theme options
     * @return bool
     */
    function qode_startit_is_seo_enabled() {
        return qode_startit_options()->getOptionValue('disable_seo') == 'no';
    }
}