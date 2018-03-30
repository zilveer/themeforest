<?php
/**
 * The Template for displaying front-page
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

if(get_option('show_on_front') === 'posts'){
    get_template_part( 'index' );
}
else{
    $fp_variant   = $apollo13->get_option( 'settings', 'fp_variant' );

    if($fp_variant == 'page'){
        //it makes use of real page templates instead of front-page.php
        $page_template = basename(get_page_template(), '.php');
        if($page_template !== 'page.php'){
            get_template_part( $page_template );
        }
        else{
            get_template_part( 'page' );
        }
    }
    elseif($fp_variant == 'blog'){
        global $wp_query, $more;

        //dirty trick
        /* on front page when you set page as FP $more is set to 1, so it breaks excerpts of posts */
        $more = NULL;

        //fix for front page pagination
        if ( get_query_var('paged') ) {
            $paged = get_query_var('paged');
        } elseif ( get_query_var('page') ) {
            $paged = get_query_var('page');
        } else {
            $paged = 1;
        }

        $args = array(
            'post_type=page' => 'post',
            'paged' => $paged
        );

        $wp_query->query( $args );

        get_template_part( 'index' );

    //    wp_reset_postdata();
    }
    elseif($fp_variant == 'works_list'){
        get_template_part( 'works_template' );
    }
    elseif($fp_variant == 'galleries_list'){
        get_template_part( 'galleries_template' );
    }
    elseif($fp_variant == 'gallery'){
        global $wp_query;
        //get gallery to show
        $fp_gallery  = $apollo13->get_option( 'settings', 'fp_gallery' );
        //save original query
        $original_query = $wp_query;
        //reset
        $wp_query = null;
        //make query
        $wp_query = new WP_Query( array('p' => $fp_gallery, 'post_type' => A13_CUSTOM_POST_TYPE_GALLERY ) );

        //call post so getting result from 'post' functions will do proper things
        if ( have_posts() ) the_post();

        //tell template who is calling ;-)
        define('A13_CALLED_FROM_FRONT_PAGE', true);

        //brutal change of what is desired for front page (fight WORDPRESS SEO PLUGIN)
        $GLOBALS['wp_the_query'] = $GLOBALS['wp_query'];

        //show
        get_template_part( 'single', 'gallery' );

        //return old query
        $wp_query = null;
        $wp_query = $original_query;

        // Reset Post Data
        wp_reset_postdata();
    }
}



