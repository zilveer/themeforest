<?php
if (!defined('ABSPATH')) die('No direct access allowed');

$options = array(
	0 => __('Default', 'cardealer'),
	'classic' => __('Classic', 'cardealer'),
	'alternate' => __('Alternate', 'cardealer')
);

if (!isset($header_type)) {
	$header_type = 'classic';
}

?>
<input type="hidden" name="tmm_meta_saving" value="1" />

<div class="custom-page-options">

	<!-- Header Type -->
	<p>
		<strong><?php esc_html_e('Header Type', 'cardealer'); ?></strong>
	</p>

	<p>
		<select name="header_type" class="header_type">
			<?php foreach ($options as $key => $option) { ?>
				<option <?php echo($key == $header_type ? "selected" : "") ?> value="<?php echo esc_attr($key); ?>"><?php echo esc_html($option); ?></option>
			<?php } ?>
		</select>
	</p>

	<hr>

	<div class="title-bar-block"<?php echo $header_type === 'alternate' ? '' : ' style="display:none"' ?>>

		<p>
			<input type="checkbox" id="show_title_bar" name="show_title_bar" class="js_option_checkbox option_checkbox " <?php checked(intval($show_title_bar), 1); ?> value="<?php echo (int) $show_title_bar; ?>">
			<label for="show_title_bar" class="check"><strong><?php _e('Display Title Bar', 'cardealer') ?></strong></label>
		</p>

		<div class="title-bar-content"<?php echo $show_title_bar ? '' : ' style="display:none"' ?>>

			<p>
				<input type="text" name="alt_page_title" placeholder="<?php _e('Alternate Page Title', 'cardealer') ?>" value="<?php echo esc_attr($alt_page_title); ?>">
			</p>

			<p>
				<input type="text" name="page_subtitle" placeholder="<?php _e('Page Subtitle', 'cardealer') ?>" value="<?php echo esc_attr($page_subtitle); ?>">
			</p>

			<p>
				<strong><?php _e('Title Bar Background', 'cardealer'); ?></strong>
			</p>

			<p>
				<select name="title_bar_bg_type" id="title_bar_bg_type">
					<?php
					$types = array(
						"color" => __("Color", 'cardealer'),
						"image" => __("Image", 'cardealer'),
					);
					?>
					<?php foreach ($types as $key => $type) { ?>
						<option <?php selected($key, $title_bar_bg_type); ?> value="<?php echo $key; ?>"><?php echo $type; ?></option>
					<?php } ?>
				</select>
			</p>

			<div id="title_bar_bg_color"<?php echo $title_bar_bg_type === 'color' ? '' : ' style="display:none"' ?>>

				<div style="<?php echo $title_bar_bg_color ? 'background-color:'.$title_bar_bg_color.';' : ''; ?>" class="bgpicker"></div>
				<input type="text" class="bg_hex_color" value="<?php echo $title_bar_bg_color; ?>" name="title_bar_bg_color" />

			</div>

			<div id="title_bar_bg_image"<?php echo $title_bar_bg_type === 'image' ? '' : ' style="display:none"' ?>>

				<p>
					<input type="text" value="<?php echo $title_bar_bg_image; ?>" name="title_bar_bg_image" />
					<a href="#" class="button_upload body_pattern button" title="<?php _e('Browse', 'cardealer'); ?>">
						<?php _e('Browse', 'cardealer'); ?>
					</a>
				</p>

				<h4><?php _e('Set bg repeat option', 'cardealer'); ?>:</h4>

				<p>
					<select name="title_bar_bg_image_option">
						<?php
						$options = array(
							"repeat" => __("Repeat", 'cardealer'),
							"repeat-x" => __("Repeat-X", 'cardealer'),
							"fixed" => __("Fixed", 'cardealer'),
						);
						?>
						<?php foreach ($options as $key => $option) { ?>
							<option <?php selected($key, $title_bar_bg_image_option); ?> value="<?php echo $key; ?>"><?php echo $option; ?></option>
						<?php } ?>
					</select>
				</p>

			</div>

			<p>
				<a href="#" class="body_pattern button button_reset_title_bar_bg" title=""><?php _e('Reset', 'cardealer'); ?></a>
			</p>

		</div>

		<hr>

	</div>

	<!-- Hide Single Page Title -->
	<p>
		<strong><?php _e('Hide Default Page Title', 'cardealer'); ?></strong>
	</p>

	<p>
		<select name="hide_single_page_title">
			<?php
			$types = array(
				0 => __("No", 'cardealer'),
				1 => __("Yes", 'cardealer'),
			);

			if (!$hide_single_page_title) {
				$hide_single_page_title = 0;
			}
			?>
			<?php foreach ($types as $key => $type) : ?>
				<option <?php echo($key == $hide_single_page_title ? "selected" : "") ?> value="<?php echo $key; ?>"><?php echo $type; ?></option>
			<?php endforeach; ?>
		</select>
	</p>

	<hr>

	<!-- Page Background -->
	<p>
		<strong><?php _e('Page Background', 'cardealer'); ?></strong>
	</p>

	<div class="bg-type-option">

		<p>
			<select name="pagebg_type" class="pagebg_type">
				<?php
				$types = array(
					"color" => __("Color", 'cardealer'),
					"image" => __("Image", 'cardealer'),
				);

				if (!$pagebg_type) {
					$pagebg_type = "color";
				}
				?>
				<?php foreach ($types as $key => $type) : ?>
					<option <?php echo($key == $pagebg_type ? "selected" : "") ?> value="<?php echo $key; ?>"><?php echo $type; ?></option>
				<?php endforeach; ?>
			</select>
		</p>

	</div>

	<ul id="pagebg_type_options" class="page_type_options">

		<li id="pagebg_type_image">

			<p>
				<input type="text" value="<?php echo $pagebg_image; ?>" name="pagebg_image" class="pagebg_image" />
				<a href="#" class="button_upload body_pattern button" title="<?php _e('Browse', 'cardealer'); ?>">
					<?php _e('Browse', 'cardealer'); ?>
				</a>
			</p>

			<h4><?php _e('Set bg repeat option', 'cardealer'); ?>:</h4>

			<p>
				<select name="pagebg_type_image_option" class="pagebg_type_image_option">
					<?php
					$options = array(
						"repeat" => __("Repeat", 'cardealer'),
						"repeat-x" => __("Repeat-X", 'cardealer'),
						"fixed" => __("Fixed", 'cardealer'),
					);

					if (!$pagebg_type_image_option) {
						$pagebg_type_image_option = "repeat";
					}
					?>
					<?php foreach ($options as $key => $option) : ?>
						<option <?php echo($key == $pagebg_type_image_option ? "selected" : "") ?> value="<?php echo $key; ?>"><?php echo $option; ?></option>
					<?php endforeach; ?>
				</select>
			</p>

		</li>

		<li id="pagebg_type_color">

			<div style="<?php echo $pagebg_color ? 'background-color:'.$pagebg_color.';' : ''; ?>" class="bgpicker"></div>
			<input type="text" class="bg_hex_color" value="<?php echo $pagebg_color; ?>" name="pagebg_color" placeholder="" />

		</li>
	</ul>

	<p><a href="#" class="body_pattern button button_reset" title=""><?php _e('Reset', 'cardealer'); ?></a></p>

	<hr>

	<!-- Page Sidebar Position -->
	<?php
		if(!$page_sidebar_position){
			$page_sidebar_position = TMM::get_option('sidebar_position');
		}
	?>

	<p>
		<strong><?php _e('Page Sidebar Position', 'cardealer'); ?></strong>
	</p>

	<input type="hidden" value="<?php echo (!$page_sidebar_position ? "sbr" : $page_sidebar_position) ?>" name="page_sidebar_position" />

	<ul class="admin-page-choice-sidebar clearfix">
		<li class="lside <?php echo ($page_sidebar_position == "sbl" ? "current-item" : "") ?>"><a data-val="sbl" href="#"><?php _e('Left Sidebar', 'cardealer'); ?></a></li>
		<li class="wside <?php echo ($page_sidebar_position == "no_sidebar" ? "current-item" : "") ?>"><a data-val="no_sidebar" href="#"><?php _e('Without Sidebar', 'cardealer'); ?></a></li>
		<li class="rside <?php echo ($page_sidebar_position == "sbr" ? "current-item" : "") ?>"><a data-val="sbr" href="#"><?php _e('Right Sidebar', 'cardealer'); ?></a></li>
	</ul>

