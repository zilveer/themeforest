<?php

// Define Directories
define('sys_lib', TEMPLATEPATH.'/inc'); // Includes
define('sys_layout', TEMPLATEPATH.'/layout'); // Layout

define('sys_template_dir', get_template_directory()); // Template Directory
define('sys_template_uri', get_template_directory_uri()); // Template Directory URI
define('sys_theme_css', sys_template_uri.'/css'); // CSS URI
define('sys_theme_js', sys_template_uri.'/js'); // JS URI
define('sys_theme_plugins', sys_template_dir.'/inc/plugins'); // get plugins directory
define('sys_theme_plugins_uri', sys_template_uri.'/inc/plugins'); // get plugins uri

// Set Content Width
if ( ! isset( $content_width ) ) $content_width = 900;

// Define Variables
$theme = wp_get_theme();
define('venedor_version', $theme->get('Version'));


// Function for Content Type, ReducxFramework
function venedor_ct_layouts() {
    return array(
        "fullwidth" => "Full Width",
        "left-sidebar" => "Left Sidebar",
        "right-sidebar" => "Right Sidebar"
    );
}

function venedor_ct_sidebars() {
    global $wp_registered_sidebars;
    
    $sidebar_options = array();
    if (!empty($wp_registered_sidebars)) {
        foreach ($wp_registered_sidebars as $sidebar) {
            $sidebar_options[$sidebar['id']] = $sidebar['name'];
        }
    };
    
    return $sidebar_options;
}

function venedor_ct_banner_type() {
    return array(
        "layer_slider" => "LayerSlider",
        "rev_slider" => "Revolution Slider",
        "banner" => "Banner",
        "product_slider" => "Product Slider"
    );
}

function venedor_ct_banner_width() {
    return array(
        "wide" => "Wide Width",
        "narrow" => "Content Width"
    );
}

function venedor_ct_layer_sliders() {
    global $wpdb;
    
    $table_name = $wpdb->prefix . "layerslider";
    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name) {
        $sliders = $wpdb->get_results( "SELECT * FROM $table_name
                                        WHERE flag_hidden = '0' AND flag_deleted = '0'
                                        ORDER BY date_c ASC" );
    
        $layer_sliders = array();
        if (!empty($sliders)) {
            foreach($sliders as $slider) {
                $layer_sliders[$slider->id] = '#'.$slider->id.': '.$slider->name;
            }
        }

        return $layer_sliders;
    }
    
    return null;
}

function venedor_ct_rev_sliders() {
    global $wpdb;
    
    $table_name = $wpdb->prefix . "revslider_sliders";
    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name) {
        $sliders = $wpdb->get_results('SELECT * FROM '.$table_name);
        $rev_sliders = array();
        if (!empty($sliders)) {
            foreach($sliders as $slider) {
                $rev_sliders[$slider->alias] = '#'.$slider->id.': '.$slider->title;
            }
        }
        
        return $rev_sliders;
    }
    
    return null;
}    

/**
* Embedded Redux Framework
*/
global $venedor_import;
// Venedor Options Functions
if ( file_exists( dirname( __FILE__ ) . '/ReduxFramework/venedor/functions.php' ) ) {
    require_once( dirname( __FILE__ ) . '/ReduxFramework/venedor/functions.php' );
}

if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/ReduxFramework/ReduxCore/framework.php' ) ) {
    require_once( dirname( __FILE__ ) . '/ReduxFramework/ReduxCore/framework.php' );
}

// Venedor Import Options
if ( !isset( $venedor_import ) && file_exists( dirname( __FILE__ ) . '/ReduxFramework/venedor/import.php' ) ) {
    require_once( dirname( __FILE__ ) . '/ReduxFramework/venedor/import.php' );
}

global $venedor_settings, $venedor_design;

// Define Theme Type
define('VENEDOR_SETTINGS', isset($venedor_import['theme-settings'])?$venedor_import['theme-settings']:'');
define('VENEDOR_DESIGN', isset($venedor_import['theme-design'])?$venedor_import['theme-design']:'');

// Venedor Settings Options
if ( !isset( $venedor_settings ) && file_exists( dirname( __FILE__ ) . '/ReduxFramework/venedor/settings'.VENEDOR_SETTINGS.'.php' ) ) {
    require_once( dirname( __FILE__ ) . '/ReduxFramework/venedor/settings'.VENEDOR_SETTINGS.'.php' );
}

// Venedor Design Options
if ( !isset( $venedor_design ) && file_exists( dirname( __FILE__ ) . '/ReduxFramework/venedor/design'.VENEDOR_DESIGN.'.php' ) ) {
    require_once( dirname( __FILE__ ) . '/ReduxFramework/venedor/design'.VENEDOR_DESIGN.'.php' );
}

// Include Functions
require_once(sys_lib.'/functions.php');

// Get Venedor Meta Values
function venedor_meta_layout() {
    global $wp_query, $venedor_settings;

    $layout = isset($venedor_settings['layout'])?$venedor_settings['layout']:'fullwidth';
    $layout = (isset($_GET['blog-layout'])) ? $_GET['blog-layout'] : $layout;
    $default = venedor_meta_use_default();

    if (is_404()) {
        $layout = 'widewidth';
    } else if (is_category()) {
        $cat = $wp_query->get_queried_object();
        if ($default)
            $layout = $venedor_settings['blog-layout'];
        else
            $layout = get_metadata('category', $cat->term_id, 'layout', true);
    } else if (is_archive()) {
        if (function_exists('is_shop') && is_shop())  {
            if ($default)
                $layout = $venedor_settings['woocategory-layout'];
            else
                $layout = get_post_meta(wc_get_page_id( 'shop' ), 'layout', true);
        } else {
            $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
            if ($term) {
                if ($default) {
                    switch ($term->taxonomy) {
                        case 'portfolio_cat':
                        case 'portfolio_skills':
                            $layout = $venedor_settings['portfolio-layout'];
                            break;
                        case 'product_cat':
                        case 'product_tag':
                            $layout = $venedor_settings['woocategory-layout'];
                            break;
                        case 'aps-cats':
                        case 'aps-brands':
                            $layout = 'fullwidth';
                            break;
                        default:
                            $layout = $venedor_settings['blog-layout'];
                            break;
                    }
                } else {
                    $layout = get_metadata($term->taxonomy, $term->term_id, 'layout', true);
                }
            }
        }
    } else {
        if (is_singular()) {
            global $post;
            if ($default) {
                switch ($post->post_type) {
                    case 'product':
                        $layout = $venedor_settings['wooproduct-layout'];
                        break;
                    case 'portfolio':
                        $layout = $venedor_settings['portfolio-layout'];
                        break;
                    case 'post':
                        $layout = $venedor_settings['single-post-layout'];
                        break;
                    case 'aps-products':
                        $layout = 'fullwidth';
                        break;
                }
            } else {
                $layout = get_post_meta(get_the_id(), 'layout', true);
            }
        } else {
            if (!is_home() && is_front_page()) {

                $layout = $venedor_settings['home-layout'];
            } else if (is_home() && !is_front_page()) {
                $layout = $venedor_settings['blog-layout'];
                $layout = (isset($_GET['blog-layout'])) ? $_GET['blog-layout'] : $layout;
            } else if (is_home() || is_front_page()) {
                $layout = $venedor_settings['home-layout'];
            }
        }
    }

    return $layout;
}

