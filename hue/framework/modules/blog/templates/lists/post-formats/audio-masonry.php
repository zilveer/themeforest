<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="mkd-post-content">
		<div class="mkd-audio-image-holder">
			<div class="mkd-audio-player-holder">
				<?php hue_mikado_get_module_template_part('templates/parts/audio', 'blog'); ?>
			</div>
		</div>
		<div class="mkd-post-text">
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
			<div class="mkd-post-text-inner">
				<?php hue_mikado_get_module_template_part('templates/lists/parts/title', 'blog'); ?>
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