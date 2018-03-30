<?php
/**
 * This file is part of the G1_Framework package.
 *
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Framework
 * @subpackage G1_Features
 * @since G1_Features 1.0.0
 */

// Prevent direct script access
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );
?>
<?php


class G1_Template {
    protected $id;
    protected $label;
    protected $file;
    protected $icon;

    protected $post_types;

    public function __construct( $id, $args ) {
        $this->set_id( $id );
        $this->set_file( $args['file'] );
        $this->set_label( isset( $args['label'] ) ? $args['label'] : $this->get_id() );
        $this->set_icon( isset( $args['icon'] ) ? $args['icon'] : '' );

        $this->post_types = isset( $args['post_types'] ) ? $args['post_types'] : array();
    }


    public function get_id() {  return $this->id; }
    public function set_id( $val ) { $this->id = $val; }

    public function get_label() {  return $this->label; }
    public function set_label( $val ) { $this->label = $val; }



    /**
     * Gets the file
     *
     * @return string
     */
    public function get_file() {
        return $this->file;
    }

    /**
     * Sets the file
     *
     * @param string
     */
    public function set_file( $val ) {
        $this->file = $val;
    }

    /**
     * Gets the icon
     *
     * @return string
     */
    public function get_icon() {
        return $this->icon;
    }

    /**
     * Sets the icon
     *
     * @param string
     */
    public function set_icon( $val ) {
        $this->icon = $val;
    }


    public function has_post_type( $post_type ) {
        return in_array( $post_type, $this->post_types );
    }

    public function add_post_type( $post_type ) {
        if ( !$this->has_post_type( $post_type ) ) {
            $this->post_types[] = $post_type;
        }
    }

    public function remove_post_type( $post_type ) {
        if ( $this->has_post_type( $post_type ) ) {
            unset( $this->post_types[ $post_type ] );
        }
    }

    public function get_post_types() {
        return $this->post_types;
    }
}


class G1_Collection {
    protected $id;
    protected $file;
    protected $classes;
    protected $image_size;
    protected $lighbox_group;
    protected $force_placeholder;

    protected $post_types;

    public function __construct( $id, $args ) {
        $this->set_id( $id );

        $this->set_file( $args['file'] );
        $this->set_classes( $args['classes'] );
        $this->set_image_size( $args['image_size'] );
        $this->set_lightbox_group( $args['lightbox_group'] );
        $this->set_force_placeholder( $args['force_placeholder'] );

        $this->post_types = isset( $args['post_types'] ) ? $args['post_types'] : array();
    }


    public function get_id() { return $this->id; }
    public function set_id( $val ) { $this->id = $val; }

    public function get_file() { return $this->file; }
    public function set_file( $val ) { $this->file = $val; }

    public function get_image_size() { return $this->image_size; }
    public function set_image_size( $val ) { $this->image_size = $val; }

    public function get_lightbox_group() { return $this->lightbox_group; }
    public function set_lightbox_group( $val ) { $this->lightbox_group = $val; }

    public function get_force_placeholder() { return $this->force_placeholder; }
    public function set_force_placeholder( $val ) { $this->force_placeholder = $val; }


    public function has_post_type( $post_type ) {
        return in_array( $post_type, $this->post_types );
    }

    public function add_post_type( $post_type ) {
        if ( !$this->has_post_type( $post_type ) ) {
            $this->post_types[ $post_type ] = $post_type;
        }
    }

    public function remove_post_type( $post_type ) {
        if ( $this->has_post_type( $post_type ) ) {
            unset( $this->post_types[ $post_type ] );
        }
    }

    public function get_post_types() {
        return $this->post_types;
    }



    public function has_class( $class ) {
        return in_array( $class, $this->classes );
    }

    public function add_class( $class ) {
        if ( !$this->has_class( $class ) ) {
            $this->classes[ $class ] = $class;
        }
    }

    public function remove_class( $class ) {
        if ( $this->has_class( $class ) ) {
            unset( $this->classes[ $class ] );
        }
    }

    public function get_classes() {
        return array_merge( array( 'g1-collection' => 'g1-collection' ), $this->classes );
    }

    public function set_classes( $val ) {
        $this->classes = $val;
    }
}



class G1_Collection_Manager {
    protected $collections;

    public function __construct() {
        $this->collections = array();

        $this->setup_hooks();
    }

    protected function setup_hooks() {
        // Register templates before the WP Customizer is ready
        add_action( 'wp_loaded',    array( $this, 'do_register' ), 8 );
    }

    public function do_register() {
        do_action( 'g1_collections_register', $this );
    }


    /**
     * Adds a collection
     *
     * @param string $id
     * @param array $args
     */
    public function add_collection( $id, $args = array() ) {
        if ( is_a( $id, 'G1_Collection' ) ) {
            $collection = $id;
        } else {
            $collection = new G1_Collection( $id, $args );
        }

        // Add
        $this->collections[ $id ] = $collection;
    }



    /**
     * Checks whether a collection is available
     *
     * @param   string $id
     * @return  bool
     */
    public function has_collection( $id ) {
        return isset( $this->collections[ $id ] ) ? true : false;
    }



    /**
     * Returns a collection
     *
     * @param  string $id
     * @return G1_Collection
     */
    public function get_collection( $id ) {
        // Normalize the name of a template
        $id = str_replace( '-', '_', $id );

        if ( !isset( $this->collections[ $id ] ) ) {
            return false;
        }

        return $this->collections[ $id ];
    }



    /**
     * Returns an array of available collection choices
     *
     * @return array
     */
    public function get_collection_choices( $args = array() ) {
        $post_type = isset ( $args['post_type'] ) ? $args['post_type'] : 'any';

        $choices = array();
        foreach ( $this->collections as $id => $collection ) {
            if ( 'any' === $post_type || $collection->has_post_type( $post_type ) ) {
                $choices[ $id ] = $collection->get_id();
            }
        }

        return $choices;
    }
}
function G1_Collection_Manager() {
    static $instance = null;

    if ( null === $instance ) {
        $instance = new G1_Collection_Manager();
    }

    return $instance;
}
// Fire in the hole :)
G1_Collection_Manager();







class G1_Template_Manager {
    protected $id;

    protected $templates;

    protected $template_base_class;

    public function __construct( $id ) {
        $this->set_id( $id );

        $this->templates = array();

        $this->set_template_base_class( 'G1_Template' );

        $this->setup_hooks();
    }

    protected function setup_hooks() {
        // Register templates before the WP Customizer is ready
        add_action( 'wp_loaded',    array( $this, 'do_register' ), 8 );
    }

   public function do_register() {
       do_action( $this->get_id() . '_register', $this );
   }

    /**
     * Gets the id
     *
     * @return string
     */
    public function get_id() {
        return $this->id;
    }

    /**
     * Sets the id
     *
     * @param string
     */
    public function set_id( $val ) {
        $this->id = $val;
    }

    /**
     * Adds a template
     *
     * @param   string $id
     * @param   array $args
     */
    public function add_template( $id, $args = array() ) {
        if ( is_a( $id, $this->template_base_class ) ) {
            $template = $id;
        } else {
            $template = new $this->template_base_class( $id, $args );
        }

        // Add
        $this->templates[ $id ] = $template;
    }



    /**
     * Checks whether a template is available
     *
     * @param   string $id
     * @return  bool
     */
    public function has_template( $id ) {
        return isset( $this->templates[ $id ] ) ? true : false;
    }



    /**
     * Returns a template
     *
     * @param           string $id
     * @return          array
     */
    public function get_template( $id ) {
        // Normalize the name of a template
        $id = str_replace( '-', '_', $id );

        if ( !isset( $this->templates[ $id ] ) ) {
            return false;
        }

        return $this->templates[ $id ];
    }



