<?php
// Get the featured slides
$featured_slide_type=of_get_option('featured_style');
if ( DEMO_STATUS  ) { 
	if ( isset( $_GET['demo_featured'] ) ) $_SESSION['demo_featured']=$_GET['demo_featured'];
	if ( isset($_SESSION['demo_featured'] )) $featured_slide_type = $_SESSION['demo_featured'];
}

Switch ( $featured_slide_type ) {
	case "flexislider" :
		get_template_part ('/includes/featured/flexislider');
		break;
	case "video" :
		get_template_part ( '/includes/featured/static-video');
		break;
	case "image" :
		get_template_part ( '/includes/featured/static-image');
		break;
}
?>