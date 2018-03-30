<?php

define('A13_DEMO_DATA_DIR', A13_TPL_DIR.'/demo_data/');
global $a13_site_config;
$a13_site_config = false;
$a13_config_file = A13_DEMO_DATA_DIR.'/site_config';
if ( file_exists( $a13_config_file ) ){
	$a13_site_config = unserialize( base64_decode(file_get_contents($a13_config_file) ) );
}

function a13_demo_data_clear_content($sublevel, &$sublevel_name){
    global $wpdb;

    $min = $max = 0;

    //removes all posts, pages, works etc.
    $sql = "SELECT MIN(ID) as min, MAX(ID) as max FROM `{$wpdb->posts}`";
    extract( $wpdb->get_row( $sql, ARRAY_A ) );
    // Now you have $min and $max

    for( $i = $min; $i <= $max ; $i++ ) {
        wp_delete_post( $i, true );
    }


    //remove all menus
    $menus = wp_get_nav_menus();
    foreach($menus as $menu){
        wp_delete_nav_menu($menu->term_id);
    }



    //removes all Revolution sliders
    if(class_exists('RevSlider')){
        $slider = new RevSlider();
        $arrSliders = $slider->getArrSliders();
        foreach($arrSliders as $slider){
            $data = array('sliderid' => $slider->getID());
            $slider->deleteSliderFromData($data);
        }
    }

    //removes all Layer sliders
    if(function_exists('lsSliders')){
        $arrSliders = lsSliders(200,true,false);
        foreach($arrSliders as $slider){
            $id = $slider['id'];
            LS_Sliders::delete( intval($id) );
        }
    }

    //this step is done
    return true;
}


function a13_demo_data_install_plugins($sublevel, &$sublevel_name){
	$plugins = require_once(A13_DEMO_DATA_DIR. '/plugins-list.php');

    //save last plugin
    end($plugins);
    $last_plugin = key($plugins);
    reset($plugins);

    if(strlen($sublevel) === 0){//we will install first plugin on list but in second call of this function
        $sublevel = key($plugins);
        $sublevel_name = $plugins[$sublevel]['name'];
    }
    else{
	    $sublevel = (int)$sublevel;//convert from string type

	    // move to currently installing plugin
        while (key($plugins) !== $sublevel) next($plugins);

	    a13_do_plugin_install($plugins[$sublevel]);

        //if this was last plugin on list then we end this process
        if($last_plugin === $sublevel){
            $sublevel = true;
        }
        else{
            next($plugins); //move to next
            $sublevel = key($plugins); //we will install this one in next call
            $sublevel_name = $plugins[$sublevel]['name'];
        }
    }


    return $sublevel;
}


function a13_get_plugin_basename_from_slug( $slug, &$plugins ) {

	$keys = array_keys( $plugins );

	foreach ( $keys as $key ) {
		if ( preg_match( '|^' . $slug .'|', $key ) )
			return $key;
	}

	return $slug;
}


