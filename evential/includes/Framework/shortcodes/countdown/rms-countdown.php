<?php
function countdown($atts)
{
    extract(shortcode_atts(array(
        'text'               	=> '',
        'content'               => '',
        'year'               	=> '',
        'month'               	=> '',
        'day'               	=> ''
    ), $atts));

		ob_start();
	?>
	<div class="countdown">
		<div class="col-lg-8 col-lg-offset-2 text-center">
			<h1 class="uppercase"><?php echo esc_html($text); ?></h1>
			<h3><?php echo esc_html($content); ?></h3>
		</div>
		
		<div class="col-md-4 col-lg-4 col-md-offset-4 text-center">
			<div id="countdown"></div>
		</div>
	</div>
	<script>
	jQuery(document).ready(function($) {
		'use strict';
		var newYear = new Date(); 
		newYear = new Date(newYear.getFullYear() + 1, 1 - 1, 1); 
		jQuery('#countdown').countdown({until: new Date(<?php echo esc_js($year); ?>, <?php echo esc_js($month); ?>-1, <?php echo esc_js($day); ?>)}); // enter event day
		jQuery('#removeCountdown').toggle(
			function() {
				jQuery(this).text('Re-attach'); 
				jQuery('#defaultCountdown').countdown('destroy'); 
			}, 
			function() { 
				jQuery(this).text('Remove'); 
				jQuery('#defaultCountdown').countdown({until: newYear}); 
			}
		);
	});
	</script>
	<?php
		$results = ob_get_clean();
		return $section_countdown = force_balance_tags( $results );
}
add_shortcode( "rms-countdown", "countdown" );