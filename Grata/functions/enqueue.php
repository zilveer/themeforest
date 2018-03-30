<?php


function us_fonts() {
	global $smof_data;
	$protocol = is_ssl() ? 'https' : 'http';

	if (empty($smof_data['font_subset'])) {
		$subset = '';
	} else {
		$subset = '&subset='.$smof_data['font_subset'];
	}

	if ($smof_data['body_text_font'] != '' AND $smof_data['body_text_font'] != 'none')
	{

		wp_enqueue_style( 'us-body-text-font', "$protocol://fonts.googleapis.com/css?family=".str_replace(' ', '+', $smof_data['body_text_font']).":400,300,600,700".$subset );
	}
	else
	{
		wp_enqueue_style( 'us-body-text-font', "$protocol://fonts.googleapis.com/css?family=PT+Sans:400,300,600,700".$subset );
	}


	if ($smof_data['body_text_font'] != $smof_data['navigation_font'] AND $smof_data['navigation_font'] != '' AND $smof_data['navigation_font'] != 'none')
	{
		wp_enqueue_style( 'us-navigation-font', "$protocol://fonts.googleapis.com/css?family=".str_replace(' ', '+', $smof_data['navigation_font']).":400,300,600,700".$subset );
	}

	if ($smof_data['heading_font'] != '' AND $smof_data['heading_font'] != 'none')
	{

		wp_enqueue_style( 'us-heading-font', "$protocol://fonts.googleapis.com/css?family=".str_replace(' ', '+', $smof_data['heading_font']).":400,300,600,700".$subset );
	}
	else
	{
		wp_enqueue_style( 'us-heading-font', "$protocol://fonts.googleapis.com/css?family=Titillium+Web:400,300,600,700".$subset );
	}


}
add_action( 'wp_enqueue_scripts', 'us_fonts' );

function us_styles()
{
	$template_directory_uri = str_replace( array( 'http:', 'https:' ), '', get_template_directory_uri() );

	wp_register_style('motioncss', $template_directory_uri . '/css/motioncss.css', array(), '1', 'all');
	wp_register_style('motioncss-responsive', $template_directory_uri . '/css/motioncss-responsive.css', array(), '1', 'all');
	wp_register_style('font-awesome', $template_directory_uri . '/css/font-awesome.css', array(), '4.4.0', 'all');
	wp_register_style('magnific-popup', $template_directory_uri . '/css/magnific-popup.css', array(), '1', 'all');
	wp_register_style('slick', $template_directory_uri . '/slick/slick.css', array(), '1', 'all');
	wp_register_style('style', $template_directory_uri . '/css/style.css', array(), '1', 'all');
	wp_register_style('responsive', $template_directory_uri . '/css/responsive.css', array(), '1', 'all');

	wp_enqueue_style('motioncss');
	wp_enqueue_style('motioncss-responsive');
	wp_enqueue_style('font-awesome');
	wp_enqueue_style('magnific-popup');
	wp_enqueue_style('slick');
	wp_enqueue_style('style');
	wp_enqueue_style('responsive');

	wp_enqueue_style( 'wp-mediaelement' );
	wp_enqueue_script( 'wp-mediaelement' );

}
add_action('wp_enqueue_scripts', 'us_styles', 12);

function us_custom_styles()
{
	global $of_options, $smof_data;
	// Resave theme custom CSS if the theme was updated
	$theme_version = us_get_main_theme_version();
	$last_custom_css_version = get_option('us_custom_css_version');
	if (empty($last_custom_css_version) OR version_compare($last_custom_css_version, $theme_version, '<')){
		$options_machine = new Options_Machine($of_options);
		$smof_data = array_merge($options_machine->Defaults, $smof_data);
		of_save_options($smof_data);
		us_save_styles($smof_data);
		update_option('us_custom_css_version', $theme_version);
	}

	$wp_upload_dir  = wp_upload_dir();
	$styles_dir = $wp_upload_dir['basedir'].'/us_custom_css';
	$styles_dir = str_replace('\\', '/', $styles_dir);
	$styles_file = $styles_dir.'/us_grata_custom_styles.css';

	if (file_exists($styles_file))
	{
		wp_register_style('us_custom_css', $wp_upload_dir['baseurl'] . '/us_custom_css/us_grata_custom_styles.css', array(), '1', 'all');
		wp_enqueue_style('us_custom_css');
	}
	else
	{
		global $load_styles_directly;
		$load_styles_directly = true;
	}

	if(get_template_directory_uri() !=  get_stylesheet_directory_uri())
	{
		wp_register_style( 'grata-style' ,  str_replace( array( 'http:', 'https:' ), '', get_stylesheet_directory_uri() ) . '/style.css', array(), '1', 'all' );
		wp_enqueue_style( 'grata-style');
	}
}
add_action('wp_enqueue_scripts', 'us_custom_styles', 17);

function us_jscripts()
{
	$template_directory_url = str_replace( array( 'http:', 'https:' ), '', get_template_directory_uri() );

	wp_register_script('us-jquery-easing', $template_directory_url.'/js/jquery.easing.min.js', array('jquery'), '', TRUE);
	wp_enqueue_script('us-jquery-easing');

	wp_register_script('us-isotope', $template_directory_url.'/js/jquery.isotope.js', array('jquery'), '', TRUE);
	wp_enqueue_script('us-isotope');

	wp_register_script('us-slick', $template_directory_url.'/slick/slick.min.js', array('jquery'), '', TRUE);
	wp_enqueue_script('us-slick');

	wp_register_script('us-magnific-popup', $template_directory_url.'/js/jquery.magnific-popup.js', array('jquery'), '', TRUE);
	wp_enqueue_script('us-magnific-popup');

	wp_register_script('us-google-maps', '//maps.google.com/maps/api/js?sensor=false', array(), '', FALSE);
	wp_register_script('us-gmap', $template_directory_url.'/js/jquery.gmap.min.js', array('jquery'), '', TRUE);
	wp_enqueue_script('us-google-maps');
	wp_enqueue_script('us-gmap');


	wp_register_script('us-parallax', $template_directory_url.'/js/jquery.parallax.js', array('jquery'), '', TRUE);
	wp_register_script('us-hor-parallax', $template_directory_url.'/js/jquery.horparallax.js', array('jquery'), '', TRUE);
	wp_enqueue_script('us-parallax');
	wp_enqueue_script('us-hor-parallax');

	wp_register_script('us-responsive', $template_directory_url.'/js/responsive.js', array('jquery'), '', TRUE);
	wp_enqueue_script('us-responsive');

	wp_register_script('us-waypoints', $template_directory_url.'/js/waypoints.min.js', array('jquery'), '', TRUE);
	wp_enqueue_script('us-waypoints');

	wp_register_script('us-imagesloaded', $template_directory_url.'/js/imagesloaded.js', array('jquery'), '', TRUE);
	wp_enqueue_script('us-imagesloaded');

	wp_register_script('us-mediaelement', $template_directory_url.'/js/mediaelement-and-player.js', array('jquery'), '', TRUE);
	wp_enqueue_script('us-mediaelement');

	wp_register_script('us-plugins', $template_directory_url.'/js/plugins.js', array('jquery'), '', TRUE);
	wp_register_script('us-widgets', $template_directory_url.'/js/us.widgets.js', array('jquery'), '', TRUE);
	wp_enqueue_script('us-plugins');
	wp_enqueue_script('us-widgets');

	wp_enqueue_script('comment-reply');
}
add_action('wp_enqueue_scripts', 'us_jscripts');
