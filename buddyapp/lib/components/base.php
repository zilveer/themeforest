<?php

/***************************************************
:: Header section render
 ***************************************************/

function kleo_show_header() {
    kleo_get_template_part( 'page-parts/header-top' );
}

add_action( 'kleo_header', 'kleo_show_header', 12 );


function kleo_show_side_menu() {

    kleo_get_template_part( 'page-parts/header-side' );
}

add_action( 'kleo_after_body', 'kleo_show_side_menu' );

if ( ! function_exists('kleo_show_page_title')) {
    /**
     * Render page title
     */
    function kleo_show_page_title() {
        if ( sq_option( 'page_title_title', true ) ) {
            echo '<h1>' . kleo_title() . '</h1>';
        }
    }
}

add_action( 'kleo_page_title_section', 'kleo_show_page_title', 12 );

/**
 * Render page title tagline
 */
function kleo_show_title_tagline() {
    if ( sq_option('page_title_tagline') ) {
        echo '<span>' . sq_option('page_title_tagline') .'</span>';
    }
}

add_action( 'kleo_page_title_section', 'kleo_show_title_tagline', 14 );

/**
 * Render page breadcrumb in title section
 */
function kleo_show_breadcrumb() {
    if (sq_option( 'page_title_breadcrumb', true, true )) {

        kleo_breadcrumb( array( 'container' => 'ol', 'separator' => '', 'show_browse' => false ) );

    }
}

add_action( 'kleo_page_title_section', 'kleo_show_breadcrumb', 16 );

/***************************************************
:: Add body classes
 ***************************************************/

add_filter( 'body_class','kleo_body_classes' );

/*
 * Adds specific classes to body element
 *
 * @param array $classes
 * @return array
 * @since 1.0
 */
function kleo_body_classes( $classes = array() ) {

    if( is_admin_bar_showing() && sq_option( 'admin_bar', 1 ) == 1 ) {
        $classes[] = 'adminbar-enable';
    }

    //page transition
    if ( sq_option( 'page_loader', false ) ) {
        $classes[] = 'page-transition';
    }

    //side-menu cookie
    if (sq_option('header_sidemenu', true, true)) {
        if ( sq_option( 'header_sidemenu_state', 'cookie' ) == 'cookie' ) {
            if ( isset( $_COOKIE['kleo-side'] ) && $_COOKIE['kleo-side'] == 'open' ) {
                $classes[] = 'sidemenu-is-open';
                $classes[] = 'force-close-sidemenu';
                $classes[] = 'sidemenu-saved';
            }
        } elseif ( sq_option( 'header_sidemenu_state', 'cookie' ) == 'narrow' ) {
            $classes[] = 'sidemenu-is-open';
            $classes[] = 'force-close-sidemenu';
        }
    } else {
        $classes[] = 'no-sidemenu';
    }

    //is customizer
    if (is_customize_preview()) {
        $classes[] = 'customize-preview';
    }
    
    
    return $classes;
}


/***************************************************
:: Dynamic variables
 ***************************************************/

add_filter( 'kleo_get_dynamic_variables', 'kleo_base_dynamic_variables' );
function kleo_base_dynamic_variables( $variables ) {

    foreach (Kleo::get_config('styling_variables') as $slug => $name) {
        if (sq_option('header_style_' . str_replace('-', '_', $slug))) {
            $variables['header-' . $slug] = sq_option('header_style_' . str_replace('-', '_', $slug));
        }

        if (sq_option('default_style_' . str_replace('-', '_', $slug))) {
            $variables['default-' . $slug] = sq_option('default_style_' . str_replace('-', '_', $slug));
        }

        if (sq_option('sidemenu_style_' . str_replace('-', '_', $slug))) {
            $variables['sidemenu-' . $slug] = sq_option('sidemenu_style_' . str_replace('-', '_', $slug));
        }
    }

    if (sq_option('header_style_mobile_background_color')) {
        $variables['header-mobile-background-color'] = sq_option('header_style_mobile_background_color');
    }


    if (sq_option('font_headings')) {
        $variables['heading-font'] = sq_option('font_headings');
    }
    if (sq_option('font_text')) {
        $variables['body-font'] = sq_option('font_text');
    }

    $headings_array = array( 'h1' , 'h2', 'h3', 'h4', 'h5', 'h6' );
    foreach ( $headings_array as $heading ) {
        if ( sq_option('font_size_' . $heading ) ) {
            $variables['font-size-' . $heading] = round( sq_option( 'font_size_' . $heading ) / 16, 2 ) . 'em';
        }
    }

    if (sq_option('font_size_base')) {
        $variables['font-size-base'] = round(sq_option('font_size_base') / 16, 2) . 'rem';
        $variables['font-size-content'] = round(sq_option('font_size_base') / 16, 2) . 'em';
    }


    return $variables;
}



