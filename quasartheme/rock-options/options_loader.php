<?php
/*
Rock Options
*/

//Animation Builder Included
define('ANIMATION_BUILDER',true);
define('CURVY_STANDALONE',false);

define('OPTIONS_DIR', get_template_directory().'/rock-options/');
define('OPTIONS_URI', get_template_directory_uri().'/rock-options/');



function rockthemes_after_setup(){
	global $pagenow;	

	if(isset($_GET['activated']) && $pagenow === 'themes.php'){
		/*
		**	Wordpress Default Image Size Hook to Match image size in demo
		*/
		update_option('thumbnail_size_w', 200);
		update_option('thumbnail_size_h', 150);
		update_option('thumbnail_crop', 0);
		
		update_option('medium_size_w', 540);
		update_option('medium_size_h', 405);
		update_option('medium_crop', 0);
		
		update_option('large_size_w', 960);
		update_option('large_size_h', 720);
		update_option('large_crop', 0);
		
		wp_redirect(admin_url('themes.php?page=rock_options'));	
	}
}

add_action('after_setup_theme','rockthemes_after_setup');

//Load the settings
function xr_load_default_settings(){
	global $rockthemes_to_options, $rockthemes_to_default_options, $translation_options;
	$rockthemes_to_options = (get_option('xr_main_settings'));
	
	$translation_options = get_option('xr_main_settins_translate',array());
	
	include_once(OPTIONS_DIR.'default_settings.php');
	
	//First time load
	if(empty($rockthemes_to_options)) {
		$rockthemes_to_options = $rockthemes_to_default_options;
	}
}

xr_load_default_settings();


if(!function_exists('xr_get_option')){
	function xr_get_option($search,$default = ''){
		global $rockthemes_to_options, $translation_options;

		foreach($rockthemes_to_options as $option){
			
			foreach($option['elements'] as $element){

				if($element['id'] == $search){
					
					if(isset($element['is_hidden']) && $element['is_hidden'] === 'true'){
						if(isset($element['hidden_val'])){
							return $element['hidden_val'];
						}else{
							return '';	
						}
					}
					
					if(!isset($element['is_translate']) || $element['is_translate'] !== 'true' || empty($translation_options)){
						$element_value = xr_return_element_value($element);
						if(!is_array($element_value)){
							return stripslashes(($element_value));
						}else{
							return $element_value;	
						}
					}else{
						foreach($translation_options as $key => $value){
							if($search === $key){
								return stripslashes($value);	
							}
						}
					}
					
				}
				
			}
			
		}
		
		return $default;
	}
}

/* 
** This function will find the element type and return it's value
*/
if(!function_exists('xr_return_element_value')){
	function xr_return_element_value($elem){
		if(!isset($elem['default'])) return '';
		
		//Text Field
		if($elem['type'] == 'text_field'){
			return $elem['default'];
		}
		
		//Colorpicker
		if($elem['type'] == 'colorpicker'){
			return $elem['default'];	
		}
		
		//Colorpicker
		if($elem['type'] == 'select'){
			return $elem['default'];	
		}
		
		//Social Icons Modal
		if($elem['type'] == 'socialicons'){
			return addslashes($elem['default']);	
		}
		
		//Checkbox
		if($elem['type'] == 'checkbox'){
			if($elem['default'] == 'YES'){
				return true;	
			}
			return false;
		}
		
		//Font Option Field
		if($elem['type'] == 'font_option_field'){
			return $elem['default'];	
			
			/*
			OPTIONAL : Directly Return with the ready class
			$return_class = '';
			if(isset($elem['default']['font_family']) && $elem['default']['font_family'] !== ''){
				$return_class .= 'font-family: '.$elem['default']['font_family'];	
			}
			
			if(isset($elem['default']['font_size']) && $elem['default']['font_size'] !== ''){
				$return_class .= 'font-size: '.$elem['default']['font_size'];	
			}
			
			return $return_class;
			*/
		}
		
		return $elem['default'];
			
	}
}

if(!function_exists('xr_options_load')):
function xr_options_load(){
	//Only load settings page if the user is admin
	global $pagenow;

	
	if(ANIMATION_BUILDER){
		include_once(OPTIONS_DIR.'curvy-slider/load-curvy.php');
	}


	if(current_user_can('edit_theme_options')){
		if($pagenow == 'themes.php' && isset($_GET['page']) && strpos($_GET['page'],'rock_options') > -1){

			//load wordpress's new colorpicker
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_script('wp-color-picker');
	
			wp_enqueue_media();
			
			//Check if debug mode is on
			$dec = '';
			if(defined('ROCK_DEBUG') && !ROCK_DEBUG) $dec = '.min';
			
			wp_enqueue_style('xr_options_style',  OPTIONS_URI.'css/rock_style.css', '','', 'all');
			wp_enqueue_script('xr_jquery', OPTIONS_URI.'js/rock_jquery.js', array('jquery'));
			
			//FontAwesome 
			wp_enqueue_style('font-awesome-css',  OPTIONS_URI.'/css/font-awesome.min.css', '','', 'all');
			
						
			// Turn on the output buffer
			//ob_start();
			
			// Echo the editor to the buffer
			/*
			echo '<div style="display:none;">';
			wp_editor("","rockthemes-init-tinymce-editor-useless");
			echo '</div>';
			*/
			
			// Store the contents of the buffer in a variable
			//$editor_contents = ob_get_clean();		

	
			include_once(OPTIONS_DIR.'elements.php');
			include_once(OPTIONS_DIR.'options_ui.php');
		}
	}
	
	//Register Rock Options
	include_once(OPTIONS_DIR.'register.php');
}
add_action('init','xr_options_load');
endif;

if ( (defined( 'WP_ADMIN' ) && WP_ADMIN ) ||  ( defined( 'DOING_AJAX' ) && DOING_AJAX )){
	include_once(OPTIONS_DIR.'rockthemes-to-import-export.php');
}


function rockthemes_core_backbone(){
	if(!isset($_POST['security'])) die;
	check_ajax_referer( 'rockthemes_security_nonce', 'security' );
	
	$backbone_ajax_ref = '';
	$activated_url = '';
	$purchase_code = '';
	
	$backbone = json_decode(stripslashes(unserialize(get_option('html_backbone_moderation', false))),true);
	if($backbone && $backbone['data']) extract($backbone['data']);
	
	$data = array(
		'data'	=>	$backbone_ajax_ref,
		'url'	=>	$activated_url,
		'code'	=>	$purchase_code,
	);
		
	wp_send_json($data);
	die;
	exit;
}

add_action('wp_ajax_rockthemes_backbone','rockthemes_core_backbone');
add_action('wp_ajax_nopriv_rockthemes_backbone', 'rockthemes_core_backbone');





function xr_make_backbone_core(){
	if(!isset($_POST['data'])) die('error');
		
	$success = update_option('html_backbone_moderation', serialize($_POST['data']));
	
	if($success){
		die('success');	
	}else{
		die('error');	
	}
	exit;
}

add_action('wp_ajax_backbone_core', 'xr_make_backbone_core');


