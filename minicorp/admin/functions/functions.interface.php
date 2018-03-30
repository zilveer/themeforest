<?php 
/**
 * SMOF Interface
 *
 * @package     WordPress
 * @subpackage  SMOF
 * @since       1.4.0
 * @author      Syamil MJ
 */
 
 
/**
 * Admin Init
 *
 * @uses wp_verify_nonce()
 * @uses header()
 *
 * @since 1.0.0
 */
function optionsframework_admin_init() 
{
	// Rev up the Options Machine
	global $of_options, $options_machine;
	$options_machine = new Options_Machine($of_options);
}

/**
 * Create Options page
 *
 * @uses add_theme_page()
 * @uses add_action()
 *
 * @since 1.0.0
 */
function optionsframework_add_admin() {

    // Added by IshYoBoy
    $title = __( 'Theme Options', 'ishyoboy' );

    if ( $xml = Options_Machine::ishyoboy_get_updates() ){

        $my_theme = wp_get_theme(THEME_SLUG);

        if( version_compare( $my_theme->Version, $xml->latest ) == -1 ){
            $title = __( 'Theme Options', 'ishyoboy' ) . ' ' . '<span class="update-plugins count-1"><span class="update-count">1</span></span>';
        }

    }
	
    $of_page = add_theme_page( THEMENAME, $title, 'edit_theme_options', 'optionsframework', 'optionsframework_options_page');

	// Add framework functionaily to the head individually
	add_action("admin_print_scripts-$of_page", 'of_load_only');
	add_action("admin_print_styles-$of_page",'of_style_only');
	add_action( "admin_print_styles-$of_page", 'optionsframework_mlu_css', 0 );
	add_action( "admin_print_scripts-$of_page", 'optionsframework_mlu_js', 0 );	
	
}


/**
 * Build Options page
 *
 * @since 1.0.0
 */
function optionsframework_options_page(){
	
	global $options_machine;
	
	/*
	//for debugging

	$ish_options = of_get_options();
	print_r($ish_options);

	*/	
	
	include_once( ADMIN_PATH . 'front-end/options.php' );

}

/**
 * Create Options page
 *
 * @uses wp_enqueue_style()
 *
 * @since 1.0.0
 */
function of_style_only(){
	wp_enqueue_style('admin-style', ADMIN_DIR . 'assets/css/admin-style.css');
	wp_enqueue_style('ishyoboy-styles', ADMIN_DIR . 'assets/css/ishyoboy-style.css');
	wp_enqueue_style('color-picker', ADMIN_DIR . 'assets/css/colorpicker.css');
	wp_enqueue_style('jquery-ui-custom-admin', ADMIN_DIR .'assets/css/jquery-ui-custom.css');
}	

/**
 * Create Options page
 *
 * @uses add_action()
 * @uses wp_enqueue_script()
 *
 * @since 1.0.0
 */
function of_load_only() 
{
	add_action('admin_head', 'of_admin_head');
	
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-sortable');
	wp_enqueue_script('jquery-ui-slider');
	wp_enqueue_script('jquery-input-mask', ADMIN_DIR .'assets/js/jquery.maskedinput-1.2.2.js', array( 'jquery' ));
	wp_enqueue_script('tipsy', ADMIN_DIR .'assets/js/jquery.tipsy.js', array( 'jquery' ));
	wp_enqueue_script('color-picker', ADMIN_DIR .'assets/js/colorpicker.js', array('jquery'));
	wp_enqueue_script('ajaxupload', ADMIN_DIR .'assets/js/ajaxupload.js', array('jquery'));
	wp_enqueue_script('cookie', ADMIN_DIR . 'assets/js/cookie.js', 'jquery');
	wp_enqueue_script('smof', ADMIN_DIR .'assets/js/smof.js', array( 'jquery' ));
}

/**
 * Front end inline jquery scripts
 *
 * @since 1.0.0
 */
