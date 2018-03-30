<div class="mkd-post-info-author">
	<?php esc_html_e('By', 'libero'); ?>
	<a class="mkd-post-info-author-link" href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>">
		<?php the_author_meta('display_name'); ?>
	</a>
</div>