function venedor_meta_sidebar() {
    global $wp_query;

    $sidebar = 'blog-sidebar';
    $default = venedor_meta_use_default();

    if (is_404()) {
        $sidebar = '';
    } else if (is_category()) {
        $cat = $wp_query->get_queried_object();
        if ($default)
            $sidebar = 'blog-sidebar';
        else
            $sidebar = get_metadata('category', $cat->term_id, 'sidebar', true);
    } else if (is_archive()) {
        if (function_exists('is_shop') && is_shop())  {
            if ($default)
                $sidebar = 'woocommerce-sidebar';
            else
                $sidebar = get_post_meta(wc_get_page_id( 'shop' ), 'sidebar', true);
        } else {
            $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
            if ($term) {
                if ($default) {
                    switch ($term->taxonomy) {
                        case 'portfolio_cat':
                        case 'portfolio_skills':
                            $sidebar = 'portfolio-sidebar';
                            break;
                        case 'product_cat':
                        case 'product_tag':
                            $sidebar = 'woocommerce-sidebar';
                            break;
                        default:
                            $sidebar = 'blog-sidebar';
                            break;
                    }
                } else {
                    $sidebar = get_metadata($term->taxonomy, $term->term_id, 'sidebar', true);
                }
            }
        }
    } else {
        if (is_singular()) {
            global $post;
            if ($default) {
                switch ($post->post_type) {
                    case 'product':
                        $sidebar = 'woocommerce-sidebar';
                        break;
                    case 'portfolio':
                        $sidebar = 'portfolio-sidebar';
                        break;
                    case 'post':
                    default:
                        $sidebar = 'blog-sidebar';
                        break;
                }
            } else {
                $sidebar = get_post_meta(get_the_id(), 'sidebar', true);
            }
        } else {
            if (!is_home() && is_front_page()) {
                $sidebar = 'home-sidebar';
            } else if (is_home() && !is_front_page()) {
                $sidebar = 'blog-sidebar';
            } else if (is_home() || is_front_page()) {
                $sidebar = 'home-sidebar';
            }
        }
    }

    return $sidebar;
}

function venedor_meta_header_on_banner() {
    global $wp_query, $venedor_settings;

    $header_on_banner = '';

    if (is_category()) {
        $cat = $wp_query->get_queried_object();
        $header_on_banner = get_metadata('category', $cat->term_id, 'header_on_banner', true);
    } else if (is_archive()) {
        if (function_exists('is_shop') && is_shop())  {
            $header_on_banner = get_post_meta(wc_get_page_id( 'shop' ), 'header_on_banner', true);
        } else {
            $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
            if ($term) {
                $header_on_banner = get_metadata($term->taxonomy, $term->term_id, 'header_on_banner', true);
            }
        }
    } else {
        if (is_singular()) {
            $header_on_banner = get_post_meta(get_the_id(), 'header_on_banner', true);
        } else {
            if (!is_home() && is_front_page()) {
                $header_on_banner = $venedor_settings['home-header-on-banner'];
            } else if (is_home() && !is_front_page()) {
                $header_on_banner = $venedor_settings['blog-header-on-banner'];
            } else if (is_home() || is_front_page()) {
                $header_on_banner = $venedor_settings['home-header-on-banner'];
            }
        }
    }

    $header_on_banner = ($header_on_banner == 'header_on_banner')?true:false;

    $banner_type = venedor_meta_banner_type();
    $rev_slider = venedor_meta_rev_slider();
    $layer_slider = venedor_meta_layer_slider();
    $banner = venedor_meta_banner();
    if ( $header_on_banner && !(($banner_type === 'layer_slider' && isset($layer_slider)) || ($banner_type === 'rev_slider' && isset($rev_slider)) || ($banner_type === 'banner' && isset($banner))) ) {
        $header_on_banner = false;
    }

    return $header_on_banner;
}

function venedor_meta_bg_slider() {
    global $wp_query, $venedor_settings;

    $bg_rev_slider = '';

    if (is_category()) {
        $cat = $wp_query->get_queried_object();
        $bg_rev_slider = get_metadata('category', $cat->term_id, 'bg_rev_slider', true);
    } else if (is_archive()) {
        if (function_exists('is_shop') && is_shop())  {
            $bg_rev_slider = get_post_meta(wc_get_page_id( 'shop' ), 'bg_rev_slider', true);
        } else {
            $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
            if ($term) {
                $bg_rev_slider = get_metadata($term->taxonomy, $term->term_id, 'bg_rev_slider', true);
            }
        }
    } else {
        if (is_singular()) {
            $bg_rev_slider = get_post_meta(get_the_id(), 'bg_rev_slider', true);
        } else {
            if (!is_home() && is_front_page()) {
                $bg_rev_slider = $venedor_settings['home-bg-slider'];
            } else if (is_home() && !is_front_page()) {
                $bg_rev_slider = $venedor_settings['blog-bg-slider'];
            } else if (is_home() || is_front_page()) {
                $bg_rev_slider = $venedor_settings['home-bg-slider'];
            }
        }
    }

    return $bg_rev_slider;
}

