<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="qodef-post-content">
		<?php qode_startit_get_module_template_part('templates/single/parts/image', 'blog'); ?>
		<div class="qodef-post-text">
			<div class="qodef-post-text-inner">
				<?php qode_startit_get_module_template_part('templates/lists/parts/date', 'blog'); ?>
				<div class="qodef-blog-standard-info-holder">
					<?php qode_startit_get_module_template_part('templates/single/parts/title', 'blog'); ?>
					<div class="qodef-post-info">
						<?php qode_startit_post_info(array('date' => 'no', 'author' => 'yes', 'category' => 'yes', 'comments' => 'yes', 'share' => 'no', 'like' => 'no')) ?>
					</div>
				</div>
				<?php the_content(); ?>
			</div>
		</div>
	</div>
	<div class="qodef-post-info-bottom">
		<?php do_action('qode_startit_before_blog_article_closed_tag'); ?>
	</div>
</article>