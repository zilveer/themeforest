<?php hue_mikado_get_module_template_part('templates/lists/parts/filter', 'blog'); ?>
    <div class="mkd-blog-holder mkd-blog-type-masonry mkd-masonry-full-width mkd-masonry-pagination-<?php echo hue_mikado_options()->getOptionValue('masonry_pagination'); ?>">
        <div class="mkd-blog-masonry-grid-sizer"></div>
        <div class="mkd-blog-masonry-grid-gutter"></div>
        <?php
        if($blog_query->have_posts()) : while($blog_query->have_posts()) : $blog_query->the_post();
            hue_mikado_get_post_format_html($blog_type);
        endwhile;
        else:
            hue_mikado_get_module_template_part('templates/parts/no-posts', 'blog');
        endif;
        ?>
    </div>
<?php
if(hue_mikado_options()->getOptionValue('pagination') == 'yes') {
    $pagination_type = hue_mikado_options()->getOptionValue('masonry_pagination');
	if($pagination_type != 'no-pagination') {
		if ($pagination_type == 'load-more' || $pagination_type == 'infinite-scroll') {
			if (get_next_posts_page_link($blog_query->max_num_pages)) { ?>
				<div class="mkd-blog-<?php echo esc_attr($pagination_type); ?>-button-holder">
						<span class="mkd-blog-<?php echo esc_attr($pagination_type); ?>-button"
							  data-rel="<?php echo esc_attr($blog_query->max_num_pages); ?>">
							<?php
							echo hue_mikado_get_button_html(array(
								'link' => get_next_posts_page_link($blog_query->max_num_pages),
								'text' => 'Show more'
							));
							?>
						</span>
				</div>
			<?php }
		} else {
			hue_mikado_pagination($blog_query->max_num_pages, $blog_page_range, $paged);
		}
	}
}
?>