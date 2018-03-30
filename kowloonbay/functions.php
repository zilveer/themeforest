<?php 

/* Redux framework */
if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/vendor/redux-framework/ReduxCore/framework.php' ) ) {
	require_once( dirname( __FILE__ ) . '/vendor/redux-framework/ReduxCore/framework.php' );
}
require_once( dirname( __FILE__ ) . '/inc/kowloonbay-redux-config.php' );
require_once( dirname( __FILE__ ) . '/inc/kowloonbay-set-redux-defaults.php' );

global $kowloonbay_redux_opts;
kowloonbay_set_redux_defaults();

$disable_query_vars = $kowloonbay_redux_opts['misc_disable_query_vars'] === '1';


/* Meta Box plugin */
define( 'RWMB_URL', trailingslashit( get_template_directory_uri() . '/vendor/meta-box' ) );
define( 'RWMB_DIR', trailingslashit( get_template_directory() . '/vendor/meta-box' ) );
require_once RWMB_DIR . 'meta-box.php';
include 'inc/kowloonbay-meta-boxes.php';


/* WP LESS */
require dirname(__FILE__) . '/vendor/wp-less/bootstrap-for-theme.php';
$less = WPLessPlugin::getInstance();
$less->dispatch();
require get_template_directory() . '/inc/kowloonbay-less-vars.php';
$less->install();
$less->uninstall();

/* Allowed HTML tags for data sanitization */
global $kowloonbay_allowed_html;
$kowloonbay_allowed_html = array(
	'a' => array(
		'href' => array(),
		'title' => array(),
		'target' => array(),
		'data-hover' => array(),
		'rel' => array(),
		'class' => array()
	),
	'br' => array(),
	'p' => array(
		'class' => array(),
	),
	'span' => array(
		'class' => array(),
	),
	'em' => array(),
	'strong' => array(),
	'h1' => array(
		'class' => array(),
	),
	'h2' => array(
		'class' => array(),
	),
	'h3' => array(
		'class' => array(),
	),
	'h4' => array(
		'class' => array(),
	),
	'h5' => array(
		'class' => array(),
	),
	'h6' => array(
		'class' => array(),
	),
	'img' => array(
		'class' => array(),
		'src' => array(),
		'alt' => array(),
		'title' => array(),
	),
	'ul' => array(
		'class' => array(),
	),
	'li' => array(
		'class' => array(),
	),
	'i' => array(
		'class' => array(),
	),
	'div' => array(
		'id' => array(),
		'class' => array(),
		'data-property' => array(),
	),
	'iframe' => array(
		'class' => array(),
		'src' => array(),
		'width' => array(),
		'height' => array(),
		'frameborder' => array(),
		'title' => array(),
		'webkitallowfullscreen' => array(),
		'mozallowfullscreen' => array(),
		'allowfullscreen' => array(),
		'scrolling' => array(),
	),
);

/* WP Title */
function kowloonbay_wp_title( $title, $sep ) {
	global $kowloonbay_blog_title;
	if (is_single()) {
		$title = get_the_title().' - '.get_bloginfo('name');
	}
	else if (is_front_page() && is_home()) {
		$title = $kowloonbay_blog_title.' - '.get_bloginfo('name');
	}
	else if (is_front_page()) {
		$title = get_the_title();
	} elseif ( is_home() ) {
		$title = $kowloonbay_blog_title.' - '.get_bloginfo('name');
	}
	else if (is_page()) {
		$title = get_the_title().' - '.get_bloginfo('name');
	}
	else {
		$title = get_bloginfo('name');
	}

	return $title;
}
add_filter( 'wp_title', 'kowloonbay_wp_title', 10, 2 );


/* KowloonBay Menu */
require get_template_directory() . '/inc/kowloonbay-walker-nav-menu.php';
register_nav_menus( array(
	'kowloonbay_menu'   => __( 'KowloonBay Menu (Header)', 'KowloonBay' ),
) );


