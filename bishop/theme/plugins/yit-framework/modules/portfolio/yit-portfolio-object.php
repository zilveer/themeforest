<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */
if (!defined('ABSPATH')) {exit('Direct access forbidden.');}

/**
 * 
 *
 * @class YIT_Portfolio_Object
 * @package	Yithemes
 * @since 1.0
 * @author Your Inspiration Themes
 *
 */

class YIT_Portfolio_Object {

    /**
     * @var object The single instance of the class
     * @since 1.0
     */
    protected static $_instances = null;

	/**
	 * @var string The name of current portfolio
	 * @since 1.0
	 */
	public $name = '';

	/**
	 * @var string The post type of current portfolio
	 * @since 1.0
	 */
	public $post_type = '';

    /**
     * @var null All data of portfolio
     * @since 1.0
     */
    public $config = null;

    /**
     * @var \WP_Query The WP_Query for the posts of portfolio
     * @since 1.0
     */
    public $query = null;

    /**
     * Get the instance of portfolio defined
     *
     * @param $portfolio string The portfolio name
     *
     * @return null|object|YIT_Portfolio_Object
     * @since 1.0
     * @author Antonino Scarfì <antonino.scarfi@yithemes.com>
     */
    public static function instance( $portfolio ) {
        if ( is_object( $portfolio ) ) {
            $name = $portfolio->post_name;
        } else {
            $name = $portfolio;
        }

        if ( ! isset( self::$_instances[ $name ] ) ) {
            self::$_instances[ $name ] = new self( $name );
        }

        return self::$_instances[ $name ];
    }


    /**
     * Set the name of current portfolio and get all data
     *
     * @param $portfolio
     * @internal param object|string $name The identification name of portfolio
     *
     * @return \YIT_Portfolio_Object
     * @since  1.0
     * @author Antonino Scarfì <antonino.scarfi@yithemes.com>
     */
    public function __construct( $portfolio ) {
        if ( is_object( $portfolio ) ) {
            $this->name = $portfolio->post_name;
            $this->config = $portfolio;
        } else {
            $this->name = $portfolio;
        }

        $this->name = str_replace( array( YIT_Portfolio()->post_type_prefix, '-' ), array( '', '_' ), $this->name );
        $this->_populate();
    }

    /**
     * Populate the attribute $data with all informations of current portfolio
     *
     * @return void
     * @since 1.0
     * @author Antonino Scarfì <antonino.scarfi@yithemes.com>
     */
    protected function _populate() {

        if ( is_null ( $this->config ) ) {
            global $wpdb;
            $name =  str_replace('_','-',$this->name) ;
            $prepare = $wpdb->prepare( "SELECT * FROM $wpdb->posts WHERE post_name = %s AND post_type = %s", $name, YIT_Portfolio()->portfolios_post_type ) ;
            $this->config = $wpdb->get_row( $prepare );
        }

        if ( is_null ( $this->config ) ) {
            global $wpdb;
            $this->config = $wpdb->get_row( $wpdb->prepare( "SELECT p.* FROM $wpdb->postmeta AS pm INNER JOIN $wpdb->posts AS p ON p.ID = pm.post_id WHERE pm.meta_key = %s AND pm.meta_value = %s AND p.post_type = %s", '_post_type', YIT_Portfolio()->post_type_prefix . $this->name, YIT_Portfolio()->portfolios_post_type ) );
        }

        // extra metadata
        $post_id = $this->config->ID;
		$this->post_type                = get_post_meta( $post_id, '_post_type',         true );
        $this->config->layout           = get_post_meta( $post_id, '_type',              true );
        $this->config->rewrite          = get_post_meta( $post_id, '_rewrite',           true );
        $this->config->label_singular   = get_post_meta( $post_id, '_label_singular',    true );
        $this->config->label_plural     = get_post_meta( $post_id, '_label_plural',      true );
        $this->config->taxonomy         = get_post_meta( $post_id, '_taxonomy',          true );
        $this->config->taxonomy_rewrite = get_post_meta( $post_id, '_taxonomy_rewrite',  true );
        $this->config->single_layout    = get_post_meta( $post_id, '_single_layout',     true );

    }

