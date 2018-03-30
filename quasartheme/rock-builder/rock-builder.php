<?php

/*
**	Rock Page Builder Main File
**
**	Alias	:	Rock Builder UI		Located in "rock-builder/builder-functions.php"
**	Alias	:	Rock Builder		Located in "rock-builder/rock-builder-ui.php"
**	Author	:	Rockthemes.net
**	License	:	Contact to rockthemes.net for further information
**	Version	:	1.3
**
**	Main file of Rock Page Builder
*/


include_once(get_template_directory().'/rock-builder/builder-functions.php');

function load_rock_builder_files(){
	global $pagenow;
	
	$allowed_post_types = array(
			'page',
			'post',
			'quasarproducts',
			'product',
			'quasargallery',
	);
	
	if(function_exists('get_current_screen')){
		//Do not load in media edit screen
		$current_screen = get_current_screen();
		if(isset($current_screen) && $current_screen->post_type === 'attachment') return;
		
		if(!empty($current_screen->post_type)){
			$allowed = false;
			
			foreach($allowed_post_types as $allowed_type){
				if($allowed_type == $current_screen->post_type){
					$allowed = true;	
				}
			}
			
			if(!$allowed){
				return;	
			}
		}
	}


	if(($pagenow == 'post.php' && !empty($_REQUEST['action']) && $_REQUEST['action'] == 'edit') || 
		($pagenow == 'post-new.php') /*May cause conflicts*/ ||
		($pagenow == 'post-new.php' && !empty($_REQUEST['post_type']) && $_REQUEST['post_type'] == 'page') ||
		($pagenow == 'post-new.php' && !empty($_REQUEST['post_type']) && $_REQUEST['post_type'] == 'quasarproducts') ||
		($pagenow == 'post-new.php' && !empty($_REQUEST['post_type']) && $_REQUEST['post_type'] == 'product') || 
		($pagenow === 'themes.php' && !empty($_REQUEST['page']) && $_REQUEST['page'] === 'rock_options')){

			
		wp_enqueue_script('jquery-ui-core');
		
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script('wp-color-picker');
		wp_enqueue_script('json2');
						
		//add_editor_style( '/rock-builder/css/editor-style.css');
		
		wp_enqueue_style( 'bootstrap-css', F_WAY.'/rock-builder/bootstrap/css/bootstrap.css', '', '', 'all' );
		wp_enqueue_script('bootstrap-min', F_WAY.'/rock-builder/bootstrap/js/bootstrap.js', array('jquery'), '');
		
		wp_enqueue_style( 'fontawesome', F_WAY.'/css/font-awesome.css', '', '', 'all' );
			
		wp_enqueue_style( 'gridster-css', F_WAY.'/rock-builder/css/jquery.gridster.css', '', '', 'all' );
		wp_enqueue_style( 'rock-builder-css', F_WAY.'/rock-builder/css/rock-builder-style.css', '', '', 'all' );
		
		wp_enqueue_script('gridster-min', F_WAY.'/rock-builder/js/jquery.gridster.js', array('jquery'), '');
		wp_enqueue_script('rock-builder-js', F_WAY.'/rock-builder/js/rock-builder.min.js', array('jquery'), '');
		
		wp_enqueue_style( 'bootstrap-modal-css', F_WAY.'/rock-builder/bootstrap-modal-master/css/bootstrap-modal.css', '', '', 'all' );
		
		wp_enqueue_script('bootstrap-modal-master', F_WAY.'/rock-builder/bootstrap-modal-master/js/bootstrap-modalmanager.js', array('jquery'), '');
		wp_enqueue_script('bootstrap-modal-reg', F_WAY.'/rock-builder/bootstrap-modal-master/js/bootstrap-modal.js', array('jquery'), '');
		
		$ajax_vars = array(
			'ajaxurl' 	=>	admin_url( 'admin-ajax.php' ), 
			'siteurl' 	=>	home_url(),
			'nonces'	=> array(
				'rpb_save_nonce' =>	wp_create_nonce('rpb_save_nonce')
			)
			
		);

		// declare the URL to the file that handles the AJAX request (wp-admin/admin-ajax.php)
		wp_localize_script( 'rock-builder-js', 'rockAjax', $ajax_vars);

	}
}

