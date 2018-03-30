<?php
$filter = esc_attr(flow_elated_options()->getOptionValue('masonry_filter'));

if($filter == 'yes'){
	$page_category = get_post_meta(flow_elated_get_page_id(), "eltd_blog_category_meta", true);
	if(is_category()){
		$page_category = get_query_var( 'cat' );
	}
	if ($page_category == "" && !is_category()) {
		$args = array(
			'parent' => 0
		);
		$categories = get_categories( $args );
	} else {
		$args = array(
			'parent' => $page_category
		);
		$categories = get_categories( $args );
	}
	if (count($categories) > 0) {	?>
		<div class="eltd-filter-blog-holder">
			<div class="eltd-filter-blog">
				<ul>
					<li class="eltd-filter eltd-active" data-filter="*"><span><?php esc_html_e('All', 'flow'); ?></span></li>
					<?php foreach ($categories as $category) { ?>
						<li class="eltd-filter" data-filter="<?php echo ".category-" . esc_attr($category->slug); ?>"><span><?php echo esc_html($category->name); ?></span></li>
					<?php } ?>
				</ul>
			</div>
		</div>
	<?php }
}
?>
