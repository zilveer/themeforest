<?php

// THEME OPTIONS

// sidebar and footer settings
	
	
	//save settings
	if(!empty($_POST) && !empty($_GET['page']) && $_GET['page'] == 'tp_theme_sidebar_footer'){		
	
		//save
			update_option('tp_default_sidebar_position',$_POST['form-tp_default_sidebar_position']);
			
			//posts
				$ub_c_was = maybe_unserialize(get_option('ub_custom_widget_areas'));			
			
				if($_POST['form-tp_posts_new_widget_area_sb'] != ''){ //add to custow widget area list and set as default sidebar area
					$nuarr['title'] = $_POST['form-tp_posts_new_widget_area_sb'];
					$nuarr['id'] = 'ub_wa_po_sb_'.time();
					$ub_c_was[] = $nuarr;
					update_option('ub_custom_widget_areas',maybe_serialize($ub_c_was));
					update_option('tp_posts_default_sb_widget_area',$nuarr['id']);
				}else{ update_option('tp_posts_default_sb_widget_area',$_POST['form-tp_posts_default_sb_widget_area']); }

				
				if($_POST['form-tp_posts_new_widget_area_f1'] != ''){
					$nuarr['title'] = $_POST['form-tp_posts_new_widget_area_f1'];
					$nuarr['id'] = 'ub_wa_po_f1_'.time();
					$ub_c_was[] = $nuarr;
					update_option('ub_custom_widget_areas',maybe_serialize($ub_c_was));
					update_option('tp_posts_default_f1_widget_area',$nuarr['id']);
				}else{	update_option('tp_posts_default_f1_widget_area',$_POST['form-tp_posts_default_f1_widget_area']); }
				
				
				if($_POST['form-tp_posts_new_widget_area_f2'] != ''){
					$nuarr['title'] = $_POST['form-tp_posts_new_widget_area_f2'];
					$nuarr['id'] = 'ub_wa_po_f2_'.time();
					$ub_c_was[] = $nuarr;
					update_option('ub_custom_widget_areas',maybe_serialize($ub_c_was));
					update_option('tp_posts_default_f2_widget_area',$nuarr['id']);
				}else{	update_option('tp_posts_default_f2_widget_area',$_POST['form-tp_posts_default_f2_widget_area']); }

				
				if($_POST['form-tp_posts_new_widget_area_f3'] != ''){
					$nuarr['title'] = $_POST['form-tp_posts_new_widget_area_f3'];
					$nuarr['id'] = 'ub_wa_po_f3_'.time();
					$ub_c_was[] = $nuarr;
					update_option('ub_custom_widget_areas',maybe_serialize($ub_c_was));
					update_option('tp_posts_default_f3_widget_area',$nuarr['id']);
				}else{	update_option('tp_posts_default_f3_widget_area',$_POST['form-tp_posts_default_f3_widget_area']); }
				
				
				if($_POST['form-tp_posts_new_widget_area_f4'] != ''){
					$nuarr['title'] = $_POST['form-tp_posts_new_widget_area_f4'];
					$nuarr['id'] = 'ub_wa_po_f4_'.time();
					$ub_c_was[] = $nuarr;
					update_option('ub_custom_widget_areas',maybe_serialize($ub_c_was));
					update_option('tp_posts_default_f4_widget_area',$nuarr['id']);
				}else{	update_option('tp_posts_default_f4_widget_area',$_POST['form-tp_posts_default_f4_widget_area']); }
				
			
			//pages
				if($_POST['form-tp_pages_new_widget_area_sb'] != ''){ //add to custow widget area list and set as default sidebar area
					$nuarr['title'] = $_POST['form-tp_pages_new_widget_area_sb'];
					$nuarr['id'] = 'ub_wa_pa_sb_'.time();
					$ub_c_was[] = $nuarr;
					update_option('ub_custom_widget_areas',maybe_serialize($ub_c_was));
					update_option('tp_pages_default_sb_widget_area',$nuarr['id']);
				}else{ update_option('tp_pages_default_sb_widget_area',$_POST['form-tp_pages_default_sb_widget_area']); }

				
				if($_POST['form-tp_pages_new_widget_area_f1'] != ''){
					$nuarr['title'] = $_POST['form-tp_pages_new_widget_area_f1'];
					$nuarr['id'] = 'ub_wa_pa_f1_'.time();
					$ub_c_was[] = $nuarr;
					update_option('ub_custom_widget_areas',maybe_serialize($ub_c_was));
					update_option('tp_pages_default_f1_widget_area',$nuarr['id']);
				}else{	update_option('tp_pages_default_f1_widget_area',$_POST['form-tp_pages_default_f1_widget_area']); }
				
				
				if($_POST['form-tp_pages_new_widget_area_f2'] != ''){
					$nuarr['title'] = $_POST['form-tp_pages_new_widget_area_f2'];
					$nuarr['id'] = 'ub_wa_pa_f2_'.time();
					$ub_c_was[] = $nuarr;
					update_option('ub_custom_widget_areas',maybe_serialize($ub_c_was));
					update_option('tp_pages_default_f2_widget_area',$nuarr['id']);
				}else{	update_option('tp_pages_default_f2_widget_area',$_POST['form-tp_pages_default_f2_widget_area']); }

				
				if($_POST['form-tp_pages_new_widget_area_f3'] != ''){
					$nuarr['title'] = $_POST['form-tp_pages_new_widget_area_f3'];
					$nuarr['id'] = 'ub_wa_pa_f3_'.time();
					$ub_c_was[] = $nuarr;
					update_option('ub_custom_widget_areas',maybe_serialize($ub_c_was));
					update_option('tp_pages_default_f3_widget_area',$nuarr['id']);
				}else{	update_option('tp_pages_default_f3_widget_area',$_POST['form-tp_pages_default_f3_widget_area']); }
				
				
				if($_POST['form-tp_pages_new_widget_area_f4'] != ''){
					$nuarr['title'] = $_POST['form-tp_pages_new_widget_area_f4'];
					$nuarr['id'] = 'ub_wa_pa_f4_'.time();
					$ub_c_was[] = $nuarr;
					update_option('ub_custom_widget_areas',maybe_serialize($ub_c_was));
					update_option('tp_pages_default_f4_widget_area',$nuarr['id']);
				}else{	update_option('tp_pages_default_f4_widget_area',$_POST['form-tp_pages_default_f4_widget_area']); }
		
		
		header("Location: admin.php?page=tp_theme_sidebar_footer&success=1");						
	}
		
		
	//display option layout	
	function tp_theme_sidebar_footer(){
		global $framework_url;

		if(!empty($_GET['success']) && $_GET['success'] == '1'){
			print '<div id="message" class="updated"><p>'.__('Settings are successfully saved.','ingrid').'</p></div>';
		}
		
		
		//load default widget areas
		$tp_default_sidebar_position = get_option('tp_default_sidebar_position');
		
		$tp_posts_default_sb_widget_area = get_option('tp_posts_default_sb_widget_area'); 
		$tp_posts_default_f1_widget_area = get_option('tp_posts_default_f1_widget_area');
		$tp_posts_default_f2_widget_area = get_option('tp_posts_default_f2_widget_area');
		$tp_posts_default_f3_widget_area = get_option('tp_posts_default_f3_widget_area');
		$tp_posts_default_f4_widget_area = get_option('tp_posts_default_f4_widget_area');
		
		
		$tp_pages_default_sb_widget_area = get_option('tp_pages_default_sb_widget_area');
		$tp_pages_default_f1_widget_area = get_option('tp_pages_default_f1_widget_area');
		$tp_pages_default_f2_widget_area = get_option('tp_pages_default_f2_widget_area');
		$tp_pages_default_f3_widget_area = get_option('tp_pages_default_f3_widget_area');
		$tp_pages_default_f4_widget_area = get_option('tp_pages_default_f4_widget_area');
		
		
		
		print '<div class="wrap">	
			<div class="icon32"><img src="'.$framework_url.'icon-big.png" class="h2_icon" /><br /></div><h2>'.__( 'Sidebar and Footer Settings', 'ingrid' ).'</h2>	
		
			<form method="post" action="" enctype="multipart/form-data">		

			<table class="form-table">
							
			
				<tr>
					<th scope="row"><label>'.__('Default Sidebar Position','ingrid').'</label></th>
					<td>
						<select name="form-tp_default_sidebar_position">
							<option value="">'.__('Right','ingrid').'</option>
							<option value="left"'; if($tp_default_sidebar_position == 'left'){ print ' selected="selected"'; } print '>'.__('Left','ingrid').'</option>
						</select>
					</td>
				</tr>							
				
				
				<tr>
					<td></td>
				</tr>	
				
				<tr>					
					<td colspan="2"><h3>'.__('Set Default Widget Areas for Posts','ingrid').'</h3>
					<p>'.__('Here you can set the default sidebar and footer widget areas for posts. You can override these settings for each posts in their editor.','ingrid').'</p></td>
				</tr>
				
					<tr class="tp_pad">
						<th><h4>'.__('Sidebar Widget Area','ingrid').'</h4></th>
						<td></td>
					</tr>
					<tr class="tp_pad">
						<th scope="row"><label>'.__('Select a widget area:','ingrid').'</label></th>
						<td><select name="form-tp_posts_default_sb_widget_area">
							<option value="">'.__('Default Widget Area','ingrid').'</option>
							<option value="no-widget-area">'.__('No Widget Area','ingrid').'</option>
							<option value="primary-widget-area"'; if($tp_posts_default_sb_widget_area == 'primary-widget-area'){print ' selected="selected"';} print '>'.__('Sidebar Widget Area','ingrid').'</option>
							<option value="first-footer-widget-area"'; if($tp_posts_default_sb_widget_area == 'first-footer-widget-area'){print ' selected="selected"';} print '>'.__('First Footer Widget Area','ingrid').'</option>
							<option value="second-footer-widget-area"'; if($tp_posts_default_sb_widget_area == 'second-footer-widget-area'){print ' selected="selected"';} print '>'.__('Second Footer Widget Area','ingrid').'</option>
							<option value="third-footer-widget-area"'; if($tp_posts_default_sb_widget_area == 'third-footer-widget-area'){print ' selected="selected"';} print '>'.__('Third Footer Widget Area','ingrid').'</option>				
							<option value="fourth-footer-widget-area"'; if($tp_posts_default_sb_widget_area == 'fourth-footer-widget-area'){print ' selected="selected"';} print '>'.__('Fourth Footer Widget Area','ingrid').'</option>				
							';
							//get the rest if exist
							$custom_was = maybe_unserialize(get_option('ub_custom_widget_areas'));
							if($custom_was != ''){
								foreach($custom_was as $custom_wa){
									print '<option value="'.$custom_wa['id'].'"'; if($tp_posts_default_sb_widget_area == $custom_wa['id']){print ' selected="selected"';} print '>'.$custom_wa['title'].'</option>';
								}
							}		
														
							print '
							</select>
						</td>
					</tr>
					<tr class="tp_pad">
						<th scope="row"><label>'.__('or create a new area:','ingrid').'</label></th>
						<td><input type="text" name="form-tp_posts_new_widget_area_sb" /><span style="color: #aaa;"> ('.__('enter a title for it','ingrid').')</span></td>
					</tr>
					
				
				
				
					<tr class="tp_pad">
						<th><h4>'.__('First Footer Widget Area','ingrid').'</h4></th>
						<td></td>
					</tr>
					<tr class="tp_pad">
						<th scope="row"><label>'.__('Select a widget area:','ingrid').'</label></th>
						<td><select name="form-tp_posts_default_f1_widget_area">
							<option value="">'.__('Default Widget Area','ingrid').'</option>
							<option value="no-widget-area">'.__('No Widget Area','ingrid').'</option>
							<option value="primary-widget-area"'; if($tp_posts_default_f1_widget_area == 'primary-widget-area'){print ' selected="selected"';} print '>'.__('Sidebar Widget Area','ingrid').'</option>
							<option value="first-footer-widget-area"'; if($tp_posts_default_f1_widget_area == 'first-footer-widget-area'){print ' selected="selected"';} print '>'.__('First Footer Widget Area','ingrid').'</option>
							<option value="second-footer-widget-area"'; if($tp_posts_default_f1_widget_area == 'second-footer-widget-area'){print ' selected="selected"';} print '>'.__('Second Footer Widget Area','ingrid').'</option>
							<option value="third-footer-widget-area"'; if($tp_posts_default_f1_widget_area == 'third-footer-widget-area'){print ' selected="selected"';} print '>'.__('Third Footer Widget Area','ingrid').'</option>				
							<option value="fourth-footer-widget-area"'; if($tp_posts_default_f1_widget_area == 'fourth-footer-widget-area'){print ' selected="selected"';} print '>'.__('Fourth Footer Widget Area','ingrid').'</option>				
							';
							//get the rest if exist							
							if($custom_was != ''){
								foreach($custom_was as $custom_wa){
									print '<option value="'.$custom_wa['id'].'"'; if($tp_posts_default_f1_widget_area == $custom_wa['id']){print ' selected="selected"';} print '>'.$custom_wa['title'].'</option>';
								}
							}		
														
							print '
							</select>
						</td>
					</tr>
					<tr class="tp_pad">
						<th scope="row"><label>'.__('or create a new area:','ingrid').'</label></th>
						<td><input type="text" name="form-tp_posts_new_widget_area_f1" /><span style="color: #aaa;"> ('.__('enter a title for it','ingrid').')</span></td>
					</tr>
					
					
					
					<tr class="tp_pad">
						<th><h4>'.__('Second Footer Widget Area','ingrid').'</h4></th>
						<td></td>
					</tr>
					<tr class="tp_pad">
						<th scope="row"><label>'.__('Select a widget area:','ingrid').'</label></th>
						<td><select name="form-tp_posts_default_f2_widget_area">
							<option value="">'.__('Default Widget Area','ingrid').'</option>
							<option value="no-widget-area">'.__('No Widget Area','ingrid').'</option>
							<option value="primary-widget-area"'; if($tp_posts_default_f2_widget_area == 'primary-widget-area'){print ' selected="selected"';} print '>'.__('Sidebar Widget Area','ingrid').'</option>
							<option value="first-footer-widget-area"'; if($tp_posts_default_f2_widget_area == 'first-footer-widget-area'){print ' selected="selected"';} print '>'.__('First Footer Widget Area','ingrid').'</option>
							<option value="second-footer-widget-area"'; if($tp_posts_default_f2_widget_area == 'second-footer-widget-area'){print ' selected="selected"';} print '>'.__('Second Footer Widget Area','ingrid').'</option>
							<option value="third-footer-widget-area"'; if($tp_posts_default_f2_widget_area == 'third-footer-widget-area'){print ' selected="selected"';} print '>'.__('Third Footer Widget Area','ingrid').'</option>				
							<option value="fourth-footer-widget-area"'; if($tp_posts_default_f2_widget_area == 'fourth-footer-widget-area'){print ' selected="selected"';} print '>'.__('Fourth Footer Widget Area','ingrid').'</option>				
							';
							//get the rest if exist							
							if($custom_was != ''){
								foreach($custom_was as $custom_wa){
									print '<option value="'.$custom_wa['id'].'"'; if($tp_posts_default_f2_widget_area == $custom_wa['id']){print ' selected="selected"';} print '>'.$custom_wa['title'].'</option>';
								}
							}		
														
							print '
							</select>
						</td>
					</tr>
					<tr class="tp_pad">
						<th scope="row"><label>'.__('or create a new area:','ingrid').'</label></th>
						<td><input type="text" name="form-tp_posts_new_widget_area_f2" /><span style="color: #aaa;"> ('.__('enter a title for it','ingrid').')</span></td>
					</tr>
					
					
					
					
					
					
					<tr class="tp_pad">
						<th><h4>'.__('Third Footer Widget Area','ingrid').'</h4></th>
						<td></td>
					</tr>
					<tr class="tp_pad">
						<th scope="row"><label>'.__('Select a widget area:','ingrid').'</label></th>
						<td><select name="form-tp_posts_default_f3_widget_area">
							<option value="">'.__('Default Widget Area','ingrid').'</option>
							<option value="no-widget-area">'.__('No Widget Area','ingrid').'</option>
							<option value="primary-widget-area"'; if($tp_posts_default_f3_widget_area == 'primary-widget-area'){print ' selected="selected"';} print '>'.__('Sidebar Widget Area','ingrid').'</option>
							<option value="first-footer-widget-area"'; if($tp_posts_default_f3_widget_area == 'first-footer-widget-area'){print ' selected="selected"';} print '>'.__('First Footer Widget Area','ingrid').'</option>
							<option value="second-footer-widget-area"'; if($tp_posts_default_f3_widget_area == 'second-footer-widget-area'){print ' selected="selected"';} print '>'.__('Second Footer Widget Area','ingrid').'</option>
							<option value="third-footer-widget-area"'; if($tp_posts_default_f3_widget_area == 'third-footer-widget-area'){print ' selected="selected"';} print '>'.__('Third Footer Widget Area','ingrid').'</option>				
							<option value="fourth-footer-widget-area"'; if($tp_posts_default_f3_widget_area == 'fourth-footer-widget-area'){print ' selected="selected"';} print '>'.__('Fourth Footer Widget Area','ingrid').'</option>				
							';
							//get the rest if exist							
							if($custom_was != ''){
								foreach($custom_was as $custom_wa){
									print '<option value="'.$custom_wa['id'].'"'; if($tp_posts_default_f3_widget_area == $custom_wa['id']){print ' selected="selected"';} print '>'.$custom_wa['title'].'</option>';
								}
							}		
														
							print '
							</select>
						</td>
					</tr>
					<tr class="tp_pad">
						<th scope="row"><label>'.__('or create a new area:','ingrid').'</label></th>
						<td><input type="text" name="form-tp_posts_new_widget_area_f3" /><span style="color: #aaa;"> ('.__('enter a title for it','ingrid').')</span></td>
					</tr>
					
					
					
					
					<tr class="tp_pad">
						<th><h4>'.__('Fourth Footer Widget Area','ingrid').'</h4></th>
						<td></td>
					</tr>
					<tr class="tp_pad">
						<th scope="row"><label>'.__('Select a widget area:','ingrid').'</label></th>
						<td><select name="form-tp_posts_default_f4_widget_area">
							<option value="">'.__('Default Widget Area','ingrid').'</option>
							<option value="no-widget-area">'.__('No Widget Area','ingrid').'</option>
							<option value="primary-widget-area"'; if($tp_posts_default_f4_widget_area == 'primary-widget-area'){print ' selected="selected"';} print '>'.__('Sidebar Widget Area','ingrid').'</option>
							<option value="first-footer-widget-area"'; if($tp_posts_default_f4_widget_area == 'first-footer-widget-area'){print ' selected="selected"';} print '>'.__('First Footer Widget Area','ingrid').'</option>
							<option value="second-footer-widget-area"'; if($tp_posts_default_f4_widget_area == 'second-footer-widget-area'){print ' selected="selected"';} print '>'.__('Second Footer Widget Area','ingrid').'</option>
							<option value="third-footer-widget-area"'; if($tp_posts_default_f4_widget_area == 'third-footer-widget-area'){print ' selected="selected"';} print '>'.__('Third Footer Widget Area','ingrid').'</option>				
							<option value="fourth-footer-widget-area"'; if($tp_posts_default_f4_widget_area == 'fourth-footer-widget-area'){print ' selected="selected"';} print '>'.__('Fourth Footer Widget Area','ingrid').'</option>				
							';
							//get the rest if exist							
							if($custom_was != ''){
								foreach($custom_was as $custom_wa){
									print '<option value="'.$custom_wa['id'].'"'; if($tp_posts_default_f4_widget_area == $custom_wa['id']){print ' selected="selected"';} print '>'.$custom_wa['title'].'</option>';
								}
							}		
														
							print '
							</select>
						</td>
					</tr>
					<tr class="tp_pad">
						<th scope="row"><label>'.__('or create a new area:','ingrid').'</label></th>
						<td><input type="text" name="form-tp_posts_new_widget_area_f4" /><span style="color: #aaa;"> ('.__('enter a title for it','ingrid').')</span></td>
					</tr>
					
					
					
					
				<tr>
					<td></td>
				</tr>	
				
				<tr>					
					<td colspan="2"><h3>'.__('Set Default Widget Areas for Pages','ingrid').'</h3>
					<p>'.__('Here you can set the default sidebar and footer widget areas for pages. You can override these settings for each pages in their editor.','ingrid').'</p></td>
				</tr>
				
				
				<tr class="tp_pad">
						<th><h4>'.__('Sidebar Widget Area','ingrid').'</h4></th>
						<td></td>
					</tr>
					<tr class="tp_pad">
						<th scope="row"><label>'.__('Select a widget area:','ingrid').'</label></th>
						<td><select name="form-tp_pages_default_sb_widget_area">
							<option value="">'.__('Default Widget Area','ingrid').'</option>
							<option value="no-widget-area">'.__('No Widget Area','ingrid').'</option>
							<option value="primary-widget-area"'; if($tp_pages_default_sb_widget_area == 'primary-widget-area'){print ' selected="selected"';} print '>'.__('Sidebar Widget Area','ingrid').'</option>
							<option value="first-footer-widget-area"'; if($tp_pages_default_sb_widget_area == 'first-footer-widget-area'){print ' selected="selected"';} print '>'.__('First Footer Widget Area','ingrid').'</option>
							<option value="second-footer-widget-area"'; if($tp_pages_default_sb_widget_area == 'second-footer-widget-area'){print ' selected="selected"';} print '>'.__('Second Footer Widget Area','ingrid').'</option>
							<option value="third-footer-widget-area"'; if($tp_pages_default_sb_widget_area == 'third-footer-widget-area'){print ' selected="selected"';} print '>'.__('Third Footer Widget Area','ingrid').'</option>				
							<option value="fourth-footer-widget-area"'; if($tp_pages_default_sb_widget_area == 'fourth-footer-widget-area'){print ' selected="selected"';} print '>'.__('Fourth Footer Widget Area','ingrid').'</option>				
							';
							//get the rest if exist							
							if($custom_was != ''){
								foreach($custom_was as $custom_wa){
									print '<option value="'.$custom_wa['id'].'"'; if($tp_pages_default_sb_widget_area == $custom_wa['id']){print ' selected="selected"';} print '>'.$custom_wa['title'].'</option>';
								}
							}		
														
							print '
							</select>
						</td>
					</tr>
					<tr class="tp_pad">
						<th scope="row"><label>'.__('or create a new area:','ingrid').'</label></th>
						<td><input type="text" name="form-tp_pages_new_widget_area_sb" /><span style="color: #aaa;"> ('.__('enter a title for it','ingrid').')</span></td>
					</tr>
					
				
				
				
					<tr class="tp_pad">
						<th><h4>'.__('First Footer Widget Area','ingrid').'</h4></th>
						<td></td>
					</tr>
					<tr class="tp_pad">
						<th scope="row"><label>'.__('Select a widget area:','ingrid').'</label></th>
						<td><select name="form-tp_pages_default_f1_widget_area">
							<option value="">'.__('Default Widget Area','ingrid').'</option>
							<option value="no-widget-area">'.__('No Widget Area','ingrid').'</option>
							<option value="primary-widget-area"'; if($tp_pages_default_f1_widget_area == 'primary-widget-area'){print ' selected="selected"';} print '>'.__('Sidebar Widget Area','ingrid').'</option>
							<option value="first-footer-widget-area"'; if($tp_pages_default_f1_widget_area == 'first-footer-widget-area'){print ' selected="selected"';} print '>'.__('First Footer Widget Area','ingrid').'</option>
							<option value="second-footer-widget-area"'; if($tp_pages_default_f1_widget_area == 'second-footer-widget-area'){print ' selected="selected"';} print '>'.__('Second Footer Widget Area','ingrid').'</option>
							<option value="third-footer-widget-area"'; if($tp_pages_default_f1_widget_area == 'third-footer-widget-area'){print ' selected="selected"';} print '>'.__('Third Footer Widget Area','ingrid').'</option>				
							<option value="fourth-footer-widget-area"'; if($tp_pages_default_f1_widget_area == 'fourth-footer-widget-area'){print ' selected="selected"';} print '>'.__('Fourth Footer Widget Area','ingrid').'</option>				
							';
							//get the rest if exist							
							if($custom_was != ''){
								foreach($custom_was as $custom_wa){
									print '<option value="'.$custom_wa['id'].'"'; if($tp_pages_default_f1_widget_area == $custom_wa['id']){print ' selected="selected"';} print '>'.$custom_wa['title'].'</option>';
								}
							}		
														
							print '
							</select>
						</td>
					</tr>
					<tr class="tp_pad">
						<th scope="row"><label>'.__('or create a new area:','ingrid').'</label></th>
						<td><input type="text" name="form-tp_pages_new_widget_area_f1" /><span style="color: #aaa;"> ('.__('enter a title for it','ingrid').')</span></td>
					</tr>
					
					
					
					<tr class="tp_pad">
						<th><h4>'.__('Second Footer Widget Area','ingrid').'</h4></th>
						<td></td>
					</tr>
					<tr class="tp_pad">
						<th scope="row"><label>'.__('Select a widget area:','ingrid').'</label></th>
						<td><select name="form-tp_pages_default_f2_widget_area">
							<option value="">'.__('Default Widget Area','ingrid').'</option>
							<option value="no-widget-area">'.__('No Widget Area','ingrid').'</option>
							<option value="primary-widget-area"'; if($tp_pages_default_f2_widget_area == 'primary-widget-area'){print ' selected="selected"';} print '>'.__('Sidebar Widget Area','ingrid').'</option>
							<option value="first-footer-widget-area"'; if($tp_pages_default_f2_widget_area == 'first-footer-widget-area'){print ' selected="selected"';} print '>'.__('First Footer Widget Area','ingrid').'</option>
							<option value="second-footer-widget-area"'; if($tp_pages_default_f2_widget_area == 'second-footer-widget-area'){print ' selected="selected"';} print '>'.__('Second Footer Widget Area','ingrid').'</option>
							<option value="third-footer-widget-area"'; if($tp_pages_default_f2_widget_area == 'third-footer-widget-area'){print ' selected="selected"';} print '>'.__('Third Footer Widget Area','ingrid').'</option>				
							<option value="fourth-footer-widget-area"'; if($tp_pages_default_f2_widget_area == 'fourth-footer-widget-area'){print ' selected="selected"';} print '>'.__('Fourth Footer Widget Area','ingrid').'</option>				
							';
							//get the rest if exist							
							if($custom_was != ''){
								foreach($custom_was as $custom_wa){
									print '<option value="'.$custom_wa['id'].'"'; if($tp_pages_default_f2_widget_area == $custom_wa['id']){print ' selected="selected"';} print '>'.$custom_wa['title'].'</option>';
								}
							}		
														
							print '
							</select>
						</td>
					</tr>
					<tr class="tp_pad">
						<th scope="row"><label>'.__('or create a new area:','ingrid').'</label></th>
						<td><input type="text" name="form-tp_pages_new_widget_area_f2" /><span style="color: #aaa;"> ('.__('enter a title for it','ingrid').')</span></td>
					</tr>
					
					
					
					
					
					
					<tr class="tp_pad">
						<th><h4>'.__('Third Footer Widget Area','ingrid').'</h4></th>
						<td></td>
					</tr>
					<tr class="tp_pad">
						<th scope="row"><label>'.__('Select a widget area:','ingrid').'</label></th>
						<td><select name="form-tp_pages_default_f3_widget_area">
							<option value="">'.__('Default Widget Area','ingrid').'</option>
							<option value="no-widget-area">'.__('No Widget Area','ingrid').'</option>
							<option value="primary-widget-area"'; if($tp_pages_default_f3_widget_area == 'primary-widget-area'){print ' selected="selected"';} print '>'.__('Sidebar Widget Area','ingrid').'</option>
							<option value="first-footer-widget-area"'; if($tp_pages_default_f3_widget_area == 'first-footer-widget-area'){print ' selected="selected"';} print '>'.__('First Footer Widget Area','ingrid').'</option>
							<option value="second-footer-widget-area"'; if($tp_pages_default_f3_widget_area == 'second-footer-widget-area'){print ' selected="selected"';} print '>'.__('Second Footer Widget Area','ingrid').'</option>
							<option value="third-footer-widget-area"'; if($tp_pages_default_f3_widget_area == 'third-footer-widget-area'){print ' selected="selected"';} print '>'.__('Third Footer Widget Area','ingrid').'</option>				
							<option value="fourth-footer-widget-area"'; if($tp_pages_default_f3_widget_area == 'fourth-footer-widget-area'){print ' selected="selected"';} print '>'.__('Fourth Footer Widget Area','ingrid').'</option>				
							';
							//get the rest if exist							
							if($custom_was != ''){
								foreach($custom_was as $custom_wa){
									print '<option value="'.$custom_wa['id'].'"'; if($tp_pages_default_f3_widget_area == $custom_wa['id']){print ' selected="selected"';} print '>'.$custom_wa['title'].'</option>';
								}
							}		
														
							print '
							</select>
						</td>
					</tr>
					<tr class="tp_pad">
						<th scope="row"><label>'.__('or create a new area:','ingrid').'</label></th>
						<td><input type="text" name="form-tp_pages_new_widget_area_f3" /><span style="color: #aaa;"> ('.__('enter a title for it','ingrid').')</span></td>
					</tr>
					
					
					
					
					<tr class="tp_pad">
						<th><h4>'.__('Fourth Footer Widget Area','ingrid').'</h4></th>
						<td></td>
					</tr>
					<tr class="tp_pad">
						<th scope="row"><label>'.__('Select a widget area:','ingrid').'</label></th>
						<td><select name="form-tp_pages_default_f4_widget_area">
							<option value="">'.__('Default Widget Area','ingrid').'</option>
							<option value="no-widget-area">'.__('No Widget Area','ingrid').'</option>
							<option value="primary-widget-area"'; if($tp_pages_default_f4_widget_area == 'primary-widget-area'){print ' selected="selected"';} print '>'.__('Sidebar Widget Area','ingrid').'</option>
							<option value="first-footer-widget-area"'; if($tp_pages_default_f4_widget_area == 'first-footer-widget-area'){print ' selected="selected"';} print '>'.__('First Footer Widget Area','ingrid').'</option>
							<option value="second-footer-widget-area"'; if($tp_pages_default_f4_widget_area == 'second-footer-widget-area'){print ' selected="selected"';} print '>'.__('Second Footer Widget Area','ingrid').'</option>
							<option value="third-footer-widget-area"'; if($tp_pages_default_f4_widget_area == 'third-footer-widget-area'){print ' selected="selected"';} print '>'.__('Third Footer Widget Area','ingrid').'</option>				
							<option value="fourth-footer-widget-area"'; if($tp_pages_default_f4_widget_area == 'fourth-footer-widget-area'){print ' selected="selected"';} print '>'.__('Fourth Footer Widget Area','ingrid').'</option>				
							';
							//get the rest if exist							
							if($custom_was != ''){
								foreach($custom_was as $custom_wa){
									print '<option value="'.$custom_wa['id'].'"'; if($tp_pages_default_f4_widget_area == $custom_wa['id']){print ' selected="selected"';} print '>'.$custom_wa['title'].'</option>';
								}
							}		
														
							print '
							</select>
						</td>
					</tr>
					<tr class="tp_pad">
						<th scope="row"><label>'.__('or create a new area:','ingrid').'</label></th>
						<td><input type="text" name="form-tp_pages_new_widget_area_f4" /><span style="color: #aaa;"> ('.__('enter a title for it','ingrid').')</span></td>
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