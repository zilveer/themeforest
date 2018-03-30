<?php

if ( ! defined( 'BTPFX' ) ) {
	define( 'BTPFX', 'bt_theme' );
}

if ( ! function_exists( 'bt_set_global_pfx' ) ) {
	function bt_set_global_pfx() {
		echo '<script>window.BTPFX = "' . esc_js( BTPFX ) . '";</script>';
	}
}
add_action( 'customize_preview_init', 'bt_set_global_pfx' );

if ( ! function_exists( 'bt_set_global_uri' ) ) {
	function bt_set_global_uri() {
		echo '<script>window.BTURI = "' . esc_js( get_template_directory_uri() ) . '"; window.BTAJAXURL = "' . esc_js( admin_url( 'admin-ajax.php' ) ) . '";</script>';
	}
}
add_action( 'wp_head', 'bt_set_global_uri' );

get_template_part( 'php/customization' );
get_template_part( 'editor-buttons/editor-buttons' );

if ( ! isset( $content_width ) ) {
	$content_width = 768;
}

if ( ! function_exists( 'bt_load_theme_textdomain' ) ) {
	function bt_load_theme_textdomain(){
		load_theme_textdomain( 'bt_theme', get_template_directory() . '/languages' );
	}
}
add_action( 'after_setup_theme', 'bt_load_theme_textdomain' );

add_theme_support( 'automatic-feed-links' );

add_theme_support( 'post-thumbnails', array( 'post', 'page' ) );

add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

add_theme_support( 'post-formats', array( 'image', 'gallery', 'video', 'audio', 'link', 'quote' ) );

if ( ! function_exists( 'bt_remove_recent_comments_style' ) ) {
	function bt_remove_recent_comments_style() {  
        global $wp_widget_factory;  
        remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
	}
}
add_action( 'widgets_init', 'bt_remove_recent_comments_style' );

if ( ! function_exists( 'bt_search_form' ) ) {
	function bt_search_form( $form ) {
		$form = '<div class="onSideSearch"><div class="osSearch" role="search"><form action="/" method="get"><input type="text" name="s" placeholder="' . esc_attr( __( 'Looking for...', 'bt_theme' ) ) . '" class="untouched"><button type="submit" data-icon="&#xf105;"></button></form></div></div>';
		return $form;
	}
}
add_filter( 'get_search_form', 'bt_search_form' );

if ( ! function_exists( 'bt_remove_more_link_scroll' ) ) {
	function bt_remove_more_link_scroll( $link ) {
		$link = preg_replace( '|#more-[0-9]+|', '', $link );
		return $link;
	}
}
add_filter( 'the_content_more_link', 'bt_remove_more_link_scroll' );

global $date_format;
if ( function_exists( 'icl_register_string' ) ) {
	icl_register_string( 'bt_theme', 'Date Format', get_option( 'date_format' ) );
	$date_format = icl_t( 'bt_theme', 'Date Format', get_option( 'date_format' ) );
} else {
	$date_format = get_option( 'date_format' );
}

// image sizes
update_option( 'thumbnail_size_w', 160 );
update_option( 'thumbnail_size_h', 160 );
update_option( 'medium_size_w', 320 );
update_option( 'medium_size_h', 0 );
update_option( 'large_size_w', 960 );
update_option( 'large_size_h', 0 );

add_image_size( 'grid', 640 );

if ( ! function_exists( 'bt_enqueue_scripts_styles' ) ) {
	function bt_enqueue_scripts_styles() {
		global $wp_styles;
		wp_enqueue_style( 'bt_style_css', get_stylesheet_directory_uri() . '/style.css', array(), false );
		wp_enqueue_style( 'bt_main_css', get_stylesheet_directory_uri() . '/css/main.min.css', array(), false );
		wp_enqueue_style( 'bt_mobile_css', get_stylesheet_directory_uri() . '/css/mobile.min.css', array(), false, 'all and (min-width: 0px) and (max-width: 1025px)' );
		wp_enqueue_style( 'bt_ie9_css', get_stylesheet_directory_uri() . '/css/ie9.css', array(), false );
		$wp_styles->add_data( 'bt_ie9_css', 'conditional', 'IE 9' );
		wp_enqueue_style( 'bt_ie10_css', get_stylesheet_directory_uri() . '/css/ie10.css', array(), false );
		wp_enqueue_script( 'bt_modernizr_js', get_template_directory_uri() . '/js/modernizr.custom.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'bt_slick_js', get_template_directory_uri() . '/js/slick.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'bt_misc_js', get_template_directory_uri() . '/js/misc.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'bt_select_js', get_template_directory_uri() . '/js/fancySelect.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'bt_script_js', get_template_directory_uri() . '/js/script.js', array( 'jquery' ), '', true );
		
		wp_enqueue_script( 'bt_magnific_popup', get_template_directory_uri() . '/js/jquery.magnific-popup.min.js', array( 'jquery' ), '', true );
		wp_enqueue_style( 'bt_magnific_popup_css', get_stylesheet_directory_uri() . '/css/magnific-popup-custom.css', array(), false );
	}
}
add_action( 'wp_enqueue_scripts', 'bt_enqueue_scripts_styles' );

if ( ! function_exists( 'bt_editor_style' ) ) {
	function bt_editor_style() {
		add_editor_style( 'css/editor_style.css' );
	}
}
add_action( 'after_setup_theme', 'bt_editor_style' );

if ( ! function_exists( 'bt_register_menus' ) ) {
	function bt_register_menus() {
		register_nav_menus( array (
			'primary' => __( 'Primary Menu', 'bt_theme' ),
			'footer'  => __( 'Footer Menu', 'bt_theme' )
		));
	}
}
add_action( 'init', 'bt_register_menus' );

if ( ! function_exists( 'bt_remove_menu_item_whitespace' ) ) {
	function bt_remove_menu_item_whitespace( $items ) {
		return preg_replace( '/>(\s|\n|\r)+</', '><', $items );
	}
}
add_filter( 'wp_nav_menu_items', 'bt_remove_menu_item_whitespace' );

