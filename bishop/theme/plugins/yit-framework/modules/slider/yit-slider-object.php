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
 * @class YIT_Slider_Object
 * @package	Yithemes
 * @since 1.0
 * @author Your Inspiration Themes
 *
 */

class YIT_Slider_Object {

    /**
     * @var object The single instance of the class
     * @since 1.0
     */
    protected static $_instances = null;

    /**
     * @var string The name of current slider
     * @since 1.0
     */
    public $name = '';

	/**
	 * @var string The post type of current portfolio
	 * @since 1.0
	 */
	public $post_type = '';

    /**
     * @var null All data of slider
     * @since 1.0
     */
    public $config = null;

    /**
     * @var \WP_Query The WP_Query for the posts of slider
     * @since 1.0
     */
    public $query = null;

    /**
     * Get the instance of slider defined
     *
     * @param $slider string The slider name
     *
     * @return null|object|YIT_Slider_Object
     * @since 1.0
     * @author Antonino Scarfì <antonino.scarfi@yithemes.com>
     */
    public static function instance( $slider ) {
        if ( is_object( $slider ) ) {
            $name = $slider->post_name;
        } else {
            $name = $slider;
        }

        if ( ! isset( self::$_instances[ $name ] ) ) {
            self::$_instances[ $name ] = new self( $name );
        }

        return self::$_instances[ $name ];
    }


    /**
     * Set the name of current slider and get all data
     *
     * @param $slider
     * @internal param object|string $name The identification name of slider
     *
     * @return \YIT_Slider_Object
     * @since  1.0
     * @author Antonino Scarfì <antonino.scarfi@yithemes.com>
     */
    public function __construct( $slider ) {
        if ( is_object( $slider ) ) {
            $this->name = $slider->post_name;
            $this->config = $slider;
        } else {
            $this->name = $slider;
        }

        $this->_populate();
    }

    /**
     * Populate the attribute $data with all informations of current slider
     *
     * @return void
     * @since 1.0
     * @author Antonino Scarfì <antonino.scarfi@yithemes.com>
     */
    protected function _populate() {
        if ( is_null ( $this->config ) ) {
            global $wpdb;
			$this->config = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $wpdb->posts WHERE post_name = %s AND post_type = %s", $this->name, YIT_Slider()->sliders_post_type ) );
        }

        //wpml fix
        $translated_id = yit_wpml_get_translated_id( $this->config->ID , YIT_Slider()->sliders_post_type );
        if( $translated_id != $this->config->ID ) {
            global $wpdb;
            $this->config = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $wpdb->posts WHERE id = %s", $translated_id ) );
            $this->name = $this->config->post_name;
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
    }

    /**
     * Retrieve the pathaname of config.php file, located inside the folder layout of current slider
     *
     * @return mixed Pathname of config.php file of current layout
     * @since 1.0
     * @author Antonino Scarfì <antonino.scarfi@yithemes.com>
     */
    public function get_config_file() {
        return YIT_Slider()->cptu->locate_file( $this->config->layout, 'config' );
    }

    /**
     * Retrieve the pathname of markup.php file, located inside the folder layout of current slider
     *
     * @return mixed Pathname of markup.php file of current layout
     * @since 1.0
     * @author Antonino Scarfì <antonino.scarfi@yithemes.com>
     */
    public function get_markup_file() {
        return YIT_Slider()->cptu->locate_file( $this->config->layout, 'markup' );
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
			'post_status' => 'publish'
        );

		if ( empty( $defaults['posts_per_page'] ) ) {
			$defaults['posts_per_page'] = -1;
		}

        $args = wp_parse_args( $args, $defaults );

        $this->query = new WP_Query( $args );
    }

