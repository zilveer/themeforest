<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="qodef-post-content">
		<div class="qodef-post-text">
			<div class="qodef-post-text-inner">
				<div class="qodef-post-mark">
					<span class="fa fa-link link_mark"></span>
				</div>
				<?php qode_startit_get_module_template_part('templates/lists/parts/date', 'blog'); ?>
				<div class="qodef-blog-standard-info-holder">
					<div class="qodef-post-info">
						<?php qode_startit_post_info(array('date' => 'no', 'author' => 'yes', 'category' => 'yes', 'comments' => 'yes', 'share' => 'no', 'like' => 'no')) ?>
					</div>
					<?php qode_startit_get_module_template_part('templates/lists/parts/title', 'blog', '', array('title_tag' => 'h5')); ?>
				</div>
			</div>
		</div>
	</div>
</article>