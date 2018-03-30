<?php
/**
 * The `baseOptionsGenerator` class help generate the html code for meta boxes.
 */
class baseOptionsGenerator {
	/**
	 * displays a text input
	 */
	function text($item) {
		extract($this->option_atts(array(
			"id" => "",
			"default" => "",
			"value" => "",
			"size" => "10",
			"class"=> "",
			"htmlspecialchars" => false,
		), $item));
		$class = $class?' class="'.$class.'"':'';
		if($htmlspecialchars === true){
			$value = htmlspecialchars($value);
		}
		echo '<input'.$class.' name="' . $id . '" id="' . $id . '" type="text" size="' . $size . '" value="' . $value . '" />';
	}
	
	/**
	 * displays a textarea
	 */
	function textarea($item) {
		extract($this->option_atts(array(
			"id" => "",
			"default" => "",
			"value" => "",
			"rows" => "7",
			"class"=> "",
			"htmlspecialchars" => false,
		), $item));
		$class = $class?' class="'.$class.'"':'';
		if($htmlspecialchars === true){
			$value = htmlspecialchars($value);
		}
		echo '<textarea'.$class.' rows="' . $rows . '" name="' . $id . '" id="' . $id . '" type="textarea">' . $value . '</textarea>';
	}
	
	/**
	 * displays a select
	 */
	function select($item) {
		extract($this->option_atts(array(
			"id" => "",
			"default" => "",
			"value" => "",
			"chosen" => false,
			"target" => NULL,
			"options" => array(),
			"prompt" => NULL,
			"page" => NULL,
			"class"=> "",
			"manual" => "",
		), $item));
		if (!is_null($target)) {
			$options += $this->get_select_target_options($target);
		}
		if ($chosen == true){
			if($class){
				$class .= ' themechosen';
			}else{
				$class = 'themechosen';
			}
		}
		$class = $class?' class="'.$class.'"':'';
		echo '<select'.$class.' name="' . $id . '" id="' . $id . '" data-manual="'.$manual.'">';
		if(!is_null($prompt)){
			echo '<option value="">'.$prompt.'</option>';
		}
		
		if(is_array($options)){
			foreach($options as $key => $option) {
				if(is_array($option)){
					echo '<optgroup label="' . $key . '">';
					foreach($option as $k => $o) {
						echo '<option value="' . $k . '"';
						if ((string)$k === $value) {
							echo ' selected="selected"';
						}
						echo '>' . $o . '</option>';
					}
					echo "</optgroup>";
				}else{
					echo '<option value="' . $key . '"';
					if ((string)$key === $value) {
						echo ' selected="selected"';
					}
					echo '>' . $option . '</option>';
				}
			}
		}
		if (!is_null($page)){
			$depth = $page;
			$args = array(
				'depth' => $depth, 'child_of' => 0,
				'selected' => $value, 'echo' => 1,
				'name' => 'page_id', 'id' => '',
				'show_option_none' => '', 'show_option_no_change' => '',
				'option_none_value' => ''
			);
			$pages = get_pages($args);
			
			echo walk_page_dropdown_tree($pages,$depth,$args);
		}
		
		echo '</select>';

		if($manual) {
			echo '<input class="theme-select-manual" name="'.$id.'manual" type="text" value="" />';
		}
	}
	
