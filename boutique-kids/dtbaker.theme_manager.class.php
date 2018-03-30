<?php


if ( ! defined( 'ABSPATH' ) ) exit;

class boutiqueThemeManager {

	/**
	 * Holds the current instance of the theme manager
	 *
	 * @var boutiqueThemeManager
	 */
	private static $instance = null;

	/**
	 * @return boutiqueThemeManager
	 */
	public static function get_instance() {
		if ( ! self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 *
	 * Theme settings from the theme.json file.
	 *
	 * @var array
	 */
	public $theme_settings = array();

	/*
	 * This is the magic that sets up all the hooks and filters for the theme.
	 */
	/**
	 *
	 */
	public function start() {


		$theme_actions = array(
			'init'                     => array(
				'method' => 'init',
			),
			'after_setup_theme'        => array(
				'method' => 'after_setup_theme',
			),
			'admin_enqueue_scripts'    => array(
				'method'   => 'admin_enqueue_scripts',
				'priority' => 30,
			),
			'wp_enqueue_scripts'       => array(
				'method'   => 'wp_enqueue_scripts',
				'priority' => 30,
			),
			'boutique_page_header_before' => array(
				'method' => 'boutique_page_header_before',
			),
			'boutique_page_header_after'  => array(
				'method' => 'boutique_page_header_after',
			),
			/*'wp_footer'                => array(
				'method' => 'boutique_rtl_bracket_js_hack',
			),*/
			'tgmpa_register'           => array(
				'method' => 'tgmpa_register',
			),
			'in_widget_form'           => array(
				'method' => 'in_widget_form',
			),
			'widget_update_callback'   => array(
				'method'   => 'widget_update_callback',
				'priority' => 11,
				'args'     => 2,
			),
			'load-widgets.php'         => array(
				'method' => 'widget_color_picker',
			),
			'edit_form_after_title'         => array(
				'method' => 'edit_form_after_title',
			),
		);

		$theme_filters = array(
			'image_size_names_choose' => array(
				'method'   => 'image_size_names_choose',
				'priority' => 11,
			),
			'widget_title'            => array(
				'method'   => 'widget_title',
				'priority' => 5,
				'args'     => 3,
			),
			'excerpt_length'          => array(
				'method' => 'excerpt_length',
			),
			'excerpt_more'          => array(
				'method' => 'excerpt_more',
			),
			'wp_page_menu_args'       => array(
				'method' => 'wp_page_menu_args',
			),
			'body_class'              => array(
				'method' => 'body_class',
			),
			'tiny_mce_before_init'    => array(
				'method' => 'tiny_mce_before_init',
			),
			'wp_list_categories'      => array(
				'method' => 'wp_list_categories',
				'args'   => 2,
			),
			'get_archives_link'      => array(
				'method' => 'get_archives_link',
				'args'   => 6,
			),
			'wp_tag_cloud'            => array(
				'method' => 'wp_tag_cloud',
			),
			'wp_nav_menu_items'       => array(
				'method' => 'wp_nav_menu_items',
			),
		);

		foreach ( apply_filters( 'boutique_theme_actions', $theme_actions ) as $action_key => $action_args ) {
			add_action( $action_key, array(
				$this,
				$action_args['method']
			), empty( $action_args['priority'] ) ? 10 : $action_args['priority'], empty( $action_args['args'] ) ? 1 : $action_args['args'] );
		}
		foreach ( apply_filters( 'boutique_theme_filters', $theme_filters ) as $filter_key => $filter_args ) {
			add_filter( $filter_key, array(
				$this,
				$filter_args['method']
			), empty( $filter_args['priority'] ) ? 10 : $filter_args['priority'], empty( $filter_args['args'] ) ? 1 : $filter_args['args'] );
		}

		$this->backwards_compatibility();

		$this->include_theme_files();
	}

	public function init() {

		$this->get_theme_settings();

	}

	public function edit_form_after_title($post){
		if(!$post || $post->ID != get_option('page_for_posts'))
			return;
		remove_action('edit_form_after_title', '_wp_posts_page_notice');
		add_post_type_support('page', 'editor');
	}

	public function get_theme_setting($key,$default=false){
		if(isset($this->theme_settings[$key])){
			return $this->theme_settings[$key];
		}
		return $default;
	}

	public function get_theme_settings() {
		if ( $this->theme_settings ) {
			return $this->theme_settings;
		}
		require_once( ABSPATH . 'wp-admin/includes/file.php' );
		WP_Filesystem();
		global $wp_filesystem;
		$this->theme_settings = json_decode( $wp_filesystem->get_contents( trailingslashit( get_template_directory() ) . 'theme.json' ), true );
		if ( ! is_array( $this->theme_settings ) ) {
			$this->theme_settings = array();
		}

		return $this->theme_settings;
	}

	public function after_setup_theme() {

		$this->add_editor_styles();
		$this->setup_translations();
		$this->add_theme_support();
		$this->setup_background();
		$this->setup_menu();
		$this->setup_images();

	}

	public function add_editor_styles() {
		add_editor_style( apply_filters( 'boutique_editor_styles', array(
			'style.content.css',
			'style.custom.css',
			'style.editor.css',
			'style.plugins.css',
			'style.color.css',
		) ) );
	}

	/*
	 * Make boutique available for translation.
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on boutique, use a find and replace
	 * to change 'boutique' to the name of your theme in all the template files.
	 */
	public function setup_translations() {
		load_theme_textdomain( 'boutique-kids', get_template_directory() . '/languages' );

		$locale      = get_locale();
		$locale_file = get_template_directory() . "/languages/$locale.php";
		if ( is_readable( $locale_file ) ) {
			require_once( $locale_file );
		}
	}

	public function add_theme_support() {
		// Add default posts and comments RSS feed links to <head>.
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'breadcrumb-trail' );
		add_theme_support( 'site-logo' );
		// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
		add_theme_support( 'post-thumbnails' );
	}

	public function setup_background() {

		// Add support for custom backgrounds
		// add_custom_background('dtbaker_set_custom_background_defaults');
		$args = array(
			'default-color' => 'FFFFFF',
			'default-image' => get_template_directory_uri() . '/images/bg-paper-tile.jpg',
		);
		add_theme_support( 'custom-background', $args );
	}

	public function setup_menu() {
		// This theme uses wp_nav_menu() in one location.
		register_nav_menu( 'primary', esc_html__( 'Primary Menu', 'boutique-kids' ) );
	}

	public function setup_images() {
		// post-thumbnail
		set_post_thumbnail_size( 224, 144, true ); // same in dtbaker.woocommerce.php
		// Add boutique's custom image sizes
		add_image_size( 'boutique_blog-large', 970 );  // for fancy posts
		add_image_size( 'boutique_gallery', 500, 333, true );
	}

	public function admin_enqueue_scripts() {
		wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/fonts/font-awesome.min.css', array(), _boutique_theme_version );
		wp_enqueue_style( 'boutique_admin', get_template_directory_uri() . '/style.admin.css', array(), _boutique_theme_version );
	}

	public function wp_enqueue_scripts() {
		/* Main Javascript File */
		wp_register_script( 'boutique_javascript', get_template_directory_uri() . '/js/javascript.js', array(
			'jquery',
			'jquery-ui-core',
		), _boutique_theme_version, true );
		wp_localize_script( 'boutique_javascript', 'boutique_params', array(
			'view_site_text' => esc_html__( 'View Full Site', 'boutique-kids' ),
		) );
		wp_enqueue_script( 'boutique_javascript' ); // registered and localized above.

		/* ENQUEUE ALL THE SCRIPTS AND STYLES */
		if ( is_singular() ) {
			wp_enqueue_script( 'comment-reply' ); // core comment css styles
		}

		if ( ! wp_script_is( 'prettyPhoto', 'registered' ) ) {
			wp_enqueue_script( 'prettyPhoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.min.js', array(), _boutique_theme_version, true );
			wp_enqueue_script( 'prettyPhoto-init', get_template_directory_uri() . '/js/jquery.prettyPhoto.init.min.js', array( 'prettyPhoto' ), _boutique_theme_version , true );
			//wp_enqueue_style( 'prettyPhoto_css', get_template_directory_uri() . '/style.prettyPhoto.css', array(), _boutique_theme_version );
		}
		wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/fonts/font-awesome.min.css', array(), _boutique_theme_version );

		wp_enqueue_script( 'slick_slider', get_template_directory_uri() . '/slick/slick.min.js', array( 'jquery' ), '1.5.9', true );
		wp_enqueue_style( 'slick_slider', get_template_directory_uri() . '/slick/slick.css', false, '1.5.9' );
		wp_enqueue_style( 'slick_slider_theme', get_template_directory_uri() . '/slick/slick-theme.css', false, '1.5.9' );

		$theme_settings = $this->get_theme_settings();
		if ( ! empty( $theme_settings['minify-stylesheets'] ) && apply_filters( 'boutique_minify_styles', true ) ) {
			wp_enqueue_style( 'boutique_style', get_template_directory_uri() . '/style.min.css', array(), _boutique_theme_version );
		} else {
			// individual styles.
			if ( ! empty( $theme_settings['stylesheets'] ) ) {
				foreach ( $theme_settings['stylesheets'] as $stylesheet ) {
					$stylesheet_id = 'boutique_' . str_replace( '.', '_', str_replace( '.css', '', $stylesheet ) );
					wp_enqueue_style( $stylesheet_id, get_template_directory_uri() . '/' . $stylesheet, array(), _boutique_theme_version );
				}
			}
		}

		// time to enqueue our custom stylesheet
		// we fall back to printing this out in 'head' if our file write permissions are not available.
		$dynamic_file      = 'style.custom.css';
		$dynamic_file_path = get_template_directory() . '/' . $dynamic_file;
		require_once( ABSPATH . 'wp-admin/includes/file.php' );
		WP_Filesystem();
		global $wp_filesystem;
		$css_data = '';
		if ( file_exists( $dynamic_file_path ) ) {
			$css_data = $wp_filesystem->get_contents( $dynamic_file_path );
		}
		global $wp_customize;
		if ( ( isset( $wp_customize ) && $wp_customize && $wp_customize->is_preview() ) || strlen( $css_data ) < 100 ) {
			add_action( 'wp_head', array( $this, 'default_css_output' ) );
		} else {
			// otherwise we load up our custom stylesheet like normal
			wp_enqueue_style( 'boutique_dynamic', get_template_directory_uri() . '/' . $dynamic_file, array(), get_option( 'boutique_dynamic_css_version', 1 ) );
		}
	}

	public function default_css_output() {
		boutique_default_css_output( true );
	}

	public function backwards_compatibility() {
		if ( ! function_exists( '_wp_render_title_tag' ) ) {
			add_action( 'wp_head', array( $this, 'backwards_compatibility_title' ) );
		}
	}

	public function include_theme_files() {


		$theme_files = array(
			'dtbaker.functions.php',
			'dtbaker.theme_options.php',
			'dtbaker.theme_customizer.php',
			'dtbaker.widgets.php',
			'dtbaker.gallery.php',
			'style.fonts.php',
			'dtbaker.woocommerce.php',
			'dtbaker.metabox_post.php',
			'dtbaker.elementor.php',
		);


		if (version_compare(PHP_VERSION, '5.3.0', '<')) {
			function boutique_php_version_notice() {
				?>
				<div class="notice notice-error">
					<p><?php esc_html_e( 'Please ensure your PHP version is 5.3 or above. Please contact the hosting provider for assistance.', 'boutique-kids' ); ?></p>
				</div>
				<?php
			}
			add_action( 'admin_notices', 'boutique_php_version_notice' );
		}else{


			$theme_files[] = 'plugins/envato_setup/envato_setup.php';
			$theme_files[] = 'class-tgm-plugin-activation.php';
		}


		foreach ( apply_filters( 'boutique_theme_files', $theme_files ) as $theme_file ) {
			$template_file = locate_template($theme_file);
			if ( $template_file && is_readable( $template_file ) ) {
				require_once $template_file;
			}
		}

	}

	public function backwards_compatibility_title() {
		?>
		<title><?php wp_title(); ?></title>
		<?php
	}

	/**
	 * We run this filter on the first two times it is called during page load.
	 * We don't want to run it on the 3rd time because that is the insert image template which already has image sizes.
	 *
	 * @param $sizes
	 *
	 * @return array
	 */
	private static $_image_size_name_chooser_count = 0;

	public function image_size_names_choose( $sizes ) {
		//if(self::$_image_size_name_chooser_count++ == 2)return $sizes;
		global $_wp_additional_image_sizes;
		// print_r($sizes); print_r($_wp_additional_image_sizes);exit;
		if( isset( $_wp_additional_image_sizes ) && is_array( $_wp_additional_image_sizes ) ) {
			foreach ( $_wp_additional_image_sizes as $size => $settings ) {
				if ( ! isset( $sizes[ $size ] ) ) {// } && strpos($size,'shop') === false){
					$sizes[ $size ] = $size . ( 2 === self::$_image_size_name_chooser_count ? ' (' . $settings['width'] . 'x' . $settings['height'] . ')' : '' );
				}
			}
		}
		self::$_image_size_name_chooser_count ++;

		return $sizes;
	}

	/**
	 *
	 * Remove the calendar widget title if it's empty
	 *
	 * @param string $title
	 * @param string $instance
	 * @param string $id_base
	 *
	 * @return string
	 */
	public function widget_title( $title = '', $instance = '', $id_base = '' ) {
		if ( 'calendar' === $id_base && '&nbsp;' === $title ) {
			$title = '';
		}

		return $title;
	}

	/**
	 * Sets the post excerpt length
	 *
	 * To override this length in a child theme, remove the filter and add your own
	 * function tied to the excerpt_length filter hook.
	 */
	public function excerpt_length() {
		return 48;
	}

	/**
	 * Sets the post excerpt more string
	 *
	 */
	public function excerpt_more() {
		return '[…]';
	}

	/**
	 * @param $args array
	 *
	 * @return array
	 */
	public function wp_page_menu_args( $args ) {
		$args['show_home'] = true;

		return $args;
	}


	public function boutique_get_header_style() {
		return array(
			'background_color' => get_theme_mod( 'color_background_fancy_header', 'FFFFFF' ),
			'page_header_mode' => get_theme_mod( 'page_header_mode', '1' ),
		);
	}

	public function boutique_page_header_before() {
		if ( $style = $this->boutique_get_header_style() ) {
			if ( $style['page_header_mode'] == 2 ) {
				// echo '<div class="boutique_page_header page_header_fancy" style="background-color:#'.$style['background_color'].'">';
			} else {
				echo '<div class="boutique_page_header">';
			}
		}
	}

	public function boutique_page_header_after() {
		if ( $style = $this->boutique_get_header_style() ) {
			echo '<br class="clear"/>';
			if ( $style['page_header_mode'] == 2 ) {
				// echo '</div>';
			} else {
				echo '</div>';
			}
		}
	}

	public $default_color = 'pink';

	public function body_class( $classes ) {
		if ( get_theme_mod( 'boutique_site_color', $this->default_color ) ) {
			$classes[] = 'boutique_color_' . get_theme_mod( 'boutique_site_color', $this->default_color );
		}
		if ( get_theme_mod( 'responsive_enabled', 1 ) ) {
			$classes[] = 'responsive_enabled';
		}
		if ( get_theme_mod( 'header_overlay', 'enabled' ) == 'enabled' ) {
			$classes[] = 'boutique_header_overlay';
		}
		if ( get_theme_mod( 'menu_overlay', 'enabled' ) == 'enabled' ) {
			$classes[] = 'boutique_menu_overlay';
		}
		if ( get_theme_mod( 'footer_overlay', 'enabled' ) == 'enabled' ) {
			$classes[] = 'boutique_footer_overlay';
		}
		if ( $style = $this->boutique_get_header_style() ) {
			$classes[] = 'boutique_header-' . $style['page_header_mode'];
		} else {

		}

		if ( ! is_multi_author() ) {
			$classes[] = 'single-author';
		}

		if ( is_singular() && ! is_home() && ! is_page_template( 'showcase.php' ) && ! is_page_template( 'sidebar-page.php' ) ) {
			$classes[] = 'singular';
		}

		// return the $classes array
		return $classes;
	}


	public function tiny_mce_before_init( $init_array ) {
		if ( get_theme_mod( 'boutique_site_color', $this->default_color ) ) {
			$init_array['body_class'] = 'boutique_color_' . get_theme_mod( 'boutique_site_color', $this->default_color );
		}

		return $init_array;
	}

	public function wp_list_categories( $cats, $args ) {
		return preg_replace( '#</a>\s*\(([^\)]*)\)#', ' <span class="number">$1</span></a>', $cats );
	}
	public function get_archives_link( $link_html, $url, $text, $format, $before, $after ) {
		$text = wptexturize($text);
		$url = esc_url($url);

		if ('link' == $format){
			$after = preg_replace( '#\s*\(([^\)]*)\)#', ' <span class="number">$1</span>', $after );
			$link_html = "\t<link rel='archives' title='" . esc_attr( $text ) . "' href='$url' />\n";
		} elseif ('option' == $format)
			$link_html = "\t<option value='$url'>$before $text $after</option>\n";
		elseif ('html' == $format){
			$after = preg_replace( '#\s*\(([^\)]*)\)#', ' <span class="number">$1</span>', $after );
			$link_html = "\t<li>$before<a href='$url'>$text</a>$after</li>\n";
		} else // custom
			$link_html = "\t$before<a href='$url'>$text</a>$after\n";

		return $link_html;
	}


	public function boutique_rtl_bracket_js_hack() {
		?>
		<script type="text/javascript">
			(function ($) {
				$('p:contains(")")').each(function () {
					$(this).html($(this).html().replace(/\)(\s*)$/, ')&#x200E;\1').replace(/^(\s*)\(/, '\1&#x200E;('));
				});
			})(jQuery);
		</script>
		<?php
	}

	public function wp_tag_cloud( $return ) {
		return preg_replace( '#(<a[^>]+\')(\d+)( topics?\'[^>]*>)([^<]*)<#imsU', '$1$2$3$4 ($2)<', $return );
	}

	public function wp_nav_menu_items( $items ) {
		// work out which of these items have icons. using regex. yay!
		// then add our icons in. based on the settings (todo: from plugin)
		if ( preg_match_all( '#<li id="menu-item-(\d+)"[^>]*>(.*)</li>#imsU', $items, $matches ) ) {
			// for now we just add our icon as a background image to the <a> link.
			foreach ( $matches[0] as $match_id => $full_li_match ) {
				$link_id = $matches[1][ $match_id ];
				if ( (int) $link_id > 0 ) {
					// check if this one has an icon
					$new_a_link = $matches[2][ $match_id ];
					$new_a_link = preg_replace( '#<a href="[^"]*"[^>]*>#imsU', '<span class="menu-dropdown-toggle"></span>$0', $new_a_link, 1 );
					// todo: make sure we don't double up on existing classes and inline styles.
					$new_full_li_match = str_replace( $matches[2][ $match_id ], $new_a_link, $full_li_match );
					$items             = preg_replace( '#' . preg_quote( $full_li_match, '#' ) . '#', $new_full_li_match, $items );
				}
			}
		}

		return $items;
	}

	public function tgmpa_register() {

		$theme_settings = $this->get_theme_settings();
		// we load our required plugins from the theme settings array.
		$tgmpa_plugins = array();
		$plugin_config = array();
		if ( ! empty( $theme_settings['plugins'] ) && is_array( $theme_settings['plugins'] ) ) {
			foreach ( $theme_settings['plugins'] as $plugin_slug => $plugin_details ) {
				if ( ! empty( $plugin_details['local'] ) && ! empty( $plugin_details['source'] ) ) {
					// This is a locally build plugin in the /plugins/ folder.
					if ( is_readable( get_template_directory() . '/plugins/' . $plugin_details['source'] ) ) {
						$tgmpa_plugins[ $plugin_slug ] = array(
							'name'             => $plugin_details['name'],
							'version'          => $plugin_details['version'],
							'slug'             => $plugin_slug,
							'source'           => get_template_directory() . '/plugins/' . $plugin_details['source'],
							'required'         => ! empty( $plugin_details['required'] ),
							'recommended'      => ! empty( $plugin_details['required'] ),
							'force_activation' => ! empty( $plugin_details['required'] ),
						);
					}
				} else if ( ! empty( $plugin_details['wordpress'] ) ) {
					// This is a standard WordPress plugin.
					$tgmpa_plugins[ $plugin_slug ] = array(
						'name'             => $plugin_details['name'],
						'slug'             => $plugin_slug,
						'required'         => ! empty( $plugin_details['required'] ),
						'recommended'      => ! empty( $plugin_details['required'] ),
						'force_activation' => ! empty( $plugin_details['required'] ),
					);
				} else if ( ! empty( $plugin_details['source'] ) ) {
					// This is a 3rd party manually installed plugin (e.g. Envato Market)
					$tgmpa_plugins[ $plugin_slug ] = array(
						'name'             => $plugin_details['name'],
						'source'           => $plugin_details['source'],
						'slug'             => $plugin_slug,
						'required'         => ! empty( $plugin_details['required'] ),
						'recommended'      => ! empty( $plugin_details['required'] ),
						'force_activation' => ! empty( $plugin_details['required'] ),
					);
				}
				if ( ! empty( $plugin_details['config'] ) ) {
					// localize these out so the plugin can access them.
					$plugin_config[ $plugin_slug ] = $plugin_details['config'];
				}
			}
		}
		if ( ! empty( $plugin_config ) ) {
			$plugin_config = apply_filters( 'boutique_plugin_config', $plugin_config );
			wp_localize_script( 'jquery', 'boutique_plugin_config', $plugin_config );
		}

		$tgmpa_plugins = apply_filters( 'boutique_tgmpa_plugins', $tgmpa_plugins );

		tgmpa( $tgmpa_plugins, array() );
	}


	/**
	 * Adds the color picker to the widget page so we can select widget title/background colors
	 */
	public function widget_color_picker() {
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );
	}

