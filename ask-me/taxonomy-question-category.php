<?php get_header();
	$vbegy_sidebar_all   = vpanel_options("sidebar_layout");
	$tax_id               = get_term_by('slug',get_query_var('term'),$taxonomy);
	$tax_id               = $tax_id->term_id;
	$category             = get_term_by('slug',esc_attr(get_query_var('term')),esc_attr(get_query_var('taxonomy')));
	$category_description = category_description();
	if (!empty($category_description)) {?>
		<article class="post clearfix">
			<div class="post-inner">
		        <h2 class="post-title"><?php echo esc_html__("Category","vbegy")." : ".esc_attr(single_cat_title("",false));?></a></h2>
		        <div class="post-content">
		            <?php echo $category_description?>
		        </div><!-- End post-content -->
		    </div><!-- End post-inner -->
		</article><!-- End article.post -->
	<?php }
	
	get_template_part("loop-question","category");
	vpanel_pagination();
get_footer();?>