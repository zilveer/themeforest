<?php
/**
 * @package by MattMao * 
*/

class theme_options_generator 
{
	var $name;
	var $options;
	var $saved_options;


	#
	# Theme options generator
	#
	function theme_options_generator($name, $options) 
	{
	
		$this->name = $name;
		$this->options = $options;
		
		$this->save_options();
		$this->render();

	}
	#
	#End theme options generator
	#



	#
	# Save options
	#
	function save_options() 
	{
		$options = get_option('admin_' .THEME_SLUG . '_' . $this->name);
		
		if (isset($_POST['save_theme_options'])) {
			
			foreach($this->options as $value) {
				if (isset($value['id']) && ! empty($value['id'])) {
					if (isset($_POST[$value['id']])) {
						if ($value['type'] == 'multidropdown') {
							if(empty($_POST[$value['id']])){
								$options[$value['id']] = array();
							}else{
								$options[$value['id']] = array_unique(explode(',', $_POST[$value['id']]));
							}
						} else {
							$options[$value['id']] = $_POST[$value['id']];
						}
					} else {
						$options[$value['id']] = false;
					}
				}
			}

			if ($options != $this->options) {
				update_option('admin_' .THEME_SLUG . '_' . $this->name, $options);
			}
			echo '<div id="message" class="updated fade"><p><strong>Updated Successfully</strong></p></div>';						
		}
		
		$this->saved_options = $options;

	}
	#
	# End save options
	#



	#
	# The render
	#
	function render() 
	{
		echo '<div class="wrap theme-settings-page">';
		
		foreach($this->options as $option) 
		{
			if (method_exists($this, $option['type'])) {
				$this->$option['type']($option);
			}		
		}

		echo '<div class="theme-settings-wrap-title-bottom"><div class="theme-settings-save"><input type="submit" name="save_theme_options" class="button-primary" value="Save Changes" /></div></div>';
		echo '</div>';
		echo '</form>';
		echo '</div>';
	}
	#
	# End the render
	#



	#
	#Page Title
	#
	function tab_page_title($value) 
	{
		echo '<div id="icon-theme-settings" class="icon32 icon32-theme-settings"><br /></div><h2 class="theme-settings-title">' . $value['name'] . '<span>Verson:'.THEME_VERSION.'</span></h2>';
		echo '<form method="post" action="">';
		echo '<div class="theme-settings-wrap-title-top"><div class="theme-settings-save"><input type="submit" name="save_theme_options" class="button-primary" value="Save Changes" /></div></div>';
		echo '<div class="theme-settings-wrap">';
	}



	#
	# The tabs head
	#
	function tabs_head() 
	{
		echo '<div class="theme-settings-tabs clearfix">';
	}



	#
	# The tabs foot
	#
	function tabs_foot() 
	{
		echo '</div>';
		echo '</div>';
	}


	#
	# The tabs
	#
	function tab_title_head() 
	{
		echo '<ul class="clearfix theme-tabs-title">';
	}


	#
	# The tabs
	#
	function tab($value) 
	{
		$class = isset($value['class']) ? $value['class'] : 'not-active';

		echo '<li><a href="#theme-tab-' . $value['slug'] . '" class="'.$class.'">' . $value['name'] . '</a></li>';
	}


	#
	# The tabs
	#
	function tab_title_foot() 
	{
		echo '</ul>';
		echo '<div class="theme-tabs-box">';
	}


	#
	# The tab content
	#
	function tab_content_head($value) 
	{
		$class = isset($value['class']) ? $value['class'] : 'not-hide';

		echo '<div id="theme-tab-' . $value['slug'] . '" class="'.$class.'">';
	}


	#
	# The tab content
	#
	function tab_content_foot() 
	{
		echo '</div>';
	}


	#
	# The tab sub title
	#
	function tab_sub_title($value) 
	{
		if(isset($value['class']) && $value['class'] == 'no') { $class = 'tab-sub-title tab-sub-title-noborder'; } else { $class = 'tab-sub-title'; }

		echo '<div class="'.$class.'"><h3>'. $value['name'] . '</h3></div>';
	}


	#
	#displays a text input
	#
	function text($value) {
		$size = isset($value['size']) ? $value['size'] : '10';
		if(isset($value['class']) && $value['class'] == 'no') { $class = 'theme-settings-item theme-settings-item-noborder'; } else { $class = 'theme-settings-item'; }
		
		echo '<div class="'.$class.'">';
		echo '<h3 class="title"><label for="'.$value['id'].'">' . $value['name'] . '</label></h3>';
		echo '<div class="box">';
		echo '<input name="' . $value['id'] . '" id="' . $value['id'] . '" type="text" size="' . $size . '" value="';
		if (isset($this->saved_options[$value['id']])) {
			echo stripslashes($this->saved_options[$value['id']]);
		} else {
			echo stripslashes($value['std']);
		}
		echo '" />';
		if(isset($value['unit'])){ echo '<span class="unit">' . $value['unit'] . '</span>'; }
		if(isset($value['desc'])){
			echo '<p class="description">' . $value['desc'] . '</p>';
		}
		echo '</div>';
		echo '</div>';
	}


