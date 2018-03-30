<?php
/**
 * The template for displaying Author bios.
 *
 */
?>
<div class="grid-100 tablet-grid-100 mobile-grid-100">
	<div class="author-info clearfix">
    <h3 class="author-title"><span><?php printf( esc_html__( 'About the Author', 'unitedthemes' ), get_the_author() ); ?></span></h3>
        <div class="author-description">
        
        	 <figure class="author-avatar">
                <?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'ut_author_bio_avatar_size', 80 ) ); ?>
            </figure><!-- .author-avatar -->
            
            <span class="author-bio">
            	<span class="the-author"><?php the_author(); ?></span> 
                <?php the_author_meta( 'description' ); ?>
                <a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
                    <?php printf( esc_html__( 'View all posts by %s', 'unitedthemes' ), get_the_author() ); ?><i class="fa fa-chevron-circle-right"></i>
                </a>
            </span>
            
		</div><!-- .author-description -->
    	</div><!-- .grid-100 tablet-grid-100 mobile-grid-100 -->
</div><!-- .author-info -->