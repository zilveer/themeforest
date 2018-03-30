<?php
/**
 * Filters for BuildPress WP theme
 *
 * @package BuildPress
 */



/**
 * Create a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
if ( ! function_exists( 'buildpress_wp_title' ) && ! function_exists( '_wp_render_title_tag' ) ) {
	function buildpress_wp_title( $title, $sep ) {
		global $paged, $page;

		if ( is_feed() ) {
			return $title;
		}

		// Add the site name.
		$title .= get_bloginfo( 'name' );

		// Add the site description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title = "$title $sep $site_description";
		}

		// Add a page number if necessary.
		if ( $paged >= 2 || $page >= 2 ) {
			$title = "$title $sep " . sprintf( __( 'Page %s', 'buildpress_wp'), max( $paged, $page ) );
		}

		return $title;
	}
	add_filter( 'wp_title', 'buildpress_wp_title', 10, 2 );
}



/**
 * Add shortcodes in widgets
 */
add_filter( 'widget_text', 'do_shortcode' );



if ( ! function_exists( 'add_disabled_editor_buttons' ) ) {
	function add_disabled_editor_buttons($buttons) {
		/**
		 * Add a core button that's disabled by default
		 */
		$buttons[] = 'hr';

		return $buttons;
	}
	add_filter('mce_buttons', 'add_disabled_editor_buttons');
}



/**
 * Skype protocol
 */
add_filter( 'kses_allowed_protocols', 'buildpress_kses_allowed_protocols' );
function buildpress_kses_allowed_protocols( $protocols ) {
	return array_merge( $protocols, array( 'skype' ) );
}



/**
 * Custom tag font size
 */
if ( ! function_exists( 'set_tag_cloud_sizes' ) ) {
	function set_tag_cloud_sizes($args) {
		$args['smallest'] = 8;
		$args['largest']  = 12;
		return $args;
	}
	add_filter( 'widget_tag_cloud_args', 'set_tag_cloud_sizes' );
}



/**
 * Custom text after excerpt
 */
if ( ! function_exists( 'buildpress_excerpt_more' ) ) {
	function buildpress_excerpt_more( $more ) {
		return _x( ' &hellip;', 'custom read more text after the post excerpts' , 'buildpress_wp');
	}
	add_filter( 'excerpt_more', 'buildpress_excerpt_more' );
}



/**
 * Add Formats Dropdown Menu To TinyMCE
 */
if ( ! function_exists( 'buildpress_style_select' ) ) {
	function buildpress_style_select( $buttons ) {
		array_push( $buttons, 'styleselect' );
		return $buttons;
	}
}
add_filter( 'mce_buttons', 'buildpress_style_select' );



/**
 * Add new styles to the TinyMCE "formats" menu dropdown
 */
if ( ! function_exists( 'buildpress_styles_dropdown' ) ) {
	function buildpress_styles_dropdown( $settings ) {

		$items = array();
		for ($i=1; $i <= 6; $i++) {
			$items[] = array(
				'title'   => _x( 'Heading', 'backend', 'buildpress_wp' ) . " {$i}",
				'block'   => "h{$i}",
				'classes' => 'alternative-heading'
			);
		}

		// Create array of new styles
		$new_styles = array(
			array(
				'title' => _x( 'ProteusThemes', 'backend','buildpress_wp' ),
				'items' => $items
			),
		);

		// Merge old & new styles
		$settings['style_formats_merge'] = true;

		// Add new styles
		$settings['style_formats'] = json_encode( $new_styles );

		// Return New Settings
		return $settings;

	}
}
add_filter( 'tiny_mce_before_init', 'buildpress_styles_dropdown' );



/**
 * Filter the text in the footer
 */
foreach ( array( 'buildpress/footer_left_txt', 'buildpress/footer_right_txt' ) as $buildpress_filter ) {
	add_filter( $buildpress_filter, 'wptexturize' );
	add_filter( $buildpress_filter, 'convert_chars' );
	add_filter( $buildpress_filter, 'capital_P_dangit' );
}



