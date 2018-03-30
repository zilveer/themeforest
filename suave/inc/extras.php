<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package commercegurus
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function cg_page_menu_args( $args ) {
    $args['show_home'] = true;
    return $args;
}

add_filter( 'wp_page_menu_args', 'cg_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 */
function cg_body_classes( $classes ) {
    global $cg_options;
    $cg_sticky_menu_class = '';
    $cg_hide_prices = '';

    if ( isset( $cg_options['cg_sticky_menu'] ) ) {
        $cg_sticky_menu_class = $cg_options['cg_sticky_menu'];
    }

    if ( isset( $cg_options['cg_hide_prices'] ) ) {
        $cg_hide_prices = $cg_options['cg_hide_prices'];
    }

    // Adds a class of group-blog to blogs with more than 1 published author
    if ( is_multi_author() ) {
        $classes[] = 'group-blog';
    }

    if ( $cg_hide_prices == 'yes'  ) {
        $classes[] = 'cg-hide-prices';
    }

    //if ( $cg_sticky_menu_class == 'yes' ) {
    $classes[] = 'cg-sticky-enabled';
    //}

    return $classes;
}

add_filter( 'body_class', 'cg_body_classes' );

/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 */
function cg_enhanced_image_navigation( $url, $id ) {
    if ( !is_attachment() && !wp_attachment_is_image( $id ) )
        return $url;

    $image = get_post( $id );
    if ( !empty( $image->post_parent ) && $image->post_parent != $id )
        $url .= '#main';

    return $url;
}

add_filter( 'attachment_link', 'cg_enhanced_image_navigation', 10, 2 );

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 */
function cg_wp_title( $title, $sep ) {
    global $page, $paged;

    if ( is_feed() )
        return $title;

    // Add the blog name
    $title .= get_bloginfo( 'name' );

    // Add the blog description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
        $title .= " $sep $site_description";

    // Add a page number if necessary:
    if ( $paged >= 2 || $page >= 2 )
        $title .= " $sep " . sprintf( __( 'Page %s', 'commercegurus' ), max( $paged, $page ) );

    return $title;
}

add_filter( 'wp_title', 'cg_wp_title', 10, 2 );

function cg_add_menu_parent( $items ) {
    $parents = array();
    foreach ( $items as $item ) {
        if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
            $parents[] = $item->menu_item_parent;
        }
    }
    return $items;
}

add_filter( 'wp_nav_menu_objects', 'cg_add_menu_parent' );


/* Boxed class */
if ( !function_exists( 'boxed_class' ) ) {

    function boxed_class( $classes ) {
        global $cg_options;
        $cg_boxed_status = '';

        if ( !empty( $_SESSION['cg_boxed'] ) ) {
            $cg_boxed_status = esc_html ( $_SESSION['cg_boxed'] );
        }

        if ( ( isset( $cg_options['container_style'] ) && $cg_options['container_style'] == 'boxed' ) || ( $cg_boxed_status == 'yes' ) ) :
            $classes[] = 'boxed';
        else:
            $classes[] = "";
        endif;

        return $classes;
    }

}

add_filter( 'body_class', 'boxed_class' );

// Initialize some global js vars
add_action( 'wp_head', 'cg_js_init' );
if ( !function_exists( 'cg_js_init' ) ) {

    function cg_js_init() {
        global $cg_options;
        ?>
        <script type="text/javascript">
            var view_mode_default = '<?php echo esc_js( $cg_options['product_layout'] ) ?>';
            var cg_sticky_default = '<?php echo esc_js( $cg_options['cg_sticky_menu'] )  ?>';
        </script>
        <?php
    }

}

// WooCommerce Quick View Ajax Helpers
function cg_quickview() {
    global $post, $product, $woocommerce;
    $cg_prod_id = $_POST["productid"];
    $post = get_post( $cg_prod_id );
    $product = get_product( $cg_prod_id );

    ob_start();

    wc_get_template( 'content-single-product-cg-quickview.php' );

    $cg_output = ob_get_contents();
    ob_end_clean();
    echo $cg_output;
    die();
}