/* KowloonBay content types */
require get_template_directory() . '/inc/kowloonbay-portfolio.php';
require get_template_directory() . '/inc/kowloonbay-team.php';
require get_template_directory() . '/inc/kowloonbay-service.php';
require get_template_directory() . '/inc/kowloonbay-testimonial.php';
require get_template_directory() . '/inc/kowloonbay-faq.php';


/* KowloonBay shortcodes */
require get_template_directory() . '/inc/kowloonbay-portfolio-shortcode.php';
require get_template_directory() . '/inc/kowloonbay-team-shortcode.php';
require get_template_directory() . '/inc/kowloonbay-services-shortcode.php';
require get_template_directory() . '/inc/kowloonbay-testimonials-shortcode.php';
require get_template_directory() . '/inc/kowloonbay-faq-shortcode.php';


/* Remove Slider Revolution Metaboxes */
/* Source: https://gist.github.com/DevinWalker/ee9d4e53883460c6bbb8 */
if ( is_admin() ) {
	function kowloonbay_remove_revolution_slider_meta_boxes() {
		remove_meta_box( 'mymetabox_revslider_0', 'page', 'normal' );
		remove_meta_box( 'mymetabox_revslider_0', 'post', 'normal' );
		remove_meta_box( 'mymetabox_revslider_0', 'kowloonbay_portfolio', 'normal' );
		remove_meta_box( 'mymetabox_revslider_0', 'kowloonbay_team', 'normal' );
		remove_meta_box( 'mymetabox_revslider_0', 'kowloonbay_service', 'normal' );
		remove_meta_box( 'mymetabox_revslider_0', 'kowloonbay_tmnl', 'normal' );
		remove_meta_box( 'mymetabox_revslider_0', 'kowloonbay_faq', 'normal' );
	}
	add_action( 'do_meta_boxes', 'kowloonbay_remove_revolution_slider_meta_boxes' );
}

/* Check if a Redux option contains image infomation */
function kowloonbay_redux_img_exists($opt)
{
	if (is_array($opt) && isset($opt['url']) && !empty($opt['url']) )
		return true;
	else
		return false;
}

/* Print preloader of the KowloonBay template */
function kowloonbay_preloader()
{
	global $kowloonbay_redux_opts;

	if ($kowloonbay_redux_opts['general_enable_preloader'] === '1'):
	?>

	<div class="preloader"><div class="load <?php echo esc_attr('load'.$kowloonbay_redux_opts['general_preloader_spinner']) ; ?>"><div class="loader">Loading...</div></div></div>
	
	<?php
	endif;
}

/* Print logo of the KowloonBay template */
function kowloonbay_logo()
{
	global $kowloonbay_redux_opts;
	global $kowloonbay_allowed_html;

	$general_use_as_logo = $kowloonbay_redux_opts['general_use_as_logo'];
	$general_logo_html = $kowloonbay_redux_opts['general_logo_html'];
	$general_logo_img = $kowloonbay_redux_opts['general_logo_img'];

	if ( $general_use_as_logo === 'img' && kowloonbay_redux_img_exists($general_logo_img) ){
		echo '<img src="'. esc_url( $general_logo_img['url'] ) .'" alt="'. get_bloginfo('name' ) .'">';
	} else if (!empty($general_logo_html)){
		echo wp_kses($general_logo_html, $kowloonbay_allowed_html);
	} else{
		echo esc_html(get_bloginfo('name'));
	}
}

/* Check if the page is homepage */
function kowloonbay_is_home()
{
	return is_page_template('inc/kowloonbay-page-home-video.php') || is_page_template('inc/kowloonbay-page-home-slider.php');
}

/* Check if the page template of homepage video background is used */
function kowloonbay_is_home_video()
{
	return is_page_template('inc/kowloonbay-page-home-video.php');
}

/* Query var for switching between YouTube / HTML5 video */
function kowloonbay_add_homepage_query_vars_filter( $vars ){
	$vars[] = "homepage_youtube_or_html5";
	return $vars;
}
if (!$disable_query_vars) add_filter( 'query_vars', 'kowloonbay_add_homepage_query_vars_filter' );

