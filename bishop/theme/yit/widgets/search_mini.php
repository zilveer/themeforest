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
if ( ! class_exists( 'search_mini' ) ) :

    /**
     * Search widget class
     *
     * @since 2.8.0
     */
    class search_mini extends WP_Widget {

        function __construct() {

            $widget_ops = array( 'classname' => 'widget_search_mini', 'description' => __( "A mini search form for your site. The widget can be used only within the Header Sidebar. If you have installed the plugin YITH WooCommerce Ajax Search the widget will automatically use the plugin.", 'yit' ) );
            parent::__construct( 'search_mini', __( 'Mini Search', 'yit' ), $widget_ops );
        }

        function widget( $args, $instance ) {
            extract( $args );

            $title = ( isset( $instance['title'] ) ) ? $instance['title'] : '';
            echo $before_widget;

            $search_type = yit_get_option( 'search_type' );
            if ( ! is_shop_installed() && $search_type == 'product' ) {
                $search_type = 'post';
            }
            ?>
            <?php $icon = yit_get_option('header-search-mini-icon');

            if( $icon['select'] == 'icon' ){
                $i = '<i class="fa fa-'.$icon['icon'].'"></i>';
            }else{
                $image_attr = yit_getimagesize( $icon['custom'] );
                $i = '<span><img src="'.$icon['custom'].'" '. $image_attr[3] .' alt="'. __("Search", "yit" ) . '"/></span>';
            }

            ?>
            <a href="#" class="search_mini_button"><?php echo $i ?></a>

            <div class="search_mini_content slideInDown">

                <?php echo ( yit_get_header_skin() == 'skin1') ? '<div class="container">' : '' ?>

                <?php if ( defined( 'YITH_WCAS' ) ): ?>
                    <?php echo do_shortcode( '[yith_woocommerce_ajax_search]' ) ?>
                <?php else: ?>
                    <form action="<?php echo home_url( '/' ); ?>" method="get" class="search_mini">
                        <input type="text" name="s" id="search_mini" value="<?php the_search_query(); ?>" placeholder="<?php if ( is_shop_installed() ): _e( 'search for products', 'yit' );
                        else: _e( 'search for...', 'yit' ); endif ?>" /><input type="submit" value="" id="mini-search-submit" />
                        <input type="hidden" name="post_type" value="<?php echo $search_type ?>" />
                    </form>
                <?php endif ?>
                <?php echo ( yit_get_header_skin() == 'skin1') ? '</div>' : '' ?>
            </div>
            <?php
            echo $after_widget;
        }

        function form( $instance ) {
            $default  = array(
                'title' => ''
            );
            $instance = wp_parse_args( (array) $instance, $default );
            ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'yit' ) ?>:
                    <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
                </label>
            </p>
        <?php
        }

        function update( $new_instance, $old_instance ) {
            $instance          = $old_instance;
            $instance['title'] = strip_tags( $new_instance['title'] );
            return $instance;
        }

    }
endif;