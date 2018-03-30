<?php
/*-----------------------------------------------------------------------------------*/
/*	Load Text Domain
/*-----------------------------------------------------------------------------------*/	
	load_theme_textdomain( 'framework' );


/*-----------------------------------------------------------------------------------*/
/*	Include theme options framework
/*-----------------------------------------------------------------------------------*/	
	require_once(TEMPLATEPATH . '/admin/admin-functions.php');
	require_once(TEMPLATEPATH . '/admin/admin-interface.php');
	require_once(TEMPLATEPATH . '/admin/theme-settings.php');



/*-----------------------------------------------------------------------------------*/
/*	For Loading Required JS Files
/*-----------------------------------------------------------------------------------*/	
	if(!function_exists('load_theme_scripts'))
	{
		function load_theme_scripts()
		{		
			if (!is_admin()) {
				
				$jscriptURL = get_template_directory_uri().'/js/';
				
				// Registering New Scripts						
				wp_register_script('validate', $jscriptURL.'jquery.validate.js','jquery');
				wp_register_script('forms', $jscriptURL.'jquery.form.js','jquery');									
				wp_register_script('easing', ($jscriptURL.'jquery.easing.1.3.js'), 'jquery');
				wp_register_script('cycle', $jscriptURL.'jquery.cycle.all.js', 'jquery');
				wp_register_script('backgroundPosition', $jscriptURL.'jquery.backgroundpos.min.js', 'jquery');
				wp_register_script('count_down', $jscriptURL.'jquery.countdown.js', 'jquery');
				wp_register_script('custom_script',$jscriptURL.'script.js', 'jquery','1.0',true);
				
				// Enqueing Scripts
				wp_enqueue_script('jquery');
				wp_enqueue_script('easing');
				wp_enqueue_script('backgroundPosition');
				wp_enqueue_script('cycle');
				wp_enqueue_script('forms');				
				wp_enqueue_script('validate');					
				wp_enqueue_script('count_down');
				
				// Loading Custom Script which calls to all other scripts methods
				wp_enqueue_script('custom_script');
				
			}
		}
	}
		
	add_action('wp_enqueue_scripts', 'load_theme_scripts');	



/*-----------------------------------------------------------------------------------*/
/*	Custom Excerpt Length
/*-----------------------------------------------------------------------------------*/	
	  function framework_excerpt($len=15, $trim="&hellip;")
	  	{
		  	$limit = $len+1;
		  	$excerpt = explode(' ', get_the_excerpt(), $limit);
		  	$num_words = count($excerpt);
		  	if($num_words >= $len)
			{
		  		$last_item = array_pop($excerpt);
		  	}
		  	else
		  	{
		  		$trim = "";
		  	}
		  	$excerpt = implode(" ",$excerpt)."$trim";
		  	
		  	echo $excerpt;
	  	}
	  	
	  	function get_framework_excerpt($len=15, $trim="&hellip;")
	  	{
	  		$limit = $len+1;
	  		$excerpt = explode(' ', get_the_excerpt(), $limit);
	  		$num_words = count($excerpt);
		  	if($num_words >= $len){
		  		$last_item=array_pop($excerpt);
		  	}
		  	else
		  	{
		  		$trim="";
		  	}
	  		$excerpt = implode(" ",$excerpt)."$trim";
	  
	  		return $excerpt;
	  	}



/*-----------------------------------------------------------------------------------*/
/*	Contact Form Ajax Handler
/*-----------------------------------------------------------------------------------*/	
add_action( 'wp_ajax_nopriv_send_message', 'send_message' );
add_action( 'wp_ajax_send_message', 'send_message' );	
	
	function send_message()
	{	
		if(isset($_POST['email'])):
		
			$name = $_POST['name'];
            $email = $_POST['email'];
            $message = $_POST['message'];
			$address = $_POST['target'];
			
            if(get_magic_quotes_gpc()) {
                    $message = stripslashes($message);
            }

             $e_subject = __('You have Received a Message From ','framework') . $name . '.';

             $e_body = __('You have Received a Message From ','framework') . $name . __(", their additional message is as follows. ",'framework')." \r\n\n ";

             $e_content = "\" $message \"\r\n\n";

             $e_reply = __('You can contact ','framework') . $name . __(' via email, ','framework') . $email;

             $msg = $e_body . $e_content . $e_reply;

             if(wp_mail($address, $e_subject, $msg, "From: $email\r\nReply-To: $email\r\nReturn-Path: $email\r\n","-f $address"))
			 {
    		 	_e('Message Sent Successfully!','framework');
			 }
			 else
			 {
				 _e('Server Error: WordPress mail method failed!','framework');
			 }
		else:
				_e('Message Sending Failed!','framework');
		endif;
		die;
	}		

