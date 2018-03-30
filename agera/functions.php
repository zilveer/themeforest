<?php

define('MPC_THEME_ROOT', get_template_directory_uri());

global $shortname;
global $mp_option;

$shortname = "agera";


/* Enable the shortcodes to work in sidebar */
add_filter('widget_text', 'do_shortcode');


/*-----------------------------------------------------------------------------------*/
/*	Setup Theme
/*-----------------------------------------------------------------------------------*/

function agera_setup(){
	//flush_rewrite_rules();

	if ( ! isset( $content_width ) ) $content_width = 960;
	/*-----------------------------------------------------------------------------------*/
	/*	Hook MPC Shortcode button & Shortcodes Source
	/*-----------------------------------------------------------------------------------*/

	require_once (TEMPLATEPATH . '/tinymce/tinymce-settings.php');
	require_once (TEMPLATEPATH . '/functions/theme-shortcodes.php');

	/*--------------------------- END Shortcodes Hook  -------------------------------- */

	/*-----------------------------------------------------------------------------------*/
	/*	Setup image sizes
	/*-----------------------------------------------------------------------------------*/

	if (function_exists('add_theme_support')) {
		add_theme_support( 'automatic-feed-links');
		add_theme_support('post-thumbnails');
		add_image_size('portfolio-full', 500, 330, true);
		add_image_size('blog_post_thumb', 410, 1000, false);
	}
}

add_action( 'after_setup_theme', 'agera_setup' );

/*--------------------------- END Setup Theme -------------------------------- */

/*-----------------------------------------------------------------------------------*/
/*	Admin Styles
/*-----------------------------------------------------------------------------------*/

function agera_add_init() {
	if ( is_admin() ) {
		wp_enqueue_style("functions", MPC_THEME_ROOT."/css/admin.css");
	}
}

add_action( 'admin_print_styles', 'agera_add_init' );

/*-----------------------------------------------------------------------------------*/
/*	Location Files / Language Files
/*-----------------------------------------------------------------------------------*/

load_theme_textdomain( 'agera', TEMPLATEPATH.'/languages' );

$locale = get_locale();
$locale_file = MPC_THEME_ROOT."/languages/$locale.php";
if ( is_readable($locale_file) )
	require_once($locale_file);

/*-----------------------------------------------------------------------------------*/
/*	Register Menu
/*-----------------------------------------------------------------------------------*/

if ( function_exists( 'register_nav_menus' ) ) {
	register_nav_menus(
		array(
		  'main' => 'Main Navigation Menu',
		)
	);
}

function main_menu() {
	echo '<div id="top_menu" class="right nav_menu"><ul class="dropmenu">';
	wp_list_pages('sort_column=menu_order&title_li=');
	echo '<li class="clear"></li></ul></div>';
}


/*-----------------------------------------------------------------------------------*/
/*	Add CSS & JS
/*-----------------------------------------------------------------------------------*/

function agera_enqueue_scripts() {
	wp_enqueue_style('mpc-reset-styles', MPC_THEME_ROOT.'/css/reset.css');
	wp_enqueue_style('mpc-agera-styles', MPC_THEME_ROOT.'/style.css');
	wp_enqueue_style('mpc-shortcodes-styles', MPC_THEME_ROOT.'/css/shortcodes-styles.css');
	wp_enqueue_style('flex-slider', MPC_THEME_ROOT.'/css/flexslider.css');
	wp_enqueue_style('fancybox', MPC_THEME_ROOT.'/css/fancybox.css');

	wp_enqueue_script('custom-shortcodes', MPC_THEME_ROOT.'/js/shortcodes.js', array('jquery'));
	wp_enqueue_script('js-functions', MPC_THEME_ROOT.'/js/functions.js', array('jquery'));
	wp_enqueue_script('cufon', MPC_THEME_ROOT.'/js/cufon.js', array('jquery'));
	wp_enqueue_script('jquery-colors', MPC_THEME_ROOT.'/js/jquery.color.js', array('jquery'));
	wp_enqueue_script('jquery-quicksand', MPC_THEME_ROOT.'/js/jquery.quicksand.js', array('jquery'));
	wp_enqueue_script('jquery-validate', MPC_THEME_ROOT.'/js/jquery.validate.min.js', array('jquery'));
	wp_enqueue_script('jquery-shadow', MPC_THEME_ROOT.'/js/jquery.shadow-animate.js', array('jquery'));
	wp_enqueue_script('font-helve', MPC_THEME_ROOT.'/js/helvetica.js');
	wp_enqueue_script('font-helveL', MPC_THEME_ROOT.'/js/helveticaLight.js');
	wp_enqueue_script('mpc-portfolio', MPC_THEME_ROOT.'/js/mpc-portfolio.js');
	wp_enqueue_script('jquery-flexslider', MPC_THEME_ROOT.'/js/jquery.flexslider-min.js');
	wp_enqueue_script('jquery-isotope', MPC_THEME_ROOT.'/js/jquery.isotope.min.js', array('jquery'));
	wp_enqueue_script('easing-jquery', MPC_THEME_ROOT.'/js/easing-jquery.js', array('jquery'));
	wp_enqueue_script('mousewheel-jquery', MPC_THEME_ROOT.'/js/jquery.mousewheel.pack.js', array('jquery'));
	wp_enqueue_script('fancybox-jquery', MPC_THEME_ROOT.'/js/jquery.fancybox.js', array('jquery'));
}

