<?php

 	
function epic_get_modulestyle($module){
	
	global $post;
	
	/* Module style */
	$style = get_post_meta($post->ID,$module,true);
	//if(!$style)	{ $style = EPIC_DEFAULT_MODULESTYLE;}
	return $style;
	
}

function epic_get_modulemargin($module){
	
	global $post;
	$margin = get_post_meta($post->ID,$module,true);
	//if(!$margin){ $margin = EPIC_DEFAULT_MODULEMARGIN;}
	return $margin;
}



function unhide_kitchensink( $args ) {
$args['wordpress_adv_hidden'] = false;
return $args;
}
add_filter( 'tiny_mce_before_init', 'unhide_kitchensink' );

function epic_excerptlimit($limit){
	global $post;
	$text = $post->post_excerpt;
	if (strlen($text) > $limit) {
		$text = substr($text,0,strpos($text,' ',$limit));
		$text = $text . '...';
	}
	
	return apply_filters('the_excerpt',$text);
}

function epic_post_excerptlimit($limit, $id){
	global $post;
	$text = $id->post_excerpt;
	if (strlen($text) > $limit) {
		$text = substr($text,0,strpos($text,' ',$limit));
		$text = $text . '...';
	}else {
		$text = $text;
	}
	
	return apply_filters('the_excerpt',$text);
}

define('EPIC_FRONTEND_EDITOR', get_option('epic_disable_fee'));

define('EPIC_DEFAULT_MODULESTYLE', get_option('epic_module_default_style'));
define('EPIC_DEFAULT_MODULEMARGIN', get_option('epic_module_default_margin'));



function add_module_input_title($name){
	global $post;
	?>
		<h5>Title</h5>
		<p><input type="text" name="<?php echo $name;?>" value="<?php echo get_post_meta($post->ID,$name,true);?>"/></p>
	<?php
}

function add_module_textarea_description($name){
	global $post;
	?>
	<h5>Description</h5>
	<p><textarea name="<?php echo $name;?>"><?php echo get_post_meta($post->ID,$name,true);?></textarea></p>
	<?php
}


function add_module_text_style($name){
	global $post;
	
	$alignment = get_post_meta($post->ID,$name,true);
	?>
	<h5>Header and description text-alignment</h5>
	<p>
	<label><input type="radio" name="<?php echo $name;?>" value="left" <?php if($alignment=='left'){ echo 'checked="checked"';}?>> Left-aligned</label>
	<label><input type="radio" name="<?php echo $name;?>" value="centered" <?php if($alignment=='centered' || !$alignment){ echo 'checked="checked"';}?>>Centered</label>
	</p>
	
	<?php
}

add_action('wp_ajax_ajax_save', 'ajax_save_order');

function new_nav_menu_home($items, $args) {
    if( $args->theme_location == 'primary' )
    return '<li class="home"><a href="' . home_url( '/' ) . '"></a></li>'.$items;
    return $items;
    
}
add_filter( 'wp_nav_menu_items', 'new_nav_menu_home', 10, 2 );


function new_nav_menu_search($items, $args) {
    if( $args->theme_location == 'primary' )
        return $items . '<li class="menu-search"><form action="'.site_url().'" method="get"><div class="input-wrapper"><input type="text" value="'.__('To search type and hit enter','epic').'" class="cleardefault" name="s"/></div><input type="image" src="'.get_stylesheet_directory_uri().'/library/images/btn_search.png" alt="Search"/></form></li>';
 
    return $items;
}
add_filter('wp_nav_menu_items','new_nav_menu_search', 10, 2);






function language_selector_flags(){
    $languages = icl_get_languages('skip_missing=0&orderby=code');
    if(!empty($languages)){
    	echo '<div id="epic_wpml_lang_selector">';
        foreach($languages as $l){
            if(!$l['active']) echo '<a href="'.$l['url'].'">';
            echo '<img src="'.$l['country_flag_url'].'" height="12" alt="'.$l['language_code'].'" width="18" />';
            if(!$l['active']) echo '</a>';
        }
        echo '</div><div class="clearfix"></div>';
    }
}

function ajax_save_order(){

	
	$order = $_POST['order'];
	$id = $_POST['id'];
	//$post_id = '933';
	if ($value = '') {
		$message_result = array(
			'setting' => "",
			'message' => 'No modules selected',
			'success' => FALSE
	         );
	         delete_post_meta($id,'epic_pageorder');
		}
	else {
		$message_result = array(
			'setting' => $value,
			'message' => 'Position saved.',
		    'success' => TRUE
	         );
	       	update_post_meta($id,'epic_pageorder', $order);
	       	
	}
		
	echo json_encode($message_result);
	
	exit;
	
	
}


add_action('wp_head','pluginname_ajaxurl');	

	
function pluginname_ajaxurl() {
?>
<script type="text/javascript">
var feeajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
</script>
<?php
}

function fee_handle($str){
	
	$str_low = strtolower($str);
	
	echo '<div class="fee-handle clearfix" id="'.$str_low.'_handle">
	<h5>'.$str.'</h5>
	<a href="#" class="bulb"></a>
	<div class="handle-icons">
	<a class="fee-opentoggle" title="Edit '.$str.'"></a>
	<a class="fee-draghandle" title="Move '.$str.'"></a>
	<a class="fee-deletehandle" title="Remove '.$str.'"></a>
	
	
	</div>';
}




define('EPIC_CONTENT_WIDTH', 960);

if ( ! isset( $content_width ) ) $content_width = EPIC_CONTENT_WIDTH;
function get_content_width(){
		return $content_width;
}



/* 	===============================================================

	DEFINE PATHS 
 	
===================================================================*/

define('EPIC_LIBRARY', TEMPLATEPATH . '/library');
define('EPIC_FUNCTIONS', EPIC_LIBRARY . '/functions');
define('EPIC_ADMIN', EPIC_LIBRARY . '/admin');
define('EPIC_IMAGES', EPIC_LIBRARY . '/images');
define('EPIC_SCRIPTS', EPIC_LIBRARY . '/scripts');
define('EPIC_STYLES', EPIC_LIBRARY . '/css');
define('EPIC_CHILD', TEMPLATEPATH . '/child');


// Add theme support for drag & drop functionality in admin  

add_theme_support('epic_teaserpages');
add_theme_support('epic_featuredpages');
add_theme_support('epic_tabpages');
    
	// Add post type support
	add_theme_support('epic_posttype_slide');
	add_theme_support('epic_posttype_portfolio');
	add_theme_support('epic_posttype_teaser');
	//add_theme_support('epic_posttype_news');
	


    
get_template_part('/library/structure');
get_template_part('/library/styles');

/* Load text strings */	
get_template_part('/library/functions/strings');

/* Load the image-handling file */
get_template_part('/library/functions/images');

/* Load the post types */
get_template_part('/library/functions/posttypes');

/* Load core functions */
get_template_part('/library/functions/core');

/* Load extensions */
get_template_part('/library/functions/extensions');

/* Load file containing hooks */
get_template_part('/library/functions/hooks');

/* Load theme admin-files */
require_once (EPIC_ADMIN.'/options.php');
//get_template_part('/library/admin/options');
get_template_part('/library/admin/epicadmin');
	
	/* Wizard */
	//get_template_part('/library/admin/wizard');
	
	/* Update notifier */	
	get_template_part('/library/admin/update-notifier');
	
	/* Front end editor  */	
	get_template_part('/library/admin/frontend_editor/frontend_editor');


 



/* 	===============================================================

	LOCALIZATION 
 	
 	Make theme available for translation. 
 	Translations can be filed in the /library/languages/ directory
 	
===================================================================*/
 
function locale(){

	load_theme_textdomain('epic', EPIC_LIBRARY . '/languages');
	$locale = get_locale();
	$locale_file = EPIC_LIBRARY . "/languages/$locale.php";
	if (is_readable($locale_file)) require_once ($locale_file);
}

