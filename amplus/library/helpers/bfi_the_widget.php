<?php
/**
 */

/**
 * Displays a widget (sidebar), use this instead of WP's the_widget
 *
 * @package API\WordPress Replacements
 * @see http://codex.wordpress.org/Function_Reference/the_widget Refer to 
 * WP Codex for a list of all possible values for $widget
 * @param string $widget a widget class name, e.g. "WP_Widget_Calendar"
 * @param array $instance the widget's instance settings
 * @param array $array sidebar arguments
 * @return null
 */
function bfi_the_widget($widget, $instance = array(), $args = array()) {
    global $wp_widget_factory;
    
    $widget_obj = $wp_widget_factory->widgets[$widget];
    $before_widget = sprintf('<article class="widget %s">', $widget_obj->widget_options['classname'] );
    
    // insert classname
    if (isset($args['before_widget'])) { 
        $args['before_widget'] = sprintf($args['before_widget'],
            $widget_obj->widget_options['classname'] );
    }
    
    if (!isset($args['before_widget'])) { $args['before_widget'] = $before_widget; }
    if (!isset($args['after_widget']))  { $args['after_widget']  = "</article>"; }
    if (!isset($args['before_title']))  { $args['before_title']  = "<h4>"; }
    if (!isset($args['after_title']))   { $args['after_title']   = "</h4><hr/>"; }
    
    the_widget($widget, $instance, $args);
}