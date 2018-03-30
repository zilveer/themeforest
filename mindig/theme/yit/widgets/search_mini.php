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

            $widget_ops = array( 'classname' => 'widget_search_mini', 'description' => __( "A mini search form for your site. The widget can be used only within the Header Row Middle Sidebar. If you have installed the plugin YITH WooCommerce Ajax Search the widget will automatically use the plugin.", 'yit' ) );
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


            <div class="search_mini_content">



                <?php if ( defined( 'YITH_WCAS' ) ): ?>
                    <?php echo do_shortcode( '[yith_woocommerce_ajax_search]' ) ?>

                <?php else: ?>
                    <label class="search_mini_label"><?php _e('Search', 'yit') ?></label>
                    <form action="<?php echo home_url( '/' ); ?>" method="get" class="search_mini">
                        <input type="submit" value="<?php _e( 'GO', 'yit' ) ?>" id="mini-search-submit" />
                        <div class="nav-searchfield">
                            <div id="nav-searchfield-container">
                                <input type="text" name="s" id="search_mini" value="<?php the_search_query(); ?>"  />
                            </div>
                        </div>

                        <input type="hidden" name="post_type" value="<?php echo $search_type ?>" />
                    </form>
                <?php endif ?>


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