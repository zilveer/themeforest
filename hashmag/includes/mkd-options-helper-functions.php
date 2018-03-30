<?php

if(!function_exists('hashmag_mikado_is_responsive_on')) {
    /**
     * Checks whether responsive mode is enabled in theme options
     * @return bool
     */
    function hashmag_mikado_is_responsive_on() {
        return hashmag_mikado_options()->getOptionValue('responsiveness') !== 'no';
    }
}