add_action('wp_enqueue_scripts', 'agera_enqueue_scripts');


remove_action( 'wp_head', 'rsd_link' );

function agera_add_my_head() {

?>
	<meta http-equiv="Content-Type" charset="<?php bloginfo('charset'); ?>" content="<?php bloginfo('html_type'); ?>"/>
	<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />
	<title>
	<?php bloginfo('name'); ?>
	<?php wp_title(); ?>
	</title>

	<link rel="shortcut icon" href="<?php echo MPC_THEME_ROOT ?>/images/favicon.ico" />

	<!--[if lte IE 8 ]>
		<link rel="stylesheet" href="<?php echo MPC_THEME_ROOT ?>/css/ie8.css"/>
	<![endif]-->

	<!--[if lte IE 7 ]>
		<script src"http://ie7-js.googlecode.com/svn/version/2.0(beta3)/IE8.js" type="text/javascript"></script>
		<link rel="stylesheet" href="<?php echo MPC_THEME_ROOT ?>/css/ie7.css"/>
	<![endif]-->
	<!--[if lt IE 9]>
		<script src="<?php echo MPC_THEME_ROOT ?>/js/html5.js" type="text/javascript"></script>
	<![endif]-->
	<!--[if IE]>
		<link rel="stylesheet" href="<?php echo MPC_THEME_ROOT ?>/css/ie.css"/>
	<![endif]-->



<script type="text/javascript">
		<?php global $mp_option; ?>
		jQuery(document).ready(function($) {

			$.validator.addMethod("notEqual", function(value, element, param) {
				if(element.value == param)
					return false;
				else if(element.text == param)
					return false;
				else
					return true;
			}, "Please input value!");

			$.validator.addMethod("notEqual", function(value, element, param) {
				return value !== param;
			}, "Please input value!");

			/* Validation for comment form */
			$('#commentform').validate({
				rules: {
					author: {
						required: true,
						minlength: 2,
						notEqual: 'Name *'
					},

					email: {
						required: true,
						email: true,
						notEqual: 'Email *'
					},

					comment: {
						required: true,
						minlength: 5,
						notEqual: 'Message *'
					}
				},

				messages: {
					author: "<?php echo $mp_option['agera_comment_name_error']; ?>",
					email: "<?php echo $mp_option['agera_comment_email_error']; ?>",
					comment: "<?php echo $mp_option['agera_comment_comment_error']; ?>"
				}
			});
		});
	</script>



	<style type="text/css">

		<?php global $shortname;
			  global $mp_option ?>

		/* Body Text Color */
		body {
			color: <?php echo $mp_option[$shortname.'_body_color']; ?>;
		}

		.meta-content a,
		.meta-content .zilla-likes-count,
		#commentform .logged-in-as a,
		.comments_author,
		.comments_author a,
		.comment_date,
		.comment_date a,
		.mpc-comments-nav a,
		.list a {
			color: <?php echo $mp_option[$shortname.'_body_color']; ?>!important;
		}

		#commentform .logged-in-as a:hover,
		.tabs_title.active a {
			color: <?php echo $mp_option[$shortname.'_active_color']; ?>!important;
		}

		.zilla-likes-count,
		.blog-post small a,
		.blog-post small {
			color: <?php echo $mp_option[$shortname.'_body_color']; ?>!important;
		}

		/* headings color */
		.tabs ul li a,
		h1, h2, h3, h4, h5,
		.mpc-page-title a {
			color: <?php echo $mp_option[$shortname.'_heading_color']; ?>!important;
		}

		/* Header Background */
		#header-container {
			background: <?php echo $mp_option[$shortname.'_bg_header_color']; ?>;
		}

		/* Footer Background */
		#agera_footer {
			background: <?php echo $mp_option[$shortname.'_bg_footer_color']; ?>;
		}

		/* Main Background */
		body,
		.page-content,
		.tab_content,
		.post-content {
			background-color: <?php echo $mp_option[$shortname.'_bg_color']; ?>!important;
		}

		/* Post Background */
		.blog-post .post-content-wrap {
			background: <?php echo $mp_option[$shortname.'_bg_color']; ?>!important;
		}

		/* Portfolio Filter Background */
		.mpc-portfolio-categories {
			background: <?php echo $mp_option[$shortname.'_bg_folio_color']; ?>!important;
		}

		/*Hr Line color */
		h2.mpc-post-title,
		h2.mpc-page-title {
			border-bottom: 1px solid <?php echo $mp_option[$shortname.'_hr_color']; ?>!important;
		}

		hr {
			background-color: <?php echo $mp_option[$shortname.'_hr_color']; ?>!important;
		}

		/* Footer Button Color */
		.mpc-footer-ribbon {
			background: <?php echo $mp_option[$shortname.'_bg_footer_color']; ?>!important;
		}

		/* Post Meta Aside Color */
		.post-meta {
			background: <?php echo $mp_option[$shortname.'_bg_meta_color']; ?>!important;
		}

		/* Contact Form & Comments Background */
		#respond input,
		#respond textarea,
		#contact_form input,
		#contact_form textarea {
			background: <?php echo $mp_option[$shortname.'_bg_contact_color']; ?>!important;
		}

		/* Contact Form & Comments Background on focus */
		#respond input:focus,
		#respond textarea:focus,
		#contact_form input:focus,
		#contact_form textarea:focus {
			background: <?php echo $mp_option[$shortname.'_bg_contact_focus_color']; ?>!important;
		}

		/* Contact Form & Comments Background on error */
		#respond input.error,
		#respond textarea.error,
		#contact_form input.error,
		#contact_form textarea.error {
			background: <?php echo $mp_option[$shortname.'_bg_contact_error_color']; ?>!important;
		}

		/* Contact Form & Comments Label on error */
		#respond label.error,
		#contact_form label.error {
			color: <?php echo $mp_option[$shortname.'_bg_contact_labels_error_color']; ?>!important;
		}

		/* Contact Form & Comments Text on error */
		#respond .comment-from-who input.error,
		#respond textarea.error,
		#contact_form .comment-from-who input.error,
		#contact_form textarea.error {
			color: <?php echo $mp_option[$shortname.'_contact_error_color']; ?>!important;
		}

		/* Submit Button Background & color */
		input#submit {
			background: <?php echo $mp_option[$shortname.'_bg_contact_submit']; ?>!important;
			color: <?php echo $mp_option[$shortname.'_color_contact_submit']; ?>!important;
		}

		/* Submit Button Background & color Hover */
		input#submit:hover {
			background: <?php echo $mp_option[$shortname.'_bg_contact_submit_hover']; ?>!important;
			color: <?php echo $mp_option[$shortname.'_color_contact_submit_hover']; ?>!important;
		}

		/*-----------------------------------------------------------------------------------*/
		/*	Font Color
		/*-----------------------------------------------------------------------------------*/

		/* Form Text Color */
		#contact_form textarea,
		#contact_form .comment-from-who input,
		#respond textarea,
		#respond .comment-from-who input {
			color: <?php echo $mp_option[$shortname.'_text_contact_color']; ?>!important;
		}

		/* Menu Font Color */
		div.mpc-portfolio-categories ul li a,
		ul#nav li a,
		#slogan .agera_text_logo a {
			color: <?php echo $mp_option[$shortname.'_menu_color']; ?>;
		}


		/* Post Meta Heading color */
		aside.post-meta div.meta-content ul li em {
			color: <?php echo $mp_option[$shortname.'_meta_heading_color']; ?>;
		}

		/* Main Active Color */
		ul#nav > li > a:hover,
		ul#nav > li.current-menu-item > a,
		div.mpc-portfolio-categories ul li.active a,
		div.mpc-portfolio-categories ul li a:hover  {
			background: <?php echo $mp_option[$shortname.'_active_color']; ?>;
		}

		.tabs ul li a:hover,
		.comment_meta .author,
		#cancel-comment-reply-link,
		ul#nav ul.sub-menu li a:hover,
		a:hover {
			color: <?php echo $mp_option[$shortname.'_active_color']; ?>!important;
		}

		.blog-post small a:hover {
			color: <?php echo $mp_option[$shortname.'_body_color']; ?>!important;
		}
		.blog-post .mpc-post-content a {
			color: <?php echo $mp_option[$shortname.'_active_color']; ?>!important;
		}

		/* Button Hover Contrast Font Color */
		ul#nav > li.current-menu-item > a,
		ul#nav > li > a:hover,
		div.mpc-portfolio-categories ul li.active a,
		div.mpc-portfolio-categories ul li a:hover {
			color: <?php echo $mp_option[$shortname.'_menu_selected_color']; ?>!important;
		}

		/* Portfolio Back Font Color */
		.mpc-card .zilla-likes-count,
		.mpc-card .face.back h2,
		div.portfolio.flip .mpc-card .face.back {
			color: <?php echo $mp_option[$shortname.'_back_folio_color']; ?>!important;
		}

		/* Highlight Color Setting */

		::-moz-selection {
			background: <?php echo $mp_option[$shortname.'_highlight_color']; ?>;
			color: <?php echo $mp_option[$shortname.'_highlight_text_color']; ?>;
		}

		::selection {
			background: <?php echo $mp_option[$shortname.'_highlight_color']; ?>;
			color: <?php echo $mp_option[$shortname.'_highlight_text_color']; ?>;
		}


		.search::-moz-selection {
			background: <?php echo $mp_option[$shortname.'_highlight_color']; ?>;
			color: <?php echo $mp_option[$shortname.'_highlight_text_color']; ?>;
		}

		<?php if($mp_option[$shortname.'_footer'] == "1") { ?>
			#agera_footer {
				left: 0px;
				visibility: visible;
			}

			.mpc-footer-ribbon .plus { opacity: 0; }
			.mpc-footer-ribbon .minus { opacity: 1; }

		<?php } ?>

	</style>

	<?php
}