/***************************************************
:: Theme options
 ***************************************************/

add_filter( 'kleo_theme_settings', 'kleo_base_settings' );

function kleo_base_settings( $kleo )
{
    //
    // Settings Sections
    //

    $kleo['panels']['kleo_panel_styling'] = array(
        'title' => esc_html__('Styling', 'buddyapp'),
        'description' => __('Styling & fonts settings', 'buddyapp'),
        'priority' => 10
    );


    $kleo['sec']['kleo_section_layout'] = array(
        'title' => esc_html__( 'Layout', 'buddyapp' ),
        'priority' => 8
    );
    $kleo['sec']['kleo_section_styling'] = array(
        'title' => esc_html__('Main section Colors', 'buddyapp'),
        'panel' => 'kleo_panel_styling',
        'priority' => 10
    );
    $kleo['sec']['kleo_section_fonts'] = array(
        'title' => esc_html__('Fonts', 'buddyapp'),
        'panel' => 'kleo_panel_styling',
        'priority' => 10
    );
    $kleo['sec']['kleo_section_logo'] = array(
        'title' => esc_html__('Logo', 'buddyapp'),
        'priority' => 13
    );
    $kleo['sec']['kleo_section_blog'] = array(
        'title' => esc_html__('Blog', 'buddyapp'),
        'priority' => 14
    );


    //
    // Layout
    //


    $kleo['set'][] = array(
        'id' => 'site_layout',
        'type' => 'select',
        'title' => esc_html__('Site Layout', 'buddyapp'),
        'choices' => array(
            'full' => esc_html__('Full', 'buddyapp'),
            'right' => esc_html__('Right sidebar', 'buddyapp'),
            'left' => esc_html__('Left sidebar', 'buddyapp')
        ),
        'default' => 'full',
        'section' => 'kleo_section_layout',
        'customizer' => true,
        'transport' => 'refresh'
    );


    $kleo['set'][] = array(
        'id' => 'page_loader',
        'type' => 'switch',
        'title' => esc_html__('Page load transition', 'buddyapp'),
        'default' => '0',
        'section' => 'kleo_section_layout',
        'description' => esc_html__('Have a nice page load effect', 'buddyapp'),
        'customizer' => true,
        'transport' => 'refresh'
    );


    //
    // Styling.
    //

    $kleo['set'][] = array(
        'id' => 'font_headings',
        'type' => 'gfont',
        'title' => esc_html__('Headings font', 'buddyapp'),
        'default' => '',
        'section' => 'kleo_section_fonts',
        'description' => esc_html__('Font for the h1, h2, etc. font', 'buddyapp'),
        'customizer' => true,
        'transport' => 'refresh'
    );

    $kleo['set'][] = array(
        'id' => 'font_text',
        'type' => 'gfont',
        'title' => esc_html__('Text font', 'buddyapp'),
        'default' => '',
        'section' => 'kleo_section_fonts',
        'description' => esc_html__('Font for the text on your site', 'buddyapp'),
        'customizer' => true,
        'transport' => 'refresh'
    );

    $headings_array = array( 'h1' => 30 , 'h2' => 24, 'h3' => 18, 'h4' => 18, 'h5' => 16, 'h6' => 14 );

    $kleo['set'][] = array(
        'id' => 'font_size_base',
        'type' => 'text',
        'title' => esc_html__( "Body text font size", "buddyapp" ),
        'default' => 16,
        'section' => 'kleo_section_fonts',
        'description' => esc_html__('Font size in pixels', 'buddyapp') .  '. Default 16' ,
        'customizer' => true,
        'transport' => 'refresh'
    );


    foreach ( $headings_array as $heading => $default ) {
        $kleo['set'][] = array(
            'id' => 'font_size_' . $heading,
            'type' => 'text',
            'title' => strtoupper( $heading ) . ' ' . esc_html__( "Font size", "buddyapp" ),
            'default' => $default,
            'section' => 'kleo_section_fonts',
            'description' => esc_html__('Font size in pixels', 'buddyapp') .  '. Default ' . $default,
            'customizer' => true,
            'transport' => 'refresh'
        );
    }

    foreach (Kleo::get_config( 'styling_variables' ) as $slug => $name) {
        $kleo['set'][] = array(
            'id' => 'default_style_' . str_replace('-', '_', $slug),
            'type' => 'color',
            'title' => $name,
            'default' => '',
            'section' => 'kleo_section_styling',
            'customizer' => true,
            'transport' => 'refresh'
        );
    }

    //
    // Header.
    //


    $kleo['panels']['kleo_panel_header'] = array(
        'title' => esc_html__('Header', 'buddyapp'),
        'priority' => 12
    );
    $kleo['sec']['kleo_section_header'] = array(
        'title' => esc_html__('Header settings', 'buddyapp'),
        'panel' => 'kleo_panel_header',
        'priority' => 12
    );
    $kleo['sec']['kleo_section_header_styling'] = array(
        'title' => esc_html__('Header Styling', 'buddyapp'),
        'panel' => 'kleo_panel_header',
        'priority' => 12
    );
    $kleo['sec']['kleo_section_header_sidemenu'] = array(
        'title' => esc_html__('Side-Menu Styling', 'buddyapp'),
        'panel' => 'kleo_panel_header',
        'priority' => 12
    );

    $kleo['set'][] = array(
        'id' => 'header_right_logic',
        'type' => 'select',
        'title' => esc_html__( 'Right menu location display logic' , 'buddyapp' ),
        'default' => 'default',
        'choices' => array(
            'default' => 'Just for logged in, under my Profile image',
            'replace' => 'My menu will display horizontally for everyone'
        ),
        'section' => 'kleo_section_header',
        'description' => esc_html__('How to render the assigned custom menu. First option will show a login button for guests instead of your menu.', 'buddyapp'),
        'customizer' => true,
        'transport' => 'refresh'
    );

    $kleo['set'][] = array(
        'id' => 'header_search',
        'type' => 'switch',
        'title' => esc_html__( 'Display search in header', 'buddyapp' ),
        'default' => '1',
        'section' => 'kleo_section_header',
        'description' => esc_html__('Enable/disable the search form in the header area', 'buddyapp'),
        'customizer' => true,
        'transport' => 'refresh'
    );

    $kleo['set'][] = array(
        'id' => 'search_context',
        'type' => 'multi-select',
        'title' => esc_html__( 'Search context' , 'buddyapp' ),
        'default' => '',
        'choices' => kleo_search_scope_post_types(),
        'section' => 'kleo_section_header',
        'description' => esc_html__('What to search for.', 'buddyapp'),
        'customizer' => true,
        'transport' => 'postMessage',
        'condition' => array( 'header_search', 1 )
    );

    $kleo['set'][] = array(
        'id' => 'menu_dropdown',
        'type' => 'select',
        'title' => esc_html__( 'Dropdown menu trigger' , 'buddyapp' ),
        'default' => 'default',
        'choices' => array(
            'hover' => 'On Hover',
            'click' => 'On Arrow click'
        ),
        'section' => 'kleo_section_header',
        'description' => esc_html__('How to open the header sub-menus.', 'buddyapp'),
        'customizer' => true,
        'transport' => 'refresh'
    );

    //default menu icon
    $icon = Kleo::get_config( 'menu_icon_default' );
    $kleo['set'][] = array(
        'id' => 'menu_icon',
        'type' => 'select',
        'title' => esc_html__( 'Default Menu icon' , 'buddyapp' ),
        'default' => $icon,
        'choices' => kleo_icons_array(),
        'section' => 'kleo_section_header',
        'customizer' => true,
        'transport' => 'refresh'
    );


    $kleo['set'][] = array(
        'id' => 'header_sidemenu',
        'type' => 'switch',
        'title' => esc_html__( 'Sidemenu enabled', 'buddyapp' ),
        'default' => '1',
        'section' => 'kleo_section_header',
        'description' => esc_html__('Enable/disable left sidemenu area', 'buddyapp'),
        'customizer' => true,
        'transport' => 'refresh'
    );

    $kleo['set'][] = array(
        'id' => 'header_sidemenu_state',
        'type' => 'select',
        'title' => esc_html__( 'Sidemenu Desktop state' , 'buddyapp' ),
        'default' => 'cookie',
        'choices' => array(
            'cookie' => 'Cookie based. Opened by default.',
            'open' => 'Opened',
            'narrow' => 'Narrowed'
        ),
        'section' => 'kleo_section_header',
        'description' => esc_html__('How to show the left sidemenu by default on desktop devices. Cookie based uses last open state before browser refresh.', 'buddyapp'),
        'customizer' => true,
        'transport' => 'refresh',
        'condition' => array( 'header_sidemenu', 1 )
    );

    $kleo['set'][] = array(
        'id' => 'header_bottom_text',
        'type' => 'textarea',
        'title' => esc_html__( 'Bottom Text' , 'buddyapp' ),
        'default' => Kleo::get_config( 'footer_text' ),
        'section' => 'kleo_section_header',
        'description' => esc_html__('Bottom text on side menu', 'buddyapp'),
        'customizer' => true,
        'transport' => 'refresh',
        'condition' => array( 'header_sidemenu', 1 )
    );

    $styling_variables = Kleo::get_config('styling_variables');
    foreach ( $styling_variables as $slug => $name ) {
        $kleo['set'][] = array(
            'id' => 'header_style_' . str_replace('-', '_', $slug),
            'type' => 'color',
            'title' => 'Header ' . $name,
            'default' => '',
            'section' => 'kleo_section_header_styling',
            'customizer' => true,
            'transport' => 'refresh'
        );
    }

    //mobile bg color
    $kleo['set'][] = array(
        'id' => 'header_style_mobile_background_color',
        'type' => 'color',
        'title' => esc_html__('Mobile background color', 'buddyapp'),
        'default' => '',
        'section' => 'kleo_section_header_styling',
        'customizer' => true,
        'transport' => 'refresh'
    );


    // Sidemenu
    foreach (Kleo::get_config('styling_variables') as $slug => $name) {
        $kleo['set'][] = array(
            'id' => 'sidemenu_style_' . str_replace('-', '_', $slug),
            'type' => 'color',
            'title' => 'Sidemenu ' . $name,
            'default' => '',
            'section' => 'kleo_section_header_sidemenu',
            'customizer' => true,
            'transport' => 'refresh'
        );
    }

    //
    // Logo
    //

    $kleo['set'][] = array(
        'id' => 'logo',
        'type' => 'image',
        'title' => esc_html__('Logo Image', 'buddyapp'),
        'default' => Kleo::get_config('logo_default'),
        'section' => 'kleo_section_logo',
        'description' => esc_html__('Used on dark backgrounds', 'buddyapp'),
        'customizer' => true,
        'transport' => 'refresh'
    );

    $kleo['set'][] = array(
        'id' => 'logo_retina',
        'type' => 'image',
        'title' => esc_html__('Retina Logo Image', 'buddyapp'),
        'default' => '',
        'section' => 'kleo_section_logo',
        'customizer' => true,
        'transport' => 'postMessage'
    );

    $kleo['set'][] = array(
        'id' => 'logo_dark',
        'type' => 'image',
        'title' => esc_html__('Dark Logo Image', 'buddyapp'),
        'default' => Kleo::get_config('logo_dark_default'),
        'section' => 'kleo_section_logo',
        'description' => esc_html__('Used on white backgrounds', 'buddyapp'),
        'customizer' => true,
        'transport' => 'refresh'
    );

    $kleo['set'][] = array(
        'id' => 'logo_dark_retina',
        'type' => 'image',
        'title' => esc_html__( 'Retina Dark Logo Image', 'buddyapp' ),
        'default' => '',
        'section' => 'kleo_section_logo',
        'customizer' => true,
        'transport' => 'postMessage'
    );

    $kleo['set'][] = array(
        'id' => 'logo_mini',
        'type' => 'image',
        'title' => esc_html__( 'Logo Mini Image', 'buddyapp' ),
        'default' => Kleo::get_config( 'logo_mini_default' ),
        'section' => 'kleo_section_logo',
        'description' => esc_html__('Used when side menu is minimized', 'buddyapp'),
        'customizer' => true,
        'transport' => 'refresh'
    );

    $kleo['set'][] = array(
        'id' => 'logo_mini_retina',
        'type' => 'image',
        'title' => esc_html__( 'Retina Logo Mini Image', 'buddyapp' ),
        'default' => '',
        'section' => 'kleo_section_logo',
        'customizer' => true,
        'transport' => 'postMessage'
    );


    //Blog

    $kleo['set'][] = array(
        'id' => 'blog_layout',
        'type' => 'select',
        'title' => esc_html__( 'Blog Layout', 'buddyapp' ),
        'default' => 'default',
        'choices' => array( 'default' => 'Site Default', 'full' => 'Full', 'right' => 'Right sidebar', 'left' => 'Left sidebar'),
        'section' => 'kleo_section_blog',
        'customizer' => true,
        'transport' => 'refresh'
    );

    //blog_get_image - switch
    $kleo['set'][] = array(
        'id' => 'blog_get_image',
        'type' => 'switch',
        'title' => esc_html__( 'Get image from post content', 'buddyapp' ),
        'default' => '1',
        'section' => 'kleo_section_blog',
        'description' => esc_html__('If no featured image was added, get it from the post content', 'buddyapp'),
        'customizer' => true,
        'transport' => 'refresh'
    );

    //blog_default_image - image
    $kleo['set'][] = array(
        'id' => 'blog_default_image',
        'type' => 'image',
        'title' => esc_html__( 'Default Post Image', 'buddyapp' ),
        'default' => '',
        'section' => 'kleo_section_blog',
        'description' =>  esc_html__('Used when post has no featured image', 'buddyapp'),
        'customizer' => true,
        'transport' => 'postMessage'
    );

    //post_media_status
    $kleo['set'][] = array(
        'id' => 'post_media_status',
        'type' => 'select',
        'title' => esc_html__( 'Show featured image on post page', 'buddyapp' ),
        'default' => '1',
        'choices' => array( '1' => 'Yes', '0' => 'No'),
        'section' => 'kleo_section_blog',
        'customizer' => true,
        'transport' => 'refresh'
    );

    return $kleo;
}

