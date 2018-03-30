<?php
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0
 * 
 * Template Name: Timeline Portfolio
 * Created by CMSMasters
 * 
 */


get_header();


$cmsms_heading = get_post_meta(get_the_ID(), 'cmsms_heading', true);

$cmsms_layout = get_post_meta(get_the_ID(), 'cmsms_layout', true);

if (!$cmsms_layout) { 
    $cmsms_layout = 'fullwidth';
}


echo '<!--_________________________ Start Content _________________________ -->' . "\n";

if ($cmsms_layout == 'r_sidebar') {
	echo '<section id="content" role="main">' . "\n";
} elseif ($cmsms_layout == 'l_sidebar') {
	echo '<section id="content" class="fr" role="main">' . "\n";
} else {
	echo '<section id="middle_content" role="main">' . "\n";
}


if (have_posts()) : the_post();
	echo '<div class="entry">' . "\n";
	
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


$timeline_query = new WP_Query(array( 
	'post_type' => 'project', 
	'orderby' => 'date', 
	'order' => 'DESC', 
	'posts_per_page' => -1 
));


$timeline_array = array();


if ($timeline_query->have_posts()) :
	while ($timeline_query->have_posts()) : $timeline_query->the_post();
		if (!array_key_exists(get_the_date('Y'), $timeline_array)) {
			$timeline_array[get_the_date('Y')] = array( 
				array( 
					get_permalink(get_the_ID()), 
					cmsms_title(get_the_ID(), false), 
					theme_excerpt(55, false),
					get_the_date('F j, Y'),
					get_the_post_thumbnail(get_the_ID(), 'thumbnail', array( 
						'alt' => cmsms_title(get_the_ID(), false), 
						'title' => cmsms_title(get_the_ID(), false), 
						'style' => 'width:100px; height:100px;' 
					))
				) 
			);
		} else {
			$timeline_array[get_the_date('Y')][] = array( 
				get_permalink(get_the_ID()), 
				cmsms_title(get_the_ID(), false), 
				theme_excerpt(55, false),
				get_the_date('F j, Y'),
				get_the_post_thumbnail(get_the_ID(), 'thumbnail', array( 
					'alt' => cmsms_title(get_the_ID(), false), 
					'title' => cmsms_title(get_the_ID(), false), 
					'style' => 'width:100px; height:100px;' 
				))
			);
		}
	endwhile;
endif;


wp_reset_query();


foreach ($timeline_array as $key => $values) {
	echo '<h3 class="cmsms_timeline_title">' . $key . '</h3>' . "\n" . 
	'<div class="cmsms_timeline">' . "\n";
	
	foreach ($values as $value) {
		echo '<article>' . 
			'<header class="entry-header cmsms_timeline_header">' . 
				'<abbr class="published cmsms_timeline_date">' . $value[3] . '</abbr>' .
				'<h4 class="entry-title">' . 
					'<a href="' . $value[0] . '">' . $value[1] . '</a>' .
				'</h4>' . 
				'<div class="cl"></div>' . 
			'</header>' . 
			'<div class="cmsms_timeline_content">';
				if ($value[4] != '') {
					echo '<figure class="alignleft">' . $value[4] . '</figure>';
				}
				echo '<div class="entry-content">' . $value[2] . '</div>' . 
			'</div>' . 
		'</article>' . "\n";
	}
	
	echo '</div>';
}


echo '</section>' . "\n" . 
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

