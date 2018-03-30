<?php
/*
 * Netlabs Admin Framework
 */



//  INITIALIZE THE OPTIONS AND DRAWS THE MENU ITEMS 
add_action( 'admin_menu', 'ntl_init' );
add_action( 'init', 'ntl_admin_init' );

function ntl_init() {
	
	$theme_data = get_theme_data( TEMPLATEPATH . '/style.css' );	
	$icon = get_template_directory_uri() .'/admin/images/ntl.png';
		
	//  SETS THE MAIN THEME OPTIONS PAGE	
	$ntl_settings_page =  add_menu_page(
		$theme_data['Name'], 
		$theme_data['Name'], 
		'manage_options',
		'theme-settings', 
		'ntl_draw_page', 
		$icon, 
		3
	);
	
	$ntl_settings_facebook = add_submenu_page(
		'theme-settings', 
		'Facebook', 
		__('Facebook', 'localize'), 
		'manage_options', 
		'facebook-settings', 
		'ntl_draw_facebook'
	);
		
	//  SETS THE SLIDE OPTIONS PAGE	
	$ntl_settings_slide = add_submenu_page(
		'theme-settings', 
		'Slideshow', 
		__('Slideshow', 'localize'), 
		'manage_options', 
		'slide-settings', 
		'ntl_draw_slide'
	);
	
	$ntl_settings_video = add_submenu_page(
		'theme-settings', 
		'Video', 
		__('Video', 'localize'), 
		'manage_options', 
		'video-settings', 
		'ntl_draw_video'
	);
	
	$ntl_settings_utility = add_submenu_page(
		'theme-settings', 
		'Utility', 
		__('Utilities', 'localize'), 
		'manage_options', 
		'utility-settings', 
		'ntl_draw_utility'
	);
		
	//  RENDERS ALL THE PAGES	
	add_action( "load-{$ntl_settings_page}", 'ntl_show_page' );
	add_action( "load-{$ntl_settings_facebook}", 'ntl_show_facebook' );
	add_action( "load-{$ntl_settings_slide}", 'ntl_show_slide' );
	add_action( "load-{$ntl_settings_video}", 'ntl_show_video' );
	add_action( "load-{$ntl_settings_utility}", 'ntl_show_utility' );

	add_action( 'admin_print_styles-' . $ntl_settings_page, 'ntl_color_scripts' );
	add_action( 'admin_print_styles-' . $ntl_settings_facebook, 'ntl_color_scripts' );	
	add_action( 'admin_print_styles-' . $ntl_settings_slide, 'ntl_color_scripts' );
	add_action( 'admin_print_styles-' . $ntl_settings_video, 'ntl_color_scripts' );
	add_action( 'admin_print_styles-' . $ntl_settings_utility, 'ntl_color_scripts' );
}



   function ntl_color_scripts()
   {
       
   	wp_enqueue_style( 'farbtastic' );
	wp_enqueue_style('thickbox');
    wp_enqueue_script( 'farbtastic' );
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_register_script('my-upload', get_template_directory_uri() .'/scripts/admin.js', array('jquery','media-upload','thickbox'));
	wp_enqueue_script('my-upload');
    wp_enqueue_script( 'ntl_color_scripts', get_template_directory_uri() . '/scripts/admin-options.js', array( 'farbtastic', 'jquery' ) );
	wp_register_script('my-aj1', get_template_directory_uri() .'/scripts/ajaxupload.js', array('jquery'));
	wp_enqueue_script('my-aj1');
	wp_register_script('my-aj2', get_template_directory_uri() .'/scripts/admin-ajax.js', array('jquery'));
	wp_enqueue_script('my-aj2');


   }



//  ADDS ALL THE HEADER STYLES AND SCRIPTS

add_action('admin_head', 'ntl_admin_head');

function ntl_admin_head() {
	
	
	//  GENERAL ADMIN STYLE	
	echo '<link rel="stylesheet" type="text/css" href="' . get_template_directory_uri() . '/admin/admin-style.css" media="screen" />';
	
	$thepager = '';
	
	if (isset($_GET['page'])) {
		$thepager = $_GET['page'];
	}
		
	//  STYLESHEET FOR THE NAV-MENU TYPE PAGES	
	if ($thepager == 'slide-settings' || $thepager == 'video-settings' || $thepager == 'utility-settings' || $thepager == 'facebook-settings' ){ 
		echo '<link rel="stylesheet" type="text/css" href="' . get_template_directory_uri() . '/admin/nav-menu.css" media="screen" />';	
	}		
			
	?>
	<script type="text/javascript"> 
		ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';
	</script>			
	<?php	

}



//  AJAX UPLOADER PHP ACTION CODE
add_action('wp_ajax_ntl_post_action', 'ntl_ajax_callback');

function ntl_ajax_callback() {
	global $wpdb; 
	$save_type = $_POST['type'];
		
	//  IMAGE UPLOAD HANDLER
	if($save_type == 'upload'){		
		$clickedID = $_POST['data']; // Acts as the name
		$filename = $_FILES[$clickedID];
		$override['test_form'] = false;
		$override['action'] = 'wp_handle_upload';    
		$uploaded_file = wp_handle_upload($filename,$override);		 
		$upload_tracking[] = $clickedID;
		$settings = get_option( "ntl_theme_settings" );
		$settings['ntl_theme_logo']	= $uploaded_file['url'];
		$updated = update_option( "ntl_theme_settings", $settings );
		$subber = $uploaded_file['new_file'];
		$subber2 = $uploaded_file['url'];
		$subber2 = str_replace($subber , "" , $subber2);				
		 if(!empty($uploaded_file['error'])) {echo 'Upload Error: ' . $uploaded_file['error']; exit; }
		 else { echo ' id="image_' . $clickedID .'" src="' . $subber2 . '" alt=""'; exit; } 
	}
		
	//  IMAGE RESET HANDLER
	elseif($save_type == 'image_reset'){
		$id = $_POST['data']; // Acts as the name
		$settings = get_option( "ntl_theme_settings" );
		$settings['ntl_theme_logo']	= '';
		$updated = update_option( "ntl_theme_settings", $settings );
		exit;
	} 
	
	elseif ($save_type == 'get_googleapi'){
		echo '<iframe name="framename" frameBorder="0" id="myframe" ALLOWTRANSPARENCY="true" src="' . get_template_directory_uri() . '/admin/googleapi.php?data=' . $_POST['data'] . '"></iframe>';
		exit;
	}			
}


// ADD DEFAULT SETTINGS TO THE THEME
function ntl_admin_init() {
	$settings = get_option( "ntl_theme_settings" );
	if ( empty( $settings ) ) {
		$settings = array(
			'ntl_theme_bg' => 'Brown',
			'ntl_theme_color' => '#5692BC',
			'ntl_font_primary' => 'PT Sans Narrow',
			'ntl_font_secondary' => 'Droid Sans',
			'ntl_calnext_label' => 'next show',
			'ntl_calmoreinf_label' => 'view calendar',
			'ntl_map_metric' => 'metric',
			'ntl_trans_type' => 'cube',
			'ntl_trans_time' => 5,
			'ntl_slide_type' => 'content',
			'ntl_disable_audio' => 'off'
			
		);
		add_option( "ntl_theme_settings", $settings, '', 'yes' );
	}	
}

?>