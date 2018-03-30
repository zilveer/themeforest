<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="qodef-post-content">
		<div class="qodef-post-text">
			<div class="qodef-post-text-inner">
				<div class="qodef-post-mark">
					<span class="fa fa-link link_mark"></span>
				</div>
				<?php qode_startit_get_module_template_part('templates/lists/parts/date', 'blog'); ?>
				<div class="qodef-blog-standard-info-holder">
					<div class="qodef-post-info">
						<?php qode_startit_post_info(array('date' => 'no', 'author' => 'yes', 'category' => 'yes', 'comments' => 'yes', 'share' => 'no', 'like' => 'no')) ?>
					</div>
					<h5 class="qodef-post-title">
						<a href="<?php echo esc_html(get_post_meta(get_the_ID(), "qodef_post_link_link_meta", true)); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
					</h5>
				</div>
			</div>
			<div class="qodef-post-extra-content">
				<?php the_content(); ?>
			</div>
		</div>
	</div>
	<div class="qodef-post-info-bottom">
		<?php do_action('qode_startit_before_blog_article_closed_tag'); ?>
	</div>
</article>