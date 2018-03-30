<?php

add_action('after_setup_theme', 'royalgold_theme_setup');

function royalgold_theme_setup() {

	if ( ! isset( $content_width ) ) $content_width = 480;

	/* load translations */
	load_theme_textdomain('royalgold', get_template_directory() . '/languages');

	add_theme_support('automatic-feed-links');
	add_theme_support('post-thumbnails');
	if (function_exists('_wp_render_title_tag')) {
		add_theme_support('title-tag');
	}

	add_action('init', 'royalgold_register_menus');
	add_action('widgets_init', 'royalgold_widgets_init');
	add_action('wp_enqueue_scripts', 'royalgold_scripts_and_style_function');

	add_filter('paginate_links_attributes', 'royalgold_paginate_links_attributes');
	add_filter('excerpt_more', 'royalgold_excerpt_more');
	add_filter('excerpt_length', 'royalgold_excerpt_length', 99);

	add_editor_style();

}

/* register main header menu */
function royalgold_register_menus() {
	register_nav_menus(array(
		'main_menu' => __('Main Menu', 'royalgold')
	));
}

/* sidebar widgets */
function royalgold_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Content Footer Widgets', 'royalgold' ),
		'id' => 'page-sidebar',
		'description' => __( 'Widget area for your main site sidebar displayed at the bottom of each page.', 'royalgold' ),
		'before_widget' => '<div class="sep"><span></span></div><div id="%1$s" class="%2$s page-widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
}