    /**
     * Get a value for the slider configuration (with 'config-') or current project loop
     *
     * @param string $var The name of variable
     * @param array $args
     *
     * @return mixed
     * @since 1.0
     * @author Antonino Scarfì <antonino.scarfi@yithemes.com>
     */
    public function get( $var, $args = array() ) {

       // global $post;


        $defaults = array(
            'post_id' => false,
            'echo' => false,
            // image
            'size' => 'post-thumbnail',
            'attr' => '',

            // featured content
            'before' => '',
            'after' => '',
            'container' => true,
            'video_width' => 425,
            'video_height' => 356,
            'content_type' => 'image'

        );
        extract( wp_parse_args( $args, $defaults ) );

        // general variables
        if ( 'baseurl' == $var ) {
            return YIT_Slider()->cptu->locate_url( $this->config->layout );
        }



        // get from slider config
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
        //if ( ! is_null( $this->query ) ) {
            if( !$post_id ){
                global $post;
                $post_id = $post->ID;
            }elseif ( ! $post_id && isset( $this->config->ID ) ) {
                $post_id = $this->config->ID;
            } elseif ( ! isset( $this->config->ID ) ) {
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

            } elseif ( 'featured-content' == $var ) {
                return $this->featured_content( $content_type, array(
                    'before'       => $before,
                    'after'        => $after,
                    'container'    => $container,
                    'video_width'  => $video_width,
                    'video_height' => $video_height
                ) );

            } elseif ( 'ID' == $var ) {
                return $post_id;

            } elseif ( $value = get_post_meta( $post_id, '_' . $this->config->layout . '_' . $var, true ) ) {

                return $value;

            } else {

                return get_post_meta( $post_id, '_' . $var, true );

            }
        //}

    }

    /**
     * Print the result of get() method
     *
     * @param string $var
     * @param array $args
     *
     * @return mixed
     * @since 1.0
     * @author Antonino Scarfì <antonino.scarfi@yithemes.com>
     */
    public function the( $var, $args = array() ) {
        echo $this->get( $var, $args );
    }

    /**
     * Return the image for the current project of slider
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
     * Generate the main content of slide
     *
     * @param string $content_type 'image' or 'video'
     * @param array $args
     *
     * @return string The output html
     * @since 1.0
     * @author Antonino Scarfì <antonino.scarfi@yithemes.com>
     */
    public function featured_content( $content_type, $args = array() ){
        $default = array(
            'container' => true,
            'id_container' => '',
            'before' => '',
            'after' => '',
            'video_width' => 425,
            'video_height' => 356
        );
        $args = wp_parse_args( $args, $default );

        extract($args, EXTR_SKIP);

        $link_url = $this->get('link');
        $link = ! empty( $link_url ) ? true : false;

        $output = $attr = $a_before = $a_after = '';

        if ( $link ) {
            $a_before = '<a href="' . $link_url . '">';
            $a_after  = '</a>';
        }

        $output .= $before;

        if ( ! empty( $id_container ) ) {
            $id_container = " id=\"$id_container\"";
        }

        switch( $content_type ) {

            case 'image' :
                if( $container ) {
                    $output .= '<div class="featured-image"' . $id_container . '>';
                }

                $output .= $a_before . $this->get_image( 'full' ) . $a_after;

                if( $container ) {
                    $output .= '</div>';
                }
                break;

            case 'video' :
                list( $type, $id ) = explode( ':', YIT_Video::video_id_by_url( $this->get('url_video') ) );

                $output .= '<div class="video-container">' . YIT_Video::$type( "id=$id&width=$video_width&height=$video_height" ) . '</div>';

                break;

        }

        $output .= $after . "\n";

        return $output;
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
	 * Is first slide
	 *
	 * Detect if the current post is the first one of the current query
	 *
	 * @return bool
	 * @since 1.0
	 * @author Antonino Scarfì <antonino.scarfi@yithemes.com>
	 */
	public function is_first() {
		return 0 == $this->query->current_post ? true : false;
	}

	/**
	 * Is last slide
	 *
	 * Detect if the current post is the last one of the current query
	 *
	 * @return bool
	 * @since 1.0
	 * @author Antonino Scarfì <antonino.scarfi@yithemes.com>
	 */
	public function is_last() {
		return $this->query->current_post +1 == $this->query->post_count ? true : false;
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
        $class = array(
            'slider',
            $this->config->layout,
            $classes
        );

		if ( $this->is_first() ) {
			$class[] = 'first';
		}

		if ( $this->is_last() ) {
			$class[] = 'last';
		}

        echo 'class="' . join( ' ', array_merge( $class, get_post_class( '' , $this->config->ID ) ) ) . '"';
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
        return get_the_term_list( $this->query->post->ID, $this->config->taxonomy, $before, $sep, $after );
    }

}