add_action('admin_enqueue_scripts', 'load_rock_builder_files');

function init_pagebuilder_to_pages(){
	foreach (array('post','page','quasarproducts','product') as $type) 
    {
		add_meta_box( 'custom_page', 'Page Builder' , 'rock_pages_ui', $type, 'normal', 'high' );
    }
}

add_action( 'admin_init', 'init_pagebuilder_to_pages' );


function rockthemes_pb_frontend_display_nosidebar_content_before(){
	global $post;
	//Check if post exists (For WPML)	
	if(empty($post)) return;
	
	/*
	**	Password Protected
	**
	**	@since	:	1.3
	*/
	if(post_password_required()) return;
		
	//Return if not single or page (For custom post types and posts)
	if(!is_single() && !is_page()) return;
	
	//Check if page-builder in use
	$in_use = get_post_meta($post->ID,'_builder_in_use',true);
	
	if(!isset($in_use) || $in_use === 'false'){
		$content_before = array();
		preg_match_all('/\[rockthemes_specialgridblock avoid_sidebar\=\"before\".*?\[\/rockthemes_specialgridblock\]/s', get_the_content(), $content_before);
		if(empty($content_before) || empty($content_before[0]) || empty($content_before[0][0])) return;
		foreach($content_before[0] as $cntbfr){
			echo do_shortcode($cntbfr);
		}
		return;
	}
	
    $val = get_post_meta( $post->ID, '_this_r_content', true );  

    if( empty( $val ) ) return;  
		
	$val = preg_replace( "/\r|\n/", "", $val);
	$final_val = (json_decode($val, true));
		
	if(!is_array($final_val)){
		$final_val = json_decode(stripslashes($val), true);
	}
	//var_dump(is_array($final_val));
	echo '</div>'.do_shortcode(rockthemes_pb_parse_content_val($final_val,'before')).'<div class="row">';
}
add_action('rockthemes_pb_frontend_before_page','rockthemes_pb_frontend_display_nosidebar_content_before', 11);

function rockthemes_pb_frontend_display_nosidebar_content_after(){
	global $post;
	//Check if post exists (For WPML)	
	if(empty($post)) return;
	
	/*
	**	Password Protected
	**
	**	@since	:	1.3
	*/
	if(post_password_required()) return;
		
	//Return if not single or page (For custom post types and posts)
	if(!is_single() && !is_page()) return;
	
	//Check if page-builder in use
	$in_use = get_post_meta($post->ID,'_builder_in_use',true);
	
	if(!isset($in_use) || $in_use === 'false'){
		$content_before = array();
		preg_match_all('/\[rockthemes_specialgridblock avoid_sidebar\=\"after\".*?\[\/rockthemes_specialgridblock\]/s', get_the_content(), $content_before);
		if(empty($content_before) || empty($content_before[0]) || empty($content_before[0][0])) return;
		foreach($content_before[0] as $cntbfr){
			echo do_shortcode($cntbfr);
		}
		return;
	}
	
    $val = get_post_meta( $post->ID, '_this_r_content', true );  

    if( empty( $val ) ) return;  
		
	$val = preg_replace( "/\r|\n/", "", $val);
	$final_val = (json_decode($val, true));
		
	if(!is_array($final_val)){
		$final_val = json_decode(stripslashes($val), true);
	}
	
	//var_dump(is_array($final_val));
	echo '</div></div>'.do_shortcode(rockthemes_pb_parse_content_val($final_val,'after')).'<div><div class="row">';
}
add_action('rockthemes_pb_frontend_after_page','rockthemes_pb_frontend_display_nosidebar_content_after', 11);



