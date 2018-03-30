<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if (!defined('YIT')) exit('Direct access forbidden.');

/**
 * Wordpress Admin Dashboard Management
 *
 * @class YIT_Dashboard
 * @package	Yithemes
 * @since 2.0.0
 * @author Your Inspiration Themes
 *
 */
class YIT_Dashboard extends YIT_Object {
    /**
     * Products Feed
     *
     * @var string
     */
    protected $_productsFeed = 'http://yithemes.com/feed/?post_type=product';

    /**
     * Blog Feed
     *
     * @var string
     */
    protected $_blogFeed = 'http://yithemes.com/feed/';

    /**
     * Constructor
     *
     * @since 1.0.0
     * @author Simone D'Amico <simone.damico@yithemes.com>
     */
    public function __construct() {
        add_action( 'wp_dashboard_setup', array($this, 'dashboard_widget_setup' ) );
    }

    /**
     * Dashboard widget setup
     *
     * @return void
     * @since 1.0.0
     * @author Simone D'Amico <simone.damico@yithemes.com>
     */
    public function dashboard_widget_setup() {
        global $wp_meta_boxes;

        wp_add_dashboard_widget( 'yit_dashboard_products_news', __( 'Our latest themes' , 'yit' ), array($this, 'dashboard_products_news') );
        wp_add_dashboard_widget( 'yit_dashboard_blog_news', __( 'News from the YIT Blog' , 'yit' ), array($this, 'dashboard_blog_news') );

        $widgets_on_side = array(
            'yit_dashboard_products_news',
            'yit_dashboard_blog_news'
        );

        foreach( $widgets_on_side as $meta ) {
            $temp = $wp_meta_boxes['dashboard']['normal']['core'][$meta];
            unset($wp_meta_boxes['dashboard']['normal']['core'][$meta]);
            $wp_meta_boxes['dashboard']['side']['core'][$meta] = $temp;
        }
    }


    /**
     * Product news Widget
     *
     * @return void
     * @since 1.0.0
     * @author Simone D'Amico <simone.damico@yithemes.com>
     */
    public function dashboard_products_news() {
        $args = array( 'show_author' => 1, 'show_date' => 1, 'show_summary' => 0, 'items'=>10 );
        wp_widget_rss_output( $this->_productsFeed, $args );
    }


    /**
     * Blog news Widget
     *
     * @return void
     * @since 1.0.0
     * @author Simone D'Amico <simone.damico@yithemes.com>
     */
    public function dashboard_blog_news() {
        $args = array( 'show_author' => 1, 'show_date' => 1, 'show_summary' => 0, 'items'=>10 );
        wp_widget_rss_output( $this->_blogFeed, $args );
    }
}