function venedor_meta_banner_type() {
    global $wp_query, $venedor_settings;

    $banner_type = '';

    if (is_category()) {
        $cat = $wp_query->get_queried_object();
        $banner_type = get_metadata('category', $cat->term_id, 'banner_type', true);
    } else if (is_archive()) {
        if (function_exists('is_shop') && is_shop())  {
            $banner_type = get_post_meta(wc_get_page_id( 'shop' ), 'banner_type', true);
        } else {
            $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
            if ($term) {
                $banner_type = get_metadata($term->taxonomy, $term->term_id, 'banner_type', true);
            }
        }
    } else {
        if (is_singular()) {
            $banner_type = get_post_meta(get_the_id(), 'banner_type', true);
        } else {
            if (!is_home() && is_front_page()) {
                $banner_type = $venedor_settings['home-banner-type'];
            } else if (is_home() && !is_front_page()) {
                $banner_type = $venedor_settings['blog-banner-type'];
            } else if (is_home() || is_front_page()) {
                $banner_type = $venedor_settings['home-banner-type'];
            }
        }
    }

    if (is_search())
        $banner_type = '';

    return $banner_type;
}

function venedor_meta_banner_width() {
    global $wp_query, $venedor_settings;

    $banner_width = '';

    if (is_category()) {
        $cat = $wp_query->get_queried_object();
        $banner_width = get_metadata('category', $cat->term_id, 'banner_width', true);
    } else if (is_archive()) {
        if (function_exists('is_shop') && is_shop())  {
            $banner_width = get_post_meta(wc_get_page_id( 'shop' ), 'banner_width', true);
        } else {
            $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
            if ($term) {
                $banner_width = get_metadata($term->taxonomy, $term->term_id, 'banner_width', true);
            }
        }
    } else {
        if (is_singular()) {
            $banner_width = get_post_meta(get_the_id(), 'banner_width', true);
        } else {
            if (!is_home() && is_front_page()) {
                $banner_width = $venedor_settings['home-banner-width'];
            } else if (is_home() && !is_front_page()) {
                $banner_width = $venedor_settings['blog-banner-width'];
            } else if (is_home() || is_front_page()) {
                $banner_width = $venedor_settings['home-banner-width'];
            }
        }
    }

    return $banner_width;
}

function venedor_meta_layer_slider() {
    global $wp_query, $venedor_settings;

    $layer_slider = '';

    if (is_category()) {
        $cat = $wp_query->get_queried_object();
        $layer_slider = get_metadata('category', $cat->term_id, 'layer_slider', true);
    } else if (is_archive()) {
        if (function_exists('is_shop') && is_shop())  {
            $layer_slider = get_post_meta(wc_get_page_id( 'shop' ), 'layer_slider', true);
        } else {
            $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
            if ($term) {
                $layer_slider = get_metadata($term->taxonomy, $term->term_id, 'layer_slider', true);
            }
        }
    } else {
        if (is_singular()) {
            $layer_slider = get_post_meta(get_the_id(), 'layer_slider', true);
        } else {
            if (!is_home() && is_front_page()) {
                $layer_slider = $venedor_settings['home-layerslider'];
            } else if (is_home() && !is_front_page()) {
                $layer_slider = $venedor_settings['blog-layerslider'];
            } else if (is_home() || is_front_page()) {
                $layer_slider = $venedor_settings['home-layerslider'];
            }
        }
    }

    return $layer_slider;
}

function venedor_meta_rev_slider() {
    global $wp_query, $venedor_settings;

    $rev_slider = '';

    if (is_category()) {
        $cat = $wp_query->get_queried_object();
        $rev_slider = get_metadata('category', $cat->term_id, 'rev_slider', true);
    } else if (is_archive()) {
        if (function_exists('is_shop') && is_shop())  {
            $rev_slider = get_post_meta(wc_get_page_id( 'shop' ), 'rev_slider', true);
        } else {
            $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
            if ($term) {
                $rev_slider = get_metadata($term->taxonomy, $term->term_id, 'rev_slider', true);
            }
        }
    } else {
        if (is_singular()) {
            $rev_slider = get_post_meta(get_the_id(), 'rev_slider', true);
        } else {
            if (!is_home() && is_front_page()) {
                $rev_slider = $venedor_settings['home-revslider'];
            } else if (is_home() && !is_front_page()) {
                $rev_slider = $venedor_settings['blog-revslider'];
            } else if (is_home() || is_front_page()) {
                $rev_slider = $venedor_settings['home-revslider'];
            }
        }
    }

    return $rev_slider;
}

function venedor_meta_banner() {
    global $wp_query, $venedor_settings;

    $banner = '';

    if (is_category()) {
        $cat = $wp_query->get_queried_object();
        $banner = get_metadata('category', $cat->term_id, 'banner', true);
    } else if (is_archive()) {
        if (function_exists('is_shop') && is_shop())  {
            $banner = get_post_meta(wc_get_page_id( 'shop' ), 'banner', true);
        } else {
            $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
            if ($term) {
                $banner = get_metadata($term->taxonomy, $term->term_id, 'banner', true);
            }
        }
    } else {
        if (is_singular()) {
            $banner = get_post_meta(get_the_id(), 'banner', true);
        } else {
            if (!is_home() && is_front_page()) {
                if (isset($venedor_settings['home-banner']))
                    $banner = $venedor_settings['home-banner'];
            } else if (is_home() && !is_front_page()) {
                if (isset($venedor_settings['blog-banner']))
                    $banner = $venedor_settings['blog-banner'];
            } else if (is_home() || is_front_page()) {
                if (isset($venedor_settings['home-banner']))
                    $banner = $venedor_settings['home-banner'];
            }
        }
    }

    return $banner;
}

function venedor_meta_product_slider() {
    global $wp_query, $venedor_settings;

    $product_slider = '';

    if (is_category()) {
        $cat = $wp_query->get_queried_object();
        $product_slider = get_metadata('category', $cat->term_id, 'product_slider', true);
    } else if (is_archive()) {
        if (function_exists('is_shop') && is_shop())  {
            $product_slider = get_post_meta(wc_get_page_id( 'shop' ), 'product_slider', true);
        } else {
            $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
            if ($term) {
                $product_slider = get_metadata($term->taxonomy, $term->term_id, 'product_slider', true);
            }
        }
    } else {
        if (is_singular()) {
            $product_slider = get_post_meta(get_the_id(), 'product_slider', true);
        } else {
            if (!is_home() && is_front_page()) {
                if (isset($venedor_settings['home-productslider']))
                    $product_slider = $venedor_settings['home-productslider'];
            } else if (is_home() && !is_front_page()) {
                if (isset($venedor_settings['blog-productslider']))
                    $product_slider = $venedor_settings['blog-productslider'];
            } else if (is_home() || is_front_page()) {
                if (isset($venedor_settings['home-productslider']))
                    $product_slider = $venedor_settings['home-productslider'];
            }
        }
    }

    return $product_slider;
}

