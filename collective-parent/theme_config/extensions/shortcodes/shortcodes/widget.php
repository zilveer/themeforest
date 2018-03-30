<?php
/**
 * Widget
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 * 
 * Optional arguments:
 * name:
 * instance:
 * args:
 * 
 * http://codex.wordpress.org/Function_Reference/the_widget
 */

function tfuse_widget($atts)
{
    global $wp_widget_factory;

    extract(shortcode_atts(array('name' => '', 'instance' => array(), 'args' => array()), $atts));

    $wp_class = esc_html($name);

    if ( !isset($wp_widget_factory->widgets[$wp_class]) || !is_a($wp_widget_factory->widgets[$wp_class], 'WP_Widget') )
    {
        $wp_class = 'WP_Widget_'.ucwords(strtolower($wp_class));
        
        if ( !isset($wp_widget_factory->widgets[$wp_class]) || !is_a($wp_widget_factory->widgets[$wp_class], 'WP_Widget') )
            return '<p>'.sprintf(__("%s: Widget class not found. Make sure this widget exists and the class name is correct",'tfuse'),'<strong>'.$wp_class.'</strong>').'</p>';
    }

    ob_start();
    the_widget($wp_class,$instance, $args);
    $output = ob_get_contents();
    ob_end_clean();

    return $output;

}
add_shortcode('widget', 'tfuse_widget');