add_action('wp_head', 'agera_add_my_head');

/*-----------------------------------------------------------------------------------*/
/*	Register Portfolio Post Type
/*-----------------------------------------------------------------------------------*/

function agera_create_portfolio() {

	register_taxonomy('portfolio_cat','portfolio', array(
		'hierarchical' => true,
		'show_ui' => true,
		'query_var' => true,
	)); // add unique categories to portfolio section

	$portfolio_args = array(
			'label' => __('Portfolio', 'agera'),
			'singular_label' => __('Portfolio', 'agera'),
			'public' => true,
			'show_ui' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => true,
			'supports' => array('title', 'editor', 'thumbnail', 'comments'),
			'taxonomies' => array('post_tag')
	);

	register_post_type('portfolio', $portfolio_args);
}

add_action('init', 'agera_create_portfolio');


/*-----------------------------------------------------------------------------------*/
/*	Hook Massive Panel & Get Options
/*-----------------------------------------------------------------------------------*/

if(is_admin()) {
		require_once('massive-panel/theme-settings.php');
}

function agera_get_global_options() {
	global $shortname;
	$mp_option = array();
	$mp_option = get_option($shortname.'_options');

	return $mp_option;
}

$mp_option = agera_get_global_options();

/*-----------------------------------------------------------------------------------*/
/*	Search Form
/*-----------------------------------------------------------------------------------*/

