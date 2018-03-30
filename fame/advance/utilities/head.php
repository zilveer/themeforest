<?php


/*
 * Prints favicon
 */
if(!function_exists('a13_favicon')){
    function a13_favicon() {
        global $apollo13;
        $fav_icon = $apollo13->get_option( 'appearance', 'favicon' );
        if(!empty($fav_icon))
            echo '<link rel="shortcut icon" href="'.esc_url($fav_icon).'" />';
    }
}