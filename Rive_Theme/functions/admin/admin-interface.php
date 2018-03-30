<?php

// Add Theme options link to admin menu
function themeoptions_add_admin() {

	global $query_string;

	$themename = get_option('of_themename');
	$shortname = get_option('of_shortname');

	if (isset($_REQUEST['page']) && $_REQUEST['page'] == 'themeoptions') {
		if (isset($_REQUEST['of_save']) && 'reset' == $_REQUEST['of_save']) {
			$options = get_option('of_template');
			of_reset_options($options, 'themeoptions');
			header("Location: admin.php?page=themeoptions&reset=true");
			die;
		}
	}

	$of_page = add_submenu_page('themes.php', 'Theme Options', 'Theme Options', 'edit_theme_options', 'themeoptions', 'themeoptions_options_page');

	// Add framework functionaily to the head individually
	add_action("admin_print_scripts-$of_page", 'of_load_only');
	add_action("admin_print_styles-$of_page", 'of_style_only');
}
add_action('admin_menu', 'themeoptions_add_admin');

// Reset Function - of_reset_options
function of_reset_options($options, $page = '') {

	global $wpdb;
	$query_inner = '';
	$count = 0;

	$excludes = array();

	foreach ($options as $option) {

		if (isset($option['id'])) {
			$count++;
			$option_id = $option['id'];
			$option_type = $option['type'];

			// Skip assigned id's
			if (in_array($option_id, $excludes)) {
				continue;
			}

			if ($count > 1) {
				$query_inner .= ' OR ';
			}
			if ($option_type == 'multicheck') {
				$multicount = 0;
				foreach ($option['options'] as $option_key => $option_option) {
					$multicount++;
					if ($multicount > 1) {
						$query_inner .= ' OR ';
					}
					$query_inner .= "option_name = '" . $option_id . "_" . $option_key . "'";
				}
			} else if (is_array($option_type)) {
				$type_array_count = 0;
				foreach ($option_type as $inner_option) {
					$type_array_count++;
					$option_id = $inner_option['id'];
					if ($type_array_count > 1) {
						$query_inner .= ' OR ';
					}
					$query_inner .= "option_name = '$option_id'";
				}
			} else {

				if ($option_type == 'font') {

					$query_inner .= "option_name = '$option_id' OR
									option_name = '" . $option_id . "_font_face' OR
									option_name = '" . $option_id . "_font_size' OR
									option_name = '" . $option_id . "_line_height' OR
									option_name = '" . $option_id . "_font_color' OR
									option_name = '" . $option_id . "_weight'";
				} else {
					$query_inner .= "option_name = '$option_id'";
				}
			}
		}
	}

	// When Theme Options page is reset - Add the of_options option
	if ($page == 'themeoptions') {
		$query_inner .= " OR option_name = 'of_options'";
	}

	$query = "DELETE FROM $wpdb->options WHERE $query_inner";
	$wpdb->query($query);
}

