<?php
/*
This file will be holding all of the general functions of the Curvy Slider on the server side.
*/

if(CURVY_STANDALONE){
	if(isset($_POST['action'])){
		if(function_exists('wp_ajax_' . $_POST['action'])){
			do_action( 'wp_ajax_' . $_POST['action'] );
		}
	}
}

add_action( 'wp_ajax_save_curvy_slider_references', 'save_curvy_slider_references' );


if(!function_exists('save_curvy_slider_references')){
	function save_curvy_slider_references(){
		if(!current_user_can(CURVY_USER_CAPABILITY)) die;

		$curvy_slider_references = $_REQUEST['curvy_slider_references_data'];
		
		$error;
		if($error = update_option('curvy_slider_references', $curvy_slider_references)){
			echo "saved";
		}else{
			echo "update_error ".$error;
		}
		exit;
	}
}

//Quasar Animation Builder Save Function
add_action( 'wp_ajax_quasar-save', 'quasar_save' );

function quasar_save() {
	if(!current_user_can(CURVY_USER_CAPABILITY)) die();
	
	// get the submitted parameters
	$array = $_POST['quasarAnimationBuilder'];
	
	$saved_settings = get_option('quasar_animation_builder_data', array());
	
	$current_settings = array(
	
	
	);
		
	  /* settings are not the same update the DB */
	  if ( $saved_settings !== $array ) {
		update_option( 'quasar_animation_builder_data', $array ); 
	  }
	
	//Update the google fonts data for enqueue
	$fonts = isset($_POST['animationGoogleFonts']) ? $_POST['animationGoogleFonts'] : array();
	update_option('quasar_google_fonts',$fonts);

	exit;
}

//IN USE Quasar Animation Builder Save Function
add_action( 'wp_ajax_curvy_save_animation', 'curvy_save_animation' );

function curvy_save_animation() {
	if(!current_user_can(CURVY_USER_CAPABILITY)) die;
	// get the submitted parameters
	$incomingData = json_decode(stripslashes($_POST['curvyAnimationData']));
	$sliderDBName = $incomingData->sliderDBName;
	$sliderDBName = 'curvy_slider_'.intval(str_replace('curvy_slider_', '', sanitize_text_field($sliderDBName)));
	$animationName = $incomingData->animationName;
	$array = $incomingData->scenes;
	update_option( $sliderDBName, stripslashes($_POST['curvyAnimationData']) ); 

	
	$curvy_slider_references = (json_decode(get_option('curvy_slider_references'),true));
	foreach($curvy_slider_references as $key => $value){
		echo $curvy_slider_references[$key]['id'].' / '.$incomingData->id;
		if($curvy_slider_references[$key]['id'] == $incomingData->id){
			echo $curvy_slider_references[$key]['name'].' / '.$incomingData->animationName;
			$curvy_slider_references[$key]['name'] = 	$incomingData->animationName;
			$curvy_slider_references[$key]['modified'] = date('m/d/Y');
			break;
		}
	}
	update_option('curvy_slider_references', json_encode($curvy_slider_references));
	
	exit;
}


function curvy_get_slider_list($selected=null, $modal_ID = null, $echo = true){
	if(!current_user_can(CURVY_USER_CAPABILITY)) return;
	
	$curvy_slider_references = (json_decode(get_option('curvy_slider_references'),true));
	
	$return = '';//'<h4>Choose a Curvy Slider</h4>';
	
	if(!empty($curvy_slider_references)){
	
	$return .= '<select class="curvy_slider_list">';
	
	foreach($curvy_slider_references as $ref){
		if($selected == $ref['shortcode']){
			$return .= '<option value="'.htmlentities($ref['shortcode']).'" selected>'.$ref['name'].'</option>';
		}else{
			$return .= '<option value="'.htmlentities($ref['shortcode']).'">'.$ref['name'].'</option>';
		}
	}
	
	$return .= '</select>';
	
	}else{
		
		$return .= 'No Curvy Slider Found!';
			
	}
	
	if($echo){
		echo $return;
	}else{
		return $return;
	}
	
	exit;
}

function curvy_get_slider_list_ajax(){
	curvy_get_slider_list();	
	exit;
}

add_action('wp_ajax_curvy_get_slider_list', 'curvy_get_slider_list');