add_action( 'wp_ajax_cg_quickview', 'cg_quickview' );
add_action( 'wp_ajax_nopriv_cg_quickview', 'cg_quickview' );

// Util function for building VC row styles - replaces default VC buildstyle function

if ( !function_exists( 'cg_build_style' ) ) {

    function cg_build_style( $bg_image = '', $bg_color = '', $bg_image_repeat = '', $font_color = '', $padding = '', $padding_bottom = '', $padding_top = '', $margin_bottom = '' ) {
        $has_image = false;
        $style = '';
        if ( ( int ) $bg_image > 0 && ( $image_url = wp_get_attachment_url( $bg_image, 'large' ) ) !== false ) {
            $has_image = true;
            $style .= "background-image: url(" . $image_url . ");";
        }
        if ( !empty( $bg_color ) ) {
            $style .= 'background-color: ' . $bg_color . ';';
        }
        if ( !empty( $bg_image_repeat ) && $has_image ) {
            if ( $bg_image_repeat === 'cover' ) {
                $style .= "background-repeat:no-repeat;background-size: cover;";
            } elseif ( $bg_image_repeat === 'contain' ) {
                $style .= "background-repeat:no-repeat;background-size: contain;";
            } elseif ( $bg_image_repeat === 'no-repeat' ) {
                $style .= 'background-repeat: no-repeat;';
            }
        }
        if ( !empty( $font_color ) ) {
            $style .= 'color: ' . $font_color . ';';
        }
        if ( $padding != '' ) {
            $style .= 'padding: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $padding ) ? $padding : $padding . 'px' ) . ';';
        }
        if ( $padding_bottom != '' ) {
            $style .= 'padding-bottom: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $padding_bottom ) ? $padding_bottom : $padding_bottom . 'px' ) . ';';
        }
        if ( $padding_top != '' ) {
            $style .= 'padding-top: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $padding_top ) ? $padding_top : $padding_top . 'px' ) . ';';
        }
        if ( $margin_bottom != '' ) {
            $style .= 'margin-bottom: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $margin_bottom ) ? $margin_bottom : $margin_bottom . 'px' ) . ';';
        }
        return empty( $style ) ? $style : ' style="' . $style . '"';
    }

}

// Hi themeforest review team! This is a safe filter for cleaning up commercegurus shortcode output only!
// Credits to bitfade for this solution - https://gist.github.com/bitfade/4555047
// Ref - http://themeforest.net/forums/thread/how-to-add-shortcodes-in-wp-themes-without-being-rejected/98804?page=4#996848

add_filter( "the_content", "cg_content_filter" );

function cg_content_filter( $content ) {

    // array of custom shortcodes requiring the fix
    $block = join( "|", array( "cg_content_strip", "vc_button", "cg_video_banner" ) );

    // opening tag
    $rep = preg_replace( "/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/", "[$2$3]", $content );

    // closing tag
    $rep = preg_replace( "/(<p>)?\[\/($block)](<\/p>|<br \/>)?/", "[/$2]", $rep );

    return $rep;
}

add_action( 'cg_page_title', 'cg_page_title_callback' );

