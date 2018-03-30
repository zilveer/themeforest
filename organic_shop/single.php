<?php
	
	if ( is_post_type( "accommodation" )) {
		load_template(get_template_directory().'/single-accommodation.php');
	}
	
	elseif ( is_post_type( "event" )) {
		load_template(get_template_directory().'/single-events.php');
	}
	
	elseif ( is_post_type( "gallery" )) {
		load_template(get_template_directory().'/single-gallery.php');
	}

	else {
		load_template(get_template_directory().'/single-default.php');
	}

?>