function venedor_meta_content_top() {
    global $wp_query, $venedor_settings;

    $content_top = '';

    if (is_category()) {
        $cat = $wp_query->get_queried_object();
        $content_top = get_metadata('category', $cat->term_id, 'content_top', true);
    } else if (is_archive()) {
        if (function_exists('is_shop') && is_shop())  {
            $content_top = get_post_meta(wc_get_page_id( 'shop' ), 'content_top', true);
        } else {
            $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
            if ($term) {
                $content_top = get_metadata($term->taxonomy, $term->term_id, 'content_top', true);
            }
        }
    } else {
        if (is_singular()) {
            $content_top = get_post_meta(get_the_id(), 'content_top', true);
        } else {
            if (!is_home() && is_front_page()) {
                if (isset($venedor_settings['home-content-top']))
                    $content_top = $venedor_settings['home-content-top'];
            } else if (is_home() && !is_front_page()) {
                if (isset($venedor_settings['blog-content-top']))
                    $content_top = $venedor_settings['blog-content-top'];
            } else if (is_home() || is_front_page()) {
                if (isset($venedor_settings['home-content-top']))
                    $content_top = $venedor_settings['home-content-top'];
            }
        }
    }

    return $content_top;
}

function venedor_meta_content_bottom() {
    global $wp_query, $venedor_settings;

    $content_bottom = '';

    if (is_category()) {
        $cat = $wp_query->get_queried_object();
        $content_bottom = get_metadata('category', $cat->term_id, 'content_bottom', true);
    } else if (is_archive()) {
        if (function_exists('is_shop') && is_shop())  {
            $content_bottom = get_post_meta(wc_get_page_id( 'shop' ), 'content_bottom', true);
        } else {
            $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
            if ($term) {
                $content_bottom = get_metadata($term->taxonomy, $term->term_id, 'content_bottom', true);
            }
        }
    } else {
        if (is_singular()) {
            $content_bottom = get_post_meta(get_the_id(), 'content_bottom', true);
        } else {
            if (!is_home() && is_front_page()) {
                $content_bottom = $venedor_settings['home-content-bottom'];
            } else if (is_home() && !is_front_page()) {
                $content_bottom = $venedor_settings['blog-content-bottom'];
            } else if (is_home() || is_front_page()) {
                $content_bottom = $venedor_settings['home-content-bottom'];
            }
        }
    }

    return $content_bottom;
}

function venedor_meta_hide_breadcrumbs() {
    global $wp_query, $venedor_settings;

    $breadcrumbs = '';

    if (is_category()) {
        $cat = $wp_query->get_queried_object();
        $breadcrumbs = get_metadata('category', $cat->term_id, 'breadcrumbs', true);
    } else if (is_archive()) {
        if (function_exists('is_shop') && is_shop())  {
            $breadcrumbs = get_post_meta(wc_get_page_id( 'shop' ), 'breadcrumbs', true);
        } else {
            $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
            if ($term) {
                $breadcrumbs = get_metadata($term->taxonomy, $term->term_id, 'breadcrumbs', true);
            }
        }
    } else {
        if (is_singular()) {
            $breadcrumbs = get_post_meta(get_the_id(), 'breadcrumbs', true);
        } else {
            if (!is_home() && is_front_page()) {
                $breadcrumbs = 'breadcrumbs';
            } else if (is_home() && !is_front_page()) {
                $blog_id = get_option( 'page_for_posts' );
                if ($blog_id)
                    $breadcrumbs = get_post_meta($blog_id, 'breadcrumbs', true);
                else
                $breadcrumbs = '';
            } else if (is_home() || is_front_page()) {
                $breadcrumbs = 'breadcrumbs';
            }
        }
    }

    $breadcrumbs = ($breadcrumbs != 'breadcrumbs')?true:false;

    if (is_search()) {
        if (function_exists('is_shop') && is_shop())
            $breadcrumbs = true;
        else
            $breadcrumbs = false;
    }

    if (is_404())
        $breadcrumbs = false;

    return $breadcrumbs;
}

function venedor_meta_use_default() {
    global $wp_query, $venedor_settings;

    $default = '';

    if (is_category()) {
        $cat = $wp_query->get_queried_object();
        $default = get_metadata('category', $cat->term_id, 'default', true);
    } else if (is_archive()) {
        if (function_exists('is_shop') && is_shop())  {
            $default = get_post_meta(wc_get_page_id( 'shop' ), 'default', true);
        } else {
            $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
            if ($term) {
                $default = get_metadata($term->taxonomy, $term->term_id, 'default', true);
            }
        }
    } else {
        if (is_singular()) {
            global $post;
            if ($post->post_type == 'page') {
                $default = 'default';
            } else {
                $default = get_post_meta(get_the_id(), 'default', true);
            }
        }
    }

    $default = ($default != 'default')?true:false;

    return $default;
}

/*
 * LOAD CSS
 * */
add_action('wp_enqueue_scripts', 'venedor_css');
add_action('admin_enqueue_scripts', 'venedor_admin_css');
 
