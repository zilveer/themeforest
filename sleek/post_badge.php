<div class="post__badge post__badge--author">
	<a class="tooltip" data-tooltip="<?php the_author_meta( 'display_name' ); ?>" href="<?php echo get_author_posts_url( get_the_author_meta('ID') ); ?>">
		<?php echo get_avatar( get_the_author_meta( 'ID' ), 320 ); ?>
	</a>
</div>