add_action('after_setup_theme','locale');


/* 	===============================================================

	ENQUEUE jAVASCRIPT 
 	 	
===================================================================*/

function epic_enqueue_theme_js() {
    
    wp_enqueue_script('jquery', EPIC_SCRIPTS . '/jquery.js');
	
	if(get_option('epic_title_font_rendering') == 'cufon'  && !is_admin()){
		if(get_option('epic_cufon_title_font') != ''){ $cufonfont = get_option('epic_cufon_title_font');}
		wp_enqueue_script('epic_cufon', 		get_template_directory_uri().'/library/scripts/cufon.js');
		wp_enqueue_script('epic_cufon_font', 	get_template_directory_uri().'/library/fonts/cufon/' . strtolower($cufonfont) .'.js', array('epic_cufon'));
	} 

	wp_enqueue_script('jPlayer', 		get_template_directory_uri().'/library/scripts/jPlayer/jquery.jplayer.min.js');
	wp_enqueue_script('epic_scripts', 	get_template_directory_uri().'/library/scripts/epic.js');
	wp_enqueue_script('epic_easing', 	get_template_directory_uri().'/library/scripts/jquery.easing.1.1.3.js');
	wp_enqueue_script('epic_custom', 	get_template_directory_uri().'/library/scripts/custom.js');

	
    
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) wp_enqueue_script('comment-reply');
          
          	$js_dir=	get_template_directory_uri('template_directory').'/library/admin/js';
          
           wp_enqueue_script("mediaupload", null,array('jquery')); 
		   wp_enqueue_script('thickbox',null,array('jquery'));
    	   wp_enqueue_style ('thickbox.css', '/'.WPINC.'/js/thickbox/thickbox.css', null, '1.0');
    	   wp_enqueue_script("ui", 		$js_dir."/jquery.ui.js", false, '');
    }
    
  }

add_action('init', 'epic_enqueue_theme_js');


/* 	===============================================================

	RUN EPIC SETUP 
 	
 	Tell WordPress to run epic_setup() when the 'after_setup_theme' 
 	hook is run. 
 	
===================================================================*/

function epic_setup() {

	/* 	===============================================================

	ADD THEME SUPPORT 
 	
 	Adding themes support for various framework functionality.
 	
	===================================================================*/
	add_theme_support('post-thumbnails');
	add_theme_support('automatic-feed-links');
	add_theme_support('post-formats', array('image','video','gallery'));
	add_post_type_support('page', 'excerpt');
	
	// ADD POST FORMAT SUPPORT
	add_post_type_support('page', 'post-formats',array('image','video','gallery')); // add post-formats to post_type 'page'
	add_post_type_support('portfolio', 'post-formats',array('image','video','gallery')); // add post-formats to post_type 'portfolio'


	/* Menus */
	add_theme_support('epic_primary_nav');
	//add_theme_support('epic_secondary_nav');
	add_theme_support('epic_footer_nav');
	add_theme_support('epic_mobile_nav');
	
	add_theme_support('epic_breadcrumb');
	
	require_if_theme_supports( 'epic_breadcrumb', EPIC_FUNCTIONS . '/breadcrumbtrail.php' );

    
	/* REGISTER NAV-MENUS
 	===================================================================*/

	function epic_register_menus(){
    	if(current_theme_supports('epic_primary_nav'))	{ register_nav_menu('primary', 'Primary Navigation');  }
   		if(current_theme_supports('epic_secondary_nav')){ register_nav_menu('secondary','Secondary Navigation'); }
   		if(current_theme_supports('epic_footer_nav'))	{ register_nav_menu('footer','Footer Navigation'); }
   		if(current_theme_supports('epic_mobile_nav'))	{ register_nav_menu('mobile','Mobile Navigation'); }
  		
   	}
    
	add_action('init', 'epic_register_menus');
        
 
  	/* 	LOAD SHORTCODES
 	===================================================================*/
 	//require_once (EPIC_FUNCTIONS . '/shortcodes.php');
   
   	/* 	LOAD TINYMCE PLUGIN
 	===================================================================*/
 	//require_once (EPIC_ADMIN . '/tinymce/tinymce.php');

    /* 	LOAD SIDEBAR SCRIPTS
 	===================================================================*/  	 
    require_once (EPIC_ADMIN . '/sidebar_generator.php'); // The sidebar-generator
    require_once (EPIC_FUNCTIONS . '/sidebars.php'); // Sidebars
   
   
    /* 	LOAD META PANELS FOR POST-PAGE EDITING
 	===================================================================*/
    require_once (EPIC_ADMIN . '/panels/post-meta.php'); // For inserting video
    require_once (EPIC_ADMIN . '/panels/background-meta.php');
    require_once (EPIC_ADMIN . '/panels/icon-meta.php');
    require_once (EPIC_ADMIN . '/panels/page-meta.php');
    
  
  	/* 	LOAD CUSTOM WIDGETS
 	===================================================================*/     
	require_once (TEMPLATEPATH . '/widgets/epic_userreg.php');
	require_once (EPIC_LIBRARY . '/widgets/epic_tweets.php');
    require_once (TEMPLATEPATH . '/widgets/epic-latestposts.php');
    require_once (TEMPLATEPATH . '/widgets/flickr.php');
    require_once (TEMPLATEPATH . '/widgets/epic-testimonial.php');
       
}

/* Run the setup */
add_action('after_setup_theme', 'epic_setup');


function epic_update_options(){

	global $user_ID;
	
	/* Create home page and set home page to static page */
	
	// Create home page
	/*
	$homepage = array(
    'post_title' => 'Home',
    'post_type' => 'page',
    'post_excerpt' => 'This page has been created programatically upon theme activation',
    'post_content' => 'This page has been created programatically upon theme activation',
    'post_status' => 'publish',
    'post_author' => $user_ID
  	);
	 
	$homepage_id = wp_insert_post( $homepage);

	update_option( 'page_on_front', $homepage_id );
	update_option( 'show_on_front', 'page' );
	update_post_meta($homepage_id,'epic_pageorder','module-header,module-page-title,module-page-content,module-footer' );
*/
	/* Header */
	//update_option('epic_header_background_color','#333');
	
	
	/* SLIDESHOW 
	
	$slide_1 = array(
    'post_title' => 'Slide 1',
    'post_type' => 'slide',
    'post_excerpt' => 'This is an excerpt',
    'post_status' => 'publish',
    'post_author' => $user_ID
  	);

	$slide_1_id = wp_insert_post( $slide_1 );

	wp_set_object_terms($slide_1_id,'Homepage','slideshow',false);

	$filesrc = get_stylesheet_directory_uri().'/library/images/democontent/imac.png'; // Image src
	//$upload = epic_sideload_image($filesrc, $slide_1_id, 'Sample image 1'); // Upload the image
	update_post_meta($slide_1_id, '_thumbnail_id', $filesrc, true); // Set image as featured image
	*/
	
	
	
	
	/* Images */
	
	update_option('epic_image_resize','vt-resize');
	
	update_option('epic_thumbnail_galleryfullwidth_image_height','400');
	update_option('epic_thumbnail_galleryregular_image_height','300');
	update_option('epic_thumbnail_slideshowfullwidth_image_height','400');
	update_option('epic_thumbnail_slideshowregular_image_height','280');
	update_option('epic_thumbnail_900_image_height','360');
	update_option('epic_thumbnail_590_image_height','300');
	update_option('epic_thumbnail_430_image_height','250');
	update_option('epic_thumbnail_280_image_height','160');
	update_option('epic_thumbnail_210_image_height','140');
	update_option('epic_thumbnail_featured_image_height','160');
	
	update_option('ion_first_run_3','yes');
	
	
	
	/* Add footer credits text */
	update_option('epic_footer_text_left','© Copyright 2012, Your Company. (Edit this text in the theme options panel)');
	
}

$is_first_run = get_option('ion_first_run_3');

