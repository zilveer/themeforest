<?php

// THEME OPTIONS

// typography settings
	
	//remove custom font
	if(!empty($_GET['page']) && $_GET['page'] == 'tp_theme_typography' && !empty($_GET['remove'])){		
		$tp_typography_custom_fonts = unserialize(get_option('tp_typography_custom_fonts'));		
		if(!empty($tp_typography_custom_fonts)){			
			foreach($tp_typography_custom_fonts as $k => $tp_f){
				$_GET['remove'] = str_replace(' ','+',$_GET['remove']);
				if($tp_f != $_GET['remove']){
					$nuarr[] = $tp_f;					
				}
			}
			
			update_option('tp_typography_custom_fonts',serialize($nuarr));
		}
				
		header("Location: admin.php?page=tp_theme_typography");
	}
	
	
	//reset
	if(!empty($_GET['reset']) && $_GET['reset'] == '1'){
		delete_option('tp_typography_custom_fonts');
		delete_option('tp_fontface_font_family');
		
		delete_option('tp_txt_body_font');
		delete_option('tp_txt_body_size');
		delete_option('tp_txt_body_style');
		delete_option('tp_txt_body_color');
				
		
		delete_option('tp_txt_menu_font');
		delete_option('tp_txt_menu_size');
		delete_option('tp_txt_menu_style');
		delete_option('tp_txt_menu_color');
		delete_option('tp_txt_menu_hover_color');
			
			
		delete_option('tp_txt_link_font');
		delete_option('tp_txt_link_size');
		delete_option('tp_txt_link_style');
		delete_option('tp_txt_link_color');
		delete_option('tp_txt_link_hover_color');
		
		
		delete_option('tp_txt_footer_link_font');
		delete_option('tp_txt_footer_link_size');
		delete_option('tp_txt_footer_link_style');
		delete_option('tp_txt_footer_link_color');
		delete_option('tp_txt_footer_link_hover_color');
		
		delete_option('tp_txt_h1_font');
		delete_option('tp_txt_h1_size');
		delete_option('tp_txt_h1_style');
		delete_option('tp_txt_h1_color');
		
		delete_option('tp_txt_h2_font');
		delete_option('tp_txt_h2_size');
		delete_option('tp_txt_h2_style');
		delete_option('tp_txt_h2_color');
			
		delete_option('tp_txt_h3_font');
		delete_option('tp_txt_h3_size');
		delete_option('tp_txt_h3_style');
		delete_option('tp_txt_h3_color');
			
		delete_option('tp_txt_h4_font');
		delete_option('tp_txt_h4_size');
		delete_option('tp_txt_h4_style');
		delete_option('tp_txt_h4_color');
			
		delete_option('tp_txt_h5_font');
		delete_option('tp_txt_h5_size');
		delete_option('tp_txt_h5_style');
		delete_option('tp_txt_h5_color');
			
		delete_option('tp_txt_h6_font');
		delete_option('tp_txt_h6_size');
		delete_option('tp_txt_h6_style');
		delete_option('tp_txt_h6_color');

		header("Location: admin.php?page=tp_theme_typography");	
	}
	
	
	//save settings
	if(!empty($_POST) && !empty($_GET['page']) && $_GET['page'] == 'tp_theme_typography'){		
		//load custom fonts if set
			$tp_typography_custom_fonts = get_option('tp_typography_custom_fonts');
		
		//save font family
			update_option('tp_fontface_font_family',$_POST['fontface_font_family']);
		
		//add custom font			
			if($_POST['form-add_custom_font'] != ''){
				//$fontname = ucwords(strtolower($_POST['form-add_custom_font']));
				$fontname = $_POST['form-add_custom_font'];
				$fontname = str_replace(' ','+',$fontname);				
				$resp = wp_remote_get('http://fonts.googleapis.com/css?family='.$fontname);				
				if($resp['response']['message'] == 'Bad Request'){
					$error = '1';
				}else{				
					if($tp_typography_custom_fonts != ''){
						//load existing array, update
						$typo_arr = unserialize($tp_typography_custom_fonts);
						if(!in_array($fontname,$typo_arr)){
							$typo_arr[] = $fontname;
						}
						update_option('tp_typography_custom_fonts',serialize($typo_arr));
					}else{
						//create new array
						$typo_arr[] = $fontname;
						update_option('tp_typography_custom_fonts',serialize($typo_arr));
					}
				}
			}
			
			
		//save advanced settings			
			update_option('tp_txt_body_font',$_POST['form-txt-body-font']); 
			update_option('tp_txt_body_size',$_POST['form-txt-body-size']); 
			update_option('tp_txt_body_style',$_POST['form-txt-body-style']); 
			if($_POST['form-txt-body-color'] != '#'){ update_option('tp_txt_body_color',$_POST['form-txt-body-color']); }
			
			update_option('tp_txt_menu_font',$_POST['form-txt-menu-font']); 
			update_option('tp_txt_menu_size',$_POST['form-txt-menu-size']); 
			update_option('tp_txt_menu_style',$_POST['form-txt-menu-style']); 
			if($_POST['form-txt-menu-color'] != '#'){ update_option('tp_txt_menu_color',$_POST['form-txt-menu-color']);	 }
			if($_POST['form-txt-menu-hover-color'] != '#'){ update_option('tp_txt_menu_hover_color',$_POST['form-txt-menu-hover-color']);	 }
			
			
			update_option('tp_txt_link_font',$_POST['form-txt-link-font']); 
			update_option('tp_txt_link_size',$_POST['form-txt-link-size']); 
			update_option('tp_txt_link_style',$_POST['form-txt-link-style']); 
			if($_POST['form-txt-link-color'] != '#'){ update_option('tp_txt_link_color',$_POST['form-txt-link-color']);	 }
			
			if($_POST['form-txt-link-hover-color'] != '#'){ update_option('tp_txt_link_hover_color',$_POST['form-txt-link-hover-color']); }
		
		
			update_option('tp_txt_footer_link_font',$_POST['form-txt-footer_link-font']); 
			update_option('tp_txt_footer_link_size',$_POST['form-txt-footer_link-size']); 
			update_option('tp_txt_footer_link_style',$_POST['form-txt-footer_link-style']); 
			if($_POST['form-txt-footer_link-color'] != '#'){ update_option('tp_txt_footer_link_color',$_POST['form-txt-footer_link-color']);	 }
			
			if($_POST['form-txt-footer_link-hover-color'] != '#'){ update_option('tp_txt_footer_link_hover_color',$_POST['form-txt-footer_link-hover-color']); }
		
		
			update_option('tp_txt_h1_font',$_POST['form-txt-h1-font']); 
			update_option('tp_txt_h1_size',$_POST['form-txt-h1-size']); 
			update_option('tp_txt_h1_style',$_POST['form-txt-h1-style']); 
			if($_POST['form-txt-h1-color'] != '#'){ update_option('tp_txt_h1_color',$_POST['form-txt-h1-color']); }
			
			update_option('tp_txt_h2_font',$_POST['form-txt-h2-font']); 
			update_option('tp_txt_h2_size',$_POST['form-txt-h2-size']); 
			update_option('tp_txt_h2_style',$_POST['form-txt-h2-style']); 
			if($_POST['form-txt-h2-color'] != '#'){ update_option('tp_txt_h2_color',$_POST['form-txt-h2-color']); }
			
			update_option('tp_txt_h3_font',$_POST['form-txt-h3-font']); 
			update_option('tp_txt_h3_size',$_POST['form-txt-h3-size']); 
			update_option('tp_txt_h3_style',$_POST['form-txt-h3-style']); 
			if($_POST['form-txt-h3-color'] != '#'){ update_option('tp_txt_h3_color',$_POST['form-txt-h3-color']); }
			
			update_option('tp_txt_h4_font',$_POST['form-txt-h4-font']); 
			update_option('tp_txt_h4_size',$_POST['form-txt-h4-size']); 
			update_option('tp_txt_h4_style',$_POST['form-txt-h4-style']); 
			if($_POST['form-txt-h4-color'] != '#'){ update_option('tp_txt_h4_color',$_POST['form-txt-h4-color']); }
			
			update_option('tp_txt_h5_font',$_POST['form-txt-h5-font']); 
			update_option('tp_txt_h5_size',$_POST['form-txt-h5-size']); 
			update_option('tp_txt_h5_style',$_POST['form-txt-h5-style']); 
			if($_POST['form-txt-h5-color'] != '#'){ update_option('tp_txt_h5_color',$_POST['form-txt-h5-color']); }
			
			update_option('tp_txt_h6_font',$_POST['form-txt-h6-font']); 
			update_option('tp_txt_h6_size',$_POST['form-txt-h6-size']); 
			update_option('tp_txt_h6_style',$_POST['form-txt-h6-style']); 
			if($_POST['form-txt-h6-color'] != '#'){ update_option('tp_txt_h6_color',$_POST['form-txt-h6-color']); }
		
		
		if($error == '1'){
			header("Location: admin.php?page=tp_theme_typography&error=1");						
		}else{
			header("Location: admin.php?page=tp_theme_typography&success=1");						
		}
	}
		
		
	//display option layout	
	function tp_theme_typography(){
		global $framework_url;

		if(!empty($_GET['success']) && $_GET['success'] == '1'){
			print '<div id="message" class="updated"><p>'.__('Settings are successfully saved','ingrid').'</p></div>';
		}		
		
		if(!empty($_GET['error']) && $_GET['error'] == '1'){
			print '<div id="message" class="error"><p>'.__('Font not found!','ingrid').'</p></div>';
		}

		
		//load saved values
		$tp_fontface_font_family = get_option('tp_fontface_font_family');
		$tp_typography_custom_fonts = get_option('tp_typography_custom_fonts');
		
		$tp_txt_body_font = get_option('tp_txt_body_font');
		$tp_txt_body_size = get_option('tp_txt_body_size');
		$tp_txt_body_style = get_option('tp_txt_body_style');
		$tp_txt_body_color = get_option('tp_txt_body_color');	if($tp_txt_body_color == ''){$tp_txt_body_color = '#';}
		
		$tp_txt_menu_font = get_option('tp_txt_menu_font');
		$tp_txt_menu_size = get_option('tp_txt_menu_size');
		$tp_txt_menu_style = get_option('tp_txt_menu_style');
		$tp_txt_menu_color = get_option('tp_txt_menu_color');	if($tp_txt_menu_color == ''){$tp_txt_menu_color = '#';}
		$tp_txt_menu_hover_color = get_option('tp_txt_menu_hover_color');	if($tp_txt_menu_hover_color == ''){$tp_txt_menu_hover_color = '#';}
		
		$tp_txt_link_font = get_option('tp_txt_link_font');
		$tp_txt_link_size = get_option('tp_txt_link_size');
		$tp_txt_link_style = get_option('tp_txt_link_style');
		$tp_txt_link_color = get_option('tp_txt_link_color');	if($tp_txt_link_color == ''){$tp_txt_link_color = '#';}
		$tp_txt_link_hover_color = get_option('tp_txt_link_hover_color');	if($tp_txt_link_hover_color == ''){$tp_txt_link_hover_color = '#';}
		
		$tp_txt_footer_link_font = get_option('tp_txt_footer_link_font');
		$tp_txt_footer_link_size = get_option('tp_txt_footer_link_size');
		$tp_txt_footer_link_style = get_option('tp_txt_footer_link_style');
		$tp_txt_footer_link_color = get_option('tp_txt_footer_link_color');	if($tp_txt_footer_link_color == ''){$tp_txt_footer_link_color = '#';}
		$tp_txt_footer_link_hover_color = get_option('tp_txt_footer_link_hover_color');	if($tp_txt_footer_link_hover_color == ''){$tp_txt_footer_link_hover_color = '#';}
		
		$tp_txt_h1_font = get_option('tp_txt_h1_font');
		$tp_txt_h1_size = get_option('tp_txt_h1_size');
		$tp_txt_h1_style = get_option('tp_txt_h1_style');
		$tp_txt_h1_color = get_option('tp_txt_h1_color');	if($tp_txt_h1_color == ''){$tp_txt_h1_color = '#';}
		
		$tp_txt_h2_font = get_option('tp_txt_h2_font');
		$tp_txt_h2_size = get_option('tp_txt_h2_size');
		$tp_txt_h2_style = get_option('tp_txt_h2_style');
		$tp_txt_h2_color = get_option('tp_txt_h2_color');	if($tp_txt_h2_color == ''){$tp_txt_h2_color = '#';}
		
		$tp_txt_h3_font = get_option('tp_txt_h3_font');
		$tp_txt_h3_size = get_option('tp_txt_h3_size');
		$tp_txt_h3_style = get_option('tp_txt_h3_style');
		$tp_txt_h3_color = get_option('tp_txt_h3_color');	if($tp_txt_h3_color == ''){$tp_txt_h3_color = '#';}
		
		$tp_txt_h4_font = get_option('tp_txt_h4_font');
		$tp_txt_h4_size = get_option('tp_txt_h4_size');
		$tp_txt_h4_style = get_option('tp_txt_h4_style');
		$tp_txt_h4_color = get_option('tp_txt_h4_color');	if($tp_txt_h4_color == ''){$tp_txt_h4_color = '#';}
		
		$tp_txt_h5_font = get_option('tp_txt_h5_font');
		$tp_txt_h5_size = get_option('tp_txt_h5_size');
		$tp_txt_h5_style = get_option('tp_txt_h5_style');
		$tp_txt_h5_color = get_option('tp_txt_h5_color');	if($tp_txt_h5_color == ''){$tp_txt_h5_color = '#';}
		
		$tp_txt_h6_font = get_option('tp_txt_h6_font');
		$tp_txt_h6_size = get_option('tp_txt_h6_size');
		$tp_txt_h6_style = get_option('tp_txt_h6_style');
		$tp_txt_h6_color = get_option('tp_txt_h6_color');	if($tp_txt_h6_color == ''){$tp_txt_h6_color = '#';}
		
		
		print '<div class="wrap">	
			<div class="icon32"><img src="'.$framework_url.'icon-big.png" class="h2_icon" /><br /></div><h2>'.__( 'Typography', 'ingrid' ).'</h2>	
		
			<form method="post" action="" enctype="multipart/form-data">		

			<h3>'.__('Recommended Fonts','ingrid').'</h3>
			
			<table class="form-table">
				
				
				<tr class="font-face-settings">					
					<td colspan="2">
						<ul class="font-list">
						<li><label><input name="fontface_font_family" type="radio" value="" '; if($tp_fontface_font_family == ''){print 'checked="checked" ';} print '/><span id="preview-1"><h1>PT Sans ('.__('Default','ingrid').')</h1><br />It\'s a preview sentence with  numbers: 0123456789</span></label></li>
						
						<li><label><input name="fontface_font_family" type="radio" value="Archivo+Narrow" '; if($tp_fontface_font_family == 'Archivo+Narrow'){print 'checked="checked" ';} print '/><span id="preview-6"><h1>Archivo Narrow</h1><br />'.__('It\'s a preview sentence with  numbers: 0123456789','ingrid').'</span></label></li>				
						<li><label><input name="fontface_font_family" type="radio" value="Brawler" '; if($tp_fontface_font_family == 'Brawler'){print 'checked="checked" ';} print '/><span id="preview-3"><h1>Brawler</h1><br />'.__('It\'s a preview sentence with  numbers: 0123456789','ingrid').'</span></label></li>
						<li><label><input name="fontface_font_family" type="radio" value="Comfortaa" '; if($tp_fontface_font_family == 'Comfortaa'){print 'checked="checked" ';} print '/><span id="preview-7"><h1>Comfortaa</h1><br />'.__('It\'s a preview sentence with  numbers: 0123456789','ingrid').'</span></label></li>				
						<li><label><input name="fontface_font_family" type="radio" value="Droid+Serif" '; if($tp_fontface_font_family == 'Droid+Serif'){print 'checked="checked" ';} print '/><span id="preview-4"><h1>Droid Serif</h1><br />'.__('It\'s a preview sentence with  numbers: 0123456789','ingrid').'</span></label></li>
						<li><label><input name="fontface_font_family" type="radio" value="Fjalla+One" '; if($tp_fontface_font_family == 'Fjalla+One'){print 'checked="checked" ';} print '/><span id="preview-5"><h1>Fjalla One</h1><br />'.__('It\'s a preview sentence with  numbers: 0123456789','ingrid').'</span></label></li>						
						<li><label><input name="fontface_font_family" type="radio" value="Kaushan+Script" '; if($tp_fontface_font_family == 'Kaushan+Script'){print 'checked="checked" ';} print '/><span id="preview-8"><h1>Kaushan Script</h1><br />'.__('It\'s a preview sentence with  numbers: 0123456789','ingrid').'</span></label></li>
						<li><label><input name="fontface_font_family" type="radio" value="Libre+Baskerville" '; if($tp_fontface_font_family == 'Libre+Baskerville'){print 'checked="checked" ';} print '/><span id="preview-9"><h1>Libre Baskerville</h1><br />'.__('It\'s a preview sentence with  numbers: 0123456789','ingrid').'</span></label></li>				
						<li><label><input name="fontface_font_family" type="radio" value="Open+Sans" '; if($tp_fontface_font_family == 'Open+Sans'){print 'checked="checked" ';} print '/><span id="preview-2"><h1>Open Sans</h1><br />'.__('It\'s a preview sentence with  numbers: 0123456789','ingrid').'</span></label></li>						
						<li><label><input name="fontface_font_family" type="radio" value="Roboto+Condensed" '; if($tp_fontface_font_family == 'Roboto+Condensed'){print 'checked="checked" ';} print '/><span id="preview-10"><h1>Roboto Condensed</h1><br />'.__('It\'s a preview sentence with  numbers: 0123456789','ingrid').'</span></label></li>						
						';
						
						if(!empty($tp_typography_custom_fonts)){
							if(!is_array($tp_typography_custom_fonts)){ $tp_typography_custom_fonts = unserialize($tp_typography_custom_fonts); }
							
							
							if(!empty($tp_typography_custom_fonts)){	
								print '<li>&nbsp;</li><li>&nbsp;</li>';
								foreach($tp_typography_custom_fonts as $cf){
									print '
									<li><label>
										<input name="fontface_font_family" type="radio" value="'.$cf.'" '; if($tp_fontface_font_family == $cf){print 'checked="checked" ';} print '/>
										<span id="preview-'.strtolower(str_replace('+','_',$cf)).'"><h1>'.str_replace('+',' ',$cf).' ('.__('Custom','ingrid').')</h1><br />'.__('It\'s a preview sentence with  numbers: 0123456789','ingrid').'
										<br /><br /><a href="admin.php?page=tp_theme_typography&remove='.$cf.'">'.__('Click here to remove','ingrid').'</a>
										</span>
										</label>
									</li>';							
								}
							}
						}
						
						print '						
						</ul>
					</td>
				</tr>
						
				<tr>
					<td><h3>'.__('Add Your Custom Google Font','ingrid').'</h3>
					'.__('Just select a font from <a href="http://www.google.com/webfonts" target="_blank">Google Web Fonts</a> directory, type your selected font\'s <strong>exact name</strong> below, hit enter and it will appear in the list!','ingrid').'</td>
				</tr>
				<tr>					
					<td>
						<label>'.__( 'Google Font Name', 'ingrid' ).'&nbsp;&nbsp;&nbsp;</label>
						<input type="text" name="form-add_custom_font" value="" class="regular-text" />
					</td>
				</tr>
				
				
				
						
				<tr>
					<td></td>
				</tr>	
				</table>
				
				
				<h3>'.__('Advanced Settings','ingrid').'</h3>
				
				<table class="form-table">
				<tr>
					<td width="100%">
						<table id="advanced-fs">
							<tr style="background-color: #f5f5f5;">
								<td width="20%"></td>
								<td width="16%"><strong>'.__('Font Family','ingrid').'</strong></td>
								<td width="10%"><strong>'.__('Size','ingrid').'</strong></td>
								<td width="10%"><strong>'.__('Style','ingrid').'</strong></td>
								<td width=""><strong>'.__('Color','ingrid').'</strong></td>
								<td width=""><strong>'.__('Hover Color','ingrid').'</strong></td>
							</tr>
							
							
							<tr>
								<td><strong>'.__('Body text','ingrid').'</strong></td>
								<td><select name="form-txt-body-font" class="form-as-fontfamily">
									<option value="">-</option>
									<optgroup label="'.__('Recommended Fonts','ingrid').'">
										<option value="Archivo+Narrow"'; if($tp_txt_body_font == 'Archivo+Narrow'){ print ' selected="selected"';} print '>Archivo Narrow</option>
										<option value="Brawler"'; if($tp_txt_body_font == 'Brawler'){ print ' selected="selected"';} print '>Brawler</option>
										<option value="Comfortaa"'; if($tp_txt_body_font == 'Comfortaa'){ print ' selected="selected"';} print '>Comfortaa</option>
										<option value="Droid+Serif"'; if($tp_txt_body_font == 'Droid+Serif'){ print ' selected="selected"';} print '>Droid Serif</option>
										<option value="Fjalla+One"'; if($tp_txt_body_font == 'Fjalla+One'){ print ' selected="selected"';} print '>Fjalla One</option>
										<option value="Kaushan+Script"'; if($tp_txt_body_font == 'Kaushan+Script'){ print ' selected="selected"';} print '>Kaushan Script</option>
										<option value="Libre+Baskerville"'; if($tp_txt_body_font == 'Libre+Baskerville'){ print ' selected="selected"';} print '>Libre Baskerville</option>
										<option value="Open+Sans"'; if($tp_txt_body_font == 'Open+Sans'){ print ' selected="selected"';} print '>Open Sans</option>
										<option value="PT+Sans"'; if($tp_txt_body_font == 'PT+Sans'){ print ' selected="selected"';} print '>PT Sans</option>
										<option value="Roboto+Condensed"'; if($tp_txt_body_font == 'Roboto+Condensed'){ print ' selected="selected"';} print '>Roboto Condensed</option>
									</optgroup>
									<optgroup label="'.__('Your Custom Fonts','ingrid').'">
									';
										//load custom fonts
										if(!empty($tp_typography_custom_fonts)){
											if(!is_array($tp_typography_custom_fonts)){$tp_typography_custom_fonts = unserialize($tp_typography_custom_fonts);}
											foreach($tp_typography_custom_fonts as $cf){
												print '<option value="'.$cf.'"'; if($tp_txt_body_font == $cf){ print ' selected="selected"';} print '>'.str_replace('+',' ',$cf).'</option>';
											}
										}else{
											print '<option value="" style="font-style: italic;">'.__('None added yet','ingrid').'</option>';
										}
									print '
									</optgroup>
									</select>
									
								</td>
								<td><select name="form-txt-body-size">
									<option value="">-</option>';
									
									for($a = 9;$a <= 26;$a++){
										if($tp_txt_body_size == $a.'px'){
											print '<option value="'.$a.'px" selected="selected">'.$a.'px</option>';
										}else{
											print '<option value="'.$a.'px">'.$a.'px</option>';
										}
									}
									
									print '							
									</select>
								</td>
								<td><select name="form-txt-body-style">
									<option value="">Regular</option>';
									
									$tp_txt_body_style = get_option('tp_txt_body_style');
									
									print '
									<option value="bold" style="font-weight:bold;"'; if($tp_txt_body_style == 'bold'){print ' selected="selected"';} print '>'.__('Bold','ingrid').'</option>
									<option value="italic" style="font-style:italic;"'; if($tp_txt_body_style == 'italic'){print ' selected="selected"';} print '>'.__('Italic','ingrid').'</option>									
									</select>
								</td>
								<td>
									<input type="text" id="color1" class="colorwell" name="form-txt-body-color" maxlength="7" value="'.$tp_txt_body_color.'" />
									<input type="button" id="colorpicker_1" class="button" value="'.__('Select color','ingrid').'"  />
									<div id="colorpicker1" class="colorpicker"></div>
								</td>
								<td>-</td>
							</tr>
							
							
							<tr class="alternate">
								<td><strong>'.__('Menu','ingrid').'</strong></td>
								<td><select name="form-txt-menu-font" class="form-as-fontfamily">
									<option value="">-</option>
									<optgroup label="'.__('Recommended Fonts','ingrid').'">
										<option value="Archivo+Narrow"'; if($tp_txt_menu_font == 'Archivo+Narrow'){ print ' selected="selected"';} print '>Archivo Narrow</option>
										<option value="Brawler"'; if($tp_txt_menu_font == 'Brawler'){ print ' selected="selected"';} print '>Brawler</option>
										<option value="Comfortaa"'; if($tp_txt_menu_font == 'Comfortaa'){ print ' selected="selected"';} print '>Comfortaa</option>
										<option value="Droid+Serif"'; if($tp_txt_menu_font == 'Droid+Serif'){ print ' selected="selected"';} print '>Droid Serif</option>
										<option value="Fjalla+One"'; if($tp_txt_menu_font == 'Fjalla+One'){ print ' selected="selected"';} print '>Fjalla One</option>
										<option value="Kaushan+Script"'; if($tp_txt_menu_font == 'Kaushan+Script'){ print ' selected="selected"';} print '>Kaushan Script</option>
										<option value="Libre+Baskerville"'; if($tp_txt_menu_font == 'Libre+Baskerville'){ print ' selected="selected"';} print '>Libre Baskerville</option>
										<option value="Open+Sans"'; if($tp_txt_menu_font == 'Open+Sans'){ print ' selected="selected"';} print '>Open Sans</option>
										<option value="PT+Sans"'; if($tp_txt_menu_font == 'PT+Sans'){ print ' selected="selected"';} print '>PT Sans</option>
										<option value="Roboto+Condensed"'; if($tp_txt_menu_font == 'Roboto+Condensed'){ print ' selected="selected"';} print '>Roboto Condensed</option>
									</optgroup>
									<optgroup label="'.__('Your Custom Fonts','ingrid').'">
									';
										//load custom fonts
										if(!empty($tp_typography_custom_fonts)){
											if(!is_array($tp_typography_custom_fonts)){$tp_typography_custom_fonts = unserialize($tp_typography_custom_fonts);}
											foreach($tp_typography_custom_fonts as $cf){
												print '<option value="'.$cf.'"'; if($tp_txt_menu_font == $cf){ print ' selected="selected"';} print '>'.str_replace('+',' ',$cf).'</option>';
											}
										}else{
											print '<option value="" style="font-style: italic;">'.__('None added yet','ingrid').'</option>';
										}
									print '
									</optgroup>
									</select>
									
								</td>
								<td><select name="form-txt-menu-size">
									<option value="">-</option>';
									
									for($a = 9;$a <= 26;$a++){
										if($tp_txt_menu_size == $a.'px'){
											print '<option value="'.$a.'px" selected="selected">'.$a.'px</option>';
										}else{
											print '<option value="'.$a.'px">'.$a.'px</option>';
										}
									}
									
									print '							
									</select>
								</td>
								<td><select name="form-txt-menu-style">
									<option value="">Regular</option>';
									
									$tp_txt_menu_style = get_option('tp_txt_menu_style');
									
									print '
									<option value="bold" style="font-weight:bold;"'; if($tp_txt_menu_style == 'bold'){print ' selected="selected"';} print '>'.__('Bold','ingrid').'</option>
									<option value="italic" style="font-style:italic;"'; if($tp_txt_menu_style == 'italic'){print ' selected="selected"';} print '>'.__('Italic','ingrid').'</option>									
									</select>
								</td>
								<td>
									<input type="text" id="color2" class="colorwell" name="form-txt-menu-color" maxlength="7" value="'.$tp_txt_menu_color.'" />
									<input type="button" id="colorpicker_2" class="button" value="'.__('Select color','ingrid').'"  />
									<div id="colorpicker2" class="colorpicker"></div>
								</td>
								<td>
									<input type="text" id="color3" class="colorwell" name="form-txt-menu-hover-color" maxlength="7" value="'.$tp_txt_menu_hover_color.'" />
									<input type="button" id="colorpicker_3" class="button" value="'.__('Select color','ingrid').'"  />
									<div id="colorpicker3" class="colorpicker"></div></td>
							</tr>
							
							
							<tr>
								<td><strong>'.__('Link','ingrid').'</strong></td>
								<td><select name="form-txt-link-font" class="form-as-fontfamily">
									<option value="">-</option>
									<optgroup label="'.__('Recommended Fonts','ingrid').'">
										<option value="Archivo+Narrow"'; if($tp_txt_link_font == 'Archivo+Narrow'){ print ' selected="selected"';} print '>Archivo Narrow</option>
										<option value="Brawler"'; if($tp_txt_link_font == 'Brawler'){ print ' selected="selected"';} print '>Brawler</option>
										<option value="Comfortaa"'; if($tp_txt_link_font == 'Comfortaa'){ print ' selected="selected"';} print '>Comfortaa</option>
										<option value="Droid+Serif"'; if($tp_txt_link_font == 'Droid+Serif'){ print ' selected="selected"';} print '>Droid Serif</option>
										<option value="Fjalla+One"'; if($tp_txt_link_font == 'Fjalla+One'){ print ' selected="selected"';} print '>Fjalla One</option>
										<option value="Kaushan+Script"'; if($tp_txt_link_font == 'Kaushan+Script'){ print ' selected="selected"';} print '>Kaushan Script</option>
										<option value="Libre+Baskerville"'; if($tp_txt_link_font == 'Libre+Baskerville'){ print ' selected="selected"';} print '>Libre Baskerville</option>
										<option value="Open+Sans"'; if($tp_txt_link_font == 'Open+Sans'){ print ' selected="selected"';} print '>Open Sans</option>
										<option value="PT+Sans"'; if($tp_txt_link_font == 'PT+Sans'){ print ' selected="selected"';} print '>PT Sans</option>
										<option value="Roboto+Condensed"'; if($tp_txt_link_font == 'Roboto+Condensed'){ print ' selected="selected"';} print '>Roboto Condensed</option>
									</optgroup>
									<optgroup label="'.__('Your Custom Fonts','ingrid').'">
									';
										//load custom fonts
										if(!empty($tp_typography_custom_fonts)){
											if(!is_array($tp_typography_custom_fonts)){$tp_typography_custom_fonts = unserialize($tp_typography_custom_fonts);}
											foreach($tp_typography_custom_fonts as $cf){
												print '<option value="'.$cf.'"'; if($tp_txt_link_font == $cf){ print ' selected="selected"';} print '>'.str_replace('+',' ',$cf).'</option>';
											}
										}else{
											print '<option value="" style="font-style: italic;">'.__('None added yet','ingrid').'</option>';
										}
									print '
									</optgroup>
									</select>
									
								</td>
								<td><select name="form-txt-link-size">
									<option value="">-</option>';
									
									for($a = 9;$a <= 26;$a++){
										if($tp_txt_link_size == $a.'px'){
											print '<option value="'.$a.'px" selected="selected">'.$a.'px</option>';
										}else{
											print '<option value="'.$a.'px">'.$a.'px</option>';
										}
									}
									
									print '							
									</select>
								</td>
								<td><select name="form-txt-link-style">
									<option value="">Regular</option>';
									
									$tp_txt_link_style = get_option('tp_txt_link_style');
									
									print '
									<option value="bold" style="font-weight:bold;"'; if($tp_txt_link_style == 'bold'){print ' selected="selected"';} print '>'.__('Bold','ingrid').'</option>
									<option value="italic" style="font-style:italic;"'; if($tp_txt_link_style == 'italic'){print ' selected="selected"';} print '>'.__('Italic','ingrid').'</option>									
									</select>
								</td>
								<td>
									<input type="text" id="color4" class="colorwell" name="form-txt-link-color" maxlength="7" value="'.$tp_txt_link_color.'" />
									<input type="button" id="colorpicker_4" class="button" value="'.__('Select color','ingrid').'"  />
									<div id="colorpicker4" class="colorpicker"></div>
								</td>
								<td>
									<input type="text" id="color5" class="colorwell" name="form-txt-link-hover-color" maxlength="7" value="'.$tp_txt_link_hover_color.'" />
									<input type="button" id="colorpicker_5" class="button" value="'.__('Select color','ingrid').'"  />
									<div id="colorpicker5" class="colorpicker"></div></td>
							</tr>
							
							
							
							<tr>
								<td><strong>'.__('Footer Link','ingrid').'</strong></td>
								<td><select name="form-txt-footer_link-font" class="form-as-fontfamily">
									<option value="">-</option>
									<optgroup label="'.__('Recommended Fonts','ingrid').'">
										<option value="Archivo+Narrow"'; if($tp_txt_footer_link_font == 'Archivo+Narrow'){ print ' selected="selected"';} print '>Archivo Narrow</option>
										<option value="Brawler"'; if($tp_txt_footer_link_font == 'Brawler'){ print ' selected="selected"';} print '>Brawler</option>
										<option value="Comfortaa"'; if($tp_txt_footer_link_font == 'Comfortaa'){ print ' selected="selected"';} print '>Comfortaa</option>
										<option value="Droid+Serif"'; if($tp_txt_footer_link_font == 'Droid+Serif'){ print ' selected="selected"';} print '>Droid Serif</option>
										<option value="Fjalla+One"'; if($tp_txt_footer_link_font == 'Fjalla+One'){ print ' selected="selected"';} print '>Fjalla One</option>
										<option value="Kaushan+Script"'; if($tp_txt_footer_link_font == 'Kaushan+Script'){ print ' selected="selected"';} print '>Kaushan Script</option>
										<option value="Libre+Baskerville"'; if($tp_txt_footer_link_font == 'Libre+Baskerville'){ print ' selected="selected"';} print '>Libre Baskerville</option>
										<option value="Open+Sans"'; if($tp_txt_footer_link_font == 'Open+Sans'){ print ' selected="selected"';} print '>Open Sans</option>
										<option value="PT+Sans"'; if($tp_txt_footer_link_font == 'PT+Sans'){ print ' selected="selected"';} print '>PT Sans</option>
										<option value="Roboto+Condensed"'; if($tp_txt_footer_link_font == 'Roboto+Condensed'){ print ' selected="selected"';} print '>Roboto Condensed</option>
									</optgroup>
									<optgroup label="'.__('Your Custom Fonts','ingrid').'">
									';
										//load custom fonts
										if(!empty($tp_typography_custom_fonts)){
											if(!is_array($tp_typography_custom_fonts)){$tp_typography_custom_fonts = unserialize($tp_typography_custom_fonts);}
											foreach($tp_typography_custom_fonts as $cf){
												print '<option value="'.$cf.'"'; if($tp_txt_footer_link_font == $cf){ print ' selected="selected"';} print '>'.str_replace('+',' ',$cf).'</option>';
											}
										}else{
											print '<option value="" style="font-style: italic;">'.__('None added yet','ingrid').'</option>';
										}
									print '
									</optgroup>
									</select>
									
								</td>
								<td><select name="form-txt-footer_link-size">
									<option value="">-</option>';
									
									for($a = 9;$a <= 26;$a++){
										if($tp_txt_footer_link_size == $a.'px'){
											print '<option value="'.$a.'px" selected="selected">'.$a.'px</option>';
										}else{
											print '<option value="'.$a.'px">'.$a.'px</option>';
										}
									}
									
									print '							
									</select>
								</td>
								<td><select name="form-txt-footer_link-style">
									<option value="">Regular</option>';
									
									$tp_txt_footer_link_style = get_option('tp_txt_footer_link_style');
									
									print '
									<option value="bold" style="font-weight:bold;"'; if($tp_txt_footer_link_style == 'bold'){print ' selected="selected"';} print '>'.__('Bold','ingrid').'</option>
									<option value="italic" style="font-style:italic;"'; if($tp_txt_footer_link_style == 'italic'){print ' selected="selected"';} print '>'.__('Italic','ingrid').'</option>									
									</select>
								</td>
								<td>
									<input type="text" id="color12" class="colorwell" name="form-txt-footer_link-color" maxlength="7" value="'.$tp_txt_footer_link_color.'" />
									<input type="button" id="colorpicker_12" class="button" value="'.__('Select color','ingrid').'"  />
									<div id="colorpicker12" class="colorpicker"></div>
								</td>
								<td>
									<input type="text" id="color13" class="colorwell" name="form-txt-footer_link-hover-color" maxlength="7" value="'.$tp_txt_footer_link_hover_color.'" />
									<input type="button" id="colorpicker_13" class="button" value="'.__('Select color','ingrid').'"  />
									<div id="colorpicker13" class="colorpicker"></div></td>
							</tr>
							
							
							
							<tr class="alternate">
								<td><strong>'.__('Heading 1','ingrid').'</strong></td>
								<td><select name="form-txt-h1-font" class="form-as-fontfamily">
									<option value="">-</option>
									<optgroup label="'.__('Recommended Fonts','ingrid').'">
										<option value="Archivo+Narrow"'; if($tp_txt_h1_font == 'Archivo+Narrow'){ print ' selected="selected"';} print '>Archivo Narrow</option>
										<option value="Brawler"'; if($tp_txt_h1_font == 'Brawler'){ print ' selected="selected"';} print '>Brawler</option>
										<option value="Comfortaa"'; if($tp_txt_h1_font == 'Comfortaa'){ print ' selected="selected"';} print '>Comfortaa</option>
										<option value="Droid+Serif"'; if($tp_txt_h1_font == 'Droid+Serif'){ print ' selected="selected"';} print '>Droid Serif</option>
										<option value="Fjalla+One"'; if($tp_txt_h1_font == 'Fjalla+One'){ print ' selected="selected"';} print '>Fjalla One</option>
										<option value="Kaushan+Script"'; if($tp_txt_h1_font == 'Kaushan+Script'){ print ' selected="selected"';} print '>Kaushan Script</option>
										<option value="Libre+Baskerville"'; if($tp_txt_h1_font == 'Libre+Baskerville'){ print ' selected="selected"';} print '>Libre Baskerville</option>
										<option value="Open+Sans"'; if($tp_txt_h1_font == 'Open+Sans'){ print ' selected="selected"';} print '>Open Sans</option>
										<option value="PT+Sans"'; if($tp_txt_h1_font == 'PT+Sans'){ print ' selected="selected"';} print '>PT Sans</option>
										<option value="Roboto+Condensed"'; if($tp_txt_h1_font == 'Roboto+Condensed'){ print ' selected="selected"';} print '>Roboto Condensed</option>
									</optgroup>
									<optgroup label="'.__('Your Custom Fonts','ingrid').'">
									';
										//load custom fonts
										if(!empty($tp_typography_custom_fonts)){
											if(!is_array($tp_typography_custom_fonts)){$tp_typography_custom_fonts = unserialize($tp_typography_custom_fonts);}
											foreach($tp_typography_custom_fonts as $cf){
												print '<option value="'.$cf.'"'; if($tp_txt_h1_font == $cf){ print ' selected="selected"';} print '>'.str_replace('+',' ',$cf).'</option>';
											}
										}else{
											print '<option value="" style="font-style: italic;">'.__('None added yet','ingrid').'</option>';
										}
									print '
									</optgroup>
									</select>
									
								</td>
								<td><select name="form-txt-h1-size">
									<option value="">-</option>';
									
									for($a = 9;$a <= 26;$a++){
										if($tp_txt_h1_size == $a.'px'){
											print '<option value="'.$a.'px" selected="selected">'.$a.'px</option>';
										}else{
											print '<option value="'.$a.'px">'.$a.'px</option>';
										}
									}
									
									print '							
									</select>
								</td>
								<td><select name="form-txt-h1-style">
									<option value="">Regular</option>';
									
									$tp_txt_h1_style = get_option('tp_txt_h1_style');
									
									print '
									<option value="bold" style="font-weight:bold;"'; if($tp_txt_h1_style == 'bold'){print ' selected="selected"';} print '>'.__('Bold','ingrid').'</option>
									<option value="italic" style="font-style:italic;"'; if($tp_txt_h1_style == 'italic'){print ' selected="selected"';} print '>'.__('Italic','ingrid').'</option>									
									</select>
								</td>
								<td>
									<input type="text" id="color6" class="colorwell" name="form-txt-h1-color" maxlength="7" value="'.$tp_txt_h1_color.'" />
									<input type="button" id="colorpicker_6" class="button" value="'.__('Select color','ingrid').'"  />
									<div id="colorpicker6" class="colorpicker"></div>
								</td>
								<td>-</td>
							</tr>
							
							
							
							<tr>
								<td><strong>'.__('Heading 2','ingrid').'</strong></td>
								<td><select name="form-txt-h2-font" class="form-as-fontfamily">
									<option value="">-</option>
									<optgroup label="'.__('Recommended Fonts','ingrid').'">
										<option value="Archivo+Narrow"'; if($tp_txt_h2_font == 'Archivo+Narrow'){ print ' selected="selected"';} print '>Archivo Narrow</option>
										<option value="Brawler"'; if($tp_txt_h2_font == 'Brawler'){ print ' selected="selected"';} print '>Brawler</option>
										<option value="Comfortaa"'; if($tp_txt_h2_font == 'Comfortaa'){ print ' selected="selected"';} print '>Comfortaa</option>
										<option value="Droid+Serif"'; if($tp_txt_h2_font == 'Droid+Serif'){ print ' selected="selected"';} print '>Droid Serif</option>
										<option value="Fjalla+One"'; if($tp_txt_h2_font == 'Fjalla+One'){ print ' selected="selected"';} print '>Fjalla One</option>
										<option value="Kaushan+Script"'; if($tp_txt_h2_font == 'Kaushan+Script'){ print ' selected="selected"';} print '>Kaushan Script</option>
										<option value="Libre+Baskerville"'; if($tp_txt_h2_font == 'Libre+Baskerville'){ print ' selected="selected"';} print '>Libre Baskerville</option>
										<option value="Open+Sans"'; if($tp_txt_h2_font == 'Open+Sans'){ print ' selected="selected"';} print '>Open Sans</option>
										<option value="PT+Sans"'; if($tp_txt_h2_font == 'PT+Sans'){ print ' selected="selected"';} print '>PT Sans</option>
										<option value="Roboto+Condensed"'; if($tp_txt_h2_font == 'Roboto+Condensed'){ print ' selected="selected"';} print '>Roboto Condensed</option>
									</optgroup>
									<optgroup label="'.__('Your Custom Fonts','ingrid').'">
									';
										//load custom fonts
										if(!empty($tp_typography_custom_fonts)){
											if(!is_array($tp_typography_custom_fonts)){$tp_typography_custom_fonts = unserialize($tp_typography_custom_fonts);}
											foreach($tp_typography_custom_fonts as $cf){
												print '<option value="'.$cf.'"'; if($tp_txt_h2_font == $cf){ print ' selected="selected"';} print '>'.str_replace('+',' ',$cf).'</option>';
											}
										}else{
											print '<option value="" style="font-style: italic;">'.__('None added yet','ingrid').'</option>';
										}
									print '
									</optgroup>
									</select>
									
								</td>
								<td><select name="form-txt-h2-size">
									<option value="">-</option>';
									
									for($a = 9;$a <= 26;$a++){
										if($tp_txt_h2_size == $a.'px'){
											print '<option value="'.$a.'px" selected="selected">'.$a.'px</option>';
										}else{
											print '<option value="'.$a.'px">'.$a.'px</option>';
										}
									}
									
									print '							
									</select>
								</td>
								<td><select name="form-txt-h2-style">
									<option value="">Regular</option>';
									
									$tp_txt_h2_style = get_option('tp_txt_h2_style');
									
									print '
									<option value="bold" style="font-weight:bold;"'; if($tp_txt_h2_style == 'bold'){print ' selected="selected"';} print '>'.__('Bold','ingrid').'</option>
									<option value="italic" style="font-style:italic;"'; if($tp_txt_h2_style == 'italic'){print ' selected="selected"';} print '>'.__('Italic','ingrid').'</option>									
									</select>
								</td>
								<td>
									<input type="text" id="color7" class="colorwell" name="form-txt-h2-color" maxlength="7" value="'.$tp_txt_h2_color.'" />
									<input type="button" id="colorpicker_7" class="button" value="'.__('Select color','ingrid').'"  />
									<div id="colorpicker7" class="colorpicker"></div>
								</td>
								<td>-</td>
							</tr>
							
							
							<tr class="alternate">
								<td><strong>'.__('Heading 3','ingrid').'</strong></td>
								<td><select name="form-txt-h3-font" class="form-as-fontfamily">
									<option value="">-</option>
									<optgroup label="'.__('Recommended Fonts','ingrid').'">
										<option value="Archivo+Narrow"'; if($tp_txt_h3_font == 'Archivo+Narrow'){ print ' selected="selected"';} print '>Archivo Narrow</option>
										<option value="Brawler"'; if($tp_txt_h3_font == 'Brawler'){ print ' selected="selected"';} print '>Brawler</option>
										<option value="Comfortaa"'; if($tp_txt_h3_font == 'Comfortaa'){ print ' selected="selected"';} print '>Comfortaa</option>
										<option value="Droid+Serif"'; if($tp_txt_h3_font == 'Droid+Serif'){ print ' selected="selected"';} print '>Droid Serif</option>
										<option value="Fjalla+One"'; if($tp_txt_h3_font == 'Fjalla+One'){ print ' selected="selected"';} print '>Fjalla One</option>
										<option value="Kaushan+Script"'; if($tp_txt_h3_font == 'Kaushan+Script'){ print ' selected="selected"';} print '>Kaushan Script</option>
										<option value="Libre+Baskerville"'; if($tp_txt_h3_font == 'Libre+Baskerville'){ print ' selected="selected"';} print '>Libre Baskerville</option>
										<option value="Open+Sans"'; if($tp_txt_h3_font == 'Open+Sans'){ print ' selected="selected"';} print '>Open Sans</option>
										<option value="PT+Sans"'; if($tp_txt_h3_font == 'PT+Sans'){ print ' selected="selected"';} print '>PT Sans</option>
										<option value="Roboto+Condensed"'; if($tp_txt_h3_font == 'Roboto+Condensed'){ print ' selected="selected"';} print '>Roboto Condensed</option>
									</optgroup>
									<optgroup label="'.__('Your Custom Fonts','ingrid').'">
									';
										//load custom fonts
										if(!empty($tp_typography_custom_fonts)){
											if(!is_array($tp_typography_custom_fonts)){$tp_typography_custom_fonts = unserialize($tp_typography_custom_fonts);}
											foreach($tp_typography_custom_fonts as $cf){
												print '<option value="'.$cf.'"'; if($tp_txt_h3_font == $cf){ print ' selected="selected"';} print '>'.str_replace('+',' ',$cf).'</option>';
											}
										}else{
											print '<option value="" style="font-style: italic;">'.__('None added yet','ingrid').'</option>';
										}
									print '
									</optgroup>
									</select>
									
								</td>
								<td><select name="form-txt-h3-size">
									<option value="">-</option>';
									
									for($a = 9;$a <= 26;$a++){
										if($tp_txt_h3_size == $a.'px'){
											print '<option value="'.$a.'px" selected="selected">'.$a.'px</option>';
										}else{
											print '<option value="'.$a.'px">'.$a.'px</option>';
										}
									}
									
									print '							
									</select>
								</td>
								<td><select name="form-txt-h3-style">
									<option value="">Regular</option>';
									
									$tp_txt_h3_style = get_option('tp_txt_h3_style');
									
									print '
									<option value="bold" style="font-weight:bold;"'; if($tp_txt_h3_style == 'bold'){print ' selected="selected"';} print '>'.__('Bold','ingrid').'</option>
									<option value="italic" style="font-style:italic;"'; if($tp_txt_h3_style == 'italic'){print ' selected="selected"';} print '>'.__('Italic','ingrid').'</option>									
									</select>
								</td>
								<td>
									<input type="text" id="color8" class="colorwell" name="form-txt-h3-color" maxlength="7" value="'.$tp_txt_h3_color.'" />
									<input type="button" id="colorpicker_8" class="button" value="'.__('Select color','ingrid').'"  />
									<div id="colorpicker8" class="colorpicker"></div>
								</td>
								<td>-</td>
							</tr>
							
							<tr>
								<td><strong>'.__('Heading 4','ingrid').'</strong></td>
								<td><select name="form-txt-h4-font" class="form-as-fontfamily">
									<option value="">-</option>
									<optgroup label="'.__('Recommended Fonts','ingrid').'">
										<option value="Archivo+Narrow"'; if($tp_txt_h4_font == 'Archivo+Narrow'){ print ' selected="selected"';} print '>Archivo Narrow</option>
										<option value="Brawler"'; if($tp_txt_h4_font == 'Brawler'){ print ' selected="selected"';} print '>Brawler</option>
										<option value="Comfortaa"'; if($tp_txt_h4_font == 'Comfortaa'){ print ' selected="selected"';} print '>Comfortaa</option>
										<option value="Droid+Serif"'; if($tp_txt_h4_font == 'Droid+Serif'){ print ' selected="selected"';} print '>Droid Serif</option>
										<option value="Fjalla+One"'; if($tp_txt_h4_font == 'Fjalla+One'){ print ' selected="selected"';} print '>Fjalla One</option>
										<option value="Kaushan+Script"'; if($tp_txt_h4_font == 'Kaushan+Script'){ print ' selected="selected"';} print '>Kaushan Script</option>
										<option value="Libre+Baskerville"'; if($tp_txt_h4_font == 'Libre+Baskerville'){ print ' selected="selected"';} print '>Libre Baskerville</option>
										<option value="Open+Sans"'; if($tp_txt_h4_font == 'Open+Sans'){ print ' selected="selected"';} print '>Open Sans</option>
										<option value="PT+Sans"'; if($tp_txt_h4_font == 'PT+Sans'){ print ' selected="selected"';} print '>PT Sans</option>
										<option value="Roboto+Condensed"'; if($tp_txt_h4_font == 'Roboto+Condensed'){ print ' selected="selected"';} print '>Roboto Condensed</option>
									</optgroup>
									<optgroup label="'.__('Your Custom Fonts','ingrid').'">
									';
										//load custom fonts
										if(!empty($tp_typography_custom_fonts)){
											if(!is_array($tp_typography_custom_fonts)){$tp_typography_custom_fonts = unserialize($tp_typography_custom_fonts);}
											foreach($tp_typography_custom_fonts as $cf){
												print '<option value="'.$cf.'"'; if($tp_txt_h4_font == $cf){ print ' selected="selected"';} print '>'.str_replace('+',' ',$cf).'</option>';
											}
										}else{
											print '<option value="" style="font-style: italic;">'.__('None added yet','ingrid').'</option>';
										}
									print '
									</optgroup>
									</select>
									
								</td>
								<td><select name="form-txt-h4-size">
									<option value="">-</option>';
									
									for($a = 9;$a <= 26;$a++){
										if($tp_txt_h4_size == $a.'px'){
											print '<option value="'.$a.'px" selected="selected">'.$a.'px</option>';
										}else{
											print '<option value="'.$a.'px">'.$a.'px</option>';
										}
									}
									
									print '							
									</select>
								</td>
								<td><select name="form-txt-h4-style">
									<option value="">Regular</option>';
									
									$tp_txt_h4_style = get_option('tp_txt_h4_style');
									
									print '
									<option value="bold" style="font-weight:bold;"'; if($tp_txt_h4_style == 'bold'){print ' selected="selected"';} print '>'.__('Bold','ingrid').'</option>
									<option value="italic" style="font-style:italic;"'; if($tp_txt_h4_style == 'italic'){print ' selected="selected"';} print '>'.__('Italic','ingrid').'</option>									
									</select>
								</td>
								<td>
									<input type="text" id="color9" class="colorwell" name="form-txt-h4-color" maxlength="7" value="'.$tp_txt_h4_color.'" />
									<input type="button" id="colorpicker_9" class="button" value="'.__('Select color','ingrid').'"  />
									<div id="colorpicker9" class="colorpicker"></div>
								</td>
								<td>-</td>
							</tr>
							
							
							
							<tr class="alternate">
								<td><strong>'.__('Heading 5','ingrid').'</strong></td>
								<td><select name="form-txt-h5-font" class="form-as-fontfamily">
									<option value="">-</option>
									<optgroup label="'.__('Recommended Fonts','ingrid').'">
										<option value="Archivo+Narrow"'; if($tp_txt_h5_font == 'Archivo+Narrow'){ print ' selected="selected"';} print '>Archivo Narrow</option>
										<option value="Brawler"'; if($tp_txt_h5_font == 'Brawler'){ print ' selected="selected"';} print '>Brawler</option>
										<option value="Comfortaa"'; if($tp_txt_h5_font == 'Comfortaa'){ print ' selected="selected"';} print '>Comfortaa</option>
										<option value="Droid+Serif"'; if($tp_txt_h5_font == 'Droid+Serif'){ print ' selected="selected"';} print '>Droid Serif</option>
										<option value="Fjalla+One"'; if($tp_txt_h5_font == 'Fjalla+One'){ print ' selected="selected"';} print '>Fjalla One</option>
										<option value="Kaushan+Script"'; if($tp_txt_h5_font == 'Kaushan+Script'){ print ' selected="selected"';} print '>Kaushan Script</option>
										<option value="Libre+Baskerville"'; if($tp_txt_h5_font == 'Libre+Baskerville'){ print ' selected="selected"';} print '>Libre Baskerville</option>
										<option value="Open+Sans"'; if($tp_txt_h5_font == 'Open+Sans'){ print ' selected="selected"';} print '>Open Sans</option>
										<option value="PT+Sans"'; if($tp_txt_h5_font == 'PT+Sans'){ print ' selected="selected"';} print '>PT Sans</option>
										<option value="Roboto+Condensed"'; if($tp_txt_h5_font == 'Roboto+Condensed'){ print ' selected="selected"';} print '>Roboto Condensed</option>
									</optgroup>
									<optgroup label="'.__('Your Custom Fonts','ingrid').'">
									';
										//load custom fonts
										if(!empty($tp_typography_custom_fonts)){
											if(!is_array($tp_typography_custom_fonts)){$tp_typography_custom_fonts = unserialize($tp_typography_custom_fonts);}
											foreach($tp_typography_custom_fonts as $cf){
												print '<option value="'.$cf.'"'; if($tp_txt_h5_font == $cf){ print ' selected="selected"';} print '>'.str_replace('+',' ',$cf).'</option>';
											}
										}else{
											print '<option value="" style="font-style: italic;">'.__('None added yet','ingrid').'</option>';
										}
									print '
									</optgroup>
									</select>
									
								</td>
								<td><select name="form-txt-h5-size">
									<option value="">-</option>';
									
									for($a = 9;$a <= 26;$a++){
										if($tp_txt_h5_size == $a.'px'){
											print '<option value="'.$a.'px" selected="selected">'.$a.'px</option>';
										}else{
											print '<option value="'.$a.'px">'.$a.'px</option>';
										}
									}
									
									print '							
									</select>
								</td>
								<td><select name="form-txt-h5-style">
									<option value="">Regular</option>';
									
									$tp_txt_h5_style = get_option('tp_txt_h5_style');
									
									print '
									<option value="bold" style="font-weight:bold;"'; if($tp_txt_h5_style == 'bold'){print ' selected="selected"';} print '>'.__('Bold','ingrid').'</option>
									<option value="italic" style="font-style:italic;"'; if($tp_txt_h5_style == 'italic'){print ' selected="selected"';} print '>'.__('Italic','ingrid').'</option>									
									</select>
								</td>
								<td>
									<input type="text" id="color10" class="colorwell" name="form-txt-h5-color" maxlength="7" value="'.$tp_txt_h5_color.'" />
									<input type="button" id="colorpicker_10" class="button" value="'.__('Select color','ingrid').'"  />
									<div id="colorpicker10" class="colorpicker"></div>
								</td>
								<td>-</td>
							</tr>
							
							
							<tr class="alternate">
								<td><strong>'.__('Heading 6','ingrid').'</strong></td>
								<td><select name="form-txt-h6-font" class="form-as-fontfamily">
									<option value="">-</option>
									<optgroup label="'.__('Recommended Fonts','ingrid').'">
										<option value="Archivo+Narrow"'; if($tp_txt_h6_font == 'Archivo+Narrow'){ print ' selected="selected"';} print '>Archivo Narrow</option>
										<option value="Brawler"'; if($tp_txt_h6_font == 'Brawler'){ print ' selected="selected"';} print '>Brawler</option>
										<option value="Comfortaa"'; if($tp_txt_h6_font == 'Comfortaa'){ print ' selected="selected"';} print '>Comfortaa</option>
										<option value="Droid+Serif"'; if($tp_txt_h6_font == 'Droid+Serif'){ print ' selected="selected"';} print '>Droid Serif</option>
										<option value="Fjalla+One"'; if($tp_txt_h6_font == 'Fjalla+One'){ print ' selected="selected"';} print '>Fjalla One</option>
										<option value="Kaushan+Script"'; if($tp_txt_h6_font == 'Kaushan+Script'){ print ' selected="selected"';} print '>Kaushan Script</option>
										<option value="Libre+Baskerville"'; if($tp_txt_h6_font == 'Libre+Baskerville'){ print ' selected="selected"';} print '>Libre Baskerville</option>
										<option value="Open+Sans"'; if($tp_txt_h6_font == 'Open+Sans'){ print ' selected="selected"';} print '>Open Sans</option>
										<option value="PT+Sans"'; if($tp_txt_h6_font == 'PT+Sans'){ print ' selected="selected"';} print '>PT Sans</option>
										<option value="Roboto+Condensed"'; if($tp_txt_h6_font == 'Roboto+Condensed'){ print ' selected="selected"';} print '>Roboto Condensed</option>
									</optgroup>
									<optgroup label="'.__('Your Custom Fonts','ingrid').'">
									';
										//load custom fonts
										if(!empty($tp_typography_custom_fonts)){
											if(!is_array($tp_typography_custom_fonts)){$tp_typography_custom_fonts = unserialize($tp_typography_custom_fonts);}
											foreach($tp_typography_custom_fonts as $cf){
												print '<option value="'.$cf.'"'; if($tp_txt_h6_font == $cf){ print ' selected="selected"';} print '>'.str_replace('+',' ',$cf).'</option>';
											}
										}else{
											print '<option value="" style="font-style: italic;">'.__('None added yet','ingrid').'</option>';
										}
									print '
									</optgroup>
									</select>
									
								</td>
								<td><select name="form-txt-h6-size">
									<option value="">-</option>';
									
									for($a = 9;$a <= 26;$a++){
										if($tp_txt_h6_size == $a.'px'){
											print '<option value="'.$a.'px" selected="selected">'.$a.'px</option>';
										}else{
											print '<option value="'.$a.'px">'.$a.'px</option>';
										}
									}
									
									print '							
									</select>
								</td>
								<td><select name="form-txt-h6-style">
									<option value="">Regular</option>';
									
									$tp_txt_h6_style = get_option('tp_txt_h6_style');
									
									print '
									<option value="bold" style="font-weight:bold;"'; if($tp_txt_h6_style == 'bold'){print ' selected="selected"';} print '>'.__('Bold','ingrid').'</option>
									<option value="italic" style="font-style:italic;"'; if($tp_txt_h6_style == 'italic'){print ' selected="selected"';} print '>'.__('Italic','ingrid').'</option>									
									</select>
								</td>
								<td>
									<input type="text" id="color11" class="colorwell" name="form-txt-h6-color" maxlength="7" value="'.$tp_txt_h6_color.'" />
									<input type="button" id="colorpicker_11" class="button" value="'.__('Select color','ingrid').'"  />
									<div id="colorpicker11" class="colorpicker"></div>
								</td>
								<td>-</td>
							</tr>
							
						</table>
					</td>
				</tr>
				
						
				<tr>
					<td></td>
				</tr>	
				
			</table>

			<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="'.__( 'Save Changes', 'ingrid' ).'"  /></p>	
			
			<p class="submit"><a href="admin.php?page=tp_theme_typography&reset=1" class="button button-secondary">'.__( 'Reset Defaults', 'ingrid' ).'</a></p>	
		
			</form>		
		</div>';
	}




?>