	/**
	 *
	 * Handles saving our custom widget options, as defined in theme.json
	 *
	 * @param $instance
	 * @param $new_instance
	 *
	 * @return mixed
	 */
	public function widget_update_callback( $instance, $new_instance ) {
		$theme_settings = $this->get_theme_settings();
		if ( ! empty( $theme_settings['widget-settings'] ) ) {
			foreach ( $theme_settings['widget-settings'] as $setting ) {
				if ( ! empty( $setting['id'] ) && isset( $new_instance[ 'boutique_' . $setting['id'] ] ) ) {
					$instance[ 'boutique_' . $setting['id'] ] = $new_instance[ 'boutique_' . $setting['id'] ];
				}
			}
		}

		return $instance;
	}

	/**
	 *
	 * Applies our custom widget settings from the theme.json file
	 * Supports color picker and background select box class.
	 *
	 * @param $widget_instance
	 */
	public function in_widget_form( $widget_instance ) {
		$theme_settings = $this->get_theme_settings();
		$settings       = $widget_instance->get_settings();
		$settings       = isset( $widget_instance->number ) && isset( $settings[ $widget_instance->number ] ) ? $settings[ $widget_instance->number ] : array();
		if ( ! empty( $theme_settings['widget-settings'] ) ) {
			foreach ( $theme_settings['widget-settings'] as $setting ) {
				if ( ! empty( $setting['id'] ) && ! empty( $setting['type'] ) ) {
					switch ( $setting['type'] ) {
						case 'select':
							?>
							<div class="boutique_widget_setting">
							<label
								for="<?php echo esc_attr( $widget_instance->get_field_id( 'boutique_' . $setting['id'] ) ); ?>"><?php echo esc_html( $setting['title'] ); ?>:</label>
							<select
								name="<?php echo esc_attr( $widget_instance->get_field_name( 'boutique_' . $setting['id'] ) ); ?>"
								id="<?php echo esc_attr( $widget_instance->get_field_id( 'boutique_' . $setting['id'] ) ); ?>"
								class="boutique_widget_style_select">
								<?php
								foreach ( $setting['options'] as $key => $val ) { ?>
									<option
										value="<?php echo esc_attr( $key ); ?>" <?php echo ( isset( $settings[ 'boutique_' . $setting['id'] ] ) && $settings[ 'boutique_' . $setting['id'] ] == $key ) ? 'selected' : ''; ?>><?php echo esc_html( $val ); ?></option>
								<?php } ?>
							</select>
							</div>
							<?php
							break;
						case 'color':
							?>
							<div class="boutique_widget_setting">
							<script type='text/javascript'>
								var color_done = color_done || {};
								color_done['<?php echo esc_js($widget_instance->get_field_id( 'boutique_' . $setting['id'] ));?>'] = false;
								jQuery(document).ready(function ($) {
									$('.widget-liquid-right #<?php echo esc_js($widget_instance->get_field_id( 'boutique_' . $setting['id'] ));?>').wpColorPicker();

								});
							</script>
							<label
								for="<?php echo $widget_instance->get_field_id( 'boutique_' . $setting['id'] ); ?>"><?php echo esc_html( $setting['title'] ); ?>:</label>
							<input class="boutique_color_picker" type="text"
							       id="<?php echo $widget_instance->get_field_id( 'boutique_' . $setting['id'] ); ?>"
							       name="<?php echo $widget_instance->get_field_name( 'boutique_' . $setting['id'] ); ?>"
							       placeholder="<?php esc_attr_e( ' (Press Save)', 'boutique-kids' );?>"
							       value="<?php echo esc_attr( ! empty( $settings[ 'boutique_' . $setting['id'] ] ) ? $settings[ 'boutique_' . $setting['id'] ] : '' ); ?>"/>
							</div>
							<?php
							break;
					}
				}
			}
		}
		?>

		<?php
	}

}