if($is_first_run == ''){

	add_action('after_setup_theme','epic_update_options');

}




/* 	PAGE BACKGROUND IMAGE
====================================== */   
function epic_page_background(){
	global $post;
	
	if(is_page() || is_single()){
		$page_background = get_post_meta($post->ID,'epic_page_background',true);
		$fit_to_screen   = get_post_meta($post->ID,'epic_page_background_stretch',true);
	
		if(!empty($page_background) && $fit_to_screen){
	   		$out = '<div id="background_image_container"><img id="background_image" src="'.$page_background.'"/><span></span></div>';
		}
	}
	
	if(!empty($out)){return $out;}

}



/**
 * Post meta in posts and pages
 *
 * Since ver. 1.0
 */


function epic_post_meta(){
	
	global $post,$taxonomy;
		
	?>
	<div class="module-title-meta">
					<div class="meta-avatar"><?php echo get_avatar( get_the_author_email(), '28' );?></div>
					<div class="meta-text">			
						<span class="fat delimiter"><?php _e('By','epic');?> <?php the_author_posts_link();?> <?php _e('on','epic');?> <?php echo get_the_date();?></span>
						
						
						<?php if(is_single()):?>
						<span><?php $u_time = get_the_time('U');
								$u_modified_time = get_the_modified_time('U');
if ($u_modified_time >= $u_time + 86400) {
echo _e('Last modified on ','epic');
the_modified_time('F jS, Y');
_e(' at ','epic');
the_modified_time();
} ?></span>
<?php endif;?>

<br/>

				
				<span class="delimiter"><?php _e('Filed in:  ','epic');?> <?php the_category(', ' , '', $post->ID );?></span>
				<a href="<?php echo  get_comments_link(); ?>"><?php echo get_comments_number().' '.__('comments','epic'); ?></a>		
	</div></div>

	
	<?php
}


/**
 * Header logo 
 *
 * @ Since ver. 1.0
 */

function epic_header_logo(){
	do_action('epic_header_logo');
}


function epic_insert_header_logo(){?>

	<!-- Site logo / title -->
	<div id="logo">
		<?php if (get_option('epic_logo_url')): ?>
			<a href="<?php echo home_url(); ?>"  title="<?php echo get_bloginfo('name');?>"><img src="<?php echo get_option('epic_logo_url');?>" alt="<?php echo get_option('epic_logo_alt');?>" id="logoimage"/></a>
			<?php else: // If no logo is inserted, use text ?>
			<h1><a href="<?php echo home_url(); ?>"><span class="logo-main"><?php echo get_bloginfo('name');?></span><span class="logo-description"><?php bloginfo('description');?></span></a></h1>
		<?php endif;?></div>
	<!-- / site logo/title -->
<?php
}

/* Insert logo via the epic_header_logo hook */
add_action('epic_header_logo','epic_insert_header_logo');



function epic_login_menu(){

	$registration = get_option( 'users_can_register' );
	$loginPageId = get_option('epic_user_login_page');
	$registerPageId = get_option('epic_user_registration_page');
	$profilePageId = get_option('epic_user_profile_page');


	global $current_user, $wp_roles;
	get_currentuserinfo();
	
	echo '<div id="epic_user_menu"><ul>';

	if (!(current_user_can('read')) && !is_user_logged_in() ){ 
		echo '<li class="guest">'.__('Welcome guest','epic').'</li>';
		echo '<li class="signin"><a href="#" class="open_modal">';
		echo __('Sign in or sign up','epic');
		echo '</a></li>';
	}


if ( is_user_logged_in() ) {
	echo '<li class="drop"><a href="#">'.get_the_author_meta('display_name', $current_user->id).'</a><ul>';
	echo '<li><a href="'.get_permalink($profilePageId).'" >';
	echo __('View','epic').' '.get_the_title($profilePageId);
	echo '</a></li></ul></li>';

	echo '<li>';
	

echo '<li class="signout"><a href="'.wp_logout_url(get_permalink()).'" >';
echo __('Sign out','epic');
echo '</a></li>';
}



echo '</ul></div>';

}





function epic_login(){

$out = '';


if ( !is_user_logged_in() ) {
$out.= '<form action="'. home_url().'/wp-login.php" method="post" class="login_form">';
$out.= '<p><label for="log">'.__('Username','epic').'</label><br/><input type="text" name="log" id="log" value="'. esc_html(stripslashes($user_login), 1).'"/></p>';
$out.= '<p><label for="log">'.__('Password','epic').'</label><br/><input type="password" name="pwd" id="pwd" size="20" /></p>';
$out.= '<p><input type="submit" name="submit" value="'. __('Sign in','epic').'"/></p>';
$out.= '<input class="epic_user_checkbox" name="rememberme" id="rememberme" type="checkbox" checked="checked" value="forever"/><label for="rememberme">'.__('Remember me','epic').'</label></p>';
$out.= '<p><input type="hidden" name="redirect_to" value="'. get_permalink().'" /></p>';
$out.= '</form>';


// Reset password form
$out.= '<br class="clearfix"/><h4 class="togglehandle"><a href="#">'. __('Forgotten password?','epic').'</a></h4>';
$out.= '<div class="togglecontainer"><div class="block">';
$out.= '<form action="'. home_url().'/wp-login.php?action=lostpassword" method="post" class="login_form">';
do_action('login_form', 'resetpass'); 
$out.= '<p><input type="text" name="user_login" value="'.__('Enter username or email','epic').'" size="20" id="user_login" tabindex="1001" class="cleardefault"/></p>';
$out.= '<p><input type="submit" name="user-submit" value="'.__('Send my password','epic').'" class="user-submit" tabindex="1002" /></p>';
$reset = $_GET['reset']; if($reset == true) { $out.= __('Your password has been reset, and message containing your new password will be sent to your email address.','epic'); } 
$out.= '<p><input type="hidden" class="epic_button" name="redirect_to" value="'. $_SERVER['REQUEST_URI'].'?reset=true"/></p>';
$out.= '</form>';
$out.= '</div></div>';
}
/*
else{
$profilePageId = get_option('epic_user_profile_page');
$out.= '<div class="epic_icon_user">'.__('You are signed in as:','epic').' '.get_the_author_meta('display_name', $current_user->id).'</div>';
$out.= '<p><a href="'. wp_logout_url(get_permalink()).'">'. __('Log out','epic').'</a></p>';
}
*/
return $out;
}



 


/**
 * Pagination in post loops
 *
 * Pagination in post-listings like blog page, archive, category etc..
 *
 * @ Since ver. 1.0
 */
function epic_pagination() {
    
    global $wp_query, $wp_rewrite;
    
    $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
    
    $pagination = array(
    	'base' => @add_query_arg('paged', '%#%'), 
    	'format' => '', 
    	'total' => $wp_query->max_num_pages, 
    	'current' => $current, 
    	'show_all' => true, 
    	'prev_next' => True, 
    	'prev_text' => __('&laquo; Previous', 'epic'), 
    	'next_text' => __('Next &raquo;', 'epic'), 
    	'type' => 'plain'
    	);
   
    if ($wp_rewrite->using_permalinks()) 
    	$pagination['base'] = user_trailingslashit(trailingslashit(remove_query_arg('s', get_pagenum_link(1))) . 'page/%#%/', 'paged');
    if (!empty($wp_query->query_vars['s'])) 
    	$pagination['add_args'] = array('s' => get_query_var('s'));
    
    echo '<div id="pager">'.paginate_links($pagination).'</div>';
  
}

/* 
 * Pagination inside  posts 
 *
 * This if for adding a pagination inside a post or page when using the <!-- nextpage --> quick tag.
 *
 * @ Since ver. 1.0
 */

