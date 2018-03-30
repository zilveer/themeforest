<?php

/*
 * checks whether a new/old post is of one of the $post_types
 */

function wpv_is_post_type( $type, $post_types = '' ) {

	if ( $post_types == '' )
		return true;

	$check = '';

	switch ( $type ) {
		case 'new':
			if ( 'post-new.php' != basename( $_SERVER['PHP_SELF'] ) )
				return false;

			$check = isset( $_GET['post_type'] ) ?
						$_GET['post_type'] :
						( isset( $_POST['post_type'] ) ?
							$_POST['post_type'] :
							'post'
						);
		break;

		case 'post':
			if ( 'post.php' != basename( $_SERVER['PHP_SELF'] ) )
				return false;

			$post  = isset( $_GET['post'] ) ?
						$_GET['post'] :
						( isset( $_POST['post'] ) ?
							$_POST['post'] :
							false
						);
			$check = get_post_type( $post );
		break;
	}

	if ( is_string( $post_types ) && $check == $post_types )
		return true;
	if ( is_array( $post_types ) && in_array( $check, $post_types ) )
		return true;
	return false;
}

/*
 * saves theme/framework config
 */

function wpv_save_config( $options ) {
	if ( isset( $_POST['doreset'] ) ) {
		echo 'Deleting... ';
	}

	foreach ( $options as $option ) {
		if ( isset( $option['id'] ) && ! empty( $option['id'] ) ) {
			wpv_save_option_by_id( $option['id'], $option['type'] );
		} elseif ( $option['type'] == 'select_checkbox' ) {
			wpv_save_option_by_id( $option['id_select'], 'select_checkbox' );
			wpv_save_option_by_id( $option['id_checkbox'], 'select_checkbox' );
		} elseif ( $option['type'] == 'social' ) {
			$places   = array( 'post', 'page', 'portfolio', 'lightbox', 'product', 'tribe' );
			$networks = array( 'twitter', 'facebook', 'googleplus', 'pinterest' );

			foreach ( $places as $place ) {
				foreach ( $networks as $network ) {
					wpv_save_option_by_id( "share-$place-$network", 'social' );
				}
			}
		} elseif ( $option['type'] == 'horizontal_blocks' ) {
			$id = $option['id_prefix'];
			wpv_update_option( $id, $_POST[$id] );

			for ( $i = 1; $i <= $_POST["$id-max"]; $i++ ) {
				wpv_save_option_by_id( "$id-$i-width", 'select' );
				wpv_save_option_by_id( "$id-$i-last", 'checkbox' );
				wpv_save_option_by_id( "$id-$i-empty", 'checkbox' );
			}
		} elseif ( $option['type'] == 'color-row' ) {
			foreach ( $option['inputs'] as $id => $name ) {
				wpv_save_option_by_id( $id, 'color' );
			}
		} elseif ( $option['type'] == 'select-row' ) {
			foreach ( $option['selects'] as $id => $name ) {
				wpv_save_option_by_id( $id, 'select' );
			}
		}

		if ( isset( $option['process'] ) && function_exists( $option['process'] ) )
			wpv_update_option( $option['id'], $option['process']( $option, wpv_get_option( $option['id'] ) ) );
	}

	do_action( 'vamtam_saved_options' );
	return wpv_finalize_custom_css();
}

/*
 * saves a single option by id
 */

function wpv_save_option_by_id( $id, $type ) {
	if ( isset( $_POST[$id] ) ) {
		if ( $type == 'multiselect' ) {
			if ( empty( $_POST[$id] ) )
				wpv_update_option( $id, array() );
			else
				wpv_update_option( $id, array_unique( $_POST[$id] ) );
		} else {
			wpv_update_option( $id, $_POST[$id] );
		}
	} elseif ( $type == 'font' || $type == 'background' ) {

		$suboptions = array(
			'font' => array(
				'size',
				'lheight',
				'face',
				'weight',
				'color',
			),
			'background' => array(
				'image',
				'opacity',
				'color',
				'position',
				'attachment',
				'repeat',
				'size',
			),
		);

		foreach ( $suboptions[$type] as $opt ) {
			$name = $id.'-'.$opt;

			if ( isset( $_POST[$name] ) ) {
				wpv_update_option( $name, $_POST[$name] );
			} else {
				wpv_delete_option( $name );
			}

			if ( isset( $_POST['doreset'] ) ) {
				wpv_delete_option( $name );
			}
		}
	} elseif ( $type === 'checkbox' ) {
		wpv_update_option( $id, 'false' );
	} else {
		wpv_update_option( $id, false );
	}

	if ( isset( $_POST['doreset'] ) ) {
		wpv_delete_option( $id );
		return false;
	}
}

/**
 *
 * @desc registers a theme activation hook
 * @param string $code : Code of the theme. This can be the base folder of your theme. Eg if your theme is in folder 'mytheme' then code will be 'mytheme'
 * @param callback $function : Function to call when theme gets activated.
 */
