<?php 
/**
 * SMOF Modified / AllAround
 *
 * @package     WordPress
 * @subpackage  SMOF
 * @theme AllAround
 * @author Shindiri Studio (http://www.shindiristudio.com) & http://www.mihajlovicnenad.com/
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
	
    $of_page = add_theme_page( THEMENAME, 'AllAround Theme Options', 'edit_theme_options', 'optionsframework', 'optionsframework_options_page' );

	// Add framework functionaily to the head individually
	add_action( "admin_print_scripts-$of_page", 'of_load_only' );
	add_action( "admin_print_styles-$of_page",'of_style_only' );
	add_action( "admin_print_styles", 'optionsframework_mlu_css', 0 );
	add_action( "admin_print_scripts", 'optionsframework_mlu_js', 0 );	
	
}


/**
 * Build Options page
 *
 * @since 1.0.0
 */
function optionsframework_options_page(){
	
	global $options_machine;
	
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
 * Set transients on save
 *
 * @AllAround
 */
 
function allaround_checkfonts($data) {
	delete_transient('google_fonts');
	delete_transient('insert_fonts');
	$fonts = array( 'body' => $data['font'], 'cursive' => $data['cursive_font'] );
	$google_fonts = '';
	$insert_fonts = '';
	foreach ( $fonts as $font => $type ) {
		if ( strstr( $type, ',' ) == false ) :
			$the_font_replace = str_replace( ' ', '+', $type );
			$google_fonts .= "@import url('http://fonts.googleapis.com/css?family={$the_font_replace}:400,200,300,600,700,800,500,400italic,700italic');\n";
		endif;
		switch ( $font ):
			case 'body' :
			$insert_fonts .= "body { font-family:{$data['font']}; }\n";
			break;
			case 'cursive' :
			$insert_fonts .= ".our_team_sub_header, .blog_post_comments .comment_text_wrapper .date, .blog_post_comments .comment_text_wrapper .rank, .products .subtitle, .sub_header, .gallery span, .contact_link_wrapper span span, .testimonials_text, .testimonials_author, .featured_text, .featured_author, .woocommerce table.shop_attributes td p, cite, address, em, .widget_calendar caption { font-family:{$data['cursive_font']}; font-style:italic; }\n";
			break;
		endswitch;
	}
	set_transient('google_fonts', $google_fonts);
	set_transient('insert_fonts', $insert_fonts);
}

function allaround_checkcolors($data) {
	delete_transient('insert_colors');
	$dark = allaround_adjust_brightness( $data['custom_color'], -33 );
	$darker = allaround_adjust_brightness( $data['custom_color'], -66 );
	$lighter = allaround_adjust_brightness( $data['custom_color'], 33 );
	$color = array( $data['custom_color'], $dark, $darker, $lighter );
	$insert_colors = ".sidebar_wrapper aside li, .widget_calendar caption, .woocommerce div.product .stock, .star-rating, .woocommerce div.product .woocommerce-tabs ul.tabs li.active a:hover, .additional_information_tab.active, .reviews_tab.active, .sidebar_wrapper .widget li a:hover, h5 a:hover, h3 a:hover, .customColor, a, .highlight, a.acc-trigger.active, .bread_crumps a, .widget a:hover, .widget li span, .footer_navigation a:hover, .main_header span, .products .subtitle, .sub_header, .our_team_sub_header, .woocommerce .address h2, .woocommerce > h2, .footer_navigation a:hover {color:{$color[0]};} .image_more_info img, .customColorBg, span.onsale, .woocommerce .remove:hover, .widget_product_search #searchform label ,.woocommerce form .form-row label[for='password_1'], .woocommerce form .form-row label[for='password_2'], .woocommerce form .form-row label[for='user_login'], .woocommerce-page form.login .form-row label, .widget_price_filter .ui-slider .ui-slider-range, .widget_price_filter .ui-slider .ui-slider-handle {background:{$color[0]} !important;} .woocommerce div.product .woocommerce-tabs ul.tabs li, .input_title, .textarea_title, #submit, .pop_up_bubble.red, .submit_button, .cart-collaterals .shipping_calculator .button, .woocommerce .edit, .woocommerce input.button, .woocommerce a.button, .woocommerce-page button.button.alt, .checkout-button, #place_order,.woocommerce input.button.alt, .woocommerce input.button.alt:hover, input.submit_button, .static_banner_wrapper, #commentform p.comment-form-comment label, .widget_product_search #searchsubmit {background:{$color[0]};} .supheader_wrap, .statistics_bar, .woocommerce nav.woocommerce-pagination ul li span.current {background-color:{$color[0]} !important;} #rcarousel2-next, #rcarousel2-prev,.hover_single, #ui-carousel-prev, #ui-carousel-next, .read_more, .orbit-wrapper div.slider-nav span.right:hover, .orbit-wrapper div.slider-nav span.left:hover, .pagination .current, .woocommerce-message:before, .add_to_cart_button, .image_socials a img, .content_slider_text_block_wrap a.button_regular, .products_wrapper span.price {background-color:{$color[0]};-pie-background:{$color[0]};} h1, .woocommerce .remove, .products_sidebar a:hover {color:{$color[0]} !important;} .page .category a, span.price, p.price,.supheader_wrap .header_socials.cart-style span {color:{$color[0]} !important;}a.acc-trigger.active:hover, .bread_crumps a:hover, .blog_content h3 a span {color:$color[1] !important;} .tabs-nav a.active { color:{$color[0]} !important; border-top-color:{$color[0]} !important; }.woocommerce-message {border-color:{$color[0]} !important;} .products_wrapper .add_to_cart_button.button.product_type_simple, .button.product_type_variable {background-color:{$color[0]} !important;}";
	set_transient('insert_colors', $insert_colors);
	set_transient('custom_color', $color[0]);
	set_transient('custom_color_lighter', $color[3]);
}

function allaround_checkimages($data) {
	
	$admin_url = admin_url( 'admin-ajax.php' );
	
	$color = substr($data['custom_color'], 1, 7);
	$pointer_ajaxurl = $admin_url . '?action=con_replace_color&imgpath=' . get_template_directory_uri() . '/images/blog/pointer.png&imgcolor=' . $color;
	$pointer_left_ajaxurl = $admin_url . '?action=con_replace_color&imgpath=' . get_template_directory_uri() . '/images/blog/pointer_left.png&imgcolor=' . $color;
	$accordion_ajaxurl = $admin_url . '?action=con_replace_color&imgpath=' . get_template_directory_uri() . '/images/elements/arrow-opened.png&imgcolor=' . $color;
	$select_ajaxurl = $admin_url . '?action=con_replace_color&imgpath=' . get_template_directory_uri() . '/images/products/arrows.png&imgcolor=' . $color;

	$iconbits = wp_remote_fopen($pointer_ajaxurl);
	$iconbits_1 = wp_remote_fopen($pointer_left_ajaxurl);
	$iconbits_2 = wp_remote_fopen($accordion_ajaxurl);
	$iconbits_3 = wp_remote_fopen($select_ajaxurl);
	
	$iconurl = wp_upload_bits( 'pointer.png', null, $iconbits );
	$iconurl_1 = wp_upload_bits( 'pointer_left.png', null, $iconbits_1 );
	$iconurl_2 = wp_upload_bits( 'arrow-opened.png', null, $iconbits_2 );
	$iconurl_3 = wp_upload_bits( 'arrows.png', null, $iconbits_3 );
	
	$insert_images = ".date_bubble_holder .comments a {background: url(" . $iconurl['url'] . ") no-repeat top right;} .blog_post.blog2 .date_bubble_holder .comments a, .blog_post.blog2.blog3 .date_bubble_holder .comments a, .blog_post_page2 .date_bubble_holder .comments a {background: url(" . $iconurl_1['url'] . ") no-repeat top left;} a.acc-trigger.active .acc-arrow {background:url(" . $iconurl_2['url'] . ") no-repeat center center;} .select_menu .drop_button {background:url(" . $iconurl_3['url'] . ") no-repeat center center;}";
	set_transient('insert_images', $insert_images);

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
			$(this).ColorPicker({
					color: '<?php if(isset($color)) echo $color; ?>',
					onShow: function (colpkr) {
						$(colpkr).fadeIn(500);
						return false;
					},
					onHide: function (colpkr) {
						$(colpkr).fadeOut(500);
						return false;
					},
					onChange: function (hsb, hex, rgb) {
						$(Othis).children('div').css('backgroundColor', '#' + hex);
						$(Othis).next('input').attr('value','#' + hex);
					}
			});
		}); //end color picker
	}); //end doc ready
	</script>
