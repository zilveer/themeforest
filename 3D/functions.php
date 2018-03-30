<?php
/**
 * @package WordPress
 * @subpackage 3D
 * @since Idea 3D
 * Graphic Desing : Ilkay ALPGIRAY
 * Code : Mustafa TANRIVERDI
 */
 // register an action (can be any suitable action)
add_action('admin_init', 'on_admin_init');

function on_admin_init()
{
    // include the library
    include_once('envato-wordpress-toolkit-library/class-envato-wordpress-theme-upgrader.php');
    
    $upgrader = new Envato_WordPress_Theme_Upgrader( 'imtheme', 'toze3xg0z7jluuw2enddd70b9xs97911' );
    
    /*
     *  Uncomment to check if the current theme has been updated
     */
    
    // $upgrader->check_for_theme_update(); 

    /*
     *  Uncomment to update the current theme
     */
    
    // $upgrader->upgrade_theme();
}
?>
<?php
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'menus' );
?>
<?php
// ADMIN PANEL
if (file_exists(TEMPLATEPATH.'/admin/iamadmin.php')) include_once("admin/iamadmin.php");
?>
<?php
/* -----------------------------------------------
IM THEME NEW POST DEFAULT
----------------------------------------------- */
function im_custom_boxes() {
    add_meta_box( 'Bar', 'IM Page', 'im_post_options', 'post', 'advanced', 'core');
    add_meta_box( 'Bar', 'IM Page', 'im_post_options', 'page', 'advanced', 'core');
}

function im_post_options(){
	global $prefix;
	global $post;
	$post_id = $post->ID;
	 ?>
     	<style>@import url(<?php bloginfo('template_url'); ?>/admin/css/style.css);</style>
        <div class="stage">
        <h1 class="mini-title">Description : </h1>
     	<input type="text" name="im_theme_3D_description" id="im_theme_3D_description" class="form-input" value="<?php echo get_post_meta($post_id, 'im_theme_3D_description', true); ?>"/>
        <div class="clear"></div>
        </div>
        
        <div class="stage">
        <h1 class="mini-title">Download Size : </h1>
        <input type="text" name="im_theme_3D_download_size" id="im_theme_3D_download_size" class="form-input" value="<?php echo get_post_meta($post_id, 'im_theme_3D_download_size', true); ?>"/>
        <div class="clear"></div>
        </div>
		
        <div class="stage">
        <h1 class="mini-title">YouTube Video Url :</h1>
        <input type="text" name="im_theme_3D_video" id="im_theme_3D_video" class="form-input" value="<?php echo get_post_meta($post_id, 'im_theme_3D_video', true); ?>"/>
        <div class="clear"></div>
        </div>
        
        <div class="stage">
        <h1 class="mini-title">Select Page Style :</h1>
        <div class="select-wrapper">
        <select name="im_theme_full_normal_page" id="im_theme_full_normal_page" style="background:none; border:none;">
        	<option value="NORMAL" <?php if(get_post_meta($post_id, 'im_theme_full_normal_page', true) == 'NORMAL'){ echo 'selected="selected"'; } ?>>NORMAL</option>
            <option value="FULL" <?php if(get_post_meta($post_id, 'im_theme_full_normal_page', true) == 'FULL'){ echo 'selected="selected"'; } ?>>FULL</option>
        </select>
        </div>
        <div class="clear"></div>
        </div>
        
        <div class="stage-alt">
        <h1 class="mini-title">Select Page Type :</h1>
        <div class="select-wrapper">
        <select name="im_theme_page_type" id="im_theme_page_type" style="background:none; border:none;">
        	<option value="PAGE" <?php if(get_post_meta($post_id, 'im_theme_page_type', true) == 'PAGE'){ echo 'selected="selected"'; } ?>>PAGE</option>
            <option value="CONTACT" <?php if(get_post_meta($post_id, 'im_theme_page_type', true) == 'CONTACT'){ echo 'selected="selected"'; } ?>>CONTACT</option>
            <option value="LOGO_PAGE" <?php if(get_post_meta($post_id, 'im_theme_page_type', true) == 'LOGO_PAGE'){ echo 'selected="selected"'; } ?>>LOGO_PAGE</option>
        </select>
        </div>
        <div class="clear"></div>
        </div>
        
	<?php
}