	/**
	 * displays a multiselect
	 */
	function multiselect($item) {
		extract($this->option_atts(array(
			"id" => "",
			"default" => array(),
			"value" => array(),
			"size" => "5",
			"chosen" => false,
			"chosen_order" => false,
			"class"=> "",
			"page" => NULL,
			"target" => NULL,
			"prompt" => "",
			"options" => array(),
		), $item));
		
		if(empty($value)){
			$value = array();
		}
		if(is_string($value)){
			$value = array($value);
		}
		if ($chosen == true){
			if($class){
				$class .= ' themechosen';
			}else{
				$class = 'themechosen';
			}
		}
		$class = $class?' class="'.$class.'"':'';
		if (!is_null($target)) {
			$options += $this->get_select_target_options($target);
		}
		if (!is_null($page)){
			$depth = $page;
			$pages = get_pages();
		}
		if (!empty($prompt)) {
			$prompt = ' data-placeholder="'.$prompt.'"';
		}
		
		if($chosen_order == true){
			echo '<input type="hidden" name="_'.$id.'" value="'.implode(",",$value).'"/>';
			$order = ' data-order="true"';
		}else{
			$order = '';
		}
		echo '<select'.$class.$prompt.$order.' name="' . $id . '[]" id="' . $id . '" multiple="true" size="' . $size . '" style="width:60%;height:auto" >';
		
		foreach($options as $key => $option) {
			if(is_array($option)){
				echo '<optgroup label="' . $key . '">';
				foreach($option as $k => $o) {
					echo '<option value="' . $k . '"';
					if(is_array($value) && in_array((string)$k, $value)) {
						echo ' selected="selected"';
					}
					echo '>' . $o . '</option>';
				}
				echo "</optgroup>";
			}else{
				echo '<option value="' . $key . '"';
				if(is_array($value) && in_array((string)$key, $value)) {
					echo ' selected="selected"';
				}
				echo '>' . $option . '</option>';
			}
		}
		if (!is_null($page)){
			$args = array(
				'depth' => $page, 'child_of' => 0,
				'selected' => $value, 'echo' => 1,
				'name' => 'page_id', 'id' => '',
				'show_option_none' => '', 'show_option_no_change' => '',
				'option_none_value' => ''
			);
			echo walk_page_multi_select_tree($pages,$depth,$args);
		}
		echo '</select>';
		
	}
	
	/**
	 * displays a drag and drop multiselect
	 */
	function ddmultiselect($item){
		extract($this->option_atts(array(
			"id" => "",
			"default" => array(),
			"value" => array(),
			"class"=> "",
			"options" => array(),
			"enable_text" => __('Enabled','theme_admin'),
			"disable_text" => __('Disabled','theme_admin'),
		), $item));
		if(empty($value) || !is_array($value)){
			$value = array();
		}
		echo '<input type="hidden" id="' . $id . '" name="' . $id . '" value="' . implode(',', $value) . '" />';
		echo '<div class="ddmultiselect-wrap">';
			echo '<div class="ddmultiselect-enabled-holder">';
				echo '<h3>'.$enable_text.'</h3>';
				echo '<ul>';
				foreach($value as $item){
					echo '<li data-value="'.$item.'">'.$options[$item].'</li>';
				}
				echo '</ul>';
			echo '</div>';
			echo '<div class="ddmultiselect-disabled-holder">';
				echo '<h3>'.$disable_text.'</h3>';
				echo '<ul>';
				foreach($options as $key=>$item){
					if(!in_array($key, $value)){
						echo '<li data-value="'.$key.'">'.$item.'</li>';
					}
				}
				echo '</ul>';
			echo '</div>';

		echo '</div>';
	}

	/**
	 * displays a multidropdown
	 */
	function multidropdown($item) {
		extract($this->option_atts(array(
			"id" => "",
			"default" => array(),
			"value" => array(),
			"target" => NULL,
			"prompt" => NULL,
			"page" => NULL,
			"options" => array(),
		), $item));
		
		if (!is_null($target)) {
			$options += $this->get_select_target_options($target);
		}
		
		echo '<input type="hidden" id="' . $id . '" name="' . $id . '" value="' . implode(',', $value) . '" />';
		echo '<div class="multidropdown-wrap">';
		$i = 0;
		if (!is_null($page)){
			$depth = $page;
			$pages = get_pages();
		}
		
		foreach($value as $selected) {
			echo '<select name="' . $id . '_' . $i . '" id="' . $id . '_' . $i . '">';
			if($prompt){
				echo '<option value="">'.$prompt.'</option>';
			}
			
			foreach($options as $key => $option) {
				echo '<option value="' . $key . '"';
				if ($selected === (string)$key) {
					echo ' selected="selected"';
				}
				echo '>' . $option . '</option>';
			}

			if (!is_null($page)){
				$args = array(
					'depth' => $page, 'child_of' => 0,
					'selected' => $selected, 'echo' => 1,
					'name' => 'page_id', 'id' => '',
					'show_option_none' => '', 'show_option_no_change' => '',
					'option_none_value' => ''
				);
				echo walk_page_dropdown_tree($pages,$depth,$args);
			}
			$i++;
			echo '</select>';
		}
		
		echo '<select name="' . $id . '_' . $i . '" id="' . $id . '_' . $i . '">';
		if(!is_null($prompt)){
			echo '<option value="">'.$prompt.'</option>';
		}

		foreach($options as $key => $option) {
			echo '<option value="' . $key . '">' . $option . '</option>';
		}
		if (!is_null($page)){
			$args = array(
				'depth' => $depth, 'child_of' => 0,
				'selected' => 0, 'echo' => 1,
				'name' => 'page_id', 'id' => '',
				'show_option_none' => '', 'show_option_no_change' => '',
				'option_none_value' => ''
			);
			echo walk_page_dropdown_tree($pages,$depth,$args);
		}
		echo '</select></div>';
		
	}
	