function agera_add_search_form() { ?>
	<form role="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" >
		<div>
			<input type="text" value="" name="s" id="s" class="search" />
			<input type="submit" id="searchsubmit" value="GO" />
		</div>
	</form>
	<?php
}

/*-----------------------------------------------------------------------------------*/
/*	Search Filter - display only posts
/*-----------------------------------------------------------------------------------*/

function agera_search_filter($query) {
	if ($query->is_search)
		{$query->set('post_type', 'post');}
	return $query;
}

add_filter('pre_get_posts','agera_search_filter');

/*-----------------------------------------------------------------------------------*/
/*	Portfolio Setup - columns width, excerpt length ect.
/*-----------------------------------------------------------------------------------*/

function agera_portfolio_columns($type, $page_data) {
	global $mp_option;
	global $shortname;

	if (has_post_thumbnail()) {
	?>
		<div class="portfolio-item-thumb">
			<div class="mpc-card">
				<div class="front face">
					<?php the_post_thumbnail( $type ); ?>
				</div>
				<div class="back face" style="background: <?php echo $page_data['background']; ?> ;">
					<img class="mpc-viniet" src="<?php echo MPC_THEME_ROOT; ?>/images/viniet.png"/>
					<a href="<?php the_permalink(); ?>" class="post-link-layer"></a>
					<a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
					<!-- Remove shortcodes from excerpts -->
					<p class="mpc-excerpt"><?php echo preg_replace('|\[(.+?)\](.+?\[/\\1\])?|s', '', agera_my_excerpt(get_the_content(''), 160));?></p>
					<div class="post-excerpt-hidder" style="background: <?php echo $page_data['background']; ?> ;"></div>
					<?php if( function_exists('zilla_likes') ) zilla_likes(); ?>

					<?php if(isset($page_data['lightbox']) && $page_data['lightbox']) {
						$type = '';
						$asset = $page_data['lightbox_src'];
						$search = preg_match('/.(jpg|JPG|jpeg|JPEG|gif|GIF|png)/', $asset);
						if($search == 1) {
							$type = 'mpc-image';
							$search = 0;
						}

						$search = preg_match('/.(vimeo)./', $asset);

						if($search == 1) {
							$type = 'mpc-vimeo-video';
							$search = 0;
						}

						$search = preg_match('/.(youtube)/', $asset);

						if($search == 1) {
							$type = 'mpc-youtube-video';
							$search = 0;
						}

						$search = preg_match('/.(swf|SWF)/', $asset);
						if($search == 1) {
							$type = 'mpc-swf';
							$search = 0;
						}

						if($type == '') {
							$type = 'mpc-iframe';
						}

						?>

						<a class="mpc-fancybox <?php echo $type; ?>" rel="<?php echo $page_data['gallery']; ?>" href="<?php echo $page_data['lightbox_src']; ?>" title="<?php echo $page_data['caption']; ?>"></a>
					<?php } ?>

					<a class="view-details" href="<?php the_permalink(); ?>"></a>
				</div>
			</div>
		</div><!-- portfolio_item_thumb -->
	<?php }
}