/*-----------------------------------------------------------------------------------*/
/*	Feed Links
/*-----------------------------------------------------------------------------------*/	
	add_theme_support( 'automatic-feed-links' );


/*-----------------------------------------------------------------------------------*/
/*	Add Custom Background
/*-----------------------------------------------------------------------------------*/
    add_theme_support( 'custom-background' );


/*-----------------------------------------------------------------------------------*/
/*	Content Width
/*-----------------------------------------------------------------------------------*/
    if ( ! isset( $content_width ) ) $content_width = 770;


/*-----------------------------------------------------------------------------------*/
/*	Enables Widget Sidebars
/*-----------------------------------------------------------------------------------*/
if ( function_exists('register_sidebar') ){

    // Location: Default Sidebar
    register_sidebar(array('name'=>__('Sidebar','framework'),
        'before_widget' => '<section class="widget">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="title">',
        'after_title' => '</h3>'
    ));

    // Location: Tweets Sidebar
    register_sidebar(array('name'=>__('Tweets','framework'),
        'before_widget' => '<section class="widget">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="title">',
        'after_title' => '</h3>'
    ));

    // Location: Tweets Sidebar
    register_sidebar(array('name'=>__('Subscribe','framework'),
        'before_widget' => '<section class="widget">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="title">',
        'after_title' => '</h3>'
    ));

}




/*-----------------------------------------------------------------------------------*/
/*	TGM Activation
/*-----------------------------------------------------------------------------------*/
require_once(TEMPLATEPATH . '/class-tgm-plugin-activation.php');


/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @package	   TGM-Plugin-Activation
 * @subpackage Example
 * @version	   2.3.6
 * @author	   Thomas Griffin <thomas@thomasgriffinmedia.com>
 * @author	   Gary Jones <gamajo@gamajo.com>
 * @copyright  Copyright (c) 2012, Thomas Griffin
 * @license	   http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/thomasgriffin/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
//require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function my_theme_register_required_plugins() {

    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
        array(
            'name' 		=> 'Simple Subscribe',
            'slug' 		=> 'simple-subscribe',
            'required' 	=> false,
        ),
        array(
            'name' 		=> 'Display Tweets',
            'slug' 		=> 'display-tweets-php',
            'required' 	=> false,
        ),

    );

    // Change this to your theme text domain, used for internationalising strings
    $theme_text_domain = 'framework';

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'domain'       		=> 'framework',         	// Text domain - likely want to be the same as your theme.
        'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
        'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
        'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
        'menu'         		=> 'install-required-plugins', 	// Menu slug
        'has_notices'      	=> true,                       	// Show admin notices or not
        'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not
        'message' 			=> '',							// Message to output right before the plugins table
        'strings'      		=> array(
            'page_title'                       			=> __( 'Install Required Plugins', 'framework' ),
            'menu_title'                       			=> __( 'Install Plugins', 'framework' ),
            'installing'                       			=> __( 'Installing Plugin: %s', 'framework' ), // %1$s = plugin name
            'oops'                             			=> __( 'Something went wrong with the plugin API.', 'framework'),
            'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.','framework' ), // %1$s = plugin name(s)
            'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.','framework' ), // %1$s = plugin name(s)
            'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.','framework' ), // %1$s = plugin name(s)
            'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.','framework' ), // %1$s = plugin name(s)
            'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.','framework' ), // %1$s = plugin name(s)
            'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.','framework' ), // %1$s = plugin name(s)
            'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.','framework' ), // %1$s = plugin name(s)
            'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.','framework' ), // %1$s = plugin name(s)
            'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins','framework' ),
            'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins','framework' ),
            'return'                           			=> __( 'Return to Required Plugins Installer', 'framework' ),
            'plugin_activated'                 			=> __( 'Plugin activated successfully.', 'framework' ),
            'complete' 									=> __( 'All plugins installed and activated successfully. %s', 'framework'), // %1$s = dashboard link
            'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
        )
    );

    tgmpa( $plugins, $config );

}