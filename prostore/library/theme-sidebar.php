<?php
/**
 * Theme Name: proStore
 * Theme URI: http://themeforest.net/user/gnrocks/portfolio
 * Theme demo : http://rchour.net/prostore
 * Description: A WordPress premium theme exclusively for sale on ThemeForest
 *
 * Author: gnrocks
 * Author URI: http://themeforest.net/user/gnrocks
 * License : http://codex.wordpress.org/GPL & http://wiki.envato.com/support/legal-terms/licensing-terms/
 *
 *
 * @package 	proStore/library/theme-sidebar.php
 * @file	 	1.0
 *
 *	1. Default sidebars
 *  2. Custom sidebars
 *
 */
?>
<?php
/**
 * ------------------------------------------------------------------------
 * 1.	Default sidebars
 * ------------------------------------------------------------------------
 */
	if ( ! function_exists( 'prostore_register_sidebars' ) ) {
		function prostore_register_sidebars() {
		    register_sidebar(array(
		    	'id' => 'sidebar1',
		    	'name' => 'Main Sidebar',
		    	'description' => 'Used on every page BUT the homepage page template.',
		    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
		    	'after_widget' => '</div>',
		    	'before_title' => '<h6 class="widgettitle"><span>',
		    	'after_title' => '</span></h6>',
		    ));

		    register_sidebar(array(
		    	'id' => 'sidebar2',
		    	'name' => 'Shop Sidebar',
		    	'description' => 'Used on shop pages',
		    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
		    	'after_widget' => '</div>',
		    	'before_title' => '<h6 class="widgettitle"><span>',
		    	'after_title' => '</span></h6>',
		    ));

		    for ($i=1;$i<=4;$i++) {
			    register_sidebar(array(
			    	'id' => 'footer-sidebar-'.$i,
			    	'name' => 'Footer Area '.$i,
			    	'description' => '',
			    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
			    	'after_widget' => '</div>',
			    	'before_title' => '<h6 class="widgettitle">',
			    	'after_title' => '</h6>',
			    ));
		    }
		} // don't remove this bracket!
		// adding sidebars to Wordpress (these are created in functions.php)
		add_action( 'widgets_init', 'prostore_register_sidebars' );
	}

/**
 * ------------------------------------------------------------------------
 * 2.	Custom sidebars
 * ------------------------------------------------------------------------
 */
	if ( ! function_exists( 'prostore_register_custom_sidebars' ) ) {
		function prostore_register_custom_sidebars() {
		    global $data, $prefix;

			$custom_sidebars = $data[$prefix.'sidebars'];

			$i=1;
			if(count($custom_sidebars) > 0 && !empty($custom_sidebars)) {
				foreach($custom_sidebars as $sidebar) {
					if ( function_exists('register_sidebar')) {
						register_sidebar( array(
				            'name' => $sidebar['title'],
				            'id' => generate_slug($sidebar['title'], 45),
				            'before_widget' => '<div id="%1$s" class="widget %2$s">',
				            'after_widget' => "</div>",
				            'before_title' => '<h6 class="widgettitle">',
				            'after_title' => '</h6>',
				        ) );
					}
				}
			}
		} // don't remove this bracket!
		add_action( 'widgets_init', 'prostore_register_custom_sidebars' );
	}