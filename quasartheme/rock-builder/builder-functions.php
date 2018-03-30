<?php
/*
**	Rock Page Builder Functions
**
**	Alias	:	Rock Builder UI		Located in "rock-builder/rock-builder-ui.php"
**	Alias	:	Rock Builder		Located in "rock-builder/rock-builder.php"
**	Author	:	Rockthemes.net
**	License	:	Contact to rockthemes.net for further information
**	Version	:	1.0
**
**	This file contains all of the ajax based and regular functions of the Rock Page Builder
*/




/*
**	Rock Ajax Save Function
*/
if(!function_exists('rockAjax_save')):
function rockAjax_save() {
	if(!isset($_POST['serializedArray'])) return;
	if(!is_admin()) return;

	// get the submitted parameters
	$postID = (int) $_POST['postID'];
	
	if( !is_string( get_post_status( $postID ) )) return;
	
	$array = ($_POST['serializedArray']);
	$_builder_in_use = isset($_POST['_builder_in_use']) ? $_POST['_builder_in_use'] : 'false';
	$_featured_image_in_builder = $_POST['featuredInBuilder'];
	
		
   	update_post_meta($postID, '_this_r_content', ((addslashes($array))) );  
	update_post_meta($postID, '_builder_in_use', $_builder_in_use);
	update_post_meta($postID, '_featured_image_in_builder', $_featured_image_in_builder);
 
	// generate the response
	$response = json_encode( array( 'success' => true ) );

	// response output
	echo $response;

	exit;
}
add_action( 'wp_ajax_rockAjax-save', 'rockAjax_save' );
endif;

if(!function_exists('rockthemes_pb_featured_in_builder')):
function rockthemes_pb_featured_in_builder(){
	global $post;
	if($post && $post->ID){
		return get_post_meta($post->ID, '_featured_image_in_builder',true);
	}
	return 'false';
}
endif;



/*
**	Rockthemes Wordpress Import / Export Hook
**
**	Wordpress export successfully exports all of the data in the database without changes.
**
**	Wordpress import breaks some codes in Rock Page Builder. This function hooks into Wordpress Import Plugin
**	and remap the data as needed
*/
function rockthemes_pb_wp_import_hook( $post_id, $key, $value){

	//Only remap Rock Page Builder Content and Advanced Post Details
	if($key !== '_this_r_content' && $key !== 'advanced_post_details') return;
	
	//Get the imported datas old url
	$old_url = $GLOBALS['wp_import']->base_url;
	
	$old_url_encoded = str_replace('/', '\\/', $old_url);
	
	//Get current url
	$current_site_url = home_url();
	
	$current_site_url_encoded = str_replace('/', '\\/', $current_site_url);


	if($key === 'advanced_post_details'){
		$encoded_details = json_encode($value);
		
		//replace all of the old urls 	
		$encoded_details_replaced = str_replace($old_url, $current_site_url, ($encoded_details));
		//replace all of the old urls 	
		$encoded_details_replaced = str_replace($old_url_encoded, $current_site_url_encoded, ($encoded_details_replaced));
		
		$decoded_details_replaced = json_decode($encoded_details_replaced, true);
		
		update_post_meta($post_id, $key, $decoded_details_replaced);
	}
	
	if($key === '_this_r_content'){		
		//replace all of the old urls 	
		$replaced = str_replace($old_url, $current_site_url, ($value));
		
		if(is_array(json_decode($replaced, true))){
			//If exported server escapes slashes in the XML, readd slashes to the datas
			$replaced = addslashes($replaced);	
		}
		
		//Update the registered post meta with new url values
		update_post_meta($post_id, $key, ($replaced));
	}
}
add_action('import_post_meta','rockthemes_pb_wp_import_hook', 10, 3);


function rockthemes_pb_wp_import_end_hook(){
	//Some additional hooks to import end can be added here if needed
}
//add_action('import_end', 'rockthemes_pb_wp_import_end_hook', 10);




/*
**	Get Custom Post types
*/

function rock_builder_get_customposttypes($selected = null, $modal_ID = null, $header=null) {
	
	$post_types = get_post_types(array('_builtin'=>false));

	if(sizeof($post_types) <= 0) {echo "empty"; return;}
	
	$return = '<div class="custom_post_types_holder">';
	
	if(isset($_REQUEST['header'])) $return .= '<h4>'.$_REQUEST['header'].'</h4>';
	if(isset($header)) $return .= '<h4>'.$header.'</h4>';
	
	$modalID = isset($modal_ID) ? $modal_ID : $_REQUEST['modal_ID'];
		
	$return .= '<select class="custom_post_types" bind="'.esc_attr($modalID).'" autocomplete="off">';
	
	if($selected == "no-selected"){
		$return .= '<option value="no-selected" selected>Choose a Post Type</option>';
	}else{
		$return .= '<option value="no-selected">Choose a Post Type</option>';
	}
	
	if($selected == 'post'){
		$return .= '<option value="post" selected>post</option>';
	}else{
		$return .= '<option value="post">post</option>';
	}
	
	foreach($post_types as $type){
		//Remove the unlrelated post types.
		if($type == 'product_variation'
		   || $type == 'shop_order'
		   || $type == 'shop_coupon'
		   || $type == '' ){
			//Do Nothing	
		}else{
			//If post type is allowed in our list and not unrelated add them to select item
			if($selected == $type){
				$return .= '<option value="'.$type.'" selected>'.$type.'</option>';
			}else{
				$return .= '<option value="'.$type.'">'.$type.'</option>';
			}
		}
	}
	
	$return .= '</select>';
	
	$return .= '</div>';
	
	if(isset($selected)){
		return $return;
	}else{
		echo $return;
	}

	exit;
}