function a13_do_plugin_install($plugin = array()) {
	// For plugins from WP repository
	if(!isset($plugin['source'])) {
		$plugin['source'] = 'repo';
	}

	// Retrieve a list of all the plugins
	$installed_plugins = get_plugins();

	// Add file_path key for plugin
	$plugin['file_path'] = a13_get_plugin_basename_from_slug( $plugin['slug'], $installed_plugins );

	// Install/update/activate states
	$install_type = false;
	$activate_plugin = false;

	// What to do with this plugin
	// Do nothing or update
	if ( isset( $installed_plugins[$plugin['file_path']] ) ) {
		// A minimum version has been specified
		if ( isset( $plugin['version'] ) && isset( $installed_plugins[$plugin['file_path']]['Version'] ) ) {
			if ( version_compare( $installed_plugins[$plugin['file_path']]['Version'], $plugin['version'], '<' ) ) {
				$install_type = 'update';
				$activate_plugin = true;
			}
		}
	}
	// Install
	else{
		$install_type = 'install';
		$activate_plugin = true;
	}

	// Activate
	if ( is_plugin_inactive( $plugin['file_path'] ) ) {
		$activate_plugin = true;
	}

	/** Pass all necessary information via URL if WP_Filesystem is needed */
	$url = esc_url( wp_nonce_url(
		add_query_arg(
			array(
				'page'          => '',
				'plugin'        => $plugin['slug'],
				'plugin_name'   => $plugin['name'],
				'plugin_source' => $plugin['source'],
				'a13-plugin-install' => 'install-plugin',
			),
			admin_url()
		),
		'a13-plugin-install'
	) );
	$method = ''; // Leave blank so WP_Filesystem can populate it as necessary
	$fields = array( sanitize_key( 'a13-plugin-install' ) ); // Extra fields to pass to WP_Filesystem

	if ( false === ( $creds = request_filesystem_credentials( $url, $method, false, false, $fields ) ) )
		return true;

	if ( ! WP_Filesystem( $creds ) ) {
		request_filesystem_credentials( $url, $method, true, false, $fields ); // Setup WP_Filesystem
		return true;
	}

	require_once ABSPATH . 'wp-admin/includes/plugin-install.php'; // Need for plugins_api
	require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php'; // Need for upgrade classes
	require_once dirname(__FILE__). '/class-a13-plugin-installer-skin.php'; // Overwrite of Plugin_Installer_Skin that doesn't clear buffer


	/** Set plugin source to WordPress API link if available */
	if ( isset( $plugin['source'] ) && 'repo' == $plugin['source'] ) {
		$api = plugins_api( 'plugin_information', array( 'slug' => $plugin['slug'], 'fields' => array( 'sections' => false ) ) );

		if ( is_wp_error( $api ) )
			wp_die( $api );

		if ( isset( $api->download_link ) )
			$plugin['source'] = $api->download_link;
	}

	/** Set type, based on whether the source starts with http:// or https:// */
	$type = preg_match( '|^http(s)?://|', $plugin['source'] ) ? 'web' : 'upload';

	/** Prep variables for Plugin_Installer_Skin class */
	$title = sprintf( a13__be('Installing %s'), $plugin['name'] );
	$url   = esc_url( add_query_arg( array( 'action' => 'install-plugin', 'plugin' => $plugin['slug'] ), 'update.php' ) );

	$nonce = 'install-plugin_' . $plugin['slug'];

	/** Prefix a default path to pre-packaged plugins */
	$source = $plugin['source'];



	/** Create a new instance of Plugin_Upgrader */
	$upgrader = new Plugin_Upgrader( $skin = new A13_Plugin_Installer_Skin( compact( 'type', 'title', 'url', 'nonce', 'plugin', 'api' ) ) );

	// Enable maintenance mode if needed
	if($install_type !== false || $activate_plugin !== false){
		$upgrader->maintenance_mode(true);
	}

	/** Perform the action and install the plugin from the $source urldecode() */
	if ( $install_type === 'update' ) {
		delete_site_transient('update_plugins');
		$data = get_site_transient( 'update_plugins' );
		if ( ! is_object($data) )
			$data = new stdClass;
		@$data->response[$plugin['slug']]->package = $source; // @ cause it is often made from StdClass and it gives warning
		$data->response[$plugin['slug']]->version  = $plugin['version'];

		set_site_transient( 'update_plugins', $data );
		$upgrader->upgrade( $plugin['slug'] );
		echo sprintf( a13__be('Plugin updated: %s'), $plugin['name'] )."\r\n";
	}
	elseif($install_type === 'install'){
		$upgrader->install( $source );
		echo sprintf( a13__be('Plugin installed: %s'), $plugin['name'] )."\r\n";
	}

	/** Flush plugins cache so we can make sure that the installed plugins list is always up to date */
	wp_cache_flush();

	// Try to activate plugin
	if($activate_plugin){
		$plugin_activate = $upgrader->plugin_info(); // Grab the plugin info from the Plugin_Upgrader method
		// Activation of only inactive plugins
		if($plugin_activate === false){
			$activate = activate_plugin( $plugin['file_path'] );
		}
		// Activating while installing/updating
		else{
			$activate = activate_plugin( $plugin_activate );
		}

		if ( is_wp_error( $activate ) ) {
			echo $activate->get_error_message();
		}
		else {
			echo sprintf( a13__be('Plugin activated: %s'), $plugin['name'] )."\r\n";
		}
	}

	// Disable maintenance mode if needed
	if($install_type !== false || $activate_plugin !== false){
		$upgrader->maintenance_mode(false);
	}

	return true;
}


function a13_demo_data_install_layer_sliders($sublevel, &$sublevel_name){
    //imports all Layer sliders
    if(defined('LS_ROOT_PATH')){
        include LS_ROOT_PATH.'/classes/class.ls.importutil.php';
        if(class_exists('LS_ImportUtil')){
            $dir = A13_DEMO_DATA_DIR.'/layer/';
            if( is_dir( $dir ) ) {
                foreach ( (array)glob($dir.'/*.zip') as $file ){
                    new LS_ImportUtil($file);
                }
            }
        }
    }


    //this step is done
    return true;
}