	/**
	 * displays a superlink
	 */
	function superlink($item) {
		extract($this->option_atts(array(
			"id" => "",
			"default" => '',
			"value" => '',
			"shows" => array('page','cat','post','portfolio','manually'),
		), $item));
		
		$target = '';
		$target_value = '';
		
		if (!empty($value)) {
			list($target, $target_value) = explode('||', $value);
		}
		
		echo '<input type="hidden" id="' . $id . '" name="' . $id . '" value="' . $value . '" />';
		
		$method_options = array(
			'page' => 'Link to page',
			'cat' => 'Link to category',
			'post' => 'Link to post',
			'portfolio'=> 'Link to portfolio',
			'manually' => 'Link manually'
		);
		
		foreach ($method_options as $key => $v){
			if(!in_array($key,$shows)){
				unset($method_options[$key]);
			}
		}
		
		echo '<select name="' . $id . '_selector" id="' . $id . '_selector">';
		echo '<option value="">Select Linking method</option>';
		foreach($method_options as $key => $option) {
			echo '<option value="' . $key . '"';
			if ($key == $target) {
				echo ' selected="selected"';
			}
			echo '>' . $option . '</option>';
		}
		echo '</select>';
		
		echo '<div class="superlink-wrap">';
		
		if(in_array('page',$shows)){
			//render page selector
			$hidden = ($target != "page") ? 'class="hidden"' : '';
			echo '<select name="' . $id . '_page" id="' . $id . '_page" ' . $hidden . '>';
			echo '<option value="">Select Page</option>';
			
			$selected = ($target == "page")?$target_value:0;
			$args = array(
				'depth' => 0, 'child_of' => 0,
				'selected' => $selected, 'echo' => 1,
				'name' => 'page_id', 'id' => '',
				'show_option_none' => '', 'show_option_no_change' => '',
				'option_none_value' => ''
			);
			$pages = get_pages($args);
			echo walk_page_dropdown_tree($pages,$args['depth'],$args);
			
			/*
			foreach($this->get_select_target_options('page') as $key => $option) {
				echo '<option value="' . $key . '"';
				if ($target == "page" && $key == $target_value) {
					echo ' selected="selected"';
				}
				echo '>' . $option . '</option>';
			}
			*/
			echo '</select>';
		}
		
		if(in_array('portfolio',$shows)){
			//render portfolio selector
			$hidden = ($target != "portfolio") ? 'class="hidden"' : '';
			echo '<select name="' . $id . '_page" id="' . $id . '_portfolio" ' . $hidden . '>';
			echo '<option value="">Select Portfolio</option>';
			foreach($this->get_select_target_options('portfolio') as $key => $option) {
				echo '<option value="' . $key . '"';
				if ($target == "portfolio" && $key == $target_value) {
					echo ' selected="selected"';
				}
				echo '>' . $option . '</option>';
			}
			echo '</select>';
		}

		if(in_array('cat',$shows)){
			//render category selector
			$hidden = ($target != "cat") ? 'class="hidden"' : '';
			echo '<select name="' . $id . '_cat" id="' . $id . '_cat" ' . $hidden . '>';
			echo '<option value="">Select Category</option>';
			foreach($this->get_select_target_options('cat') as $key => $option) {
				echo '<option value="' . $key . '"';
				if ($target == "cat" && $key == $target_value) {
					echo ' selected="selected"';
				}
				echo '>' . $option . '</option>';
			}
			echo '</select>';
		}
		
		if(in_array('post',$shows)){
			//render post selector
			$hidden = ($target != "post") ? 'class="hidden"' : '';
			echo '<select name="' . $id . '_post" id="' . $id . '_post" ' . $hidden . '>';
			echo '<option value="">Select Post</option>';
			foreach($this->get_select_target_options('post') as $key => $option) {
				echo '<option value="' . $key . '"';
				if ($target == "post" && $key == $target_value) {
					echo ' selected="selected"';
				}
				echo '>' . $option . '</option>';
			}
			echo '</select>';
		}
		
		if(in_array('manually',$shows)){
			//render manually
			$hidden = ($target != "manually") ? 'class="hidden"' : '';
			echo '<input name="' . $id . '_manually" id="' . $id . '_manually" type="text" value="';
			if ($target == 'manually') {
				echo $target_value;
			}
			echo '" size="35" ' . $hidden . '/>';
		}
		
		echo '</div>';
		
	}
	