// Load CSS
function venedor_css() {
    global $venedor_settings, $venedor_design;
    
    // load visual composer styles
    if (!wp_style_is('js_composer_front'))
        wp_enqueue_style('js_composer_front');

    // load ultimate addons default js
    $bsf_options = get_option('bsf_options');
    $ultimate_global_scripts = (isset($bsf_options['ultimate_global_scripts'])) ? $bsf_options['ultimate_global_scripts'] : false;
    if ($ultimate_global_scripts !== 'enable') {
        $ultimate_css = get_option('ultimate_css');
        if ($ultimate_css == "enable") {
            if (!wp_style_is('ultimate-style-min'))
                wp_enqueue_style('ultimate-style-min');
        } else {
            if (!wp_style_is('ultimate-style'))
                wp_enqueue_style('ultimate-style');
        }
    }
    
    // plugin styles
    wp_deregister_style( 'plugins' );
    wp_register_style( 'plugins', sys_theme_css . '/plugins.css' );
    wp_enqueue_style( 'plugins' );
    
    // venedor styles
    wp_deregister_style( 'venedor-styles' );
    wp_register_style( 'venedor-styles', sys_theme_css . '/styles.css' );
    wp_enqueue_style( 'venedor-styles' );
?>    
    <!--[if lte IE 8]>
    <link rel="stylesheet" href="<?php echo sys_theme_css; ?>/ie8.css" />
    <![endif]-->
<?php    
    // config styles
    wp_deregister_style( 'system' );
    wp_register_style( 'system', get_bloginfo('template_directory') . '/_config/system_'.get_current_blog_id().'.css' );
    wp_enqueue_style( 'system' );
    
    // animate styles
    
    if ($venedor_design['use-animate-css']) {
        if (wp_is_mobile()) {
            if (!$venedor_design['disable-mobile-animate']) {
                wp_deregister_style( 'animate' );
                wp_register_style( 'animate', sys_theme_css.'/animate.css' );
                wp_enqueue_style( 'animate' );
                ?>
                <style type="text/css">
                .animated { visibility:hidden; }
                </style>
            <?php } else { ?>
                <style type="text/css">
                .animated {
                    visibility:visible !important;
                    -webkit-transition: none !important;
                    -moz-transition: none !important;
                    -o-transition: none !important;
                    -ms-transition: none !important;
                    transition: none !important;
                }
                </style>
            <?php } 
        } else {
            wp_deregister_style( 'animate' );
            wp_register_style( 'animate', sys_theme_css.'/animate.css');
            wp_enqueue_style( 'animate' );
            ?>
            <style type="text/css">
                .animated { visibility:hidden; }
            </style>
            <?php
        }
        ?>
    <?php } else { ?>
    <style type="text/css">
    .animated {
        visibility:visible !important;
        -webkit-transition: none !important;
        -moz-transition: none !important;
        -o-transition: none !important;
        -ms-transition: none !important;
        transition: none !important;
    }
    </style>
    <?php } ?>
    <!--[if lt IE 10]>
    <style type="text/css">
    .animated {
        visibility:visible !important;
        -webkit-transition: none !important;
        -moz-transition: none !important;
        -o-transition: none !important;
        -ms-transition: none !important;
        transition: none !important;
    }
    </style>
    <![endif]-->
<?php

    // default styles
    wp_deregister_style( 'style' );
    wp_register_style( 'style', get_bloginfo('template_directory') . '/style.css' );
    wp_enqueue_style( 'style' );
}

// Load Admin CSS
function venedor_admin_css() {
    wp_enqueue_style('venedor_admin_css', sys_theme_css.'/admin.css', false, venedor_version, 'all');

    // config admin styles
    wp_deregister_style( 'system-admin' );
    wp_register_style( 'system-admin', get_bloginfo('template_directory') . '/_config/system_admin_'.get_current_blog_id().'.css' );
    wp_enqueue_style( 'system-admin' );
}

/*
 * LOAD JAVASCRIPT
 * */
add_action('wp_enqueue_scripts', 'venedor_scripts');
add_action('admin_enqueue_scripts', 'venedor_admin_scripts');

// Load Admin JS
function venedor_admin_scripts() {
    wp_enqueue_script( 'common' );

    wp_print_scripts('media-upload');
    if (function_exists('add_thickbox')) 
        add_thickbox();
    
    wp_register_script('venedor-admin', sys_theme_js.'/admin.js', array('jquery', 'media-upload', 'thickbox'));
    wp_enqueue_script('venedor-admin');
    
}

