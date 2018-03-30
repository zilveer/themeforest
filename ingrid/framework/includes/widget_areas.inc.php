<?php



//fix broken array option
	$ucwa = get_option('ub_custom_widget_areas');
	if($ucwa == 'a:0:{}'){
		delete_option('ub_custom_widget_areas');
	}	
	

// widget area selector/creator
	$new_meta_boxes_w_area  = array(
		"sc_gen" => array(
		"name" => "ub_widget_area",
		"std" => "",
		"title" => __("Widget Area Settings","ingrid")
		)
	);

	function new_meta_boxes_w_area() {
		global $post, $new_meta_boxes_w_area;
		 
		foreach($new_meta_boxes_w_area as $meta_box) {
			$meta_box_value = get_post_meta($post->ID, 'ub_widget_area', true);
			$meta_box_value2 = get_post_meta($post->ID, 'ub_widget_area_f1', true);
			$meta_box_value3 = get_post_meta($post->ID, 'ub_widget_area_f2', true);
			$meta_box_value4 = get_post_meta($post->ID, 'ub_widget_area_f3', true);
			$meta_box_value5 = get_post_meta($post->ID, 'ub_widget_area_f4', true);
			
			
			echo'<div class="ub_input_field"><b>'.__('Sidebar Widget Area','ingrid').'</b></div>		
			<div class="ub_input_field"><label>'.__('Select a widget area to display:','ingrid').'</label>
			<select id="ub_scg_select" name="ub_widget_area" id="ub_widget_area" style="width: 200px; float: left;">
			<option value="">'.__('Default Widget Area','ingrid').'</option>
			<option value="no-widget-area"'; if($meta_box_value == 'no-widget-area'){print ' selected="selected"';} print '>'.__('No Widget Area','ingrid').'</option>
			<option value="primary-widget-area"'; if($meta_box_value == 'primary-widget-area'){print ' selected="selected"';} print '>'.__('Sidebar Widget Area','ingrid').'</option>
			<option value="first-footer-widget-area"'; if($meta_box_value == 'first-footer-widget-area'){print ' selected="selected"';} print '>'.__('First Footer Widget Area','ingrid').'</option>
			<option value="second-footer-widget-area"'; if($meta_box_value == 'second-footer-widget-area'){print ' selected="selected"';} print '>'.__('Second Footer Widget Area','ingrid').'</option>
			<option value="third-footer-widget-area"'; if($meta_box_value == 'third-footer-widget-area'){print ' selected="selected"';} print '>'.__('Third Footer Widget Area','ingrid').'</option>				
			<option value="fourth-footer-widget-area"'; if($meta_box_value == 'fourth-footer-widget-area'){print ' selected="selected"';} print '>'.__('Fourth Footer Widget Area','ingrid').'</option>				
			';
			//get the rest if exist
			$custom_was = maybe_unserialize(get_option('ub_custom_widget_areas'));
			if($custom_was != ''){
				foreach($custom_was as $custom_wa){
					print '<option value="'.$custom_wa['id'].'"'; if($meta_box_value == $custom_wa['id']){print ' selected="selected"';} print '>'.$custom_wa['title'].'</option>';
				}
			}		
			
						
			print '
			</select></div>
			
			<div class="ub_input_field"><label>'.__('or create a new area:','ingrid').'</label>
				<input type="text" name="ub_new_widget_area" /><span style="color: #aaa;"> ('.__('enter a title for it','ingrid').')</span>
			</div>
			
			
			
			
			<div class="ub_input_field"><hr /></div>			
			<div class="ub_input_field"><b>'.__('First Footer Widget Area','ingrid').'</b></div>		
			<div class="ub_input_field"><label>'.__('Select a widget area to display:','ingrid').'</label>
			<select id="ub_scg_select" name="ub_widget_area_f1" id="ub_widget_area_f1" style="width: 200px; float: left;">
			<option value="">'.__('Default Widget Area','ingrid').'</option>
			<option value="no-widget-area"'; if($meta_box_value2 == 'no-widget-area'){print ' selected="selected"';} print '>'.__('No Widget Area','ingrid').'</option>
			<option value="primary-widget-area"'; if($meta_box_value2 == 'primary-widget-area'){print ' selected="selected"';} print '>'.__('Sidebar Widget Area','ingrid').'</option>
			<option value="first-footer-widget-area"'; if($meta_box_value2 == 'first-footer-widget-area'){print ' selected="selected"';} print '>'.__('First Footer Widget Area','ingrid').'</option>
			<option value="second-footer-widget-area"'; if($meta_box_value2 == 'second-footer-widget-area'){print ' selected="selected"';} print '>'.__('Second Footer Widget Area','ingrid').'</option>
			<option value="third-footer-widget-area"'; if($meta_box_value2 == 'third-footer-widget-area'){print ' selected="selected"';} print '>'.__('Third Footer Widget Area','ingrid').'</option>				
			<option value="fourth-footer-widget-area"'; if($meta_box_value2 == 'fourth-footer-widget-area'){print ' selected="selected"';} print '>'.__('Fourth Footer Widget Area','ingrid').'</option>				
			';
			//get the rest if exist
			if($custom_was != ''){
				foreach($custom_was as $custom_wa){
					print '<option value="'.$custom_wa['id'].'"'; if($meta_box_value2 == $custom_wa['id']){print ' selected="selected"';} print '>'.$custom_wa['title'].'</option>';
				}
			}		
			print '
			</select></div>
			
			<div class="ub_input_field"><label>'.__('or create a new area:','ingrid').'</label>
			<input type="text" name="ub_new_widget_area_f1" /><span style="color: #aaa;"> ('.__('enter a title for it','ingrid').')</span>
			</div>
			
			
			
			<div class="ub_input_field"><hr /></div>					
			<div class="ub_input_field"><b>'.__('Second Footer Widget Area','ingrid').'</b></div>		
			<div class="ub_input_field"><label>'.__('Select a widget area to display:','ingrid').'</label>
			<select id="ub_scg_select" name="ub_widget_area_f2" id="ub_widget_area_f2" style="width: 200px; float: left;">
			<option value="">'.__('Default Widget Area','ingrid').'</option>
			<option value="no-widget-area"'; if($meta_box_value3 == 'no-widget-area'){print ' selected="selected"';} print '>'.__('No Widget Area','ingrid').'</option>
			<option value="primary-widget-area"'; if($meta_box_value3 == 'primary-widget-area'){print ' selected="selected"';} print '>'.__('Sidebar Widget Area','ingrid').'</option>
			<option value="first-footer-widget-area"'; if($meta_box_value3 == 'first-footer-widget-area'){print ' selected="selected"';} print '>'.__('First Footer Widget Area','ingrid').'</option>
			<option value="second-footer-widget-area"'; if($meta_box_value3 == 'second-footer-widget-area'){print ' selected="selected"';} print '>'.__('Second Footer Widget Area','ingrid').'</option>
			<option value="third-footer-widget-area"'; if($meta_box_value3 == 'third-footer-widget-area'){print ' selected="selected"';} print '>'.__('Third Footer Widget Area','ingrid').'</option>				
			<option value="fourth-footer-widget-area"'; if($meta_box_value3 == 'fourth-footer-widget-area'){print ' selected="selected"';} print '>'.__('Fourth Footer Widget Area','ingrid').'</option>				
			';
			//get the rest if exist
			if($custom_was != ''){
				foreach($custom_was as $custom_wa){
					print '<option value="'.$custom_wa['id'].'"'; if($meta_box_value3 == $custom_wa['id']){print ' selected="selected"';} print '>'.$custom_wa['title'].'</option>';
				}
			}		
			print '
			</select></div>
			
			<div class="ub_input_field"><label>'.__('or create a new area:','ingrid').'</label>
			<input type="text" name="ub_new_widget_area_f2" /><span style="color: #aaa;"> ('.__('enter a title for it','ingrid').')</span>
			</div>		
			
			
			<div class="ub_input_field"><hr /></div>					
			<div class="ub_input_field"><b>'.__('Third Footer Widget Area','ingrid').'</b></div>		
			<div class="ub_input_field"><label>'.__('Select a widget area to display:','ingrid').'</label>
			<select id="ub_scg_select" name="ub_widget_area_f3" id="ub_widget_area_f3" style="width: 200px; float: left;">
			<option value="">'.__('Default Widget Area','ingrid').'</option>
			<option value="no-widget-area"'; if($meta_box_value4 == 'no-widget-area'){print ' selected="selected"';} print '>'.__('No Widget Area','ingrid').'</option>
			<option value="primary-widget-area"'; if($meta_box_value4 == 'primary-widget-area'){print ' selected="selected"';} print '>'.__('Sidebar Widget Area','ingrid').'</option>
			<option value="first-footer-widget-area"'; if($meta_box_value4 == 'first-footer-widget-area'){print ' selected="selected"';} print '>'.__('First Footer Widget Area','ingrid').'</option>
			<option value="second-footer-widget-area"'; if($meta_box_value4 == 'second-footer-widget-area'){print ' selected="selected"';} print '>'.__('Second Footer Widget Area','ingrid').'</option>
			<option value="third-footer-widget-area"'; if($meta_box_value4 == 'third-footer-widget-area'){print ' selected="selected"';} print '>'.__('Third Footer Widget Area','ingrid').'</option>				
			<option value="fourth-footer-widget-area"'; if($meta_box_value4 == 'fourth-footer-widget-area'){print ' selected="selected"';} print '>'.__('Fourth Footer Widget Area','ingrid').'</option>				
			';
			//get the rest if exist
			if($custom_was != ''){
				foreach($custom_was as $custom_wa){
					print '<option value="'.$custom_wa['id'].'"'; if($meta_box_value4 == $custom_wa['id']){print ' selected="selected"';} print '>'.$custom_wa['title'].'</option>';
				}
			}		
			print '
			</select></div>
			
			<div class="ub_input_field"><label>'.__('or create a new area:','ingrid').'</label>
			<input type="text" name="ub_new_widget_area_f3" /><span style="color: #aaa;"> ('.__('enter a title for it','ingrid').')</span>
			</div>
			
			
			
			<div class="ub_input_field"><hr /></div>					
			<div class="ub_input_field"><b>'.__('Fourth Footer Widget Area','ingrid').'</b></div>		
			<div class="ub_input_field"><label>'.__('Select a widget area to display:','ingrid').'</label>
			<select id="ub_scg_select" name="ub_widget_area_f4" id="ub_widget_area_f4" style="width: 200px; float: left;">
			<option value="">'.__('Default Widget Area','ingrid').'</option>
			<option value="no-widget-area"'; if($meta_box_value5 == 'no-widget-area'){print ' selected="selected"';} print '>'.__('No Widget Area','ingrid').'</option>
			<option value="primary-widget-area"'; if($meta_box_value5 == 'primary-widget-area'){print ' selected="selected"';} print '>'.__('Sidebar Widget Area','ingrid').'</option>
			<option value="first-footer-widget-area"'; if($meta_box_value5 == 'first-footer-widget-area'){print ' selected="selected"';} print '>'.__('First Footer Widget Area','ingrid').'</option>
			<option value="second-footer-widget-area"'; if($meta_box_value5 == 'second-footer-widget-area'){print ' selected="selected"';} print '>'.__('Second Footer Widget Area','ingrid').'</option>
			<option value="third-footer-widget-area"'; if($meta_box_value5 == 'third-footer-widget-area'){print ' selected="selected"';} print '>'.__('Third Footer Widget Area','ingrid').'</option>				
			<option value="fourth-footer-widget-area"'; if($meta_box_value5 == 'fourth-footer-widget-area'){print ' selected="selected"';} print '>'.__('Fourth Footer Widget Area','ingrid').'</option>				
			';
			//get the rest if exist			
			if($custom_was != ''){
				foreach($custom_was as $custom_wa){
					print '<option value="'.$custom_wa['id'].'"'; if($meta_box_value5 == $custom_wa['id']){print ' selected="selected"';} print '>'.$custom_wa['title'].'</option>';
				}
			}		
			print '
			</select></div>
			
			<div class="ub_input_field"><label>'.__('or create a new area:','ingrid').'</label>
			<input type="text" name="ub_new_widget_area_f4" /><span style="color: #aaa;"> ('.__('enter a title for it','ingrid').')</span>
			</div>
			';
			
			
		}
	}

	function create_meta_w_area() {
		global $theme_name;
		if ( function_exists('add_meta_box') ) {
			add_meta_box( 'new-meta-boxes_w_area', 'Widget Area Settings', 'new_meta_boxes_w_area', 'post', 'normal', 'high' );
			add_meta_box( 'new-meta-boxes_w_area', 'Widget Area Settings', 'new_meta_boxes_w_area', 'page', 'normal', 'high' );
			add_meta_box( 'new-meta-boxes_w_area', 'Widget Area Settings', 'new_meta_boxes_w_area', 'galleries', 'normal', 'high' );
		}
	}

	function save_postdata_w_area( $post_id ) {
		global $post, $new_meta_boxes_w_area;
		 
		if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
			return $post_id;
		}else{	
			//sidebar w area
			if(!empty($_POST['ub_new_widget_area'])){			
				//add new widget area		
				$ub_c_was = maybe_unserialize(get_option('ub_custom_widget_areas'));
				
				//check dupes
				if($ub_c_was != ''){
				foreach($ub_c_was as $ub_c_wa){
					if($ub_c_wa['id'] == ('ub_wa_'.time()))
					$found_ub_c_wa = '1';
				}
				}
				
				if($found_ub_c_wa != '1'){
					$nuarr['title'] = $_POST['ub_new_widget_area'];
					$nuarr['id'] = 'ub_wa_'.time();
					$ub_c_was[] = $nuarr;
					
					update_option('ub_custom_widget_areas',$ub_c_was);
					
					
					
					
					//and save it as selected
					update_post_meta($post_id,'ub_widget_area',$nuarr['id']);		
				}
				
				$tp_wa_id = $nuarr['id'];
				
			}else{
				//save selected
				if(!empty($_POST['ub_widget_area'])){
					update_post_meta($post_id,'ub_widget_area',$_POST['ub_widget_area']);
					$tp_wa_id = $_POST['ub_widget_area'];
				}else{
					delete_post_meta($post_id,'ub_widget_area');
				}
				
			}
			
			
			
			//footer w area 1
			if(!empty($_POST['ub_new_widget_area_f1'])){			
				//add new widget area		
				$ub_c_was = maybe_unserialize(get_option('ub_custom_widget_areas'));
				
				//check dupes
				if($ub_c_was != ''){
				foreach($ub_c_was as $ub_c_wa){
					if($ub_c_wa['id'] == ('ub_wa_f1'.time()))
					$found_ub_c_wa = '1';
				}
				}
				
				if($found_ub_c_wa != '1'){
					$nuarr['title'] = $_POST['ub_new_widget_area_f1'];
					$nuarr['id'] = 'ub_wa_f1'.time();
					$ub_c_was[] = $nuarr;
					
					update_option('ub_custom_widget_areas',$ub_c_was);
					
					
					
					
					//and save it as selected
					update_post_meta($post_id,'ub_widget_area_f1',$nuarr['id']);	

					$tp_wa_f1_id = $nuarr['id'];
				}
			}else{
				//save selected
				if(!empty($_POST['ub_widget_area_f1'])){
					update_post_meta($post_id,'ub_widget_area_f1',$_POST['ub_widget_area_f1']);
					$tp_wa_f1_id = $_POST['ub_widget_area_f1'];
				}else{
					delete_post_meta($post_id,'ub_widget_area_f1');
				}
			}
			
			
			
			
			if(!empty($_POST['ub_new_widget_area_f2'])){			
				//add new widget area		
				$ub_c_was = maybe_unserialize(get_option('ub_custom_widget_areas'));
				
				//check dupes
				if($ub_c_was != ''){
				foreach($ub_c_was as $ub_c_wa){
					if($ub_c_wa['id'] == ('ub_wa_f2'.time()))
					$found_ub_c_wa = '1';
				}
				}
				
				if($found_ub_c_wa != '1'){
					$nuarr['title'] = $_POST['ub_new_widget_area_f2'];
					$nuarr['id'] = 'ub_wa_f2'.time();
					$ub_c_was[] = $nuarr;
					
					update_option('ub_custom_widget_areas',$ub_c_was);
					
					
					
					
					//and save it as selected
					update_post_meta($post_id,'ub_widget_area_f2',$nuarr['id']);		
				}
			}else{
				//save selected
				if(!empty($_POST['ub_widget_area_f2'])){
					update_post_meta($post_id,'ub_widget_area_f2',$_POST['ub_widget_area_f2']);
				}else{
					delete_post_meta($post_id,'ub_widget_area_f2');
				}
			}
			
			
			
			
			if(!empty($_POST['ub_new_widget_area_f3'])){			
				//add new widget area		
				$ub_c_was = maybe_unserialize(get_option('ub_custom_widget_areas'));
				
				//check dupes
				if($ub_c_was != ''){
				foreach($ub_c_was as $ub_c_wa){
					if($ub_c_wa['id'] == ('ub_wa_f3'.time()))
					$found_ub_c_wa = '1';
				}
				}
				
				if($found_ub_c_wa != '1'){
					$nuarr['title'] = $_POST['ub_new_widget_area_f3'];
					$nuarr['id'] = 'ub_wa_f3'.time();
					$ub_c_was[] = $nuarr;
					
					update_option('ub_custom_widget_areas',$ub_c_was);
					
					
					
					
					//and save it as selected
					update_post_meta($post_id,'ub_widget_area_f3',$nuarr['id']);		
				}
			}else{
				//save selected
				if(!empty($_POST['ub_widget_area_f3'])){
					update_post_meta($post_id,'ub_widget_area_f3',$_POST['ub_widget_area_f3']);
				}else{
					delete_post_meta($post_id,'ub_widget_area_f3');
				}
			}
			
			
			
			
			
			if(!empty($_POST['ub_new_widget_area_f4'])){			
				//add new widget area		
				$ub_c_was = maybe_unserialize(get_option('ub_custom_widget_areas'));
				
				//check dupes
				if($ub_c_was != ''){
				foreach($ub_c_was as $ub_c_wa){
					if($ub_c_wa['id'] == ('ub_wa_f4'.time()))
					$found_ub_c_wa = '1';
				}
				}
				
				if($found_ub_c_wa != '1'){
					$nuarr['title'] = $_POST['ub_new_widget_area_f4'];
					$nuarr['id'] = 'ub_wa_f4'.time();
					$ub_c_was[] = $nuarr;
					
					update_option('ub_custom_widget_areas',$ub_c_was);
					
					
					
					
					//and save it as selected
					update_post_meta($post_id,'ub_widget_area_f4',$nuarr['id']);		
				}
			}else{
				//save selected
				if(!empty($_POST['ub_widget_area_f4'])){
					update_post_meta($post_id,'ub_widget_area_f4',$_POST['ub_widget_area_f4']);
				}else{
					delete_post_meta($post_id,'ub_widget_area_f4');
				}
			}
			
			
		}
	}
	add_action('admin_menu', 'create_meta_w_area');
	add_action('save_post', 'save_postdata_w_area');
	
?>