function makeCurvySlider($atts){
	extract( shortcode_atts( array(
			'id'					=> '',
			'auto_play'				=> 'true',
			'slider_bottom_divider' => ''
	), $atts ) );	
	
	if($id === '') return;
		
	$dec = '';
	if(!defined('ROCK_DEBUG') || !ROCK_DEBUG) $dec = '.min';
	
	
	$sliderDBName = 'curvy_slider_'.$id;
	$saved_settings = (get_option($sliderDBName, array()));
	
	if(empty($saved_settings)) return;
	
	$GLOBALS['curvy_html_id'] = isset($GLOBALS['curvy_html_id']) ? $GLOBALS['curvy_html_id'] + 1 : 0;
	
	$curvy_html_id = $GLOBALS['curvy_html_id'];

	$canvasID = "curvy-canvas-".$curvy_html_id;

	$rockthemes_browser = rockthemes_get_browser_details();
	
	$loader = F_WAY.'/images/loader.gif';
		
	if($loader !== ''){
		$loader = '
			<div class="loader-container" style="position:relative; text-align:center; opacity:0">
				<div style="text-align:center; display: inline-block;position: relative;">
					<img src="'.$loader.'" />
				</div>
			</div>
		';		
			
	}
	
	$canvas_supported = true;
		
	//var_dump($rockthemes_browser);
	if(strpos($rockthemes_browser['name'], "Explorer") > -1){
		if(intval($rockthemes_browser['version']) >= 9){
			wp_enqueue_script('rockthemes-curvy-slider-caat', CURVY_URI.'js/caat.min.js', array('jquery'));
		}else{
			$canvas_supported = false;
		}
	}else{
		wp_enqueue_script('rockthemes-curvy-slider-caat', CURVY_URI.'js/caat.min.js', array('jquery'));
	}

	$ssl = is_ssl() ? 'https' : 'http';
	
	wp_enqueue_script('google-webfont-api', $ssl.'://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js', array());
	
	wp_enqueue_script('rockthemes-curvy-slider-js', CURVY_URI.'frontend/js/curvy-slider-frontend.min.js', array('jquery', 'google-webfont-api'));
	
	wp_enqueue_style('rockthemes-curvy-slider-style',  CURVY_URI.'css/curvy-slider-style.css', '','', 'all');

	//For fullwidth slider
	$full_width = "false";
	
	//For small screens remove the padding to make the slider look fullwidth
	$responsive_full_width = "true";
	
	$row_max_width = '62.5em';
	
	$return = '';
		
	if($canvas_supported){
		$return .= '
		<div class="rockthemes-curvy-slider curvy-inline-nav">
			'.$loader.'
			<div id="curvy-slider-main-container-'.$curvy_html_id.'" style="opacity:0">
				<div id="quasar-animID">
					<div id="experiment-holder">
						<canvas id="'.$canvasID.'"></canvas>
						<div class="clear"></div>
					</div>
				</div>
		';
	}else{
		$return .= '
		<div class="rockthemes-curvy-slider curvy-inline-nav" style="opacity:0;">
			<div id="curvy-slider-main-container-'.$curvy_html_id.'" class="rockthemes-curvy-slider">
				<div class="curvy-slider-fallback-canvas"></div>
		';
	}
	
	if($full_width == "true"){
		$return .= '<div class="row">';
	}
	
	$style = '';
	//For small devices make the slider fullwidth by removing padding
	if($responsive_full_width == "true"){
		/*
		$style .= '
			<style type="text/css">
				@media only screen and (max-width:'.$row_max_width.') {
					#quasar-animID{margin-left:-0.9375em; margin-right:-0.9375em;}
				}
			</style>
		';
		*/
	}
	
	if(!$canvas_supported) $style = '';
	
	$navigation = '
		<div class="curvy-slider-nav-container">
			<div class="curvy-slider-nav">
				<div class="curvy-start-button curvy-main-nav-elem" ref="curvy-slider-main-container-'.$curvy_html_id.'"><i id="playAllScenesBtn" class="fa fa-play"></i></div>
				<div id="stopAllScenesBtn" class="curvy-stop-button curvy-main-nav-elem" ref="curvy-slider-main-container-'.$curvy_html_id.'"><i class="fa fa-pause"></i></div>
			</div>
		</div>
	';
	
	$script = '';
	if($curvy_html_id === 1 || 1==1){
	$script .= '
		<script type="text/javascript">
			jQuery(document).ready(function(){
				var loader_container_top = jQuery(window).width() * 700 / 1920 / 2 - 10;
				jQuery("#curvy-slider-main-container-'.$curvy_html_id.'").parent().find(".loader-container").css({"margin-top":loader_container_top, "opacity":"1"});
				jQuery.curvySlider("'.$id.'","curvy-slider-main-container-'.$curvy_html_id.'", "'.$canvasID.'", "'.$auto_play.'", '.$saved_settings.');
			});
		</script>
	';
	}
	
	$under_curvy_slider = '';
	
	switch($slider_bottom_divider){
		case '':
		
		break;
		
		case 'use_border':
		$under_curvy_slider = '<div class="curvy-slider-bottom curvy-border-margin"><div class="curvy-border-bottom"></div></div>';
		break;
		
		case 'use_shadow':
		$under_curvy_slider = '<div class="curvy-slider-bottom"><div class="shadow-divider-down"><img src="'.CURVY_URI.'images/shadow-divider-down.png" /></div></div>';
		break;	
	}
	
	$under_curvy_slider = apply_filters('under_curvy_slider', $under_curvy_slider);
	
	return $return.$under_curvy_slider.$navigation.'</div></div>'.$style.$script;
	//This closing div is closing the main container id div

}


add_shortcode('curvyslider','makeCurvySlider');



function get_curvy_slider_data(){
	if(!current_user_can(CURVY_USER_CAPABILITY)) return;
	
	if(!isset($_REQUEST['id'])) return;
	
	$id = intval($_REQUEST['id']);
	$sliderDBName = 'curvy_slider_'.$id;
		
	$saved_settings = (get_option($sliderDBName, array()));
	
	echo $saved_settings;
	
	exit;
}

add_action('wp_ajax_get_curvy_slider_data','get_curvy_slider_data');
add_action('wp_ajax_nopriv_get_curvy_slider_data','get_curvy_slider_data');



?>