/* Get post types for Search scope */
function kleo_search_scope_post_types() {
    $scope_atts = array();
    $scope_atts['extra'] = array();
    if (function_exists('bp_is_active')) {
        $scope_atts['extra']['members'] = 'Members';
        $scope_atts['extra']['groups'] = 'Groups';
    }
    $scope_atts['extra']['post'] = 'Posts';
    $scope_atts['extra']['page'] = 'Pages';
    $scope_atts['exclude'] = array('topic', 'reply');

    return kleo_post_types( $scope_atts );
}

/***************************************************
:: Layout
 ***************************************************/

Kleo::set_config( 'site_layout_default', 'full' );
Kleo::set_config( 'blog_layout_default', 'default' );


if ( ! function_exists( 'kleo_prepare_layout' ) ) {
    /**
     * Prepare site layout with different customizations
     * @global string $kleo_custom_logo
     */
    function kleo_prepare_layout() {

        //Change the template
        $layout = sq_option( 'site_layout', Kleo::get_config('site_layout_default') );

        if( is_single() ) {
            if ( get_cfield( 'post_layout' ) && get_cfield('post_layout') != 'default' ) {
                $layout = get_cfield('post_layout');
            } else {
                if ( sq_option( 'blog_layout', Kleo::get_config('blog_layout_default') ) == 'default' ) {
                    $layout = sq_option( 'site_layout', Kleo::get_config('site_layout_default'));
                } else {
                    $layout = sq_option( 'blog_layout', Kleo::get_config('blog_layout_default'));
                }

            }
        }
        $layout = apply_filters( 'site_layout', $layout );
        kleo_switch_layout( $layout );

        //page specific overrides
        add_filter( 'sq_option', 'kleo_base_options', 10, 2 );

        if( is_singular()) {
            if (get_cfield('page_bg') ) {
                Kleo::add_css('body, #content, .page-title-colors, #respond { background-color:' . get_cfield('page_bg') . '!important;}');
            }
            if (get_cfield('page_bg_image') ) {
                Kleo::add_css('body, #content, .page-title-colors, #respond { ' .
                    'background-image: url("' . get_cfield('page_bg_image') . '") !important; ' .
                    'background-size: cover; background-repeat: no-repeat;' .
                    '}'
                );
            }
        }

    }
}

