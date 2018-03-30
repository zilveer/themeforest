<?php 
	if ( function_exists( 'eo_get_events' ) ) {
		echo do_shortcode( "[eo_calendar  headerLeft='prev' headerCenter='title' headerRight='next']" ); 
	}
?>
<?php wp_cache_flush(); ?>