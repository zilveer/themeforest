<?php

if(!function_exists('suprema_qodef_is_responsive_on')) {
    /**
     * Checks whether responsive mode is enabled in theme options
     * @return bool
     */
    function suprema_qodef_is_responsive_on() {
        return suprema_qodef_options()->getOptionValue('responsiveness') !== 'no';
    }
}