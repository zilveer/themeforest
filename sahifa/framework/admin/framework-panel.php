<?php
/*-----------------------------------------------------------------------------------*/
# Clean options before store it in DB
/*-----------------------------------------------------------------------------------*/
function tie_clean_options(&$value) {
  $value = htmlspecialchars(stripslashes( $value ));
}
function tie_clean_imported_options(&$value) {
  $value = htmlspecialchars_decode( $value );
}
	
	
/*-----------------------------------------------------------------------------------*/
# Options Array
/*-----------------------------------------------------------------------------------*/
$array_options = array( "tie_options" );
	
	
/*-----------------------------------------------------------------------------------*/
# Save Theme Settings
/*-----------------------------------------------------------------------------------*/	
function tie_save_settings ( $data , $refresh = 0 ) {
	global $array_options ;
		
	foreach( $array_options as $option ){
		if( isset( $data[$option] )){
			array_walk_recursive( $data[$option] , 'tie_clean_options');
			update_option( $option ,  $data[$option] );
		}		
	}

	if( $refresh == 2 )  	die('2');
	elseif( $refresh == 1 )	die('1');
}
	
	
/*-----------------------------------------------------------------------------------*/
# Save Options
/*-----------------------------------------------------------------------------------*/
add_action('wp_ajax_test_theme_data_save', 'tie_save_ajax');
function tie_save_ajax() {
	
	check_ajax_referer('test-theme-data', 'security');
	$data = $_POST;
	$refresh = 1;

	if( !empty( $data['tie_import'] ) ){
		$refresh = 2;
		$data = unserialize(base64_decode( $data['tie_import'] ));
		array_walk_recursive( $data , 'tie_clean_imported_options');
	}
	
	tie_save_settings ($data , $refresh );
}


/*-----------------------------------------------------------------------------------*/
# Add Panel Page
/*-----------------------------------------------------------------------------------*/
add_action('admin_menu', 'tie_add_admin'); 
function tie_add_admin() {

	$current_page = isset( $_REQUEST['page'] ) ? $_REQUEST['page'] : '';

	$icon = get_template_directory_uri().'/framework/admin/images/tie.png';
	add_menu_page( THEME_NAME , THEME_NAME ,'switch_themes', 'panel' , 'tie_panel_options', $icon  );
	$theme_page = add_submenu_page('panel', __( 'Theme Settings', 'tie' ), __( 'Theme Settings', 'tie' ) ,'switch_themes', 'panel' , 'tie_panel_options');
	add_submenu_page('panel',  __( 'Import Demo Data', 'tie' ), __( 'Import Demo Data', 'tie' ),'switch_themes', 'tie_demo_installer' , 'tie_demo_installer');
	add_submenu_page('panel', __( 'Documentation', 'tie' ), __( 'Documentation', 'tie' ) ,'switch_themes', 'docs' , 'redirect_docs');
	add_submenu_page('panel', __( 'Support', 'tie' ), __( 'Support', 'tie' ) ,'switch_themes', 'support' , 'tie_get_support');


	function tie_get_support(){
		echo "<script type='text/javascript'>window.location='http://tielabs.com/help/';</script>";
	}
	
	function redirect_docs(){
		echo "<script type='text/javascript'>window.location='".DOCUMENTATION_URL."';</script>";
	}

	add_action( 'admin_head-'. $theme_page, 'tie_admin_head' );
	function tie_admin_head(){
	
	?>
	<script type="text/javascript">
		var emptyImg = '<?php echo get_template_directory_uri(); ?>/framework/admin/images/empty.png';

		jQuery(document).ready(function($) {
		  jQuery('.on-of').checkbox({empty: emptyImg});

		  jQuery('form#tie_form').submit(function() {
		  
		  	/* Disable Empty options */
			  jQuery('form#tie_form input, form#tie_form textarea, form#tie_form select').each(function() {
					if (!jQuery(this).val()) jQuery(this).attr("disabled", true );
			  });
			   jQuery('#typography_test-item input, #typography_test-item select').attr("disabled", true );
			   
			  var data = jQuery(this).serialize();
			  
			/* Enable Empty options */
			  jQuery('form#tie_form input:disabled, form#tie_form textarea:disabled, form#tie_form select:disabled').attr("disabled", false );
			  
			  jQuery.post(ajaxurl, data, function(response) {
				  if(response == 1) {
					  jQuery('#save-alert').addClass('save-done');
					  t = setTimeout('fade_message()', 1000);
				  }
				else if( response == 2 ){
					location.reload();
				}
				else {
					 jQuery('#save-alert').addClass('save-error');
					  t = setTimeout('fade_message()', 1000);
				  }
			  });
			  return false;
		  });
		  
		});
		
		function fade_message() {
			jQuery('#save-alert').fadeOut(function() {
				jQuery('#save-alert').removeClass('save-done');
			});
			clearTimeout(t);
		}
				
		jQuery(function() {
			jQuery( "#customList"   ).sortable({placeholder: "ui-state-highlight"});
		});
	</script>
	<?php
		wp_enqueue_media();
	}
	if( isset( $_REQUEST['action'] ) ){
		if( 'reset' == $_REQUEST['action']  && $current_page == 'panel' && check_admin_referer('reset-action-code' , 'resetnonce') ) {
			global $default_data;
			tie_save_settings( $default_data );
			header("Location: admin.php?page=panel&reset=true");
			die;
		}
	}
}


/*-----------------------------------------------------------------------------------*/
# Get The Panel Options
/*-----------------------------------------------------------------------------------*/
function tie_options ( $value ){
	$data = false;
	if( tie_get_option( $value['id'] ) ) $data = tie_get_option( $value['id'] );
	
	tie_options_build ( $value, 'tie_options['.$value["id"].']', $data );
}

