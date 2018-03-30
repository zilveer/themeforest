<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php
$logo_type = (TMM::get_option('logo_type') === null || TMM::get_option('logo_type') === '0') ? 'text' : 'image';
?>

<div class="option option-radio">
	
	<div class="controls">
		<input id="logoimage" type="radio" class="showhide" data-show-hide="logo_img" name="logo_type" value="1" <?php echo $logo_type === 'image' ? "checked" : ""; ?> />
		<label for="logoimage"><span></span><?php _e('Image', 'diplomat'); ?></label>&nbsp; &nbsp;
		<input id="logotext" type="radio" class="showhide" data-show-hide="logo_text" name="logo_type" value="0" <?php echo $logo_type === 'text' ? "checked" : ""; ?> />
		<label for="logotext"><span></span><?php _e('Text', 'diplomat'); ?></label>
	</div><!--/ .controls-->
	
	<div class="explain"></div>
	
</div><!--/ .option-->	

<ul class="show-hide-items">

	<li class="logo_img" <?php echo ($logo_type === 'image' ? "" : 'style="display:none;"'); ?>>
		
		<?php
		TMM_OptionsHelper::draw_theme_option(array(
			'name' => 'logo_img',
			'type' => 'upload',
			'default_value' => '',
			'description' => __('Upload your logo image here. Recommended dimensions: width <= 300px, height = any. Recommended image types: png, gif, jpg.', 'diplomat'),
			'id' => 'logo_image',
		));
		?>

		<?php $logo_img = TMM::get_option('logo_img') ?>
		<div class="optional">
			<img id="logo_preview_image" style="display: <?php if ($logo_img): ?>inline<?php else: ?>none<?php endif; ?>; max-width:300px;" src="<?php echo esc_url($logo_img); ?>" alt="logo" />
		</div>
		
	</li>
	<li class="logo_text" <?php echo($logo_type === 'text' ? "" : 'style="display:none;"') ?>>
		
		<?php
		TMM_OptionsHelper::draw_theme_option(array(
			'name' => 'logo_text',
			'title'=>__('Logo Name', 'diplomat'),
			'type' => 'text',
			'description' => __('Type your website name here, it will appear instead of your Logo in text format.', 'diplomat'),
			'default_value' => __('Diplomat', 'diplomat'),
			'css_class' => 'logo_text_val',
			'is_reset' => true
		));
		?>
		
		<?php
		$logo_font_size = array();
		for ($i = 20; $i < 70; $i++) {
			$logo_font_size[$i] = $i;
		}
		
		TMM_OptionsHelper::draw_theme_option(array(
			'name' => 'logo_font_size',
			'type' => 'select',
			'title'=> __('Logo Font Size', 'diplomat'),
			'description' => '',
			'values' => $logo_font_size,
			'default_value' => TMM_OptionsHelper::get_default_value('logo_font_size'),
			'css_class' => '',
            'is_reset' => true
		));
		?>

		<?php
		TMM_OptionsHelper::draw_theme_option(array(
			'name' => 'logo_font',
			'title' => __('Logo Font Family', 'diplomat'),
			'type' => 'google_font_select',
			'default_value' => TMM_OptionsHelper::get_default_value('logo_font'),
			'fonts' => tmm_get_fonts_array(),
            'is_reset' => true
		));
		?>

		<?php
		TMM_OptionsHelper::draw_theme_option(array(
			'name' => 'logo_text_color',
			'title'=>__('Logo Text Color', 'diplomat'),
			'type' => 'color',
			'default_value' => TMM_OptionsHelper::get_default_value('logo_text_color'),
			'description' => __('Logo text color for text logo only. Do not edit this field to use default theme styling.', 'diplomat'),
			'css_class' => '',
			'is_reset' => true
		));
		?>

		<?php
		TMM_OptionsHelper::draw_theme_option(array(
			'name' => 'use_logo_two_colors',
			'title' => __('Use Two Colors For Logo', 'diplomat'),
			'type' => 'checkbox',
			'default_value' => 1,
			'description' => '',
			'css_class' => 'use_logo_two_colors'
		));
		?>

		<div class="advanced_logo_options">

			<?php
			TMM_OptionsHelper::draw_theme_option(array(
				'name' => 'splitted_logo_text',
				'title' => __('Split Title with the help "^" symbol', 'diplomat'),
				'type' => 'text',
				'default_value' => TMM_OptionsHelper::get_default_value('splitted_logo_text'),
				'description' => '',
				'css_class' => 'splitted_logo_text',
				'is_reset' => true
			));
			?>

			<?php
			TMM_OptionsHelper::draw_theme_option(array(
				'name' => 'hlight_logo_text_color1',
				'title'=>__('Text Color for First Part (Light Header Type)', 'diplomat'),
				'type' => 'color',
				'default_value' => TMM_OptionsHelper::get_default_value('hlight_logo_text_color1'),
				'description' => __('Text color for first part logo only (Light Header Type). Do not edit this field to use default theme styling.', 'diplomat'),
				'css_class' => '',
				'is_reset' => true
			));
			?>

			<?php
			TMM_OptionsHelper::draw_theme_option(array(
				'name' => 'hlight_logo_text_color2',
				'title'=>__('Text Color for Second Part (Light Header Type)', 'diplomat'),
				'type' => 'color',
				'default_value' => TMM_OptionsHelper::get_default_value('hlight_logo_text_color2'),
				'description' => __('Text color for second part logo only (Light Header Type). Do not edit this field to use default theme styling.', 'diplomat'),
				'css_class' => '',
				'is_reset' => true
			));
			?>

			<?php
			TMM_OptionsHelper::draw_theme_option(array(
				'name' => 'hdark_logo_text_color1',
				'title'=>__('Text Color for First Part (Dark or Colored Header Type)', 'diplomat'),
				'type' => 'color',
				'default_value' => TMM_OptionsHelper::get_default_value('hdark_logo_text_color1'),
				'description' => __('Text color for first part logo only (Light or Colored Header Type). Do not edit this field to use default theme styling.', 'diplomat'),
				'css_class' => '',
				'is_reset' => true
			));
			?>

			<?php
			TMM_OptionsHelper::draw_theme_option(array(
				'name' => 'hdark_logo_text_color2',
				'title'=>__('Text Color for Second Part (Dark or Colored Header Type)', 'diplomat'),
				'type' => 'color',
				'default_value' => TMM_OptionsHelper::get_default_value('hdark_logo_text_color2'),
				'description' => __('Text color for second part logo only (Dark or Colored Header Type). Do not edit this field to use default theme styling.', 'diplomat'),
				'css_class' => '',
				'is_reset' => true
			));
			?>

		</div>

	</li>
</ul>
