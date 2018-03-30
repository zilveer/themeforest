<?php
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0
 * 
 * Template Name: Blog
 * Created by CMSMasters
 * 
 */


get_header();


$cmsms_heading = get_post_meta(get_the_ID(), 'cmsms_heading', true);

$cmsms_layout = get_post_meta(get_the_ID(), 'cmsms_layout', true);

if (!$cmsms_layout) { 
    $cmsms_layout = 'r_sidebar'; 
}


$cmsms_page_order_type = get_post_meta(get_the_ID(), 'cmsms_page_order_type', true);
$cmsms_page_order = get_post_meta(get_the_ID(), 'cmsms_page_order', true);
$cmsms_page_items_number = get_post_meta(get_the_ID(), 'cmsms_page_items_number', true);
$cmsms_page_post_categ = get_post_meta(get_the_ID(), 'cmsms_page_post_categ', true);


echo '<!--_________________________ Start Content _________________________ -->' . "\n";


if ($cmsms_layout == 'r_sidebar') {
	echo '<section id="content" role="main">' . "\n\t";
} elseif ($cmsms_layout == 'l_sidebar') {
	echo '<section id="content" class="fr" role="main">' . "\n\t";
} else {
	echo '<section id="middle_content" role="main">' . "\n\t";
}


if (have_posts()) : the_post();
	echo '<div class="entry">' . "\n\t";
	
	if (has_post_thumbnail() && $cmsms_heading != 'parallax') {
		if ($cmsms_layout == 'r_sidebar' || $cmsms_layout == 'l_sidebar') {
			echo '<div class="cmsms_media">' . "\n\t";
			
			
			cmsms_thumb(get_the_ID(), 'post-thumbnail', false, 'img_' . get_the_ID(), true, false, true, true, false);
			
			
			echo "\r" . '</div>';
		} else {
			echo '<div class="cmsms_media">' . "\n\t";
			
			
			cmsms_thumb(get_the_ID(), 'full-thumb', false, 'img_' . get_the_ID(), true, false, true, true, false);
			
			
			echo "\r" . '</div>';
		}
	}
	
	echo '<div class="entry-content">' . "\n";
	
	the_content();
	
	
	wp_link_pages(array( 
		'before' => '<div class="subpage_nav" role="navigation">' . '<strong>' . __('Pages', 'cmsmasters') . ':</strong>', 
		'after' => '</div>' . "\n", 
		'link_before' => ' [ ', 
		'link_after' => ' ] ' 
	));
	
	echo '</div>' . "\n";
	
	cmsms_content_composer(get_the_ID());
	
	echo '</div>' . "\n";
endif;


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
	'post_type' => 'post', 
	'orderby' => $cmsms_page_order_type, 
	'order' => $cmsms_page_order, 
	'posts_per_page' => $cmsms_page_items_number, 
	'paged' => $paged, 
	'cat' => $cmsms_page_post_categ 
));


if ($wp_query->have_posts()) :
	echo "\t" . '<div class="entry-summary">' . "\n\t\t" . 
		'<section class="blog">' . "\n";
	
	
	while ($wp_query->have_posts()) : $wp_query->the_post();
		if ($cmsms_layout == 'fullwidth') {
			if (get_post_format() != '') {
				get_template_part('framework/postType/blog/page/fullwidth/' . get_post_format());
			} else {
				get_template_part('framework/postType/blog/page/fullwidth/standard');
			}
		} else { 
			if (get_post_format() != ''){
				get_template_part('framework/postType/blog/page/sidebar/' . get_post_format());
			} else {
				get_template_part('framework/postType/blog/page/sidebar/standard');   
			}
		}
	endwhile;
	
	
	pagination();
	
	
	echo "\t\t" . '</section>' . "\r\t" . 
	'</div>';
endif;


$wp_query = null;
$wp_query = $temp;


wp_reset_query();


comments_template();


echo "\r" . '</section>' . "\n" . 
'<!-- _________________________ Finish Content _________________________ -->' . "\n\n";


if ($cmsms_layout == 'r_sidebar') {
	echo "\n" . '<!-- _________________________ Start Sidebar _________________________ -->' . "\n" . 
	'<section id="sidebar" role="complementary">' . "\n";
	
	
	get_sidebar();
	
	
	echo "\n" . '</section>' . "\n" . 
	'<!-- _________________________ Finish Sidebar _________________________ -->' . "\n";
} elseif ($cmsms_layout == 'l_sidebar') {
	echo "\n" . '<!-- _________________________ Start Sidebar _________________________ -->' . "\n" . 
	'<section id="sidebar" class="fl" role="complementary">' . "\n";
	
	
	get_sidebar();
	
	
	echo "\n" . '</section>' . "\n" . 
	'<!-- _________________________ Finish Sidebar _________________________ -->' . "\n";
}


get_footer();