add_action( 'wp_head','kleo_prepare_layout' );


// Logo defaults logic

Kleo::set_config( 'logo_default', get_template_directory_uri() . '/assets/images/logo.png' );
Kleo::set_config( 'logo_dark_default', get_template_directory_uri() . '/assets/images/logo-dark.png' );
Kleo::set_config( 'logo_mini_default', get_template_directory_uri() . '/assets/images/logo-mini.png' );

// if side menu background is dark/white
$sidemenu_color = sq_option( 'sidemenu_style_background_color', '#0c0e38' );

if ( kleo_calc_perceived_brightness( $sidemenu_color, 100 ) ) {
    $logo_side = 'logo';
} else {
    $logo_side = 'logo_dark';
}
Kleo::set_config( 'logo_side', $logo_side );


// if header background is dark/white
$header_color = sq_option( 'header_style_background_color', '#ffffff' );

if ( kleo_calc_perceived_brightness( $header_color, 100 ) ) {
    $logo_mobile = 'logo';
} else {
    $logo_mobile = 'logo_dark';
}
Kleo::set_config( 'logo_mobile', $logo_mobile );



/* Page specific overrides */
function kleo_base_options( $output, $option ) {

    if( $option == 'post_media_status' && is_single() && get_cfield('post_media_status') != '' ) {
        if ( get_cfield( 'post_media_status' ) == 'yes' ) {
            $output = 1;
        } elseif ( get_cfield( 'post_media_status' ) == 'no' ) {
            $output = 0;
        }
    }

    elseif( $option == 'page_title_enable' && is_singular() && get_cfield('page_title_enable') != '' ) {
        if ( get_cfield( 'page_title_enable' ) == 'yes' ) {
            $output = true;
        } else {
            $output = false;
        }
    }
    elseif( $option == 'header_sidemenu' && is_singular() && get_cfield('header_sidemenu') != 'default' ) {
        if ( get_cfield( 'header_sidemenu' ) == 'enabled' ) {
            $output = true;
        } elseif ( get_cfield( 'header_sidemenu' ) == 'disabled' ) {
            $output = false;
        }
    }
    return $output;
}