function rockthemes_pb_parse_content_val($val,$nosidebar_content = 'false'){
	//return if no value entered or the value is not an array
	if(!isset($val) && !is_array($val)) return;
	
	foreach ($val as $key => $value) {

		$col[$key] = $value['col'];
		
		$row[$key] = $value['row'];
	
	}
	
	array_multisort($row, $col, $val);
	
	$main_return = '';
	$return = '';	
	
	$calcColumn = 0;
	$latestRow = 1;
	$columnsInRow = 1; //Must be 12 for each column
	$fullwidth_colored_active = false;//For fullwidth colored rows
	$fullwidth_slider_active = false;//For full width slider rows
	$general_padding = rockthemes_fn_px_em_return_num(xr_get_option('content_padding','10px'));
	$shadow_html = '';
	$last_shadow_html = '';
	$skip_content_in_blocks = false;
	
	foreach($val as $singleVal){
		
		//Open and close special grid block
		if($nosidebar_content !== 'false'){
			if(isset($singleVal['special_grid_block_open']) && $singleVal['special_grid_block_open'] === 'yes'){
				//$return .= 'OPENED';
				
				if($singleVal['grid_data']['data']['data']['avoidSidebar'] === $nosidebar_content){
					$GLOBALS['rockthemes_pb_specialgridblocks'] = true;
				}
			}elseif(isset($singleVal['special_grid_block_open']) && $singleVal['special_grid_block_open'] === 'no'){
				//$return .= 'CLOSED';
				if($singleVal['grid_data']['data']['data']['avoidSidebar'] === $nosidebar_content){
					$GLOBALS['rockthemes_pb_specialgridblocks'] = false;
				}
			}
		}else{
			//Not before not after, regular content. But blocks are still exists, these two statements will escape content in blocks
			if(isset($singleVal['special_grid_block_open']) && $singleVal['special_grid_block_open'] === 'yes'){
				//echo 'OPENED';
				$skip_content_in_blocks = true;	
			}elseif(isset($singleVal['special_grid_block_open']) && $singleVal['special_grid_block_open'] === 'no'){
				//echo 'CLOSED';
				$skip_content_in_blocks = false;	
			}
		}
				
		//Do not display if this is no sidebar content
		//if(isset($singleVal['grid_data']['data']['data']['avoidSidebar']) && $nosidebar_content === 'false' && $singleVal['grid_data']['data']['data']['avoidSidebar'] !== 'false' ) continue;
		
		if($nosidebar_content === 'false' && ((isset($GLOBALS['rockthemes_pb_specialgridblocks']) && $GLOBALS['rockthemes_pb_specialgridblocks']) || $skip_content_in_blocks)) continue;
		
		//Display only no sidebar content before sidebars
		if(($nosidebar_content === 'before' ) && (!isset($singleVal['special_grid_block_open']) || $singleVal['special_grid_block_open'] !== 'no') && (!isset($GLOBALS['rockthemes_pb_specialgridblocks']) || !$GLOBALS['rockthemes_pb_specialgridblocks'] ) ) continue;

		//Display only no sidebar content after sidebars
		if(($nosidebar_content === 'after' ) && (!isset($singleVal['special_grid_block_open']) || $singleVal['special_grid_block_open'] !== 'no') && (!isset($GLOBALS['rockthemes_pb_specialgridblocks']) || !$GLOBALS['rockthemes_pb_specialgridblocks'] )) {continue;}
		
		
		
		
		//Check if using fullwidth for sliders
		$fullwidth_slider = isset($singleVal['grid_data']['data']['data']['grid_special_width_details']) &&
							$singleVal['grid_data']['data']['data']['grid_special_width_details'] === 'full_width_slider' ? true : false;
			
		//Check if using fullwidth background color
		$fullwidth_colored = isset($singleVal['grid_data']['data']['data']['grid_special_width_details']) &&
							$singleVal['grid_data']['data']['data']['grid_special_width_details'] === 'full_width_colored' ? true : false;
			
		//Check if using parallax
		$parallax_used = isset($singleVal['grid_data']['data']['data']['grid_special_width_details']) &&
							$singleVal['grid_data']['data']['data']['grid_special_width_details'] === 'use_parallax' ? true : false;
		
		//Background Image in Special Blocks
		$background_img_used = isset($singleVal['grid_data']['data']['data']['grid_special_width_details']) &&
							$singleVal['grid_data']['data']['data']['grid_special_width_details'] === 'use_background_img' ? true : false;
		
		
		$background_color = isset($singleVal['grid_data']['data']['data']['background_color']) ?
							$singleVal['grid_data']['data']['data']['background_color'] : '';

		$transparent_background = checked("true", (isset($singleVal['grid_data']['data']['data']['transparent_background']) ? $singleVal['grid_data']['data']['data']['transparent_background'] : false ), false);
		
				
		
		$padding_vertical_html = '';
		
		if(isset($singleVal['grid_data']['data']['data']['activate_padding']) && $singleVal['grid_data']['data']['data']['activate_padding'] === 'true'){
			$padding_vertical_html = 'padding-top:'.(4 * $general_padding).'px; padding-bottom:'.(4 * $general_padding).'px;';
		}

				
		if(intval($singleVal['row']) === intval($latestRow)){

		}else{
			$latestRow = $singleVal['row'];
			
			if($columnsInRow <= 12 && $columnsInRow !== 1)	$return .= '<div class="large-'.(13 - $columnsInRow).' columns"></div>';

			if($fullwidth_colored_active && (!$GLOBALS['rockthemes_pb_specialgridblocks'])){
				$return .= '</div>';
				$return .= $shadow_html;
				$shadow_html = '';
				
				$fullwidth_colored_active = false;	
			}
			
			if($parallax_used && (!$GLOBALS['rockthemes_pb_specialgridblocks'])){
				$return .= '</div>';
				$parallax_used = false;	
			}

			if(!$fullwidth_slider_active){
				$return .= '</div><div class="row">';
			}

			$columnsInRow = 1;
		}
		
		$animation_used = isset($singleVal['grid_data']['data']['data']['animation_type']) ? $singleVal['grid_data']['data']['data']['animation_type'] : '';

		if($animation_used !== ''){
			$animation_details = ' animation-class="'.$animation_used.'" animation-delay-time="'.$singleVal['grid_data']['data']['data']['animation_delay_time'].'"';
			$animation_main_class = 'rockthemes-animate';
		}
		
		if(isset($singleVal['grid_data']['data']['data']['use_shadow']) && $singleVal['grid_data']['data']['data']['use_shadow'] === 'true'){
			$shadow_html = '<div class="hr-shadow-mask rotate-shadow"><hr class="hr-shadow active shadow-effect curve curve-hz-1"></div>';
			$shadow_html = quasar_image_shadow_up();
		}

		$last_shadow_html = $shadow_html;


		//Add Parallax 
		if($parallax_used && !$fullwidth_colored_active && $nosidebar_content !== 'false'){
			$special_grid_html_id_code = '';
			$special_grid_html_id = isset($singleVal['grid_data']['data']['data']['special_grid_html_id']) ? $singleVal['grid_data']['data']['data']['special_grid_html_id'] : false;
			if(!empty($special_grid_html_id)){
				$special_grid_html_id_code = 'id="'.$special_grid_html_id.'" ';
			}
			
			$return .= '
			</div>
			<div '.$special_grid_html_id_code.' class="rockthemes-parallax" 
				parallax-model="height_specific" 
				parallax-bg-image="'.$singleVal['grid_data']['data']['data']['parallax_bg_image'].'" 
				parallax-mask-height="'.$singleVal['grid_data']['data']['data']['parallax_mask_height'].'">
			<div class="row">';
			$fullwidth_colored_active = true;
		}
		
		//Add Background Image 
		if($background_img_used && !$fullwidth_colored_active && $nosidebar_content !== 'false'){
			$special_grid_html_id_code = '';
			$special_grid_html_id = isset($singleVal['grid_data']['data']['data']['special_grid_html_id']) ? $singleVal['grid_data']['data']['data']['special_grid_html_id'] : false;
			if(!empty($special_grid_html_id)){
				$special_grid_html_id_code = 'id="'.$special_grid_html_id.'" ';
			}

			$return .= '
			</div>
			<div '.$special_grid_html_id_code.' class="rockthemes-parallax" 
				parallax-model="no_parallax_only_image" 
				parallax-bg-image="'.$singleVal['grid_data']['data']['data']['parallax_bg_image'].'" 
				parallax-mask-height="'.$singleVal['grid_data']['data']['data']['parallax_mask_height'].'">
			<div class="row">';
			$fullwidth_colored_active = true;
		}

		//Add Fullwidth colored (Colored Background)
		if($fullwidth_colored && !$fullwidth_colored_active && $nosidebar_content !== 'false'){
			$special_grid_html_id_code = '';
			$special_grid_html_id = isset($singleVal['grid_data']['data']['data']['special_grid_html_id']) ? $singleVal['grid_data']['data']['data']['special_grid_html_id'] : false;
			if(!empty($special_grid_html_id)){
				$special_grid_html_id_code = 'id="'.$special_grid_html_id.'" ';
			}
			
			$return .= '</div><div '.$special_grid_html_id_code.' class="rockthemes-fullwidth-colored" style="'.(!$transparent_background ? 'background:'.$background_color.';' : '').' '.$padding_vertical_html.'"><div class="row">';
			$fullwidth_colored_active = true;
		}
		
		//Add Fullwidth for slider
		if($fullwidth_slider && !$fullwidth_slider_active && $nosidebar_content !== 'false'){
			$return .= '</div>';	
			$fullwidth_slider_active = true;
		}
		
		//Columns Div
		if(!$fullwidth_slider_active){
		if($columnsInRow < intval($singleVal['col']) && $columnsInRow !== 0){
			if($animation_used !== ''){
				$return .= '<div class="large-'.$singleVal['size_x'].' large-offset-'.(intval($singleVal['col']) - $columnsInRow).' columns '.$animation_main_class.'" '.$animation_details.'>';
			}else{
				$return .= '<div class="large-'.$singleVal['size_x'].' large-offset-'.(intval($singleVal['col']) - $columnsInRow).' columns">';
			}
			
			$columnsInRow = intval($singleVal['size_x']) + intval($singleVal['col']);

		}else{
			if($animation_used !== ''){
				$return .= '<div class="large-'.$singleVal['size_x'].' columns '.$animation_main_class.'" '.$animation_details.'>';
			}else{
				$return .= '<div class="large-'.$singleVal['size_x'].' columns">';
			}
			
			$columnsInRow = $columnsInRow + intval($singleVal['size_x']);
		}
		}
		
			

		if(isset($singleVal['elems']) && !empty($singleVal['elems']) ){
			
			foreach($singleVal['elems'] as $singleElem){
				$return .= makeObjectWithDetails($singleElem);
			}
						
		}
		
		
		//Add Fullwidth for slider
		if($fullwidth_slider_active && isset($GLOBALS['rockthemes_pb_specialgridblocks']) && !$GLOBALS['rockthemes_pb_specialgridblocks']){
			$return .= '<div class="row after-fullwidth-slider"><div class="large-'.$singleVal['size_x'].' columns">';	
			$fullwidth_slider_active = false;
		}
		


		
		//Add Fullwidth colored (Colored Background)
		if($fullwidth_colored){
			//$return .= '</div>';	
		}

		if(!$fullwidth_slider_active){
			//close columns div
			$return .= '</div>';
		}
		
	}
	
	if($columnsInRow <= 12 && $columnsInRow !== 1)	$return .= '<div class="large-'.(13 - $columnsInRow).' columns"></div>';
	
	if($return !== ''){
		$main_return = '<div class="row">'.$return.'</div>';
	}
	
	
	if($fullwidth_colored_active && isset($GLOBALS['rockthemes_pb_specialgridblocks']) && !$GLOBALS['rockthemes_pb_specialgridblocks']){
		$main_return .= $last_shadow_html;
		$main_return .= '</div>';
		$fullwidth_colored_active = false;	
	}
	
	if($fullwidth_slider_active && isset($GLOBALS['rockthemes_pb_specialgridblocks']) && !$GLOBALS['rockthemes_pb_specialgridblocks']){
		$main_return .= '</div>';
		$fullwidth_slider_active = false;	
	}
	
	/*
	**	Remove empty rows and empty columns
	**
	**	@since	:	1.3
	**
	*/
	$main_return = str_replace('<div class="large-12 columns"></div>','',$main_return);
	$main_return = str_replace('<div class="row"></div>','',$main_return);
	
	return $main_return;
}