function rock_builder_get_customposttypes_ajax(){
	rock_builder_get_customposttypes();
	exit;
}
add_action( 'wp_ajax_rockAjax_get_customposttypes', 'rock_builder_get_customposttypes_ajax' );



/*
**	Get Taxonomies/Categories 
*/

function rock_builder_get_taxonomies($selected=null, $incoming_type = null, $header = null) {
		
	if(!isset($_REQUEST['post_type']) && !isset($incoming_type)) return;
	
	$post_type = isset($_REQUEST['post_type']) ? $_REQUEST['post_type'] : $incoming_type;
		
	$list = null;
	
	//If default wordpress post types in use (such as post, page) this variable will be setted to true
	$postTypeDefault = false;
	
	if($post_type == 'post'){
		$list = get_categories();
		$postTypeDefault = true;
	}else{
		$tax_list = get_object_taxonomies(sanitize_text_field($post_type));
		foreach($tax_list as $tax){

			if(strpos($tax,'cat') > -1){
				$list = get_terms($tax, array('hide_empty'=>0));
				break;
			}
		}
	}

				
	if(!$list || (is_array($list) && sizeof($list) <= 0)) {echo ""; return;}
		
	$return = '<div class="category_taxonomy_holder">';
	
	if(isset($_REQUEST['header'])) $return .= '<h4>'.esc_html($_REQUEST['header']).'</h4>';
	if(isset($header)) $return .= '<h4>'.esc_html($header).'</h4>';
		
	$return .= '<select multiple class="category_taxonomy" autocomplete="off">';
	
	$all_types = '';
	$total = sizeof($list);
	$i = 0;
	foreach($list as $allType){
		$all_types .= $allType->slug;
		
		if($i +1 < $total){
			$all_types .= ',';	
		}
		
		$i++;
	}

	if(isset($selected)){
		$totalEqual = 0;
		foreach($selected as $sel){
			foreach($list as $elem){
				if($elem->slug == $sel){
					$totalEqual++;
					break;
				}
			}
		}

		if($totalEqual === $total){
			$return .= '<option value="'.$all_types.'" selected>All</option>';
		}else{
			$return .= '<option value="'.$all_types.'">All</option>';
		}
	}else{
		$return .= '<option value="'.$all_types.'" selected>All</option>';
	}
	
	foreach($list as $type){
		if(isset($selected)){
			$exists = false;
			foreach($selected as $sel){
				if($sel == $type->slug){
					$exists = true;
				}
			}
			
			if($exists){
				if($postTypeDefault){
					$return .= '<option value="'.$type->slug.'" selected>'.$type->name.'</option>';
				}else{
					$return .= '<option value="'.$type->slug.'" selected>'.$type->name.'</option>';
				}
			}else{
				if($postTypeDefault){
					$return .= '<option value="'.$type->slug.'">'.$type->name.'</option>';
				}else{
					$return .= '<option value="'.$type->slug.'">'.$type->name.'</option>';
				}
			}
		}else{
			if($postTypeDefault){
				$return .= '<option value="'.$type->slug.'">'.$type->name.'</option>';
			}else{
				$return .= '<option value="'.$type->slug.'">'.$type->name.'</option>';
			}
		}
	}
	
	$return .= '</select>';
	
	$return .= '</div>';
	
	if(isset($selected)){
		return $return;
	}else{
		echo $return;
	}

	exit;
}
function rock_builder_get_taxonomies_ajax(){
	rock_builder_get_taxonomies();	
	exit;
}
add_action( 'wp_ajax_rockAjax_get_taxonomies', 'rock_builder_get_taxonomies_ajax' );



/*
**	Get All Image Types (thumbnail, medium, large etc..)
*/

function rock_builder_get_image_sizes($selected = null, $modal_ID = null, $header = null){
	global $_wp_additional_image_sizes;
	
	$sizes = array();
	foreach( get_intermediate_image_sizes() as $s ){
 		$sizes[ $s ] = array( 0, 0 );
 		if( in_array( $s, array( 'thumbnail', 'medium', 'large' ) ) ){
 			$sizes[ $s ][0] = get_option( $s . '_size_w' );
 			$sizes[ $s ][1] = get_option( $s . '_size_h' );
 		}else{
 			if( isset( $_wp_additional_image_sizes ) && isset( $_wp_additional_image_sizes[ $s ] ) )
 				$sizes[ $s ] = array( $_wp_additional_image_sizes[ $s ]['width'], $_wp_additional_image_sizes[ $s ]['height'], );
 		}
 	}
		
	if(sizeof($sizes) <= 0) {echo "empty"; return;}
	
	$return = '<div class="image_sizes_holder">';
	
	if(isset($_REQUEST['header'])) $return .= '<h4>'.esc_html($_REQUEST['header']).'</h4>';
	if(isset($header)) $return .= '<h4>'.esc_html($header).'</h4>';
	
	$modalID = isset($modal_ID) ? $modal_ID : $_REQUEST['modal_ID'];
		
	$return .= '<select class="image_sizes" bind="'.esc_attr($modalID).'" autocomplete="off">';
	
	if($selected == "no-selected"){
		$return .= '<option value="no-selected" selected>Choose an Image Size</option>';
	}else{
		$return .= '<option value="no-selected">Choose an Image Size</option>';
	}
	
	
	foreach($sizes as $size => $atts){
		//Remove the unlrelated image sizes.
		if($size == '' ){
			//Do Nothing	
		}else{
			//If post type is allowed in our list and not unrelated add them to select item
			if($selected == $size){
				$return .= '<option value="'.$size.'" sizes="' . implode( 'x', $atts ) .'" selected>'.$size. ' ' . implode( 'x', $atts ) .'</option>';
			}else{
				$return .= '<option value="'.$size.'" sizes="' . implode( 'x', $atts ) .'">'.$size. ' ' . implode( 'x', $atts ) .'</option>';
			}
		}
	}
	
	$return .= '</select>';
	
	$return .= '</div>';
	
	// response output
	if(isset($selected)){
		return $return;
	}else{
		echo $return;
	}

	exit;
}