</div>

<script type="text/javascript">
	jQuery(document).ready(function() {

		jQuery("#pagebg_type_<?php echo $pagebg_type; ?>").show();

		jQuery("[name=pagebg_type]").on('change', function() {
			jQuery("#pagebg_type_options li").hide(200);
			jQuery("#pagebg_type_" + jQuery(this).val()).show(400);
		});

		jQuery(".header_type").on('change', function() {
			if (jQuery(this).val() === 'alternate') {
				jQuery('.title-bar-block').show(400);
			} else {
				jQuery('.title-bar-block').hide(200);
			}
		});

		jQuery("#show_title_bar").on('click', function() {
			if (jQuery(this).is(':checked')) {
				jQuery('.title-bar-content').show(300);
			} else {
				jQuery('.title-bar-content').hide(200);
			}
		});

		jQuery("#title_bar_bg_type").on('change', function() {
			if (jQuery(this).val() === 'color') {
				jQuery('#title_bar_bg_color').show(400);
				jQuery('#title_bar_bg_image').hide(200);
			} else {
				jQuery('#title_bar_bg_image').show(400);
				jQuery('#title_bar_bg_color').hide(200);
			}
		});

		jQuery('.button_reset_title_bar_bg').on('click', function()
		{
			jQuery("#title_bar_bg_color input, #title_bar_bg_image input").val('');
			jQuery("#title_bar_bg_color .bgpicker").css('backgroundColor', '');
			jQuery("#title_bar_bg_image select").val('repeat');
			return false;
		});

		jQuery('.button_reset').on('click', function()
		{
			jQuery("#pagebg_type_options input").val("");
			jQuery("#pagebg_type_options select").val(0);
			jQuery("#pagebg_type_options .bgpicker").css('backgroundColor', '');
			return false;
		});

	});
</script>