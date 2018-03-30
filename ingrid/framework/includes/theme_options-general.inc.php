<?php

// THEME OPTIONS

// general settings
	
	//remove logo
	if(!empty($_GET['page']) && !empty($_GET['remove']) && $_GET['page'] == 'tp_theme_general' && $_GET['remove'] == 'logo'){
		global $wpdb;  
  
		$image_url = get_option('tp_logo');
		
		// We need to get the image's meta ID.  
		$query = "SELECT ID FROM wp_posts where guid = '" . esc_url($image_url) . "' AND post_type = 'attachment'";  
		$results = $wpdb->get_results($query);  
	  
		// And delete it  
		foreach ( $results as $row ) {  
			wp_delete_attachment( $row->ID );  
		}  
		
		delete_option('tp_logo');		
		
		header("Location: admin.php?page=tp_theme_general&success=1");	
	}
	
	//remove favicon
	if(!empty($_GET['page']) && !empty($_GET['remove']) && $_GET['page'] == 'tp_theme_general' && $_GET['remove'] == 'favicon'){
		global $wpdb;  
  
		$image_url = get_option('tp_favicon');
		
		// We need to get the image's meta ID.  
		$query = "SELECT ID FROM wp_posts where guid = '" . esc_url($image_url) . "' AND post_type = 'attachment'";  
		$results = $wpdb->get_results($query);  
	  
		// And delete it  
		foreach ( $results as $row ) {  
			wp_delete_attachment( $row->ID );  
		}  
		
		delete_option('tp_favicon');		
		
		header("Location: admin.php?page=tp_theme_general&success=1");	
	}
	
	//save settings
	if(!empty($_POST) && !empty($_GET['page']) && $_GET['page'] == 'tp_theme_general'){		
	
		if(!empty($_POST['form-logo'])){
			//save
			update_option('tp_logo',$_POST['form-logo']);
		}
				
		if(!empty($_POST['form-favicon'])){
			//save
			update_option('tp_favicon',$_POST['form-favicon']);
		}
			

		if(intval($_POST['form-logo_padding']) > 50){
			update_option('tp_logo_padding','50');
		}elseif(intval($_POST['form-logo_padding']) < 1){
			delete_option('tp_logo_padding');
		}else{
			update_option('tp_logo_padding',intval($_POST['form-logo_padding']));
		}
		
		if(!empty($_POST['form-respo'])){
			//save
			update_option('tp_responsive',$_POST['form-respo']);
		}else{
			update_option('tp_responsive','');
		}
		
		if(!empty($_POST['form-retina'])){
			//save
			update_option('tp_retina',$_POST['form-retina']);
		}else{
			update_option('tp_retina','');
		}
		
		
		update_option('tp_tracking_code',stripslashes($_POST['form-code']));
			
		update_option('tp_bottom_footer_text_left',stripslashes($_POST['form-bottom_footer_text_left']));
		update_option('tp_bottom_footer_text_right',stripslashes($_POST['form-bottom_footer_text_right']));
		
		
		header("Location: admin.php?page=tp_theme_general&success=1");						
	}
		
		
	//display option layout	
	function tp_theme_general(){
		global $framework_url;

		if(!empty($_GET['success']) && $_GET['success'] == '1'){
			print '<div id="message" class="updated"><p>'.__('Settings are successfully saved.','ingrid').'</p></div>';
		}
		
		$tp_logo_padding = get_option('tp_logo_padding');
		$tp_retina = get_option('tp_retina');
		$tp_responsive = get_option('tp_responsive');
		
		print '<div class="wrap">	
			<div class="icon32"><img src="'.$framework_url.'icon-big.png" class="h2_icon" /><br /></div><h2>'.__( 'General Settings', 'ingrid' ).'</h2>	
		
			<form method="post" action="" enctype="multipart/form-data">		

			<table class="form-table">
				
					<tr valign="top">
					<th scope="row"><label>'.__( 'Responsivity', 'ingrid' ).'</label></th>
					<td>
						<label><input type="radio" name="form-respo" value=""'; if(empty($tp_responsive)){ print ' checked="checked"'; } print ' /><span> '.__('Enabled','ingrid').'</span></label><br />
						<label><input type="radio" name="form-respo" value="off"'; if(!empty($tp_responsive) && $tp_responsive == 'off'){ print ' checked="checked"'; } print ' /><span> '.__('Disabled','ingrid').'</span></label>					
					</td>
				</tr>

				<tr>
					<th scope="row"><label></label></th>
					<td></td>
				</tr>	
				
									
				<tr valign="top">
					<th scope="row"><label>'.__( 'Retina Display Support', 'ingrid' ).'</label></th>
					<td>
						<label><input type="radio" name="form-retina" value=""'; if(empty($tp_retina)){ print ' checked="checked"'; } print ' /><span> '.__('Enabled','ingrid').'</span></label><br />
						<label><input type="radio" name="form-retina" value="off"'; if(!empty($tp_retina) && $tp_retina == 'off'){ print ' checked="checked"'; } print ' /><span> '.__('Disabled','ingrid').'</span></label>					
					</td>
				</tr>


				
					<tr>
						<th scope="row"><label></label></th>
						<td></td>
					</tr>	
				
				
				
				<tr valign="top">
				<th scope="row"><label>'.__( 'Upload a logo', 'ingrid' ).'</label></th>
				<td>
					<input type="text" name="form-logo" id="tp_logo_up_src" class="regular-text" />
					<input id="';
					if(function_exists( 'wp_enqueue_media' )){
						print 'tp_logo_up';
					}else{
						print 'tp_logo_up-old';
					}
					
					print '" type="button" class="button" value="'.__( 'Upload/Select Logo', 'ingrid' ).'" />
					<br />
					<span class="description">'.__( 'Must be in transparent PNG format. Optimal height is 55px.', 'ingrid' ).'</span>
					<br /><br />				 
					';	
						$tp_logo = get_option('tp_logo');
						if(!empty($tp_logo)){
							print '<img id="upload_logo_preview" style="max-width:100%; border: 2px solid #ddd; padding: 5px; background-color: #333;" src="'.$tp_logo.'" />
							<br />
							<a href="?page=tp_theme_general&remove=logo">Click here to remove image</a>';							
						}else{
							print '<img id="upload_logo_preview" style="max-width:100%; border: 2px solid #ddd; padding: 5px; background-color: #333; display:none;" src="" />';
						}
					print '
				</td>
				</tr>
				<tr valign="top">
				<th scope="row"><label>'.__( 'Set top panel padding for logo', 'ingrid' ).' '.__( '(If you have a bigger one)', 'ingrid' ).'</label></th>
				<td>
					<input type="text" name="form-logo_padding" id="tp_logo_padding" maxlength="2" class="small-text" value="'.$tp_logo_padding.'" /> px
					<br />
					<span class="description">'.__( 'Max. 50 pixel', 'ingrid' ).'</span>
				</td>
				</tr>
				
					
					<tr>
						<th scope="row"><label></label></th>
						<td></td>
					</tr>	
				
				
				<tr valign="top">
				<th scope="row"><label>'.__( 'Upload favicon', 'ingrid' ).'</label></th>
				<td>				
					<input type="text" name="form-favicon" id="tp_favicon_up_src" class="regular-text" />
					<input id="';
					if(function_exists( 'wp_enqueue_media' )){
						print 'tp_favicon_up';
					}else{
						print 'tp_favicon_up-old';
					}
					
					print '" type="button" class="button" value="'.__( 'Upload/Select Logo', 'ingrid' ).'" />
					<br />
					<span class="description">'.__( 'Must be in 16px * 16px ICO format', 'ingrid' ).'</span>
					<br /><br />				 
					';	
						$tp_favicon = get_option('tp_favicon');
						if(!empty($tp_favicon)){
							print '<img id="upload_favicon_preview" style="max-width:100%; border: 2px solid #ddd; padding: 5px; background-color: #eee;" src="'.$tp_favicon.'" />
							<br />
							<a href="?page=tp_theme_general&remove=favicon">Click here to remove image</a>';							
						}else{
							print '<img id="upload_favicon_preview" style="max-width:100%; border: 2px solid #ddd; padding: 5px; background-color: #eee; display:none;" src="" />';
						}
					print '
				</td>		
				</tr>
				
				
					<tr>
						<th scope="row"><label></label></th>
						<td></td>
					</tr>	
					
				
				<tr valign="top">
				<th scope="row"><label>'.__( 'Insert tracking or other code<br />(Include script tags!)', 'ingrid' ).'</label></th>
				<td><textarea name="form-code" cols="60" rows="6" class="code">'.esc_textarea(get_option('tp_tracking_code')).'</textarea></td>
				</tr>	
				
				<tr>
					<th scope="row"><label></label></th>
					<td></td>
				</tr>	
				
				
				<tr>
					<th scope="row"><label>'.__('Bottom Footer Text or HTML <br /> Left Side','ingrid').'</label></th>
					<td><textarea name="form-bottom_footer_text_left" cols="60" rows="2" class="code">'.esc_textarea(get_option('tp_bottom_footer_text_left')).'</textarea>
					<br /><span class="description">'.__( 'Shortcodes are supported', 'ingrid' ).'</span></td>
				</tr>
				
				<tr>
					<th scope="row"><label>'.__('Bottom Footer Text or HTML <br /> Right Side','ingrid').'</label></th>
					<td><textarea name="form-bottom_footer_text_right" cols="60" rows="2" class="code">'.esc_textarea(get_option('tp_bottom_footer_text_right')).'</textarea>
					<br /><span class="description">'.__( 'Shortcodes are supported', 'ingrid' ).'</span></td>
				</tr>
				
			</table>

			<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="'.__( 'Save Changes', 'ingrid' ).'"  /></p>	
		
			</form>		
		</div>';
	}




?>