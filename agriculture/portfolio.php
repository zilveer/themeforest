<?php
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0
 * 
 * Template Name: Portfolio
 * Created by CMSMasters
 * 
 */


get_header();


$cmsms_heading = get_post_meta(get_the_ID(), 'cmsms_heading', true);

$cmsms_page_project_type = get_post_meta(get_the_ID(), 'cmsms_page_project_type', true);
$cmsms_page_items_number = get_post_meta(get_the_ID(), 'cmsms_page_items_number', true);
$cmsms_page_order = get_post_meta(get_the_ID(), 'cmsms_page_order', true);
$cmsms_page_order_type = get_post_meta(get_the_ID(), 'cmsms_page_order_type', true);
$cmsms_page_full_columns = get_post_meta(get_the_ID(), 'cmsms_page_full_columns', true);

if (!$cmsms_page_full_columns) {
    $cmsms_page_full_columns = 'four_columns';
}


echo '<!--_________________________ Start Content _________________________ -->' . "\n" . 
'<section id="middle_content" role="main">' . "\n";


if (get_query_var('paged')) { 
	$paged = get_query_var('paged'); 
} elseif (get_query_var('page')) { 
	$paged = get_query_var('page'); 
} else { 
	$paged = 1; 
}


$temp = $wp_query;
$wp_query= null;


$wp_query = new WP_Query(array( 
	'post_type' => 'project', 
	'orderby' => $cmsms_page_order_type, 
	'order' => $cmsms_page_order, 
	'posts_per_page' => $cmsms_page_items_number, 
	'paged' => $paged, 
	'pj-categs' => $cmsms_page_project_type 
));


if ($wp_query->have_posts()) : 
	echo '<div class="entry-summary">' . "\n" . 
		'<section class="portfolio ' . $cmsms_page_full_columns . '">';
	
	while ($wp_query->have_posts()) : $wp_query->the_post();
		$cmsms_project_format = get_post_meta(get_the_ID(), 'cmsms_project_format', true);
		
		if (!$cmsms_project_format) { 
			$cmsms_project_format = 'slider'; 
		}
		
		get_template_part('framework/postType/portfolio/page/' . $cmsms_project_format);
	endwhile;
	
	echo '</section>' . "\n";
	
	pagination();
	
	echo '</div>' . "\n\t";
endif;


$wp_query = null;
$wp_query = $temp;


wp_reset_query();


if (have_posts()) : the_post();
	echo '<div class="entry">' . "\n\t";
	
	if (has_post_thumbnail() && $cmsms_heading != 'parallax') {
		echo '<div class="cmsms_media">' . "\n\t";
		
		cmsms_thumb(get_the_ID(), 'full-thumb', false, 'img_' . get_the_ID(), true, false, true, true, false);
		
		echo "\r" . '</div>';
	}
	
	the_content();
	
	wp_link_pages(array( 
		'before' => '<div class="subpage_nav" role="navigation">' . '<strong>' . __('Pages', 'cmsmasters') . ':</strong>', 
		'after' => '</div>' . "\n", 
		'link_before' => ' [ ', 
		'link_after' => ' ] ' 
	));
	
	cmsms_content_composer(get_the_ID());
	
	echo '</div>' . "\n";
endif;


if (comments_open()) {
	echo '<br />' . 
	'<div class="divider"></div>';
	
	comments_template();
}


echo '</section>' . "\n" . 
'<!-- _________________________ Finish Content _________________________ -->' . "\n\n";


get_footer();