function epic_post_pagination(){


	$args = array(
    'before'           => '<div class="post-pagination-wrap">',
    'after'            => '</div>',
    'link_before'      => '',
    'link_after'       => '',
    'next_or_number'   => 'text',
    'nextpagelink'     => ''.__('Continue reading','epic').'',
    'previouspagelink' => ''.__('Go back ', 'epic').'',
    'pagelink'         => '%',
    'more_file'        => '',
    'echo'             => 1 );
     
     wp_link_pages( $args);

}



/**
 * Post comments
 *
 * Since ver. 1.0
 *
 */

function epic_comments($comment, $args, $depth) {
$GLOBALS['comment'] = $comment; ?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
            <div id="comment-<?php comment_ID(); ?>" class="single-comment">
                  
                  
                  <div class="comment-author vcard"> <?php echo get_avatar($comment, $size = '48', $default = '<path_to_url>'); ?></div> 
                  <div class="comment-text">
                       
                  <span class="alignright"><?php edit_comment_link(__('Edit comment', 'epic'), '  ', ''); ?></span>
                  <span class="alignright"><?php comment_reply_link(array_merge($args, array('reply_text' => __('Reply', 'epic'), 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?></span>
                       
                       
                       <h4><?php echo get_comment_author_link(); ?>
                      <span class="tiny"> &nbsp;/&nbsp; <?php echo get_comment_date(); ?></span>
                       </h4>
                       
                       <?php if ($comment->comment_approved == '0'): ?>
                       <p><?php _e('Comment is awaiting moderation', 'epic'); ?></p> 
                       <?php endif; ?>
    			 		
    			 	    <?php comment_text() ?>
                 		                   
                        
							<div class="clearfix"></div>
                        
                    </div>
                    <br class="clearfix" />   
                       
          </div>

            <?php
}



if(get_option('epic_hook_before_innercontent')){
	
	function custom_hook_before_innercontent(){
		$output = stripslashes(get_option('epic_hook_before_innercontent'));
		$output = eval($output);
		return $output;
	}
	
	add_action('epic_before_content','custom_hook_before_innercontent');
}


/**********************************
INSERT GALLERY
**********************************/
function epic_insert_gallery($columns, $per_page, $page_id) {
    global $post;
    
    $resizemethod = get_option('epic_image_resize');
    
    $page_id = $page_id;
    
    if ($page_id != '') {
        $my_page_id = $page_id;
    } else {
        $my_page_id = get_the_ID();
    }
 
   
    $size = 'Thumbnail-280';
       
   
    
    $images = get_children(array(
	'post_parent' => $my_page_id, 
	'post_type' => 'attachment', 
	'post_mime_type' => 'image', 
	'orderby' => 'menu_order', 
	'order' => 'DESC')
	);

    if ( !empty($images) ):
        foreach($images as $image):
            $largephotos[] = wp_get_attachment_url($image->ID, '');
            $smallphotos[] = wp_get_attachment_image($image->ID, $size);
            $imageid[] = $image->ID;
            $imagetitle[] = $image->post_title;
            $imagecaption[] = $image->post_excerpt;
        endforeach;
    endif;
    
    $count = count($largephotos) -1;
    
    $result = '';
    $result.= '<div class="gallery-wrap portfolio-280"><ul class="portfolio-items clearfix">';
    $i = 0;
   
    while ($i <= $count) {
        
        $result.= '<li style="margin:0 20px 20px 0">';
        $result.= '<a href="' . $largephotos[$i] . '" rel="prettyPhoto[gall]" title="'.$imagecaption[$i].'">';
        
        if($resizemethod == 'wordpress'){
			$result.= $smallphotos[$i];
		}
		
		elseif($resizemethod == 'vt-resize') {
		$imagem = vt_resize( $imageid[$i], '' , EPIC_280_WIDTH, EPIC_THUMBNAIL_280_HEIGHT, true );
		$result.= '<img src="'.$imagem[url].'" alt="'.$imagetitle[$i].'"/>';
		}
		        
       
        $result.= '<span class="p-enlarge"></span></a></li>';
        $i++;
    }
    $result.= '</ul></div>';
   
    return $result;
}







/**
 * Function for creating inline sidebar
 *
 * @ Since ver. 1.0
 */
function epic_inline_sidebar(){
    
    /* Check if an inline sidebar has been selected.
    If true insert class="inlinecontent" */
    global $post;
    
    $sidebar = get_post_meta($post->ID, 'epic_selectsidebar_left', true);
    $inlinesidebar = get_post_meta($post->ID, 'epic_selectsidebar_inline', true);
    $sidebarposition = get_post_meta($post->ID, 'epic_inlinesidebar_position', true);
    
    
    
        if ($inlinesidebar != '' && $inlinesidebar != 'No Sidebar' && $sidebar == 'No Sidebar') {
            $divclass = 'grid_13 position-'.$sidebarposition;
        }
        
    
     	elseif ($inlinesidebar != '' && $inlinesidebar != 'No Sidebar' && $sidebar != 'No Sidebar') {
            $divclass = 'grid_8 position-'.$sidebarposition;
        }
        
        else{
        	$divclass = 'container_full';
        }
        
    

    if (!empty($divclass)) {
    
        return ' class="' . $divclass . '"';
    }
}



// Inserts analytics code from theme options panel
function epic_tracking(){
	
	$output = get_option('epic_analytics'); 
	if(!empty($output)){
	
	echo stripslashes($output);
	
	}
}

add_action('wp_footer','epic_tracking');



/**
 * Function for creating titles on all templates
 *
 *  From ver. 1.0
 */
 
 
/* Create the hook */

function epic_title($link){
	do_action('epic_title', $link);
} 


 
/* Check if function exists (in child theme) */ 

if(!function_exists('epic_insert_title')){

	function epic_insert_title($link){
		global $post, $category, $author;
		
		$output = ''; 
		$title = '';
		//$title .= '<header class="postheader">';
		
		// For pages and single posts
				
		if($link){
			$output.= '<a href="'.get_permalink().'">';
			}
		
			$output.= get_the_title();
			
		if($link){
			$output.= '</a>';
		}
		
		
			
		$posttitle = $output;
				
		
		$subtitle = get_post_meta($post->ID,'epic_subtitle',true);
		if(!empty($subtitle)){
				$title .= '<h3 class="sub-title">'.$subtitle.'</h3>';
			
		}
		
		
		$title .= '<h1>' . $posttitle  . '</h1>';
		//$title .= '</header>';
		
		echo apply_filters('epic_posttitle', $title);
	
}


add_action('epic_title','epic_insert_title',1);
}

function epic_subtitle(){

	
	global $post;
	$subtitle = get_post_meta($post->ID,'epic_subtitle',true);
	if(!empty($subtitle)){
	return '<h3 class="sub-title">'.$subtitle.'</h3>';
	}

}



/**
 * Insert category description on category-template and taxonomy-template
 * Placed in the epic_title hook
 *
 * From ver. 1.0
 */
 
function epic_categorydescription(){
	
	global $term;
	
	remove_filter('term_description','wpautop');

	if(is_category() || is_tax()){
		
		
		$output = '';
		$output.= '<p>';
		$output.= term_description();
		$output.= '</p>';
		
		$output = apply_filters ( 'epic_categorydescription_markup' , $output );
		
		
		echo $output;
	}
	
}

//add_action('epic_title','epic_categorydescription', 2);



// Button generating 

function epic_button($atts){
	
	return '<a href="'.get_permalink($atts[0]).'"  class="epic_button epic_button_'.$atts[2].' epic_button_'.$atts[3].'" rel="'.$atts[4].'"><span></span>'.$atts[1].'</a>';
}



/** 
 * Author info-box
 *
 * Since ver 1.0
 */
function epic_author_info() {

	if(get_post_meta($post->ID,'epic_displayauthor',true) == true){
    // If a user has filled out their description, show a bio on their entries.
    global $author;
    if (get_the_author_meta('description')):
        $author = get_the_author();
        $authorlink = get_the_author_link();
        $output = '<br class="break" />';
        $output.= '<div class="author-box clearfix">';
        $output.= '<h2>' . __('About the author:', 'epic') . ' ' . $author . '</h2>';
        $output.= '<div class="author-box">';
        $output.= get_avatar(get_the_author_meta('user_email'), '70');
        $output.= '<p>';
        $output.= get_the_author_meta('description');
        $output.= '</p>';
        $output.= '</div></div>';
    endif;
    
    
    
    global $post;
   
    $tags = wp_get_post_tags($post->ID);
    if ($tags) {
        $tag_ids = array();
        foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
        $args = array( 'post__not_in' => array($post->ID), 'author=' => get_the_author_meta('user_id'),'showposts' => 3, // Number of related posts that will be shown.
        'caller_get_posts' => 1);
        $my_query = new wp_query($args);
        if ($my_query->have_posts()) {
            $output.= '<div id="related_posts"><h4>'.__('Other posts by','epic').' '. get_the_author().'</h4>';
            $count = 0;
            $output.= '<ul>';
            while ($my_query->have_posts() && $count < 3) {
               $count++;
               
               if($count % 3 == 0){$pos = 'class="last"';} else {$pos = '';}
               
               
                $my_query->the_post();
                
                $output.= '<li '.$pos.'>';
                
                $output.= '<h5><a href="' . get_permalink() . '">';
                $output.= get_the_title().'</a></h5> ';
               
                $args = array(
					'page_id' 		=> $post->ID,
					'excerptlimit' 	=> '40'
					//'link' 			=> 'text',
					//'string'		=> __('Read post','epic') 
					);
				$output.= epic_post_excerpt($args);
                
                
                 $output.= '</li>';
                
               if($count % 3 == 0){$output.= '<div class="clearfix"></div>';}
                 
            }
            $output.= '</ul>';
            $output.= '<p><a href="' . get_author_posts_url(get_the_author_meta('ID')) . '" class="epic_link">' . __('Show all posts by', 'epic') . ' ' . get_the_author() . '</a></p><br class="clearfix" />';
            $output.= '</div>';
            wp_reset_query();
                         
        }
    }

    
    
    return $output;
    
    }
}

/** 
 * Related posts module
 *
 * Since ver 1.0
 */
 
 
function epic_related_posts($max_posts) {
    global $post;
    
    if(get_post_meta($post->ID,'epic_displayrelatedposts',true) == true){
    
    $max_posts = 3;
    $tags = wp_get_post_tags($post->ID);
    if ($tags) {
        $tag_ids = array();
        foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
        $args = array('tag__in' => $tag_ids, 'post__not_in' => array($post->ID), 'showposts' => $max_posts, // Number of related posts that will be shown.
        'caller_get_posts' => 1);
        $output = '';
        $my_query = new wp_query($args);
        if ($my_query->have_posts()) {
            $output.= '<div id="related_posts" class="clearfix"><h4>'.__('Related posts','epic').'</h4>';
            $count = 0;
            $output.= '<ul>';
            
            while ($my_query->have_posts() && $count < $max_posts) {
               $count++;
               
               if($count % 3 == 0){$pos = 'class="last"';} else {$pos = '';}
               
               
                $my_query->the_post();
                
                $output.= '<li '.$pos.'>';
                
                $output.= '<h5><a href="' . get_permalink() . '">';
                $output.= get_the_title().'</a></h5> ';
               
                $args = array(
					'page_id' 		=> $post->ID,
					'excerptlimit'	=> '40'
					);
				$output.= epic_post_excerpt($args);
                
                
                 $output.= '</li>';
                
               if($count % 3 == 0){$output.= '<div class="clearfix"></div>';}
                 
            }
            $output.= '</ul><br class="clearfix" />';
            $output.= '</div>';
            wp_reset_query();
            return $output;
             
        }
    }
   }
}


function epic_tweets(){
	 		
	$twitteruser = get_option('epic_twitter_user');
	$count = get_option('epic_twitter_tweet_count');
	$header = get_option('epic_twitter_header');
	
	$output  = '';
	$output .=  '<ul id="twitter_update_list"><li>Twitter feed loading</li></ul>';
	$output .= '<a href="http://twitter.com/'.$twitteruser.'" id="twitterlink">'.__('Follow us','epic').'</a>';
	$output .= '<script type="text/javascript" src="http://twitter.com/javascripts/blogger.js"></script>
	<script type="text/javascript" src="http://twitter.com/statuses/user_timeline/'. $twitteruser .'.json?callback=twitterCallback2&amp;count='. $count .'"></script>
';	
	return $output;
}


function epic_sharing(){

	global $post;
	
	//if(get_post_meta($post->ID,'epic_displaysharing',true) == true){
	
	$twitteruser = get_option('epic_twitter_user');
	?>
	<div class="epic_sharing">
	
	<a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal" data-via="<?php echo $twitteruser;?>"><?php _e('Tweet','epic');?></a>
	<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
	<div id="fb-root"></div>
	<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="fb-like" data-send="false" data-layout="button_count" data-width="80" data-show-faces="true" data-font="arial"></div>
	
	</div>
<?php
	//}
}

if(!function_exists('epic_featured_title')){
	function epic_featured_title($id,$title){
		
		$args = array($id,$title);
	
		$featuredtitle = '<h4><a href="'. get_permalink($id) .'">'.$title .'</a></h4>';
		
		return apply_filters('epic_theme_featured_title',$featuredtitle );
	}
}


if(!function_exists('epic_socialize')){
	
	function epic_socialize(){
	
	
		// SOCIABLES - PULLED FROM THEME ADMIN
		
		$smi_image_1=get_option('epic_smi_image_1');
		$smi_url_1=get_option('epic_smi_url_1');
		$smi_text_1=get_option('epic_smi_text_1');

		$smi_image_2=get_option('epic_smi_image_2');
		$smi_url_2=get_option('epic_smi_url_2');
		$smi_text_2=get_option('epic_smi_text_2');

		$smi_image_3=get_option('epic_smi_image_3');
		$smi_url_3=get_option('epic_smi_url_3');
		$smi_text_3=get_option('epic_smi_text_3');
		
		$smi_image_4=get_option('epic_smi_image_4');
		$smi_url_4=get_option('epic_smi_url_4');
		$smi_text_4=get_option('epic_smi_text_4');
		
		$smi_image_5=get_option('epic_smi_image_5');
		$smi_url_5=get_option('epic_smi_url_5');
		$smi_text_5=get_option('epic_smi_text_5');
		
		$smi_image_6=get_option('epic_smi_image_6');
		$smi_url_6=get_option('epic_smi_url_6');
		$smi_text_6=get_option('epic_smi_text_6');
		
		$smi_image_7=get_option('epic_smi_image_7');
		$smi_url_7=get_option('epic_smi_url_7');
		$smi_text_7=get_option('epic_smi_text_7');
		
		$smi_image_8=get_option('epic_smi_image_8');
		$smi_url_8=get_option('epic_smi_url_8');
		$smi_text_8=get_option('epic_smi_text_8');
		
		$smi_image_9=get_option('epic_smi_image_9');
		$smi_url_9=get_option('epic_smi_url_9');
		$smi_text_9=get_option('epic_smi_text_9');
		
		$smi_image_10=get_option('epic_smi_image_10');
		$smi_url_10=get_option('epic_smi_url_10');
		$smi_text_10=get_option('epic_smi_text_10');
		
		?>

		<ul class="epic_socialmedia">
				
			<?php if ($smi_image_1==true and $smi_url_1==true):?>
			<li><a href="<?php echo $smi_url_1;?>" title="<?php echo $smi_text_1;?>" rel="external"><img src="<?php echo $smi_image_1;?>"  alt="<?php echo $smi_text_1;?>" /></a></li>
			<?php endif;?>
			<?php if ($smi_image_2==true and $smi_url_2==true):?>
			<li><a href="<?php echo $smi_url_2;?>" title="<?php echo $smi_text_2;?>"  rel="external"><img src="<?php echo $smi_image_2;?>"  alt="<?php echo $smi_text_2;?>" /></a></li>
			<?php endif;?>
			<?php if ($smi_image_3==true and $smi_url_3==true):?>
			<li><a href="<?php echo $smi_url_3;?>" title="<?php echo $smi_text_3;?>"  rel="external"><img src="<?php echo $smi_image_3;?>"  alt="<?php echo $smi_text_3;?>" /></a></li>
			<?php endif;?>
			<?php if ($smi_image_4==true and $smi_url_4==true):?>
			<li><a href="<?php echo $smi_url_4;?>" title="<?php echo $smi_text_4;?>"  rel="external"><img src="<?php echo $smi_image_4;?>"  alt="<?php echo $smi_text_4;?>" /></a></li>
			<?php endif;?>
			<?php if ($smi_image_5==true and $smi_url_5==true):?>
			<li><a href="<?php echo $smi_url_5;?>" title="<?php echo $smi_text_5;?>"  rel="external"><img src="<?php echo $smi_image_5;?>"  alt="<?php echo $smi_text_5;?>" /></a></li>
			<?php endif;?>
			<?php if ($smi_image_6==true and $smi_url_6==true):?>
			<li><a href="<?php echo $smi_url_6;?>" title="<?php echo $smi_text_6;?>"  rel="external"><img src="<?php echo $smi_image_6;?>" alt="<?php echo $smi_text_6;?>" /></a></li>
			<?php endif;?>
			<?php if ($smi_image_7==true and $smi_url_7==true):?>
			<li><a href="<?php echo $smi_url_7;?>" title="<?php echo $smi_text_7;?>"  rel="external"><img src="<?php echo $smi_image_7;?>"alt="<?php echo $smi_text_7;?>" /></a></li>
			<?php endif;?>
			<?php if ($smi_image_8==true and $smi_url_8==true):?>
			<li><a href="<?php echo $smi_url_8;?>" title="<?php echo $smi_text_8;?>"  rel="external"><img src="<?php echo $smi_image_8;?>" alt="<?php echo $smi_text_8;?>" /></a></li>
			<?php endif;?>
			<?php if ($smi_image_9==true and $smi_url_9==true):?>
			<li><a href="<?php echo $smi_url_9;?>" title="<?php echo $smi_text_9;?>"  rel="external"><img src="<?php echo $smi_image_9;?>"  alt="<?php echo $smi_text_9;?>" /></a></li>
			<?php endif;?>
			<?php if ($smi_image_10==true and $smi_url_10==true):?>
			<li><a href="<?php echo $smi_url_10;?>" title="<?php echo $smi_text_10;?>"  rel="external"><img src="<?php echo $smi_image_10;?>"  alt="<?php echo $smi_text_10;?>" /></a></li>
			<?php endif;?>
		</ul>
				
				<?php	

	
	
	}
}







function lang_page_id($id){
  if(function_exists('icl_object_id')) {
    return icl_object_id($id,'page',false);
  } else {
    return $id;
  }
}

function get_attachment_id_from_src ($image_src) {

		global $wpdb;
		$query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
		$id = $wpdb->get_var($query);
		return $id;

	}
	
	
function epic_sideload_image($file, $post_id, $desc = null) {

	if ( ! empty($file) ) {

		// Download file to temp location

		$tmp = download_url( $file );

		// Set variables for storage

		// fix file filename for query strings

		preg_match('/[^\?]+\.(jpg|JPG|jpe|JPE|jpeg|JPEG|gif|GIF|png|PNG)/', $file, $matches);

		$file_array['name'] = basename($matches[0]);

		$file_array['tmp_name'] = $tmp;

		// If error storing temporarily, unlink

		if ( is_wp_error( $tmp ) ) {

			@unlink($file_array['tmp_name']);

			$file_array['tmp_name'] = '';

		}

		// do the validation and storage stuff

		$id = media_handle_sideload( $file_array, $post_id, $desc );

		// If error storing permanently, unlink

		if ( is_wp_error($id) ) {

			@unlink($file_array['tmp_name']);

			return $id;

		}

		$src = wp_get_attachment_url( $id );
		
		return $id;

	}

	// Finally check to make sure the file has been saved, then return the html

	if ( ! empty($src) ) {

		$alt = isset($desc) ? esc_attr($desc) : '';

		$html = "<img src='$src' alt='$alt' />";

		

	}

}


if(!function_exists('signup_form')){
	
	function signup_form(){

		global $user_login, $current_user, $user_ID, $user_identity; get_currentuserinfo();
		$registration = get_option( 'users_can_register' );
		echo '<div id="modal_signup"><div id="modal_signup_form">';
		
		
		
		// Sign in
		echo '<div id="signin">';
		echo '<h2>Sign in</h2>';
		echo '<form action="'. home_url().'/wp-login.php" method="post">';
		echo '<div><label>Enter username</label><input type="text" name="log" id="log" value="'. esc_html(stripslashes($user_login), 1).'"/></div>';
		echo '<div><label>Enter password</label><input type="password" name="pwd" id="pwd" size="20" /></div>';
		echo '<div><input type="submit" name="submit" value="'. __('Sign in','epic').'"/></div><div class="clearfix"></div>';
		echo '<p><input name="rememberme" id="rememberme" type="checkbox" checked="checked" value="forever"/><label for="rememberme">'.__('Remember me','epic').'</label></p>';
		echo '<div><input type="hidden" name="redirect_to" value="'. get_permalink().'" /></div>';
		echo '</form>';
		
		echo '</div>';
		
		
		// Sign up
		echo '<div id="signup">';
		echo '<h2>Sign up</h2>';
		echo '<form method="post" id="add_user" action="http://'. $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'].'" class="user_form">'; 
		echo '<div><label>Enter username</label><input name="user_name" type="text" id="user_name" value="" /></div>';
		echo '<div><label>Enter email</label><input name="user_email" type="text" id="user_email" value="" /></div>'; 
		echo $referer;
		echo '<p><input name="adduser" type="submit" id="addusersub" value="'.__('Register', 'epic').'"/></p><div class="clearfix"></div>';
		echo '<p>'.__('A password will be e-mailed to you.','epic').'</p>';
		wp_nonce_field( 'add-user');
		echo '<div><input name="action" type="hidden" id="action" value="add_user"/></div>';
		echo '</form></div>';
		
		
		
		// Reset password
		echo '<div id="reset">';
		echo '<h2>Reset password</h2>';
		echo '<form action="'. home_url().'/wp-login.php?action=lostpassword" method="post">';
		do_action('login_form', 'resetpass'); 
		echo '<div class="epic_icon_user"><input type="text" name="user_login" value="'.__('Enter username or email','epic').'" size="20" id="user_login" tabindex="1001" class="cleardefault"/></div>';
		echo '<div><input type="submit" name="user-submit" value="'.__('Send my password','epic').'" class="user-submit" tabindex="1002" /></div><div class="clearfix"></div>';
		$reset = $_GET['reset']; 
		if($reset == true) { 
		echo __('Your password has been reset, and message containing your new password will be sent to your email address.','epic'); 
		} 
		echo '<div><input type="hidden" class="epic_button" name="redirect_to" value="'. $_SERVER['REQUEST_URI'].'?reset=true"/></div>';
		echo '</form>';
		echo '</div>';
		
		
		echo '<div id="signupform_nav">';
		echo '<a href="#" id="link_signin" data-rel="signin">Sign in</a> | ';
		echo '<a href="#" id="link_register" data-rel="signup">Create account</a> | ';
		echo '<a href="#" id="link_forgotten" data-rel="reset">Forgotten password?</a>';
		echo '</div><br/><br/>';
		echo '<p style="text-align:center;"><a href="#" id="closemodal">Close window</a></p>';
		
		echo '</div></div>';

	}
}

//add_action('wp_footer','signup_form');



// Widget for user login and registration

function epic_user_module($login_title, $login_text, $login_subtext, $signup_title, $signup_text, $signup_subtext, $welcome_text, $welcome_subtext, $method){
	
$loginPageId = get_option('epic_user_login_page');
$registerPageId = get_option('epic_user_registration_page');
$profilePageId = get_option('epic_user_profile_page');



$formStr= '';

global $user_login, $current_user, $user_ID, $user_identity; get_currentuserinfo();
$formStr.= '<div class="tabs">';
if ( !is_user_logged_in() ) {
$formStr .= '<ul class="epic_tabnav">';
$formStr .= '<li><a href="#tab1">'.strip_tags($signup_title).'</a></li>';
$formStr .= '<li><a href="#tab2">'.strip_tags($login_title).'</a></li>';
$formStr .= '</ul>';
}


if ( !is_user_logged_in() ) {
$formStr.= '<div data-id="#tab1" class="tabcontent">';
$formStr.= '<h3>'.strip_tags($signup_text).'</h3>';
$formStr.= '<p>'.strip_tags($signup_subtext).'</p>';
// Register user
$formStr.= '<form method="post"  action="http://'. $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'].'">'; 
$formStr.= '<div><input name="user_name" type="text"  value="'.__('Username','epic').'" class="cleardefault" /></div>';
$formStr.= '<div><input name="user_email" type="text"  value="'.__('Email','epic').'" class="cleardefault" /></div>'; 
$formStr .= $referer;
$formStr.= '<div><input name="adduser" type="submit"  value="'.__('Register', 'epic').'"/></div>';
wp_nonce_field( 'add-user');
$formStr.= '<div><input name="action" type="hidden"  value="add_user"/></div>';
$formStr.= '<p>A password will be e-mailed to you.</p>';  
$formStr.= '</form>';
$formStr.= '</div>';

// Login form
$formStr.= '<div data-id="#tab2" class="tabcontent">';
$formStr.= '<h3>'.strip_tags($login_text).'</h3>';
$formStr.= '<p>'.strip_tags($login_subtext).'</p>';
$formStr.= '<form action="'. home_url().'/wp-login.php" method="post" >';
$formStr.= '<div><input type="text" name="log" size="30" value="'. esc_html(stripslashes($user_login), 1).'"/></div>';
$formStr.= '<div><input type="password" name="pwd"  size="30" /></div>';
$formStr.= '<div><input type="submit" name="submit" value="'. __('Sign in','epic').'"/>';
$formStr.= '<input name="rememberme"  type="checkbox" checked="checked" value="forever"/><label for="rememberme">'.__('Remember me','epic').'</label></div>';
$formStr.= '<div><input type="hidden" name="redirect_to" value="'. get_permalink().'" /></div>';
$formStr.= '</form>';

// Reset password form
$formStr.= '<h4 class="togglehandle"><a href="#">'. __('Forgotten password?','epic').'</a></h4>';
$formStr.= '<div class="acc_container"><div class="block">';
$formStr.= '<form action="'. home_url().'/wp-login.php?action=lostpassword" method="post" class="login_form">';
do_action('login_form', 'resetpass'); 
$formStr.= '<div><input type="text" name="user_login" value="'.__('Enter username or email','epic').'" size="20"  tabindex="1001" class="cleardefault"/></div>';
$formStr.= '<div><input type="submit" name="user-submit" value="'.__('Send my password','epic').'" class="user-submit" tabindex="1002" /></div>';
$reset = $_GET['reset']; if($reset == true) { $formStr.= __('Your password has been reset, and message containing your new password will be sent to your email address.','epic'); } 
$formStr.= '<div><input type="hidden" name="redirect_to" value="'. $_SERVER['REQUEST_URI'].'?reset=true"/></div>';
$formStr.= '</form>';
$formStr.= '</div></div></div>';
}

// User welcome
if ( is_user_logged_in() ) {
$formStr.= '<div class="formcontent">';
$formStr.= '<h3>'.__($welcome_text,'epic').'</h3>';
$formStr.= '<p>'.__($welcome_subtext,'epic').'</p>';
$formStr.= '<p>'.__('Signed in as:','epic').' '.get_the_author_meta('display_name', $current_user->id).'</p>';
$formStr.= '<p><a href="'. get_permalink($profilePageId).'" class="epic_button epic_button_regular epic_button_default epic_button_left">'. __('View profile','epic').'</a> <a href="'. wp_logout_url(get_permalink()).'" class="epic_button epic_button_regular epic_button_default epic_button_left">'. __('Sign out','epic').'</a></p>';
$formStr.= '<br class="clearfix">';
$formStr.= '</div>';
}

$formStr.= '</div>';

return $formStr;
}




/* VIDEO */
/* Insert video into post via shortcode
=======================================================================*/
function epic_video($args) {

global $post;

extract($args);

	$output = "";
	
	//Post meta
	if( $type == 'youtube' || $type == 'vimeo'){
  
    	if ($type == 'epic_vimeo' || $type == 'vimeo') {
       		$url = 'http://vimeo.com/moogaloop.swf?clip_id=' . $id;
    	} elseif ($type == 'epic_youtube' || $type == 'youtube') {
       		$url = 'http://www.youtube.com/v/' . $id;
    	}
    
    
    // Markup
    
    if (strstr($_SERVER['HTTP_USER_AGENT'], 'iPad') || strstr($_SERVER['HTTP_USER_AGENT'], 'iPhone') || strstr($_SERVER['HTTP_USER_AGENT'], 'iPod')) {
        if ($type == 'vimeo') {
            $output.= '<div class="video-wrapper"><figure class="video-container">';
            $output.= '<iframe src="http://player.vimeo.com/video/';
            $output.= $id;
            $output.= '?portrait=0&amp;color=ff7f00"  frameborder="0"  ></iframe>';
            $output.= '</div>';
        } elseif ($type == 'youtube') {
            $output.= '<figure>';
            $output.= '<iframe  title="YouTube video player" class="youtube-player" type="text/html" ';
            $output.= ' src="http://www.youtube.com/embed/';
            $output.= $id;
            $output.= '?rel=0&amp;hd=1" frameborder="0"></iframe>';
            $output.= '</figure></div>';
        }
    } else {
        $output.= '<div class="video-wrapper"><figure class="video-container clearfix" >';
        $output.= '<object type="application/x-shockwave-flash" data="' . $url . '" >';
        $output.= '<param name="allowScriptAccess" value="always" />';
        $output.= '<param name="scale" value="exactfit"/>';
        $output.= '<param name="allowFullScreen" value="true" />';
        $output.= '<param name="movie" value="' . $url . '" />';
        $output.= '<param name="quality" value="high" />';
        $output.= '<param name="wmode" value="transparent" />';
        $output.= '<param name="bgcolor" value="#ffffff" />';
        //$output.= '<img src="banner.gif" width="100%" height="100%" alt="banner" />';
        $output.= '</object>';
        $output.= '</figure></div>';
    }
}
    
elseif ($type == 'self'){
    
$player_id = rand(0,1000);
    
$output .= '<script>
jQuery(document).ready(function($){
$("#jquery_jplayer_'. $player_id .'").jPlayer({
		ready: function () {
			$(this).jPlayer("setMedia", {
				m4v: "'. $m4v .'",
				ogv: "'. $ogv .'",
				webmv: "'. $webmv .'",
				poster: "'. $poster .'"
				});
				
						
			},
				
		
		play: function() { // To avoid both jPlayers playing together.
			$(this).jPlayer("pauseOthers");
				
		},
		repeat: function(event) { // Override the default jPlayer repeat event handler
			if(event.jPlayer.options.loop) {
				$(this).unbind(".jPlayerRepeat").unbind(".jPlayerNext");
				$(this).bind($.jPlayer.event.ended + ".jPlayer.jPlayerRepeat", function() {
					$(this).jPlayer("play");
				});
			} else {
				$(this).unbind(".jPlayerRepeat").unbind(".jPlayerNext");
				$(this).bind($.jPlayer.event.ended + ".jPlayer.jPlayerNext", function() {
					$("#jquery_jplayer_'. $player_id .'").jPlayer("play", 0);
				});
			}
		},
		
		swfPath: "/library/scripts/jPlayer/",
		supplied: "webmv, ogv, m4v",
		size:{width:"100%", height:"auto",cssClass:"jp_video_regular"}, 
		cssSelectorAncestor: "#jp_container_'. $player_id .'"	
	}); 
});
</script>    
    <div class="video-container-self">
    <div id="jp_container_'. $player_id .'" class="jp-video ">
    <div class="jp-type-single">
      <div id="jquery_jplayer_'. $player_id .'" class="jp-jplayer"></div>
      <div class="jp-gui">
        <div class="jp-video-play">
          <a href="javascript:;" class="jp-video-play-icon" tabindex="1">play</a>
        </div>
        <div class="jp-interface">
          <div class="jp-progress">
            <div class="jp-seek-bar">
              <div class="jp-play-bar"></div>
            </div>
          </div>
          <div class="jp-controls-holder">
            <ul class="jp-controls">
              <li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li>
              <li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>
              <li><a href="javascript:;" class="jp-stop" tabindex="1">stop</a></li>
              <li><a href="javascript:;" class="jp-mute" tabindex="1" title="mute">mute</a></li>
              <li><a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute">unmute</a></li>
              <li><a href="javascript:;" class="jp-volume-max" tabindex="1" title="max volume">max volume</a></li>
            </ul>
            <ul class="jp-toggles">
              <li><a href="javascript:;" class="jp-full-screen" tabindex="1" title="full screen">full screen</a></li>
              <li><a href="javascript:;" class="jp-restore-screen" tabindex="1" title="restore screen">restore screen</a></li>
              <li><a href="javascript:;" class="jp-repeat" tabindex="1" title="repeat">repeat</a></li>
              <li><a href="javascript:;" class="jp-repeat-off" tabindex="1" title="repeat off">repeat off</a></li>
            </ul>
            <div class="jp-volume-bar">
              <div class="jp-volume-bar-value"></div>
            </div>
          
          <div class="jp-current-time"></div>
          <div class="jp-title">
            <ul>
              <li></li>
            </ul>
          </div>
          <div class="jp-duration"></div>
          
          </div>
          
        </div>
      </div>
      <div class="jp-no-solution">
        <span>Update Required</span>
        To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
      </div>
    </div>
  </div>
  </div>';
	}
return $output;	

}

if(!function_exists('subMenu')){
function subMenu($post_id){
	
	global $post;
	$pagemenu = get_post_meta($post_id, 'epic_selectmenu',true);

	if(!empty($pagemenu)){

				wp_nav_menu( array( 
					'menu'				=> $pagemenu,
					'container'    		=> 'nav',
					'sort_column' 		=> 'menu_order',
					'container_id' 		=> 'epic_submenu', 
					'container_class' 		=> 'clearfix', 
					'menu_id' 			=> 'menu-sub'
					)
				);
			}
	}
}
	

// Counts sidebar widgets for column calculations in some widgetized areas
function count_sidebar_widgets( $sidebar_id, $echo = true ) {
    $the_sidebars = wp_get_sidebars_widgets();
    if( !isset( $the_sidebars[$sidebar_id] ) )
        return __( 'Invalid sidebar ID','epic' );
    if( $echo )
        echo count( $the_sidebars[$sidebar_id] );
    else
        return count( $the_sidebars[$sidebar_id] );
}

/* Creates page excerpts for use in loops etc.
====================================================== */
function epic_post_excerpt($args) {
  
  extract($args);
  
  if(empty($link)){ $link = '';}
  if(empty($excerptlimit)){ $excerptlimit = '';}
  //if(empty($link)){ $link = '';}	  

  if( $page_id == null ) return false;
  
  $page_data = get_page( $page_id );
  $page_content = $page_data->post_content; 
  $page_excerpt = $page_data->post_excerpt; 
  
  if(!empty($page_content)){
  		$limit = strpos( $page_content, "<!--more-->", 1);
  		$val =  substr($page_content, 0, $limit);
  	}

	
  $output = '';
  
  // If page has excerpt...
  
  if(!empty($page_excerpt)){
  	
  	if($excerptlimit){
  	$stringlength = strlen($page_excerpt) - 4;
  	 
  	  
  	if ($stringlength  > $excerptlimit) {
	$page_excerpt = substr($page_excerpt,0,strpos($page_excerpt, ' ', $excerptlimit)); 
	$page_excerpt = $page_excerpt.'…';
	} else {
	$page_excerpt = $page_excerpt;
	}
	}
	$output .= apply_filters('the_excerpt',$page_excerpt);  	
  	//$output .= '<p>'.do_shortcode($page_excerpt).'</p>';
	
	// Button 
  	if($link == 'button'){
  		$output.=  epic_button(array($page_id, $string, 'default', 'regular','')); 
  	}
  	// Text link
  	if($link == 'text'){
  		$output.=  '<a href="'.get_permalink($page_id).'" class="epic_link">'.$string.'</a>'; 
  	}
  	
  	return $output;
  }
  	
  
  // If page has more-quicktag, echo up to <!--more-->
  
  elseif(!empty($limit)){
  
  	  
 	$output .= wpautop(do_shortcode($val));
  	
  	if($link == true && !empty($size)){
  		$output.=  epic_button(array($page_id, $string, $buttoncolor, $buttonsize,'')); 
  	}
  	
  	if($link == true && empty($size)){
  		$output.=  '<a href="'.get_permalink($page_id).'" class="epic_link">'.$string.'</a>'; 
  	}
  	return $output; 
    }
  
  // Else echo the content in full
  
  else {
  
  	return wpautop(do_shortcode($page_content));
  		
  }
}


if(!function_exists('epic_socialicons')){
	function epic_socialicons($icons){
		
		$opt = "";
		$opt.= '<ul class="socialicons">';
		foreach ($icons as $icon): 
			$opt.= '<li class="icon-'.$icon.'"><a href="'.get_option('epic_socialmedia_'.$icon).'" title="'.$icon.'"></a></li>';
			endforeach;
		$opt.= '</ul>';			
		
		return $opt;

	}
}


class Dropdown_walker extends Walker_Nav_Menu
{
      function start_el(&$output, $item, $depth, $args)
      {
      
      	   global $wp_query;
           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

           $class_names = $value = '';

           $classes = empty( $item->classes ) ? array() : (array) $item->classes;

           $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
           $class_names = ' class="'. esc_attr( $class_names ) . '"';

           $output .= $indent . '<option id="menu-item-'. $item->ID . '" value="'.esc_attr( $item->url).'">';

    

            $item_output = $args->before;
            $item_output .= $args->link_before .apply_filters( 'the_title', $item->title, $item->ID );
            $item_output .= $args->link_after;
            $item_output .= $args->after;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
           
      }
      
      function end_el(&$output, $item, $depth){
      		$output .= "</option>\n"; // replace closing </li> with the option tag
    	}
      
}

function epic_random_testimonial(){
	
	global $post;
		
		$args = array(
		'post_type' => 'testimonial',
		'showposts'=> 1,
		'orderby' => 'rand',
		);
		
		query_posts($args);
		
		echo '<div class="testimonial-widget">';
		//$title = apply_filters('widget_title', $instance['title'] );

		if (have_posts()): while (have_posts()) : the_post(); 
		$signature = get_post_meta($post->ID,'epic_testimonial_writer',true);
		?>
		<div class="testimonial-content">
			<?php the_excerpt(); ?>
		</div>
		<div class="testimonial-name">
		<?php echo $signature;?>
		</div>
		<?php
		endwhile; endif;
		wp_reset_query();
		echo '</div>';				
}


?>