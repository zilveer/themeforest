<?php
/**
 * Counter shortcode template
 */
?>
<div class="qodef-countdown" id="countdown<?php echo esc_html($id); ?>" data-year="<?php echo esc_attr($year);?>" data-month="<?php echo esc_attr($month);?>" data-day="<?php echo esc_attr($day);?>" data-hour="<?php echo esc_attr($hour);?>" data-minute="<?php echo esc_attr($minute);?>" data-timezone="<?php echo get_option('gmt_offset'); ?>" data-month-label="<?php echo esc_html($month_label); ?>" data-day-label="<?php echo esc_html($day_label); ?>" data-hour-label="<?php echo esc_html($hour_label); ?>" data-minute-label="<?php echo esc_html($minute_label); ?>" data-second-label="<?php echo esc_html($second_label); ?>" data-digit-size="<?php echo esc_html($digit_font_size); ?>" data-label-size="<?php echo esc_html($label_font_size); ?>"></div>