<?php
/**
 * This file belongs to the YIT Plugin Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( !defined( 'YIT' ) ) {
    exit;
} // Exit if accessed directly

/**
 * YIT Layout Options
 *
 * Manage the site options and postmeta
 *
 * @class      YIT_Layout
 * @package    Yitheme
 * @since      1.0
 * @author     Your Inspiration Themes
 */
class YIT_Layout_Options {


    /**
     * @var object The single instance of the class
     * @since 1.0
     */
    protected static $_instance = null;

    /**
     * @var \WP_Query The object of current page, retrieved when wp_query is istantiate
     * @since 1.0
     */
    protected $wp_query = null;

    private $static_pages = array();

    private $prefix = 'yit_lp_';

    /**
     * Main plugin Instance
     *
     * @static
     * @return object Main instance
     *
     * @since  1.0
     * @author Antonino Scarfi' <antonino.scarfi@yithemes.com>
     */
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     * Constructor
     *
     * @since  1.0
     * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
     */
    public function __construct() {


        add_action( 'save_post', array( $this, 'save_postdata' ) );
        add_action( 'wp_ajax_yit-layout-panel-save', array( $this, 'ajax_save_options' ) );
        add_action( 'wp_ajax_yit-layout-panel-clear', array( $this, 'ajax_clear_options' ) );

        /**
         * Set the params of current page i when the query of page is instantiate
         */
        add_action( 'wp', array( $this, 'set_param_current_page' ), 1 );
        add_action( 'admin_init', array( $this, 'set_param_current_page' ), 1 );

        $this->static_pages = array(
            'front-page'  => __( 'Front Page', 'yit' ),
            '404-page'    => __( '404 Page', 'yit' ),
            'search-page' => __( 'Search Page', 'yit' ),
        );
    }

    /**
     * Set the params of current page
     *
     * @return void
     * @since  1.0
     * @author Antonino Scarfi' <antonino.scarfi@gmail.com>
     */
    public function set_param_current_page() {
        global $wp_query;

        $this->wp_query = $wp_query;
        $this->wp_query->get_queried_object();
    }

    /**
     * Ajax Save Option
     *
     * is called when the "Save Option" in panel layout is clicked
     *
     * @return array
     * @since    1.0
     * @author   Emanuela Castorina <emanuela.castorina@yithemes.it>
     */
    public function ajax_save_options() {
        if ( !isset( $_POST['wpnonce'] ) || !wp_verify_nonce( $_POST['wpnonce'], 'yit-layout-panel-save-option' ) ) {
            return;
        }

        $ind           = YIT_Layout_Panel()->prefix . 'options';
        $current_panel = array(
            'model' => $_POST['panel_model'],
            'type'  => $_POST['panel_type'],
            'id'    => $_POST['panel_id'],

        );

        $validated_options = $this->options_validate( $_POST[$ind] );


        $opt_name      = YIT_Layout_Panel()->prefix . $current_panel['model'] . '_' . $current_panel['type'];
        $model_options = get_option( $opt_name );

        //replace the options for the current panel
        $model_options[$current_panel['id']] = $validated_options;

        //if is a page or or a post, this options must me saved in the post meta
        if ( $current_panel['id'] != 'all' && $current_panel['model'] == 'post_type' && ( $current_panel['type'] == 'page' || $current_panel['type'] == 'post' ) ) {
            $this->update_post_meta( $current_panel['id'], $validated_options );
        }

        //if save for all pages
        if ( $current_panel['id'] == 'all' && $current_panel['model'] == 'post_type' && ( $current_panel['type'] == 'page' || $current_panel['type'] == 'post' ) ) {
            $posts_ids = get_posts( 'fields=ids&post_type=' . $current_panel['type'] . '&posts_per_page=-1' );
            foreach ( $posts_ids as $id ) {
                if ( !$this->is_active_page_options( $id ) ) {
                    $model_options[$id] = $validated_options;
                    $this->update_post_meta( $id, $validated_options );
                }
            }
        }

        if ( update_option( $opt_name, $model_options ) ) {
            $message = '<div id="message" class="updated fade"><p><strong>' . __( 'Element updated correctly.', 'yit' ) . '</strong></p></div>';
        }
        else {
            $message = '<div id="message" class="error fade"><p><strong>' . __( 'Any options was saved.', 'yit' ) . '</strong></p></div>';
        }

        echo json_encode( $message );

        die();
    }