/*-----------------------------------------------------------------------------------*/
# The Panel UI
/*-----------------------------------------------------------------------------------*/
function tie_panel_options() { 
	
	//Categories
	$categories_obj = get_categories('hide_empty=0');
	$categories = array();
	foreach ($categories_obj as $pn_cat) {
		$categories[$pn_cat->cat_ID] = $pn_cat->cat_name;
	}
		
	$checked = 'checked="checked"';

$save='
	<div class="mpanel-submit">
		<input type="hidden" name="action" value="test_theme_data_save" />
        <input type="hidden" name="security" value="'. wp_create_nonce("test-theme-data").'" />
		<input name="save" class="mpanel-save button button-primary button-large" type="submit" value="'.__( "Save Changes", 'tie' ).'" />    
	</div>'; 
?>
		
		
<div id="save-alert"></div>

	<?php do_action( 'tie_before_theme_panel' );?>

<div class="mo-panel">
	<div class="mo-panel-tabs">
		<a href="http://tielabs.com/" target="_blank" class="tie-logo"></a>
		<ul>
			<li class="tie-tabs general"><a href="#tab1"><span class="dashicons-before dashicons-admin-settings tie-icon-menu"></span><?php _e( 'General Settings', 'tie' ) ?></a></li>
			<li class="tie-tabs header"><a href="#tab9"><span class="dashicons-before dashicons-schedule tie-icon-menu"></span><?php _e( 'Header Settings', 'tie' ) ?></a></li>
			<li class="tie-tabs archives"><a href="#tab12"><span class="dashicons-before dashicons-exerpt-view tie-icon-menu"></span><?php _e( 'Archives Settings', 'tie' ) ?></a></li>
			<li class="tie-tabs article"><a href="#tab6"><span class="dashicons-before dashicons-media-text tie-icon-menu"></span><?php _e( 'Posts Settings', 'tie' ) ?></a></li>
			<li class="tie-tabs sidebars"><a href="#tab11"><span class="dashicons-before dashicons-slides tie-icon-menu"></span><?php _e( 'Sidebars', 'tie' ) ?></a></li>
			<li class="tie-tabs footer"><a href="#tab7"><span class="dashicons-before dashicons-editor-insertmore tie-icon-menu"></span><?php _e( 'Footer Settings', 'tie' ) ?></a></li>
			<li class="tie-tabs banners"><a href="#tab8"><span class="dashicons-before dashicons-megaphone tie-icon-menu"></span><?php _e( 'Ads Settings', 'tie' ) ?></a></li>
			<li class="tie-tabs styling"><a href="#tab13"><span class="dashicons-before dashicons-admin-appearance tie-icon-menu"></span><?php _e( 'Styling', 'tie' ) ?></a></li>
			<li class="tie-tabs typography"><a href="#tab14"><span class="dashicons-before dashicons-editor-italic tie-icon-menu"></span><?php _e( 'Typography', 'tie' ) ?></a></li>
			<li class="tie-tabs translations"><a href="#tab20"><span class="dashicons-before dashicons-editor-textcolor tie-icon-menu"></span><?php _e( 'Translations', 'tie' ) ?></a></li>
			<li class="tie-tabs Social"><a href="#tab4"><span class="dashicons-before dashicons-networking tie-icon-menu"></span><?php _e( 'Social Networking', 'tie' ) ?></a></li>
			<li class="tie-tabs advanced"><a href="#tab10"><span class="dashicons-before dashicons-admin-tools tie-icon-menu"></span><?php _e( 'Advanced', 'tie' ) ?></a></li>
			<li class="tie-tabs tie-rate tie-not-tab"><a target="_blank" href="http://themeforest.net/downloads?ref=tielabs"><span class="dashicons-before dashicons-star-filled tie-icon-menu"></span><?php _e( 'Rate', 'tie' ) ?> <?php echo THEME_NAME ?></a></li>
			<li class="tie-tabs tie-more tie-not-tab"><a target="_blank" href="http://themeforest.net/user/tielabs/portfolio?ref=tielabs"><span class="dashicons-before dashicons-art tie-icon-menu"></span><?php _e( 'More Themes', 'tie' ) ?></a></li>
		</ul>
		<div class="clear"></div>
	</div> <!-- .mo-panel-tabs -->
	
	
	<div class="mo-panel-content">
	<form action="/" name="tie_form" id="tie_form">
		<div id="tab1" class="tabs-wrap">
			<h2><?php _e( 'General Settings', 'tie' ) ?></h2> <?php echo $save ?>
			<?php if( class_exists( 'bbPress' ) ): ?>
			<div class="tiepanel-item">
				<h3><?php _e( 'bbPress Settings', 'tie' ) ?></h3>
				<?php
					tie_options(
						array(	"name"	=> __( 'bbPress Full width', 'tie' ),
								"id"	=> "bbpress_full",
								"type"	=> "checkbox"));
				?>
			</div>
			<?php endif; ?>
			
			<div class="tiepanel-item">
				<h3><?php _e( 'Theme Layout', 'tie' ) ?></h3>
				<div class="option-item">
					<?php
						$tie_theme_layout = tie_get_option('theme_layout');
					?>
					<ul id="tie_theme_layout" class="tie-options">
						<li>
							<input id="tie_theme_layout" name="tie_options[theme_layout]" type="radio" value="boxed" <?php if($tie_theme_layout == 'boxed' || !$tie_theme_layout ) echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/boxed.png" /></a>
						</li>
						<li>
							<input id="tie_theme_layout" name="tie_options[theme_layout]" type="radio" value="boxed-all" <?php if($tie_theme_layout == 'boxed-all') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/boxed-all.png" /></a>
						</li>
						<li>
							<input id="tie_theme_layout" name="tie_options[theme_layout]" type="radio" value="full" <?php if($tie_theme_layout == 'full') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/full.png" /></a>
						</li>
					</ul>
				</div>
			</div>
			
			
			<div class="tiepanel-item">
				<h3><?php _e( 'Custom Favicon', 'tie' ) ?></h3>
				<?php
					tie_options(
						array(	"name"	=> __( 'Custom Favicon', 'tie' ),
								"id"	=> "favicon",
								"type"	=> "upload"));
				?>
			</div>	
			<div class="tiepanel-item">
				<h3><?php _e( 'Custom Gravatar', 'tie' ) ?></h3>
				<?php
					tie_options(
						array(	"name"	=> __( 'Custom Gravatar', 'tie' ),
								"id"	=> "gravatar",
								"type"	=> "upload"));
				?>
			</div>	
			<div class="tiepanel-item">
				<h3><?php _e( 'Apple Icons', 'tie' ) ?></h3>
				<?php
					tie_options(
						array(	"name"			=> __( 'Apple iPhone Icon', 'tie' ),
								"id"			=> "apple_iphone",
								"type"			=> "upload",
								"extra_text"	=> __( 'Icon for Apple iPhone (57px x 57px)', 'tie' ) )); 			

					tie_options(
						array(	"name"			=> __( 'Apple iPhone Retina Icon', 'tie' ),
								"id"			=> "apple_iphone_retina",
								"type"			=> "upload",
								"extra_text"	=> __( 'Icon for Apple iPhone Retina Version (120px x 120px)', 'tie' ) )); 			

					tie_options(
						array(	"name"			=> __( 'Apple iPad Icon', 'tie' ),
								"id"			=> "apple_iPad",
								"type"			=> "upload",
								"extra_text"	=> __( 'Icon for Apple iPhone (72px x 72px)', 'tie' ) )); 			

					tie_options(
						array(	"name"			=> __( 'Apple iPad Retina Icon', 'tie' ),
								"id"			=> "apple_iPad_retina",
								"type"			=> "upload",
								"extra_text"	=> __( 'Icon for Apple iPad Retina Version (144px x 144px)', 'tie' ) )); 			

				?>
			</div>	
			
			<div class="tiepanel-item">
				<h3><?php _e( 'Time format', 'tie' ) ?></h3>
				<?php
					tie_options(
						array( 	"name"		=> __( 'Time format for blog posts', 'tie' ),
								"id"		=> "time_format",
								"type"		=> "radio",
								"options"	=> array(	"traditional"	=> __( 'Traditional', 'tie' ) ,
														"modern"		=> __( 'Time Ago Format', 'tie' ),
														"none"			=> __( 'Disable all', 'tie' ) )));
				?>									
			</div>

			<div class="tiepanel-item">
				<h3><?php _e( 'Lightbox Settings', 'tie' ) ?></h3>
				<?php																
					tie_options(
						array(	"name"			=> __( 'Enable Lightbox Automatically', 'tie' ),
								"extra_text"	=> __( 'Enable Lightbox automatically for all images linked to an image file in the post content area', 'tie' ),
								"id"			=> "lightbox_all",
								"type"			=> "checkbox"));	
								
					tie_options(
						array(	"name"			=> __( 'Enable Lightbox for WordPress Galleries', 'tie' ),
								"extra_text"	=> __( 'Enable Lightbox automatically for all images added via [gallery] shortcode in the content area', 'tie' ),
								"id"			=> "lightbox_gallery",
								"type"			=> "checkbox"));
								
					tie_options(
						array(	"name"			=> __( 'Lightbox Skin', 'tie' ),
								"id"			=> "lightbox_skin",
								"type"			=> "select",
								"options"		=> array(
													'dark'			=> 'dark',
													'light'			=> 'light',
													'smooth'		=> 'smooth',
													'metro-black'	=> 'metro-black',
													'metro-white'	=> 'metro-white',
													'mac'			=> 'mac')));
								
					tie_options(
						array( 	"name"			=> __( 'Lightbox Thumbnail Position', 'tie' ),
								"id"			=> "lightbox_thumbs",
								"type"			=> "radio",
								"options"		=> array(	"vertical"		=> __( 'Vertical', 'tie' ) ,
															"horizontal"	=> __( 'Horizontal', 'tie' ) )));
													
					tie_options(
						array(	"name"			=> __( 'Show Lightbox Arrows', 'tie' ),
								"id"			=> "lightbox_arrows",
								"type" 			=> "checkbox"));	
				?>									
			</div>	
			

				
			<div class="tiepanel-item">
				<h3><?php _e( 'Breadcrumbs Settings', 'tie' ) ?></h3>
				<?php
					tie_options(
						array(	"name"	=> __( 'Breadcrumbs', 'tie' ),
								"id"	=> "breadcrumbs",
								"type"	=> "checkbox")); 
					
					tie_options(
						array(	"name"	=> __( 'Breadcrumbs Delimiter', 'tie' ),
								"id"	=> "breadcrumbs_delimiter",
								"type"	=> "short-text"));
				?>
			</div>
						
			<div class="tiepanel-item">
				<h3><?php _e( 'Header Code', 'tie' ) ?></h3>
				<div class="option-item">
					<small><?php _e( 'The following code will add to the &lt;head&gt; tag. Useful if you need to add additional codes such as CSS or JS.', 'tie' ) ?></small>
					<textarea id="header_code" name="tie_options[header_code]" style="width:100%" rows="7"><?php echo htmlspecialchars_decode(tie_get_option('header_code'));  ?></textarea>				
				</div>
			</div>
			
			<div class="tiepanel-item">
				<h3><?php _e( 'Footer Code', 'tie' ) ?></h3>
				<div class="option-item">
					<small><?php _e( 'The following code will add to the footer before the closing  &lt;/body&gt; tag. Useful if you need to add Javascript or tracking code.', 'tie' ) ?></small>
					<textarea id="footer_code" name="tie_options[footer_code]" style="width:100%" rows="7"><?php echo htmlspecialchars_decode(tie_get_option('footer_code'));  ?></textarea>				
				</div>
			</div>	
			
		</div>
		
		<div id="tab9" class="tabs-wrap">
			<h2><?php _e( 'Header Settings', 'tie' ) ?></h2> <?php echo $save ?>
			
			<div class="tiepanel-item">
				<h3><?php _e( 'Logo', 'tie' ) ?></h3>
				<?php
					tie_options(
						array( 	"name"		=> __( 'Logo Settings', 'tie' ),
								"id"		=> "logo_setting",
								"type"		=> "radio",
								"options"	=> array(	"logo"	=> __( 'Custom Image Logo', 'tie' ) ,
														"title"	=> __( 'Display Site Title', 'tie' ) )));

					tie_options(
						array(	"name"			=> __( 'Logo Image', 'tie' ),
								"id"			=> "logo",
								"help"			=> __( 'Upload a logo image, or enter URL to an image if it is already uploaded. the theme default logo gets applied if the input field is left blank.', 'tie' ),
								"type"			=> "upload",
								"extra_text"	=> __( 'Recommended size (MAX) : 190px x 60px', 'tie' ) )); 
								
					tie_options(
						array(	"name"			=> __( 'Logo Image (Retina Version @2x)', 'tie' ),
								"id"			=> "logo_retina",
								"type"			=> "upload",
								"extra_text"	=> __( 'Please choose an image file for the retina version of the logo. It should be 2x the size of main logo.', 'tie' ) )); 			
					
					tie_options(
						array(	"name"			=> __( 'Standard Logo Width for Retina Logo', 'tie' ),
								"id"			=> "logo_retina_width",
								"type"			=> "short-text",
								"extra_text"	=> __( 'If retina logo is uploaded, please enter the standard logo (1x) version width, do not enter the retina logo width.', 'tie' ) )); 			

					tie_options(
						array(	"name"			=> __( 'Standard Logo Height for Retina Logo', 'tie' ),
								"id"			=> "logo_retina_height",
								"type"			=> "short-text",
								"extra_text"	=> __( 'If retina logo is uploaded, please enter the standard logo (1x) version height, do not enter the retina logo height.', 'tie' ) )); 			
								
					tie_options(
						array(	"name"	=> __( 'Logo Margin Top', 'tie' ),
								"id"	=> "logo_margin",
								"type"	=> "slider",
								"help"	=> __( 'Input number to set the top space of the logo.', 'tie' ),
								"unit"	=> "px",
								"max"	=> 100,
								"min"	=> 0 ));
								
					tie_options(
						array(	"name"	=> __( 'Logo Margin Bottom', 'tie' ),
								"id"	=> "logo_margin_bottom",
								"type"	=> "slider",
								"help"	=> __( 'Input number to set the bottom space of the logo.', 'tie' ),
								"unit"	=> "px",
								"max"	=> 100,
								"min"	=> 0 ));

					tie_options(
						array(	"name"		=> __( 'Full Width Logo', 'tie' ),
								"id"		=> "full_logo",
								"type"		=> "checkbox",
								"extra_text"	=> __( 'Recommended logo width : 1045px', 'tie' ) )); 

					tie_options(
						array(	"name"	=> __( 'Center the Logo', 'tie' ),
								"id"	=> "center_logo",
								"type"	=> "checkbox")); 			
				?>

			</div>
			

			<div class="tiepanel-item">
				<h3><?php _e( 'Header Top area Settings', 'tie' ) ?></h3>
				<?php
					tie_options(
						array(	"name"	=> __( 'Top menu', 'tie' ),
								"id"	=> "top_menu",
								"type"	=> "checkbox"));

					tie_options(
						array(	"name"	=> __( "Today's Date", 'tie' ),
								"id"	=> "top_date",
								"type"	=> "checkbox"));

					tie_options(
						array(	"name"			=> __( "Today's Date Format", 'tie' ),
								"id"			=> "todaydate_format",
								"type"			=> "text",
								"extra_text"	=> '<a target="_blank" href="http://codex.wordpress.org/Formatting_Date_and_Time">'.__( 'Documentation on date and time formatting' , 'tie' ).'</a>')); 			
																		
					tie_options(		
						array(	"name"	=> __( 'Search', 'tie' ),
								"id"	=> "top_search",
								"type"	=> "checkbox"));
								
					tie_options(		
						array(	"name"	=> __( 'Live Search', 'tie' ),
								"id"	=> "live_search",
								"type"	=> "checkbox"));	
								
					tie_options(		
						array(	"name"	=> __( 'Social Icons', 'tie' ),
								"id"	=> "top_social",
								"type"	=> "checkbox"));			
				?>		
			</div>
			
			
			<div class="tiepanel-item">
				<h3><?php _e( 'Main Nav Settings', 'tie' ) ?></h3>
				<?php
					tie_options(
						array(	"name"	=> __( 'Main Nav', 'tie' ),
								"id"	=> "main_nav",
								"type"	=> "checkbox"));	
																			
					tie_options(
						array(	"name"	=> __( 'Random Article Button', 'tie' ),
								"id"	=> "random_article",
								"type"	=> "checkbox"));
								
				if (class_exists('Woocommerce'))
					tie_options(
						array(	"name"	=> __( 'Shopping Cart', 'tie' ),
								"id"	=> "shopping_cart",
								"type"	=> "checkbox"));

					tie_options(
						array(	"name"	=> __( 'Stick The Navigation menu', 'tie' ),
								"id"	=> "stick_nav",
								"type"	=> "checkbox")); 

					tie_options(
						array(	"name"	=> __( 'Logo in the sticky Navigation menu', 'tie' ),
								"id"	=> "nav_logo",
								"type"	=> "upload" )); 			
													
				?>		
			</div>			
			
			
			<div class="tiepanel-item">
				<h3><?php _e( 'Responsive Mobile Menu Settings', 'tie' ) ?></h3>
				<?php
					tie_options(
						array(	"name"	=> __( 'Enable the Mobile Menu', 'tie' ),
								"id"	=> "mobile_menu_active",
								"type"	=> "checkbox"));	
					
					tie_options(
						array(	"name"	=> __( 'Search', 'tie' ),
								"id"	=> "mobile_menu_search",
								"type"	=> "checkbox")); 

					tie_options(
						array(	"name"	=> __( 'Social Icons', 'tie' ),
								"id"	=> "mobile_menu_social",
								"type"	=> "checkbox" ));
								
					tie_options(
						array(	"name"	=> __( 'Show the Top Menu items in the Mobile Menu below the Main Menu items ?', 'tie' ),
								"id"	=> "mobile_menu_top",
								"type"	=> "checkbox" ));
								
					tie_options(
						array(	"name"	=> __( 'Enable Mobile Menu Items Icons', 'tie' ),
								"id"	=> "mobile_menu_hide_icons",
								"type"	=> "checkbox" ));
		
													
				?>		
			</div>
			

			<div class="tiepanel-item">
				<h3><?php _e( 'Breaking News', 'tie' ) ?></h3>
				<?php
					tie_options(
						array(	"name"	=> __( 'Enable', 'tie' ),
								"id"	=> "breaking_news",
								"type"	=> "checkbox"));

					tie_options(
						array(	"name"	=> __( 'Show in Homepage Only', 'tie' ),
								"id"	=> "breaking_home",
								"type"	=> "checkbox")); 
																												
					tie_options(
						array(	"name"		=> __( 'Animation Effect', 'tie' ),
								"id"		=> "breaking_effect",
								"type"		=> "select",
								"options"	=> array(
												'fade'	=> __( 'Fade', 'tie' ),
												'slide'	=> __( 'Slide', 'tie' ),
												'ticker'=> __( 'Ticker', 'tie' ))));
								
					tie_options(
						array(	"name"	=> __( 'Animation Speed', 'tie' ),
								"id"	=> "breaking_speed",
								"type"	=> "slider",
								"unit"	=> "ms",
								"max"	=> 40000,
								"min"	=> 100 ));

								
					tie_options(
						array(	"name"	=> __( 'Time between the fades', 'tie' ),
								"id"	=> "breaking_time",
								"type"	=> "slider",
								"unit"	=> "ms",
								"max"	=> 40000,
								"min"	=> 100 ));
				
			
					tie_options(
						array(	"name"		=> __( 'Breaking News Query Type', 'tie' ),
								"id"		=> "breaking_type",
								"type"		=> "radio",
								"options"	=> array(	"category"	=>	__( 'Categories', 'tie' ) ,
														"tag"		=>	__( 'Tags', 'tie' ),
														"custom"	=>	__( 'Custom Text', 'tie' )))); 
															
					
					tie_options(
						array(	"name"	=> __( 'Number of posts to show', 'tie' ),
								"id"	=> "breaking_number",
								"type"	=> "short-text"));
								
					tie_options(
						array(	"name"	=> __( 'Breaking News Tags', 'tie' ),
								"help"	=> __( 'Enter a tag name, or names separated by comma.', 'tie' ),
								"id"	=> "breaking_tag",
								"type"	=> "text"));
								
				?>

					<div class="option-item" id="breaking_cat-item">
						<span class="label"><?php _e( 'Breaking News Categories', 'tie' ) ?>
						<br /><small><?php _e( 'Hold CTRL while selecting to select multiple categories.', 'tie' ) ?></small>
						</span>
							<select multiple="multiple" name="tie_options[breaking_cat][]" id="tie_breaking_cat">
							<?php foreach ($categories as $key => $option) { ?>
								<option value="<?php echo $key ?>" <?php if ( @in_array( $key , tie_get_option('breaking_cat') ) ) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
							<?php } ?>
						</select>
					</div>
		
			</div>
			
			<div class="tiepanel-item" id="breaking_custom-item">
				<h3><?php _e( 'Breaking News Custom Text', 'tie' ) ?></h3>
					<div class="option-item" >
					
						<span class="label" style="width:40px"><?php _e( 'Text', 'tie' ) ?></span>
						<input id="custom_text" type="text" size="56" style="direction:ltr; text-laign:left; width:200px; float:left" name="custom_text" value="" />
						<span class="label" style="width:40px; margin-left:10px;"><?php _e( 'Link', 'tie' ) ?></span>
						<input id="custom_link" type="text" size="56" style="direction:ltr; text-laign:left; width:200px; float:left" name="custom_link" value="" />
						<input id="TextAdd"  class="button" type="button" value="Add" />
							
						<ul id="customList" style="margin-top:15px;">
						<?php $breaking_custom = tie_get_option( 'breaking_custom' ) ;
							$custom_count = 0 ;
							if($breaking_custom){
								foreach ($breaking_custom as $custom_text) { $custom_count++; ?>
							<li>
								<div class="widget-head">
									<a href="<?php echo $custom_text['link'] ?>" target="_blank"><?php echo $custom_text['text'] ?></a>
									<input name="tie_options[breaking_custom][<?php echo $custom_count ?>][link]" type="hidden" value="<?php echo $custom_text['link'] ?>" />
									<input name="tie_options[breaking_custom][<?php echo $custom_count ?>][text]" type="hidden" value="<?php echo $custom_text['text'] ?>" />
									<a class="del-custom-text"></a></div>
							</li>
								<?php }
							}
						?>
						</ul>
						<script>
							var customnext = <?php echo $custom_count+1 ?> ;
						</script>
					</div>	
				</div>
		</div> <!-- Header Settings -->
			
		
		<div id="tab4" class="tabs-wrap">
			<h2><?php _e( 'Social Networking', 'tie' ) ?></h2> <?php echo $save ?>

			<div class="tiepanel-item">
				<h3><?php _e( 'Custom Feed URL', 'tie' ) ?></h3>
							
				<?php
					tie_options(
						array(	"name"	=> __( 'RSS Icon', 'tie' ),
								"id"	=> "rss_icon",
								"type"	=> "checkbox"));
								
					tie_options(
						array(	"name"	=> __( 'Custom Feed URL', 'tie' ),
								"id"	=> "rss_url",
								"help"	=> "e.g. http://feedburner.com/userid",
								"type"	=> "text"));
				?>
			</div>
			
			<div class="tiepanel-item">
				<h3><?php _e( 'Social Networking', 'tie' ) ?></h3>					
				<?php						
					tie_options(
						array(	"name"	=> __( 'Facebook URL', 'tie' ),
								"id"	=> "social",
								"key"	=> "facebook",
								"type"	=> "arrayText"));
					tie_options(
						array(	"name"	=> __( 'Twitter URL', 'tie' ),
								"id"	=> "social",
								"key"	=> "twitter",
								"type"	=> "arrayText"));
					tie_options(
						array(	"name"	=> __( 'Google+ URL', 'tie' ),
								"id"	=> "social",
								"key"	=> "google_plus",
								"type"	=> "arrayText"));

					tie_options(
						array(	"name"	=> __( 'Dribbble URL', 'tie' ),
								"id"	=> "social",
								"key"	=> "dribbble",
								"type"	=> "arrayText"));
								
					tie_options(
						array(	"name"	=> __( 'LinkedIn URL', 'tie' ),
								"id"	=> "social",
								"key"	=> "linkedin",
								"type"	=> "arrayText"));
								
					tie_options(
						array(	"name"	=> __( 'Evernote URL', 'tie' ),
								"id"	=> "social",
								"key"	=> "evernote",
								"type"	=> "arrayText"));
								
					tie_options(
						array(	"name"	=> __( 'Dropbox URL', 'tie' ),
								"id"	=> "social",
								"key"	=> "dropbox",
								"type"	=> "arrayText"));
								
					tie_options(
						array(	"name"	=> __( 'Flickr URL', 'tie' ),
								"id"	=> "social",
								"key"	=> "flickr",
								"type"	=> "arrayText"));
								
					tie_options(
						array(	"name"	=> __( 'Picasa Web URL', 'tie' ),
								"id"	=> "social",
								"key"	=> "picasa",
								"type"	=> "arrayText"));
								
					tie_options(
						array(	"name"	=> __( 'DeviantArt URL', 'tie' ),
								"id"	=> "social",
								"key"	=> "deviantart",
								"type"	=> "arrayText"));
								
					tie_options(
						array(	"name"	=> __( 'YouTube URL', 'tie' ),
								"id"	=> "social",
								"key"	=> "youtube",
								"type"	=> "arrayText"));
								
					tie_options(
						array(	"name"	=> __( 'Grooveshark URL', 'tie' ),
								"id"	=> "social",
								"key"	=> "grooveshark",
								"type"	=> "arrayText"));
								
					tie_options(
						array(	"name"	=> __( 'Vimeo URL', 'tie' ),
								"id"	=> "social",
								"key"	=> "vimeo",
								"type"	=> "arrayText"));
								
					tie_options(
						array(	"name"	=> __( 'ShareThis URL', 'tie' ),
								"id"	=> "social",
								"key"	=> "sharethis",
								"type"	=> "arrayText"));
								
					tie_options(
						array(	"name"	=> __( '500px URL', 'tie' ),
								"id"	=> "social",
								"key"	=> "px500",
								"type"	=> "arrayText"));
								
					tie_options(
						array(	"name"	=> __( 'Skype URL', 'tie' ),
								"id"	=> "social",
								"key"	=> "skype",
								"type"	=> "arrayText"));
								
					tie_options(
						array(	"name"	=> __( 'Digg URL', 'tie' ),
								"id"	=> "social",
								"key"	=> "digg",
								"type"	=> "arrayText"));
								
					tie_options(
						array(	"name"	=> __( 'Reddit URL', 'tie' ),
								"id"	=> "social",
								"key"	=> "reddit",
								"type"	=> "arrayText"));
								
					tie_options(
						array(	"name"	=> __( 'Delicious URL', 'tie' ),
								"id"	=> "social",
								"key"	=> "delicious",
								"type"	=> "arrayText"));
								
					tie_options(
						array(	"name"	=> __( 'StumbleUpon  URL', 'tie' ),
								"key"	=> "stumbleupon",
								"id"	=> "social",
								"type"	=> "arrayText"));
								
					tie_options(
						array(	"name"	=> __( 'Tumblr URL', 'tie' ),
								"id"	=> "social",
								"key"	=> "tumblr",
								"type"	=> "arrayText"));
								
					tie_options(
						array(	"name"	=> __( 'Blogger URL', 'tie' ),
								"id"	=> "social",
								"key"	=> "blogger",
								"type"	=> "arrayText"));
								
					tie_options(
						array(	"name"	=> __( 'WordPress URL', 'tie' ),
								"id"	=> "social",
								"key"	=> "wordpress",
								"type"	=> "arrayText"));
								
					tie_options(
						array(	"name"	=> __( 'Yelp URL', 'tie' ),
								"id"	=> "social",
								"key"	=> "yelp",
								"type"	=> "arrayText"));							
																					
					tie_options(
						array(	"name"	=> __( 'Last.fm URL', 'tie' ),
								"id"	=> "social",
								"key"	=> "lastfm",
								"type"	=> "arrayText"));
								
					tie_options(
						array(	"name"	=> __( 'Apple URL', 'tie' ),
								"id"	=> "social",
								"key"	=> "apple",
								"type"	=> "arrayText"));
								
					tie_options(
						array(	"name"	=> __( 'FourSquare URL', 'tie' ),
								"id"	=> "social",
								"key"	=> "foursquare",
								"type"	=> "arrayText"));
								
					tie_options(
						array(	"name"	=> __( 'Github URL', 'tie' ),
								"id"	=> "social",
								"key"	=> "github",
								"type"	=> "arrayText"));

					tie_options(
						array(	"name"	=> __( 'SoundCloud URL', 'tie' ),
								"id"	=> "social",
								"key"	=> "soundcloud",
								"type"	=> "arrayText"));
								
					tie_options(
						array(	"name"	=> __( 'XING URL', 'tie' ),
								"id"	=> "social",
								"key"	=> "xing",
								"type"	=> "arrayText"));
								
					tie_options(
						array(	"name"	=> __( 'Google Play URL', 'tie' ),
								"id"	=> "social",
								"key"	=> "google_play",
								"type"	=> "arrayText"));
								
					tie_options(
						array(	"name"	=> __( 'Pinterest URL', 'tie' ),
								"id"	=> "social",
								"key"	=> "Pinterest",
								"type"	=> "arrayText"));
								
					tie_options(
						array(	"name"	=> __( 'Instagram URL', 'tie' ),
								"id"	=> "social",
								"key"	=> "instagram",
								"type"	=> "arrayText"));
								
					tie_options(
						array(	"name"	=> __( 'Spotify URL', 'tie' ),
								"id"	=> "social",
								"key"	=> "spotify",
								"type"	=> "arrayText"));
								
					tie_options(
						array(	"name"	=> __( 'PayPal URL', 'tie' ),
								"id"	=> "social",
								"key"	=> "paypal",
								"type"	=> "arrayText"));
								
					tie_options(
						array(	"name"	=> __( 'Forrst URL', 'tie' ),
								"id"	=> "social",
								"key"	=> "forrst",
								"type"	=> "arrayText"));
								
					tie_options(
						array(	"name"	=> __( 'Behance URL', 'tie' ),
								"id"	=> "social",
								"key"	=> "behance",
								"type"	=> "arrayText"));
								
					tie_options(
						array(	"name"	=> __( 'Viadeo URL', 'tie' ),
								"id"	=> "social",
								"key"	=> "viadeo",
								"type"	=> "arrayText"));
								
					tie_options(
						array(	"name"	=> __( 'VK.com URL', 'tie' ),
								"id"	=> "social",
								"key"	=> "vk",
								"type"	=> "arrayText"));
				?>
			</div>	

			<div class="tiepanel-item">
				<h3><?php _e( 'Custom Social Network', 'tie' ) ?> #1</h3>				
					<?php
						tie_options(
							array(	"name"	=> __( 'Title', 'tie' ),
									"id"	=> "custom_social_title_1",
									"type"	=> "text"));	

						tie_options(
							array(	"name"	=> __( 'Icon (use full Font Awesome name)', 'tie' ),
									"id"	=> "custom_social_icon_1",
									"type"	=> "text"));
									
						tie_options(
							array(	"name"	=> __( 'URL', 'tie' ),
									"id"	=> "custom_social_url_1",
									"type"	=> "text"));
									
						tie_options(
							array(	"name"	=> __( 'Color', 'tie' ),
									"id"	=> "custom_social_color_1",
									"type"	=> "color"));
					?>
			</div>
			
			<div class="tiepanel-item">
				<h3><?php _e( 'Custom Social Network', 'tie' ) ?> #2</h3>				
					<?php
						tie_options(
							array(	"name"	=> __( 'Title', 'tie' ),
									"id"	=> "custom_social_title_2",
									"type"	=> "text"));	

						tie_options(
							array(	"name"	=> __( 'Icon (use full Font Awesome name)', 'tie' ),
									"id"	=> "custom_social_icon_2",
									"type"	=> "text"));
									
						tie_options(
							array(	"name"	=> __( 'URL', 'tie' ),
									"id"	=> "custom_social_url_2",
									"type"	=> "text"));
									
						tie_options(
							array(	"name"	=> __( 'Color', 'tie' ),
									"id"	=> "custom_social_color_2",
									"type"	=> "color"));
					?>
			</div>
			
			<div class="tiepanel-item">
				<h3><?php _e( 'Custom Social Network', 'tie' ) ?> #3</h3>				
					<?php
						tie_options(
							array(	"name"	=> __( 'Title', 'tie' ),
									"id"	=> "custom_social_title_3",
									"type"	=> "text"));	

						tie_options(
							array(	"name"	=> __( 'Icon (use full Font Awesome name)', 'tie' ),
									"id"	=> "custom_social_icon_3",
									"type"	=> "text"));
									
						tie_options(
							array(	"name"	=> __( 'URL', 'tie' ),
									"id"	=> "custom_social_url_3",
									"type"	=> "text"));
									
						tie_options(
							array(	"name"	=> __( 'Color', 'tie' ),
									"id"	=> "custom_social_color_3",
									"type"	=> "color"));
					?>
			</div>
			
			<div class="tiepanel-item">
				<h3><?php _e( 'Custom Social Network', 'tie' ) ?> #4</h3>				
					<?php
						tie_options(
							array(	"name"	=> __( 'Title', 'tie' ),
									"id"	=> "custom_social_title_4",
									"type"	=> "text"));	

						tie_options(
							array(	"name"	=> __( 'Icon (use full Font Awesome name)', 'tie' ),
									"id"	=> "custom_social_icon_4",
									"type"	=> "text"));
									
						tie_options(
							array(	"name"	=> __( 'URL', 'tie' ),
									"id"	=> "custom_social_url_4",
									"type"	=> "text"));
									
						tie_options(
							array(	"name"	=> __( 'Color', 'tie' ),
									"id"	=> "custom_social_color_4",
									"type"	=> "color"));
					?>
			</div>
			
			<div class="tiepanel-item">
				<h3><?php _e( 'Custom Social Network', 'tie' ) ?> #5</h3>				
					<?php
						tie_options(
							array(	"name"	=> __( 'Title', 'tie' ),
									"id"	=> "custom_social_title_5",
									"type"	=> "text"));	

						tie_options(
							array(	"name"	=> __( 'Icon (use full Font Awesome name)', 'tie' ),
									"id"	=> "custom_social_icon_5",
									"type"	=> "text"));
									
						tie_options(
							array(	"name"	=> __( 'URL', 'tie' ),
									"id"	=> "custom_social_url_5",
									"type"	=> "text"));
									
						tie_options(
							array(	"name"	=> __( 'Color', 'tie' ),
									"id"	=> "custom_social_color_5",
									"type"	=> "color"));
					?>
			</div>
		
		</div><!-- Social Networking -->
		
	
		<div id="tab6" class="tab_content tabs-wrap">
			<h2><?php _e( 'Posts Settings', 'tie' ) ?></h2> <?php echo $save ?>
					
			<div class="tiepanel-item">
				<h3><?php _e( 'Posts Settings', 'tie' ) ?></h3>
				<?php

					tie_options(
						array(	"name"	=> __( 'Show Featured Image By Default', 'tie' ),
								"id"	=> "post_featured",
								"type"	=> "checkbox"));

					tie_options(
						array(	"name"	=> __( 'Post Author Box', 'tie' ),
								"id"	=> "post_authorbio",
								"type"	=> "checkbox"));

					tie_options(
						array(	"name"	=> __( 'Next/Prev Articles', 'tie' ),
								"id"	=> "post_nav",
								"type"	=> "checkbox")); 

					tie_options(
						array(	"name"	=> __( 'OG Meta', 'tie' ),
								"id"	=> "post_og_cards",
								"type"	=> "checkbox")); 
 
					tie_options(
						array(	"name"	=> __( 'Reading Position Indicator', 'tie' ),
								"id"	=> "reading_indicator",
								"type"	=> "checkbox"));
				?>
			</div>
			
			<div class="tiepanel-item">

				<h3><?php _e( 'Post Meta Settings', 'tie' ) ?></h3>
				<?php
					tie_options(
						array(	"name"	=> __( 'Post Meta', 'tie' ),
								"id"	=> "post_meta",
								"type"	=> "checkbox"));

					tie_options(
						array(	"name"	=> __( 'Author Meta', 'tie' ),
								"id"	=> "post_author",
								"type"	=> "checkbox"));

					tie_options(
						array(	"name"	=> __( 'Date Meta', 'tie' ),
								"id"	=> "post_date",
								"type"	=> "checkbox"));

					tie_options(
						array(	"name"	=> __( 'Categories Meta', 'tie' ),
								"id"	=> "post_cats",
								"type"	=> "checkbox"));

					tie_options(
						array(	"name"	=> __( 'Comments Meta', 'tie' ),
								"id"	=> "post_comments",
								"type"	=> "checkbox"));

					tie_options(
						array(	"name"	=> __( 'Tags Meta', 'tie' ),
								"id"	=> "post_tags",
								"type"	=> "checkbox"));
					
					tie_options(
						array(	"name"	=> __( 'Views Meta', 'tie' ),
								"id"	=> "post_views",
								"type"	=> "checkbox"));

								
				?>	
			</div>

				
			<div class="tiepanel-item">

				<h3><?php _e( 'Share Post Settings', 'tie' ) ?></h3>
				<?php
					tie_options(
						array(	"name"	=> __( 'Bottom Share Post Buttons', 'tie' ),
								"id"	=> "share_post",
								"type"	=> "checkbox"));

					tie_options(
						array(	"name"	=> __( 'Top Share Post Buttons', 'tie' ),
								"id"	=> "share_post_top",
								"type"	=> "checkbox"));
								
					tie_options(
						array(	"name"	=> __( 'Share Buttons for Pages', 'tie' ),
								"id"	=> "share_buttons_pages",
								"type"	=> "checkbox"));
					
					tie_options(
						array(	"name"		=> __( 'Share Buttons type', 'tie' ),
								"id"		=> "share_post_type",
								"type"		=> "radio",
								"options"	=> array(	"counters"	=> __( 'Buttons with counters', 'tie' ) ,
														"flat"	=> __( 'Flat Buttons', 'tie' ) ))); 
								
					tie_options(
						array(	"name"	=> __( "Use the post's Short Link", 'tie' ),
								"id"	=> "share_shortlink",
								"type"	=> "checkbox"));

					tie_options(
						array(	"name"	=> __( 'Tweet Button', 'tie' ),
								"id"	=> "share_tweet",
								"type"	=> "checkbox"));
								
					tie_options(
						array(	"name"	=> __( 'Twitter Username <small>(optional)</small>', 'tie' ),
								"id"	=> "share_twitter_username",
								"type"	=> "text"));
						
					tie_options(
						array(	"name"	=> __( 'Facebook Like Button', 'tie' ),
								"id"	=> "share_facebook",
								"type"	=> "checkbox"));
								
					tie_options(
						array(	"name"	=> __( 'Google+ Button', 'tie' ),
								"id"	=> "share_google",
								"type"	=> "checkbox"));
													
					tie_options(
						array(	"name"	=> __( 'LinkedIn Button', 'tie' ),
								"id"	=> "share_linkdin",
								"type"	=> "checkbox"));
																					
					tie_options(
						array(	"name"	=> __( 'StumbleUpon Button', 'tie' ),
								"id"	=> "share_stumble",
								"type"	=> "checkbox"));
								
																			
					tie_options(
						array(	"name"	=> __( 'Pinterest Button', 'tie' ),
								"id"	=> "share_pinterest",
								"type"	=> "checkbox"));
								
				?>	
			</div>

				
			<div class="tiepanel-item">

				<h3><?php _e( 'Related Posts Settings', 'tie' ) ?></h3>
				<?php
					tie_options(
						array(	"name"	=> __( 'Related Posts', 'tie' ),
								"id"	=> "related",
								"type"	=> "checkbox"));
								
					tie_options(
						array(	"name"		=> __( 'Related Posts Position', 'tie' ),
								"id"		=> "related_position",
								"type"		=> "radio",
								"options"	=> array(	"in"	=> __( 'In the post content area', 'tie' ) ,
														"below"	=> __( 'Below the post area', 'tie' ) ))); 
																
					tie_options(
						array(	"name"	=> __( 'Number of posts to show', 'tie' ),
								"id"	=> "related_number",
								"type"	=> "short-text"));	
								
					tie_options(
						array(	"name"	=> __( 'Number of posts to show in Full width pages', 'tie' ),
								"id"	=> "related_number_full",
								"type"	=> "short-text"));
								
					tie_options(
						array(	"name"		=> __( 'Query Type', 'tie' ),
								"id"		=> "related_query",
								"type"		=> "radio",
								"options"	=> array(	"category"	=> __( 'Posts in the same Categories', 'tie' ) ,
														"tag"		=> __( 'Posts in the same Tags', 'tie' ),
														"author"	=> __( 'Posts by the same Author', 'tie' ) ))); 
				?>
			</div>	

			
			<div class="tiepanel-item">

				<h3><?php _e( 'Fly Check Also Box', 'tie' ) ?></h3>
				<?php
					tie_options(
						array(	"name"	=> __( 'Check Also Box', 'tie' ),
								"id"	=> "check_also",
								"type"	=> "checkbox"));
								
					tie_options(
						array(	"name"		=> __( 'Check Also Box Position', 'tie' ),
								"id"		=> "check_also_position",
								"type"		=> "radio",
								"options"	=> array(	"right"	=> __( 'Right', 'tie' ) ,
														"left"	=> __( 'Left', 'tie' ) ))); 
																
					tie_options(
						array(	"name"	=> __( 'Number of posts to show', 'tie' ),
								"id"	=> "check_also_number",
								"type"	=> "short-text"));	

					tie_options(
						array(	"name"		=> __( 'Query Type', 'tie' ),
								"id"		=> "check_also_query",
								"type"		=> "radio",
								"options"	=> array(	"category"	=> __( 'Posts in the same Categories', 'tie' ) ,
														"tag"		=> __( 'Posts in the same Tags', 'tie' ),
														"author"	=> __( 'Posts by the same Author', 'tie' ) ))); 
				?>
			</div>

			
			<div class="tiepanel-item">

				<h3><?php _e( 'jQuery Comments Settings', 'tie' ) ?></h3>
				<?php
					tie_options(
						array(	"name"	=> __( 'Adding Comment Validation' , 'tie' ),
								"id"	=> "comment_validation",
								"type"	=> "checkbox"));
				?>
			</div>
		</div> <!-- Article Settings -->
		
		
		<div id="tab7" class="tabs-wrap">
			<h2><?php _e( 'Footer Settings', 'tie' ) ?></h2> <?php echo $save ?>

			<div class="tiepanel-item">

				<h3><?php _e( 'Footer Elements', 'tie' ) ?></h3>
				<?php
					tie_options(
						array(	"name"	=> __( 'Go To Top Button', 'tie' ),
								"id"	=> "footer_top",
								"type"	=> "checkbox"));

					tie_options(
						array(	"name"	=> __( 'Social Icons', 'tie' ),
								"id"	=> "footer_social",
								"type"	=> "checkbox")); 

				?>
			</div>
			
			<div class="tiepanel-item">
				<h3><?php _e( 'Footer Widgets layout', 'tie' ) ?></h3>
					<?php
						tie_options(
						array(	"name"	=> __( 'Footer Widgets', 'tie' ),
								"id"	=> "footer_widgets_enable",
								"type"	=> "checkbox"));

					?>
					<div class="option-item">
					<?php
						$tie_footer_widgets = tie_get_option('footer_widgets');
					?>
					<ul id="footer-widgets-options" class="tie-options">
						<li>
							<input id="tie_footer_widgets"  name="tie_options[footer_widgets]" type="radio" value="footer-1c" <?php if($tie_footer_widgets == 'footer-1c') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/footer-1c.png" /></a>
						</li>
						<li>
							<input id="tie_footer_widgets"  name="tie_options[footer_widgets]" type="radio" value="footer-2c" <?php if($tie_footer_widgets == 'footer-2c') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/footer-2c.png" /></a>
						</li>
						<li>
							<input id="tie_footer_widgets"  name="tie_options[footer_widgets]" type="radio" value="narrow-wide-2c" <?php if($tie_footer_widgets == 'narrow-wide-2c') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/footer-2c-narrow-wide.png" /></a>
						</li>
						<li>
							<input id="tie_footer_widgets"  name="tie_options[footer_widgets]" type="radio" value="wide-narrow-2c" <?php if($tie_footer_widgets == 'wide-narrow-2c') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/footer-2c-wide-narrow.png" /></a>
						</li>
						<li>
							<input id="tie_footer_widgets"  name="tie_options[footer_widgets]" type="radio" value="footer-3c" <?php if($tie_footer_widgets == 'footer-3c' || !$tie_footer_widgets ) echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/footer-3c.png" /></a>
						</li>
						<li>
							<input id="tie_footer_widgets"  name="tie_options[footer_widgets]" type="radio" value="wide-left-3c" <?php if($tie_footer_widgets == 'wide-left-3c') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/footer-3c-wide-left.png" /></a>
						</li>
						<li>
							<input id="tie_footer_widgets"  name="tie_options[footer_widgets]" type="radio" value="wide-right-3c" <?php if($tie_footer_widgets == 'wide-right-3c') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/footer-3c-wide-right.png" /></a>
						</li>
						<li>
							<input id="tie_footer_widgets"  name="tie_options[footer_widgets]" type="radio" value="footer-4c" <?php if($tie_footer_widgets == 'footer-4c') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/footer-4c.png" /></a>
						</li>
					</ul>
				</div>
			</div>
			
			<div class="tiepanel-item">
				<h3><?php _e( 'Footer Text One', 'tie' ) ?></h3>
				<div class="option-item">
					<textarea id="tie_footer_one" name="tie_options[footer_one]" style="width:100%" rows="4"><?php echo htmlspecialchars_decode(tie_get_option('footer_one'));  ?></textarea>				
					<span style="padding:0" class="extra-text"><strong style="font-size: 12px;"><?php _e( 'Variables', 'tie' ) ?></strong>
						<?php _e( 'These tags can be included in the textarea above and will be replaced when a page is displayed.', 'tie' ) ?>
						<br />
						<strong>%year%</strong> : <em><?php _e( 'Replaced with the current year.', 'tie' ) ?></em><br />
						<strong>%site%</strong> : <em><?php _e( "Replaced with The site's name.", 'tie' ) ?></em><br />
						<strong>%url%</strong>  : <em><?php _e( "Replaced with The site's URL.", 'tie' ) ?></em>
					</span>
				</div>
			</div>
			
			<div class="tiepanel-item">
				<h3><?php _e( 'Footer Text Two', 'tie' ) ?></h3>
				<div class="option-item">
					<textarea id="tie_footer_two" name="tie_options[footer_two]" style="width:100%" rows="4"><?php echo htmlspecialchars_decode(tie_get_option('footer_two'));  ?></textarea>				
					<span style="padding:0" class="extra-text"><strong style="font-size: 12px;"><?php _e( 'Variables', 'tie' ) ?></strong>
						<?php _e( 'These tags can be included in the textarea above and will be replaced when a page is displayed.', 'tie' ) ?>
						<br />
						<strong>%year%</strong> : <em><?php _e( 'Replaced with the current year.', 'tie' ) ?></em><br />
						<strong>%site%</strong> : <em><?php _e( "Replaced with The site's name.", 'tie' ) ?></em><br />
						<strong>%url%</strong>  : <em><?php _e( "Replaced with The site's URL.", 'tie' ) ?></em>
					</span>
				</div>
			</div>

		</div><!-- Footer Settings -->

		
		<div id="tab8" class="tab_content tabs-wrap">
			<h2><?php _e( 'Banners Settings', 'tie' ) ?></h2> <?php echo $save ?>
			<div class="tiepanel-item">
				<h3><?php _e( 'Background Image ADS', 'tie' ) ?></h3>
				<?php
					tie_options(				
						array(	"name"	=> __( 'Enable Background Image ADS', 'tie' ),
								"id"	=> "banner_bg",
								"type"	=> "checkbox")); 	
							
					tie_options(					
						array(	"name"	=> __( 'Background Image ADS Link', 'tie' ),
								"id"	=> "banner_bg_url",
								"type"	=> "text"));
				?>
				<p class="tie_message_hint">
					<?php _e( 'Go to Styling tab and set Background Type to Custom Background then upload your custom image and enable Full Screen Background option.', 'tie' ) ?>
				</p>
			</div>
			<div class="tiepanel-item">
				<h3><?php _e( 'Top Banner Area', 'tie' ) ?></h3>
				<?php
					tie_options(				
						array(	"name"	=> __( 'Top Banner', 'tie' ),
								"id"	=> "banner_top",
								"type"	=> "checkbox"));
				?>
				<div class="tie-accordion">
					<h4 class="accordion-head"><a href=""><?php _e( 'Image Ad', 'tie' ) ?></a></h4>
					<div class="tie-accordion-contnet">
				<?php
					tie_options(			
						array(	"name"	=> __( 'Top Banner Image', 'tie' ),
								"id"	=> "banner_top_img",
								"type"	=> "upload")); 
								
					tie_options(					
						array(	"name"	=> __( 'Top Banner Link', 'tie' ),
								"id"	=> "banner_top_url",
								"type"	=> "text")); 
								
					tie_options(				
						array(	"name"	=> __( 'Alternative Text For The image', 'tie' ),
								"id"	=> "banner_top_alt",
								"type"	=> "text"));
								
					tie_options(
						array(	"name"	=> __( 'Open The Link In a new Tab', 'tie' ),
								"id"	=> "banner_top_tab",
								"type"	=> "checkbox"));

					tie_options(
						array(	"name"	=> __( 'Nofollow', 'tie' ),
								"id"	=> "banner_top_nofollow",
								"type"	=> "checkbox"));
				?>
					</div>
					<h4 class="accordion-head"><a href=""><?php _e( 'Responsive Google AdSense', 'tie' ) ?></a></h4>
					<div class="tie-accordion-contnet">
				<?php
					tie_options(					
						array(	"name"	=> __( 'Publisher ID', 'tie' ),
								"id"	=> "banner_top_publisher",
								"type"	=> "text"));

					tie_options(					
						array(	"name"	=> __( '728x90 (Leaderboard) - ad ID', 'tie' ),
								"id"	=> "banner_top_728",
								"type"	=> "text"));
								
					tie_options(					
						array(	"name"	=> __( '468x60 (Banner) - ad ID', 'tie' ),
								"id"	=> "banner_top_468",
								"type"	=> "text"));
								
					tie_options(					
						array(	"name"	=> __( '300x250 (Medium Rectangle) - ad ID', 'tie' ),
								"id"	=> "banner_top_300",
								"type"	=> "text"));

				?>
					</div>
					<h4 class="accordion-head"><a href=""><?php _e( 'Custom Code', 'tie' ) ?></a></h4>
					<div class="tie-accordion-contnet">
				<?php
					tie_options(					
						array(	"name"			=> __( 'Custom Ad Code', 'tie' ),
								"id"			=> "banner_top_adsense",
								"extra_text"	=> __( 'Supports: Text, HTML and Shortcodes.', 'tie' ),
								"type"			=> "textarea")); 
				?>
					</div>
				</div>
			</div>

			<div class="tiepanel-item">
				<h3><?php _e( 'Bottom Banner Area', 'tie' ) ?></h3>
				<?php
					tie_options(				
						array(	"name"	=> __( 'Bottom Banner', 'tie' ),
								"id"	=> "banner_bottom",
								"type"	=> "checkbox")); 
				?>
				<div class="tie-accordion">
					<h4 class="accordion-head"><a href=""><?php _e( 'Image Ad', 'tie' ) ?></a></h4>
					<div class="tie-accordion-contnet">
				<?php
					tie_options(			
						array(	"name"	=> __( 'Bottom Banner Image', 'tie' ),
								"id"	=> "banner_bottom_img",
								"type"	=> "upload")); 
								
					tie_options(					
						array(	"name"	=> __( 'Bottom Banner Link', 'tie' ),
								"id"	=> "banner_bottom_url",
								"type"	=> "text")); 
								
					tie_options(				
						array(	"name"	=> __( 'Alternative Text For The image', 'tie' ),
								"id"	=> "banner_bottom_alt",
								"type"	=> "text"));
								
					tie_options(
						array(	"name"	=> __( 'Open The Link In a new Tab', 'tie' ),
								"id"	=> "banner_bottom_tab",
								"type"	=> "checkbox"));
						
					tie_options(
						array(	"name"	=> __( 'Nofollow', 'tie' ),
								"id"	=> "banner_bottom_nofollow",
								"type"	=> "checkbox"));
				?>
					</div>
					<h4 class="accordion-head"><a href=""><?php _e( 'Responsive Google AdSense', 'tie' ) ?></a></h4>
					<div class="tie-accordion-contnet">
				<?php
					tie_options(					
						array(	"name"	=> __( 'Publisher ID', 'tie' ),
								"id"	=> "banner_bottom_publisher",
								"type"	=> "text"));

					tie_options(					
						array(	"name"	=> __( '728x90 (Leaderboard) - ad ID', 'tie' ),
								"id"	=> "banner_bottom_728",
								"type"	=> "text"));
								
					tie_options(					
						array(	"name"	=> __( '468x60 (Banner) - ad ID', 'tie' ),
								"id"	=> "banner_bottom_468",
								"type"	=> "text"));
								
					tie_options(					
						array(	"name"	=> __( '300x250 (Medium Rectangle) - ad ID', 'tie' ),
								"id"	=> "banner_bottom_300",
								"type"	=> "text"));

				?>
					</div>
					<h4 class="accordion-head"><a href=""><?php _e( 'Custom Code', 'tie' ) ?></a></h4>
					<div class="tie-accordion-contnet">
				<?php
					tie_options(					
						array(	"name"			=> __( 'Custom Ad Code', 'tie' ),
								"id"			=> "banner_bottom_adsense",
								"extra_text"	=> __( 'Supports: Text, HTML and Shortcodes.', 'tie' ),
								"type"			=> "textarea")); 
				?>
					</div>
				</div>
			</div>
	
			<div class="tiepanel-item">
				<h3><?php _e( 'Below Header Banner Area', 'tie' ) ?></h3>
				<?php
					tie_options(				
						array(	"name"	=> __( 'Below Header Banner', 'tie' ),
								"id"	=> "banner_below_header",
								"type"	=> "checkbox")); 
				?>
				<div class="tie-accordion">
					<h4 class="accordion-head"><a href=""><?php _e( 'Image Ad', 'tie' ) ?></a></h4>
					<div class="tie-accordion-contnet">
				<?php
					tie_options(			
						array(	"name"	=> __( 'Bottom Banner Image', 'tie' ),
								"id"	=> "banner_below_header_img",
								"type"	=> "upload")); 
								
					tie_options(					
						array(	"name"	=> __( 'Bottom Banner Link', 'tie' ),
								"id"	=> "banner_below_header_url",
								"type"	=> "text")); 
								
					tie_options(				
						array(	"name"	=> __( 'Alternative Text For The image', 'tie' ),
								"id"	=> "banner_below_header_alt",
								"type"	=> "text"));
								
					tie_options(
						array(	"name"	=> __( 'Open The Link In a new Tab', 'tie' ),
								"id"	=> "banner_below_header_tab",
								"type"	=> "checkbox"));
						
					tie_options(
						array(	"name"	=> __( 'Nofollow', 'tie' ),
								"id"	=> "banner_below_header_nofollow",
								"type"	=> "checkbox"));
				?>
					</div>
					<h4 class="accordion-head"><a href=""><?php _e( 'Responsive Google AdSense', 'tie' ) ?></a></h4>
					<div class="tie-accordion-contnet">
				<?php
					tie_options(					
						array(	"name"	=> __( 'Publisher ID', 'tie' ),
								"id"	=> "banner_below_header_publisher",
								"type"	=> "text"));

					tie_options(					
						array(	"name"	=> __( '728x90 (Leaderboard) - ad ID', 'tie' ),
								"id"	=> "banner_below_header_728",
								"type"	=> "text"));
								
					tie_options(					
						array(	"name"	=> __( '468x60 (Banner) - ad ID', 'tie' ),
								"id"	=> "banner_below_header_468",
								"type"	=> "text"));
								
					tie_options(					
						array(	"name"	=> __( '300x250 (Medium Rectangle) - ad ID', 'tie' ),
								"id"	=> "banner_below_header_300",
								"type"	=> "text"));

				?>
					</div>
					<h4 class="accordion-head"><a href=""><?php _e( 'Custom Code', 'tie' ) ?></a></h4>
					<div class="tie-accordion-contnet">
				<?php
					tie_options(					
						array(	"name"			=> __( 'Custom Ad Code', 'tie' ),
								"id"			=> "banner_below_header_adsense",
								"extra_text"	=> __( 'Supports: Text, HTML and Shortcodes.', 'tie' ),
								"type"			=> "textarea")); 
				?>
					</div>
				</div>
			</div>
	
	
			<div class="tiepanel-item">
				<h3><?php _e( 'Above Article Banner Area', 'tie' ) ?></h3>
				<?php
					tie_options(				
						array(	"name"	=> __( 'Above Article Banner', 'tie' ),
								"id"	=> "banner_above",
								"type"	=> "checkbox")); 	
				?>
				<div class="tie-accordion">
					<h4 class="accordion-head"><a href=""><?php _e( 'Image Ad', 'tie' ) ?></a></h4>
					<div class="tie-accordion-contnet">
				<?php
					tie_options(			
						array(	"name"	=> __( 'Above Article Banner Image', 'tie' ),
								"id"	=> "banner_above_img",
								"type"	=> "upload")); 
								
					tie_options(					
						array(	"name"	=> __( 'Above Article Banner Link', 'tie' ),
								"id"	=> "banner_above_url",
								"type"	=> "text")); 
								
					tie_options(				
						array(	"name"	=> __( 'Alternative Text For The image', 'tie' ),
								"id"	=> "banner_above_alt",
								"type"	=> "text"));
								
					tie_options(
						array(	"name"	=> __( 'Open The Link In a new Tab', 'tie' ),
								"id"	=> "banner_above_tab",
								"type"	=> "checkbox"));
					
					tie_options(
						array(	"name"	=> __( 'Nofollow', 'tie' ),
								"id"	=> "banner_above_nofollow",
								"type"	=> "checkbox"));
				?>
					</div>
					<h4 class="accordion-head"><a href=""><?php _e( 'Responsive Google AdSense', 'tie' ) ?></a></h4>
					<div class="tie-accordion-contnet">
				<?php
					tie_options(					
						array(	"name"	=> __( 'Publisher ID', 'tie' ),
								"id"	=> "banner_above_publisher",
								"type"	=> "text"));
	
					tie_options(					
						array(	"name"	=> __( '468x60 (Banner) - ad ID', 'tie' ),
								"id"	=> "banner_above_468",
								"type"	=> "text"));
								
					tie_options(					
						array(	"name"	=> __( '300x250 (Medium Rectangle) - ad ID', 'tie' ),
								"id"	=> "banner_above_300",
								"type"	=> "text"));

				?>
					</div>
					<h4 class="accordion-head"><a href=""><?php _e( 'Custom Code', 'tie' ) ?></a></h4>
					<div class="tie-accordion-contnet">
				<?php
					tie_options(					
						array(	"name"			=> __( 'Custom Ad Code', 'tie' ),
								"id"			=> "banner_above_adsense",
								"extra_text"	=> __( 'Supports: Text, HTML and Shortcodes.', 'tie' ),
								"type"			=> "textarea")); 
				?>
					</div>
				</div>
			</div>
	
			
			<div class="tiepanel-item">
				<h3><?php _e( 'Below Article Banner Area', 'tie' ) ?></h3>
				<?php
					tie_options(				
						array(	"name"	=> __( 'Below Article Banner', 'tie' ),
								"id"	=> "banner_below",
								"type"	=> "checkbox")); 	
				?>
				<div class="tie-accordion">
					<h4 class="accordion-head"><a href=""><?php _e( 'Image Ad', 'tie' ) ?></a></h4>
					<div class="tie-accordion-contnet">
				<?php
					tie_options(			
						array(	"name"	=> __( 'Below Article Banner Image', 'tie' ),
								"id"	=> "banner_below_img",
								"type"	=> "upload")); 
								
					tie_options(					
						array(	"name"	=> __( 'Below Article Banner Link', 'tie' ),
								"id"	=> "banner_below_url",
								"type"	=> "text")); 
								
					tie_options(				
						array(	"name"	=> __( 'Alternative Text For The image', 'tie' ),
								"id"	=> "banner_below_alt",
								"type"	=> "text"));
								
					tie_options(
						array(	"name"	=> __( 'Open The Link In a new Tab', 'tie' ),
								"id"	=> "banner_below_tab",
								"type"	=> "checkbox"));
							
					tie_options(
						array(	"name"	=> __( 'Nofollow', 'tie' ),
								"id"	=> "banner_below_nofollow",
								"type"	=> "checkbox"));
				?>
					</div>
					<h4 class="accordion-head"><a href=""><?php _e( 'Responsive Google AdSense', 'tie' ) ?></a></h4>
					<div class="tie-accordion-contnet">
				<?php
					tie_options(					
						array(	"name"	=> __( 'Publisher ID', 'tie' ),
								"id"	=> "banner_below_publisher",
								"type"	=> "text"));
	
					tie_options(					
						array(	"name"	=> __( '468x60 (Banner) - ad ID', 'tie' ),
								"id"	=> "banner_below_468",
								"type"	=> "text"));
								
					tie_options(					
						array(	"name"	=> __( '300x250 (Medium Rectangle) - ad ID', 'tie' ),
								"id"	=> "banner_below_300",
								"type"	=> "text"));

				?>
					</div>
					<h4 class="accordion-head"><a href=""><?php _e( 'Custom Code', 'tie' ) ?></a></h4>
					<div class="tie-accordion-contnet">
				<?php
					tie_options(					
						array(	"name"			=> __( 'Custom Ad Code', 'tie' ),
								"id"			=> "banner_below_adsense",
								"extra_text"	=> __( 'Supports: Text, HTML and Shortcodes.', 'tie' ),
								"type"			=> "textarea")); 
				?>
					</div>
				</div>
			</div>

			<div class="tiepanel-item">
				<h3><?php _e( 'Shortcode ADS', 'tie' ) ?></h3>
				<?php
					tie_options(				
						array(	"name"	=> __( '[ads1] Shortcode Banner', 'tie' ),
								"id"	=> "ads1_shortcode",
								"type"	=> "textarea")); 
	
					tie_options(
						array(	"name"	=> __( '[ads2] Shortcode Banner', 'tie' ),
								"id"	=> "ads2_shortcode",
								"type"	=> "textarea")); 
				?>
			</div>
		</div> <!-- Banners Settings -->
		
			

		<div id="tab11" class="tab_content tabs-wrap">
			<h2><?php _e( 'Sidebars', 'tie' ) ?></h2>	<?php echo $save ?>	
			
			<div class="tiepanel-item">
				<h3><?php _e( 'Default Sidebar Position', 'tie' ) ?></h3>
				<div class="option-item">
					<?php
						$tie_sidebar_pos = tie_get_option('sidebar_pos');
					?>
					<ul id="sidebar-position-options" class="tie-options">
						<li>
							<input name="tie_options[sidebar_pos]" type="radio" value="right" <?php if($tie_sidebar_pos == 'right' || !$tie_sidebar_pos ) echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/sidebar-right.png" /></a>
						</li>
						<li>
							<input name="tie_options[sidebar_pos]" type="radio" value="left" <?php if($tie_sidebar_pos == 'left') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/sidebar-left.png" /></a>
						</li>
					</ul>
				</div>
			</div>
			
			<div class="tiepanel-item">
				<h3><?php _e( 'Sticky Sidebars', 'tie' ) ?></h3>
				<?php
					tie_options(
						array(	"name"	=> __( 'Sticky Sidebar', 'tie' ),
								"id"	=> "sticky_sidebar",
								"type"	=> "checkbox"));
								
					tie_options(
						array(	"name"	=> __( 'Disable on the homepage', 'tie' ),
								"id"	=> "sticky_sidebar_disable_homepage",
								"type"	=> "checkbox"));
								
					tie_options(
						array(	"name"	=> __( 'Disable on category pages', 'tie' ),
								"id"	=> "sticky_sidebar_disable_cat",
								"type"	=> "checkbox"));	
								
					tie_options(
						array(	"name"	=> __( 'Disable on tag pages', 'tie' ),
								"id"	=> "sticky_sidebar_disable_tag",
								"type"	=> "checkbox"));	
								
					tie_options(
						array(	"name"	=> __( 'Disable on pages', 'tie' ),
								"id"	=> "sticky_sidebar_disable_pages",
								"type"	=> "checkbox"));	
								
					tie_options(
						array(	"name"	=> __( 'Disable on posts', 'tie' ),
								"id"	=> "sticky_sidebar_disable_posts",
								"type"	=> "checkbox"));
													
								
				?>
			</div>
			
			<div class="tiepanel-item">
				<h3><?php _e( 'Add Sidebar', 'tie' ) ?></h3>
				<div class="option-item">
					<span class="label"><?php _e( 'Sidebar Name', 'tie' ) ?></span>
					
					<input id="sidebarName" type="text" size="56" style="direction:ltr; text-laign:left" name="sidebarName" value="" />
					<input id="sidebarAdd"  class="button" type="button" value="<?php _e( 'Add', 'tie' ) ?>" />
					
					<ul id="sidebarsList">
					<?php $sidebars = tie_get_option( 'sidebars' ) ;
						if($sidebars){
							foreach ($sidebars as $sidebar) { ?>
						<li>
							<div class="widget-head"><?php echo $sidebar ?>  <input id="tie_sidebars" name="tie_options[sidebars][]" type="hidden" value="<?php echo $sidebar ?>" /><a class="del-sidebar"></a></div>
						</li>
							<?php }
						}
					?>
					</ul>
				</div>				
			</div>

			<div class="tiepanel-item" id="custom-sidebars">
				<h3><?php _e( 'Custom Sidebars', 'tie' ) ?></h3>
				<?php
				
				$new_sidebars = array(''=> __( 'Default' , 'tie' ));
				if (class_exists('Woocommerce'))
					$new_sidebars ['shop-widget-area'] = __( 'Shop - For WooCommerce Pages', 'tie' ) ;

				if($sidebars){
					foreach ($sidebars as $sidebar) {
						$new_sidebars[$sidebar] = $sidebar;
					}
				}
				
				
				tie_options(				
					array(	"name"		=> __( 'Home Sidebar', 'tie' ),
							"id"		=> "sidebar_home",
							"type"		=> "select",
							"options"	=> $new_sidebars ));
							
				tie_options(				
					array(	"name"		=> __( 'Single Page Sidebar', 'tie' ),
							"id"		=> "sidebar_page",
							"type"		=> "select",
							"options"	=> $new_sidebars ));
							
				tie_options(				
					array(	"name"		=> __( 'Single Article Sidebar', 'tie' ),
							"id"		=> "sidebar_post",
							"type"		=> "select",
							"options"	=> $new_sidebars ));
							
				tie_options(				
					array(	"name"		=> __( 'Archives Sidebar', 'tie' ),
							"id"		=> "sidebar_archive",
							"type"		=> "select",
							"options"	=> $new_sidebars ));

				if(class_exists( 'bbPress' ))
				tie_options(				
					array(	"name"		=> __( 'bbPress Sidebar', 'tie' ),
							"id"		=> "sidebar_bbpress",
							"type"		=> "select",
							"options"	=> $new_sidebars )); 

				?>
			</div>
		</div> <!-- Sidebars -->
		
		
		<div id="tab12" class="tab_content tabs-wrap">
			<h2><?php _e( 'Archives Settings', 'tie' ) ?></h2>	<?php echo $save ?>	
			
			
			<div class="tiepanel-item">
				<h3><?php _e( 'General Settings', 'tie' ) ?></h3>
				<?php
								
					tie_options(
						array(	"name"	=> __( 'Show Social Buttons', 'tie' ),
								"id"	=> "archives_socail",
								"type"	=> "checkbox" ));
					
					tie_options(
						array( 	"name"	=> __( 'Excerpt Length', 'tie' ),
								"id"	=> "exc_length",
								"type"	=> "short-text"));
								
					tie_options(
						array(	"name"	=> __( 'Review Score', 'tie' ),
								"id"	=> "arc_meta_score",
								"type"	=> "checkbox" )); 	
								
					tie_options(
						array(	"name"	=> __( 'Author Meta', 'tie' ),
								"id"	=> "arc_meta_author",
								"type"	=> "checkbox")); 
								
					tie_options(
						array(	"name"	=> __( 'Date Meta', 'tie' ),
								"id"	=> "arc_meta_date",
								"type"	=> "checkbox"));
								
					tie_options(
						array(	"name"	=> __( 'Categories Meta', 'tie' ),
								"id"	=> "arc_meta_cats",
								"type"	=> "checkbox")); 
								
					tie_options(
						array(	"name"	=> __( 'Comments Meta', 'tie' ),
								"id"	=> "arc_meta_comments",
								"type"	=> "checkbox"));
								
					tie_options(
						array(	"name"	=> __( 'Views Meta', 'tie' ),
								"id"	=> "arc_meta_views",
								"type"	=> "checkbox"));
				?>
			</div>	
			
			<div class="tiepanel-item">
				<h3><?php _e( 'Default layout settings', 'tie' ) ?></h3>
				
				<?php
					$tie_blog_display = tie_get_option('blog_display');
				?>
				<div class="option-item">
					<span class="label"><?php _e( 'Choose the default layout', 'tie' ) ?></span>
					<ul id="tie_blog_display" class="tie-options tie-archives-options">
						<li>
							<input name="tie_options[blog_display]" type="radio" value="excerpt" <?php if($tie_blog_display == 'excerpt' || !$tie_blog_display ) echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/arc-1.png" /></a>
						</li>
						<li>
							<input name="tie_options[blog_display]" type="radio" value="full_thumb" <?php if($tie_blog_display == 'full_thumb') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/arc-2.png" /></a>
						</li>
						<li>
							<input name="tie_options[blog_display]" type="radio" value="content" <?php if($tie_blog_display == 'content') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/arc-3.png" /></a>
						</li>
						<li>
							<input name="tie_options[blog_display]" type="radio" value="masonry" <?php if($tie_blog_display == 'masonry') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/arc-4.png" /></a>
						</li>
						<li>
							<input name="tie_options[blog_display]" type="radio" value="timeline" <?php if($tie_blog_display == 'timeline') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/arc-6.png" /></a>
						</li>
					</ul>
					<p class="tie_message_hint"><?php _e( 'These settings will applies on all pages with blog List template.', 'tie' ) ?></p>
				</div>
			</div>

			
			<div class="tiepanel-item">
				<h3><?php _e( 'Category Page Settings', 'tie' ) ?></h3>
				<?php
					tie_options(
						array(	"name"	=> __( 'Category Description', 'tie' ),
								"id"	=> "category_desc",
								"type"	=> "checkbox"));

					tie_options(
						array(	"name"	=> __( 'RSS Icon', 'tie' ),
								"id"	=> "category_rss",
								"type"	=> "checkbox"));

					$tie_category_layout = tie_get_option('category_layout');
				?>
				<div class="option-item">
					<span class="label"><?php _e( 'Choose Default Categories page layout', 'tie' ) ?></span>
					<ul id="tie_category_layout" class="tie-options tie-archives-options">
						<li>
							<input name="tie_options[category_layout]" type="radio" value="excerpt" <?php if($tie_category_layout == 'excerpt' || !$tie_category_layout ) echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/arc-1.png" /></a>
						</li>
						<li>
							<input name="tie_options[category_layout]" type="radio" value="full_thumb" <?php if($tie_category_layout == 'full_thumb') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/arc-2.png" /></a>
						</li>
						<li>
							<input name="tie_options[category_layout]" type="radio" value="content" <?php if($tie_category_layout == 'content') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/arc-3.png" /></a>
						</li>
						<li>
							<input name="tie_options[category_layout]" type="radio" value="masonry" <?php if($tie_category_layout == 'masonry') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/arc-4.png" /></a>
						</li>
						<li>
							<input name="tie_options[category_layout]" type="radio" value="timeline" <?php if($tie_category_layout == 'timeline') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/arc-6.png" /></a>
						</li>
					</ul>
				</div>
			</div>


			<div class="tiepanel-item">
				<h3><?php _e( 'Tag Page Settings', 'tie' ) ?></h3>
				<?php
					tie_options(
						array(	"name"	=> __( 'Tag Description', 'tie' ),
								"id"	=> "tag_desc",
								"type"	=> "checkbox"));
								
					tie_options(
						array(	"name"	=> __( 'RSS Icon', 'tie' ),
								"id"	=> "tag_rss",
								"type"	=> "checkbox"));
				?>
				<?php
					$tie_tag_layout = tie_get_option('tag_layout');
				?>
				<div class="option-item">
					<span class="label"><?php _e( 'Choose Tags page layout', 'tie' ) ?></span>
					<ul id="tie_tag_layout" class="tie-options tie-archives-options">
						<li>
							<input name="tie_options[tag_layout]" type="radio" value="excerpt" <?php if($tie_tag_layout == 'excerpt' || !$tie_tag_layout ) echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/arc-1.png" /></a>
						</li>
						<li>
							<input name="tie_options[tag_layout]" type="radio" value="full_thumb" <?php if($tie_tag_layout == 'full_thumb') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/arc-2.png" /></a>
						</li>
						<li>
							<input name="tie_options[tag_layout]" type="radio" value="content" <?php if($tie_tag_layout == 'content') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/arc-3.png" /></a>
						</li>
						<li>
							<input name="tie_options[tag_layout]" type="radio" value="masonry" <?php if($tie_tag_layout == 'masonry') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/arc-4.png" /></a>
						</li>
						<li>
							<input name="tie_options[tag_layout]" type="radio" value="timeline" <?php if($tie_tag_layout == 'timeline') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/arc-6.png" /></a>
						</li>
					</ul>
				</div>
			</div>
			
			<div class="tiepanel-item">
				<h3><?php _e( 'Author Page Settings', 'tie' ) ?></h3>
				<?php
					tie_options(
						array(	"name"	=> __( 'Author Bio', 'tie' ),
								"id"	=> "author_bio",
								"type"	=> "checkbox"));

					tie_options(
						array(	"name"	=> __( 'RSS Icon', 'tie' ),
								"id"	=> "author_rss",
								"type"	=> "checkbox"));

					$tie_author_layout = tie_get_option('author_layout');
				?>
				<div class="option-item">
					<span class="label"><?php _e( 'Choose Author page layout', 'tie' ) ?></span>
					<ul id="tie_author_layout" class="tie-options tie-archives-options">
						<li>
							<input name="tie_options[author_layout]" type="radio" value="excerpt" <?php if($tie_author_layout == 'excerpt' || !$tie_author_layout ) echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/arc-1.png" /></a>
						</li>
						<li>
							<input name="tie_options[author_layout]" type="radio" value="full_thumb" <?php if($tie_author_layout == 'full_thumb') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/arc-2.png" /></a>
						</li>
						<li>
							<input name="tie_options[author_layout]" type="radio" value="content" <?php if($tie_author_layout == 'content') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/arc-3.png" /></a>
						</li>
						<li>
							<input name="tie_options[author_layout]" type="radio" value="masonry" <?php if($tie_author_layout == 'masonry') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/arc-4.png" /></a>
						</li>
						<li>
							<input name="tie_options[author_layout]" type="radio" value="timeline" <?php if($tie_author_layout == 'timeline') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/arc-6.png" /></a>
						</li>
					</ul>
				</div>
			</div>
			
			<div class="tiepanel-item">
				<h3><?php _e( 'Search Page Settings', 'tie' ) ?></h3>
				<?php
					tie_options(
						array(	"name"	=> __( 'Search in Category IDs', 'tie' ),
								"id"	=> "search_cats",
								"help" => __( 'Use minus sign (-) to exclude categories. Example: (1,4,-7) = search only in Category 1 & 4, and exclude Category 7.', 'tie' ),
								"type"	=> "text"));
	
					tie_options(
						array(	"name"	=> __( 'Exclude Pages in results', 'tie' ),
								"id"	=> "search_exclude_pages",
								"type"	=> "checkbox"));

					$tie_search_layout = tie_get_option('search_layout');
				?>
				<div class="option-item">
					<span class="label"><?php _e( 'Choose Search results page layout', 'tie' ) ?></span>
					<ul id="tie_search_layout" class="tie-options tie-archives-options">
						<li>
							<input name="tie_options[search_layout]" type="radio" value="excerpt" <?php if($tie_search_layout == 'excerpt' || !$tie_search_layout ) echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/arc-1.png" /></a>
						</li>
						<li>
							<input name="tie_options[search_layout]" type="radio" value="full_thumb" <?php if($tie_search_layout == 'full_thumb') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/arc-2.png" /></a>
						</li>
						<li>
							<input name="tie_options[search_layout]" type="radio" value="content" <?php if($tie_search_layout == 'content') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/arc-3.png" /></a>
						</li>
						<li>
							<input name="tie_options[search_layout]" type="radio" value="masonry" <?php if($tie_search_layout == 'masonry') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/arc-4.png" /></a>
						</li>
						<li>
							<input name="tie_options[search_layout]" type="radio" value="timeline" <?php if($tie_search_layout == 'timeline') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/arc-6.png" /></a>
						</li>
					</ul>
				</div>
			</div>
		</div> <!-- Archives -->
				
				
		<div id="tab13" class="tab_content tabs-wrap">
			<h2><?php _e( 'Styling', 'tie' ) ?></h2>	<?php echo $save ?>	
			<div class="tiepanel-item">
				<h3><?php _e( 'Theme Color and Settings', 'tie' ) ?></h3>

				<div class="option-item">
					<span class="label"><?php _e( 'Choose Theme Color', 'tie' ) ?></span>
			
					<?php
						$theme_color = tie_get_option('theme_skin');
					?>
					<ul style="clear:both" id="theme-skins" class="tie-options">
						<li>
							<input id="tie_theme_skin"  name="tie_options[theme_skin]" type="radio" value="0" <?php if(!$theme_color) echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/skin-none.png" /></a>
						</li>
						<li>
							<input id="tie_theme_skin"  name="tie_options[theme_skin]" type="radio" value="#ef3636" <?php if($theme_color == '#ef3636' ) echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/skin-red.png" /></a>
						</li>
						<li>
							<input id="tie_theme_skin"  name="tie_options[theme_skin]" type="radio" value="#37b8eb" <?php if($theme_color == '#37b8eb') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/skin-blue.png" /></a>
						</li>
						<li>
							<input id="tie_theme_skin"  name="tie_options[theme_skin]" type="radio" value="#81bd00" <?php if($theme_color == '#81bd00') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/skin-green.png" /></a>
						</li>
						<li>
							<input id="tie_theme_skin"  name="tie_options[theme_skin]" type="radio" value="#e95ca2" <?php if($theme_color == '#e95ca2') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/skin-pink.png" /></a>
						</li>
						<li>
							<input id="tie_theme_skin"  name="tie_options[theme_skin]" type="radio" value="#000" <?php if($theme_color == '#000') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/skin-black.png" /></a>
						</li>
						<li>
							<input id="tie_theme_skin"  name="tie_options[theme_skin]" type="radio" value="#ffbb01" <?php if($theme_color == '#ffbb01' ) echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/skin-yellow.png" /></a>
						</li>
						<li>
							<input id="tie_theme_skin"  name="tie_options[theme_skin]" type="radio" value="#7b77ff" <?php if($theme_color == '#7b77ff') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/skin-purple.png" /></a>
						</li>
					</ul>
				</div>

				<?php
					tie_options(
						array(	"name"	=> __( 'Custom Theme Color', 'tie' ),
								"id"	=> "global_color",
								"type"	=> "color"));

					tie_options(				
						array(	"name"	=> __( 'Dark Skin', 'tie' ),
								"id"	=> "dark_skin",
								"type"	=> "checkbox")); 
								
					tie_options(				
						array(	"name"			=> __( 'Modern Colored Scrollbar', 'tie' ),
								"id"			=> "modern_scrollbar",
								"type"			=> "checkbox",
								"extra_text"	=> __( 'For Chrome and Safari only.', 'tie' ) ));
						
					tie_options(
						array(	"name"	=> __( 'Apply Categories Colors on News blocks', 'tie' ),
								"id"	=> "homepage_cats_colors",
								"type"	=> "checkbox")); 
							
					tie_options(				
						array(	"name"	=> __( 'Lazy Load For Images', 'tie' ),
								"id"	=> "lazy_load",
								"type"	=> "checkbox" ));

					tie_options(				
						array(	"name"	=> __( 'Smoth Scroll', 'tie' ),
								"id"	=> "smoth_scroll",
								"type"	=> "checkbox" ));
				?>
			</div>	
			<div class="tiepanel-item">

				<h3><?php _e( 'Background Type', 'tie' ) ?></h3>
				<?php
					tie_options(
						array( 	"name"		=> __( 'Background Type', 'tie' ),
								"id"		=> "background_type",
								"type"		=> "radio",
								"options"	=> array(	"pattern"	=> __( 'Pattern', 'tie' ) ,
														"custom"	=> __( 'Custom Background', 'tie' ) )));
				?>
			</div>

			<div class="tiepanel-item" id="pattern-settings">
				<h3><?php _e( 'Choose Pattern', 'tie' ) ?></h3>
				
				<?php
					tie_options(
						array( 	"name"	=> __( 'Background Color', 'tie' ),
								"id"	=> "background_pattern_color",
								"type"	=> "color" ));

					$theme_pattern = tie_get_option('background_pattern');
				?>
				<ul id="theme-pattern" class="tie-options">
					<?php for($i=1 ; $i<=46 ; $i++ ){ 
					 $pattern = 'body-bg'.$i; ?>
					<li>
						<input id="tie_background_pattern"  name="tie_options[background_pattern]" type="radio" value="<?php echo $pattern ?>" <?php if($theme_pattern == $pattern ) echo $checked; ?> />
						<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/pattern<?php echo $i ?>.png" /></a>
					</li>
					<?php } ?>
				</ul>
			</div>

			<div class="tiepanel-item" id="bg_image_settings">
				<h3><?php _e( 'Custom Background', 'tie' ) ?></h3>
				<?php
					tie_options(
						array(	"name"	=> __( 'Custom Background', 'tie' ),
								"id"	=> "background",
								"type"	=> "background"));

					tie_options(
						array(	"name"	=> __( 'Full Screen Background', 'tie' ),
								"id"	=> "background_full",
								"type"	=> "checkbox"));
				?>

			</div>	
			<div class="tiepanel-item">
				<h3><?php _e( 'Body Styling', 'tie' ) ?></h3>
				<?php
				
					tie_options(
						array(	"name"	=> __( 'Highlighted Text Color', 'tie' ),
								"id"	=> "highlighted_color",
								"type"	=> "color"));
								
					tie_options(
						array(	"name"	=> __( 'Links Color', 'tie' ),
								"id"	=> "links_color",
								"type"	=> "color"));
					tie_options(
						array(	"name"		=> __( 'Links Decoration', 'tie' ),
								"id"		=> "links_decoration",
								"type"		=> "select",
								"options"	=> array(	""				=> __( 'Default', 'tie' ),
														"none"			=> __( 'none', 'tie' ),
														"underline"		=> __( 'underline', 'tie' ),
														"overline"		=> __( 'overline', 'tie' ),
														"line-through"	=> __( 'line-through', 'tie' ) )));

					tie_options(
						array(	"name"	=> __( 'Links Color on mouse over', 'tie' ),
								"id"	=> "links_color_hover",
								"type"	=> "color"));
	
					tie_options(
						array(	"name"		=> __( 'Links Decoration on mouse over', 'tie' ),
								"id"		=> "links_decoration_hover",
								"type"		=> "select",
								"options"	=> array(	""				=> __( 'Default', 'tie' ),
														"none"			=> __( 'none', 'tie' ),
														"underline"		=> __( 'underline', 'tie' ),
														"overline"		=> __( 'overline', 'tie' ),
														"line-through"	=> __( 'line-through', 'tie' ) )));
				?>
			</div>

			<div class="tiepanel-item">
				<h3><?php _e( 'Top Navigation Styling', 'tie' ) ?></h3>
				<?php
					tie_options(
						array(	"name"	=> __( 'Background', 'tie' ),
								"id"	=> "topbar_background",
								"type"	=> "background"));

					tie_options(
						array(	"name"	=> __( 'Links Color', 'tie' ),
								"id"	=> "topbar_links_color",
								"type"	=> "color"));

					tie_options(
						array(	"name"	=> __( 'Links Color on mouse over', 'tie' ),
								"id"	=> "topbar_links_color_hover",
								"type"	=> "color"));

					tie_options(
						array(	"name"	=> __( "Today's Date text color", "tie" ),
								"id"	=> "todaydate_color",
								"type"	=> "color"));
				?>
			</div>
			
			<div class="tiepanel-item">
				<h3><?php _e( 'Header Background', 'tie' ) ?></h3>
				<?php
					tie_options(
						array(	"name"	=> __( 'Background', 'tie' ),
								"id"	=> "header_background",
								"type"	=> "background"));
				?>
			</div>
			
						
			<div class="tiepanel-item">
				<h3><?php _e( 'Main Navigation Styling', 'tie' ) ?></h3>
				<?php
					tie_options(
						array(	"name"	=> __( 'Main Navigation Background', 'tie' ),
								"id"	=> "main_nav_background",
								"type"	=> "color"));
								
					tie_options(
						array(	"name"	=> __( 'Main Navigation inner bottom border color', 'tie' ),
								"id"	=> "main_nav_border",
								"type"	=> "color"));
								
					tie_options(
						array(	"name"	=> __( 'Sub Menu Background', 'tie' ),
								"id"	=> "sub_nav_background",
								"type"	=> "color"));

					tie_options(
						array(	"name"	=> __( 'Links Color', 'tie' ),
								"id"	=> "nav_links_color",
								"type"	=> "color"));
								
					tie_options(
						array(	"name"	=> __( 'Links Color on mouse over', 'tie' ),
								"id"	=> "nav_links_color_hover",
								"type"	=> "color"));
								
					tie_options(
						array(	"name"	=> __( 'Current Item Link Color', 'tie' ),
								"id"	=> "nav_current_links_color",
								"type"	=> "color"));
										
					tie_options(
						array(	"name"	=> __( 'Separator Line1 color', 'tie' ),
								"id"	=> "nav_sep1",
								"type"	=> "color"));
								
					tie_options(
						array(	"name"	=> __( 'Separator Line2 color', 'tie' ),
								"id"	=> "nav_sep2",
								"type"	=> "color"));
				?>
			</div>
			
			
			<div class="tiepanel-item">
				<h3><?php _e( 'Breaking News Styling', 'tie' ) ?></h3>
				<?php
					tie_options(
						array(	"name"	=> __( 'Breaking News Text Background', 'tie' ),
								"id"	=> "breaking_title_bg",
								"type"	=> "color"));
				?>		
			</div>

			<div class="tiepanel-item">
				<h3><?php _e( 'Content Styling', 'tie' ) ?></h3>
				<?php
					tie_options(
						array(	"name"	=> __( 'Main Content Background', 'tie' ),
								"id"	=> "main_content_bg",
								"type"	=> "background"));

					tie_options(
						array(	"name"	=> __( 'Blocks / Widgets Background', 'tie' ),
								"id"	=> "boxes_bg",
								"type"	=> "background"));

				?>		
			</div>
			<div class="tiepanel-item">
				<h3><?php _e( 'Post Styling', 'tie' ) ?></h3>
				<?php
					tie_options(
						array(	"name"	=> __( 'Post Links Color', 'tie' ),
								"id"	=> "post_links_color",
								"type"	=> "color"));

					tie_options(
						array(	"name"		=> __( 'Post Links Decoration', 'tie' ),
								"id"		=> "post_links_decoration",
								"type"		=> "select",
								"options"	=> array(	""				=> __( 'Default', 'tie' ),
														"none"			=> __( 'none', 'tie' ),
														"underline"		=> __( 'underline', 'tie' ),
														"overline"		=> __( 'overline', 'tie' ),
														"line-through"	=> __( 'line-through', 'tie' ) )));

					tie_options(
						array(	"name"	=> __( 'Post Links Color on mouse over', 'tie' ),
								"id"	=> "post_links_color_hover",
								"type"	=> "color"));

					tie_options(
						array(	"name"		=> __( 'Post Links Decoration on mouse over', 'tie' ),
								"id"		=> "post_links_decoration_hover",
								"type"		=> "select",
								"options"	=> array(	""				=> __( 'Default', 'tie' ),
														"none"			=> __( 'none', 'tie' ),
														"underline"		=> __( 'underline', 'tie' ),
														"overline"		=> __( 'overline', 'tie' ),
														"line-through"	=> __( 'line-through', 'tie' ) )));
				?>
			</div>
			<div class="tiepanel-item">
				<h3><?php _e( 'Footer Background', 'tie' ) ?></h3>
				<?php
					tie_options(
						array(	"name"	=> __( 'Background', 'tie' ),
								"id"	=> "footer_background",
								"type"	=> "background"));

					tie_options(
						array(	"name"	=> __( 'Footer Widget Title color', 'tie' ),
								"id"	=> "footer_title_color",
								"type"	=> "color"));

					tie_options(
						array(	"name"	=> __( 'Links Color', 'tie' ),
								"id"	=> "footer_links_color",
								"type"	=> "color"));

					tie_options(
						array(	"name"	=> __( 'Links Color on mouse over', 'tie' ),
								"id"	=> "footer_links_color_hover",
								"type"	=> "color"));
				?>
			</div>				
						
			<div class="tiepanel-item">
				<h3><?php _e( 'Custom CSS', 'tie' ) ?></h3>	
				<div class="option-item">
					<p><strong><?php _e( 'Global CSS :', 'tie' ) ?></strong></p>
					<textarea id="tie_css" name="tie_options[css]" class="code tie-css" style="width:100%" rows="7"><?php echo tie_get_option('css');  ?></textarea>
				</div>	
				<div class="option-item">
					<p><strong><?php _e( 'Tablets:', 'tie' ) ?></strong><?php _e( '768 - 985px', 'tie' ) ?> </p>
					<textarea id="tie_css_tablets" name="tie_options[css_tablets]" class="code tie-css"  style="width:100%" rows="7"><?php echo tie_get_option('css_tablets');  ?></textarea>
				</div>
				<div class="option-item">
					<p><strong><?php _e( 'Wide Phones:', 'tie' ) ?></strong><?php _e( '480 - 767px', 'tie' ) ?></p>
					<textarea id="tie_css_wphones" name="tie_options[css_wide_phones]" class="code tie-css"  style="width:100%" rows="7"><?php echo tie_get_option('css_wide_phones');  ?></textarea>
				</div>
				<div class="option-item">
					<p><strong><?php _e( 'Phones:', 'tie' ) ?></strong><?php _e( '320 - 479px', 'tie' ) ?></p>
					<textarea id="tie_css_phones" name="tie_options[css_phones]" class="code tie-css"  style="width:100%" rows="7"><?php echo tie_get_option('css_phones');  ?></textarea>
				</div>	
			</div>	

		</div> <!-- Styling -->

	
		
		<div id="tab14" class="tab_content tabs-wrap">
			<h2><?php _e( 'Typography', 'tie' ) ?></h2>	<?php echo $save ?>	
			
			<div class="tiepanel-item">
				<h3><?php _e( 'Character sets', 'tie' ) ?></h3>
				<p class="tie_message_hint"><strong><?php _e( 'Tip:', 'tie' ) ?></strong><?php _e( "If you choose only the languages that you need, you'll help prevent slowness on your webpage.", 'tie' ) ?></p>
				<?php
					tie_options(
						array(	"name"	=> __( 'Latin Extended', 'tie' ),
								"id"	=> "typography_latin_extended",
								"type"	=> "checkbox"));

					tie_options(
						array(	"name"	=> __( 'Cyrillic', 'tie' ),
								"id"	=> "typography_cyrillic",
								"type"	=> "checkbox"));

					tie_options(
						array(	"name"	=> __( 'Cyrillic Extended', 'tie' ),
								"id"	=> "typography_cyrillic_extended",
								"type"	=> "checkbox"));
								
					tie_options(
						array(	"name"	=> __( 'Greek', 'tie' ),
								"id"	=> "typography_greek",
								"type"	=> "checkbox"));
								
					tie_options(
						array(	"name"	=> __( 'Greek Extended', 'tie' ),
								"id"	=> "typography_greek_extended",
								"type"	=> "checkbox"));	
								
					tie_options(
						array(	"name"	=> __( 'Khmer', 'tie' ),
								"id"	=> "typography_khmer",
								"type"	=> "checkbox"));		
								
					tie_options(
						array(	"name"	=> __( 'Vietnamese', 'tie' ),
								"id"	=> "typography_vietnamese",
								"type"	=> "checkbox"));
				?>
			</div>
			
			<div class="tiepanel-item">
				<h3><?php _e( 'Live typography preview', 'tie' ) ?></h3>
					<?php
					tie_options(
						array( 	"name"	=> "",
								"id"	=> "typography_test",
								"type"	=> "typography"));
					?>
	
				<div id="font-preview" class="option-item"><?php _e( 'Grumpy wizards make toxic brew for the evil Queen and Jack.', 'tie' ) ?></div>		

			</div>
			<div class="tiepanel-item">
				<h3><?php _e( 'Main Typography', 'tie' ) ?></h3>
				<?php
					tie_options(
						array( 	"name"	=> __( 'General Typography', 'tie' ),
								"id"	=> "typography_general",
								"type"	=> "typography"));
								
					tie_options(
						array( 	"name"	=> __( 'Site Title In Header', 'tie' ),
								"id"	=> "typography_site_title",
								"type"	=> "typography"));	

					tie_options(
						array( 	"name"	=> __( 'Tagline In Header', 'tie' ),
								"id"	=> "typography_tagline",
								"type"	=> "typography"));	
								
					tie_options(
						array( 	"name"	=> __( 'Top Menu', 'tie' ),
								"id"	=> "typography_top_menu",
								"type"	=> "typography"));

					tie_options(
						array( 	"name"	=> __( 'Main Navigation', 'tie' ),
								"id"	=> "typography_main_nav",
								"type"	=> "typography"));

					tie_options(
						array( 	"name"	=> __( 'Breaking News Label', 'tie' ),
								"id"	=> "typography_breaking_news",
								"type"	=> "typography"));

					tie_options(
						array( 	"name"	=> __( 'Grid Slider Post Title', 'tie' ),
								"id"	=> "typography_grid_slider_title",
								"type"	=> "typography"));

					tie_options(
						array( 	"name"	=> __( 'Slider Post Title', 'tie' ),
								"id"	=> "typography_slider_title",
								"type"	=> "typography"));

					tie_options(
						array( 	"name"	=> __( 'Page Title', 'tie' ),
								"id"	=> "typography_page_title",
								"type"	=> "typography"));

					tie_options(
						array( 	"name"	=> __( 'Single Post Title', 'tie' ),
								"id"	=> "typography_post_title",
								"type"	=> "typography"));
								
					tie_options(
						array( 	"name"	=> __( 'Post Title in Homepage Blocks and Post Titles in Blog Layout', 'tie' ),
								"id"	=> "typography_post_title_boxes",
								"type"	=> "typography"));
								
					tie_options(
						array( 	"name"	=> __( 'Small Post Title in Homepage Blocks', 'tie' ),
								"id"	=> "typography_post_title2_boxes",
								"type"	=> "typography"));

					tie_options(
						array( 	"name"	=> __( 'Post Meta', 'tie' ),
								"id"	=> "typography_post_meta",
								"type"	=> "typography"));

					tie_options(
						array( 	"name"	=> __( 'Post Entry', 'tie' ),
								"id"	=> "typography_post_entry",
								"type"	=> "typography"));
								
					tie_options(
						array( 	"name"	=> __( 'Blockquotes', 'tie' ),
								"id"	=> "typography_blockquotes",
								"type"	=> "typography"));

					tie_options(
						array( 	"name"	=> __( 'Blocks Titles', 'tie' ),
								"id"	=> "typography_boxes_title",
								"type"	=> "typography"));
								
					tie_options(
						array( 	"name"	=> __( 'Widgets Titles', 'tie' ),
								"id"	=> "typography_widgets_title",
								"type"	=> "typography"));
								
					tie_options(
						array( 	"name"	=> __( 'Footer Widgets Titles', 'tie' ),
								"id"	=> "typography_footer_widgets_title",
								"type"	=> "typography"));
				?>
			</div>			
		</div> <!-- Typography -->
		
		
		<div id="tab20" class="tab_content tabs-wrap">
			<h2><?php _e( 'Translations', 'tie' ) ?></h2>	<?php echo $save ?>	
			
			<div>
			<?php
				global $tie_default_texts;
				foreach ( $tie_default_texts as $value ) {
					if( is_array( $value ) ){
						?>
					</div> <!--tie-panel-item -->
					<div class="tiepanel-item">
						<h3><?php echo $value[ 'text' ] ?></h3>
						<?php
					}
					else{
						$value = htmlspecialchars( $value );
						tie_options( array(  "id"=> tie_sanitize_title($value), "name"=> $value, "type"=> "text") );
					}
				}
				?>
			</div> <!--tie-panel-item -->
		</div> <!-- Translations -->
		
		
		<div id="tab10" class="tab_content tabs-wrap">
			<h2><?php _e( 'Advanced Settings', 'tie' ) ?></h2>	<?php echo $save ?>	

			<div class="tiepanel-item">
				<h3><?php _e( 'Advanced Settings', 'tie' ) ?></h3>
				<?php
					tie_options(
						array(	"name"	=> __( 'Disable Arqam Lite', 'tie' ),
								"id"	=> "disable_arqam_lite",
								"type"	=> "checkbox"));
					
					tie_options(
						array(	"name"	=> __( 'Notify on theme updates', 'tie' ),
								"id"	=> "notify_theme",
								"type"	=> "checkbox"));
								
					tie_options(
						array(	"name"	=> __( 'Disable the Responsiveness', 'tie' ),
								"id"	=> "disable_responsive",
								"type"	=> "checkbox"));
				?>
				<p class="tie_message_hint"><?php _e( 'This option works only on Tablets and Phones .. to disable the responsiveness action on the desktop .. edit style.css file and remove all Media Queries from the end of the file .', 'tie' ) ?></p>
			</div>


			<div class="tiepanel-item">
				<h3><?php _e( 'WordPress Login page Logo', 'tie' ) ?></h3>
				<?php
					tie_options(
						array(	"name"	=> __( 'WordPress Login page Logo', 'tie' ),
								"id"	=> "dashboard_logo",
								"type"	=> "upload"));

					tie_options(
						array(	"name"	=> __( 'WordPress Login page Logo URL', 'tie' ),
								"id"	=> "dashboard_logo_url",
								"type"	=> "text"));
				?>
			
			</div>
			<?php
				global $array_options ;
				
				$current_options = array();
				foreach( $array_options as $option ){
					if( get_option( $option ) )
						$current_options[$option] =  get_option( $option ) ;
				}
			?>
			
			<div class="tiepanel-item">
				<h3><?php _e( 'Export', 'tie' ) ?></h3>
				<div class="option-item">
					<textarea style="width:100%" rows="7"><?php echo $currentsettings = base64_encode( serialize( $current_options )); ?></textarea>
				</div>
			</div>
			<div class="tiepanel-item">
				<h3><?php _e( 'Import', 'tie' ) ?></h3>
				<div class="option-item">
					<textarea id="tie_import" name="tie_import" style="width:100%" rows="7"></textarea>
				</div>
			</div>


		</div> <!-- Advanced -->
		
		
		<div class="mo-footer">
			<?php echo $save; ?>
		</form>

			<form method="post">
				<div class="mpanel-reset">
					<input type="hidden" name="resetnonce" value="<?php echo wp_create_nonce('reset-action-code'); ?>" />
					<input name="reset" class="mpanel-reset-button button button-primary button-large" type="submit" onClick="if(confirm('<?php _e( 'All settings will be rest .. Are you sure ?', 'tie' ) ?>')) return true ; else return false; " value="<?php _e( 'Reset All Settings', 'tie' ) ?>" />
					<input type="hidden" name="action" value="reset" />
				</div>
			</form>
		</div>

	</div><!-- .mo-panel-content -->
	<div class="clear"></div>
</div><!-- .mo-panel -->
<?php 
}
?>
