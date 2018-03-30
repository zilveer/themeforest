<?php

/* ---------------------------------------------------------------------- */
/*	Options Framework Theme
/* ---------------------------------------------------------------------- */

// Load options panel
if ( !function_exists( 'optionsframework_init' ) ) {

	define( 'OPTIONS_FRAMEWORK_DIRECTORY', SS_BASE_URL . 'functions/admin/' );

	require_once( SS_BASE_DIR . 'functions/admin/options-framework.php' );
}

// Load custom scripts
function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery( document ).ready( function($) {

	// Project slider settings
	var	$projectUseCustomSpeed   = $('#ss_use_custom_project_slider_speed'),
		$projectCustomSpeed      = $('#section-ss_custom_project_slider_speed'),
		$projectUseCustomTimeout = $('#ss_use_custom_project_slider_timeout'),
		$projectCustomTimeout    = $('#section-ss_custom_project_slider_timeout');

	if( $projectUseCustomSpeed.is(':checked') )
		$projectCustomSpeed.show();

	$projectUseCustomSpeed.click(function() {
		$projectCustomSpeed.toggle();
	});

	if( $projectUseCustomTimeout.is(':checked') )
		$projectCustomTimeout.show();

	$projectUseCustomTimeout.click(function() {
		$projectCustomTimeout.toggle();
	});

	// Gallery slider settings
	var	$galleryUseCustomSpeed   = $('#ss_use_custom_gallery_slider_speed'),
		$galleryCustomSpeed      = $('#section-ss_custom_gallery_slider_speed'),
		$galleryUseCustomTimeout = $('#ss_use_custom_gallery_slider_timeout'),
		$galleryCustomTimeout    = $('#section-ss_custom_gallery_slider_timeout');

	if( $galleryUseCustomSpeed.is(':checked') )
		$galleryCustomSpeed.show();

	$galleryUseCustomSpeed.click(function() {
		$galleryCustomSpeed.toggle();
	});

	if( $galleryUseCustomTimeout.is(':checked') )
		$galleryCustomTimeout.show();

	$galleryUseCustomTimeout.click(function() {
		$galleryCustomTimeout.toggle();
	});
	
});

function googleFontPreview( option ){

	var dir      = '<?php echo OPTIONS_FRAMEWORK_DIRECTORY; ?>',
		dropDown = document.getElementById( option ),
		font     = dropDown.options[ dropDown.selectedIndex ].value; 

	if( font !== '' && font !== 'off' && font !== 'none' ){

		window.open( dir + 'font-preview.php?font=' + font );

	} else {

		alert("<?php _e('No font selected!', 'ss_framework'); ?>");

	}

}
</script>

<?php
}
add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

// This will enable few tags for theme options page's description field
if ( is_admin() ) {

	function updated_options_tags() {
		global $allowedtags;
		
		$allowedtags["input"] = array("type" => array(), "value" => array(), "onclick" => array(), "class" => array());
		$allowedtags["p"] = array();
	}	
	add_action('init', 'updated_options_tags', 10);
	
}