/* Echo poster for homepage video background */
function kowloonbay_homepage_video_bg_poster()
{
	global $kowloonbay_redux_opts;
	if ( kowloonbay_is_home_video() && kowloonbay_redux_img_exists($kowloonbay_redux_opts['homepage_bg_video_poster']) ){
		echo 'style="background-image:url(\''. esc_url( $kowloonbay_redux_opts['homepage_bg_video_poster']['url'] ) .'\');" ';
	}
}

/* Echo HTML attribute for homepage video background */
function kowloonbay_homepage_video_bg_atts()
{
	$videoAtts = '';

	global $kowloonbay_redux_opts;

	$homepage_youtube_or_html5 = get_query_var('homepage_youtube_or_html5');
	if ($homepage_youtube_or_html5 === '')
	$homepage_youtube_or_html5 = $kowloonbay_redux_opts['homepage_youtube_or_html5'];

	$homepage_bg_video_poster = kowloonbay_redux_img_exists($kowloonbay_redux_opts['homepage_bg_video_poster']) ? $kowloonbay_redux_opts['homepage_bg_video_poster']['url'] : '';
	$homepage_bg_video_mp4 = $kowloonbay_redux_opts['homepage_bg_video_mp4'];
	$homepage_bg_video_webm = $kowloonbay_redux_opts['homepage_bg_video_webm'];
	$homepage_bg_video_ogv = $kowloonbay_redux_opts['homepage_bg_video_ogv'];

	if (!empty($homepage_bg_video_mp4)) $homepage_bg_video_mp4 = 'mp4: '. esc_url( $homepage_bg_video_mp4 ) .', ';
	if (!empty($homepage_bg_video_webm)) $homepage_bg_video_webm = 'webm: '. esc_url( $homepage_bg_video_webm ) .', ';
	if (!empty($homepage_bg_video_ogv)) $homepage_bg_video_ogv = 'ogv: '. esc_url( $homepage_bg_video_ogv ) .', ';
	if (!empty($homepage_bg_video_poster)) $homepage_bg_video_poster = 'poster: '. esc_url( $homepage_bg_video_poster );

	if (kowloonbay_is_home_video() && $homepage_youtube_or_html5 !== 'youtube'){
		$videoAtts = $homepage_bg_video_mp4.
					 $homepage_bg_video_webm.
					 $homepage_bg_video_ogv.
					 $homepage_bg_video_poster;
		echo 'data-vide-bg="'. esc_html($videoAtts) .'" data-vide-options="position: 0% 50%"';
	}
}

/* Modify posts_per_page for portfolio */
function kowloonbay_portfolio_posts_per_page()
{
	global $kowloonbay_redux_opts;

	$p = -1;
	if ($kowloonbay_redux_opts['portfolio_infinite_scroll'] === '1'){
		$p = (int)$kowloonbay_redux_opts['portfolio_posts_per_page'];
		if ($p === 0) $p = 8;
	}
	return $p;
}

function kowloonbay_portfolio_cat_attr($cats)
{
	$cat_attr = ' ';
	foreach ($cats as $c) {
		if ($c->slug !== 'hidden-from-navigation'){
			$cat_attr .= 'cat-'. $c->slug .' ';
		}
	}
	return $cat_attr;
}

function kowloonbay_portfolio_cat_names($cats)
{
	$cat_names = '';
	foreach ($cats as $c) {
		if ($c->slug !== 'hidden-from-navigation'){
			$cat_names .= ($cat_names === '' ? '' : ', '). $c->name;
		}
	}
	return $cat_names;
}

function kowloonbay_portfolio_pre_get_posts( $query ) {
	if ( !is_admin() && is_post_type_archive( 'kowloonbay_portfolio' ) && $query->is_main_query() ){
		$query->set( 'posts_per_page', kowloonbay_portfolio_posts_per_page() );
		$query->set( 'orderby', 'menu_order' );
		$query->set( 'order', 'asc' );
	}
}
add_action( 'pre_get_posts', 'kowloonbay_portfolio_pre_get_posts' );

