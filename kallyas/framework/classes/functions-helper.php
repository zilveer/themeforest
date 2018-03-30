<?php if(! defined('ABSPATH')){ return; }

/*
*	Sanitize theme options
*	Will convert the string to a database sage option string
*/

/*--------------------------------------------------------------------------------------------------
	Get option - This function will return the option
	@option : if specified, returns the option value , if not, returns the full list of category options
	@category : returns the saved options category
--------------------------------------------------------------------------------------------------*/
	global $saved_options;
	$saved_options = '';

	function zget_option( $option,$category = false , $all = false , $default = false ) {

		global $saved_options;

		if ( !ZN()->theme_data ) {
			return false;
		}

		if ( empty( $saved_options ) ) {
			$saved_options = get_option( ZN()->theme_data['options_prefix'] );
		}

		if ( $all ){
			return $saved_options;
		}

		if ( !empty($saved_options[$category][$option]) || ( isset($saved_options[$category][$option]) && $saved_options[$category][$option] === '0' ) ) {
			$return = $saved_options[$category][$option];
		}
		elseif( isset( $default ) ){
			$return = $default;
		}
		else {
			$return = false;
		}

		return $return;
	}

	function zn_uid( $prepend = 'eluid', $length = 8 ){
		return $prepend . substr(str_shuffle(MD5(microtime())), 0, $length);
	}

function zn_get_col_size( $col )
{
	$cols = array
		(
			'1' => 'col-sm-12',
			'2' => 'col-sm-6',
			'3' => 'col-sm-4',
			'4' => 'col-sm-3',
			'5' => 'col-sm-4 col-sm-1-5',
		);

	return $cols[$col];
}

/*--------------------------------------------------------------------------------------------------
	Move to top - Moves an array key to the top position
	@array : The array that we need to change
	@key : The key that we need to move to first position
	return : the array with the keys changed
--------------------------------------------------------------------------------------------------*/
function zn_move_to_top(&$array, $key) {
	$temp = array($key => $array[$key]);
	unset($array[$key]);
	$array = $temp + $array;
}

/*--------------------------------------------------------------------------------------------------
	Move to end - Moves an array key to the top position
	@array : The array that we need to change
	@key : The key that we need to move to first position
	return : the array with the keys changed
--------------------------------------------------------------------------------------------------*/
function zn_move_to_end(&$array, $key) {
	$temp = array($key => $array[$key]);
	unset($array[$key]);
	$array =  $array + $temp;
}

add_action('zn_save_theme_options', 'zn_refresh_mailchimp_lists');
function zn_refresh_mailchimp_lists(){
	delete_option( 'zn_mailchimp_lists' );
}

/* RETURNS A LIST OF MAILCHIMP CREATED LISTS */
	function generate_mailchimp_lists( $option_id = 'mailchimp_api' , $option_page = 'advanced' ,$refresh = false ){

	//	delete_option('zn_mailchimp_lists');

		$loaded_lists = get_option( 'zn_mailchimp_lists' );

		if( $loaded_lists && $refresh == false ) {
			return $loaded_lists;
		}
		elseif( $mailchimp_api = zget_option( $option_id , $option_page ) ) {

			require_once ( THEME_BASE .'/framework/classes/class-mailchimp.php' );

			$mailchimp = new ZnMailChimp($mailchimp_api);

			$lists = $mailchimp->call( 'lists/list' );

			$loaded_lists = array();

			if ( isset( $lists['data'] ) && is_array( $lists['data'] ) ) {
				foreach ( $lists['data'] as $key => $list ) {
					$loaded_lists[$list['id']] = $list['name'];
				}
			}

			add_option( 'zn_mailchimp_lists', $loaded_lists, '', false );
			return $loaded_lists;
		}
		else{
			return array();
		}

	}