function cg_page_title_callback() {
    $cg_is_page_title_bg_color = '';
    $cg_show_page_title = '';
    $cg_page_title_background_color = '';
    $cg_page_title_font_color = '';
    $cg_page_title_background_color_style = '';
    $cg_page_title_font_color_style = '';

    if ( function_exists( 'get_field' ) ) {

        $cg_show_page_title = get_field( 'show_page_title' );
        $cg_is_page_title_bg_color = get_field( 'cg_is_page_title_bg_color' );

        if ( $cg_is_page_title_bg_color == 'true' ) {
            $cg_page_title_background_color = get_field( 'page_title_background_color' );
            $cg_page_title_background_opacity = get_field( 'page_title_background_opacity' );
            $cg_page_title_font_color = get_field( 'page_title_font_color' );
            if ( !empty( $cg_page_title_background_color ) ) {
                $cg_page_title_background_color_style = 'style="background-color:' . $cg_page_title_background_color . '; opacity:' . $cg_page_title_background_opacity . ';"';
            }
            if ( !empty( $cg_page_title_font_color ) ) {
                $cg_page_title_font_color_style = 'style="color:' . $cg_page_title_font_color . '"';
            }
        }
    }
    ?>
    <?php if ( $cg_show_page_title !== 'Hide' ) { ?>
        <div class="header-wrapper">
            <div class="overlay" <?php echo $cg_page_title_background_color_style; ?>></div> 
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <header class="entry-header">
                            <?php
                            if ( function_exists( 'yoast_breadcrumb' ) && (!is_front_page() ) ) {
                                yoast_breadcrumb( '<p class="animate sub-title" data-animate="fadeInDown">', '</p>' );
                            }
                            ?>
                            <h1 class="animate cg-page-title" <?php echo $cg_page_title_font_color_style; ?> data-animate="fadeInUp"><?php the_title(); ?></h1>
                        </header>
                    </div>
                </div>
            </div>
        </div>
    <?php }
    ?>

    <?php
}

function cg_get_page_title() {
    do_action( 'cg_page_title' );
}

add_action( 'cg_blog_page_title', 'cg_blog_page_title_callback' );

function cg_blog_page_title_callback() {
    global $cg_options;
    $cg_blog_page_title = '';
    $cg_blog_header_bg = '';

    $cg_is_page_title_bg_color = '';
    $cg_show_page_title = '';
    $cg_page_title_background_color = '';
    $cg_page_title_font_color = '';
    $cg_page_title_background_color_style = '';
    $cg_page_title_font_color_style = '';

    if ( isset( $cg_options['cg_blog_page_title'] ) ) {
        $cg_blog_page_title = $cg_options['cg_blog_page_title'];
    }

    if ( function_exists( 'get_field' ) ) {
        $cg_show_page_title = get_field( 'show_page_title' );
        $cg_is_page_title_bg_color = get_field( 'cg_is_page_title_bg_color' );

        if ( $cg_is_page_title_bg_color == 'true' ) {
            $cg_page_title_background_color = get_field( 'page_title_background_color' );
            $cg_page_title_background_opacity = get_field( 'page_title_background_opacity' );
            $cg_page_title_font_color = get_field( 'page_title_font_color' );
            if ( !empty( $cg_page_title_background_color ) ) {
                $cg_page_title_background_color_style = 'style="background-color:' . $cg_page_title_background_color . '; opacity:' . $cg_page_title_background_opacity . ';"';
            }
            if ( !empty( $cg_page_title_font_color ) ) {
                $cg_page_title_font_color_style = 'style="color:' . $cg_page_title_font_color . '"';
            }
        }
    }
    ?>

    <div class="header-wrapper">
        <div class="overlay" <?php echo $cg_page_title_background_color_style; ?>></div> 
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <header class="entry-header">

                        <?php
                        if ( function_exists( 'yoast_breadcrumb' ) && (!is_front_page() ) ) {
                            yoast_breadcrumb( '<p class="animate sub-title" data-animate="fadeInDown">', '</p>' );
                        }
                        ?>

                        <h1 class="animate cg-page-title" <?php echo $cg_page_title_font_color_style; ?> data-animate="fadeInUp"><?php echo $cg_blog_page_title; ?></h1>
                    </header>
                </div>
            </div>
        </div>
    </div> 
    <?php
}

function cg_get_blog_page_title() {
    do_action( 'cg_blog_page_title' );
}

add_action( 'cg_announcements', 'cg_announcements_callback' );

