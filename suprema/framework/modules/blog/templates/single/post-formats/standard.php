<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="qodef-post-content">
		<?php suprema_qodef_get_module_template_part('templates/single/parts/image', 'blog'); ?>
		<div class="qodef-post-text">
			<div class="qodef-post-text-inner clearfix">
				<?php suprema_qodef_get_module_template_part('templates/single/parts/title', 'blog'); ?>
				<div class="qodef-post-info">
					<?php suprema_qodef_post_info(array('date' => 'yes', 'author' => 'yes', 'category' => 'yes', 'comments' => 'no', 'share' => 'no', 'like' => 'no')) ?>
				</div>
				<?php the_content(); ?>
			</div>
		</div>
	</div>
	<div class="qodef-post-info-bottom clearfix">
		<?php do_action('suprema_qodef_before_blog_article_closed_tag'); ?>
	</div>
</article>