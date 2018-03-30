<?php

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

class VC_Setup {

    protected static $instance = null;

    public $animations = array();
    public $bg_colors = array();

    /**
     * Return an instance of this class.
     *
     * @since     1.0.0
     *
     * @return    object    A single instance of this class.
     */
    public static function get_instance() {

        // If the single instance hasn't been set, set it now.
        if ( null == self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }


    private function __construct() {

        if (class_exists('Vc_Manager')) {

            // Revome Elements
            vc_remove_element('vc_tour');
            vc_remove_element('vc_toggle');
            vc_remove_element('vc_button');
            //vc_remove_element('vc_button2');
            //vc_remove_element('vc_pie');
            vc_remove_element('vc_gallery');
            //vc_remove_element('vc_images_carousel');
            vc_remove_element('vc_posts_grid');
            vc_remove_element('vc_carousel');
            vc_remove_element('vc_posts_slider');
            vc_remove_element('vc_cta_button');
            vc_remove_element('vc_cta_button2');
            //vc_remove_element('vc_text_separator');


            // Edit Elements
            $this->clubix_img_gallery();

            // Buttons
            $this->clubix_buttons();

            // Message
            $this->clubix_message();

            // Tabs
            $this->clubix_tabs();

            // Accordions
            $this->clubix_tanda_handler();

            // Text Divider
            $this->clubix_divider();

            // Divider
            $this->clubix_text_divider();

            // Tables
            $this->clubix_tables();

            // Download button
            $this->clubix_download();

            $this->clubix_blog();

            $this->clubix_player();

            $this->clubix_album();

            $this->clubix_event();

        }

    }

    public function clubix_event() {
        // Get all songs
        $args = array(
            'post_type' => EventPostType::get_instance()->postType,
            'posts_per_page'    => 999
        );
        $songs_array = array();
        $songs = get_posts($args);
        foreach($songs as $song) {
            $songs_array[$song->post_title] = $song->ID;
        }

        vc_map( array(
            "name" => __('Next Events', LANGUAGE_ZONE),
            "base" => "clx_next_events",
            'icon' => 'icon-wpb-wp',
            'show_settings_on_create' => false,
            "category" => __('By StylishThemes', LANGUAGE_ZONE),
            "params" => array(

            )
        ) );
    }

    public function clubix_album() {
        // Get all songs
        $args = array(
            'post_type' => AlbumPostType::get_instance()->postType,
            'posts_per_page'    => 999
        );
        $songs_array = array();
        $songs = get_posts($args);
        foreach($songs as $song) {
            $songs_array[$song->post_title] = $song->ID;
        }

        vc_map( array(
            "name" => __('Latest Album Player', LANGUAGE_ZONE),
            "base" => "clx_latest_album",
            'icon' => 'icon-wpb-wp',
            "category" => __('By StylishThemes', LANGUAGE_ZONE),
            "params" => array(
                array(
                    "type" => "dropdown",
                    "heading" => __('Select Album', LANGUAGE_ZONE),
                    "param_name" => "album_id",
                    "value" => $songs_array
                ),
            )
        ) );
    }

    public function clubix_player() {
        // Get all songs
        $args = array(
            'post_type' => SongPostType::get_instance()->postType,
            'posts_per_page'    => 999
        );
        $songs_array = array();
        $songs = get_posts($args);
        foreach($songs as $song) {
            $songs_array[$song->post_title] = $song->ID;
        }

        vc_map( array(
            "name" => __('Simple Player', LANGUAGE_ZONE),
            "base" => "clx_player",
            'icon' => 'icon-wpb-wp',
            "category" => __('By StylishThemes', LANGUAGE_ZONE),
            "params" => array(
                array(
                    "type" => "checkbox",
                    "heading" => __('Select Songs', LANGUAGE_ZONE),
                    "param_name" => "songs",
                    "value" => $songs_array
                ),
            )
        ) );
    }

    public function clubix_blog(){
        $args = array(
            'orderby'       => 'name',
            'order'         => 'ASC'
        );

        $terms = get_terms('category', $args);
        $teams_categories = array();

        foreach( $terms as $term ) {
            $teams_categories[$term->name] = $term->term_id;
        }

        $args = array(
            'who'   => 'authors'
        );
        $authors = get_users($args);
        $blog_authors = array();

        foreach( $authors as $author ) {
            $blog_authors[$author->user_login] = $author->ID;
        }

        vc_map( array(
            "name" => __('Blog', LANGUAGE_ZONE),
            "base" => "clx_blog",
            'icon' => 'icon-wpb-wp',
            "category" => __('By StylishThemes', LANGUAGE_ZONE),
            "params" => array(
                array(
                    "type" => "dropdown",
                    "heading" => __('Blog Type', LANGUAGE_ZONE),
                    "param_name" => "type",
                    "value" => array(
                        __("Blog Style 1", LANGUAGE_ZONE) => '1',
                        __("Blog Style 2", LANGUAGE_ZONE) => '2'
                    ),
                    "description" => __("Select what type of blog you want to display.", LANGUAGE_ZONE)
                ),
                array(
                    "type" => "checkbox",
                    "heading" => __('Select Categories', LANGUAGE_ZONE),
                    "param_name" => "category",
                    "value" => $teams_categories
                ),
                array(
                    "type" => "checkbox",
                    "heading" => __('Select Authors', LANGUAGE_ZONE),
                    "param_name" => "author",
                    "value" => $blog_authors
                ),
                array(
                    "type" => "textfield",
                    "heading" => __('Number of posts/page', LANGUAGE_ZONE),
                    "param_name" => "posts_per_page",
                    "description" => __("Number. How many posts you want to show, on this blog. ", LANGUAGE_ZONE)
                ),
                array(
                    "type" => "dropdown",
                    "heading" => __('Order By', LANGUAGE_ZONE),
                    "param_name" => "orderby",
                    "value" => array(
                        __("Date", LANGUAGE_ZONE) => 'date',
                        __("Name", LANGUAGE_ZONE) => 'name',
                        __("Author", LANGUAGE_ZONE) => 'author',
                        __("ID", LANGUAGE_ZONE) => 'ID',
                        __("Random", LANGUAGE_ZONE) => 'rand',
                        __("Title", LANGUAGE_ZONE) => 'title'
                    )
                ),
                array(
                    "type" => "dropdown",
                    "heading" => __('Order', LANGUAGE_ZONE),
                    "param_name" => "order",
                    "value" => array(
                        __("DESC", LANGUAGE_ZONE) => 'DESC',
                        __("ASC", LANGUAGE_ZONE) => 'ASC'
                    )
                ),
            )
        ) );
    }

    public function clubix_img_gallery(){

        vc_map( array(
                "name" => __('Gallery for Clubix', LANGUAGE_ZONE),
                "base" => "gallery",
                "description" => __('Galleries for your website.', LANGUAGE_ZONE_ADMIN),
                "icon" => "icon-wpb-images-stack",
                "category" => __('By StylishThemes', LANGUAGE_ZONE),
                "params" => array(
                    array(
                        "type" => "dropdown",
                        "heading" => __('Gallery Type', LANGUAGE_ZONE),
                        "param_name" => "style",
                        "value" => array(
                            __("Default", LANGUAGE_ZONE) => ''
                        ),
                        "description" => __("Select what type of gallery you want to display.", LANGUAGE_ZONE)
                    ),
                    array(
                        "type" => "dropdown",
                        "heading" => __('Columns', LANGUAGE_ZONE),
                        "param_name" => "columns",
                        "value" => array(
                            __("1", LANGUAGE_ZONE) => '1',
                            __("2", LANGUAGE_ZONE) => '2',
                            __("3", LANGUAGE_ZONE) => '3',
                            __("4", LANGUAGE_ZONE) => '4',
                            __("5", LANGUAGE_ZONE) => '5',
                            __("6", LANGUAGE_ZONE) => '6',
                        )
                    ),
                    array(
                        "type" => "attach_images",
                        "heading" => __("Images", LANGUAGE_ZONE),
                        "param_name" => "ids",
                        "value" => ""
                    ),
                )
            )
        );

    }

    private function clubix_buttons(){

        // Remove Params
        vc_remove_param('vc_button2', 'color');
        vc_remove_param('vc_button2', 'icon');
        vc_remove_param('vc_button2', 'size');
        vc_remove_param('vc_button2', 'style');


        $attr = array(
            "type" => 'colorpicker',
            "heading" => __("Color", LANGUAGE_ZONE_ADMIN),
            "param_name" => "color",
            //"description" => __("If selected, the padding of this section will be removed.", LANGUAGE_ZONE_ADMIN),
            //"value" => array(__("Yes, please", LANGUAGE_ZONE_ADMIN) => 'yes'),
            //"group" => __( 'Stylish Options', LANGUAGE_ZONE_ADMIN ),
            //"dependency" => array('element' => "container_style", 'value' => array('video-bg')),
        );
        vc_add_param('vc_button2', $attr);
    }

    private function clubix_message(){

        // Remove Params
        vc_remove_param('vc_message', 'style');
        vc_remove_param('vc_message', 'css_animation');


    }

    private function clubix_tabs(){

        // TABS

        // Remove params
        vc_remove_param('vc_tabs', 'interval');
        vc_remove_param('vc_tabs', 'title');
        vc_remove_param('vc_tabs', 'el_class');

        // Add params

        $attr = array(
            "type" => "textfield",
            "heading" => __('Tab Icon Class', LANGUAGE_ZONE_ADMIN),
            "param_name" => "icon",
            "description" => __("A Font Awesome class for the icon you want to add to this tab. ", LANGUAGE_ZONE_ADMIN),
            "edit_field_class" => 'col-md-6'
        );
        vc_add_param('vc_tab', $attr);


        $attr = array(
            "type" => "dropdown",
            "heading" => __('Navigation Type', LANGUAGE_ZONE_ADMIN),
            "param_name" => "nav_type",
            //"description" => __("A Font Awesome class for the icon you want to add to this tab. ", LANGUAGE_ZONE_ADMIN),
            "value" => array(
                __("Default (primary color tabs)", LANGUAGE_ZONE_ADMIN) => '',
                __("Dark Tabs 1", LANGUAGE_ZONE_ADMIN) => 'nav-dark',
                __("Dark Tabs 2", LANGUAGE_ZONE_ADMIN) => 'nav-dark-02',
                __("Oblique Primary Color", LANGUAGE_ZONE_ADMIN) => 'oblique',
                __("Oblique Dark Tabs 1", LANGUAGE_ZONE_ADMIN) => 'nav-dark oblique',
                __("Oblique Dark Tabs 2", LANGUAGE_ZONE_ADMIN) => 'nav-dark-02 oblique',
            ),
        );
        vc_add_param('vc_tabs', $attr);

        $attr = array(
            "type" => "dropdown",
            "heading" => __('Content Type', LANGUAGE_ZONE_ADMIN),
            "param_name" => "content_type",
            //"description" => __("A Font Awesome class for the icon you want to add to this tab. ", LANGUAGE_ZONE_ADMIN),
            "value" => array(
                __("Default", LANGUAGE_ZONE_ADMIN) => '',
                __("Dark Content", LANGUAGE_ZONE_ADMIN) => 'tab-content-dark',
                __("Oblique", LANGUAGE_ZONE_ADMIN) => 'oblique',
                __("Oblique Dark Content", LANGUAGE_ZONE_ADMIN) => 'tab-content-dark oblique',
            ),
        );
        vc_add_param('vc_tabs', $attr);

    }

    private function clubix_tanda_handler() {

        // TABS

        // Remove params
        vc_remove_param('vc_accordion', 'active_tab');
        vc_remove_param('vc_accordion', 'collapsible');
        vc_remove_param('vc_accordion', 'title');

        // Add params
        $attr = array(
            "type" => "dropdown",
            "heading" => __('Accordion Style', LANGUAGE_ZONE_ADMIN),
            "param_name" => "type",
            //"description" => __("A Font Awesome class for the icon you want to add to this tab. ", LANGUAGE_ZONE_ADMIN),
            "value" => array(
                __("Default", LANGUAGE_ZONE_ADMIN) => "default",
                __("Style 2", LANGUAGE_ZONE_ADMIN) => "primary",
                __("Style 3", LANGUAGE_ZONE_ADMIN) => "info"
            ),
            "edit_field_class" => 'col-md-6'
        );
        //vc_add_param('vc_accordion', $attr);

        $attr = array(
            "type" => "textfield",
            "heading" => __('Tab Icon Class', LANGUAGE_ZONE_ADMIN),
            "param_name" => "icon",
            "description" => __("A Font Awesome class for the icon you want to add to this tab. ", LANGUAGE_ZONE_ADMIN),
            "edit_field_class" => 'col-md-6'
        );
        vc_add_param('vc_accordion_tab', $attr);

    }

    private function clubix_text_divider(){

        // Remove params
        vc_remove_param('vc_text_separator', 'title_align');
        vc_remove_param('vc_text_separator', 'el_width');
        vc_remove_param('vc_text_separator', 'style');
        vc_remove_param('vc_text_separator', 'color');
        vc_remove_param('vc_text_separator', 'accent_color');
        vc_remove_param('vc_text_separator', 'el_class');


    }

    private function clubix_divider(){

        // Remove params
        vc_remove_param('vc_separator', 'el_class');
        vc_remove_param('vc_separator', 'el_width');
        vc_remove_param('vc_separator', 'style');
        vc_remove_param('vc_separator', 'color');
        vc_remove_param('vc_separator', 'accent_color');

        // Add params
        $attr = array(
            "type" => "dropdown",
            "heading" => __('Type', LANGUAGE_ZONE_ADMIN),
            "param_name" => "type",
            //"description" => __("A Font Awesome class for the icon you want to add to this tab. ", LANGUAGE_ZONE_ADMIN),
            "value" => array(
                __("Thin", LANGUAGE_ZONE_ADMIN) => "",
                __("Strong", LANGUAGE_ZONE_ADMIN) => "2"
            ),
        );
        vc_add_param('vc_separator', $attr);
    }

    private function clubix_tables(){
        vc_map( array(
            "name" => __("Tables", LANGUAGE_ZONE_ADMIN),
            "base" => "clx_tables",
            "category" => __('By StylishThemes', LANGUAGE_ZONE_ADMIN),
            "description" => __('Tables for your website.', LANGUAGE_ZONE_ADMIN),
            'icon' => 'icon-wpb-wp',
            "params" => array(
                array(
                    "type" => "textfield",
                    "heading" => __("Packages", LANGUAGE_ZONE_ADMIN),
                    "param_name" => "packages",
                    "description" => __("Your packeges. You must put the separator '|' between them.", LANGUAGE_ZONE_ADMIN),
                    "value" => "Basic Package | Normal Package | Next Package | Pro Package"
                ),
                array(
                    "type" => "textfield",
                    "heading" => __('Addons', LANGUAGE_ZONE_ADMIN),
                    "param_name" => "addons",
                    "description" => __("Your addons. You must put the separator '|' between them.", LANGUAGE_ZONE_ADMIN),
                    "value" => "Addon 1 | Addon 2 | Addon 3 | Bonus"
                ),
                array(
                    "type" => "textfield",
                    "heading" => __('Values', LANGUAGE_ZONE_ADMIN),
                    "param_name" => "values",
                    "description" => __("Your values: 'v' for check and '-' for uncheck. You must put the separator '|' between row and ',' between element.", LANGUAGE_ZONE_ADMIN),
                    "value" => "v , - , - , - | v , v , - , - | v , v , v , - | v , v , v , v"
                )
            )
        ) );
    }

    private function clubix_download(){
        vc_map( array(
            "name" => __("Download Button", LANGUAGE_ZONE_ADMIN),
            "base" => "clx_dwn",
            "category" => __('By StylishThemes', LANGUAGE_ZONE_ADMIN),
            "description" => __('Download button for your website.', LANGUAGE_ZONE_ADMIN),
            'icon' => 'icon-wpb-wp',
            "params" => array(
                array(
                    "type" => "attach_image",
                    "heading" => __("Image", LANGUAGE_ZONE_ADMIN),
                    "param_name" => "image",
                    "description" => __("Upload a image for your button.", LANGUAGE_ZONE_ADMIN)
                ),
                array(
                    "type" => "textfield",
                    "heading" => __('Icon', LANGUAGE_ZONE_ADMIN),
                    "param_name" => "icon",
                    "description" => __("Type a image class. Default: fa-cloud-download.", LANGUAGE_ZONE_ADMIN),
                    "value" => "fa-cloud-download"
                ),
                array(
                    "type" => "textfield",
                    "heading" => __('Text', LANGUAGE_ZONE_ADMIN),
                    "param_name" => "text",
                    "description" => __("Type the text you want to display on your button.", LANGUAGE_ZONE_ADMIN),
                    "value" => "Download!"
                ),
                array(
                    "type" => "textfield",
                    "heading" => __('Link button', LANGUAGE_ZONE_ADMIN),
                    "param_name" => "link",
                    "description" => __("Type the link to your download page.", LANGUAGE_ZONE_ADMIN)
                )
            )
        ) );
    }


}

VC_Setup::get_instance();

