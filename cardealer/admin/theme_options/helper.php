<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

class TMM_OptionsHelper
{

	public static $sections = array();

	public static $google_fonts = array(
		"Oswald",
		"Roboto Condensed:300,400",
		"Open Sans:400,600,700"
	);
	public static $content_fonts = array(
		"Arial",
		"Tahoma",
		"Verdana",
		"Calibri"
	);

	/*
	 * Drawing theme option for admin panel
	 */

	public static function draw_theme_option($data, $prefix = TMM_THEME_PREFIX)
	{
		$value = "";

		if (isset($data['value'])) {
			$value = $data['value'];	

		} else {
			if (!empty($data['name_type']) && $data['name_type'] == 'array') {

				$option = explode('[', $data['name']);
				$option_name = $option['0'];
				$key = $option['1'];
				$key = explode(']', $key);
				$key = $key['0'];

				$value = TMM::get_option($option_name, $prefix);

				if (!empty($value[$key])) {
					$value = $value[$key];
				}

			} else {
				$value = TMM::get_option($data['name'], $prefix);
			}
		}

		if (empty($value) && '0' != $value) {
			$value = @$data['default_value'];
		}

		switch ($data['type']) {
			case 'slider':
				?>
				<div class="option option-slider"<?php echo !empty($data['hide']) ? ' style="display:none"' : ''; ?>>
					<?php if(!isset($data['show_title']) || $data['show_title'] == 1){ ?>
						<h4 class="option-title"><?php echo $data['title']; ?></h4>
					<?php } ?>
					<div class="controls">
						<input data-default-value="<?php echo @$data['default_value'] ?>" type="text"
							   name="<?php echo $data['name'] ?>" value="<?php echo $value ?>"
							   min-value="<?php echo $data['min'] ?>" max-value="<?php echo $data['max'] ?>"
							   class="ui_slider_item"/>
					</div>
					<div class="explain">
						<?php echo $data['description'] ?>
					</div>
				</div>

				<?php
				break;
			case 'text':
				?>

				<div class="option option-text"<?php echo !empty($data['hide']) ? ' style="display:none"' : ''; ?>>
					<?php if (!isset($data['show_title']) || $data['show_title'] == 1) { ?>
						<h4 class="option-title"><?php echo $data['title']; ?></h4>
					<?php } ?>
					<div class="controls">
						<input data-default-value="<?php echo @$data['default_value'] ?>"
							   data-id="<?php echo @$data['data-id'] ?>" type="text"
							<?php if (!empty($data['data_typecheck'])) { ?>
								data-typecheck="<?php echo $data['data_typecheck']; ?>"
							<?php } ?>
							   class="<?php echo @$data['css_class'] ?>"
							   name="<?php echo $data['name'] ?>" value="<?php echo $value ?>">
					</div>
					<div class="explain">
						<?php echo $data['description'] ?>
					</div>
				</div>

				<?php
				break;
			case 'textarea':
				?>

				<div class="option option-textarea"<?php echo !empty($data['hide']) ? ' style="display:none"' : ''; ?>>
					<textarea style="width: 99%; min-height: 150px;"
							  data-default-value="<?php echo @$data['default_value'] ?>"
							  name="<?php echo $data['name'] ?>"
							  class="<?php echo $data['css_class'] ?>"><?php echo $value ?></textarea>

					<div class="explain">
						<?php echo $data['description'] ?>
					</div>
				</div>

				<?php
				break;
			case 'select':
				?>
				<div class="option option-select"<?php echo !empty($data['hide']) ? ' style="display:none"' : ''; ?>>
					<?php if(!isset($data['show_title']) || $data['show_title'] == 1){ ?>
						<h4 class="option-title"><?php echo $data['title']; ?></h4>
					<?php } ?>

					<div class="controls">
						<label class="sel">
							<select data-default-value="<?php echo @$data['default_value'] ?>"
									name="<?php echo $data['name'] ?>" class="<?php echo $data['css_class'] ?>">
								<?php if (!empty($data['values'])): ?>
									<?php foreach ($data['values'] as $key => $option_text) : ?>
										<option value="<?php echo $key ?>" <?php echo($value == $key ? 'selected=""' : "") ?>><?php echo $option_text ?></option>
									<?php endforeach; ?>
								<?php endif; ?>
							</select>
						</label>
					</div>

					<div class="explain">
						<?php echo $data['description'] ?>
					</div>
				</div>
				<?php
				break;
			case 'checkbox':
				?>

				<div class="option option-checkbox"<?php echo !empty($data['hide']) ? ' style="display:none"' : ''; ?>>
					<div class="controls">
						<input data-default-value="<?php echo @$data['default_value'] ?>" type="hidden"
							   value="<?php echo ($value == '1') ? "1" : "0" ?>" name="<?php echo $data['name'] ?>">
						<input type="checkbox" id="<?php echo $data['name'] ?>"
							   class="option_checkbox <?php echo $data['css_class'] ?>" <?php echo($value == 1 ? "checked" : "") ?> <?php if (@$data['disable'] == 1) {
							echo "disabled";
						} ?>/>
						<label for="<?php echo $data['name'] ?>"><span></span><?php echo $data['title'] ?></label>
					</div>
					<div class="explain">
						<?php echo $data['description'] ?>
					</div>
				</div>

				<?php
				break;
			case 'color':
				?>

				<div class="option option-color"<?php echo !empty($data['hide']) ? ' style="display:none"' : ''; ?>>
					<?php if (!isset($data['show_title']) || $data['show_title'] == 1) { ?>
						<h4 class="option-title"><?php echo @$data['title']; ?></h4>
					<?php } ?>
					<div class="controls">
						<div class="bgpicker" style="background-color: <?php echo $value ?>"></div>
						<input data-default-value="<?php echo @$data['default_value'] ?>" value-index="0" type="text"
							   class="bg_hex_color text small <?php echo @$data['css_class'] ?>"
							   value="<?php echo $value ?>" name="<?php echo $data['name'] ?>">

						<?php if (@$_GET['page'] == 'tmm_theme_options'): ?>
							<a href="javascript:void(0);" class="js_picker_val_back" title="Back">back</a>&nbsp;
							<a href="javascript:void(0);" class="js_picker_val_ahead" title="Forward">forward</a>&nbsp;
							<a href="javascript:void(0);" class="js_picker_val_reset" title="Reset">reset</a>
						<?php endif; ?>
					</div>
					<div class="explain">
						<?php echo $data['description'] ?>
					</div>
				</div>

				<?php
				break;

			case 'google_font_select':
				$google_fonts = TMM_HelperFonts::get_google_fonts_list();
				?>
				<div class="option option-select-browse"<?php echo !empty($data['hide']) ? ' style="display:none"' : ''; ?>>

					<?php if (!isset($data['show_title']) || $data['show_title'] == 1) { ?>
						<h4 class="option-title"><?php echo $data['title']; ?></h4>
					<?php } ?>

					<div class="controls">
						<label class="sel">
							<select data-default-value="<?php echo @$data['default_value'] ?>"
									name="<?php echo $data['name'] ?>" class="google_font_select">
								<option
									value="<?php echo _e('default_font', 'cardealer') ?>"><?php _e('Default Font', 'cardealer') ?></option>
								<?php foreach ($google_fonts as $font_name => $font_text): ?>

									<option <?php echo($font_name == $value ? "selected" : "") ?>
										value="<?php echo $font_name; ?>">
										<?php echo $font_text; ?>
									</option>

								<?php endforeach; ?>
							</select>
						</label>
					</div>
					<div class="explain"><?php echo $data['description'] ?></div>
				</div>
				<?php
				break;

			case 'upload':
				?>

				<div class="option option-upload"<?php echo !empty($data['hide']) ? ' style="display:none"' : ''; ?>>
					<div class="controls">
						<input data-default-value="" id="<?php echo @$data['id'] ?>" class="middle <?php echo @$data['css_class'] ?>" type="text"
							   name="<?php echo $data['name'] ?>" value="<?php echo $value ?>">
						<a class="admin-button button_upload" href="#"><?php _e('Browse', 'cardealer'); ?></a>
					</div>
					<div class="explain">
						<?php echo $data['description'] ?>
					</div>
				</div>

				<?php
				break;
			case 'upload_zip':

				?>

				<div class="option option-upload"<?php echo !empty($data['hide']) ? ' style="display:none"' : ''; ?>>
					<div class="controls">
						<input multiple data-default-value="" id="<?php echo @$data['id'] ?>" class="middle" type="file"
							   name="<?php echo $data['name'] ?>[]" value="" style="display: none" >
						<a class="admin-button button_browse_zip" href="#"><?php _e('Browse', 'cardealer'); ?></a>
						<a class="admin-button button_upload_zip" href="#"><?php _e('Upload', 'cardealer'); ?></a>
						<ul class="groups upload_zip_list"></ul>
					</div>
					<div class="explain">
						<?php echo $data['description'] ?>
					</div>
				</div>

				<?php
				break;

			default:
				_e('Option type does not exist!', 'cardealer');
				break;
		}
		?>
		<?php if (isset($data['is_reset'])): ?>
		<script type="text/javascript">
			tmm_options_reset_array.push("<?php echo $data['name'] ?>");
		</script>
	<?php endif; ?>
	<?php
	}