/*-----------------------------------------------------------------------------------*/
/*	Triming the excerpt
/*-----------------------------------------------------------------------------------*/

function agera_my_excerpt($string, $word_limit) {
	$words = explode(' ', $string, ($word_limit + 1));
	if (count($words) > $word_limit)
		array_pop($words);
	return strip_tags(implode(' ', $words) . '...');
}

/*-----------------------------------------------------------------------------------*/
/*	Add site logo
/*-----------------------------------------------------------------------------------*/

function agera_add_logo() {
	global $mp_option;
	global $shortname;

	if ( isset( $mp_option[$shortname.'_logo_link_checkbox'] ) && !empty( $mp_option[$shortname.'_logo_link_checkbox'] ) ) :
	?>
		<h1 class="agera_text_logo"><a href="<?php bloginfo( 'url' ); ?>"><?php echo $mp_option[$shortname.'_logo_link']; ?></a></h1>
	<?php
	elseif ( isset( $mp_option[$shortname.'_image_logo_checkbox'] ) &&  !empty( $mp_option[$shortname.'_image_logo_checkbox'] ) ) :
	?>
		<h1 class="agera_image_logo"><a href="<?php bloginfo( 'url' ); ?>"><img src="<?php echo $mp_option[$shortname.'_image_logo']; ?>"/></a></h1>
	<?php
	endif;
}

/*-----------------------------------------------------------------------------------*/
/*	List Comments
/*-----------------------------------------------------------------------------------*/

function comments_all($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>


	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<span class="comment-line"></span>
		<?php if(get_comment_author_email() == get_the_author_meta('email')){
			$author = "comment_author";
		} else {
			$author ="";
		}?>

		<div id="comment-<?php comment_ID(); ?>" class="comments_holder comment_line <?php echo $author; ?>" >
			<div class="comment-author vcard">
				<div class="agera_comment_gravatar">
					<?php echo get_avatar(get_comment_author_email(), $size ='55'); ?>

				</div>
			<div class="comment_meta">
				<?php if($author == "comment_author") { ?>
					<span class="comment_author">
						<?php printf(__('<h4 class="comments_author"> %s</h4>', 'agera'), get_comment_author_link()) ?>

					</span>
					<p class="comment_date"><time><?php printf(__('%1$s ', 'agera'),  get_comment_time('H:i F jS, Y')) ?> &middot;</time>
					<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
					&middot; <span class="author">author</span>
					</p>
				<?php } else { ?>
					<?php printf(__('<h4 class="comments_author"> %s</h4>', 'agera'), get_comment_author_link()) ?>
					<p class="comment_date">On: <time datetime="2011-04-26"><?php printf(__('%1$s ', 'agera'),  get_comment_time('H:i F jS, Y')) ?> &middot;</time>
					<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
					</p>
				<?php } ?>
			</div>
			<div class="agera_message">
				<?php comment_text() ?>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<?php
}