    /**
     * Returns an array of available template choices
     *
     * @return array
     */
    public function get_templates_choices( $args = array() ) {
        $post_type = isset ( $args['post_type'] ) ? $args['post_type'] : 'any';

        $choices = array();
        foreach ( $this->templates as $id => $template ) {
            if ( 'any' === $post_type || $template->has_post_type( $post_type ) ) {
                $choices[ $id ] = $template->get_icon();
            }
        }

        return $choices;
    }



    public function get_template_base_class() {
        return $this->template_base_class;
    }

    public function set_template_base_class( $val ) {
        $this->template_base_class = $val;
    }
}



function G1_Archive_Template_Manager() {
    static $instance = null;

    if ( null === $instance ) {
        $instance = new G1_Template_Manager( 'g1_archive_templates' );
    }

    return $instance;
}
// Fire in the hole :)
G1_Archive_Template_Manager();


function G1_Single_Template_Manager() {
    static $instance = null;

    if ( null === $instance ) {
        $instance = new G1_Template_Manager( 'g1_single_templates' );
    }

    return $instance;
}
// Fire in the hole :)
G1_Single_Template_Manager();



class G1_Archive_Page_Feature {
    public function __construct() {
        $this->setup_hooks();

        $this->feature = 'g1-archive-page';
    }

    /**
     * Set up all hooks
     */
    protected function setup_hooks() {
        add_filter( get_redux_opts_sections_filter_name(), array( $this, 'add_post_type_settings' ), 12 );

        add_filter( 'request', array( $this, 'alter_request') );

        add_filter( 'nav_menu_css_class', array( $this, 'fix_nav_menu_css_class'), 10, 2);

        add_filter( 'post_type_archive_title', array( $this, 'alter_post_type_archive_title' ) );
    }

    public function get_post_types() {
        // Get post types with support for our feature
        $post_types = array();
        foreach ( get_post_types() as $post_type ) {
            if ( post_type_supports( $post_type, $this->feature ) ) {
                $post_types[ $post_type ] = $post_type;
            }
        }

        return $post_types;
    }

    /**
     * Add some stuff to the Theme Options Panel
     *
     * @param $sections
     */
    public function add_post_type_settings( $sections ) {
        foreach ( $this->get_post_types() as $post_type ) {
            $id = 'post_type_' . $post_type . '_page_for_posts';
            $section_id = G1_Archive_Settings_Feature()->get_section_id( $post_type );

            if ( !empty($sections[$section_id]) ) {
                $options = array( '' => '' );
                $options = $options + G1_Pages_Module()->get_choices();

                $std = '';
                if (!empty($options)) {
                    $std = array_keys($options);
                    $std = $std[0];
                }

                $sections[$section_id]['fields'][] = array(
                    'id'        => $id,
                    'priority'  => 10,
                    'type'      => 'select',
                    'title'     => __( 'Archive Page', Redux_TEXT_DOMAIN ),
                    'sub_desc'  =>
                        '<p>' . __( 'A few points about this page:', Redux_TEXT_DOMAIN ) . '</p>' .
                        '<ul>' .
                            '<li>' . __( 'A page template will be ignored. Instead one of the below templates will be used.', Redux_TEXT_DOMAIN ) . '</li>' .
                            '<li>' . __( 'Any content will be ignored.', Redux_TEXT_DOMAIN ) . '</li>' .
                            '<li>' . __( 'All other elements ( like title, sidebar, background, etc. ) should work fine.', Redux_TEXT_DOMAIN ) . '</li>' .
                        '</ul>',
                    'options'   => $options,
                    'std'       => $std
                );
            }
        }

        return $sections;
    }

    /**
     * Alternates page link, so that it points to the post type archive.
     *
     * It hooks into the page_link filter.
     *
     * @param string $link
     * @param integer $id
     * @param bool $sample *
     * @return string
     */
    public function page_link( $link, $id, $sample ) {
        //$index = absint( g1_get_theme_option( 'post_type_' , ) );

        // WPML fallback
        if ( G1_WPML_LOADED )
            $index = absint( icl_object_id( $index, 'page', true ) );


        if ( $index === $id )
            return get_post_type_archive_link( $this->get_post_type() );


        return $link;
    }



    public function get_page_id( $post_type ) {
        $page_id = (int) g1_get_theme_option( 'post_type_' . $post_type, 'page_for_posts' );

        return $page_id;
    }

    /**
     * Alternates request
     *
     * @param array $request
     * @return array
     */
    public function alter_request( $request ) {
        if ( is_admin() ) {
            return $request;
        }

        $mapping = array();
        foreach ( $this->get_post_types() as $post_type ) {
            $page_id = (int) g1_get_theme_option( 'post_type_' . $post_type, 'page_for_posts' );
            if ( $page_id )
                $mapping[ $post_type ] = $page_id;
        }

        foreach ( $mapping as $post_type => $page_id ) {
            // WPML fallback
            if ( G1_WPML_LOADED )
                $page_id = absint( icl_object_id( $page_id, 'page', true ) );

            if ( $page_id ) {
                // The query isn't run if we don't pass any query vars
                $query = new WP_Query();
                $query->parse_query( $request );

                // Change request from page to post type archive
                if ( $query->is_page() ) {

                    if ( absint( $query->get( 'page_id' ) ) === $page_id || ( strlen( $query->get('pagename') ) && absint( $query->get_queried_object_id() ) === $page_id) ) {
                        unset( $request[ 'page' ] );
                        unset( $request[ 'page_id' ] );
                        unset( $request[ 'pagename' ] );

                        $request[ 'post_type'] = $post_type;
                    }


                }
            }
        }
        return $request;
    }

    /**
     * Fixes CSS classes in custom navigation menus.
     *
     * @param array $classes
     * @param object $item
     */
    public function fix_nav_menu_css_class( $classes, $item ) {
        foreach ( $this->get_post_types() as $post_type ) {
            if ( $post_type === get_post_type() ) {
                $page_id = (int) g1_get_theme_option( 'post_type_' . $post_type, 'page_for_posts' );

                if ( $page_id ) {
                    // WPML fallback
                    if ( G1_WPML_LOADED )
                        $page_id = absint( icl_object_id( $page_id, 'page', true ) );

                    // Add current_page_parent class to the index page
                    if ( $page_id == $item->object_id && 'page' == $item->object ) {
                        $classes[] = 'current_page_parent';
                    }
                }
            }
        }

        return $classes;
    }



    public function alter_post_type_archive_title( $title ) {
        if ( ! is_post_type_archive() ) {
            return $title;
        }

        $post_type_obj = get_queried_object();

        // Is our feature supported?
        if ( in_array( $post_type_obj->name, $this->get_post_types() ) ) {
            $page_id = $this->get_page_id( $post_type_obj->name );

            if ( $page_id ) {
                // WPML fallback
                if ( G1_WPML_LOADED )
                    $page_id = icl_object_id( $page_id, 'page', true );

                if ( $page_id ) {
                    $title = get_the_title( $page_id );
                }
            }
        }

        return $title;
    }

}
/**
 * Quasi-singleton for our feature
 *
 * @return G1_Archive_Page_Feature
 */
function G1_Archive_Page_Feature() {
    static $instance;

    if ( !isset ( $instance ) )
        $instance = new G1_Archive_Page_Feature();


    return $instance;
}
// Fire in the hole :)
G1_Archive_Page_Feature();



class G1_Archive_Posts_Per_Page_Feature {
    public function __construct() {
        $this->setup_hooks();

        $this->global_feature = 'g1-global-archive-posts-per-page';
        $this->individual_feature = 'g1-individual-archive-posts-per-page';
    }

