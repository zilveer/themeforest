<?php
/**
 * @package 	WordPress
 * @subpackage 	EcoNature
 * @version		1.0.0
 * 
 * Single Project Template
 * Created by CMSMasters
 * 
 */


$cmsms_option = cmsms_get_global_options();


get_header();


$project_tags = get_the_terms(get_the_ID(), 'pj-tags');


$cmsms_project_author_box = get_post_meta(get_the_ID(), 'cmsms_project_author_box', true);
$cmsms_project_more_posts = get_post_meta(get_the_ID(), 'cmsms_project_more_posts', true);


echo '<!--_________________________ Start Content _________________________ -->' . "\n" . 

'<div class="middle_content entry" role="main">' . "\n\t";

if (have_posts()) : the_post();
	echo '<div class="portfolio opened-article">' . "\n";
	
	if (get_post_format() != '') {
		get_template_part('framework/postType/portfolio/post/' . get_post_format());
	} else {
		get_template_part('framework/postType/portfolio/post/standard');
	}
	
	
	if ($cmsms_option[CMSMS_SHORTNAME . '_portfolio_project_nav_box']) {
		cmsms_prev_next_posts();
	}
	
	
	if ($cmsms_project_author_box == 'true') {
		cmsms_author_box(__('About author', 'cmsmasters'), 'h3');
	}
	
	
	if ($project_tags) {
		$tgsarray = array();
		
		foreach ($project_tags as $tagone) {
			$tgsarray[] = $tagone->term_id;
		}  
	} else {
		$tgsarray = '';
	}
	
	
	if (is_array($cmsms_project_more_posts)) {
		cmsms_related( 
			'h3', 
			in_array('related', $cmsms_project_more_posts), 
			$tgsarray, 
			in_array('popular', $cmsms_project_more_posts), 
			in_array('recent', $cmsms_project_more_posts), 
			$cmsms_option[CMSMS_SHORTNAME . '_portfolio_project_r_p_l_number'], 
			'project', 
			'pj-tags' 
		);
	}
	
	comments_template(); 
	
	echo '</div>';
endif;

echo '</div>' . "\n" . 
'<!-- _________________________ Finish Content _________________________ -->' . "\n\n";


get_footer();