function a13_demo_data_install_revo_sliders($sublevel, &$sublevel_name){
    //imports all Revolution sliders
    if(class_exists('RevSlider')){
        $slider = new RevSlider();
        $dir = A13_DEMO_DATA_DIR.'/revo/';
        if( is_dir( $dir ) ) {
            foreach ( (array)glob($dir.'/*.zip') as $file ){
                $_FILES["import_file"]["tmp_name"] = $file;
                $slider->importSliderFromPost();
            }
        }
    }

    //this step is done
    return true;
}


function a13_demo_data_install_content($sublevel, &$sublevel_name){
    //imports all posts, pages, works etc.
    require_once('a13-wordpress-importer/wordpress-importer.php');

    if(class_exists('A13_WP_Import')){

        $file = A13_DEMO_DATA_DIR.'demo_data.xml';
        set_time_limit(0);
	    //we get previous state
	    if(strlen($sublevel)){
		    $importer = unserialize(stripslashes($sublevel));
	    }
	    //we start importer for first time
	    else{
            $importer = new A13_WP_Import();
	    }
        $is_done = $importer->import( $file );
	    if(!$is_done){
		    //empty posts array, cause we will read from file again and it adds lot of weight
		    $importer->posts = array();
		    $sublevel = serialize($importer);
		    $sublevel_name = sprintf( a13__be('Last imported post of Id %s'), $importer->last_post_did )."\r\n";
		    return $sublevel;
	    }
    }

    //this step is done
    return true;
}


function a13_demo_data_setup_widgets($sublevel, &$sublevel_name){
	global $a13_site_config;
	if($a13_site_config !== false){
        //first put widgets configuration
        $widget_config = unserialize($a13_site_config['widgets']);
        foreach($widget_config as $name => $value){
            update_option($name, $value);
        }

	    //next lets tell which widget in which sidebar is:-)
        $sidebars_config = unserialize($a13_site_config['sidebars']);
        update_option( 'sidebars_widgets', $sidebars_config);
	}

    //this step is done
    return true;
}


function a13_demo_data_setup_fp($sublevel, &$sublevel_name){
	global $a13_site_config;
	if($a13_site_config !== false){
        $config = unserialize($a13_site_config['frontpage']);
        foreach($config as $name => $value){
            update_option($name, $value);
        }
    }

    //this step is done
    return true;
}


function a13_demo_data_setup_wc($sublevel, &$sublevel_name){
	global $a13_site_config;
	if($a13_site_config !== false){
        $config = unserialize($a13_site_config['woocommerce']);
        foreach($config as $name => $value){
            update_option($name, $value);
        }
    }

    //this step is done
    return true;
}


function a13_demo_data_setup_menus($sublevel, &$sublevel_name){
	global $a13_site_config;
	if($a13_site_config !== false){
		$menusy = unserialize($a13_site_config['menus']);
		$nav_menus = wp_get_nav_menus( array('orderby' => 'name') );

		foreach($menusy as $location => $term){
			//search for such menu in available menus
			$our_menu = false;
			foreach($nav_menus as $menu){
				if($menu->slug === $term){//found it!
					$our_menu = $menu;
					break;
				}
			}

			if($our_menu !== false){
				//set this menu to proper location
				$locations = get_theme_mod('nav_menu_locations');
				$locations[$location] = $our_menu->term_id;
				set_theme_mod( 'nav_menu_locations', $locations );
			}

		}
	}


    //this step is done
    return true;
}


function a13_demo_data_setup_permalinks($sublevel, &$sublevel_name){
	global $wp_rewrite;
	$wp_rewrite->set_permalink_structure('/%postname%/');
	$wp_rewrite->flush_rules();

    //this step is done
    return true;
}


function a13_demo_data_import_predefined_set($sublevel, &$sublevel_name){
    global $a13_apollo13;
    $config_file = A13_DEMO_DATA_DIR.'/predefined_set';
    if ( file_exists( $config_file ) ){
        $config = file_get_contents($config_file);

        $_POST[ 'a13_import_page' ] = true;
        $_POST[ 'a13_import_options_select' ] = $config;

        $a13_apollo13->demo_data_import_predefined_set();
    }

    //this step is done
    return true;
}