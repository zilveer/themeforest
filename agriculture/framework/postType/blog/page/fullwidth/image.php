<?php
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0
 * 
 * Blog Page Full Width Image Post Format Template
 * Created by CMSMasters
 * 
 */

 
$cmsms_option = cmsms_get_global_options(); 


$cmsms_post_featured_image_show = get_post_meta(get_the_ID(), 'cmsms_post_featured_image_show', true);

$cmsms_post_image_link = get_post_meta(get_the_ID(), 'cmsms_post_image_link', true);

?>

<!--_________________________ Start Image Article _________________________ -->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		if (!post_password_required()) {
			if ($cmsms_post_featured_image_show == 'true' && has_post_thumbnail()) {
				cmsms_thumb(get_the_ID(), 'full-thumb', false, 'img_' . get_the_ID(), true, true, true, true, false);
			} elseif ($cmsms_post_image_link != '' && $cmsms_post_image_link != get_template_directory_uri() . '/framework/admin/inc/img/image.png') {
				cmsms_thumb(get_the_ID(), 'full-thumb', false, 'img_' . get_the_ID(), true, true, true, true, $cmsms_post_image_link);
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
<!--_________________________ Finish Image Article _________________________ -->

