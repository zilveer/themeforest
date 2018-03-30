<?php
/**
 * @package 	WordPress
 * @subpackage 	EcoNature
 * @version		1.0.0
 * 
 * Blog Post with Sidebar Image Post Format Template
 * Created by CMSMasters
 * 
 */


$cmsms_option = cmsms_get_global_options();


$cmsms_post_title = get_post_meta(get_the_ID(), 'cmsms_post_title', true);

$cmsms_post_image_link = get_post_meta(get_the_ID(), 'cmsms_post_image_link', true);

?>

<!--_________________________ Start Image Article _________________________ -->

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php 
	if (!post_password_required()) {
		if ($cmsms_post_image_link != '') {
			cmsms_thumb(get_the_ID(), 'masonry-thumb', false, 'img_' . get_the_ID(), true, true, true, true, $cmsms_post_image_link);
		} elseif (has_post_thumbnail()) {
			cmsms_thumb(get_the_ID(), 'masonry-thumb', false, 'img_' . get_the_ID(), true, true, true, true, false);
		}
	}
	
	
	if ($cmsms_post_title == 'true') {
		echo '<header class="cmsms_post_header entry-header">' . 
			'<span class="cmsms_post_format_img cmsms-icon-photo"></span>';
			cmsms_post_title_nolink(get_the_ID(), 'h1');
		echo '</header>';
	}
	
	
	echo '<div class="cmsms_post_content entry-content">' . "\n";
		
		the_content();
		
		wp_link_pages(array( 
			'before' => '<div class="subpage_nav" role="navigation">' . '<strong>' . __('Pages', 'cmsmasters') . ':</strong>', 
			'after' => '</div>', 
			'link_before' => ' [ ', 
			'link_after' => ' ] ' 
		));
		
		echo '<div class="cl"></div>' . 
	'</div>';
	
	
	if (
		$cmsms_option[CMSMS_SHORTNAME . '_blog_post_date'] || 
		$cmsms_option[CMSMS_SHORTNAME . '_blog_post_like'] || 
		$cmsms_option[CMSMS_SHORTNAME . '_blog_post_comment'] || 
		$cmsms_option[CMSMS_SHORTNAME . '_blog_post_author'] || 
		$cmsms_option[CMSMS_SHORTNAME . '_blog_post_cat'] || 
		$cmsms_option[CMSMS_SHORTNAME . '_blog_post_tag']
	) {
		echo '<footer class="cmsms_post_footer entry-meta">';
			if (
				$cmsms_option[CMSMS_SHORTNAME . '_blog_post_date'] || 
				$cmsms_option[CMSMS_SHORTNAME . '_blog_post_like'] || 
				$cmsms_option[CMSMS_SHORTNAME . '_blog_post_comment']
			) {
				echo '<div class="cmsms_post_meta_info">';
				
					cmsms_post_date('post');
				
					cmsms_post_like('post');
					
					cmsms_post_comments('post');
				
				echo '</div>';
			}
			
			
			if (
				$cmsms_option[CMSMS_SHORTNAME . '_blog_post_author'] || 
				$cmsms_option[CMSMS_SHORTNAME . '_blog_post_cat'] || 
				$cmsms_option[CMSMS_SHORTNAME . '_blog_post_tag']
			) {
				echo '<div class="cmsms_post_cont_info">';
				
					cmsms_post_author('post');
					
					cmsms_post_category('post');
					
					cmsms_post_tags('post');
				
				echo '</div>';
			}
		echo '</footer>';
	}
	?>
</article>
<!--_________________________ Finish Image Article _________________________ -->

