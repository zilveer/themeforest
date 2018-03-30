<?php
/**
 * @package G1_Framework
 * @subpackage G1_Theme03
 * @since G1_Theme03 1.0.0
 */

// Prevent direct script access
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );

if ( file_exists( bbpress()->themes_dir . 'default/bbpress-functions.php' ) ) {
    require_once( bbpress()->themes_dir . 'default/bbpress-functions.php' ) ;
}


class G1_BBPress {

    public function __construct() {
        $this->setup_hooks();
    }

    /**
     * Set up all hooks
     */
    protected function setup_hooks() {
        add_filter( 'bbp_forums_widget_options', array( $this, 'add_widget_class' ) );
        add_filter( 'bbp_topics_widget_options', array( $this, 'add_widget_class' ) );
        add_filter( 'bbp_views_widget_options', array( $this, 'add_widget_class' ) );

        // Remove small avatars
        add_filter( 'bbp_after_get_reply_author_link_parse_args', array( $this, 'remove_small_avatars' ) );
        add_filter( 'bbp_after_get_topic_author_link_parse_args', array( $this, 'remove_small_avatars' ) );


        add_action( 'bbp_theme_before_topic_meta', array( $this, 'begin_bigger_avatars') );
        add_action( 'bbp_theme_after_topic_meta', array( $this, 'end_bigger_avatars') );


        add_action( 'bbp_theme_before_forum_sub_forums', array( $this, 'alter_sub_forums' ) );
        remove_action( 'bbp_theme_after_forum_sub_forums', array( $this, 'alter_sub_forums' ) );

        //add_filter( 'bbp_user_can_view_forum', array( $this, 'user_can_view_test' ), 10, 3 );

        add_filter( 'bbp_get_logout_link', array( $this, 'adjust_logout_link'), 10, 2 );

        add_action( 'init', array( $this, 'init' ), 11 );

        // Breadcrumb
        add_filter( 'bbp_after_get_breadcrumb_parse_args', array( $this, 'adjust_breadcrumb_markup' ) );
        add_action( 'wp', array( $this, 'switch_breadcrumb_nav') );
        add_filter( 'bbp_no_breadcrumb', '__return_true' );

        // Manage sidebars
        add_filter( 'g1_setup_sidebars', array( $this, 'setup_sidebars' ) );

        // Fix nav menu CSS class
        add_filter( 'nav_menu_css_class', array( $this, 'fix_nav_menu_css_class' ), 10, 2 );

        // Include custom shortcodes
        require_once( 'shortcode-forums.php' );

        if ( is_admin() ) {
            add_action( get_redux_opts_sections_filter_name(), array( $this, 'add_theme_options' ) );
        }
    }

    public function init() {
        add_post_type_support( 'forum', 'thumbnail' );
    }

    public function add_theme_options ( $sections ) {
        $fields = array();
        $image_uri = trailingslashit( get_template_directory_uri() ) . 'images/templates/';

        $fields[] = array(
            'id'        => 'bbpress_forum_template',
            'priority'  => 10,
            'type'      => 'radio_img',
            'title'     => __( 'Forum Template', Redux_TEXT_DOMAIN ),
            'options'   => array(
                'sidebar_right'         => array(
                    'title' => 'Sidebar Right',
                    'img'   => $image_uri . 'g1_template_single_sidebar_right.png',
                ),
                'sidebar_left'         => array(
                    'title' => 'Sidebar Left',
                    'img'   => $image_uri . 'g1_template_single_sidebar_left.png',
                ),'full'         => array(
                    'title' => 'Full',
                    'img'   => $image_uri . 'g1_template_single_full.png',
                ),

            ),
        );

        $sections['bbpress'] = array(
            'priority'   => 1200,
            'icon'       => 'comments',
            'icon_class' => 'icon-large',
            'title'      => __( 'bbPress', Redux_TEXT_DOMAIN ),
            'fields'     => $fields
        );

        return $sections;
    }

    public function fix_nav_menu_css_class( $classes, $item ) {
        $blog_page_id = (int) g1_get_theme_option( 'post_type_post', 'page_for_posts' );
        $post_type = get_post_type();

        if ( in_array( $post_type, array('forum', 'topic', 'reply' ) ) ) {
            // Remove current_page_parent class from the blog index page
            if ( $blog_page_id == $item->object_id && 'page' == $item->object ) {

                $classes = array_diff( $classes, array( 'current_page_parent') );
            }
        }

        return $classes;
    }


    public function setup_sidebars ( $sidebars ) {
        $sidebars[] = 'bbpress';

        return $sidebars;
    }

    public function switch_breadcrumb_nav() {
        if ( is_bbpress() ) {
            remove_action( 'g1_content_begin', 'g1_add_breadcrumbs'  );
            add_action( 'g1_content_begin', array( $this, 'render_breadcrumb' ) );
        }
    }

    public function render_breadcrumb() {
        add_filter( 'bbp_no_breadcrumb', '__return_false' );
        bbp_breadcrumb();
        add_filter( 'bbp_no_breadcrumb', '__return_true' );
    }