function rock_builder_get_image_sizes_ajax(){
	rock_builder_get_image_sizes();	
	exit;
}
add_action( 'wp_ajax_rockAjax_get_image_sizes', 'rock_builder_get_image_sizes_ajax' );






/*
**	Get Image IDs according to image URLs
*/

function rock_builder_get_image_ids($imageURLs = null){
	
	$images = isset($_REQUEST['imageURLs']) ? ($_REQUEST['imageURLs']) : $imageURLs;
			
	if(sizeof($images) <= 0) {echo "empty"; return;}	
	
	$returnArray = array();
	
	foreach($images as $image){
		$returnArray[] = rockthemes_get_image_id_from_url($image);
	}
		
	echo json_encode($returnArray);
		
	exit;
}

function rock_builder_get_image_ids_ajax(){
	rock_builder_get_image_ids();	
	exit;
}
add_action( 'wp_ajax_rockAjax_get_image_ids', 'rock_builder_get_image_ids_ajax' );




/*
**	DEPRECATED
**	Get Fontawesome Icon List (Only required icons)
*/

function rock_builder_get_fontawesome_icons($selected=null, $echo_value=false){
	
	$icons = array(
		'No Icon',
		'fa fa-check',
		'fa fa-times',
		'icon-star',
	);

	
	$echo = isset($_REQUEST['echo_value']) ? true : $echo_value;
	
	$return = '<select class="fontawesome-icons-select" autocomplete="off">';
	
	foreach($icons as $icon){
		if($icon === $selected){
			$return .= '<option value="'.$icon.'" selected>'.$icon.'</option>';
		}else{
			$return .= '<option value="'.$icon.'">'.$icon.'</option>';
		}
	}
	
	$return .= '</select>';
	
	if($echo){
		echo ($return);
	}else{
		return $return;	
	}
		
	exit;
}

function rock_builder_get_fontawesome_icons_ajax(){
	rock_builder_get_fontawesome_icons();	
	exit;
}
add_action( 'wp_ajax_rockAjax_get_fontawesome_icons', 'rock_builder_get_fontawesome_icons_ajax' );




/*
**	Get All Registered Sidebars
*/

function rock_builder_get_sidebar_list($selected=null, $echo_value=false, $header = null){
	global $wp_registered_sidebars;
	
	$return = '';
	
	if(isset($_REQUEST['header'])) $return .= '<h4>'.esc_html($_REQUEST['header']).'</h4>';
	if(isset($header)) $return .= '<h4>'.esc_html($header).'</h4>';
	
	$emptyReturn = '<p>No sidebar found</p>';
	
	if(!$wp_registered_sidebars || !is_array($wp_registered_sidebars) || sizeof($wp_registered_sidebars) <= 0) return $emptyReturn;
	
	$echo = isset($_REQUEST['echo_value']) ? true : $echo_value;
	
	$return = '<select class="sidebar-list-select" autocomplete="off">';
	
	foreach($wp_registered_sidebars as $sidebar){
		if($sidebar['id'] === $selected){
			$return .= '<option value="'.$sidebar['id'].'" selected>'.$sidebar['name'].'</option>';
		}else{
			$return .= '<option value="'.$sidebar['id'].'">'.$sidebar['name'].'</option>';
		}
	}
	
	$return .= '</select>';
	
	if($echo){
		echo ($return);
	}else{
		return $return;	
	}
		
	exit;
}

function rock_builder_get_sidebar_list_ajax(){
	rock_builder_get_sidebar_list();	
	exit;
}
add_action( 'wp_ajax_rockAjax_get_sidebar_list', 'rock_builder_get_sidebar_list_ajax' );



/*
**	Get all post types for Linking
*/