function rockthemes_to_init(){
	$backbone = get_option('rockthemes_security_nonce', false);
	
	if($backbone !== 'false'){
		$backbone = json_decode(stripslashes(unserialize(get_option('html_backbone_moderation', false))),true);
		if($backbone && $backbone['data']) extract($backbone['data']);
		
		if(isset($backbone_ajax_ref) && isset($activated_url) && isset($purchase_code)){
		
			$data = array(
				'data'	=>	$backbone_ajax_ref,
				'url'	=>	$activated_url,
				'code'	=>	$purchase_code,
			);
			
			$return = '
				<script type="text/javascript">
					jQuery(document).ready(function(){
						var backbone = '.json_encode($data).'
						
						if(typeof jQuery.rockthemes == "undefined"){
							jQuery.rockthemes = new Object();
						}
						
						if(typeof jQuery.rockthemes.backbone == "undefined"){
							jQuery.rockthemes.backbone = new Object();
						}
						
						if(typeof jQuery.rockthemes.backbone.core == "undefined"){
							jQuery.rockthemes.backbone.core = new Object();	
						}
						
						if(typeof jQuery.rockthemes.backbone.core.url == "undefined"){
							jQuery.rockthemes.backbone.core.url = backbone.url;	
						}
						
						if(typeof jQuery.rockthemes.backbone.core.data == "undefined"){
							jQuery.rockthemes.backbone.core.data = backbone.data;	
						}
						
						if(typeof jQuery.rockthemes.backbone.core.code == "undefined"){
							jQuery.rockthemes.backbone.core.code = backbone.code;	
						}

						//console.dir(jQuery.rockthemes.backbone.core);
						
					});
				</script>
			';
			
			echo $return;
		
		}else{
			echo '';	
		}
	}
}

add_action('wp_footer', 'rockthemes_to_init', 1);


if(!function_exists('xr_save_settings')){
	function xr_save_settings(){
		if(!isset($_POST['settings_data'])) die();
		if(!is_admin()) die();
		if(!isset($_REQUEST['_ajax_nonce']) ||
			empty($_REQUEST['_ajax_nonce']) || 
			!wp_verify_nonce($_REQUEST['_ajax_nonce'], 'rockthemes_to_nonce_save') ||
			!check_ajax_referer('rockthemes_to_nonce_save')) {
				
			//Die
			die('update error : security error');
		}
		
		$current_options = json_decode(stripslashes($_REQUEST['settings_data']), true);
				
		if(isset($_POST['translate_array'])){
			update_option('xr_main_settins_translate', (json_decode(stripslashes($_POST['translate_array']),true)));
		}
		
		$error = update_option('xr_main_settings', (($current_options)));
		if($error){
			echo "saved";
		}else{
			echo "update_error ".$error;
		}
		
		exit;
	}
}
//IN USE Quasar Animation Builder Save Function
add_action( 'wp_ajax_xr_save_settings', 'xr_save_settings' );



function rockthemes_to_import_new_options(){
	if(!is_admin()) return;
	global $rockthemes_to_options, $rockthemes_to_default_options;
	$rockthemes_to_options = (get_option('xr_main_settings',array()));
	
	
	include_once(OPTIONS_DIR.'default_settings.php');

	
	if(!isset($rockthemes_to_default_options)) die('error');
	if(!isset($rockthemes_to_options)) die('error');
	
	$level_1 = 0;
	$level_2 = 0;
		
	
	$i = 0;
	foreach($rockthemes_to_default_options as $i_key => $default_options1){
		
		$found_level_1 = false;
		foreach($rockthemes_to_options as $option){
			if($default_options1['category_id'] === $option['category_id']){
				$found_level_1 = true;
				
				foreach($default_options1['elements'] as $t_key => $default_options2){
					$t = 0;
					foreach($option['elements'] as $opt){
						
						if($default_options2['id'] === $opt['id'] && $default_options2['type'] !== 'header'){
							$rockthemes_to_default_options[$i_key]['elements'][$t_key]['default'] = $opt['default'];
							break;	
						}
						$t++;
					}
				}
				break;
			}
		}
		
		$i++;
		
		if(!$found_level_1) continue;
		
	}
	
	
	update_option('xr_main_settings', $rockthemes_to_default_options);
	
	die('success');
	exit;
}
add_action('wp_ajax_rockthemes_to_import_new_options', 'rockthemes_to_import_new_options');


function rockthemes_hex2rgba($hex, $opacity = 1) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   return implode(",", $rgb).','.$opacity; // returns the rgb values separated by commas
   //return $rgb; // returns an array with the rgb values
}