    /**
     * Adjusts breadcrumb navigation markup to match the one from theme
     *
     * @param $args
     * @return mixed
     */
    public function adjust_breadcrumb_markup( $args ) {
        $args['before']         = '<nav class="g1-nav-breadcrumbs g1-meta"><p class="assistive-text">' . __( 'You are here:', 'g1_theme' ) . '</p><ol>';
        $args['after']          = '</ol></nav>';
        $args['sep']            = '';
        $args['sep_before']     = '';
        $args['sep_after']      = '';
        $args['crumb_before']   = '<li class="g1-nav-breadcrumbs__item">';
        $args['crumb_after']    = '</li>';
        $args['current_before'] = '';
        $args['current_after']  = '';
        $args['home_text']      = __( 'Home', 'g1_theme' );

        return $args;
    }



    //public function user_can_view_test( $retval, $forum_id, $user_id ) {
    //    return false;
    //}

    public function adjust_logout_link( $link, $redirect_to ) {
        $link = str_replace( 'class="button ', 'class="g1-button g1-button--small g1-button--solid ', $link );

        return $link;
    }



    public function alter_sub_forums() {
        add_filter( 'bbp_after_list_forums_parse_args', array( $this, 'bbp_after_list_forums_parse_args' ) );
    }

    public function bbp_after_list_forums_parse_args( $args ) {
        $args['before'] = '<div class="g1-links"><ul class="bbp-forums-list">';
        $args['after'] = '</ul></div>';
        $args['separator'] = '';

        return $args;
    }

    public function begin_bigger_avatars() {
        add_filter( 'bbp_after_get_topic_author_link_parse_args', array( $this, 'make_bigger_avatars' ) );
    }

    public function end_bigger_avatars() {
        remove_filter( 'bbp_after_get_topic_author_link_parse_args', array( $this, 'make_bigger_avatars' ) );
    }

    public function make_bigger_avatars( $args ) {
        $args['size'] = 40;

        return $args;
    }

    public function remove_small_avatars( $args ) {
        if ( 'both' === $args['type'] && 14 === $args['size'] ) {
//            $args['type'] = 'name';
            $args['size'] = 20;
        }

        return $args;
    }

    public function add_widget_class( $args ) {
        $args['classname'] .= ' g1-links';

        return $args;
    }
}

function G1_BBPress() {
    static $instance;

    if ( !isset( $instance ) )
        $instance = new G1_BBPress();

    return $instance;
}
// Fire in the hole :)
G1_BBPress();



add_filter( 'g1_dynamic_numeric_value', 'g1_bbp_user_count' );
function g1_bbp_user_count( $value ) {
    if ( 'bbp_user_count' === $value ) {
        $value = bbp_get_statistics( array(
                'count_users'           => true,
                'count_forums'          => !true,
                'count_topics'          => !true,
                'count_private_topics'  => !true,
                'count_spammed_topics'  => !true,
                'count_trashed_topics'  => !true,
                'count_replies'         => !true,
                'count_private_replies' => !true,
                'count_spammed_replies' => !true,
                'count_trashed_replies' => !true,
                'count_tags'            => !true,
                'count_empty_tags'      => !true
        ) );

        $value = $value[ 'user_count' ];
    }

    return $value;
}


add_filter( 'g1_dynamic_numeric_value', 'g1_bbp_forum_count' );
function g1_bbp_forum_count( $value ) {
    if ( 'bbp_forum_count' === $value ) {
        $value = bbp_get_statistics( array(
            'count_users'           => !true,
            'count_forums'          => true,
            'count_topics'          => !true,
            'count_private_topics'  => !true,
            'count_spammed_topics'  => !true,
            'count_trashed_topics'  => !true,
            'count_replies'         => !true,
            'count_private_replies' => !true,
            'count_spammed_replies' => !true,
            'count_trashed_replies' => !true,
            'count_tags'            => !true,
            'count_empty_tags'      => !true
        ) );

        $value = $value[ 'forum_count' ];
    }

    return $value;
}


add_filter( 'g1_dynamic_numeric_value', 'g1_bbp_topic_count' );
function g1_bbp_topic_count( $value ) {
    if ( 'bbp_topic_count' === $value ) {
        $value = bbp_get_statistics( array(
            'count_users'           => !true,
            'count_forums'          => !true,
            'count_topics'          => true,
            'count_private_topics'  => !true,
            'count_spammed_topics'  => !true,
            'count_trashed_topics'  => !true,
            'count_replies'         => !true,
            'count_private_replies' => !true,
            'count_spammed_replies' => !true,
            'count_trashed_replies' => !true,
            'count_tags'            => !true,
            'count_empty_tags'      => !true
        ) );

        $value = $value[ 'topic_count' ];
    }

    return $value;
}


add_filter( 'g1_dynamic_numeric_value', 'g1_bbp_reply_count' );
function g1_bbp_reply_count( $value ) {
    if ( 'bbp_reply_count' === $value ) {
        $value = bbp_get_statistics( array(
            'count_users'           => !true,
            'count_forums'          => !true,
            'count_topics'          => !true,
            'count_private_topics'  => !true,
            'count_spammed_topics'  => !true,
            'count_trashed_topics'  => !true,
            'count_replies'         => true,
            'count_private_replies' => !true,
            'count_spammed_replies' => !true,
            'count_trashed_replies' => !true,
            'count_tags'            => !true,
            'count_empty_tags'      => !true
        ) );

        $value = $value[ 'reply_count' ];
    }

    return $value;
}