// enqueue the scripts
function royalgold_scripts_and_style_function() {

	global $smof_data;

	// enqueue google fonts
	if ( ! empty($smof_data['font_body']) || ! empty($smof_data['font_headers'])) {
		// enqueue google fonts
		$fonts  = (!empty($smof_data['font_body'])) ? ($smof_data['font_body'] . '|') : '';
		$fonts .= (!empty($smof_data['font_headers'])) ? $smof_data['font_headers'] : '';
		$fonts  = trim( $fonts, '|' );
		$protocol = is_ssl() ? 'https' : 'http';
		$font_subset = (!empty($smof_data['google_fonts_subset'])) ? '&subset=' . $smof_data['google_fonts_subset'] : '';
		wp_enqueue_style('googlefonts', $protocol . '://fonts.googleapis.com/css?family=' . rawurlencode($fonts) . $font_subset);
	}

	wp_enqueue_style('royalgold-main', get_template_directory_uri() . '/style.css');

	$additional_css = '';
	if ( ! empty($smof_data['font_body']) ) {
		$additional_css .= 'body { font-family: "' . $smof_data['font_body'] . '"; } ';
	}
	if ( ! empty($smof_data['font_headers']) ) {
		$additional_css .= 'h1, h2, h3, h4, h5, #menu li a { font-family: "' . $smof_data['font_headers'] . '"; } ';
	}
	if (isset($smof_data['color_background']) && ! empty($smof_data['color_background'])) {
		$additional_css .= 'html, #header, #main, #footer { background-color: ' . $smof_data['color_background'] . '; } ';
	}
	if (isset($smof_data['bg_pattern']) && ! empty($smof_data['bg_pattern']) && basename($smof_data['bg_pattern']) != '00.png') {
		$additional_css .= '#header, #main, #footer { background-color: #fff; background-image: url(' . get_template_directory_uri() . '/images/patterns/' . basename($smof_data['bg_pattern']) . '); } ';
	}
	if (isset($smof_data['color_link']) && ! empty($smof_data['color_link'])) {
		$additional_css .= 'a, .collapse .collapse-title { color: ' . $smof_data['color_link'] . ' } ';
		$additional_css .= 'a:hover, .collapse .collapse-title:hover, .post h3 a:hover { color: ' . royalgold_color_brightness($smof_data['color_link'], 0.9) . ' } ';
		$additional_css .= 'a:visited { color: ' . royalgold_color_brightness($smof_data['color_link'], -0.7) . ' } ';
		$additional_css .= 'a:focus { color: ' . royalgold_color_brightness($smof_data['color_link'], 0.7) . ' } ';
	}
	if (isset($smof_data['color_base']) && ! empty($smof_data['color_base'])) {
		$additional_css .= '::-moz-selection { background-color: ' . $smof_data['color_base'] . ' } ';
		$additional_css .= '::selection { background-color: ' . $smof_data['color_base'] . ' } ';
		$additional_css .= '#header nav li.current_page_item > a { color: ' . $smof_data['color_base'] . ' } ';
		$additional_css .= '.button, button, input[type=submit], input[type=reset], input[type=button], .pagination .page-numbers, table th, table caption, .dropcap.color { background-color: ' . $smof_data['color_base'] . ' } ';
		$additional_css .= '.button:focus, button:focus, input[type=submit]:focus, input[type=reset]:focus, input[type=button]:focus, .pagination .page-numbers:focus, .button:hover, button:hover, input[type=submit]:hover, input[type=reset]:hover, input[type=button]:hover, .pagination .page-numbers:hover { background-color: ' . royalgold_color_brightness($smof_data['color_base'], -0.9) . ' } ';
		$additional_css .= '.button:active, button:active, input[type=submit]:active, input[type=reset]:active, input[type=button]:active { background-color: ' . royalgold_color_brightness($smof_data['color_base'], -0.8) . ' } ';
		$additional_css .= 'table th, table caption { border-color: ' . royalgold_color_brightness($smof_data['color_base'], -0.9) . ' } ';
		$additional_css .= 'input[type=text]:focus, input[type=password]:focus, input[type=email]:focus, input[type=date]:focus, textarea:focus, select:focus { border-color: ' . $smof_data['color_base'] . ' } ';
	}
	if (isset($smof_data['menu_text_case']) && ! empty($smof_data['menu_text_case']) ) {
		$additional_css .= '#menu li a { text-transform: uppercase; } ';
	}
	if (isset($smof_data['extra_space_menu']) && ! empty($smof_data['extra_space_menu']) ) {
		$additional_css .= '#header { width: ' . (140 + intval($smof_data['extra_space_menu'])) . 'px; } ';
		$additional_css .= '@media (min-width: 768px) { #header { width: ' . (170 + intval($smof_data['extra_space_menu'])) . 'px; } } ';
	}
	if (isset($smof_data['extra_space_content']) && ! empty($smof_data['extra_space_content']) ) {
		$extra_space_content = intval($smof_data['extra_space_content']);
		$additional_css .= '@media (min-width: 768px) { #main { width: ' . (300 + $extra_space_content) . 'px; } #supersized-loader { margin-left: -' . ((300 + $extra_space_content) / 2 + 20) . 'px; } #supersized, #footer { right: ' . (300 + $extra_space_content) . 'px; } .supersized-fullscreen { right: ' . (320 + $extra_space_content) . 'px; } .supersized-prev { right: ' . (390 + $extra_space_content) . 'px; } .supersized-next { right: ' . (355 + $extra_space_content) . 'px; } } ';
		$additional_css .= '@media (min-width: 992px) { #main { width: ' . (360 + $extra_space_content) . 'px; } #supersized-loader { margin-left: -' . ((360 + $extra_space_content) / 2 + 20) . 'px; } #supersized, #footer { right: ' . (360 + $extra_space_content) . 'px; } .supersized-fullscreen { right: ' . (380 + $extra_space_content) . 'px; } .supersized-prev { right: ' . (450 + $extra_space_content) . 'px; } .supersized-next { right: ' . (415 + $extra_space_content) . 'px; } } ';
	}

	if (isset($smof_data['custom_css'])) {
		$custom_css = $additional_css . $smof_data['custom_css'];
	} else {
		$custom_css = $additional_css;
	}

	if ( ! empty($custom_css) ) {
		wp_add_inline_style('royalgold-main', str_replace('&gt;', '>', wp_kses($custom_css, array( '\'', '\"' ))));
	}

	if (defined('RESERVATIONS_VERSION')) {
		wp_enqueue_style('easy-form-royalgold', get_template_directory_uri() . '/style-easy-form.css');
	}

	if ( is_singular() ) {
		wp_enqueue_script('comment-reply');
	}

	global $is_IE;
	$is_android = isset($_SERVER['HTTP_USER_AGENT']) && strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false;
	if( $is_IE || $is_android ) {
		wp_enqueue_script('royalgold-html5', get_template_directory_uri() . '/js/html5.js');
	}

	wp_enqueue_script('royalgold-site', get_template_directory_uri() . '/js/site.js', array('jquery'), false, true);

	if ( ! empty($smof_data['custom_scrollbars'])) {
		wp_enqueue_script('royalgold-nicescroll', get_template_directory_uri() . '/js/nicescroll.min.js', array('royalgold-site'), false, true);
	}

	wp_enqueue_script('royalgold-supersized', get_template_directory_uri() . '/js/supersized.min.js', array('royalgold-site'), false, true);
}

function royalgold_color_brightness($hex, $percent) {
	$hash = '';
	if (stristr($hex,'#')) {
		$hex = str_replace('#','',$hex);
		$hash = '#';
	}
	$rgb = array(hexdec(substr($hex,0,2)), hexdec(substr($hex,2,2)), hexdec(substr($hex,4,2)));
	for ($i=0; $i<3; $i++) {
		if ($percent > 0) {
			$rgb[$i] = round($rgb[$i] * $percent) + round(255 * (1-$percent));
		} else {
			$positivePercent = $percent - ($percent*2);
			$rgb[$i] = round($rgb[$i] * $positivePercent) + round(0 * (1-$positivePercent));
		}
		if ($rgb[$i] > 255) {
			$rgb[$i] = 255;
		}
	}
	$hex = '';
	for($i=0; $i < 3; $i++) {
		$hexDigit = dechex($rgb[$i]);
		if(strlen($hexDigit) == 1) {
		$hexDigit = "0" . $hexDigit;
		}
		$hex .= $hexDigit;
	}
	return $hash.$hex;
}

