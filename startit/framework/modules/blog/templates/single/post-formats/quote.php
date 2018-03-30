<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="qodef-post-content">
		<div class="qodef-post-text">
			<div class="qodef-post-text-inner">
				<div class="qodef-post-mark">
					<span class="fa fa-quote-right quote_mark"></span>
				</div>
				<?php qode_startit_get_module_template_part('templates/lists/parts/date', 'blog'); ?>
				<div class="qodef-blog-standard-info-holder">
					<div class="qodef-post-info">
						<?php qode_startit_post_info(array('date' => 'no', 'author' => 'yes', 'category' => 'yes', 'comments' => 'yes', 'share' => 'no', 'like' => 'no')) ?>
					</div>
					<div class="qodef-post-title">
						<h5><?php echo esc_html(get_post_meta(get_the_ID(), "qodef_post_quote_text_meta", true)); ?></h5>
						<span class="qodef-quote-author">&ndash; <?php the_title(); ?></span>
					</div>
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