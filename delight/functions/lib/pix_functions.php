<?php
add_filter( 'show_admin_bar', '__return_false' );

/*=========================================================================================*/

load_theme_textdomain( 'delight', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

/*=========================================================================================*/

$content_width = 710;

/*=========================================================================================*/

add_action('login_head', 'my_custom_login_logo');

function my_custom_login_logo() {
    echo '<style type="text/css">
        #login h1 a { 
			background-image:url('.get_template_directory_uri().'/images/custom-login-logo.png) !important;
			background-size: 225px 128px!important;
			height:128px; background-position:center!important;
			margin-bottom:10px;
			width: 326px!important;
		}
    </style>';
}

/*=========================================================================================*/

add_action('admin_head', 'my_custom_logo');

function my_custom_logo() {
	if( get_bloginfo('version') < 3.2 ) {
		echo '
			<style type="text/css">
				 #header-logo { background-image: url('.get_template_directory_uri().'/images/custom_logo.png) !important; }
			</style>';
	} else {
		echo '
			<style type="text/css">
				 #header-logo { 
				 	background-image: url('.get_template_directory_uri().'/images/delight-icon.png) !important;
					background-position: 0 -6px;
				 }
			</style>';
	}
}

/*=========================================================================================*/

add_filter('admin_body_class', 'google_font_load', 1);

function google_font_load( $classes ) {
	global $wpdb, $post;
	$post_type = get_post_type( $post->ID );
	if ( is_admin() && get_pix_option('pix_google_prevent') != 'show' ) {
        $classes .= 'google_font_loaded';
	}
	return $classes;
}

/*=========================================================================================*/

if (function_exists('register_nav_menus')) {
	add_action( 'init', 'register_my_menus' );
	function register_my_menus() {
		register_nav_menus(
			array(
				'primary_menu' => __( 'Primary menu' ),
				'secondary_menu' => __( 'Secondary menu' )
			)
		);
	}
}

/*=========================================================================================*/

function menuCount($menu_name){
$menu_to_count = wp_nav_menu(array(
					'echo' => false,
					'theme_location' => $menu_name
				));
$menu_items = substr_count($menu_to_count,'class="menu-item ');
return $menu_items;
}
			
/*=========================================================================================*/

add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 75, 75, true ); // hard crop mode true

if ( function_exists( 'add_image_size' ) ) { 
	add_image_size('slideTh', 34, 34, true);
	add_image_size('exTh', 50, 50, true);
	add_image_size('th64', 64, 64, true);
	add_image_size('th338191', 338, 191, true);
	add_image_size('th203115', 203, 115, true);
	add_image_size('th230130', 230, 130, true);
	add_image_size('th13778', 137, 78, true);
	add_image_size('th17198', 171, 98, true);
	add_image_size('th10057', 100, 57, true);
	add_image_size('th14280', 142, 80, true);
	add_image_size('th8548', 85, 48, true);
	add_image_size('wideCol', 708, 0, true);
	add_image_size('narrowCol', 427, 0, true);
	add_image_size('wideCol43', 708, 399, true);
	add_image_size('narrowCol43', 427, 240, true);
	add_image_size('floatPort', 350, 350, false);
}

/*=========================================================================================*/

/*=========================================================================================*/

if ( !function_exists('fb_AddThumbColumn') && function_exists('add_theme_support') ) {
 
	function fb_AddThumbColumn($cols) { 
		$cols['description'] = __('Description');
		$cols['thumbnail'] = __('Thumbnail'); 
		$cols['galleries'] = __('Galleries'); 
		return $cols;
	}
 
	function fb_AddThumbValue($column_name, $post_id) {
		
			$width = (int) 75;
			$height = (int) 75;
 
 
			if ( 'thumbnail' == $column_name ) {
				$thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
				$attachments = get_children( array('post_parent' => $post_id, 'post_type' => 'attachment', 'post_mime_type' => 'image') );
				if ($thumbnail_id)
					$thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
				elseif ($attachments) {
					foreach ( $attachments as $attachment_id => $attachment ) {
						$thumb = wp_get_attachment_image( $attachment_id, array($width, $height), true );
					}
				}
					if ( isset($thumb) && $thumb ) {
						echo $thumb;
					} else {
						echo __('None');
					}
			}
			
		
			if ( 'description' == $column_name ) {
				echo get_the_excerpt();
			}

			if ( 'galleries' == $column_name ) {
				$_taxonomy = 'gallery';
				$categories = get_the_terms( $post_id, $_taxonomy );
				if ( !empty( $categories ) ) {
					$out = array();
					foreach ( $categories as $c )
						$out[] = "<a href='edit.php?gallery=$c->term_id&post_type=portfolio'> " . esc_html(sanitize_term_field('name', $c->name, $c->term_id, 'category', 'display')) . "</a>";
					echo join( ', ', $out );
				}
				else {
					_e('Uncategorized');
				}
			}
	}
 
	add_filter( 'manage_posts_columns', 'fb_AddThumbColumn' );
	add_action( 'manage_posts_custom_column', 'fb_AddThumbValue', 10, 2 );
 
}

/*=========================================================================================*/

function get_content($url)
{
    $ch = curl_init();

    curl_setopt ($ch, CURLOPT_URL, $url);
    curl_setopt ($ch, CURLOPT_HEADER, 0);

    ob_start();

    curl_exec ($ch);
    curl_close ($ch);
    $string = ob_get_contents();

    ob_end_clean();
   
    return $string;    
}
			
/*=========================================================================================*/

function pix_admin_styles() {
	wp_enqueue_style('thickbox');
	wp_enqueue_style( 'farbtastic' );
	if(get_pix_option('pix_google_prevent') != 'show') { wp_enqueue_style("lobster", "http://fonts.googleapis.com/css?family=Lobster", false, "1.0", "all"); }
	if(get_pix_option('pix_google_prevent') != 'show') { wp_enqueue_style("cabin", "http://fonts.googleapis.com/css?family=Cabin", false, "1.0", "all"); }
	if ( $pagenow != 'index.php' ) {
		wp_enqueue_style ('wp-jquery-ui-dialog');
	}
	wp_enqueue_style("functions", get_template_directory_uri()."/functions/css/functions.css", false, "1.0", "all");
}
add_action('admin_print_styles', 'pix_admin_styles');

/*=========================================================================================*/

function addTinyMCELinkClasses( $wp ) {
	$wp .= ',' . get_template_directory_uri() . '/functions/css/tinymce.css';
	return $wp;
}

add_filter( 'mce_css', 'addTinyMCELinkClasses' );
			
/*=========================================================================================*/

add_action( 'admin_head', 'html5_comp' );
function html5_comp() {
    echo '<!--[if lt IE 9]>
    <script src="'.get_template_directory_uri().'/scripts/html5.js"></script>
    <![endif]-->';
}


			
/*=========================================================================================*/

add_action( 'admin_head', 'template_path' );
function template_path() {
    echo '<link id="template_path" data-url="'.get_template_directory_uri().'" />';
}
			
/*=========================================================================================*/

function pix_admin_enqueue_scripts() {
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_enqueue_script( 'thickbox' );
		wp_register_script( 'pix-tb', get_template_directory_uri()."/functions/scripts/pix_thickbox.js", array('thickbox') );
		wp_enqueue_script( 'pix-tb' );
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-tabs' );
		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_script( 'farbtastic' );
		wp_enqueue_script('jquery-ui-mouse', get_template_directory_uri()."/scripts/jquery.ui.mouse.js", array('jquery-ui-core'));
		wp_enqueue_script('jquery-ui-widget', get_template_directory_uri()."/scripts/jquery.ui.widget.js", array('jquery-ui-core'));
		wp_enqueue_script('jquery-ui-slider', get_template_directory_uri()."/scripts/jquery.ui.slider.js", array('jquery-ui-core','jquery-ui-mouse','jquery-ui-widget'));
	if(isset($_GET['page']) && $_GET['page']=='admin_general'){
		wp_enqueue_script('modernizr', get_template_directory_uri()."/scripts/modernizr-1.7.min.js");
		wp_enqueue_script('jquery-cookie', get_template_directory_uri()."/functions/scripts/biscuit.js", array('jquery'));
		wp_enqueue_script('jquery-cluetip', get_template_directory_uri()."/scripts/jquery.qtip.min.js", array('jquery'));
		wp_enqueue_script("colorBox", get_template_directory_uri()."/scripts/jquery.colorbox-min.js", array('jquery'));
		if(get_pix_option('pix_google_prevent') != 'show') { wp_enqueue_script('google-font', "https://www.google.com/jsapi"); }
	}
	wp_enqueue_script('pix-scripts', get_template_directory_uri()."/functions/scripts/pix_scripts.js", array('jquery','jquery-ui-tabs', 'jquery-ui-dialog'));
}
add_action('admin_enqueue_scripts', 'pix_admin_enqueue_scripts');
			
function plugin_prevent_scripts() {
	if(isset($_GET['page']) && $_GET['page']=='admin_general'){
		wp_deregister_script( 'yak-ui' );
		wp_deregister_script( 'yak-admin-ui' );
	}
}
add_action('admin_enqueue_scripts', 'plugin_prevent_scripts');

/*=========================================================================================*/

if ( (strpos($_SERVER['SCRIPT_NAME'], 'wp-admin/admin.php'))) {
	if( get_bloginfo('version') < 3.2 ) {
		add_filter('admin_head','myplugin_tinymce');
	}
	add_filter('tiny_mce_before_init', 'remove_mce_showcase');
	add_action("admin_print_scripts", "js_libs");
}

function js_libs() {
     wp_enqueue_script('tiny_mce');
}

function myplugin_tinymce()
{
  wp_enqueue_script('common');
  wp_enqueue_script('jquery-color');
  wp_admin_css('thickbox');
  wp_print_scripts('post');
  wp_print_scripts('media-upload');
  wp_print_scripts('jquery');
  wp_print_scripts('jquery-ui-core');
  wp_print_scripts('jquery-ui-tabs');
  wp_print_scripts('tiny_mce');
  wp_print_scripts('editor');
  wp_print_scripts('editor-functions');
  add_thickbox();
  wp_tiny_mce();
  wp_admin_css();
  wp_enqueue_script('utils');
  wp_enqueue_script('link');
  do_action("admin_print_styles-post-php");
  do_action('admin_print_styles');
  remove_all_filters('mce_external_plugins');
}

function remove_mce_showcase($initArray) {
    global $post_type;
	$initArray['theme_advanced_disable'] = 'strikethrough,wp_more,spellchecker,fullscreen,underline,undo,redo,wp_help';
    return $initArray;
}

/*=========================================================================================*/

$custom_slideshow = new WPAlchemy_MetaBox(array
(
	'id' => '_custom_slideshow',
	'types' => array('page', 'post','portfolio'), 
	'title' => 'Slideshow shortcode',
	'context' => 'normal',
	'priority' => 'high',
	'template' => TEMPLATEPATH .'/custom/custom_slideshow.php'
));

$custom_googlemap = new WPAlchemy_MetaBox(array
(
	'id' => '_custom_googlemap',
	'types' => array('page', 'post','portfolio'), 
	'title' => 'Googlemap shortcode',
	'context' => 'normal',
	'priority' => 'high',
	'template' => TEMPLATEPATH .'/custom/custom_googlemap.php'
));

$custom_contactform = new WPAlchemy_MetaBox(array
(
	'id' => '_custom_contactform',
	'types' => array('page', 'post','portfolio'), 
	'title' => 'Contact form shortcode',
	'context' => 'normal',
	'priority' => 'high',
	'template' => TEMPLATEPATH .'/custom/custom_contactform.php'
));

$custom_tooltip = new WPAlchemy_MetaBox(array
(
	'id' => '_custom_tooltip',
	'types' => array('page', 'post','portfolio'), 
	'title' => 'Tooltip shortcode',
	'context' => 'normal',
	'priority' => 'high',
	'template' => TEMPLATEPATH .'/custom/custom_tooltip.php'
));

