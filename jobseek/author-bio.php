<div class="author-bio">
	<?php echo get_avatar( $post->post_author, 95 ); ?>
	<h5><?php _e( 'About the Author', 'jobseek' ); ?></h5>
	<p><?php the_author_meta( 'description' ); ?></p>
</div>