add_action( 'customize_save_after', 'kleo_delete_font_transient' );
function kleo_delete_font_transient() {
    delete_transient( KLEO_DOMAIN . '_google_link' );
}

if ( ! function_exists( 'remove_wp_open_sans' ) ) {
    /**
     * Remove duplicate Open Sans from WordPress
     */
    function kleo_remove_wp_open_sans() {
        $font_link = get_transient( KLEO_DOMAIN . '_google_link' );
        if ( strpos( $font_link, 'Open+Sans' ) !== false ) {
            wp_deregister_style( 'open-sans' );
            wp_register_style( 'open-sans', false );
        }
    }
    add_action('wp_enqueue_scripts', 'kleo_remove_wp_open_sans');
}


function kleo_get_standard_fonts() {
    return array(
    "Arial, Helvetica, sans-serif",
    "'Arial Black', Gadget, sans-serif",
    "'Bookman Old Style', serif",
    "'Comic Sans MS', cursive",
    "Courier, monospace",
    "Garamond, serif",
    "Georgia, serif",
    "Impact, Charcoal, sans-serif",
    "'Lucida Console', Monaco, monospace",
    "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
    "'MS Sans Serif', Geneva, sans-serif",
    "'MS Serif', 'New York', sans-serif",
    "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
    "Tahoma, Geneva, sans-serif",
    "'Times New Roman', Times, serif",
    "'Trebuchet MS', Helvetica, sans-serif",
    "Verdana, Geneva, sans-serif"
    );
}