	#
	# displays a textarea
	#
	function textarea($value)
	{
		$rows = isset($value['rows']) ? $value['rows'] : '5';		
		if(isset($value['class']) && $value['class'] == 'no') { $class = 'theme-settings-item theme-settings-item-noborder'; } else { $class = 'theme-settings-item'; }
		
		echo '<div class="'.$class.'">';
		echo '<h3 class="title"><label for="'.$value['id'].'">' . $value['name'] . '</label></h3>';
		echo '<div class="box">';
		echo '<textarea id="'.$value['id'].'" rows="' . $rows . '" name="' . $value['id'] . '" type="' . $value['type'] . '" class="code">';
		if (isset($this->saved_options[$value['id']])) {
			echo stripslashes($this->saved_options[$value['id']]);
		} else {
			echo stripslashes($value['std']);
		}
		echo '</textarea>';
		if(isset($value['desc'])){
			echo '<p class="description">' . $value['desc'] . '</p>';
		}
		echo '</div>';
		echo '</div>';
	}


	#
	#displays a radio
	#
	function radio($value)
	{			
		if(isset($value['class']) && $value['class'] == 'no') { $class = 'theme-settings-item theme-settings-item-noborder'; } else { $class = 'theme-settings-item'; }

		if (isset($this->saved_options[$value['id']])) {
			$checked_key = $this->saved_options[$value['id']];
		} else {
			$checked_key = $value['std'];
		}

		echo '<div class="'.$class.'">';
		echo '<h3 class="title"><label for="'.$value['id'].'">' . $value['name'] . '</label></h3>';
		echo '<div class="box">';

		$i = 0;
		foreach($value['options'] as $key => $option) 
		{
			$i++;
			$checked = '';
			if ($key == $checked_key) {
				$checked = ' checked="checked"';
			}
			
			echo '<div class="radio-in-line">';
			echo '<input type="radio" id="' . $value['id'] . '_' . $i . '" name="' . $value['id'] . '" value="' . $key . '" ' . $checked . ' />';
			echo '<label for="' . $value['id'] . '_' . $i . '" class="radio">' . $option . '</label>';
			echo '</div>';
		}

		if(isset($value['desc'])){
			echo '<p class="description">' . $value['desc'] . '</p>';
		}
		echo '</div>';
		echo '</div>';
	}


	#
	# displays a checkbox
	#
	function checkbox($value) 
	{
		if(isset($value['class']) && $value['class'] == 'no') { $class = 'theme-settings-item theme-settings-item-noborder'; } else { $class = 'theme-settings-item'; }

		$checked = '';
		if (isset($this->saved_options[$value['id']])) {
			if ($this->saved_options[$value['id']] == true) {
				$checked = 'checked="checked"';
			}
		} elseif ($value['std'] == true) {
			$checked = 'checked="checked"';
		}

		echo '<div class="'.$class.'">';
		echo '<h3 class="title"><label for="'.$value['id'].'">' . $value['name'] . '</label></h3>';
		echo '<div class="box">';
		
		echo '<input type="checkbox" name="' . $value['id'] . '" id="' . $value['id'] . '" value="true" ' . $checked . ' />';

		if(isset($value['desc']))
		{
			echo '<span class="theme-metabox-checkbox-desc">'.$value['desc'].'</span>';
		}

		echo '</div>';
		echo '</div>';
	}


	#
	#displays a upload
	#
	function upload($value) 
	{
		$size = isset($value['size']) ? $value['size'] : '10';
		$button = isset($value['button']) ? $value['button'] : 'Upload Image';
		if(isset($value['class']) && $value['class'] == 'no') { $class = 'theme-settings-item theme-settings-item-noborder'; } else { $class = 'theme-settings-item'; }

		echo '<div class="'.$class.'">';
		echo '<h3 class="title"><label for="'.$value['id'].'">' . $value['name'] . '</label></h3>';
		echo '<div class="box">';

		echo '<input name="'.$value['id'].'" id="'.$value['id'].'" type="text" size="' . $size . '" value="';
		if (isset($this->saved_options[$value['id']])) {
			echo stripslashes($this->saved_options[$value['id']]);
		} else {
			echo stripslashes($value['std']);
		}
		echo '" />';

		echo '<span class="or">OR</span>';

		echo '<input id="'.$value['id'].'_button" name="'.$value['id']. '_button" type="button" value="'.$button.'" class="button" />';

		if(isset($value['desc'])){
			echo '<p class="description">' . $value['desc'] . '</p>';
		}
		echo '</div>';
		echo '</div>';
	}