    /**
     * Set up all hooks
     */
    protected function setup_hooks() {
        add_filter( get_redux_opts_sections_filter_name(),   array( $this, 'register_global_post_type_setting' ), 12 );
        add_filter( get_redux_opts_sections_filter_name(),   array( $this, 'register_global_taxonomy_setting' ), 12 );

        add_action( 'g1_term_meta_manager_register', array( $this, 'register_individual_term_setting') );

        add_action( 'pre_get_posts',        array( $this, 'alter_post_type_archive' ), 1 );
        add_action( 'pre_get_posts',        array( $this, 'alter_taxonomy_archive' ), 1 );
    }

    /**
     * Gets post_types with support for our features
     *
     * @param array $features
     */
    protected function get_post_types( $features ) {

        $post_types = get_post_types();
        foreach ( $post_types as $key => $value ) {
            foreach ( $features as $feature ) {
                if ( !post_type_supports( $value, $feature ) ) {
                    unset( $post_types[ $key ] );
                }
            }
        }

        return $post_types;
    }

    /**
     * Gets taxonomies with support for our features
     *
     * @param array $features
     */
    protected function get_taxonomies( $features ) {
        $taxonomies = get_taxonomies();
        foreach ( $taxonomies as $key => $value ) {
            foreach ( $features as $feature ) {
                if ( !taxonomy_supports( $value, $feature ) ) {
                    unset( $taxonomies[ $key ] );
                }
            }
        }

        return $taxonomies;
    }

    protected function get_individual_setting_id() {
        $setting_id = 'posts_per_page';

        return $setting_id;
    }


    /**
     * Registers the setting in the Term Meta Manager
     *
     * @param G1_Term_Meta_Manager $manager
     */
    public function register_individual_term_setting( $manager ) {
        // Get post types with support for required feature
        $taxonomies = $this->get_taxonomies(array(
            $this->individual_feature
        ));

        if ( count( $taxonomies ) ) {
            $setting_id = '_g1[' . $this->get_individual_setting_id() . ']';

            $manager->add_setting( $setting_id, array(
                'apply'	   	=> $taxonomies,
                'view'      => new G1_Form_Text_Control( $setting_id, array(
                    'label'     => __( 'Entries Per Page', 'g1_theme' ),
                    'hint'      => __( 'Leave empty to inherit, set -1 to show all', 'g1_theme' ),
                )),
                'section'	=> 'g1_term_single', //G1_Single_Entry_Settings_Feature()->get_section_id(),
                'priority'	=> 201,
            ));
        }
    }





    /**
     * Add some stuff to the Theme Options Panel
     *
     * @param $sections
     */
    public function register_global_post_type_setting( $sections ) {
        // Get post types with support for our feature
        $post_types = $this->get_post_types(array(
            $this->global_feature,
        ));

        foreach ( $post_types as $post_type ) {
            $id = 'post_type_' . $post_type . '_posts_per_page';
            $section_id = G1_Archive_Settings_Feature()->get_section_id( $post_type );

            if ( !empty($sections[$section_id]) ) {

                // @todo Maybe we should move this info to a more generic feature?
                $sections[$section_id]['fields'][] = array(
                    'id'        => 'post_type_' . $post_type . '_collection_info',
                    'priority'  => 200,
                    'type'      => 'info',
                    'desc'      =>
                        '<h4>' . __( 'Collection Options', Redux_TEXT_DOMAIN ) . '</h4>',
                );

                $sections[$section_id]['fields'][] = array(
                    'id'        => $id,
                    'priority'  => 201,
                    'type'      => 'text',
                    'title'     => __( 'Entries Per Page', Redux_TEXT_DOMAIN ),
                    'validate'  => 'numeric',
                    'std'       => 12
                );
            }
        }

        return $sections;
    }



    /**
     * Add some stuff to the Theme Options Panel
     *
     * @param $sections
     */
    public function register_global_taxonomy_setting( $sections ) {
        // Get taxonomies with support for our feature
        $taxonomies = $this->get_taxonomies(array(
            $this->global_feature,
        ));

        foreach ( $taxonomies as $taxonomy ) {
            $id = 'taxonomy_' . $taxonomy . '_posts_per_page';
            $section_id = G1_Archive_Settings_Feature()->get_section_id( $taxonomy, 'taxonomy' );

            if ( !empty($sections[$section_id]) ) {
                // @todo Maybe we should move this info to a more generic feature?
                $sections[$section_id]['fields'][] = array(
                    'id'        => 'taxonomy_' . $taxonomy . '_collection_info',
                    'priority'  => 200,
                    'type'      => 'info',
                    'desc'      =>
                    '<h4>' . __( 'Collection Options', Redux_TEXT_DOMAIN ) . '</h4>',
                );
                $sections[$section_id]['fields'][] = array(
                    'id'        => $id,
                    'priority'  => 201,
                    'type'      => 'text',
                    'title'     => __( 'Entries Per Page', Redux_TEXT_DOMAIN ),
                    'validate'  => 'numeric',
                    'std'       => 12
                );
            }
        }

        return $sections;
    }

    /**
     * Alternates the 'posts_per_page' query_var on post type archive pages
     *
     * @param WP_Query $query
     */
    public function alter_post_type_archive( $query ) {
        if ( is_admin() || !$query->is_main_query() )
            return;

        if ( !$query->is_home() && !$query->is_post_type_archive() )
            return;

        $post_type = 'post';

        if ( !is_home() ) {
            // Get query var
            $post_type = $query->get( 'post_type' );
        }


        if ( post_type_supports( $post_type, $this->global_feature ) ) {
            $posts_per_page = (int) g1_get_theme_option( 'post_type_' . $post_type,  'posts_per_page' );

            if ( -1 === $posts_per_page || $posts_per_page > 0 ) {
                $query->set( 'posts_per_page', $posts_per_page );
            }
        }
    }

    /**
     * Alternates the 'posts_per_page' query_var on taxonomy archive pages
     *
     * @todo Correct taxonomy value ?
     *
     * @param WP_Query $query
     */
    public function alter_taxonomy_archive( $query ) {
        if ( is_admin() || !$query->is_main_query() )
            return;

        if ( ! ( $query->is_tax() || $query->is_category() || $query->is_tag() ) )
            return;

        if ( is_tax() ) {
            // Get query var
            $taxonomy = $query->tax_query->queries[0]['taxonomy'];
            $tax_obj = get_taxonomy( $taxonomy );
            $query_var = $tax_obj->query_var;

            if ( $query->get( $taxonomy ) ) {
                $term = get_term_by( 'slug', $query->get( $query_var ), $taxonomy );
            }
        } elseif ( is_category() ) {
            $taxonomy = 'category';

            if ( $query->get( 'cat' ) ) {
                $term = get_term( $query->get( 'cat' ), 'category' );
            } elseif ( $query->get( 'category_name' ) ) {
                $term = get_term_by( 'slug', $query->get( 'category_name' ), 'category' );
            }
        } elseif ( is_tag() ) {
            $taxonomy = 'post_tag';

            if ( $query->get('tag_id') ) {
                $term = get_term( $query->get('tag_id'), 'post_tag' );
            } else {
                $term = get_term_by( 'slug', $query->get( 'tag' ), 'post_tag' );
            }
        }

        if ( taxonomy_supports( $taxonomy, $this->global_feature ) ) {
            $posts_per_page = (int) g1_get_theme_option( 'taxonomy_' . $taxonomy,  'posts_per_page' );

            if ( -1 === $posts_per_page || $posts_per_page > 0 ) {
                $query->set( 'posts_per_page', $posts_per_page );
            }
        }

        if ( taxonomy_supports( $taxonomy, $this->individual_feature ) ) {
            if ( $term ) {
                $term_meta = (array) g1_get_term_meta( $term->term_id, '_g1' );

                $posts_per_page = isset( $term_meta['posts_per_page'] ) ? (int) $term_meta['posts_per_page'] : 0;

                if ( -1 === $posts_per_page || $posts_per_page > 0 ) {
                    $query->set( 'posts_per_page', $posts_per_page );
                }
            }
        }
    }
}
new G1_Archive_Posts_Per_Page_Feature();

