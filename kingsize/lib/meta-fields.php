<?php  /**
 * @KingSize 2013
 *
 * The PHP code for setup Theme page custom fields.
 */
/*
	Begin creating custom fields
*/

###### HTML element fields function ########## 
function get_meta_clear($args = array(), $value = false){
	extract($args); 
	echo '<div class="clear"></div>';		
}


function get_meta_divider_start($args = array(), $value = false){
	extract($args); 
	echo '<tr style="border-top:1px solid #eeeeee;">';
}
function get_meta_divider_end($args = array(), $value = false){
	extract($args); 
	echo '</tr>';
}

function meta_button($args = array(), $value = false){
	extract($args); 
	echo '<td valign="top">';
	echo '<input style="float: left;" type="button" class="button" name="', $id, '" id="', $id, '" value="Browse" />';
	echo '</td>';
}

function meta_textarea($args = array(), $value = false){
	global $post;

	extract( $args );
	echo '<tr style="border-top:1px solid #eeeeee;">',
					'<th style="width:25%"><label for="', $id, '"><strong>', $name, '</strong><span style="line-height:18px; display:block; color:#999; margin:5px 0 0 0;">'. $desc.'</span></label></th>',
					'<td>';
	echo '<textarea name="', $id, '" id="', $id, '" value="', esc_html( get_post_meta($post->ID, $id, true), 1 ), '" rows="8" cols="5" style="width:100%; margin-right: 20px; float:left;">', esc_html( get_post_meta($post->ID, $id, true), 1 ), '</textarea>';
	echo '</td>';
}

function meta_inputbox($args = array(), $value = false){
	global $post;

	extract( $args );

		// class here			
		$class = ' class="code"';
		if($extras == "getimage" OR $extras == "getvideo") 			 
			$class = ' class="uploadbutton"'; 
		

		echo '<th style="width:25%"><label for="', $id, '"><strong>', $title, '</strong><span style="line-height:20px; display:block; color:#999; margin:5px 0 0 0;">'. $desc.'</span></label></th>',
		'<td valign="top">';

		echo '<input type="text" name="', $id, '" id="', $id, '" value="', esc_html( get_post_meta($post->ID, $id, true), 1 ),'" size="'.$size.'" style="margin-right: 20px; float:left;" '.$class.'/>';

		if($extras == "getimage" OR $extras == "getvideo") 	{
			echo '<!-- media upload -->';
			echo '<input type="file" name="upload_'.$id.'" id="upload_'.$id.'" style="border:1px solid #eeeeee;margin-right: 20px;" size="16"/>';
			echo '<!-- end media upload -->';
		}
		echo '</td>';

		echo '<input type="hidden" name="'.$id.'_noncename" id="'.$id.'_noncename" value="'.wp_create_nonce( plugin_basename( __FILE__ ) ).'" />';
	
}


function meta_selectbox($args = array(), $value = false){
	global $post;
	extract( $args );

			echo '<th style="width:25%"><label for="', $id, '"><strong>', $title, '</strong><span style="line-height:20px; display:block; color:#999; margin:5px 0 0 0;">'. $desc.'</span></label></th>',
			'<td valign="top">';

			echo "<select name='$id' id='$id' style='width:75%; margin-right: 20px; float:left;'>";
			
			if($show_default_title == "true" || $show_default_title == "")
				echo '<option value="">'.$title.'</option>';

			if(!empty($items))
			{
				foreach ($items as $key_item=>$item)
				{
					$kingsize_page_columns = get_post_meta($post->ID, $id);
				
					if(isset($kingsize_page_columns[0]) && $key_item == $kingsize_page_columns[0])
					{
						$css_string = 'selected';
					}
					else
					{
						$css_string = '';
					}
					echo '<option value="'.$key_item.'" '.$css_string.'>'.$item.'</option>';
				}
			}
			
			echo "</select>";
			echo '</td>';
}

function meta_checkbox($args = array(), $value = false){
	global $post;
	extract( $args );
	
		$checked = get_post_meta($post->ID, $id, true) == '1' ? "checked" : "";

		echo '<th style="width:25%"><label for="', $id, '"><strong>', $title, '</strong><span style="line-height:20px; display:block; color:#999; margin:5px 0 0 0;">'. $desc.'</span></label></th>';
		
		echo '<td valign="top">';
		echo "<input type='checkbox' name='".$id."' id='".$id."' value='1' ".$checked ."/>";
		echo '</td>';
	
}
###### End of html element fields function ########## 
?>