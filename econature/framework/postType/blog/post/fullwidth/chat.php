<?php
/**
 * @package 	WordPress
 * @subpackage 	EcoNature
 * @version		1.0.0
 * 
 * Blog Post Full Width Chat Post Format Template
 * Created by CMSMasters
 * 
 */


$cmsms_option = cmsms_get_global_options();

?>

<!--_________________________ Start Chat Article _________________________ -->

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="cmsms_post_cont">
		<span class="cmsms_post_format_img cmsms-icon-star-7"></span>
		<?php 
		cmsms_post_format_chat(); 
		
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
	</div>
</article>
<!--_________________________ Finish Standard Article _________________________ -->

