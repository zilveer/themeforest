<?php
/**
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Theme03
 * @subpackage G1_Learndash_Module
 * @since G1_Learndash_Module 1.0.0
 */

// Prevent direct script access
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );
?>
<?php


class G1_Learndash_Module extends G1_Module {

    public function __construct() {
        parent::__construct();

        $this->set_version( '1.0.0' );
    }

    protected function setup_hooks() {
        parent::setup_hooks();

        // general setup
        add_action( 'wp', array( $this, 'setup_learndash' ) );

        // sidebars
        add_filter( 'g1_setup_sidebars', array( $this, 'setup_sidebars' ) );

        // support features
        add_action( 'init', array( $this, 'add_post_type_support' ) );

        // theme options
        add_action( get_redux_opts_sections_filter_name(), array( $this, 'add_theme_options' ) );

        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_styles' ) );
    }

    public function enqueue_styles ( $hook ) {
        wp_enqueue_style( 'g1_learndash_admin', get_template_directory_uri().'/lib/g1-learndash/css/g1-learndash-admin.css');
    }

    public function setup_learndash () {
        $is_learndash_page = in_array( get_post_type(), $this->get_post_types() );

        if ( is_singular() && $is_learndash_page ) {
            // disable precontent
            remove_action( 'g1_precontent', 'g1_precontent_render' );
        }

        if ( is_archive() && $is_learndash_page ) {
            // disable precontent
            remove_action( 'g1_precontent', 'g1_precontent_render' );

            // use custom sidebar
            add_filter( 'g1_sidebar_1_id', array( $this, 'get_archive_sidebar_name' ) );
        }
    }

    public function add_post_type_support () {
        $features = array(
            'g1-single-template',
            'g1-global-archive-template',
            'excerpt',
            'g1-single-entry-settings',
            'g1-single-element-sidebar-1',
        );

        foreach ( $this->get_post_types() as $post_type ) {
            foreach ( $features as $feature ) {
                add_post_type_support( $post_type, $feature );
            }
        }
    }

    public function add_theme_options ( $sections ) {
        // single templates
        $templates = G1_Single_Template_Manager()->get_templates_choices( array( 'post_type' => 'post' ) );

        unset($templates['overview_left']);
        unset($templates['overview_right']);

        $single_options = array();
        foreach ( $templates as $template_id => $template_path ) {
            $single_options[ $template_id ] = array(
                'title' => $template_id,
                'img'   => $template_path
            );
        }

        $single_std = '';
        if ( !empty($single_options) ) {
            $single_std = array_keys($single_options);
            $single_std = $single_std[0];
        }

        // archive templates
        $archive_templates = G1_Archive_Template_Manager()->get_templates_choices( array( 'post_type' => 'post' ) );

        $archive_options = array();
        foreach ( $archive_templates as $template_id => $template_path ) {
            // exclude filterable layouts
            if ( strpos( $template_id, 'filterable' ) !== false  ) {
                continue;
            }

            $archive_options[ $template_id ] = array(
                'title' => $template_id,
                'img'   => $template_path
            );
        }

        $archive_std = '';
        if ( !empty($archive_options) ) {
            $archive_std = array_keys($archive_options);
            $archive_std = $archive_std[0];
        }

        $fields = array();
        $priority = 1;

        foreach ( $this->get_post_types() as $post_type ) {
            $post_type_label = str_replace( 'sfwd-', '', $post_type );
            $post_type_label = ucfirst( $post_type_label );

            $fields[] = array(
                'id'        => 'post_type_' . $post_type . '_info',
                'priority'  => $priority,
                'type'      => 'info',
                'desc'      =>
                    '<h4>' .
                        $post_type_label .
                    '</h4>',
            );

            $fields[] = array(
                'id'        => 'post_type_' . $post_type . '_single_template',
                'priority'  => $priority + 1,
                'type'      => 'radio_img',
                'title'     => __( 'Single template', Redux_TEXT_DOMAIN ),
                'options'   => $single_options,
                'std'       => $single_std
            );

            $fields[] = array(
                'id'        => 'post_type_' . $post_type . '_archive_template',
                'priority'  => $priority + 2,
                'type'      => 'radio_img',
                'title'     => __( 'Archive template', Redux_TEXT_DOMAIN ),
                'options'   => $archive_options,
                'std'       => $archive_std
            );

            $priority += 10;
        }

        $sections['learndash'] = array(
            'priority'   => 1100,
            'icon'       => 'folder-open',
            'icon_class' => 'icon-large',
            'title'      => __( 'LearnDash', Redux_TEXT_DOMAIN ),
            'fields'     => $fields
        );

        return $sections;
    }

    public function get_sidebar_name () {
        return 'learndash';
    }

    public function get_archive_sidebar_name () {
        return 'learndash-archive';
    }

    public function setup_sidebars ( $sidebars ) {
        $sidebars[] = $this->get_sidebar_name();
        $sidebars[] = $this->get_archive_sidebar_name();

        return $sidebars;
    }

    public function get_post_types () {
        return array(
            'sfwd-courses',
            'sfwd-lessons',
            'sfwd-quiz',
            'sfwd-topic',
            'sfwd-certificates',
            'sfwd-transactions'
        );
    }
}
function G1_Learndash_Module() {
    static $instance;

    if ( !isset( $instance ) )
        $instance = new G1_Learndash_Module();

    return $instance;
}
// Fire in the hole :)
G1_Learndash_Module();