function rock_builder_get_linkposts_cats($selected = null, $modal_ID = null, $header=null) {
	
	$post_types = get_post_types(array('_builtin'=>false));
		
	if(sizeof($post_types) <= 0) {echo "empty"; return;}
	
	$return = '<div class="link_select_holder">';
	
	if(isset($_REQUEST['header'])) $return .= '<h4>'.esc_html($_REQUEST['header']).'</h4>';
	if(isset($header)) $return .= '<h4>'.esc_html($header).'</h4>';
	
	$modalID = isset($modal_ID) ? $modal_ID : $_REQUEST['modal_ID'];
		
	$return .= '<select class="link_select" bind="'.esc_attr($modalID).'" autocomplete="off">';
	
	if($selected == "no-selected"){
		$return .= '<option value="no-selected" selected>No Link</option>';
	}else{
		$return .= '<option value="no-selected">No Link</option>';
	}
	
	if($selected == "custom-link"){
		$return .= '<option value="custom-link" selected>Custom Link</option>';
	}else{
		$return .= '<option value="custom-link">Custom Link</option>';
	}
	
	$return .= '<optgroup label="Single Entry">';
	
	if($selected == 'post'){
		$return .= '<option value="post" is_page="yes" selected>post</option>';
	}else{
		$return .= '<option value="post" is_page="yes">post</option>';
	}
	
	if($selected == 'page'){
		$return .= '<option value="page" is_page="yes" selected>page</option>';
	}else{
		$return .= '<option value="page" is_page="yes">page</option>';
	}
	
	foreach($post_types as $type){
		//Remove the unlrelated post types.
		if($type == 'product_variation'
		   || $type == 'shop_order'
		   || $type == 'shop_coupon'
		   || $type == '' ){
			//Do Nothing	
		}else{
			//If post type is allowed in our list and not unrelated add them to select item
			if($selected == $type){
				$return .= '<option value="'.$type.'" is_page="yes" selected>'.$type.'</option>';
			}else{
				$return .= '<option value="'.$type.'" is_page="yes">'.$type.'</option>';
			}
		}
	}
	
	$return .= '</optgroup>';
	
	$return .= '<optgroup label="Taxonomy / Category">';
	
	$list = get_taxonomies('','objects');
	
	foreach($list as $tax){
		$return .= '<option value="'.$tax->name.'" is_page="no" '.($tax->name === $selected ? 'selected' : '').'>'.$tax->label.'</option>';
	}
	
	$return .= '</optgroup>';
	
	$return .= '</select>';
	
	$return .= '</div>';
	
	if(isset($selected)){
		return $return;
	}else{
		echo $return;
	}

	exit;
}

function rock_builder_get_linkposts_cats_ajax(){
	rock_builder_get_linkposts_cats();
	exit;
}
add_action( 'wp_ajax_rockAjax_get_linkposts_cats', 'rock_builder_get_linkposts_cats_ajax' );

/*
	$obj 
	@category = incoming post type or taxonomy
	@selected = selected list item
	@is_page = if its a page then we will get the page list if not we will get the categories instead pages for archives
	@modal_ID = just for reference
*/

function rock_builder_get_linkposts_cats_posts($obj=null){
	if(empty($obj) && !isset($_REQUEST['data'])) return;
	if(isset($_REQUEST['data'])) $obj = $_REQUEST['data'];

	
	$category = sanitize_text_field($obj['category']);
	$is_page = sanitize_text_field($obj['is_page']);
	
	
	$selected = '';
	if(isset($obj['selected'])){
		
		$selected = $obj['selected'];	
		
		if($is_page === 'yes'){
			$selected = intval($selected);	
		}
	}
	
	if($category == 'page'){
		$posts = get_pages();
	}elseif($is_page == 'yes'){
		$posts = get_posts(array('post_type'=>$category, 'posts_per_page'=>-1));
	}elseif($is_page != 'yes'){
		if($category == 'category' || 
		   $category == 'post_tag' || 
		   $category == 'nav_menu' || 
		   $category == 'link_category' || 
		   $category == 'post_format'){
			$posts = get_categories(array('taxonomy'=>$category));
		}else{
			$posts = get_terms($category, array('hide_empty'=>0));
		}
	}

	$return = '';
	
	$return .= '<select class="link_select_page" autocomplete="off">';

	foreach($posts as $post){

		if($is_page === 'yes'){
			if($selected === $post->ID){
				$return .= '<option value="'.$post->ID.'" selected>'.$post->post_title.'</option>';
			}else{
				$return .= '<option value="'.$post->ID.'">'.$post->post_title.'</option>';
			}
		}else{
			if($selected === $post->slug){
				$return .= '<option value="'.$post->slug.'" selected>'.$post->name.'</option>';
			}else{
				$return .= '<option value="'.$post->slug.'">'.$post->name.'</option>';
			}
		}
	}
	
	$return .= '</select>';
	
	return $return;
}


function rock_builder_get_linkposts_cats_posts_ajax(){
	echo rock_builder_get_linkposts_cats_posts();
	exit;
}
add_action( 'wp_ajax_rockAjax_get_linkposts_cats_posts', 'rock_builder_get_linkposts_cats_posts_ajax' );




