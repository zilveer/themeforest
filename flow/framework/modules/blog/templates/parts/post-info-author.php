<div class="eltd-post-info-author">
	<?php esc_html_e('by', 'flow'); ?>
	<a class="eltd-post-info-author-link" href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>" data-author-id="<?php echo esc_attr(get_the_author_meta( 'ID' )); ?>">
		<?php the_author_meta('display_name'); ?>
	</a>
</div>
