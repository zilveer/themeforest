<?php

/* Functions specific to the included option settings */



/*-----------------------------------------------------------------------------------*/
/* Output Google Font HTML
/*-----------------------------------------------------------------------------------*/

function theme_google_font() {
	if (of_get_option('google_font') != '') {
	echo '<link href="'. of_get_option('google_font_html') .'"  rel="stylesheet" type="text/css" />';
	}
}

add_action('wp_head', 'theme_google_font');

/*-----------------------------------------------------------------------------------*/
/* Output Custom CSS from theme options
/*-----------------------------------------------------------------------------------*/

function theme_head_css() {

		
		$custom_css = of_get_option('custom_css');
		$output = '';
		
		if ($custom_css <> '') {
			$output .= $custom_css . "\n";
		}
		
		// Output styles
		if ($output <> '') {
			$output = "<!-- Custom Styling -->\n<style type=\"text/css\">\n" . $output . "</style>\n";
			echo $output;
		}
	
}

add_action('wp_head', 'theme_head_css');


/*-----------------------------------------------------------------------------------*/
/* Add Favicon
/*-----------------------------------------------------------------------------------*/

function theme_favicon() {
	if (of_get_option('custom_favicon')) {
	echo '<link rel="shortcut icon" href="'. of_get_option('custom_favicon') .'"/>'."\n";
	}
}

add_action('wp_head', 'theme_favicon');


/*-----------------------------------------------------------------------------------*/
/* Show analytics code in footer */
/*-----------------------------------------------------------------------------------*/

function theme_analytics(){
	$output = of_get_option('analytics_code');
	if ( $output <> "" ) 
		echo stripslashes('<script type="text/javascript">'.$output.'</script>') . "\n";
}
add_action('wp_footer','theme_analytics');


?>