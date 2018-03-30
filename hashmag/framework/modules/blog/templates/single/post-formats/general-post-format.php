<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="mkdf-post-content">
        <?php hashmag_mikado_get_single_post_html(); ?>
		<div class="mkdf-post-text">
			<div class="mkdf-post-text-inner clearfix">
				<?php the_content(); ?>
			</div>
		</div>
	</div>
	<?php do_action('hashmag_mikado_before_blog_article_closed_tag'); ?>
</article>