	/**
	 * displays checkboxes
	 */
	function checkboxes($item) {
		extract($this->option_atts(array(
			"id" => "",
			"default" => array(),
			"value" => array(),
			"target" => NULL,
			"options" => array(),
		), $item));
		
		if (!is_null($target)) {
			$options += $this->get_select_target_options($target);
		}
		echo '<div class="checkboxes-wrap">';
		
		foreach($options as $key => $option) {
			echo '<label><input type="checkbox" value="' . $key . '" name="' . $id . '[]"';
			if (is_array($value) && in_array($key, $value)) {
				echo ' checked="checked"';
			}
			echo '>' . $option . '</label><br/>';
		}
		echo '</div>';
	}
	
	/**
	 * displays radios
	 */
	function radios($item) {
		extract($this->option_atts(array(
			"id" => "",
			"default" => array(),
			"value" => array(),
			"target" => NULL,
			"options" => array(),
		), $item));
		
		if (!is_null($target)) {
			$options += $this->get_select_target_options($target);
		}
		$i = 0;
		echo '<div class="radios-wrap" >';
		foreach($options as $key => $option) {
			$i++;
			$checked = '';
			if ($key == $value) {
				$checked = ' checked="checked"';
			}
			
			echo '<input type="radio" id="' . $id . '_' . $i . '" name="' . $id . '" value="' . $key . '" ' . $checked . ' />';
			echo '<label for="' . $id . '_' . $i . '">' . $option . '</label><br />';
		}
		echo '</div>';
	}
	
	/**
	 * displays a upload field
	 */
	function upload($item) {
		if(isset($item["name"])){
			$item['uploader_title'] = sprintf( __( 'Select Image for %s' , 'theme_admin' ), $item["name"] );
		}

		extract($this->option_atts(array(
			"id" => "",
			"default" => "",
			"value" => "",
			"imagewidth"=>'600',
			"button" => __("Insert Image","theme_admin"),
			'removebutton'=>__("Remove Image","theme_admin"),
			"uploader_title" => __("Select Image","theme_admin"),
			"uploader_button_text" => __("Select Image","theme_admin"),
			"postid" => NULL,
			'onlyid' => 'false',
		), $item));

		if(is_null($postid)){
			global $post_ID, $temp_ID;
			$postid = (int) (0 == $post_ID ? $temp_ID : $post_ID);
		}

		if (!empty($value)) {
			if(is_array($value)){
				$source = $value;
				$value = stripslashes(json_encode($source));
			}
			
			if(isset($source['type'])){
				if($source['type'] == 'attachment_id'){
					$src = wp_get_attachment_image_src($source['value'],'full');
					if(! empty($src)){
						$width = $src[1];
						if($width < $imagewidth) {
							$imagewidth = $width;
						}
						$src = $src[0];
					}
				}elseif($source['type'] =='url'){
					$src = $source['value'];
				}
			}
		}

		echo '<div id="' . $id . '_preview" class="theme-option-image-preview" data-imagewidth="'.$imagewidth.'">';
		
		if(isset($src)){
			echo '<a class="thickbox" href="' . $src . '?"><img width="'.$imagewidth.'" src="' . $src . '" /></a>';
		}
		echo '</div>';
		$value = empty($value) ? '' : htmlspecialchars($value);
		echo '<input type="hidden" id="' . $id . '" name="' . $id . '" value="'.$value.'" class="upload-value" data-onlyid="'.$onlyid.'" />';
		echo '<div class="theme-upload-buttons">';
		global $wp_version;
		if(version_compare($wp_version, "3.5", '<')){
			echo '<a class="thickbox theme-button theme-upload-button" id="' . $id . '_button" href="media-upload.php?post_id=' . $postid . '&target=' . $id . '&option_image_upload=1&TB_iframe=1&width=640&height=644">' . $button . '</a>';
		} else {
			echo '<a href="#" class="theme-button theme-add-media-button" data-target="' .  $id  . '" data-uploader_title="'.$uploader_title.'" data-uploader_button_text="'.$uploader_button_text.'" title="' . $button . '">' .$button . '</a>';
		}
		echo '<a class="theme-button theme-upload-button theme-upload-remove" id="' . $id . '_remove">' . $removebutton . '</a>';
		echo '</div>';
	}
	