class G1_Rewrite_Slug_Feature {
    public function __construct() {
        $this->setup_hooks();

        $this->global_feature = 'g1-global-rewrite-slug';
        $this->individual_feature = 'g1-individual-rewrite-slug';
    }

    /**
     * Set up all hooks
     */
    protected function setup_hooks() {
        add_filter( get_redux_opts_sections_filter_name(),   array( $this, 'register_post_type_setting' ), 12 );
        add_filter( get_redux_opts_sections_filter_name(),   array( $this, 'register_taxonomy_setting' ), 12 );
    }

    /**
     * Gets post_types with support for our features
     *
     * @param array $features
     */
    protected function get_post_types( $features ) {
        $post_types = get_post_types();
        foreach ( $post_types as $key => $value ) {
            foreach ( $features as $feature ) {
                if ( !post_type_supports( $value, $feature ) ) {
                    unset( $post_types[ $key ] );
                }
            }
        }

        return $post_types;
    }

    /**
     * Gets taxonomies with support for our features
     *
     * @param array $features
     */
    protected function get_taxonomies( $features ) {
        $taxonomies = get_taxonomies();
        foreach ( $taxonomies as $key => $value ) {
            foreach ( $features as $feature ) {
                if ( !taxonomy_supports( $value, $feature ) ) {
                    unset( $taxonomies[ $key ] );
                }
            }
        }

        return $taxonomies;
    }

    protected function get_individual_setting_id() {
        $setting_id = 'rewrite_slug';

        return $setting_id;
    }

    /**
     * Add some stuff to the Theme Options Panel
     *
     * @param $sections
     */
    public function register_post_type_setting( $sections ) {
        // Get post types with support for our feature
        $post_types = $this->get_post_types(array(
            $this->global_feature,
        ));

        foreach ( $post_types as $post_type ) {
            $id = 'post_type_' . $post_type . '_' . $this->get_individual_setting_id();
            $section_id = G1_Single_Settings_Feature()->get_section_id( $post_type );

            if ( !empty($sections[$section_id]) ) {
                $sections[$section_id]['fields'][] = array(
                    'id'        => $id,
                    'priority'  => 10,
                    'type'      => 'text',
                    'title'     => __( 'Link Base', Redux_TEXT_DOMAIN ),
                    'sub_desc'  => __( 'This will be used as a part of the permalink.', Redux_TEXT_DOMAIN ),
                    'std'       => ''
                );
            }
        }

        return $sections;
    }

    /**
     * Add some stuff to the Theme Options Panel
     *
     * @param $sections
     */
    public function register_taxonomy_setting( $sections ) {
        // Get taxonomies with support for our feature
        $taxonomies = $this->get_taxonomies(array(
            $this->global_feature,
        ));

        foreach ( $taxonomies as $taxonomy ) {
            $id = 'taxonomy_' . $taxonomy . '_' . $this->get_individual_setting_id();
            $section_id = G1_Archive_Settings_Feature()->get_section_id( $taxonomy, 'taxonomy' );

            if ( !empty($sections[$section_id]) ) {
                $sections[$section_id]['fields'][] = array(
                    'id'        => $id,
                    'priority'  => 10,
                    'type'      => 'text',
                    'title'     => __( 'Link Base', Redux_TEXT_DOMAIN ),
                    'sub_desc'  => __( 'This will be used as a part of the permalink.', Redux_TEXT_DOMAIN ),
                    'std'       => ''
                );
            }
        }

        return $sections;
    }
}
new G1_Rewrite_Slug_Feature();

class G1_Archive_Sidebar_Feature {
    private $sidebar_choices;

    public function __construct() {
        $this->setup_hooks();

        $this->global_feature = 'g1-global-archive-sidebar-1';
        $this->individual_feature = 'g1-individual-archive-sidebar-1';
    }

    protected function setup_hooks() {
        add_filter( get_redux_opts_sections_filter_name(),   array( $this, 'register_taxonomy_setting' ), 12 );
    }

    protected function get_post_types( $features ) {
        $post_types = get_post_types();
        foreach ( $post_types as $key => $value ) {
            foreach ( $features as $feature ) {
                if ( !post_type_supports( $value, $feature ) ) {
                    unset( $post_types[ $key ] );
                }
            }
        }

        return $post_types;
    }

    protected function get_taxonomies( $features ) {
        $taxonomies = get_taxonomies();
        foreach ( $taxonomies as $key => $value ) {
            foreach ( $features as $feature ) {
                if ( !taxonomy_supports( $value, $feature ) ) {
                    unset( $taxonomies[ $key ] );
                }
            }
        }

        return $taxonomies;
    }

    protected function get_individual_setting_id() {
        $setting_id = 'sidebar_1';

        return $setting_id;
    }

    public function register_taxonomy_setting( $sections ) {
        // Get taxonomies with support for our feature
        $taxonomies = $this->get_taxonomies(array(
            $this->global_feature,
        ));

        foreach ( $taxonomies as $taxonomy ) {
            $id = 'taxonomy_' . $taxonomy . '_' . $this->get_individual_setting_id();

            $section_id = G1_Archive_Settings_Feature()->get_section_id( $taxonomy, 'taxonomy' );

            if ( !empty($sections[$section_id]) ) {
                $sections[$section_id]['fields'][] = array(
                    'id'        => $id,
                    'priority'  => 190,
                    'type'      => 'select',
                    'options'   => $this->get_sidebar_choices(),
                    'title'     => __( 'Sidebar', Redux_TEXT_DOMAIN ),
                    'std'       => ''
                );
            }
        }

        return $sections;
    }

    private function get_sidebar_choices () {
        if (!$this->sidebar_choices) {
            $this->sidebar_choices = g1_sidebar_get_choices();
        }

        return $this->sidebar_choices;
    }
}

new G1_Archive_Sidebar_Feature();

class G1_Archive_Settings_Feature {
    public function __construct() {
        $this->feature = 'g1-archive-settings';
        $this->setup_hooks();
    }

    /**
     * Set up all hooks
     */
    protected function setup_hooks() {
        add_filter( get_redux_opts_sections_filter_name(),   array( $this, 'add_post_type_empty_sections' ) );
        add_filter( get_redux_opts_sections_filter_name(),   array( $this, 'add_post_type_archive_sections' ) );
        add_filter( get_redux_opts_sections_filter_name(),   array( $this, 'add_taxonomy_archive_sections' ) );
    }

    public function add_post_type_empty_sections( $sections ) {
        // Get post types with support for our feature
        $post_types = array();
        foreach ( get_post_types() as $post_type ) {
            if ( post_type_supports( $post_type, $this->feature ) ) {
                $post_types[] = $post_type;
            }
        }

        $priority_start = 390;
        $priority_step = 100;
        foreach ( $post_types as $post_type ) {

            $post_type_obj = get_post_type_object( $post_type );
            $section_id = 'empty_' . $this->get_section_id( $post_type );

            $sections[$section_id] = array(
                'priority'   => $priority_start + 1,
                'icon'       => 'pencil',
                'icon_class' => 'icon-large',
                'title'      => sprintf( __( '%s', Redux_TEXT_DOMAIN ), $post_type_obj->labels->name ),
                'fields'     => array(
                )
            );

            $priority_start += $priority_step;
        }

        return $sections;
    }

    public function get_section_id( $id, $type = 'post_type' ) {
        switch ( $type ) {
            case 'taxonomy':
                $section_id = str_replace(  array( '_', '-' ), array( '', '' ), $id );
                $section_id = $section_id . '_archive';
                break;
            case 'post_type':
                $section_id = str_replace(  array( '_', '-' ), array( '', '' ), $id );
                $section_id = $section_id . '_archive';
                break;
        }

        return $section_id;
    }


