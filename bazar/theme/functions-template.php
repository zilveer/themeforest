<?php
/**
 * Your Inspiration Themes
 *
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/* === HEADER */
if( !function_exists( 'yit_head' ) ) {
    function yit_head() {
        yit_get_template( '/header/head.php' );
    }
}

if( !function_exists( 'yit_add_custom_styles' ) ) {
    function yit_add_custom_styles() {

        $config = YIT_Config::load();

        if( yit_get_option( 'responsive-enabled' ) ) {
            yit_wp_enqueue_style( 9994, 'responsive', YIT_CORE_ASSETS_URL . '/css/responsive.css', array(), $config['theme']['version'], 'all' );
            yit_wp_enqueue_style( 9995, 'theme-responsive', get_template_directory_uri() . '/css/responsive.css', false, $config['theme']['version'], 'all' );
        } else {
            yit_wp_enqueue_style( 9995, 'theme-responsive', get_template_directory_uri() . '/css/non-responsive.css', false, $config['theme']['version'], 'all' );
        }

        $custom_css = locate_template( 'custom.css' );
        $custom_css = str_replace( array( get_stylesheet_directory(), get_template_directory() ), array( get_stylesheet_directory_uri(), get_template_directory_uri() ), $custom_css );

        yit_wp_enqueue_style( 99999, 'custom', $custom_css, array(), $config['theme']['version'], 'all', true );
    }
}

if( !function_exists( 'yit_add_custom_scripts' ) ) {
    function yit_add_custom_scripts() {
        if( yit_get_option( 'responsive-enabled' ) ) {
            if( is_child_theme() && file_exists( get_stylesheet_directory() . '/js/responsive.js' ) ) {
                wp_enqueue_script( 'responsive-theme', yit_remove_protocol_url(get_stylesheet_directory_uri()) . '/js/responsive.js' , array( 'jquery' ), '1.0', true );
            } else {
                wp_enqueue_script( 'responsive-theme', yit_remove_protocol_url(get_template_directory_uri()) . '/js/responsive.js' , array( 'jquery' ), '1.0', true );
            }
        }
    }
}

if(!function_exists( 'yit_load_touch_punch_js' )){
    function yit_load_touch_punch_js() {
        global $version;

        // Check for the jquery ui touch punch js
        $themepunchjs = get_template_directory_uri() ;

        wp_enqueue_script( 'jquery-ui-widget' );
        wp_enqueue_script( 'jquery-ui-mouse' );
        wp_enqueue_script( 'jquery-ui-slider' );

        if ( is_child_theme() && file_exists( get_stylesheet_directory() . "/js/jquery.ui.touch-punch-min.js" ) ) {
            $themepunchjs = get_stylesheet_directory_uri();
        }

        wp_register_script( 'woo-jquery-touch-punch', yit_remove_protocol_url($themepunchjs) . "/js/jquery.ui.touch-punch-min.js", array('jquery'), $version, true );
        wp_enqueue_script( 'woo-jquery-touch-punch' );
    }
}

if( !function_exists( 'yit_topbar' ) ) {
    function yit_topbar() {
        yit_get_template( '/header/topbar.php' );
    }
}

if( !function_exists( 'yit_topbar_login' ) ) {
    function yit_topbar_login() {
        yit_get_template( '/header/login.php' );
    }
}

if( !function_exists( 'yit_header' ) ) {
    function yit_header() {
        yit_get_template( '/header/header.php' );
    }
}

if( !function_exists( 'yit_logo' ) ) {
    function yit_logo() {
        yit_get_template( '/header/logo.php' );
    }
}

if( !function_exists( 'yit_header_sidebar' ) ) {
    function yit_header_sidebar() {
        yit_get_template( '/header/header-sidebar.php' );
    }
}

if( !function_exists( 'yit_header_cartsearch' ) ) {
    function yit_header_cartsearch() {
        yit_get_template( '/header/cart-search.php' );
    }
}

if( !function_exists( 'yit_main_navigation' ) ) {
    function yit_main_navigation() {
        yit_get_template( '/header/main-navigation.php' );
    }
}

if( !function_exists( 'yit_map' ) ) {
    function yit_map() {
        yit_get_template( '/header/map.php' );
    }
}

if( !function_exists( 'yit_page_meta' ) ) {
    function yit_page_meta() {
        yit_get_template( '/header/page-meta.php' );
    }
}

if( !function_exists( 'yit_slogan' ) ) {
    function yit_slogan() {
        yit_get_template( '/header/slogan.php' );
    }
}

