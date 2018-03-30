<?php
/**
 * The generator file of metabox
 * @package by Theme Record
 * @auther: MattMao
 */
class meta_boxes_generator 
{
	var $config;
	var $options;
	var $saved_options;

	#
	#Constructor
	#@param string $name
	#@param array $options
	function meta_boxes_generator($config, $options)
	{
		$this->config = $config;
		$this->options = $options;
		
		add_action('admin_menu', array(&$this, 'create_meta_box'));
		add_action('save_post', array(&$this, 'save_meta_box'));
	}

	#
	#create meta box
	#
	function create_meta_box() 
	{
		if (function_exists('add_meta_box')) {
			if (! empty($this->config['callback']) && function_exists($this->config['callback'])) {
				$callback = $this->config['callback'];
			} else {
				$callback = array(&$this, 'render');
			}
			foreach($this->config['pages'] as $page) {
				add_meta_box($this->config['id'], $this->config['title'], $callback, $page, $this->config['context'], $this->config['priority']);
			}
		}
	}

	#
	#save meta box
	#
	function save_meta_box($post_id) 
	{
		if (! isset($_POST[$this->config['id'] . '_noncename'])) {
			return $post_id;
		}
		
		if (! wp_verify_nonce($_POST[$this->config['id'] . '_noncename'], plugin_basename(__FILE__))) {
			return $post_id;
		}
		
		if ('page' == $_POST['post_type']) {
			if (! current_user_can('edit_page', $post_id)) {
				return $post_id;
			}
		} else {
			if (! current_user_can('edit_post', $post_id)) {
				return $post_id;
			}
		}
		
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post_id;
		}
		add_post_meta($post_id, 'textfalse', false, true);
		