function venedor_scripts() {    
if (!is_admin() && !in_array( $GLOBALS['pagenow'], array( 'wp-login.php', 'wp-register.php' ) )) {
    wp_reset_postdata();

    // load wc variation script
    wp_enqueue_script( 'wc-add-to-cart-variation' );

    //wp_deregister_script( 'jquery-cookie' );
    global $venedor_settings, $venedor_design, $post;
    // comment reply
    if ( is_singular() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    // load visual composer default js
    if (!wp_script_is('wpb_composer_front_js')) {
        wp_enqueue_script('wpb_composer_front_js');
    }

    // load ultimate addons default js
    $bsf_options = get_option('bsf_options');
    $ultimate_global_scripts = (isset($bsf_options['ultimate_global_scripts'])) ? $bsf_options['ultimate_global_scripts'] : false;
    if ($ultimate_global_scripts !== 'enable') {
        $isAjax = false;
        $ultimate_ajax_theme = get_option('ultimate_ajax_theme');
        if ($ultimate_ajax_theme == 'enable')
            $isAjax = true;
        $ultimate_js = get_option('ultimate_js', 'disable');
        $bsf_dev_mode = (isset($bsf_options['dev_mode'])) ? $bsf_options['dev_mode'] : false;
        if (($ultimate_js == 'enable' || $isAjax == true) && ($bsf_dev_mode != 'enable') ) {
            if (!wp_script_is('ultimate-script')) {
                wp_enqueue_script('ultimate-script');
            }
        }
    }

    // google map
    global $venedor_settings;
    $gmap_key = isset($venedor_settings['gmap-key']) ? 'key=' . $venedor_settings['gmap-key'] . '&amp;' : '';
    wp_deregister_script( 'google.maps' );
    wp_register_script( 'google.maps', "http".((is_ssl())?'s':'')."://maps.googleapis.com/maps/api/js?" . $gmap_key . "sensor=false&amp;language=".substr(get_locale(), 0, 2).'"', array(), null, true);
    //wp_enqueue_script( 'google.maps' );

    wp_deregister_script( 'jquery.ui.map' );
    wp_register_script( 'jquery.ui.map', sys_theme_js.'/jquery/gmap.min.js', array(), null, true);
    //wp_enqueue_script( 'jquery.ui.map' );
    
    // plugins scripts
    wp_deregister_script( 'venedor-plugins' );
    wp_register_script( 'venedor-plugins', sys_theme_js.'/plugins.min.js', array(), null, true);
    wp_enqueue_script( 'venedor-plugins' );
    
    // blueimap gallery
    wp_deregister_script( 'jquery-blueimp-gallery' );
    wp_register_script( 'jquery-blueimp-gallery', sys_theme_js.'/blueimp/jquery.blueimp-gallery.min.js', array(), null, true);
    wp_enqueue_script( 'jquery-blueimp-gallery' );
    
    // venedor scripts
    wp_deregister_script( 'venedor-js' );
    wp_register_script( 'venedor-js', sys_theme_js.'/venedor.min.js', array(), null, true);
    wp_enqueue_script( 'venedor-js' );
    
    wp_localize_script( 'venedor-js', 'js_venedor_vars', array(
        'post_slider_zoom' => $venedor_settings['post-zoom'],
        'portfolio_slider_zoom' => $venedor_settings['portfolio-zoom'],
        'infinte_blog_text' => __('<em>Loading the next items...</em>', 'venedor'),
        'infinte_blog_finished_msg' => __('<em>Loaded all the items.</em>', 'venedor'),
        'theme_color' => $venedor_design['link-color']['regular'],
        'googleplus' => __('Google Plus', 'venedor'),
        'pinterest' => __('Pinterest', 'venedor'),
        'email' => __('Email', 'venedor'),
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'menu_item_padding' => $venedor_settings['menu-item-padding'],
        'sidebar_scroll' => $venedor_design['sidebar-scroll'],
        'ajax_loader_url' => sys_template_uri . '/images/ajax-loader@2x.gif'
    ) );
    
    }
}

// GENERAL FUNCTIONS

function venedor_config_value($value) {
    return $value ? $value : 0;
}

function venedor_print_bg($field) {
    global $venedor_design;
?>
background: <?php echo $venedor_design[$field.'-bg-color'] ?>;
<?php if (isset($venedor_design[$field.'-bg-mode']) && $venedor_design[$field.'-bg-mode'] == 'gradient') { ?>
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,<?php echo $venedor_design[$field.'-bg-gcolor']['from'] ?>), color-stop(100%,<?php echo $venedor_design[$field.'-bg-gcolor']['to'] ?>));
    background: -webkit-linear-gradient(top, <?php echo $venedor_design[$field.'-bg-gcolor']['from'] ?> 0%, <?php echo $venedor_design[$field.'-bg-gcolor']['to'] ?> 100%);
    background: -moz-linear-gradient(top, <?php echo $venedor_design[$field.'-bg-gcolor']['from'] ?> 0%, <?php echo $venedor_design[$field.'-bg-gcolor']['to'] ?> 100%);
    background: -ms-linear-gradient(top, <?php echo $venedor_design[$field.'-bg-gcolor']['from'] ?> 0%, <?php echo $venedor_design[$field.'-bg-gcolor']['to'] ?> 100%);
    background: -o-linear-gradient(top, <?php echo $venedor_design[$field.'-bg-gcolor']['from'] ?> 0%, <?php echo $venedor_design[$field.'-bg-gcolor']['to'] ?> 100%);
    background: linear-gradient(to bottom, <?php echo $venedor_design[$field.'-bg-gcolor']['from'] ?> 0%, <?php echo $venedor_design[$field.'-bg-gcolor']['to'] ?> 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo $venedor_design[$field.'-bg-gcolor']['from'] ?>', endColorstr='<?php echo $venedor_design[$field.'-bg-gcolor']['to'] ?>',GradientType=0 );
<?php } else if (isset($venedor_design[$field.'-bg-mode']) && $venedor_design[$field.'-bg-mode'] == 'texture' && $venedor_design[$field.'-bg-texture']) { ?>
    background-image: url(<?php echo str_replace( array( 'http:', 'https:' ), '', $venedor_design[$field.'-bg-texture'] ) ?>);
    background-position: top center;
    background-repeat: repeat;
<?php } else if (isset($venedor_design[$field.'-bg-mode']) && $venedor_design[$field.'-bg-mode'] == 'image' && $venedor_design[$field.'-bg-image']['url']) { ?>
    background-image: url(<?php echo str_replace( array( 'http:', 'https:' ), '', $venedor_design[$field.'-bg-image']['url'] ) ?>);
    background-repeat: <?php echo $venedor_design[$field.'-bg-repeat'] ?>;
    background-attachment: <?php echo $venedor_design[$field.'-bg-attachment'] ?>;
    background-position: <?php echo $venedor_design[$field.'-bg-pos-x'] ?> <?php echo $venedor_design[$field.'-bg-pos-y'] ?>;
<?php }
}

function venedor_print_hbg($field) {
    global $venedor_design;
?>
background: <?php echo $venedor_design[$field.'-hbg-color'] ?>;
<?php if (isset($venedor_design[$field.'-hbg-mode']) && $venedor_design[$field.'-hbg-mode'] == 'gradient') { ?>
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,<?php echo $venedor_design[$field.'-hbg-gcolor']['from'] ?>), color-stop(100%,<?php echo $venedor_design[$field.'-hbg-gcolor']['to'] ?>));
    background: -webkit-linear-gradient(top, <?php echo $venedor_design[$field.'-hbg-gcolor']['from'] ?> 0%, <?php echo $venedor_design[$field.'-hbg-gcolor']['to'] ?> 100%);
    background: -moz-linear-gradient(top, <?php echo $venedor_design[$field.'-hbg-gcolor']['from'] ?> 0%, <?php echo $venedor_design[$field.'-hbg-gcolor']['to'] ?> 100%);
    background: -ms-linear-gradient(top, <?php echo $venedor_design[$field.'-hbg-gcolor']['from'] ?> 0%, <?php echo $venedor_design[$field.'-hbg-gcolor']['to'] ?> 100%);
    background: -o-linear-gradient(top, <?php echo $venedor_design[$field.'-hbg-gcolor']['from'] ?> 0%, <?php echo $venedor_design[$field.'-hbg-gcolor']['to'] ?> 100%);
    background: linear-gradient(to bottom, <?php echo $venedor_design[$field.'-hbg-gcolor']['from'] ?> 0%, <?php echo $venedor_design[$field.'-hbg-gcolor']['to'] ?> 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo $venedor_design[$field.'-hbg-gcolor']['from'] ?>', endColorstr='<?php echo $venedor_design[$field.'-hbg-gcolor']['to'] ?>',GradientType=0 );
<?php } else if (isset($venedor_design[$field.'-hbg-mode']) && $venedor_design[$field.'-hbg-mode'] == 'texture' && $venedor_design[$field.'-hbg-texture']) { ?>
    background-image: url(<?php echo str_replace( array( 'http:', 'https:' ), '', $venedor_design[$field.'-hbg-texture'] ) ?>);
    background-position: center center;
    background-repeat: repeat;
<?php } else if (isset($venedor_design[$field.'-hbg-mode']) && $venedor_design[$field.'-hbg-mode'] == 'image' && $venedor_design[$field.'-hbg-image']['url']) { ?>
    background-image: url(<?php echo str_replace( array( 'http:', 'https:' ), '', $venedor_design[$field.'-hbg-image']['url'] ) ?>);
    background-repeat: <?php echo $venedor_design[$field.'-hbg-repeat'] ?>;
    background-attachment: <?php echo $venedor_design[$field.'-hbg-attachment'] ?>;
    background-position: <?php echo $venedor_design[$field.'-hbg-pos-x'] ?> <?php echo $venedor_design[$field.'-hbg-pos-y'] ?>;
<?php }
}