$custom_options = new WPAlchemy_MetaBox(array
(
	'id' => '_custom_options',
	'types' => array('page', 'post','portfolio'), 
	'title' => 'Page options',
	'context' => 'normal',
	'priority' => 'high',
	'template' => TEMPLATEPATH .'/custom/custom_options.php'
));

$custom_payoff = new WPAlchemy_MetaBox(array
(
	'id' => '_custom_payoff',
	'types' => array('page', 'post','portfolio'), 
	'title' => 'Custom titles',
	'context' => 'normal',
	'priority' => 'high',
	'template' => TEMPLATEPATH .'/custom/custom_payoff.php'
));

if ( get_pix_option('pix_seo_enable')=='true' ) {
	$custom_seo = new WPAlchemy_MetaBox(array
	(
		'id' => '_custom_seo',
		'types' => array('page', 'post','portfolio'), 
		'title' => 'SEO',
		'context' => 'normal',
		'priority' => 'high',
		'template' => TEMPLATEPATH .'/custom/custom_seo.php'
	));
}

$custom_destination = new WPAlchemy_MetaBox(array
(
	'id' => '_custom_destination',
	'types' => array('portfolio'), 
	'title' => 'Display a video in the gallery page',
	'context' => 'side',
	'priority' => 'low',
	'template' => TEMPLATEPATH .'/custom/custom_destination.php'
));

$custom_url = new WPAlchemy_MetaBox(array
(
	'id' => '_custom_url',
	'types' => array('portfolio'), 
	'title' => 'Point your featured image to an external URL',
	'context' => 'side',
	'priority' => 'low',
	'template' => TEMPLATEPATH .'/custom/custom_url.php'
));

$custom_video = new WPAlchemy_MetaBox(array
(
	'id' => '_custom_video',
	'types' => array('page', 'post','portfolio'), 
	'title' => 'Insert a video',
	'context' => 'normal',
	'priority' => 'high',
	'template' => TEMPLATEPATH .'/custom/custom_video.php'
));

$custom_audio = new WPAlchemy_MetaBox(array
(
	'id' => '_custom_audio',
	'types' => array('page', 'post','portfolio'), 
	'title' => 'Insert a audio',
	'context' => 'normal',
	'priority' => 'high',
	'template' => TEMPLATEPATH .'/custom/custom_audio.php'
));

$custom_accordion = new WPAlchemy_MetaBox(array
(
	'id' => '_custom_accordion',
	'types' => array('page', 'post','portfolio'), 
	'title' => 'Insert an accordion',
	'context' => 'normal',
	'priority' => 'high',
	'template' => TEMPLATEPATH .'/custom/custom_accordion.php'
));

$custom_tab = new WPAlchemy_MetaBox(array
(
	'id' => '_custom_tab',
	'types' => array('page', 'post','portfolio'), 
	'title' => 'Insert a tab',
	'context' => 'normal',
	'priority' => 'high',
	'template' => TEMPLATEPATH .'/custom/custom_tab.php'
));

$custom_columns = new WPAlchemy_MetaBox(array
(
	'id' => '_custom_columns',
	'types' => array('page', 'post','portfolio'), 
	'title' => 'Insert columns',
	'context' => 'normal',
	'priority' => 'high',
	'template' => TEMPLATEPATH .'/custom/custom_columns.php'
));

$custom_box = new WPAlchemy_MetaBox(array
(
	'id' => '_custom_box',
	'types' => array('page', 'post','portfolio'), 
	'title' => 'Insert a box',
	'context' => 'normal',
	'priority' => 'high',
	'template' => TEMPLATEPATH .'/custom/custom_box.php'
));

$custom_list = new WPAlchemy_MetaBox(array
(
	'id' => '_custom_list',
	'types' => array('page', 'post','portfolio'), 
	'title' => 'Insert a custom list',
	'context' => 'normal',
	'priority' => 'high',
	'template' => TEMPLATEPATH .'/custom/custom_list.php'
));

$custom_dropcap = new WPAlchemy_MetaBox(array
(
	'id' => '_custom_dropcap',
	'types' => array('page', 'post','portfolio'), 
	'title' => 'Insert a drop cap',
	'context' => 'normal',
	'priority' => 'high',
	'template' => TEMPLATEPATH .'/custom/custom_dropcap.php'
));

$custom_button = new WPAlchemy_MetaBox(array
(
	'id' => '_custom_button',
	'types' => array('page', 'post','portfolio'), 
	'title' => 'Insert a drop cap',
	'context' => 'normal',
	'priority' => 'high',
	'template' => TEMPLATEPATH .'/custom/custom_button.php'
));

$custom_pricetable = new WPAlchemy_MetaBox(array
(
	'id' => '_custom_pricetable',
	'types' => array('page', 'post','portfolio'), 
	'title' => 'Insert a drop cap',
	'context' => 'normal',
	'priority' => 'high',
	'template' => TEMPLATEPATH .'/custom/custom_pricetable.php'
));

$custom_span = new WPAlchemy_MetaBox(array
(
	'id' => '_custom_span',
	'types' => array('page', 'post','portfolio'), 
	'title' => 'Insert a drop cap',
	'context' => 'normal',
	'priority' => 'high',
	'template' => TEMPLATEPATH .'/custom/custom_span.php'
));

$custom_blog = new WPAlchemy_MetaBox(array
(
	'id' => '_custom_blog',
	'types' => array('page'), 
	'title' => 'Display your posts',
	'context' => 'normal',
	'priority' => 'high',
	'template' => TEMPLATEPATH .'/custom/custom_blog.php'
));

add_action('admin_print_footer_scripts','my_admin_print_footer_scripts',99);
function my_admin_print_footer_scripts()
{
	?><script type="text/javascript">/* <![CDATA[ */
		jQuery(function($)
		{
			var i=1;
			$('.customEditor textarea').each(function(e)
			{
				var id = $(this).attr('id');
 
				if (!id)
				{
					id = 'customEditor-' + i++;
					$(this).attr('id',id);
				}
 
				tinyMCE.execCommand('mceAddControl', false, id);
 
			});
		});
	/* ]]> */</script><?php
}

/*=========================================================================================*/

function ajax_sidebar_rm() {	
	global $shortname, $wpdb;
	$sidebar = $_POST['sidebar'];
	$sidebar_id = $_POST['sidebar_id'];
	$sidebar_name = $_POST['sidebar_name'];
	$pieces = explode(",", $sidebar);

	foreach ($pieces as $key => $value) {
		if($value != '')
			$options_sidebar_rm[ $value ] = $value;
		}
		update_option( $shortname.'_sidebar_generator', $options_sidebar_rm);
		ajax_update_widgets($sidebar_id);

		$sidebar_meta = $wpdb->get_results("SELECT post_id FROM $wpdb->postmeta WHERE meta_value = '$sidebar_name'", ARRAY_A);
		if ( is_array($sidebar_meta) ){
			foreach ($sidebar_meta as $key => $value) {
				delete_post_meta($value['post_id'], 'selected_sidebar');
		}
	}
}

add_action('wp_ajax_sidebar_rm', 'ajax_sidebar_rm');

function pix_admin_print_scripts($hook) {
	$nonce = wp_create_nonce( 'sidebar_rm' );
		
	echo '<script type="text/javascript">
	//<![CDATA[
	var $rmSidebarAjaxUrl = "' .admin_url('admin-ajax.php'). '";
	var $ajaxNonce = "' .$nonce. '";
	//]]></script>';
}

add_action('admin_print_scripts', 'pix_admin_print_scripts');

/*=========================================================================================*/

add_action('admin_menu', 'select_sidebar');

function select_sidebar() {
	add_meta_box('sidebar_selected', 'Select a sidebar', 'custom_sidebar_selected', 'post', 'side', 'high');
	add_meta_box('sidebar_selected', 'Select a sidebar', 'custom_sidebar_selected', 'page', 'side', 'high');
	add_meta_box('sidebar_selected', 'Select a sidebar', 'custom_sidebar_selected', 'portfolio', 'side', 'high');
}

function custom_sidebar_selected() {
	global $post;
	?>
	<fieldset id="mycustom-div">
	<div>
	<p>
	<label for="pix_select_sidebar" >Dropdown Options:</label><br />
	<select name="pix_select_sidebar" id="pix_select_sidebar">
		<option<?php selected( get_post_meta($post->ID, 'pix_select_sidebar', true), 'None'); ?>>No sidebar</option>
	<?php
	$sidebars = sidebar_generator_pix::get_sidebars();
	if(is_array($sidebars) && !empty($sidebars)){
		foreach($sidebars as $sidebar){ ?>
			<option<?php selected( get_post_meta($post->ID, 'pix_select_sidebar', true), $sidebar ); ?>><?php echo $sidebar; ?></option>
		<?php }
	}
	?>
	</select>
	</p>
	</div>
	</fieldset>
	<?php
}

add_action('save_post', 'custom_sidebar_save');
function custom_sidebar_save($postID){
	if($parent_id = wp_is_post_revision($postID)) {
		$postID = $parent_id;
	}
	
	if ($_POST['pix_select_sidebar']) {
		update_custom_meta($postID, $_POST['pix_select_sidebar'], 'pix_select_sidebar');
	}
}

function update_custom_meta($postID, $newvalue, $field_name) {
	if(!get_post_meta($postID, $field_name)){
		add_post_meta($postID, $field_name, $newvalue);
	}else{
		update_post_meta($postID, $field_name, $newvalue);
	}
}

/*=========================================================================================*/


function custom_the_excerpt($length, $more, $end_char = '&#8230;'){
    global $post;
	if (function_exists('has_excerpt') && has_excerpt()) {
		the_excerpt(); 
	} else {
		$content = strip_tags($post->post_content);
		$content = preg_replace( '|\[(.+?)\](.+?\[/\\1\])?|s', '', $content);
		preg_match('/^\s*+(?:\S++\s*+){1,' .$length . '}/', $content, $matches);
		$no = count(explode(" ",$content));
		$no2 = count(explode(" ",$matches[0]));
		$excerpt = preg_replace("/\n/", " ", $matches[0]);
		if($no>$no2) {
			echo "<p class='".$no." ".$no2."'>" . $excerpt . $end_char . "</p>";
		} else {
			echo "<p class='".$no." ".$no2."'>" . $excerpt . "</p>";
		}
	}
		if($more!=''){
			echo '<a class="button small alignleft" href="'. get_permalink($post->ID) .'">'. $more .'</a>';
		}
} 

add_filter( 'the_content_more_link', 'pix_more_link', 10, 2 );

function pix_more_link( $more_link, $more_link_text ) {
	return str_replace( $more_link_text, '<a href="' . get_permalink() . '" class="more-link button small alignleft">'.$more_link_text.'</a>', $more_link );
}

/*=========================================================================================*/

function remove_something($something,$content) 
{
	$str = str_replace($something, '', $content);

    return $str;
}
 
/*=========================================================================================*/

function add_space_brackets($pattern) 
{
	$str = str_replace('][', '] [', $pattern);

    return $str;
}
 
/*=========================================================================================*/