/*-----------------------------------------------------------------------------------*/
/*	Change excerpt leght
/*-----------------------------------------------------------------------------------*/

function agera_new_excerpt_length($length) {
	if(is_page()) {
		return 30;
	} else {
		return 38;
	}
}

add_filter('excerpt_length', 'agera_new_excerpt_length');

/*-----------------------------------------------------------------------------------*/
/*	Add custom Meta Box to Pages
/*-----------------------------------------------------------------------------------*/

// add meta boxes
function add_pages_meta_box() {
	$post_id = '';

	if(isset($_GET['post']))
		$post_id =  $_GET['post'];
	elseif(isset($_POST['post_ID']))
		$post_id = $_POST['post_ID'];

	$template_file = get_post_meta($post_id, '_wp_page_template',TRUE);

	add_meta_box( 'portfolio-project', 'Project Settings', 'portfolio_meta_box', 'portfolio', 'normal');

	if($template_file != 'portfolio.php' && $template_file != 'portfolio-no-flip.php' && $template_file != 'gallery.php') {
		if ($template_file != 'full-width.php')
			add_meta_box( 'pages-settings', 'Page Settings', 'page_meta_box', 'page', 'normal');
		else
			add_meta_box( 'full-width-settings', 'Page Settings', 'full_meta_box', 'page', 'normal');
	}

	add_meta_box( 'post-settings', 'Post Settings', 'post_meta_box', 'post', 'normal');

	if ($template_file == 'portfolio.php' || $template_file == 'portfolio-no-flip.php')
		add_meta_box( 'portfolio-page-settings', 'Portfolio Settings', 'portfolio_page_meta_box', 'page', 'normal');
}

add_action( 'add_meta_boxes', 'add_pages_meta_box' );

/* Meta box for portfolio settings */
function portfolio_meta_box($post) {

	wp_nonce_field( 'my_portfolio_meta_box_nonce', 'portfolio_meta_box_nonce');

	$values = get_post_custom($post->ID);

	if(isset( $values['project_background'] ))
		$project_background =  esc_attr( $values['project_background'][0] );
	else
		$project_background = "#F9625B";

	if(isset( $values['full_width_asset'] ))
		$full_width_asset =  esc_attr( $values['full_width_asset'][0] );
	else
		$full_width_asset = '';

	if(isset( $values['client'] ))
		$client =  esc_attr( $values['client'][0] );
	else
		$client = "";

	if(isset( $values['tools'] ))
		$tools =  esc_attr( $values['tools'][0] );
	else
		$tools = "";

	if(isset( $values['copyright'] ))
		$copyright =  esc_attr( $values['copyright'][0] );
	else
		$copyright = "";

	if(isset( $values['share'] ))
		$share =  esc_attr( $values['share'][0] );
	else
		$share = "on";

	if(isset($values['lightbox_enable'] ))
		$lightbox_enable =  esc_attr( $values['lightbox_enable'][0] );
	else
		$lightbox_enable = "off";

	$share = checked($share, 'on', false);
	$lightbox_enable = checked($lightbox_enable, 'on', false);

	if(isset( $values['caption'] ))
		$caption =  esc_attr( $values['caption'][0] );
	else
		$caption = "";

	if(isset( $values['lightbox_src'] ))
		$lightbox_src =  esc_attr( $values['lightbox_src'][0] );
	else
		$lightbox_src = "";

	$box_output = '';

	$box_output .= '<label for="project_background">Project Background</label> ';
	$box_output .= '<input type="text" name="project_background" id="project_background" value="'.$project_background.'"/></br>';

	$box_output .= '<label for="client">Project Client</label> ';
	$box_output .= '<input type="text" name="client" id="client" value="'.$client.'"/></br>';

	$box_output .= '<label for="tools">Tools Used</label> ';
	$box_output .= '<input type="text" name="tools" id="tools" value="'.$tools.'"/></br>';

	$box_output .= '<label for="copyright">Artwork By</label> ';
	$box_output .= '<input type="text" name="copyright" id="copyright" value="'.$copyright.'"/></br>';

	$box_output .= '<label for="share">Share</label> ';
	$box_output .= '<input type="checkbox" id="share" name="share"'.$share.'/></br>';

	$box_output .= '<label for="full_width_asset">Full Width Asset:</label></br> ';
	$box_output .= '<textarea type="text" name="full_width_asset" id="full_width_asset" style="width: 100%; height: 200px;">'.$full_width_asset.'</textarea></br>';

	$box_output .= '<label for="lightbox_enable">Enable Lightbox</label> ';
	$box_output .= '<input type="checkbox" id="lightbox_enable" name="lightbox_enable"'.$lightbox_enable.'/></br>';

	$box_output .= '<label for="caption">Lightbox Caption</label> ';
	$box_output .= '<input type="text" name="caption" id="caption" value="'.$caption.'"/></br>';

	$box_output .= '<label for="lightbox_src">Lightbox Source</label> ';
	$box_output .= '<input type="text" name="lightbox_src" id="lightbox_src" value="'.$lightbox_src.'"/></br>';

	echo $box_output;
}

