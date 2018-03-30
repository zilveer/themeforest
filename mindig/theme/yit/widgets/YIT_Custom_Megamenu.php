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

if ( ! class_exists( 'YIT_Custom_Megamenu' ) ) :

    class YIT_Custom_Megamenu extends WP_Widget {

        function __construct() {
            $widget_ops  = array(
                'classname'   => 'yit-custom-megamenu',
                'description' => __( 'Display a Custom Mega Menu in the header row sidebars.', 'yit' )
            );
            $control_ops = array( 'id_base' => 'yit-custom-megamenu' );
            WP_Widget::__construct( 'yit-custom-megamenu', __( 'YIT Custom Mega Menu', 'yit' ), $widget_ops, $control_ops );
        }



    /**
     * widget function.
     *
     * @see WP_Widget
     * @access public
     * @param array $args
     * @param array $instance
     * @return void
     */
    function widget( $args, $instance ) {

        extract( $args );

        if( !isset( $instance['title'] ) )
            $instance['title'] = '';

        $title = apply_filters('widget_title', $instance['title'] );

        $nav_menu = isset( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : '';
        include_once( YIT_THEME_ASSETS_PATH . '/lib/Walker_Nav_Menu_Div.php' );

        $nav_args = array(
            'menu'       => $nav_menu,
            'container'  => 'div',
            'container_class' => 'submenu',
            'menu_class' => 'sub-menu clearfix',
            'depth'      => 3,
            'walker'     => new YIT_Walker_Nav_Menu_Div()
        );
        echo $before_widget;
        echo '<ul class="yit-cm"><li>';
        echo '<a href="#" class="btn-flat">'. $title .'</a>';
        wp_nav_menu( $nav_args );
        echo '</li></ul>';
        echo $after_widget;

    }


    /**
     * update function.
     *
     * @see WP_Widget->update
     * @access public
     * @param array $new_instance
     * @param array $old_instance
     * @return array
     */
    function update( $new_instance, $old_instance ) {
        $instance                        = $old_instance;
        $instance['title']               = strip_tags( $new_instance['title'] );
        $instance['nav_menu']            = $new_instance['nav_menu'];
        return $instance;
    }


    /**
     * form function.
     *
     * @see WP_Widget->form
     * @access public
     * @param array $instance
     * @return void
     */
    function form( $instance ) {

        $defaults = array(
            'title'     => '',
            'nav_menu'  => '',
        );

        $instance = wp_parse_args( (array) $instance, $defaults );
        $menus    = wp_get_nav_menus( array( 'orderby' => 'name' ) );

        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'yit' ) ?>:
                <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
            </label>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'nav_menu' ); ?>"><?php _e( 'Select the Menu:', 'yit' ); ?></label>
            <select id="<?php echo $this->get_field_id( 'nav_menu' ); ?>" name="<?php echo $this->get_field_name( 'nav_menu' ); ?>">
                <?php
                foreach ( $menus as $menu ) {
                    echo '<option value="' . $menu->term_id . '"'
                        . selected( $instance['nav_menu'], $menu->term_id, false )
                        . '>' . $menu->name . '</option>';
                }
                ?>
            </select>
        </p>
    <?php
    }

}

endif;
