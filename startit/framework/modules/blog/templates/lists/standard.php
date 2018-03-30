<div class="qodef-blog-holder qodef-blog-type-standard">
	<?php
		if($blog_query->have_posts()) : while ( $blog_query->have_posts() ) : $blog_query->the_post();
			qode_startit_get_post_format_html($blog_type);
		endwhile;
		else:
			qode_startit_get_module_template_part('templates/parts/no-posts', 'blog');
		endif;
	?>
	<?php
		if(qode_startit_options()->getOptionValue('pagination') == 'yes') {
			if (qode_startit_options()->getOptionValue('pagination_type') == 'navigation') {
				?>
				<div class="qodef-pagination">
					<ul>
						<li class='qodef-pagination-prev'><?php echo wp_kses_post(get_previous_posts_link('<i class="pagination_arrow arrow_carrot-left"></i>')); ?></li>
						<li class='qodef-pagination-next'><?php echo wp_kses_post(get_next_posts_link('<i class="pagination_arrow arrow_carrot-right"></i>', $blog_page_range)); ?></li>
					</ul>
				</div>
				<?php
			} else {
				qode_startit_pagination($blog_query->max_num_pages, $blog_page_range, $paged);
			}
		}
	?>
</div>