function pix_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <div class="comment-text">
            <div id="comment-<?php comment_ID(); ?>" class="span_in">
                <span class="comment-author vcard">
                    <?php 
                        if($depth == 1) {
                            echo get_avatar( $comment, '50' );
                        }
                        else {
                            echo get_avatar( $comment, '34' );
                        }
                    ?>
                </span><!-- .comment-author-avatar -->
                <span class="head-comment"><?php comment_author_link(); ?>, <span><?php printf( __( '%1$s at %2$s', 'delight' ), get_comment_date(),  get_comment_time() ); ?></span></span><!-- .head-comment -->
                <br />
                <?php comment_text(); ?>
                <?php if ( $comment->comment_approved == '0' ) : ?>
                <em><?php _e('Your comment is awaiting moderation','delight'); ?></em>
                <?php edit_comment_link( __('Edit','delight')); ?>
                <?php endif; ?>
        
                <?php edit_comment_link( __( '(Edit)', 'delight' ), ' ' ); ?>
        
                <div class="reply buttonspan small">
                    <?php comment_reply_link( array_merge( array( 'reply_text' => __('Reply','delight')), array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                </div><!-- .reply -->
            </div><!-- #comment-##  -->
       </div><!-- .comment-text -->

	<?php
       }

/*=========================================================================================*/

function pix_search_form($form) {
$form = '
	<form method="get" id="search" action="' . get_pix_option('home') . '/" >
		<fieldset>
			<input type="text" class="typeText" value="" name="s" id="s" placeholder="' . esc_attr_x( 'Search &hellip;', 'placeholder', 'delight' ) . '"><input type="submit" class="typeSubmit" id="searchsubmit" value="&nbsp;">
			<span class="icons">S</span>
		</fieldset>
	</form>';
return $form;
}
add_filter('get_search_form', 'pix_search_form');

/*=========================================================================================*/

function get_attachment_id_from_src($image_src) {
    global $wpdb;
    $query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
    $id = $wpdb->get_var($query);
 
    if($id == null){
        $image_src = basename ( $image_src );
        $q2 = "SELECT post_id FROM {$wpdb->postmeta}  WHERE meta_key = '_wp_attachment_metadata' AND meta_value LIKE '%$image_src%'";
        $id = $wpdb->get_var($q2);
    }
    return $id;
}

function get_pix_thumb($image_src, $thumb_size) {
	$upload_dir = wp_upload_dir();
	$image_id = get_attachment_id_from_src(str_replace($upload_dir['baseurl'].'/','',$image_src));  
	$url_thumb = wp_get_attachment_image_src($image_id,$thumb_size);  
	$url_thumb2 = $url_thumb[0];
	if($url_thumb2==''){
		$url_thumb2=$image_src;
	}
	return $url_thumb2;
}

function get_pix_content($image_src) {
	global $wpdb, $blog_id;
	if ( is_multisite() && $blog_id > 1 ) {
		$upload_dir = content_url().'/blogs.dir/' . $blog_id . '/files/';
	} else {
		$upload_dir = wp_upload_dir();
		$upload_dir = $upload_dir['basedir'];
	}
	$image_id = get_attachment_id_from_src($image_src); 
	/*if($image_id=='') {
		if(strpos(substr( $image_src, -10 ), 'x')&&strpos(substr( $image_src, -15 ), '-')) {
			$pos = strrpos($image_src, '-');
			$image_src = substr($image_src, 0, $pos) . substr($image_src, -4);
		}
		$image_id = get_attachment_id_from_src(str_replace($upload_dir['baseurl'].'/','',$image_src));  
	}*/
	$query = "SELECT post_content FROM {$wpdb->posts} WHERE ID='$image_id'";
	$content = $wpdb->get_var($query);
	$img_content = replace_something('"', '\'', $content);
	if($img_content == '') {
		$img_content = '<!-- pix_credits_hide -->';
	}
	return $img_content;
}

/*=========================================================================================*/

function replace_something($something,$else,$content) {
	$str = str_replace($something, $else, $content);
    return $str;
}


/*=========================================================================================*/

function explode_something($something,$content,$return) {
	$str = explode($something, $content);
    return $str[$return];
}

/*=========================================================================================*/

function pix_breadcrumbs() {
 
	global $custom_payoff; $meta_title = get_post_meta(get_the_ID(), $custom_payoff->get_the_id(), TRUE);
	if(isset($meta_title['payoff']) && $meta_title['payoff']!='') {
		$the_title = $meta_title['payoff'];
	} else {
		$the_title = get_the_title();
	}

  $delimiter = '</li><li> / </li>';
  $name = __( 'Home', 'delight');
  $currentBefore = '<li class="current">';
  $currentAfter = '</li>';
   
  if ( get_pix_option('pix_breadcrumbs_show')=='show' && ( !is_home() && !is_front_page() || is_paged() && !is_search())) {
 
    echo '<ul id="breadcrumbs">';
 
    global $post;
    $home = get_bloginfo('url');
    echo '<li><a href="' . $home . '">' . $name . '</a> ' . $delimiter . ' ';
 
    if ( is_category() && !is_search()) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) echo('<li>'.get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
      echo $currentBefore;
      single_cat_title();
      echo $currentAfter;
 
    } elseif ( is_day() && !is_search()) {
      echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<li><a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $currentBefore . get_the_time('d') . $currentAfter;
 
    } elseif ( is_month() && !is_search()) {
      echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $currentBefore . get_the_time('F') . $currentAfter;
 
    } elseif ( is_year() && !is_search()) {
      echo $currentBefore . get_the_time('Y') . $currentAfter;
 
    } elseif ( is_tax() && !is_search()) {
		$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); $current_term = $term->term_id; $taxonomy = $term->taxonomy;
		$cus_terms = get_ancestors( $current_term, $taxonomy );
		foreach ( $cus_terms as $cus_term ) {
			$the_term = get_term_by( 'id', $cus_term, $taxonomy );
			echo "<li><a href='".get_term_link( $the_term->name, $taxonomy )."'>".$the_term->name."</a></li><li> / </li>";
		}
		echo "<li class='current'>".$term->name."</li>";
	} elseif ( 'portfolio' == get_post_type() && !is_search()) {
		echo get_the_term_list( $post->ID, 'gallery', '<li>', '</li><li> / </li><li>', '</li><li> / </li>');
		echo $currentBefore;
		echo $the_title;
		echo $currentAfter;
    }elseif ( is_single() && !is_search()) {
      $cat = get_the_category(); $cat = $cat[0];
      echo '<li>'.get_category_parents($cat, TRUE, '</li><li> / </li><li>');
      echo $currentBefore;
      echo $the_title;
      echo $currentAfter;
 
    } elseif ( is_page() && !$post->post_parent && !is_search()) {
      echo $currentBefore;
      echo $the_title;
      echo $currentAfter;
 
    } elseif ( is_page() && $post->post_parent && !is_search()) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
      echo $currentBefore;
      echo $the_title;
      echo $currentAfter;
 
    } elseif ( is_tag() && !is_search()) {
      echo $currentBefore .  __( 'Tag &#39;','delight');
      single_tag_title();
      echo '&#39;' . $currentAfter;
 
    } elseif ( is_author() && !is_search()) {
       global $author;
      $userdata = get_userdata($author);
      echo $currentBefore .  __( 'Posts by ','delight') . $userdata->display_name . $currentAfter;
 
    } elseif ( is_404() && !is_search() ) {
      echo $currentBefore .  __( 'Error 404 ','delight') . $currentAfter;
	  
    } elseif ( is_search() ) {
		
      echo $currentBefore .sprintf( __( 'Results for &#39%s&#39','delight'), get_search_query()) . $currentAfter;
 
    }
 
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() || is_tax() ) echo '<li class="current" style="padding-left:0"> (';
      echo __('Page','delight') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() || is_tax() ) echo ')</li>';
    }
 
    echo '</ul>';
 
  }
}

/*=========================================================================================*/

function pix_pagenavi($numposts='') {
	global $request, $posts_per_page, $wpdb, $paged;
	$pages_to_show = 10;
	$always_show = false;
	$half_pages_to_show = round($pages_to_show/2);
	if (!is_single()) {
		if(!is_category()&&!is_tag()&&!is_tax()) {
			preg_match('#FROM\s(.*)\sORDER BY#siU', $request, $matches); 
		} 
		else {
			preg_match('#FROM\s(.*)\sGROUP BY#siU', $request, $matches);  
		}
	$fromwhere = $matches[1];
	if($numposts==''){
		$numposts = $wpdb->get_var("SELECT COUNT(DISTINCT ID) FROM $fromwhere");
	}
	$max_page = ceil($numposts / $posts_per_page);
	if(empty($paged)) {
		$paged = 1;
	}
	if($max_page > 1 || $always_show) {
		echo "<div class='pix_pagenavi'><ul>";
		if ($paged >= ($pages_to_show-2)) {
			echo '<li><a href="'.esc_url( get_pagenum_link()).'">1</a></li><li>...</li>'; 
		} elseif ($paged == ($pages_to_show-3)) {
			echo '<li><a href="'.esc_url( get_pagenum_link()).'">1</a></li>'; 
		}
		for($i = $paged - $half_pages_to_show; $i <= $paged + $half_pages_to_show; $i++) {   
			if ($i >= 1 && $i <= $max_page) {
				if($i == $paged) {
					echo "<li class='on'>$i</li> ";
				}
				else {
					echo '<li><a href="'.esc_url( get_pagenum_link($i)).'">'.$i.'</a></li> ';   
				}
			}
		}
		if (($paged+$half_pages_to_show) < ($max_page-1) ) {
			echo ' <li>...</li><li><a href="'.get_pagenum_link($max_page).'">'.$max_page.'</a></li> ';
		} elseif  (($paged+$half_pages_to_show) == ($max_page-1)) {
			echo ' <li><a href="'.get_pagenum_link($max_page).'">'.$max_page.'</a></li> ';
		}
		echo "</ul></div>";
	}
}
}

/*=========================================================================================*/

function reduce_string($start, $end, $original) {
	$original = strrchr($original, $start);
	$trimmed = strrchr($original, $end);
	return substr($original, strlen($start), -strlen($trimmed));
}

/*=========================================================================================*/

function html5autop($pee, $br = 1) {
   if ( trim($pee) === '' )
      return '';
   $pee = $pee . "\n"; // just to make things a little easier, pad the end
   $pee = preg_replace('|<br />\s*<br />|', "\n\n", $pee);
   // Space things out a little
// *insertion* of section|article|aside|header|footer|hgroup|figure|details|figcaption|summary
   $allblocks = '(?:table|thead|tfoot|caption|col|colgroup|tbody|tr|td|th|div|dl|dd|dt|ul|ol|li|pre|select|form|map|area|blockquote|address|math|style|input|p|h[1-6]|hr|fieldset|legend|section|article|aside|header|footer|hgroup|figure|details|figcaption|summary)';
   $pee = preg_replace('!(<' . $allblocks . '[^>]*>)!', "\n$1", $pee);
   $pee = preg_replace('!(</' . $allblocks . '>)!', "$1\n\n", $pee);
   $pee = str_replace(array("\r\n", "\r"), "\n", $pee); // cross-platform newlines
   if ( strpos($pee, '<object') !== false ) {
      $pee = preg_replace('|\s*<param([^>]*)>\s*|', "<param$1>", $pee); // no pee inside object/embed
      $pee = preg_replace('|\s*</embed>\s*|', '</embed>', $pee);
   }
   $pee = preg_replace("/\n\n+/", "\n\n", $pee); // take care of duplicates
   // make paragraphs, including one at the end
   $pees = preg_split('/\n\s*\n/', $pee, -1, PREG_SPLIT_NO_EMPTY);
   $pee = '';
   foreach ( $pees as $tinkle )
      $pee .= '<p>' . trim($tinkle, "\n") . "</p>\n";
   $pee = preg_replace('|<p>\s*</p>|', '', $pee); // under certain strange conditions it could create a P of entirely whitespace
// *insertion* of section|article|aside
   $pee = preg_replace('!<p>([^<]+)</(div|address|form|section|article|aside)>!', "<p>$1</p></$2>", $pee);
   $pee = preg_replace('!<p>\s*(</?' . $allblocks . '[^>]*>)\s*</p>!', "$1", $pee); // don't pee all over a tag
   $pee = preg_replace("|<p>(<li.+?)</p>|", "$1", $pee); // problem with nested lists
   $pee = preg_replace('|<p><blockquote([^>]*)>|i', "<blockquote$1><p>", $pee);
   $pee = str_replace('</blockquote></p>', '</p></blockquote>', $pee);
   $pee = preg_replace('!<p>\s*(</?' . $allblocks . '[^>]*>)!', "$1", $pee);
   $pee = preg_replace('!(</?' . $allblocks . '[^>]*>)\s*</p>!', "$1", $pee);
   if ($br) {
      $pee = preg_replace_callback('/<(script|style).*?<\/\\1>/s', create_function('$matches', 'return str_replace("\n", "<WPPreserveNewline />", $matches[0]);'), $pee);
      $pee = preg_replace('|(?<!<br />)\s*\n|', "<br />\n", $pee); // optionally make line breaks
      $pee = str_replace('<WPPreserveNewline />', "\n", $pee);
   }
   $pee = preg_replace('!(</?' . $allblocks . '[^>]*>)\s*<br />!', "$1", $pee);
// *insertion* of img|figcaption|summary
   $pee = preg_replace('!<br />(\s*</?(?:p|li|div|dl|dd|dt|th|pre|td|ul|ol|img|figcaption|summary)[^>]*>)!', '$1', $pee);
   if (strpos($pee, '<pre') !== false)
      $pee = preg_replace_callback('!(<pre[^>]*>)(.*?)</pre>!is', 'clean_pre', $pee );
   $pee = preg_replace( "|\n</p>$|", '</p>', $pee );
   $pee = preg_replace( "|\]\[|", '] [', $pee );

   return $pee;
}


