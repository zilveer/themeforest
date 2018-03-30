<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Widget for yit-newsletter
 *
 * @package Yithemes
 * @since   1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

/**
 * YIT_Newsletter_Form
 *
 * Add a widget to show a custom newsletter subscription form in the sidebar
 *
 * @class YIT_Newsletter_Form
 * @package Yithemes
 * @since   Version 1.0.0
 * @author  Your Inspiration Themes
 */
class YIT_Newsletter_Form extends WP_Widget {

    /**
     * Constructor
     *
     * Constructor method of the class. Create a WP_Widget instance
     *
     * @since  1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     * @author Francesco Licandro <francesco.licandro@yithemes.it>
     */
    public function __construct() {

        $widget_ops = array(
            'classname'   => 'newsletter-form',
            'description' => __( 'Add a newsletter subscription form', 'yit' )
        );

        $control_ops = array(
            'id_base' => 'yit-newsletter-form'
        );

        WP_Widget::__construct( 'yit-newsletter-form', __( 'YIT Newsletter Form', 'yit' ), $widget_ops, $control_ops );
    }

    /**
     * Form
     *
     * Show the option panel of the widget
     *
     * @param $instance
     *
     * @return void
     * @since  Version 1.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     * @author Francesco Licandro <francesco.licandro@yithemes.it>
     */
    public function form( $instance ) {
        $defaults = array(
            'title'       => '',
            'subtitle'    => '',
            'icon_form'   => '-1',
            'post_name'   => '-1',
            'text'        => '',
            'with_border' => 'yes',
            'button_class' => ''
        );

        $instance = wp_parse_args( (array) $instance, $defaults );

        $instance['title'] = strip_tags($instance['title']);
        $instance['text'] = esc_textarea($instance['text']);

        $icons = YIT_Plugin_Common::get_awesome_icons();

        $posts = get_posts( array(
            'posts_per_page' => - 1,
            'post_type'      => YIT_Newsletter()->newsletter_post_type
        ) );
        ?>
        <p>
            <label>
                <strong><?php _e( 'Widget Title', 'yit' ) ?>:</strong><br />
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
            </label>
        </p>
        <p>
            <label>
                <strong><?php _e( 'Widget Subtitle', 'yit' ) ?>:</strong><br />
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'subtitle' ); ?>" name="<?php echo $this->get_field_name( 'subtitle' ); ?>" value="<?php echo $instance['subtitle']; ?>" />
            </label>
        </p>
        <p>
            <label>
                <strong><?php _e( 'Newsletter Form', 'yit' ) ?>:</strong>
            </label>
            <select id="<?php echo $this->get_field_id( 'post_name' ); ?>" name="<?php echo $this->get_field_name( 'post_name' ); ?>">
                <option value="-1">Select your option</option>
                <?php
                foreach ( $posts as $post ):
                    ?>
                    <option value="<?php echo $post->post_name ?>" <?php selected( $post->post_name, $instance['post_name'] )?> ><?php echo ( strcmp( $post->post_title, '' ) != 0 ) ? $post->post_title : $post->post_name ?></option>
                <?php
                endforeach;
                ?>
            </select>
        </p>
        <p>
            <label>
                <strong><?php _e( 'Newsletter Form Icon', 'yit' )?>:</strong>
                <select id="<?php echo $this->get_field_id( 'icon_form' ) ?>" name="<?php echo $this->get_field_name( 'icon_form' ); ?>">
                    <option value="-1">Select your option</option>
                    <?php
                    foreach ( $icons as $id => $icon ) :
                        ?>
                        <option value="<?php echo $id ?>" <?php selected( $id, $instance['icon_form'] )?> ><?php echo $icon ?></option>
                    <?php
                    endforeach;
                    ?>
                </select>
            </label>
        </p>
        <p>
            <label>
                <strong><?php _e( 'Form Border', 'yit' ) ?></strong>
                <select id="<?php echo $this->get_field_id( 'with_border' ) ?>" name="<?php echo $this->get_field_name( 'with_border' ) ?>">
                    <option value="yes" <?php selected( 'yes', $instance['with_border'] ) ?> ><?php _e( 'Yes', 'yit' ) ?></option>
                    <option value="no" <?php selected( 'no', $instance['with_border'] ) ?> ><?php _e( 'No', 'yit' ) ?></option>
                </select>
            </label>
        </p>
        <p>
            <label>
                <strong><?php _e( 'Button Class', 'yit' ) ?></strong>
                <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'button_class' ) ?>" name="<?php echo $this->get_field_name( 'button_class' ) ?>" value="<?php echo $instance['button_class'] ?>">
            </label>
        </p>
        <p>
            <label>
                <strong><?php _e( 'Widget Text', 'yit' ) ?>:</strong><br />
                <textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $instance['text']; ?></textarea>

            </label>
        </p>
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
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     * @author Francesco Licandro <francesco.licandro@yithemes.it>
     */
    public function widget( $args, $instance ) {
        extract( $args );
        $args['title']       = apply_filters( 'widget_title', $instance['title'] );
        $args['subtitle']    = apply_filters( 'widget_subtitle', $instance['subtitle'] );
        $args['icon_form']   = $instance['icon_form'];
        $args['post_name']   = $instance['post_name'];
        $args['with_border'] = isset( $instance['with_border'] ) ? $instance['with_border'] : '';
        $args['widget']      = true;
        $args['text']        = empty( $instance['text'] ) ? '' : $instance['text'];
        $args['button_class'] = isset( $instance['button_class'] ) ? $instance['button_class'] : '';
        $class = ( isset( $instance['with_border'] ) && $instance['with_border'] == 'yes' ) ? 'newsletter-form with-border' : 'newsletter-form';

        echo str_replace( 'newsletter-form', $class, $before_widget );

        echo $before_title . $args['title'] . $after_title;
        if ( $args['subtitle'] != '' ) {
            echo '<p class="newsletter-subtitle">' . $args['subtitle'] . '</p>';
        }

        yit_plugin_get_template( untrailingslashit( plugin_dir_path( __FILE__ ) ), 'shortcodes/newsletter_form.php', $args );

        echo $after_widget;
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
     * @author   Antonio La Rocca <antonio.larocca@yithemes.it>
     * @author   Francesco Licandro <francesco.licandro@yithemes.it>
     */
    public function update( $new_instance, $old_instance ) {
        $instance                = $old_instance;
        $instance['title']       = strip_tags( $new_instance['title'] );
        $instance['subtitle']    = strip_tags( $new_instance['subtitle'] );
        if ( current_user_can('unfiltered_html') )
            $instance['text'] =  $new_instance['text'];
        else
            $instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) ); // wp_filter_post_kses() expects slashed
        $instance['icon_form']   = strip_tags( $new_instance['icon_form'] );
        $instance['post_name']   = strip_tags( $new_instance['post_name'] );
        $instance['with_border'] = $new_instance['with_border'];
        $instance['button_class'] = $new_instance['button_class'];

        return $instance;
    }
}