function im_save_post_options($post_id) 
{
	global $prefix;
	global $post;
	$post_id = $post->ID;
	if(isset($_POST['im_theme_3D_description'])) 
	{	
		update_post_meta($post_id, 'im_theme_3D_description', trim(mysql_real_escape_string($_POST['im_theme_3D_description'])));
		update_post_meta($post_id, 'im_theme_3D_download_size', trim(mysql_real_escape_string($_POST['im_theme_3D_download_size'])));
		update_post_meta($post_id, 'im_theme_3D_video', trim(mysql_real_escape_string($_POST['im_theme_3D_video'])));
		update_post_meta($post_id, 'im_theme_full_normal_page', trim(mysql_real_escape_string($_POST['im_theme_full_normal_page'])));
		update_post_meta($post_id, 'im_theme_page_type', trim(mysql_real_escape_string($_POST['im_theme_page_type'])));
		update_post_meta($post_id, 'im_theme_portfolio_tag', trim(mysql_real_escape_string($_POST['im_theme_portfolio_tag'])));
		update_post_meta($post_id, 'im_theme_portfolio_description', trim(mysql_real_escape_string($_POST['im_theme_portfolio_description'])));
		
		update_post_meta($post_id, 'im_theme_seo_description', trim(mysql_real_escape_string($_POST['im_theme_seo_description'])));
		update_post_meta($post_id, 'im_theme_seo_keywords', trim(mysql_real_escape_string($_POST['im_theme_seo_keywords'])));
		
		
			$q_prt_show_url = trim(mysql_real_escape_string($_POST['im_theme_portfolio_video_url']));
			$q_prt_show_url = str_replace('http://','',$q_prt_show_url);
			$q_prt_show_url = str_replace('www.','',$q_prt_show_url);
			$q_prt_show_url = str_replace('youtu.be','youtube.com/embed',$q_prt_show_url);
			$q_prt_show_url = str_replace('youtube.com/watch?v=','youtube.com/embed/',$q_prt_show_url);	
			$q_prt_show_url = 'http://'.$q_prt_show_url;
			if(strstr($q_prt_show_url, '&')){$q_prt_show_url = explode('&', $q_prt_show_url); $q_prt_show_url = $q_prt_show_url[0];}
		
		update_post_meta($post_id, 'im_theme_portfolio_video_url', $q_prt_show_url);
		update_post_meta($post_id, 'im_theme_portfolio_iframe_url', trim(mysql_real_escape_string($_POST['im_theme_portfolio_iframe_url'])));
	}
}
add_action('add_meta_boxes', 'im_custom_boxes');
add_action('publish_post', 'im_save_post_options');
add_action('save_post', 'im_save_post_options');
?>
<?php
/* -----------------------------------------------
IM THEME NEW POST BUTTON
----------------------------------------------- */
function im_custom_boxes_2() {
    add_meta_box( 'Bar_2', 'IM Button', 'im_post_options_2', 'post', 'advanced', 'core');
    add_meta_box( 'Bar_2', 'IM Button', 'im_post_options_2', 'page', 'advanced', 'core');
}

function im_post_options_2(){
	global $prefix;
	global $post;
	$post_id = $post->ID;
	 ?>
       <div class="stage">
        <h1 class="mini-title">Button 1 Title : </h1>
		<input type="text" name="im_theme_3D_button_1_title" id="im_theme_3D_button_1_title" class="form-input" value="<?php echo get_post_meta($post_id, 'im_theme_3D_button_1_title', true); ?>"/>
        <div class="clear"></div>
        </div>
        
        <div class="stage">
        <h1 class="mini-title">Button 1 Url :</h1>
        <input type="text" name="im_theme_3D_button_1_url" id="im_theme_3D_button_1_url" class="form-input" value="<?php echo get_post_meta($post_id, 'im_theme_3D_button_1_url', true); ?>"/>
        <div class="clear"></div>
        </div>
        
       	<div class="stage">
        <h1 class="mini-title">Button 2 Title :</h1>
        <input type="text" name="im_theme_3D_button_2_title" id="im_theme_3D_button_2_title" class="form-input" value="<?php echo get_post_meta($post_id, 'im_theme_3D_button_2_title', true); ?>"/>
        <div class="clear"></div>
        </div>
        
        <div class="stage-alt">
        <h1 class="mini-title">Button 2 URL :</h1>
        <input type="text" name="im_theme_3D_button_2_url" id="im_theme_3D_button_2_url" class="form-input" value="<?php echo get_post_meta($post_id, 'im_theme_3D_button_2_url', true); ?>"/>
        <div class="clear"></div>
        </div>
	<?php
}