function venedor_print_shbg($field) {
    global $venedor_design;
?>
background: <?php echo $venedor_design[$field.'-sbg-color'] ?>;
<?php if (isset($venedor_design[$field.'-sbg-mode']) && $venedor_design[$field.'-sbg-mode'] == 'gradient') { ?>
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,<?php echo $venedor_design[$field.'-sbg-gcolor']['from'] ?>), color-stop(100%,<?php echo $venedor_design[$field.'-sbg-gcolor']['to'] ?>));
    background: -webkit-linear-gradient(top, <?php echo $venedor_design[$field.'-sbg-gcolor']['from'] ?> 0%, <?php echo $venedor_design[$field.'-sbg-gcolor']['to'] ?> 100%);
    background: -moz-linear-gradient(top, <?php echo $venedor_design[$field.'-sbg-gcolor']['from'] ?> 0%, <?php echo $venedor_design[$field.'-sbg-gcolor']['to'] ?> 100%);
    background: -ms-linear-gradient(top, <?php echo $venedor_design[$field.'-sbg-gcolor']['from'] ?> 0%, <?php echo $venedor_design[$field.'-sbg-gcolor']['to'] ?> 100%);
    background: -o-linear-gradient(top, <?php echo $venedor_design[$field.'-sbg-gcolor']['from'] ?> 0%, <?php echo $venedor_design[$field.'-sbg-gcolor']['to'] ?> 100%);
    background: linear-gradient(to bottom, <?php echo $venedor_design[$field.'-sbg-gcolor']['from'] ?> 0%, <?php echo $venedor_design[$field.'-sbg-gcolor']['to'] ?> 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo $venedor_design[$field.'-sbg-gcolor']['from'] ?>', endColorstr='<?php echo $venedor_design[$field.'-sbg-gcolor']['to'] ?>',GradientType=0 );
<?php } else if (isset($venedor_design[$field.'-sbg-mode']) && $venedor_design[$field.'-sbg-mode'] == 'texture' && $venedor_design[$field.'-sbg-texture']) { ?>
    background-image: url(<?php echo str_replace( array( 'http:', 'https:' ), '', $venedor_design[$field.'-sbg-texture'] ) ?>);
    background-position: center center;
    background-repeat: repeat;
<?php } else if (isset($venedor_design[$field.'-sbg-mode']) && $venedor_design[$field.'-sbg-mode'] == 'image' && $venedor_design[$field.'-sbg-image']['url']) { ?>
    background-image: url(<?php echo str_replace( array( 'http:', 'https:' ), '', $venedor_design[$field.'-sbg-image']['url'] ) ?>);
    background-repeat: <?php echo $venedor_design[$field.'-sbg-repeat'] ?>;
    background-attachment: <?php echo $venedor_design[$field.'-sbg-attachment'] ?>;
    background-position: <?php echo $venedor_design[$field.'-sbg-pos-x'] ?> <?php echo $venedor_design[$field.'-sbg-pos-y'] ?>;
<?php }
}

function venedor_print_border($field) {
    global $venedor_design;
if (isset($venedor_design[$field.'-border']['border-style'])) : ?>
border-style: <?php echo $venedor_design[$field.'-border']['border-style'] ?>;
<?php endif;
if (isset($venedor_design[$field.'-border']['border-color'])) : ?>
    border-color: <?php echo $venedor_design[$field.'-border']['border-color'] ?>;
<?php endif;
if (isset($venedor_design[$field.'-border']['border-top'])) : ?>
    border-top-width: <?php echo venedor_config_value($venedor_design[$field.'-border']['border-top']) ?>;
<?php endif;
if (isset($venedor_design[$field.'-border']['border-right'])) : ?>
    border-right-width: <?php echo venedor_config_value($venedor_design[$field.'-border']['border-right']) ?>;
<?php endif;
if (isset($venedor_design[$field.'-border']['border-bottom'])) : ?>
    border-bottom-width: <?php echo venedor_config_value($venedor_design[$field.'-border']['border-bottom']) ?>;
<?php endif;
if (isset($venedor_design[$field.'-border']['border-left'])) : ?>
    border-left-width: <?php echo venedor_config_value($venedor_design[$field.'-border']['border-left']) ?>;
<?php endif;
}

function venedor_print_hborder($field) {
    global $venedor_design;
if (isset($venedor_design[$field.'-hborder']['border-style'])) : ?>
border-style: <?php echo $venedor_design[$field.'-hborder']['border-style'] ?>;
<?php endif;
if (isset($venedor_design[$field.'-hborder']['border-color'])) : ?>
    border-color: <?php echo $venedor_design[$field.'-hborder']['border-color'] ?>;
<?php endif;
if (isset($venedor_design[$field.'-hborder']['border-top'])) : ?>
    border-top-width: <?php echo venedor_config_value($venedor_design[$field.'-hborder']['border-top']) ?>;
<?php endif;
if (isset($venedor_design[$field.'-hborder']['border-right'])) : ?>
    border-right-width: <?php echo venedor_config_value($venedor_design[$field.'-hborder']['border-right']) ?>;
<?php endif;
if (isset($venedor_design[$field.'-hborder']['border-bottom'])) : ?>
    border-bottom-width: <?php echo venedor_config_value($venedor_design[$field.'-hborder']['border-bottom']) ?>;
<?php endif;
if (isset($venedor_design[$field.'-hborder']['border-left'])) : ?>
    border-left-width: <?php echo venedor_config_value($venedor_design[$field.'-hborder']['border-left']) ?>;
<?php endif;
}

