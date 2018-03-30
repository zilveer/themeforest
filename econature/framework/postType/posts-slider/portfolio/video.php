<?php
/**
 * @package 	WordPress
 * @subpackage 	EcoNature
 * @version		1.0.0
 * 
 * Posts Slider Video Project Format Template
 * Created by CMSMasters
 * 
 */


global $cmsms_project_metadata;


$cmsms_metadata = explode(',', $cmsms_project_metadata);

$title = in_array('title', $cmsms_metadata) ? true : false;
$excerpt = in_array('excerpt', $cmsms_metadata) ? true : false;
$categories = (get_the_terms(get_the_ID(), 'pj-categs') && in_array('categories', $cmsms_metadata)) ? true : false;
$comments = (comments_open() && in_array('comments', $cmsms_metadata)) ? true : false;
$likes = in_array('likes', $cmsms_metadata) ? true : false;

$cmsms_project_link_url = get_post_meta(get_the_ID(), 'cmsms_project_link_url', true);
$cmsms_project_link_redirect = get_post_meta(get_the_ID(), 'cmsms_project_link_redirect', true);


$cmsms_project_video_type = get_post_meta(get_the_ID(), 'cmsms_project_video_type', true);

$cmsms_project_video_link = get_post_meta(get_the_ID(), 'cmsms_project_video_link', true);

$cmsms_project_video_links = get_post_meta(get_the_ID(), 'cmsms_project_video_links', true);

?>

<!--_________________________ Start Video Project _________________________ -->

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="slider_project_outer">
	<?php 
		cmsms_thumb_rollover(get_the_ID(), 'project-thumb', true, true, true, false, $cmsms_project_video_type, $cmsms_project_video_link, $cmsms_project_video_links, false, true, $cmsms_project_link_redirect, $cmsms_project_link_url);
		
		
		if ($title || $categories || $excerpt || $likes || $comments) {
			echo '<div class="slider_project_inner">';
			
				($title) ? cmsms_slider_post_heading(get_the_ID(), 'project', 'h3', true, $cmsms_project_link_redirect, $cmsms_project_link_url) : '';
				
				if ($categories) {
					echo '<div class="cmsms_slider_project_cont_info entry-meta">';
					
						cmsms_slider_post_category('project', get_the_ID(), 'pj-categs');
						
					echo '</div>';
				}
				
				($excerpt) ? cmsms_slider_post_exc_cont('project') : '';
				
				if ($likes || $comments) {
					echo '<footer class="cmsms_slider_project_footer entry-meta">';
					
						($likes) ? cmsms_slider_post_like('project') : '';
						
						($comments) ? cmsms_slider_post_comments('project') : '';
						
					echo '</footer>';
				}
			
			echo '</div>';
		}
	?>
		<div class="cl"></div>
	</div>
</article>
<!--_________________________ Finish Video Project _________________________ -->

