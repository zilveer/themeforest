<?php
/**
 * This file contain some general functions:
 * -enqueuing CSS and JS files
 * -inserting the JavaScript init code into the head
 * -set the default thumbnail size
 * -print pagination function
 * -register navigation menus function
 * -generating arrays for available sliders
 *
 * @author Pexeto
 */


/**
 * ADD THE ACTIONS
 */
add_action('admin_enqueue_scripts', 'pexeto_admin_init');   
add_action('admin_head', 'pexeto_admin_head_add');   
add_action('init', 'register_pexeto_menus' ); 
add_action('init', 'pexeto_load_slider_data');
add_action('pre_get_posts', 'pexeto_set_blog_post_settings');

add_theme_support('menus');
add_theme_support('automatic-feed-links');


/**
 * Enqueues the JavaScript files needed depending on the current section.
 */
function pexeto_admin_init(){
	global $current_screen;

	if($current_screen->base=='post'){
		//enqueue the script and CSS files for the TinyMCE editor formatting buttons
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-dialog');

		//set the style files
		add_editor_style('lib/formatting-buttons/custom-editor-style.css');
		wp_enqueue_style('pexeto-page-style',PEXETO_CSS_URL.'page_style.css');
	}

	if(isset($_GET['page']) && $_GET['page']=='options'){
		//enqueue the scripts for the Options page
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script('jquery-ui-dialog');
		wp_enqueue_script('pexeto-jquery-co',PEXETO_SCRIPT_URL.'jquery-co.js');
		wp_enqueue_script('pexeto-ajaxupload',PEXETO_SCRIPT_URL.'ajaxupload.js');
		wp_enqueue_script('pexeto-colorpicker',PEXETO_SCRIPT_URL.'colorpicker.js');
		wp_enqueue_script('pexeto-options',PEXETO_SCRIPT_URL.'options.js');

		//enqueue the styles for the Options page
		wp_enqueue_style('pexeto-admin-style',PEXETO_CSS_URL.'admin_style.css');
		wp_enqueue_style('pexeto-colorpicker-style',PEXETO_CSS_URL.'colorpicker.css');
	}

	if($current_screen->id==PEXETO_PORTFOLIO_POST_TYPE){
		//enqueue the scripts needed for the add/edit portfolio post
		wp_enqueue_script('pexeto-ajaxupload',PEXETO_SCRIPT_URL.'ajaxupload.js');
		wp_enqueue_script('pexeto-options',PEXETO_SCRIPT_URL.'options.js');
	}

	if($current_screen->id=='page'){
		//enqueue the scripts needed for the add/edit page page
		wp_enqueue_script('pexeto-options',PEXETO_SCRIPT_URL.'options.js');
	}

	if(isset($_GET['page']) && ($_GET['page']=='theme-update-notifier')){
		//enqueue the scripts for the Update notifier page
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-dialog');
		wp_enqueue_script('pexeto-update',PEXETO_SCRIPT_URL.'update-notifier.js');

		//enqueue the styles for the Update notifier page
		wp_enqueue_style('pexeto-page-style',PEXETO_CSS_URL.'page_style.css');
		wp_enqueue_style('pexeto-update-style',PEXETO_CSS_URL.'update-notifier.css');
	}


}

/**
 * Inserts scripts for initializing the JavaScript functionality for the relevant section.
 */
function pexeto_admin_head_add(){
		
	if(isset($_GET['page']) && $_GET['page']=='options'){
		//init the options js functionality
		echo '<script>jQuery(document).ready(function($) {
				pexetoOptions.init({cookie:true});
		});</script>
		<!--[if IE 9]>
		<style type="text/css">
		.tab_navigation ul li.ui-tabs-selected a.tab span, .tab_navigation ul li.ui-tabs-selected a.tab span{
		top:-1px;
		position:relative;
		}
		
		.tab_navigation ul li.ui-tabs-selected a.tab{
		position:relative;
		top:1px;
		}
		</style>
		<![endif]-->
				
				';
	}
}

/**
 * Filter the main blog page query according to the blog settings in the theme's Options page
 * @param $query the WP query object
 */
function pexeto_set_blog_post_settings( $query ) {
    if ( $query->is_main_query() && is_home()) {
    	$postsPerPage=get_opt('_post_per_page_on_blog')==''?5:get_opt('_post_per_page_on_blog');
		$excludeCat=explode(',',get_opt('_exclude_cat_from_blog'));
        $query->set( 'category__not_in', $excludeCat );  //exclude the categories
        $query->set( 'posts_per_page', $postsPerPage );  //set the number of posts per page
    }
}


/* ------------------------------------------------------------------------*
 * LOCALE AND TRANSLATION
 * ------------------------------------------------------------------------*/

load_theme_textdomain( 'pexeto', TEMPLATEPATH . '/lang' );

/**
 * Returns a text depending on the settings set. By default the theme gets uses
 * the texts set in the Translation section of the Options page. If multiple languages enabled,
 * the default language texts are used from the Translation section and the additional language
 * texts are used from the added .mo files within the lang folder.
 * @param $textid the ID of the text
 */