if( !function_exists( 'yit_slider_section' ) ) {
    function yit_slider_section() {
        yit_get_template( '/header/slider.php' );
    }
}

if( !function_exists( 'yit_slider_space' ) ) {
    function yit_slider_space() {
        ?><div class="slider-space"></div><?php
    }
}

if( !function_exists( 'yit_page_menu_args' ) ) {
    function yit_page_menu_args( $args ) {
        $args['show_home'] = true;
        $args['link_after'] = '<div style="position:absolute; left: 50%;"><span class="triangle">&nbsp;</span></div>';
        $args['menu_class'] = 'sf-menu';
        return $args;
    }
}

if( !function_exists( 'yit_page_menu' ) ) {
    function yit_page_menu( $menu, $args ) {
        $menu = str_replace('<div class="'. $args['menu_class'] .'">', '<div class="menu">', $menu);
        $menu = str_replace('<ul>', '<ul class="'. $args['menu_class'] .'">', $menu);
        return $menu;
    }
}

if( !function_exists( 'yit_header_background' ) ) {
    /**
     * Define the body background for the page.
     *
     * First get the setting for the current page. If a setting is not defined
     * in the current page, will be get the setting from the theme options.
     * All css will be shown in head tag, by the action 'wp_head'
     *
     * @since 1.0.0
     */
    function yit_header_background() {
        global $post;

        $post_id = isset( $post->ID ) ? $post->ID : 0;

        // get color and background from postmeta
        $color = get_post_meta( $post_id, '_bg_color-header', true );
        $image = get_post_meta( $post_id, '_bg_image-header', true );

        // get the color and background from theme options, if above are empty
        $background = yit_get_option('background-header');
        if ( empty( $color ) ) {
            //$color = $background['color'];
        }
        if ( empty( $image ) ) {
            //$image = $background['image'];
            if ( $image == 'custom' ) {
                $image = yit_get_option('bg_image-header');
            }
        }

        $image_repeat     = yit_get_option('bg_image_repeat-header');
        $image_position   = yit_get_option('bg_image_position-header');
        $image_attachment = yit_get_option('bg_image_attachment-header');

        $css = array();

        if ( ! empty( $color ) ) { $css[] = "background-color: $color;"; }
        if ( ! empty( $image ) ) { $css[] = "background-image: url('$image');"; }

        if ( ! empty( $image ) && ! empty( $image_repeat ) )     { $css[] = "background-repeat: $image_repeat;"; }
        if ( ! empty( $image ) && ! empty( $image_position ) )   { $css[] = "background-position: $image_position;"; }
        if ( ! empty( $image ) && ! empty( $image_attachment ) ) { $css[] = "background-attachment: $image_attachment;"; }

        if ( empty( $css ) ) return;

        ?>
        <style type="text/css">
            #header { <?php echo implode( ' ', $css ) ?> }
        </style>
    <?php
    }
}
if( !function_exists( 'yit_meta_bg' ) ) {
    function yit_meta_bg() {
        global $post;

        $post_id = isset( $post->ID ) ? $post->ID : 0;

        // get color and background from postmeta
        $color = get_post_meta( $post_id, '_bg_color', true );

        // get the color and background from theme options, if above are empty
        $background = yit_get_option('container-background');
        if ( empty( $color ) ) {
            $color = $background;
        }

        $css = array();

        if ( ! empty( $color ) ) { $css[] = "background-color: $color;"; }

        if ( empty( $css ) ) return;

        ?>
        <style type="text/css">
            .blog-big .meta, .blog-small .meta { <?php echo implode( ' ', $css ) ?> }
        </style>
    <?php
    }
}
/* === PAGE */
if( !function_exists( 'yit_loop_page' ) ) {
    function yit_loop_page() {
        yit_get_template( '/loop/page/content.php' );
    }
}

if( !function_exists( 'yit_404' ) ) {
    function yit_404() {
        yit_get_template( '404/404.php' );
    }
}

if( !function_exists( 'yit_is_primary_start' ) ) {
    function yit_is_primary_start() {
        global $is_primary;
        $is_primary = true;
    }
}

if( !function_exists( 'yit_is_primary_end' ) ) {
    function yit_is_primary_end() {
        global $is_primary;
        $is_primary = false;
    }
}

/* === LOOP */
if( !function_exists( 'yit_loop' ) ) {
    function yit_loop() {
        yit_get_template( '/loop/loop.php' );
    }
}

