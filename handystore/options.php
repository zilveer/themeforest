<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 */
function optionsframework_option_name() {
	// Change this to use your theme slug
	return 'handystore-theme';
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 */

function optionsframework_options() {

	// Adding Google fonts
	if (class_exists('handyFonts')) {
		$handy_default_fonts = handyFonts::get_default_fonts();
	}
	$font_list = array();
	if ( $handy_default_fonts ) {
		foreach ($handy_default_fonts as $item) {
			$font_option = str_replace(' ', '_', $item);
			$font_name = $item;
			$font_list[$font_option] = $font_name;
		}
		unset($item);
	}

	// On/Off array
	$on_off_array = array(
		'on' => esc_html__( 'On', 'plumtree' ),
		'off' => esc_html__( 'Off', 'plumtree' ),
	);

	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment' => 'scroll'
	);

	/**
	 * For $settings options see:
	 * http://codex.wordpress.org/Function_Reference/wp_editor
	 *
	 * 'media_buttons' are not supported as there is no post to attach items to
	 * 'textarea_name' is set by the 'id' you choose
	 */

	$wp_editor_settings = array(
		'wpautop' => false,
		'textarea_rows' => 3,
		'tinymce' => array( 'plugins' => 'wordpress,wplink' )
	);

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/theme-options/images/';

	// Layout options
	$layout_options = array(
		'one-col' => $imagepath . 'one-col.png',
		'two-col-left' => $imagepath . 'two-col-left.png',
		'two-col-right' => $imagepath . 'two-col-right.png'
	);

	// Typography Options
	$typography_options = array(
		'faces' => $font_list,
		'styles' => array( 'normal' => 'Normal', 'bold' => 'Bold', 'lighter' => 'Light' ),
		'color' => true
	);

	// Color Schemes
	$base_color_scheme_array = array( "green_default" => "Default (Green)", "turquoise" => "Turquoise", "dark_red" => "Dark Red", "blue" => "Blue");

	$options = array();

	/* Global Site Settings */
	$options[] = array(
		'name' => esc_html__( 'Site Options', 'plumtree' ),
		'type' => 'heading',
		'icon' => 'site'
	);

	$options[] = array(
		'name' => esc_html__( 'Select layout for site', 'plumtree' ),
		'id' => 'site_layout',
		'std' => 'wide',
		'type' => 'radio',
		'options' => array(
			'wide'  => esc_html__('Wide', 'plumtree'),
			'boxed' => esc_html__('Boxed', 'plumtree'),
		)
	);

	$default_favicon_url = get_site_url().'/wp-content/uploads/2015/06/favicon.png';
	$options[] = array(
		'name' => esc_html__( 'Upload image for favicon', 'plumtree' ),
		'desc' => esc_html__( 'Must be in .png, .gif format & 32x32 px', 'plumtree' ),
		'id' => 'site_favicon',
		'std' => $default_favicon_url,
		'type' => 'upload'
	);

	$options[] = array(
		'name' => esc_html__( 'Enable "Maintenance Mode" for site?', 'plumtree' ),
		'desc' => esc_html__( 'When is ON use /wp-login.php to login to your site', 'plumtree' ),
		'id' => 'site_maintenance_mode',
		'std' => 'off',
		'type' => 'radio',
		'options' => $on_off_array
	);

	$options[] = array(
		'name' => esc_html__('Enter the date when "Maintenance Mode" expired', 'plumtree'),
		'desc' => esc_html__('Set date in following format (YYYY-MM-DD). If you leave this field blank, countdown clock won&rsquo;t be shown', 'plumtree'),
		'id' => 'maintenance_countdown',
		'std' => '',
		'placeholder' => 'YYYY-MM-DD',
		'type' => 'text'
	);

	$options[] = array(
		'name' => esc_html__( 'Extra Features', 'plumtree' ),
		'type' => 'info'
	);

	$options[] = array(
		'name' => esc_html__( 'Enable "Breadcrumbs" for site?', 'plumtree' ),
		'desc' => esc_html__( 'Switch to "Off" if you don&rsquo;t want to use breadcrumbs', 'plumtree' ),
		'id' => 'site_breadcrumbs',
		'std' => 'on',
		'type' => 'radio',
		'options' => $on_off_array
	);

	$options[] = array(
		'name' => esc_html__( 'Enable "Post like system" for site?', 'plumtree' ),
		'desc' => esc_html__( 'Anabling post like functionality on your site + Extra Widgets (Popular Posts, User Likes)', 'plumtree' ),
		'id' => 'site_post_likes',
		'std' => 'on',
		'type' => 'radio',
		'options' => $on_off_array
	);

	$options[] = array(
		'name' => esc_html__( 'Enable "Scroll to Top button" for site?', 'plumtree' ),
		'desc' => esc_html__( 'If "ON" appears in bottom right corner of site', 'plumtree' ),
		'id' => 'totop_button',
		'std' => 'on',
		'type' => 'radio',
		'options' => $on_off_array
	);

	/* Header Options */
	$options[] = array(
		'name' => esc_html__( 'Header Options', 'plumtree' ),
		'type' => 'heading',
		'icon' => 'header'
	);

	$header_bg_default = get_site_url().'/wp-content/uploads/2015/02/handy_bg_03.jpg';
	$options[] = array(
		'name' => esc_html__( 'Background for header', 'plumtree' ),
		'desc' => esc_html__( 'Add custom background color or image for header section.', 'plumtree' ),
		'id' => 'header_bg',
		'std' => array(
				'color' => '',
				'image' => $header_bg_default,
				'repeat' => 'repeat',
				'position' => 'top left',
				'attachment' => 'fixed'
		),
		'type' => 'background'
	);

	$options[] = array(
		'name' => esc_html__( 'Logo Options', 'plumtree' ),
		'type' => 'info'
	);

	$options[] = array(
		'name' => esc_html__( 'Select position for logo', 'plumtree' ),
		'id' => 'site_logo_position',
		'std' => 'left',
		'type' => 'radio',
		'options' => array(
			'left'  => esc_html__('Left', 'plumtree'),
			'center' => esc_html__('Center', 'plumtree'),
			'right' => esc_html__('Right', 'plumtree'),
		)
	);

	$default_logo_url = get_site_url().'/wp-content/uploads/2015/03/handy-logo.png';
	$options[] = array(
		'name' => esc_html__( 'Upload image for logo', 'plumtree' ),
		'id' => 'site_logo',
		'std' => $default_logo_url,
		'type' => 'upload'
	);

	$options[] = array(
		'name' => esc_html__( 'Top Panel Options', 'plumtree' ),
		'type' => 'info'
	);

	$options[] = array(
		'name' => esc_html__( 'Enable header&rsquo;s top panel?', 'plumtree' ),
		'desc' => esc_html__( 'Switch to "Off" if you don&rsquo;t want to use header top panel', 'plumtree' ),
		'id' => 'header_top_panel',
		'std' => 'on',
		'type' => 'radio',
		'options' => $on_off_array
	);

	$options[] = array(
		'name' => esc_html__( 'Custom background color for top panel', 'plumtree' ),
		'desc' => esc_html__( 'Check to specify custom background color for top panel', 'plumtree' ),
		'id' => 'top_panel_bg',
		'std' => false,
		'class' => 'has_hidden_child',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => esc_html__( 'Background color for header top panel', 'plumtree' ),
		'id' => 'top_panel_bg_color',
		'std' => '',
		'class' => 'hidden',
		'type' => 'color'
	);

	$options[] = array(
		'name' => esc_html__( 'Enter info contents', 'plumtree' ),
		'desc' => esc_html__( 'Info appears at center of headers top panel', 'plumtree' ),
		'id' => 'top_panel_info',
		'std' => '<i class="fa fa-map-marker"></i> 102580 Santa Monica BLVD Los Angeles',
		'type' => 'textarea'
	);

	/* Footer Options */
	$options[] = array(
		'name' => esc_html__( 'Footer Options', 'plumtree' ),
		'type' => 'heading',
		'icon' => 'footer'
	);

	$options[] = array(
		'name' => esc_html__( 'Background for footer', 'plumtree' ),
		'desc' => esc_html__( 'Add custom background color or image for footer section.', 'plumtree' ),
		'id' => 'footer_bg',
		'std' => array(
				'color' => '#393E45',
				'image' => '',
				'repeat' => 'repeat',
				'position' => 'top center',
				'attachment' => 'scroll'
		),
		'type' => 'background'
	);

	$options[] = array(
		'name' => esc_html__( 'Enter sites copyright', 'plumtree' ),
		'desc' => esc_html__( 'Enter copyright (appears at the bottom of site)', 'plumtree' ),
		'id' => 'site_copyright',
		'std' => '',
		'type' => 'textarea'
	);

	$options[] = array(
		'name' => esc_html__( 'Footer shortcode section Options', 'plumtree' ),
		'type' => 'info'
	);

	$options[] = array(
		'name' => esc_html__( 'Footer shortcode section', 'plumtree' ),
		'desc' => esc_html__( 'Check to use shortcode section located above footer', 'plumtree' ),
		'id' => 'footer_shortcode_section',
		'std' => true,
		'class' => 'has_hidden_childs',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => esc_html__( 'Background for footer shortcode section', 'plumtree' ),
		'desc' => esc_html__( 'Add custom background color or image for shortcode section.', 'plumtree' ),
		'id' => 'footer_shortcode_section_bg',
		'class' => 'hidden',
		'std' => array(
				'color' => '',
				'image' => $header_bg_default,
				'repeat' => 'repeat',
				'position' => 'top left',
				'attachment' => 'fixed'
		),
		'type' => 'background'
	);

	$default_footer_shortcode = '[ig_vendors_carousel el_title="Our Vendors" cols_qty="5" items_number="12" disabled_el="no" ][/ig_vendors_carousel]';
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		$default_footer_shortcode = '[handy_vendors_carousel cols_qty="5" items_number="6" el_title="Our Vendors"]';
	}
	$options[] = array(
		'name' => esc_html__( 'Enter shortcode', 'plumtree' ),
		'id' => 'footer_shortcode_section_shortcode',
		'std' => $default_footer_shortcode,
		'class' => 'hidden',
		'type' => 'editor',
		'settings' => $wp_editor_settings
	);

	/* Page Templates Options */
	$options[] = array(
		'name' => esc_html__( 'Page Templates Options', 'plumtree' ),
		'type' => 'heading',
		'icon' => 'templates'
	);

	$options[] = array(
		'name' => esc_html__( 'Front Page Options', 'plumtree' ),
		'type' => 'info'
	);

	$options[] = array(
		'name' => esc_html__( 'Front Page shortcode section', 'plumtree' ),
		'desc' => esc_html__( 'Check to use shortcode section located under primary navigation menu', 'plumtree' ),
		'id' => 'front_page_shortcode_section',
		'std' => false,
		'class' => 'has_hidden_childs',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => esc_html__( 'Background shortcode section', 'plumtree' ),
		'desc' => esc_html__( 'Add custom background color or image for shortcode section.', 'plumtree' ),
		'id' => 'front_page_shortcode_section_bg',
		'class' => 'hidden',
		'std' => $background_defaults,
		'type' => 'background'
	);

	$options[] = array(
		'name' => esc_html__( 'Enter shortcode', 'plumtree' ),
		'id' => 'front_page_shortcode_section_shortcode',
		'std' => '',
		'class' => 'hidden',
		'type' => 'editor',
		'settings' => $wp_editor_settings
	);

	$options[] = array(
		'name' => esc_html__( 'Enable Front Page special sidebar?', 'plumtree' ),
		'desc' => esc_html__( 'Switch to "Off" if you don&rsquo;t want to use front page special sidebar located at the bottom of Front Page Template', 'plumtree' ),
		'id' => 'front_page_special_sidebar',
		'std' => 'on',
		'type' => 'radio',
		'options' => $on_off_array
	);

	$options[] = array(
		'name' => esc_html__( 'Post Format: Gallery', 'plumtree' ),
		'type' => 'info'
	);

	$options[] = array(
		'name' => esc_html__( 'Enable Carousel for Gallery posts on blog page?', 'plumtree' ),
		'desc' => esc_html__( 'Switch to "Off" if you don&rsquo;t want to show carousel for gallery posts', 'plumtree' ),
		'id' => 'show_gallery_carousel',
		'std' => 'on',
		'type' => 'radio',
		'class' => 'has_hidden_childs_radio',
		'options' => $on_off_array
	);

	$options[] = array(
		'name' => esc_html__( 'Select carousel type for Gallery post Carousel', 'plumtree' ),
		'id' => 'gallery_carousel_type',
		'std' => 'paginated',
		'type' => 'radio',
		'class' => 'hidden',
		'options' => array(
			'paginated'  => esc_html__('Pagination navi', 'plumtree'),
			'with-thumbs' => esc_html__('Thumbnails navi', 'plumtree')
		)
	);

	$options[] = array(
		'name' => esc_html__( 'Select transition effect for Gallery post Carousel', 'plumtree' ),
		'id' => 'gallery_carousel_effect',
		'std' => 'fade',
		'type' => 'select',
		'class' => 'hidden',
		'options' => array(
			'fade'  => esc_html__('Fade', 'plumtree'),
			'backSlide'  => esc_html__('Back Slide', 'plumtree'),
			'goDown'  => esc_html__('Go Down', 'plumtree'),
			'fadeUp'  => esc_html__('Fade Up', 'plumtree'),
		)
	);


	/* Layout Options */
	$options[] = array(
		'name' => esc_html__( 'Layout Options', 'plumtree' ),
		'type' => 'heading',
		'icon' => 'layout'
	);

	$options[] = array(
		'name' => esc_html__('Set Front page layout', 'plumtree'),
		'desc' => esc_html__('Specify the location of sidebars about the content on the front page', 'plumtree'),
		'id' => "front_layout",
		'std' => "two-col-left",
		'type' => "images",
		'options' => $layout_options
	);

	$options[] = array(
		'name' => esc_html__('Set global layout for Pages', 'plumtree'),
		'desc' => esc_html__('Specify the location of sidebars about the content on the Pages of your site', 'plumtree'),
		'id' => "page_layout",
		'std' => "two-col-left",
		'type' => "images",
		'options' => $layout_options
	);

	$options[] = array(
		'name' => esc_html__('Set Blog page layout', 'plumtree'),
		'desc' => esc_html__('Specify the location of sidebars about the content on the Blog page', 'plumtree'),
		'id' => "blog_layout",
		'std' => "one-col",
		'type' => "images",
		'options' => $layout_options
	);

	$options[] = array(
		'name' => esc_html__('Set Single post view layout', 'plumtree'),
		'desc' => esc_html__('Specify the location of sidebars about the content on the single posts', 'plumtree'),
		'id' => "single_layout",
		'std' => "two-col-right",
		'type' => "images",
		'options' => $layout_options
	);

	$options[] = array(
		'name' => esc_html__('Set Products page (Shop page) layout', 'plumtree'),
		'desc' => esc_html__('Specify the location of sidebars about the content on the products page', 'plumtree'),
		'id' => "shop_layout",
		'std' => "two-col-left",
		'type' => "images",
		'options' => $layout_options
	);

	$options[] = array(
		'name' => esc_html__('Set Single Product pages layout', 'plumtree'),
		'desc' => esc_html__('Specify the location of sidebars about the content on the single product pages', 'plumtree'),
		'id' => "product_layout",
		'std' => "two-col-right",
		'type' => "images",
		'options' => $layout_options
	);

	$options[] = array(
		'name' => esc_html__('Set Vendor Store pages layout', 'plumtree'),
		'desc' => esc_html__('Specify the location of sidebars about the content on the vendor store pages', 'plumtree'),
		'id' => "vendor_layout",
		'std' => "two-col-right",
		'type' => "images",
		'options' => $layout_options
	);

	/* Blog Options */
	$options[] = array(
		'name' => esc_html__( 'Blog Options', 'plumtree' ),
		'type' => 'heading',
		'icon' => 'wordpress'
	);

	$options[] = array(
		'name' => esc_html__( 'Enter text for "Read More" button', 'plumtree' ),
		'id' => 'blog_read_more_text',
		'std' => 'Continue Reading <i class="fa fa-angle-right"></i>',
		'type' => 'textarea'
	);

	$options[] = array(
		'name' => esc_html__( 'Select pagination view for blog page', 'plumtree' ),
		'id' => 'blog_pagination',
		'std' => 'infinite',
		'type' => 'radio',
		'options' => array(
			'infinite'  => esc_html__('Infinite blog', 'plumtree'),
			'numeric' => esc_html__('Numeric pagination', 'plumtree')
		)
	);

	$options[] = array(
		'name' => esc_html__( 'Enable lazyload effects on blog page?', 'plumtree' ),
		'desc' => esc_html__( 'Switch to "Off" if you don&rsquo;t want to use Lazyload effects on blog page', 'plumtree' ),
		'id' => 'lazyload_on_blog',
		'std' => 'on',
		'type' => 'radio',
		'options' => $on_off_array
	);

	$options[] = array(
		'name' => esc_html__( 'Blog Layout Options', 'plumtree' ),
		'type' => 'info'
	);

	$options[] = array(
		'name' => esc_html__( 'Select layout for blog', 'plumtree' ),
		'id' => 'blog_frontend_layout',
		'std' => 'isotope',
		'type' => 'radio',
		'class' => 'hidden-radio-control',
		'options' => array(
			'list'  => esc_html__('List', 'plumtree'),
			'grid'  => esc_html__('Grid', 'plumtree'),
			'isotope' => esc_html__('Isotope with filters', 'plumtree')
		)
	);

	$options[] = array(
		'name' => esc_html__( 'Select number of columns for Blog "grid layout" or "isotope layout"', 'plumtree' ),
		'id' => 'blog_grid_columns',
		'std' => 'cols-3',
		'type' => 'radio',
		'class' => 'hidden',
		'options' => array(
			'cols-2'  => esc_html__('2 Columns', 'plumtree'),
			'cols-3'  => esc_html__('3 Columns', 'plumtree'),
			'cols-4' => esc_html__('4 Columns', 'plumtree')
		)
	);

	$options[] = array(
		'name' => esc_html__( 'Select what taxonomy will be used for blog filters', 'plumtree' ),
		'id' => 'blog_isotope_filters',
		'std' => 'cats',
		'type' => 'radio',
		'class' => 'hidden',
		'options' => array(
			'cats'  => esc_html__('Categories', 'plumtree'),
			'tags'  => esc_html__('Tags', 'plumtree'),
		)
	);

	$options[] = array(
		'name' => esc_html__( 'Single Post Options', 'plumtree' ),
		'type' => 'info'
	);

	$options[] = array(
		'name' => esc_html__( 'Enable single post Prev/Next navigation output?', 'plumtree' ),
		'desc' => esc_html__( 'Switch to "Off" if you don&rsquo;t want to use single post navigation', 'plumtree' ),
		'id' => 'post_pagination',
		'std' => 'on',
		'type' => 'radio',
		'options' => $on_off_array
	);

	$options[] = array(
		'name' => esc_html__( 'Enable single post breadcrumbs?', 'plumtree' ),
		'desc' => esc_html__( 'Switch to "Off" if you don&rsquo;t want to use breadcrumbs on Single post view', 'plumtree' ),
		'id' => 'post_breadcrumbs',
		'std' => 'on',
		'type' => 'radio',
		'options' => $on_off_array
	);

	$options[] = array(
		'name' => esc_html__( 'Enable single post share buttons output?', 'plumtree' ),
		'desc' => esc_html__( 'Switch to "Off" if you don&rsquo;t want to use share buttons', 'plumtree' ),
		'id' => 'blog_share_buttons',
		'std' => 'on',
		'type' => 'radio',
		'options' => $on_off_array
	);

	$options[] = array(
		'name' => esc_html__( 'Enable single post Related Posts output?', 'plumtree' ),
		'desc' => esc_html__( 'Switch to "Off" if you don&rsquo;t want to show related posts', 'plumtree' ),
		'id' => 'post_show_related',
		'std' => 'on',
		'type' => 'radio',
		'options' => $on_off_array
	);

	$options[] = array(
		'name' => esc_html__( 'Select pagination type for comments', 'plumtree' ),
		'id' => 'comments_pagination',
		'std' => 'numeric',
		'type' => 'radio',
		'options' => array(
			'newold'  => esc_html__('Newer/Older pagination', 'plumtree'),
			'numeric'  => esc_html__('Numeric pagination', 'plumtree'),
		)
	);

	$options[] = array(
		'name' => esc_html__( 'Enable lazyload effects on single post?', 'plumtree' ),
		'desc' => esc_html__( 'Switch to "Off" if you don&rsquo;t want to use Lazyload effects on single post', 'plumtree' ),
		'id' => 'lazyload_on_post',
		'std' => 'on',
		'type' => 'radio',
		'options' => $on_off_array
	);

	/* Store Options */
	$options[] = array(
		'name' => esc_html__( 'Store Options', 'plumtree' ),
		'type' => 'heading',
		'icon' => 'basket'
	);

	$options[] = array(
		'name' => esc_html__( 'Enable Catalog Mode?', 'plumtree' ),
		'desc' => esc_html__( 'Switch to "ON" if you want to switch your shop into a catalog mode (no prices, no "add to cart")', 'plumtree' ),
		'id' => 'catalog_mode',
		'std' => 'off',
		'type' => 'radio',
		'options' => $on_off_array
	);

	$options[] = array(
		'name' => esc_html__( 'Show number of products in the cart widget?', 'plumtree' ),
		'desc' => esc_html__( 'Switch to "ON" if you want to show a a number of products currently in the cart widget', 'plumtree' ),
		'id' => 'cart_count',
		'std' => 'on',
		'type' => 'radio',
		'options' => $on_off_array
	);

	$options[] = array(
		'name' => esc_html__( 'Show store Breadcrumbs?', 'plumtree' ),
		'desc' => esc_html__( 'Switch to "Off" if you don&rsquo;t want to use breadcrumbs on store page', 'plumtree' ),
		'id' => 'store_breadcrumbs',
		'std' => 'on',
		'type' => 'radio',
		'options' => $on_off_array
	);

	$options[] = array(
		'name' => esc_html__( 'Add special sidebar for filters on Store page?', 'plumtree' ),
		'desc' => esc_html__( 'Switch to "Off" if you don&rsquo;t want to use special sidebar on products page', 'plumtree' ),
		'id' => 'filters_sidebar',
		'std' => 'on',
		'type' => 'radio',
		'options' => $on_off_array
	);

	$options[] = array(
		'name' => esc_html__( 'Store as Front page?', 'plumtree' ),
		'desc' => esc_html__( 'Switch to "On" if you want to display Store page on Front page. Don&rsquo;t forget to specify Products Page as static front page in WordPress "Reading Settings".', 'plumtree' ),
		'id' => 'front_page_shop',
		'std' => 'off',
		'type' => 'radio',
		'options' => $on_off_array
	);

	$options[] = array(
		'name' => esc_html__( 'Add "Lazyload" to products?', 'plumtree' ),
		'desc' => esc_html__( 'Switch to "Off" if you don&rsquo;t want to use Lazyload effects on products.', 'plumtree' ),
		'id' => 'catalog_lazyload',
		'std' => 'on',
		'type' => 'radio',
		'options' => $on_off_array
	);

	$options[] = array(
		'name' => esc_html__( 'Store Layout Options', 'plumtree' ),
		'type' => 'info'
	);

	$options[] = array(
		'name' => esc_html__( 'Enter number of products to show on Store page', 'plumtree' ),
		'id' => 'store_per_page',
		'std' => '9',
		'class' => 'mini',
		'type' => 'text'
	);

	$options[] = array(
		'name' => esc_html__( 'Select product quantity per row on Store page', 'plumtree' ),
		'id' => 'store_columns',
		'std' => '3',
		'type' => 'radio',
		'options' => array(
			'3'  => esc_html__('3 Products', 'plumtree'),
			'4'  => esc_html__('4 Products', 'plumtree'),
		)
	);

	$options[] = array(
		'name' => esc_html__( 'Show List/Grid products switcher?', 'plumtree' ),
		'desc' => esc_html__( 'Switch to "Off" if you don&rsquo;t want to use switcher on products page', 'plumtree' ),
		'id' => 'list_grid_switcher',
		'std' => 'on',
		'type' => 'radio',
		'options' => $on_off_array
	);

	$options[] = array(
		'name' => esc_html__( 'Set default view for products (list or grid)', 'plumtree' ),
		'id' => 'default_list_type',
		'std' => 'grid',
		'type' => 'radio',
		'options' => array(
			'grid'  => esc_html__('Grid', 'plumtree'),
			'list'  => esc_html__('List', 'plumtree'),
		)
	);

	$options[] = array(
		'name' => esc_html__( 'Single Product Options', 'plumtree' ),
		'type' => 'info'
	);

	$options[] = array(
		'name' => esc_html__( 'Show Single Product pagination (prev/next product)?', 'plumtree' ),
		'desc' => esc_html__( 'Switch to "Off" if you don&rsquo;t want to use single pagination on product page', 'plumtree' ),
		'id' => 'product_pagination',
		'std' => 'on',
		'type' => 'radio',
		'options' => $on_off_array
	);

	$options[] = array(
		'name' => esc_html__( 'Show single product share buttons?', 'plumtree' ),
		'desc' => esc_html__( 'Switch to "Off" if you don&rsquo;t want to use single product share buttons', 'plumtree' ),
		'id' => 'use_pt_shares_for_product',
		'std' => 'on',
		'type' => 'radio',
		'options' => $on_off_array
	);

	$options[] = array(
		'name' => esc_html__( 'Use custom images output on Single product page?', 'plumtree' ),
		'desc' => esc_html__( 'Turning on custom image carousel on single product page', 'plumtree' ),
		'id' => 'use_pt_images_slider',
		'std' => 'on',
		'type' => 'radio',
		'class' => 'has_hidden_childs_radio',
		'options' => $on_off_array
	);

	$options[] = array(
		'name' => esc_html__( 'Choose slider type for images on Single product page', 'plumtree' ),
		'id' => 'product_slider_type',
		'std' => 'slider-with-thumbs',
		'type' => 'select',
		'class' => 'hidden',
		'options' => array(
			'simple-slider'  => esc_html__('Slider', 'plumtree'),
			'slider-with-popup'  => esc_html__('Slider with pop-up gallery', 'plumtree'),
			'slider-with-thumbs'  => esc_html__('Slider with thumbnails', 'plumtree'),
			/*'vertical-thumbs'  => esc_html__('Vertical thumbnails', 'plumtree'),*/
		)
	);

	$options[] = array(
		'name' => esc_html__( 'Select transition effect for Product Images Carousel', 'plumtree' ),
		'id' => 'product_slider_effect',
		'std' => 'backSlide',
		'type' => 'select',
		'class' => 'hidden',
		'options' => array(
			'fade'  => esc_html__('Fade', 'plumtree'),
			'backSlide'  => esc_html__('Back Slide', 'plumtree'),
			'goDown'  => esc_html__('Go Down', 'plumtree'),
			'fadeUp'  => esc_html__('Fade Up', 'plumtree'),
		)
	);

	$options[] = array(
		'name' => esc_html__( 'Show single product up-sells?', 'plumtree' ),
		'id' => 'show_upsells',
		'std' => 'on',
		'type' => 'radio',
		'class' => 'has_hidden_childs_radio',
		'options' => $on_off_array
	);

	$options[] = array(
		'name' => esc_html__( 'Select how many Up-Sell Products to show on Single product page', 'plumtree' ),
		'id' => 'upsells_qty',
		'std' => '2',
		'type' => 'select',
		'class' => 'hidden',
		'options' => array(
			'2'  => esc_html__('2 products', 'plumtree'),
			'3'  => esc_html__('3 products', 'plumtree'),
			'4'  => esc_html__('4 products', 'plumtree'),
			'5'  => esc_html__('5 products', 'plumtree'),
		)
	);

	$options[] = array(
		'name' => esc_html__( 'Show single product related products?', 'plumtree' ),
		'id' => 'show_related_products',
		'std' => 'on',
		'type' => 'radio',
		'class' => 'has_hidden_childs_radio',
		'options' => $on_off_array
	);

	$options[] = array(
		'name' => esc_html__( 'Select how many Related Products to show on Single product page', 'plumtree' ),
		'id' => 'related_products_qty',
		'std' => '3',
		'type' => 'select',
		'class' => 'hidden',
		'options' => array(
			'2'  => esc_html__('2 products', 'plumtree'),
			'3'  => esc_html__('3 products', 'plumtree'),
			'4'  => esc_html__('4 products', 'plumtree'),
			'5'  => esc_html__('5 products', 'plumtree'),
		)
	);

	$options[] = array(
		'name' => esc_html__( 'WC Vendors Options', 'plumtree' ),
		'type' => 'info'
	);

	$options[] = array(
		'name' => esc_html__( 'Show WC Vendors "Sold by:" in Store page loop products?', 'plumtree' ),
		'id' => 'show_wcv_loop_sold_by',
		'std' => 'on',
		'type' => 'radio',
		'options' => $on_off_array
	);

	$options[] = array(
		'name' => esc_html__( 'Show single product vendors related products?', 'plumtree' ),
		'id' => 'show_wcv_related_products',
		'std' => 'on',
		'type' => 'radio',
		'class' => 'has_hidden_childs_radio',
		'options' => $on_off_array
	);

	$options[] = array(
		'name' => esc_html__( 'Select how many Vendor Related Products to show on Single product page', 'plumtree' ),
		'id' => 'wcv_qty',
		'std' => '3',
		'type' => 'select',
		'class' => 'hidden',
		'options' => array(
			'2'  => esc_html__('2 products', 'plumtree'),
			'3'  => esc_html__('3 products', 'plumtree'),
			'4'  => esc_html__('4 products', 'plumtree'),
			'5'  => esc_html__('5 products', 'plumtree'),
		)
	);

	$options[] = array(
		'name' => esc_html__( 'Add favourite vendor system?', 'plumtree' ),
		'desc' => esc_html__( 'Special "Add to Favourites" button appears on single vendor shop when "On". So logged in users can add different vendors to their favourite lists & manage them from "My Account" page', 'plumtree' ),
		'id' => 'show_wcv_favourite_vendors',
		'std' => 'off',
		'type' => 'radio',
		'class' => 'has_hidden_childs_radio',
		'options' => $on_off_array
	);


	/* Color Shemes */
	$options[] = array(
		'name' => esc_html__( 'Typography & Colors', 'plumtree' ),
		'type' => 'heading',
		'icon' => 'eyedropper'
	);

	$options[] = array(
		'name' => esc_html__( 'Enable custom colors and fonts?', 'plumtree' ),
		'id' => 'site_custom_colors',
		'std' => 'off',
		'type' => 'radio',
		'class' => 'has_hidden_childs_radio',
		'options' => $on_off_array
	);

	$options[] = array(
	  "name" => esc_html__( "Base Color Scheme", 'plumtree' ),
	  "desc" => esc_html__( "Choose a predefined base color scheme.", 'plumtree' ),
	  "id" => "base_color_scheme",
	  "std" => "orange_default",
	  "type" => "select",
	  "class" => "hidden mini",
	  "options" => $base_color_scheme_array
	);

	$options[] = array(
		'name' => esc_html__( 'Fonts Options', 'plumtree' ),
		'type' => 'info',
		'class' => 'hidden'
	);

	$options[] = array(
		'name' => esc_html__( 'Primary text typography options', 'plumtree' ),
		'desc' => esc_html__( 'Specify color for all text content', 'plumtree' ),
		'id' => "primary_text_typography",
		'std' => array(
			'size' => '14px',
			'face' => 'Open_Sans',
			'style' => 'normal',
			'color' => '#646565'
		),
		'type' => 'typography',
		'class' => 'hidden',
		'options' => $typography_options
	);

	$options[] = array(
		'name' => esc_html__( 'Secondary text color', 'plumtree' ),
		'desc' => esc_html__( 'Specify secondary color for all meta content(categories, tags, excerpts)', 'plumtree' ),
		'id' => 'secondary_text_color',
		'std' => '#898e91',
		'class' => 'hidden',
		'type' => 'color'
	);

	$options[] = array(
		'name' => esc_html__( 'Content headings typography options', 'plumtree' ),
		'desc' => esc_html__( 'Specify color for all headings in the content area(page/post/product titles)', 'plumtree' ),
		'id' => "content_headings_typography",
		'std' => array(
			'size' => '30px',
			'face' => 'Roboto',
			'style' => 'bold',
			'color' => '#484747'
		),
		'type' => 'typography',
		'class' => 'hidden',
		'options' => $typography_options
	);

	$options[] = array(
		'name' => esc_html__( 'Sidebar headings typography options', 'plumtree' ),
		'desc' => esc_html__( 'Specify color for all headings in the sidebar area(widget titles)', 'plumtree' ),
		'id' => "sidebar_headings_typography",
		'std' => array(
			'size' => '18px',
			'face' => 'Roboto',
			'style' => 'bold',
			'color' => '#151515'
		),
		'type' => 'typography',
		'class' => 'hidden',
		'options' => $typography_options
	);

	$options[] = array(
		'name' => esc_html__( 'Footer headings typography options', 'plumtree' ),
		'desc' => esc_html__( 'Specify color for all headings in the footer widgets(footer widget titles)', 'plumtree' ),
		'id' => "footer_headings_typography",
		'std' => array(
			'size' => '18px',
			'face' => 'Roboto',
			'style' => 'bold',
			'color' => '#f8f8f6'
		),
		'type' => 'typography',
		'class' => 'hidden',
		'options' => $typography_options
	);

	$options[] = array(
		'name' => esc_html__( 'Footer text color', 'plumtree' ),
		'desc' => esc_html__( 'Specify color for text in the footer area', 'plumtree' ),
		'id' => 'footer_text_color',
		'std' => '#f8f8f6',
		'class' => 'hidden',
		'type' => 'color'
	);

	$options[] = array(
		'name' => esc_html__( 'Links & Buttons Options', 'plumtree' ),
		'type' => 'info',
		'class' => 'hidden'
	);

	$options[] = array(
		'name' => esc_html__( 'Link color', 'plumtree' ),
		'desc' => esc_html__( 'Specify color for all text links', 'plumtree' ),
		'id' => 'link_color',
		'std' => '#151515',
		'class' => 'hidden',
		'type' => 'color'
	);

	$options[] = array(
		'name' => esc_html__( 'Link color on hover', 'plumtree' ),
		'desc' => esc_html__( 'Specify color for all hovered text links', 'plumtree' ),
		'id' => 'link_color_hover',
		'std' => '#f7972b',
		'class' => 'hidden',
		'type' => 'color'
	);

	$options[] = array(
		'name' => esc_html__( 'Primary button typography options', 'plumtree' ),
		'desc' => esc_html__( 'Specify fonts for buttons(product "add to cart", form buttons, etc.)', 'plumtree' ),
		'id' => "button_typography",
		'std' => array(
			'size' => '14px',
			'face' => 'Roboto',
			'style' => 'normal',
			'color' => '#444444'
		),
		'type' => 'typography',
		'class' => 'hidden',
		'options' => $typography_options
	);

	$options[] = array(
		'name' => esc_html__( 'Primary button background color', 'plumtree' ),
		'desc' => esc_html__( 'Specify background color for buttons. Background for hovered buttons equal to main theme color', 'plumtree' ),
		'id' => 'button_background_color',
		'std' => '#f7f8f8',
		'class' => 'hidden',
		'type' => 'color'
	);

	$options[] = array(
		'name' => esc_html__( 'Primary button text color on hover', 'plumtree' ),
		'desc' => esc_html__( 'Specify text color for hovered buttons', 'plumtree' ),
		'id' => 'button_text_hovered_color',
		'std' => '#ffffff',
		'class' => 'hidden',
		'type' => 'color'
	);

	$options[] = array(
		'name' => esc_html__( 'Icons & other Elements', 'plumtree' ),
		'type' => 'info',
		'class' => 'hidden'
	);

	$options[] = array(
		'name' => esc_html__( 'Main Theme color', 'plumtree' ),
		'desc' => esc_html__( 'Specify color for decorative elements(icons, buttons, switchers, etc.)', 'plumtree' ),
		'id' => 'main_decor_color',
		'std' => '#f7972b',
		'class' => 'hidden',
		'type' => 'color'
	);

	$options[] = array(
		'name' => esc_html__( 'Secondary Theme color', 'plumtree' ),
		/*'desc' => esc_html__( 'Specify color for decorative elements(icons, buttons, switchers, etc.)', 'plumtree' ),*/
		'id' => 'sec_decor_color',
		'std' => '#81cfdc',
		'class' => 'hidden',
		'type' => 'color'
	);

	$options[] = array(
		'name' => esc_html__( 'Theme Border color', 'plumtree' ),
		'desc' => esc_html__( 'Specify color for borders of the theme elements', 'plumtree' ),
		'id' => 'main_border_color',
		'std' => '#e7e4d9',
		'class' => 'hidden',
		'type' => 'color'
	);

	return $options;
}