$reinstall_error_msg = __( 'Please reinstall the theme, one of the main files is missing.', 'royalgold' );

/* add admin options */
define( 'ADMIN_PATH', get_template_directory() . '/utils/admin/' );
define( 'ADMIN_DIR', get_template_directory_uri() . '/utils/admin/' );
if (file_exists( get_template_directory() . '/utils/admin/index.php' )) {
	require_once( 'utils/admin/index.php' );
} else {
	wp_die( $reinstall_error_msg );
}

/* meta box */
if ( ! class_exists( 'RW_Meta_Box' ) && ! defined('RWMB_URL') ) {
	define( 'RWMB_URL', get_template_directory_uri() . '/utils/meta-box/' );
	define( 'RWMB_DIR', get_template_directory() . '/utils/meta-box/' );
	if (file_exists( RWMB_DIR . 'meta-box.php' )) {
		require_once RWMB_DIR . 'meta-box.php';
	} else {
		wp_die( $reinstall_error_msg );
	}
}
if (file_exists( get_template_directory() . '/utils/meta-box/meta-box-config.php' )) {
	include get_template_directory() . '/utils/meta-box/meta-box-config.php';
} else {
	wp_die( $reinstall_error_msg );
}

/* Register the required plugins for this theme with TGM Plugin Activation class */
if (is_admin() && file_exists(get_template_directory() . '/utils/class-tgm-plugin-activation.php')) {

	require_once('utils/class-tgm-plugin-activation.php');

	add_action( 'tgmpa_register', 'royalgold_register_required_plugins' );
	function royalgold_register_required_plugins() {
		$plugins = array(
			array(
				'name' => 'RoyalGold Helper',
				'slug' => 'royalgold-helper',
				'source' => get_template_directory() . '/utils/plugins/royalgold-helper.zip',
				'version' => '1.0',
				'required' => true,
				'force_activation' => true
			),
			array(
				'name' => '360&deg; Panoramic Viewer ',
				'slug' => 'panorama360',
				'source' => get_template_directory() . '/utils/plugins/panorama360.zip',
				'version' => '1.1.1',
			),
			array(
				'name' => 'easyReservations',
				'slug' => 'easyreservations',
			),
			array(
				'name' => 'Contact Form 7',
				'slug' => 'contact-form-7',
			),
			array(
				'name' => 'Responsive Lightbox',
				'slug' => 'responsive-lightbox',
			),
		);

		tgmpa( $plugins );
	}
}

/* pagination utils */
function royalgold_paginate_links_attributes() {
	return 'class="button"';
}

function pagination_links() {
	global $wp_query;
	$max = $wp_query->max_num_pages;
	if ($max > 1) {
		if (!$current = get_query_var('paged')) $current = 1;
		$a['base'] = str_replace(99999999, '%#%', get_pagenum_link(99999999));
		$a['total'] = $max;
		$a['current'] = $current;
		$a['mid_size'] = 1;
		echo '<div class="pagination">'.paginate_links($a).'</div>';
	}
}

/* excerpt settings */
function royalgold_excerpt_more($more) {
	global $post;
	return '&#46;&#46;&#46; <a href="'. get_permalink($post->ID) . '" class="more">' . __( '(more)', 'royalgold' ) . '</a>';
}
function royalgold_excerpt_length( $length ) {
	return 42;
}

/* comments section */
if ( ! function_exists( 'royalgold_comment' ) ) {

	function royalgold_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
			// Display trackbacks differently than normal comments.
		?>
			<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
					<p><?php _e( 'Pingback:', 'royalgold' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'royalgold' ) ); ?></p>
<?php
				break;
			default :
			// Proceed with normal comments.
			global $post; ?>

			<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
				<div class="clearfix">
					<div class="comment-author"><?php echo get_avatar( $comment, 80 ); ?></div>
					<div class="comment-body">
						<h6><?php echo get_comment_author_link( $comment->comment_ID ); ?> <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( '(reply)', 'royalgold' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></h6>
						<p class="date"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><?php /* 1: date, 2: time */
							printf( __( '%1$s at %2$s', 'royalgold' ), get_comment_date(), get_comment_time() ); ?></a></p>
<?php if ( $comment->comment_approved == '0' ) : ?>
						<div class="alert notice">
							<p><em><?php _e( 'Your comment is awaiting moderation.', 'royalgold' ); ?> <?php edit_comment_link( __( 'Edit', 'royalgold' ) ); ?></em></p>
							<br />
							<?php comment_text(); ?>
						</div>
<?php else: ?>
						<?php comment_text(); ?>
						<?php edit_comment_link( __( 'Edit', 'royalgold' ) ); ?>
<?php endif; ?>

					</div>
				</div>
<?php
			break;
		endswitch; // end comment_type check
	}

} // function_exists