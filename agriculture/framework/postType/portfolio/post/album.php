<?php
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0
 * 
 * Portfolio Project Full Width Album Project Format Template
 * Created by CMSMasters
 * 
 */


$cmsms_option = cmsms_get_global_options();


$cmsms_project_featured_image_show = get_post_meta(get_the_ID(), 'cmsms_project_featured_image_show', true);

$cmsms_project_columns = get_post_meta(get_the_ID(), 'cmsms_project_columns', true);

$cmsms_project_features = get_post_meta(get_the_ID(), 'cmsms_project_features', true);

$cmsms_project_sharing_box = get_post_meta(get_the_ID(), 'cmsms_project_sharing_box', true);

$cmsms_project_pj_link_text = get_post_meta(get_the_ID(), 'cmsms_project_pj_link_text', true);

$cmsms_project_pj_link_url = get_post_meta(get_the_ID(), 'cmsms_project_pj_link_url', true);

$cmsms_project_pj_link_target = get_post_meta(get_the_ID(), 'cmsms_project_pj_link_target', true);

$cmsms_project_images = explode(',', str_replace(' ', '', str_replace('img_', '', get_post_meta(get_the_ID(), 'cmsms_project_images', true))));


if ($cmsms_project_columns == 'four' || $cmsms_project_columns == 'three') {
    $project_thumb = 'project-thumb';
} elseif ($cmsms_project_columns == 'two') {
    $project_thumb = 'project-thumb-half';
} else {
    $project_thumb = 'open-project-thumb';
}

$colnumb = 0;

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

<!--_________________________ Start Album Project _________________________ -->
<article id="post-<?php the_ID(); ?>" <?php post_class(array('format-album', 'cmsms_' . $cmsms_project_columns)); ?>>
<?php 
	echo '<div class="pj_content_bar' . (($pj_side_bar != '') ? ' with_pj_side_bar' : '') . '">';

	if (sizeof($cmsms_project_images) > 0 && $cmsms_project_images[0] != '') {
		echo '<div class="resize">';
		
		foreach ($cmsms_project_images as $cmsms_project_image) {
			$link_href = wp_get_attachment_image_src($cmsms_project_image, 'full');
			
			if ($cmsms_project_columns == 'one') { 
				if ($colnumb == 1) {
					echo '<div class="cl"></div></div><div class="resize">';
					
					$colnumb = 0;
				}
			} else if ($cmsms_project_columns == 'two') {
				if ($colnumb == 2) {
					echo '<div class="cl"></div></div><div class="resize">';
					
					$colnumb = 0;
				}
			} else if ($cmsms_project_columns == 'three') {
				if ($colnumb == 3) {
					echo '<div class="cl"></div></div><div class="resize">';
					
					$colnumb = 0;
				}
			} else if ($cmsms_project_columns == 'four') {
				if ($colnumb == 4) {
					echo '<div class="cl"></div></div><div class="resize">';
					
					$colnumb = 0;
				}
			}
			
			echo '<figure>' . 
				'<a href="' . $link_href[0] . '" data-group="img_' . get_the_ID() . '" title="' . cmsms_title(get_the_ID(), false) . '" class="preloader highImg jackbox">' . 
					wp_get_attachment_image($cmsms_project_image, $project_thumb, false, array( 
						'class' => 'fullwidth', 
						'alt' => cmsms_title(get_the_ID(), false), 
						'title' => cmsms_title(get_the_ID(), false) 
					)) . 
				'</a>' . 
			'</figure>';
			
			$colnumb++;
		}
		
		echo '<div class="cl"></div></div>';
	} elseif (sizeof($cmsms_project_images) == 1 && $cmsms_project_images[0] != '') {
		echo '<div class="resize">';
		
		cmsms_thumb(get_the_ID(), $project_thumb, false, 'img_' . get_the_ID(), true, true, true, true, $cmsms_project_images[0]);
		
		echo '</div>';
	} elseif (sizeof($cmsms_project_images) < 1 && has_post_thumbnail() && $cmsms_project_featured_image_show == 'true') {
		echo '<div class="resize">';
		
		cmsms_thumb(get_the_ID(), $project_thumb, false, 'img_' . get_the_ID(), true, true, true, true, false);
		
		echo '</div>';
	}
	
	echo '<div class="cl"></div>';
	
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
<!--_________________________ Finish Album Project _________________________ -->