function im_save_post_options_2($post_id) 
{
	global $prefix;
	global $post;
	$post_id = $post->ID;
	if(isset($_POST['im_theme_3D_button_1_title'])) 
	{	
		update_post_meta($post_id, 'im_theme_3D_button_1_title', trim(mysql_real_escape_string($_POST['im_theme_3D_button_1_title'])));
		update_post_meta($post_id, 'im_theme_3D_button_1_url', trim(mysql_real_escape_string($_POST['im_theme_3D_button_1_url'])));
		update_post_meta($post_id, 'im_theme_3D_button_2_title', trim(mysql_real_escape_string($_POST['im_theme_3D_button_2_title'])));
		update_post_meta($post_id, 'im_theme_3D_button_2_url', trim(mysql_real_escape_string($_POST['im_theme_3D_button_2_url'])));
		update_post_meta($post_id, 'im_theme_3D_download_size', trim(mysql_real_escape_string($_POST['im_theme_3D_download_size'])));
	}
}
add_action('add_meta_boxes', 'im_custom_boxes_2');
add_action('publish_post', 'im_save_post_options_2');
add_action('save_post', 'im_save_post_options_2');
?>
<?php
/* -----------------------------------------------
IM THEME NEW POST PORTFOLIO
----------------------------------------------- */
function im_custom_boxes_3() {
    add_meta_box( 'Bar_3', 'IM Portfolio', 'im_post_options_3', 'post', 'advanced', 'core');
    add_meta_box( 'Bar_3', 'IM Portfolio', 'im_post_options_3', 'page', 'advanced', 'core');
}

function im_post_options_3(){
	global $prefix;
	global $post;
	$post_id = $post->ID;
	 ?>
        <div class="stage">
        <h1 class="mini-title">Portfolio Tag (Portfolio Filter Name) :</h1>
        <input type="text" name="im_theme_portfolio_tag" id="im_theme_portfolio_tag" class="form-input" value="<?php echo get_post_meta($post_id, 'im_theme_portfolio_tag', true); ?>"/>
        <div class="clear"></div>
        </div>
        
        <div class="stage">
        <h1 class="mini-title">Portfolio Description :</h1>
        <input type="text" name="im_theme_portfolio_description" id="im_theme_portfolio_description" class="form-input" value="<?php echo get_post_meta($post_id, 'im_theme_portfolio_description', true); ?>"/>
        <div class="clear"></div>
        </div>
        
        <div class="stage">
        <h1 class="mini-title">Portfolio Video URL :</h1>
        <input type="text" name="im_theme_portfolio_video_url" id="im_theme_portfolio_video_url" class="form-input" value="<?php echo get_post_meta($post_id, 'im_theme_portfolio_video_url', true); ?>"/>
        <div class="clear"></div>
        </div>
        
        <div class="stage-alt">
        <h1 class="mini-title">Portfolio Iframe URL :</h1>
        <input type="text" name="im_theme_portfolio_iframe_url" id="im_theme_portfolio_iframe_url" class="form-input" value="<?php echo get_post_meta($post_id, 'im_theme_portfolio_iframe_url', true); ?>"/>
        <div class="clear"></div>
        </div>
	<?php
}


function im_save_post_options_3($post_id) 
{
	global $prefix;
	global $post;
	$post_id = $post->ID;
	if(isset($_POST['im_theme_portfolio_tag'])) 
	{	
		update_post_meta($post_id, 'im_theme_portfolio_tag', trim(mysql_real_escape_string($_POST['im_theme_portfolio_tag'])));
		update_post_meta($post_id, 'im_theme_portfolio_description', trim(mysql_real_escape_string($_POST['im_theme_portfolio_description'])));
		
			$q_prt_show_url = trim(mysql_real_escape_string($_POST['im_theme_portfolio_video_url']));
			$q_prt_show_url = str_replace('http://','',$q_prt_show_url);
			$q_prt_show_url = str_replace('www.','',$q_prt_show_url);
			$q_prt_show_url = str_replace('youtu.be','youtube.com/embed',$q_prt_show_url);
			$q_prt_show_url = str_replace('youtube.com/watch?v=','youtube.com/embed/',$q_prt_show_url);	
			$q_prt_show_url = 'http://'.$q_prt_show_url;
			if(strstr($q_prt_show_url, '&')){$q_prt_show_url = explode('&', $q_prt_show_url); $q_prt_show_url = $q_prt_show_url[0];}
		
		update_post_meta($post_id, 'im_theme_portfolio_video_url', $q_prt_show_url);
		update_post_meta($post_id, 'im_theme_portfolio_iframe_url', trim(mysql_real_escape_string($_POST['im_theme_portfolio_iframe_url'])));
	}
}
add_action('add_meta_boxes', 'im_custom_boxes_3');
add_action('publish_post', 'im_save_post_options_3');
add_action('save_post', 'im_save_post_options_3');
?>
<?php
/* -----------------------------------------------
IM THEME NEW POST SEO
----------------------------------------------- */
function im_custom_boxes_4() {
    add_meta_box( 'Bar_4', 'IM Seo', 'im_post_options_4', 'post', 'advanced', 'core');
    add_meta_box( 'Bar_4', 'IM Seo', 'im_post_options_4', 'page', 'advanced', 'core');
}

