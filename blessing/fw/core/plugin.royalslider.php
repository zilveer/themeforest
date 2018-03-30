<?php
/* Royal Slider support functions
------------------------------------------------------------------------------- */

// Check if Royal Slider installed and activated
if ( !function_exists( 'ancora_exists_royalslider' ) ) {
	function ancora_exists_royalslider() {
		return class_exists("NewRoyalSliderMain");
		//return is_plugin_active('new-royalslider/newroyalslider.php');
	}
}
?>