<div class="qodef-blog-holder qodef-blog-type-gallery qodef-gallery-pagination-<?php echo qode_startit_options()->getOptionValue('gallery_pagination'); ?>">
	<div class="qodef-blog-gallery-grid-sizer"></div>
	<div class="qodef-blog-gallery-grid-gutter"></div>
	<?php
	if($blog_query->have_posts()) : while ( $blog_query->have_posts() ) : $blog_query->the_post();
		qode_startit_get_post_format_html($blog_type);
	endwhile;
	else:
		qode_startit_get_module_template_part('templates/parts/no-posts', 'blog');
	endif;
	?>
</div>
<?php
	if(qode_startit_options()->getOptionValue('pagination') == 'yes') {

		$pagination_type = qode_startit_options()->getOptionValue('gallery_pagination');
		if($pagination_type == 'load-more' || $pagination_type == 'infinite-scroll'){
			if(get_next_posts_page_link($blog_query->max_num_pages)){ ?>
				<div class="qodef-blog-<?php echo esc_attr($pagination_type); ?>-button-holder">
					<span class="qodef-blog-<?php echo esc_attr($pagination_type); ?>-button" data-rel="<?php echo esc_attr($blog_query->max_num_pages); ?>">
						<?php
							echo qode_startit_get_button_html(array(
								'link' => get_next_posts_page_link($blog_query->max_num_pages),
								'text' => 'Show more'
							));
						?>
					</span>
				</div>
			<?php }
		}else {
			qode_startit_pagination($blog_query->max_num_pages, $blog_page_range, $paged);
		}
	}
?>