    /**
     * Add some stuff to the Theme Options Panel
     *
     * @param $sections
     */
    public function add_post_type_archive_sections( $sections ) {
        // Get post types with support for our feature
        $post_types = array();
        foreach ( get_post_types() as $post_type ) {
            if ( post_type_supports( $post_type, $this->feature ) ) {
                $post_types[] = $post_type;
            }
        }

        $priority_start = 400;
        $priority_step = 100;
        foreach ( $post_types as $post_type ) {

            $post_type_obj = get_post_type_object( $post_type );
            $section_id = $this->get_section_id( $post_type );

            $sections[$section_id] = array(
                'priority'   => $priority_start + 1,
                'icon'       => 'th',
                'icon_class' => 'icon-large',
                'title'      => sprintf( __( '%s Archive Page', Redux_TEXT_DOMAIN ), $post_type_obj->labels->name ),
                'fields'     => array(
                )
            );

            $priority_start += $priority_step;
        }

        return $sections;
    }


    /**
     * Add some stuff to Theme Options Panel
     *
     * @param $sections
     */
    public function add_taxonomy_archive_sections( $sections ) {
        // Get taxonomies with support for our feature
        $taxonomies = array();
        foreach ( get_taxonomies() as $taxonomy ) {
            if ( taxonomy_supports( $taxonomy, $this->feature ) ) {
                $taxonomies[] = $taxonomy;
            }
        }

        $priority_start = 400;
        $priority_step = 10;
        $old_post_type = null;

        foreach ( $taxonomies as $taxonomy ) {
            $taxonomy_obj = get_taxonomy( $taxonomy );
            $current_post_type = $taxonomy_obj->object_type[0];
            $section_id = $this->get_section_id( $taxonomy, 'taxonomy' );
            $icon = $taxonomy_obj->hierarchical ? 'folder-open' : 'tags';

            if ($old_post_type === null) {
                $old_post_type = $current_post_type;
            }

            if ( $old_post_type != $current_post_type ) {
                $priority_start += 100;
            }

            $sections[$section_id] = array(
                'priority'   => $priority_start + 10,
                'icon'       => $icon,
                'icon_class' => 'icon-large',
                'title'      => sprintf( __( '%s', Redux_TEXT_DOMAIN ), $taxonomy_obj->labels->name ),
                'fields'     => array(
                )
            );

            $priority_start += $priority_step;
            $old_post_type = $current_post_type;
        }

        return $sections;
    }
}
/**
 * Quasi-singleton for our feature
 *
 * @return G1_Archive_Settings_Feature
 */
function G1_Archive_Settings_Feature() {
    static $instance = null;

    if ( null === $instance ) {
        $instance = new G1_Archive_Settings_Feature();
    }

    return $instance;
}
// Fire in the hole :)
G1_Archive_Settings_Feature();



class G1_Archive_Template_Feature {
    protected $template_manager;

    public function __construct( $args ) {
        $this->set_template_manager( $args['template_manager'] );

        $this->global_feature = 'g1-global-archive-template';
        $this->individual_feature = 'g1-individual-archive-template';

        $this->setup_hooks();
    }


    /**
     * Sets the Template Manager
     *
     * @param G1_Template_Manager $manager
     */
    public function set_template_manager( G1_Template_Manager $manager ) {
        $this->template_manager = $manager;
    }

    /**
     * Gets the Template Manager
     *
     * @return G1_Template_Manager
     */
    public function get_template_manager() {
        return $this->template_manager;
    }


    /**
     * Set up all hooks
     */
    protected function setup_hooks() {
        add_filter( get_redux_opts_sections_filter_name(),   array( $this, 'post_type_customize_register' ), 12 );
        add_filter( get_redux_opts_sections_filter_name(),   array( $this, 'taxonomy_customize_register' ), 12 );

        add_action( 'g1_term_meta_manager_register', array( $this, 'register_individual_term_setting' ), 12 );

        add_action( 'home_template',        array( $this, 'alter_post_type_archive_template' ) );
        add_action( 'archive_template',     array( $this, 'alter_post_type_archive_template' ) );
        add_action( 'archive_template',     array( $this, 'alter_taxonomy_template' ) );
        add_action( 'taxonomy_template',    array( $this, 'alter_taxonomy_template' ) );
        add_action( 'g1_collection_before', array( $this, 'add_collection_class' ), 10, 2 );
    }

    /**
     * Gets post_types with support for our features
     *
     * @param array $features
     */
    protected function get_post_types( $features ) {
        $features = (array) $features;

        $post_types = get_post_types();
        foreach ( $post_types as $key => $value ) {
            foreach ( $features as $feature ) {
                if ( !post_type_supports( $value, $feature ) ) {
                    unset( $post_types[ $key ] );
                }
            }
        }

        return $post_types;
    }



    /**
     * Gets taxonomies with support for our features
     *
     * @param array $features
     */
    protected function get_taxonomies( $features ) {
        $features = (array) $features;

        $taxonomies = get_taxonomies();
        foreach ( $taxonomies as $key => $value ) {
            foreach ( $features as $feature ) {
                if ( !taxonomy_supports( $value, $feature ) ) {
                    unset( $taxonomies[ $key ] );
                }
            }
        }

        return $taxonomies;
    }


    protected function get_taxonomy_archive_templates( $taxonomy ) {
        $taxonomy_obj = get_taxonomy( $taxonomy );

        // Merge post type archive templates
        $templates = array();
        foreach ( $taxonomy_obj->object_type as $post_type ) {
            $templates = array_merge(
                $templates,
                $this->get_template_manager()->get_templates_choices( array( 'post_type' => $post_type ) )
            );
        }

        return $templates;
    }


    protected function get_individual_setting_id() {
        $setting_id = 'template';

        return $setting_id;
    }


    /**
     * Registers the setting in the Term Meta Manager
     *
     * @param G1_Term_Meta_Manager $manager
     */
    public function register_individual_term_setting( $manager ) {
        // Get post types with support for required feature
        $taxonomies = $this->get_taxonomies(array(
            $this->individual_feature
        ));


        $choices = $this->get_template_manager()->get_templates_choices();
        $empty = trailingslashit( get_template_directory_uri() ) . 'images/admin-assets/inherit.png';
        $choices = array( '' => $empty ) + $choices;


        if ( count( $taxonomies ) ) {
            $setting_id = '_g1[' . $this->get_individual_setting_id() . ']';

            $manager->add_setting( $setting_id, array(
                'apply'	   	=> $taxonomies,
                'view'      => new G1_Form_Image_Choice_Control( $setting_id, array(
                    'label'     => __( 'Template', 'g1_theme'),
                    'choices'   => $choices,
                )),
                'section'	=> 'g1_term_single', //G1_Single_Entry_Settings_Feature()->get_section_id(),
                'priority'	=> 190,
            ));

            $setting_id = '_g1[' . $this->get_individual_setting_id() . '_sidebar_1]';

            $manager->add_setting( $setting_id, array(
                'apply'	   	=> $taxonomies,
                'view'      => new G1_Form_Choice_Control( $setting_id, array(
                    'label'     => __( 'Sidebar', 'g1_theme'),
                    'choices'   => array_merge(array('' => 'inherit'), g1_sidebar_get_choices()),
                )),
                'section'	=> 'g1_term_single',
                'priority'	=> 192,
            ));

            $setting_id = '_g1[' . $this->get_individual_setting_id() . '_effect]';

            $manager->add_setting( $setting_id, array(
                'apply'	   	=> $taxonomies,
                'view'      => new G1_Form_Choice_Control( $setting_id, array(
                    'label'     => __( 'Effect', 'g1_theme'),
                    'choices'   => array(
                        ''          => __( 'inherit', 'g1_theme' ),
                        'none'      => __( 'none', 'g1_theme' ),
                        'grayscale' => __( 'grayscale', 'g1_theme' ),
                    ),
                )),
                'section'	=> 'g1_term_single',
                'priority'	=> 195,
            ));
        }
    }



