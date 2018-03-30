<?php

	/*
	*
	*	Swift Page Builder - Includes Class
	*	------------------------------------------------
	*	Swift Framework
	* 	Copyright Swift Ideas 2013 - http://www.swiftideas.net
	*
	*/
	
	/* DEFINITIONS
	================================================== */ 
	$lib_dir = $spb_settings['SPB_BUILDER_LIB'];
	$shortcodes_dir = $spb_settings['SPB_BUILDER_SHORTCODES'];
	
	
	/* INCLUDE LIB FILES
	================================================== */ 
	require_once( $lib_dir . 'abstract.php' );
	require_once( $lib_dir . 'helpers.php' );
	require_once( $lib_dir . 'mapper.php' );
	require_once( $lib_dir . 'shortcodes.php' );
	require_once( $lib_dir . 'builder.php' );
	require_once( $lib_dir . 'media_tab.php' );
	require_once( $lib_dir . 'layouts.php' );	
	
	
	/* INCLUDE SHORTCODE FILES
	================================================== */
	if ( ! function_exists( 'spb_register_assets' ) ) {
        function spb_register_assets() {
            $pb_assets = array();
            $path      = dirname( __FILE__ ) . '/shortcodes/';
            $folders   = scandir( $path, 1 );
            foreach ( $folders as $file ) {
                if ( $file == '.' || $file == '..' || $file == '.DS_Store' || $file == "blog-grid-old.php" || strpos($file,'.php') != true ) {
                    continue;
                }
                $file               = substr( $file, 0, - 4 );
                $pb_assets[ $file ] = SPB_SHORTCODES . $file . '.php' ;
            }

            $pb_assets = apply_filters( 'spb_assets_filter', $pb_assets );

            if ( ! sf_woocommerce_activated() ) {
                unset( $pb_assets['products'] );
            }

            // Load Each Asset
            foreach ( $pb_assets as $asset ) {
                require_once( $asset );
            }

        }

        if ( is_admin() ) {
            add_action( 'admin_init', 'spb_register_assets', 2 );
        }
        if ( ! is_admin() ) {
            add_action( 'wp', 'spb_register_assets', 2 );
        }
    }
	
	/* LAYOUT & SHORTCODE SETUP
	================================================== */
	require_once( $lib_dir . 'default-map.php' );
	
?>