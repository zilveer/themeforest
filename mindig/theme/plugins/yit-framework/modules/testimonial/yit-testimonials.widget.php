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
 * YIT_Testimonials_Widget
 *
 * Add a widget to get list of FAQ categories, created on FAQ custom type.
 *
 * @class Add a slider testimonial on your widget which link a category to show the contents.
 * @package    Yithemes
 * @since      1.0
 * @author     Your Inspiration Themes
 */
if( ! class_exists(  'YIT_Testimonials_Widget' ) ) {
class YIT_Testimonials_Widget extends WP_Widget {
    /**
     * Constructor
     *
     * @return void
     * @since  1.0
     * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
     */
    function __construct() {
        $widget_ops = array(
            'classname'   => 'testimonial-widget',
            'description' => __( 'Add a slider testimonial', 'yit' )
        );

        $control_ops = array( 'id_base' => 'testimonial-widget' );
        WP_Widget::__construct( 'testimonial-widget', 'Testimonial Widget', $widget_ops, $control_ops );
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

        wp_enqueue_script( 'owl-carousel' );
        wp_enqueue_script( 'yit-testimonial' );

        if ( ! isset( $instance['title'] ) ) {
            $instance['title'] = '';
        }

        if ( isset( $instance['icon_title'] ) && $instance['icon_title'] != '' ) {
            $img_title = '<img class="title-icon" src="' . $instance['icon_title'] . '" />';
        }
        else {
            $img_title = '';
        }

        $title = apply_filters( 'widget_title', $instance['title'] );


        $excerpt_length           = isset( $instance['excerpt_length'] ) ? $instance['excerpt_length'] : 55;

        $enable_slider            = isset( $instance['enable_slider'] ) ? $instance['enable_slider'] : false;
        $test_auto_play           = isset( $instance['test_auto_play'] ) ? $instance['test_auto_play'] : false;
        $test_navigation          = isset( $instance['test_navigation'] ) && ( $instance['test_navigation']=='true' || $instance['test_navigation']=='1' || $instance['test_navigation']=='yes') ? true : false;

        if( $enable_slider == "1" ) {
            $enable_slider = "true";
        }

        if( $test_auto_play == "1" ) {
            $test_auto_play = "true";
        }

        if( $test_navigation ) {
            $test_navigation = 'true';
        }   else {
            $test_navigation = 'false';
        }

        $test_pagination_speed_fx = isset( $instance['test_pagination_speed_fx'] ) ? $instance['test_pagination_speed_fx'] : 500;
        $test_speed_fx            = isset( $instance['test_speed_fx'] ) ? $instance['test_speed_fx'] : 500;
        $test_n_items             = isset( $instance['test_n_items'] ) ? $instance['test_n_items'] : 5;

        $test_posts = new WP_Query( "post_type=testimonial&posts_per_page=$test_n_items" );

        $out = '';
        if ( $test_posts->have_posts() ) {

            echo $before_widget;

            if ( $title ) {
                echo $before_title . $img_title . $title . $after_title;
            }

            $class_slider="slides owl-slider";
            if($enable_slider=="false") $class_slider="";

            $out .= '<div class="testimonial-text">';
            $out .= '<ul class="'.$class_slider.'" data-slidespeed="' . $test_speed_fx . '" data-paginationspeed="' . $test_pagination_speed_fx . '" data-navigation="' . $test_navigation . '" data-singleitem="true" data-autoplay="' . $test_auto_play . '">';
            while ( $test_posts->have_posts() ) {
                $test_posts->the_post();

                $out .= '<li><div>';

                if ( has_post_thumbnail() ) {
                    $out .= '<div class="image-container">' . yit_image( "post_id=".get_the_ID()."&size=blog_thumb&output=img",false ) . '</div>';
                }

                $label   = get_post_meta( get_the_ID(), '_yit_testimonial_social', true );
                $website = get_post_meta( get_the_ID(), '_yit_testimonial_website', true );

                if( $website !='' ||  $label !=''){
                    $website =  empty( $website ) ? ' - <span class="label-testimonial">' . $label . '</span>' : ' - <a class="url-testimonial" href="' . esc_url(
                        $website ) . '">' . ( ! empty( $label ) ? $label : $website ) . '</a>';
                }

                $out .= '<div class="name-testimonial"><p>' . get_the_title() .'<span class="website">' . $website . '</span> </p>';

                $rating  = get_post_meta( get_the_ID(), '_yit_testimonial_rating', true );
                if( $rating!=0 ){
                   $out .='<div class="testimonial-rating">
                        <span class="star-empty"><span class="star" style="width: '. ($rating*20) .'%"></span></span>
                    </div>';
                }

                $out .="</div>";

                $out .= '<div class="testimonial-description arrow">';

                $length = create_function( '', "return $excerpt_length;" );
                add_filter( 'excerpt_length', $length , 999);
                $out .= get_the_excerpt();
                remove_filter( 'excerpt_length', $length , 999);

                $out .= '</div>';


                $out .= '<div class="clear"></div>';
                $out .= '</div></li>';

            }
            $out .= '</ul>';
            $out .= '</div>';

            echo $out;
            echo $after_widget;
        }

        wp_reset_query();
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

        $instance                             = $old_instance;
        $instance['title']                    = strip_tags( $new_instance['title'] );
        $instance['icon_title']               = strip_tags( $new_instance['icon_title'] );
        $instance['test_n_items']             = $new_instance['test_n_items'];
        $instance['excerpt_length']           = $new_instance['excerpt_length'];
        $instance['enable_slider']           = $new_instance['enable_slider'];
        $instance['test_navigation']          = $new_instance['test_navigation'];
        $instance['test_auto_play']           = $new_instance['test_auto_play'];
        $instance['test_pagination_speed_fx'] = $new_instance['test_pagination_speed_fx'];
        $instance['test_speed_fx']            = $new_instance['test_speed_fx'];

        return $instance;
    }

    /**
     * Form
     *
     * Show the option panel of the widget
     *
     * @param array $instance
     *
     * @internal param array $args
     * @return void
     * @since    Version 1.0
     * @author   Emanuela Castorina <emanuela.castorina@yithemes.it>
     */
    function form( $instance ) {

        $defaults = array(
            'title'                    => 'Testimonials',
            'icon_title'               => '',
            'excerpt_length'           => 55,
            'enable_slider'           => true,
            'test_n_items'             => 5,
            'test_navigation'          => true,
            'test_auto_play'           => false,
            'test_pagination_speed_fx' => 400,
            'test_speed_fx'            => 300
        );


        $instance = wp_parse_args( (array) $instance, $defaults ); ?>

        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:
                <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
            </label>
        </p>

        <p>
            <label>
                <?php _e( 'Title Icon', 'yit' ); ?>:<br />
                <input type="text" id="<?php echo $this->get_field_id( 'icon_title' ); ?>" name="<?php echo $this->get_field_name( 'icon_title' ); ?>" value="<?php echo $instance['icon_title']; ?>" class="upload_img_url" />
                <input type="button" value="<?php _e( 'Upload', 'yit' ) ?>" id="<?php echo $this->get_field_id( 'icon_title' ); ?>-button" class="upload_button button" />
            </label>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'excerpt_length' ); ?>">Text lenght:
                <input type="text" id="<?php echo $this->get_field_id( 'excerpt_length' ); ?>" name="<?php echo $this->get_field_name( 'excerpt_length' ); ?>" value="<?php echo $instance['excerpt_length']; ?>" class="widefat" />
            </label>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'test_n_items' ); ?>">Items:
                <select id="<?php echo $this->get_field_id( 'test_n_items' ); ?>" name="<?php echo $this->get_field_name( 'test_n_items' ); ?>">
                    <?php for ( $i = 1; $i <= 20; $i ++ ) : ?>
                        <option value="<?php echo $i ?>" <?php selected( $instance['test_n_items'], $i ) ?>><?php echo $i ?></option>
                    <?php endfor ?>
                </select>
            </label>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'enable_slider' ); ?>">Enable Slider:
                <select id="<?php echo $this->get_field_id( 'enable_slider' ); ?>" name="<?php echo $this->get_field_name( 'enable_slider' ); ?>">
                    <option value="true" <?php selected( $instance['enable_slider'], 'true' ) ?>>yes</option>
                    <option value="false" <?php selected( $instance['enable_slider'], 'false' ) ?>>no</option>
                </select>
            </label>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'test_navigation' ); ?>">Navigation:
                <select id="<?php echo $this->get_field_id( 'test_navigation' ); ?>" name="<?php echo $this->get_field_name( 'test_navigation' ); ?>">
                    <option value="true" <?php selected( $instance['test_navigation'], 'true' ) ?>>yes</option>
                    <option value="false" <?php selected( $instance['test_navigation'], 'false' ) ?>>no</option>
                </select>
            </label>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'test_auto_play' ); ?>">Auto Play:
                <select id="<?php echo $this->get_field_id( 'test_auto_play' ); ?>" name="<?php echo $this->get_field_name( 'test_auto_play' ); ?>">
                    <option value="true" <?php selected( $instance['test_auto_play'], 'true' ) ?>>yes</option>
                    <option value="false" <?php selected( $instance['test_auto_play'], 'false' ) ?>>no</option>
                </select>
            </label>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'test_pagination_speed_fx' ); ?>">Pagination speed (ms):
                <input type="text" id="<?php echo $this->get_field_id( 'test_pagination_speed_fx' ); ?>" name="<?php echo $this->get_field_name( 'test_pagination_speed_fx' ); ?>" value="<?php echo $instance['test_pagination_speed_fx']; ?>" size="4" />
            </label>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'test_speed_fx' ); ?>">Speed Animation (ms):
                <input type="text" id="<?php echo $this->get_field_id( 'test_speed_fx' ); ?>" name="<?php echo $this->get_field_name( 'test_speed_fx' ); ?>" value="<?php echo $instance['test_speed_fx']; ?>" size="4" />
            </label>
        </p>
    <?php
    }
}
}