    /**
     * Add some stuff to the Theme Options Panel
     *
     * @param $sections
     */
    public function post_type_customize_register( $sections ) {
        foreach ( $this->get_post_types( $this->global_feature ) as $post_type ) {
            $id = 'post_type_' . $post_type . '_archive_template';
            $section_id = G1_Archive_Settings_Feature()->get_section_id( $post_type );

            $templates = $this->get_template_manager()->get_templates_choices( array( 'post_type' => $post_type ) );

            $options = array();
            foreach ( $templates as $template_id => $template_path ) {
                $options[ $template_id ] = array(
                    'title' => $template_id,
                    'img'   => $template_path
                );
            }

            if ( !empty($sections[$section_id]) ) {
                $std = '';
                if (!empty($options)) {
                    $std = array_keys($options);
                    $std = $std[0];
                }

                $sections[$section_id]['fields'][] = array(
                    'id'        => $id,
                    'priority'  => 190,
                    'type'      => 'radio_img',
                    'title'     => __( 'Template', Redux_TEXT_DOMAIN ),
                    'sub_desc' =>
                       '<p>' . __( 'Color Legend:', Redux_TEXT_DOMAIN ) . '</p>' .
                       '<ul>' .
                            '<li>' . __( 'dark gray: media', Redux_TEXT_DOMAIN ) . '</li>' .
                            '<li>' . __( 'light gray: text', Redux_TEXT_DOMAIN ) . '</li>' .
                            '<li>' . __( 'blue: sidebar', Redux_TEXT_DOMAIN ) . '</li>' .
                            '<li>' . __( 'green: navigation', Redux_TEXT_DOMAIN ) . '</li>' .
                        '<ul>',
                    'options'   => $options,
                    'std'       => $std
                );

                $id = 'post_type_' . $post_type . '_archive_template_effect';

                $sections[$section_id]['fields'][] = array(
                    'id'        => $id,
                    'priority'  => 195,
                    'type'      => 'select',
                    'title'     => __( 'Effect', Redux_TEXT_DOMAIN ),
                    'options'   => array(
                        'none'      => __( 'none', 'g1_theme' ),
                        'grayscale' => __( 'grayscale', 'g1_theme' ),
                    ),
                    'std'       => 'none'
                );
            }
        }

        return $sections;
    }



    /**
     * Add some stuff to the Theme Options Panel
     *
     * @param $sections
     */
    public function taxonomy_customize_register( $sections ) {
        foreach ( $this->get_taxonomies( $this->global_feature ) as $taxonomy ) {
            $id = 'taxonomy_' . $taxonomy . '_archive_template';
            $section_id = G1_Archive_Settings_Feature()->get_section_id( $taxonomy, 'taxonomy' );

            $templates = $this->get_taxonomy_archive_templates( $taxonomy );

            $options = array();
            foreach ( $templates as $template_id => $path ) {
                $options[ $template_id ] = array(
                    'title' => $template_id,
                    'img'   => $path
                );
            }

            if ( !empty($sections[$section_id]) ) {
                $std = '';
                if (!empty($options)) {
                    $std = array_keys($options);
                    $std = $std[0];
                }

                $sections[$section_id]['fields'][] = array(
                    'id'        => $id,
                    'priority'  => 190,
                    'type'      => 'radio_img',
                    'title'     => __( 'Template', Redux_TEXT_DOMAIN ),
                    'sub_desc'  =>
                        '<p>' . __( 'Color Legend:', Redux_TEXT_DOMAIN ) . '</p>' .
                        '<ul>' .
                            '<li>' . __( 'dark gray: media', Redux_TEXT_DOMAIN ) . '</li>' .
                            '<li>' . __( 'light gray: text', Redux_TEXT_DOMAIN ) . '</li>' .
                            '<li>' . __( 'blue: sidebar', Redux_TEXT_DOMAIN ) . '</li>' .
                            '<li>' . __( 'green: navigation', Redux_TEXT_DOMAIN ) . '</li>' .
                        '<ul>',
                    'options'   => $options,
                    'std'       => $std
                );

                $id = 'taxonomy_' . $taxonomy . '_archive_template_effect';

                $sections[$section_id]['fields'][] = array(
                    'id'        => $id,
                    'priority'  => 195,
                    'type'      => 'select',
                    'title'     => __( 'Effect', Redux_TEXT_DOMAIN ),
                    'options'   => array(
                        'none'      => __( 'none', 'g1_theme' ),
                        'grayscale' => __( 'grayscale', 'g1_theme' ),
                    ),
                    'std'       => 'none'
                );
            }
        }

        return $sections;
    }

    protected function get_individual_feature_taxonomy_value ( $taxonomy_name, $term_object, $feature_name_base, $feature_name_key = '' ) {
        if ( taxonomy_supports( $taxonomy_name, $this->individual_feature ) ) {
            $term_meta = (array) g1_get_term_meta( $term_object->term_id, '_g1' );

            $feature_name = $feature_name_base;

            if ( strlen( $feature_name_key ) > 0 ) {
                $feature_name .= '_' . $feature_name_key;
            }

            $feature_value = !empty($term_meta[$feature_name]) ? $term_meta[$feature_name] : '';

            if ( strlen( $feature_value ) > 0 ) {
                return $feature_value;
            }
        }

        return null;
    }

    protected function get_global_feature_value ( $type, $type_value, $feature_name_base, $feature_name_key = '' ) {
        switch ( $type ) {
            case 'post':
                if ( post_type_supports( $type_value, $this->global_feature ) ) {
                    $feature_value = g1_get_theme_option( $feature_name_base, $feature_name_key, '' );
                }
                break;

            case 'taxonomy':
                if ( taxonomy_supports( $type_value, $this->global_feature ) ) {
                    $feature_value = g1_get_theme_option( $feature_name_base, $feature_name_key, '' );
                }
                break;
        }

        if ( isset( $feature_value ) && strlen( $feature_value ) > 0 ) {
            return $feature_value;
        }

        return null;
    }

    /**
     * @param G1_Collection $g1_collection
     * @param WP_Query $g1_query
     */
    public function add_collection_class ( $g1_collection, $g1_query ) {
        if ( !$g1_query->is_main_query() ) {
            return;
        }

        // post tags
        if ( is_tag() ) {
            $taxonomy = 'post_tag';
        // post categories
        } else if ( is_category() ) {
            $taxonomy = 'category';
        // work categories & tags
        } else if ( is_tax() ) {
            $taxonomy = get_query_var( 'taxonomy' );
        }

        if ( isset( $taxonomy ) ) {
            $term = $g1_query->queried_object;

            // individual
            $effect = $this->get_individual_feature_taxonomy_value( $taxonomy, $term, 'template_effect' );

            // global
            if ( empty( $effect ) ) {
                $effect = $this->get_global_feature_value( 'taxonomy', $taxonomy, 'taxonomy_'.$taxonomy, 'archive_template_effect' );
            }

            if ( !empty( $effect ) ) {
                $g1_collection->add_class('g1-effect-'.$effect);
                return;
            }

            return;
        }

        // home page
        if ( is_home() ) {
            $post_type = 'post';
        // post & work archive page
        } else if ( is_post_type_archive() ) {
            $post_type = get_query_var( 'post_type' );
        // date & author archive page
        } else if ( is_archive() ) {
            $post_type = 'post';
        }

        if ( isset($post_type) ) {
            // only global
            $effect = $this->get_global_feature_value( 'post', $post_type, 'post_type_'.$post_type, 'archive_template_effect' );

            if ( !empty( $effect ) ) {
                $g1_collection->add_class('g1-effect-'.$effect);
                return;
            }
        }
    }

