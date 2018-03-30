<?php get_header();
	$blog_style = vpanel_options("home_display");
	$vbegy_sidebar_all = vpanel_options("sidebar_layout");
	$tag_description   = tag_description();
	if (!empty($tag_description)) {?>
		<article class="post clearfix">
			<div class="post-inner">
		        <h2 class="post-title"><?php echo esc_html__("Tag","vbegy")." : ".esc_attr(single_tag_title("", false));?></a></h2>
		        <div class="post-content">
		            <?php echo $tag_description?>
		        </div><!-- End post-content -->
		    </div><!-- End post-inner -->
		</article><!-- End article.post -->
	<?php }
	get_template_part("loop","tag");
	vpanel_pagination();
get_footer();?>