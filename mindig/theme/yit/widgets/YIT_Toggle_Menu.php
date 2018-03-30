<?php
/**
 * Your Inspiration Themes
 *
 * @package    WordPress
 * @subpackage Your Inspiration Themes
 * @author     Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! class_exists( 'YIT_Toggle_Menu' ) ) :

    class YIT_Toggle_Menu extends WP_Widget {

        public function __construct() {

            /* Widget variable settings. */
            $this->woo_widget_idbase = 'yit_toggle_menu';

            /* Widget settings. */
            $widget_ops = array( 'classname' => 'yit_toggle_menu', 'description' => __( 'Print a custom menu in a sidebar with a fancy toggle jQuery effect. Create an apposite menu for this widget in Appearance -> Menus.', 'yit' ) );

            /* Create the widget. */
            WP_Widget::__construct( 'yit-toggle-menu', 'Toggle Menu', $widget_ops );



        }

        public function form( $instance ) {
            $defaults = array(
                'title'          => '',
                'menu'           => '',
                'open_dropdowns' => 'first',
            );

            $instance = wp_parse_args( ( array ) $instance, $defaults ); ?>

            <p>
                <label for="<?php echo $this->get_field_id( 'title' ) ?>"><?php _e( 'Title', 'yit' ) ?></label>
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'menu' ); ?>"><?php _e( 'Menu', 'yit' ) ?></label>
                <select id="<?php echo $this->get_field_id( 'menu' ); ?>" name="<?php echo $this->get_field_name( 'menu' ); ?>">
                    <?php foreach ( yit_get_registered_nav_menus() as $menu ): ?>
                        <option value="<?php echo $menu ?>" <?php selected( $instance['menu'], $menu ) ?>><?php echo $menu ?></option>
                    <?php endforeach ?>
                </select>

            </p>

            <p>
                <input type="radio" name="<?php echo $this->get_field_name( 'open_dropdowns' ); ?>" value="first" <?php checked( 'first', $instance['open_dropdowns'] ) ?> />
                <label><?php _e( 'Open the first dropdown', 'yit' ) ?></label><br />

                <input type="radio" name="<?php echo $this->get_field_name( 'open_dropdowns' ); ?>" value="all" <?php checked( 'all', $instance['open_dropdowns'] ) ?> />
                <label><?php _e( 'Open all dropdowns', 'yit' ) ?></label><br />

                <input type="radio" name="<?php echo $this->get_field_name( 'open_dropdowns' ); ?>" value="active" <?php checked( 'active', $instance['open_dropdowns'] ) ?> />
                <label><?php _e( 'Open active dropdown', 'yit' ) ?></label><br />

                <input type="radio" name="<?php echo $this->get_field_name( 'open_dropdowns' ); ?>" value="none" <?php checked( 'none', $instance['open_dropdowns'] ) ?> />
                <label><?php _e( 'Close all dropdowns', 'yit' ) ?></label><br />
            </p>

        <?php
        }

        public function widget( $args, $instance ) {

            extract( $args );

            $title = apply_filters( 'widget_title', $instance['title'] );

            echo $before_widget;

            if ( $title ) {
                echo $before_title . $title . $after_title;
            }

            $args = array(
                'menu'       => $instance['menu'],
                'menu_class' => 'menu',
                'depth'      => 3
            );

            if ( $instance['open_dropdowns'] ) {
                $args['menu_class'] .= ' open_' . $instance['open_dropdowns'];
            }

            wp_nav_menu( $args );

            echo $after_widget;
        }

        public function update( $new_instance, $old_instance ) {
            $instance = $old_instance;

            $instance['title']          = esc_html( $new_instance['title'] );
            $instance['menu']           = $new_instance['menu'];
            $instance['open_dropdowns'] = $new_instance['open_dropdowns'];

            return $instance;
        }
    }
endif;