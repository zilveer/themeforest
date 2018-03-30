<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>


<div class="option option-radio">
	
	<div class="controls">
		<input id="logotext" type="radio" class="showhide" data-show-hide="logo_text" name="logo_type" value="0" <?php echo(!TMM::get_option('logo_type') ? "checked" : "") ?> />
		<label for="logotext"><span></span><?php _e('Text', 'cardealer'); ?></label>
		<input id="logoimage" type="radio" class="showhide" data-show-hide="logo_img" name="logo_type" value="1" <?php echo(TMM::get_option('logo_type') ? "checked" : "") ?> />
		<label for="logoimage"><span></span><?php _e('Image', 'cardealer'); ?></label>&nbsp; &nbsp;
	</div><!--/ .controls-->
	
	<div class="explain"></div>
	
</div><!--/ .option-->	

<ul class="show-hide-items">

	<li class="logo_img" <?php echo (TMM::get_option('logo_type') ? "" : 'style="display:none;"') ?>>
		
		<?php
		TMM_OptionsHelper::draw_theme_option(array(
			'name' => 'logo_img',
			'type' => 'upload',
			'default_value' => '',
			'description' => __('Upload your logo image here. Recommended dimensions: width <= 300px, height = any. Recommended image types: png, gif, jpg.', 'cardealer'),
			'id' => '',
		));
		?>

		<?php $logo_img = TMM::get_option('logo_img') ?>
		<div class="optional">
			<img id="logo_preview_image" style="display: <?php if ($logo_img): ?>inline<?php else: ?>none<?php endif; ?>; max-width:300px;" src="<?php echo $logo_img ?>" alt="logo" />
		</div>
		
	</li>
	<li class="logo_text" <?php echo(!TMM::get_option('logo_type') ? "" : 'style="display:none;"') ?>>
		
		<?php
		TMM_OptionsHelper::draw_theme_option(array(
			'name' => 'logo_text',
			'title'=>__('Logo Name', 'cardealer'),
			'type' => 'text',
			'description' => __('Type your website name here, it will appear instead of your Logo in text format.', 'cardealer'),
			'default_value' => __('cardealer', 'cardealer'),
			'css_class' => '',
		));
		?>
		
		<?php
		$logo_font_size = array();
		for ($i = 40; $i < 61; $i++) {
			$logo_font_size[$i] = $i;
		}
		
		TMM_OptionsHelper::draw_theme_option(array(
			'name' => 'logo_font_size',
			'type' => 'select',
			'title'=> __('Logo Font Size', 'cardealer'),
			'description' => '',
			'values' => $logo_font_size,
			'default_value' => 44,
			'css_class' => '',
			'show_title' => true,
			'is_reset' => true
		));
		?>

		<?php
		TMM_OptionsHelper::draw_theme_option(array(
			'name' => 'logo_font',
			'title' => __('Logo Font Family', 'cardealer'),
			'type' => 'google_font_select',
			'description' => '',
			'default_value' => 'Oswald:300,regular,700&subset=latin-ext,latin',
                        'is_reset' => true
		));
		?>

		<?php
		TMM_OptionsHelper::draw_theme_option(array(
			'name' => 'logo_text_color',
			'title'=>__('Logo Text Color', 'cardealer'),
			'type' => 'color',
			'default_value' => '#585757',
			'description' => __('Can be applied for text logo only. Can not be used on One-Page page types', 'cardealer'),
			'css_class' => '',
			'is_reset' => true
		));
		?>
		
	</li>
</ul>
