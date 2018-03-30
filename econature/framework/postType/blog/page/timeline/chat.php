<?php
/**
 * @package 	WordPress
 * @subpackage 	EcoNature
 * @version		1.0.0
 * 
 * Blog Page Timeline Chat Post Format Template
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
 
?>

<!--_________________________ Start Chat Article _________________________ -->

<article id="post-<?php the_ID(); ?>" <?php post_class('cmsms_timeline_type'); ?>>
	<div class="cmsms_post_info entry-meta">
		<span class="cmsms_post_format_img cmsms-icon-star-7"></span>
		
		<?php $date ? cmsms_post_date('page', 'default') : ''; ?>
	</div>
	<div class="cmsms_post_cont">
		<?php
		cmsms_post_format_chat();
		
		
		echo '<h1 class="entry-title dn">' . cmsms_title(get_the_ID(), false) . '</h1>';
		
		
		if ($likes || $comments || $author || $categories || $tags) {
			echo '<footer class="cmsms_post_footer entry-meta">';
				
				if ($likes || $comments) {
					echo '<div class="cmsms_post_meta_info">';
						
						$likes ? cmsms_post_like('page') : '';
						
						$comments ? cmsms_post_comments('page') : '';
						
					echo '</div>';
				}
				
				
				if ($author || $categories || $tags) {
					echo '<div class="cmsms_post_cont_info">';
					
						$author ? cmsms_post_author('page') : '';
					
						$categories ? cmsms_post_category('page') : '';
						
						$tags ? cmsms_post_tags('page') : '';
						
					echo '</div>';
				}
				
			echo '</footer>';
		}
		?>
		<div class="cl"></div>
	</div>
</article>
<!--_________________________ Finish Chat Article _________________________ -->

