<?php

class Znb_Scripts_Manager{
	function __construct(){
		add_action( 'delete_post', array( $this, 'delete_asset_cache' ) );
	}


	/**
	 * Will return the cache directory path and url
	 *
	 * @return array the path and url to the cache folder
	 */
	function get_asset_config( $type = null ){
		$type = $type ? $type : 'cache';
		$wp_upload_dir  = wp_upload_dir();
		$dir_name = 'kallyas-builder';
		$allowed_asset_types = array( 'cache' );

		// Don't proceed if we don't allow this type of asset directory
		if( ! in_array( $type, $allowed_asset_types ) ){
			return false;
		}

		$asset_config = array(
			'path'	 => $wp_upload_dir['basedir'] . '/' . $dir_name . '/'. $type .'/',
			'url'	 => $wp_upload_dir['baseurl'] . '/' . $dir_name . '/'. $type .'/',
		);

		// Create the file if it doesn't exists
		zn_create_folder( $asset_config['path'] );

		return $asset_config;
	}

	/**
	 * Will delete all cached files for a post
	 *
	 * @param string $post_id The post id for wich we need to clear the cache
	 */
	function delete_asset_cache( $post_id = null ){
		// Will delete the cache for a post id
		$post_id      = $post_id ? $post_id: ZNPB()->get_post_id();
		$cache_config = $this->get_asset_config();
		$files = array(
			$cache_config['path'] . $post_id . '-layout.css',
			$cache_config['path'] . $post_id . '-layout.js',
		);

		foreach ( $files as $file_path ) {
			if ( file_exists( $file_path ) ) {
				unlink( $file_path );
			}
		}
	}


	function delete_all_cache(){
		// Will delete the cache for a post id
		$cache_config 		= $this->get_asset_config();
		$css_files          = glob( $cache_config['path'] . '*.css' );
		$js_files           = glob( $cache_config['path'] . '*.js' );

		if ( is_array( $css_files ) ) {
			array_map( 'unlink', $css_files );
		}
		if ( is_array( $js_files ) ) {
			array_map( 'unlink', $js_files );
		}
	}

	function enqueue_cached_assets( $post_id = null ){
		// Will enqueue both css and js
		$post_id       = $post_id ? $post_id: ZNPB()->get_post_id();
		$cache_path    = $this->get_asset_config();
		$css_file_name = $post_id.'-layout.css';
		$css_file      = $cache_path['url'] . $css_file_name;
		$js_file       = $cache_path['url'] . $post_id.'-layout.js';
		$version       = $this->get_asset_version( $post_id );

		if( $post_id ){
			if( ! file_exists( $css_file ) || ZN()->is_debug() ){
				$this->create_asset_css( $post_id );
			}

			wp_enqueue_style( $css_file_name, $css_file, array(), $version );
		}
		else{
			// We may have a smart area set
			$registered_smart_areas = ZNPB()->get_registered_smart_areas();

			if( ! empty( $registered_smart_areas ) ){
				foreach ($registered_smart_areas as $key => $area_id) {

					$css_file_name = $area_id.'-smart-layout.css';
					$css_file      = $cache_path['url'] . $css_file_name;
					$js_file       = $cache_path['url'] . $area_id.'-smart-layout.js';

					if( ! file_exists( $css_file ) || ZN()->is_debug() ){
						$this->create_smart_area_css( $area_id );
					}

					wp_enqueue_style( $css_file_name, $css_file, array(), $version );

				}
			}
		}

	}



	/**
	 * Will return an asset version
	 *
	 * @param string $post_id The current post id
	 */
	function get_asset_version( $post_id = null ){
		$post_id = $post_id ? $post_id : ZNPB()->get_post_id();

		if( ZNPB()->is_active_editor ){
			return md5(uniqid());
		}
		else{
			return md5(get_post_modified_time('U', false, $post_id));
		}
	}


	function create_smart_area_css( $post_id = null ){
		// Will create the css file asset
		$post_id = $post_id ? $post_id : ZNPB()->get_post_id();

		if( empty( $post_id ) ){
			return false;
		}

		$area_layout = get_post_meta( $post_id, 'zn_page_builder_els', true );


		$cache_config = $this->get_asset_config();
		$loaded_assets = array();
		$css = '';

		// Save the old instantiated modules
		$old_instances = ZNPB()->instantiated_modules;

		// Instantiate area modules
		ZNPB()->load_page_modules( $area_layout );

		$current_layout = ZNPB()->instantiated_modules;
		foreach ( $current_layout as $key => $element_instance ) {

			$element_config = ZNPB()->all_available_elements[ $element_instance->data['object'] ];

			if( empty( $element_config ) ){
				continue;
			}

			// Only add css once
			if( ! isset( $loaded_assets[$element_instance->data['object']] ) ){
				// Add the style.css file if present
				if( file_exists( $element_config['path'].'/style.css' ) ){
					$css .= file_get_contents( $element_config['path'].'/style.css' );
				}

				// Add the style.php file if present
				if( file_exists( $element_config['path'].'/style.php' ) ){
					ob_start();
						include( $element_config['path'].'/style.php' );
					$css .= ob_get_clean();
				}
			}

			// Add inline styles for the element
			if( method_exists( $element_instance, 'css' ) ){
				$css .= $element_instance->css();
			}

			$loaded_assets[$element_instance->data['object']] = true;

		}

		// Restore the old instances
		ZNPB()->instantiated_modules = $old_instances;

		if( ! ZN()->is_debug() ){
			$css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css); // Remove comments
			$css = str_replace(': ', ':', $css); // Remove space after colons
			$css = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $css); // Remove whitespace
		}

		file_put_contents( $cache_config['path'] . $post_id . '-smart-layout.css', $css );

	}

	function create_asset_css( $post_id = null ){
		// Will create the css file asset
		$post_id = $post_id ? $post_id : ZNPB()->get_post_id();

		if( empty( $post_id ) ){
			return false;
		}

		$current_layout = ZNPB()->instantiated_modules;
		$cache_config = $this->get_asset_config();
		$loaded_assets = array();
		$css = '';
		foreach ( $current_layout as $key => $element_instance ) {

			$element_config = ZNPB()->all_available_elements[ $element_instance->data['object'] ];

			if( empty( $element_config ) ){
				continue;
			}

			// Only add css once
			if( ! isset( $loaded_assets[$element_instance->data['object']] ) ){
				// Add the style.css file if present
				if( file_exists( $element_config['path'].'/style.css' ) ){
					$css .= file_get_contents( $element_config['path'].'/style.css' );
				}

				// Add the style.php file if present
				if( file_exists( $element_config['path'].'/style.php' ) ){
					ob_start();
						include( $element_config['path'].'/style.php' );
					$css .= ob_get_clean();
				}
			}

			// Add inline styles for the element
			if( method_exists( $element_instance, 'css' ) ){
				$css .= $element_instance->css();
			}

			$loaded_assets[$element_instance->data['object']] = true;

		}

		if( ! ZN()->is_debug() ){
			$css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css); // Remove comments
			$css = str_replace(': ', ':', $css); // Remove space after colons
			$css = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $css); // Remove whitespace
		}

		file_put_contents( $cache_config['path'] . $post_id . '-layout.css', $css );

	}


	function create_asset_js( $post_id = null ){
		// Will create the js file asset
	}


}

return new Znb_Scripts_Manager();