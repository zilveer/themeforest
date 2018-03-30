<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php $body_pattern_selected = TMM::get_option('body_pattern_selected'); ?>

<ul class="show-hide-items">
	
	<li class="body_pattern_custom_color"<?php echo($body_pattern_selected == 0 ? "" : 'style="display:none;"') ?>>
		
		<?php
		TMM_OptionsHelper::draw_theme_option(array(
			'name' => 'body_bg_color',
			'type' => 'color',
			'default_value' => '#ffffff',
			'description' => __('General website background color behind your pattern image. Do not edit this field to use default theme styling.', 'cardealer'),
			'css_class' => '',
			'is_reset' => true
		));
		?>

	</li>
	<li class="body_pattern_custom_image" <?php echo($body_pattern_selected == 1 ? "" : 'style="display:none;"') ?>>
	
		<?php
		
		TMM_OptionsHelper::draw_theme_option(array(
			'name' => 'body_pattern',
			'type' => 'upload',
			'default_value' => '',
			'description' => '',
			'id' => 'body_pattern_upload',
			'is_reset' => true
		));
		?>
		
	</li>
	<li class="body_pattern_default_image" <?php echo($body_pattern_selected == 2 ? "" : 'style="display: none;"') ?>>

		<?php	
		$body_pattern = TMM::get_option('body_pattern');
		$result = array();
		$patterns_path = TMM_THEME_PATH . "/images/patterns/";
		$dir_handle = opendir($patterns_path); # Open the path
		while ($file = readdir($dir_handle)) {
			if (is_dir($file)) {
				continue;
			}
			$result[] = $file;
		}
		closedir($dir_handle);
		?>
		
		<div class="option option-hidden">
			
			<h4 class="option-title"><?php _e('Pattern Background', 'cardealer') ?></h4>
			
			<div class="controls">
				<ul class="thumb-pattern">
					<?php if (!empty($result)): ?>
						<?php foreach ($result as $key => $file_name) : ?>
							<?php $img_path = TMM_THEME_URI . "/images/patterns/" . $file_name; ?>				
							<li class="<?php if ($img_path == $body_pattern) echo "current"; ?>"><a class="thumb_thumb_<?php echo($key + 1) ?>" style="background: url(<?php echo $img_path ?>);" href="<?php echo $img_path ?>"></a></li>
						<?php endforeach; ?>
					<?php endif; ?>
				</ul>	
				
			</div>
			
		</div><!--/ .option-->
		
		<?php
		TMM_OptionsHelper::draw_theme_option(array(
			'name' => 'body_pattern_custom_color',
			'title' => __('Pattern Background Color', 'cardealer'),
			'type' => 'color',
			'default_value' => '#ececec',
			'description' => __('General website background color behind your pattern image. Do not edit this field to use default theme styling.', 'cardealer'),
			'css_class' => '',
			'is_reset' => true
		));
		?>

	</li>

</ul>