function cg_announcements_callback() {
    $args = array(
        'post_type' => 'shopannouncements',
        'ignore_sticky_posts' => 1,
        'post_status' => 'publish',
        'orderby' => 'menu_order',
        'order' => 'ASC',
        'posts_per_page' => -1
    );

    $query = new WP_Query( $args );
    while ( $query->have_posts() ) : $query->the_post();
        global $post;
        ?>
        <li><?php the_content(); ?></li>
        <?php
    endwhile;
    wp_reset_query();
}

function cg_get_announcements() {
    do_action( 'cg_announcements' );
}

// Dynamic blog header banner
function cg_blog_header_banner() {
    global $wp_query, $cg_options;
    $post_id = '';
    $cg_blog_archive_title_bg_img = '';

    if ( !is_404() ) {
        if ( isset( $wp_query ) ) {
            if ( $wp_query->have_posts() ) {
                $post_id = $wp_query->post->ID;                    
            }
        }
    }

    $cg_blog_header_bg = '';
    $cg_blog_archive_title_bg_img = '';
    $cg_blog_banner_css = '';
    $cg_blog_archive_banner_css = '';

    if ( is_single() || is_page() ) {
        if ( !empty( $post_id ) ) {
            $cg_blog_header_bg = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'full' );
        }
        $cg_blog_banner_css .= "
            .header-wrapper {
                background-image: url( $cg_blog_header_bg[0] );
            }
        ";
        wp_add_inline_style( 'cg-commercegurus', $cg_blog_banner_css );

    } elseif ( is_wc_shop() ) {

        if ( is_shop() && isset( $cg_options['cg_shop_archive_title_bg_img']['url'] ) ) {
            $cg_blog_archive_title_bg_img = $cg_options['cg_shop_archive_title_bg_img']['url'];

            $cg_blog_archive_banner_css .= "
                .header-wrapper {
                    background-image: url( $cg_blog_archive_title_bg_img );
                }
            ";
            wp_add_inline_style( 'cg-commercegurus', $cg_blog_archive_banner_css ); 

        }
                   
    } else if ( is_archive() || is_home() ) {

        if ( isset( $cg_options['cg_blog_archive_title_bg_img']['url'] ) ) {
            $cg_blog_archive_title_bg_img = $cg_options['cg_blog_archive_title_bg_img']['url'];
        }
    
        $cg_blog_archive_banner_css .= "
            .header-wrapper {
                background-image: url( $cg_blog_archive_title_bg_img );
            }
        ";
        wp_add_inline_style( 'cg-commercegurus', $cg_blog_archive_banner_css );
    } 

}

add_action( 'wp_enqueue_scripts', 'cg_blog_header_banner' );

// Dynamic category banner
function cg_woo_cat_banner() {
    if ( is_wc_active() ) {
        if ( is_product_category() ) {
            // Get our custom category banner if it exists     
            $queried_object = '';
            $taxonomy = '';
            $term_id = '';
            $cat_banner = '';
            $cg_woo_cat_banner_src = '';
            $cg_woo_cat_banner_css = '';

            $queried_object = get_queried_object();
            if ( isset( $queried_object->taxonomy ) ) {
                $taxonomy = $queried_object->taxonomy;
                $term_id = $queried_object->term_id;
            }

            if ( function_exists( 'get_field' ) ) {
                $cat_banner = get_field( 'product_category_banner', $taxonomy . '_' . $term_id );
                if ( !empty( $cat_banner ) ) {
                    $cg_woo_cat_banner_src = wp_get_attachment_image_src( $cat_banner, 'product-category-banner' ); // returns an array
                    if ( !empty( $cg_woo_cat_banner_src ) ) {
                        $cg_woo_cat_banner_css .= "
                                .header-wrapper {
                                    /* 4 */
                                    background: url( $cg_woo_cat_banner_src[0] ) no-repeat top center; background-size: cover;
                                }
                            ";
                        wp_add_inline_style( 'cg-commercegurus', $cg_woo_cat_banner_css );
                    }
                }
            }
        }        
    }

}

add_action( 'wp_enqueue_scripts', 'cg_woo_cat_banner' );