<?php }

/**
 * Ajax Save Options
 *
 * @uses get_option()
 * @uses update_option()
 *
 * @since 1.0.0
 */
function of_ajax_callback() 
{
	global $options_machine, $of_options;

	$nonce=$_POST['security'];
	
	if (! wp_verify_nonce($nonce, 'of_ajax_nonce') ) die('-1'); 
			
	//get options array from db
	$all = get_option(OPTIONS);
	
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
			
			update_option(OPTIONS, $upload_image ) ;
		
				
		 if(!empty($uploaded_file['error'])) {echo 'Upload Error: ' . $uploaded_file['error']; }	
		 else { echo $uploaded_file['url']; } // Is the Response
		 
	}
	elseif($save_type == 'image_reset')
	{
			
			$id = $_POST['data']; // Acts as the name
			
			$delete_image = $all; //preserve rest of data
			$delete_image[$id] = ''; //update array key with empty value	 
			update_option(OPTIONS, $delete_image ) ;
	
	}
	elseif($save_type == 'backup_options')
	{
			
		$backup = $all;
		$backup['backup_log'] = date('r');
		
		update_option(BACKUPS, $backup ) ;
			
		die('1'); 
	}
	elseif($save_type == 'restore_options')
	{
			
		$data = get_option(BACKUPS);
		
		update_option(OPTIONS, $data);
		
		die('1'); 
	}
	elseif($save_type == 'import_options'){
			
		$data = $_POST['data'];
		$data = unserialize(base64_decode($data)); //100% safe - ignore theme check nag
		update_option(OPTIONS, $data);
		
		die('1'); 
	}
	elseif ($save_type == 'save')
	{
		wp_parse_str(stripslashes($_POST['data']), $data);
		unset($data['security']);
		unset($data['of_save']);
		allaround_checkfonts($data);
		allaround_checkcolors($data);
		allaround_checkimages($data);
		update_option(OPTIONS, $data);
		
		die('1');
	}
	elseif ($save_type == 'reset')
	{
		update_option(OPTIONS,$options_machine->Defaults);
		
        die('1'); //options reset
	}

  	die();
}