if ( ! function_exists( 'bt_register_sidebar' ) ) {
	function bt_register_sidebar() {
		register_sidebar( array (
			'name' 			=> __( 'Sidebar', 'bt_theme' ),
			'id' 			=> 'primary_widget_area',
			'description' 	=> '',
			'before_widget' => '<div class="btBox %2$s">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<h4>',
			'after_title' 	=> '</h4>',
		));
		
		register_sidebar( array (
			'name' 			=> __( 'Footer Widget Area 1', 'bt_theme' ),
			'id' 			=> 'footer_widget_area_1',
			'description' 	=> '',
			'before_widget' => '<div class="btBox %2$s">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<h4>',
			'after_title' 	=> '</h4>',
		));

		register_sidebar( array (
			'name' 			=> __( 'Footer Widget Area 2', 'bt_theme' ),
			'id' 			=> 'footer_widget_area_2',
			'description' 	=> '',
			'before_widget' => '<div class="btBox %2$s">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<h4>',
			'after_title' 	=> '</h4>',
		));

		register_sidebar( array (
			'name' 			=> __( 'Footer Widget Area 3', 'bt_theme' ),
			'id' 			=> 'footer_widget_area_3',
			'description' 	=> '',
			'before_widget' => '<div class="btBox %2$s">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<h4>',
			'after_title' 	=> '</h4>',
		));		
	}
}
add_action( 'widgets_init', 'bt_register_sidebar' );

// meta boxes
get_template_part( 'config-meta-boxes' );

if ( ! function_exists( 'add_scripts' ) ) {
	function add_scripts() {
		wp_enqueue_media();
		wp_enqueue_script( 'bt_media_manager', get_template_directory_uri() . '/js/media_manager.js', array( ), '1.0', true );
	}
}
add_action( 'customize_controls_enqueue_scripts', 'add_scripts' );

if ( ! function_exists( 'bt_wp_video_shortcode' ) ) {
	function bt_wp_video_shortcode( $item_html, $atts, $video, $post_id, $library ) {
		$replace_value = 'width: ' . $atts['width'] . 'px';
		$replace_with  = 'width: 100%';
		return str_ireplace( $replace_value, $replace_with, $item_html );
	}
}
add_filter( 'wp_video_shortcode', 'bt_wp_video_shortcode', 10, 5 );

if ( ! function_exists( 'bt_wp_video_shortcode_library' ) ) {
	function bt_wp_video_shortcode_library() {
		wp_enqueue_style( 'wp-mediaelement' );
		wp_enqueue_script( 'bt_video_shortcode', get_template_directory_uri() . '/js/video_shortcode.js', array( 'mediaelement' ), '', true );
		return 'bt_mejs';
	}
}
add_filter( 'wp_video_shortcode_library', 'bt_wp_video_shortcode_library' );

if ( ! function_exists( 'bt_wp_audio_shortcode_library' ) ) {
	function bt_wp_audio_shortcode_library() {
		wp_enqueue_style( 'wp-mediaelement' );
		wp_enqueue_script( 'bt_audio_shortcode', get_template_directory_uri() . '/js/audio_shortcode.js', array( 'mediaelement' ), '', true );
		return 'bt-mejs';
	}
}
add_filter( 'wp_audio_shortcode_library', 'bt_wp_audio_shortcode_library' );

if ( ! function_exists( 'bt_pagination' ) ) {
	function bt_pagination() {
	
		$prev = get_previous_posts_link( __( 'Newer Posts', 'bt_theme' ) );
		$next = get_next_posts_link( __( 'Older Posts', 'bt_theme' ) );
		
		$pattern = '/(<a href=".*")/';
		
		echo '<div class="newerOlder">
			' . preg_replace( $pattern, '$1 class="btn chubby newer"', $prev ) . preg_replace( $pattern, '$1 class="btn chubby older"', $next ) . '
		</div><!-- /newerOlder -->';
	}
}

if ( ! function_exists( 'bt_de_script' ) ) {
	function bt_de_script() {
		wp_dequeue_script( 'rwmb-clone' );
		wp_deregister_script( 'rwmb-clone' );
	}
}
add_action( 'wp_print_scripts', 'bt_de_script', 100 );

if ( ! function_exists( 'bt_admin_style' ) ) {
	function bt_admin_style() {
		echo '<style>
			.rwmb-meta-box input[type="text"], .rwmb-meta-box select {
				width:250px;
			}
			.rwmb-meta-box input[type="text"].bt_bttext {
				width:190px;
			}
		</style>';
	}
}
add_action( 'admin_head', 'bt_admin_style' );

if ( ! function_exists( 'bt_admin_customize_style' ) ) {
	function bt_admin_customize_style() {
		echo '<style>
			.customize-control-image, .customize-control-text, .customize-control-select, 
			.customize-control-radio, .customize-control-checkbox, .customize-control-color {
				padding-top:5px;
				padding-bottom:5px;
			}
		</style>';
	}
}
add_action( 'customize_controls_print_styles', 'bt_admin_customize_style' );

if ( ! class_exists( 'RWMB_BTText_Field' ) && class_exists( 'RWMB_Field' ) ) {
	class RWMB_BTText_Field extends RWMB_Field {
	
		static function admin_enqueue_scripts() {			
			wp_enqueue_script( 
				'bt_text',
				get_template_directory_uri() . '/js/bt_text.js',
				array( 'jquery' ),
				'',
				true
			);
		}

		static function html( $meta, $field ) {	
			$meta_key = substr( $meta, 0, strpos( $meta, ':' ) );
			$meta_value = substr( $meta, strpos( $meta, ':' ) + 1 );
			$vars = get_class_vars( 'BT_Customize_Default' );
			$select = '<select class="bttext_clear bt_bttext-select" style="vertical-align:baseline;height:auto;">';
			$select .= '<option value=""></option>';
			foreach ( $vars as $key => $var ) {
				$selected_html = '';
				if ( BTPFX . '_' . $key == $meta_key ) {
					$selected_html = 'selected="selected"';
				}
				$select .= '<option value="' . esc_attr( BTPFX . '_' . $key ) . '" ' . $selected_html . '>' . esc_html( $key ) . '</option>';
			}
			$select .= '</select>';
			$input = ' <input type="text" class="bttext_clear bt_bttext" value="' . esc_attr( $meta_value ) . '">';
			return sprintf(
				'<input type="hidden" class="rwmb-text" name="%s" id="%s" value="%s" placeholder="%s" %s>%s',
				$field['field_name'],
				$field['id'],
				$meta,
				$field['placeholder'],
				//! $field['datalist'] ?  '' : "list='{$field['datalist']['id']}'",
				'',
				self::datalist_html($field)
			) . $select . $input;
		}

		static function normalize_field( $field ) {
			$field = wp_parse_args( $field, array(
				'size'        => 30,
				'datalist'    => false,
				'placeholder' => '',
			) );
			return $field;
		}

		static function datalist_html( $field ) {
			return '';
			/*if( ! $field['datalist'] )
				return '';
			$datalist = $field['datalist'];
			$item_html = sprintf(
				'<datalist id="%s">',
				$datalist['id']
			);

			foreach( $datalist['options'] as $option ) {
				$item_html .= sprintf( '<option value="%s"></option>', $option );
			}

			$item_html .= '</datalist>';

			return $item_html;*/
		}
	}
}

