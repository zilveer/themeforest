<?php

/*
**	Globals Functions
**
**	Most of the Rock Themes plugins and built in systems are requiring these functions.
**	For standalone plugins and widgets of Rock Themes, these functions will be prevented from the widget/plugin/feature inside
*/


/*
**	Global wp_ajax function to be called from Javascript/jQuery
*/
if(isset($_POST['action'])){
	
	if(function_exists('wp_ajax_' . $_POST['action'])){
		do_action( 'wp_ajax_' . $_POST['action'] );
	}
	
}

/*
**	Sidebar Alignment
**	Rock Custom Sidebar system allows 5 different alignment for the sidebar
**	
**	This function generates a list object with 5 different alignment for sidebars
**
*/
if(!function_exists('rockthemes_cs_make_sidebar_alignment_list')){
	function rockthemes_cs_make_sidebar_alignment_list(){
		$return = '
			<h4>Choose your sidebar alignment</h4>
			<select class="sidebar-alignment-list">
				<option value="leftleft">Left Left</option>
				<option value="left">Left</option>
				<option value="right">Right</option>
				<option value="rightright">Right Right</option>
			</select>
		';	
		
		return $return;
	}
}


/*
**	Rock Builder Uses 12 Columns Grid system
**	This function generates a list object for 12 column
**	@param $selected = selected column value
*/
if(!function_exists('rockthemes_pb_make_columns_list')){
	function rockthemes_pb_make_columns_list($selected = null){
		
		
		$return = '<div class="columns_select_holder">
						<h4>Select Columns</h4>
						<select class="columns_select">';
		
		if($selected === 1){
			$return .= '<option value="1" selected>One Column</option>';
		}else{
			$return .= '<option value="1">One Column</option>';
		}
		
		if($selected === 2){
			$return .= '<option value="2" selected>Two Column</option>';
		}else{
			$return .= '<option value="2">Two Column</option>';
		}
		
		if($selected === 3){
			$return .= '<option value="3" selected>Three Column</option>';
		}else{
			$return .= '<option value="3">Three Column</option>';
		}
		
		if($selected === 4){
			$return .= '<option value="4" selected>Four Column</option>';
		}else{
			$return .= '<option value="4">Four Column</option>';
		}
		
		if($selected === 5){
			$return .= '<option value="5" selected>Five Column</option>';
		}else{
			$return .= '<option value="5">Five Column</option>';
		}
		
		if($selected === 6){
			$return .= '<option value="6" selected>Six Column</option>';
		}else{
			$return .= '<option value="6">Six Column</option>';
		}
		
		if($selected === 7){
			$return .= '<option value="7" selected>Seven Column</option>';
		}else{
			$return .= '<option value="7">Seven Column</option>';
		}
	
		if($selected === 8){
			$return .= '<option value="8" selected>Eight Column</option>';
		}else{
			$return .= '<option value="8">Eight Column</option>';
		}
	
		if($selected === 9){
			$return .= '<option value="9" selected>Nine Column</option>';
		}else{
			$return .= '<option value="9">Nine Column</option>';
		}
	
		if($selected === 10){
			$return .= '<option value="10" selected>Ten Column</option>';
		}else{
			$return .= '<option value="10">Ten Column</option>';
		}
	
		if($selected === 11){
			$return .= '<option value="11" selected>Eleven Column</option>';
		}else{
			$return .= '<option value="11">Eleven Column</option>';
		}
	
		if($selected === 12){
			$return .= '<option value="12" selected>Twelve Column</option>';
		}else{
			$return .= '<option value="12">Twelve Column</option>';
		}
	
		$return .= '</select></div>';
		
		return $return;
	}
}



/*
**	Browser Details
**
**	@param	:	None, This function does not require any params
**	
**	@return	:	$return:Object,	Object with browser details. Useful for detecting browser specific
**								options and lack of details of some browsers. More details about 
**								return object can be found in the function
**
*/
if(!function_exists('rockthemes_get_browser_details')):
function rockthemes_get_browser_details() {

	if ( empty( $_SERVER['HTTP_USER_AGENT'] ) )

		return false;



	$key = md5( $_SERVER['HTTP_USER_AGENT'] );



	if ( false === ($response = get_site_transient('browser_' . $key) ) ) {

		global $wp_version;



		$options = array(

			'body'			=> array( 'useragent' => $_SERVER['HTTP_USER_AGENT'] ),

			'user-agent'	=> 'WordPress/' . $wp_version . '; ' . home_url() 

		);



		$response = wp_remote_post( 'http://api.wordpress.org/core/browse-happy/1.0/', $options );



		if ( is_wp_error( $response ) || 200 != wp_remote_retrieve_response_code( $response ) )

			return false;



		/**

		 * Response should be an array with:

		 *  'name' - string - A user friendly browser name

		 *  'version' - string - The most recent version of the browser

		 *  'current_version' - string - The version of the browser the user is using

		 *  'upgrade' - boolean - Whether the browser needs an upgrade

		 *  'insecure' - boolean - Whether the browser is deemed insecure

		 *  'upgrade_url' - string - The url to visit to upgrade

		 *  'img_src' - string - An image representing the browser

		 *  'img_src_ssl' - string - An image (over SSL) representing the browser

		 */

		$response = unserialize( wp_remote_retrieve_body( $response ) );



		if ( ! $response )

			return false;



		set_site_transient( 'browser_' . $key, $response, 604800 ); // cache for 1 week

	}



	return $response;

}
endif;


/*
**	Global Browser variable
**
**	This variable contains browser details. For more information about browser details
**	check the "rockthemes_get_browser_details" function
*/
$rockthemes_browser = rockthemes_get_browser_details();


/*
**	Check if the browser is lower than IE9. This functions detects the browser and if it's IE8 and lower returns true.
**	This function is more like a shortcut to for feature detection
**
**	@param	:	This function does not require any params
**	@return	:	Boolean,	True if browser IE8 and lower false if IE9 or other browsers
**
*/
function rockthemes_ie_lower_nine(){
	global $rockthemes_browser;
	if($rockthemes_browser && strpos($rockthemes_browser['name'],'xplorer') > -1 && intval($rockthemes_browser['version']) < 9) return true;
	return false;
}






/*
**	We use some special hooks for plugins for performance improvement. This function makes plugins
**	widgets and extra features to recognize we are using a rockthemes theme. 
**
**	!Attention	:	Do not remove or change these functions
*/
function rockthemes_switched_to_rockthemes(){
	update_option('rockthemes_theme_active',true);
}
add_action('after_switch_theme', 'rockthemes_switched_to_rockthemes');
function rockthemes_switched_to_other_themes(){
	update_option('rockthemes_theme_active',false);
}
add_action('switch_theme', 'rockthemes_switched_to_other_themes');




?>