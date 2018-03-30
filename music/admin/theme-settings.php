<?php
/*
 * Netlabs Admin Framework
 */


//  SUBMIT REDIRECTS FOR THEME OPTIONS SAVES
function ntl_show_page() {
	$ntag = 'theme-settings';
		
	if (  ( isset ( $_POST["ntl-settings-submit"]) ) && $_POST["ntl-settings-submit"] == 'Y' ) {
		ntl_save_settings();
		$url_parameters = isset($_GET['tab'])? 'updated=true&tab='.$_GET['tab'] : 'updated=true';
		wp_redirect(admin_url('admin.php?page=' .  $ntag  .   '&'.$url_parameters));
		exit;
	}	
}


// SAVE SCRIPTS FOR THE THEME OPTIONS
function ntl_save_settings() {
	global $pagenow;
	$ntag = 'theme-settings';	
	
	$settings = get_option( "ntl_theme_settings" );
	
	if ( $_GET['page'] == $ntag ){ 
		if ( isset ( $_GET['tab'] ) )
	        $tab = $_GET['tab']; 
	    else
	        $tab = 1; 

	    switch ( $tab ){ 
	        case 1 :				
				$settings['ntl_theme_bg']		= $_POST['ntl_theme_bg'];
				$settings['ntl_theme_color']	= $_POST['ntl_theme_color'];
				$settings['ntl_twitter_name']	= $_POST['ntl_twitter_name'];

				$settings['ntl_twitter_conskey']= $_POST['ntl_twitter_conskey'];
				$settings['ntl_twitter_consecret']	= $_POST['ntl_twitter_consecret'];
				$settings['ntl_twitter_acctoken']	= $_POST['ntl_twitter_acctoken'];
				$settings['ntl_twitter_accsecret']	= $_POST['ntl_twitter_accsecret'];

				$settings['ntl_show_carousel']	= $_POST['ntl_show_carousel'];
				$settings['ntl_themetagline']	= $_POST['ntl_themetagline'];
				$settings['ntl_show_timer']		= $_POST['ntl_show_timer'];	
				$settings['ntl_calnext_label']	= $_POST['ntl_calnext_label'];					
			break; 
			
	        case 2 : 
				$settings['ntl_font_primary']	= $_POST['ntl_font_primary'];
				$settings['ntl_font_secondary']	= $_POST['ntl_font_secondary'];	
				
			break;
			
			case 3:
				$settings['ntl_map_metric']		= $_POST['ntl_map_metric'];	
				$settings['ntl_drivedir_page']	= $_POST['ntl_drivedir_page'];	
				$settings['ntl_disable_audio']	= $_POST['ntl_disable_audio'];	
				$settings['ntl_default_album']	= $_POST['ntl_default_album'];	
				$settings['ntl_auto_play']		= $_POST['ntl_auto_play'];	
			break;
			
			case 4:
				$settings['ntl_newssignup_admin_s']			= $_POST['ntl_newssignup_admin_s'];	
				$settings['ntl_newssignup_admin']			= $_POST['ntl_newssignup_admin'];	
				$settings['ntl_newssignup_customer_s']		= $_POST['ntl_newssignup_customer_s'];	
				$settings['ntl_newssignup_customer']		= $_POST['ntl_newssignup_customer'];	
				$settings['ntl_remindersignup_customer_s']	= $_POST['ntl_remindersignup_customer_s'];
				$settings['ntl_remindersignup_customer']	= $_POST['ntl_remindersignup_customer'];
				$settings['ntl_reminders_customer_s']		= $_POST['ntl_reminders_customer_s'];
				$settings['ntl_reminders_customer']			= $_POST['ntl_reminders_customer'];		
			break;
			
			case 5:
				$settings['ntl_facebook_addr']			= $_POST['ntl_facebook_addr'];
				$settings['ntl_facebook_post']			= $_POST['ntl_facebook_post'];	
				$settings['ntl_facebook_widg']			= $_POST['ntl_facebook_widg'];
				
				$settings['ntl_twitter_addr']			= $_POST['ntl_twitter_addr'];
				$settings['ntl_twitter_post']			= $_POST['ntl_twitter_post'];	
				$settings['ntl_twitter_widg']			= $_POST['ntl_twitter_widg'];	
				
				$settings['ntl_googleplus_addr']		= $_POST['ntl_googleplus_addr'];
				$settings['ntl_googleplus_post']		= $_POST['ntl_googleplus_post'];	
				$settings['ntl_googleplus_widg']		= $_POST['ntl_googleplus_widg'];	
				
				$settings['ntl_linkedin_addr']			= $_POST['ntl_linkedin_addr'];
				$settings['ntl_linkedin_post']			= $_POST['ntl_linkedin_post'];	
				$settings['ntl_linkedin_widg']			= $_POST['ntl_linkedin_widg'];	
				
				$settings['ntl_digg_addr']				= $_POST['ntl_digg_addr'];
				$settings['ntl_digg_post']				= $_POST['ntl_digg_post'];	
				$settings['ntl_digg_widg']				= $_POST['ntl_digg_widg'];
				
				$settings['ntl_reddit_addr']			= $_POST['ntl_reddit_addr'];
				$settings['ntl_reddit_post']			= $_POST['ntl_reddit_post'];	
				$settings['ntl_reddit_widg']			= $_POST['ntl_reddit_widg'];
				
				$settings['ntl_rss_addr']				= $_POST['ntl_rss_addr'];
				$settings['ntl_rss_post']				= $_POST['ntl_rss_post'];	
				$settings['ntl_rss_widg']				= $_POST['ntl_rss_widg'];	
				
				$settings['ntl_stumbleupon_addr']		= $_POST['ntl_stumbleupon_addr'];
				$settings['ntl_stumbleupon_post']		= $_POST['ntl_stumbleupon_post'];	
				$settings['ntl_stumbleupon_widg']		= $_POST['ntl_stumbleupon_widg'];	
				
				$settings['ntl_delicious_addr']			= $_POST['ntl_delicious_addr'];
				$settings['ntl_delicious_post']			= $_POST['ntl_delicious_post'];	
				$settings['ntl_delicious_widg']			= $_POST['ntl_delicious_widg'];	
				
			break;
	    }
	}
	
	$updated = update_option( "ntl_theme_settings", $settings );
}