/* CONVERTS A YOUTUBE LINK INTO AN EMBED */
	// function get_video_from_link( $string, $css = null , $width = '425px' , $height = '239px' ) {

	// 	// Save old string in case no video is provided
	// 	$old_string = $string;
	// 	$video_url = parse_url($string);

	// 	if ( $video_url['host'] == 'www.youtube.com' || $video_url['host'] == 'youtube.com' ) {

	// 		preg_match('#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#', $string, $matches);
	// 		$string = '<iframe class="'.$css.'" width="'.$width.'" height="'.$height.'" src="//www.youtube.com/embed/'.$matches[0].'?iv_load_policy=3&enablejsapi=0&amp;wmode=transparent&amp;modestbranding=1&amp;rel=0&amp;showinfo=0&amp;feature=player_embedded" frameborder="0" allowfullscreen></iframe>';

	// 	}
	// 	elseif( $video_url['host'] == 'www.dailymotion.com' ){
	// 		$id = strtok(basename($old_string), '_');
	// 		$string = '<iframe frameborder="0" width="'.$width.'" height="'.$height.'" src="//www.dailymotion.com/embed/video/'.$id.'"></iframe>';
	// 	}
	// 	else {
	// 		$string = preg_replace('#http://(www\.)?vimeo\.com/([^ ?\n/]+)((\?|/).*?(\n|\s))?#i', '<iframe class="youtube-player '.$css.'" type="text/html" src="//player.vimeo.com/video/$2" width="'.$width.'" height="'.$height.'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>', $string);
	// 	}

	// 	// If no video link was provided return the full link
	// 	if ( $string != $old_string ) {
	// 		return $string;
	// 	}
	// 	else {

	// 		return;
	// 	}
	// }

	function get_video_id_from_link( $string ){
		// Save old string in case no video is provided
		$old_string = $string;
		$video_url = parse_url($string);

		if ( $video_url['host'] == 'www.youtube.com' || $video_url['host'] == 'youtube.com' ) {

			preg_match('#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#', $string, $matches);
			$string = $matches[0];

		}

		// If no video link was provided return the full link
		if ( $string != $old_string ) {
			return $string;
		}
		else {
			return;
		}

	}

	function zn_hex_to_rgb($hex){
		$hex = str_replace('#', '', $hex);
		if ( strlen($hex) == 3 ) {
			$hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
		}
		else{
			$hex = substr($hex,0,2).substr($hex,2,2).substr($hex,4,2);

		}

		return $hex;
	}

	function zn_hex2rgb($hex) {
	   $hex = str_replace('#', '', $hex);

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
	   //return implode(",", $rgb); // returns the rgb values separated by commas
	   return $rgb; // returns an array with the rgb values
	}

	function zn_hex2rgb_str($hex){
		$hex = zn_hex2rgb($hex);
		return 'rgb('.$hex[0].','.$hex[1].','.$hex[2].')';
	}

	function zn_hex2rgba($hex, $percent = 100) {
		$rgb = zn_hex2rgb($hex);
		$argb = array($rgb[0], $rgb[1], $rgb[2], $percent/100);
		return $argb;
	}

	function zn_hex2rgba_str($hex, $percent = 100){
		$argb = zn_hex2rgba($hex, $percent);
		return 'rgba('.$argb[0].','.$argb[1].','.$argb[2].','.$argb[3].')';
	}

	function adjustBrightness($hex, $percentage_adjuster) {
		// fallback if rgba color
		if(strpos($hex, 'rgba') === true){
			return $hex;
		}

		// Steps should be between . Negative = darker, positive = lighter
		$percentage_adjuster = round( $percentage_adjuster/100,2 );

		// Format the hex color string
		  $hex = str_replace('#','',$hex);
		$r = (strlen($hex) == 3)? hexdec(substr($hex,0,1).substr($hex,0,1)):hexdec(substr($hex,0,2));
		$g = (strlen($hex) == 3)? hexdec(substr($hex,1,1).substr($hex,1,1)):hexdec(substr($hex,2,2));
		$b = (strlen($hex) == 3)? hexdec(substr($hex,2,1).substr($hex,2,1)):hexdec(substr($hex,4,2));
		$r = round($r - (max(1,$r)*$percentage_adjuster));
		$g = round($g - (max(1,$g)*$percentage_adjuster));
		$b = round($b - (max(1,$b)*$percentage_adjuster));

		return '#'.str_pad(dechex( max(0,min(255,$r)) ),2,'0',STR_PAD_LEFT)
			.str_pad(dechex( max(0,min(255,$g)) ),2,'0',STR_PAD_LEFT)
			.str_pad(dechex( max(0,min(255,$b)) ),2,'0',STR_PAD_LEFT);

	}

	function adjustBrightnessByStep($hex, $diff) {
		$rgb = str_split(trim($hex, '# '), 2);

		foreach ($rgb as &$hex) {
			$dec = hexdec($hex);
			if ($diff >= 0) {
				$dec += $diff;
			}
			else {
				$dec -= abs($diff);
			}
			$dec = max(0, min(255, $dec));
			$hex = str_pad(dechex($dec), 2, '0', STR_PAD_LEFT);
		}

		return '#'.implode($rgb);

	}

