<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<br>
<ul id="slider_options">

	<?php foreach (TMM_Ext_Sliders::$slider_js_options as $slider_key => $slider) : ?>

		<?php
		if ($slider_key == 'cuteslider' OR $slider_key == 'layerslider') {
			continue;
		}
		?>

		<li id="<?php echo $slider_key ?>">

			
			<?php 
			$counter = count($slider);
			
			foreach ($slider as $option => $options_array) :
			
				switch ($options_array['type']) {
					case 'text':
						TMM_OptionsHelper::draw_theme_option(array(
							'name' => "slider_" . $slider_key . "_" . $option,
							'type' => 'slider',
							'title' => $options_array['title'],
							'show_title' => $options_array['show_title'],
							'description' => $options_array['description'],
							'default_value' => $options_array['default'],
							'is_reset' => true,
							'min' => 0,
							'max' => $options_array['max'],
							'css_class' => '',
						));
						break;

					case 'select':
						TMM_OptionsHelper::draw_theme_option(array(
							'name' => "slider_" . $slider_key . "_" . $option,
							'type' => 'select',
							'title' => $options_array['title'],
							'show_title' => $options_array['show_title'],
							'description' => $options_array['description'],
							'values' => $options_array['values_list'],
							'default_value' => $options_array['default'],
							'is_reset' => true,
							'css_class' => '',
						));
						break;

					case 'image_link':
						TMM_OptionsHelper::draw_theme_option(array(
							'name' => "slider_" . $slider_key . "_" . $option,
							'type' => 'upload',
							'default_value' => $options_array['default'],
							'description' => $options_array['description'],
							'id' => '',
							'css_class' => 'slide_option_textinput',
						));

						break;

					case 'color':
						TMM_OptionsHelper::draw_theme_option(array(
							'name' => "slider_" . $slider_key . "_" . $option,
							'type' => 'color',
							'default_value' => $options_array['default'],
							'is_reset' => true,
							'description' => $options_array['description'],
							'css_class' => '',
						));
						break;

					case 'checkbox':
						TMM_OptionsHelper::draw_theme_option(array(
							'name' => "slider_" . $slider_key . "_" . $option,
							'type' => 'checkbox',
							'default_value' => $options_array['default'],
							'title' => $options_array['title'],
							'description' => $options_array['description'],
							'is_reset' => true,
							'css_class' => '',
						));
						break;

					default:
						_e('Such option type does not exist!', 'cardealer');
						break;
				}
				?>

				<?php $counter--; ?>
				<?php if ($counter > 1): ?>
					<hr class="admin-divider">
				<?php endif; ?>

			<?php endforeach; ?>

		</li>
	<?php endforeach; ?>
</ul>