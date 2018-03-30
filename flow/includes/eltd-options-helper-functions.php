<?php

if(!function_exists('flow_elated_is_responsive_on')) {
    /**
     * Checks whether responsive mode is enabled in theme options
     * @return bool
     */
    function flow_elated_is_responsive_on() {
        return flow_elated_options()->getOptionValue('responsiveness') !== 'no';
    }
}