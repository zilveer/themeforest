<?php

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'morning_records_template_events_2_theme_setup' ) ) {
	add_action( 'morning_records_action_before_init_theme', 'morning_records_template_events_2_theme_setup', 1 );
	function morning_records_template_events_2_theme_setup() {
		morning_records_add_template(array(
			'layout' => 'events-2',
			'template' => 'events-2',
			'mode'   => 'events',
			'title'  => esc_html__('Events /Style 2/', 'morning-records')
		));
	}
}

// Template output
if ( !function_exists( 'morning_records_template_events_2_output' ) ) {
	function morning_records_template_events_2_output($post_options, $post_data) {
		$show_title = true;
		$parts = explode('_', $post_options['layout']);
		$style = $parts[0];
		$columns = max(1, min(12, empty($parts[1]) ? (!empty($post_options['columns_count']) ? $post_options['columns_count'] : 1) : (int) $parts[1]));
		$start_date = explode('|', tribe_get_start_date(null, true, 'M,d|'.get_option('time_format')));
		$end_date = explode('|', tribe_get_end_date(null, true, 'M,d|'.get_option('time_format')));
		$sd = explode(',', $start_date[0]);
		if (tribe_event_is_all_day()) $start_date[1] = $end_date[1] = '';
		?>
		<div<?php echo !empty($post_options['tag_id']) ? ' id="'.esc_attr($post_options['tag_id']).'"' : ''; ?>
			class="sc_events_item sc_events_item_<?php echo esc_attr($post_options['number']) . ($post_options['number'] % 2 == 1 ? ' odd' : ' even') . ($post_options['number'] == 1 ? ' first' : '') . (!empty($post_options['tag_class']) ? ' '.esc_attr($post_options['tag_class']) : ''); ?>"
			<?php echo (!empty($post_options['tag_css']) ? ' style="'.esc_attr($post_options['tag_css']).'"' : '') 
				. (!morning_records_param_is_off($post_options['tag_animation']) ? ' data-animation="'.esc_attr(morning_records_get_animation_classes($post_options['tag_animation'])).'"' : ''); ?>
			>
			<span class="sc_events_item_date">
				<span class="sc_events_item_month"><?php echo trim($sd[0]); ?></span>
				<span class="sc_events_item_day"><?php echo trim($sd[1]); ?></span>
			</span><?php
			if ($show_title) {
				if ((!isset($post_options['links']) || $post_options['links']) && !empty($post_data['post_link'])) {
					?><h6 class="sc_events_item_title"><a href="<?php echo esc_url($post_data['post_link']); ?>"><?php echo trim($post_data['post_title']); ?></a></h6><?php
				} else {
					?><h6 class="sc_events_item_title"><?php echo trim($post_data['post_title']); ?></h6><?php
				}
			}
			?><span class="sc_events_item_time"><?php
				echo (trim($start_date[1]) ? $start_date[1] : esc_html__('Whole day', 'morning-records'))
						. ($start_date[0]==$end_date[0] && trim($start_date[1]) && trim($end_date[1]) ? ' - ' . $end_date[1] : '');
			?></span><span class="sc_events_item_details"><?php
				if ((!isset($post_options['links']) || $post_options['links']) && !empty($post_data['post_link'])) {
					?><a href="<?php echo esc_url($post_data['post_link']); ?>"><?php echo trim($post_options['readmore']); ?></a><?php
				}
			?></span>
		</div>
		<?php
	}
}
?>