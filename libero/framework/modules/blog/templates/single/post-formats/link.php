<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="mkd-post-content">
		<div class="mkd-post-info-column">
			<div class="mkd-post-info-column-inner">
				<?php libero_mikado_post_info(array('date' => 'yes', 'comments' => 'yes', 'share' => 'yes')) ?>
			</div>
		</div>
		<div class="mkd-post-content-column">
			<div class="mkd-post-content-column-inner mkd-quote-link-main" <?php echo libero_mikado_quote_link_content_style();?>>
				<div class="mkd-post-mark">
					<span class="icon_paperclip link_mark"></span>
				</div>
				<div class="mkd-post-text">
					<div class="mkd-post-text-inner">
						<h4 class="mkd-post-title">
							<a href="<?php echo esc_html(get_post_meta(get_the_ID(), "mkd_post_link_link_meta", true)); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
						</h4>
						<div class="mkd-post-info">
							<?php libero_mikado_post_info(array('author' => 'yes', 'category' => 'yes')) ?>
						</div>
					</div>
				</div>
			</div>
			<div class="mkd-post-single-quote-link-content">
				<?php the_content(); ?>
			</div>
		</div>
	</div>
	<?php do_action('libero_mikado_before_blog_article_closed_tag'); ?>
</article>