	/**
	 * displays a range input
	 */
	function range($item) {
		extract($this->option_atts(array(
			"id" => "",
			"default" => "",
			"value" => "",
			"min" => NULL,
			"max" => NULL,
			"step" => NULL,
			"unit" => NULL,
		), $item));
		
		echo '<div class="range-input-wrap" ><input name="' . $id . '" id="' . $id . '" type="text" value="'.$value;
		
		if (!is_null($min)) {
			echo '" min="' . $min;
		}
		if (!is_null($max)) {
			echo '" max="' . $max;
		}
		if (!is_null($step)) {
			echo '" step="' . $step;
		}
		echo '" />';
		if (!is_null($unit)) {
			echo '<span>' . $unit . '</span>';
		}
		echo '<br /></div>';
		
	}
	
	function measurement($item) {
		extract($this->option_atts(array(
			"id" => "",
			"default" => "",
			"value" => "",
			"min" => NULL,
			"max" => NULL,
			"step" => NULL,
			"units" => array('px','%','em','pt'),
			'default_unit' => 'px',
		), $item));
		$value_unit = $default_unit;
		if(is_numeric($value)){
			$value_range = $value;
		}else{
			$value_range=0;
		}
		foreach($units as $unit){
			if(strpos($value, $unit)!==false){
				$value_unit = $unit;
				$value_range = str_replace($unit, '',$value);
			}
		}
		if(empty($value_unit)){
			$value_unit = $default_unit;
		}
		echo '<div class="measurement-wrap" >';
		echo '<input type="hidden" id="' . $id . '" name="' . $id . '" value="' . $value . '" />';
		echo '<span class="range-input-wrap"><input name="' . $id . '_range" id="' . $id . '_range" type="text" value="'.$value_range;
		
		if (!is_null($min)) {
			echo '" min="' . $min;
		}
		if (!is_null($max)) {
			echo '" max="' . $max;
		}
		if (!is_null($step)) {
			echo '" step="' . $step;
		}
		echo '" /></span>';
		echo '<span class="measurement-unit-wrap">';
		if (is_array($units) && count($units)>1) {
			echo '<select name="' . $id . '_unit" id="' . $id . '_unit">';
			foreach($units as $unit) {
				echo '<option value="' . $unit . '"';
				if ($unit == $value_unit) {
					echo ' selected="selected"';
				}
				echo '>' . $unit . '</option>';
			}
			echo '</select>';
		}else{
			echo $units[0];
		}
		echo '</span>';
		echo '<br /></div>';
	}
	
	/**
	 * displays a color input
	 */
	function color($item) {
		extract($this->option_atts(array(
			"id" => "",
			"default" => "",
			"value" => "",
			"size" => "10",
			"class" => "",
			"format" => 'rgba',
		), $item));
		
		$class = $class?' class="'.$class.'"':'';
		if(empty($value)){
			$transparent = true;
		}else{
			$transparent = false;
		}
		
		echo '<div class="color-input-wrap"><input'.$class.' name="' . $id . '" id="' . $id . '" type="text" '.($transparent?'data-transparent="true"':'').'data-color-format="'.$format.'" size="' . $size . '" value="' . $value . '" /></div>';
		
	}
	