if ( ! function_exists( 'bt_theme_comment' ) ) {
	function bt_theme_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
			// Display trackbacks differently than normal comments.
		?>
		<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
			<p><?php _e( 'Pingback:', 'bt_theme' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'bt_theme' ), '<span class="edit-link">', '</span>' ); ?></p>
		<?php
				break;
			default :
			// Proceed with normal comments.
			global $post;
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
			<article id="comment-<?php comment_ID(); ?>">
				<?php $avatar_html = get_avatar( $comment, 140 ); 
					if ( $avatar_html != '' ) {
						echo '<div class="commentAvatar">' . $avatar_html . '</div>';
					}
				?>
				<div class="commentTxt">
					<div class="vcard">
						<?php
							printf( '<h5 class="author"><span class="fn">%1$s</span></h5>', get_comment_author_link() );
							echo '<p class="posted">' . sprintf( __( '%1$s at %2$s', 'bt_theme' ), get_comment_date(), get_comment_time() ) . '</p>';
						?>
					</div>

					<?php if ( '0' == $comment->comment_approved ) : ?>
						<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'bt_theme' ); ?></p>
					<?php endif; ?>

					<div class="comment">
						<?php comment_text(); ?>
						<?php edit_comment_link( __( 'Edit', 'bt_theme' ), '<p class="edit-link">', '</p>' ); ?>
					</div>
					
					<p class="reply">
						<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'bt_theme' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					</p>
				</div>
			</article>
		<?php
			break;
		endswitch;
	}
}

if ( ! function_exists( 'bt_title' ) ) {
	function bt_title( $title ) {
		if ( empty( $title ) && ( is_home() || is_front_page() ) ) {
			$title = __( 'Home', 'bt_theme' );
		}
		return get_bloginfo( 'name' ) . ' - ' . trim( $title );
	}
}
add_filter( 'wp_title', 'bt_title' );

if ( ! function_exists( 'bt_get_attachment_id_from_url' ) ) {
	function bt_get_attachment_id_from_url( $attachment_url = '' ) {
	 
		global $wpdb;
		$attachment_id = false;
	 
		if ( '' == $attachment_url ) {
			return;
		}
	 
		$upload_dir_paths = wp_upload_dir();

		$attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );
 
		$attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );
 
		$attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );
	 
		return $attachment_id;
	}
}

/**
 * Include the TGM_Plugin_Activation class.
 */
get_template_part( 'class-tgm-plugin-activation' );
add_action( 'tgmpa_register', 'bt_theme_register_required_plugins' );
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
if ( ! function_exists( 'bt_theme_register_required_plugins' ) ) {
	function bt_theme_register_required_plugins() {
	 
		/**
		 * Array of plugin arrays. Required keys are name and slug.
		 * If the source is NOT from the .org repo, then source is also required.
		 */
		$plugins = array(
	 
			array(
				'name'               => 'BT Plugin', // The plugin name.
				'slug'               => 'bt_plugin', // The plugin slug (typically the folder name).
				'source'             => get_template_directory() . '/plugins/bt_plugin.zip', // The plugin source.
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'version'            => '1.0.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
				'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			),
			array(
				'name'               => 'Meta Box', // The plugin name.
				'slug'               => 'meta-box', // The plugin slug (typically the folder name).
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			)			

		);
	 
		/**
		 * Array of configuration settings. Amend each line as needed.
		 * If you want the default strings to be available under your own theme domain,
		 * leave the strings uncommented.
		 * Some of the strings are added into a sprintf, so see the comments at the
		 * end of each line for what each argument will be.
		 */
		$config = array(
			'default_path' => '',                      // Default absolute path to pre-packaged plugins.
			'menu'         => 'tgmpa-install-plugins', // Menu slug.
			'has_notices'  => true,                    // Show admin notices or not.
			'dismissable'  => false,                    // If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => true,                   // Automatically activate plugins after installation or not.
			'message'      => '',                      // Message to output right before the plugins table.
			'strings'      => array(
				'page_title'                      => __( 'Install Required Plugins', 'tgmpa' ),
				'menu_title'                      => __( 'Install Plugins', 'tgmpa' ),
				'installing'                      => __( 'Installing Plugin: %s', 'tgmpa' ), // %s = plugin name.
				'oops'                            => __( 'Something went wrong with the plugin API.', 'tgmpa' ),
				'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s).
				'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s).
				'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s).
				'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
				'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
				'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s).
				'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.<br><br>If you want to update BT Plugin (included with Genie theme) please activate some other theme, delete BT Plugin from Plugins, activate Genie theme and install BT Plugin (click Begin installing plugin inside notification box which you will see after Genie theme is activated).', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.<br><br>If you want to update BT Plugin (included with Genie theme) please activate some other theme, delete BT Plugin from Plugins, activate Genie theme and install BT Plugin (click Begin installing plugin inside notification box which you will see after Genie theme is activated).' ), // %1$s = plugin name(s).
				'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s).
				'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
				'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins' ),
				'return'                          => __( 'Return to Required Plugins Installer', 'tgmpa' ),
				'plugin_activated'                => __( 'Plugin activated successfully.', 'tgmpa' ),
				'complete'                        => __( 'All plugins installed and activated successfully. %s', 'tgmpa' ), // %s = dashboard link.
				'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
			)
		);
	 
		tgmpa( $plugins, $config );
	 
	}
}