function pex_text($textid){
	
	$locale=get_locale();
	$int_enabled=get_option(PEXETO_SHORTNAME.'_enable_translation')=='on'?true:false;
	$default_locale=get_option(PEXETO_SHORTNAME.'_def_locale');

	if($int_enabled && $locale!=$default_locale){
		//use translation - extract the text from a defined .mo file
		return __($textid, 'pexeto');
	}else{
		//use the default text settings
		return stripslashes(get_option(PEXETO_SHORTNAME.$textid));
	}
}


/* ------------------------------------------------------------------------*
 * SET THE THUMBNAILS
 * ------------------------------------------------------------------------*/


if (function_exists('add_theme_support')) {
	add_theme_support( 'post-thumbnails' );
	add_image_size('post_box_img', 580, 250, true);
	add_image_size('static-header-img', 980, 370, true);
}

function pexeto_get_resized_image($imgurl, $width, $height, $enlarge = 0){
	$resized_img = '';
	$crop = empty($height) ? false : true;
	$w = $width;
	$h = $height;

	//enlarge the image for retina displays
	if($enlarge!==0){
		$w = intval($width+$enlarge);
		$h = empty($height) ? $height : intval($height*$w/$width);
	}

	$resized_img = aq_resize( $imgurl, $w, $h, $crop, true, true );

	if(!$resized_img){
		//the Aqua Resizer script could not crop the image, return the original image
		$resized_img = $imgurl;
	}

	return $resized_img;
}



/**
 * Prints the pagination. Checks whether the WP-Pagenavi plugin is installed and if so, calls
 * the function for pagination of this plugin. If not- shows prints the previous and next post links.
 */
function print_pagination(){
	if(function_exists('wp_pagenavi')){
	 wp_pagenavi();
	}else{?>
<div id="blog_nav_buttons" class="navigation">
<div class="alignleft"><?php previous_posts_link('<span>&laquo;</span> '.get_opt('_previous_text')) ?></div>
<div class="alignright"><?php next_posts_link(get_opt('_next_text').' <span>&raquo;</span>') ?></div>
</div>
	<?php
	}
}


/**
 * Register the main menu for the theme.
 */
function register_pexeto_menus() {
	register_nav_menus(
	array('pexeto_main_menu' => __( 'Main Menu' ))
	);
}

/**
 * Generates arrays containing all the sliders names, so that this data would be used in an drop down select.
 */
function pexeto_load_slider_data(){
	global $pexeto_manager;

	$pexeto_slider_data=array();

	$pexeto_sliders=array(array('id'=>'_thum_slider_names', 'name'=>'Thumbnail Slider'),
	array('id'=>'_content_slider_names', 'name'=>'Content Slider'),
	array('id'=>'_accord_slider_names', 'name'=>'Accordion Slider'),
	array('id'=>'_nivo_slider_names', 'name'=>'Nivo Slider'),
	);

	foreach($pexeto_sliders as $slider){
		$slider_id=convert_to_class($slider['name']);

		//the slider caption that will be shown in a select box as disabled
		$pexeto_slider_data[]=array('id'=>'disabled', 'name'=>$slider['name'], 'class'=>'caption');
		//there always should be one default slider from each slider type
		$pexeto_slider_data[]=array('id'=>'default', 'name'=>'Default', 'class'=>$slider_id);

		$names = explode('|*|', get_option($slider['id']));

		if(sizeof($names)>1){
			array_pop($names);
			foreach($names as $slidername){
				$pexeto_slider_data[]=array('id'=>convert_to_class($slidername), 'name'=>$slidername, 'class'=>$slider_id);
			}
		}
	}

	//assign the slider data to the global manager object
	$pexeto_manager->pexeto_slider_data=$pexeto_slider_data;

}

/**
 * Generates the HTML for the services boxes.
 */
function pexeto_services_boxes(){
	$html='<div class="columns-wrapper nomargin">';
	for($i=1; $i<=3; $i++){
		 $lastClass=$i==3?'nomargin':'';
		 $html.='<div class="services-box three-columns '.$lastClass.'">';
		 if(get_opt('_home_box_icon'.$i)!=''){
	        $html.='<img src="'.get_opt('_home_box_icon'.$i).'" class="img-frame" />'; 
	     } 
	     $html.='<h4>'.get_opt('_home_box_title'.$i).'</h4>';
	     $html.=get_opt('_home_box_desc'.$i).'<br />';
	     if(trim(get_opt('_home_box_btn_link'.$i))){ 
	        $html.='<a href="'.get_opt('_home_box_btn_link'.$i).'" >'.get_opt('_home_box_btn_text'.$i).'<span class="more-arrow">&raquo;</span></a>';
	       } 
	     $html.='</div>';
	 } 
	
	$html.='</div>';
	return $html; 
}


function pexeto_generate_uploads_url($id){
	$nonce_name= 'nonce_'.$id;
	$nonce = wp_create_nonce( $nonce_name );
	$uploads_url = admin_url( 'admin-ajax.php' );
	$params = array(
		'pexeto_nonce'=>$nonce, 
		'nonce_name'=>$nonce_name,
		'action'=>'pexeto_upload'
		);
	$uploads_url = add_query_arg($params, $uploads_url);
	return $uploads_url;
}

