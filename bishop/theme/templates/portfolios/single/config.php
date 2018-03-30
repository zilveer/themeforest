<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/* === AJAX ACTIONS === */
add_action( 'wp_ajax_portfolio_next_post', 'yit_portfolio_next_page' );
add_action( 'wp_ajax_nopriv_portfolio_next_post', 'yit_portfolio_next_page');

if( isset( $portfolio ) ){
    $layout = ( isset( $portfolio ) ? $portfolio->get('config-single_layout') : 'big_image' );

    /* === ENQUEUE SCRIPTS === */
	if ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX || $layout == 'small_image' ) {
		if( ! yit_is_old_ie() ){
			$this->enqueue_style( 'portfolio-single', 'css/style.css' );
		}else{
			wp_enqueue_style( 'portfolio-single', YIT_THEME_TEMPLATES_URL . '/portfolios/single/css/style.css' );
		}
	}

    /* === HOOKS === */
    if( $layout == 'big_image' ){
        add_action( 'wp_head', 'yit_add_portfolio_stylesheet', 0 );
        add_action( 'yit_primary', 'yit_portfolio_title', 7 );
        add_action( 'yit_after_primary_starts', 'yit_portfolio_current_page_start', 5 );
        add_action( 'yit_after_primary_starts', 'yit_portfolio_image', 10 );
        add_action( 'yit_before_primary_ends', 'yit_portfolio_current_page_end', 10 );
        add_action( 'yit_before_primary_ends', 'yit_portfolio_next_page', 15 );
        add_filter( 'body_class', 'yit_portfolio_add_body_class' );
        add_filter( 'yit_footer_type', 'yit_hide_footer' );
        add_action( 'wp_footer', 'yit_portfolio_single_assets' );
    }
    elseif( $layout == 'small_image' ){
        add_action( 'yit_after_primary_starts', 'yit_portfolio_title_bar', 7 );
    }
}