	public static function get_theme_buttons()
	{
		$buttons = array(
			'default' => __('Default Grey', 'cardealer'),
			'orange' => __('Orange', 'cardealer')
		);

		return $buttons;

	}

	public static function get_theme_image_sizes()
	{
		$data = array();

		$data['100*80'] = array();
		$data['100*80']['name'] = '100*80';
		$data['100*80']['width'] = 100;
		$data['100*80']['height'] = 80;
		$data['100*80']['crop'] = true;

		$data['125*125'] = array();
		$data['125*125']['name'] = '125*125';
		$data['125*125']['width'] = 125;
		$data['125*125']['height'] = 125;
		$data['125*125']['crop'] = true;

		$data['146*88'] = array();
		$data['146*88']['name'] = '146*88';
		$data['146*88']['width'] = 146;
		$data['146*88']['height'] = 88;
		$data['146*88']['crop'] = true;

		$data['300*183'] = array();
		$data['300*183']['name'] = '300*183';
		$data['300*183']['width'] = 300;
		$data['300*183']['height'] = 183;
		$data['300*183']['crop'] = true;

		$data['350*215'] = array();
		$data['350*215']['name'] = '350*215';
		$data['350*215']['width'] = 350;
		$data['350*215']['height'] = 215;
		$data['350*215']['crop'] = true;

		$data['200*200'] = array();
		$data['200*200']['name'] = '200*200';
		$data['200*200']['width'] = 200;
		$data['200*200']['height'] = 200;
		$data['200*200']['crop'] = true;

		$data['220*134'] = array();
		$data['220*134']['name'] = '220*134';
		$data['220*134']['width'] = 220;
		$data['220*134']['height'] = 134;
		$data['220*134']['crop'] = true;


		$data['740*420'] = array();
		$data['740*420']['name'] = '740*420';
		$data['740*420']['width'] = 740;
		$data['740*420']['height'] = 420;
		$data['740*420']['crop'] = true;

		$data['1130*420'] = array();
		$data['1130*420']['name'] = '1130*420';
		$data['1130*420']['width'] = 1130;
		$data['1130*420']['height'] = 420;
		$data['1130*420']['crop'] = true;


		return $data;
	}

	public static function get_theme_image_sizes_aliases($min_width = 0, $max_width = 0)
	{
		$sizes = self::get_theme_image_sizes();
		$result = array();

		foreach ($sizes as $key => $value) {

			//filter alias with small sizes
			if ($min_width > 0) {
				if ($value['width'] < $min_width) {
					continue;
				}
			}

			//filter alias with big sizes
			if ($max_width > 0) {
				if ($value['width'] > $max_width) {
					continue;
				}
			}

			$result[$key] = $value['name'];
		}

		//***
		$result = array('' => __('Full size', 'cardealer')) + $result;

		return $result;
	}

	public static function enqueue_script($key, $in_footer = false)
	{
		wp_enqueue_script('tmm_' . $key . '_js', false, array(), false, $in_footer);
	}

	public static function enqueue_style($key)
	{
		wp_enqueue_style('tmm_' . $key . '_css');
	}

	public static function get_contacts_placeholder_icons()
	{
		return array(
			'' => "",
			'message-form-name' => __('Name', 'cardealer'),
			'message-form-email' => __('Email', 'cardealer'),
			'message-form-url' => __('URL', 'cardealer'),
			'message-form-message' => __('Message', 'cardealer')
		);
	}

}