// DRAW THE THEME OPTIONS PAGE
function ntl_draw_page() {
	global $pagenow;
	$settings = get_option( "ntl_theme_settings" );
	$theme_data = get_theme_data( TEMPLATEPATH . '/style.css' );
	$ntag = 'theme-settings';	
	?>
	
	<div class="wrap ntl_wrap">
		<h2 class="appset"><?php echo get_option('blogname'); ?> Theme Settings</h2>
		
		<?php
		
			if ( isset ( $_GET['updated'] )){
			if ( 'true' == esc_attr( $_GET['updated'] ) ) echo '<div class="updated" ><p>' . __('Theme Settings updated.', 'localize') . '</p></div>';	
			}		
			if ( isset ( $_GET['tab'] ) ) ntl_draw_tabs($_GET['tab'], 'admin', $ntag); else ntl_draw_tabs('', 'admin', $ntag);
			
			$sval = __('Save', 'localize');
		?>

		<div id="poststuff">
			<form method="post" action="<?php admin_url( 'admin.php?page=' . $ntag . '&tab='  . $_GET['tab'] ); ?>">
				<span class="formsave">
					<input type="submit" name="Submit"  class="ntl_formsave" value="<?php echo $sval; ?>" />
					<input type="hidden" name="ntl-settings-submit" value="Y" />
				</span>
				<span class="formbody">
				<?php
				wp_nonce_field( "ntl-draw-page" ); 

				
				if ( $pagenow == 'admin.php' && $_GET['page'] == $ntag ){
					
				
					if ( isset ( $_GET['tab'] ) ) $tab = $_GET['tab']; 
					else $tab = 1; 	
							

					switch ( $tab ){
						case 1 :
							 ntl_general_settings();
						break; 
						
						case 2  : 
							ntl_font_settings();
						break;
						
						case 3 : 
							ntl_audiomap_settings();
						break;
						
						case 4 : 
							ntl_mailmessage_settings();
						break;
						
						case 5 : 
							ntl_social_settings();
						break;
					}
				}
				?>
				</span>
				<br class="clear" />
			</form>			
		</div>
	</div>
<?php
}


?>