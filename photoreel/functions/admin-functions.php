<?php

/*-----------------------------------------------------------------------------------*/
/* Output HEAD - themnific_wp_head */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'themnific_wp_head' ) ) {
	function themnific_wp_head() {

		do_action( 'themnific_wp_head_before' );

		// Favicon
		if(get_option('themnific_custom_favicon') != '') {
	        echo '<link rel="shortcut icon" href="'.  get_option('themnific_custom_favicon')  .'"/>'."\n";
	    }   

		// Output shortcodes stylesheet
		if ( function_exists( 'tmnf_shortcode_stylesheet' ) )
			tmnf_shortcode_stylesheet();
			

			
		do_action( 'themnific_wp_head_after' );
		
		

	} // End themnific_wp_head()
}



add_action( 'wp_head', 'themnific_wp_head', 10 );


/*-----------------------------------------------------------------------------------*/
/* Get the style path currently selected */
/*-----------------------------------------------------------------------------------*/
function fiftytwo_style_path() {
    $style = $_REQUEST[style];
    if ($style != '') {
        $style_path = $style;
    } else {
        $stylesheet = get_option('themnific_alt_stylesheet');
        $style_path = str_replace(".css","",$stylesheet);
    }
    if ($style_path == "default")
      echo 'images';
    else
      echo 'styles/'.$style_path;
}


/*-----------------------------------------------------------------------------------*/
/* Show analytics code in footer */
/*-----------------------------------------------------------------------------------*/
function themnific_analytics(){
	$output = get_option('themnific_google_analytics');
	if ( $output <> "" ) 
		echo stripslashes($output) . "\n";
}
add_action('wp_footer','themnific_analytics');

/*-----------------------------------------------------------------------------------*/
/* THE END */
/*-----------------------------------------------------------------------------------*/
?>