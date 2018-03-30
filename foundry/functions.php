<?php 

/**
 * Define theme folder URL, saves querying the template directory multiple times.
 */
define('EBOR_THEME_DIRECTORY', esc_url(trailingslashit( get_template_directory_uri() )));

/**
 * Ebor Framework
 * Queue Up Theme-Side Framework, everything else is loaded in the ebor-framework plugin.
 * 
 * You can install a child theme to modify all aspects of the theme, if you need to modify anything from the /admin/ folder
 * Just delete the require line below and move it to the functions.php of your child theme, make sure to copy over the entire /admin/ folder too.
 * It's very rare you'd need to do that, but if you do, you'll need to delete this require on every theme update.
 * 
 * Note that to override a function from the /admin/ folder, you don't need to copy the folder to your child theme, every function is wrapped
 * in a conditional so that it can be called directly from your child theme and ignored in the parent theme.
 * 
 * @since 1.0.0
 * @author TommusRhodus
 */
get_template_part("admin/init");

/**
 * If visual composer is installed, grab all required files.
 * Wrapped in an if statement so that we can save parsing this if visual composer is not used.
 * It's a speed boost basically.
 */
if( function_exists('vc_set_as_theme') ){
	get_template_part("vc_init");
}

/**
 * Please use a child theme if you need to modify any aspect of the theme, if you need to, you can add code
 * below here if you need to add extra functionality.
 * Be warned! Any code added here will be overwritten on theme update!
 * Add & modify code at your own risk & always use a child theme instead for this!
 */