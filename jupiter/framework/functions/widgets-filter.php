<?php
/**
 * Class Widget_Output_Filters
 * https://github.com/philipnewcomer/widget-output-filters
 *
 * Allows developers to filter the output of any WordPress widget.
 */
class Widget_Output_Filters {
	/**
	 * Contains the single instance of this class.
	 *
	 * @var Widget_Output_Filters
	 */
	private static $instance = null;
	/**
	 * Returns the single instance of this class.
	 *
	 * @return Widget_Output_Filters The single instance of this class.
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}
	/**
	 * Initializes the functionality by registering actions and filters.
	 */
	private function __construct() {
		// Priority of 9 to run before the Widget Logic plugin.
		add_filter( 'dynamic_sidebar_params', array( $this, 'filter_dynamic_sidebar_params' ), 9 );
	}
	/**
	 * Replaces the widget's display callback with the Dynamic Sidebar Params display callback, storing the original callback for use later.
	 *
	 * The $sidebar_params variable is not modified; it is only used to get the current widget's ID.
	 *
	 * @param array $sidebar_params The sidebar parameters.
	 *
	 * @return array The sidebar parameters
	 */
	public function filter_dynamic_sidebar_params( $sidebar_params ) {
		if ( is_admin() ) {
			return $sidebar_params;
		}
		global $wp_registered_widgets;
		$current_widget_id = $sidebar_params[0]['widget_id'];
		$wp_registered_widgets[ $current_widget_id ]['original_callback'] = $wp_registered_widgets[ $current_widget_id ]['callback'];
		$wp_registered_widgets[ $current_widget_id ]['callback'] = array( $this, 'display_widget' );
		return $sidebar_params;
	}
	/**
	 * Execute the widget's original callback function, filtering its output.
	 */
	public function display_widget() {
		global $wp_registered_widgets;
		$original_callback_params = func_get_args();
		$widget_id         = $original_callback_params[0]['widget_id'];
		$original_callback = $wp_registered_widgets[ $widget_id ]['original_callback'];
		$wp_registered_widgets[ $widget_id ]['callback'] = $original_callback;
		$widget_id_base = $original_callback[0]->id_base;
		$sidebar_id     = $original_callback_params[0]['id'];
		if ( is_callable( $original_callback ) ) {
			ob_start();
			call_user_func_array( $original_callback, $original_callback_params );
			$widget_output = ob_get_clean();
			/**
			 * Filter the widget's output.
			 *
			 * @param string $widget_output  The widget's output.
			 * @param string $widget_id_base The widget's base ID.
			 * @param string $widget_id      The widget's full ID.
			 * @param string $sidebar_id     The current sidebar ID.
			 */
			echo apply_filters( 'widget_output', $widget_output, $widget_id_base, $widget_id, $sidebar_id );
		}
	}
}

// Init
Widget_Output_Filters::get_instance();

// Filter native widgets here. Decouple to separate file if grows a little
function mk_filter_native_widgets( $widget_output, $widget_type, $widget_id, $sidebar_id ) {
	// echo 'Widget type: ' . $widget_type;
    $html = $widget_output;

    if ( 'calendar' == $widget_type ) {
    	$html = phpQuery::newDocument( $widget_output );
    	pq('#prev')->prepend(Mk_SVG_Icons::get_svg_icon_by_class_name(false, 'mk-icon-chevron-left', 14));
    	pq('#next')->prepend(Mk_SVG_Icons::get_svg_icon_by_class_name(false, 'mk-icon-chevron-right', 14));
    }

    if ( 'nav_menu' == $widget_type ) {
    	$html = phpQuery::newDocument( $widget_output );
    	pq('li:not(.menu-item-has-children) a')->prepend(Mk_SVG_Icons::get_svg_icon_by_class_name(false, 'mk-icon-angle-right', 14));
    }

    if ( 'meta' == $widget_type ) {
    	$html = phpQuery::newDocument( $widget_output );
    	pq('a')->prepend(Mk_SVG_Icons::get_svg_icon_by_class_name(false, 'mk-icon-angle-right', 14));
    }

    if ( 'rss' == $widget_type ) {
    	$html = phpQuery::newDocument( $widget_output );
    	pq('li a')->prepend(Mk_SVG_Icons::get_svg_icon_by_class_name(false, 'mk-icon-angle-right', 14));
    }

    if ( 'recent-comments' == $widget_type ) {
    	$html = phpQuery::newDocument( $widget_output );
    	pq('.recentcomments')->prepend(Mk_SVG_Icons::get_svg_icon_by_class_name(false, 'mk-icon-comment-o', 14));
    }

    return $html;
}
add_filter( 'widget_output', 'mk_filter_native_widgets', 10, 4 );