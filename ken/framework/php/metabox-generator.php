<?php
/**
 * Class to generate metaboxe options.
 *
 * @author  Bob Ulusoy
 * @copyright Copyright (c) Bob Ulusoy
 * @link  http://artbees.net
 * @since  Version 2.0
 * @package  MK Framework
 */

class mk_metaboxesGenerator {
	var $config;
	var $options;
	var $saved_options;

	/**
	 * Constructor
	 *
	 * @param string  $name
	 * @param array   $options
	 */
	function __construct($config, $options) {
		$this->config = $config;
		$this->options = $options;

		add_action('admin_menu', array(&$this, 'create'));
		add_action('save_post', array(&$this, 'save'));

	}

	function create() {
		if (function_exists('add_meta_box')) {
			if (!empty($this->config['callback']) && function_exists($this->config['callback'])) {
				$callback = $this->config['callback'];
			} else {
				$callback = array(&$this, 'render');
			}
			foreach ($this->config['pages'] as $page) {
				add_meta_box($this->config['id'], $this->config['title'], $callback, $page, $this->config['context'], $this->config['priority']);
			}
		}
	}

	function save($post_id) {
		if (!isset($_POST[$this->config['id'] . '_noncename'])) {
			return $post_id;
		}

		if (!wp_verify_nonce($_POST[$this->config['id'] . '_noncename'], plugin_basename(__FILE__))) {
			return $post_id;
		}

		if ('page' == $_POST['post_type']) {
			if (!current_user_can('edit_page', $post_id)) {
				return $post_id;
			}
		} else {
			if (!current_user_can('edit_post', $post_id)) {
				return $post_id;
			}
		}

		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post_id;
		}
		add_post_meta($post_id, 'textfalse', false, true);

