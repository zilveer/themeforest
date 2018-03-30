<?php
/**
 * The template for displaying posts in the Status Post Format on index and archive pages
 *
 * @package WordPress
 */
 
/* :: Get Custom Field Data
--------------------------------------------- */

include(NV_FILES .'/inc/classes/post-fields-class.php');

/* :: / ------------------------------------- */ ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    	
        <div class="article-row row">
        
            <aside class="post-metadata columns two">
            <?php echo get_avatar( get_the_author_meta( 'ID' ), 70 ); ?>
            </aside><!-- /post-metadata -->
            
            <section class="entry <?php echo $columns; ?>">
                <?php if ( is_search() ) : // Only display Excerpts for Search ?>
                    <?php the_excerpt(); ?>
                <?php else : ?>
                    <small class="status-time"><?php _e( 'By ', 'themeva' ); echo get_the_author_meta('first_name') ." ". get_the_author_meta('last_name') .' '; _e( 'On ', 'themeva' ); the_time('F j, Y g:i a'); ?></small>
                    <?php do_shortcode(the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'themeva' ) )); ?>
                    <?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'themeva' ) . '</span>', 'after' => '</div>' ) ); ?>
                <?php endif; ?>
            </section><!-- / .entry -->
        
        </div>
    
		<?php 
    	// Check if placed within a widget
        if( $NV_is_widget != true )
		{ 
			include(NV_FILES .'/inc/classes/post-footer-class.php');	 
		} ?>
    
	</article><!-- #post-<?php the_ID(); ?> -->