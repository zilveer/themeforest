<div class='mkd-blog-slider-holder mkd-blog-slider-one <?php echo esc_attr($additional_classes) ?>' <?php print $data_attribute; ?>>
	<?php if ($query->have_posts()) : ?>
		<?php while ($query->have_posts()) : $query->the_post(); ?>
			<div class="item">
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="mkd-post-content">
						<div class="mkd-post-image-with-author">
							<?php
							if (hue_mikado_masonry_no_image_template()) {
								hue_mikado_get_module_template_part('templates/lists/parts/image', 'blog', '', array('image_size' => 'hue_mikado_masonry'));
							}
							?>
							<div class="mkd-author-desc clearfix">
								<div class="mkd-image-name clearfix">
									<div class="mkd-author-image">
										<?php echo hue_mikado_kses_img(get_avatar(get_the_author_meta('ID'), 102)); ?>
									</div>
									<div class="mkd-author-name-holder">
										<h5 class="mkd-author-name">
											<?php
											if (get_the_author_meta('first_name') != "" || get_the_author_meta('last_name') != "") {
												echo esc_attr(get_the_author_meta('first_name')) . " " . esc_attr(get_the_author_meta('last_name'));
											} else {
												echo esc_attr(get_the_author_meta('display_name'));
											}
											?>
										</h5>
									</div>
								</div>
							</div>
						</div>
						<div class="mkd-post-text">
							<div class="mkd-post-text-inner">
								<h2 class="mkd-post-title">
									<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
										<?php
										if ($title_length != '') {
											echo hue_mikado_get_title_substring(get_the_title(), intval($title_length));
										} else {
											the_title();
										}
										?>
									</a>
								</h2>
								<?php
								hue_mikado_excerpt($excerpt_length);
								$args_pages = array(
									'before'      => '<div class="mkd-single-links-pages"><div class="mkd-single-links-pages-inner">',
									'after'       => '</div></div>',
									'link_before' => '<span>',
									'link_after'  => '</span>',
									'pagelink'    => '%'
								);

								wp_link_pages($args_pages);
								?>
							</div>
							<div class="mkd-categories-date clearfix">
								<div class="mkd-categories-list">
									<?php hue_mikado_get_module_template_part('templates/parts/post-info-category', 'blog'); ?>
								</div>
								<div class="mkd-post-info">
									<?php hue_mikado_post_info(array('date' => 'yes')) ?>
								</div>
							</div>
						</div>
					</div>
				</article>
			</div>
		<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>
	<?php else: ?>
		<p><?php esc_html_e('No posts were found.', 'hue'); ?></p>
	<?php endif; ?>
</div>