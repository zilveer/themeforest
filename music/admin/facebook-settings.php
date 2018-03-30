<?php
/*
 * Netlabs Admin Framework
 */


//  SUBMIT REDIRECTS FOR THEME OPTIONS SAVES
function ntl_show_facebook() {
	$ntag = 'facebook-settings';			
	if (isset ($_POST["ntl-settings-submit"]) && $_POST["ntl-settings-submit"] == 'Y' ) {
		ntl_save_facebook();
		$url_parameters = isset($_GET['tab'])? 'updated=true&tab='.$_GET['tab'] : 'updated=true';
		wp_redirect(admin_url('admin.php?page=' .  $ntag  .   '&'.$url_parameters));
		exit;
	}	
}


// SAVE SCRIPTS FOR THE THEME OPTIONS
function ntl_save_facebook() {
	global $pagenow;
	$ntag = 'facebook-settings';	
	
	$settings = get_option( "ntl_theme_settings" );
	
	if ( $_GET['page'] == $ntag ){ 
		if ( isset ( $_GET['tab'] ) )
	        $tab = $_GET['tab']; 
	    else
	        $tab = 1; 

	    switch ( $tab ){ 
	        case 1 :
				$settings['ntl_facebook_api']		= $_POST['ntl_facebook_api'];
				$settings['ntl_facebook_secret']	= $_POST['ntl_facebook_secret'];
				$settings['ntl_facebook_previewmode']	= $_POST['ntl_facebook_previewmode'];
				$settings['ntl_facebook_secure']	= $_POST['ntl_facebook_secure'];
				$settings['ntl_facebook_ssl']		= $_POST['ntl_facebook_ssl'];
				$settings['ntl_fb_album']			= $_POST['ntl_fb_album'];
				$settings['ntl_fb_showplayer']		= $_POST['ntl_fb_showplayer'];						
			break; 
			
	        case 2 : 
				
			break;			
	    }
	}
	
	$updated = update_option( "ntl_theme_settings", $settings );
}


// DRAW THE THEME OPTIONS PAGE
function ntl_draw_facebook() {
	global $pagenow;
	$settings = get_option( "ntl_theme_settings" );
	$ntag = 'facebook-settings';	
	?>
	
	<div class="wrap ntl_wrap">
		<h2 class="appset"><?php echo get_option('blogname'); ?> Facebook Settings</h2>
		
		<?php
			if (isset ($_GET['updated']) && 'true' == esc_attr( $_GET['updated'] ) ) echo '<div class="updated" ><p>' . __('Facebook Settings updated.', 'localize') . '</p></div>';			
			if ( isset ( $_GET['tab'] ) ) ntl_draw_tabs($_GET['tab'], 'facebook', $ntag); else ntl_draw_tabs('', 'facebook', $ntag);
			
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
							ntl_facebookgeneral_settings();
						break; 
						
						case 2  : 
							
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