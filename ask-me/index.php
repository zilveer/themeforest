<?php get_header();
	$vbegy_sidebar_all = vpanel_options("sidebar_layout");
	$blog_style = vpanel_options("home_display");
	get_template_part("loop","index");
	vpanel_pagination();
get_footer();?>