    /**
     * Alternates a template for post type archives
     *
     * @param string $template
     */
    public function alter_post_type_archive_template( $template ) {
        if ( !is_home() && !is_post_type_archive() ) {
            return $template;
        }

        $post_type = 'post';

        if ( !is_home() ) {
            $post_type = get_query_var( 'post_type' );
        }

        $templates = array();

        if ( post_type_supports( $post_type, $this->global_feature ) ) {
            $archive_template = g1_get_theme_option( 'post_type_' . $post_type,  'archive_template' );

            if ( $this->get_template_manager()->has_template( $archive_template ) ) {
                $template_obj = $this->get_template_manager()->get_template( $archive_template );
                $templates[] = $template_obj->get_file();
            }
        }

        if ( count( $templates ) ) {
            $new_template = locate_template( $templates );

            if ( !empty( $new_template ) ) {
                return $new_template;
            }
        }

        return $template;
    }


    /**
     * Alternates a template for taxonomies
     *
     * @param string $template
     */
    public function alter_taxonomy_template( $template ) {
        if ( ! ( is_tax() || is_category() || is_tag() ) )
            return $template;


        $taxonomy = '';

        if ( is_tax() ) {
            $taxonomy = get_query_var( 'taxonomy' );
            $term = get_query_var( 'term' );
        } elseif ( is_category() ) {
            $taxonomy = 'category';
            $term = get_query_var( 'cat' );
        } elseif ( is_tag() ) {
            $taxonomy = 'post_tag';
            $term = get_query_var( 'tag' );
        }

        $templates = array();

        // Global value
        if ( taxonomy_supports( $taxonomy, $this->global_feature ) ) {
            $archive_template = g1_get_theme_option( 'taxonomy_' . $taxonomy, 'archive_template' );

            if ( $this->get_template_manager()->has_template( $archive_template ) ) {
                $template_obj = $this->get_template_manager()->get_template( $archive_template );
                array_unshift( $templates, $template_obj->get_file() );
            }
        }

        // Individual value
        if ( taxonomy_supports( $taxonomy, $this->individual_feature ) ) {
            if ( is_numeric( $term ) ) {
                $term_obj = get_term_by( 'id', $term, $taxonomy );
            } else {
                $term_obj = get_term_by( 'slug', $term, $taxonomy );
            }

            if ( $term_obj ) {
                $temp = get_option( 'g1_tt_' . $term_obj->term_taxonomy_id, array() );

                if ( isset( $temp['_g1'] ) ) {
                    $temp = $temp['_g1'];

                    $term_template = isset( $temp['template'] ) ? $temp['template'] : null;

                    if ( $this->get_template_manager()->has_template( $term_template ) ) {
                        $template_obj = $this->get_template_manager()->get_template( $term_template );
                        array_unshift( $templates, $template_obj->get_file() );
                    }
                }
            }
        }

        if ( count( $templates ) ) {
            $new_template = locate_template( $templates );

            if ( !empty( $new_template ) ) {
                return $new_template;
            }
        }

        return $template;
    }
}
new G1_Archive_Template_Feature( array(
    'template_manager' => G1_Archive_Template_Manager(),
));




class G1_Single_Entry_Settings_Feature {
    protected $feature;

    public function __construct() {
        $this->feature = 'g1-single-entry-settings';
        $this->setup_hooks();
    }

    public function get_feature() {
        return $this->feature;
    }


    /**
     * Set up all hooks
     */
    protected function setup_hooks() {
        add_action( 'g1_post_meta_manager_register',   array( $this, 'add_single_meta_box' ), 1 );

        add_action( 'g1_term_meta_manager_register',   array( $this, 'add_taxonomy_section' ), 1 );
    }

    public function get_section_id() {
        $section_id = 'g1_metabox_single';

        return $section_id;
    }

    public function get_taxonomies() {
        // Get taxonomies with support for our feature
        $taxonomies = array();
        foreach ( get_taxonomies() as $taxonomy ) {
            if ( taxonomy_supports( $taxonomy, $this->feature ) ) {
                $taxonomies[] = $taxonomy;
            }
        }

        return $taxonomies;
    }


    public function add_taxonomy_section( $manager ) {
        // Get taxonomies with support for our feature
        $taxonomies = $this->get_taxonomies();
        if ( count( $taxonomies ) ) {

            $manager->add_section(
                new G1_Term_Meta_Section(
                    'g1_term_single',
                    array(
                        'title'     => __( 'Single Term Options', 'g1_theme' )
                    )
                )
            );
        }
    }


    public function add_single_meta_box( $manager ) {
        // Get post types with support for our feature
        $post_types = array();
        foreach ( get_post_types() as $post_type ) {
            if ( post_type_supports( $post_type, $this->feature ) ) {
                $post_types[] = $post_type;
            }
        }

        if ( count( $post_type ) ) {
            $manager->add_section(
                new G1_Post_Meta_Section(
                    $this->get_section_id(),
                    array(
                        'title'     => __( 'Single Page Options', 'g1_theme' )
                    )
                )
            );
        }
    }
}

/**
 * Quasi-singleton for our feature
 *
 * @return G1_Single_Entry_Settings_Feature
 */
function G1_Single_Entry_Settings_Feature() {
    static $instance = null;

    if ( null === $instance ) {
        $instance = new G1_Single_Entry_Settings_Feature();
    }

    return $instance;
}
// Fire in the hole :)
G1_Single_Entry_Settings_Feature();



class G1_Single_Entry_Subtitle_Feature {
    public function __construct() {
        $this->feature = 'g1-single-entry-subtitle';

        $this->setup_hooks();
    }

    /**
     * Set up all hooks
     */
    protected function setup_hooks() {
        add_action( 'g1_post_meta_manager_register',    array( $this, 'register_setting'), 12 );
    }

    protected function get_post_types( $features = array() ) {
        // Get post types with support for our feature
        $post_types = get_post_types();
        foreach ( $post_types as $key => $value ) {
            foreach ( $features as $feature ) {
                if ( !post_type_supports( $value, $feature ) ) {
                    unset( $post_types[ $key ] );
                }
            }
        }

        return $post_types;
    }

    /**
     * Registers the setting in the Post Meta Manager
     *
     * @param G1_Post_Meta_Manager $manager
     */
    public function register_setting( $manager ) {
        // Get post types with support for required feature
        $post_types = $this->get_post_types(array(
            $this->feature,
            G1_Single_Entry_Settings_Feature()->get_feature(),
        ));

        if ( count( $post_types ) ) {
            $setting_id = '_g1_subtitle';

            $manager->add_setting( $setting_id, array(
                'apply'	   	=> $post_types,
                'view'      => new G1_Form_Text_Control( $setting_id, array(
                    'label'     => __( 'Subtitle', 'g1_theme'),
                    'hint'      => __( 'This will be displayed below the title', 'g1_theme' ),
                )),
                'section'	=> 'g1_general',
                'priority'	=> 100,
            ));
        }
    }
}
new G1_Single_Entry_Subtitle_Feature();



class G1_Single_Settings_Feature {
    public function __construct() {
        $this->feature = 'g1-single-settings';
        $this->setup_hooks();
    }

    /**
     * Set up all hooks
     */
    protected function setup_hooks() {
        add_filter( get_redux_opts_sections_filter_name(),   array( $this, 'add_post_type_single_sections' ) );
    }

    public function get_section_id( $post_type ) {
        $section_id = str_replace(  array( '_', '-' ), array( '', '' ), $post_type );
        $section_id = $section_id . '_single';

        return $section_id;
    }