function makeObjectWithDetails($elem){
	switch($elem['descType']){
		case 'textarea':
		return '<div>'.$elem['desc'].'</div>';
		break;	
		
		case 'textfield':
		return $elem['desc'];
		break;
		
		case 'ajaxfiltered':
		return $elem['desc'];
		break;
		
		case 'swiperslider':
		return $elem['desc'];
		break;
		
		case 'sidebar':
		/*This is not shortcode for now. According to Themeforest new rules, this can be turn into a shortcode*/
		ob_start();
		dynamic_sidebar($elem['desc']);
		return ob_get_clean();
		break;
		
		case 'toggles':
		return $elem['desc'];
		break;
		
		case 'tabs':
		return $elem['desc'];
		break;
		
		case 'iconictext':
		return $elem['desc'];
		break;
		
		case 'button':
		return $elem['desc'];
		break;
		
		case 'rockformbuilder':
		return $elem['desc'];
		break;
				
		default :
		return $elem['desc'];
		break;
	}
	
	return '';
}



add_filter( 'the_content', 'rockthemes_pb_wp_content_filter' );  
function rockthemes_pb_wp_content_filter( $content )  
{  	
    // We're in the loop, so we can grab the $post variable  
    global $post;  
	//Check if post exists (For WPML)	
	if(empty($post)) return;
	
	/*
	**	Password Protected
	**
	**	@since	:	1.3
	*/
	if(post_password_required()) return get_the_password_form();
	
    // We only want this on single posts, bail if we're not in a single post  
    if( !is_single() && !is_page() ) return $content;  
	
	//Check if page-builder in use
	$in_use = get_post_meta($post->ID,'_builder_in_use',true);
	
	//if(!isset($in_use) || $in_use === 'false') return '<div class="large-12 columns">'.$content.'</div>';
	if(!isset($in_use) || $in_use === 'false'){
		/*
		**	Remove all of the special grid codes from the general content area.
		**	Special grid block contents will be displayed before/after the content
		**
		**	@since	:	1.3
		*/
		return preg_replace('/\[rockthemes_specialgridblock.*?\[\/rockthemes_specialgridblock\]/s', '', $content);
	}
	
    $val = get_post_meta( $post->ID, '_this_r_content', true );  
	
    if( empty( $val ) ){ 
		/*
		**	Remove all of the special grid codes from the general content area.
		**	Special grid block contents will be displayed before/after the content
		**
		**	@since	:	1.3
		*/
		return preg_replace('/\[rockthemes_specialgridblock.*?\[\/rockthemes_specialgridblock\]/s', '', $content);
	}
	
	$val = preg_replace( "/\r|\n/", "", $val);
	$final_val = (json_decode($val, true));

	if(!is_array($final_val)){
		$final_val = json_decode(stripslashes($val), true);
	}

	return rockthemes_pb_parse_content_val($final_val);// .$content removed
}





