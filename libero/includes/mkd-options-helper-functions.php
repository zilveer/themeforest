<?php

if(!function_exists('libero_mikado_is_responsive_on')) {
    /**
     * Checks whether responsive mode is enabled in theme options
     * @return bool
     */
    function libero_mikado_is_responsive_on() {
        return libero_mikado_options()->getOptionValue('responsiveness') !== 'no';
    }
}