function my_shortcode($pee) {

   $allblocks = '(?:table|thead|tfoot|caption|col|colgroup|tbody|tr|td|th|div|dl|dd|dt|ul|ol|li|pre|select|form|map|area|blockquote|address|math|style|input|p|h[1-6]|hr|fieldset|legend|section|article|aside|header|footer|hgroup|figure|details|figcaption|summary)';
   $pee = preg_replace( "| />|", '>', $pee );
   $pee = preg_replace( "|/>|", '>', $pee );
   $pee = preg_replace( "|<p><div|", '<div', ($pee) );
   $pee = preg_replace( "|div></p>|", 'div>', ($pee) );
   $pee = preg_replace( "|--></p>|", '-->', ($pee) );
   $pee = preg_replace( "|/li><br>|", '/li>', ($pee) );
   $pee = preg_replace( "|ul><br>|", 'ul>', ($pee) );
   $pee = preg_replace( "|</div><br>|", '</div>', ($pee) );
   $pee = preg_replace('!<p>\s*(</?' . $allblocks . '[^>]*>)!', "$1", ($pee));
   $pee = preg_replace('!(</?' . $allblocks . '[^>]*>)\s*</p>!', "$1", ($pee));
   $pee = preg_replace( "|--><br>|", '-->', ($pee) );

		return $pee;

}


// remove the original wpautop function
remove_filter('the_excerpt', 'wpautop');
remove_filter('the_content', 'wpautop');

// add our new html5autop function
add_filter('the_excerpt', 'html5autop');
add_filter('the_content', 'html5autop');


add_filter('the_content', 'my_shortcode', 100);

/*=========================================================================================*/

function extend_valid_html5($init) {
	// Standard attributes
	$atts = 'role|accesskey|class|contenteditable|contextmenu|dir|draggable|hidden|id|item|itemprop|lang|spellcheck|style|subject|tabindex|title';
	$html5Elements = array(
		'article[#|cite|pubdate]',
		'aside[#]',
		'audio[#]',
		'canvas[#]',
		'command[#]',
		'datalist[#]',
		'details[#]',
		'figure[#]',
		'figcaption[#]',
		'footer[#]',
		'header[#]',
		'hgroup[#]',
		'mark[#]',
		'meter[#]',
		'nav[#]',
		'output[#]',
		'progress[#]',
		'section[#]',
		'summary[#]',
		'time[#|datetime]',
		'video[#]'
	);
	if(!isset($init['extended_valid_elements'])) {
		$init['extended_valid_elements'] = '';
	}
	$init['extended_valid_elements'] .= str_replace('#',$atts,implode(',',$html5Elements));
	return $init;
}

add_filter('tiny_mce_before_init', 'extend_valid_html5');

/*=========================================================================================*/

/*function set_contenttype($content_type){
	global $shortcode_form;
	if($shortcode_form == true){
		return 'text/html';
	}
}
add_filter('wp_mail_content_type','set_contenttype');*/

/*=========================================================================================*/

function hex2RGB($hexStr, $returnAsString = false, $seperator = ',') {
    $hexStr = preg_replace("/[^0-9A-Fa-f]/", '', $hexStr); // Gets a proper hex string
    $rgbArray = array();
    if (strlen($hexStr) == 6) { //If a proper hex code, convert using bitwise operation. No overhead... faster
        $colorVal = hexdec($hexStr);
        $rgbArray['red'] = 0xFF & ($colorVal >> 0x10);
        $rgbArray['green'] = 0xFF & ($colorVal >> 0x8);
        $rgbArray['blue'] = 0xFF & $colorVal;
    } elseif (strlen($hexStr) == 3) { //if shorthand notation, need some string manipulations
        $rgbArray['red'] = hexdec(str_repeat(substr($hexStr, 0, 1), 2));
        $rgbArray['green'] = hexdec(str_repeat(substr($hexStr, 1, 1), 2));
        $rgbArray['blue'] = hexdec(str_repeat(substr($hexStr, 2, 1), 2));
    } else {
        return false; //Invalid hex color code
    }
    return $returnAsString ? implode($seperator, $rgbArray) : $rgbArray; // returns the rgb string or the associative array
}

/*=========================================================================================*/

function opacHex($opacity){
	if($opacity=='0'){
		return '00';
	} elseif($opacity=='0.05'){
		return '0d';
	} elseif($opacity=='0.1' || $opacity=='0.10'){
		return '19';
	} elseif($opacity=='0.15'){
		return '26';
	} elseif($opacity=='0.2' || $opacity=='0.20'){
		return '32';
	} elseif($opacity=='0.25'){
		return '3f';
	} elseif($opacity=='0.3' || $opacity=='0.30'){
		return '4b';
	} elseif($opacity=='0.35'){
		return '58';
	} elseif($opacity=='0.4' || $opacity=='0.40'){
		return '64';
	} elseif($opacity=='0.45'){
		return '72';
	} elseif($opacity=='0.5' || $opacity=='0.50'){
		return '7d';
	} elseif($opacity=='0.55'){
		return '8b';
	} elseif($opacity=='0.6' || $opacity=='0.60'){
		return '96';
	} elseif($opacity=='0.65'){
		return 'a4';
	} elseif($opacity=='0.7' || $opacity=='0.70'){
		return 'af';
	} elseif($opacity=='0.75'){
		return 'bd';
	} elseif($opacity=='0.8' || $opacity=='0.80'){
		return 'c8';
	} elseif($opacity=='0.85'){
		return 'd7';
	} elseif($opacity=='0.9' || $opacity=='0.90'){
		return 'e3';
	} elseif($opacity=='0.95'){
		return 'f0';
	} elseif($opacity=='1'){
		return 'ff';
	}
}

/*=========================================================================================*/

