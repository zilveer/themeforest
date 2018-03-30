<?php

add_action ( 'edit_category_form_fields', 'ABdev_aeron_extra_category_fields');
add_action ( 'category_add_form_fields', 'ABdev_aeron_extra_add_category_fields');

if ( ! function_exists( 'ABdev_aeron_extra_category_fields' ) ){
	function ABdev_aeron_extra_category_fields( $tag ) {    
		$t_id = $tag->term_id;
		$cat_meta = get_option( "category_$t_id");
		?>
		<tr class="form-field">
			<th scope="row" valign="top"><label for="extra1"><?php _e('Blog Layout', 'ABdev_aeron'); ?></label></th>
			<td>
				<select name="Cat_meta[sidebar_position]">
					<?php
					$sidebar_pos[$cat_meta['sidebar_position']] = ' selected';
					echo '<option value="right"'.$sidebar_pos['right'].'>'.__('Right Sidebar', 'ABdev_aeron').'</option> ';
					echo '<option value="left"'.$sidebar_pos['left'].'>'.__('Left Sidebar', 'ABdev_aeron').'</option> ';
					echo '<option value="none"'.$sidebar_pos['none'].'>'.__('No Sidebar', 'ABdev_aeron').'</option> ';
					echo '<option value="timeline"'.$sidebar_pos['timeline'].'>'.__('Timeline', 'ABdev_aeron').'</option> ';
					?>
				</select>
			</td>
		</tr>

		<tr class="form-field">
			<th scope="row" valign="top"><label for="cat_Image_url"><?php _e('Sidebar', 'ABdev_aeron'); ?></label></th>
			<td>
				<?php 
				global $wp_registered_sidebars;
				for($i=0;$i<1;$i++){ ?>
					<select name="Cat_meta[sidebar]">
					<?php
					$sidebar_replacements = $wp_registered_sidebars;
					if(is_array($sidebar_replacements) && !empty($sidebar_replacements)){
						foreach($sidebar_replacements as $sidebar){
							if($sidebar['name'] == $cat_meta['sidebar']){
								echo "<option value='{$sidebar['name']}' selected>{$sidebar['name']}</option>";
							}else{
								echo "<option value='{$sidebar['name']}'>{$sidebar['name']}</option> ";
							}
						}
					}
					?>
					</select>
					<br>
				<?php } ?>
				<span class="description"><?php _e('Please select the sidebar you would like to display on this category. Note: If you like to use custom sidebar you must first create it under Appearance > Theme Options > Sidebars.', 'ABdev_aeron'); ?></span>
			</td>
		</tr>

	<?php
	}
}

if ( ! function_exists( 'ABdev_aeron_extra_add_category_fields' ) ){
	function ABdev_aeron_extra_add_category_fields( $tag ) {    
		$t_id = (is_object($tag))?$tag->term_id:'';
		$cat_meta = get_option( "category_$t_id");
		?>

		<div class="form-field">
			<label for="extra1"><?php _e('Blog Layout', 'ABdev_aeron'); ?></label></th>
			<select name="Cat_meta[sidebar_position]">
				<?php
				$sidebar_pos[$cat_meta['sidebar_position']] = ' selected';
				echo '<option value="right"'.$sidebar_pos['right'].'>'.__('Right Sidebar', 'ABdev_aeron').'</option> ';
				echo '<option value="left"'.$sidebar_pos['left'].'>'.__('Left Sidebar', 'ABdev_aeron').'</option> ';
				echo '<option value="none"'.$sidebar_pos['none'].'>'.__('No Sidebar', 'ABdev_aeron').'</option> ';
				echo '<option value="timeline"'.$sidebar_pos['timeline'].'>'.__('Timeline', 'ABdev_aeron').'</option> ';
				?>
			</select>
		</div>

		<div class="form-field">
			<label for="cat_Image_url"><?php _e('Sidebar', 'ABdev_aeron'); ?></label>
			<?php 
			global $wp_registered_sidebars;
			for($i=0;$i<1;$i++){ ?>
				<select name="Cat_meta[sidebar]">
					<?php
					$sidebar_replacements = $wp_registered_sidebars;
					if(is_array($sidebar_replacements) && !empty($sidebar_replacements)){
						foreach($sidebar_replacements as $sidebar){
							if($sidebar['name'] == $cat_meta['sidebar']){
								echo "<option value='{$sidebar['name']}' selected>{$sidebar['name']}</option> ";
							}else{
								echo "<option value='{$sidebar['name']}'>{$sidebar['name']}</option> ";
							}
						}
					}
					?>
				</select> <br>
			<?php 
			} ?>
			
			<p><?php _e('Please select the sidebar you would like to display on this category. Note: If you like to use custom sidebar you must first create it under Appearance > Theme Options > Sidebars.', 'ABdev_aeron'); ?></p>
		</div>
		<?php
	}
}
add_action ( 'edited_category', 'ABdev_aeron_save_extra_category_fileds');
add_action ( 'created_category', 'ABdev_aeron_save_extra_category_fileds');

if ( ! function_exists( 'ABdev_aeron_save_extra_category_fileds' ) ){
	function ABdev_aeron_save_extra_category_fileds( $term_id ) {
		if ( isset( $_POST['Cat_meta'] ) ) {
			$t_id = $term_id;
			$cat_meta = get_option( "category_$t_id");
			$cat_keys = array_keys($_POST['Cat_meta']);
			foreach ($cat_keys as $key){
				if(isset($_POST['Cat_meta'][$key])){
					$cat_meta[$key] = $_POST['Cat_meta'][$key];
				}
			}
			update_option( "category_$t_id", $cat_meta );
		}
	}
}