function get_brightness($hex, $compare = false) {

	// strip off any leading #
	$hex = zn_hex_to_rgb($hex);

	$c_r = hexdec(substr($hex, 0, 2));
	$c_g = hexdec(substr($hex, 2, 2));
	$c_b = hexdec(substr($hex, 4, 2));

	$brighntess = (($c_r * 299) + ($c_g * 587) + ($c_b * 114)) / 1000;

	if ( $compare ) {
		$brighntess = $brighntess > $compare ? true : false;
	}

	return $brighntess;
}

	function zn_create_folder( &$folder, $addindex = true )
	{
		if( is_dir( $folder ) && $addindex == false)
			return true;

		$created = wp_mkdir_p( trailingslashit( $folder ) );
		// SET PERMISSIONS
		@chmod( $folder, 0777 );

		if($addindex == false) return $created;

		// ADD AN INDEX.PHP FILE
		$index_file = trailingslashit( $folder ) . 'index.php';
		if ( file_exists( $index_file ) )
			return $created;

		$handle = @fopen( $index_file, 'w' );
		if ($handle)
		{
			fwrite( $handle, "<?php\r\necho 'Directory browsing is not allowed!';\r\n?>" );
			fclose( $handle );
		}

		return $created;
	}

	function zn_delete_folder( $path )
	{
		//echo $path;
		//check if folder exists
		if( is_dir( $path) )
		{

			$it = new RecursiveDirectoryIterator($path);
			$files = new RecursiveIteratorIterator($it, RecursiveIteratorIterator::CHILD_FIRST);

			foreach($files as $file) {
				if ($file->getFilename() === '.' || $file->getFilename() === '..')
				{
					continue;
				}

				if ( $file->isDir() ){
					rmdir($file->getRealPath());
				}
				else {
					unlink($file->getRealPath());
				}
			}

			rmdir($path);
		}
	}

	function find_file( $folder , $extension )
	{
		$files = scandir( $folder );

		foreach($files as $file)
		{
			if(strpos(strtolower($file), $extension )  !== false && $file[0] != '.')
			{
				return $file;
			}
		}

		return false;
	}

/*--------------------------------------------------------------------------------------------------
	zn_extract_link - This function will return the option
	@accepts : An link option
	@returns : array containing a link start and link end HTML
--------------------------------------------------------------------------------------------------*/
function zn_extract_link( $link_array , $class = false , $attributes = false, $def_start = '', $def_end = '', $def_url = false ){

	if($def_url && empty($link_array['url'])){
		$link_array['url'] = trim($def_url);
	}

	if ( !is_array( $link_array ) || empty( $link_array['url'] ) ) {
		$link['start'] = $def_start ? $def_start : '';
		$link['end'] = $def_end ? $def_end : '';
	}
	else{

		$title 	= ! empty( $link_array['title'] ) ? 'title="'.$link_array['title'].'"' : '';
		$target = ! empty( $link_array['target'] ) ? zn_get_target( esc_attr( $link_array['target'] ) ) : '';
		$link 	= array( 'start' => '<a href="'.esc_url( $link_array['url'] ).'" '.$attributes.' class="'.$class.'" '.$title.' '.$target.' '.WpkPageHelper::zn_schema_markup('url').'>' , 'end' => '</a>' );
	}

	return $link;

}

