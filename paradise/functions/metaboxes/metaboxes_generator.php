<?php
/**
 * The `metaboxesGenerator` class help generate the html code for meta boxes.
 */
class metaboxesGenerator {
	var $config;
	var $options;
	var $saved_options;

	/**
	 * Constructor
	 *
	 * @param string $name
	 * @param array $options
	 */
	function metaboxesGenerator($config, $options) {
		$this->config = $config;
		$this->options = $options;

		add_action('admin_menu', array(&$this, 'create'));
		add_action('save_post', array(&$this, 'save'));
	}

	function create() {
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

	function save($post_id) {
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

				if (get_post_meta($post_id, $option['id']) == '') {
					add_post_meta($post_id, $option['id'], $value, true);
				} elseif ($value != get_post_meta($post_id, $option['id'], true)) {
					update_post_meta($post_id, $option['id'], $value);
				} elseif ($value == '') {
					delete_post_meta($post_id, $option['id'], get_post_meta($post_id, $option['id'], true));
				}
			}
		}
	}

	function render() {
		global $post;

		foreach($this->options as $option) {
			if (method_exists($this, $option['type'])) {
				if (isset($option['id'])) {
					$default = get_post_meta($post->ID, $option['id'], true);
					if ($default != '') {
						$option['default'] = $default;
					}
				}
				echo '<div class="meta-box-item">';
				$this->$option['type']($option);
				echo '</div>';
			}
		}

		echo '<input type="hidden" name="' . $this->config['id'] . '_noncename" id="' . $this->config['id'] . '_noncename" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '" />';
	}

	/**
	 * displays a text input
	 */
	function text($value) {
		$size = isset($value['size']) ? $value['size'] : '10';
		echo '<div class="meta-box-item-title"><h4>' . $value['name'] . '</h4>';
		if (isset($value['desc'])) {
			echo '<a class="switch" href="">[+] more info</a></div><p class="description">' . $value['desc'] . '</p>';
		} else {
			echo '</div>';
		}
		echo '<div class="meta-box-item-content">';
		echo '<input'.(isset($value['class'])?' class="'.$value['class'].'"':'').' name="' . $value['id'] . '" id="' . $value['id'] . '" type="text" size="' . $size . '" value="' . $value['default'] . '" />';
		echo '<br /></div>';
	}

	/**
	 * displays a textarea
	 */
	function textarea($value) {
		$rows = isset($value['rows']) ? $value['rows'] : '7';

		echo '<div class="meta-box-item-title"><h4>' . $value['name'] . '</h4>';
		if (isset($value['desc'])) {
			echo '<a class="switch" href="">[+] more info</a></div><p class="description">' . $value['desc'] . '</p>';
		} else {
			echo '</div>';
		}
		echo '<div class="meta-box-item-content"><textarea rows="' . $rows . '" name="' . $value['id'] . '" type="' . $value['type'] . '" class="code">' . $value['default'] . '</textarea>';
		echo '<br /></div>';

	}

	/**
	 * displays a select
	 */
	function select($value) {
		if (isset($value['target'])) {
			if (isset($value['options'])) {
				$value['options'] = $value['options'] + $this->get_select_target_options($value['target']);
			} else {
				$value['options'] = $this->get_select_target_options($value['target']);
			}
		}
		echo '<div class="meta-box-item-title"><h4>' . $value['name'] . '</h4>';
		if (isset($value['desc'])) {
			echo '<a class="switch" href="">[+] more info</a></div><p class="description">' . $value['desc'] . '</p>';
		} else {
			echo '</div>';
		}
		echo '<div class="meta-box-item-content"><select name="' . $value['id'] . '" id="' . $value['id'] . '">';
		if(isset($value['empty'])){
			echo '<option value="">'.$value['empty'].'</option>';
		}
		if (isset($value['options_callback'])) {
			$value['options'] = call_user_func($value['options_callback']);
		}
		foreach($value['options'] as $key => $option) {
			echo "<option value=\"{$key}\"" . selected($key, $value['default'], false) . ">{$option}</option>";
		}

		echo '</select><br /></div>';

	}

	/**
	 * displays a multiselect
	 */
	function multiselect($value) {
		$size = isset($value['size']) ? $value['size'] : '5';
		if (isset($value['target'])) {
			if (isset($value['options'])) {
				$value['options'] = $value['options'] + $this->get_select_target_options($value['target']);
			} else {
				$value['options'] = $this->get_select_target_options($value['target']);
			}
		}
		echo '<div class="meta-box-item-title"><h4>' . $value['name'] . '</h4>';
		if (isset($value['desc'])) {
			echo '<a class="switch" href="">[+] more info</a></div><p class="description">' . $value['desc'] . '</p>';
		} else {
			echo '</div>';
		}
		echo '<div class="meta-box-item-content"><select name="' . $value['id'] . '[]" id="' . $value['id'] . '" multiple="multiple" size="' . $size . '" style="height:auto">';

		foreach($value['options'] as $key => $option) {
			echo '<option value="' . $key . '"';
			if (in_array($key, $value['default'])) {
				echo ' selected="selected"';
			}
			echo '>' . $option . '</option>';
		}

		echo '</select><br /></div>';

	}

	function superlink($value) {
		$target = '';
		if (! empty($value['default'])) {
			list($target, $target_value) = explode('||', $value['default']);
		}
		if ( empty($value['shows'])) {
			$value['shows'] = array('page','cat','post','portfolio','manually');
		}
		echo '<div class="meta-box-item-title"><h4>' . $value['name'] . '</h4>';
		if (isset($value['desc'])) {
			echo '<a class="switch" href="">[+] more info</a></div><p class="description">' . $value['desc'] . '</p>';
		} else {
			echo '</div>';
		}

		echo '<div class="meta-box-item-content">';
		echo '<input type="hidden" id="' . $value['id'] . '" name="' . $value['id'] . '" value="' . $value['default'] . '"/>';

		$method_options = array(
			'page' => 'Link to page',
			'cat' => 'Link to category',
			'post' => 'Link to post',
			'portfolio'=> 'Link to portfolio',
			'manually' => 'Link manually'
		);

		foreach ($method_options as $key => $v){
			if(!in_array($key,$value['shows'])){
				unset($method_options[$key]);
			}
		}

		echo '<select name="' . $value['id'] . '_selector" id="' . $value['id'] . '_selector">';
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

		if(in_array('page',$value['shows'])){
			//render page selector
			$hidden = ($target != "page") ? 'class="hidden"' : '';
			echo '<select name="' . $value['id'] . '_page" id="' . $value['id'] . '_page" ' . $hidden . '>';
			echo '<option value="">Select Page</option>';
			foreach($this->get_select_target_options('page') as $key => $option) {
				echo '<option value="' . $key . '"';
				if ($target == "page" && $key == $target_value) {
					echo ' selected="selected"';
				}
				echo '>' . $option . '</option>';
			}
			echo '</select>';
		}

		if(in_array('portfolio',$value['shows'])){
			//render portfolio selector
			$hidden = ($target != "portfolio") ? 'class="hidden"' : '';
			echo '<select name="' . $value['id'] . '_page" id="' . $value['id'] . '_portfolio" ' . $hidden . '>';
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

		if(in_array('cat',$value['shows'])){
			//render category selector
			$hidden = ($target != "cat") ? 'class="hidden"' : '';
			echo '<select name="' . $value['id'] . '_cat" id="' . $value['id'] . '_cat" ' . $hidden . '>';
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

		if(in_array('post',$value['shows'])){
			//render post selector
			$hidden = ($target != "post") ? 'class="hidden"' : '';
			echo '<select name="' . $value['id'] . '_post" id="' . $value['id'] . '_post" ' . $hidden . '>';
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

		if(in_array('manually',$value['shows'])){
			//render manually
			$hidden = ($target != "manually") ? 'class="hidden large-text"' : 'class="large-text"';
			echo '<input name="' . $value['id'] . '_manually" id="' . $value['id'] . '_manually" type="text" value="';
			if ($target == 'manually') {
				echo $target_value;
			}
			echo '" ' . $hidden . '/>';
		}

		echo '</div>';
		echo '</div>';
	}

	/**
	 * displays a checkbox
	 */
	function checkbox($value) {
		echo '<div class="meta-box-item-title"><h4>' . $value['name'] . '</h4>';
		if (isset($value['desc'])) {
			echo '<a class="switch" href="">[+] more info</a></div><p class="description">' . $value['desc'] . '</p>';
		} else {
			echo '</div>';
		}

		echo '<div class="meta-box-item-content">';
		$i = 0;
		foreach($value['options'] as $key => $option) {
			$i++;
			$checked = '';
			if (is_array($value['default']) && in_array($key, $value['default'])) {
				$checked = ' checked="checked"';
			}
			echo '<input type="checkbox" name="' . $value['id'] . '[]" id="' . $value['id'] . '_' . $i . '" value="' . $key . '" ' . $checked . ' />';
			echo '<label for="' . $value['id'] . '_' . $i . '">' . $option . '</label><br />';
		}
		echo '</div>';

	}

	/**
	 * displays a radio
	 */
	function radio($value) {

		echo '<div class="meta-box-item-title"><h4>' . $value['name'] . '</h4>';
		if (isset($value['desc'])) {
			echo '<a class="switch" href="">[+] more info</a></div><p class="description">' . $value['desc'] . '</p>';
		} else {
			echo '</div>';
		}
		echo '<div class="meta-box-item-content">';
		$i = 0;
		foreach($value['options'] as $key => $option) {
			$i++;
			$checked = '';
			if ($key == $value['default']) {
				$checked = ' checked="checked"';
			}

			echo '<input type="radio" id="' . $value['id'] . '_' . $i . '" name="' . $value['id'] . '" value="' . $key . '" ' . $checked . ' />';
			echo '<label for="' . $value['id'] . '_' . $i . '">' . $option . '</label><br />';
		}
		echo '</div>';

	}

	function get_select_target_options($type) {
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
			case 'portfolio':
				$entries = get_posts('post_type=portfolio&orderby=title&numberposts=-1&order=ASC');
				foreach($entries as $key => $entry) {
					$options[$entry->ID] = $entry->post_title;
				}
				break;
			case 'projects':
				$entries = get_terms('projects','orderby=name&hide_empty=0');
				foreach($entries as $key => $entry) {
					$options[$entry->slug] = $entry->name;
				}
				break;
			case 'clients':
				$entries = get_terms('clients','orderby=name&hide_empty=0');
				foreach($entries as $key => $entry) {
					$options[$entry->slug] = $entry->name;
				}
				break;
			case 'gallery':
				$entries = get_terms('gallery','orderby=name&hide_empty=0');
				foreach($entries as $key => $entry) {
					$options[$entry->slug] = $entry->name;
				}
				break;
		}

		return $options;
	}

	function the_superlink($field = '_link_to') {
		$link_to = get_post_meta(get_the_ID(), $field, true);
		$link = '';
		if(!empty($link_to)){
			$link_array = explode('||',$link_to);
			switch($link_array[0]){
				case 'page':
					$link = get_page_link($link_array[1]);
					break;
				case 'cat':
					$link = get_category_link($link_array[1]);
					break;
				case 'portfolio':
				case 'post':
					$link = get_permalink($link_array[1]);
					break;
				case 'manually':
					$link = $link_array[1];
					break;
			}
		}
		return $link;
	}
}