/*
**	Rockthemes Special Grid Block Shortcode
**	This shortcode function is not for editing. Thus it's not located in shortcodes.php
**	-	If the system will change this function will be moved to "shortcodes.php" file
**	RPB (Rock Page Builder) uses special grid block. New version contains a shortcode method
**	for special grid block. 
**
**	@since	:	1.3
*/
if(!function_exists('rockthemes_shortcode_make_specialgridblock')){
	function rockthemes_shortcode_make_specialgridblock($atts, $content=null){
		extract(shortcode_atts(array(
			'avoid_sidebar' => 'false',
			'grid_special_width_details' => '',
			'background_color' => '',
			'use_shadow' => '',
			'activate_padding' => '',
			'transparent_background' => '',
			'special_grid_html_id' => '',
			'parallax_model' => '',
			'parallax_mask_height' => '',
			'parallax_bg_image' => ''
		), $atts));
		
		$transparent_background = $transparent_background === 'true' ? true : false;
		$general_padding = rockthemes_fn_px_em_return_num(xr_get_option('content_padding','10px'));
		$padding_vertical_html = '';
		if(isset($activate_padding) && $activate_padding === 'true'){
			$padding_vertical_html = 'padding-top:'.(4 * $general_padding).'px; padding-bottom:'.(4 * $general_padding).'px;';
		}

		$return = '';
				
		$special_grid_html_id_code = '';
		
		if(!empty($special_grid_html_id)){
			$special_grid_html_id_code = 'id="'.$special_grid_html_id.'" ';
		}
		
		switch($grid_special_width_details){
			case 'use_parallax':
			$content = '<div '.$special_grid_html_id_code.' class="rockthemes-parallax" 
				parallax-model="height_specific" 
				parallax-bg-image="'.$parallax_bg_image.'" 
				parallax-mask-height="'.$parallax_mask_height.'">
			<div class="row">'.$content.'</div>';

			break;
			
			case 'use_background_img' :
			$content = '<div '.$special_grid_html_id_code.' class="rockthemes-parallax" 
				parallax-model="no_parallax_only_image" 
				parallax-bg-image="'.$parallax_bg_image.'" 
				parallax-mask-height="'.$parallax_mask_height.'">
			<div class="row">'.$content.'</div>';
			break;	
			
			case 'full_width_slider':
			$content = '<div><div><div>'.$content.'';
			break;
			
			case 'full_width_colored':
			$content = '<div '.$special_grid_html_id_code.' class="rockthemes-fullwidth-colored" style="'.(!$transparent_background ? 'background:'.$background_color.';' : '').' '.$padding_vertical_html.'">
							<div class="row">'.$content.'</div>';
			break;
		}
		
		
		switch($avoid_sidebar){
			
			case 'false':
			break;
			
			case 'before':
			$return = '</div>'.do_shortcode($content).'</div><div class="row">';
			break;
			
			case 'after':
			$return = '</div></div>'.do_shortcode($content).'</div><div><div class="row">';
			break;
			
		}
		return $return;
		
	}
}
add_shortcode('rockthemes_specialgridblock', 'rockthemes_shortcode_make_specialgridblock');






/*
**	Animation Classes based on animate.css
**
**	This function will generate a select (dropdown) element with all used animations.
**
**	@param	:	$selected:String	selected animation
**	@return	:	Returns a select element of animation classes
*/
function rock_builder_get_animation_classes($selected = ''){
	
	$return = '';
	
	$classes = array(
		array('name' => 'None', 'class' => ''),
		array('name' => 'To Left', 'class' => 'fadeInRight'),
		array('name' => 'To Right', 'class' => 'fadeInLeft'),
		array('name' => 'To Top', 'class' => 'fadeInUp'),
		array('name' => 'To Bottom', 'class' => 'fadeInDown'),
		array('name' => 'Alpha', 'class' => 'fadeIn'),
	);
	
	$return = '<select class="animation_type">';
	
	foreach($classes as $class){
		$return .= '<option value="'.$class['class'].'" '.($class['class'] === $selected ? 'selected' : '').'>'.$class['name'].'</option>';
	}
	
	$return .= '</select>';
	
	return $return;
		
}




/*
**	Parallax Models
**
**	This function will generate a select (dropdown) element with all parallax models.
**
**	@param	:	$selected:String	selected parallax model
**	@return	:	Returns a select element of parallax models
*/
function rock_builder_get_parallax_models($selected = ''){
	
	$return = '';
	
	$classes = array(
		array('name' => 'None', 'class' => ''),
		array('name' => 'Simple Parallax (Height Specific)', 'class' => 'height_specific'),
		array('name' => 'To Right', 'class' => 'fadeInLeft'),
		array('name' => 'To Top', 'class' => 'fadeInUp'),
		array('name' => 'To Bottom', 'class' => 'fadeInDown'),
		array('name' => 'Alpha', 'class' => 'fadeIn'),
	);
	
	$return = '<select class="parallax_models">';
	
	foreach($classes as $class){
		$return .= '<option value="'.$class['class'].'" '.($class['class'] === $selected ? 'selected' : '').'>'.$class['name'].'</option>';
	}
	
	$return .= '</select>';
	
	return $return;
		
}







/*
**	Columns Grid Large
*/

function rock_builder_get_columns_grid_large_list($selected=''){
	$return = '';
	
	$return .= '<select class="columns_grid_large autocomplete="off"">';
	
	for($i = 1; $i<13; $i++){
		$return .= '<option value="'.$i.'" '.(intval($selected) == $i ? 'selected' : '').'>'.$i.' Columns</option>';
	}
	
	$return .= '</select>';
	
	return $return;

};

function rock_builder_get_columns_grid_large_list_ajax(){
	echo rock_builder_get_columns_grid_large_list();
	exit;
}
add_action('wp_ajax_get_columns_grid_large_list','rock_builder_get_columns_grid_large_list_ajax');


/*
**	Columns Grid Medium
*/