if ( ! function_exists( 'bt_get_grid_callback' ) ) {
	function bt_get_grid_callback() {

		$offset = intval( $_POST['offset'] );

		$recent_posts = bt_get_posts_data( 12, $offset, $_POST['cat_slug'], intval( $_POST['limit'] ) );
		bt_dump_grid( $recent_posts, true );
		
		die();
	}
}
add_action( 'wp_ajax_bt_get_grid', 'bt_get_grid_callback' );
add_action( 'wp_ajax_nopriv_bt_get_grid', 'bt_get_grid_callback' );

if ( ! function_exists( 'bt_get_tile_grid_callback' ) ) {
	function bt_get_tile_grid_callback() {

		$offset = intval( $_POST['offset'] );

		$recent_posts = bt_get_posts_data( 16, $offset, $_POST['cat_slug'], intval( $_POST['limit'] ) );
		bt_dump_tile_grid( $recent_posts, true );
		
		die();
	}
}
add_action( 'wp_ajax_bt_get_tile_grid', 'bt_get_tile_grid_callback' );
add_action( 'wp_ajax_nopriv_bt_get_tile_grid', 'bt_get_tile_grid_callback' );

if ( ! function_exists( 'bt_dump_grid' ) ) {
	function bt_dump_grid( $arr, $json ) {
		if ( count( $arr ) == 0 ) {
			echo 'no_posts';
		}
		
		$new_arr = array();
		
		$i = 0;
		foreach ( $arr as $post ) {
		
			$media = '';
			$item_html = '';
			
			$hw = '';
			
			if ( $post['thumbnail'] != '' ) {
				$media = '<div class="mediaBox bt_img_grid">' . $post['thumbnail'] . '<a href="' . esc_url( $post['permalink'] ) . '"></a></div>';
				
				if ( $post['format'] != 'gallery' && $post['format'] != 'video' && $post['format'] != 'audio' && $post['format'] != 'link' && $post['format'] != 'quote' ) {
				
					$tn_id = get_post_thumbnail_id( $post['ID'] );
					
					$img = wp_get_attachment_image_src( $tn_id, 'grid' );
					
					if ( $img[1] == 0 || $img[1] == '' ) {
						$media = '';
					} else {
						$hw = $img[2] / $img[1];
					}
				}
				
				if ( $post['format'] == 'video' ) {
					$hw = 9 / 16;
				}
			}
			
			if ( $post['format'] == 'image' && $post['thumbnail'] == '' ) {
			
				foreach ( $post['images'] as $img ) {
					$img = wp_get_attachment_image_src( $img['ID'], 'grid' );
					if ( $img[1] == 0 || $img[1] == '' ) {
						$media = '';
					} else {
						$src = $img[0];
						$hw = $img[2] / $img[1];
						$media = '<div class="mediaBox bt_img_grid"><img src="' . esc_url( $src ) . '" alt="' . esc_attr( basename( $src ) ) . '"><a href="' . esc_url( $post['permalink'] ) . '"></a></div>';
					}
					break;
				}
				
			} else if ( $post['format'] == 'gallery' ) {
			
				$images_ids = array();
				foreach ( $post['images'] as $img ) {
					$images_ids[] = $img['ID'];
				}			
				if ( $post['grid_gallery'] ) {
					$media = do_shortcode( '[bt_grid_gallery ids="' . join( ',', $images_ids ) . '" size="grid"]' );
				} else {
					if ( count( $images_ids ) > 0 ) {
						$img = wp_get_attachment_image_src( $images_ids[0], 'grid' );
						$src = $img[0];
						if ( $img[1] == 0 || $img[1] == '' ) {
							$media = '';
						} else {
							$hw = $img[2] / $img[1];
							$media = do_shortcode( '[gallery ids="' . join( ',', $images_ids ) . '" size="grid"]' );
						}						
					}
				}
				
			} else if ( $post['format'] == 'video' ) {
				
				$media = '<div class="mediaBox"><div class="videoBox"><img class="aspectKeeper" src="' . esc_url( get_template_directory_uri() . '/gfx/16x9.gif' ) . '" alt="" role="presentation" aria-hidden="true"><div class="videoPort">';
				
				$video = $post['video'];

				if ( strpos( $video, 'vimeo.com/' ) > 0 ) {
					$video_id = substr( $video, strpos( $video, 'vimeo.com/' ) + 10 );
					$media .= '<ifra' . 'me src="' . esc_url( 'http://player.vimeo.com/video/' . $video_id ) . '" allowfullscreen></ifra' . 'me>';
				} else {
					$yt_id_pattern = '~(?:http|https|)(?::\/\/|)(?:www.|)(?:youtu\.be\/|youtube\.com(?:\/embed\/|\/v\/|\/watch\?v=|\/ytscreeningroom\?v=|\/feeds\/api\/videos\/|\/user\S*[^\w\-\s]|\S*[^\w\-\s]))([\w\-]{11})[a-z0-9;:@#?&%=+\/\$_.-]*~i';
					$youtube_id = ( preg_replace( $yt_id_pattern, '$1', $video ) );
					if ( strlen( $youtube_id ) == 11 ) {
						$media .= '<ifra' . 'me width="560" height="315" src="' . esc_url( 'http://www.youtube.com/embed/' . $youtube_id ) . '" allowfullscreen></ifra' . 'me>';
					} else {	
						$media .= do_shortcode( $video );
					}
				}
				
				$media .= '</div></div></div>';
				
			} else if ( $post['format'] == 'audio' ) {
			
				$audio = $post['audio'];
				
				if ( strpos( $audio, '</ifra' . 'me>' ) > 0 ) {
					$media = '<div class="soundCloudBox">' . wp_kses( $audio, array( 'iframe' => array( 'height' => array(), 'src' =>array() ) ) ) . '</div>';
				} else {
					$media = '<div class="mediaBox">' . do_shortcode( $audio ) . '</div>';
				}
				
			} else if ( $post['format'] == 'link' ) {
				
				$media = '<blockquote class="quote link"><p>' . esc_html( $post['link_title'] ) . '</p><p class="author"><a href="' . esc_url( $post['link_url'] ) . '">' . esc_url( $post['link_url'] ) . '</a></p></blockquote>';
				
			} else if ( $post['format'] == 'quote' ) {
				
				$media = '<blockquote class="quote"><p>' . esc_html( $post['quote'] ) . '</p><p class="author">' . esc_html( $post['quote_author'] ) . '</p></blockquote>';
				
			}
			
			if ( ! $json ) {
				$item_html = '<div class="gridItem">';
			}

			$item_html .= '<article class="classic grid"><h2>grid</h2>' . $media . '<header><h3>' . $post['category'] . '</h3><h2><a href="' . esc_url( $post['permalink'] ) . '">' . esc_html( $post['title'] ) . '</a></h2>';
			
			$blog_author = bt_get_option( 'blog_author' );
			$blog_date = bt_get_option( 'blog_date' );
			
			$meta = '';
			
			if ( ( $blog_author && $post['author'] != '' ) || $blog_date ) {
				$meta .= '<p class="meta">';
				if ( $blog_date ) $meta .= esc_html( $post['date'] );
				if ( $blog_date && $blog_author && $post['author'] != '' ) $meta .= ' &mdash; ';
				if ( $blog_author && $post['author'] != '' ) $meta .= __( 'by', 'bt_theme' ) . ' ' . $post['author'];
				$meta .= '</p>';
			}
			
			$item_html .= $meta;
			
			if ( bt_get_option( 'blog_share_on_grid' ) ) {
				$blog_share_facebook = bt_get_option( 'blog_share_facebook' );
				$blog_share_twitter = bt_get_option( 'blog_share_twitter' );
				$blog_share_google_plus = bt_get_option( 'blog_share_google_plus' );
				$blog_share_linkedin = bt_get_option( 'blog_share_linkedin' );
				$blog_share_vk = bt_get_option( 'blog_share_vk' );

				get_template_part( 'php/share' );

				$share_html = '';
				if ( $blog_share_facebook || $blog_share_twitter || $blog_share_google_plus || $blog_share_linkedin || $blog_share_vk ) {
					
					if ( $blog_share_facebook ) {
						$share_html .= '<a href="' . esc_url( bt_get_share_link( 'facebook', $post['permalink'] ) ) . '" class="ico" title="Facebook"><span data-icon="&#xf09a;"></span></a>';
					}
					if ( $blog_share_twitter ) {
						$share_html .= '<a href="' . esc_url( bt_get_share_link( 'twitter', $post['permalink'] ) ) . '" class="ico" title="Twitter"><span data-icon="&#xf099;"></span></a>';
					}
					if ( $blog_share_linkedin ) {
						$share_html .= '<a href="' . esc_url( bt_get_share_link( 'linkedin', $post['permalink'] ) ) . '" class="ico" title="LinkedIn"><span data-icon="&#xf0e1;"></span></a>';
					}
					if ( $blog_share_google_plus ) {
						$share_html .= '<a href="' . esc_url( bt_get_share_link( 'google_plus', $post['permalink'] ) ) . '" class="ico" title="Google Plus"><span data-icon="&#xf0d5;"></span></a>';
					}
					if ( $blog_share_vk ) {
						$share_html .= '<a href="' . esc_url( bt_get_share_link( 'vk', $post['permalink'] ) ) . '" class="ico" title="VK"><span data-icon="&#xf189;"></span></a>';
					}
				}
				
				$item_html .= '<div class="bt_grid_share">' . $share_html . '</div>';
			}
			
			$item_html .= '</header></article>';
			
			if ( ! $json ) {
				$item_html .= '</div>';
			}			
			
			if ( $json ) {
				$new_arr[ $i ]['html'] = $item_html;
				$new_arr[ $i ]['hw'] = $hw;
				$i++;
			} else {
				echo $item_html;
			}
			
		}
		
		if ( $json ) {
			echo json_encode( $new_arr );
		}
	}
}