function kowloonbay_get_previous_portfolio_where($where) {
	if(is_singular('kowloonbay_portfolio')) {
		global $wpdb, $post, $kowloonbay_portfolio_current_assignment;

		$where .= " AND p.ID IN ( SELECT post_id FROM $wpdb->postmeta WHERE meta_key = 'kowloonbay_portfolio_assignment' AND meta_value = $kowloonbay_portfolio_current_assignment )";
		$term_hidden_from_navigation = get_term_by('slug','hidden-from-navigation', 'kowloonbay_portfolio_cat');
		if ($term_hidden_from_navigation !== false){
			$where .= " AND p.ID NOT IN ( SELECT object_id FROM $wpdb->term_relationships WHERE term_taxonomy_id IN ($term_hidden_from_navigation->term_taxonomy_id) )";
		}
	}
	return $where;
}
add_filter('get_previous_post_where', 'kowloonbay_get_previous_portfolio_where');

function kowloonbay_get_next_portfolio_where($where) {
	if(is_singular('kowloonbay_portfolio')) {
		global $wpdb, $post, $kowloonbay_portfolio_current_assignment;

		$where .= " AND p.ID IN ( SELECT post_id FROM $wpdb->postmeta WHERE meta_key = 'kowloonbay_portfolio_assignment' AND meta_value = $kowloonbay_portfolio_current_assignment )";
		$term_hidden_from_navigation = get_term_by('slug','hidden-from-navigation', 'kowloonbay_portfolio_cat');
		if ($term_hidden_from_navigation !== false){
			$where .= " AND p.ID NOT IN ( SELECT object_id FROM $wpdb->term_relationships WHERE term_taxonomy_id IN ($term_hidden_from_navigation->term_taxonomy_id) )";
		}
	}
	return $where;
}
add_filter('get_next_post_where', 'kowloonbay_get_next_portfolio_where');

function kowloonbay_add_portfolio_query_vars_filter( $vars ){
	$vars[] = "portfolio_col";
	$vars[] = "portfolio_masonry";
	$vars[] = "portfolio_boxed";
	return $vars;
}
if (!$disable_query_vars) add_filter( 'query_vars', 'kowloonbay_add_portfolio_query_vars_filter' );

function kowloonbay_add_portfolio_paged_query_var_filter( $vars ){
	$vars[] = "portfolio_paged";
	return $vars;
}
add_filter( 'query_vars', 'kowloonbay_add_portfolio_paged_query_var_filter' );


/* KowloonBay Blog */
function kowloonbay_new_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'kowloonbay_new_excerpt_more');

function kowloonbay_blog_sidebar_init() {

	register_sidebar( array(
		'name' => 'Blog sidebar',
		'id' => 'kowloonbay_blog_sidebar',
		'before_widget' => '<div id="%1$s" class="%2$s sidebar-block">',
		'after_widget' => '</div>',
		'before_title' => '<h5 class="h5-style">',
		'after_title' => '</h5>',
	) );
}
add_action( 'widgets_init', 'kowloonbay_blog_sidebar_init' );

function kowloonbay_exclude_sticky( $query ) {
	if ( $query->is_home() && $query->is_main_query() ) {
		$query->set('post__not_in',  get_option('sticky_posts'));
	}
}
add_action( 'pre_get_posts', 'kowloonbay_exclude_sticky' );

function kowloonbay_search_filter($query) {
	// search only blog posts
	if ( $query->is_search ) {
		$query->set('post_type', 'post');
	}
	return $query;
}
add_filter('pre_get_posts','kowloonbay_search_filter');

function kowloonbay_add_blog_query_vars_filter( $vars ){
	$vars[] = "blog_layout";
	$vars[] = "blog_infinite_scroll";
	return $vars;
}
if (!$disable_query_vars) add_filter( 'query_vars', 'kowloonbay_add_blog_query_vars_filter' );

