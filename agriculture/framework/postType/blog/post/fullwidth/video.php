<?php
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0
 * 
 * Blog Post Full Width Video Post Format Template
 * Created by CMSMasters
 * 
 */


$cmsms_option = cmsms_get_global_options();


$cmsms_post_video_type = get_post_meta(get_the_ID(), 'cmsms_post_video_type', true);

$cmsms_post_video_link = get_post_meta(get_the_ID(), 'cmsms_post_video_link', true);

$cmsms_post_video_links = get_post_meta(get_the_ID(), 'cmsms_post_video_links', true);

?>

<!--_________________________ Start Video Article _________________________ -->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		if (!post_password_required()) {
			if ($cmsms_post_video_type == 'selfhosted' && !empty($cmsms_post_video_links) && sizeof($cmsms_post_video_links) > 0) {
				foreach ($cmsms_post_video_links as $cmsms_post_video_link_url) {
					$video_link[$cmsms_post_video_link_url[0]] = $cmsms_post_video_link_url[1];
				}
				
				if (has_post_thumbnail()) {
					$poster = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full-thumb');
					
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
	<?php
		if ($cmsms_option[CMSMS_SHORTNAME . '_blog_post_title']) {
			echo cmsms_heading_nolink(get_the_ID(), false) . "\n";
		}
	?>
	</header>
	<?php 
	if (
		$cmsms_option[CMSMS_SHORTNAME . '_blog_post_like'] || 
		$cmsms_option[CMSMS_SHORTNAME . '_blog_post_date'] || 
		$cmsms_option[CMSMS_SHORTNAME . '_blog_post_comment'] || 
		$cmsms_option[CMSMS_SHORTNAME . '_blog_post_cat'] || 
		$cmsms_option[CMSMS_SHORTNAME . '_blog_post_author']
	) {
		echo '<footer class="entry-meta">';
			
			cmsms_post_like('post', 'post');
		
			cmsms_post_date('post', 'post');
			
			if (!post_password_required()) {
				cmsms_comments('post', 'post');
			}
			
			cmsms_meta('post', 'post');
			
		echo '</footer>';
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
	'<div class="cl"></div>';
	
	cmsms_tags(get_the_ID(), 'post', 'post'); 
	?>
</article>
<!--_________________________ Finish Video Article _________________________ -->