if ( ! function_exists( 'bt_dump_tile_grid' ) ) {
	function bt_dump_tile_grid( $arr, $json ) {
		if ( count( $arr ) == 0 ) {
			echo 'no_posts';
		}

		$new_arr = array();
		
		$i = 0;
		foreach ( $arr as $post ) {
		
			$item_class = ' shading';
			
			$media = '';
			$item_html = '';
			
			$hw = '';
			
			if ( $post['thumbnail'] != '' ) {
				$media = '<div class="mediaBox">' . $post['thumbnail'] . '</div>';
				
				$tn_id = get_post_thumbnail_id( $post['ID'] );

				$img = wp_get_attachment_image_src( $tn_id, 'grid' );
				
				if ( $img[1] == 0 || $img[1] == '' ) {
					$media = '';
				} else {
					$hw = $img[2] / $img[1];
				}				
			}
			
			if ( $post['format'] == 'image' && $post['thumbnail'] == '' ) {
				foreach ( $post['images'] as $img ) {
					$img = wp_get_attachment_image_src( $img['ID'], 'grid' );
					if ( $img[1] == 0 || $img[1] == '' ) {
						$media = '';
					} else {
						$src = $img[0];
						$hw = $img[2] / $img[1];
						$media = '<div class="mediaBox"><img src="' . esc_url( $src ) . '" alt="' . esc_attr( basename( $src ) ) . '"></div>';
					}
					break;
				}
			}
			
			if ( $hw == '' ) {
				$item_class .= ' noImage';
			}
			
			if ( ! $json ) {
				$item_html = '<div class="gridItem">';
			}
			$item_html .= '<article class="classic tile' . $item_class . '"><h2>tile</h2><a class="tileAnchor" href="' . esc_url( $post['permalink'] ). '"></a>';
			$item_html .= $media;

			$item_html .= '<header><h3>' . $post['category'] . '</h3><h2><a href="' . esc_url( $post['permalink'] ) . '">' . esc_html( $post['title'] ) . '</a></h2>';
			
			$blog_author = bt_get_option( 'blog_author' );
			$blog_date = bt_get_option( 'blog_date' );
			
			$meta = '';
			
			if ( ( $blog_author && $post['author'] != '' ) || $blog_date ) {
				$meta .= '<p class="meta">';
				if ( $blog_date ) $meta .= esc_html( $post['date'] );
				if ( $blog_date && $blog_author && $post['author'] != '' ) $meta .= ' &mdash; ';
				if ( $blog_author && $post['author'] != '' ) $meta .= __( 'by', 'bt_theme' ) . ' ' . $post['author'];
				$meta .= '</p>';
			}			
			
			$item_html .= $meta;		
			
			$item_html .= '</header></article>';
				
			if ( ! $json ) {
				$item_html .= '</div>';
			}
			
			if ( $json ) {
				$new_arr[ $i ]['html'] = $item_html;
				$new_arr[ $i ]['hw'] = $hw;
				$i++;
			} else {
				echo $item_html;
			}
		}
		
		if ( $json ) {
			echo json_encode( $new_arr );
		}		
	}
}

