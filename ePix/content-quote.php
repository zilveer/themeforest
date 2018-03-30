<?php
/**
 * The template for displaying posts in the Quote Post Format on index and archive pages
 *
 * @package WordPress
 */
 
/* :: Get Custom Field Data
--------------------------------------------- */

include(NV_FILES .'/inc/classes/post-fields-class.php');

/* :: / ------------------------------------- */ 

?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<div class="article-row row">
        	<section class="entry twelve columns">
   
				<?php if ( is_search() ) : // Only display Excerpts for Search ?>
                    <?php the_excerpt(); ?>
                <?php else : ?>
                    <?php echo do_shortcode('[blockquote type="blockquote_quotes" align="center"]'. get_the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'themeva' )).'[/blockquote]'); ?>
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