/* Google fonts Load */
function sq_load_google_fonts_style() {
    if ( get_google_fonts_link() ) {
        wp_enqueue_style( 'kleo-google-fonts', get_google_fonts_link(), array(), null );
    }
}

add_action( 'wp_enqueue_scripts', 'sq_load_google_fonts_style' );

function get_google_fonts_link() {

    $std_fonts = kleo_get_standard_fonts();

    $fonts = array();
    $sections = array( 'headings', 'text' );

    //kleo_delete_font_transient();

    if ( is_customize_preview() || get_transient( KLEO_DOMAIN . '_google_link' ) === FALSE ) {

        foreach ( $sections as $section ) {

            $font = sq_option ( 'font_' . $section );

            if ( $font == '' ) {
                $font = Kleo::get_config( 'default_font_' . $section );
            }

            $font = str_replace($std_fonts, '', $font);

            if (empty($font) || $font == '') {
                continue;
            }

            $font_style = kleo_get_font_variants( $font );

            $font = str_replace(' ', '+', $font);
            if (!isset($fonts[$font])) {
                $fonts[$font] = array();
                $fonts[$font]['family'] = $font;
                $fonts[$font]['variants'] = $font_style;
            }

        }

        if ( ! empty( $fonts )) {

            $google_link = kleo_make_google_font_link($fonts);

            if( ! is_customize_preview() ) {
                set_transient(KLEO_DOMAIN . '_google_link', $google_link, 12 * 60 * 60);
            }
        }


    } else {
        $google_link = get_transient( KLEO_DOMAIN . '_google_link' );
    }

    return $google_link;
}