if ( ! function_exists( 'bt_get_posts_data' ) ) {
	function bt_get_posts_data( $number, $offset, $cat_slug, $limit ) {
		if ( $limit > 0 ) {
			if ( $limit <= $number + $offset && $limit >= $offset ) {
				$number = $limit - $offset;
			} else if ( $limit < $offset ) {
				$number = 0;
			}
		}
		
		$posts_data1 = array();
		$posts_data2 = array();
		
		$sticky = false;
		if ( intval( bt_get_option( 'sticky_in_grid' ) == 1 ) ) {
			$sticky = true;
			$sticky_array = get_option( 'sticky_posts' );
		}
		
		if ( $offset == 0 && $sticky ) {
			$recent_posts_q_sticky = new WP_Query( array( 'post__in' => $sticky_array, 'post_status' => 'publish' ) );
			$posts_data1 = bt_get_posts_array( $recent_posts_q_sticky, array() );
		}
		
		if ( $number > 0 ) {
			if ( $cat_slug != '' ) {
				$cat = get_category_by_slug( $cat_slug );
				$cat_id = $cat->term_id;
				$recent_posts_q = new WP_Query( array( 'posts_per_page' => $number, 'offset' => $offset, 'category_name' => $cat_slug, 'post_status' => 'publish' ) );
			} else {
				$recent_posts_q = new WP_Query( array( 'posts_per_page' => $number, 'offset' => $offset, 'post_status' => 'publish' ) );
			}
		}
		
		if ( $sticky ) {
			$posts_data2 = bt_get_posts_array( $recent_posts_q, $sticky_array );
		} else {
			$posts_data2 = bt_get_posts_array( $recent_posts_q, array() );
		}
		
		return array_merge( $posts_data1, $posts_data2 );

	}
}

if ( ! function_exists( 'bt_get_posts_array' ) ) {
	function bt_get_posts_array( $recent_posts_q, $sticky_arr ) {
	
		global $date_format;
		$posts_data = array();
		$i = 0;

		while ( $recent_posts_q->have_posts() ) {
			$recent_posts_q->the_post();
			$post_id = get_the_ID();
			
			if ( in_array( $post_id, $sticky_arr ) ) {
				continue;
			}
			
			$posts_data[ $i ]['permalink'] = get_permalink();
			$posts_data[ $i ]['format'] = get_post_format();
			$posts_data[ $i ]['title'] = get_the_title();
			
			$posts_data[ $i ]['date'] = date_i18n( $date_format, strtotime( get_the_time( 'Y-m-d', $post_id ) ) );
			
			$post = get_post();
			
			$user_data = get_userdata( $post->post_author );
			if ( $user_data ) {
				$author = $user_data->data->display_name;
				$author_url = get_author_posts_url( $post->post_author );
				$posts_data[ $i ]['author'] = '<a href="' . esc_url( $author_url ) . '">' . esc_html( $author ) . '</a>';
			} else {
				$posts_data[ $i ]['author'] = '';
			}
			
			$categories = get_the_category( $post_id );
			$categories_html = '';
			if ( $categories ) {
				foreach ( $categories as $cat ) {
					$categories_html .= '<a href="' . esc_url( get_category_link( $cat->term_id ) ) . '">' . esc_html( $cat->name ) . '</a>';
				}
			}

			$posts_data[ $i ]['category'] = $categories_html;
			
			$post_thumbnail_id = get_post_thumbnail_id( $post_id );
			if ( $post_thumbnail_id != '' ) {
				$img = wp_get_attachment_image_src( $post_thumbnail_id, 'grid' );
				$thumbnail_src = $img[0];
				$posts_data[ $i ]['thumbnail'] = '<img src="' . esc_url( $thumbnail_src ) . '" alt="' . esc_attr( basename( $thumbnail_src ) ) . '">';
			} else {
				$posts_data[ $i ]['thumbnail'] = '';
			}
			
			$posts_data[ $i ]['images'] = bt_rwmb_meta( BTPFX . '_images', 'type=image', $post_id );
			if ( $posts_data[ $i ]['images'] == null ) $posts_data[ $i ]['images'] = array();
			$posts_data[ $i ]['video'] = bt_rwmb_meta( BTPFX . '_video', array(), $post_id );
			$posts_data[ $i ]['audio'] = bt_rwmb_meta( BTPFX . '_audio', array(), $post_id );
			$posts_data[ $i ]['grid_gallery'] = bt_rwmb_meta( BTPFX . '_grid_gallery', array(), $post_id );
			$posts_data[ $i ]['link_title'] = bt_rwmb_meta( BTPFX . '_link_title', array(), $post_id );
			$posts_data[ $i ]['link_url'] = bt_rwmb_meta( BTPFX . '_link_url', array(), $post_id );
			$posts_data[ $i ]['quote'] = bt_rwmb_meta( BTPFX . '_quote', array(), $post_id );
			$posts_data[ $i ]['quote_author'] = bt_rwmb_meta( BTPFX . '_quote_author', array(), $post_id );
			$posts_data[ $i ]['ID'] = $post_id;
			
			$i++;
			
		}
		
		wp_reset_postdata();
		
		return $posts_data;		
	}
}