/*
**	This filter applies any page template not related to this theme. If Rock Page Builder contains Featured Image
**	This function will remove the regular featured image
*/
function rockthemes_pb_thumbail_filter($html) {
	global $post;
	$queried = get_queried_object();
   	if(rockthemes_pb_featured_in_builder() === "true" && $queried && isset($queried->ID) && $queried->ID == $post->ID){
		$in_use = get_post_meta($post->ID,'_builder_in_use',true);
		
		if(isset($in_use) && $in_use !== 'false' && is_single($post)) return;
	}
	return $html;
}

add_filter('post_thumbnail_html', 'rockthemes_pb_thumbail_filter', 99, 1);




function rockthemes_pb_num_to_string($num){
	$numArray = array(1,2,3,4,5,6,7,8,9,10,11,12);
	$stringArray = array('one','two','three','four','five','six','seven','eight','nine','ten','eleven','twelve');
	
	return str_replace($numArray,$stringArray,$num);
}

function rockthemes_pb_string_to_num($str){
	$numArray = array(1,2,3,4,5,6,7,8,9,10,11,12);
	$stringArray = array('one','two','three','four','five','six','seven','eight','nine','ten','eleven','twelve');
	
	return str_replace($stringArray,$numArray,$str);
}

function rockthemes_pb_element_to_string($element){
	$return = '';
	switch($element){
		case 'textfield':
		$return = 'Text Field';
		break;


		case 'textarea':
		$return = 'Text Area';
		break;


		case 'image':
		$return = 'Image';
		break;
		
		
		case 'ajaxfiltered':
		$return = 'Ajax Filtered Gallery';
		break;
		
		
		case 'featuredimage':
		$return = 'Featured Image';
		break;		
		
		case 'swiperslider':
		$return = "Swiper Slider";
		break;
		
		case "pricingtable":
		$return = "Pricing Table";
		break;
		
		case "curvyslider":
		$return = "Curvy Slider";
		break;
		
		case "sidebar":
		$return = "Sidebar";
		break;
		
		case "toggles":
		$return = "Toggles";
		break;
		
		case "tabs":
		$return = "Tabs";
		break;
		
		case "iconictext":
		$return = "Iconic Text";
		break;
		
		case "button":
		$return = "Button";
		break;
				
		case "skill":
		$return = "Skill";
		break;
		
		case "horizontalrule":
		$return = "HR";
		break;
		
		case "portfolio";
		$return = "Portfolio";
		break;
		
		case "rockformbuilder";
		$return = "Rock Form Builder";
		break;
		
		case "googlemap";
		$return = "Google Map";
		break;
		
		case "promotionbox";
		$return = "Promotion Box";
		break;
		
		case "alertbox";
		$return = "Alert Box";
		break;
		
		case "referencesbuilder";
		$return = "References Builder";
		break;
		
		case "testimonialsbuilder";
		$return = "Testimonials Builder";
		break;
		
		case "socialicons";
		$return = "Social Icons";
		break;
		
		case "teammembers";
		$return = "Team Members";
		break;
		
		case "beforeafterslider";
		$return = "Before After Slider";
		break;
		
		case "externalshortcode";
		$return = "External Code";
		break;
		
		case "regularblog";
		$return = "Regular Blog";
		break;
		
		case "gallery";
		$return = "Gallery";
		break;
	}
		
	return $return;
}



