<?php
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0
 * 
 * Portfolio Project Full Width Video Project Format Template
 * Created by CMSMasters
 * 
 */


$cmsms_option = cmsms_get_global_options();


$cmsms_project_featured_image_show = get_post_meta(get_the_ID(), 'cmsms_project_featured_image_show', true);

$cmsms_project_features = get_post_meta(get_the_ID(), 'cmsms_project_features', true);

$cmsms_project_sharing_box = get_post_meta(get_the_ID(), 'cmsms_project_sharing_box', true);

$cmsms_project_pj_link_text = get_post_meta(get_the_ID(), 'cmsms_project_pj_link_text', true);

$cmsms_project_pj_link_url = get_post_meta(get_the_ID(), 'cmsms_project_pj_link_url', true);

$cmsms_project_pj_link_target = get_post_meta(get_the_ID(), 'cmsms_project_pj_link_target', true);

$cmsms_project_video_type = get_post_meta(get_the_ID(), 'cmsms_project_video_type', true);

$cmsms_project_video_link = get_post_meta(get_the_ID(), 'cmsms_project_video_link', true);

$cmsms_project_video_links = get_post_meta(get_the_ID(), 'cmsms_project_video_links', true);

$pj_side_bar = '';

if (
	$cmsms_option[CMSMS_SHORTNAME . '_portfolio_project_like'] || 
	$cmsms_option[CMSMS_SHORTNAME . '_portfolio_project_date'] || 
	$cmsms_option[CMSMS_SHORTNAME . '_portfolio_project_cat'] || 
	$cmsms_option[CMSMS_SHORTNAME . '_portfolio_project_author'] || 
	$cmsms_option[CMSMS_SHORTNAME . '_portfolio_project_comment'] || 
	$cmsms_option[CMSMS_SHORTNAME . '_portfolio_project_tag'] || 
	(
		count($cmsms_project_features) > 1 || 
		(
			count($cmsms_project_features) == 1 && 
			!empty($cmsms_project_features[1][0]) && 
			!empty($cmsms_project_features[1][1])
		)
	) || 
	$cmsms_option[CMSMS_SHORTNAME . '_portfolio_project_link'] || 
	$cmsms_project_sharing_box == 'true'
) {
	$pj_side_bar = 'true';
}

?>

<!--_________________________ Start Video Project _________________________ -->
<article id="post-<?php the_ID(); ?>" <?php post_class('format-video'); ?>>
<?php 
	echo '<div class="pj_content_bar' . (($pj_side_bar != '') ? ' with_pj_side_bar' : '') . '">' . "\n" . 
		'<div class="resize">';
		
		if ($cmsms_project_video_type == 'selfhosted' && !empty($cmsms_project_video_links) && sizeof($cmsms_project_video_links) > 0) {
			foreach ($cmsms_project_video_links as $cmsms_project_video_link_url) {
				$video_link[$cmsms_project_video_link_url[0]] = $cmsms_project_video_link_url[1];
			}
			
			if (has_post_thumbnail()) {
				$poster = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'open-project-thumb');
				
				$video_link['poster'] = $poster[0];
			}
			
			echo '<div class="cmsms_blog_media">' . 
				cmsmastersSingleVideoPlayer($video_link) . 
			'</div>';
		} elseif ($cmsms_project_video_type == 'embeded' && $cmsms_project_video_link != '') {
			echo '<div class="cmsms_blog_media">' . 
				'<div class="resizable_block">' . 
					get_video_iframe($cmsms_project_video_link) . 
				'</div>' . 
			'</div>';
		} else if (has_post_thumbnail() && $cmsms_project_featured_image_show == 'true') {
			cmsms_thumb(get_the_ID(), 'open-project-thumb', true, false, true, false, true, true, false);
		}
		
		echo '</div>';
		
		if ($cmsms_option[CMSMS_SHORTNAME . '_portfolio_project_title']) {
			cmsms_heading_nolink(get_the_ID(), true, 'h2');
		}
		
		echo '<div class="entry-content">' . "\n";
	
		the_content();
		
		wp_link_pages(array( 
			'before' => '<div class="subpage_nav" role="navigation">' . '<strong>' . __('Pages', 'cmsmasters') . ':</strong>', 
			'after' => '</div>' . "\n", 
			'link_before' => ' [ ', 
			'link_after' => ' ] ' 
		));
		
		cmsms_content_composer(get_the_ID());
		
		echo "\t\t" . '</div>' . "\n" . 
	'</div>';
	
	if ($pj_side_bar != '') {
		echo '<footer class="pj_side_bar entry-meta">';
			echo '<h4>' . __('Project details', 'cmsmasters') . '</h4>';
		
			cmsms_pj_like();
			
			cmsms_pj_date();
			
			cmsms_pj_cat(get_the_ID(), 'pj-sort-categs', 'post');
			
			cmsms_pj_author();
			
			cmsms_pj_comments();
			
			cmsms_pj_tag(get_the_ID(), 'pj-tags', 'post');
			
			foreach ($cmsms_project_features as $cmsms_project_feature) {
				if ($cmsms_project_feature[0] != '' && $cmsms_project_feature[1] != '') {
					$cmsms_project_feature_lists = explode("\n", $cmsms_project_feature[1]);
					
					echo '<div>' . 
						'<p>' . $cmsms_project_feature[0] . '</p>' . 
						'<div class="cmsms_details_links">';
					
					foreach ($cmsms_project_feature_lists as $cmsms_project_feature_list) {
						echo trim($cmsms_project_feature_list);
					}
					
					echo '</div>' . 
					'</div>' . "\n\t\t\t";
				}
			}
			
			if ( 
				$cmsms_option[CMSMS_SHORTNAME . '_portfolio_project_link'] && 
				$cmsms_project_pj_link_text != '' && 
				$cmsms_project_pj_link_url != '' 
			) {
				echo '<div class="pj_link">' . 
					'<p>' . __('Project Link', 'cmsmasters') . '</p>' . 
					'<div class="cmsms_details_links">' . 
						'<a href="' . $cmsms_project_pj_link_url . '" title="' . $cmsms_project_pj_link_text . '"' . (($cmsms_project_pj_link_target == 'true') ? ' target="_blank"' : '') . '>' . $cmsms_project_pj_link_text . '</a>' . 
					'</div>' . 
				'</div>';
			}
			
			cmsms_pj_share(get_the_ID());
		
		echo '</footer>';
	}
	?>
	<div class="cl"></div>
</article>
<!--_________________________ Finish Video Project _________________________ -->