global $kowloonbay_blog_title;
global $kowloonbay_blog_desc;
global $kowloonbay_blog_url;

$kowloonbay_blog_id = get_option( 'page_for_posts' );
if ($kowloonbay_blog_id > 0){
	$kowloonbay_blog_title = get_the_title( $kowloonbay_blog_id );
	$kowloonbay_blog_desc = rwmb_meta( 'kowloonbay_page_desc', '', $kowloonbay_blog_id);
	$kowloonbay_blog_url = get_permalink( $kowloonbay_blog_id );
} else{
	$kowloonbay_blog_title = 'Blog';
	$kowloonbay_blog_desc = '';
	$kowloonbay_blog_url = esc_url( home_url( '/' ) );;
}



/* Styles and scripts */
function kowloonbay_styles_scripts() {
	global $kowloonbay_redux_opts;

	// enqueue styles
	$body_text = $kowloonbay_redux_opts['typography_body_text'];
	$title_text = $kowloonbay_redux_opts['typography_title_text'];

	$body_light_font_weight = $kowloonbay_redux_opts['typography_body_light_font_weight'];
	$body_medium_font_weight = $kowloonbay_redux_opts['typography_body_medium_font_weight'];
	$body_heavy_font_weight = $kowloonbay_redux_opts['typography_body_heavy_font_weight'];
	$title_medium_font_weight = $kowloonbay_redux_opts['typography_title_medium_font_weight'];
	$title_heavy_font_weight = $kowloonbay_redux_opts['typography_title_heavy_font_weight'];

	$misc_rs_custom_hide_whitespaces = $kowloonbay_redux_opts['misc_rs_custom_hide_whitespaces'];
	$general_custom_css = $kowloonbay_redux_opts['general_custom_css'];

	$typography_body_text_font_weight = implode(',', array(
		$body_light_font_weight,
		$body_medium_font_weight,
		$body_heavy_font_weight,
		$body_light_font_weight.'italic',
		$body_medium_font_weight.'italic',
		$body_heavy_font_weight.'italic',
		));
	$typography_title_text_font_weight = implode(',', array(
		$title_heavy_font_weight,
		$title_medium_font_weight,
		$title_heavy_font_weight.'italic',
		$title_medium_font_weight.'italic',
		));

	$typography_body_text_font = str_replace(' ', '+', $body_text['font-family']);
	$typography_title_text_font = str_replace(' ', '+', $title_text['font-family']);

	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/vendor/bootstrap-3.3.0/css/bootstrap.min.css' );
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/css/libs/font-awesome-4.3.0/css/font-awesome.css' );
	wp_enqueue_style( 'body-text-font', 'http://fonts.googleapis.com/css?family='.$typography_body_text_font.':'.$typography_body_text_font_weight );
	wp_enqueue_style( 'title-text-font', 'http://fonts.googleapis.com/css?family='.$typography_title_text_font.':'.$typography_title_text_font_weight );
	wp_enqueue_style( 'owl-carousel-css', get_template_directory_uri() . '/css/libs/owl.carousel.css');
	wp_enqueue_style( 'owl-theme', get_template_directory_uri() . '/css/libs/owl.theme.default.css');
	wp_enqueue_style( 'stackbox-css', get_template_directory_uri() . '/css/libs/jquery.stackbox.min.css');
	wp_enqueue_style( 'animate-css', get_template_directory_uri() . '/css/libs/animate.min.css');
	wp_enqueue_style( 'magnific-popup', get_template_directory_uri() . '/css/libs/magnific-popup.css');

	if ( ! is_admin() && !in_array( $GLOBALS['pagenow'], array( 'wp-login.php', 'wp-register.php' ) ) ){
		wp_enqueue_style( 'index', get_template_directory_uri() . '/css/index.less' );
	}
	wp_enqueue_style( 'style', get_stylesheet_uri() );

	$css_rs_custom_hide_whitespaces = "
		.kowloonbaybigwhite>.tp-splitted>.tp-splitted:last-child{
			display: none !important;
		}
		.kowloonbaybigwhite>.tp-splitted>.tp-splitted:first-child{
			display: inline-block !important;
		}
		";

	if ($misc_rs_custom_hide_whitespaces){
		wp_add_inline_style( 'index', $css_rs_custom_hide_whitespaces );
	}
	wp_add_inline_style( 'index', $general_custom_css );

	// enqueue scripts
	wp_enqueue_script('bootstrap', get_template_directory_uri() . '/vendor/bootstrap-3.3.0/js/bootstrap.min.js', array('jquery'), false, true );
	wp_enqueue_script('smooth-scroll', get_template_directory_uri() . '/js/libs/SmoothScroll.js', array(), false, true );

	if (is_page_template('inc/kowloonbay-page-portfolio.php') || is_archive() || is_home() || is_search()){
		wp_enqueue_script('isotope', get_template_directory_uri() . '/js/libs/isotope.pkgd.min.js', array(), false, true );
		wp_enqueue_script('jscroll', get_template_directory_uri() . '/js/libs/jquery.jscroll.min.js', array('jquery'), false, true );
	}

	if (is_page_template('inc/kowloonbay-page-testimonials.php')){
		wp_enqueue_script('waypoints', get_template_directory_uri() . '/js/libs/waypoints.min.js', array(), false, true );
		wp_enqueue_script('counterup', get_template_directory_uri() . '/js/libs/jquery.counterup.min.js', array('jquery'), false, true );
	}
	if (is_single() || is_archive() || is_home() || is_search() || is_page_template('inc/kowloonbay-page-team.php')){
		wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/js/libs/owl.carousel.min.js', array('jquery'), false, true );
		wp_enqueue_script('stackbox', get_template_directory_uri() . '/js/libs/jquery.stackbox.min.js', array('jquery'), false, true );
		wp_enqueue_script('tube', get_template_directory_uri() . '/js/libs/jquery.tubeplayer.min.js', array('jquery'), false, true );
	}
	if (is_archive() || is_home() || is_search()){
		wp_enqueue_script('stackbox', get_template_directory_uri() . '/js/libs/jquery.stackbox.min.js', array('jquery'), false, true );
		wp_enqueue_script('tube', get_template_directory_uri() . '/js/libs/jquery.tubeplayer.min.js', array('jquery'), false, true );
		wp_enqueue_script('vimeo-api', get_template_directory_uri() . '/js/libs/jquery.vimeo.api.min.js', array('jquery'), false, true );
	}
	if (is_page_template('inc/kowloonbay-page-contact.php')){
		wp_enqueue_script('color', get_template_directory_uri() . '/js/libs/jquery.color.min.js', array('jquery'), false, true );
		wp_enqueue_script('gmaps-api', 'http://maps.google.com/maps/api/js?sensor=false', array(), false, false );
		wp_enqueue_script('google-maps', get_template_directory_uri() . '/js/google-maps.js', array('jquery', 'gmaps-api'), false, true );
	}

	wp_enqueue_script('magnific-popup', get_template_directory_uri() . '/js/libs/jquery.magnific-popup.min.js', array('jquery'), false, true );
	wp_enqueue_script('vide', get_template_directory_uri() . '/js/libs/jquery.vide.min.js', array('jquery'), false, true );
	wp_enqueue_script('lettering', get_template_directory_uri() . '/js/libs/jquery.lettering.js', array('jquery'), false, true );
	wp_enqueue_script('wow', get_template_directory_uri() . '/js/libs/wow.min.js', array(), false, true );
	wp_enqueue_script('skrollr', get_template_directory_uri() . '/js/libs/skrollr.min.js', array('jquery'), false, true );
	wp_enqueue_script('modernizr', get_template_directory_uri() . '/js/libs/modernizr.min.js', array(), false, true );
	wp_enqueue_script('hammer', get_template_directory_uri() . '/js/libs/hammer.min.js', array(), false, true );

	wp_enqueue_script('img-bg-cover', get_template_directory_uri() . '/js/img-bg-cover.js', array('jquery'), false, true );
	wp_enqueue_script('eq-col-height', get_template_directory_uri() . '/js/eq-col-height.js', array('jquery'), false, true );
	wp_enqueue_script('multi-level-menu', get_template_directory_uri() . '/js/multi-level-menu.js', array('jquery'), false, true );
	wp_enqueue_script('clickable-block', get_template_directory_uri() . '/js/clickable-block.js', array('jquery'), false, true );

	wp_enqueue_script('setup', get_template_directory_uri() . '/js/setup.js', array('jquery','bootstrap'), false, true );
}

