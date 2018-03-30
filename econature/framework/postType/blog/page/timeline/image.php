<?php
/**
 * @package 	WordPress
 * @subpackage 	EcoNature
 * @version		1.0.0
 * 
 * Blog Page Timeline Image Post Format Template
 * Created by CMSMasters
 * 
 */


global $cmsms_metadata;


$cmsms_post_metadata = explode(',', $cmsms_metadata);

$date = (in_array('date', $cmsms_post_metadata) || is_home()) ? true : false;
$categories = (get_the_category() && (in_array('categories', $cmsms_post_metadata) || is_home())) ? true : false;
$author = (in_array('author', $cmsms_post_metadata) || is_home()) ? true : false;
$comments = (comments_open() && (in_array('comments', $cmsms_post_metadata) || is_home())) ? true : false;
$likes = (in_array('likes', $cmsms_post_metadata) || is_home()) ? true : false;
$tags = (get_the_tags() && (in_array('tags', $cmsms_post_metadata) || is_home())) ? true : false;
$more = (in_array('more', $cmsms_post_metadata) || is_home()) ? true : false;


$cmsms_post_image_link = get_post_meta(get_the_ID(), 'cmsms_post_image_link', true);

?>

<!--_________________________ Start Image Article _________________________ -->

<article id="post-<?php the_ID(); ?>" <?php post_class('cmsms_timeline_type'); ?>>
	<div class="cmsms_post_info entry-meta">
		<span class="cmsms_post_format_img cmsms-icon-photo"></span>
		
		<?php $date ? cmsms_post_date('page', 'default') : ''; ?>
	</div>
	<div class="cmsms_post_cont">
		<?php 
		if (!post_password_required()) {
			if ($cmsms_post_image_link != '') {
				cmsms_thumb(get_the_ID(), 'masonry-thumb', false, 'img_' . get_the_ID(), true, true, true, true, $cmsms_post_image_link);
			} elseif (has_post_thumbnail()) {
				cmsms_thumb(get_the_ID(), 'masonry-thumb', false, 'img_' . get_the_ID(), true, true, true, true, false);
			}
		}
		
		cmsms_post_heading(get_the_ID(), 'h1');
		
		if ($author || $categories || $tags) {
			echo '<div class="cmsms_post_cont_info entry-meta">';
			
				$author ? cmsms_post_author('page') : '';
				
				$categories ? cmsms_post_category('page') : '';
				
				$tags ? cmsms_post_tags('page') : '';
				
			echo '</div>';
		} 
		
		cmsms_post_exc_cont(); 
		
		if ($likes || $comments || $more) {
			echo '<footer class="cmsms_post_footer entry-meta">';
			
				if ($likes || $comments) {
					echo '<div class="cmsms_post_meta_info">';
					
						$likes ? cmsms_post_like('page') : '';
						
						$comments ? cmsms_post_comments('page') : '';
					
					echo '</div>';
				}
			
				$more ? cmsms_post_more(get_the_ID()) : '';
		
			echo '</footer>';
		}
		?>
		<div class="cl"></div>
	</div>
</article>
<!--_________________________ Finish Image Article _________________________ -->

