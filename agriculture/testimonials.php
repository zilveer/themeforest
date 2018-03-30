<?php
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0
 * 
 * Template Name: Testimonials
 * Created by CMSMasters
 * 
 */


$cmsms_option = cmsms_get_global_options(); 
 

get_header();


$cmsms_heading = get_post_meta(get_the_ID(), 'cmsms_heading', true);

$cmsms_layout = get_post_meta(get_the_ID(), 'cmsms_layout', true);

if (!$cmsms_layout) { 
    $cmsms_layout = 'r_sidebar'; 
}


$cmsms_page_order = get_post_meta(get_the_ID(), 'cmsms_page_order', true);

$cmsms_page_items_number = get_post_meta(get_the_ID(), 'cmsms_page_items_number', true);

$cmsms_page_tl_categ = get_post_meta(get_the_ID(), 'cmsms_page_tl_categ', true);


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
	'post_type' => 'testimonial', 
	'order' => $cmsms_page_order, 
	'posts_per_page' => $cmsms_page_items_number, 
	'paged' => $paged, 
	'tl-categs' => $cmsms_page_tl_categ 
));


if ($wp_query->have_posts()) : 
	echo '<div class="entry-summary">' . "\n" . 
		'<section class="testimonials">' . "\n";
	
	while ($wp_query->have_posts()) : $wp_query->the_post();
?>

<!--_________________________ Start Aside Article _________________________ -->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php 
	$cmsms_testimonial_author = get_post_meta(get_the_ID(), 'cmsms_testimonial_author', true);
	
	$cmsms_testimonial_author_link = get_post_meta(get_the_ID(), 'cmsms_testimonial_author_link', true);
	
	$cmsms_testimonial_company = get_post_meta(get_the_ID(), 'cmsms_testimonial_company', true);
	
	
	echo '<div class="tl-content_wrap">' .  "\n\t\t";
		if ($cmsms_option[CMSMS_SHORTNAME . '_testimonial_page_author_avatar'] && has_post_thumbnail()) {
			echo '<figure class="tl_author_img">' . 
				get_the_post_thumbnail(get_the_ID(), 'thumbnail', array( 
					'alt' => cmsms_title(get_the_ID(), false), 
					'title' => cmsms_title(get_the_ID(), false), 
					'style' => 'width:125px; height:125px;' 
				)) . 
			'</figure>' . "\n";
		} else {
			echo '';
		}
		
		echo '<div class="tl-content">' . 
			'<blockquote>' . 
				'<p>' . theme_excerpt(60, false) . '</p>' . 
			'</blockquote>' .  "\r\t";
			
			if ($cmsms_option[CMSMS_SHORTNAME . '_testimonial_page_author_descr'] && ($cmsms_testimonial_author != '' || $cmsms_testimonial_company != '')) {
				echo '<div class="tl_author_info">';
				if ( 
					$cmsms_testimonial_author != '' && 
					$cmsms_testimonial_author_link != '' 
				) {
					echo '<p class="tl_author"><a target="_blank" href="' . $cmsms_testimonial_author_link . '">' . $cmsms_testimonial_author . '</a></p>' . "\n";
				} elseif ($cmsms_testimonial_author != '') {
					echo '<p class="tl_author">' . $cmsms_testimonial_author . '</p>' . "\n";
				}
				
				if ($cmsms_testimonial_company != '') {
					if ($cmsms_testimonial_author != '') {
						echo ' / ';
					}
					echo '<p class="tl_company">' . $cmsms_testimonial_company . '</p>' . "\n";
				}
				echo '</div>';
			}
		
		echo '</div>' . 
	'</div>' . "\n";
	
	if (
		$cmsms_option[CMSMS_SHORTNAME . '_testimonial_page_more'] || 
		$cmsms_option[CMSMS_SHORTNAME . '_testimonial_page_date'] || 
		$cmsms_option[CMSMS_SHORTNAME . '_testimonial_page_comment'] || 
		$cmsms_option[CMSMS_SHORTNAME . '_testimonial_page_cat']
	) {
		echo '<div class="tl_info">';
	
		cmsms_more(get_the_ID(), 'testimonial');
	
		cmsms_post_date('testimonial', 'page');
		
		cmsms_comments('page', 'testimonial');
	
		cmsms_tl_cat(get_the_ID(), 'tl-categs', 'page');
		
		echo '</div>';
	}
?>
</article>
<!--_________________________ Finish Testimonial Article _________________________ -->

<?php
	endwhile;
	
	
	echo '</section>' . "\n";
	
	
	pagination();
	
	
	echo '</div>' . "\n\t";
endif;


$wp_query = null;
$wp_query = $temp;


wp_reset_query();


if (comments_open()) {
	echo '<br />' . 
	'<div class="divider"></div>';
	
	comments_template();
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