function venedor_print_shborder($field) {
    global $venedor_design;
if (isset($venedor_design[$field.'-sborder']['border-style'])) : ?>
border-style: <?php echo $venedor_design[$field.'-sborder']['border-style'] ?>;
<?php endif;
if (isset($venedor_design[$field.'-sborder']['border-color'])) : ?>
    border-color: <?php echo $venedor_design[$field.'-sborder']['border-color'] ?>;
<?php endif;
if (isset($venedor_design[$field.'-sborder']['border-top'])) : ?>
    border-top-width: <?php echo venedor_config_value($venedor_design[$field.'-sborder']['border-top']) ?>;
<?php endif;
if (isset($venedor_design[$field.'-sborder']['border-right'])) : ?>
    border-right-width: <?php echo venedor_config_value($venedor_design[$field.'-sborder']['border-right']) ?>;
<?php endif;
if (isset($venedor_design[$field.'-sborder']['border-bottom'])) : ?>
    border-bottom-width: <?php echo venedor_config_value($venedor_design[$field.'-sborder']['border-bottom']) ?>;
<?php endif;
if (isset($venedor_design[$field.'-sborder']['border-left'])) : ?>
    border-left-width: <?php echo venedor_config_value($venedor_design[$field.'-sborder']['border-left']) ?>;
<?php endif;
}

function venedor_print_border_radius($field) {
    global $venedor_design;
if (isset($venedor_design[$field.'-border-radius'])) : ?>
border-radius: <?php echo venedor_config_value($venedor_design[$field.'-border-radius']['top']) ?>px <?php echo venedor_config_value($venedor_design[$field.'-border-radius']['right']) ?>px <?php echo venedor_config_value($venedor_design[$field.'-border-radius']['bottom']) ?>px <?php echo venedor_config_value($venedor_design[$field.'-border-radius']['left']) ?>px;
<?php endif;
}

function venedor_print_left_border_radius($field) {
    global $venedor_design;
    if (isset($venedor_design[$field.'-border-radius'])) : ?>
    border-radius: 0 <?php echo venedor_config_value($venedor_design[$field.'-border-radius']['top']) ?>px <?php echo venedor_config_value($venedor_design[$field.'-border-radius']['right']) ?>px 0;
    <?php endif;
}

function venedor_print_right_border_radius($field) {
    global $venedor_design;
    if (isset($venedor_design[$field.'-border-radius'])) : ?>
    border-radius: <?php echo venedor_config_value($venedor_design[$field.'-border-radius']['bottom']) ?>px 0 0 <?php echo venedor_config_value($venedor_design[$field.'-border-radius']['left']) ?>px;
    <?php endif;
}

function venedor_print_padding($field) {
    global $venedor_design;
if (isset($venedor_design[$field.'-padding'])) : ?>
padding: <?php echo venedor_config_value($venedor_design[$field.'-padding']['padding-top']) ?>px <?php echo venedor_config_value($venedor_design[$field.'-padding']['padding-right']) ?>px <?php echo venedor_config_value($venedor_design[$field.'-padding']['padding-bottom']) ?>px <?php echo venedor_config_value($venedor_design[$field.'-padding']['padding-left']) ?>px;
<?php endif;
}

function venedor_print_margin($field) {
    global $venedor_design;
if (isset($venedor_design[$field.'-margin'])) : ?>
margin: <?php echo venedor_config_value($venedor_design[$field.'-margin']['margin-top']) ?>px <?php echo venedor_config_value($venedor_design[$field.'-margin']['margin-right']) ?>px <?php echo venedor_config_value($venedor_design[$field.'-margin']['margin-bottom']) ?>px <?php echo venedor_config_value($venedor_design[$field.'-margin']['margin-left']) ?>px;
<?php endif;
}

function venedor_print_typo($field) {
    global $venedor_design;
if (isset($venedor_design[$field.'-font']['color'])) : ?>
color: <?php echo $venedor_design[$field.'-font']['color'] ?>;
<?php endif;
if (isset($venedor_design[$field.'-font']['font-size'])) : ?>
    font-size: <?php echo $venedor_design[$field.'-font']['font-size'] ?>;
<?php endif;
if (isset($venedor_design[$field.'-font']['font-family'])) : ?>
    font-family: <?php echo $venedor_design[$field.'-font']['font-family'] ?>;
<?php endif;
if (isset($venedor_design[$field.'-font']['font-weight'])) : ?>
    font-weight: <?php echo $venedor_design[$field.'-font']['font-weight'] ?>;
<?php endif;
}

function venedor_print_font($field) {
    global $venedor_design;
    if (isset($venedor_design[$field.'-font']['color'])) : ?>
    color: <?php echo $venedor_design[$field.'-font']['color'] ?>;
    <?php endif;
    if (isset($venedor_design[$field.'-font']['font-family'])) : ?>
    font-family: <?php echo $venedor_design[$field.'-font']['font-family'] ?>;
    <?php endif;
    if (isset($venedor_design[$field.'-font']['font-weight'])) : ?>
    font-weight: <?php echo $venedor_design[$field.'-font']['font-weight'] ?>;
    <?php endif;
}

function venedor_print_rgba($color, $alpha) {
    echo 'rgba('.get_red($color).','.get_green($color).','.get_blue($color).','.$alpha.')';
}

function venedor_print_rgb($color, $offset) {
    $red = get_red($color, $offset);
    $green = get_green($color, $offset);
    $blue = get_blue($color, $offset);
    $hex = "#";
    $hex .= str_pad(dechex($red), 2, "0", STR_PAD_LEFT);
    $hex .= str_pad(dechex($green), 2, "0", STR_PAD_LEFT);
    $hex .= str_pad(dechex($blue), 2, "0", STR_PAD_LEFT);

    echo $hex;
}

function get_red($color, $offset = 0) {
    return hexdec(substr($color, 1, 2)) + $offset;
}
function get_green($color, $offset = 0) {
    return hexdec(substr($color, 3, 2)) + $offset;
}
function get_blue($color, $offset = 0) {
    return hexdec(substr($color, 5, 2)) + $offset;
}

function venedor_print_line_height($line_height, $field) {
    global $venedor_design;
?>
    line-height: <?php echo $line_height - (int)($venedor_design[$field.'-border']['border-top']) * 2 ?>px;
<?php
}

function venedor_print_hline_height($line_height, $field) {
    global $venedor_design;
    if ($venedor_design[$field.'-hborder']['border-top'] != '1px') :
    ?>
    line-height: <?php echo $line_height - (int)($venedor_design[$field.'-hborder']['border-top']) * 2 ?>px;
    <?php
    endif;
}

function venedor_print_sline_height($line_height, $field) {
    global $venedor_design;
    ?>
    line-height: <?php echo $line_height - (int)($venedor_design[$field.'-sborder']['border-top']) * 2 ?>px;
    <?php
}
?>