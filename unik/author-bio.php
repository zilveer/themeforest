<?php
/**
 * The template part for displaying author biography part
 *
 */

?>
<div class="author-info clearfix">

	<div class="author-avatar thumbnail">
		<?php echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size ); ?>
	</div><!-- author-avatar -->
	
	<div class="author-description">
		<h2 class="author-title"><?php printf( __( 'About %s', THEMENAME ), get_the_author() ); ?></h2>		
		<p class="author-bio">	
			<?php the_author_meta( 'description' ); ?>
			
			<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
				<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', THEMENAME ), get_the_author() ); ?>
			</a>
		</p>
		
	</div><!-- .author-description -->
	
</div><!-- .author-info -->