    /**
     * Ajax Reset Options
     *
     * is called when the "Clear Options" in panel layout is clicked
     *
     * @return array
     * @since    1.0
     * @author   Emanuela Castorina <emanuela.castorina@yithemes.it>
     */
    public function ajax_clear_options() {
        if ( !isset( $_POST['wpnonce'] ) || !wp_verify_nonce( $_POST['wpnonce'], 'yit-layout-panel-save-option' ) ) {
            return;
        }

        $ind           = YIT_Layout_Panel()->prefix . 'options';
        $current_panel = array(
            'model' => $_POST['panel_model'],
            'type'  => $_POST['panel_type'],
            'id'    => $_POST['panel_id'],

        );

        $opt_name      = YIT_Layout_Panel()->prefix . $current_panel['model'] . '_' . $current_panel['type'];
        $model_options = get_option( $opt_name );

        unset( $model_options[$current_panel['id']] );

        if ( update_option( $opt_name, $model_options ) ) {
            $message = '<div id="message" class="updated fade"><p><strong>' . __( 'Element updated correctly.', 'yit' ) . '</strong></p></div>';
        }
        else {
            $message = '<div id="message" class="error fade"><p><strong>' . __( 'Any options was saved.', 'yit' ) . '</strong></p></div>';
        }

        echo json_encode( $message );

        die();
    }

    /**
     * Option validate
     *
     * validate the option of input return the option validate
     *
     * @param $input
     *
     * @internal param $postid
     * @internal param $panel_values
     *
     * @return array
     * @since    1.0
     * @author   Emanuela Castorina <emanuela.castorina@yithemes.it>
     */
    public function options_validate( $input ) {

        $panel_options = YIT_Layout_Panel()->options;

        $valid_input = array();
        foreach ( $panel_options as $id_box => $box ) {
            if ( isset( $box['fields'] ) ) {
                foreach ( $box['fields'] as $id_field => $field ) {
                    if ( $id_field == 'sep' ) {
                        continue; //for separator
                    }
                    if ( isset( $input[$id_box][$id_field] ) ) {
                        $valid_input[$id_box][$id_field] = $input[$id_box][$id_field];
                    }
                    else {
                        $valid_input[$id_box][$id_field] = 'no';
                    }
                }
            }
        }

        return $valid_input;
    }

    /**
     * Update Post Meta
     *
     * update post meta if the type is post_type
     *
     * @param $postid
     * @param $panel_values
     *
     * @return void
     * @since    1.0
     * @author   Emanuela Castorina <emanuela.castorina@yithemes.it>
     */
    public function update_post_meta( $postid, $panel_values ) {
        foreach ( $panel_values as $box ) {
            foreach ( $box as $key => $field ) {
                update_post_meta( $postid, '_' . $key, $field );
            }
        }
    }

    /**
     * Save Post Data
     *
     * when a post o a page is saved, this function save also in option panel
     *
     * @param $post_id
     *
     * @return int
     * @since  1.0
     * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
     */
    public function save_postdata( $post_id ) {


        if ( !isset( $_POST['yit_metaboxes_nonce'] ) || !wp_verify_nonce( $_POST['yit_metaboxes_nonce'], 'metaboxes-fields-nonce' ) ) {
            return $post_id;
        }

        if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
            return $post_id;
        }

        if ( isset( $_POST['post_type'] ) ) {
            $post_type = $_POST['post_type'];
        }
        else {
            return $post_id;
        }
        if ( 'page' == $post_type ) {
            //check is user can edit the page or if metabox is active
            if ( !current_user_can( 'edit_page', $post_id ) || !$this->is_active_page_options( $post_id ) ) {
                return $post_id;
            }
        }
        elseif ( 'post' == $post_type ) {
            if ( !current_user_can( 'edit_post', $post_id ) || !$this->is_active_page_options( $post_id ) ) {
                return $post_id;
            }
        }


        $opt_name        = YIT_Layout_Panel()->prefix . 'post_type_' . $_POST['post_type'];
        $panel_options   = YIT_Layout_Panel()->options;
        $panel_db_option = get_option( $opt_name );

        if ( !isset( $_POST['yit_metaboxes'] ) ) {
            return $post_id;
        }
        else {
            $yit_meta = $_POST['yit_metaboxes'];
        }

        if ( !isset( $yit_meta['_active_page_options'] ) ) {
            return $post_id;
        }

        $new_values = array();
        foreach ( $panel_options as $key => $option_value ) {
            if ( isset( $option_value['post_types'] ) && ! in_array( get_post_type( $post_id ), (array) $option_value['post_types'] ) ) {
                continue;
            }

            foreach ( $option_value['fields'] as $field_id => $field ) {
                if ( isset( $field['post_types'] ) && ! in_array( get_post_type( $post_id ), (array) $field['post_types'] ) ) {
                    continue;
                }

                if ( isset( $yit_meta['_' . $field_id] ) ) {

                    $new_values[$key][$field_id] = $yit_meta['_' . $field_id];
                }
                elseif ( $field['type'] == 'onoff' ) {

                    $new_values[$key][$field_id] = 'no';
                }
                elseif ( $field['type'] == 'checkbox' ) {
                    $new_values[$key][$field_id] = 0;
                }
            }
        }