function listFont($name, $name2, $label, $label2, $preview) {
	$out = '<label for="'.$name.'">'.$label.'</label>';
	
	$out .= '
                        <select id="'.$name.'" name="'.$name.'" class="font_select">
                            <optgroup label="Web safe">
                                <option value="Arial"'; if (get_pix_option($name) == 'Arial') { $out .= ' selected="selected"'; } $out .='>Arial</option>
                                <option value="Verdana"'; if (get_pix_option($name) == 'Verdana') { $out .= ' selected="selected"'; } $out .='>Verdana</option>
                                <option value="Georgia"'; if (get_pix_option($name) == 'Georgia') { $out .= ' selected="selected"'; } $out .='>Georgia</option>
                                <option value="Courier New"'; if (get_pix_option($name) == 'Courier New') { $out .= ' selected="selected"'; } $out .='>Courier New</option>
                                <option value="Tahoma"'; if (get_pix_option($name) == 'Tahoma') { $out .= ' selected="selected"'; } $out .='>Tahoma</option>
                                <option value="Trebuchet MS"'; if (get_pix_option($name) == 'Trebuchet MS') { $out .= ' selected="selected"'; } $out .='>Trebuchet</option>
                                <option value="Arial Black"'; if (get_pix_option($name) == 'Arial Black') { $out .= ' selected="selected"'; } $out .='>Arial Black</option>
                                <option value="Times New Roman"'; if (get_pix_option($name) == 'Times New Roman') { $out .= ' selected="selected"'; } $out .='>Times</option>
                                <option value="Palatino Linotype"'; if (get_pix_option($name) == 'Palatino Linotype') { $out .= ' selected="selected"'; } $out .='>Palatino Linotype</option>
                                <option value="Lucida Sans Unicode"'; if (get_pix_option($name) == 'Lucida Sans Unicode') { $out .= ' selected="selected"'; } $out .='>Lucida</option>
                                <option value="Comic Sans MS"'; if (get_pix_option($name) == 'Comic Sans MS') { $out .= ' selected="selected"'; } $out .='>Comic Sans MS</option>
                           </optgroup>
                            <optgroup label="Sans serif">
                                <option value="Allerta"'; if (get_pix_option($name) == 'Allerta') { $out .= ' selected="selected"'; } $out .='>Allerta</option>
                                <option value="Amaranth"'; if (get_pix_option($name) == 'Amaranth') { $out .= ' selected="selected"'; } $out .='>Amaranth</option>
                                <option value="Arimo"'; if (get_pix_option($name) == 'Arimo') { $out .= ' selected="selected"'; } $out .='>Arimo</option>
                                <option value="Bowlby One"'; if (get_pix_option($name) == 'Bowlby One') { $out .= ' selected="selected"'; } $out .='>Bowlby One</option>
                                <option value="Cabin"'; if (get_pix_option($name) == 'Cabin') { $out .= ' selected="selected"'; } $out .='>Cabin</option>
                                <option value="Candal"'; if (get_pix_option($name) == 'Candal') { $out .= ' selected="selected"'; } $out .='>Candal</option>
                                <option value="Cantarell"'; if (get_pix_option($name) == 'Cantarell') { $out .= ' selected="selected"'; } $out .='>Cantarell</option>
                                <option value="Carter One"'; if (get_pix_option($name) == 'Carter One') { $out .= ' selected="selected"'; } $out .='>Carter One</option>
                                <option value="Coda:800"'; if (get_pix_option($name) == 'Coda:800') { $out .= ' selected="selected"'; } $out .='>Coda</option>
                                <option value="Didact Gothic"'; if (get_pix_option($name) == 'Didact Gothic') { $out .= ' selected="selected"'; } $out .='>Didact Gothic</option>
                                <option value="Droid Sans"'; if (get_pix_option($name) == 'Droid Sans') { $out .= ' selected="selected"'; } $out .='>Droid Sans</option>
                                <option value="Expletus Sans"'; if (get_pix_option($name) == 'Expletus Sans') { $out .= ' selected="selected"'; } $out .='>Expletus Sans</option>
                                <option value="Francois One"'; if (get_pix_option($name) == 'Francois One') { $out .= ' selected="selected"'; } $out .='>Francois One</option>
                                <option value="Gruppo"'; if (get_pix_option($name) == 'Gruppo') { $out .= ' selected="selected"'; } $out .='>Gruppo</option>
                                <option value="Hammersmith One"'; if (get_pix_option($name) == 'Hammersmith One') { $out .= ' selected="selected"'; } $out .='>Hammersmith One</option>
                                <option value="Istok Web"'; if (get_pix_option($name) == 'Istok Web') { $out .= ' selected="selected"'; } $out .='>Istok Web</option>
                                <option value="Josefin Sans"'; if (get_pix_option($name) == 'Josefin Sans') { $out .= ' selected="selected"'; } $out .='>Josefin Sans</option>
                                <option value="Jura"'; if (get_pix_option($name) == 'Jura') { $out .= ' selected="selected"'; } $out .='>Jura</option>
                                <option value="Lato"'; if (get_pix_option($name) == 'Lato') { $out .= ' selected="selected"'; } $out .='>Lato</option>
                                <option value="Lekton"'; if (get_pix_option($name) == 'Lekton') { $out .= ' selected="selected"'; } $out .='>Lekton</option>
                                <option value="Limelight"'; if (get_pix_option($name) == 'Limelight') { $out .= ' selected="selected"'; } $out .='>Limelight</option>
                                <option value="Mako"'; if (get_pix_option($name) == 'Mako') { $out .= ' selected="selected"'; } $out .='>Mako</option>
                                <option value="Maven Pro"'; if (get_pix_option($name) == 'Maven Pro') { $out .= ' selected="selected"'; } $out .='>Maven Pro</option>
                                <option value="Michroma"'; if (get_pix_option($name) == 'Michroma') { $out .= ' selected="selected"'; } $out .='>Michroma</option>
                                <option value="Metrophobic"'; if (get_pix_option($name) == 'Metrophobic') { $out .= ' selected="selected"'; } $out .='>Metrophobic</option>
                                <option value="Molengo"'; if (get_pix_option($name) == 'Molengo') { $out .= ' selected="selected"'; } $out .='>Molengo</option>
                                <option value="Muli"'; if (get_pix_option($name) == 'Muli') { $out .= ' selected="selected"'; } $out .='>Muli</option>
                                <option value="News Cycle"'; if (get_pix_option($name) == 'News Cycle') { $out .= ' selected="selected"'; } $out .='>News Cycle</option>
                                <option value="Nova Flat"'; if (get_pix_option($name) == 'Nova Flat') { $out .= ' selected="selected"'; } $out .='>Nova Flat</option>
                                <option value="Nunito"'; if (get_pix_option($name) == 'Nunito') { $out .= ' selected="selected"'; } $out .='>Nunito</option>
                                <option value="Oswald"'; if (get_pix_option($name) == 'Oswald') { $out .= ' selected="selected"'; } $out .='>Oswald</option>
                                <option value="Play"'; if (get_pix_option($name) == 'Play') { $out .= ' selected="selected"'; } $out .='>Play</option>
                                <option value="Paytone One"'; if (get_pix_option($name) == 'Paytone One') { $out .= ' selected="selected"'; } $out .='>Paytone One</option>
                                <option value="PT Sans"'; if (get_pix_option($name) == 'PT Sans') { $out .= ' selected="selected"'; } $out .='>PT Sans</option>
                                <option value="Puritan"'; if (get_pix_option($name) == 'Puritan') { $out .= ' selected="selected"'; } $out .='>Puritan</option>
                                <option value="Raleway:100"'; if (get_pix_option($name) == 'Raleway:100') { $out .= ' selected="selected"'; } $out .='>Raleway</option>
                                <option value="Shanti"'; if (get_pix_option($name) == 'Shanti') { $out .= ' selected="selected"'; } $out .='>Shanti</option>
                                <option value="Tenor Sans"'; if (get_pix_option($name) == 'Tenor Sans') { $out .= ' selected="selected"'; } $out .='>Tenor Sans</option>
                                <option value="Terminal Dosis Light"'; if (get_pix_option($name) == 'Terminal Dosis Light') { $out .= ' selected="selected"'; } $out .='>Terminal Dosis Light</option>
                                <option value="Ubuntu"'; if (get_pix_option($name) == 'Ubuntu') { $out .= ' selected="selected"'; } $out .='>Ubuntu</option>
                                <option value="Varela"'; if (get_pix_option($name) == 'Varela') { $out .= ' selected="selected"'; } $out .='>Varela</option>
                                <option value="Varela Round"'; if (get_pix_option($name) == 'Varela Round') { $out .= ' selected="selected"'; } $out .='>Varela Round</option>
                                <option value="Wire One"'; if (get_pix_option($name) == 'Wire One') { $out .= ' selected="selected"'; } $out .='>Wire One</option>
                                <option value="Yanone Kaffeesatz"'; if (get_pix_option($name) == 'Yanone Kaffeesatz') { $out .= ' selected="selected"'; } $out .='>Yanone Kaffeesatz</option>
                            </optgroup>
                            <optgroup label="Serif">
                                <option value="Asset"'; if (get_pix_option($name) == 'Asset') { $out .= ' selected="selected"'; } $out .='>Asset</option>
                                <option value="Bentham"'; if (get_pix_option($name) == 'Bentham') { $out .= ' selected="selected"'; } $out .='>Bentham</option>
                                <option value="Bigshot One"'; if (get_pix_option($name) == 'Bigshot One') { $out .= ' selected="selected"'; } $out .='>Bigshot One</option>
                                <option value="Brawler"'; if (get_pix_option($name) == 'Brawler') { $out .= ' selected="selected"'; } $out .='>Brawler</option>
                                <option value="Buda:300"'; if (get_pix_option($name) == 'Buda:300') { $out .= ' selected="selected"'; } $out .='>Buda</option>
                                <option value="Cardo"'; if (get_pix_option($name) == 'Cardo') { $out .= ' selected="selected"'; } $out .='>Cardo</option>
                                <option value="Caudex"'; if (get_pix_option($name) == 'Caudex') { $out .= ' selected="selected"'; } $out .='>Caudex</option>
                                <option value="Corben:bold"'; if (get_pix_option($name) == 'Corben:bold') { $out .= ' selected="selected"'; } $out .='>Corben</option>
                                <option value="Crimson Text"'; if (get_pix_option($name) == 'Crimson Text') { $out .= ' selected="selected"'; } $out .='>Crimson Text</option>
                                <option value="Droid Serif"'; if (get_pix_option($name) == 'Droid Serif') { $out .= ' selected="selected"'; } $out .='>Droid Serif</option>
                                <option value="EB Garamond"'; if (get_pix_option($name) == 'EB Garamond') { $out .= ' selected="selected"'; } $out .='>EB Garamond</option>
                                <option value="Forum"'; if (get_pix_option($name) == 'Forum') { $out .= ' selected="selected"'; } $out .='>Forum</option>
                                <option value="Gravitas One"'; if (get_pix_option($name) == 'Gravitas One') { $out .= ' selected="selected"'; } $out .='>Gravitas One</option>
                                <option value="Goblin One"'; if (get_pix_option($name) == 'Goblin One') { $out .= ' selected="selected"'; } $out .='>Goblin One</option>
                                <option value="IM Fell DW Pica"'; if (get_pix_option($name) == 'IM Fell DW Pica') { $out .= ' selected="selected"'; } $out .='>IM Fell</option>
                                <option value="Judson"'; if (get_pix_option($name) == 'Judson') { $out .= ' selected="selected"'; } $out .='>Judson</option>
                                <option value="Merriweather"'; if (get_pix_option($name) == 'Merriweather') { $out .= ' selected="selected"'; } $out .='>Merriweather</option>
                                <option value="Modern Antiqua"'; if (get_pix_option($name) == 'Modern Antiqua') { $out .= ' selected="selected"'; } $out .='>Modern Antiqua</option>
                                <option value="Neuton"'; if (get_pix_option($name) == 'Neuton') { $out .= ' selected="selected"'; } $out .='>Neuton</option>
                                <option value="OFL Sorts Mill Goudy TT"'; if (get_pix_option($name) == 'OFL Sorts Mill Goudy TT') { $out .= ' selected="selected"'; } $out .='>OFL Sorts Mill Goudy TT</option>
                                <option value="Old Standard TT"'; if (get_pix_option($name) == 'Old Standard TT') { $out .= ' selected="selected"'; } $out .='>Old Standard TT</option>
                                <option value="Playfair Display"'; if (get_pix_option($name) == 'Playfair Display') { $out .= ' selected="selected"'; } $out .='>Playfair Display</option>
                                <option value="Philosopher"'; if (get_pix_option($name) == 'Philosopher') { $out .= ' selected="selected"'; } $out .='>Philosopher</option>
                                <option value="PT Serif"'; if (get_pix_option($name) == 'PT Serif') { $out .= ' selected="selected"'; } $out .='>PT Serif</option>
                                <option value="Quattrocento"'; if (get_pix_option($name) == 'Quattrocento') { $out .= ' selected="selected"'; } $out .='>Quattrocento</option>
                                <option value="Radley"'; if (get_pix_option($name) == 'Radley') { $out .= ' selected="selected"'; } $out .='>Radley</option>
                                <option value="Stardos Stencil"'; if (get_pix_option($name) == 'Stardos Stencil') { $out .= ' selected="selected"'; } $out .='>Stardos Stencil</option>
                                <option value="Tinos"'; if (get_pix_option($name) == 'Tinos') { $out .= ' selected="selected"'; } $out .='>Tinos</option>
                                <option value="Ultra"'; if (get_pix_option($name) == 'Ultra') { $out .= ' selected="selected"'; } $out .='>Ultra</option>
                                <option value="Vollkorn"'; if (get_pix_option($name) == 'Vollkorn') { $out .= ' selected="selected"'; } $out .='>Vollkorn</option>
                                <option value="Yeseva One"'; if (get_pix_option($name) == 'Yeseva One') { $out .= ' selected="selected"'; } $out .='>Yeseva One</option>
                            </optgroup>
                            <optgroup label="Slab">
                                <option value="Anton"'; if (get_pix_option($name) == 'Anton') { $out .= ' selected="selected"'; } $out .='>Anton</option>
                                <option value="Arvo"'; if (get_pix_option($name) == 'Arvo') { $out .= ' selected="selected"'; } $out .='>Arvo</option>
                                <option value="Holtwood One SC"'; if (get_pix_option($name) == 'Holtwood One SC') { $out .= ' selected="selected"'; } $out .='>Holtwood One SC</option>
                                <option value="Josefin Slab"'; if (get_pix_option($name) == 'Josefin Slab') { $out .= ' selected="selected"'; } $out .='>Josefin Slab</option>
                                <option value="Kreon"'; if (get_pix_option($name) == 'Kreon') { $out .= ' selected="selected"'; } $out .='>Kreon</option>
                                <option value="Podkova"'; if (get_pix_option($name) == 'Podkova') { $out .= ' selected="selected"'; } $out .='>Podkova</option>
                                <option value="Rokkitt"'; if (get_pix_option($name) == 'Rokkitt') { $out .= ' selected="selected"'; } $out .='>Rokkitt</option>
                            </optgroup>
                            <optgroup label="Script">
                                <option value="Annie Use Your Telescope"'; if (get_pix_option($name) == 'Annie Use Your Telescope') { $out .= ' selected="selected"'; } $out .='>Annie Use Your Telescope</option>
                                <option value="Architects Daughter"'; if (get_pix_option($name) == 'Architects Daughter') { $out .= ' selected="selected"'; } $out .='>Architects Daughter</option>
                                <option value="Calligraffitti"'; if (get_pix_option($name) == 'Calligraffitti') { $out .= ' selected="selected"'; } $out .='>Calligraffitti</option>
                                <option value="Damion"'; if (get_pix_option($name) == 'Damion') { $out .= ' selected="selected"'; } $out .='>Damion</option>
                                <option value="Dancing Script"'; if (get_pix_option($name) == 'Dancing Script') { $out .= ' selected="selected"'; } $out .='>Dancing Script</option>
                                <option value="Homemade Apple"'; if (get_pix_option($name) == 'Homemade Apple') { $out .= ' selected="selected"'; } $out .='>Homemade Apple</option>
                                <option value="Kristi"'; if (get_pix_option($name) == 'Kristi') { $out .= ' selected="selected"'; } $out .='>Kristi</option>
                                <option value="Indie Flower"'; if (get_pix_option($name) == 'Indie Flower') { $out .= ' selected="selected"'; } $out .='>Indie Flower</option>
                                <option value="Lobster"'; if (get_pix_option($name) == 'Lobster') { $out .= ' selected="selected"'; } $out .='>Lobster</option>
                                <option value="Lobster Two"'; if (get_pix_option($name) == 'Lobster Two') { $out .= ' selected="selected"'; } $out .='>Lobster Two</option>
                                <option value="Meddon"'; if (get_pix_option($name) == 'Meddon') { $out .= ' selected="selected"'; } $out .='>Meddon</option>
                                <option value="Over the Rainbow"'; if (get_pix_option($name) == 'Over the Rainbow') { $out .= ' selected="selected"'; } $out .='>Over the Rainbow</option>
                                <option value="Pacifico"'; if (get_pix_option($name) == 'Pacifico') { $out .= ' selected="selected"'; } $out .='>Pacifico</option>
                                <option value="Redressed"'; if (get_pix_option($name) == 'Redressed') { $out .= ' selected="selected"'; } $out .='>Redressed</option>
                                <option value="Swanky and Moo Moo"'; if (get_pix_option($name) == 'Swanky and Moo Moo') { $out .= ' selected="selected"'; } $out .='>Swanky and Moo Moo</option>
                                <option value="Tangerine"'; if (get_pix_option($name) == 'Tangerine') { $out .= ' selected="selected"'; } $out .='>Tangerine</option>
                                <option value="The Girl Next Door"'; if (get_pix_option($name) == 'The Girl Next Door') { $out .= ' selected="selected"'; } $out .='>The Girl Next Door</option>
                                <option value="Vibur"'; if (get_pix_option($name) == 'Vibur') { $out .= ' selected="selected"'; } $out .='>Vibur</option>
                            </optgroup>
                            <optgroup label="Monospaced">
                                <option value="Anonymous Pro"'; if (get_pix_option($name) == 'Anonymous Pro') { $out .= ' selected="selected"'; } $out .='>Anonymous Pro</option>
                                <option value="Cousine"'; if (get_pix_option($name) == 'Cousine') { $out .= ' selected="selected"'; } $out .='>Cousine</option>
                                <option value="Droid Sans Mono"'; if (get_pix_option($name) == 'Droid Sans Mono') { $out .= ' selected="selected"'; } $out .='>Droid Sans Mono</option>
                                <option value="Inconsolata"'; if (get_pix_option($name) == 'Inconsolata') { $out .= ' selected="selected"'; } $out .='>Inconsolata</option>
                                <option value="VT323"'; if (get_pix_option($name) == 'VT323') { $out .= ' selected="selected"'; } $out .='>VT323</option>
                            </optgroup>
                            <optgroup label="Square">
                                <option value="Geo"'; if (get_pix_option($name) == 'Geo') { $out .= ' selected="selected"'; } $out .='>Geo</option>
                                <option value="Orbitron"'; if (get_pix_option($name) == 'Orbitron') { $out .= ' selected="selected"'; } $out .='>Orbitron</option>
                            </optgroup>
                            <optgroup label="Comic">
                                <option value="Coming Soon"'; if (get_pix_option($name) == 'Coming Soon') { $out .= ' selected="selected"'; } $out .='>Coming Soon</option>
                                <option value="Chewy"'; if (get_pix_option($name) == 'Chewy') { $out .= ' selected="selected"'; } $out .='>Chewy</option>
                                <option value="Luckiest Guy"'; if (get_pix_option($name) == 'Luckiest Guy') { $out .= ' selected="selected"'; } $out .='>Luckiest Guy</option>
                                <option value="Neucha"'; if (get_pix_option($name) == 'Neucha') { $out .= ' selected="selected"'; } $out .='>Neucha</option>
                                <option value="Sunshiney"'; if (get_pix_option($name) == 'Sunshiney') { $out .= ' selected="selected"'; } $out .='>Sunshiney</option>
                                <option value="Walter Turncoat"'; if (get_pix_option($name) == 'Walter Turncoat') { $out .= ' selected="selected"'; } $out .='>Walter Turncoat</option>
                            </optgroup>
                            <optgroup label="Hand writing">
                                <option value="Crafty Girls"'; if (get_pix_option($name) == 'Crafty Girls') { $out .= ' selected="selected"'; } $out .='>Crafty Girls</option>
                                <option value="Just Another Hand"'; if (get_pix_option($name) == 'Just Another Hand') { $out .= ' selected="selected"'; } $out .='>Just Another Hand</option>
                                <option value="Just Me Again Down Here"'; if (get_pix_option($name) == 'Just Me Again Down Here') { $out .= ' selected="selected"'; } $out .='>Just Me Again Down Here</option>
                                <option value="Patrick Hand"'; if (get_pix_option($name) == 'Patrick Hand') { $out .= ' selected="selected"'; } $out .='>Patrick Hand</option>
                                <option value="Reenie Beanie"'; if (get_pix_option($name) == 'Reenie Beanie') { $out .= ' selected="selected"'; } $out .='>Reenie Beanie</option>
                                <option value="Schoolbell"'; if (get_pix_option($name) == 'Schoolbell') { $out .= ' selected="selected"'; } $out .='>Schoolbell</option>
                            </optgroup>
                        </select>
						
						';
	
	$out .= '<label for="'.$name2.'">'.$label2.'</label>
			<input name="'.$name2.'" class="font_your_own" type="text" value="'.get_pix_option($name2).'">
						
			<input type="text" class="preview_font" value="'. $preview.'" />';
	echo $out;
}  