// Create options page
function themeoptions_options_page() {
	$options = get_option('of_template');
	$themename = get_option('of_themename');
?>
	<div class="wrap" id="ch_wrapper">
		<div id="message-box" class="message-box">Options Updated!</div>
		<form action="" enctype="multipart/form-data" id="ofform">
			<div id="header">
				<div class="logo">
					<h2>Theme Options</h2>
				</div>
				<div class="save-container top">
					<input type="submit" value="Save Changes" class="button-primary" />
				</div>
				<div class="clear"></div>
			</div>
			<?php
				$theme_options = ch_theme_options($options);
			?>
			<div id="main">
				<div id="of-nav">
					<ul>
						<?php echo $theme_options[1] ?>
					</ul>
				</div>
				<div id="content"> <?php echo $theme_options[0]; /* Settings */ ?> </div>
				<div class="clear"></div>
			</div>
			<div class="save-container">
				<input type="submit" value="Save Changes" class="button-primary" />
			</div>
		</form>
		<form action="<?php echo esc_attr($_SERVER['REQUEST_URI']) ?>" method="post" style="display:inline" id="ofform-reset">
			<span class="submit-footer-reset">
				<input name="reset" type="submit" value="Reset Options" class="button submit-button reset-button" onclick="return confirm('CAUTION: This will restore all your options to default.');" />
				<input type="hidden" name="of_save" value="reset" />
			</span>
		</form>
	</div>
<?php if (!empty($update_message))
			echo $update_message; ?>
		<div style="clear:both;"></div>

<?php
	}

	// Load required styles for Options Page - of_style_only
	function of_style_only() {
		global $wp_version;

		wp_enqueue_style('admin-style', get_template_directory_uri() . '/functions/admin/theme-options.css');
		wp_enqueue_style('color-picker', get_template_directory_uri() . '/functions/admin/colorpicker.css');
		if (version_compare($wp_version, '3.5', '>=')) {
			wp_enqueue_style('jquery-ui', get_template_directory_uri() . '/functions/admin/jquery-ui-1.9.2.custom.min.css');
		} else {
			wp_enqueue_style('jquery-ui', get_template_directory_uri() . '/functions/admin/jquery-ui-1.8.16.custom.css');
		}

		wp_enqueue_style('thickbox', get_template_directory_uri() . '/functions/admin/thickbox.css');
		wp_enqueue_style('gfonts', get_template_directory_uri() . '/css/gfonts.css');
	}

	// Load required javascripts for Options Page - of_load_only
	function of_load_only() {
		global $wp_version;
		add_action('admin_head', 'of_admin_head');

		wp_register_script('jquery-input-mask', get_template_directory_uri() . '/functions/admin/js/jquery.maskedinput-1.2.2.js', array('jquery'));
		wp_enqueue_script('jquery-input-mask');
		wp_enqueue_script('color-picker', get_template_directory_uri() . '/functions/admin/js/colorpicker.js', array('jquery'));
		wp_enqueue_script('ajaxupload', get_template_directory_uri() . '/functions/admin/js/fileuploader.js', array('jquery'));
		if (version_compare($wp_version, '3.5', '>=')) {
			wp_enqueue_script('jquery-ui', get_template_directory_uri() . '/functions/admin/js/jquery-ui-1.9.2.custom.min.js', array('jquery'));
		} else {
			wp_enqueue_script('jquery-ui', get_template_directory_uri() . '/functions/admin/js/jquery-ui-1.8.16.custom.min.js', array('jquery'));
		}

		wp_enqueue_script('thickbox');

		function of_admin_head() {
?>
			<script type="text/javascript" language="javascript">
				jQuery(document).ready(function(){

					// Race condition to make sure js files are loaded
					if (typeof AjaxUpload != 'function') {
						return ++counter < 6 && window.setTimeout(init, counter * 500);
					}

					jQuery('.group_select').each(function(index, value) {
						jQuery(value).closest('.block').find('.group_' + jQuery(value).val()).show();
					});

					jQuery('.group_select').change(function() {
						var selector_val = jQuery(this).val();
						jQuery(this).closest('.block').find('.group').hide();
						jQuery(this).closest('.block').find('.group_' + selector_val).show();
					});

					jQuery('.group:not(.dont_hide), .block').hide();
					jQuery('.group:first').show();

					jQuery('.of-radio-font-font').click(function(){
						jQuery(this).parent().parent().find('.of-radio-font-font').removeClass('of-radio-font-selected');
						jQuery(this).addClass('of-radio-font-selected');

					});

					jQuery('.of-radio-img-img').click(function(){
						jQuery(this).parent().parent().find('.of-radio-img-img').removeClass('of-radio-img-selected');
						jQuery(this).addClass('of-radio-img-selected');

					});
					jQuery('.of-radio-img-label').hide();
					jQuery('.of-radio-img-img').show();
					jQuery('.of-radio-img-radio').hide();
					jQuery('#of-nav li:first').addClass('current');
					jQuery('#of-nav li a').click(function(evt) {

						jQuery('#of-nav li').removeClass('current');
						jQuery(this).parent().addClass('current');

						var clicked_group = jQuery(this).attr('href');

						jQuery('.group:not(.dont_hide), .block').hide();
						jQuery(clicked_group).show();

						jQuery('.group_select').each(function(index, value) {
							jQuery(value).closest('.block').find('.group_' + jQuery(value).val()).show();
						});

						evt.preventDefault();
					});

					// Upload image
					jQuery('.upload_image').each(function(){
						upload_image("<?php echo admin_url("admin-ajax.php"); ?>");
					});

					// Remove image
					jQuery('.remove-image').click(function(){
						remove_image(this, "<?php echo admin_url( "admin-ajax.php"); ?>");
					});

					// Save everything else
					jQuery('#ofform').submit(function(){

						// Serialize data
						jQuery(":checkbox, :radio").click(jQuery("#ofform").serialize());
						jQuery("select").change(jQuery("#ofform").serialize());

						var ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';
						var data = {
							type: 'options',
							action: 'ajax_post_action',
							data: jQuery("#ofform").serialize()
						};

						// Save all form data
						jQuery.post(ajax_url, data, function(response) {

							// Scroll page to top
							jQuery('body,html').animate({
								scrollTop: 0
							}, 200, function() {

								// Show update box
								jQuery('#message-box').fadeIn();

								// Hide update box after 5 seconds
								window.setTimeout('jQuery(\'#message-box\').fadeOut(200)', 5000);
							});
						});

						return false;

					});

				});
			</script>
<?php
		}

	}