if ( ! function_exists( 'bt_inline_style' ) ) {
	function bt_inline_style() {
		$color = esc_html( bt_get_option( 'accent_color' ) );
		$body_font = urldecode( bt_get_option( 'body_font' ) );
		$heading_font = urldecode( bt_get_option( 'heading_font' ) );
		
		$custom_css = '';
		
		if ( $color != '' ) {
			list( $r, $g, $b ) = sscanf( $color, '#%02x%02x%02x' );
			$dark_r = $r - 20;
			$dark_g = $g - 20;
			$dark_b = $b - 20;
			if ( $dark_r < 0 ) {
				$dark_r = 0;
			}
			if ( $dark_g < 0 ) {
				$dark_g = 0;
			}
			if ( $dark_b < 0 ) {
				$dark_b = 0;
			}
			$dark_color = 'rgb(' . intval( $dark_r ) . ', ' . intval( $dark_g ) . ', ' . intval( $dark_b ) . ')';
			$custom_css .= "
			a {
				color:{$color};
			}

			h1 a:hover, h2 a:hover {
				color:{$color};
			}
			
			a.btn, button.btn, p.form-submit #submit, .comment-navigation a, a.comment-reply-link, ul.comments .commentTxt p.edit-link a {
				border: 1px solid {$color};
			}
			
			.onSideSearch input[type=\"text\"] {
				border: 1px solid {$color};
			}
			
			.onSideSearch input[type=\"text\"]:focus, .fancy-select .trigger.open {
				border: 1px solid {$dark_color};
			}

			.mainNav ul li a {
				color:{$color};
			}

			.mainNav ul li:hover a {
				background-color:{$color};
			}

			.mainNav ul ul {
				background-color:{$color};
			}

			.mainNav ul ul li a:hover {
				color:{$color};
			}

			.ssPort input[type=\"text\"] {
				color:{$color};
			}

			span.closeSearch:hover {
				color:{$dark_color};
			}

			span.menuToggler {
				color:{$color};
			}

			.tsBlock .cat {
				color:{$color};
			}

			.tsBlock .cat b:before {
				background-color:{$color};
			}

			.tsBlock .posted strong {
				color:{$color};
			}

			.topSlidePort .slick-dots li.slick-active button, .topSlidePort .slick-dots li.slick-active:hover button {
				color:{$color};
			}

			.classic header h3 a:before {
				background-color:{$color};
			}

			.classic header.light h3 a:before {
				background-color:{$color};
			}

			.classic header h3.errorCode {
				color:{$color};
			}

			.classic header a:hover {
				color:{$dark_color};
			}
			
			.classic footer .ico span {
				border: 1px solid {$color};
			}

			.classic footer .ico:hover span {
				background-color:{$color};
			}

			blockquote {
				background-color:{$color};
			}

			.btBox a:hover {
				color:{$dark_color};
			}

			.btBox .recentTweets li p.posted {
				color:{$color};
			}

			.btBox .recentTweets li a {
				color:{$dark_color};
			}

			.fooNav ul li a:hover {
				color:{$color};
			}

			.onSideSearch button {
				background-color:{$color};
				border: 1px solid {$color};
			}

			.onSideSearch button:hover {
				color:{$color};
			}

			.catList li {
				color:{$color};
			}

			.catList li a {
				color:{$color};
			}

			.catList li a:hover {
				color:{$dark_color};
			}

			.popularPosts ul li .ppTxt h5 a:hover, #recentcomments li.recentcomments a:hover, .widget_archive ul li a:hover, .widget_pages ul li a:hover, .widget_meta ul li a:hover {
				color:{$color};
			}

			.widget_archive ul li, .widget_categories ul li {
				color:{$color};
			}

			.latestComments li h5 a:hover {
				color:{$dark_color};
			}

			.tagsCloud ul li a {
				background-color:{$color};
				border: 1px solid {$color};
			}

			.tagsCloud ul li a:hover {
				color:{$color};
			}

			.tagcloud a {
				background-color:{$color};
				border: 1px solid {$color};
			}

			.tagcloud a:hover {
				color:{$color};
			}
			
			span.enhanced {
				border: 1px solid {$color};
			}

			.post footer .tagsCloud li a {
				color:{$color};
			}

			.post footer .tagsCloud li a:hover {
				color:{$dark_color};
			}

			.sideToggler {
				background-color:{$color};
			}

			.light span.commentCount a:hover {
				color:{$dark_color};
			}

			span.enhanced.colored {
				color:{$color};
			}

			span.enhanced.ring {
				background-color:{$color};
			}

			.articleBody ul li:before, .articleBody ol ul li:before, .articleBody ul ol ul li:before {
				color:{$color};
			}

			h5.author {
				color:{$color};
			}

			h5.author a {
				color:{$color};
			}

			h5.author a:hover {
				color:{$dark_color};
			}

			a.btn, button.btn, p.form-submit #submit, .comment-navigation a, a.comment-reply-link {
				color:{$color};
				border: 1px solid {$color};
			}

			a.btn:hover, button.btn:hover, p.form-submit #submit:hover, .comment-navigation a:hover, a.comment-reply-link:hover {
				background-color:{$color};
			}

			.neighbor a:hover strong {
				color:{$color};
			}

			.articleBody h3.accTitle {
				color:{$color};
			}

			.articleBody h3.accTitle.on {
				background-color:{$color};
			}

			.classic.grid header h1 a:hover, .classic.grid header h2 a:hover {
				color:{$color};
			}

			.classic.tile header p.meta a {
				color:{$color};
			}

			.classic.tile header p.meta a:hover {
				color:{$dark_color};
			}

			.classic.tile.twitter p.loud:before {
				color:{$color};
			}

			.classic.tile.noMedia header h1 a, .classic.tile.noMedia header h2 a {
				color:{$color};
			}

			.classic.tile.noMedia header h1 a:hover, .classic.tile.noMedia header h2 a:hover {
				color:{$dark_color};
			}

			.toolsToggler.on {
				color:{$color};
			}

			.sticky header p.meta:before {
				color:{$color};
			}

			ul.pagination li a {
				color:{$color};
			}

			ul.pagination li a:hover, ul.pagination li a.active {
				background-color:{$color};
			}

			span.btHighlight {
				background-color:{$color};
			}

			li.cat-item {
				color:{$color};
			}

			li.cat-item a {
				color:{$color};
			}

			li.cat-item a:hover {
				color:{$dark_color};
			}

			.fancy-select ul.options li {
				background-color:{$color};
			}

			.fancy-select ul.options li:hover {
				background-color:{$dark_color};
			}

			table#wp-calendar caption {
				background-color:{$color};
			}

			.aaTxt h4 a:hover {
				color:{$dark_color};
			}

			.widget_rss ul li a.rsswidget {
				color:{$color};
			}

			#recentcomments li.recentcomments a:hover {
				color:{$color};
			}

			ul.comments .commentTxt p.edit-link a {
				color:{$color};
				border: 1px solid {$color};
			}

			ul.comments .commentTxt p.edit-link a:hover {
				background-color:{$color};
			}

			p.logged-in-as a {
				color:{$color};
			}

			p.logged-in-as a:hover {
				color:{$dark_color};
			}

			.comment-reply-title #cancel-comment-reply-link:hover {
				color:{$dark_color};
			}

			.articleBody table caption {
				background-color:{$color};
			}

			.btLinkPages a:hover {
				color:{$dark_color};
			}
			
			.classic.grid blockquote.link a, .classic.tile blockquote.link a {
				color:{$color};
			}

			.classic.grid blockquote.link a:hover, .classic.tile blockquote.link a:hover {
				color:{$color};
			}

			.classic.grid blockquote.link:before, .classic.grid blockquote.link:before {
				color:{$color};
			}
			
			.classic .mediaBox.image:hover:after, .classic.grid:hover:after {
				box-shadow: 0 0 0 11px {$color} inset;
			}
			
			.classic header .bt_grid_share a:hover {
				color:{$color};
			}			
			
			.toolsToggler {
				color:{$color};
			}

			.socNtools ul li.search a:before {
				color:{$color};
			}
			
			.socNtools ul li a {
				color:{$color};
			}			

			.btLinkPages a:hover {
				color:{$color};
			}

			#imageHolder:after {
				color:{$color};
			}

			#imageHolder:before {
				color:{$color};
			}

			input[type='text']:focus, input[type='email']:focus, textarea:focus, input[type='url']:focus {
				box-shadow: 0 0 3px {$color};
			}

			html[data-useragent*='Firefox'] input:invalid:focus {
				box-shadow: 0 0 3px {$color};
			}			
			
			@media all and (min-width: 0px) and (max-width: 1025px) {
				.mainNav ul li a, .mainNav ul li a:hover, .mainNav ul li:hover a {
					color:{$color} !important;
				}
			}";
		}
		
		if ( $body_font != 'no_change' ) {
			$custom_css .= "
			body { 
				font-family:\"{$body_font}\", arial, tahoma;
			}

			.mainNav ul ul li { 
				font-family:\"{$body_font}\", arial, tahoma;
			}

			.btBox .recentTweets li a { 
				font-family:\"{$body_font}\", arial, tahoma;
			}

			a.btn, button.btn, p.form-submit #submit, .comment-navigation a, a.comment-reply-link { 
				font-family:\"{$body_font}\", arial, tahoma;
			}

			.aaTxt h4 { 
				font-family:\"{$body_font}\", arial, sans-serif;
			}

			ul.comments .commentTxt p.edit-link a { 
				font-family:\"{$body_font}\", arial, tahoma;
			}";
		}
		
		if ( $heading_font != 'no_change' ) {
			$custom_css .= "
			header h1, header h2 { 
				font-family:\"{$heading_font}\", arial, sans-serif;
			}

			.articleBody h1, .articleBody h2, .articleBody h3, .articleBody h4, .articleBody h5, .articleBody h6 { 
				font-family:\"{$heading_font}\", arial, sans-serif;
			}

			.ssPort input[type=\"text\"] { 
				font-family:\"{$heading_font}\", arial, sans-serif;
			}

			.tsBlock .title { 
				font-family:\"{$heading_font}\", arial, sans-serif;
			}

			.classic header h3.errorCode { 
				font-family:\"{$heading_font}\", arial, sans-serif;
			}

			.btBox h4 { 
				font-family:\"{$heading_font}\", arial, sans-serif;
			}

			.catList li { 
				font-family:\"{$heading_font}\", arial, sans-serif;
			}

			.popularPosts ul li .ppTxt h5, .widget_recent_entries ul li a, #recentcomments li.recentcomments a, .widget_archive ul li, .widget_categories ul li a, .widget_pages ul li a, .widget_meta ul li a, .widget_nav_menu ul li a, .widget_rss ul li a.rsswidget { 
				font-family:\"{$heading_font}\", arial, sans-serif;
			}

			.latestComments li h5 { 
				font-family:\"{$heading_font}\", arial, sans-serif;
			}

			.post footer .tagsCloud li a { 
				font-family:\"{$heading_font}\", arial, sans-serif;
			}

			.neighbor a strong { 
				font-family:\"{$heading_font}\", arial, sans-serif;
			}

			li.cat-item { 
				font-family:\"{$heading_font}\", arial, sans-serif;
			}

			.articleBody address { 
				font-family:\"{$heading_font}\", arial, sans-serif;
			}";
		}		

		if ( $color != '' || $body_font != 'no_change' || $heading_font != 'no_change' ) {
			wp_add_inline_style( 'bt_main_css', $custom_css );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'bt_inline_style' );