/*--------------------------------------------------------------------------------------------------
	zn_extract_link_title - This function will return the title string from link array
	@accepts : An link option
	@returns : string
--------------------------------------------------------------------------------------------------*/
function zn_extract_link_title( $link_array, $esc = false ){

	return is_array( $link_array ) && !empty( $link_array['title'] ) ? ( $esc ? esc_attr( $link_array['title'] ) : $link_array['title'] )  : '';

}

/*--------------------------------------------------------------------------------------------------
	Minimifyes CSS code
--------------------------------------------------------------------------------------------------*/
function zn_minimify( $css_code ){

	// Minimiy CSS
	$css_code = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css_code); // Remove comments
	$css_code = str_replace(': ', ':', $css_code); // Remove space after colons
	$css_code = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $css_code); // Remove whitespace

	return $css_code;
}

/*--------------------------------------------------------------------------------------------------
	Sanitize string
--------------------------------------------------------------------------------------------------*/
function zn_sanitize_string( $string , $prepend = false , $not_empty = false ){

	$string = remove_accents( $string );
	$string = preg_replace(array('~[\W\s]~' , '/_+/'), '_', $string);
	$string = strtolower($string);

	if( $not_empty )
	{
		if(str_replace('_', '', $string) == '') return;
	}

	if ( $prepend ) {
		$string = $prepend . $string;
	}

	return $string;
}

function zn_make_theme_options_slug( $string ) {

	$string = strtolower($string);
	$invalid_characters = array('$', '%', '#', '<', '>', '|', ' ');
	$string = str_replace($invalid_characters, '', $string);

	return $string;
}

function is_ajax_pb(){
	if ( current_user_can( 'edit_posts' ) && isset( $_POST['nonce'] ) && wp_verify_nonce($_POST['nonce'], 'ZnNonce') ) {
		return true;
	}
	else {
		return false;
	}
}

global $zn_current_post_id;
function zn_get_the_id() {
	global $zn_current_post_id;

	if ( isset( $zn_current_post_id ) ) {
		$id = $zn_current_post_id;
	}
	else{
		if( isset( $_POST['post_id'] ) ){
			$id = $zn_current_post_id = $_POST['post_id'];
		}
		else{
			$post = get_post();
			if(isset( $post->ID) ) {
				$id = $zn_current_post_id = get_queried_object_id();
			}
			else{
				$id = $zn_current_post_id = false;
			}

		}
	}

	$id = apply_filters('zn_get_the_id', $id);

	return $id;

}

/*--------------------------------------------------------------------------------------------------
	Preety print
--------------------------------------------------------------------------------------------------*/
function print_z($string, $hidden = false) {
	echo '<pre '. ( $hidden ? 'style="display:none"':'' ) .'>';
		print_r($string);
	echo '</pre>';
}

/*--------------------------------------------------------------------------------------------------
	Sanitize string for widgets
--------------------------------------------------------------------------------------------------*/
function zn_sanitize_widget_id($id){
	$id = preg_replace( '|[^a-z0-9 _.\-@]|i', '', $id );
	return str_replace(' ','_',strtolower($id) );
}