// Ajax Save Action - ajax_callback
add_action('wp_ajax_ajax_post_action', 'ajax_callback');

function ajax_callback() {
	global $wpdb;

	$save_type = $_POST['type'];

	// Uploads
	if ($save_type == 'upload') {

		$clickedID = $_POST['data']; // Acts as the name
		$filename = $_FILES[$clickedID];
		$filename['name'] = preg_replace('/[^a-zA-Z0-9._\-]/', '', $filename['name']);

		$override['test_form'] = false;
		$override['action'] = 'wp_handle_upload';
		$uploaded_file = wp_handle_upload($filename, $override);

		$upload_tracking[] = $clickedID;
		update_option($clickedID, $uploaded_file['url']);

		if (!empty($uploaded_file['error'])) {
			echo 'Upload Error: ' . $uploaded_file['error'];
		} else {
			echo $uploaded_file['url'];
		} // Is the Response
	} elseif ($save_type == 'image_reset') {

		$id = $_POST['data']; // Acts as the name
		global $wpdb;
		$query = "DELETE FROM $wpdb->options WHERE option_name LIKE '$id'";
		$wpdb->query($query);
	} elseif ($save_type == 'options' OR $save_type == 'framework') {
		$data = $_POST['data'];
		$fonts_content = '';

		parse_str($data, $output);

		// Pull options
		$options = get_option('of_template');

		foreach ($options as $option_array) {

			$id = $option_array['id'];
			$old_value = get_option($id);
			$new_value = '';

			if (isset($output[$id])) {
				$new_value = $output[$option_array['id']];
			}

			if (isset($option_array['id'])) {
				$type = $option_array['type'];

				if (is_array($type)) {
					foreach ($type as $array) {
						if ($array['type'] == 'text') {
							$id = $array['id'];
							$order = $array['order'];
							$new_value = $output[$id];
							if ($new_value == '') {
								$new_value = $order;
							}
							update_option($id, stripslashes($new_value));
						}
					}

				// ..checkbox
				} elseif ($new_value == '' && $type == 'checkbox') {
					update_option($id, 'false');
				} elseif ($new_value == 'true' && $type == 'checkbox') {
					update_option($id, 'true');

				// ..multicheck
				} elseif ($type == 'multicheck') {
					$option_options = $option_array['options'];

					foreach ($option_options as $options_id => $options_value) {

						$multicheck_id = $id . "_" . $options_id;

						if (!isset($output[$multicheck_id])) {
							update_option($multicheck_id, 'false');
						} else {
							update_option($multicheck_id, 'true');
						}
					}

				// ..fonts
				} elseif ($type == 'font') {

					// Update all style options
					update_option($id . '_font_face', stripslashes($output[$id . '_font_face']));
					update_option($id . '_font_size', stripslashes($output[$id . '_font_size']));
					update_option($id . '_line_height', stripslashes($output[$id . '_line_height']));
					update_option($id . '_font_color', stripslashes($output[$id . '_font_color']));
					update_option($id . '_weight', stripslashes($output[$id . '_weight']));

					$fonts_content[] = $output[$id . '_font_face'];

				// ..select, text and textarea
				} else {
					update_option($id, stripslashes($new_value));
				}
			}
		}

		// Check subsets
		$cyrillic_subset = get_option('vh_subset_cyrillic', 'false');
		$greek_subset = get_option('vh_subset_greek', 'false');
		$latin_subset = get_option('vh_subset_latin', 'true');
		$latin_ext_subset = get_option('vh_subset_latin_ext', 'false');
		$font_subsets = '';
		if ( $latin_subset == 'true' ) {
			$font_subsets .= 'latin,';
		}
		if ( $latin_ext_subset == 'true' ) {
			$font_subsets .= 'latin-ext,';
		}
		if ( $greek_subset == 'true' ) {
			$font_subsets .= 'greek,';
		}
		if ( $cyrillic_subset == 'true' ) {
			$font_subsets .= 'cyrillic,';
		}
		$font_subsets = rtrim($font_subsets, ',');

		// Create google fonts css file
		$fonts_content = array_unique($fonts_content);
		$fonts_content = '@import url(\'http://fonts.googleapis.com/css?family=' . implode('|', $fonts_content) . '&subset=' . $font_subsets . '\');';
		create_google_css(TEMPLATEPATH . '/css/gfonts.css', $fonts_content);
	}

	die();
}