add_action( 'wp_enqueue_scripts', 'kowloonbay_styles_scripts' );
if ( is_singular() ) wp_enqueue_script( "comment-reply" );
add_action( 'wp_print_footer_scripts', 'kowloonbay_print_inline_scripts' );

function kowloonbay_print_inline_scripts()
{
	global $kowloonbay_redux_opts;
	global $kowloonbay_carousel_single_item_count;
	global $kowloonbay_carousel_single_item_video_count;
	global $kowloonbay_carousel_multiple_items_count;
	global $kowloonbay_carousel_related_items_count;
	global $wp_scripts;

	if (wp_script_is('setup','done' )): ?>

	<script>
		var param = {
			requiredScripts: '<?php echo esc_js(implode($wp_scripts->queue,',')); ?>',
			animationSectionDesc: '<?php echo esc_js( $kowloonbay_redux_opts["animation_section_desc"] ) ?>',
			animationSectionHeading: '<?php echo esc_js( $kowloonbay_redux_opts["animation_section_heading"] ) ?>',
			animationPortfolioSlider: '<?php echo esc_js( $kowloonbay_redux_opts["animation_portfolio_slider"] ) ?>',
			carouselSingleItemCount: <?php echo esc_js( (int) $kowloonbay_carousel_single_item_count); ?>,
			carouselSingleItemVideoCount: <?php echo esc_js( (int) $kowloonbay_carousel_single_item_video_count); ?>,
			carouselMultipleItemsCount: <?php echo esc_js( (int) $kowloonbay_carousel_multiple_items_count); ?>,
			teamMaxCol: <?php echo esc_js( abs(intval($kowloonbay_redux_opts['team_max_col'])) ); ?>,
			carouselRelatedItemsCount: <?php echo esc_js( (int) $kowloonbay_carousel_related_items_count); ?>,
			animationItemArray: '<?php echo esc_js( $kowloonbay_redux_opts["animation_item_array"] ); ?>',
			animationParallaxInitial: '<?php echo esc_js( $kowloonbay_redux_opts["animation_parallax_initial"] );?>',
			animationParallaxFinal: '<?php echo esc_js( $kowloonbay_redux_opts["animation_parallax_final"] );?>',
			miscLoadingFaIcon: '<?php echo esc_js( $kowloonbay_redux_opts["misc_loading_fa_icon"] ); ?>',
			animationSectionDescApplyToLetter:  <?php echo esc_js($kowloonbay_redux_opts["animation_section_desc_apply_to_letter"] === '1' ? 'true' : 'false'); ?>,

			durationCarouselSingleItemAutoplayTimeout: <?php echo esc_js( (int) $kowloonbay_redux_opts['duration_carousel_single_item_autoplay_timeout'] ); ?>,
			durationCarouselMultipleItemsAutoplayTimeout: <?php echo esc_js( (int) $kowloonbay_redux_opts['duration_carousel_multiple_items_autoplay_timeout'] ); ?>,
			durationCarouselRelatedItemsAutoplayTimeout: <?php echo esc_js( (int) $kowloonbay_redux_opts['duration_carousel_related_items_autoplay_timeout'] ); ?>,
			durationCarouselBlogGalleryAutoplayTimeout: <?php echo esc_js( (int) $kowloonbay_redux_opts['duration_carousel_blog_gallery_autoplay_timeout'] ); ?>,

			styled: <?php echo esc_js($kowloonbay_redux_opts["google_maps_styled"] === '1' ? 'true' : 'false'); ?>,
			latitude: <?php echo esc_js( floatval($kowloonbay_redux_opts["google_maps_lat"]) );?>,
			longitude: <?php echo esc_js( floatval($kowloonbay_redux_opts["google_maps_long"]) );?>,
			zoom: <?php echo esc_js( floatval($kowloonbay_redux_opts["google_maps_zoom"]) );?>,
			gamma: <?php echo esc_js( floatval($kowloonbay_redux_opts["google_maps_gamma"]) );?>,
			saturation: <?php echo esc_js( floatval($kowloonbay_redux_opts["google_maps_saturation"]) );?>,
			lightness: <?php echo esc_js( floatval($kowloonbay_redux_opts["google_maps_lightness"]) );?>,
			invertLightness: <?php echo esc_js( $kowloonbay_redux_opts["google_maps_invert_lightness"] );?>,
			infoWindowContentString:<?php echo stripslashes( esc_js( htmlentities($kowloonbay_redux_opts["google_maps_info_window_content_string"]) ) );?>,
			disableDefaultUI: <?php echo esc_js( $kowloonbay_redux_opts["google_maps_disable_default_ui"] );?>,
			scrollwheel: <?php echo esc_js( $kowloonbay_redux_opts["google_maps_scrollwheel"] );?>,
			markerIcon: '<?php
				echo esc_js( esc_url(
					kowloonbay_redux_img_exists( $kowloonbay_redux_opts["google_maps_marker_icon"]) ?
						$kowloonbay_redux_opts["google_maps_marker_icon"]["url"]:
						''
					) );
				?>',
			markerAnimation: '<?php echo esc_js( $kowloonbay_redux_opts["google_maps_marker_animation"] );?>'
		};

		if (param.animationPortfolioSlider === 'default-animation'){
			param.animationPortfolioSlider = '';
		}

		param.customJS = function() {};

		KowloonBaySetup(jQuery, param);
	</script>

	<?php if ( trim($kowloonbay_redux_opts["general_google_analytics_tracking_id"]) !== '' ): ?>
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', '<?php echo esc_js(trim($kowloonbay_redux_opts["general_google_analytics_tracking_id"])); ?>', 'auto');
		ga('send', 'pageview');
	</script>
	<?php endif; ?>

	<?php
	endif;
}


