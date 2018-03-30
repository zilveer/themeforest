<?php


function mk_menus_hook() {

	wp_enqueue_script( 'mk-menus-scripts', THEME_ADMIN_ASSETS_URI . '/js/min/mk-menus-scripts.js', array( 'jquery' ), false, true );
	wp_enqueue_style( 'mk-menus-styles', THEME_ADMIN_ASSETS_URI . '/stylesheet/css/min/mk-menus-styles.css' );
    wp_enqueue_media();
}


if ( mk_theme_is_menus() ) {
	add_action( 'admin_init', 'mk_menus_hook' );
    add_action( 'admin_notices', 'mk_compatibility_check_menus' );
    add_action( 'network_admin_notices', 'mk_compatibility_check_menus' );
}

if( mk_theme_is_themes()) {
    add_action( 'admin_notices', 'mk_compatibility_check_menus' );
    add_action( 'network_admin_notices', 'mk_compatibility_check_menus' );
}

function mk_compatibility_check_menus () {
    $compatibility = new Compatibility();
    $compatibility->setSchedule('off');
    $compatibility_response = $compatibility->compatibilityCheck();
    echo $compatibility_response;

}
function mk_detect_count_post_vars() {

	if( isset( $_POST['save_menu'] ) ){

		$count = 0;
		foreach( $_POST as $key => $arr ){
			$count+= count( $arr );
		}

		update_option( 'mk_detect-post-var-count' , $count );
	}
	else{
		$count = get_option( 'mk_detect-post-var-count' , 0 );
	}

	return $count;
}