if( !function_exists( 'yit_loop_internal' ) ) {
    function yit_loop_internal() {
        yit_get_template( '/loop/loop_internal.php' );
    }
}

if( !function_exists( 'yit_loop_blog_big' ) ) {
    function yit_loop_blog_big() {
        yit_get_template( '/blog/big/markup.php' );
    }
}

if( !function_exists( 'yit_loop_blog_small' ) ) {
    function yit_loop_blog_small() {
        yit_get_template( '/blog/small/markup.php' );
    }
}

if( !function_exists( 'yit_loop_blog_elegant' ) ) {
    function yit_loop_blog_elegant() {
        yit_get_template( '/blog/elegant/markup.php' );
    }
}

if( !function_exists( 'yit_loop_blog_pinterest' ) ) {
    function yit_loop_blog_pinterest() {
        yit_get_template( '/blog/pinterest/markup.php' );
    }
}

if( !function_exists( 'yit_loop_blog_big_ribbon' ) ) {
    function yit_loop_blog_big_ribbon() {
        yit_get_template( '/blog/big-ribbon/markup.php' );
    }
}

if( !function_exists( 'yit_loop_blog_small_ribbon' ) ) {
    function yit_loop_blog_small_ribbon() {
        yit_get_template( '/blog/small-ribbon/markup.php' );
    }
}

if( !function_exists( 'yit_loop_blog_sphera' ) ) {
    function yit_loop_blog_sphera() {
        yit_get_template( '/blog/sphera/markup.php' );
    }
}

if( !function_exists( 'yit_loop_blog_bazar' ) ) {
    function yit_loop_blog_bazar() {
        yit_get_template( '/blog/bazar/markup.php' );
    }
}

if( !function_exists( 'yit_archives' ) ) {
    function yit_archives() {
        yit_get_template( '/loop/archives.php' );
    }
}

/* === COMMENTS */
if( !function_exists( 'yit_comments' ) ) {
    function yit_comments() {
        yit_get_template( '/comments/markup.php' );
    }
}

if( !function_exists( 'yit_comments_password_required' ) ) {
    function yit_comments_password_required() {
        yit_get_template( '/comments/password-required.php' );
    }
}

if( !function_exists( 'yit_comments_navigation' ) ) {
    function yit_comments_navigation() {
        yit_get_template( '/comments/navigation.php' );
    }
}

if( !function_exists( 'yit_trackbacks' ) ) {
    function yit_trackbacks() {
        yit_get_template( '/comments/trackbacks.php' );
    }
}

/* === MISC */
if( !function_exists( 'yit_searchform' ) ) {
    function yit_searchform( $post_type ) {
        yit_get_template( '/searchform/' . $post_type . '.php' );
    }
}

if( !function_exists( 'yit_extra_content' ) ) {
    function yit_extra_content() {
        yit_get_template( '/loop/extra-content.php' );
    }
}

/* === FOOTER */
if( !function_exists( 'yit_footer' ) ) {
    function yit_footer() {
        yit_get_template( '/footer/footer.php' );
    }
}

if( !function_exists( 'yit_footer_big' ) ) {
    function yit_footer_big() {
        yit_get_template( '/footer/footer-big.php' );
    }
}

if( !function_exists( 'yit_copyright' ) ) {
    function yit_copyright() {
        yit_get_template( '/footer/copyright.php' );
    }
}

/* === SIDEBAR */
if( !function_exists( 'yit_default_sidebar' ) ) {
    function yit_default_sidebar() {
        yit_get_template( '/sidebars/default.php' );
    }
}

/* === TESTIMONIALS */
if( !function_exists( 'yit_single_testimonial' ) ) {
    function yit_single_testimonial() {
        yit_get_template( '/testimonial/testimonial.php' );
    }
}

/* === SERVICES */
if( !function_exists( 'yit_single_service' ) ) {
    function yit_single_service() {
        yit_get_template( '/services/service.php' );
    }
}