if ( ! function_exists( 'bt_load_fonts' ) ) {
	function bt_load_fonts() {
		$body_font = bt_get_option( 'body_font' );
		$heading_font = bt_get_option( 'heading_font' );
		$fonts = $body_font . ':100,200,300,400,500,600,700,800,900,100italic,200italic,300italic,400italic,500italic,600italic,700italic,800italic,900italic' . '|' . $heading_font . ':100,200,300,400,500,600,700,800,900,100italic,200italic,300italic,400italic,500italic,600italic,700italic,800italic,900italic';
		if ( $body_font == '' ) {
			$fonts = $heading_font . ':100,200,300,400,500,600,700,800,900,100italic,200italic,300italic,400italic,500italic,600italic,700italic,800italic,900italic';
		} else if ( $heading_font == '' ) {
			$fonts = $body_font . ':100,200,300,400,500,600,700,800,900,100italic,200italic,300italic,400italic,500italic,600italic,700italic,800italic,900italic';
		}
		if ( $body_font != 'no_change' || $heading_font != 'no_change' ) {
			wp_register_style( 'bt_fonts', 'http://fonts.googleapis.com/css?family=' . $fonts );
			wp_enqueue_style( 'bt_fonts' );
		}
	}
}
add_action( 'wp_print_styles', 'bt_load_fonts' );

if ( ! function_exists( 'bt_rwmb_meta' ) ) {
	function bt_rwmb_meta( $key, $args = array(), $post_id = null ) {
		if ( function_exists( 'rwmb_meta' ) ) {
			return rwmb_meta( $key, $args, $post_id );
		} else {
			return null;
		}
	}
}