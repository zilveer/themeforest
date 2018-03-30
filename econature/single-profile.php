<?php
/**
 * @package 	WordPress
 * @subpackage 	EcoNature
 * @version		1.0.0
 * 
 * Single Profile Template
 * Created by CMSMasters
 * 
 */


$cmsms_option = cmsms_get_global_options();


get_header();


$cmsms_profile_sharing_box = get_post_meta(get_the_ID(), 'cmsms_profile_sharing_box', true);


echo '<!--_________________________ Start Content _________________________ -->' . "\n" . 

'<div class="middle_content entry" role="main">' . "\n\t";


if (have_posts()) : the_post();
	echo '<div class="profiles opened-article">' . "\n";
	
	
	get_template_part('framework/postType/profile/post/standard');

	
	if ($cmsms_option[CMSMS_SHORTNAME . '_profile_post_nav_box']) {
		cmsms_prev_next_posts();
	}
	
	
	if ($cmsms_profile_sharing_box == 'true') {
		cmsms_sharing_box(__('Share this profile?', 'cmsmasters'), 'h3');
	}

	comments_template(); 
	
	echo '</div>';
endif;

echo '</div>' . "\n" . 
'<!-- _________________________ Finish Content _________________________ -->' . "\n\n";


get_footer();

