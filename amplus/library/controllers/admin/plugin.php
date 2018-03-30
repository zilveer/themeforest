<?php

class BFIAdminPluginController {
    
    private $pluginModels = array();
    
    function __construct() {
        $this->loadpluginModels();
        
        // load TGM class
        if (count($this->pluginModels) 
            && file_exists(BFI_LIBRARYPATH . 'includes/class-tgm-plugin-activation.php')) {
            require_once BFI_LIBRARYPATH . 'includes/class-tgm-plugin-activation.php';
        }
        
        add_action('tgmpa_register', array($this, 'registerpluginModels'));
    }
       
    // load all plugin models in application/models/admin/plugin
    private function loadpluginModels() {
        $definedClasses = get_declared_classes();
        $this->pluginModels = array();
        foreach ($definedClasses as $i => $className) {
            if (preg_match('/^BFIAdminPlugin[a-zA-Z0-9]+Model$/', $className)) {
                $this->pluginModels[] = new $className();
            }
        }
    }    
    
    public function registerpluginModels() {
        if (count($this->pluginModels)) {
            $plugins = array();
            foreach ($this->pluginModels as $pluginModel) {
                $plugins[] = $pluginModel->createPluginArgs();
            }

            $config = array(
        		'domain'       		=> BFI_I18NDOMAIN,         	    // Text domain - likely want to be the same as your theme.
        		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
        		'parent_menu_slug' 	=> BFIAdminController::$themeMenuSlug, 				// Default parent menu slug
        		'parent_url_slug' 	=> 'admin.php', 				// Default parent URL slug
        		'menu'         		=> 'install-required-plugins', 	// Menu slug
        		'has_notices'      	=> true,                       	// Show admin notices or not
        		'is_automatic'    	=> true,					   	// Automatically activate plugins after installation or not
        		'message' 			=> '',							// Message to output right before the plugins table
        		'strings'      		=> array(
        			'page_title'                       			=> __( 'Install Required Plugins', BFI_I18NDOMAIN ),
        			'menu_title'                       			=> __( 'Install Plugins', BFI_I18NDOMAIN ),
        			'installing'                       			=> __( 'Installing Plugin: %s', BFI_I18NDOMAIN ), // %1$s = plugin name
        			'oops'                             			=> __( 'Something went wrong with the plugin API.', BFI_I18NDOMAIN ),
        			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
        			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
        			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
        			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
        			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
        			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
        			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
        			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
        			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
        			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
        			'return'                           			=> __( 'Return to Required Plugins Installer', BFI_I18NDOMAIN ),
        			'plugin_activated'                 			=> __( 'Plugin activated successfully.', BFI_I18NDOMAIN ),
        			'complete' 									=> __( 'All plugins installed and activated successfully. %s', BFI_I18NDOMAIN ), // %1$s = dashboard link
        			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
        		)
        	);
        	
        	tgmpa( $plugins, $config );
        }
    }
}
