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
	                            	data-label_years = "<?php _e("Years", "loc_sport_core_plugin"); ?>"
	                            	data-label_months = "<?php _e("Months", "loc_sport_core_plugin"); ?>"
	                            	data-label_weeks = "<?php _e("Weeks", "loc_sport_core_plugin"); ?>"
	                            	data-label_days = "<?php _e("Days", "loc_sport_core_plugin"); ?>"
	                            	data-label_hours = "<?php _e("Hours", "loc_sport_core_plugin"); ?>"
	                            	data-label_minutes= "<?php _e("Minutes", "loc_sport_core_plugin"); ?>"
	                            	data-label_seconds = "<?php _e("Seconds", "loc_sport_core_plugin"); ?>"
	                            	
	                            	data-label_year = "<?php _e("Year", "loc_sport_core_plugin"); ?>"
	                            	data-label_month = "<?php _e("Month", "loc_sport_core_plugin"); ?>"
	                            	data-label_week = "<?php _e("Week", "loc_sport_core_plugin"); ?>"
	                            	data-label_day = "<?php _e("Day", "loc_sport_core_plugin"); ?>"
	                            	data-label_hour = "<?php _e("Hour", "loc_sport_core_plugin"); ?>"
	                            	data-label_minute= "<?php _e("Minute", "loc_sport_core_plugin"); ?>"
	                            	data-label_second = "<?php _e("Second", "loc_sport_core_plugin"); ?>"
	                            	
	                            	data-label_y = "<?php _e("Y", "loc_sport_core_plugin"); ?>"
	                            	data-label_m = "<?php _e("M", "loc_sport_core_plugin"); ?>"
	                            	data-label_w = "<?php _e("W", "loc_sport_core_plugin"); ?>"
	                            	data-label_d = "<?php _e("D", "loc_sport_core_plugin"); ?>"

	                            	data-datetime_string = "<?php echo $datetime_string; ?>"
	                            	data-gmt_offset = "<?php echo $gmt_offset; ?>"
	                            	data-format = "<?php echo $format; ?>"
	                            	data-use_compact = "<?php echo $use_compact; ?>"
	                            	data-description = '<?php echo $description; ?>'
	                            	data-layout = '<?php echo $layout; ?>'
	                            ></div>
