<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="qodef-post-content">
		<div class="qodef-post-text">
			<div class="qodef-post-text-inner clearfix">
				<div class="qodef-post-info">
					<?php suprema_qodef_post_info(array('date' => 'yes', 'author' => 'yes', 'category' => 'yes', 'comments' => 'no', 'share' => 'no', 'like' => 'no')) ?>
				</div>
				<h3 class="qodef-post-title">
					<a href="<?php echo esc_html(get_post_meta(get_the_ID(), "qodef_post_link_link_meta", true)); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
				</h3>
			</div>
		</div>
		<?php the_content(); ?>
	</div>
	<div class="qodef-post-info-bottom clearfix">
		<?php do_action('suprema_qodef_before_blog_article_closed_tag'); ?>
	</div>
</article>