function kleo_make_google_font_link( $fonts ) {
    $link = "";
    $subsets = array();

    foreach( $fonts as $font ) {
        if ( ! empty( $link )) {
            $link .= "|"; // Append a new font to the string
        }

        $link .= $font['family'];


        if (isset($font['variants'])) {
            $link .= ':' . implode(',', $font['variants']);
        }


        if ( ! empty( $font['subset'] ) ) {
            foreach( $font['subset'] as $subset ) {
                if ( ! in_array( $subset, $subsets ) ) {
                    array_push( $subsets, $subset );
                }
            }

        }
    }
    if ( ! empty( $subsets ) ) {
        $link .= "&amp;subset=".implode(',', $subsets);
    }

    return '//fonts.googleapis.com/css?family=' . $link;

}

function kleo_get_font_variants( $font_name ) {

    $variants = array();

    $fonts = kleo_get_google_fonts();

    if (! empty($fonts)) {

        foreach ( $fonts->items as $font ) {
            if ( $font_name == $font->family ) {
                $variants = $font->variants;
            }
        }

        foreach ( $variants as $k => $variant ) {
            if ( $variant == 'regular' ) {
                $variants[ $k ] = '400';
            }
            if ( $variant == 'italic' ) {
                $variants[ $k ] = '400italic';
            }
        }
    }

    return (array)$variants;
}

function kleo_get_google_fonts() {

    if ( $content = get_transient( 'buddyapp_fonts' ) ) {
        return $content;
    }
    else {
        $selectDirectory = get_template_directory() . '/lib/customizer/assets/';
        $fontFile = $selectDirectory . 'google-web-fonts.txt';
        if ( file_exists( $fontFile ) ) {
            $content = json_decode( sq_fs_get_contents( $fontFile ) );
        } else {
            $googleApi = 'https://www.googleapis.com/webfonts/v1/webfonts?sort=alpha&key=AIzaSyDhrTD5e5gNmX2b4keObH6cHA2DL8rsqMo';
            $font_data = wp_remote_get ( $googleApi, array( 'sslverify' => false ) );

            if ( ! is_wp_error( $font_data ) ) {
                $font_body = wp_remote_retrieve_body($font_data);
                $content = json_decode($font_body);

                sq_fs_put_contents( $fontFile, $font_body );

            } else {
                return $font_data->get_error_message();
            }

        }

        set_transient( 'buddyapp_fonts', $content );

        return $content;
    }
}

/***************************************************
:: Sidebar logic
 ***************************************************/
if ( ! function_exists( 'kleo_switch_layout' )) {
    /**
     * Change site layout
     *
     * @param bool $layout
     * @param int $priority
     */
    function kleo_switch_layout( $layout = false, $priority = 10 )
    {
        if( $layout == false ) {
            $layout = sq_option( 'site_layout', Kleo::get_config('site_layout_default') );
        }

        switch ( $layout ) {

            case 'left':
                add_action( 'kleo_after_content', 'kleo_sidebar', $priority );
                add_filter( 'kleo_main_section_class', create_function('$classes', ' $classes["tpl"]="tpl-left-sidebar"; return $classes;'), $priority );
                break;

            case 'right':
                add_action( 'kleo_after_content', 'kleo_sidebar', $priority );
                add_filter( 'kleo_main_section_class', create_function('$classes', ' $classes["tpl"]="tpl-right-sidebar"; return $classes;'), $priority );
                break;

            case 'full':
            default :
                remove_action( 'kleo_after_content', 'kleo_sidebar' );
                add_filter( 'kleo_main_section_class', create_function('$classes', ' $classes["tpl"]="tpl-full-width"; return $classes;'), $priority );

                break;
        }
    }
}


//get the global sidebar
if ( ! function_exists( 'kleo_sidebar' ) ):
    function kleo_sidebar()
    {
        get_sidebar();
    }
endif;

//return full container class
function kleo_ret_full_container() {
    return 'container-fluid';
}



/***************************************************
:: Header section functions
 ***************************************************/

/**
 * Display the classes for the header element.
 *
 * @since 1.0
 *
 * @param string|array $class One or more classes to add to the class list.
 */