    /**
     * Add some stuff to the Theme Options Panel
     *
     * @param $sections
     */
    public function add_post_type_single_sections( $sections ) {
        // Get post types with support for our feature
        $post_types = array();
        foreach ( get_post_types() as $post_type ) {
            if ( post_type_supports( $post_type, $this->feature ) ) {
                $post_types[] = $post_type;
            }
        }

        $priority_start = 400;
        $priority_step = 100;
        foreach ( $post_types as $post_type ) {
            $post_type_obj = get_post_type_object( $post_type );
            $section_id = $this->get_section_id( $post_type );

            $sections[$section_id] = array(
                'priority'   => $priority_start,
                'icon'       => 'file',
                'icon_class' => 'icon-large',
                'title'      => sprintf( __( '%s Single Page', Redux_TEXT_DOMAIN ), $post_type_obj->labels->name ),
                'fields'     => array(
                )
            );

            $priority_start += $priority_step;
        }

        return $sections;
    }
}

/**
 * Quasi-singleton for our feature
 *
 * @return G1_Single_Settings_Feature
 */
function G1_Single_Settings_Feature() {
    static $instance = null;

    if ( null === $instance ) {
        $instance = new G1_Single_Settings_Feature();
    }

    return $instance;
}
// Fire in the hole :)
G1_Single_Settings_Feature();


class G1_Single_Template_Feature {
    protected $template_manager;

    public function __construct( $args ) {
        $this->set_template_manager( $args['template_manager'] );

        $this->global_feature = 'g1-single-template';
        $this->individual_feature = 'g1-single-entry-template';

        $this->setup_hooks();
    }


    /**
     * Sets the Template Manager
     *
     * @param G1_Template_Manager $manager
     */
    public function set_template_manager( G1_Template_Manager $manager ) {
        $this->template_manager = $manager;
    }

    /**
     * Gets the Template Manager
     *
     * @return G1_Template_Manager
     */
    public function get_template_manager() {
        return $this->template_manager;
    }

    /**
     * Set up all hooks
     */
    protected function setup_hooks() {
        add_filter( get_redux_opts_sections_filter_name(),   array( $this, 'register_global_setting' ), 12 );
        add_action( 'g1_post_meta_manager_register',    array( $this, 'register_individual_setting'), 12 );

        add_action( 'single_template',      array( $this, 'alter_single_template' ) );
    }

    public function do_register() {
        do_action( 'g1_single_template_register', $this );
    }


    /**
     * Add some stuff to the Theme Options Panel
     *
     * @param $sections
     */
    public function register_global_setting( $sections ) {
        // Get post types with support for our feature
        $post_types = array();
        foreach ( get_post_types() as $post_type ) {
            if ( post_type_supports( $post_type, $this->global_feature ) ) {
                $post_types[] = $post_type;
            }
        }

        foreach ( $post_types as $post_type ) {
            $id = 'post_type_' . $post_type . '_single_template';
            $section_id = G1_Single_Settings_Feature()->get_section_id( $post_type );

            $templates = $this->get_template_manager()->get_templates_choices( array( 'post_type' => $post_type ) );

            $options = array();
            foreach ( $templates as $template_id => $template_path ) {
                $options[ $template_id ] = array(
                    'title' => $template_id,
                    'img'   => $template_path
                );
            }

            $std = '';
            if (!empty($options)) {
                $std = array_keys($options);
                $std = $std[0];
            }

            if ( !empty($sections[$section_id]) ) {
                $sections[$section_id]['fields'][] = array(
                    'id'        => $id,
                    'priority'  => 190,
                    'type'      => 'radio_img',
                    'title'     => __( 'Template', Redux_TEXT_DOMAIN ),
                    'sub_desc' =>
                        '<p>' . __( 'Color Legend:', Redux_TEXT_DOMAIN ) . '</p>' .
                        '<ul>' .
                            '<li>' . __( 'dark gray: media', Redux_TEXT_DOMAIN ) . '</li>' .
                            '<li>' . __( 'light gray: text', Redux_TEXT_DOMAIN ) . '</li>' .
                            '<li>' . __( 'blue: sidebar', Redux_TEXT_DOMAIN ) . '</li>' .
                        '<ul>',
                    'options'   => $options,
                    'std'       => $std
                );
            }
        }

        return $sections;
    }



    protected function get_individual_setting_id() {
        $setting_id = 'template';

        return $setting_id;
    }


    protected function get_post_types( $features = array() ) {
        // Get post types with support for our feature
        $post_types = get_post_types();
        foreach ( $post_types as $key => $value ) {
            foreach ( $features as $feature ) {
                if ( !post_type_supports( $value, $feature ) ) {
                    unset( $post_types[ $key ] );
                }
            }
        }

        return $post_types;
    }


    /**
     * Registers the setting in the Post Meta Manager
     *
     * @param G1_Post_Meta_Manager $manager
     */
    public function register_individual_setting( $manager ) {
        // Get post types with support for required feature
        $post_types = $this->get_post_types(array(
            $this->global_feature,
            G1_Single_Entry_Settings_Feature()->get_feature(),
        ));

        $choices = $this->get_template_manager()->get_templates_choices();
        $empty = trailingslashit( get_template_directory_uri() ) . 'images/admin-assets/inherit.png';
        $choices = array( '' => $empty ) + $choices;

        if ( count( $post_types ) ) {
            $setting_id = '_g1[' . $this->get_individual_setting_id() . ']';

            $manager->add_setting( $setting_id, array(
                'apply'	   	=> $post_types,
                'view'      => new G1_Form_Image_Choice_Control( $setting_id, array(
                    'label'     => __( 'Template', 'g1_theme'),
                    'choices'   => $choices,
                )),
                'section'	=> G1_Single_Entry_Settings_Feature()->get_section_id(),
                'priority'	=> 190,
            ));
        }
    }

    public function get_global_value( $post_type ) {
        $template = null;

        if ( post_type_supports( $post_type, $this->global_feature ) ) {
            $template = g1_get_theme_option( 'post_type_' . $post_type, 'single_template' );
        }

        return $template;
    }

    public function get_individual_value( $post_id ) {
        $template = null;

        $post = get_post( $post_id );

        if ( $post ) {
            if ( post_type_supports( $post->post_type, $this->individual_feature ) ) {
                $meta = get_post_meta( $post_id, '_g1', true );
                $meta = (array) $meta;
                if ( array_key_exists( $this->get_individual_setting_id(), $meta ) ) {
                    $template = $meta[ $this->get_individual_setting_id() ];
                }
            }
        }

        return $template;
    }


    public function alter_single_template( $template ) {
        $object = get_queried_object();

        $templates = array(

        );

        // global value
        $global_value = $this->get_global_value( $object->post_type );
        if ( $this->get_template_manager()->has_template( $global_value ) ) {
            $template_obj = $this->get_template_manager()->get_template( $global_value );

            $info = pathinfo( $template_obj->get_file() );
            $info = $info['dirname'] . '/' . $info['filename'];

            array_unshift( $templates,
                "{$info}-{$object->post_type}.php",
                "{$info}.php"
            );
        }

        // individual value
        $individual_value = $this->get_individual_value( $object->ID );
        if ( $this->get_template_manager()->has_template( $individual_value ) ) {
            $template_obj = $this->get_template_manager()->get_template( $individual_value );

            $info = pathinfo( $template_obj->get_file() );
            $info = $info['dirname'] . '/' . $info['filename'];

            array_unshift( $templates,
                "{$info}-{$object->post_type}.php",
                "{$info}.php"
            );
        }

        $templates = array_unique( $templates );

        if ( count( $templates ) ) {
            $new_template = locate_template( $templates );

            if ( !empty( $new_template ) )
                return $new_template;
        }

        return $template;
    }
}
new G1_Single_Template_Feature( array(
    'template_manager' => G1_Single_Template_Manager(),
));