function wpv_register_theme_activation_hook( $code, $function ) {
	$optionKey = 'theme_is_activated_' . $code;
	if ( ! get_option( $optionKey ) ) {
		call_user_func( $function );
		update_option( $optionKey , 1 );
	}
}

/**
 * @desc registers deactivation hook
 * @param string $code : Code of the theme. This must match the value you provided in wpv_register_theme_activation_hook function as $code
 * @param callback $function : Function to call when theme gets deactivated.
 */
function wpv_register_theme_deactivation_hook( $code, $function ) {
	// store function in code specific global
	$GLOBALS['wpv_register_theme_deactivation_hook_function' . $code] = $function;

	// create a runtime function which will delete the option set while activation of this theme and will call deactivation function provided in $function
	$fn = create_function( '$theme', ' call_user_func( $GLOBALS["wpv_register_theme_deactivation_hook_function' . $code . '"] ); delete_option( "theme_is_activated_' . $code. '" );' );

	// add above created function to switch_theme action hook. This hook gets called when admin changes the theme.
	// Due to wordpress core implementation this hook can only be received by currently active theme ( which is going to be deactivated as admin has chosen another one.
	// Your theme can perceive this hook as a deactivation hook.
	add_action( 'switch_theme', $fn );
}

// wpv activation hook
function wpv_theme_activated() {
	if ( wpv_validate_install() )
		wp_redirect( admin_url( 'admin.php?page=wpv_import' ) );
}
wpv_register_theme_activation_hook( 'wpv_'.THEME_NAME, 'wpv_theme_activated' );

// wpv deactivation hook
function wpv_theme_deactivated() {
}
wpv_register_theme_deactivation_hook( 'wpv_'.THEME_NAME, 'wpv_theme_deactivated' );

add_action( 'admin_init', 'wpv_validate_install' );
function wpv_validate_install() {
	global $wpv_errors, $wpv_validated;
	if ( $wpv_validated )
		return;

	$wpv_validated = true;
	$wpv_errors    = array();

	if ( strpos( str_replace( WP_CONTENT_DIR.'/themes/', '', get_template_directory() ), '/' ) !== false ) {
		$wpv_errors[] = __( 'The theme must be installed in a directory which is a direct child of wp-content/themes/', 'health-center' );
	}

	if ( ! is_writable( WPV_CACHE_DIR ) ) {
		$wpv_errors[] = sprintf( __( 'You must set write permissions (755 or 777) for the cache directory (%s)', 'health-center' ), WPV_CACHE_DIR );
	}

	if ( ! extension_loaded( 'gd' ) || ! function_exists( 'gd_info' ) ) {
		$wpv_errors[] = __( "It seems that your server doesn't have the GD graphic library installed. Please contact your hosting provider, they should be able to assist you with this issue", 'health-center' );
	}

	if ( count( $wpv_errors ) ) {
		if ( ! function_exists( 'wpv_invalid_install' ) ) {
			function wpv_invalid_install() {
				global $wpv_errors;
				?>
					<div class="updated fade error" style="background: #FEF2F2; border: 1px solid #DFB8BB; color: #666;"><p>
						<?php _e( 'There were some some errors with your Vamtam theme setup:', 'health-center' )?>
						<ul>
							<?php foreach ( $wpv_errors as $error ): ?>
								<li><?php echo $error // xss ok ?></li>
							<?php endforeach ?>
						</ul>
					</p></div>
				<?php
			}
			add_action( 'admin_notices', 'wpv_invalid_install' );
		}
		switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );
		return false;
	}

	return true;
}

function wpv_static( $option ) {
	if ( isset( $option['static'] ) && $option['static'] ) {
		echo 'static';
	}
}

function wpv_description( $id, $desc ) {
	if ( ! empty( $desc ) ): ?>
		<div class="row-desc">
			<a href="#" class="va-icon va-icon-info desc-handle"></a>
			<div>
				<section class="content"><?php echo $desc // xss ok ?></section>
				<footer><a href="<?php echo esc_attr( 'http://support.vamtam.com' ) ?>" title="<?php esc_attr_e( 'Read more on our Help Desk', 'health-center' ) ?>"><?php _e( 'Read more on our Help Desk', 'health-center' ) ?></a></footer>			</div>
		</div>
	<?php endif;
}

function wpv_add_admin_menu_separator( $position ) {
	global $menu;
	$index = 0;
	foreach ( $menu as $offset => $section ) {
		if ( substr( $section[2],0,9 ) == 'separator' )
			$index++;

		if ( $offset >= $position ) {
			$menu[$position] = array( '', 'read', "separator{$index}", '', 'wp-menu-separator' );
			break;
		}
	}
	ksort( $menu );
}
