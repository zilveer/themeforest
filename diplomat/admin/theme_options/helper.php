<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

class TMM_OptionsHelper {

	public static $sections = array();

	public static function get_default_value($val){
		$default_values  = array(
			'website_width_px' => '1170',
			'website_width_per' => '63',

			'logo_font_size' => '34',
			'logo_font' => 'Roboto Slab',
			'logo_text_color' => '#262626',
			'splitted_logo_text' => 'Diplo^mat',
			'hlight_logo_text_color1' => '#262626',
			'hlight_logo_text_color2' => '#969696',
			'hdark_logo_text_color1' => '#fff',
			'hdark_logo_text_color2' => '#b4b4b4',

			'date_format' => 'd.m.Y',
			'excerpt_symbols_count' => '220',
			'blog_listing_show_all_metadata' => '1',
			'blog_listing_show_date' => '1',
			'blog_listing_show_author' => '1',
			'blog_listing_show_tags' => '1',
			'blog_listing_show_category' => '1',
			'blog_listing_show_comments' => '1',
			'blog_listing_show_likes' => '1',
			'blog_listing_effect' => 'slideUp2x',

			'blog_single_show_bio' => '1',
			'blog_single_show_comments' => '1',
			'blog_single_show_fb_comments' => '0',
			'blog_single_show_social_share' => '1',
			'blog_single_show_posts_nav' => '1',
			'blog_single_show_related_posts' => '1',
			'blog_single_show_related_posts_with_image' => '1',
			'blog_single_show_all_metadata' => '1',
			'blog_single_show_date' => '1',
			'blog_single_show_author' => '1',
			'blog_single_show_tags' => '1',
			'blog_single_show_category' => '1',
			'blog_single_show_likes' => '1',

			'gall_single_show_bio' => '1',
			'gall_single_show_social_share' => '1',
			'gall_single_show_posts_nav' => '1',
			'gall_single_show_all_metadata' => '1',
			'gall_single_show_likes' => '1',
			'gall_single_page' => '1',

			'general_elements' => '#14b3e4',
			'general_font_family' => 'Roboto Slab',
			'general_font_size' => '16',
			'general_text_color' => '#777',
			'general_normal_links_color' => '#777',
			'general_mouseover_links_color' => '#14b3e4',

			'header_top_bg_color' => '#e1e1e1',
			'header_bottom_bg_color' => '#f5f5f5',
			'header_bottom_bg_blue_color' => '#11547b',
			'body_pattern_selected' => '0',
			'body_bg_color' => '#f5f5f5',
			'body_pattern_custom_color' => '#f5f5f5',
			'general_footer_top_bg_color' => '#3a3a3c',
			'general_footer_bottom_bg_color' => '#313133',

			'h1_font_family' => 'Roboto Slab',
			'h1_font_size' => '34',
			'h1_font_color' => '#222222',

			'h2_font_family' => 'Roboto Slab',
			'h2_font_size' => '25',
			'h2_font_color' => '#222222',

			'h3_font_family' => 'Roboto Slab',
			'h3_font_size' => '18',
			'h3_font_color' => '#222222',

			'h4_font_family' => 'Roboto Slab',
			'h4_font_size' => '16',
			'h4_font_color' => '#222222',

			'h5_font_family' => 'Roboto Slab',
			'h5_font_size' => '16',
			'h5_font_color' => '#222222',

			'h6_font_family' => 'Roboto Slab',
			'h6_font_size' => '16',
			'h6_font_color' => '#222222',

			'main_nav_font' => 'Roboto',
			'main_nav_first_level_font_size' => '15',
			'main_nav_second_level_font_size' => '15',

			'main_nav_def_text_color' => '#424246',

			'main_nav_dd_def_text_color' => '#969696',
			'main_nav_dd_hover_bg_color' => '#f9f9f9',

			'content_normal_link_color' => '#14b3e4',
			'content_mouseover_link_color' => '#14b3e4',
			'donate_buttons_bg' => '#11547b',
			'pagination_bg' => '#11547b',
			'search_button_color' => '#11547b',

			'buttons_font_family' => 'Roboto',
			'buttons_font_size' => '18',

			'buttons_text_color' => '#000000',
			'buttons_border_color' => '#262626',
			'buttons_bg_color' => '#f5f5f5',

			'buttons_hover_text_color' => '#fff',
			'buttons_hover_border_color' => '',
			'buttons_hover_bg_color' => '#14b3e4',

			'widget_title_color' => '#fff',
			'widget_title_bg_color' => '#11547b',
			'widget_text_color' => '#777777',

			'footer_widget_title_color' => '#f2f2f2',
			'footer_widget_text_color' => '#959595',

			'featured_event_widget_title_bg_color' => '#14b3e4',
			'featured_event_widget_date_bg_color' => '#14b3e4'

		);
		return $default_values[$val];
	}