// Create theme options
function ch_theme_options($options) {
	global $ch_fonts_default_options;

	$counter = 0;
	$menu = '';
	$output = '';
	foreach ($options as $value) {

		// Vars
		$counter++;
		$input_value = '';
		$slider_js = '';
		$select_value = '';

		// Heading
		if ($value['type'] != "heading" && $value['type'] != "block_open" && $value['type'] != "block_close" && $value['type'] != "group_open" && $value['type'] != "group_close") {
			$output .= '
			<div class="section section-' . $value['type'] . '">
				<h3 class="heading">' . $value['name'] . '</h3>';

			if (!isset($value['desc'])) {
				$tooltip = '';
			} else {
				$tooltip = $value['desc'];
			}

			// Show tooltip
			if (!empty($tooltip)) {
				$output .= '
			<a rel="tooltip" class="tooltip-icon icon-info-circled" id="' . $tooltip . '"></a>';
			}

			$output .= '
				<div class="clearfix"></div>
				<div class="option">
					<div class="input-wrapper">';
		}

		// Check by type
		switch ($value['type']) {

			// Show text input
			case 'text':
			$input_class = '';

				// Vars
				$input_value = $value['order'];
				$saved_value = get_option($value['id']);

				// If previously saved
				if ($saved_value != "") {
					$input_value = $saved_value;
				}

				// Should slider be shown?
				if (isset($value['slider']) && $value['slider'] == 'yes') {

					// Add input class
					$input_class = ' input-text-small';

					// Add slider JS
					$output .= '
					<script type="text/javascript">
						jQuery(function() {
							var input = jQuery("#' . $value['id'] . '");
							jQuery("<div class=\'slider\' id=\'slider_' . $value['id'] . '\'></div>").insertAfter(input).slider({
								min: 1,
								max: ' . $input_value * 2 . ',
								range: "min",
								animate: true,
								value: ' . $input_value . ',
								slide: function(event, ui) {
									jQuery("#' . $value['id'] . '").val(ui.value)
								}
							});
						});
					</script>';

					$slider_js = ' onKeyUp="SetSliderValue(\'#slider_' . $value['id'] . '\', this)"';
				}

				$output .= '<input class="of-input' . $input_class . '" name="' . $value['id'] . '" id="' . $value['id'] . '"' . $slider_js . ' type="' . $value['type'] . '" value="' . $input_value . '" />';
				break;

			// Show select input
			case 'select':
				$input_class = '';

				// Should slider be shown?
				if (isset($value['slider']) && $value['slider'] == 'yes') {

					// Add input class
					$input_class = 'select-small hide';

					// Add slider JS
					$output .= '
					<script type="text/javascript">
						jQuery(function() {
							var select = jQuery("#' . $value['id'] . '");
							var slider = jQuery("<div class=\'slider\'></div>").insertAfter(select).slider({
								min: ' . current($value['options']) . ',
								max: ' . end($value['options']) . ',
								range: "min",
								animate: true,
								value: select[0].selectedIndex + 1,
								slide: function(event, ui) {
									select[0].selectedIndex = ui.value - 1;
									jQuery("#select_' . $value["id"] . '").text(ui.value);
								}
							});
						});
					</script>';
				}

				$output .= '<select class="' . $input_class . '" name="' . $value['id'] . '" id="' . $value['id'] . '">';

				$select_value = get_option($value['id']);

				foreach ($value['options'] as $option) {

					$selected = '';

					if ($select_value != '') {
						if (stripslashes($select_value) == $option) {
							$selected = ' selected="selected"';
							$selected_option = $option;
						}
					} else {
						if (isset($value['order']))
							if ($value['order'] == $option) {
								$selected = ' selected="selected"';
								$selected_option = $option;
							}
					}

					$output .= '<option' . $selected . '>';
					$output .= $option;
					$output .= '</option>';
				}
				$output .= '</select>';

				if (isset($value['slider']) && $value['slider'] == 'yes') {
					$output .= '
					<div class="select-number" id="select_' . $value['id'] . '">' . $selected_option . '</div>';
				}

				break;


			// Show GROUP select input
			case 'group_select':
				$input_class = '';

				$output .= '<select class="group_select ' . $input_class . '" name="' . $value['id'] . '" id="' . $value['id'] . '">';

				$select_value = get_option($value['id']);

				foreach ($value['options'] as $option) {

					$selected = '';

					if ($select_value != '') {
						if (str_replace('.', '', strtolower(stripslashes($select_value))) == str_replace('.', '', strtolower(stripslashes($option)))) {
							$selected = ' selected="selected"';
							$selected_option = $option;
						}
					} else {
						if (isset($value['order']))
							if ($value['order'] == $option) {
								$selected = ' selected="selected"';
								$selected_option = $option;
							}
					}

					$output .= '<option' . $selected . ' value="' . str_replace('.', '', strtolower(stripslashes($option))) . '">';
					$output .= $option;
					$output .= '</option>';
				}
				$output .= '</select>';

				break;

			case 'font':
				$color     = $value['color'];
				$option_id = $value['id'];

				if ( !isset($ch_fonts_default_options[$option_id . '_font_color']) )
					$ch_fonts_default_options[$option_id . '_font_color'] = '';

				if ( !isset($ch_fonts_default_options[$option_id . '_weight']) )
					$ch_fonts_default_options[$option_id . '_weight'] = '';

				$current_face   = get_option($option_id . '_font_face', $ch_fonts_default_options[$option_id . '_font_face']);
				$current_size   = get_option($option_id . '_font_size', $ch_fonts_default_options[$option_id . '_font_size']);
				$current_lh     = get_option($option_id . '_line_height', $ch_fonts_default_options[$option_id . '_line_height']);
				$current_color  = get_option($option_id . '_font_color', $ch_fonts_default_options[$option_id . '_font_color']);
				$current_weight = get_option($option_id . '_weight', $ch_fonts_default_options[$option_id . '_weight']);
				$font_bg        = $ch_fonts_default_options[$option_id . '_bg'];

				// If color is saved previously then overwrite default color
				if (!empty($current_color)) {
					$color = $current_color;
				}

				$output .= '
					<script type="text/javascript">
					jQuery(document).ready(function() {
						jQuery(\'#' . $option_id . '-color-selector\').ColorPicker({
							color: \'' . $color . '\',
							onShow: function (colpkr) {
								jQuery(colpkr).fadeIn(100);
								return false;
							},
							onHide: function (colpkr) {
								jQuery(colpkr).fadeOut(100);
								return false;
							},
							onChange: function (hsb, hex, rgb) {
								jQuery(\'#' . $option_id . '\').val(hex);
								jQuery(\'#' . $option_id . '-color-selector div\').css(\'backgroundColor\', \'#\' + hex);
								jQuery(\'#' . $option_id . '-color-selector\').parent().closest(".section-font").find(".font-preview").css("color", \'#\' + hex + \'\');
							}
						});
						});
					</script>';

				$output .= '
					<select name="' . $option_id . '_font_size" class="font-size">';

				for ($i = $value['min_px']; $i <= $value['max_px']; $i++) {
					$output .= '
						<option value="' . $i . '" ' . selected($i, $current_size, false) . '>' . $i . ' px</option>';
				}
				$output .= '
					</select>
					<select name="' . $option_id . '_line_height" class="line-height">';

				for ($i = $value['min_ln']; $i <= $value['max_ln']; $i++) {
					$output .= '
						<option value="' . $i . '" ' . selected($i, $current_lh, false) . '>' . $i . ' px</option>';
				}
				$output .= '
					</select>
					<select name="' . $option_id . '_font_face" id="' . $option_id . '_font_face" class="font-family">
						<option value="Arial" ' . selected('Arial', $current_face, false) . '>Arial</option>
						<option value="Verdana" ' . selected('Verdana', $current_face, false) . '>Verdana</option>
						<option value="Georgia" ' . selected('Georgia', $current_face, false) . '>Georgia</option>
						<option value="Tahoma" ' . selected('Tahoma', $current_face, false) . '>Tahoma</option>
						<option value="Trebuchet+MS" ' . selected('Trebuchet+MS', $current_face, false) . '>Trebuchet MS</option>
						<option value="Calibri" ' . selected('Calibri', $current_face, false) . '>Calibri</option>
						<option value="Geneva" ' . selected('Geneva', $current_face, false) . '>Geneva</option>
						<option value="" ' . selected('', $current_face, false) . '>-- Google Fonts --</option>';

				// Get google web fonts list
				$fonts_list = file_get_contents(CH_ADMIN . '/fonts.xml');
				$fonts_list = unserialize($fonts_list);
				$fonts_list[] = array(
						"font-family" => "font-family: 'Headland One', sans-serif;",
						"font-name"   => "Headland One",
						"css-name"    => "Headland+One"
					);
				$fonts_list[] = array(
						"font-family" => "font-family: 'Fjalla One', sans-serif;",
						"font-name"   => "Fjalla One",
						"css-name"    => "Fjalla+One"
					);

				// Show google web fonts
				foreach ($fonts_list as $font) {
					$output .= '
						<option value="' . $font['css-name'] . '" ' . selected($font['css-name'], $current_face, false) . '>' . $font['font-name'] . '</option>';
				}

				// Prepare font-style and font-weight options
				if ($current_weight == 'bold') {
					$font_options = ' font-weight: bold;';
				} elseif ($current_weight == 'bold_italic') {
					$font_options = ' font-weight: bold; font-style: italic;';
				} elseif ($current_weight == 'italic') {
					$font_options = ' font-style: italic;';
				} else {
					$font_options = '';
				}

				$output .= '
					</select>
					<select name="' . $option_id . '_weight" class="font-weight">
						<option value="normal" ' . selected('normal', $current_weight, false) . '>Normal</option>
						<option value="bold" ' . selected('bold', $current_weight, false) . '>Bold</option>
						<option value="italic" ' . selected('italic', $current_weight, false) . '>Italic</option>
						<option value="bold_italic" ' . selected('bold_italic', $current_weight, false) . '>Bold Italic</option>
					</select>
					<div id="' . $option_id . '-color-selector" class="color-selector"><div style="background-color: #' . $color . '"></div></div>
					<input style="visibility: hidden; height: 1px; padding: 0; margin: 0;" name="' . $option_id . '_font_color" id="' . $value['id'] . '" type="text" value="' . $color . '" />
					<div class="clear"></div>
					<div class="font-descriptions">
						<div class="font-size-desc">font size</div>
						<div class="line-height-desc">line height</div>
					</div>
					<div class="clear"></div>
					<div class="font-styles"></div>
					<div class="font-preview"
						style="background: ' . $font_bg . '; color: #' . $color . ';' . $font_options . ' font-size: ' . $current_size . 'px; font-family: \'' . str_replace('+', ' ', $current_face) . '\'; line-height: ' . $current_lh . 'px;">
						Marshmallow sugar plum jelly-o. Pastry chupa chups dragée soufflé toffee powder lemon drops
						oat cake. Sweet roll apple pie dragée halvah faworki chupa chups. Topping croissant wafer halvah donut gummi bears
						ice cream jelly beans chupa chups. Biscuit tiramisu danish candy canes lemon drops biscuit. Macaroon fruitcake
						jujubes caramels. Cookie carrot cake gummies biscuit biscuit brownie dragée. Pie candy canes cupcake lemon drops
						chocolate bar.
					</div>';
				break;

			case "multicheck":

				$order = $value['order'];

				foreach ($value['options'] as $key => $option) {

					$of_key = $value['id'] . '_' . $key;
					$saved_order = get_option($of_key);

					if (!empty($saved_order)) {
						if ($saved_order == 'true') {
							$checked = 'checked="checked"';
						} else {
							$checked = '';
						}
					} elseif ($order == $key) {
						$checked = 'checked="checked"';
					} else {
						$checked = '';
					}
					$output .= '<input type="checkbox" class="checkbox of-input" name="' . $of_key . '" id="' . $of_key . '" value="true" ' . $checked . ' /><label for="' . $of_key . '">' . $option . '</label><br />';
				}
				break;

			case 'textarea':

				$cols = '8';
				$input_value = '';

				if (isset($value['order'])) {

					$input_value = $value['order'];

					if (isset($value['options'])) {
						$ta_options = $value['options'];
						if (isset($ta_options['cols'])) {
							$cols = $ta_options['cols'];
						} else {
							$cols = '8';
						}
					}
				}
				$order = get_option($value['id']);
				if ($order != "") {
					$input_value = stripslashes($order);
				}
				$output .= '<textarea class="of-input" name="' . $value['id'] . '" id="' . $value['id'] . '" cols="' . $cols . '" rows="8">' . $input_value . '</textarea>';

				break;

			case "radio":

				$select_value = get_option($value['id']);

				foreach ($value['options'] as $key => $option) {

					$checked = '';
					if ($select_value != '') {
						if ($select_value == $key) {
							$checked = ' checked';
						}
					} else {
						if ($value['order'] == $key) {
							$checked = ' checked';
						}
					}
					$output .= '<input class="of-input of-radio" type="radio" name="' . $value['id'] . '" value="' . $key . '" ' . $checked . ' />' . $option . '<br />';
				}

				break;

			case "checkbox":

				$order = $value['order'];

				$saved_order = get_option($value['id']);

				$checked = '';

				if (!empty($saved_order)) {
					if ($saved_order == 'true') {
						$checked = 'checked="checked"';
					} else {
						$checked = '';
					}
				} elseif ($order == 'true') {
					$checked = 'checked="checked"';
				} else {
					$checked = '';
				}
				$output .= '<input type="checkbox" class="checkbox of-input" name="' . $value['id'] . '" id="' . $value['id'] . '" value="true" ' . $checked . ' />';

				break;

			case "upload":

				$output .= themeoptions_uploader_function($value['id'], $value['order'], null);

				break;

			case "color":
				$val = $value['order'];
				$stored = get_option($value['id']);
				if ($stored != "") {
					$val = $stored;
				}
				$output .= '<div id="' . $value['id'] . '_picker" class="colorSelector"><div></div></div>';
				$output .= '<input class="of-color" name="' . $value['id'] . '" id="' . $value['id'] . '" type="text" value="' . $val . '" />';
				break;

			case "images":
				$i = 0;
				$select_value = get_option($value['id']);

				foreach ($value['options'] as $key => $option) {
					$i++;

					$checked = '';
					$selected = '';
					if ($select_value != '') {
						if ($select_value == $key) {
							$checked = ' checked';
							$selected = 'of-radio-img-selected';
						}
					} else {
						if ($value['order'] == $key) {
							$checked = ' checked';
							$selected = 'of-radio-img-selected';
						} elseif ($i == 1 && !isset($select_value)) {
							$checked = ' checked';
							$selected = 'of-radio-img-selected';
						} elseif ($i == 1 && $value['order'] == '') {
							$checked = ' checked';
							$selected = 'of-radio-img-selected';
						} else {
							$checked = '';
						}
					}

					$output .= '<span>';
					$output .= '<input type="radio" id="of-radio-img-' . $value['id'] . $i . '" class="checkbox of-radio-img-radio" value="' . $key . '" name="' . $value['id'] . '" ' . $checked . ' />';
					$output .= '<div class="of-radio-img-label">' . $key . '</div>';
					$output .= '<img src="' . $option . '" alt="" class="of-radio-img-img ' . $selected . '" onClick="document.getElementById(\'of-radio-img-' . $value['id'] . $i . '\').checked = true;" />';
					$output .= '</span>';
				}

				break;

			case "font-icons":
				$i = 0;
				$select_value = get_option($value['id']);

				foreach ($value['options'] as $key => $option) {
					$i++;

					$checked = '';
					$selected = '';
					if ($select_value != '') {
						if ($select_value == $key) {
							$checked = ' checked';
							$selected = 'of-radio-font-selected';
						}
					} else {
						if ($value['order'] == $key) {
							$checked = ' checked';
							$selected = 'of-radio-font-selected';
						} elseif ($i == 1 && !isset($select_value)) {
							$checked = ' checked';
							$selected = 'of-radio-font-selected';
						} elseif ($i == 1 && $value['order'] == '') {
							$checked = ' checked';
							$selected = 'of-radio-font-selected';
						} else {
							$checked = '';
						}
					}

					$output .= '<span>';
					$output .= '<input type="radio" id="of-radio-font-' . $value['id'] . $i . '" class="checkbox of-radio-font-radio" value="' . $key . '" name="' . $value['id'] . '" ' . $checked . ' />';
					$output .= '<div class="' . $option . ' of-radio-font-font ' . $selected . '" onClick="document.getElementById(\'of-radio-font-' . $value['id'] . $i . '\').checked = true;"></div>';
					$output .= '<div class="of-radio-font-label">' . $key . '</div>';
					$output .= '</span>';
				}

				break;

			case "info":
				$default = $value['order'];
				$output .= $default;
				break;

			case "heading":
				$group_class = '';
				$group_id    = '';
				$group_class = str_replace('.', '', strtolower($value['group_class']));

				if ( $value['dont_hide'] === TRUE ) {
					$group_class .= ' dont_hide';
				}

				$jquery_click_hook = ereg_replace("[^A-Za-z0-9]", "", strtolower($value['name']));
				$jquery_click_hook = "of-option-" . $jquery_click_hook;

				if ( $value['no_id'] !== TRUE ) {
					$group_id = ' id="' . $jquery_click_hook . '"';
				}

				$menu .= '<li class="tab_' . strtolower(str_replace(" ", "_", $value['name'])) . '"><a title="' . $value['name'] . '" class="' . $value['menu_class'] . '" href="#' . $jquery_click_hook . '">' . $value['name'] . '</a></li>';
				$output .= '<div class="group ' . $group_class . '" ' . $group_id . '><h2>' . $value['name'] . '</h2>' . "\n";
				break;

			case "group_open":
				$group_class = '';
				$group_id    = '';
				$group_class = str_replace('.', '', strtolower($value['group_class']));

				if ( $value['dont_hide'] === TRUE ) {
					$group_class .= ' dont_hide';
				}

				$jquery_click_hook = ereg_replace("[^A-Za-z0-9]", "", strtolower($value['name']));
				$jquery_click_hook = "of-option-" . $jquery_click_hook;

				if ( $value['no_id'] !== TRUE ) {
					$group_id = ' id="' . $jquery_click_hook . '"';
				}

				$output .= '<div class="group ' . $group_class . '" ' . $group_id . '><h2>' . $value['name'] . '</h2>' . "\n";
				break;

			case "group_close":
				$output .= '</div><!-- end of group-->' . "\n";

				break;

			case "block_open":

				$jquery_click_hook = ereg_replace("[^A-Za-z0-9]", "", strtolower($value['name']));
				$jquery_click_hook = "of-option-" . $jquery_click_hook;
				$output .= '<div class="block" id="' . $jquery_click_hook . '">' . "\n";
				break;

			case "block_close":

				$output .= '</div><!--end of block-->' . "\n";
				break;
		}

		// if TYPE is an array, formatted into smaller inputs... ie smaller values
		if (is_array($value['type'])) {
			foreach ($value['type'] as $array) {

				$id    = $array['id'];
				$order = $array['order'];
				$saved_order = get_option($id);
				if ($saved_order != $order) {
					$order = $saved_order;
				}
				$meta = $array['meta'];

				if ($array['type'] == 'text') { // Only text at this point
					$output .= '<input class="input-text-small of-input" name="' . $id . '" id="' . $id . '" type="text" value="' . $order . '" />';
					$output .= '<span class="meta-two">' . $meta . '</span>';
				}
			}
		}
		if ($value['type'] != "heading" && $value['type'] != "block_open" && $value['type'] != "block_close" && $value['type'] != "group_open" && $value['type'] != "group_close") {
			

			$output .= '</div>
						<div class="clear">
					</div>
				</div>
			</div>';
		}
	}
	$output .= '</div>';
	return array($output, $menu);
}

// File Uploader
function themeoptions_uploader_function($id, $value) {

	// Vars
	$uploader = '';
	$upload   = get_option($id);

	// Add classes for input fields
	if (!empty($upload)) {
		$hide = '';
	} else {
		$hide = ' hide';
	}

	if (get_option($id) != "") {
		$value = get_option($id);
	}

	// Show text field with value and buttons
	$uploader .= '
		<input class="of-input upload-input" name="' . $id . '" id="' . $id . '_upload" type="text" value="' . $value . '" />
		<div class="upload-box">
			<span class="button upload_image" id="' . $id . '">Upload Image</span>
		</div>
		<div class="clear"></div>';

	// Show uploaded image
	if (!empty($upload)) {
		$uploader .= '
			<div class="image-box">
				<span class="remove-image" id="reset_' . $id . '" title="' . $id . '"></span>
				<a class="uploaded-image thickbox" href="' . $upload . '">
					<img id="image_' . $id . '" src="' . $upload . '" alt="" />
				</a>
			</div>';
	}
	$uploader .= '<div class="clear"></div>';


	return $uploader;
}

function create_google_css ($filename, $content) {
	if (!$handle = fopen($filename, 'w')) {
         echo "Cannot open file ($filename)";
    }

    // Write $somecontent to our opened file.
    if (fwrite($handle, $content) === FALSE) {
        echo "Cannot write to file ($filename)";
    }
}