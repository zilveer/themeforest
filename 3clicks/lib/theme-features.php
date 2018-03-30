<?php

class G1_Post_Formats_Feature {
    private $feature;

    public function __construct() {
        $this->feature = 'post-formats';

        $this->setup_hooks();
    }

    /**
     * Set up all hooks
     */
    protected function setup_hooks() {
        add_action( 'g1_post_meta_manager_register',    array( $this, 'register_metaboxes'), 12 );
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts') );
    }

    /**
     * @param G1_Post_Meta_Manager $manager
     */
    public function register_metaboxes( $manager ) {
        $post_types = $this->get_post_types(array(
            $this->feature,
        ));

        if ( count( $post_types ) ) {
            $this->register_video_format( $manager, $post_types );
            $this->register_audio_format( $manager, $post_types );
        }
    }

    public function enqueue_scripts() {
        if (post_type_supports(get_post_type(), 'post-formats') && current_theme_supports('post-formats')) {
            $uri = trailingslashit( get_template_directory_uri() );

            wp_enqueue_script('g1-post-formats', $uri.'g1-framework/admin/js/post-formats.js', array('jquery'));

            wp_localize_script( 'g1-post-formats', 'g1_post_formats_i18n', array(
                'audio_tip'     => __( 'Audio post format can have an additional poster image. You can set it using the Featured Image', 'g1_theme' ),
                'image_tip'     => __( 'Use the Featured Image metabox to set your image', 'g1_theme' ),
                'gallery_tip'   => __( 'Gallery post format use attachments added to the post', 'g1_theme' ),
            ));
        }
    }

    /**
     * @param G1_Post_Meta_Manager $manager
     */
    protected  function register_video_format( $manager, $post_types ) {
        $manager->add_section(
            new G1_Post_Meta_Section(
                'g1_post_formats_video_config',
                array(
                    'title'     => __( 'Video', 'g1_theme' )
                )
            )
        );

        $setting_id = '_format_video_embed';

        $manager->add_setting( $setting_id, array(
            'apply'	   	=> $post_types,
            'view'      => new G1_Form_Long_Text_Control( $setting_id, array(
                'label'     => __( 'Video Url (oEmbed) or Embed Code', 'g1_theme'),
            )),
            'section'	=> 'g1_post_formats_video_config',
            'priority'	=> 10,
        ));
    }

    /**
     * @param G1_Post_Meta_Manager $manager
     */
    protected  function register_audio_format( $manager, $post_types ) {
        $manager->add_section(
            new G1_Post_Meta_Section(
                'g1_post_formats_audio_config',
                array(
                    'title'     => __( 'Audio', 'g1_theme' )
                )
            )
        );

        $setting_id = '_format_audio_embed';

        $manager->add_setting( $setting_id, array(
            'apply'	   	=> $post_types,
            'view'      => new G1_Form_Long_Text_Control( $setting_id, array(
                'label'     => __( 'Audio Url (oEmbed or mp3) or Embed Code', 'g1_theme'),
            )),
            'section'	=> 'g1_post_formats_audio_config',
            'priority'	=> 10,
        ));
    }

    /**
     * Gets all post types with support for our features
     */
    protected function get_post_types( $features = array() ) {
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
}

function G1_Post_Formats_Feature() {
    static $instance;

    if (!isset($instance)) {
        $instance = new G1_Post_Formats_Feature();
    }

    return $instance;
}

G1_Post_Formats_Feature();