/*=========================================================================================*/

function findCoords ($str) {
	$str = str_replace('(', '', $str);
	$str = str_replace(')', '', $str);
	$str = explode(",", $str);
	return $str;
}

/*=========================================================================================*/

function getTheWideVideo($video,$start,$loop) {
	if(detectMobile()){
		return '<video id="wide_flash" class="projekktor" data-position="fixed" data-top="0" data-bottom="not" data-height="100" controls>
			<source src="'.remove_something('.flv',$video).'.ogg" type="video/ogg">
			<source src="'.remove_something('.flv',$video).'.mp4" type="video/mp4">
			<source src="'.remove_something('.flv',$video).'.webm" type="video/mp4">
		</video>';
		
		
		$out .= '<script type="text/javascript">
		jQuery(window).one("load",function() {
			projekktor("#wide_flash");
		});
		</script>';
	} else {
		if($start==''){
			$start = 'false';
		} elseif($start=='auto'){
			$start = 'true';
		}
	
		if($loop==''){
			$loop = 'false';
		} elseif($loop=='loop'){
			$loop = 'true';
		}
		$wmode;
		$os = strtolower($_SERVER['HTTP_USER_AGENT']); 
		
		if (strpos($os,'chrome')!==false||strpos($os,'msie')!==false||strpos($os,'linux')!==false||(strpos($os,'windows')!==false && strpos($os,'safari')!==false)) {
			$wmode = 'wmode:"opaque",';
		} elseif ((strpos($os,'windows')!==false && strpos($os,'mozilla/5')!==false)) {
			$wmode = 'wmode:"transparent",';
		} else {
			$wmode = 'wmode:"opaque",';
		}
		
		return '<script type="text/javascript">
	 
			var flashvars = {fileSource:"'.$video.'",fileStart:"'.$start.'",fileLoop:"'.$loop.'"};
			var params = {'.$wmode.'scale:"noscale",allowfullscreen:"true",allowscriptaccess:"always",salign:"tl"};
			var attributes = {id: "wide_flash"};
			 
			swfobject.embedSWF("'. get_template_directory_uri() .'/scripts/fullbg.swf", "wide_flash", "100%", "100%", "10.0.0","'.get_template_directory_uri().'/scripts/expressInstall.swf", flashvars, params, attributes);
			
			jQuery(window).one("load",function(){
				if(jQuery("#pix_credits_pictures").length!=0){
					jQuery("#pix_credits_pictures").html("'.$credits.'");
				}
			});
	
			 
			</script>
			<div class="pix_overlay_pattern"></div>';
	}
}

/*=========================================================================================*/

add_filter( 'pre_get_posts', 'number_of_posts' );
function number_of_posts( $wp_query = '' ) {
	remove_filter( 'pre_get_posts', 'number_of_posts' );
	global $wp_query;
	$query_obj = $wp_query->get_queried_object();
	global $wpdb;
		
		if ( $wp_query->is_tax ) {
			$term_id = $query_obj->term_id;
			$wp_query->query_vars['posts_per_page'] = get_pix_option('pix_array_term_ppp_'.$term_id);
		}

		if ( $wp_query->is_home ) {
			if(get_pix_option('pix_frontpage_galleries_ppp')!=''){			
				$wp_query->query_vars['posts_per_page'] = get_pix_option('pix_frontpage_galleries_ppp');
				if ( get_pix_option('pix_frontpage_posttype')=='portfolio') {
					$wp_query->query_vars['post_type'] = 'portfolio';
				}
			}
		}

	return $wp_query;
}

/*=========================================================================================*/

function getTinyUrl($url) {
    $tinyurl = get_content("http://tinyurl.com/api-create.php?url=".$url);
    return $tinyurl;
}

/*=========================================================================================*/

function splitFont($str, $str2) {
	if($str2!=''){
		$str = $str2;
	}
	if (strpos($str,':')==true){
		$str = explode(':', $str);
		return $str[0];
	} else {
		return $str;
	}
}

/*=========================================================================================*/

function delight_comments_on($text) {
	if(get_pix_option('pix_postmetadata_comments')!='0') {
		return '<span>|&nbsp;<a href="'.get_comments_link().'">'.$text.'</a></span>';
	}
}

/*=========================================================================================*/

function delight_posted_on() {
	$numb = number_format_i18n( get_comments_number() );
	if($numb == 0) {
		$get_comm = __( '0 comments', 'delight' );
	} elseif ($numb == 1) {
		$get_comm = __( '1 comment', 'delight' );
	} else {
		$get_comm = __( $numb.' comments', 'delight' );
	}
	printf( __( '<span>|&nbsp;Posted by <span class="vcard author"><span class="fn">%1$s</span></span> in %2$s</span>'.delight_comments_on('%3$s'), 'delight' ),
		sprintf( '<a href="%1$s" title="%2$s">%3$s</a>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'delight' ), get_the_author() ),
			get_the_author()
		),
		my_category_list( ', ' ),
		$get_comm
	);
}

/*=========================================================================================*/

function get_pix_option($record) {
    global $current_user;

	get_currentuserinfo();
	
	if ($current_user->display_name == 'pix_test' || $current_user->display_name == 'manu_test') {
		if($_SESSION[$record]=='') {
			$_SESSION[$record]=get_option($record);
		}
		return $_SESSION[$record];
	} else {
		return get_option($record);
	}
}

/*=========================================================================================*/

add_filter('img_caption_shortcode', 'my_img_caption_shortcode_filter',10,3);

function my_img_caption_shortcode_filter($val, $attr, $content = null)
{
	extract(shortcode_atts(array(
		'id'	=> '',
		'align'	=> '',
		'width'	=> '',
		'caption' => ''
	), $attr));
	
	if ( 1 > (int) $width || empty($caption) )
		return $val;

	$capid = '';
	if ( $id ) {
		$id = esc_attr($id);
		$capid = 'id="figcaption_'. $id . '" ';
		$id = 'id="' . $id . '" aria-labelledby="figcaption_' . $id . '" ';
	}

	return '<figure ' . $id . 'class="wp-caption ' . esc_attr($align) . '" style="width: '
	. (2 + (int) $width) . 'px">' . do_shortcode( $content ) . '<figcaption ' . $capid 
	. 'class="wp-caption-text">' . $caption . '</figcaption></figure>';
}

/*=========================================================================================*/

