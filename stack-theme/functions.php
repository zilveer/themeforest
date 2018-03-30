<?php

require_once( get_template_directory() . '/base/base.php' );
require_once( get_template_directory() . '/base/custom/config.php' );

$theme = new Base();
$theme->init( $theme_config );

add_filter( 'no_texturize_shortcodes', 'shortcodes_to_exempt_from_wptexturize' );
function shortcodes_to_exempt_from_wptexturize($shortcodes){
    $shortcodes[] = 'accordions';
    $shortcodes[] = 'tabs';
    return $shortcodes;
}

?>