/**
 * Ajax Save Post Templates
 *
 * @uses get_option()
 * @uses update_option()
 *
 * @since 1.0.0
 */
function of_ajax_templates_callback() 
{

	$nonce=$_POST['security'];
	
	if (! wp_verify_nonce($nonce, 'of_ajax_nonce_post') ) die('-1'); 
			
	//get options array from db
	$all = get_option(OPTIONS .'_templates', '');
	
	$save_type = $_POST['type'];
	
	//echo $_POST['data'];
		//Uploads
	if($save_type == 'save')
	{
		wp_parse_str(stripslashes($_POST['data']), $data);
		unset($data['security']);
		unset($data['of_save']);
		if ( $all !== '') :
			$all = $data + $all;
			update_option(OPTIONS .'_templates', $all);
		else :
			update_option(OPTIONS .'_templates', $data);
		endif;
		
		die('1');
	}
	elseif ($save_type == 'delete')
	{
		wp_parse_str(stripslashes($_POST['data']), $data);
		unset($data['security']);
		unset($data['of_save']);
		
		$delete = reset($data);
		$name = $delete[0];
		$string = $delete[1];
		$new_all = array();
		foreach ( $all as $template ) {
			$true_name = $template[0];
			if ( $true_name !== $name ) { $new_all[$true_name] = $template;	}
		}

		update_option(OPTIONS .'_templates', $new_all);

		
		die('1');
	}	
	else
	{
        die('1'); //options reset
	}

  	die();
}

/**
 * Ajax Save Slides Templates
 *
 * @uses get_option()
 * @uses update_option()
 *
 * @since 1.0.0
 */
function of_ajax_slides_callback() 
{

	$nonce=$_POST['security'];
	
	if (! wp_verify_nonce($nonce, 'of_ajax_nonce_post') ) die('-1'); 
			
	//get options array from db
	$all = get_option(OPTIONS .'_slide_templates', '');
	
	$save_type = $_POST['type'];
	
	//echo $_POST['data'];
	
	//Uploads
	if($save_type == 'save')
	{
		wp_parse_str(stripslashes($_POST['data']), $data);
		unset($data['security']);
		unset($data['of_save']);
		if ( $all !== '') :
			$all = $data + $all;
			update_option(OPTIONS .'_slide_templates', $all);
		else :
			update_option(OPTIONS .'_slide_templates', $data);
		endif;
		
		die('1');
	}
	elseif ($save_type == 'delete')
	{
		wp_parse_str(stripslashes($_POST['data']), $data);
		unset($data['security']);
		unset($data['of_save']);
		
		$delete = reset($data);
		$name = $delete[0];
		$string = $delete[1];
		$new_all = array();
		foreach ( $all as $template ) {
			$true_name = $template[0];
			if ( $true_name !== $name ) { $new_all[$true_name] = $template; }
		}

		update_option(OPTIONS .'_slide_templates', $new_all);

		
		die('1');
	}	
	else
	{
        die('1'); //options reset
	}

  	die();
}
?>