/*--------------------------------------------------------------------------------------------------
	Create dynamic css
--------------------------------------------------------------------------------------------------*/
function generate_options_css( $data = false ) {

	global $zn_framework, $saved_options;

	/* CLEAR THE FW OPTIONS CACHE */
	if( ! empty( $data ) ){
		$saved_options = $data;
	}
	else{
		$saved_options = false;
	}


	/** Define some vars **/
	$uploads = wp_upload_dir();
	$css_dir = apply_filters( 'zn_dynamic_css_location', THEME_BASE. '/css/'); // Shorten code, save 1 call

	$zn_uploads_dir = trailingslashit( $uploads['basedir'] );

	/** Capture CSS output **/
	ob_start();
	require($css_dir . 'dynamic_css.php');
	$css = ob_get_clean();

	$css = apply_filters('zn_dynamic_css',$css);
	$css = zn_minimify( $css );

	/** Write to zn_dynamic.css file **/
	file_put_contents( $zn_uploads_dir . 'zn_dynamic.css', $css );

}

/*--------------------------------------------------------------------------------------------------
	Adds user generated custom css
--------------------------------------------------------------------------------------------------*/
add_filter( 'zn_dynamic_css', 'add_custom_css', 100 );
function add_custom_css( $css ){

	$saved_css = get_option( 'zn_'.ZN()->theme_data['theme_id'].'_custom_css', '' );
	$new_css = $css  . $saved_css;

	return $new_css;
}

/* CUSTOM WP_FOOTER FUNCTION
	Fixes problems with next gen gallery
*/
function zn_footer(){
	do_action('zn_footer');
}

/**
 * Checks if a plugin is installed. The $plugin variable should contain the plugin name and main file ( for example zn_framework/zn_framework.php )
 * @param type $plugin
 * @return bool
 */
function zn_is_plugin_installed( $plugin ){
	if ( file_exists( WP_PLUGIN_DIR . '/' . $plugin ) ) {
		return true;
	} else {
		return false;
	}
}

function zn_is_plugin_active( $plugin_path = '' ) {
	/**
	 * Detect plugin. For use on Front End only.
	 * eg: zn_is_plugin_active( 'plugin-directory/plugin-file.php' );
	 */
	if(!function_exists('is_plugin_active')){
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	}
	// check for plugin using plugin name
	return is_plugin_active( $plugin_path );
}

/**
 * Verify whether or not the WooCommerce plugin is installed and active.
 * On some web hosts, like godaddy, the check for WooCommerce using is_plugin_active returns true even if the plugin
 * is not installed or active.
 */
function znfw_is_woocommerce_active(){
	return class_exists('WooCommerce');
}

/**
 * Retrieve the media ID from the given URL
 * @param string $attachment_url
 * @return bool|null|string
 */
function ZngetAttachmentIdFromUrl($attachment_url = ''){
	global $wpdb;
	$attachment_id = false;
	// If there is no url, return.
	if ( empty( $attachment_url ) ) {
		return $attachment_id;
	}

	// Get the upload directory paths
	$upload_dir_paths = wp_upload_dir();

	// Make sure the upload path base directory exists in the attachment URL
	if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {
		// If this is the URL of an auto-generated thumbnail, get the URL of the original image
		$attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );

		// Remove the upload path base directory from the attachment URL
		$attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );

		// Run a custom database query to get the attachment ID from the modified attachment URL
		$attachment_id = $wpdb->get_var(
			$wpdb->prepare( "
		SELECT wposts.ID
			FROM {$wpdb->posts} AS wposts
				INNER JOIN {$wpdb->postmeta} AS wpostmeta
					ON wposts.ID = wpostmeta.post_id
				WHERE wpostmeta.meta_key = '_wp_attached_file'
					AND wpostmeta.meta_value = '%s'
					AND wposts.post_type = 'attachment'", $attachment_url ) );
	}
	return $attachment_id;
}

/**
 * Retrieve the alt value from the Given Image URL
 * @param string $attachment_url
 */
function ZngetImageAltFromUrl($attachment_url = '', $with_attr = false){

	$img_id = ZngetImageDataFromUrl($attachment_url);
	$alt = !empty($img_id['alt']) ? $img_id['alt'] : '';

	if($with_attr){
		$alt = ' alt="'.$alt.'"';
	}
	return $alt;
}

/**
 * Retrieve the image title value from the Given Image URL
 * @param string $attachment_url
 */
