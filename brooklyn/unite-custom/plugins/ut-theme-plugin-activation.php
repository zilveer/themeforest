<?php if ( ! defined( 'ABSPATH' ) ) exit;

/** 
 * Plugin Requirements for this theme
 *
 * @return    void
 *
 * @access    private
 * @since     1.0.0
 * @version   1.0.0
 */
if ( ! function_exists( '_ut_register_required_plugins' ) ) : 

    function _ut_register_required_plugins() {
    
        $plugins = array(
            
            array(
                'name'      			=> 'Contact Form 7',
                'slug'      			=> 'contact-form-7',
                'required'  			=> false,
				'version' 				=> '4.3', 
            ),

			array(
                'name'      			=> 'Easy Theme and Plugin Upgrades',
                'slug'      			=> 'easy-theme-and-plugin-upgrades',
                'required'  			=> false,
				'version' 				=> '1.0.4', 
            ),
			
			array(
				'name'     				=> 'Revolution Slider',
				'slug'     				=> 'revslider',
				'source'   				=> FW_STYLE_DOCUMENT_ROOT . '/plugins/lib/revslider.zip', 
				'required' 				=> true, 
				'version' 				=> '5.2.5.4', 
			),
						
		    array(
				'name'     				=> 'Twitter by UnitedThemes',
				'slug'     				=> 'ut-twitter',
				'source'   				=> FW_STYLE_DOCUMENT_ROOT . '/plugins/lib/ut-twitter.zip', 
				'required' 				=> true, 
				'version' 				=> '3.1.1', 
			),
			
			array(
				'name'     				=> 'Shortcodes by UnitedThemes',
				'slug'     				=> 'ut-shortcodes',
				'source'   				=> FW_STYLE_DOCUMENT_ROOT . '/plugins/lib/ut-shortcodes.zip', 
				'required' 				=> true, 
				'version' 				=> '4.1', 
			),
			
			array(
				'name'     				=> 'Portfolio Management by UnitedThemes',
				'slug'     				=> 'ut-portfolio',
				'source'   				=> FW_STYLE_DOCUMENT_ROOT . '/plugins/lib/ut-portfolio.zip', 
				'required' 				=> true, 
				'version' 				=> '3.8.6', 
			),
			
			array(
				'name'     				=> 'Pricing Tables by United Themes',
				'slug'     				=> 'ut-pricing',
				'source'   				=> FW_STYLE_DOCUMENT_ROOT . '/plugins/lib/ut-pricing.zip', 
				'required' 				=> true, 
				'version' 				=> '3.0', 
			),
            
            array(
				'name'     				=> 'WPBakery Visual Composer',
				'slug'     				=> 'js_composer',
				'source'   				=> FW_STYLE_DOCUMENT_ROOT . '/plugins/lib/js_composer.zip', 
				'required' 				=> true, 
				'version' 				=> '4.12', 
			)
            
        
        );
         
        $config = array(
            
            'default_path' 		=> '',                         	/* Default absolute path to pre-packaged plugins */
            'menu'         		=> 'install-required-plugins', 	/* Menu slug */
            'has_notices'      	=> true,                       	/* Show admin notices or not */
            'is_automatic'    	=> true,					   	/* Automatically activate plugins after installation or not */
           
        );
        
        tgmpa( $plugins, $config );
    
    }
    
    add_action( 'tgmpa_register', '_ut_register_required_plugins' );
    
endif;