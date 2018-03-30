<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * YIT_Faq_Filters_Widget
 *
 * Add a widget to get list of FAQ categories, created on FAQ custom type.
 *
 * @class Faq_Filters
 * @package	Yithemes
 * @since 1.0
 * @author Your Inspiration Themes
 */


    class YIT_Faq_Filters extends WP_Widget {

    /**
     * Constructor
     *
     * @return void
     * @since 1.0
     * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
     */
    function __construct() {
        $widget_ops = array(
            'classname'   => 'faq-filters',
            'description' => __( 'Get list of FAQ categories, created on FAQ custom type.', 'yit' )
        );

        $control_ops = array( 'id_base' => 'yit-faq-filters' );
        WP_Widget::__construct( 'yit-faq-filters', 'YIT Faq Filters', $widget_ops, $control_ops );

    }

    /**
     * Form
     *
     * Show the option panel of the widget
     * @param $instance
     *
     * @return void
     * @since  Version 1.0
     * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
     */
    function form( $instance ) {
        $defaults = array(
            'title'             => 'Faq Filters',
            'include'           => '',
            'project_post_type' => 0
        );
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>
        <p><label>
                <strong><?php _e( 'Widget Title', 'yit' ) ?>:</strong><br />
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
            </label></p>

        <p><label>
                <strong><?php _e( 'Categories IDs', 'yit' ) ?>:</strong><br />
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'include' ); ?>" name="<?php echo $this->get_field_name( 'include' ); ?>" value="<?php echo $instance['include']; ?>" />
                <span><?php _e( 'Type here the IDs of the categories you want to show. Separate them only with a comma. IE: 56,85,22', 'yit' ) ?></span>
            </label></p>
    <?php
    }

    /**
     * Widget
     *
     * Show output of the widget
     *
     * @param $args
     * @param $instance
     *
     * @return void
     * @since  Version 1.0
     * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
     */
    function widget( $args, $instance ) {
        extract( $args );

        $title = apply_filters( 'widget_title', $instance['title'] );

        echo $before_widget . '<div class="border">';
        echo '<div class="minus"></div>';
        echo $before_title . $title . $after_title;

        $faq = new WP_Query( "post_type=faq" );

        $cat_args = "taxonomy=category-faq&title_li=";

        if ( ! empty( $instance['include'] ) ) {
            $cat_args .= '&include=' . $instance['include'];
        }

        $cat = get_categories( $cat_args );

        if ( ! $faq->have_posts() ) {
            return false;
        } ?>
        <ul>
            <li>
                <a href="#all" data-option-value="*" class="active"><?php echo apply_filters( 'yit_faq_filters_categories_all', __( 'All', 'yit' ) ); ?></a>
            </li>
            <?php foreach ( $cat as $c ) :

                $thumbnail_id = get_metadata( 'faq_term', $c->term_id, 'thumbnail_id', true );
                $image        = wp_get_attachment_url( $thumbnail_id );
                $class_width_image = ( ! empty( $image ) ) ? 'with-image' : '';

                echo '<li class="'. $class_width_image .'">';
                if ( ! empty( $image ) ) {
                    echo '<img src="' . $image . '" />';
                }


                echo '<a href="#' . urldecode( sanitize_title( $c->slug ) ) . '" data-option-value=".' . urldecode( sanitize_title( $c->slug ) ) . '">' . $c->name . '</a></li>';
            endforeach ?>
        </ul>
        <?php

        echo '</div>' . $after_widget;
    }

    /**
     * Update
     *
     * save the options of widget
     *
     * @param $new_instance
     * @param $old_instance
     *
     * @return void
     * @since    Version 1.0
     * @author   Emanuela Castorina <emanuela.castorina@yithemes.it>
     */
    function update( $new_instance, $old_instance ) {
        $instance                      = $old_instance;
        $instance['title']             = strip_tags( $new_instance['title'] );
        $instance['include']           = strip_tags( $new_instance['include'] );
        $instance['project_post_type'] = $new_instance['project_post_type'];
        return $instance;
    }
}