function ZngetImageTitleFromUrl($attachment_url = '', $with_attr = false){

	$img_id = ZngetImageDataFromUrl($attachment_url);
	$title = !empty($img_id['title']) ? $img_id['title'] : '';

	if($with_attr){
		$title = ' title="'.$title.'"';
	}

	return $title;
}

/**
 * Retrieve the image width and height from the Given Image URL
 * @param string $attachment_url
 */
function ZngetImageSizesFromUrl($attachment_url = '', $with_attr = false){

	$sizes = array();

	$img_data = ZngetImageDataFromUrl($attachment_url);
	$sizes['width'] = ! empty($img_data['width']) ? $img_data['width'] : '';
	$sizes['height'] = ! empty($img_data['height']) ? $img_data['height'] : '';

	if($with_attr){
		$attr_sizes = '';
		if( ! empty( $sizes['width'] ) ) {
			$attr_sizes .= ' width="'.$sizes['width'].'"';
		}
		if( ! empty( $sizes['height'] ) ) {
			$attr_sizes .= ' height="'.$sizes['height'].'"';
		}
		$sizes = $attr_sizes;
		// $sizes = ' width="'.$sizes['width'].'" height="'.$sizes['height'].'"';
	}

	return $sizes;
}

function ZngetImageDataFromUrl( $attachment_url = '' )
{
	global $wpdb, $zn_images_data;
	$attachment_data = false;
	// If there is no url, return.
	if ( empty( $attachment_url ) ) {
		return $attachment_data;
	}
	$saved_attachment_url = $attachment_url;

	if(is_array($zn_images_data) && is_string($attachment_url) && isset($zn_images_data[ $attachment_url ]) && !empty($zn_images_data[ $attachment_url ]))
	{
		return $zn_images_data[ $attachment_url ];
	}

	// Get the upload directory paths
	$upload_dir_paths = wp_upload_dir();

	//#! @wpk: Fixes PHP notice when $attachment_url is an array
	//#! @since v4.1.1
	if(is_array($attachment_url) && isset($attachment_url['image']) && !empty($attachment_url['image'])){
		$saved_attachment_url = $attachment_url = $attachment_url['image'];
	}
	//#!

	// Make sure the upload path base directory exists in the attachment URL
	if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {
		// If this is the URL of an auto-generated thumbnail, get the URL of the original image
		$attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );

		// Remove the upload path base directory from the attachment URL
		$attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );

		// Run a custom database query to get the attachment ID from the modified attachment URL
		$attachment_data = $wpdb->get_results(
			$wpdb->prepare( "
		SELECT wposts.ID, wposts.post_title
			FROM {$wpdb->posts} AS wposts
				INNER JOIN {$wpdb->postmeta} AS wpostmeta
					ON wposts.ID = wpostmeta.post_id
				WHERE wpostmeta.meta_key = '_wp_attached_file'
					AND wpostmeta.meta_value = '%s'", $attachment_url ) );

		if( ! empty( $attachment_data[0] ) ){
			$attachment = $attachment_data[0];
		}

		// Check for WPML data
		if(is_plugin_active('sitepress-multilingual-cms/sitepress.php') && defined('ICL_LANGUAGE_CODE')) {
			foreach($attachment_data as $k => $att){
				$icl_id = icl_object_id( $att->ID, 'page', true, ICL_LANGUAGE_CODE );
				if($att->ID == $icl_id){
					$attachment = $attachment_data[$k];
				}
			}
		}

		if( $attachment ){
			// $alt = get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true);
			$attachment_data = $zn_images_data[ $saved_attachment_url ] = array(
				'title' => $attachment->post_title,
				'id' 	=> $attachment->ID,
				'alt' 	=> get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true),
			);

			// Get the image width and height
			$image_data = get_post_meta( $attachment->ID, '_wp_attachment_metadata', true);
			if( is_array( $image_data ) ){
				$attachment_data['width'] = absint( $image_data['width'] );
				$attachment_data['height'] = absint( $image_data['height'] );
			}
		}
	}
	return $attachment_data;
}