/*
**	FRONT END DETAILS
**
*/

function rockthemes_pb_frontend_enqueue(){
	wp_enqueue_style( 'animate-css', F_WAY.'/rock-builder/css/animate.css', '', '', 'all' );
}

add_action('wp_enqueue_scripts', 'rockthemes_pb_frontend_enqueue');



function rockthemes_pb_frontend_js(){
?>
	<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery.fn.rockthemes_animate_columns = function(obj, diff){
				if(!Modernizr.cssanimations) return;
				
				jQuery(window).scroll(function() {
					jQuery.fn.rockthemes_animate_columns_action(obj, diff);
				});
			}
			
			jQuery.fn.rockthemes_animate_columns_action = function(obj, diff){
					var current_obj = obj.div;
					
					var imagePos = current_obj.offset().top;
					
			
					var topOfWindow = jQuery(window).scrollTop() + jQuery(window).height() - diff;
										
					if (imagePos < topOfWindow && !obj.div.hasClass(obj.animation_class)) {
						setTimeout(function(){
							current_obj.addClass(obj.animation_class+" animated");
							if(current_obj.find(".ajax-body").length){
								jQuery.fn.rockthemes_animate_ajax_showcase(current_obj);
							}
							
							if(current_obj.find(".rock-skill").length){
								jQuery.fn.rockthemes_animate_skill(current_obj);
							}
							
							if(current_obj.find(".rockthemes-list").length){
								jQuery.fn.rockthemes_animate_list(current_obj, obj.animation_class);
							}
						}, obj.delay_time);
					}
			}
						
			jQuery.fn.rockthemes_animate_ajax_showcase = function(ajax_obj){
				var latest_i = 0;
				ajax_obj.find(".ajax-body ul > li").each(function(i){
					var that = jQuery(this);
					setTimeout(function(){
						that.addClass("animated fadeIn").css({"opacity":"1"});;
					}, 100 * i);
					//jQuery(this).delay(100*i).animate({"opacity":"1"},150);
					latest_i = i;
				});
				
				setTimeout(function(){
					ajax_obj.removeClass("rockthemes-animate");
				}, latest_i * 150);
			}
			
			jQuery.fn.rockthemes_animate_skill = function(ajax_obj){
				if(!Modernizr.cssanimations) return;
				ajax_obj.find(".rock-skill").each(function(i){
					for(var i = 0; i< jQuery.rockthemes_skills.length; i++){
						if(jQuery(this).attr("id") == jQuery.rockthemes_skills[i].id){
							var obj = jQuery.rockthemes_skills[i].obj;
							var value = jQuery.rockthemes_skills[i].value;
							
							setTimeout(function(){
								obj.refresh(value);
							}, ((i+1) * 600));
						}
					}
				});
			}
			
			jQuery.fn.rockthemes_animate_list = function(list_element, animation){
				list_element.find("li").css("opacity","0").addClass("animated");
				
				var latest_i = 0;
				list_element.find(" ul > li").each(function(i){
					var that = jQuery(this);
					setTimeout(function(){
						that.addClass(animation);
					}, 300 * i);
					latest_i = i;
				});
				
			}
			
			//Set Skill Default Value to 0
			jQuery(".rockthemes-animate .rock-skill").each(function(){
				if(!Modernizr.cssanimations) return;
				for(var i = 0; i< jQuery.rockthemes_skills.length; i++){
					if(jQuery(this).attr("id") == jQuery.rockthemes_skills[i].id){
						jQuery.rockthemes_skills[i].obj.refresh(0);
					}
				}
			});
			
			jQuery(".rockthemes-animate").each(function(){
				if(!Modernizr.cssanimations) return;
				var obj = new Object();
				obj.div = jQuery(this);
				obj.animation_class = jQuery(this).attr("animation-class");
				obj.delay_time = jQuery(this).attr("animation-delay-time");
								
				jQuery.fn.rockthemes_animate_columns(obj, 10);
			});
			
			if(!Modernizr.cssanimations){
				jQuery(".rockthemes-animate").removeClass("rockthemes-animate");	
			}
			

		});
		
		jQuery(window).load(function(){
			if(!Modernizr.cssanimations) return;
			
			setTimeout(function(){
			jQuery(".rockthemes-animate").each(function(){
				var obj = new Object();
				obj.div = jQuery(this);
				obj.animation_class = jQuery(this).attr("animation-class");
				obj.delay_time = jQuery(this).attr("animation-delay-time");
				
				jQuery.fn.rockthemes_animate_columns_action(obj, 0);
			});
			}, 150);
			
		});
	</script>    
<?php	
}

add_action('wp_footer', 'rockthemes_pb_frontend_js');


?>