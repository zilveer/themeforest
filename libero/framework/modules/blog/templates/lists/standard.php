<div class="mkd-blog-holder mkd-blog-type-standard">
	<?php
		if($blog_query->have_posts()) : while ( $blog_query->have_posts() ) : $blog_query->the_post();
			libero_mikado_get_post_format_html($blog_type);
		endwhile;
		else:
			libero_mikado_get_module_template_part('templates/parts/no-posts', 'blog');
		endif;
	?>
	<?php
		if(libero_mikado_options()->getOptionValue('pagination') == 'yes') {
			libero_mikado_pagination($blog_query->max_num_pages, $blog_page_range, $paged);
		}
	?>
</div>