    /**
     * Retrieve the pathaname of config.php file, located inside the folder layout of current portfolio
     *
     * @return mixed Pathname of config.php file of current layout
     * @since 1.0
     * @author Antonino Scarfì <antonino.scarfi@yithemes.com>
     */
    public function get_config_file() {
        return YIT_Portfolio()->cptu->locate_file( $this->config->layout, 'config' );
    }

    /**
     * Retrieve the pathname of markup.php file, located inside the folder layout of current portfolio
     *
     * @return mixed Pathname of markup.php file of current layout
     * @since 1.0
     * @author Antonino Scarfì <antonino.scarfi@yithemes.com>
     */
    public function get_markup_file() {
        return YIT_Portfolio()->cptu->locate_file( $this->config->layout, 'markup' );
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
            'posts_per_page' => $this->get('config-nitems'),
            'paged' => ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : false
        );

		if ( empty( $defaults['posts_per_page'] ) ) {
			$defaults['posts_per_page'] = -1;
		}

        if( is_archive() ){
            $args = wp_parse_args( $args, $GLOBALS['wp_query']->query );
        }

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

            } elseif ( $var = get_post_meta( $post_id, '_' . $this->config->layout . '_' . $var, true ) ) {
                return $var;

            } elseif ( $var = get_post_meta( $post_id, '_' . $var, true ) ) {
                return $var;

            } else {
                return null;
            }
        }

        // get from item
        if ( ! is_null( $this->query ) || is_single() ) {
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

            } elseif( 'excerpt' == $var  ){
                return get_the_excerpt();
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
        global $post;

        if( isset($post) && is_object( $post ) ) {
            $post_id =  $post->ID;
        } else if( isset ( $this->query ) ) {
            $post_id = $this->query->post->ID;
        }

        return get_the_post_thumbnail( $post_id, $size, $attr );
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

    /**
     * Retrieve the terms in a given taxonomy or list of taxonomies.
     *
     * You can fully inject any customizations to the query before it is sent, as
     * well as control the output with a filter.
     *
     * @param string|array $args The values of what to search for when returning terms
     *
     * @return array|WP_Error List of Term Objects and their children. Will return WP_Error, if any of $taxonomies do not exist.
     * @since    1.0
     * @author   Antonino Scarfì <antonino.scarfi@yithemes.com>
     */
    public function get_terms( $args = array() ) {
        $args['taxonomy'] = $this->config->taxonomy;
        return get_terms( $args );
    }

    /**
     * Retrieve a post's terms as a list with specified format.
     *
     * @param string $before Optional. Before list.
     * @param string $sep Optional. Separate items using this.
     * @param string $after Optional. After list.
     *
     * @return string|bool|WP_Error A list of terms on success, false or WP_Error on failure.
     * @since    1.0
     * @author   Antonino Scarfì <antonino.scarfi@yithemes.com>
     */
    public function terms_list( $sep = '', $before = '', $after = '' ) {
        global $post;
        $post_id = isset ( $this->query ) ? $this->query->post->ID : $post->ID;

        return get_the_term_list( $post_id,
            $this->config->taxonomy, $before, $sep, $after );
    }

    /**
     * Retrive a post's terms as an associative array
     *
     * @return array|bool|\WP_Error An associative array of terms on success, false or WP_Error on failure.
     * @since    1.0
     * @author   Antonio La Rocca <antonio.larocca@yithemes.com>
     */
    public function terms_array( ){
        return get_the_terms( $this->query->post->ID, $this->config->taxonomy );
    }

    /**
     * Print pagination
     *
     * @return void
     * @since 1.0.0
     * @author   Antonio La Rocca <antonio.larocca@yithemes.com>
     */
    public function pagination(){
        $pages = isset( $this->query->max_num_pages ) ? $this->query->max_num_pages : '';
        yit_pagination( $pages );
    }

}