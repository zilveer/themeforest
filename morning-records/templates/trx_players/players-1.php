<?php

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'morning_records_template_players_1_theme_setup' ) ) {
	add_action( 'morning_records_action_before_init_theme', 'morning_records_template_players_1_theme_setup', 1 );
	function morning_records_template_players_1_theme_setup() { 
		morning_records_add_template(array(
			'layout' => 'players-1',
			'template' => 'players-1',
			'mode'   => 'players',
			/*'container_classes' => 'sc_slider_nopagination sc_slider_controls sc_slider_controls_bottom',*/
			'title'  => esc_html__('Players /Style 1/', 'morning-records'),
			'thumb_title'  => esc_html__('Medium square image (crop)', 'morning-records'),
			'w' => 440,
			'h' => 440
		));
	}
}

// Template output
if ( !function_exists( 'morning_records_template_players_1_output' ) ) {
	function morning_records_template_players_1_output($post_options, $post_data) { 
		$show_title = true;
		$parts = explode('_', $post_options['layout']);
		$style = $parts[0];
		$columns = max(1, min(12, empty($parts[1]) ? (!empty($post_options['columns_count']) ? $post_options['columns_count'] : 1) : (int) $parts[1]));
		if (morning_records_param_is_on($post_options['slider'])) {
			?><div class="swiper-slide" data-style="<?php echo esc_attr($post_options['tag_css_wh']); ?>" style="<?php echo esc_attr($post_options['tag_css_wh']); ?>"><?php
		} else if ($columns > 1) {
			?><div class="column-1_<?php echo esc_attr($columns); ?> column_padding_bottom"><?php
		}
		?>
			<div<?php echo !empty($post_options['tag_id']) ? ' id="'.esc_attr($post_options['tag_id']).'"' : ''; ?>
				class="sc_player sc_player_<?php echo esc_attr($post_options['number']) . ($post_options['number'] % 2 == 1 ? ' odd' : ' even') . ($post_options['number'] == 1 ? ' first' : '') . (!empty($post_options['tag_class']) ? ' '.esc_attr($post_options['tag_class']) : ''); ?>"
				<?php echo (!empty($post_options['tag_css']) ? ' style="'.esc_attr($post_options['tag_css']).'"' : '') 
					. (!morning_records_param_is_off($post_options['tag_animation']) ? ' data-animation="'.esc_attr(morning_records_get_animation_classes($post_options['tag_animation'])).'"' : ''); ?>>
				<div class="sc_player_avatar"><?php echo trim($post_options['photo']); ?>
					<div class="sc_player_hover">
						<?php
						if (!empty($post_options['socials']) && $post_options['socials'] != 'inherit'){?>
							<div class="sc_player_socials"><?php echo trim($post_options['socials']); ?></div>
						<?php } ?>
					</div>
				</div>
				<div class="sc_player_info">
					<h5 class="sc_player_title">
						<?php echo (!empty($post_options['link']) ? '<a href="'.esc_url($post_options['link']).'">' : '') . ($post_data['post_title']) . (!empty($post_options['link']) ? '</a>' : ''); ?>
					</h5>
					<?php
					if(!empty($post_options['club']) && $post_options['club'] != 'inherit'){?>
						<div class="sc_player_club">
							<?php echo trim($post_options['club']);?>
						</div>
					<?php } ?>
				</div>
			</div>
		<?php
		if (morning_records_param_is_on($post_options['slider']) || $columns > 1) {
			?></div><?php
		}
	}
}
?>