<?php get_header();
	$blog_style = vpanel_options("home_display");
	$vbegy_sidebar_all = vpanel_options('sidebar_layout');
	get_template_part("loop","archive");
	vpanel_pagination();
get_footer();?>