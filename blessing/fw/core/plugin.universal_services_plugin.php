<?php
/* Universal Services support functions
------------------------------------------------------------------------------- */

// Check if Universal Services Plugin installed and activated
if ( !function_exists( 'ancora_exists_universal_services_plugin' ) ) {
    function ancora_exists_universal_services_plugin() {
        return function_exists('ancora_universal_services_plugin');
    }
}
?>