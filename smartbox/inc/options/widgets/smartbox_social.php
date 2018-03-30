<?php
/**
 * Oxygenna.com
 *
 * $Template:: *(TEMPLATE_NAME)*
 * $Copyright:: *(COPYRIGHT)*
 * $Licence:: *(LICENCE)*
 */
require_once CORE_DIR . 'widget.php';

/**
 * Adds Caelus_title widget.
 */
class Smartbox_social extends OxyWidget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_options = array( 'description' => __( 'Social Icons Widget', THEME_ADMIN_TD) );
        parent::__construct( 'smartbox_social-options.php', false, $name = THEME_NAME . ' - ' . __('Social Icons Widget', THEME_ADMIN_TD), $widget_options );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        extract( $args );

        $new_window = $this->get_option( 'social_window', $instance, 'on');
        $target = $new_window == 'on' ? 'target="_blank"' : '';

        $output = $before_widget;
        $output.= '<ul class="unstyled inline small-screen-center big social-icons">';
        for( $i = 0 ; $i < 10 ; $i++ ) {
            $social_url = $this->get_option( 'social' . $i . '_url', $instance, '');
            $social_icon = $this->get_option( 'social' . $i . '_icon', $instance, '');

            $output .= empty( $social_icon ) ? '' : '<li><a ' . $target . ' data-iconcolor="' . oxy_get_icon_color( $social_icon ) . '" href="' . $social_url . '"><i class="' . $social_icon . '"></i></a></li>';
        }

        $output.= '</ul>';
        $output.= $after_widget;

        echo $output;
    }

}