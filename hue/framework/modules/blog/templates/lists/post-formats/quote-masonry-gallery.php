<article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>
	<div class="mkd-masonry-gallery-quote-holder <?php echo esc_attr(hue_mikado_options()->getOptionValue('blog_gradient_element_style')); ?>">
		<div class="mkd-masonry-gallery-quote-author">
			<div class="mkd-masonry-gallery-quote-author-inner">
				<h2 class="mkd-masonry-gallery-quote">
					<span>"</span>
					<?php echo esc_html(get_post_meta(get_the_ID(), "mkd_post_quote_text_meta", true)); ?>
					<span>"</span>
				</h2>
				<div class="mkd-masonry-gallery-author">&mdash; <?php the_title(); ?></div>
			</div>
		</div>
		<div class="mkd-post-mark">
			<span aria-hidden="true" class="icon_quotations"></span>
		</div>
		<div class="mkd-masonry-gallery-quote-holder-bgrnd <?php echo esc_attr(hue_mikado_options()->getOptionValue('blog_gradient_element_style')); ?>"></div>
	</div>
</article>