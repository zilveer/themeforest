<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="qodef-post-content">
		<div class="qodef-post-text">
			<div class="qodef-post-text-inner clearfix">
				<div class="qodef-post-info">
					<?php suprema_qodef_post_info(array('date' => 'yes', 'author' => 'yes', 'category' => 'yes', 'comments' => 'no', 'share' => 'no', 'like' => 'no')) ?>
				</div>
				<div class="qodef-post-title">
					<h3>
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo esc_html(get_post_meta(get_the_ID(), "qodef_post_quote_text_meta", true)); ?></a>
					</h3>
					<span class="quote_author">&ndash; <?php the_title(); ?></span>
				</div>
			</div>
		</div>
		<?php the_content(); ?>
	</div>
	<div class="qodef-post-info-bottom clearfix">
		<?php do_action('suprema_qodef_before_blog_article_closed_tag'); ?>
	</div>
</article>