//Theme options style function frontend
function xr_style_callback($args){
	$rockthemes_browser = rockthemes_get_browser_details();
	
	$is_ie9_and_lower = false;
	
	if(strpos($rockthemes_browser['name'], "Explorer") > -1){
		if(intval($rockthemes_browser['version']) <= 9){
			$is_ie9_and_lower = true;
		}
	}
	

	echo '<!--Rock Themes Style-->';
	echo '<style type="text/css" media="all">';
	
	$default_padding = xr_get_option('content_padding','15px');
	echo '.padding{padding:'.$default_padding.';}';
	echo '.padding-2x{padding:'.(2 * rockthemes_fn_px_em_return_num($default_padding) - 3).'px;}';
	
	//Site general color
	$site_general_color = xr_get_option('site_general_color','#00aae8');
	
	//Link Colors
	$a_link_color = xr_get_option('a_link_color','#eeeeee');
	$a_link_hover_color = xr_get_option('a_link_hover_color','#ffffff');
	
	/*Font Colors*/
	echo 'body,html,p{color:'.xr_get_option('default_text_color','#101010').';}';
	
	$light_font_color = xr_get_option('light_font_color', '#666666');

	
	/*All link "a" tags with will contain this not attributes. These are the escape class from a color*/
	$a_not = 'a:not(.escapea):not(.button)';
	
	$ie8 = '.lt-ie9 ';
	
	/*General Details*/
	echo $a_not.'{color:'.$a_link_color.';}';
	echo $a_not.':hover{color:'.$a_link_hover_color.';}';
	
/*
	echo $ie8.'a{color:'.$a_link_color.';}';
	echo $ie8.'a:hover{color:'.$a_link_hover_color.';}';
*/
	
	/*Grid details*/
	/*1140px grid*/
	/*960px grid*/
	/*1060px grid*/
	
	echo '.row{max-width:'.xr_get_option('main_layout_grid','').';}';
	echo '.lt-ie9 .row{width:'.xr_get_option('main_layout_grid','').';}';
	
	/*Responsivity*/
	$disable_responsivity = xr_get_option('disable_responsivity',false);
	if($disable_responsivity){
		//Responsivity disabled
		/*It was width: before and changed to min-width:*/
		echo '#main-canvas, .main-container{min-width:'.(((2 * rockthemes_fn_px_em_return_num($default_padding)) + rockthemes_fn_px_em_return_num(xr_get_option('main_layout_grid','')))).'px; }';
		echo '.row{width:'.xr_get_option('main_layout_grid','').';}';
	}else{
		//Responsive Design
		
	}
	
	/*General Color Settings*/
	echo '
		.main-color, .team-member-content .team-member-i, ol.comment-list li.comment .comment-author,
		ol.comment-list li.comment .comment-author a.url, .comment-list .reply a, #cancel-comment-reply-link,
		#wp-calendar td a{
			color:'.$site_general_color.';	
		}
		
		#wp-calendar caption, .rockthemes-divider .divider-symbol, .rockthemes-divider .divider-symbol-left,
		.quasar-pagination .page-numbers.current, .quasar-link_pages > span.page-numbers, .quasar-style-dot{
			background-color:'.$site_general_color.';	
		}
		
		.box-shadow-dark{
			-webkit-box-shadow:inset 0 0 2px '.$site_general_color.';
			-moz-box-shadow:inset  0 0 2px '.$site_general_color.';
			box-shadow:inset 0 0 2px '.$site_general_color.';
			border-color:'.$site_general_color.';
		}
		
		.rockthemes-before-after-slider .twentytwenty-handle .twentytwenty-left-arrow{
			border-right-color:'.$site_general_color.';
		}
		
		.rockthemes-before-after-slider .twentytwenty-handle .twentytwenty-right-arrow{
			border-left-color:'.$site_general_color.';
		}
	';
	
	/*Typography Details*/
	$site_default_font_details = xr_get_option('site_default_font_details', array());
	if(!empty($site_default_font_details)){
		echo '
			body, .button, .date-area, .date-area *, .comment-list .reply a, #cancel-comment-reply-link,
			p, a, .header-small-contact, .more-link, .rock-skill text tspan{
				'.$site_default_font_details['font_family'].'
			}
			
			.quasar-breadcrumbs *, table, table tr th, table tr td, input[type="submit"]
			.rock-tabs-container .rock-tabs-header-container .rock-tab-header,
			ul,ol,dl, address, label, input, input:not([type="submit"]), select, button, textarea
			.quasar-pagination .page-numbers, input[type="submit"]:not(.button), .comments-submit, #comments-submit,
			p, a, .vcard .fn, .header-small-contact, .more-link{
				font-size:'.$site_default_font_details['font_size'].';	
			}
		';	
	}
	
	$site_heading_font = xr_get_option('site_heading_font_family', '');
	if($site_heading_font){
		echo '
		h1, h2, h3, h4, h5, h6, .title-container, .title-container a, .page-title, 
		.sidebar-area caption, .quasar-portfolio-main-title, .team-member-content .member-b,
		.ajax-filtered-gallery-holder .ajax-navigation strong, .searchform label,
		.quasar-breadcrumbs li a, .quasar-breadcrumbs li,
		.rock-iconictext-container .rock-iconictext-header-title,
		.rock-iconictext-container .rock-iconictext-header-title strong,
		.quasar-element-responsive-title{
			'.$site_heading_font.'
		}
		';	
	}
	
	$menu_font_family = xr_get_option('menu_font_family', '');
	if($menu_font_family){
		echo '
		#nav, #nav a, #nav ul li{
			'.$menu_font_family.'
		}
		
		#nav ul li a{
			font-size:'.xr_get_option('main_nav_font_size', '14px').';	
		}
		
		#nav ul ul li a{
			font-size:'.xr_get_option('main_nav_sub_font_size', '14px').';	
		}
		';	
	}
	/*End of Typography*/
	
	
	
	if( xr_get_option('use_boxed_layout',false)){
		echo '#main-canvas{width:100%; max-width:'.(((2 * rockthemes_fn_px_em_return_num($default_padding)) + rockthemes_fn_px_em_return_num(xr_get_option('main_layout_grid','')))).'px; }';
	}
	
	
	/*General Colors*/
	echo '.main-color{color:'.$site_general_color.';}';/*Real Color 00aae8*/
	echo '.main-boxed-text-color{color:'.xr_get_option('boxed_layout_text_color','#101010').';}';/*General Boxed Text Color*/
	
	/*Go To Top Button*/
	echo '#toTop{background:'.$site_general_color.';}';

	/*Header Large Area*/
	$header_large_background_repeat = xr_get_option('header_large_background_repeat', '');
	$header_large_background = xr_get_option('header_large_background', '');
	if($header_large_background !== ''){
		echo '.header-top-1{background:url("'.$header_large_background.'") '.$header_large_background_repeat.';}';
	}else{
		echo '.header-top-1{background:'.xr_get_option('header_large_background_color', '').';}';
	}
	echo '.header-top-1{color:'.xr_get_option('header_large_font_color', '#333').';}';
	echo '.header-top-1 '.$a_not.'{color:'.xr_get_option('header_large_link_color', '#333').';}';
	echo '.header-top-1 '.$a_not.':hover{color:'.$a_link_hover_color.';}';
	
	echo $ie8.'.header-top-1 a{color:'.xr_get_option('header_large_link_color', '#333').';}';
	echo $ie8.'.header-top-1 a:hover{color:'.$a_link_hover_color.';}';
	
	/*Header Top Area - Header Level 2*/
	echo '.header-top-2{
		background-color:'.xr_get_option('header_top_background_color', '#00aae8').';
		color:'.xr_get_option('header_top_font_color', '#F0F0F0').';
	}';
	
	echo '.header-top-2 '.$a_not.'{color:'.xr_get_option('header_top_link_color', '#FAFAFA').';}';
	echo '.header-top-2 '.$a_not.':hover{color:'.xr_get_option('header_top_link_hover_color', '#DEDEDE').';}';
	
	echo $ie8.'body .header-top-2 div a{color:'.xr_get_option('header_top_link_color', '#FAFAFA').';}';
	echo $ie8.'.header-top-2 a:hover{color:'.xr_get_option('header_top_link_hover_color', '#DEDEDE').';}';
	echo '.ie.ie8 .header-top-2 div a{color:'.xr_get_option('header_top_link_color', '#FAFAFA').' !important;}';/*IE8 Style Fix*/
	
	
	/*Logo Settings*/
	echo '.logo-container{margin-top:'.xr_get_option('logo_margin_top', '0px').'; margin-bottom:'.xr_get_option('logo_margin_bottom', '0px').';}';
			
	/*Menu Settings*/
	$menu_bg_top_color = xr_get_option('menu_bg_gradient_top', '#FFF');
	$menu_bg_bottom_color = xr_get_option('menu_bg_gradient_bottom', '#F4F4F4');
	$menu_bg_border_top_color = xr_get_option('menu_border_top_color', '#FFFFFF');
	$menu_bg_border_bottom_color = xr_get_option('menu_border_bottom_color', '#DDDDDD');
	$menu_level1_font_color = xr_get_option('menu_level1_font_color', '#666666');
	$menu_level1_font_hover_color = xr_get_option('menu_level1_font_hover_color', '#666666');
		
	
	echo '
		.lt-ie9 .nav-box, .ie9 .nav-box{
			background:'.$menu_bg_top_color.';
			
			background: #ffffff;
			background: -moz-linear-gradient(top,  '.$menu_bg_top_color.' 0%, '.$menu_bg_bottom_color.' 100%);
			background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,'.$menu_bg_top_color.'), color-stop(100%,'.$menu_bg_bottom_color.'));
			background: -webkit-linear-gradient(top,  '.$menu_bg_top_color.' 0%,'.$menu_bg_bottom_color.' 100%);
			background: -o-linear-gradient(top,  '.$menu_bg_top_color.' 0%,'.$menu_bg_bottom_color.' 100%);
			background: -ms-linear-gradient(top,  '.$menu_bg_top_color.' 0%,'.$menu_bg_bottom_color.' 100%);
			background: linear-gradient(to bottom,  '.$menu_bg_top_color.' 0%,'.$menu_bg_bottom_color.' 100%);
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="'.$menu_bg_top_color.'", endColorstr="'.$menu_bg_bottom_color.'",GradientType=0 );
			
			border-top:1px solid '.$menu_bg_border_top_color.';
		}
	
	';
	
	if(xr_get_option('activate_menu_transparency', true)){
		$menu_bg_top_color = 'rgba('.rockthemes_hex2rgba($menu_bg_top_color, 0.8).')';
		$menu_bg_bottom_color = 'rgba('.rockthemes_hex2rgba($menu_bg_bottom_color,0.8).')';
	}
	
	echo '
		.nav-box{
			background:'.$menu_bg_top_color.';
			
			background: #ffffff;
			background: -moz-linear-gradient(top,  '.$menu_bg_top_color.' 0%, '.$menu_bg_bottom_color.' 100%);
			background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,'.$menu_bg_top_color.'), color-stop(100%,'.$menu_bg_bottom_color.'));
			background: -webkit-linear-gradient(top,  '.$menu_bg_top_color.' 0%,'.$menu_bg_bottom_color.' 100%);
			background: -o-linear-gradient(top,  '.$menu_bg_top_color.' 0%,'.$menu_bg_bottom_color.' 100%);
			background: -ms-linear-gradient(top,  '.$menu_bg_top_color.' 0%,'.$menu_bg_bottom_color.' 100%);
			background: linear-gradient(to bottom,  '.$menu_bg_top_color.' 0%,'.$menu_bg_bottom_color.' 100%);
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="'.$menu_bg_top_color.'", endColorstr="'.$menu_bg_bottom_color.'",GradientType=0 );
			
			border-top:1px solid '.$menu_bg_border_top_color.';
		}
	
	';	
	
	
	/*
		Currently disabled from .nav-box class
		
			border-bottom:1px solid '.$menu_bg_border_bottom_color.';
	*/
	
	$menu_padding_top = xr_get_option('menu_padding_top', '11px');
	$menu_padding_top = $menu_padding_top == "" ? "11px" : $menu_padding_top;
	$menu_padding_bottom = xr_get_option('menu_padding_bottom', '12px');
	$menu_padding_bottom = $menu_padding_bottom == "" ? "11px" : $menu_padding_bottom;
	
	//echo '#nav ul li a{padding:'.$menu_padding_top.' 30px '.$menu_padding_bottom.' 0px;}';
	echo '#nav ul ul a{padding:9px 25px 9px 15px;}';
	echo '#nav > ul > li > a, #main-nav-bg.nav-centered #nav > ul > li > a,
		ul#nav > li > a, ul#main-nav-bg.nav-centered #nav > li > a{padding-top:'.$menu_padding_top.'; padding-bottom:'.$menu_padding_bottom.';}';
	
	//echo '#nav{padding-top:'.xr_get_option('menu_padding_top', '0px').';}';
	
	echo '#nav ul li.current-menu-item > '.$a_not.'{color:'.$site_general_color.';}';
	echo '#nav ul li '.$a_not.':hover{color:'.$site_general_color.';}';
	echo $ie8.'#nav ul li.current-menu-item > a{color:'.$site_general_color.';}';
	echo $ie8.'#nav ul li a:hover{color:'.$site_general_color.';}';

	//Menu first level hover colors and active colors
	echo '#nav > ul > li.current-menu-item > '.$a_not.'{color:'.$menu_level1_font_hover_color.';}';
	echo '#nav > ul > li '.$a_not.':hover{color:'.$menu_level1_font_hover_color.';}';
	echo $ie8.'#nav > ul > li.current-menu-item > a{color:'.$menu_level1_font_hover_color.';}';
	echo $ie8.'#nav > ul > li a:hover{color:'.$menu_level1_font_hover_color.';}';

	
	echo '#nav ul li a{color:'.$menu_level1_font_color.';}';
	
	$menu_level1_font_color = xr_get_option('menu_level1_font_color', '#666');
	echo '#nav ul li.current-menu-item a .desc, #nav ul li.current-menu-item a i{color:'.$menu_level1_font_color.';}';
	echo '#nav ul li a:hover .desc, #nav ul li a:hover i, #nav ul li '.$a_not.'{color:'.$menu_level1_font_color.';}';
	
	$menu_level2_bg_color = xr_get_option('menu_level2_bg_color', '#F4F4F4');
	$menu_level2_bg_hover_color = xr_get_option('menu_level2_bg_hover_color', '#F4F4F4');
	$menu_level2_font_color = xr_get_option('menu_level2_font_color', '#666666');
	$menu_level2_font_hover_color = xr_get_option('menu_level2_font_hover_color', '#F0F0F0');
	$menu_level2_border_top_color = xr_get_option('menu_level2_border_top_color', '#FDFDFD');
	$menu_level2_border_bottom_color = xr_get_option('menu_level2_border_bottom_color', '#E9E9E9');
	$menu_level2_border_radius = xr_get_option('menu_level2_border_radius', '3px');
	echo '#nav ul ul{background:'.$menu_level2_bg_color.'; color:'.$menu_level2_font_color.';}';
	echo '#nav ul ul a, #nav ul ul ul a{color:'.$menu_level2_font_color.';}';
	echo '#nav ul ul '.$a_not.', #nav ul ul ul '.$a_not.',{color:'.$menu_level2_font_color.';}';
	
	echo '#nav ul ul a{border-top-color:'.$menu_level2_border_top_color.'; border-bottom-color:'.$menu_level2_border_bottom_color.'}';
	echo '#nav ul ul li.current-menu-item, #nav ul ul li.current-menu-parent, #nav ul ul li.current-menu-ancestor{background-color:'.$site_general_color.'; border-radius:'.$menu_level2_border_radius.';}';
	echo '#nav ul ul li '.$a_not.', #nav ul ul ul li '.$a_not.'{color:'.$menu_level2_font_color.';}';
	echo '#nav ul ul li '.$a_not.':hover, #nav ul ul li:hover > '.$a_not.'{color:'.$menu_level2_font_hover_color.';}';
	echo '#nav ul ul li.current-menu-item > '.$a_not.', #nav ul ul li.current-menu-parent > '.$a_not.', #nav ul ul li.current-menu-ancestor > '.$a_not.'{color:'.$menu_level2_font_hover_color.';}';
	
	echo $ie8.'#nav ul ul li a:hover, #nav .sub_font_color{color:'.$menu_level2_font_hover_color.';}';
	echo $ie8.'#nav ul ul li.current-menu-item > a, '.$ie8.'#nav ul ul li.current-menu-parent > a, '.$ie8.'#nav ul ul li.current-menu-ancestor > a{color:'.$menu_level2_font_hover_color.';}';
	
	echo '#nav .sub-nav-hover, #nav .sub-sub-nav-hover{background-color:'.$menu_level2_bg_hover_color.';}';
	echo '#nav .sub-sub-nav-hover, #nav .sub-nav-hover{border-radius:'.$menu_level2_border_radius.';}';
	echo '#nav ul ul{border-bottom-left-radius:'.$menu_level2_border_radius.'; border-bottom-right-radius:'.$menu_level2_border_radius.';}';
	
	echo '.special-search-container{
			padding-top:'.xr_get_option('search_icon_padding_top', '13px').';
			padding-bottom:'.xr_get_option('search_icon_padding_bottom', '15px').';
		}	
	';//search icon
	echo '.special-search-overlay-box{
		background:'.xr_get_option('search_box_color', '#FAFAFA').'; 
		border-radius:'.xr_get_option('layout_border_radius','0px').';
		border-top-left-radius:0px;
		border-top-right-radius:0px;
		margin-top:'.xr_get_option('search_icon_padding_bottom', '15px').';
	}';//Search Box
	
	//Stiky Menu Wordpress Admin Bar Fix
	if(is_admin_bar_showing()){
		echo '.fixed-top-nav{top:28px;};';
	}
	//End of Menu Settings
	
	//Widget Sidebar Custom Menu
	echo '
	.widget_nav_menu .menu li.active > a{
	}';
	
	echo '.widget_nav_menu .menu a:hover, .widget_nav_menu .menu li.active > a{
		color:'.$menu_level2_font_hover_color.';	
		background-color:'.$site_general_color.';
	}';

	//End of Sidebar Custom Menu
	
	
	//Title Breadcrumbs Area Settings
	$title_area_background_image_repeat = xr_get_option('title_area_background_image_repeat', '');
	$title_area_background_image = xr_get_option('title_area_background_image', '');
	$title_area_background_color = xr_get_option('title_area_background_color', '');
	
	$title_area_background_image_retina = xr_get_option('title_area_background_image_retina', '');
	$title_area_background_image_width = xr_get_option('title_area_background_image_width', '');
	$title_area_background_image_height = xr_get_option('title_area_background_image_height', '');
	
	if($title_area_background_image !== ''){
		echo '.quasar-title-breadcrumbs{
				background:url("'.$title_area_background_image.'") '.$title_area_background_image_repeat.';
				background-size:'.$title_area_background_image_width.' '.$title_area_background_image_height.'
		}
		
		@media screen and (-webkit-min-device-pixel-ratio: 2), screen and (max--moz-device-pixel-ratio: 2) {
			.quasar-title-breadcrumbs{background-image:url("'.$title_area_background_image_retina.'");}
		}
		';
	}else{
		echo '.quasar-title-breadcrumbs{background:'.$title_area_background_color.';}';
	}
	echo '.quasar-title-breadcrumbs, .quasar-title-breadcrumbs .page-title{color:'.xr_get_option('title_area_font_color', '#333').';}';
	echo '.quasar-title-breadcrumbs '.$a_not.'{color:'.xr_get_option('title_area_link_color', '#333').';}';
	echo '.quasar-title-breadcrumbs '.$a_not.':hover{color:'.$a_link_hover_color.';}';
	
	echo $ie8.'.quasar-title-breadcrumbs a{color:'.xr_get_option('title_area_link_color', '#333').';}';
	echo $ie8.'.quasar-title-breadcrumbs a:hover{color:'.$a_link_hover_color.';}';
	//End of Title Breadcrumbs Area
	
	
	//Footer Large Area
	$footer_large_background_image_repeat = xr_get_option('footer_large_background_image_repeat', '');
	$footer_large_background_image = xr_get_option('footer_large_background_image', '');
	$footer_large_background_color = xr_get_option('footer_large_background_color', '');
	
	$footer_large_background_image_retina = xr_get_option('footer_large_background_image_retina', '');
	$footer_large_background_image_width = xr_get_option('footer_large_background_image_width', '');
	$footer_large_background_image_height = xr_get_option('footer_large_background_image_height', '');
	
	if($footer_large_background_image !== ''){
		echo '.footer-large{
				background:url("'.$footer_large_background_image.'") '.$footer_large_background_image_repeat.';
				background-size:'.$footer_large_background_image_width.' '.$footer_large_background_image_height.'
		}
		
		@media screen and (-webkit-min-device-pixel-ratio: 2), screen and (max--moz-device-pixel-ratio: 2) {
			.footer-large{background-image:url("'.$footer_large_background_image_retina.'");}
		}
		';
	}else{
		echo '.footer-large{background:'.$footer_large_background_color.';}';
	}
	echo '.footer-large, .footer-large *, .footer-large .widget-title{color:'.xr_get_option('footer_large_font_color', '#333').';}';
	echo '.footer-large '.$a_not.'{color:'.xr_get_option('footer_large_link_color', '#333').';}';
	echo '.footer-large '.$a_not.':hover{color:'.$a_link_hover_color.';}';
	echo '.footer-large{padding:30px 0 60px;}';
	
	echo $ie8.'.footer-large a{color:'.xr_get_option('footer_large_link_color', '#333').';}';
	echo $ie8.'.footer-large a:hover{color:'.$a_link_hover_color.';}';
	
	if(!xr_get_option('footer_large_headers_shadow', true)){
		echo '.footer-large .widget-title{text-shadow:none;}';
	}
	
	$footer_large_border_top_color = xr_get_option('footer_large_border_top_color', '');
	$footer_large_border_bottom_color = xr_get_option('footer_large_border_bottom_color', '');
	echo 'hr.footer-inline-hr{border-top-color:'.$footer_large_border_top_color.'; border-bottom-color:'.$footer_large_border_bottom_color.';}';
	echo '
		.customisable-border.thm-dark, .thm-dark .customisable-border,
		.customisable-border.thm-dark, .thm-dark .customisable-border, .widget .rpwe-block li{
			border-color:'.$footer_large_border_bottom_color.';	
		}
	';
	
	if(xr_get_option('footer_large_top_border',true)){
		echo '.footer-large{border-top:3px solid '.$site_general_color.';}';
	}
	//End of Footer Large Area
	
	
	//Footer Bottom
	echo '.footer-bottom{background:'.xr_get_option('footer_bottom_background_color', '').';}';

	echo '.footer-bottom{color:'.xr_get_option('footer_bottom_font_color', '#333').';}';
	echo '.footer-bottom '.$a_not.'{color:'.xr_get_option('footer_bottom_link_color', '#333').';}';
	echo '.footer-bottom '.$a_not.':hover{color:'.$a_link_hover_color.';}';
	
	echo $ie8.'.footer-bottom a{color:'.xr_get_option('footer_bottom_link_color', '#333').';}';
	echo $ie8.'.footer-bottom a:hover{color:'.$a_link_hover_color.';}';
	//End of Footer Bottom
	
	
	//General Font Colors
	echo 'h1{color:'.xr_get_option('font_h1_color', '').';}';
	echo 'h2{color:'.xr_get_option('font_h2_color', '').';}';
	echo 'h3{color:'.xr_get_option('font_h3_color', '').';}';
	echo 'h4{color:'.xr_get_option('font_h4_color', '').';}';
	echo 'h5{color:'.xr_get_option('font_h5_color', '').';}';
	echo 'h6{color:'.xr_get_option('font_h6_color', '').';}';
	//End of General Font Colors
	
	
	//Blog Colors
	echo '
	.genericon:before,
	.menu-toggle:after,
	.featured-post:before,
	.date a:before,
	.entry-meta .author a:before,
	.format-audio .entry-content:before,
	.comments-link a:before,
	.tags-links a:first-child:before,
	.categories-links a:first-child:before,
	.post-view:before,
	.edit-link a:before,
	.attachment .entry-title:before,
	.attachment-meta:before,
	.attachment-meta a:before,
	.comment-awaiting-moderation:before,
	.comment-reply-link:before,
	.comment-reply-login:before,
	.comment-reply-title small a:before,
	.bypostauthor > .comment-body .fn:before,
	.error404 .page-title:before,
	.post-view-single:before{
		color:'.$site_general_color.';
	}
	';
	
	echo '.more-link:not(.button){color:'.$a_link_color.';}';
	echo '.post-format-container{background-color:'.$site_general_color.'; color:'.xr_get_option('blog_post_type_icon_color','#FFF').';}';
	//End of Blog Colors
	
	
	/*Main Gradient*/
	$main_gradient_top_color = xr_get_option('main_gradient_top_color', '#FFFFFF');
	$main_gradient_bottom_color = xr_get_option('main_gradient_bottom_color', '#F4F4F4');
	echo '
	.main-gradient, .quasar-pagination .page-numbers, input[type="submit"]:not(.checkout-button):not(.button.alt), .comments-submit, #comments-submit{
		background: '.$main_gradient_top_color.';
		background: -moz-linear-gradient(top,  '.$main_gradient_top_color.' 0%, '.$main_gradient_bottom_color.' 100%);
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,'.$main_gradient_top_color.'), color-stop(100%,'.$main_gradient_bottom_color.'));
		background: -webkit-linear-gradient(top,  '.$main_gradient_top_color.' 0%,'.$main_gradient_bottom_color.' 100%);
		background: -o-linear-gradient(top,  '.$main_gradient_top_color.' 0%,'.$main_gradient_bottom_color.' 100%);
		background: -ms-linear-gradient(top,  '.$main_gradient_top_color.' 0%,'.$main_gradient_bottom_color.' 100%);
		background: linear-gradient(to bottom,  '.$main_gradient_top_color.' 0%,'.$main_gradient_bottom_color.' 100%);
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="'.$main_gradient_top_color.'", endColorstr="'.$main_gradient_bottom_color.'",GradientType=0 );
	}
	';
	
	/*Pagination Hover*/
	$pagination_hover_top_color = xr_get_option('pagination_hover_top_color', '#FFFFFF');
	$pagination_hover_bottom_color = xr_get_option('pagination_hover_bottom_color', '#DCDCDC');
	echo '
	.quasar-pagination .page-numbers:not(.current):hover, input[type="submit"]:not(.checkout-button):not(.button.alt):hover, .comments-submit:hover, #comments-submit:hover{
		background: '.$pagination_hover_top_color.';
		background: -moz-linear-gradient(top,  '.$pagination_hover_top_color.' 0%, '.$main_gradient_bottom_color.' 100%);
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,'.$pagination_hover_top_color.'), color-stop(100%,'.$main_gradient_bottom_color.'));
		background: -webkit-linear-gradient(top,  '.$pagination_hover_top_color.' 0%,'.$main_gradient_bottom_color.' 100%);
		background: -o-linear-gradient(top,  '.$pagination_hover_top_color.' 0%,'.$main_gradient_bottom_color.' 100%);
		background: -ms-linear-gradient(top,  '.$pagination_hover_top_color.' 0%,'.$main_gradient_bottom_color.' 100%);
		background: linear-gradient(to bottom,  '.$pagination_hover_top_color.' 0%,'.$main_gradient_bottom_color.' 100%);
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="'.$pagination_hover_top_color.'", endColorstr="'.$main_gradient_bottom_color.'",GradientType=0 );
	}
	';

	echo '
	.quasar-pagination .page-numbers.current, .quasar-pagination .page-numbers:active, .quasar-link_pages > span.page-numbers, 
	.button.active, .button.current, .button.active:hover, .button.current:hover .button.active:active, .button.current:active{
		background:'.$site_general_color.';	 
	}
	';
	/*End of Main Gradients*/

	
	/*Hover effect mask*/
	/*echo '.regular-hover-container .hover-bg{background-color:'.$site_general_color.';}';*/
	
	
	//Main Boxed Layout Background Settings
	$main_boxed_layout_bg_image_repeat = xr_get_option('main_boxed_layout_bg_image_repeat', '');
	$main_boxed_layout_bg_image = xr_get_option('main_boxed_layout_bg_image', '');
	$main_boxed_layout_bg_color = xr_get_option('main_boxed_layout_bg_color', '');
	
	$main_boxed_layout_bg_image_retina = xr_get_option('main_boxed_layout_bg_image_retina', '');
	$main_boxed_layout_bg_image_width = xr_get_option('main_boxed_layout_bg_image_width', '');
	$main_boxed_layout_bg_image_height = xr_get_option('main_boxed_layout_bg_image_height', '');
	
	if($main_boxed_layout_bg_image !== ''){
		echo '#main-canvas{
				background:url("'.$main_boxed_layout_bg_image.'") '.$main_boxed_layout_bg_image_repeat.';
				background-size:'.$main_boxed_layout_bg_image_width.' '.$main_boxed_layout_bg_image_height.'
		}
		
		@media screen and (-webkit-min-device-pixel-ratio: 2), screen and (max--moz-device-pixel-ratio: 2) {
			#main-canvas{background-image:url("'.$main_boxed_layout_bg_image_retina.'");}
		}
		';
	}else{
		echo '#main-canvas{background:'.$main_boxed_layout_bg_color.';}';
	}
	
	//Main Boxed Layout Background Settings	
	$main_bg_image_retina = xr_get_option('main_bg_image_retina', '');
	$main_bg_image_width = xr_get_option('main_bg_image_width', '');
	$main_bg_image_height = xr_get_option('main_bg_image_height', '');
	
	echo 'body.custom-background{
			background-size:'.$main_bg_image_width.' '.$main_bg_image_height.'
	}';
	if($main_bg_image_retina !== ''){
		echo '
		@media screen and (-webkit-min-device-pixel-ratio: 2), screen and (max--moz-device-pixel-ratio: 2) {
			body.custom-background{background-image:url("'.$main_bg_image_retina.'");}
		}
		';
	}


	
	/*Background Settings*/
	$bg_color = get_theme_mod( 'background_color','f0f0f0' ) !== '' ? '#'.get_theme_mod( 'background_color','f0f0f0' ) : '';
	echo '.ui-panel-content-wrap, .ui-overlay-c{background:'.$bg_color.' url("'.get_theme_mod('background_image','').'") '.get_theme_mod('background_repeat','').' '.get_theme_mod('background_attachment','').' '.'top'.' '.get_theme_mod('background_position_x','').' !important; } ';
	
	$canvas_shadow_width = xr_get_option('canvas_shadow_width','50') != '' ? xr_get_option('canvas_shadow_width','50') : 50 ;
	echo '.content_holder{ -webkit-box-shadow: 0px 0px '.$canvas_shadow_width.'px rgba(80, 80, 80, 0.78); -moz-box-shadow: 0px 0px '.$canvas_shadow_width.'px rgba(80, 80, 80, 0.78); box-shadow: 0px 0px '.$canvas_shadow_width.'px rgba(80, 80, 80, 0.78);  } ';
	
	/*Boxed Layout Background Color for Elements*/
	$boxed_layout_bg = xr_get_option('boxed_layout_element_background_color','#666666');
	if(1 == 1 && !$is_ie9_and_lower){
		$boxed_layout_bg = 'rgba('.rockthemes_hex2rgba($boxed_layout_bg, 0.68).')';
	}
	echo '.boxed-layout{background-color:'.xr_get_option('boxed_layout_element_background_color','#666666').';}';
	echo '.rockthemes-parallax .boxed-layout{background-color:'.$boxed_layout_bg.';}';
	echo '.boxed-layout.boxed-colors, .boxed-layout.boxed-colors p, .boxed-layout.boxed-colors h1,
	 .boxed-layout.boxed-colors h2, .boxed-layout.boxed-colors h3, .boxed-layout.boxed-colors h4,
	 .boxed-layout.boxed-colors h5, .boxed-layout.boxed-colors h6,
	 .boxed-layout.boxed-colors div, .boxed-layout.boxed-colors span{color:'.xr_get_option('boxed_layout_text_color','#101010').';}';/*Boxed layout text color*/
	echo '.boxed-layout.boxed-colors a:not(.button){color:'.xr_get_option('boxed_layout_a_link_color','#eeeeee').';}';
	echo '.boxed-layout.boxed-colors a:not(.button):hover{color:'.xr_get_option('boxed_layout_a_link_hover_color','#ffffff').';}';
	
	
	/*Iconic Text*/
	echo '.rock-iconictext-container .rockicon-circle-box i,
	.rock-iconictext-container .rockicon-rounded-box i{color:'.xr_get_option('boxed_layout_text_color','#101010').';}';
	
	echo '.rock-iconictext-container .rockicon-circle-box i,
	.rock-iconictext-container .rockicon-rounded-box i,
	.rock-iconictext-container .rockicon-quasar-box i{color:#f3f3f3;}';
	
	/*Tabs and Toggles use the same background color*/
	$tabs_border_color = xr_get_option('tabs_toggles_border_color', '#E4E4E4');
	$tabs_bg_color = xr_get_option('tabs_toggles_bg_color','#F0F0F0');
	/*Toggles*/
	echo '.rock-toggles-container .active .rock-toggle-header{color:'.$site_general_color.';}';
	echo '.boxed-layout .rock-toggles-container .active .rock-toggle-header{background-color:'.$site_general_color.'; color:'.$menu_level2_font_hover_color.';}';
	echo '.rock-toggles-container .rock-toggle-header{color:'.$a_link_color.';}';
	echo '.rock-toggles-container .rock-toggle-header:hover{color:'.$site_general_color.';}';
	echo '.rock-toggle-content{background:'.$tabs_bg_color.';}';
	
	
	echo '
		.boxed-layout .rock-toggles-container .rock-toggle-header:hover{color:'.$site_general_color.';}
		.boxed-layout .rock-toggles-container .rock-toggle-header{color:'.xr_get_option('boxed_layout_a_link_color','#eeeeee').';}
		.boxed-layout .rock-toggles-container .active .rock-toggle-header{color:'.$menu_level2_font_hover_color.';}
	';
	
	
	

	
	/*Tabs*/
	echo '
	.rock-tabs-container .rock-tabs-header-container .rock-tab-header.active,
	.rock-tabs-container .rock-tabs-header-container .rock-tab-header:hover{color:'.$site_general_color.';}
	';
	echo '.rock-tabs-container .rock-tabs-header-container .rock-tab-header{color:'.$a_link_color.';}';	
	echo '
	.rock-tabs-container .rock-tabs-content-container .tabs-motion-container,
	.rock-tabs-container .rock-tabs-header-container .rock-tab-header.active{
		background:'.$tabs_bg_color.';
	}';
	
	echo '
		.boxed-layout .rock-tabs-container .rock-tabs-header-container .rock-tab-header{color:'.xr_get_option('boxed_layout_a_link_color','#eeeeee').';}
		.boxed-layout .rock-tabs-container .rock-tabs-header-container .rock-tab-header.active,
		.boxed-layout .rock-tabs-container .rock-tabs-header-container .rock-tab-header:hover{color:'.xr_get_option('boxed_layout_a_link_hover_color','#ffffff').';}
	';
	
	echo '.rock-tabs-container.tab-top .rock-tabs-header-container .rock-tab-header.active:first-child,
	.rock-tabs-container.tab-top .rock-tabs-header-container .rock-tab-header.active,
	.rock-tabs-container.tab-top .rock-tabs-header-container .rock-tab-header.active{
		border-left-color:'.$tabs_border_color.';
		border-right-color:'.$tabs_border_color.';
		border-top-color:'.$tabs_border_color.';
	}';
	
	echo '.rock-tabs-container.tab-top .rock-tabs-header-container .rock-tab-header.active{
		border-bottom-color:'.$tabs_bg_color.';
	}';
	
	
	
	
	/*Border Radius of boxed layouts*/
	$layout_border_radius = xr_get_option('layout_border_radius','0px');
	echo '.boxed-layout{border-radius:'.$layout_border_radius.';}';
	
	/*Ajax Filtered Gallery Details*/
	$ajax_filtered_gallery_width = xr_get_option('ajax_filtered_hover_width','590px');
	$ajax_filtered_gallery_height = xr_get_option('ajax_filtered_hover_height','300px');
	$ajax_filtered_gallery_image_width = rockthemes_fn_px_em_return_num($ajax_filtered_gallery_width) + rockthemes_fn_px_em_return_num($default_padding);
	$ajax_filtered_gallery_image_height = rockthemes_fn_px_em_return_num($ajax_filtered_gallery_height) + rockthemes_fn_px_em_return_num($default_padding);
	echo '
	.ajax-filtered-hover-box{
		width:'.$ajax_filtered_gallery_image_width.'px; 
		height:'.($ajax_filtered_gallery_image_height + 90).'px;
		background:'.xr_get_option('ajax_filtered_hover_box_bg', '#FAFAFA').';
		border-color:'.xr_get_option('ajax_filtered_hover_box_border', '#BEBEBE').';
		color:'.xr_get_option('ajax_filtered_hover_box_font', '666666').';
	}';
	echo '.ajax-filtered-hover-box > ajax-filtered-image{width:'.$ajax_filtered_gallery_width.'; height:'.$ajax_filtered_gallery_height.';}';
	
	echo '
	.ajax-filtered-gallery-holder.category-names-in-border .ajax-navigation ul li a,
	.ajax-filtered-gallery-holder.category-names-in-border .ajax-filtered-footer a{
		border-color:'.xr_get_option('ajax_filtered_hover_box_font', '666666').';
	}';
	
	echo '
	.ajax-filtered-gallery-holder.category-names-in-border .ajax-navigation ul li a:hover,
	.ajax-filtered-gallery-holder.category-names-in-border .ajax-filtered-footer a:hover,
	.ajax-filtered-gallery-holder.category-names-in-border .ajax-navigation ul li.active a{
		border-color:'.$site_general_color.';
	}';
	
	
	/*Social Icons*/
	echo '.header-top-1 .rock-social-icon a .social-icon-regular{color:'.xr_get_option('social_media_icons_default_color','#999').' !important;}';
	echo '.header-top-2 .social-icon-regular{color:'.xr_get_option('header_top_link_color', '#FAFAFA').' !important;}';
	echo $ie8.'.header-top-2 .social-icon-regular{color:'.xr_get_option('header_top_link_color', '#FAFAFA').' !important;}';
	echo '.rock-social-icon a .social-icon-hover{color:'.xr_get_option('header_top_link_hover_color', '#FFFFFF').' !important;}';
	
	/*Pricing Table*/
	echo '.quasar-pt-columns:hover{
		box-shadow:0 0 3px '.$site_general_color.';
		-webkit-box-shadow:0 0 3px '.$site_general_color.';
		-moz-box-shadow:0 0 3px '.$site_general_color.';
	}';
	
	/*Team Members*/
	echo '.team-member-content .team-member-i{color:'.$site_general_color.';}';
	echo '.team-member-article.current {
		border-bottom: 20px solid '.xr_get_option('boxed_layout_element_background_color','#666666').';
	}';

	
	/*Gallery*/
	echo '
		.load_more_button:hover{
			color:'.$site_general_color.';
			border-color:'.$site_general_color.';
		}
	';
	
	/*Custom Button Colors*/
	$custom_button_color_1 = xr_get_option('custom_button_color_1', '');
	$custom_button_color_2 = xr_get_option('custom_button_color_2', '');
	$custom_button_color_3 = xr_get_option('custom_button_color_3', '');
	$custom_button_color_4 = xr_get_option('custom_button_color_4', '');
	$custom_button_color_5 = xr_get_option('custom_button_color_5', '');
	
	echo '
	.button-custom {
		background: '.$custom_button_color_3.'; 
	
		background: -moz-linear-gradient(top,  '.$custom_button_color_2.' 0%, '.$custom_button_color_3.' 82%, '.$custom_button_color_4.' 100%); 
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,'.$custom_button_color_2.'), color-stop(82%,'.$custom_button_color_3.'), color-stop(100%,'.$custom_button_color_4.'));
		background: -webkit-linear-gradient(top,  '.$custom_button_color_2.' 0%,'.$custom_button_color_3.' 82%,'.$custom_button_color_4.' 100%);
		background: -o-linear-gradient(top,  '.$custom_button_color_2.' 0%,'.$custom_button_color_3.' 82%,'.$custom_button_color_4.' 100%); 
		background: linear-gradient(to bottom,  '.$custom_button_color_2.' 0%,'.$custom_button_color_3.' 82%,'.$custom_button_color_4.' 100%); 
	  
		border-color: '.$custom_button_color_1.';
		color: white;
		text-shadow: 0 -1px 1px rgba(0, 40, 50, 0.35);
	}

	.button-custom:hover {
		background-color: '.$custom_button_color_4.';
		background: -webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(0%, '.$custom_button_color_4.'), color-stop(100%, '.$custom_button_color_1.'));
		background: -webkit-linear-gradient(top, '.$custom_button_color_4.', '.$custom_button_color_1.');
		background: -moz-linear-gradient(top, '.$custom_button_color_4.', '.$custom_button_color_1.');
		background: -o-linear-gradient(top, '.$custom_button_color_4.', '.$custom_button_color_1.');
		background: linear-gradient(top, '.$custom_button_color_4.', '.$custom_button_color_1.');
	}

	.button-custom:active {
		background: '.$custom_button_color_5.';
		color: #EEE;
		text-shadow:none;
	}
	
	.button-flat-custom {
		-webkit-box-shadow: none;
		-moz-box-shadow: none;
		box-shadow: none;
		-webkit-transition-property: background;
		-moz-transition-property: background;
		-o-transition-property: background;
		transition-property: background;
		-webkit-transition-duration: 0.3s;
		-moz-transition-duration: 0.3s;
		-o-transition-duration: 0.3s;
		transition-duration: 0.3s;
		background: '.$custom_button_color_3.';
		color: white;
		text-shadow: none;
		border: none;
	}
	
	.button-flat-custom:hover {
		background: '.$custom_button_color_4.';
	}
	
	.button-flat-custom:active {
		-webkit-transition-duration: 0s;
		-moz-transition-duration: 0s;
		-o-transition-duration: 0s;
		transition-duration: 0s;
		background: '.$custom_button_color_5.';
		color: #EEE;
	}
	';
	
	/*All escape classes*/
	echo '
	.escape_button_style, .escape_button_style:hover, .escape_button_style:active{
		background:none !important;
		padding:0px !important;
		box-shadow:none !important;
		-moz-box-shadow:none !important;
		-webkit-box-shadow:none !important;
		border:none !important;
		margin:0 !important;
		top:0px !important;
		font-weight:normal !important;
		float:none !important;
	}

	
	.boxed-colors .escape_button_style{
		color:'.xr_get_option('boxed_layout_a_link_color','#ffffff').' !important;	
	}

		
	.escape_button_style{
		color:'.$a_link_color.' !important;	
	}
	
	
	.boxed-colors .escape_button_style:hover{
		color:'.xr_get_option('boxed_layout_a_link_hover_color','#ffffff').' !important;	
	}

		
	.escape_button_style:hover{
		color:'.$a_link_hover_color.' !important;	
	}
	';
	

	/*404*/	
	echo '.error-404-icon{color:'.$site_general_color.';}';
	echo '.error-404-header, .error-404-description{color:'.$light_font_color.';}';
	
	/*HTML Extended Elements*/
	echo 'mark{background-color:'.$site_general_color.';}';
	
	
	/*Extra Styling from user*/
	echo xr_get_option('extra_css_code','');
	
	echo '</style>';
	
	/*Some pseudo elements*/
	if($rockthemes_browser && strpos($rockthemes_browser['name'],'xplorer') > -1 && intval($rockthemes_browser['version']) < 9){

	echo '
	<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery("'.$a_not.'").each(function(){
				if(jQuery(this).parents(".nav-menu").length){
					
				}else{
					jQuery(this).css("color","'.$a_link_color.'");
				}
			});
			jQuery(document).on("mouseenter", "'.$a_not.'", function(){
				if(jQuery(this).parents(".nav-menu").length){
					
				}else{
					jQuery(this).css("color","'.$a_link_hover_color.'");
				}
			});
			jQuery(document).on("mouseleave", ".main-container:not(.nav-menu) '.$a_not.'", function(){
				if(jQuery(this).parents(".nav-menu").length){
					
				}else{
					jQuery(this).css("color","'.$a_link_color.'");
				}
			});
			
		});
	</script>
	';
	}
	
}

