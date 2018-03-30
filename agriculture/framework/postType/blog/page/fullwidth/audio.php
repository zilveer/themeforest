<?php
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0
 * 
 * Blog Page Full Width Audio Post Format Template
 * Created by CMSMasters
 * 
 */

 
$cmsms_option = cmsms_get_global_options();
 

$cmsms_post_featured_image_show = get_post_meta(get_the_ID(), 'cmsms_post_featured_image_show', true);

$cmsms_post_audio_links = get_post_meta(get_the_ID(), 'cmsms_post_audio_links', true);

?>

<!--_________________________ Start Audio Article _________________________ -->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<span class="cmsms_post_format_img"></span>
		<?php cmsms_heading(get_the_ID()); ?>
	</header>
	<?php
	if (!post_password_required()) {
		if (has_post_thumbnail() && $cmsms_post_featured_image_show == 'true') {
			cmsms_thumb(get_the_ID(), 'full-thumb', true, false, true, false, true, true, false);
		}
		
		if (!empty($cmsms_post_audio_links) && sizeof($cmsms_post_audio_links) > 0) {
			foreach ($cmsms_post_audio_links as $cmsms_post_audio_link_url) {
				$audio_link[$cmsms_post_audio_link_url[0]] = $cmsms_post_audio_link_url[1];
			}
			
			echo '<div class="cmsms_blog_media">' . "\n" . 
				cmsmastersSingleAudioPlayer($audio_link) . "\r\t\t" . 
			'</div>' . "\r\t\t";
		}
	}
	
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
<!--_________________________ Finish Audio Article _________________________ -->

