<?php
$featured_slide_type=of_get_option('featured_style');
//$featured_slide_type="flexislider";

if ( DEMO_STATUS  ) { 
	if ( isset( $_GET['demo_featured'] ) ) $_SESSION['demo_featured']=$_GET['demo_featured'];
	if ( isset($_SESSION['demo_featured'] )) $featured_slide_type = $_SESSION['demo_featured'];
}
	
Switch ( $featured_slide_type ) {
	case "flexislider" :
		wp_enqueue_script( 'flexislider', MTHEME_JS . '/flexislider/jquery.flexslider-min.js', array('jquery') , '',true );
		wp_enqueue_style( 'flexislider_css', MTHEME_ROOT . '/css/flexislider/flexslider.css', false, 'screen' );
		break;
}
?>