function rock_builder_get_columns_grid_medium_list($selected=''){
	$return = '';
	
	$return .= '<select class="columns_grid_medium autocomplete="off"">';
	
	for($i = 1; $i<13; $i++){
		$return .= '<option value="'.$i.'" '.(intval($selected) == $i ? 'selected' : '').'>'.$i.' Columns</option>';
	}
	
	$return .= '</select>';
	
	return $return;

};

function rock_builder_get_columns_grid_medium_list_ajax(){
	echo rock_builder_get_columns_grid_medium_list();
	exit;
}
add_action('wp_ajax_get_columns_grid_medium_list','rock_builder_get_columns_grid_medium_list_ajax');



/*
**	Columns Grid Small
*/

function rock_builder_get_columns_grid_small_list($selected=''){
	$return = '';
	
	$return .= '<select class="columns_grid_small autocomplete="off"">';
	
	for($i = 1; $i<13; $i++){
		$return .= '<option value="'.$i.'" '.(intval($selected) == $i ? 'selected' : '').'>'.$i.' Columns</option>';
	}
	
	$return .= '</select>';
	
	return $return;

};

function rock_builder_get_columns_grid_small_list_ajax(){
	echo rock_builder_get_columns_grid_small_list();
	exit;
}
add_action('wp_ajax_get_columns_grid_small_list','rock_builder_get_columns_grid_small_list_ajax');



/*
**	Columns Grids List 
**	Contains : Large, Medium and Small Columns
**
**	Returns builder element with list.
*/

function rock_builder_get_columns_grid_list($selectedLarge='',$selectedMedium='',$selectedSmall=''){
	//Set default values if no value entered
	$selectedLarge = $selectedLarge !== '' ? intval($selectedLarge) : 4;
	$selectedMedium = $selectedMedium !== '' ? intval($selectedMedium) : 2;
	$selectedSmall = $selectedSmall !== '' ? intval($selectedSmall) : 1;
	
	$return = '';
	
	//Large Block Grid
	$return .= '						
		<div class="row-fluid">
			<div class="span6">
				'.rock_builder_get_columns_grid_large_list($selectedLarge).'
			</div>
			<div class="span6">
				<strong>Columns Large (Only bigger than 768px) - Desktop Screen</strong></br>
				<p>You can choose 1 - 12 columns for each row. If you choose 3 columns, system will show 4 in a row. ( 12 / 3 = 4) </p>
			</div>
		</div>
		<hr/>
	';
	
	//Medium Block Grid
	$return .= '						
		<div class="row-fluid">
			<div class="span6">
				'.rock_builder_get_columns_grid_medium_list($selectedMedium).'
			</div>
			<div class="span6">
				<strong>Columns Medium (Only smaller than 768px and bigger than 480px) - Tablet Screen</strong></br>
				<p>You can choose 1 - 12 columns for each row. If you choose 3 columns, system will show 4 in a row. ( 12 / 3 = 4) </p>
			</div>
		</div>
		<hr/>
	';
	
	//Small Block Grid
	$return .= '						
		<div class="row-fluid">
			<div class="span6">
				'.rock_builder_get_columns_grid_small_list($selectedSmall).'
			</div>
			<div class="span6">
				<strong>Columns Small (Only smaller than 480px) - Mobile Screen</strong></br>
				<p>You can choose 1 - 12 columns for each row. If you choose 3 columns, system will show 4 in a row. ( 12 / 3 = 4) </p>
			</div>
		</div>
		<hr/>
	';
		
	return $return;

};

function rock_builder_get_columns_grid_list_ajax(){
	echo rock_builder_get_columns_grid_list();
	exit;
}
add_action('wp_ajax_get_columns_grid_list','rock_builder_get_columns_grid_list_ajax');








/*
**	Block Grid Large
*/

function rock_builder_get_block_grid_large_list($selected=''){
	$return = '';
	
	$return .= '<select class="block_grid_large autocomplete="off"">';
	
	for($i = 1; $i<13; $i++){
		$return .= '<option value="'.$i.'" '.(intval($selected) == $i ? 'selected' : '').'>'.$i.' Block</option>';
	}
	
	$return .= '</select>';
	
	return $return;

};

function rock_builder_get_block_grid_large_list_ajax(){
	echo rock_builder_get_block_grid_large_list();
	exit;
}
add_action('wp_ajax_get_block_grid_large_list','rock_builder_get_block_grid_large_list_ajax');


/*
**	Block Grid Medium
*/

function rock_builder_get_block_grid_medium_list($selected=''){
	$return = '';
	
	$return .= '<select class="block_grid_medium autocomplete="off"">';
	
	for($i = 1; $i<13; $i++){
		$return .= '<option value="'.$i.'" '.(intval($selected) == $i ? 'selected' : '').'>'.$i.' Block</option>';
	}
	
	$return .= '</select>';
	
	return $return;

};

function rock_builder_get_block_grid_medium_list_ajax(){
	echo rock_builder_get_block_grid_medium_list();
	exit;
}
add_action('wp_ajax_get_block_grid_medium_list','rock_builder_get_block_grid_medium_list_ajax');



/*
**	Block Grid Small
*/

function rock_builder_get_block_grid_small_list($selected=''){
	$return = '';
	
	$return .= '<select class="block_grid_small autocomplete="off"">';
	
	for($i = 1; $i<13; $i++){
		$return .= '<option value="'.$i.'" '.(intval($selected) == $i ? 'selected' : '').'>'.$i.' Block</option>';
	}
	
	$return .= '</select>';
	
	return $return;

};

