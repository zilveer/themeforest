<div class="vspace-40"></div>
<div class="author-box clearfix">
	<div class="author-img">
		<?php echo get_avatar( get_the_author_meta('user_email'), '80' ); ?>
	</div>
	<div class="author-info">
		<div class="author-name"><a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><?php the_author_meta('display_name'); ?></a></div>
		<p class="author-desc"><?php the_author_meta('description'); ?></p>
	</div>
</div>