/* WordPress admin bar: remove offset */
add_action('get_header', 'kowloonbay_filter_head');
function kowloonbay_filter_head() {
	remove_action('wp_head', '_admin_bar_bump_cb');
}


/* Disable WordPress visual editor */
add_filter( 'user_can_richedit', 'kowloonbay_user_can_richedit');
function kowloonbay_user_can_richedit($c) {
	global $kowloonbay_redux_opts;
	global $post_type;
	
	if ($kowloonbay_redux_opts['general_disable_visual_editor'] !== '1') return $c;

	switch ($post_type) {
		case 'kowloonbay_portfolio':
		case 'kowloonbay_team':
		case 'kowloonbay_service':
		case 'kowloonbay_tmnl':
		case 'kowloonbay_faq':
		case 'post':
		case 'page':
			return false;
		default:
			return $c;
	}
}


/* TinyMCE setup */
function kowloonbay_override_mce_options($initArray) {
	$opts = '*[*]';
	$initArray['valid_elements'] = $opts;
	$initArray['extended_valid_elements'] = $opts;
	return $initArray;
}
add_filter('tiny_mce_before_init', 'kowloonbay_override_mce_options');


/* WordPress Theme Support */
add_theme_support( 'custom-background' );
add_theme_support( 'custom-header' );
add_theme_support( 'post-thumbnails', array( 'post' ) ); 
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'html5', array( 'search-form' ) );
if ( ! isset( $content_width ) ) $content_width = 900;
add_theme_support( 'post-formats', array( 'link', 'gallery', 'image', 'quote', 'status', 'video', 'audio' ) );


/* TGM */
require_once('inc/tgm.php');