function rock_builder_get_block_grid_small_list_ajax(){
	echo rock_builder_get_block_grid_small_list();
	exit;
}
add_action('wp_ajax_get_block_grid_small_list','rock_builder_get_block_grid_small_list_ajax');



/*
**	Block Grids List 
**	Contains : Large, Medium and Small Block Grids
**
**	Returns builder element with list.
*/

function rock_builder_get_block_grid_list($selectedLarge='',$selectedMedium='',$selectedSmall=''){
	//Set default values if no value entered
	$selectedLarge = $selectedLarge !== '' ? intval($selectedLarge) : 6;
	$selectedMedium = $selectedMedium !== '' ? intval($selectedMedium) : 4;
	$selectedSmall = $selectedSmall !== '' ? intval($selectedSmall) : 2;
	
	$return = '';
	
	//Large Block Grid
	$return .= '						
		<div class="row-fluid">
			<div class="span6">
				'.rock_builder_get_block_grid_large_list($selectedLarge).'
			</div>
			<div class="span6">
				<strong>Blocks Large (Only bigger than 768px) - Desktop Screen</strong></br>
				<p>You can choose 1 - 12 block for each row. If you set to 6 system will show 6 images per row.</p>
			</div>
		</div>
		<hr/>
	';
	
	//Medium Block Grid
	$return .= '						
		<div class="row-fluid">
			<div class="span6">
				'.rock_builder_get_block_grid_medium_list($selectedMedium).'
			</div>
			<div class="span6">
				<strong>Blocks Medium (Only smaller than 768px and bigger than 480px) - Tablet Screen</strong></br>
				<p>You can choose 1 - 12 block for each row. If you set to 6 system will show 6 images per row.</p>
			</div>
		</div>
		<hr/>
	';
	
	//Small Block Grid
	$return .= '						
		<div class="row-fluid">
			<div class="span6">
				'.rock_builder_get_block_grid_small_list($selectedSmall).'
			</div>
			<div class="span6">
				<strong>Blocks Small (Only smaller than 480px) - Mobile Screen</strong></br>
				<p>You can choose 1 - 12 block for each row. If you set to 6 system will show 6 images per row.</p>
			</div>
		</div>
		<hr/>
	';
		
	return $return;

};

function rock_builder_get_block_grid_list_ajax(){
	echo rock_builder_get_block_grid_list();
	exit;
}
add_action('wp_ajax_get_block_grid_list','rock_builder_get_block_grid_list_ajax');




/*
**	Get Chosen Small and Medium Block Grid
*/

function rock_builder_get_chosen_small_block_grid(){
	if(function_exists('xr_get_option')) {return xr_get_option('small_block_grid','2');}
	return '';
}
function rock_builder_get_chosen_medium_block_grid(){
	if(function_exists('xr_get_option')) {return xr_get_option('medium_block_grid','3');}
	return '';
}


/*
**	Get Chosen Block Grid Class (Contains small and medium block grids
**	return	: string with class names
*/
if(!function_exists('rock_builder_get_small_medium_block_grid_class')):
function rock_builder_get_small_medium_block_grid_class(){
	return 	'small-block-grid-'.rock_builder_get_chosen_small_block_grid().
			' medium-block-grid-'.rock_builder_get_chosen_medium_block_grid().' ';
}
endif;


if(!function_exists('rockthemes_woocommerce_active')):
/*
**	Rockthemes WooCommerce Integration
**	@return : true if WooCommerce installed and activated, false if not activated
*/
function rockthemes_woocommerce_active(){
	if(is_multisite()){
		if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_site_option( 'active_sitewide_plugins' ) ) ) ) {
			return true;
		}
	}
	
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		return true;
	}
	return false;
}
endif;


/*
**	Rockthemes Portfolio Excerpt / Title Option
**	@return : A select (dropdown) HTML element with options
*/
function rockthemes_excerpt_title_option($selected=''){
	$return = '';
	
	$return .= '
		<select class="excerpt_title_option">
			<option value="no_description" '.($selected == 'no_description' ? 'selected' : '').'>No Description</option>
			<option value="title" '.($selected == 'title' ? 'selected' : '').'>Only Title</option>
			<option value="excerpt" '.($selected == 'excerpt' ? 'selected' : '').'>Only Excerpt</option>
			<option value="title_excerpt" '.($selected == 'title_excerpt' ? 'selected' : '').'>Title and Excerpt</option>
	';
	
	//Check if WooCommerce is activated
	//WooCommerce currently disabled for better visualization
	if(rockthemes_woocommerce_active() && 1==0){
		$return .= '
			<option value="price" '.($selected == 'price' ? 'selected' : '').'>Only Price</option>
			<option value="title_price" '.($selected == 'title_price' ? 'selected' : '').'>Title and Price</option>
			<option value="excerpt_price" '.($selected == 'excerpt_price' ? 'selected' : '').'>Excerpt and Price</option>
			<option value="title_excerpt_price" '.($selected == 'title_excerpt_price' ? 'selected' : '').'>Title, Excerpt and Price</option>
		';	
	}
	
	$return .= '</select>';
	
	return $return;
}



