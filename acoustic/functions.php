<?php 
	get_template_part('panel/constants');

	load_theme_textdomain( 'ci_theme', get_template_directory() . '/lang' );

	// This is the main options array. Can be accessed as a global in order to reduce function calls.
	$ci = get_option(THEME_OPTIONS);
	$ci_defaults = array();

	// The $content_width needs to be before the inclusion of the rest of the files, as it is used inside of some of them.
	if ( ! isset( $content_width ) ) $content_width = 710;

	//
	// Let's bootstrap the theme.
	//
	get_template_part('panel/bootstrap');

	get_template_part('functions/shortcodes');
	get_template_part('functions/downloads_handler');
	get_template_part('functions/woocommerce');

	//
	// Let WordPress manage the title.
	//
	add_theme_support( 'title-tag' );


	//
	// Define our various image sizes.
	//
	add_theme_support( 'post-thumbnails' );
	add_image_size('ci_home_slider', 1210, 540, true);
	add_image_size('ci_featured', 710, 450, true);
	add_image_size('ci_video_thumb', 460, 300, true);
	add_image_size('ci_width', 710, 9999, false);
	add_image_size('ci_rectangle', 700, 700, true);
	add_image_size('ci_page', 900, 400, true);
	add_image_size('ci_fullwidth', 1240, 600, true);


	// Set image sizes also for woocommerce.
	// Run only when the theme or WooCommerce is activated.
	add_action('ci_theme_activated', 'ci_woocommerce_image_dimensions');
	register_activation_hook( WP_PLUGIN_DIR.'/woocommerce/woocommerce.php', 'ci_woocommerce_image_dimensions' );
	if( !function_exists('ci_woocommerce_image_dimensions') ):
	function ci_woocommerce_image_dimensions()
	{
		// Image sizes
		update_option('shop_thumbnail_image_size', array(
			'width' => '90',
			'height' => '90',
			'crop' => 1
		));
		update_option('shop_catalog_image_size', array(
			'width' => '500',
			'height' => '500',
			'crop' => 1
		));
		update_option('shop_single_image_size', array(
			'width' => '600',
			'height' => '9999',
			'crop' => 0
		));
	}
	endif;


	// Let the user choose a color scheme on each post individually.
	add_ci_theme_support('post-color-scheme', array('page', 'post', 'product', 'cpt_artists', 'cpt_discography', 'cpt_events', 'cpt_galleries', 'cpt_videos'));

	// Let the theme know that we have WP-PageNavi styled.
	add_ci_theme_support('wp_pagenavi');


	//
	// Date helper
	//
	if( !function_exists('ci_the_month') ):
	function ci_the_month($m) {
		$t = mktime(0, 0, 0, $m, 1, 2000);
		return date("M", $t);
	}
	endif;


	add_action( 'wp_print_styles', 'ci_theme_deregister_pagenavi_styles', 100 );
	if( !function_exists('ci_theme_deregister_pagenavi_styles') ):
	function ci_theme_deregister_pagenavi_styles() {
		wp_deregister_style( 'wp-pagenavi' );
	}
	endif;


	// Enable automatic video thumbnail finding.
	add_filter('ci_automatic_video_thumbnail_field', 'ci_theme_add_auto_thumb_video_field');
	if( !function_exists('ci_theme_add_auto_thumb_video_field') ):
	function ci_theme_add_auto_thumb_video_field($field)
	{
		return 'ci_cpt_videos_url';
	}
	endif;


	add_filter('the_content', 'ci_prettyPhoto_rel', 12);
	add_filter('get_comment_text', 'ci_prettyPhoto_rel');
	add_filter('wp_get_attachment_link', 'ci_prettyPhoto_rel');
	if( !function_exists('ci_prettyPhoto_rel') ):
	function ci_prettyPhoto_rel($content)
	{
		global $post;
		$pattern = "/<a(.*?)href=('|\")([^>]*).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>(.*?)<\/a>/i";
		
		$replacement = '<a$1href=$2$3.$4$5 data-rel="prettyPhoto['.$post->ID.']"$6>$7</a>';
		
		$content = preg_replace($pattern, $replacement, $content);
		return $content;
	}
	endif;

	//
	// Use HTML5 on galleries
	//
	add_theme_support( 'html5', array( 'gallery' ) );

	if ( ! function_exists( 'ci_theme_get_columns_classes' ) ):
	function ci_theme_get_columns_classes( $columns ) {
		switch ( $columns ) {
			case 1:
				$classes = 'twelve';
				break;
			case 2:
				$classes = 'six';
				break;
			case 3:
				$classes = 'four';
				break;
			case 5:
				$classes = 'five-col';
				break;
			case 6:
				$classes = 'two';
				break;
			case 4:
			default:
				$classes = 'three';
				break;
		}

		return $classes;
	}
	endif;
