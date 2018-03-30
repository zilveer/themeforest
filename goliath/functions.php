<?php
	require_once(get_template_directory() . '/core/' . 'init.php');	//initialize framework
	require_once(PLSH_THEME_PATH . 'theme-functions.php');	//initialize theme
    
/*--------------------------- CUSTOM FUNCTIONS --------------------------*/
/*	Add your custom functions below											 */
/*-----------------------------------------------------------------------*/

    if ( ! isset( $content_width ) )
    {
        $content_width = 680;
    }
        
?>