/**
 * Return Google fonts and sizes
 *
 * @see https://github.com/grappler/wp-standard-handles/blob/master/functions.php
 * @return array Google fonts and sizes.
 */
if ( ! function_exists( 'buildpress_additional_fonts' ) ) {
	function buildpress_additional_fonts( $fonts ) {

		/* translators: If there are characters in your language that are not supported by Noto Serif, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Noto Serif font: on or off', 'buildpress_wp' ) ) {
			$fonts['Source Sans Pro'] = array(
				'400' => '400',
				'700' => '700',
			);
			$fonts['Montserrat'] = array(
				'700' => '700',
			);
		}

		return $fonts;
	}
	add_filter( 'pre_google_web_fonts', 'buildpress_additional_fonts' );
}



/**
 * Add subsets from customizer, if needed.
 *
 * @return array
 */
if ( ! function_exists( 'buildpress_subsets_google_web_fonts' ) ) {
	function buildpress_subsets_google_web_fonts( $subsets ) {
		$additional_subset = get_theme_mod( 'charset_setting', 'latin' );

		array_push( $subsets, $additional_subset );

		return $subsets;
	}
	add_filter( 'subsets_google_web_fonts', 'buildpress_subsets_google_web_fonts' );
}



/**
 * Backwards compatibility for title tags theme support in WordPress 4.1
 */
if ( ! function_exists( '_wp_render_title_tag' ) && ! function_exists( 'buildpress_render_title' ) ) {
	function buildpress_render_title() {
		?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
	}
	add_action( 'wp_head', 'buildpress_render_title' );
}


/**
 * Embedded videos and video container around them
 */
function buildpress_embed_oembed_html( $html ) {
		if (
				false !== strstr( $html, 'youtube.com' ) ||
				false !== strstr( $html, 'wordpress.tv' ) ||
				false !== strstr( $html, 'wordpress.com' ) ||
				false !== strstr( $html, 'vimeo.com' )
		) {
				$out = '<div class="embed-responsive  embed-responsive-16by9">' . $html . '</div>';
		} else {
				$out = $html;
		}
		return $out;
}
add_filter( 'embed_oembed_html', 'buildpress_embed_oembed_html', 10, 1 );


/**
 * Define demo import files for One Click Demo Import plugin.
 */
if ( ! function_exists( 'buildpress_ocdi_import_files' ) ) {
	function buildpress_ocdi_import_files() {
		return array(
			array(
				'import_file_name'           => 'BuildPress Classic',
				'import_file_url'            => 'http://artifacts.proteusthemes.com/xml-exports/buildpress-latest.xml',
				'import_widget_file_url'     => 'http://artifacts.proteusthemes.com/json-widgets/buildpress.json',
				'import_customizer_file_url' => 'http://artifacts.proteusthemes.com/customizer-exports/buildpress.dat',
				'import_preview_image_url'   => 'http://artifacts.proteusthemes.com/import-preview-images/buildpress.png',
			),
			array(
				'import_file_name'           => 'BuildPress Light',
				'import_file_url'            => 'http://artifacts.proteusthemes.com/xml-exports/buildpress-light-latest.xml',
				'import_widget_file_url'     => 'http://artifacts.proteusthemes.com/json-widgets/buildpress-light.json',
				'import_customizer_file_url' => 'http://artifacts.proteusthemes.com/customizer-exports/buildpress-light.dat',
				'import_preview_image_url'   => 'http://artifacts.proteusthemes.com/import-preview-images/buildpress-light.png',
			),
		);
	}
	add_filter( 'pt-ocdi/import_files', 'buildpress_ocdi_import_files' );
}


/**
 * After import theme setup for One Click Demo Import plugin.
 */
if ( ! function_exists( 'buildpress_ocdi_after_import_setup' ) ) {
	function buildpress_ocdi_after_import_setup() {

		// Menus to Import and assign - you can remove or add as many as you want.
		$top_menu  = get_term_by('name', 'Top Menu', 'nav_menu');
		$main_menu = get_term_by('name', 'Main Menu', 'nav_menu');

		set_theme_mod( 'nav_menu_locations', array(
				'top-bar-menu' => $top_menu->term_id,
				'main-menu'    => $main_menu->term_id,
			)
		);

		// Set options for front page and blog page.
		$front_page_id = get_page_by_title( 'Front Page' )->ID;
		$blog_page_id  = get_page_by_title( 'Blog' )->ID;

		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page_id );
		update_option( 'page_for_posts', $blog_page_id );

		// Set options for Breadcrumbs NavXT.
		$breadcrumbs_settings = array( 'hseparator' => '' );
		$shop_page = get_page_by_title( 'Shop' );
		if ( ! is_null( $shop_page ) ) {
			$breadcrumbs_settings['apost_product_root'] = $shop_page->ID;
		}
		$project_page = get_page_by_title( 'Projects' );
		if ( ! is_null( $project_page ) ) {
			$breadcrumbs_settings['apost_portfolio_root'] = $project_page->ID;
		}
		add_option( 'bcn_options', $breadcrumbs_settings );

		_e( 'After import setup ended!', 'buildpress_wp' );
	}
	add_action( 'pt-ocdi/after_import', 'buildpress_ocdi_after_import_setup' );
}


/**
 * Message for manual demo import for One Click Demo Import plugin.
 */
if ( ! function_exists( 'buildpress_ocdi_message_after_file_fetching_error' ) ) {
	function buildpress_ocdi_message_after_file_fetching_error() {
		return sprintf( __( 'Please try to manually import the demo data. Here are instructions on how to do that: %sDocumentation: Import XML File%s', 'buildpress_wp' ), '<a href="https://www.proteusthemes.com/docs/buildpress/#import-xml-file" target="_blank">', '</a>' );
	}
	add_filter( 'pt-ocdi/message_after_file_fetching_error', 'buildpress_ocdi_message_after_file_fetching_error' );
}


/**
 * Add PW widgets to Page Builder group and add icon class.
 *
 * @param array $widgets All widgets in page builder list of widgets.
 *
 * @return array
 */
if ( ! function_exists( 'buildpress_add_icons_to_page_builder_for_pw_widgets' ) ) {
	function buildpress_add_icons_to_page_builder_for_pw_widgets( $widgets ) {
		foreach ( $widgets as $class => $widget ) {
			if ( strstr( $widget['title'], 'ProteusThemes:' ) ) {
				$widgets[ $class ]['icon']   = 'pw-pb-widget-icon';
				$widgets[ $class ]['groups'] = array( 'pw-widgets' );
			}
		}

		return $widgets;
	}
	add_filter( 'siteorigin_panels_widgets', 'buildpress_add_icons_to_page_builder_for_pw_widgets', 15 );
}


/**
 * Add another tab section in the Page Builder "add new widget" dialog.
 *
 * @param array $tabs Existing tabs.
 *
 * @return array
 */
if ( ! function_exists( 'buildpress_siteorigin_panels_add_widgets_dialog_tabs' ) ) {
	function buildpress_siteorigin_panels_add_widgets_dialog_tabs( $tabs ) {
		$tabs['pw_widgets'] = array(
			'title' => esc_html__( 'ProteusThemes Widgets', 'buildpress_wp' ),
			'filter' => array(
				'groups' => array( 'pw-widgets' ),
			),
		);

		return $tabs;
	}
	add_filter( 'siteorigin_panels_widget_dialog_tabs', 'buildpress_siteorigin_panels_add_widgets_dialog_tabs', 15 );
}

// Remove references to SiteOrigin Premium.
add_filter( 'siteorigin_premium_upgrade_teaser', '__return_false' );
