<?php get_header();
	$blog_style         = vpanel_options("home_display");
	$category_id        = esc_attr(get_query_var('cat'));
	$categories         = get_option("categories_$category_id");
	$cat_sidebar_layout = (isset($categories["cat_sidebar_layout"])?$categories["cat_sidebar_layout"]:"default");
	if ($cat_sidebar_layout == "default") {
		$vbegy_sidebar_all = vpanel_options("sidebar_layout");
	}else {
		$vbegy_sidebar_all = $cat_sidebar_layout;
	}
	$category_id          = esc_attr(get_query_var('cat'));
	$category             = get_category($category_id);
	$category_description = category_description();
	if (!empty($category_description)) {?>
		<article class="post clearfix">
			<div class="post-inner">
		        <h2 class="post-title"><?php echo esc_html__("Category","vbegy")." : ".esc_attr($category->cat_name);?></a></h2>
		        <div class="post-content">
		            <?php echo $category_description?>
		        </div><!-- End post-content -->
		    </div><!-- End post-inner -->
		</article><!-- End article.post -->
	<?php }
	get_template_part("loop","category");
	vpanel_pagination();
get_footer();?>