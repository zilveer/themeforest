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
        }

        global $wpdb;
        $cache_file = '/custom.css';
        if ( $wpdb->blogid != 0 ) $cache_file = str_replace( '.css', '-' . $wpdb->blogid . '.css', $cache_file );

        if( file_exists( YIT_CACHE_DIR . $cache_file ) )
            { yit_wp_enqueue_style( 9999, 'cache-custom', YIT_CACHE_URL . $cache_file, array(), $config['theme']['version'], 'all', true ); }

        $custom_css = locate_template( 'custom.css' );
        $custom_css = str_replace( array( get_stylesheet_directory(), get_template_directory() ), array( get_stylesheet_directory_uri(), get_template_directory_uri() ), $custom_css );

        yit_wp_enqueue_style( 99999, 'custom', $custom_css, array(), $config['theme']['version'], 'all', true );
    }
}

if( !function_exists( 'yit_add_custom_scripts' ) ) {
    function yit_add_custom_scripts() {
    	if( yit_get_option( 'responsive-enabled' ) ) {
            $translation_array = array( 'navigate_to' => __( 'Navigate to...', 'yit' ) );
            wp_localize_script( 'responsive-theme', 'mobile_menu', $translation_array );
    		wp_enqueue_script( 'responsive', YIT_CORE_ASSETS_URL . '/js/responsive.js', array('jquery'), '1.0', true ); 
    	}

		wp_enqueue_script( 'hoverIntent', YIT_CORE_ASSETS_URL . '/js/jquery.hoverIntent.js', array('jquery'), '1.0', true ); 
		wp_enqueue_script( 'superfish', YIT_CORE_ASSETS_URL . '/js/jquery.superfish.js', array('jquery'), '1.0', true ); 
		wp_enqueue_script( 'jquery-placeholder-plugin', YIT_CORE_ASSETS_URL . '/js/jquery.placeholder.js', array('jquery'), '1.0', true );
    }
}

if( !function_exists( 'yit_topbar' ) ) {
    function yit_topbar() {
        yit_get_template( '/header/topbar.php' );
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

/* === BLOG */


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
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <div class="<?php echo 'offset' . ( yit_comment_depth( get_comment_ID() ) - 1 ) . ' span' . ( 10 - yit_comment_depth( get_comment_ID() ) ) ?>">
            <div id="comment-<?php comment_ID(); ?>" class="comment-container">
                <div class="row">
                    <div class="comment-author vcard span3">
                        <div class="row">
                            <div class="span1"><?php echo get_avatar( $comment, 64 ); ?></div>
                            <div class="comment-meta commentmetadata reply comment-author-name comment-date span2">
                                <!-- author name -->
                                <?php printf( '<cite class="fn">%s</cite>', get_comment_author_link() ); ?>
                                
                                <!-- date -->
                                <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
                                <?php
                                    /* translators: 1: date, 2: time */
                                    printf( __( '%1$s', 'yit' ), get_comment_date( 'M j, Y' ) ); ?></a>
                                
                                <!-- reply -->
                                <?php
                                comment_reply_link( array_merge( $args, array(
                                    'depth' => $depth,
                                    'max_depth' => $args['max_depth'],
                                    'before' => '<img class="comment-plus" src="' . YIT_THEME_IMG_URL . '/icons/comment-plus.png" title="' . __( 'Reply', 'yit' ) . '" alt="+" />'
                                ) ) ); ?>
                            </div><!-- .reply -->
                        </div>
                    </div><!-- .comment-author .vcard -->
                    
                    <div class="comment-content span<?php echo 7 - yit_comment_depth( get_comment_ID() ) ?>">
                        <div>
                            <img src="<?php echo YIT_THEME_IMG_URL ?>/arrow-left-comments.png" class="arrow-left-comments" title="" alt="" />
                            <?php if ( $comment->comment_approved == '0' ) : ?>
                                <em class="moderation"><?php _e( 'Your comment is awaiting moderation.', 'yit' ); ?></em>
                                <br />
                            <?php endif; ?>                        
                            <div class="comment-body"><?php comment_text(); ?></div>
                        </div>
                    </div><!-- .comment-meta .commentmetadata -->
                </div>
            </div><!-- #comment-##  -->
        </div>
    <?php
            break;
    endswitch;
}

if( !function_exists( 'yit_unregister_post_types' ) ) {
	function yit_unregister_post_types() {
		$post_types = array('services');
		
		foreach($post_types as $pt) {
			yit_unregister_post_type($pt);
		}
	}
}