/* === HOOKED FUNCTIONS === */
if( ! function_exists( 'yit_add_portfolio_stylesheet' ) ) {
    /**
     * Add stylesheet in assets for portfolio
     *
     * @return void
     * @since 2.0.0
     * @author Antonio La Rocca <antonio.larocca@yithems.com>
    */
    function yit_add_portfolio_stylesheet(){
        $page_slider = array(
            'src'           => YIT_THEME_ASSETS_URL . '/css/page-slider.css',
            'enqueue'       => true,
            'registered'    => false
        );

        YIT_Asset()->set( 'style', 'page-slider', $page_slider );
    }
}
if( ! function_exists( 'yit_portfolio_current_page_start' ) ){
    /**
     * Print Current page start
     *
     * @return void
     * @since 2.0.0
     * @author Antonio La Rocca <antonio.larocca@yithems.com>
     */
    function yit_portfolio_current_page_start(){
        $html  = "<div id='current' class='slide-tab current-post " . ( ( ! has_post_thumbnail() ) ? "no-thumb" : "" ) . "'>";

        echo $html;
    }
}
if( !function_exists( 'yit_portfolio_image' ) ){
    /**
     * Print portfolio image
     *
     * @return void
     * @since 2.0.0
     * @author Antonio La Rocca <antonio.larocca@yithems.com>
     */
    function yit_portfolio_image(){

        $attachments = get_posts( array(
                'post_type' 	=> 'attachment',
                'numberposts' 	=> -1,
                'post_status' 	=> null,
                'post_parent' 	=> get_the_ID(),
                'post_mime_type'=> 'image',
                'orderby'		=> 'menu_order',
                'order'			=> 'ASC'
            )
        );

        $html = "";

        if( ! empty( $attachments ) && count( $attachments ) > 1 ){
            $min_height = 596;
            foreach ( $attachments as $key => $attachment ) {
                $image = yit_image( "id=$attachment->ID&size=portfolio_single_big&output=array&echo=0" );
                $min_height = ( 596 < $image[2] ) ? 596 : $image[2];
            }

            $html  = "<div class='big-image'>";
            $html .= "<div class='swiper-container swiper-" . get_the_ID() . "' data-postid='" . get_the_ID() . "' style='max-height: " . $min_height . "px' >";
            $html .= "<div class='swiper-wrapper'>";
            foreach ( $attachments as $key => $attachment ){
                $html .= "<div class='swiper-slide''>";
                $html .= yit_image( "id=" . $attachment->ID . "&size=portfolio_single_big&class=img-responsive", false );
                $html .= "</div>";
            }
            $html .= "</div>";
            $html .= "<div class='swiper-pagination pagination-post-" . get_the_ID() . "'></div>";
            $html .= "<div class='swiper-navigation container'>";
            $html .= "<div class='swiper-direction left'><i class='fa fa-chevron-left'></i></div>";
            $html .= "<div class='swiper-direction right'><i class='fa fa-chevron-right'></i></div>";
            $html .= "</div>";
            $html .= "</div>";
            $html .= "</div>";
        }
        elseif( has_post_thumbnail() ){
            $html = "<div class='big-image'>";
            $html .= yit_image( array( 'size' => 'portfolio_single_big', 'class' => 'img-responsive' ), false );
            $html .= "</div>";
        }

        echo $html;
    }
}
if( ! function_exists( 'yit_portfolio_title' ) ) {
    /**
     * Print portfolio page title
     *
     * @return void
     * @since 2.0.0
     * @author Antonio La Rocca <antonio.larocca@yithems.com>
     */
    function yit_portfolio_title(){
        yit_string( "<div class='col-sm-12 portfolio_big_image'><h2 class='post-title portfolio-title'><a href='" . get_permalink() . "'>", get_the_title(), "</a></h2></div>" );
    }
}
if( ! function_exists( 'yit_portfolio_title_bar' ) ) {
    /**
     * Print portfolio page title
     *
     * @return void
     * @since 2.0.0
     * @author Antonio La Rocca <antonio.larocca@yithems.com>
     */
    function yit_portfolio_title_bar(){
        global $post;

        $portfolio = YIT_Portfolio()->get_portfolio( $post->post_type );
        $custom_button_label = $portfolio->get('custom_button_label');
        $custom_button_url = $portfolio->get('custom_button_url');


        $html  = "<div class='portfolio_small_image portfolio-title-bar'>";
        $html .= "<div class='container'>";
        $html .= "<div class='row'>";
        $html .= "<div class='col-sm-12'>";
        $html .= yit_string( "<h2 class='post-title portfolio-title'><a href='" . get_permalink() . "'>", get_the_title(), "</a></h2>", false );
        if( $custom_button_label != '' && $custom_button_url != '' ){
            $html .= "<a class='btn btn-flat' href='" . $custom_button_url . "'>" . $custom_button_label . "</a>";
        }
        $html .= "</div>";
        $html .= "</div>";
        $html .= "</div>";
        $html .= "</div>";

        echo $html;
    }
}
if( ! function_exists( 'yit_portfolio_current_page_end' ) ){
    /**
     * Print Current page end
     *
     * @return void
     * @since 2.0.0
     * @author Antonio La Rocca <antonio.larocca@yithems.com>
     */
    function yit_portfolio_current_page_end(){
        $html  = "</div>";

        echo $html;
    }
}
if( ! function_exists( 'yit_portfolio_next_page' ) ){
    /**
     * Print Next page div
     *
     * @return void
     * @since 2.0.0
     * @author Antonio La Rocca <antonio.larocca@yithems.com>
     */
    function yit_portfolio_next_page(){
        global $post;

        if( defined('DOING_AJAX') && DOING_AJAX && isset( $_REQUEST['post_id'] ) ){
            $post = get_post( intval( $_REQUEST['post_id'] ) );
        }

        $next_post = get_next_post();

        if( $next_post == '' || $next_post == null ){

            $args = array(
                'orderby' => 'menu_order',
                'order' => 'ASC',
                'post_type' => $post->post_type
            );

            $posts = get_posts( $args );

            if( ! empty( $posts ) ){
                $next_post = $posts[0];
            }

        }

        $post = $next_post;
        setup_postdata($post);
        $layout = "big_image";

        $attachments = get_posts( array(
                'post_type' 	=> 'attachment',
                'numberposts' 	=> -1,
                'post_status' 	=> null,
                'post_parent' 	=> get_the_ID(),
                'post_mime_type'=> 'image',
                'orderby'		=> 'menu_order',
                'order'			=> 'ASC'
            )
        );

        $image_size = YIT_Registry::get_instance()->image->get_size( 'portfolio_single_big' );
        $placeholder_size = YIT_Registry::get_instance()->image->get_size( 'portfolio_single_big_placeholder' );

        if( !empty( $attachments ) ){
            $min_height = $image_size['height'];
            foreach ( $attachments as $key => $attachment ) {
                $image = yit_image( "id=$attachment->ID&size=portfolio_single_big&output=array&echo=0" );
                $min_height = ( $image_size['height'] < $image[2] ) ? $image_size['height'] : $image[2];
            }
        }

        $placeholder = ! has_post_thumbnail() ? 'class="placeholder no-featured" style="height: ' . $placeholder_size['height'] .'px;"' : 'class="placeholder"';

        ?>
        <div id="next" class='slide-tab next-post hidden-content <?php echo ( ! has_post_thumbnail() ) ? "no-thumb" : "" ?>' data-post_id="<?php the_ID() ?>">
            <div class='big-image'>
                <div <?php echo $placeholder ?> >
                    <div class="placeholder-container">
                        <?php yit_image( array( 'post_id' =>  get_the_ID(), 'size' => 'portfolio_single_big_placeholder', 'class' => 'img-responsive', 'crop' => true ) ); ?>
                        <div class="inner">
                            <div class="info-overlay">
                                <div class="read-more-label"><?php _e( 'VIEW NEXT PROJECT', 'yit' ) ?></div>
                                <div class="read-more-title"><?php the_title() ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if( ! empty( $attachments ) && count( $attachments ) > 1 ): ?>

                <div class="swiper-container swiper-<?php the_ID() ?>" data-postid="<?php the_ID() ?>" style="max-height: <?php echo $min_height ?>px;">
                    <div class="swiper-wrapper">
                        <?php foreach ( $attachments as $key => $attachment ) : ?>
                            <div class="swiper-slide">
                                <?php yit_image( "id=$attachment->ID&size=portfolio_single_big&class=img-responsive" ); ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="swiper-pagination pagination-post-<?php the_ID() ?>"></div>
                    <div class="swiper-navigation container">
                        <div class="swiper-direction left"><i class="fa fa-chevron-left"></i></div>
                        <div class="swiper-direction right"><i class="fa fa-chevron-right"></i></div>
                    </div>
                </div>

                <?php elseif( has_post_thumbnail() ): ?>

                <?php yit_image( array( 'size' => 'portfolio_single_big', 'class' => 'img-responsive' ) ); ?>

                <?php endif; ?>
            </div>
            <div class='container'>
                <div class='row'>
                    <?php
                    remove_action( 'yit_primary', 'yit_start_primary', 5 );
                    remove_action( 'yit_primary', 'yit_end_primary', 90 );
                    remove_action( 'yit_content_loop', 'yit_content_loop', 10 );
                    add_action( 'yit_content_loop', 'yit_portfolio_single_loop' );
                    do_action( 'yit_primary' );
                    add_action( 'yit_primary', 'yit_end_primary', 90 );
                    ?>
                </div>
            </div>
        </div>
        <?php

        if( defined('DOING_AJAX') && DOING_AJAX ){
            die();
        }
    }
}
if( ! function_exists( 'yit_portfolio_single_loop' ) ){
    /**
     * Add the loop in the single template
     *
     * @return void
     * @since 2.0.0
     * @author Antonio La Rocca <antonio.larocca@yithems.com>
     */
    function yit_portfolio_single_loop(){
        do_action( 'yit_loop' );
    }
}
if( ! function_exists( 'yit_portfolio_single_assets' ) ){
    /**
     * Add the loop in the single template
     *
     * @return void
     * @since 2.0.0
     * @author Antonio La Rocca <antonio.larocca@yithems.com>
     */
    function yit_portfolio_single_assets(){
        global $post;

        wp_localize_script( 'page-slider', 'yit_page_slider_options', array( 'action' => 'portfolio_next_post' ) );
    }
}
if( ! function_exists( 'yit_portfolio_add_body_class' ) ){
    /**
     * Add classes to body on portfolio layout
     *
     * @param $classes
     *
     * @return string[]
     * @since  2.0.0
     * @author Antonio La Rocca <antonio.larocca@yithems.com
     * @author Francesco Licandro <francesco.licandro@yithemes.com>
     */
    function yit_portfolio_add_body_class( $classes ){

        if( has_post_thumbnail() ) {
            $classes[] = "yit-portfolio";

            if( YIT_Registry::get_instance()->skins->get_skin() != 'vintage' ) {
                $classes[] = "force-sticky-header";
            }
        }

        return $classes;
    }
}