	/*
	 * Drawing theme option for admin panel
	 */

	public static function draw_theme_option($data, $prefix = TMM_THEME_PREFIX) {
		$value = "";

		if (isset($data['value'])) {
			$value = $data['value'];
		} else {
			$value = TMM::get_option($data['name'], $prefix);
		}

		if (!isset(TMM::$options[$data['name']]) && isset($data['default_value']) && !isset($data['value'])){

			$value = $data['default_value'];
		}

		switch ($data['type']) {
			case 'slider':
				?>
				<div class="option option-slider">

                    <h4 class="option-title"><?php echo esc_html($data['title']); ?></h4>

					<div class="controls">
						<input data-default-value="<?php echo esc_attr(@$data['default_value']); ?>" type="text" name="<?php echo esc_attr($data['name']); ?>" value="<?php echo esc_attr($value); ?>" min-value="<?php echo esc_attr($data['min']); ?>" max-value="<?php echo esc_attr($data['max']); ?>" class="ui_slider_item" />
					</div>

					<div class="explain"><?php echo esc_html($data['description']); ?></div>

				</div>
				<?php
				break;
			case 'text':
				?>
				<div class="option option-text">

					<h4 class="option-title"><?php echo esc_html($data['title']); ?></h4>

					<div class="controls">
						<input data-default-value="<?php echo esc_attr(@$data['default_value']); ?>" type="text" class="<?php echo esc_attr(@$data['css_class']); ?>" name="<?php echo esc_attr($data['name']); ?>" <?php if (!empty($data['placeholder'])){ echo 'placeholder="'.esc_attr($data['placeholder']).'"';} ?> value="<?php echo esc_attr($value); ?>">
					</div><!--/ .controls-->

					<div class="explain"><?php echo $data['description']; ?></div>

				</div>
				<?php
				break;
			case 'textarea':
				?>
				<div class="option option-textarea">

					<textarea data-default-value="<?php echo esc_attr(@$data['default_value']); ?>" name="<?php echo esc_attr($data['name']); ?>" class="<?php echo esc_attr($data['css_class']); ?>"><?php echo esc_attr($value); ?></textarea>

					<div class="explain">
						<?php echo esc_html($data['description']); ?>
					</div>

				</div>
				<?php
				break;
			case 'select':
				?>
				<div class="option option-select">

					<h4 class="option-title"><?php echo esc_html($data['title']); ?></h4>

					<div class="controls">
						<label class="sel">
							<select data-default-value="<?php echo esc_attr(@$data['default_value']); ?>" name="<?php echo esc_attr($data['name']); ?>" class="<?php echo esc_attr($data['css_class']); ?>">
								<?php if (!empty($data['values'])): ?>
									<?php foreach ($data['values'] as $key => $option_text) : ?>
										<option value="<?php echo esc_attr($key); ?>" <?php echo($value == $key ? 'selected=""' : "") ?>><?php echo esc_html($option_text); ?></option>
									<?php endforeach; ?>
								<?php endif; ?>
							</select>
						</label>
					</div>

					<div class="explain"><?php echo esc_html($data['description']); ?></div>

				</div>
				<?php
				break;
			case 'checkbox':
				?>
				<div class="option option-checkbox">

					<div class="controls">
						<input data-default-value="<?php echo esc_attr(@$data['default_value']); ?>" type="hidden" value="<?php echo esc_attr($value == 1 ? "1" : "0") ?>" name="<?php echo esc_attr($data['name']); ?>">
						<input type="checkbox" id="<?php echo esc_attr($data['name']); ?>" class="option_checkbox <?php echo esc_attr($data['css_class']); ?>" <?php echo($value == 1 ? "checked" : "") ?> />
						<label for="<?php echo esc_attr($data['name']); ?>"><span></span><?php echo esc_html($data['title']); ?></label>
					</div>

					<div class="explain">
						<?php echo esc_html($data['description']); ?>
					</div>

				</div>
				<?php
				break;
			case 'color':
				?>
				<div class="option option-color">

					<h4 class="option-title"><?php echo esc_html(@$data['title']); ?></h4>

					<div class="controls">
						<input data-default-value="<?php echo esc_attr(@$data['default_value']); ?>" value-index="0" type="text" class="bg_hex_color text small <?php echo esc_attr(@$data['css_class']) ?>" value="<?php echo esc_attr($value); ?>" name="<?php echo esc_attr($data['name']); ?>">
						<div class="bgpicker" style="background-color: <?php echo esc_attr($value); ?>"></div>

						<?php if (@$_GET['page'] == 'tmm_theme_options'): ?>
							<a href="javascript:void(0);" class="js_picker_val_back" title="Back"><?php esc_html_e('back', 'diplomat'); ?></a>&nbsp;
							<a href="javascript:void(0);" class="js_picker_val_ahead" title="Forward"><?php esc_html_e('forward', 'diplomat'); ?></a>&nbsp;
							<a href="javascript:void(0);" class="js_picker_val_reset" title="Reset"><?php esc_html_e('reset', 'diplomat'); ?></a>
						<?php endif; ?>
					</div>

					<div class="explain"><?php echo esc_html($data['description']); ?></div>

				</div>
				<?php
				break;

			case 'google_font_select':

					$fonts_array = tmm_get_fonts_array();
				?>
				<div class="option option-select-browse">

					<h4 class="option-title"><?php echo esc_html($data['title']); ?></h4>

					<div class="controls">
						<label class="sel">
							<select data-default-value="<?php echo esc_attr(@$data['default_value']); ?>" name="<?php echo esc_attr($data['name']); ?>" class="google_font_select">

								<?php foreach ($fonts_array as $font_name => $font_text){ ?>

									<option <?php echo ($font_name == $value ? "selected" : "") ?> value="<?php echo esc_attr($font_name); ?>"><?php echo esc_html($font_text); ?></option>

                                <?php } ?>

							</select>
						</label>
					</div>

					<div class="explain"><?php echo (isset($data['description'])) ? esc_html($data['description']) : ''; ?></div>

				</div>

				<?php
				break;

			case 'upload':
				?>
				<div class="option option-upload">

					<div class="controls">
						<input data-default-value="" <?php if (isset($data['id'])): ?>id="<?php echo esc_attr($data['id']); ?>"<?php endif; ?> class="middle" type="text" name="<?php echo esc_attr($data['name']); ?>" value="<?php echo esc_attr($value); ?>">
						<a class="admin-button button_upload" href="#"><?php esc_html_e('Browse', 'diplomat'); ?></a>
					</div>

					<div class="explain"><?php echo esc_html($data['description']); ?></div>

				</div>
				<?php
				break;

			default:
				_e('Option type does not exist!', 'diplomat');
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

	public static function get_theme_buttons() {
		return array(
			'default' => __('Default White', 'diplomat'),
			'default-blue' => __('Default Blue', 'diplomat')
		);
	}

	public static function get_theme_buttons_sizes() {
		return array(
			'small' => __('Small', 'diplomat'),
			'middle' => __('Middle', 'diplomat'),
			'large' => __('Large', 'diplomat'),
		);
	}

	public static function get_contacts_placeholder_icons() {
		return array(
			'' => "",
			'message-form-name' => __('Name', 'diplomat'),
			'message-form-email' => __('Email', 'diplomat'),
			'message-form-url' => __('URL', 'diplomat'),
			'message-form-message' => __('Message', 'diplomat')
		);
	}

}