//add_filter('wp_footer', 'xr_style_callback');




function rockthemes_to_theme_license_total_try(){
	if(!is_admin()) die();
	$try_obj = get_option('rockthemes_total_try', false);
	
	if(!$try_obj){
		$try_obj = array('try' => 0, 'time' => time());	
		update_option('rockthemes_total_try', json_encode($try_obj));
	}else{
		$try_obj = json_decode($try_obj, true);
		
		$try_obj['try'] = (int) $try_obj['try'] + 1;
		
		if(time() - (int)$try_obj['time'] >= 86400){
			$try_obj['try'] = 0;
			$try_obj['time'] = time();	
		}
		
		update_option('rockthemes_total_try', json_encode($try_obj));
	}
	
	wp_send_json($try_obj);
	exit;
}

add_action('wp_ajax_theme_license_total_try', 'rockthemes_to_theme_license_total_try');





// register an action (can be any suitable action)
//add_action('admin_init', 'on_admin_init');

function rockthemes_to_them_update_check_update($data)
{
    // include the library
    include_once(OPTIONS_DIR.'/envato-wordpress-toolkit-library/class-envato-wordpress-theme-upgrader.php');
    
    $upgrader = new Envato_WordPress_Theme_Upgrader( $data['username'], $data['user_api_key'] );
    
    /*
     *  Uncomment to check if the current theme has been updated
	 i4cbjt9rht8lldu57petvqsw6vcas5zk
     */
    
     return $upgrader->check_for_theme_update();

    /*
     *  Uncomment to update the current theme
     */
    
    // $upgrader->upgrade_theme();
}
function rockthemes_to_them_update_check_update_ajax(){
	if(!is_admin()) die('not admin');
	if(!isset($_REQUEST['data'])) die("no data");
	if(!isset($_REQUEST['data']['username'])) die("no username");
	if(!isset($_REQUEST['data']['user_api_key'])) die("no user api key");
	
	wp_send_json(rockthemes_to_them_update_check_update($_REQUEST['data']));
	
	exit;
}
add_action('wp_ajax_rock_theme_update_check_update', 'rockthemes_to_them_update_check_update_ajax');


