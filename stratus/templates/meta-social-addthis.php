<?php
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

// AddThis Settings themo_project_addthis_toolbox
$plugin = '';


if ( function_exists( 'ot_get_option' ) && is_plugin_active('addthis/addthis_social_widget.php') ) {
    /* get the slider array */
    $show_addthis_toolbox = ot_get_option('themo_project_addthis_toolbox', 'on');
}
if(isset($show_addthis_toolbox) && $show_addthis_toolbox == 'on'){
    echo '<div class="at-above-post addthis-toolbox at-wordpress-hide" data-url="'. get_the_permalink() .'" data-title="'.get_the_title(). '"></div>';
}