/* === COMMENTS */
if( !function_exists( 'yit_comment' ) ) {
    /**
     * Print comments
     *
     * @param object $comment
     * @param array $args
     * @param int $depth
     * @return string
     * @since 1.0.0
     */
    function yit_comment( $comment, $args, $depth ) {

        $GLOBALS['comment'] = $comment;

        switch ( $comment->comment_type ) :
            case 'pingback'  :
            case 'trackback' :
                ?>
                <li class="post pingback">
                <p><?php _e( 'Pingback:', 'yit' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'yit'), ' ' ); ?></p>
                <?php
                break;

            default:
                ?>
                <li <?php comment_class( yit_comment_has_children( $comment->comment_ID ) ? ' parent' : '' ); ?> id="li-comment-<?php comment_ID(); ?>">
                    <div class="<?php echo 'offset' . ( yit_comment_depth( get_comment_ID() ) - 1 ) . ' span' . ( 10 - yit_comment_depth( get_comment_ID() ) ) ?>">
                        <div id="comment-<?php comment_ID(); ?>" class="comment-container">
                            <div class="border-bottom-line border"></div>
                            <div class="vertical-top-line border"></div>
                            <!--<div class="parent-line"><span></span></div>-->
                            <div class="row">
                                <div class="comment-author vcard span3">
                                    <div class="row">
                                        <div class="span1"><span class="border"><?php echo get_avatar( $comment, 64 ); ?></span></div>
                                        <!--<img src="<?php echo YIT_THEME_TEMPLATES_URL ?>/comments/images/horizontal-lines.png" class="horizontal-lines-left" />-->
                                        <!--<img src="<?php echo YIT_THEME_TEMPLATES_URL ?>/comments/images/horizontal-lines.png" class="horizontal-lines-right" />-->
                                        <div class="comment-meta commentmetadata reply comment-author-name comment-date span2">
                                            <!-- author name -->
                                            <?php printf( '<cite class="fn">%s</cite>', get_comment_author_link() ); ?>

                                            <!-- date -->
                                            <a class="date" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
                                                <?php
                                                /* translators: 1: date, 2: time */
                                                printf( __( '%1$s', 'yit' ), get_comment_date( 'M, j - Y' ) ); ?></a>

                                            <!-- reply -->
                                            <?php
                                            comment_reply_link( array_merge( $args, array(
                                                'depth' => $depth,
                                                'max_depth' => $args['max_depth'],
                                                'reply_text' => apply_filters( 'yit_comment_reply_link_text', '<img class="comment-reply-link" src="' . YIT_THEME_TEMPLATES_URL . '/comments/images/comment-reply-link.png" title="' . __( 'reply', 'yit' ) . '" alt="+" />' . __( 'reply', 'yit' ) )
                                            ) ) ); ?>
                                        </div><!-- .reply -->
                                    </div>
                                </div><!-- .comment-author .vcard -->

                                <div class="comment-content span<?php echo 7 - yit_comment_depth( get_comment_ID() ) ?>">
                                    <div class="border borderstrong">
                                        <div class="border">
                                            <?php if ( $comment->comment_approved == '0' ) : ?>
                                                <em class="moderation"><?php _e( 'Your comment is awaiting moderation.', 'yit' ); ?></em>
                                                <br />
                                            <?php endif; ?>
                                            <div class="comment-body"><?php comment_text(); ?></div>
                                        </div>
                                    </div>
                                </div><!-- .comment-meta .commentmetadata -->
                            </div>
                        </div><!-- #comment-##  -->
                    </div>
                <?php
                break;
        endswitch;
    }
}

if( !function_exists( 'yit_unregister_post_types' ) ) {
    function yit_unregister_post_types() {
        $post_types = array('services');

        foreach($post_types as $pt) {
            yit_unregister_post_type($pt);
        }
    }
}

if( !function_exists( 'yit_simple_read_more_classes' ) ) {
    /**
     * Add a class to the read more if it is not a button shortcode
     *
     * @param string $link
     * @return string
     * @since 1.0.0
     */
    function yit_simple_read_more_classes( $link ) {
        if( !strpos( $link, 'class="btn' ) ) {
            $link = '<br />' . $link;
            return str_replace( 'class="', 'class="not-btn ', $link );
        }

        return $link;
    }
}



