<?php 

    // GET OPTIONS
    $canon_options_frame = get_option('canon_options_frame');

    $datetime_string = $canon_options_frame['countdown_datetime_string'];
    $gmt_offset = $canon_options_frame['countdown_gmt_offset'];
    $format = "dHMS";
    $use_compact = "unchecked";
    $description = $canon_options_frame['countdown_description'];
    $layout = '<strong>{desc}</strong> {dn} {dl} {hn} {hl} {mn} {ml} {sn} {sl}';

?>

	                            <div class="countdown"
	                            	data-label_years = "<?php _e("Years", "loc_canon"); ?>"
	                            	data-label_months = "<?php _e("Months", "loc_canon"); ?>"
	                            	data-label_weeks = "<?php _e("Weeks", "loc_canon"); ?>"
	                            	data-label_days = "<?php _e("Days", "loc_canon"); ?>"
	                            	data-label_hours = "<?php _e("Hours", "loc_canon"); ?>"
	                            	data-label_minutes= "<?php _e("Minutes", "loc_canon"); ?>"
	                            	data-label_seconds = "<?php _e("Seconds", "loc_canon"); ?>"
	                            	
	                            	data-label_year = "<?php _e("Year", "loc_canon"); ?>"
	                            	data-label_month = "<?php _e("Month", "loc_canon"); ?>"
	                            	data-label_week = "<?php _e("Week", "loc_canon"); ?>"
	                            	data-label_day = "<?php _e("Day", "loc_canon"); ?>"
	                            	data-label_hour = "<?php _e("Hour", "loc_canon"); ?>"
	                            	data-label_minute= "<?php _e("Minute", "loc_canon"); ?>"
	                            	data-label_second = "<?php _e("Second", "loc_canon"); ?>"
	                            	
	                            	data-label_y = "<?php _e("Y", "loc_canon"); ?>"
	                            	data-label_m = "<?php _e("M", "loc_canon"); ?>"
	                            	data-label_w = "<?php _e("W", "loc_canon"); ?>"
	                            	data-label_d = "<?php _e("D", "loc_canon"); ?>"

	                            	data-datetime_string = "<?php echo esc_attr($datetime_string); ?>"
	                            	data-gmt_offset = "<?php echo esc_attr($gmt_offset); ?>"
	                            	data-format = "<?php echo esc_attr($format); ?>"
	                            	data-use_compact = "<?php echo esc_attr($use_compact); ?>"
	                            	data-description = '<?php echo esc_attr($description); ?>'
	                            	data-layout = '<?php echo wp_kses_post($layout); ?>'
	                            ></div>
