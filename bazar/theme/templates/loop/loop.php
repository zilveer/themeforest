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
 
global $wp_query, $post, $more;


$blog_type = yit_get_option( 'blog-type' );

if( is_testimonial() ) {
    echo do_shortcode( '[testimonials]' );
    return;
}

if( is_single() )
    { $blog_type = yit_get_option( 'blog-single-type' ); }

if( is_category() || is_tag() ) {
    if( is_category() ) {
        echo do_shortcode( category_description() );
    } elseif( is_tag() ) {
        echo do_shortcode( tag_description() );
    }

    echo '<div class="clear"></div>';
}

if ( is_category() || is_archive() || is_search() ) {
    if( is_category() ) {
        if( yit_get_option( 'show-title-categories' ) ) : printf( '<h2>' . yit_get_option( 'page-categories-title' ) . '</h2>', single_cat_title( '', false ) ); endif;
    } elseif( is_archive() ) {
        if( yit_get_option( 'show-title-archives' ) ) : echo '<h2>' . yit_get_option( 'page-archives-title' ) . '</h2>'; endif;
    } elseif( is_search() ) {
        if( yit_get_option( 'show-title-searches' ) ) : printf( '<h2>' . yit_get_option( 'page-searches-title' ) . '</h2>', get_search_query() ); endif;
    }
}

if( have_posts() ) : 
                                                                     
    if( $blog_type == 'pinterest' ) echo '<div class="row"><div id="pinterest-container">';
    while (have_posts()) : the_post();
        $tmp_query = $wp_query;
        if( !is_single() )
            { $more = 0; }
        
        do_action( 'yit_loop_blog_' . $blog_type );
        
        $wp_query = $tmp_query;
        wp_reset_postdata();
    endwhile;
    if( $blog_type == 'pinterest' ) echo '</div></div>'; ?>
    
<?php else : //There aren't posts ?>
<div id="post-0" class="post error404 not-found group">
	<h1 class="entry-title"><?php _e( 'Not Found', 'yit' ); ?></h1>
	<div class="entry-content">
		<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'yit' ); ?></p>
		<?php get_search_form(); ?>
	</div>
</div>
<?php
endif;

wp_reset_postdata();

if( function_exists( 'yit_pagination' ) ) : yit_pagination(); else : ?> 
<div class="navigation group">
    <div class="alignleft"><?php next_posts_link( __( 'Next &raquo;', 'yit' ) ) ?></div>
    <div class="alignright"><?php previous_posts_link( __( '&laquo; Back', 'yit' ) ) ?></div>
</div>
<?php endif ?>