function my_category_list( $separator = '', $parents='', $post_id = false ) {

	global $wp_rewrite;

	$categories = get_the_category( $post_id );

	if ( !is_object_in_taxonomy( get_post_type( $post_id ), 'category' ) )

		return apply_filters( 'the_category', '', $separator, $parents );

	if ( empty( $categories ) )

		return apply_filters( 'the_category', __( 'Uncategorized' ), $separator, $parents );

	$rel = ( is_object( $wp_rewrite ) && $wp_rewrite->using_permalinks() ) ? 'data-rel="category tag"' : 'data-rel="category"';

	$thelist = '';

	if ( '' == $separator ) {

		$thelist .= '<ul class="post-categories">';

		foreach ( $categories as $category ) {

			$thelist .= "\n\t<li>";

			switch ( strtolower( $parents ) ) {

				case 'multiple':

					if ( $category->parent )

						$thelist .= get_category_parents( $category->parent, true, $separator );

					$thelist .= '<a href="' . get_category_link( $category->term_id ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" ' . $rel . '>' . $category->name.'</a></li>';

					break;

				case 'single':

					$thelist .= '<a href="' . get_category_link( $category->term_id ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" ' . $rel . '>';

					if ( $category->parent )

						$thelist .= get_category_parents( $category->parent, false, $separator );

					$thelist .= $category->name.'</a></li>';

					break;

				case '':

				default:

					$thelist .= '<a href="' . get_category_link( $category->term_id ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" ' . $rel . '>' . $category->name.'</a></li>';

			}

		}

		$thelist .= '</ul>';

	} else {

		$i = 0;

		foreach ( $categories as $category ) {

			if ( 0 < $i )

				$thelist .= $separator;

			switch ( strtolower( $parents ) ) {

				case 'multiple':

					if ( $category->parent )

						$thelist .= get_category_parents( $category->parent, true, $separator );

					$thelist .= '<a href="' . get_category_link( $category->term_id ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" ' . $rel . '>' . $category->name.'</a>';

					break;

				case 'single':

					$thelist .= '<a href="' . get_category_link( $category->term_id ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" ' . $rel . '>';

					if ( $category->parent )

						$thelist .= get_category_parents( $category->parent, false, $separator );

					$thelist .= "$category->name</a>";

					break;

				case '':

				default:

					$thelist .= '<a href="' . get_category_link( $category->term_id ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" ' . $rel . '>' . $category->name.'</a>';

			}

			++$i;

		}

	}

	return apply_filters( 'the_category', $thelist, $separator, $parents );

}

/*=========================================================================================*/

function add_video_wmode_transparent($html, $url, $attr) {
   if (strpos($html, "<embed src=" ) !== false) {
    	$html = str_replace('</param><embed', '</param><param name="wmode" value="transparent"></param><embed wmode="transparent" ', $html);
   		return $html;
   } elseif (strpos($html, "feature=oembed" ) !== false) {
    	$html = str_replace('feature=oembed', 'feature=oembed&#038;wmode=opaque" ', $html);
   		return $html;
   } else {
        return $html;
   }
}
add_filter('embed_oembed_html', 'add_video_wmode_transparent', 10, 3);

/*=========================================================================================*/

remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'rel_canonical' );
remove_action( 'wp_head', 'rel_canonical' );

/*=========================================================================================*/

function detectMobile(){
	$mobile_browser = '0';
	 
	if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|pad)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
		$mobile_browser++;
	}
	 
	if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
		$mobile_browser++;
	}    
	 
	$mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
	$mobile_agents = array(
		'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
		'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
		'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
		'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
		'newt','noki','palm','pana','pant','phil','play','port','prox',
		'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
		'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
		'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
		'wapr','webc','winw','winw','xda ','xda-');
	 
	if (in_array($mobile_ua,$mobile_agents)) {
		$mobile_browser++;
	}
	 
	if (isset($_SERVER['ALL_HTTP']) && strpos(strtolower($_SERVER['ALL_HTTP']),'OperaMini') > 0) {
		$mobile_browser++;
	}
	 
	if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'windows') > 0) {
		$mobile_browser = 0;
	}
	 
	if ($mobile_browser > 0) {
	   return true;
	}
}