		foreach($this->options as $option) {
			if (isset($option['id']) && ! empty($option['id'])) {
				
				if (isset($_POST[$option['id']])) {
					if ($option['type'] == 'multidropdown') {
						$value = array_unique(explode(',', $_POST[$option['id']]));
					} else {
						$value = $_POST[$option['id']];
					}
				} else if ($option['type'] == 'toggle') {
					$value = - 1;
				} else {
					$value = false;
				}
				
				if (get_post_meta($post_id, $option['id']) == "") {
					add_post_meta($post_id, $option['id'], $value, true);
				} elseif ($value != get_post_meta($post_id, $option['id'], true)) {
					update_post_meta($post_id, $option['id'], $value);
				} elseif ($value == "") {
					delete_post_meta($post_id, $option['id'], get_post_meta($post_id, $option['id'], true));
				}

			}
		}

	}//End save

	#
	#Render
	#
	function render() 
	{
		global $post;	
		foreach($this->options as $option) {
			if (method_exists($this, $option['type'])) {
				if (isset($option['id'])) {
					$std = get_post_meta($post->ID, $option['id'], true);
					if ($std != "") {
						$option['std'] = $std;
					}
				}
				echo '<table class="theme-metabox-table">';
				$this->$option['type']($option);
				echo '</table>';
			}
		}
		
		echo '<input type="hidden" name="' . $this->config['id'] . '_noncename" id="' . $this->config['id'] . '_noncename" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '" />';
	}


	#
	#displays a text input
	#
	function text($value) 
	{
		$size = isset($value['size']) ? $value['size'] : '10';
		$class = isset($value['class']) ? ' class="'.$value['class'].'"' : ' class="border"';

		echo '<tr valign="top"'.$class.'>';
		echo '<th class="theme-metabox-name">';
		echo '<label for="' . $value['name'] . '">' . $value['name'] . '</label>';
		if(isset($value['desc']))
		{
			echo '<span class="theme-metabox-desc theme-metabox-block">'.$value['desc'].'</span>';
		}
		echo '</th>';

		echo '<td>';
		echo '<input name="' . $value['id'] . '" id="' . $value['id'] . '" type="text" size="' . $size . '" value="' . stripslashes($value['std']) . '" />';
		if(isset($value['unit'])){ echo '<span class="unit">' . $value['unit'] . '</span>'; }
		echo '</td>';
		echo '</tr>';
	}

	#
	#displays a textarea
	#
	function textarea($value) 
	{
		$rows = isset($value['rows']) ? $value['rows'] : '7';
		$class = isset($value['class']) ? ' class="'.$value['class'].'"' : ' class="border"';
		
		echo '<tr valign="top"'.$class.'>';
		echo '<th class="theme-metabox-name">';
		echo '<label for="' . $value['name'] . '">' . $value['name'] . '</label>';
		if(isset($value['desc']))
		{
			echo '<span class="theme-metabox-desc theme-metabox-block">'.$value['desc'].'</span>';
		}
		echo '</th>';

		echo '<td>';
		echo '<textarea rows="' . $rows . '" name="' . $value['id'] . '" type="' . $value['type'] . '" class="code">' . stripslashes($value['std']) . '</textarea>';
		echo '</td>';
		echo '</tr>';
	}

	#
	#displays a select
	#
	function select($value) 
	{
		if (isset($value['target'])) {
			if (isset($value['options'])) {
				$value['options'] = $value['options'] + $this->get_select_target_options($value['target']);
			} else {
				$value['options'] = $this->get_select_target_options($value['target']);
			}
		}

		$class = isset($value['class']) ? ' class="'.$value['class'].'"' : ' class="border"';
		
		echo '<tr valign="top"'.$class.'>';

		echo '<th class="theme-metabox-name">';
		echo '<label for="' . $value['name'] . '">' . $value['name'] . '</label>';
		if(isset($value['desc']))
		{
			echo '<span class="theme-metabox-desc theme-metabox-block">'.$value['desc'].'</span>';
		}
		echo '</th>';

		echo '<td>';
		echo '<select name="' . $value['id'] . '" id="' . $value['id'] . '" class="chosen_select">';
		echo '<option value="">'. $value['prompt'] .'</option>';
		
		foreach($value['options'] as $key => $option) {
			echo '<option value="' . $key . '"';
			if ($key == $value['std']) {
				echo ' selected="selected"';
			}
			
			echo '>' . $option . '</option>';
		}
		
		echo '</select>';
		echo '</td>';
		echo '</tr>';
	}


	#
	#displays a select
	#
	function sidebar_select($value) 
	{
		if (isset($value['target'])) {
			if (isset($value['options'])) {
				$value['options'] = $value['options'] + $this->get_select_target_options($value['target']);
			} else {
				$value['options'] = $this->get_select_target_options($value['target']);
			}
		}

		echo '<div class="theme-meta-box-sidebar-select">';
		echo '<p><strong>'.$value['name'].'</strong></p>';
		echo '<label class="screen-reader-text" for="' . $value['name'] . '">' . $value['name'] . '</label>';

		echo '<select name="' . $value['id'] . '" id="' . $value['id'] . '" class="chosen_select">';
		echo '<option value="">'. $value['prompt'] .'</option>';
		
		foreach($value['options'] as $key => $option) {
			echo '<option value="' . $key . '"';
			if ($key == $value['std']) {
				echo ' selected="selected"';
			}
			
			echo '>' . $option . '</option>';
		}
		
		echo '</select>';

		if(isset($value['desc']))
		{
			echo '<p>'.$value['desc'].'</p>';
		}

		echo '</div>';
	}


	#
	#displays a checkbox
	#
	function checkbox($value) 
	{
		$checked = '';
		if (isset($this->saved_options[$value['id']])) {
			if ($this->saved_options[$value['id']] == true) {
				$checked = 'checked="checked"';
			}
		} elseif ($value['std'] == true) {
			$checked = 'checked="checked"';
		}

		$class = isset($value['class']) ? ' class="'.$value['class'].'"' : ' class="border"';
		
		echo '<tr valign="top"'.$class.'>';

		echo '<th class="theme-metabox-name"><label for="' . $value['name'] . '">' . $value['name'] . '</label></th>';

		echo '<td>';
		echo '<input type="checkbox" name="' . $value['id'] . '" id="' . $value['id'] . '" value="true" ' . $checked . ' />';

		if(isset($value['desc']))
		{
			echo '<span class="theme-metabox-checkbox-desc">'.$value['desc'].'</span>';
		}
		echo '</td>';
		echo '</tr>';
	}

	#
	#displays a upload
	#
	function upload($value) 
	{
		$size = isset($value['size']) ? $value['size'] : '10';
		$button = isset($value['button']) ? $value['button'] : 'Upload Image';
		$class = isset($value['class']) ? ' class="'.$value['class'].'"' : ' class="border"';
		
		echo '<tr valign="top"'.$class.'>';

		echo '<th class="theme-metabox-name">';
		echo '<label for="' . $value['name'] . '">' . $value['name'] . '</label>';
		if(isset($value['desc']))
		{
			echo '<span class="theme-metabox-desc theme-metabox-block">'.$value['desc'].'</span>';
		}
		echo '</th>';

		echo '<td>';
		echo '<input name="' . $value['id'] . '" id="' . $value['id'] . '" type="text" size="' . $size . '" value="' . stripslashes($value['std']) . '" />';
		echo '<input id="' . $value['id'] . '_button" name="' . $value['id'] . '_button" type="button" value="'.$button.'" class="button-secondary" />';
		echo '</td>';
		echo '</tr>';
	}


	#
	#displays a upload images
	#
	function upload_images($value) 
	{
		global $post;
		$button = isset($value['button']) ? $value['button'] : 'Upload Image';
		$class = isset($value['class']) ? ' class="'.$value['class'].'"' : ' class="border"';
		$post_id = $post->ID;
		$exclude_featured_image = get_meta_option('exclude_featured_image');
		if($exclude_featured_image == true) { $exclude_thumb_id = get_post_thumbnail_id(); } else { $exclude_thumb_id = ''; }
		
		echo '<tr valign="top"'.$class.'>';
		echo '<td>';
		if(isset($value['desc']))
		{
			echo '<div class="theme-metabox-upload-image-desc theme-metabox-block">'.$value['desc'].'</div>';
		}

		$args = array(
			'post_parent' => $post_id,
			'post_type' => 'attachment',
			'post_mime_type' => 'image',
			'post_status' => null,
			'orderby' => 'menu_order',
			'order' => 'ASC',
			'posts_per_page' => -1,
			'exclude' => $exclude_thumb_id,
			'meta_query' => array(
				array(
					'key' => '_post_theme_exclude_image',
					'value' => '1',
					'compare' => 'NOT LIKE'
				)
			)
		);
		$attachments = get_posts( $args );

		if ($attachments) {

			echo '<ul class="theme-upload-images-list clearfix">';
			foreach ( $attachments as $attachment ) {
				$thumbnail = wp_get_attachment_image_src( $attachment->ID, 'admin-thumbnail' );
				echo '<li><img width="'.$thumbnail[1].'" height="'.$thumbnail[2].'" src="'.$thumbnail[0].'" class="wp-post-image" alt="" /></li>';
			}
			echo '</ul>';
		}

		echo '<div class="upload-image-button"><input id="' . $value['id'] . '_button" name="' . $value['id'] . '_button" type="button" value="'.$button.'" class="button-secondary" /></div>';

		echo '<script type="text/javascript">'."\n";
		echo '//<![CDATA['."\n";
		echo 'jQuery(document).ready(function() {'."\n";
		echo '	jQuery("#'.$value['id'].'_button").click(function() {	'."\n";	
		echo '		window.send_to_editor = function(html) '."\n";		
		echo '		{'."\n";
		echo '			imgurl = jQuery("img",html).attr("src");'."\n";
		echo '			jQuery("#'.$value['id'].'").val(imgurl);'."\n";
		echo '			tb_remove();'."\n";
		echo '		}'."\n";				
		echo '		tb_show("", "media-upload.php?post_id='.$post_id.'&amp;type=image&amp;TB_iframe=true");'."\n";
		echo '		return false;'."\n";		
		echo '	});'."\n";
		echo '});'."\n";
		echo '//]]>'."\n";
		echo '</script>'."\n";

		echo '</td>';
		echo '</tr>';
	}


	#
	#displays a radio
	#
	function radio($value) 
	{		
		$class = isset($value['class']) ? ' class="'.$value['class'].'"' : ' class="border"';
		
		echo '<tr valign="top"'.$class.'>';

		echo '<th class="theme-metabox-name">';
		echo '<label for="' . $value['name'] . '">' . $value['name'] . '</label>';
		if(isset($value['desc']))
		{
			echo '<span class="theme-metabox-desc theme-metabox-block">'.$value['desc'].'</span>';
		}
		echo '</th>';

		echo '<td>';
		echo '<div id="'.$value['id'].'_radio" class="clearfix">';

		$i = 0;
		foreach($value['options'] as $key => $option) {
			$i++;
			$checked = '';
			if ($key == $value['std']) {
				$checked = ' checked="checked"';
			}
			
			echo '<div class="radio-in-line">';
			echo '<input type="radio" id="' . $value['id'] . '_' . $key . '" name="' . $value['id'] . '" value="' . $key . '" ' . $checked . ' />';
			echo '<label for="' . $value['id'] . '_' . $i . '">' . $option . '</label>';
			echo '</div>';
		}

		echo '</div>';
		echo '</td>';
		echo '</tr>';	
	}


	#
	#displays a target options
	#
	function get_select_target_options($type)
	{
		$options = array();
		switch($type){
			case 'page':
				$entries = get_pages('title_li=&orderby=name');
				foreach($entries as $key => $entry) {
					$options[$entry->ID] = $entry->post_title;
				}
			break;
			case 'cat':
				$entries = get_categories('title_li=&orderby=name&hide_empty=0');
				foreach($entries as $key => $entry) {
					$options[$entry->term_id] = $entry->name;
				}
			break;
			case 'post':
				$entries = get_posts('orderby=title&numberposts=-1&order=ASC');
				foreach($entries as $key => $entry) {
					$options[$entry->ID] = $entry->post_title;
				}
			break;
			case 'sidebar':
				$entries = get_posts('post_type=sidebar&orderby=title&numberposts=-1&order=ASC');
				foreach($entries as $entry) {
					global $post;
					$options[$entry->ID] = get_meta_option('sidebar_name', $entry->ID);
				}
			break;
		}		
		return $options;
	}

}//End class


?>