if( !function_exists('yit_remove_first_post_image') ) {
    /**
     * Add a class to the read more if it is not a button shortcode
     *
     * Currenctly disabled
     *
     * @param string $the_content
     * @return string
     * @since 1.0.0
     */
    function yit_remove_first_post_image( $the_content ) {
        if( yit_get_option('blog-show-first-content-image') ) {
            $output = preg_match_all('/^((<[a|span|p|div][^>]*>)*)<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $the_content, $matches);

            if( isset($matches[0][0]) && $matches[0][0]) {
                $the_content = str_replace($matches[0][0], '', $the_content);
            }
        }

        return $the_content;
    }
}

/* === AJAX CALLS */
if( !function_exists( 'yit_ajax_portfolio_thumbs' ) ) {
    /**
     * Return JSON well formatted portfolio work
     *
     * @param array $work
     * @return string
     * @since 1.0.0
     */
    function yit_ajax_portfolio_thumbs() {


        $work = $_POST['work'];
        $type = $_POST['type'];

        //thumb
        $thumb_output = '';
        $lightbox = $_POST['overlay'];
        if( isset($work['video_url']) && $work['video_url'] ) {
            list( $video_type, $video_id ) = explode( ':', yit_video_type_by_url( $work['video_url'] ) );
            if( $video_type == 'youtube' ) {
                $video_url = 'http://www.youtube.com/embed/' . $video_id . '?width=640&height=480&iframe=true';
            } else if( $video_type == 'vimeo') {
                $video_url = 'http://player.vimeo.com/video/' . $video_id;
            }

            $thumb_output = do_shortcode( "[$video_type video_id=\"$video_id\" width=\"100%\" height=\"100%\"]" );
        } elseif( !empty($work['extra-images']) ) {
            $thumb_output = '<div class="extra-images-slider"><ul class="slides">';
            $thumb_size = $type == 'portfolio' ? 'thumb_medium_portfolio_thumbs' : 'section_portfolio';

            array_unshift($work['extra-images'], $work['item_id']);
            foreach ( $work['extra-images'] as $image_id ) {
                $thumb_output .= '<li><div class="picture_overlay">';
                $thumb_output .= yit_image( "id=$image_id&size=$thumb_size", false );//wp_get_attachment_image( $image_id, $thumb_size );

                if( $lightbox ) {
                    $thumb = yit_image( "id=$image_id&output=url", false );
                    $thumb_output .= '<div class="overlay"><div><p>';
                    $thumb_output .= '<a href="'. $thumb .'" rel="lightbox_thumbs"><img src="' . get_template_directory_uri() . '/images/icons/zoom.png" alt="' . __('Open Lightbox', 'yit') .'" /></a>';
                    $thumb_output .= '</p></div></div>';
                }

                $thumb_output .= '</div></li>';
            }

            $thumb_output .= '</ul></div>';
        } else {
            $thumb_size = $type == 'portfolio' ? 'thumb_medium_portfolio_thumbs' : 'section_portfolio';
            $thumb_output  = '<div class="picture_overlay">';
            $thumb_output .= yit_image( "id=$work[item_id]&size=$thumb_size", false );//wp_get_attachment_image( $work['item_id'], $thumb_size );

            if( $lightbox ) {
                $thumb_output .= '<div class="overlay"><div><p>';
                $thumb_output .= '<a href="'. $work['image'] .'" rel="lightbox_thumbs"><img src="' . get_template_directory_uri() . '/images/icons/zoom.png" alt="' . __('Open Lightbox', 'yit') .'" /></a>';
                $thumb_output .= '</p></div></div>';
            }

            $thumb_output .= '</div>';
        }

        //content
        $thumb_content = '';
        if( $type != 'portfolio' ) {
            $thumb_content = '<h3 class="title">' . yit_decode_title($work['title']) . '</h3>';
            if( isset($work['subtitle']) && $work['subtitle'] ) {
                $thumb_content .= '<h4 class="subtitle">' . yit_decode_title($work['subtitle']) . '</h4>';
            }
        }
        $thumb_content .= yit_clean_text( $work['text'] );

        //meta
        $meta_content = '';

        $customer = $work['customer'];
        $skills = $work['skills'];
        $skills_label = empty($work['skills_label']) ? yit_string('<strong>', __('Skills: ', 'yit'), '</strong>',0) : yit_string('<strong>', $work['skills_label'], '</strong>', 0) . ': ';
        $website = $work['website_name'] ? $work['website_name'] : $work['website_url'];
        $website_url = $work['website_url'];
        $year = $work['year'];
        $terms = isset( $work['terms'] ) ? $work['terms'] : '';

        $meta_content = '<ul>';

        if( $terms ) {
            $terms_plain = '';
            $categories = $work['categories'];

            foreach( $terms as $term ) {
                $terms_plain .= $categories[$term] . ', ';
            }
            $terms_plain = substr($terms_plain,0,strlen($terms_plain)-2);

            $icon = '<span><img src="'. YIT_THEME_TEMPLATES_URL . '/portfolios/thumbs/images/categories.png" alt="categories" /></span>';
            $meta_content .= '<li class="categories">' . $icon . yit_string('<strong>', __('Categories: ', 'yit'), '</strong>', 0) . $terms_plain .'</li>';
        }

        if( $customer ) {
            $icon = '<span><img src="'. YIT_THEME_TEMPLATES_URL . '/portfolios/thumbs/images/customer.png" alt="customer" /></span>';
            $meta_content .= '<li class="customer">' . $icon . yit_string('<strong>', __('Customer: ', 'yit'), '</strong>', 0) . $customer;

            if( $website_url ) {
                $meta_content .= ' - <a href="' . $website_url . '">' . $website .'</a>';
            }

            $meta_content .= '</li>';
        }

        if( $skills ) {
            $icon = '<span><img src="'. YIT_THEME_TEMPLATES_URL . '/portfolios/thumbs/images/project.png" alt="skills" /></span>';
            $meta_content .= '<li class="skills">' . $icon . $skills_label . $skills .'</li>';
        }

        if( $year ) {
            $icon = '<span><img src="'. YIT_THEME_TEMPLATES_URL . '/portfolios/thumbs/images/year.png" alt="year" /></span>';
            $meta_content .= '<li class="year">' . $icon . yit_string('<strong>', __('Year: ', 'yit'), '</strong>', 0) . $year .'</li>';
        }

        echo json_encode( array('thumb' => $thumb_output, 'content' => $thumb_content, 'meta' => $meta_content, 'title' => yit_decode_title($work['title'])) );
        die();
    }
}

function yit_og_taxonomy_terms_image() {
    $queried_object = get_queried_object();

    if( isset($queried_object->taxonomy) && $queried_object->taxonomy ){
        $term_thumbnail = get_woocommerce_term_meta( $queried_object->term_id, 'thumbnail_id', true );
        $image_src      = wp_get_attachment_image_src( $term_thumbnail, 'full' );
        if( $image_src[0] ) {
            echo '<meta property="og:image" content="' . $image_src[0] . '"/>';
        }
    }
}

function yit_global_object() {

    wp_localize_script( 'jquery', 'yit', array(
        'isRtl' => is_rtl() ,
        'isBoxed' => (yit_get_option("layout-type")=="boxed")
    ));

}


if(!function_exists("yit_get_welcome_user_name")){

    function yit_get_welcome_user_name($current_user){

        // if firstname and last name are both not setted
        if(!$current_user->user_firstname && !$current_user->user_lastname){

            if(is_shop_installed()){

                $firstname_billing= get_user_meta($current_user->ID,"billing_first_name",true);
                $lastname_billing= get_user_meta($current_user->ID,"billing_last_name",true);

                // if firstname and last name in billing options are both not setted
                if(!$firstname_billing && !$lastname_billing)  $user_name = $current_user->user_nicename;
                else $user_name = $firstname_billing . ' ' . $lastname_billing;

            }
            else $user_name = $current_user->user_nicename;
        }
        else{
            $user_name = $current_user->user_firstname . ' ' . $current_user->user_lastname;
        }

        return $user_name;
    }

}

if( !function_exists( 'yit_print_mobile_favicons' ) ) {
    /**
     * Print the html for mobile devices favicons.
     *
     * @return string
     * @author Andrea Frascaspata    <andrea.frascaspata@yithems.com>
     * @since 1.0.0
     */
    function yit_print_mobile_favicons() {

        // 144: For iPad3 with retina display:
        // 114: for first- and second-generation iPad
        //  72: For first- and second-generation iPad
        //  57: For non-Retina iPhone, iPod Touch, and Android 2.1+ devices

        $size_list = array(144,114,72,57);

        $favicon_base_url =  yit_get_option( 'general-favicon-touch' );

        //yit default favicons
        if ( $favicon_base_url===false || empty( $favicon_base_url ) || $favicon_base_url == get_template_directory_uri() . '/apple-touch-icon-144x.png' ) {

            foreach ( $size_list as $size ) {
                $favicon_url = yit_remove_protocol_url( get_template_directory_uri() . '/apple-touch-icon-' . $size . 'x.png' );
                echo '<link rel="apple-touch-icon-precomposed" sizes="' . $size . 'x' . $size . '" href="' . $favicon_url . '" />';
            }

        }
        //custom favicon
        else {

            foreach ( $size_list as $size ) {

                $size_name = 'favicon_' . $size;

                add_image_size( $size_name, $size, $size, true );

                $args['src']  = $favicon_base_url;
                $args['output'] = 'url';
                $args['size'] = $size_name;

                $url = yit_remove_protocol_url( yit_image( $args, false ) ) ;

                echo '<link rel="apple-touch-icon-precomposed" sizes="' . $size . 'x' . $size . '" href="' . $url . '" />';
            }

        }

    }
}