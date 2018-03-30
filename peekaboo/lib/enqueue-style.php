<?php
/*********************
Enqueue the proper CSS
*********************/
if( ! function_exists( 'peekaboo_enqueue_style' ) ) {
	function peekaboo_enqueue_style()
	{
        global $smof_data;
		// foundation stylesheet
		wp_register_style( 'peekaboo-foundation-stylesheet', get_template_directory_uri() . '/assets/css/app.css', array(), '' );

        // Register the default theme style.css
        wp_register_style( 'theme-default-stylesheet', get_stylesheet_directory_uri() . '/style.css', array(), '', 'all' );

        // Register the main style
		wp_register_style( 'peekaboo-stylesheet', get_template_directory_uri() . '/assets/css/style.css', array(), '', 'all' );

        // Font icons
        wp_register_style('font-icons-social', get_template_directory_uri() . '/assets/css/fonticons/elusive.css', '', '');
        wp_register_style('font-icons-awesome', get_template_directory_uri() . '/assets/css/fonticons/font-awesome.css', '', '');

        wp_enqueue_style('font-icons-social');
        wp_enqueue_style('font-icons-awesome');

        wp_enqueue_style( 'vendor-styles', get_template_directory_uri() . '/assets/css/vendor-styles.css', array(), '' );

        // Flexslider and Venobox styles below are concatenated into vendor-styles.css.
        // Uncomment the code below to use the bower version of vendor script. Make sure run 'bower install'
        /*
         *  wp_enqueue_style( 'flexslider', get_template_directory_uri() . '/assets/bower_components/flexslider/flexslider.css', array(), '' );
            wp_enqueue_style( 'venobox', get_template_directory_uri() . '/assets/bower_components/venobox/venobox/venobox.css', array(), '' );
        */

        if ($smof_data['pkb_stylesheet'] !== 'default') {
            wp_register_style('peekaboo-foundation-custom-stylesheet', get_template_directory_uri() . '/assets/css/app-' . $smof_data['pkb_stylesheet'] . '.css', array(), '', 'all');
            wp_enqueue_style('peekaboo-foundation-custom-stylesheet');
        } else {
            wp_enqueue_style( 'peekaboo-foundation-stylesheet' );
        }

        if ($smof_data['pkb_stylesheet'] !== 'default') {
            wp_register_style('custom-stylesheet', get_template_directory_uri() . '/assets/css/style-' . $smof_data['pkb_stylesheet'] . '.css', array(), '', 'all');
            wp_enqueue_style('custom-stylesheet');
        } else {
            wp_enqueue_style('peekaboo-stylesheet');
        }
        wp_enqueue_style('theme-default-stylesheet');

	}
}
add_action( 'wp_enqueue_scripts', 'peekaboo_enqueue_style' );
?>