function im_post_options_4(){
	global $prefix;
	global $post;
	$post_id = $post->ID;
	 ?>
        <div class="stage">
        <h1 class="mini-title">Seo Description :</h1>
        <input type="text" name="im_theme_seo_description" id="im_theme_seo_description" class="form-input" value="<?php echo get_post_meta($post_id, 'im_theme_seo_description', true); ?>"/>
        <div class="clear"></div>
        </div>
        
        <div class="stage-alt">
        <h1 class="mini-title">Seo Keywords :</h1>
        <input type="text" name="im_theme_seo_keywords" id="im_theme_seo_keywords" class="form-input" value="<?php echo get_post_meta($post_id, 'im_theme_seo_keywords', true); ?>"/>
        <div class="clear"></div>
        </div>
	<?php
}


function im_save_post_options_4($post_id) 
{
	global $prefix;
	global $post;
	$post_id = $post->ID;
	if(isset($_POST['im_theme_seo_description'])) 
	{	
		update_post_meta($post_id, 'im_theme_seo_description', trim(mysql_real_escape_string($_POST['im_theme_seo_description'])));
		update_post_meta($post_id, 'im_theme_seo_keywords', trim(mysql_real_escape_string($_POST['im_theme_seo_keywords'])));
	}
}
add_action('add_meta_boxes', 'im_custom_boxes_4');
add_action('publish_post', 'im_save_post_options_4');
add_action('save_post', 'im_save_post_options_4');
?>
<?php
add_editor_style();

add_filter( 'mce_buttons_2', 'atg_mce_buttons_2' );

function atg_mce_buttons_2( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}

add_filter( 'tiny_mce_before_init', 'atg_mce_before_init' );

function atg_mce_before_init( $settings ) {

    $style_formats = array(
		array(
        	'title' => 'Button 3D Blue',
        	'block' => 'a',
        	'classes' => 'button3dblue rightmargin-two',
        	'wrapper' => true
        ),
        array(
        	'title' => 'Button 3D Green',
        	'block' => 'a',
        	'classes' => 'button3dgreen rightmargin-two',
        	'wrapper' => true
        ),
		array(
        	'title' => 'Normal Button',
        	'block' => 'a',
        	'classes' => 'More3d rightmargin-three',
        	'wrapper' => true
        ),
		array(
        	'title' => 'Picture Button 3D Blue',
        	'block' => 'a',
        	'classes' => 'button3dblue rightmargin-two fancypicture',
        	'wrapper' => true
        ),
        array(
        	'title' => 'Picture Button 3D Green',
        	'block' => 'a',
        	'classes' => 'button3dgreen rightmargin-two fancypicture',
        	'wrapper' => true
        ),
		array(
        	'title' => 'Picture Normal Button',
        	'block' => 'a',
        	'classes' => 'More3d rightmargin-three fancypicture',
        	'wrapper' => true
        ),
		array(
        	'title' => 'Video Button 3D Blue',
        	'block' => 'a',
        	'classes' => 'button3dblue rightmargin-two fancyvideo',
        	'wrapper' => true
        ),
        array(
        	'title' => 'Video Button 3D Green',
        	'block' => 'a',
        	'classes' => 'button3dgreen rightmargin-two fancyvideo',
        	'wrapper' => true
        ),
		array(
        	'title' => 'Video Normal Button',
        	'block' => 'a',
        	'classes' => 'More3d rightmargin-three fancyvideo',
        	'wrapper' => true
        ),
		array(
        	'title' => 'Iframe Normal Button',
        	'block' => 'a',
        	'classes' => 'More3d rightmargin-three fancylink',
        	'wrapper' => true
        ),
		array(
        	'title' => 'Iframe Button 3D Blue',
        	'block' => 'a',
        	'classes' => 'button3dblue rightmargin-two fancylink',
        	'wrapper' => true
        ),
        array(
        	'title' => 'Iframe Button 3D Green',
        	'block' => 'a',
        	'classes' => 'button3dgreen rightmargin-two fancylink',
        	'wrapper' => true
        ),
		array(
        	'title' => 'Icon',
        	'block' => 'a',
        	'classes' => 'More3d rightmargin-four',
        	'wrapper' => true
        ),
		array(
        	'title' => 'Icon Picture',
        	'block' => 'a',
        	'classes' => 'More3d rightmargin-four fancypicture',
        	'wrapper' => true
        ),
		array(
        	'title' => 'Icon Video',
        	'block' => 'a',
        	'classes' => 'More3d rightmargin-four fancyvideo',
        	'wrapper' => true
        ),
        array(
        	'title' => 'Icon Iframe',
        	'block' => 'a',
        	'classes' => 'More3d rightmargin-four fancylink',
        	'wrapper' => true
        )
    );

    $settings['style_formats'] = json_encode( $style_formats );

    return $settings;

}