	#
	#displays a img select
	#
	function img_select($value)
	{
		if (isset($this->saved_options[$value['id']])) {
			$checked_key = $this->saved_options[$value['id']];
		} else {
			$checked_key = $value['std'];
		}

		if(isset($value['class']) && $value['class'] == 'no') { $class = 'theme-settings-item theme-settings-item-noborder'; } else { $class = 'theme-settings-item'; }

		echo '<div class="'.$class.'">';
		echo '<h3 class="title"><label for="'.$value['id'].'">' . $value['name'] . '</label></h3>';
		echo '<div class="box">';

		$i = 0;
		foreach($value['options'] as $key => $option) 
		{
			$i++;
			$checked = '';
			$selected = '';
			if ($key == $checked_key) {
				$checked = ' checked="checked"';
				$selected = ' TR-radio-img-selected';
			}
			
			echo '<input type="radio" id="TR_radio_img_' . $value['id'] . '_' .$i . '" class="checkbox TR-radio-img-radio" value="'.$key.'" name="'.$value['id'].'" '.$checked.' />';
			echo '<div class="TR-radio-img-label">'. $key .'</div>';
			echo '<img src="'.$option.'" alt="" class="TR-radio-img-img '. $selected .'" onClick="document.getElementById(\'TR_radio_img_' . $value['id'] . '_' .$i .'\').checked = true;" />';
		}

		if(isset($value['desc'])){
			echo '<p class="description">' . $value['desc'] . '</p>';
		}
		echo '</div>';	
		echo '</div>';	
	}


	#
	# displays a color input
	#
	function color($value) 
	{
		$size = isset($value['size']) ? $value['size'] : '5';
		if(isset($value['class']) && $value['class'] == 'no') { $class = 'theme-settings-item theme-settings-item-noborder'; } else { $class = 'theme-settings-item'; }

		if (isset($this->saved_options[$value['id']])) {
			$val = stripslashes($this->saved_options[$value['id']]);
		} else {
			$val = $value['std'];
		}
	

		echo '<div class="'.$class.'">';
		echo '<h3 class="title"><label for="'.$value['id'].'">' . $value['name'] . '</label></h3>';
		echo '<div class="box">';
		echo '<div class="clearfix">';
		echo '<div id="colorSelector_'. $value['id'] .'" class="colorSelector"><div></div></div>';
		echo '<input name="' . $value['id'] . '" id="' . $value['id'] . '" type="text" size="' . $size . '" class="color-text" value="'. $val .'" />';
		
		if(isset($value['desc'])){
			echo '<p class="description">' . $value['desc'] . '</p>';
		}

		echo '</div>';
		echo '</div>';
		echo '</div>';

		echo '<script type="text/javascript">'."\n";
		echo '//<![CDATA['."\n";
		echo 'jQuery(document).ready(function(){'."\n";
		echo 'jQuery("#colorSelector_'. $value['id'] .'").children("div").css("backgroundColor", "#'. $val .'");'."\n";    
		echo '    jQuery("#colorSelector_'. $value['id'] .'").ColorPicker({'."\n";
		echo '       color: "'. $value['id'] .'",'."\n";
		echo '       onShow: function (colpkr) {'."\n";
		echo '			  jQuery(colpkr).fadeIn(500);'."\n";
		echo '			  return false;'."\n";
		echo '		   },'."\n";
		echo '		   onHide: function (colpkr) {'."\n";
		echo '				jQuery(colpkr).fadeOut(500);'."\n";
		echo '				return false;'."\n";
		echo '			},'."\n";
		echo '			onChange: function (hsb, hex, rgb) {'."\n";
		echo '				jQuery("#colorSelector_'. $value['id'] .'").children("div").css("backgroundColor", "#" + hex);'."\n";
		echo '				jQuery("#colorSelector_'. $value['id'] .'").next("input").attr("value", hex);'."\n";
		echo '			}'."\n";
		echo '		});'."\n";
		echo '	});'."\n";
		echo '//]]>'."\n";
		echo '</script>'."\n";
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

		if(isset($value['class']) && $value['class'] == 'no') { $class = 'theme-settings-item theme-settings-item-noborder'; } else { $class = 'theme-settings-item'; }

		echo '<div class="'.$class.'">';
		echo '<h3 class="title"><label for="'.$value['id'].'">' . $value['name'] . '</label></h3>';
		echo '<div class="box">';
		echo '<select name="' . $value['id'] . '" id="' . $value['id'] . '" class="chosen_select">';
		
		if(isset($value['prompt'])){
			echo '<option value="">'.$value['prompt'].'</option>';
		}
		
		foreach($value['options'] as $key => $option) {
			echo "<option value='" . $key . "'";
			if (isset($this->saved_options[$value['id']])) {
				if (stripslashes($this->saved_options[$value['id']]) == $key) {
					echo ' selected="selected"';
				}
			} else if ($key == $value['std']) {
				echo ' selected="selected"';
			}
			
			echo '>' . $option . '</option>';
		}
		
		echo '</select>';

		if(isset($value['desc'])){
			echo '<p class="description">' . $value['desc'] . '</p>';
		}
		echo '</div>';
		echo '</div>';
	}




	#
	#select target
	#
	function get_select_target_options($type) 
	{
		$options = array();
		switch($type)
		{
			case 'page':
				$entries = get_pages('title_li=&orderby=name');
				foreach($entries as $key => $entry) {
					$options[$entry->ID] = $entry->post_title;
				}
			break;
			case 'category':
				$entries = get_categories('orderby=name&hide_empty=0');
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
		}		
		return $options;
	}


}//end class


?>