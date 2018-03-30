<?php
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0
 * 
 * Blog Page with Sidebar Video Post Format Template
 * Created by CMSMasters
 * 
 */


$cmsms_option = cmsms_get_global_options();
 
 
$cmsms_post_video_type = get_post_meta(get_the_ID(), 'cmsms_post_video_type', true);

$cmsms_post_video_link = get_post_meta(get_the_ID(), 'cmsms_post_video_link', true);

$cmsms_post_video_links = get_post_meta(get_the_ID(), 'cmsms_post_video_links', true);

$cmsms_post_featured_image_show = get_post_meta(get_the_ID(), 'cmsms_post_featured_image_show', true);

?>

<!--_________________________ Start Video Article _________________________ -->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		if (!post_password_required()) {
			if ($cmsms_post_featured_image_show == 'true' && has_post_thumbnail()) {
				cmsms_thumb(get_the_ID(), 'post-thumbnail', true, false, true, false, true, true, false);
			} elseif ($cmsms_post_video_type == 'selfhosted' && !empty($cmsms_post_video_links) && sizeof($cmsms_post_video_links) > 0) {
				foreach ($cmsms_post_video_links as $cmsms_post_video_link_url) {
					$video_link[$cmsms_post_video_link_url[0]] = $cmsms_post_video_link_url[1];
				}
				
				if (has_post_thumbnail()) {
					$poster = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'post-thumbnail');
					
					$video_link['poster'] = $poster[0];
				}
				
				echo '<div class="cmsms_blog_media">' . "\n" . 
					cmsmastersSingleVideoPlayer($video_link) . "\r\t\t" . 
				'</div>' . "\r\t\t";
			} elseif ($cmsms_post_video_type == 'embeded' && $cmsms_post_video_link != '') {
				echo '<div class="cmsms_blog_media">' . "\n\t\t\t" . 
					'<div class="resizable_block">' . "\n\t\t\t\t" . 
						get_video_iframe($cmsms_post_video_link) . "\r\t\t\t" . 
					'</div>' . "\r\t\t" . 
				'</div>' . "\r\t\t";
			}
		}
	?>
	<header class="entry-header">
		<span class="cmsms_post_format_img"></span>
		<?php cmsms_heading(get_the_ID()); ?>
	</header>
	<?php 
	if (
		$cmsms_option[CMSMS_SHORTNAME . '_blog_page_like'] || 
		$cmsms_option[CMSMS_SHORTNAME . '_blog_page_date'] || 
		$cmsms_option[CMSMS_SHORTNAME . '_blog_page_comment'] || 
		$cmsms_option[CMSMS_SHORTNAME . '_blog_page_cat'] || 
		$cmsms_option[CMSMS_SHORTNAME . '_blog_page_author']
	) {
		echo '<footer class="entry-meta">';
			
			cmsms_post_like('post', 'page');
		
			cmsms_post_date('post', 'page');
			
			if (!post_password_required()) {
				cmsms_comments('page', 'post');
			}
			
			cmsms_meta('post', 'page');
			
		echo '</footer>';
	}
	
	cmsms_exc_cont();
	
	echo '<div class="cl"></div>';
	
	cmsms_more(get_the_ID(), 'post');
	
	cmsms_tags(get_the_ID(), 'post', 'page'); 
	?>
</article>
<!--_________________________ Finish Video Article _________________________ -->

