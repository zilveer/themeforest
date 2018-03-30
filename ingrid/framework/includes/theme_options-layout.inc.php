<?php

// THEME OPTIONS

// colors and layout settings
		
	//save settings
	if(!empty($_POST) && !empty($_GET['page']) && $_GET['page'] == 'tp_theme_layout'){		
	
				
		//save
		update_option('tp_panel_texture',$_POST['form-panel_texture']);			
		update_option('tp_page_background',$_POST['form-page_background']);			
		
		if(!empty($_POST['form-custom_page_bg'])){
			update_option('tp_custom_page_bg',$_POST['form-custom_page_bg']);			
		}
		
		update_option('tp_site_bg_color',$_POST['form-site_bg_color']);			
					
		
		header("Location: admin.php?page=tp_theme_layout&success=1");						
	}
		
		
	//display option layout	
	function tp_theme_layout(){
		global $framework_url;
		
			$tp_panel_texture = get_option('tp_panel_texture');
			
			$tp_page_background = get_option('tp_page_background');
			$tp_custom_page_bg = get_option('tp_custom_page_bg');
			
			$tp_panel_bg_color = get_option('tp_panel_bg_color');
			if($tp_panel_bg_color == ''){$tp_panel_bg_color='#2b2b2b';}
			
			$tp_site_bg_color = get_option('tp_site_bg_color');
			if($tp_site_bg_color == ''){$tp_site_bg_color='#ffffff';}
			

		if(!empty($_GET['success']) && $_GET['success'] == '1'){
			print '<div id="message" class="updated"><p>'.__('Settings are successfully saved','ingrid').'</p></div>';
		}
		
		
		print '<div class="wrap">	
			<div class="icon32"><img src="'.$framework_url.'icon-big.png" class="h2_icon" /><br /></div><h2>'.__( 'Layout Stylings', 'ingrid' ).'</h2>	
		
			<form method="post" action="" enctype="multipart/form-data">		

						
			<table class="form-table">
				
				<th scope="row"><label>'.__( 'Panel Backgrond Texture', 'ingrid' ).'</label></th>
				<td class="admin-texture">
					<label>
						<div class="admin-texture-div" id="texture-leather"><img src="'.get_bloginfo('template_url').'/images/admin-texture-leather.png" /></div>
						<span><input type="radio" name="form-panel_texture" value=""';
							if($tp_panel_texture == ''){
								print ' checked="checked"';
							}
						print ' /> '.__( 'Dark Leather', 'ingrid' ).'</span>
					</label>
					<label>
						<div class="admin-texture-div" id="texture-leather"><img src="'.get_bloginfo('template_url').'/images/admin-texture-red_leather.png" /></div>
						<span><input type="radio" name="form-panel_texture" value="red_leather"';
							if($tp_panel_texture == 'red_leather'){
								print ' checked="checked"';
							}
						print ' /> '.__( 'Red Leather', 'ingrid' ).'</span>
					</label>
					<label>
						<div class="admin-texture-div" id="texture-leather"><img src="'.get_bloginfo('template_url').'/images/admin-texture-brown_leather.png" /></div>
						<span><input type="radio" name="form-panel_texture" value="brown_leather"';
							if($tp_panel_texture == 'brown_leather'){
								print ' checked="checked"';
							}
						print ' /> '.__( 'Brown Leather', 'ingrid' ).'</span>
					</label>
					<label>
						<div class="admin-texture-div" id="texture-wood"><img src="'.get_bloginfo('template_url').'/images/admin-texture-wood.png" /></div>
						<span><input type="radio" name="form-panel_texture" value="wood"';
							if($tp_panel_texture == 'wood'){
								print ' checked="checked"';
							}
						print ' /> '.__( 'Wood', 'ingrid' ).'</span>
					</label>
					<label class="clear">
						<div class="admin-texture-div" id="texture-wood"><img src="'.get_bloginfo('template_url').'/images/admin-texture-dark_wood.png" /></div>
						<span><input type="radio" name="form-panel_texture" value="dark_wood"';
							if($tp_panel_texture == 'dark_wood'){
								print ' checked="checked"';
							}
						print ' /> '.__( 'Dark Wood', 'ingrid' ).'</span>
					</label>
					<label>
						<div class="admin-texture-div" id="texture-carbon"><img src="'.get_bloginfo('template_url').'/images/admin-texture-carbon.png" /></div>
						<span><input type="radio" name="form-panel_texture" value="carbon"';
							if($tp_panel_texture == 'carbon'){
								print ' checked="checked"';
							}
						print ' /> '.__( 'Carbon', 'ingrid' ).'</span>
					</label>
					<label>
						<div class="admin-texture-div" id="texture-none"><img src="'.get_bloginfo('template_url').'/images/admin-texture-none.png" /></div>
						<span><input type="radio" name="form-panel_texture" value="none"';
							if($tp_panel_texture == 'none'){
								print ' checked="checked"';
							}
						print ' /> '.__( 'None', 'ingrid' ).'</span>
					</label>
				</td>
				</tr>			
				
						
				<tr>
					<th scope="row"><label></label></th>
					<td></td>
				</tr>	
				</table>
				
				
				<table class="form-table">
				<tr>
					<th scope="row"><label>'.__( 'Page Background Color', 'ingrid' ).'</label></th>
					<td class="admin-bg">
						<input type="text" id="color1" class="colorwell" name="form-site_bg_color" maxlength="7" value="'.$tp_site_bg_color.'" />
						<input type="button" id="colorpicker_1" class="button" value="'.__('Select color','ingrid').'"  />
						<div id="colorpicker1" class="colorpicker"></div>
					</td>
				</tr>
				<tr>
					<th scope="row"><label>'.__( 'Page Backgrond Image', 'ingrid' ).'</label></th>
					<td class="admin-bg">
						<label>
							<div class="admin-bg-div" id="page_bg-smoke"><img src="'.get_bloginfo('template_url').'/images/admin-bg-smoke.jpg" /></div>
							<span><input type="radio" name="form-page_background" value=""';
								if($tp_page_background == ''){
									print ' checked="checked"';
								}
							print ' /> '.__( 'Smoke', 'ingrid' ).'</span>
						</label>
						<label>
							<div class="admin-bg-div" id="page_bg-silk"><img src="'.get_bloginfo('template_url').'/images/admin-bg-silk.jpg" /></div>
							<span><input type="radio" name="form-page_background" value="silk"';
								if($tp_page_background == 'silk'){
									print ' checked="checked"';
								}
							print ' /> '.__( 'Silk', 'ingrid' ).'</span>
						</label>	
						<label>
							<div class="admin-bg-div" id="page_bg-white"><img src="'.get_bloginfo('template_url').'/images/admin-bg-white.jpg" /></div>
							<span><input type="radio" name="form-page_background" value="white"';
								if($tp_page_background == 'white'){
									print ' checked="checked"';
								}
							print ' /> '.__( 'Clean Light', 'ingrid' ).'</span>
						</label>	
						<label>
							<div class="admin-bg-div" id="page_bg-none"><img src="'.get_bloginfo('template_url').'/images/admin-bg-none.jpg" /></div>
							<span><input type="radio" name="form-page_background" value="none"';
								if($tp_page_background == 'none'){
									print ' checked="checked"';
								}
							print ' /> '.__( 'No Image', 'ingrid' ).'</span>
						</label>	
						<label id="tp_custom_page_bg_click'; if(!function_exists( 'wp_enqueue_media' )){print '-old';} print '">';
							if($tp_page_background == 'custom' && $tp_custom_page_bg != ''){
								print '
								<div class="admin-bg-div" id="page_bg-custom" style="background-image: url(\''.$tp_custom_page_bg.'\')"></div>
								<span><input type="radio" name="form-page_background" value="custom"';
									if($tp_page_background == 'custom'){
										print ' checked="checked"';
									}
								print ' /> '.__( 'Custom Image', 'ingrid' ).'</span>
								<input type="hidden" name="form-custom_page_bg" id="form-custom_page_bg" value="" />';
							}else{								
								print '
								<div class="admin-bg-div" id="page_bg-custom"><img id="tp_custom_page_bg';
								if(!function_exists( 'wp_enqueue_media' )){print '-old';}
								print '" src="'.get_bloginfo('template_url').'/images/admin-bg-custom.jpg" /></div>
								<span><input type="radio" name="form-page_background" value="custom"';
									if($tp_page_background == 'custom'){
										print ' checked="checked"';
									}
								print ' /> '.__( 'Custom Image', 'ingrid' ).'</span>
								<input type="hidden" name="form-custom_page_bg" id="form-custom_page_bg" value="" />';
							}
							print '
						</label>
					</td>
				</tr>	
				
				
				<tr>
					<th scope="row"><label></label></th>
					<td></td>
				</tr>	
			</table>

			<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="'.__( 'Save Changes', 'ingrid' ).'"  /></p>	
			
			</form>		
		</div>';
	}




?>