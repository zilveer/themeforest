<?php

if ( ! defined( 'ABSPATH' ) ) exit;


add_filter( 'widget_text', 'do_shortcode' );



// this overwrites the widget class and gives each widget area a new option to control the background color
add_filter( 'widget_display_callback', 'boutique_widget_display_callback', 11, 3 );
function boutique_widget_display_callback( $instance, $widget, $args ) {
	static $widget_count = 0;
	$widget_count++;
	if ( ! isset( $instance['boutique_widget_bg'] ) ) {
		$instance['boutique_widget_bg'] = 'default';
		// return $instance;
	}
	$widget_classname = $widget->widget_options['classname'];


	// widget style selector:
	if ( ! $instance['boutique_widget_bg'] ) {
		$instance['boutique_widget_bg'] = 'style0';
	}
	$instance['boutique_widget_bg'] = apply_filters('boutique_widget_bg',$instance['boutique_widget_bg'],$instance,$widget,$args);
	$my_classname = 'widget_boutique widget_'.$instance['boutique_widget_bg'];
	$my_classname .= ' widget_count_'.$widget_count;
	$args['before_widget'] = preg_replace( '#class="[^"]*'.preg_quote( $widget_classname,'#' ).'#', '$0 '.$my_classname, $args['before_widget'] );


	// widget header color picker:
	ob_start();
	if(isset($widget->id) && !empty($instance['boutique_widget_color'])) {
		$colors = array(
			'primary' => $instance['boutique_widget_color'],
		);
		$widget_classname .= ' widget_boutique_color';
		$widget_colors = apply_filters('boutique_widget_color',$colors,$widget,$args);
		// now choose how to apply the selected color
		// e.g. background or text color
		?>
		<style type="text/css">
			#<?php echo esc_attr($widget->id);?> .widget-title{
				color:<?php echo esc_html($widget_colors['primary']);?>;
			}
		</style>
		<?php
	}
	$style = ob_get_clean();
	$args['before_widget'] = $style . $args['before_widget'];




	$widget->widget( $args, $instance );

	return false;
}