        //update the panel options with this new values

        $panel_db_option[$post_id] = $new_values;

        update_option( $opt_name, $panel_db_option );


    }

    /**
     * Get Option
     *
     * get an option from db, if this option doesn't exists return an empty string
     *
     * @param        $key   the id of the option can be an integer or a string "all","404", "front-page"
     * @param bool   $id    is the id of the page/post/category/taxonomy/format/static page/author
     * @param string $type  is the type of the page/post/category/post_tag/author/
     * @param string $model can be taxonomy, post_type, static, author, site
     *
     * @internal param $post_id
     *
     * @return mixed
     * @since    1.0
     * @author   Emanuela Castorina <emanuela.castorina@yithemes.it>
     */
    public function get_option( $key, $id = false, $type = 'post', $model = 'post_type' ) {

        if( strpos( $type , 'pa_' ) ) {
            $id = false;
            $type = 'post';
            $model = 'post_type' ;
        }

        if ( !empty( $this->wp_query ) ) {
            $wp = $this->wp_query;
            $qo = $wp->get_queried_object();
        }
        elseif ( !$id && empty( $this->wp_query ) && isset( $GLOBALS['post'] ) ) {
            $id   = $GLOBALS['post']->ID;
            $type = $GLOBALS['post']->post_type;
        }
        else {
            global $wp_query;
            $wp = $wp_query;
            $qo = $wp->get_queried_object();
        }

        if ( !$id ) {

            if ( $wp->is_page() ) {
                $type = 'page';
                $id   = $qo->ID;
            }
            elseif ( $wp->is_single() ) {
                $id   = $qo->ID;
                $type = $qo->post_type;
            }
            elseif ( $wp->is_category() ) {
                $id    = $wp->get_queried_object()->term_id;
                $model = 'taxonomy';
                $type  = 'category';
            }
            elseif ( $wp->is_tag() ) {
                $model = 'taxonomy';
                $type  = 'post_tag';
                $id    = intval( $wp->get( 'tag_id' ) );
            }
            elseif ( $wp->is_tax() ) {
                $model = 'taxonomy';
                $type  = $wp->get( 'taxonomy' );
                if( isset( $qo ) && is_object( $qo ) ) {
                    $id    = $qo->term_id;
                    $type  =  $qo->taxonomy;
                }
            }
            elseif ( $wp->is_author() ) {
                $model = 'author';
                $type  = 'author';
                $id    = isset( $qo->ID ) ? $qo->ID : '';
            }
            elseif ( $wp->is_posts_page ) {
                $type = 'page';
                $id    = get_option( 'page_for_posts' );
            }
            elseif ( function_exists( 'is_shop' ) && is_shop() ) {
                $id    = wc_get_page_id( 'shop' );
                $model = 'post_type';
                $type  = 'page';
            }
            elseif ( $wp->is_404() || $wp->is_front_page() || $wp->is_search() || $wp->is_home() ) {
                $model = 'post_type';
                $type  = 'page';
                if ( $wp->is_404() ) {
                    $id = '404-page';
                }
                elseif ( $wp->is_front_page() || $wp->is_home() ) {
                    $id = 'front-page';
                }
                elseif ( $wp->is_search() ) {
                    $id = 'search-page';
                }
            }
            else {
                $model = 'site';
                $type  = 'site';
                $id    = 'all';
            }
        }


        $opt_name        = YIT_Layout_Panel()->prefix . $model . '_' . $type;

        $panel_db_site   = get_option( YIT_Layout_Panel()->prefix . 'site_site' );
        $panel_db_option = get_option( $opt_name );

        //check if option is defined in post meta
        if ( $id != 'all' ) {
            $validate = false;

            $options = YIT_Layout_Panel()->options;
            foreach ( $options as $box_id => $option ) {
                foreach ( $option['fields'] as $id_tab => $field ) {
                    if ( $id_tab == $key ) {
                        $validate = true;
                        break 2;
                    }
                }
            }

            // check if the option is valid for post type
            if ( $validate && isset( $option['post_types'] ) && ! in_array( $type, (array) $option['post_types'] ) ) {
                return false;
            }

            if ( $validate && isset( $field['post_types'] ) && ! in_array( $type, (array) $field['post_types'] ) ) {
                return false;
            }

            switch ( $type ) {
                case 'page':
                    $value = ( $this->is_active_page_options( $id ) ) ? get_post_meta( $id, '_' . $key ) : array();

                    if ( !empty( $value[0] ) ) {
                        $return = $value[0];
                    }
                    elseif ( isset( $panel_db_option[$id] ) && ( $val = $this->search_key( $key, $panel_db_option[$id] ) ) !== false ) {
                        $return = $val;
                    }
                    elseif ( isset( $this->static_pages[$id] ) ) {
                        //return the options of a static page
                        $search = ( isset( $panel_db_option[$id] ) ) ? $this->search_key( $key, $panel_db_option[$id] ) : false;

                        if ( !$search ) {
                            $return = $this->get_option( $key, 'all', $type, $model );
                        }
                        else {
                            $return = $search;
                        }
                    }
                    else {
                        //check the all layout options for posts or site
                        $return = $this->get_option( $key, 'all', $type, $model );
                    }

                    break;

                case 'post':
                    $value = ( $this->is_active_page_options( $id ) ) ? get_post_meta( $id, '_' . $key ) : array();

                    if ( !empty( $value ) ) {
                        //return the options of single post (postmeta)
                        $return = $value[0];
                    }
                    elseif ( isset( $panel_db_option[$id] ) && ( $v = $this->search_key( $key, $panel_db_option[$id] ) ) !== false ) {
                        //return the options of single from layout
                        $return = $v;
                    }
                    else {
                        //return the options of format if exists
                        $format = get_post_format( $id );
                        if ( false === $format ) {
                            $format = 'standard';
                        }
                        $panel_db_format = get_option( YIT_Layout_Panel()->prefix . 'taxonomy_post_format' );
                        $term            = get_term_by( 'slug', 'post-format-' . $format, 'post_format' );
                        if ( isset( $term->term_id ) && isset( $panel_db_format[$term->term_id] ) && $v = $this->search_key( $key, $panel_db_format[$term->term_id] ) ) {
                            $return = $v;
                        }
                        else {
                            //check the all layout options for posts or site
                            $return = $this->get_option( $key, 'all', $type, $model );
                        }
                    }

                    break;

                default:

                    if ( isset( $panel_db_option[$id] ) && $v = $this->search_key( $key, $panel_db_option[$id] ) ) {
                        //return the options of single from layout
                        $return = $v;
                    }
                    else {
                        $return = $this->get_option( $key, 'all', $type, $model );
                    }
            }
        }
        else {

            if ( isset( $panel_db_option['all'] ) ) {
                $return = $this->search_key( $key, $panel_db_option['all'] );
            }

            elseif ( isset( $panel_db_site['all'] ) ) {
                $return = $this->search_key( $key, $panel_db_site['all'] );
            }

            else {
                $return = '';
            }
        }

        return apply_filters( 'yit_get_option_layout', $return, $key, $id, $type, $model );
    }

    /**
     * Search Key
     *
     * search the key inside an array and return the value or false
     *
     * @param string $needle   the key
     * @param array  $haystack the array in witch search the key
     *
     * @return mixed
     * @since    1.0
     * @author   Emanuela Castorina <emanuela.castorina@yithemes.it>
     */
    public function search_key( $needle, $haystack ) {
        if ( !empty( $haystack ) ) {
            foreach ( $haystack as $element ) {
                if ( isset( $element[$needle] ) ) {

                    return $element[$needle];
                }
            }
        }
        return false;
    }

    /**
     * Is Active Option
     *
     * if is a page or post return true is the option _active_page_options is true
     *
     * @param $post_id
     *
     *
     * @return bool
     * @since    1.0
     * @author   Emanuela Castorina <emanuela.castorina@yithemes.it>
     */
    public function is_active_page_options( $post_id ) {
        $return = get_post_meta( $post_id, '_active_page_options', true );
        return ( $return == '' || $return == 0 ) ? false : true;
    }

    /**
     * Add Default  Options
     *
     * Add custom options in database
     *
     * @return void
     * @since    1.0
     * @author   Emanuela Castorina <emanuela.castorina@yithemes.it>
     */
    public function add_default_options() {
        $model_options  = get_option( $this->prefix . 'site_site' );
        $panel_options  = YIT_Layout_Panel()->options;
        $default_option = array();
        if ( !$model_options ) {
            foreach ( $panel_options as $id_box => $box ) {
                if ( isset( $box['fields'] ) ) {
                    foreach ( $box['fields'] as $id_field => $field ) {
                        if ( isset( $field['std'] ) ) {
                            $default_option['all'][$id_box][$id_field] = $field['std'];
                        }
                    }
                }
            }
        }

        add_option( $this->prefix . 'site_site', $default_option );
    }

}

/**
 * Main instance of plugin
 *
 * @return \YIT_Layout_Options
 * @since  1.0
 * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
 */
function YIT_Layout_Options() {
    return YIT_Layout_Options::instance();
}

/**
 * Instantiate Sidebar class
 *
 * @since  1.0
 * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
 */
YIT_Layout_Options();