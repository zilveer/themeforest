<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="qodef-post-content">
		<div class="qodef-post-text">
			<div class="qodef-post-text-inner">
				<div class="qodef-post-mark">
					<span class="fa fa-quote-right quote_mark"></span>
				</div>
				<div class="qodef-post-info">
					<?php qode_startit_post_info(array('date' => 'yes', 'author' => 'no', 'category' => 'no', 'comments' => 'no', 'share' => 'no', 'like' => 'no')) ?>
				</div>
				<div class="qodef-post-title">
					<h5>
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo esc_html(get_post_meta(get_the_ID(), "qodef_post_quote_text_meta", true)); ?></a>
					</h5>
					<span class="qodef-quote-author">&ndash; <?php the_title(); ?></span>
				</div>
			</div>
		</div>
	</div>
</article>