function portfolio_page_meta_box($post) {

	wp_nonce_field( 'my_portfolio_page_meta_box_nonce', 'portfolio_page_meta_box_nonce');

	$values = get_post_custom($post->ID);

	if(isset( $values['big_portfolio'] ))
		$big_portfolio = esc_attr( $values['big_portfolio'][0] );
	else
		$big_portfolio = 'off';

	$big_portfolio = checked($big_portfolio, 'on', false);

	if(isset( $values['item_number'] ))
		$item_number = esc_attr( $values['item_number'][0] );
	else
		$item_number = '10';

	$box_output = '';

	$box_output .= '<label for="big_portfolio">Big Portfolio</label> ';
	$box_output .= '<input type="checkbox" name="big_portfolio" id="big_portfolio" '.$big_portfolio.'/></br>';

	$box_output .= '<label for="item_number">How Many Items To Show</label> ';
	$box_output .= '<input type="text" name="item_number" id="item_number" value="'.$item_number.'"/></br>';

	echo $box_output;
}

function page_meta_box($post) {

	wp_nonce_field( 'my_page_meta_box_nonce', 'page_meta_box_nonce');

	$values = get_post_custom($post->ID);

	if(isset( $values['page_background'] ))
		$page_background =  esc_attr( $values['page_background'][0] );
	else
		$page_background = "";

	$box_output = '';

	$box_output .= '<label for="page_background">Page Background</label> ';
	$box_output .= '<input type="text" name="page_background" id="page_background" value="'.$page_background.'"/></br>';

	echo $box_output;
}

function post_meta_box($post) {

	wp_nonce_field( 'my_post_meta_box_nonce', 'post_meta_box_nonce');

	$values = get_post_custom($post->ID);

	if(isset( $values['full_width_asset'] ))
		$full_width_asset =  esc_attr( $values['full_width_asset'][0] );
	else
		$full_width_asset = '';

	if(isset( $values['share'] ))
		$share =  esc_attr( $values['share'][0] );
	else
		$share = "on";

	$share = checked($share, 'on', false);

	$box_output = '';

	$box_output .= '<label for="share">Share</label> ';
	$box_output .= '<input type="checkbox" id="share" name="share"'.$share.'/></br>';

	$box_output .= '<label for="full_width_asset">Full Width Asset:</label></br> ';
	$box_output .= '<textarea type="text" name="full_width_asset" id="full_width_asset" style="width: 100%; height: 200px;">'.$full_width_asset.'</textarea></br>';

	echo $box_output;
}

function full_meta_box($post) {

	wp_nonce_field( 'my_full_meta_box_nonce', 'full_meta_box_nonce');

	$values = get_post_custom($post->ID);

	if(isset( $values['full_width_asset'] ))
		$full_width_asset =  esc_attr( $values['full_width_asset'][0] );
	else
		$full_width_asset = '';

	$box_output = '';

	$box_output .= '<label for="full_width_asset">Shortcode:</label></br> ';
	$box_output .= '<textarea type="text" name="full_width_asset" id="full_width_asset" style="width: 100%; height: 200px;">'.$full_width_asset.'</textarea></br>';

	echo $box_output;
}