	/**
	 * displays a toggle button
	 */
	function toggle($item) {
		extract($this->option_atts(array(
			"id" => "",
			"default" => "",
			"value" => "",
		), $item));
		
		$checked = '';
		if ($value === 'true' || $value === true) {
			$checked = 'checked="checked"';
		}
		
		echo '<input type="checkbox" class="toggle-button" name="' . $id . '" id="' . $id . '" value="true" ' . $checked . ' />';
	}
	
	/**
	 * displays a toggle button
	 */
	function tritoggle($item) {
		extract($this->option_atts(array(
			"id" => "",
			"default" => "",
			"value" => "",
		), $item));
		if($value === ""){
			$value = 'default';
		}elseif($value === true){
			$value = 'true';
		}elseif($value === false){
			$value = 'false';
		}
		echo '<select class="tri-toggle-button" name="' . $id . '" id="' . $id . '" >';
		echo '<option value="true"';
		if($value === 'true'){
			echo 'selected="selected"';
		}
		echo '>On</option>';
		echo '<option value="false"';
		if($value === 'false'){
			echo 'selected="selected"';
		}
		echo '>Off</option>';
		echo '<option value="default"';
		if($value === 'default'){
			echo 'selected="selected"';
		}
		echo '>default</option>';
		echo '</select>';
	}
	
	/**
	 * displays a validator input
	 */
	function validator($item) {
		extract($this->option_atts(array(
			"id" => "",
			"default" => "",
			"value" => "",
			"required" => NULL,
			"min" => NULL,
			"max" => NULL,
			"pattern" => NULL,
			"maxlength" => NULL,
			"minlength" => NULL,
			"error" => NULL,
			"format" => NULL,
		), $item));
		
		echo '<div class="validator-wrap"><input name="' . $id . '" id="' . $id . '" type="'. $format.'" value="';
		echo $value;
		if (!is_null($max)) {
			echo '" max="' . $max;
		}
		if (!is_null($min)) {
			echo '" min="' . $min;
		}
		if (!is_null($pattern)) {
			echo '" pattern="' . $pattern;
		}
		if (!is_null($required)) {
			echo '" required="required"';
		}
		if (!is_null($maxlength)) {
			echo '" maxlength="' . $maxlength;
		}
		if (!is_null($minlength)) {
			echo '" minlength="' . $minlength;
		}
		if (!is_null($error)) {
			echo '" data-message="' . $error;
		}
		echo '" /><span class="validator-error"></span></div>';
	}
	
	/**
	 * displays a editor
	 */
	function editor($item) {
		extract($this->option_atts(array(
			"id" => "",
			"default" => "",
			"value" => "",
			'settings' => array(
				'quicktags' 	=> array( 'buttons' => 'em,strong,link' ),
				//'textarea_name'	=> 'excerpt',
				'quicktags' 	=> true,
				'tinymce' 		=> true,
			)
		), $item));

		wp_editor($item['value'],$item['id'],$settings);
		
	}
	
