<?php

/*
**	Register Rock Theme Options
**
*/

add_action( 'admin_menu', 'theme_options_add_page' ); 

function theme_options_add_page() {
 add_theme_page( 'Theme Options',  'Theme Options', 'edit_theme_options', 'rock_options', 'xr_theme_options_do_page' );
} 

?>