function save_portfolio_meta_box($post_id) {

	// Bail if we're doing an auto save
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

	// if our nonce isn't there, or we can't verify it, bail
	if( !isset( $_POST['portfolio_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['portfolio_meta_box_nonce'], 'my_portfolio_meta_box_nonce' ) ) return;

	// if our current user can't edit this post, bail
	if( !current_user_can( 'edit_post' ) ) return;

	// now we can actually save the data
	$allowed = array(
		'a' => array( // on allow a tags
			'href' => array() // and those anchors can only have href attribute
		)
	);

	if(isset($_POST['full_width_asset']))
		update_post_meta( $post_id, 'full_width_asset', wp_kses($_POST['full_width_asset'], $allowed));

	if(isset($_POST['project_background']))
		update_post_meta( $post_id, 'project_background', wp_kses($_POST['project_background'], $allowed));

	if(isset($_POST['tools']))
		update_post_meta( $post_id, 'tools', wp_kses($_POST['tools'], $allowed));

	if(isset($_POST['copyright']))
		update_post_meta( $post_id, 'copyright', wp_kses($_POST['copyright'], $allowed));

	if(isset($_POST['client']))
		update_post_meta( $post_id, 'client', wp_kses($_POST['client'], $allowed));

	if(isset($_POST['share']) && $_POST['share'])
		$share = 'on';
	else
		$share = 'off';

	update_post_meta( $post_id, 'share', $share );

	if(isset($_POST['lightbox_enable']) && $_POST['lightbox_enable'])
		$lightbox_enable = 'on';
	else
		$lightbox_enable = 'off';

	update_post_meta( $post_id, 'lightbox_enable', $lightbox_enable);

	if(isset($_POST['caption']))
		update_post_meta( $post_id, 'caption', wp_kses($_POST['caption'], $allowed));

	if(isset($_POST['lightbox_src']))
		update_post_meta( $post_id, 'lightbox_src', wp_kses($_POST['lightbox_src'], $allowed));



}

function save_post_meta_box($post_id) {

	// Bail if we're doing an auto save
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

	// if our nonce isn't there, or we can't verify it, bail
	if( !isset( $_POST['post_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['post_meta_box_nonce'], 'my_post_meta_box_nonce' ) ) return;

	// if our current user can't edit this post, bail
	if( !current_user_can( 'edit_post' ) ) return;

	// now we can actually save the data
	$allowed = array(
		'a' => array( // on allow a tags
			'href' => array() // and those anchors can only have href attribute
		)
	);

	if(isset($_POST['full_width_asset']))
		update_post_meta( $post_id, 'full_width_asset', wp_kses($_POST['full_width_asset'], $allowed));

	if(isset($_POST['share']) && $_POST['share'])
		$share = 'on';
	else
		$share = 'off';

	update_post_meta( $post_id, 'share', $share );

}

function save_page_meta_box($post_id) {

	// Bail if we're doing an auto save
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

	// if our nonce isn't there, or we can't verify it, bail
	if( !isset( $_POST['page_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['page_meta_box_nonce'], 'my_page_meta_box_nonce' ) ) return;

	// if our current user can't edit this post, bail
	if( !current_user_can( 'edit_post' ) ) return;

	// now we can actually save the data
	$allowed = array(
		'a' => array( // on allow a tags
			'href' => array() // and those anchors can only have href attribute
		)
	);

	if(isset($_POST['page_background']))
		update_post_meta( $post_id, 'page_background', wp_kses($_POST['page_background'], $allowed));

}

function save_full_meta_box($post_id) {

	// Bail if we're doing an auto save
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

	// if our nonce isn't there, or we can't verify it, bail
	if( !isset( $_POST['full_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['full_meta_box_nonce'], 'my_full_meta_box_nonce' ) ) return;

	// if our current user can't edit this post, bail
	if( !current_user_can( 'edit_post' ) ) return;

	// now we can actually save the data
	$allowed = array(
		'a' => array( // on allow a tags
			'href' => array() // and those anchors can only have href attribute
		)
	);

	if(isset($_POST['full_width_asset']))
		update_post_meta( $post_id, 'full_width_asset', wp_kses($_POST['full_width_asset'], $allowed));

}

function save_portfolio_page_meta_box($post_id) {

	// Bail if we're doing an auto save
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

	// if our nonce isn't there, or we can't verify it, bail
	if( !isset( $_POST['portfolio_page_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['portfolio_page_meta_box_nonce'], 'my_portfolio_page_meta_box_nonce' ) ) return;

	// if our current user can't edit this post, bail
	if( !current_user_can( 'edit_post' ) ) return;

	// now we can actually save the data
	$allowed = array(
		'a' => array( // on allow a tags
			'href' => array() // and those anchors can only have href attribute
		)
	);

	if(isset($_POST['big_portfolio']) && $_POST['big_portfolio'])
		$big_portfolio = 'on';
	else
		$big_portfolio = 'off';

	update_post_meta($post_id, 'big_portfolio', $big_portfolio);

	if(isset($_POST['item_number']))
		update_post_meta($post_id, 'item_number', wp_kses($_POST['item_number'], $allowed));
}

add_action('save_post', 'save_portfolio_meta_box');
add_action('save_post', 'save_portfolio_page_meta_box');
add_action('save_post', 'save_page_meta_box');
add_action('save_post', 'save_post_meta_box');
add_action('save_post', 'save_full_meta_box');


?>