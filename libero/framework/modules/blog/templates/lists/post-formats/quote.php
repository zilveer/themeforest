<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="mkd-post-content">
		<div class="mkd-post-info-column">
			<div class="mkd-post-info-column-inner">
				<?php libero_mikado_post_info(array('date' => 'yes', 'comments' => 'yes', 'share' => 'yes')) ?>
			</div>
			<span class="mkd-post-sticky">
				<span class="icon_ribbon_alt mkd-sticky-icon"></span>
				<?php esc_html_e('Sticky','libero'); ?>
			</span>
		</div>
		<div class="mkd-post-content-column mkd-quote-link-main" <?php echo libero_mikado_quote_link_content_style();?>>
			<div class="mkd-post-mark">
				<span class="icon_quotations quote_mark"></span>
			</div>
			<div class="mkd-post-text">
				<div class="mkd-post-text-inner">
					<div class="mkd-post-title">
						<h4>
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo esc_html(get_post_meta(get_the_ID(), "mkd_post_quote_text_meta", true)); ?></a>
						</h4>
						<span class="mkd-quote-author">&mdash; <?php the_title(); ?></span>
					</div>
					<div class="mkd-post-info">
						<?php libero_mikado_post_info(array('author' => 'yes', 'category' => 'yes')) ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</article>