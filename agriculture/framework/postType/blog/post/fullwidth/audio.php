<?php
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0
 * 
 * Blog Post Full Width Audio Post Format Template
 * Created by CMSMasters
 * 
 */


$cmsms_option = cmsms_get_global_options();


$cmsms_heading = get_post_meta(get_the_ID(), 'cmsms_heading', true);

$cmsms_post_featured_image_show = get_post_meta(get_the_ID(), 'cmsms_post_featured_image_show', true);

$cmsms_post_audio_links = get_post_meta(get_the_ID(), 'cmsms_post_audio_links', true);

?>

<!--_________________________ Start Audio Article _________________________ -->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<span class="cmsms_post_format_img"></span>
	<?php
		if ($cmsms_option[CMSMS_SHORTNAME . '_blog_post_title']) {
			echo cmsms_heading_nolink(get_the_ID(), false) . "\n";
		}
	?>
	</header>
	<?php
	if (!post_password_required()) {
		if (has_post_thumbnail() && $cmsms_post_featured_image_show == 'true' && $cmsms_heading != 'parallax') {
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
<!--_________________________ Finish Audio Article _________________________ -->