function kleo_header_class( $class = '' ) {
    // Separates classes with a single space, collates classes for body element
    echo 'class="' . join( ' ', kleo_get_header_class( $class ) ) . '"';
}

/**
 * Retrieve the classes for the header element as an array.
 *
 * @since 1.0
 *
 * @param string|array $class One or more classes to add to the class list.
 * @return array Array of classes.
 */
function kleo_get_header_class( $class = '' ) {

    $classes = array( 'header-colors' );

    if ( ! empty( $class ) ) {
        if ( !is_array( $class ) ) {
            $class = preg_split('#\s+#', $class);
        }
        $classes = array_merge( $classes, $class );
    } else {
        // Ensure that we always coerce class to being an array.
        $class = array();
    }

    $classes = apply_filters( 'kleo_header_class', $classes, $class );

    return array_unique( $classes );
}


/***************************************************
:: Menu section functions
 ***************************************************/

/**
 * Display the classes for the menu element.
 *
 * @since 1.0
 *
 * @param string|array $class One or more classes to add to the class list.
 */
function kleo_menu_class( $class = '' ) {
    // Separates classes with a single space, collates classes for body element
    echo 'class="' . join( ' ', kleo_get_menu_class( $class ) ) . '"';
}

/**
 * Retrieve the classes for the menu element as an array.
 *
 * @since 1.0
 *
 * @param string|array $class One or more classes to add to the class list.
 * @return array Array of classes.
 */
function kleo_get_menu_class( $class = '' ) {

    $classes = array();

    if ( ! empty( $class ) ) {
        if ( !is_array( $class ) ) {
            $class = preg_split('#\s+#', $class);
        }
        $classes = array_merge( $classes, $class );
    } else {
        // Ensure that we always coerce class to being an array.
        $class = array();
    }

    $classes = apply_filters( 'kleo_menu_class', $classes, $class );

    return array_unique( $classes );
}


function kleo_header_attribute( $attribute = '' ) {
    $attributes = array();

    if ( $attribute != '' ) {
        $attributes[] = $attribute;
    }

    $attributes = apply_filters( 'kleo_header_attribute', $attributes, $attribute );

    if ( !empty( $attributes ) ) {
        echo join( ' ', (array) $attributes );
    } else {
        echo '';
    }
}



/***************************************************
:: Main section functions
 ***************************************************/


/**
 * Display the classes for the main section.
 *
 * @since 1.0
 *
 * @param string|array $class One or more classes to add to the class list.
 */
function kleo_main_section_class( $class = '' ) {
    // Separates classes with a single space, collates classes for body element
    echo 'class="' . join( ' ', kleo_get_main_section_class( $class ) ) . '"';
}

/**
 * Retrieve the classes for the menu element as an array.
 *
 * @since 1.0
 *
 * @param string|array $class One or more classes to add to the class list.
 * @return array Array of classes.
 */
function kleo_get_main_section_class( $class = '' ) {

    $classes = array();

    if ( ! empty( $class ) ) {
        if ( !is_array( $class ) ) {
            $class = preg_split('#\s+#', $class);
        }
        $classes = array_merge( $classes, $class );
    } else {
        // Ensure that we always coerce class to being an array.
        $class = array();
    }

    $classes = apply_filters( 'kleo_main_section_class', $classes, $class );

    return array_unique( $classes );
}



/***************************************************
:: SIDEBAR section functions
 ***************************************************/


/**
 * Display the classes for the main section.
 *
 * @since 1.0
 *
 * @param string|array $class One or more classes to add to the class list.
 */
function kleo_sidebar_class( $class = '' ) {
    // Separates classes with a single space, collates classes for body element
    echo 'class="' . join( ' ', kleo_get_sidebar_class( $class ) ) . '"';
}

/**
 * Retrieve the classes for the menu element as an array.
 *
 * @since 1.0
 *
 * @param string|array $class One or more classes to add to the class list.
 * @return array Array of classes.
 */
function kleo_get_sidebar_class( $class = '' ) {

    $classes = array();

    if ( ! empty( $class ) ) {
        if ( !is_array( $class ) ) {
            $class = preg_split('#\s+#', $class);
        }
        $classes = array_merge( $classes, $class );
    } else {
        // Ensure that we always coerce class to being an array.
        $class = array();
    }

    $classes = apply_filters( 'kleo_sidebar_class', $classes, $class );

    return array_unique( $classes );
}