if ( function_exists('register_sidebar') ) { register_sidebar(array('name' => 'Sidebar One Blog', 'id' => 'sidebar-one-blog')); }
if ( function_exists('register_sidebar') ) { register_sidebar(array('name' => 'Sidebar Two Blog', 'id' => 'sidebar-two-blog')); }
if ( function_exists('register_sidebar') ) { register_sidebar(array('name' => 'Sidebar One Single', 'id' => 'sidebar-one-single')); }
if ( function_exists('register_sidebar') ) { register_sidebar(array('name' => 'Sidebar Two Single', 'id' => 'sidebar-two-single')); }
if ( function_exists('register_sidebar') ) { register_sidebar(array('name' => 'Sidebar Footer', 'id' => 'sidebar-footer')); }

add_theme_support( 'automatic-feed-links' );
if ( ! isset( $content_width ) ) $content_width = 900;


if(is_admin()){}
else{
wp_enqueue_style( 'style1', get_bloginfo('template_url').'/css/grid/reset.css');
wp_enqueue_style( 'style2', get_bloginfo('template_url').'/style2.css');
wp_enqueue_style( 'style3', get_bloginfo('template_url').'/css/grid/grid.css');
wp_enqueue_style( 'style4', get_bloginfo('template_url').'/css/theme/red.css');
wp_enqueue_style( 'style5', get_bloginfo('template_url').'/css/theme/style.css');
wp_enqueue_style( 'style6', get_bloginfo('template_url').'/css/app/button.css');
wp_enqueue_style( 'style7', get_bloginfo('template_url').'/css/app/slider.css');
wp_enqueue_style( 'style8', get_bloginfo('template_url').'/fancybox/jquery.fancybox-1.3.4.css');

wp_enqueue_style( 'style11', 'http://fonts.googleapis.com/css?family=Cabin+Condensed:400,500,600,700');
wp_enqueue_style( 'style12', 'http://fonts.googleapis.com/css?family=Lato:100,700italic,300,400,400italic,700');
wp_enqueue_style( 'style13', 'http://fonts.googleapis.com/css?family=Yellowtail');
wp_enqueue_style( 'style14', 'http://fonts.googleapis.com/css?family=Dosis');
wp_enqueue_style( 'style15', 'http://fonts.googleapis.com/css?family=Ubuntu+Condensed');
wp_enqueue_style( 'style16', 'http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Playfair+Display:400italic');

wp_enqueue_script( 'js1', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js');
wp_enqueue_script( 'js2', get_bloginfo('template_url').'/js/jquery-ui-1.8.18.custom.min.js');
wp_enqueue_script( 'js3', get_bloginfo('template_url').'/js/theme.js');
}
function disable_admin_bar() {
    add_filter( 'show_admin_bar', '__return_false' );
    add_action( 'admin_print_scripts-profile.php',
         'hide_admin_bar_settings' );
}
add_action( 'init', 'disable_admin_bar' , 9 );


if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'category-thumb', 275, 200, true); //(cropped)
	add_image_size( 'single-thumb', 733, 300, true ); //(cropped)
	add_image_size( 'page-full-thumb', 1100, 300, true ); //(cropped)
	add_image_size( 'homepage-tab-1', 550, 300, true ); //(cropped)
	add_image_size( 'homepage-tab-2', 320, 140, true ); //(cropped)
	add_image_size( 'homepage-tab-3', 500, 200, true ); //(cropped)
	add_image_size( 'homepage-tab-3-1', 180, 90, true ); //(cropped)
	add_image_size( 'homepage-tab-5-1', 56, 56, true ); //(cropped)
	add_image_size( 'homepage-tab-5-2', 730, 230, true ); //(cropped)
	add_image_size( 'homepage-tab-6-1', 46, 46, true ); //(cropped)
	add_image_size( 'homepage-portfolio', 253, 150, true ); //(cropped)
}


?>