function of_admin_head() { ?>
		
	<script type="text/javascript" language="javascript">

	jQuery.noConflict();
	jQuery(document).ready(function($){
	
		// COLOR Picker			
		$('.colorSelector').each(function(){
			var Othis = this; //cache a copy of the this variable for use inside nested function
            var default_value = jQuery(this).next('input').val();
				
			$(this).ColorPicker({
					color: default_value,
					onShow: function (colpkr) {
						$(colpkr).stop(true,true).fadeIn(500);
						return false;
					},
					onHide: function (colpkr) {
						$(colpkr).stop(true,true).fadeOut(500);
						return false;
					},
					onChange: function (hsb, hex, rgb) {
						$(Othis).children('div').css('backgroundColor', '#' + hex);
						$(Othis).next('input').attr('value','#' + hex);
					}
			});

            jQuery(this).next('input').bind('keyup', function(){
                var picker = $(Othis);
                var clr = jQuery(this).val();
                picker.ColorPickerSetColor(clr);
                picker.children('div').css('backgroundColor', clr);
            });
				  
		}); //end color picker
		
	}); //end doc ready
	
	</script>
	
<?php }

/**
 * Ajax Save Options
 *
 * @uses get_option()
 *
 * @since 1.0.0
 */
function of_ajax_callback() 
{
	global $options_machine, $of_options;

	$nonce=$_POST['security'];
	
	if (! wp_verify_nonce($nonce, 'of_ajax_nonce') ) die('-1'); 
			
	//get options array from db
	$all = of_get_options();
	
	$save_type = $_POST['type'];
	
	//echo $_POST['data'];

	//Uploads
	if($save_type == 'upload')
	{
		
		$clickedID = $_POST['data']; // Acts as the name
		$filename = $_FILES[$clickedID];
       	$filename['name'] = preg_replace('/[^a-zA-Z0-9._\-]/', '', $filename['name']); 
		
		$override['test_form'] = false;
		$override['action'] = 'wp_handle_upload';    
		$uploaded_file = wp_handle_upload($filename,$override);
		 
			$upload_tracking[] = $clickedID;
				
			//update $options array w/ image URL			  
			$upload_image = $all; //preserve current data
			
			$upload_image[$clickedID] = $uploaded_file['url'];
			
			of_save_options($upload_image);
		
				
		 if(!empty($uploaded_file['error'])) {echo 'Upload Error: ' . $uploaded_file['error']; }	
		 else { echo $uploaded_file['url']; } // Is the Response
		 
	}
	elseif($save_type == 'image_reset')
	{
			
			$id = $_POST['data']; // Acts as the name
			
			$delete_image = $all; //preserve rest of data
			$delete_image[$id] = ''; //update array key with empty value	 
			of_save_options($delete_image ) ;
	
	}
	elseif($save_type == 'backup_options')
	{
			
		$backup = $all;
		$backup['backup_log'] = date('r');

        echo BACKUPS;
		
		of_save_options($backup, BACKUPS) ;
			
		die('1');
	}
	elseif($save_type == 'restore_options')
	{
			
		$ish_options = get_option(BACKUPS);

		update_option(OPTIONS, $ish_options);

		of_save_options($ish_options);
		
		die('1'); 
	}
	elseif($save_type == 'import_options'){

        $ish_options = $_POST['data'];
        $ish_options = unserialize(base64_decode($ish_options)); //100% safe - ignore theme check nag
		of_save_options($ish_options);

		die('1');
	}
	elseif ($save_type == 'save')
	{

		$_POST['data'] = str_replace('ish-rplc_open', '<script', $_POST['data'] );
		$_POST['data'] = str_replace('ish-rplc_close', '</script>', $_POST['data'] );

		wp_parse_str(stripslashes($_POST['data']), $ish_options);

        //**********************
        // Changed by IshYoBoy
            if ('' == $ish_options['color1']){ $ish_options['color1'] = ISH_COLOR_1; }
            if ('' == $ish_options['color2']){ $ish_options['color2'] = ISH_COLOR_2; }
            if ('' == $ish_options['color3']){ $ish_options['color3'] = ISH_COLOR_3; }
            if ('' == $ish_options['color4']){ $ish_options['color4'] = ISH_COLOR_4; }

		unset($ish_options['security']);
		unset($ish_options['of_save']);
		of_save_options(apply_filters('of_options_before_save_only_save', $ish_options));


		die('1');
	}
	elseif ($save_type == 'reset')
	{
		of_save_options($options_machine->Defaults);
		
        die('1'); //options reset
	}

  	die();
}