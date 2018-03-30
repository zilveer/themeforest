<div class="mkdf-blog-holder mkdf-blog-type-standard">
	<?php
		if($blog_query->have_posts()) : while ( $blog_query->have_posts() ) : $blog_query->the_post();
			hashmag_mikado_get_post_format_html($blog_type);
		endwhile;
		else:
			hashmag_mikado_get_module_template_part('templates/parts/no-posts', 'blog');
		endif;
	?>
</div>
<?php
	if(hashmag_mikado_options()->getOptionValue('pagination') == 'yes') {
		hashmag_mikado_pagination($blog_query->max_num_pages, $blog_page_range, $paged);
	}
?>