	function get_select_target_options($type) {
		$options = array();
		switch($type){
			case 'revslider':
				global $wpdb;
				$table_name = $wpdb->prefix . "revslider_sliders";

				$rev_sliders = $wpdb->get_results( "SELECT id,title,alias FROM $table_name" );
				foreach($rev_sliders as $key => $item) {
					$options[$item->id] = $item->title;
				}
				break;
			case 'taxonomy':
				$taxonomies = get_taxonomies();
				foreach ( $taxonomies as $taxonomy ){
					$tax = get_taxonomy($taxonomy);
					$options[$taxonomy] = $tax->labels->name;
				}
				break;
			case 'taxonomy_tag_cloud':
				$taxonomies = get_taxonomies();
				foreach ( $taxonomies as $taxonomy ){
					$tax = get_taxonomy($taxonomy);
					if(!$tax->show_tagcloud){
						continue;
					}
					$options[$taxonomy] = $tax->labels->name;
				}
				break;
			case 'nav_menu':
				$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
				foreach($menus as $key => $menu) {
					$options[$menu->term_id] = $menu->name;
				}
				break;
			case 'page':
				$entries = get_pages('title_li=&orderby=name');
				foreach($entries as $key => $entry) {
					$options[$entry->ID] = $entry->post_title;
				}
				break;
			case 'cat':
				$entries = get_categories('orderby=name&hide_empty=0');
				foreach($entries as $key => $entry) {
					$options[$entry->term_id] = $entry->name;
				}
				break;
			case 'author':
				global $wpdb;
				$order = 'user_id';
				$user_ids = $wpdb->get_col($wpdb->prepare("SELECT $wpdb->usermeta.user_id FROM $wpdb->usermeta where meta_key='{$wpdb->prefix}user_level' and meta_value>=1 ORDER BY %s ASC",$order));
				foreach($user_ids as $user_id) :
					$user = get_userdata($user_id);
					$options[$user_id] = $user->display_name;
				endforeach;
				break;
			case 'post':
				$entries = get_posts('orderby=title&numberposts=-1&order=ASC&suppress_filters=0');
				foreach($entries as $key => $entry) {
					$options[$entry->ID] = $entry->post_title;
				}
				break;
			case 'portfolio':
				$entries = get_posts('post_type=portfolio&orderby=title&numberposts=-1&order=ASC&suppress_filters=0');
				foreach($entries as $key => $entry) {
					$options[$entry->ID] = $entry->post_title;
				}
				break;
			case 'portfolio_category':
				$entries = get_terms('portfolio_category','orderby=name&hide_empty=0&suppress_filters=0');
				foreach($entries as $key => $entry) {
					$options[$entry->slug] = $entry->name;
				}
				break;
			case 'slideshow_category':
				$entries = get_terms('slideshow_category','orderby=name&hide_empty=0&suppress_filters=0');
				foreach($entries as $key => $entry) {
					$options[$entry->slug] = $entry->name;
				}
				break;
			case 'product_cat':
				$entries = get_terms('product_cat','orderby=name&hide_empty=0&suppress_filters=0');
				foreach($entries as $key => $entry) {
					$options[$entry->slug] = $entry->name;
				}
				break;
			case 'post_types':
				foreach( get_post_types( array('show_ui' => true), 'objects' ) as $post_type ) {

					$options[$post_type->name] = esc_html($post_type->labels->name).' ('.esc_html($post_type->name).')';
				}
				break;

			case 'public_post_types':
				foreach( get_post_types( array('public'=>true), 'objects' ) as $post_type ) {
					$options[$post_type->name] = esc_html($post_type->labels->name).' ('.esc_html($post_type->name).')';
				}
				break;
			case 'public_custom_post_types':
				foreach( get_post_types( array('public'=>true,'_builtin' => false), 'objects' ) as $post_type ) {
					$options[$post_type->name] = esc_html($post_type->labels->name).' ('.esc_html($post_type->name).')';
				}
				break;
			case 'thumbnail_post_types':
				foreach( get_post_types( array('public'=>true), 'objects' ) as $post_type ) {
					if(post_type_supports($post_type->name, 'thumbnail')){
						$options[$post_type->name] = esc_html($post_type->labels->name).' ('.esc_html($post_type->name).')';
					}
				}
				break;
			case 'thumbnail_buildin_post_types':
				foreach( get_post_types( array('public'=>true,'_builtin'=>true), 'objects' ) as $post_type ) {
					if(post_type_supports($post_type->name, 'thumbnail')){
						$options[$post_type->name] = esc_html($post_type->labels->name).' ('.esc_html($post_type->name).')';
					}
				}
				unset($options['page']);
				$options['portfolio'] = 'Portfolio (portfolio)';
				break;
			case 'thumbnail_custom_post_types':
				foreach( get_post_types( array('public'=>true,'_builtin'=>false), 'objects' ) as $post_type ) {
					if(post_type_supports($post_type->name, 'thumbnail')){
						$options[$post_type->name] = esc_html($post_type->labels->name).' ('.esc_html($post_type->name).')';
					}
				}
				unset($options['portfolio']);
				break;
			case 'link_category':
				$entries = get_terms( 'link_category','orderby=name&hide_empty=0&suppress_filters=0');
				foreach($entries as $key => $entry) {
					$options[$entry->term_id] = $entry->name;
				}
				break;
			case 'slideshow_source':
				$options['SlideShow Category']['s'] = '(s) All';
				$entries = get_terms('slideshow_category','orderby=name&hide_empty=0&suppress_filters=0');
				foreach($entries as $key => $entry) {
					$options['SlideShow Category']['s|'.$entry->slug] = '(s) '.$entry->name;
				}
				
				$options['Blog Posts Category']['b'] = '(b) All';
				$entries = get_categories('orderby=name&hide_empty=0');
				foreach($entries as $key => $entry) {
					$options['Blog Posts Category']['b|'.$entry->slug] = '(b) '.$entry->name;
				}

				$options['Portfolio Category']['p'] = '(p) All';
				$entries = get_terms('portfolio_category','orderby=name&hide_empty=0&suppress_filters=0');
				foreach($entries as $key => $entry) {
					$options['Portfolio Category']['p|'.$entry->slug] = '(p) '.$entry->name;
				}
				break;
			case 'slideshow_type':
				$slideTypes = Theme_Options_Page_Slideshow::$slideTypes;
				foreach ($slideTypes as $key => $label) {
					$options[$label][$key.'_default'] = $label.':'.'Default';
				}
				$template = theme_get_option_from_db('slideshow','template');
				if($template){
					$templates = explode(',',$template);
				}else{
					$templates = array();
				}
				if(!empty($templates)){
					foreach ($templates as $template) {
						list($stype,$name) = explode('_',$template);
						
						if( array_key_exists($stype,$slideTypes) && $template != 'default'){
							$options[$slideTypes[$stype]][$template] = $slideTypes[$stype].':'.ucwords($name);
						}	
					}
				}

				if(class_exists('RevSliderAdmin')){
					$options['revslider'] = __('Revolution Slider Plugin', 'theme_admin');
				}
				
				break;
		}
		return $options;
	}
	
