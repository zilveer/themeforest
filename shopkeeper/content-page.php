<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="row">
		<div class="large-12 columns">
            
        <div class="entry-content">
            <?php the_content( __( 'Continue Reading <span class="meta-nav">&rarr;</span>', 'shopkeeper' ) ); ?>
            <?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'shopkeeper' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
        </div><!-- .entry-content -->

		</div><!-- .columns -->
    </div><!-- .row -->
    
</div><!-- #post -->