function detectIOS(){
	$ios5 = '0';
	if (preg_match('/(os 5_0)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
		$ios5++;
	}
	 
	if ($ios5 > 0) {
	   return true;
	}
}
add_action('wp_footer', 'print_detectIOS');

function print_detectIOS(){
	if ( detectIOS() ) {
		echo '<script>var detectIOS = true;</script>';
	} else {
		echo '<script>var detectIOS = false;</script>';
	}
}

add_action('admin_footer', 'pix_footer_wariable');
function pix_footer_wariable(){
	echo '<script>var themedir = "'.get_template_directory_uri().'";</script>';
}

/*=========================================================================================*/

function dontChangePw(){
    global $current_user, $page;

	get_currentuserinfo();
	if ('admin.php' != basename($_SERVER['SCRIPT_NAME']) && ($current_user->display_name == 'pix_test' || $current_user->display_name == 'manu_test') )
	wp_die(__('<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US"> 
<head> 
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	<title>WordPress &rsaquo; Error</title> 
	<link rel="stylesheet" href="http://www.pixedelic.com/themes/delight/wp-admin/css/install.css" type="text/css" /> 
</head> 
<body id="error-page" style="height:auto"> 
	<p>You do not have sufficient permissions to access this page.</p>
</body> 
</html> '));
}


add_action('admin_head', 'dontChangePw');

/*=========================================================================================*/

add_filter('the_posts', 'pix_enq_accordion');
function pix_enq_accordion($posts){
	if ( empty($posts) ) return $posts;

	$shortcode_found = false;
	foreach ( $posts as $post ){
		if ( stripos($post->post_content, 'pix_accordion') || stripos($post->post_content, 'pix_sitemap') ){
			$shortcode_found = true;
			break;
		}
	}

	if ( $shortcode_found ){
		wp_enqueue_script("jquery-ui-core");
		wp_enqueue_script("jquery-ui-widget");
		wp_enqueue_script("jquery-ui-accordion");
	}

	return $posts;
}

/*=========================================================================================*/

add_filter('the_posts', 'pix_enq_tabs');
function pix_enq_tabs($posts){
	if ( empty($posts) ) return $posts;

	$shortcode_found = false;
	foreach ( $posts as $post ){
		if ( stripos($post->post_content, 'pix_tabs') ){
			$shortcode_found = true;
			break;
		}
	}

	if ( $shortcode_found ){
		wp_enqueue_script("jquery-ui-core");
		wp_enqueue_script("jquery-ui-widget");
		wp_enqueue_script("jquery-ui-tabs");
	}

	return $posts;
}

/*=========================================================================================*/

add_filter('the_posts', 'pix_enq_cycle');
function pix_enq_cycle($posts){
	if ( empty($posts) ) return $posts;

	$shortcode_found = false;
	foreach ( $posts as $post ){
		if ( stripos($post->post_content, 'slideshow') ){
			$shortcode_found = true;
			break;
		}
	}

	if ( $shortcode_found ){
		wp_enqueue_script("cycle", get_template_directory_uri()."/scripts/jquery.cycle.all.min.js", array('jquery'));
	}

	return $posts;
}

/*=========================================================================================*/

add_action('init', 'register_pix_datepciker');
add_action('wp_footer', 'print_pix_datepicker');

function register_pix_datepciker() {
		wp_register_script("ui-datepicker", get_template_directory_uri()."/scripts/jquery.ui.datepicker.js", array('ui-widget'));
}

function print_pix_datepicker() {
    global $print_datepicker;
    if (!$print_datepicker) return;
		wp_print_scripts("jquery-ui-core");
		wp_print_scripts("jquery-ui-widget");
		wp_print_scripts("ui-datepicker");
}

/*=========================================================================================*/

add_action('init', 'register_pix_isotope');
add_action('wp_footer', 'print_pix_isotope');

function register_pix_isotope() {
		wp_register_script("isotope", get_template_directory_uri()."/scripts/jquery.isotope.min.js", array('jquery'));
}

function print_pix_isotope() {
    global $print_isotope; 
    if (!$print_isotope) return;
		wp_print_scripts("isotope");
}

/*=========================================================================================*/

add_action('init', 'register_pix_infinite');
add_action('wp_footer', 'print_pix_infinite');

function register_pix_infinite() {
		wp_register_script("infinitescroll", get_template_directory_uri()."/scripts/jquery.infinitescroll.min.js", array('jquery'));
}

function print_pix_infinite() {
    global $print_infinite; 
    if (!$print_infinite) return;
		wp_print_scripts("infinitescroll");
}

/*=========================================================================================*/

add_filter('widget_text', 'do_shortcode');

/*=========================================================================================*/

function pix_remove_item_by_value($array, $val = '', $preserve_keys = true) {
	if (empty($array) || !is_array($array)) return false;
	if (!in_array($val, $array)) return $array;

	foreach($array as $key => $value) {
		if ($value == $val) unset($array[$key]);
	}

	return ($preserve_keys === true) ? $array : array_values($array);
}


/*=========================================================================================*/

add_action('restrict_manage_posts','restrict_portfolio_by_gallery');
function restrict_portfolio_by_gallery() {
	global $typenow;
    $args=array( 'public' => true, '_builtin' => false ); 
    $post_types = get_post_types($args);
    if ( in_array($typenow, $post_types) ) {
    $filters = get_object_taxonomies($typenow);
        foreach ($filters as $tax_slug) {
            $tax_obj = get_taxonomy($tax_slug);
            wp_dropdown_categories(array(
                'show_option_all' => __('Show All '.$tax_obj->label ),
                'taxonomy' => $tax_slug,
                'name' => $tax_obj->name,
                'orderby' => 'term_order',
                'selected' => $_GET[$tax_obj->query_var],
                'hierarchical' => $tax_obj->hierarchical,
                'show_count' => false,
                'hide_empty' => true
            ));
        }
    }
}


add_filter('parse_query','convert_portfolio_id_to_taxonomy_term_in_query');
function convert_portfolio_id_to_taxonomy_term_in_query($query) {
    global $typenow;
    global $pagenow;
	if ($pagenow=='edit.php') {
        $filters = get_object_taxonomies($typenow);
        foreach ($filters as $tax_slug) {
            $var = &$query->query_vars[$tax_slug];
            if ( isset($var) ) {
                $term = get_term_by('id',$var,$tax_slug);
                $var = $term->slug;
            }
        }
    }
}

/*=========================================================================================*/

function pix_image_path($img) {
	global $blog_id;
	if (isset($blog_id) && $blog_id > 1) {
		$img = explode('/files/', $img);
		if (isset($img[1])) {
			$img = '/blogs.dir/' . $blog_id . '/files/' . $img[1];
		}
	}
	return $img;
}

/*=========================================================================================*/

function pix_compare_dates($date) { 
	$date = new DateTime($date);
	$date = $date->format('U');
	$date2 = time();
    $blocks = array( 
        array('name'=>'year','amount'    =>    60*60*24*365    ), 
        array('name'=>'month','amount'    =>    60*60*24*31    ), 
        array('name'=>'week','amount'    =>    60*60*24*7    ), 
        array('name'=>'day','amount'    =>    60*60*24    ), 
        array('name'=>'hour','amount'    =>    60*60        ), 
        array('name'=>'minute','amount'    =>    60        ), 
        array('name'=>'second','amount'    =>    1        ) 
        ); 
    
    $diff = abs($date-$date2); 
    
    $levels = 1; 
    $current_level = 1; 
    $result = array(); 
    foreach($blocks as $block) 
        { 
        if ($current_level > $levels) {break;} 
        if ($diff/$block['amount'] >= 1) 
            { 
            $amount = floor($diff/$block['amount']); 
            if ($amount>1) {$plural='s';} else {$plural='';} 
            $result[] = $amount.' '.$block['name'].$plural; 
            $diff -= $amount*$block['amount']; 
            $current_level++; 
            } 
        } 
	return implode(' ',$result).' ago'; 
} 
			
/*=========================================================================================*/

function pix_url_2_link($text) { 
	$text = ereg_replace('[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]', '<a href="\\0" target="_blank" rel="nofollow">\\0</a>', $text);
	return $text;
}
			
/*=========================================================================================*/

function pix_include_css() {
	global $current_user;
	get_currentuserinfo();

	$inc_dir = TEMPLATEPATH . '/functions/includes/';
	$css_file = $inc_dir . 'css_include.css';
	ob_start(); 

	require(TEMPLATEPATH . '/style_2.php'); 

	$css = ob_get_clean();

	if( get_pix_option('pix_css_inline') != 'true' ) {
		//if(is_writeable($css_file) && is_readable($css_file) && is_executable($css_file)) {
			if( $current_user->display_name != 'pix_test' ) {
				file_put_contents($inc_dir . 'css_include.css', $css, LOCK_EX);
			} else {
				$session = session_id();
				if (!file_exists($inc_dir . 'sessions/css_include_session_'.$session.'.css')) {
					$css_name = $inc_dir . 'sessions/css_include_session_'.$session.'.css';
					$css_handle = fopen($css_name, 'w+') or die("can't open file");
				}
				file_put_contents($inc_dir . 'sessions/css_include_session_'.$session.'.css', $css, LOCK_EX);
				pix_delete_session_files();
			}
		//}
	}
}
/***/
function pix_include_js() {
	global $current_user;
	get_currentuserinfo();

	$inc_dir = TEMPLATEPATH . '/functions/includes/';
	$js_file = $inc_dir . 'js_include.js';
	ob_start(); 

	require(TEMPLATEPATH . '/scripts/custom_2.php'); 

	$js = ob_get_clean();

	if( get_pix_option('pix_css_inline') != 'true' ) {
		//if(is_writeable($js_file)) {
			if( $current_user->display_name != 'pix_test' ) {
				file_put_contents($inc_dir . 'js_include.js', $js, LOCK_EX);
			} else {
				$session = session_id();
				if (!file_exists($inc_dir . 'sessions/js_include_session_'.$session.'.js')) {
					$js_name = $inc_dir . 'sessions/js_include_session_'.$session.'.js';
					$js_handle = fopen($js_name, 'w+') or die("can't open file");
				}
				file_put_contents($inc_dir . 'sessions/js_include_session_'.$session.'.js', $js, LOCK_EX);
				pix_delete_session_files();
			}
		//}
	}
}
/***/
function pix_enqueue_cssinclude() {
	global $current_user;
	get_currentuserinfo();
	$inc_dir = TEMPLATEPATH . '/functions/includes/';
	if ( !is_admin() ) {
		if( $current_user->display_name != 'pix_test' && get_pix_option('pix_css_inline') != 'true' ) {
			wp_register_style('css-delight-include', get_template_directory_uri() . '/functions/includes/css_include.css', 'style');
		} elseif( $current_user->display_name == 'pix_test' && get_pix_option('pix_css_inline') != 'true' ) {
			$session = session_id();
			if (!file_exists($inc_dir . 'sessions/css_include_session_'.$session.'.css')) {
				wp_register_style('css-delight-include', get_template_directory_uri() . '/functions/includes/css_include.css', 'style');
			} else {
				wp_register_style('css-delight-include', get_template_directory_uri() . '/functions/includes/sessions/css_include_session_'.$session.'.css', 'style');
			}
		} else {
			wp_register_style('css-delight-include', get_template_directory_uri() . '/style.php', 'style');
		}
		wp_enqueue_style( 'css-delight-include');
	}
}
add_action('wp_print_styles', 'pix_enqueue_cssinclude');
/***/
function pix_enqueue_jsinclude() {
	global $current_user;
	get_currentuserinfo();
	$inc_dir = TEMPLATEPATH . '/functions/includes/';
	if( $current_user->display_name != 'pix_test' && get_pix_option('pix_css_inline') != 'true' ) {
		wp_register_script('custom', get_template_directory_uri() . '/functions/includes/js_include.js', 'pixwall_delight');
	} elseif( $current_user->display_name == 'pix_test' && get_pix_option('pix_css_inline') != 'true' ) {
		$session = session_id();
		if (!file_exists($inc_dir . 'sessions/js_include_session_'.$session.'.js')) {
			wp_register_script('custom', get_template_directory_uri() . '/functions/includes/js_include.js', 'pixwall_delight');
		} else {
			wp_register_script('custom', get_template_directory_uri() . '/functions/includes/sessions/js_include_session_'.$session.'.js', 'pixwall_delight');
		}
	} else {
		wp_register_script('custom', get_template_directory_uri() . '/scripts/custom.php', 'pixwall_delight');
	}
	wp_enqueue_script('custom');
}
add_action('wp_enqueue_scripts', 'pix_enqueue_jsinclude');
/***/
function pix_delete_session_files() {
	$inc_dir = TEMPLATEPATH . '/functions/includes/sessions/';
	$count = count(glob($inc_dir . "*"));
	$sid = session_id();
	
	if($count > 200){
		$files = glob($inc_dir . "*");
		foreach($files as $file){
			if(is_file($file) && !strpos($file, $sid)){
				unlink($file);
			}
		}
	}
}
			
/*=========================================================================================*/

function addBodyClassMobile() {
	if (detectMobile()) {
		return 'is_mobile';
	} else {
		return 'is_not_mobile';
	}
}
			
/*=========================================================================================*/

function pix_array_combine($arr1, $arr2) {
    $count = min(count($arr1), count($arr2));
    return array_combine(array_slice($arr1, 0, $count), array_slice($arr2, 0, $count));
}

/*=========================================================================================*/

function pix_cache_tweets($user, $count) {
	global $current_user, $blog_id;
	
	/*if ( is_multisite() && $blog_id > 1 ) {
		$upload_dir = ABSPATH . 'wp-content/blogs.dir/' . $blog_id . '/files/';
	} else {*/
		$upload_dir = wp_upload_dir();
		$upload_dir = $upload_dir['basedir'];
	//}
	
	if ( !isset($blog_id) || $blog_id == 1 ) {
		$up_dir = $upload_dir['basedir'].'/';
	} else {
		$up_dir = ABSPATH.'/wp-content/blogs.dir/' . $blog_id . '/files/';
	}
	$cPath = $up_dir . 'file.cache.'.$user.'.'.$count;
	$cache = FALSE; //Assume the cache is empty
	if(file_exists($cPath)) {
		
		$test_content = file_get_contents($cPath);
		
		if ( file_get_contents($cPath) != '' ) {

			$modtime = filemtime($cPath);
			$timeago = time() - 1800; //30 minutes ago in Unix timestamp format (no. seconds since 1st Jan 1970) 
			if($modtime < $timeago) {
				$cache = FALSE; //Set to false just in case as the cache needs to be renewed
			} else {
				$cache = TRUE; //The cache is not too old so the cache can be used.
			}
			
		}
	}
	
	if($cache == FALSE) {
		//initialize a new curl resource
		$content = get_content('http://api.twitter.com/1/statuses/user_timeline/'.$user.'.json?count='.$count.'&include_rts=false');
					
		//Let's save our data into the cache
		file_put_contents($cPath, utf8_encode($content), LOCK_EX);
	
	} else {
		//cache is TRUE let's load the data from the cache.
		$content = file_get_contents($cPath);
	}
	
	return $content;
}

/*=========================================================================================*/

function pix_front_javascript_var() {
	global $wp_query, $posts_per_page, $post, $pix_pages, $content_width;
	$post_type = get_post_type();
	echo '<script type="text/javascript">';
	echo 'var pix_theme_dir = "'.get_template_directory_uri().'";';
	echo 'var pix_loadingText= "'. __('Loading...','delight') .'";';
	echo 'var pix_donetext= "'. __('No more items to load','delight') .'";';
	echo '</script>';
}
add_action('wp_footer', 'pix_front_javascript_var');

/*=========================================================================================*/

function pix_seo_header(){
	if ( get_pix_option('pix_seo_enable')=='true' ) { ?>
    <title><?php

	global $post, $custom_seo; 
	$meta_seo = get_post_meta($post->ID, '_custom_seo', TRUE);
	
	if (is_tax()) {
		$the_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		$the_term = $the_term->term_id;
	}
	if (is_category()){
		$the_category = get_query_var('cat');
	}

	if((is_single()||is_page()) && $meta_seo &&  array_key_exists('title',$meta_seo)){
		echo wp_kses_stripslashes($meta_seo['title']);
	} elseif(is_home()&&get_pix_option('pix_front_page_seo_title')!='') {
		echo wp_kses_stripslashes(get_pix_option('pix_front_page_seo_title'));
	} elseif(is_tax() && get_pix_option('pix_array_term_seotitle_'. $the_term)!='') {
		echo wp_kses_stripslashes(get_pix_option('pix_array_term_seotitle_'. $the_term));
	} elseif(is_category() && get_pix_option('pix_array_term_seotitle_'. $the_category)!='') {
		echo wp_kses_stripslashes(get_pix_option('pix_array_term_seotitle_'. $the_category));
	} else {
			wp_title( '|', true, 'right' );
		
			bloginfo( 'name' );
		
			$site_description = get_bloginfo( 'description', 'display' );
			if ( $site_description && ( is_home() || is_front_page() ) )
				echo " | $site_description";
		
			if ( isset($paged) && ($paged >= 2 || $page >= 2) )
				echo ' | ' . sprintf( __( '%s' ), max( $paged, $page ) );
		}?></title>
	<?php if((is_single()||is_page()) && $meta_seo && array_key_exists('description',$meta_seo)){ ?>
			<meta name="description" content="<?php echo wp_kses_stripslashes($meta_seo['description']); ?>"> 
		<?php } elseif (get_pix_option('pix_front_page_seo_title')!=''&&is_home()) { ?>
			<meta name="description" content="<?php echo wp_kses_stripslashes(get_pix_option('pix_front_page_seo_description')); ?>"> 
		<?php } elseif(is_tax() && get_pix_option('pix_array_term_seodescription_'. $the_term)!='') {
				echo '<meta name="description" content="'.wp_kses_stripslashes(get_pix_option('pix_array_term_seodescription_'. $the_term)).'">';
			} elseif(is_category() && get_pix_option('pix_array_term_seodescription_'. $the_category)!='') {
				echo '<meta name="description" content="'.wp_kses_stripslashes(get_pix_option('pix_array_term_seodescription_'. $the_category)).'">';
			}
			
		 if((is_single()||is_page()) && $meta_seo && array_key_exists('keywords',$meta_seo)){ ?>
			<meta name="keywords" content="<?php echo wp_kses_stripslashes($meta_seo['keywords']); ?>">
		<?php } elseif (get_pix_option('pix_front_page_seo_title')!=''&&is_home()) { ?>
			<meta name="keywords" content="<?php echo wp_kses_stripslashes(get_pix_option('pix_front_page_seo_keywords')); ?>"> 
	<?php } elseif(is_tax() && get_pix_option('pix_array_term_seokeywords_'. $the_term)!='') {
				echo '<meta name="keywords" content="'.wp_kses_stripslashes(get_pix_option('pix_array_term_seokeywords_'. $the_term)).'">';
			} elseif(is_category() && get_pix_option('pix_array_term_seokeywords_'. $the_category)!='') {
				echo '<meta name="keywords" content="'.wp_kses_stripslashes(get_pix_option('pix_array_term_seokeywords_'. $the_category)).'">';
			}
	}

}
add_action( 'wp_head', 'pix_seo_header' );

/*=========================================================================================*/

function pix_switch_timthumb($post, $size, $width, $height) {
	$attachment_id = get_post_thumbnail_id($post->ID);
	$thumb_src = wp_get_attachment_image_src( $attachment_id, 'full' );
	if ( get_pix_option('pix_use_timthumb') == 'show' ) {
	    if( get_pix_option('pix_timthumb_cache') != '0' ) {
	      $timthumb_cache = '_cache';
	      $img = get_template_directory_uri().'/scripts/timthumb_cache.php?src='.pix_image_path($thumb_src[0]).'&amp;h='.$height.'&amp;w='.$width;
	    } else {
	      $img = get_template_directory_uri().'/scripts/timthumb.php?src='.pix_image_path($thumb_src[0]).'&amp;h='.$height.'&amp;w='.$width;
	    }
	} else {
		$img = wp_get_attachment_image_src( $attachment_id, $size );
		$img = $img[0];
	}
	return $img;
}