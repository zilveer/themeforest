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
 * Define Feature tab object
 *
 * @package Yithemes
 * @author Antonio La Rocca <antonio.larocca@yithemes.it>
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

class YIT_Feature_Tab_Object{
    /**
     * @var object The single instance of the class
     * @since 1.0
     */
    protected static $_instances = null;

    /**
     * @var string The name of current feature tabs
     * @since 1.0
     */
    public $name = '';

	/**
	 * @var string The post type of current features tab
	 * @since 1.0
	 */
	public $post_type = '';

    /**
     * @var null All data of feature tabs
     * @since 1.0
     */
    public $config = null;

    /**
     * @var \WP_Query The WP_Query for the posts of portfolio
     * @since 1.0
     */
    public $query = null;

    /**
     * Get the instance of feature tab defined
     *
     * @param $feature_tab string The feature tab name
     *
     * @return null|object|YIT_Feature_Tab_Object
     * @since 1.0
     * @author Antonino Scarfì <antonino.scarfi@yithemes.com>
     */
    public static function instance( $feature_tab ) {
        if ( is_object( $feature_tab ) ) {
            $name = $feature_tab->post_name;
        } else {
            $name = $feature_tab;
        }

        if ( ! isset( self::$_instances[ $name ] ) ) {
            self::$_instances[ $name ] = new self( $name );
        }

        return self::$_instances[ $name ];
    }


    /**
     * Set the name of current feature tab and get all data
     *
     * @param $feature_tab
     *
     * @internal param object|string $name The identification name of feature tab
     *
     * @return \YIT_Feature_Tab_Object
     * @since  1.0
     * @author   Antonino Scarfì <antonino.scarfi@yithemes.com>
     */
    public function __construct( $feature_tab ) {
        if ( is_object( $feature_tab ) ) {
            $this->name = $feature_tab->post_name;
            $this->config = $feature_tab;
        } else {
            $this->name = $feature_tab;
        }

        $this->_populate();
    }

    /**
     * Populate the attribute $data with all informations of current feature tab
     *
     * @return void
     * @since 1.0
     * @author Antonino Scarfì <antonino.scarfi@yithemes.com>
     */
    protected function _populate() {
        if ( is_null ( $this->config ) ) {
            global $wpdb;
            $this->config = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $wpdb->posts WHERE post_name = %s AND post_type = %s", $this->name, YIT_Feature_Tabs()->feature_tab_post_type ) );
            $this->post_type = get_post_meta( $this->config->ID, '_post_type',         true );
        }
    }

    /**
     * Initialize the Query for the items to show in the frontend
     *
     * @param array $args The arguments to configure the query
     *
     * @return void
     * @since 1.0
     * @author Antonino Scarfì <antonino.scarfi@yithemes.com>
     */
    public function init_query( $args = array() ) {
        $defaults = array(
            'post_type' => $this->post_type,
            'posts_per_page' => -1,
            'order' => 'ASC'
        );

        $args = wp_parse_args( $args, $defaults );

        $this->query = new WP_Query( $args );
    }

    /**
     * Get a value for the portfolio configuration (with 'config-') or current project loop
     *
     * @param string $var The name of variable
     * @param array $args
     *
     * @return mixed
     * @since 1.0
     * @author Antonino Scarfì <antonino.scarfi@yithemes.com>
     */
    public function get( $var, $args = array() ) {
        $defaults = array(
            'post_id' => false,
            'echo' => false,

            // image
            'size' => 'post-thumbnail',
            'attr' => ''

        );
        extract( wp_parse_args( $args, $defaults ) );

        // general variables
        if ( 'baseurl' == $var ) {
            return YIT_Portfolio()->cptu->locate_url( $this->config->layout );
        }

        // get from portfolio config
        if ( strpos( $var, 'config-' ) !== false ) {
            if ( ! $post_id ) {
                $post_id = $this->config->ID;
            }

            $var = str_replace( 'config-', '', $var );

            if ( isset( $this->config->$var ) ) {
                return $this->config->$var;

            } elseif ( $var = get_post_meta( $post_id, '_' . $var, true ) ) {
                return $var;

            } else {
                return null;
            }
        }

        // get from item
        if ( ! is_null( $this->query ) ) {
            global $post;

            if ( ! $post_id && isset( $post->ID ) ) {
                $post_id = $post->ID;
            } elseif ( ! isset( $post->ID ) ) {
                return null;
            }

            if ( 'title' == $var ) {
                return get_the_title( $post_id );

            } elseif ( 'content' == $var ) {
                $content = get_the_content();
                if ( $echo ) {
                    $content = apply_filters( 'the_content', $content );
                }
                return $content;

            } elseif ( 'permalink' == $var ) {
                return get_permalink( $post_id );

            } elseif ( 'image' == $var ) {
                return $this->get_image( $size, $attr );

            } elseif ( 'ID' == $var ) {
                return $post_id;

            } else {
                return get_post_meta( $post_id, '_' . $var, true );

            }
        }

    }

    /**
     * Return the image for the current project of portfolio
     *
     * @param string $size
     * @param array  $attr
     *
     * @return mixed|void
     * @since 1.0
     * @author Antonino Scarfì <antonino.scarfi@yithemes.com>
     */
    public function get_image( $size = 'post-thumbnail', $attr = array() ) {
        return get_the_post_thumbnail( $this->query->post->ID, $size, $attr );
    }

    /**
     * Whether there are more posts available in the loop.
     *
     * Calls action 'loop_end', when the loop is complete.
     *
     * @access public
     * @uses do_action_ref_array() Calls 'loop_end' if loop is ended
     *
     * @return bool True if posts are available, false if end of loop.
     * @since 1.0
     * @author Antonino Scarfì <antonino.scarfi@yithemes.com>
     */
    public function have_posts() {
        return $this->query->have_posts();
    }

    /**
     * Sets up the current post.
     *
     * Retrieves the next post, sets up the post, sets the 'in the loop'
     * property to true.
     *
     * @access public
     * @uses $post
     * @uses do_action_ref_array() Calls 'loop_start' if loop has just started
     *
     * @return bool True if posts are available, false if end of loop.
     * @since 1.0
     * @author Antonino Scarfì <antonino.scarfi@yithemes.com>
     */
    public function the_post() {
        return $this->query->the_post();
    }

    /**
     * Destroy the previous query and set up a new query.
     *
     * This should be used after {@link query_posts()} and before another {@link
     * query_posts()}. This will remove obscure bugs that occur when the previous
     * wp_query object is not destroyed properly before another is set up.
     *
     * @uses $wp_query
     * @since 1.0
     * @author Antonino Scarfì <antonino.scarfi@yithemes.com>
     */
    public function reset_query() {
        wp_reset_query();
    }

    /**
     * Display the classes for the post div.
     *
     * @param string $classes
     *
     * @internal param array|string $class One or more classes to add to the class list.
     *
     * @since    1.0
     * @author   Antonino Scarfì <antonino.scarfi@yithemes.com>
     */
    public function item_class( $classes = '' ) {
        echo 'class="' . join( ' ', array_merge( array( $classes ), get_post_class() ) ) . '"';
    }
}