	function option_atts($pairs, $atts){
		$atts = (array)$atts;
		$out = array();
		foreach($pairs as $name => $default) {
			if ( array_key_exists($name, $atts) )
				$out[$name] = $atts[$name];
			else
				$out[$name] = $default;
		}
		return $out;
	}
}

/**
 * Retrieve HTML dropdown (select) content for page list.
 *
 * @uses Walker_PageMultiSelect to create HTML dropdown content.
 * @since 2.1.0
 * @see Walker_PageMultiSelect::walk() for parameters and return description.
 */
function walk_page_multi_select_tree() {
	$args = func_get_args();
	if ( empty($args[2]['walker']) ) // the user's options are the third parameter
		$walker = new Walker_PageMultiSelect;
	else
		$walker = $args[2]['walker'];

	return call_user_func_array(array(&$walker, 'walk'), $args);
}

/**
 * Create HTML MultiSelect list of pages.
 *
 * @package WordPress
 * @since 2.1.0
 * @uses Walker
 */
class Walker_PageMultiSelect extends Walker {
	/**
	 * @see Walker::$tree_type
	 * @since 2.1.0
	 * @var string
	 */
	var $tree_type = 'page';

	/**
	 * @see Walker::$db_fields
	 * @since 2.1.0
	 * @todo Decouple this
	 * @var array
	 */
	var $db_fields = array ('parent' => 'post_parent', 'id' => 'ID');

	/**
	 * @see Walker::start_el()
	 * @since 2.1.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $page Page data object.
	 * @param int $depth Depth of page in reference to parent pages. Used for padding.
	 * @param array $args Uses 'selected' argument for selected page to set selected HTML attribute for option element.
	 */
	function start_el(&$output, $page, $depth = 0, $args = array(), $current_object_id = 0) {
		$pad = str_repeat('&nbsp;', $depth * 3);
		
		$output .= "\t<option class=\"level-$depth\" value=\"$page->ID\"";
		if(is_array($args['selected'])){
			if ( in_array($page->ID, $args['selected']) ){
				$output .= ' selected="selected"';
			}
		}else{
			if ( $page->ID == $args['selected'] ){
				$output .= ' selected="selected"';
			}
		}
		$output .= '>';
		$title = apply_filters( 'list_pages', $page->post_title );
		$output .= $pad . esc_html( $title );
		$output .= "</option>\n";
	}
}