if(!function_exists('rockthemes_excerpt')):
/*
**	Rockthemes Custom Excerpt Length
**
**	@param $excerpt		:	Originial Excerpt text.
**	@param $length		:	Custom word length for the excerpt. (Not character length, word length uses spaces)
**	@return : excerpt string sliced with spaces
**
**	@since				:	1.0
*/
function rockthemes_excerpt($excerpt='',$length=10){
	$excerpt = explode(' ',$excerpt, ($length + 1));
	
	if (count($excerpt)>=$length) {
		array_pop($excerpt);
		$excerpt = implode(" ",$excerpt);
	} else {
		$excerpt = implode(" ",$excerpt);
	} 
	
	$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
	return $excerpt;
}
endif;



if(!function_exists('rockthemes_get_image_id_from_url')):
/*
**	Some of our special elements allow you to choose different image size. This function will
**	retrive the "image id" according to the image url. This function is also 
**	located in the "functions.php" file in the theme.
**
**	@param	:	$image_url:String	URL of the image to get id from
**	@return	:	$attachment[0]:String	ID of the image
*/
function rockthemes_get_image_id_from_url($image_url) {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM " . $prefix . "posts" . " WHERE guid='%s';", $image_url )); 
	if(!empty($attachment) && $attachment[0]){
        return $attachment[0]; 
	}else{
		$new_image_url = '';
		
		if(strpos($image_url, 'https') > -1){
			$new_image_url = str_replace('https', 'http', $image_url);
		}elseif(strpos($image_url, 'http') > -1){
			$new_image_url = str_replace('http', 'https', $image_url);
		}

		$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM " . $prefix . "posts" . " WHERE guid='%s';", $new_image_url)); 

		if(!empty($attachment) && $attachment[0]){
        		return $attachment[0]; 
		}	

	}
	return '';
}
endif;




if(!function_exists('rock_check_p')):
/*
**	To use TinyMCE in full power, we check if the string wrapped with "<p>" tags correctly. This function is also 
**	located in the "functions.php" file in the theme.
**
**	@param	:	$string:String	String to check if wrapped correctly
**	@return	:	$string:String	String wrapped with "<p>" tags
*/
function rock_check_p($string){
	return wpautop($string);
	
	if(substr($string,0,2) != '<p') return '<p>'.$string.'</p>';
	return $string;
}
endif;







/*
**	Rockthemes Alter Comments Template
**
**
*/

function rockthemes_comment($comment, $args, $depth) {
		$GLOBALS['rockthemes_comment'] = $comment;
		extract($args, EXTR_SKIP);

		if ( 'div' == $args['style'] ) {
			$tag = 'div';
			$add_below = 'comment';
		} else {
			$tag = 'li';
			$add_below = 'div-comment';
		}
?>
		<<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
		<?php if ( 'div' != $args['style'] ) : ?>
		<div id="div-comment-<?php comment_ID() ?>" class="comment-body row">
		<?php endif; ?>
            <div class="comment-author-image large-2 medium-2 small-2 columns">
                <div class="comment-author vcard">
                    <?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['avatar_size'] ); ?>
                </div>
            </div>
            
			<?php if ($comment->comment_approved == '0') : ?>
                <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.','quasar') ?></em>
                <br />
            <?php endif; ?>

            <div class="comment-meta commentmetadata large-10 medium-10 small-10 columns"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
				<div class="comment-header row">
                    <div class="comment-author-date-container large-9 medium-9 small-9 columns">
                        <div class="comment-author">
                            <?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?>
                        </div>
                        <div class="comment-date">
                        <?php
                            /* translators: 1: date, 2: time */
                            printf( __('%1$s at %2$s','quasar'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)','quasar'),'  ','' );
                        ?>
                        </div>
                    </div>
                    
                    <div class="comment-reply-container large-3 medium-4 small-3 columns">
                        <div class="reply">
                        <?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                        </div>
                    </div>
                </div>
                <div class="comment-text">
                <?php comment_text() ?>
                </div>
                
            </div>
		<?php if ( 'div' != $args['style'] ) : ?>
		</div>
		<?php endif; ?>
        <hr />
<?php
}




function rockthemes_fb_get_references_list($selected=null, $modal_ID = null, $echo = true){
	
	$form_builder_references = get_option('rockthemes_fb_references', array());
	
	
	$return = '';
	
	if(!empty($form_builder_references)){
	
	$return .= '<select class="rockthemes_fb_list">';
	
	foreach($form_builder_references as $ref){
		if($selected == $ref['shortcode']){
			$return .= '<option value="'.htmlentities($ref['shortcode']).'" selected>'.$ref['name'].'</option>';
		}else{
			$return .= '<option value="'.htmlentities($ref['shortcode']).'">'.$ref['name'].'</option>';
		}
	}
	
	$return .= '</select>';
	
	}else{
		
		$return .= 'No Rock Form Found!';
			
	}
	
	if($echo){
		echo $return;
	}else{
		return $return;
	}
	
	exit;
}



/*
**	Wordpress 3.9 resize handle fix
**
**	Wordpress 3.9 changed the resize to "false" as default. We set it to "vertical"
**	This way the "Visual" editor will contain resize handle to resize the Text Editor
**
**	@since	:	1.3
*/
function rockthemes_pb_tinymce_before_init($settings){
	$settings['resize'] = 'vertical';
	return $settings;
}

add_filter('tiny_mce_before_init','rockthemes_pb_tinymce_before_init');




?>