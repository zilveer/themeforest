<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="qodef-post-content">
		<?php qode_startit_get_module_template_part('templates/lists/parts/gallery', 'blog'); ?>
		<div class="qodef-post-text">
			<div class="qodef-post-text-inner">
				<?php qode_startit_get_module_template_part('templates/lists/parts/date', 'blog'); ?>
				<div class="qodef-blog-standard-info-holder">
					<?php qode_startit_get_module_template_part('templates/lists/parts/title', 'blog'); ?>
					<div class="qodef-post-info">
						<?php qode_startit_post_info(array('date' => 'no', 'author' => 'yes', 'category' => 'yes', 'comments' => 'yes', 'share' => 'no', 'like' => 'no')) ?>
					</div>
				</div>
				<?php
					if($type != '' && $type =='standard-whole-post') {
						the_content();
					}
					else {
						qode_startit_excerpt($excerpt_length);
						qode_startit_read_more_button();
					}
				?>
			</div>
		</div>
	</div>
</article>