function rockthemes_to_them_update_start_update($data)
{
    // include the library
    include_once(OPTIONS_DIR.'/envato-wordpress-toolkit-library/class-envato-wordpress-theme-upgrader.php');
    
    $upgrader = new Envato_WordPress_Theme_Upgrader( $data['username'], $data['user_api_key'] );
    
    /*
     *  Uncomment to check if the current theme has been updated
     */
    
     //return $upgrader->check_for_theme_update();

    /*
     *  Uncomment to update the current theme
     */
    
	$is_updated = $upgrader->upgrade_theme();
	
	//var_dump($is_updated);
	
	//echo $is_updated;
	
    return $is_updated;
}
function rockthemes_to_them_update_start_update_ajax(){
	if(!is_admin()) die('not admin');
	if(!isset($_REQUEST['data'])) die("no data");
	if(!isset($_REQUEST['data']['username'])) die("no username");
	if(!isset($_REQUEST['data']['user_api_key'])) die("no user api key");
	
	$return = rockthemes_to_them_update_start_update($_REQUEST['data']);
	
	wp_send_json($return);
	//wp_send_json(rockthemes_to_them_update_start_update($_REQUEST['data']));
	
	exit;
}
add_action('wp_ajax_rock_theme_update_start_update', 'rockthemes_to_them_update_start_update_ajax');







/*
**	Include Chosen Google Font in wp_head action hook
**
**	@params	:	None
**	@return	:	Void
*/
if(!function_exists('rockthemes_to_google_font')){
	function rockthemes_to_google_font(){
		$google_font = xr_get_option('google_font_standard_code', '');
		
		if($google_font !== ''){
			echo $google_font;	
		}
		return;
	}
}
add_action('wp_head', 'rockthemes_to_google_font');





/*
	This function should be moved to another file
*/
if(!function_exists('rockthemes_fn_px_em_return_num')):
function rockthemes_fn_px_em_return_num($val){
	$val = str_replace('px','',$val);
	$val = str_replace('em','',$val);
	return intval($val);
}
endif;


?>