		foreach ($this->options as $option) {
			if (isset($option['id']) && !empty($option['id'])) {

				if (isset($_POST[$option['id']])) {
					if ($option['type'] == 'multidropdown') {
						$value = array_unique(explode(',', $_POST[$option['id']]));
					} else {
						$value = $_POST[$option['id']];
					}
				} else if ($option['type'] == 'toggle') {
					$value = -1;
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


		// Deletes the cached css and JS files as well as theme options.
        mk_purge_cache_actions();
	}

	function render() {
		wp_enqueue_style('redux-css', THEME_ADMIN_ASSETS_URI . '/css/metabox.css', false, false, 'all');
		global $post;
		echo '<div class="mk-metabox-holder"><table class="form-table"><tbody>';
		foreach ($this->options as $option) {
			if (method_exists($this, $option['type'])) {
				if (isset($option['id'])) {
					$default = get_post_meta($post->ID, $option['id'], true);
					if ($default != "") {
						$option['default'] = $default;
					}
				}
				$this->{$option['type']}($option);
			}
		}
		echo '</tbody></table></div>';
		echo '<input type="hidden" name="' . $this->config['id'] . '_noncename" id="' . $this->config['id'] . '_noncename" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '" />';
	}

	/*
	 **
	 **
	 ** Type : General Wrapper
	-------------------------------------------------------------*/

	function general_wrapper_start($value) {
		echo '<div id="' . $value['id'] . '">';
	}

	function general_wrapper_end() {
		echo '</div>';
	}

	/*
	 **
	 **
	 ** Type : Text Box
	-------------------------------------------------------------*/

	function text($value) {
		$size = isset($value['size']) ? $value['size'] : '50';
		$layout = isset($value['layout']) ? 'one-half' : '';

		echo '<tr id="' . $value['id'] . '_wrapper" class="' . $layout . '">';

		echo '<th>';
		echo '<label for="' . $value['id'] . '">' . $value['name'] . '</label>';

		if (isset($value['subtitle'])) {
			echo '<span class="description">' . $value['subtitle'] . '</span>';
		}
		echo '</th>';

		echo '<td>';

		echo '<input name="' . $value['id'] . '" id="' . $value['id'] . '" type="text" class="text-input" size="' . $size . '" value="' . (isset($value['default']) ? $value['default'] : '') . '" />';
		echo '<span class="description">' . $value['desc'] . '</span>';
		echo '<td>';

		echo '</tr>';
	}

	/*
	 **
	 **
	 ** Type : Upload Image
	-------------------------------------------------------------*/
	function upload($value) {
		$preview = isset($value['preview']) ? $value['preview'] : '';

		echo '<tr id="' . $value['id'] . '_wrapper">';

		echo '<th>';
		echo '<label for="' . $value['id'] . '">' . $value['name'] . '</label>';

		if (isset($value['subtitle'])) {
			echo '<span class="description">' . $value['subtitle'] . '</span>';
		}
		echo '</th>';

		echo '<td><div class="upload-option">';

		echo '<input class="mk-upload-url text-input" type="text" id="' . $value['id'] . '" name="' . $value['id'] . '" size="25"  value="' . $value['default'] . '" /><a class="option-upload-button button-primary button thickbox" id="' . $value['id'] . '_button" href="#">' . __('Upload', 'mk_framework') . '</a>';

		if ($preview != false) {
			echo '<span id="' . $value['id'] . '-preview" class="show-upload-image"><img src="' . $value['default'] . '" title="" /></span>';
		}
		echo '</div>';
		echo '<span class="description">' . $value['desc'] . '</span>';
		echo '<td>';

		echo '</tr>';

	}

	/*
	 **
	 **
	 ** Type : Toggle Button
	-------------------------------------------------------------*/
	function toggle($value) {

		echo '<tr id="' . $value['id'] . '_wrapper">';

		echo '<th>';
		echo '<label for="' . $value['id'] . '">' . $value['name'] . '</label>';

		if (isset($value['subtitle'])) {
			echo '<span class="description">' . $value['subtitle'] . '</span>';
		}
		echo '</th>';

		echo '<td>';

		echo '<span class="mk-toggle-button meta-toggle-button"><span class="toggle-handle"></span><input type="hidden" value="' . $value['default'] . '" name="' . $value['id'] . '" id="' . $value['id'] . '"/></span>';

		if (isset($value['desc'])) {
			echo '<span class="description">' . $value['desc'] . '</span>';
		}
		echo '<td>';

		echo '</tr>';
	}

	/*
	 **
	 **
	 ** Type : Page Layout
	-------------------------------------------------------------*/
	function visual_selector($value) {

		echo '<tr id="' . $value['id'] . '_wrapper">';

		echo '<th>';
		echo '<label for="' . $value['id'] . '">' . $value['name'] . '</label>';

		if (isset($value['subtitle'])) {
			echo '<span class="description">' . $value['subtitle'] . '</span>';
		}
		echo '</th>';

		echo '<td>';
		echo '<div id="' . $value['id'] . '_container" class="mk-visual-selector">';
		foreach ($value['options'] as $key => $option) {
			echo '<a href="#" rel="' . $key . '"><img  src="' . THEME_ADMIN_ASSETS_URI . '/img/' . $option . '.png" /></a>';
		}
		echo '<input type="hidden" value="' . $value['default'] . '" name="' . $value['id'] . '" id="' . $value['id'] . '"/>';
		echo '</div>';
		if (isset($value['desc'])) {
			echo '<span class="description">' . $value['desc'] . '</span>';
		}
		echo '<td>';

		echo '</tr>';
	}

	/*
	 **
	 **
	 ** Type : Color Picker
	-------------------------------------------------------------*/

	function color($value) {

		echo '<tr id="' . $value['id'] . '_wrapper">';

		echo '<th>';
		echo '<label for="' . $value['id'] . '">' . $value['name'] . '</label>';
		if (isset($value['subtitle'])) {
			echo '<span class="description">' . $value['subtitle'] . '</span>';
		}
		echo '</th>';

		echo '<td>';

		echo '<div class="color-picker-holder"><input name="' . $value['id'] . '" id="' . $value['id'] . '" type="text" class="color-picker" data-default-color="' . $value['default'] . '" value="' . $value['default'] . '" /></div>';

		if (isset($value['desc'])) {
			echo '<span class="description">' . $value['desc'] . '</span>';
		}

		echo '<td>';

		echo '</tr>';
	}

	/*
	 **
	 **
	 ** Type : Range Input
	-------------------------------------------------------------*/
	function range($value) {
		echo '<tr id="' . $value['id'] . '_wrapper">';
		echo '<th>';
		echo '<label for="' . $value['id'] . '">' . $value['name'] . '</label>';
		if (isset($value['subtitle'])) {
			echo '<span class="description">' . $value['subtitle'] . '</span>';
		}
		echo '</th>';

		echo '<td>';

		echo '<div class="mk-ui-input-slider">';
		echo '<div class="mk-range-input"';
		echo '" data-value="' . $value['default'] . '"';

		if (isset($value['min'])) {
			echo '" data-min="' . $value['min'];
		}
		if (isset($value['max'])) {
			echo '" data-max="' . $value['max'];
		}
		if (isset($value['step'])) {
			echo '" data-step="' . $value['step'] . '"';
		}
		echo '></div>';
		echo '<input class="range-input-selector" name="' . $value['id'] . '" id="' . $value['id'] . '" type="text" value="';
		echo $value['default'];
		echo '" />';

		if (isset($value['unit'])) {
			echo '<span class="unit">' . $value['unit'] . '</span>';
		}

		echo '</div>';

		if (isset($value['desc'])) {
			echo '<span class="description">' . $value['desc'] . '</span>';
		}

		echo '<td>';

		echo '</tr>';

	}

	/*
	 **
	 **
	 ** Type : Textarea
	-------------------------------------------------------------*/
	function textarea($value) {
		echo '<tr id="' . $value['id'] . '_wrapper">';
		echo '<th>';
		echo '<label for="' . $value['id'] . '">' . $value['name'] . '</label>';
		if (isset($value['subtitle'])) {
			echo '<span class="description">' . $value['subtitle'] . '</span>';
		}
		echo '</th>';

		echo '<td>';

		echo '<textarea id="' . $value['id'] . '" name="' . $value['id'] . '" rows="6" cols="60">' . $value['default'] . '</textarea>';

		if (isset($value['desc'])) {
			echo '<span class="description">' . $value['desc'] . '</span>';
		}

		echo '<td>';

		echo '</tr>';
	}

	/*
	 **
	 **
	 ** Type : Multi Select
	-------------------------------------------------------------*/
	function multiselect($value) {
		if (isset($value['target'])) {
			if (isset($value['options'])) {
				$value['options'] = $value['options']+$this->get_select_target_options($value['target']);
			} else {
				$value['options'] = $this->get_select_target_options($value['target']);
			}
		}
		$width = isset($value['width']) ? $value['width'] : '500';
		echo '<tr id="' . $value['id'] . '_wrapper">';
		echo '<th>';
		echo '<label for="' . $value['id'] . '">' . $value['name'] . '</label>';
		if (isset($value['subtitle'])) {
			echo '<span class="description">' . $value['subtitle'] . '</span>';
		}
		echo '</th>';

		echo '<td>';

		echo '<select class="mk-chosen" name="' . $value['id'] . '[]" id="' . $value['id'] . '" multiple="multiple" style="width:' . $width . 'px;">';

		if (!empty($value['options']) && is_array($value['options'])) {
			foreach ($value['options'] as $key => $option) {
				echo '<option value="' . $key . '"';
				if (in_array($key, $value['default'])) {
					echo ' selected="selected"';
				}
				echo '>' . $option . '</option>';
			}
		}
		echo '</select>';

		if (isset($value['desc'])) {
			echo '<span class="description">' . $value['desc'] . '</span>';
		}

		echo '<td>';

		echo '</tr>';
	}

	/*
	 **
	 **
	 ** Type : chosen Select
	-------------------------------------------------------------*/
	function select($value) {
		if (isset($value['target'])) {
			if (isset($value['options'])) {
				$value['options'] = $value['options']+$this->get_select_target_options($value['target']);
			} else {
				$value['options'] = $this->get_select_target_options($value['target']);
			}
		}

		if (isset($this->saved_options[$value['id']])) {
			$default = $this->saved_options[$value['id']];
		} else {
			$default = $value['default'];
		}
		$width = isset($value['width']) ? $value['width'] : '500';
		$placeholder = isset($value['placeholder']) ? $value['placeholder'] : 'true';
		$layout = isset($value['layout']) ? 'one-half' : '';
		echo '<tr id="' . $value['id'] . '_wrapper" class="' . $layout . '">';
		echo '<th>';
		echo '<label for="' . $value['id'] . '">' . $value['name'] . '</label>';
		if (isset($value['subtitle'])) {
			echo '<span class="description">' . $value['subtitle'] . '</span>';
		}
		echo '</th>';

		echo '<td>';

		echo '<select class="mk-select" name="' . $value['id'] . '" id="' . $value['id'] . '" style="min-width:' . $width . 'px;">';
		if ($placeholder != 'false') {
			echo '<option value="">' . __('Select Option', 'mk_framework') . '</option>';
		}
		if (!empty($value['options']) && is_array($value['options'])) {
			foreach ($value['options'] as $key => $option) {
				echo '<option value="' . $key . '"';
				if (isset($this->saved_options[$value['id']])) {
					if (stripslashes($this->saved_options[$value['id']]) == $key) {
						echo ' selected="selected"';
					}
				} else if ($key == $default) {
					echo ' selected="selected"';
				}
				echo '>' . $option . '</option>';
			}
		}
		echo '</select>';

		if (isset($value['desc'])) {
			echo '<span class="description">' . $value['desc'] . '</span>';
		}

		echo '<td>';

		echo '</tr>';
	}

	/*
	 **
	 **
	 ** Type : Wrodpress Built-in Editor
	-------------------------------------------------------------*/
	function editor($value) {
		if (isset($this->saved_options[$value['id']])) {
			$value['default'] = stripslashes($this->saved_options[$value['id']]);
		}
		echo '<tr id="' . $value['id'] . '_wrapper">';
		echo '<th>';
		echo '<label for="' . $value['id'] . '">' . $value['name'] . '</label>';
		if (isset($value['subtitle'])) {
			echo '<span class="description">' . $value['subtitle'] . '</span>';
		}
		echo '</th>';

		echo '<td>';

		wp_editor($value['default'], $value['id']);

		if (isset($value['desc'])) {
			echo '<span class="description">' . $value['desc'] . '</span>';
		}

		echo '<td>';

		echo '</tr>';

	}

/*
 **
 **
 ** Type : General Background Selector
-------------------------------------------------------------*/
	function general_background_selector($value) {

		echo '<tr class="mk-single-option">';
		echo '<th>';
		echo '<label>' . $value['name'] . '</label>';

		if (isset($value['subtitle'])) {
			echo '<span class="description">' . $value['subtitle'] . '</span>';
		}
		echo '</th>';

		echo '<td>';
		?>
<div class="mk-general-bg-selector">
<div class="outer-wrapper">
  <div rel="body" class="body-section"><span class="hover-state-body"><span class="section-indicator">
<?php _e('Body', 'mk_framework')?>
</span></span><div class="mk-bg-preview-layer"></div><div class="mk-transparent-bg-indicator"></div></div>
  <div class="main-sections-wrapper">
    <div rel="header" class="header-section"><span class="hover-state"><span class="section-indicator">
<?php _e('Header', 'mk_framework')?>
</span></span><div class="mk-bg-preview-layer"></div><div class="mk-transparent-bg-indicator"></div></div>
      <div rel="banner" class="banner-section"><span class="hover-state"><span class="section-indicator">
<?php _e('Page Title', 'mk_framework')?>
</span></span><div class="mk-bg-preview-layer"></div><div class="mk-transparent-bg-indicator"></div></div>
    <div rel="page" class="page-section"><span class="hover-state"><span class="section-indicator">
<?php _e('Page', 'mk_framework')?>
</span></span><div class="mk-bg-preview-layer"></div><div class="mk-transparent-bg-indicator"></div></div>
    <div rel="footer" class="footer-section"><span class="hover-state"><span class="section-indicator">
<?php _e('Footer', 'mk_framework')?>
</span></span><div class="mk-bg-preview-layer"></div><div class="mk-transparent-bg-indicator"></div></div>
  </div>
</div>
<div id="mk-bg-edit-panel" class="mk-bg-edit-panel">
  <div class="mk-bg-panel-heading"> <a class="mk-bg-edit-panel-heading-cancel" href="#"><i class="icon-close2"></i></a> <span class="mk-bg-edit-panel-heading-text">Edit color & texture - <span class="mk-edit-panel-heading"></span></span> </div>
  <div style="border-bottom:1px solid #ccc;">
    <div class="mk-bg-edit-right">
      <div class="mk-bg-edit-option"> <span class="mk-bg-edit-label">
<?php _e('Background Image', 'mk_framework')?>
</span>
        <ul class="bg-background-type-tabs">
          <li><a rel="no-image" href="#" class="mk-bg-edit-option-no-image-button button bg-image-buttons">
<?php _e('No Image', 'mk_framework')?>
</a></li>
          <li><a rel="custom" href="#" class="mk-bg-edit-option-upload-button button bg-image-buttons">
<?php _e('Upload Image', 'mk_framework')?>
</a></li>
        </ul>
        <div class="clearboth"></div>

      <div class="bg-background-type-panes">
        <div class="bg-background-type-pane bg-no-image"> </div>
        <div class="bg-background-type-pane bg-edit-panel-upload" style="padding-top:60px;">
          <div class="upload-option">
            <div id="bg_panel_upload-preview" class="custom-image-preview-block show-upload-image"><img src="" title="" /></div>
            <span class="bg-edit-panel-upload-title">
<?php _e('Upload a new custom image', 'mk_framework')?>
</span>


<?php
echo '<div class="mk-upload-bg-wrapper"><input class="mk-upload-url" type="text" id="bg_panel_upload" name="bg_panel_upload" size="40"  value="" /><a class="option-upload-button button thickbox" id="bg_panel_upload_button" href="#">' . __('Upload', 'mk_framework') . '</a></div>';
		?>
</div>
        </div>
      </div>
      <div class="clearboth"></div>
    </div>
</div>
    <div class="mk-bg-edit-left">
      <div class="mk-bg-edit-option mk-bg-edit-bg-color"> <span class="mk-bg-edit-label">
<?php _e('Background color', 'mk_framework')?>
</span>
        <div class="bg-edit-panel-color">
          <div class="color-picker-holder"><input name="bg_panel_color" id="bg_panel_color" size="8" class="color-picker" value="" /></div>
        </div>
        <div class="clearboth"></div>
      </div>
      <div class="mk-bg-edit-option mk-bg-edit-option-repeat"> <span class="mk-bg-edit-label">
<?php _e('Background Repeat', 'mk_framework')?>
</span>
        <div class="bg-repeat-option"><a style="border:none" class="no-repeat" href="#" rel="no-repeat" title="no-repeat"></a><a href="#" rel="repeat" class="repeat" title="repeat"></a><a href="#" rel="repeat-x" class="repeat-x" title="repeat-x"></a><a href="#" rel="repeat-y" class="repeat-y" title="repeat-y"></a></div>
        <div class="clearboth"></div>
      </div>
      <div class="mk-bg-edit-option mk-bg-edit-option-attachment"> <span class="mk-bg-edit-label">
<?php _e('Background Attachment', 'mk_framework')?>
        </span>
        <div class="bg-attachment-option"> <a style="border:none" href="#" rel="fixed" class="fixed" title="fixed"></a><a href="#" rel="scroll" class="scroll" title="scroll"></a></div>
        <div class="clearboth"></div>
      </div>
      <div class="mk-bg-edit-option mk-bg-edit-option-position"> <span class="mk-bg-edit-label"><?php _e('Background Position', 'mk_framework')?></span>
        <div class="bg-position-option">
            <a style="border-left:none" href="#" rel="left top" class="left-top" title="left top"></a><a href="#" rel="center top" class="center-top" title="center top"></a><a href="#" rel="right top" class="right-top" title="right top"></a>
          <div class="clearboth"></div>
          <a style="border-left:none" href="#" rel="left center" class="left-center" title="left center"></a><a href="#" rel="center center" class="center-center" title="center center"></a><a href="#" rel="right center" class="right-center" title="right center"></a>
          <div class="clearboth"></div>
          <a style="border-left:none; border-bottom:none;" href="#" rel="left bottom" class="left-bottom" title="left bottom"></a><a style="border-bottom:none;" href="#" rel="center bottom" class="center-bottom" title="center bottom"></a><a style="border-bottom:none;" href="#" rel="right bottom" class="right-bottom" title="right bottom"></a>
      </div>
        <div class="clearboth"></div>
      </div>
      <div class="mk-bg-edit-option mk-bg-edit-option-stretch"> <span class="mk-bg-edit-label">
<?php _e('Background Fit and Stretch', 'mk_framework')?>
</span>
        <span class="mk-toggle-button meta-toggle-button"><span class="toggle-handle"></span><input type="hidden" value="false" name="bg_panel_stretch" id="bg_panel_stretch"/></span>
        <div class="clearboth"></div>
      </div>
      <div class="clearboth"></div>
    </div>
    <div class="clearboth"></div>
  </div>
  <div class="mk-bg-edit-buttons"> <a id="mk_cancel_bg_selector" href="#" class="button"><span>
<?php _e('Cancel', 'mk_framework')?>
</span></a> <a id="mk_apply_bg_selector" href="#" class="button button-primary"><span>
<?php _e('Apply', 'mk_framework')?>
</span></a> </div>
</div>


<?php
echo '</div>';
		echo '</td>';
		echo '</tr>';
	}

	function hidden_input($value) {

		echo '<input type="hidden" value="' . $value['default'] . '" name="' . $value['id'] . '" id="' . $value['id'] . '"/>';
	}

/*
 **
 **
 ** Type : Super Links
-------------------------------------------------------------*/

	function superlink($value) {
		$target = '';
		if (!empty($value['default'])) {
			list($target, $target_value) = explode('||', $value['default']);
		}

		echo '<tr id="' . $value['id'] . '_wrapper">';
		echo '<th>';
		echo '<label for="' . $value['id'] . '">' . $value['name'] . '</label>';
		if (isset($value['subtitle'])) {
			echo '<span class="description">' . $value['subtitle'] . '</span>';
		}
		echo '</th>';

		echo '<td>';

		echo '<input type="hidden" id="' . $value['id'] . '" name="' . $value['id'] . '" value="' . $value['default'] . '"/>';

		$method_options = array(
			'page' => 'Link to page',
			'cat' => 'Link to category',
			'post' => 'Link to post',
			'portfolio' => 'Link to portfolio',
			'manually' => 'Link manually',
		);
		echo '<select style="width:300px" class="mk-select" name="' . $value['id'] . '_selector" id="' . $value['id'] . '_selector">';
		echo '<option value="">' . __('Select Linking method', 'mk_framework') . '</option>';
		foreach ($method_options as $key => $option) {
			echo '<option value="' . $key . '"';
			if ($key == $target) {
				echo ' selected="selected"';
			}
			echo '>' . $option . '</option>';
		}
		echo '</select>';

		echo '<div style="margin-top:15px;" class="superlink-wrap">';

		//render page selector
		$hidden = ($target != "page") ? 'class="hidden"' : '';
		echo '<select name="' . $value['id'] . '_page" id="' . $value['id'] . '_page" ' . $hidden . '>';
		echo '<option value="">' . __('Select Page', 'mk_framework') . '</option>';
		foreach ($this->get_select_target_options('page') as $key => $option) {
			echo '<option value="' . $key . '"';
			if ($target == "page" && $key == $target_value) {
				echo ' selected="selected"';
			}
			echo '>' . $option . '</option>';
		}
		echo '</select>';

		//render portfolio selector
		$hidden = ($target != "portfolio") ? 'class="hidden"' : '';
		echo '<select name="' . $value['id'] . '_page" id="' . $value['id'] . '_portfolio" ' . $hidden . '>';
		echo '<option value="">' . __('Select Portfolio', 'mk_framework') . '</option>';
		foreach ($this->get_select_target_options('portfolio') as $key => $option) {
			echo '<option value="' . $key . '"';
			if ($target == "portfolio" && $key == $target_value) {
				echo ' selected="selected"';
			}
			echo '>' . $option . '</option>';
		}
		echo '</select>';

		//render category selector
		$hidden = ($target != "cat") ? 'class="hidden"' : '';
		echo '<select name="' . $value['id'] . '_cat" id="' . $value['id'] . '_cat" ' . $hidden . '>';
		echo '<option value="">' . __('Select Category', 'mk_framework') . '</option>';
		foreach ($this->get_select_target_options('cat') as $key => $option) {
			echo '<option value="' . $key . '"';
			if ($target == "cat" && $key == $target_value) {
				echo ' selected="selected"';
			}
			echo '>' . $option . '</option>';
		}
		echo '</select>';

		//render post selector
		$hidden = ($target != "post") ? 'class="hidden"' : '';
		echo '<select name="' . $value['id'] . '_post" id="' . $value['id'] . '_post" ' . $hidden . '>';
		echo '<option value="">' . __('Select Post', 'mk_framework') . '</option>';
		foreach ($this->get_select_target_options('post') as $key => $option) {
			echo '<option value="' . $key . '"';
			if ($target == "post" && $key == $target_value) {
				echo ' selected="selected"';
			}
			echo '>' . $option . '</option>';
		}
		echo '</select>';

		//render manually
		$hidden = ($target != "manually") ? 'class="hidden"' : '';
		echo '<input name="' . $value['id'] . '_manually" id="' . $value['id'] . '_manually" type="text" value="';
		if ($target == 'manually') {
			echo $target_value;
		}
		echo '" size="35" ' . $hidden . '/>';
		echo '</div>';

		if (isset($value['desc'])) {
			echo '<span class="description">' . $value['desc'] . '</span>';
		}

		echo '<td>';

		echo '</tr>';
	}

	/*
	 **
	 **
	 ** Type : Gallery
	-------------------------------------------------------------*/

	function gallery($value) {

		echo '<tr id="' . $value['id'] . '_wrapper">';
		echo '<th>';
		echo '<label for="' . $value['id'] . '">' . $value['name'] . '</label>';
		if (isset($value['subtitle'])) {
			echo '<span class="description">' . $value['subtitle'] . '</span>';
		}
		echo '</th>';

		echo '<td>';

		global $post;
		?>

    <div id="gallery_images_container<?php echo $value['id'];?>">

        <ul class="gallery_images">
<?php

		$image_gallery = get_post_meta($post->ID, $value['id'], true);
		$attachments = array_filter(explode(',', $image_gallery));

		if ($attachments) {
			foreach ($attachments as $attachment_id) {
				echo '<li class="image attachment details" data-attachment_id="' . $attachment_id . '"><div class="attachment-preview"><div class="thumbnail">
                            ' . wp_get_attachment_image($attachment_id, 'thumbnail') . '</div>
                            <a href="#" class="delete check" title="' . __('Remove image', 'mk_framework') . '"><div class="media-modal-icon"></div></a>

                        </div></li>';
			}
		}

		?>
        </ul>


        <input type="hidden" id="<?php echo $value['id'];?>" name="<?php echo $value['id'];?>" value="<?php echo esc_attr($image_gallery);?>" />


    </div>
    <br class="clear" />
    <div class="add_gallery_images hide-if-no-js">
        <a class="button button-primary button-large add_gallery_images" href="#"><?php _e('Add gallery images', 'mk_framework');?></a>
    </div>


<?php
/**
		 * Props to WooCommerce for the following JS code
		 */
		?>
    <script type="text/javascript">
        jQuery(document).ready(function($){

            // Uploading files
            var image_gallery_frame;
            var $image_gallery_ids = $('#<?php echo $value['id'];?>');
            var $gallery_images = $('#gallery_images_container<?php echo $value['id'];?> ul.gallery_images');

            jQuery('.add_gallery_images').on( 'click', 'a', function( event ) {

                var $el = $(this);
                var attachment_ids = $image_gallery_ids.val();

                event.preventDefault();

                // If the media frame already exists, reopen it.
                if ( image_gallery_frame ) {
                    image_gallery_frame.open();
                    return;
                }

                // Create the media frame.
                image_gallery_frame = wp.media.frames.downloadable_file = wp.media({
                    // Set the title of the modal.
                    title: '<?php _e('Add Images to Gallery', 'mk_framework');?>',
                    button: {
                        text: '<?php _e('Add to gallery', 'mk_framework');?>',
                    },
                    multiple: true
                });

                // When an image is selected, run a callback.
                image_gallery_frame.on( 'select', function() {

                    var selection = image_gallery_frame.state().get('selection');

                    selection.map( function( attachment ) {

                        attachment = attachment.toJSON();

                        if ( attachment.id ) {
                            attachment_ids = attachment_ids ? attachment_ids + "," + attachment.id : attachment.id;

                             $gallery_images.append('\
                                <li class="image attachment details" data-attachment_id="' + attachment.id + '">\
                                    <div class="attachment-preview">\
                                        <div class="thumbnail">\
                                            <img src="' + attachment.url + '" />\
                                        </div>\
                                       <a href="#" class="delete check" title="<?php _e('Remove image', 'mk_framework');?>"><div class="media-modal-icon"></div></a>\
                                    </div>\
                                </li>');

                        }

                    } );

                    $image_gallery_ids.val( attachment_ids );
                });

                // Finally, open the modal.
                image_gallery_frame.open();
            });

            // Image ordering
            $gallery_images.sortable({
                items: 'li.image',
                cursor: 'move',
                scrollSensitivity:40,
                forcePlaceholderSize: true,
                forceHelperSize: false,
                helper: 'clone',
                opacity: 0.65,
                placeholder: 'eig-metabox-sortable-placeholder',
                start:function(event,ui){
                    ui.item.css('background-color','#f6f6f6');
                },
                stop:function(event,ui){
                    ui.item.removeAttr('style');
                },
                update: function(event, ui) {
                    var attachment_ids = '';

                    $('#gallery_images_container<?php echo $value['id'];?> ul li.image').css('cursor','default').each(function() {
                        var attachment_id = jQuery(this).attr( 'data-attachment_id' );
                        attachment_ids = attachment_ids + attachment_id + ',';
                    });

                    $image_gallery_ids.val( attachment_ids );
                }
            });

            // Remove images
            $('#gallery_images_container<?php echo $value['id'];?>').on( 'click', 'a.delete', function() {

                $(this).closest('li.image').remove();

                var attachment_ids = '';

                $('#gallery_images_container<?php echo $value['id'];?>ul li.image').css('cursor','default').each(function() {
                    var attachment_id = jQuery(this).attr( 'data-attachment_id' );
                    attachment_ids = attachment_ids + attachment_id + ',';
                });

                $image_gallery_ids.val( attachment_ids );

                return false;
            } );

        });
    </script>
<?php

		if (isset($value['desc'])) {
			echo '<span class="description">' . $value['desc'] . '</span>';
		}

		echo '<td>';

		echo '</tr>';

	}

/*
 **
 **
 ** Type : Icon Selector
-------------------------------------------------------------*/
	function icon_selector($value) {
		wp_enqueue_style('mk-theme-icons', THEME_STYLES . '/theme-font-icons.min.css', false, false, false);
		echo '<style>'.mk_enqueue_font_icons().'</style>';
		echo '<tr id="' . $value['id'] . '_wrapper">';
		echo '<th>';
		echo '<label for="' . $value['id'] . '">' . $value['name'] . '</label>';
		if (isset($value['subtitle'])) {
			echo '<span class="description">' . $value['subtitle'] . '</span>';
		}
		echo '</th>';

		echo '<td>';

		echo '<div id="' . $value['id'] . '_container" class="mk-visual-selector mk-font-icons-wrapper" style="">';
		foreach ($value['options'] as $key => $option) {
			if ($key) {
				echo '<a href="#" title="Class Name : mk-' . $key . '" rel="' . $key . '"><span>' . $key . '</span><i class="mk-' . $key . '" ></i></a>';
			} else {
				echo '<a class="mk-no-icon" href="#" rel="">r</a>';
			}
		}
		echo '<input type="hidden" value="' . $value['default'] . '" name="' . $value['id'] . '" id="' . $value['id'] . '"/>';
		echo '</div>';

		if (isset($value['desc'])) {
			echo '<span class="description">' . $value['desc'] . '</span>';
		}

		echo '<td>';

		echo '</tr>';
	}

	/*
	Extract Array data from sources
	 */
	function get_select_target_options($type) {
		$options = array();
		switch ($type) {
			case 'page':
				$entries = get_pages('title_li=&orderby=name');
				foreach ($entries as $key => $entry) {
					$options[$entry->ID] = $entry->post_title;
				}
				break;
			case 'cat':
				$entries = get_categories('orderby=name&hide_empty=0');
				foreach ($entries as $key => $entry) {
					$options[$entry->term_id] = $entry->name;
				}
				break;
			case 'author':
				global $wpdb;
				$order = 'user_id';
				$user_ids = $wpdb->get_col($wpdb->prepare("SELECT $wpdb->usermeta.user_id FROM $wpdb->usermeta where meta_key='wp_user_level' and meta_value>=1 ORDER BY %s ASC", $order));
				foreach ($user_ids as $user_id):
					$user = get_userdata($user_id);
					$options[$user_id] = $user->display_name;
				endforeach;
				break;
			case 'post':
				$entries = get_posts('orderby=title&numberposts=-1&order=ASC&suppress_filters=0');
				foreach ($entries as $key => $entry) {
					$options[$entry->ID] = $entry->post_title;
				}
				break;
			case 'portfolio':
				$entries = get_posts('post_type=portfolio&orderby=title&numberposts=-1&order=ASC&suppress_filters=0');
				foreach ($entries as $key => $entry) {
					$options[$entry->ID] = $entry->post_title;
				}
				break;
			case 'edge':
				$entries = get_posts('post_type=edge&orderby=title&numberposts=-1&order=ASC&suppress_filters=0');
				foreach ($entries as $key => $entry) {
					$options[$entry->ID] = $entry->post_title;
				}
				break;
			case 'portfolio_category':
				$entries = get_terms('portfolio_category', 'orderby=name&hide_empty=0');
				foreach ($entries as $key => $entry) {
					$options[$entry->slug] = $entry->name;
				}
				break;
			case 'portfolio_category_id':
				$entries = get_terms('portfolio_category', 'orderby=name&hide_empty=0');
				foreach ($entries as $key => $entry) {
					$options[$entry->term_id] = $entry->name;
				}
				break;

		}
		return $options;
	}
}
function mk_get_sidebar_options() {
	global $wp_registered_sidebars;
	$options = array();
	foreach ($wp_registered_sidebars as $sidebar) {
		$options[$sidebar["name"]] = $sidebar["name"];
	}
	return $options;
}

add_action('admin_init', 'mk_get_sidebar_options');