function boutique_widgets_init() {

	// we pass widget registration off to the widget_area_manager plugin.
	$left_name = 'left'; // is_rtl() ? 'right' : 'left';
	$right_name = 'right' ; // is_rtl() ? 'left' : 'right';

	// add layout areas (ie: areas that can contain the widgets)
	do_action('widget_area_add_layouts',array(


		/**
		 * The main widget area.
		 * This displays on the left or right of every page on the website.
		 * It can also be "hidden", when hidden the page goes to full width.
		 */
		'main' => array(
			'name' => 'Left/Right Column',
			'default_widget_area' => array(
				'all'=>'main', // the main default area used for all pages
			),
			'default_position' => array(
				'all'=>'pos_left', // change to pos_left or hidden if you like.
			),
			'positions' => array(
				'pos_left' => array(
					'name' => 'Left',
					// hooks that are called from in our template with something like:
					// do_action('widget_area_manager_hook','before_content');
					// the special {WIDGETS} string will contain the selected widget_area
					'content_top' => '<div id="column_wrapper"><div class="content_main with-'.$left_name.'-sidebar"> <div class="content_main_wrap"> <div class="content_main_data">',
					'content_bottom' => '</div></div> <div class="sidebar sidebar-'.$left_name.' widget-area" role="complementary">{WIDGETS}</div> </div></div>',
				),
				'pos_right' => array(
					'name' => 'Right',
					// hooks that are called from in our template with something like:
					// do_action('widget_area_manager_hook','before_content');
					// the special {WIDGETS} string will contain the selected widget_area
					'content_top' => '<div id="column_wrapper"><div class="content_main with-'.$right_name.'-sidebar"> <div class="content_main_wrap"> <div class="content_main_data">',
					'content_bottom' => '</div></div> <div class="sidebar sidebar-'.$right_name.' widget-area" role="complementary">{WIDGETS}</div> </div></div>',
				),
				'pos_hidden' => array(
					'name' => 'Hidden',
					// hooks that are called from in our template with something like:
					// do_action('widget_area_manager_hook','before_content');
					// the special {WIDGETS} string will contain the selected widget_area
					'content_top' => '<div class="content_main no_sidebar">',
					'content_bottom' => '<div class="clear"></div></div>',
				),
			),
		),
		/**
		 * Along the header of the content area.
		 */
		'header' => array(
			'name' => 'Header',
			'default_widget_area' => 'headerarea1',
			'default_position' => 'pos_shown',
			'positions' => array(
				'pos_shown' => array(
					'name' => 'Full Page Width',
					// hooks that are called from in our template with something like:
					// do_action('widget_area_manager_hook','before_content');
					// the special {WIDGETS} string will contain the selected widget_area
					'header_boxes' => '<div id="header_widgets"><div class="widget-area">{WIDGETS}</div></div>',
				),
				'pos_hidden' => array(
					'name' => 'Hidden',
					'header_boxes' => '',
				),
			),
		),
		/**
		 * Along the footer of the content area.
		 */
		'footer' => array(
			'name' => 'Footer',
			'default_widget_area' => 'footerarea1',
			'default_position' => 'pos_columns',
			'positions' => array(
				'pos_full' => array(
					'name' => 'Full Page Width',
					// hooks that are called from in our template with something like:
					// do_action('widget_area_manager_hook','before_content');
					// the special {WIDGETS} string will contain the selected widget_area
					'footer' => '<div id="footer_widgets"><div class="widget-area columns-1" role="complementary">{WIDGETS}</div></div>',
				),
				'pos_columns' => array(
					'name' => '3 Columns',
					// hooks that are called from in our template with something like:
					// do_action('widget_area_manager_hook','before_content');
					// the special {WIDGETS} string will contain the selected widget_area
					'footer' => '<div id="footer_widgets"><div class="widget-area columns-3" role="complementary">{WIDGETS}</div></div>'
				),
				'pos_hidden' => array(
					'name' => 'Hidden',
					'footer' => '',
				),
			),
		),
		/** end hook area config */
	));

	// add the sidebars:
	$sidebars = array();

	// main sidebar, for the left/right area.
	$sidebars['main'] = array(
		'name' => __( "Sidebar Column #1", 'boutique-kids' ),
		'description' => 'This is the default widget group that can be displayed on the left or right of every page.',
		'id' => 'main',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget_header"></div><div class="widget_content">',
		'after_widget' => '</div><div class="widget_footer"></div></div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	);


	$number = get_option('_dtbaker_theme_optional_widget_count',8);
	for($x=2;$x<=$number;$x++){
		$sidebars['widget_area-'.$x] = array(
			'name' => 'Sidebar Column #'.$x,
			'id' => 'widget_area-'.$x,
			'description' => 'An empty sidebar for use on any page',
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget_header"></div><div class="widget_content">',
			'after_widget' => '</div><div class="widget_footer"></div></div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		);
	}

	$sidebars['footerarea1'] = array(
		'name' => __( "Footer Area #1", 'boutique-kids' ),
		'description' => 'This is the widget group that can be displayed at the very bottom of the website.',
		'id' => 'footerarea1',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget_header"></div><div class="widget_content">',
		'after_widget' => '</div><div class="widget_footer"></div></div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	);
	$sidebars['footerarea2'] = array(
		'name' => __( "Footer Area #2", 'boutique-kids' ),
		'description' => 'This is the widget group that can be displayed at the very bottom of the website.',
		'id' => 'footerarea2',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget_header"></div><div class="widget_content">',
		'after_widget' => '</div><div class="widget_footer"></div></div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	);
	$sidebars['headerarea1'] = array(
		'name' => __( "Header Area #1", 'boutique-kids' ),
		'description' => 'This is the widget group that can be displayed at the very top of the website.',
		'id' => 'headerarea1',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget_header"></div><div class="widget_content">',
		'after_widget' => '</div><div class="widget_header"></div></div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	);
	$sidebars['headerarea2'] = array(
		'name' => __( "Header Area #2", 'boutique-kids' ),
		'description' => 'This is the widget group that can be displayed at the very top of the website.',
		'id' => 'headerarea2',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget_header"></div><div class="widget_content">',
		'after_widget' => '</div><div class="widget_header"></div></div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	);

	do_action( 'widget_area_add_sidebars',$sidebars );
}
add_action( 'widgets_init', 'boutique_widgets_init' );


$GLOBALS['footer_widget_rows'] = false;
$GLOBALS['footer_widget_count'] = 0;
if ( ! is_admin() ) {
	add_action( 'dynamic_sidebar_before', 'boutique_dynamic_sidebar_before', 10, 2 );
	add_action( 'dynamic_sidebar_after', 'boutique_dynamic_sidebar_after', 10, 2 );
	function boutique_dynamic_sidebar_before( $index, $tf ) {
		if ( strpos( $index, 'footer' ) !== false ) {
			// we're about to output our footer widget. set a flag so we can do some special row wrapping
			$GLOBALS['footer_widget_rows'] = true;
		} else {
			$GLOBALS['footer_widget_rows'] = false;
		}
	}

	function boutique_dynamic_sidebar_after( $index, $tf ) {
		if ( strpos( $index, 'footer' ) !== false ) {
			if ( $GLOBALS['footer_widget_count'] > 0 ) {
				echo '</div> <!-- /footer_row close -->';
			}
		}
	}

	add_action( 'dynamic_sidebar_params', 'boutique_dynamic_sidebar_params', 10, 1 );
	function boutique_dynamic_sidebar_params( $params ) {
		if ( $GLOBALS['footer_widget_rows'] ) {
			if ( $GLOBALS['footer_widget_count'] == 0 ) {
				$params[0]['before_widget'] = '<div class="footer_row">' . $params[0]['before_widget'];
			}
			$GLOBALS['footer_widget_count'] ++;
			if ( $GLOBALS['footer_widget_count'] == 3 ) {
				$GLOBALS['footer_widget_count'] = 0;
				$params[0]['after_widget']      = $params[0]['after_widget'] . '</div> <!-- /footer_row -->';
			}
		}

		return $params;
	}

	add_action( 'admin_print_footer_scripts', 'dtbaker_widgets_admin_print_footer_scripts', 100 );
	function dtbaker_widgets_admin_print_footer_scripts() {
		?>
		<script type="text/javascript">
			jQuery('.boutique_widget_style_select').each(function () {
				jQuery(this).parent().parent().find('.widget-control-noform').show();
			});
		</script>
	<?php
	}
}


if ( is_readable( get_template_directory() . '/widgets/demo.php' ) ) {
	include_once( get_template_directory() . '/widgets/demo.php' );
}
if ( is_readable( get_template_directory() . '/widgets/opening_hours.php' ) ) {
	include_once( get_template_directory() . '/widgets/opening_hours.php' );
}
if ( is_readable( get_template_directory() . '/widgets/header_cart_woocommerce.php' ) ) {
	include_once( get_template_directory() . '/widgets/header_cart_woocommerce.php' );
}
if ( is_readable( get_template_directory() . '/widgets/woocommerce_currency.php' ) ) {
	include_once( get_template_directory() . '/widgets/woocommerce_currency.php' );
}

