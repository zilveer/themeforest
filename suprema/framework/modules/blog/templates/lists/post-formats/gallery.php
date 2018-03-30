<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="qodef-post-content">
		<?php suprema_qodef_get_module_template_part('templates/lists/parts/gallery', 'blog'); ?>
		<div class="qodef-post-text">
			<div class="qodef-post-text-inner">
				<?php suprema_qodef_get_module_template_part('templates/lists/parts/title', 'blog'); ?>
				<div class="qodef-post-info">
					<?php suprema_qodef_post_info(array('date' => 'yes', 'author' => 'yes', 'category' => 'yes', 'comments' => 'no', 'share' => 'no', 'like' => 'no')) ?>
				</div>
				<?php
					if($type == 'standard') {
						suprema_qodef_excerpt($excerpt_length);
						$args_pages = array(
							'before' => '<div class="qodef-single-links-pages"><div class="qodef-single-links-pages-inner">',
							'after' => '</div></div>',
							'link_before' => '<span>',
							'link_after' => '</span>',
							'pagelink' => '%'
						);

						wp_link_pages($args_pages);
						suprema_qodef_read_more_button();
					}
					else if($type == 'standard-whole-post') {
						the_content();
					}
				?>
			</div>
		</div>
	</div>
</article>