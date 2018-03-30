<?php
/**
 * @package 	WordPress
 * @subpackage 	EcoNature
 * @version		1.1.3
 * 
 * Template Name: Sitemap
 * Created by CMSMasters
 * 
 */


get_header();

$cmsms_option = cmsms_get_global_options();


list($cmsms_layout) = cmsms_theme_page_layout_scheme();


echo '<!--_________________________ Start Content _________________________ -->' . "\n";


if ($cmsms_layout == 'r_sidebar') {
	echo '<div class="content entry" role="main">' . "\n\t";
} elseif ($cmsms_layout == 'l_sidebar') {
	echo '<div class="content entry fr" role="main">' . "\n\t";
} else {
	echo '<div class="middle_content entry" role="main">' . "\n\t";
}

echo '<div class="cmsms_sitemap_wrap">' . "\n";


if (have_posts()) : the_post();
	$content_start = substr(get_post_field('post_content', get_the_ID()), 0, 10);
	
	
	if ($cmsms_layout == 'fullwidth' && $content_start === '[cmsms_row') {
		echo '</div>' . 
		'</section>';
	}
	
	
	the_content();
	
	echo '<div class="cl"></div>';
	
	
	if ($cmsms_layout == 'fullwidth' && $content_start === '[cmsms_row') {
		echo '<section class="content_wrap ' . $cmsms_layout . 
		((is_singular('project')) ? ' project_page' : '') . 
		((is_singular('profile')) ? ' profile_page' : '') . 
		'">' . "\n\n" . 
			'<div class="middle_content entry" role="main">' . "\n\t";
	}
	
	
	wp_link_pages(array( 
		'before' => '<div class="subpage_nav" role="navigation">' . '<strong>' . __('Pages', 'cmsmasters') . ':</strong>', 
		'after' => '</div>' . "\n", 
		'link_before' => ' [ ', 
		'link_after' => ' ] ' 
	));
endif;


if ($cmsms_option[CMSMS_SHORTNAME . '_sitemap_nav']) { 
	echo '<h1>' .  __('Website Pages', 'cmsmasters') . '</h1>';
	
	wp_nav_menu(array( 
		'theme_location' => 'primary', 
		'container' => '', 
		'sort_column' => 'menu_order', 
		'menu_class' => 'cmsms_sitemap navigation_menu' 
	));
}


if ($cmsms_option[CMSMS_SHORTNAME . '_sitemap_categs']) {
	echo '<div class="cmsms_divider solid"></div>' . 
	'<h1>' . __('Blog Archives by Categories', 'cmsmasters') . '</h1>' . 
	'<ul class="cmsms_sitemap_category">';
	
	wp_list_categories(array( 
		'title_li' => '', 
		'orderby' => 'name', 
		'order' => 'ASC' 
	));
	
	echo '</ul>';
}


if ($cmsms_option[CMSMS_SHORTNAME . '_sitemap_tags']) {
	$tags = get_tags(array( 
		'orderby' => 'name', 
		'order' => 'DESC' 
	));
	
	echo '<div class="cmsms_divider solid"></div>' . 
	'<h1>' . __('Blog Archives by Tags', 'cmsmasters') . '</h1>' . 
	'<ul class="cmsms_sitemap_archive">';
	
	foreach ((array) $tags as $tag) {
		echo '<li><a href="' . get_tag_link($tag->term_id) . '" rel="tag" title="' . $tag->name . '">' . $tag->name . '</a> (' . $tag->count . ')</li>';
	}
	
	echo '</ul>';
}


if ($cmsms_option[CMSMS_SHORTNAME . '_sitemap_month']) {
	echo '<div class="cmsms_divider solid"></div>' . 
	'<h1>' . __('Blog Archives by Month', 'cmsmasters') . '</h1>' . 
	'<ul class="cmsms_sitemap_archive">';
	
	wp_get_archives(array( 
		'show_post_count' => true, 
		'format' => 'custom', 
		'before' => '<li>', 
		'after' => '</li>' 
	));
	
	echo '</ul>';
}


if ($cmsms_option[CMSMS_SHORTNAME . '_sitemap_pj_categs']) {
	echo '<div class="cmsms_divider solid"></div>' . 
	'<h1>' . __('Portfolio Archives by Categories', 'cmsmasters') . '</h1>' . 
	'<ul class="cmsms_sitemap_category">';
	
	wp_list_categories(array( 
		'title_li' => '', 
		'orderby' => 'name', 
		'order' => 'ASC', 
		'taxonomy' => 'pj-categs' 
	));
	
	echo '</ul>';
}


if ($cmsms_option[CMSMS_SHORTNAME . '_sitemap_pj_tags']) {
	echo '<div class="cmsms_divider solid"></div>' . 
	'<h1>' . __('Portfolio Archives by Tags', 'cmsmasters') . '</h1>' . 
	'<ul class="cmsms_sitemap_archive">';
	
	wp_list_categories(array( 
		'title_li' => '', 
		'orderby' => 'name', 
		'order' => 'ASC', 
		'hierarchical' => false, 
		'taxonomy' => 'pj-tags' 
	));
	
	echo '</ul>';
}

echo '</div>' . "\n" . 
'</div>' . "\n" . 
'<!-- _________________________ Finish Content _________________________ -->' . "\n\n";


if ($cmsms_layout == 'r_sidebar') {
	echo "\n" . '<!-- _________________________ Start Sidebar _________________________ -->' . "\n" . 
	'<div class="sidebar" role="complementary">' . "\n";
	
	get_sidebar();
	
	echo "\n" . '</div>' . "\n" . 
	'<!-- _________________________ Finish Sidebar _________________________ -->' . "\n";
} elseif ($cmsms_layout == 'l_sidebar') {
	echo "\n" . '<!-- _________________________ Start Sidebar _________________________ -->' . "\n" . 
	'<div class="sidebar fl" role="complementary">' . "\n";
	
	get_sidebar();
	
	echo "\n" . '</div>' . "\n" . 
	'<!-- _________________________ Finish Sidebar _________________________ -->' . "\n";
}


get_footer();

