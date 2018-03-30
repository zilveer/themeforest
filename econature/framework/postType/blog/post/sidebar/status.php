<?php
/**
 * @package 	WordPress
 * @subpackage 	EcoNature
 * @version		1.0.0
 * 
 * Blog Post with Sidebar Status Post Format Template
 * Created by CMSMasters
 * 
 */
 
 
$cmsms_option = cmsms_get_global_options();

 
$cmsms_post_status_text = get_post_meta(get_the_ID(), 'cmsms_post_status_text', true);

?>

<!--_________________________ Start Status Article _________________________ -->

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="cmsms_post_cont">
		<span class="cmsms_post_format_img cmsms-icon-user-7"></span>
		<?php 
		if (!post_password_required()) {
			if ($cmsms_post_status_text != '') {
				echo '<div class="cmsms_post_content">' . 
					'<div class="cmsms_post_content_aligner"></div>' . 
					'<div class="entry-content">' . $cmsms_post_status_text . '</div>' . 
				'</div>';
			} else {
				echo '<div class="cmsms_post_content">' . 
					'<div class="cmsms_post_content_aligner"></div>' . 
					'<div class="entry-content">' . theme_excerpt(55, false) . '</div>' . 
				'</div>';
			}
		} else {
			echo '<p class="cmsms_post_content">' . __('There is no excerpt because this is a protected post.', 'cmsmasters') . '</p>';
		}
		
		
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
	
	<?php
	echo '<div class="entry-content">';
		
		the_content();
		
		wp_link_pages(array( 
			'before' => '<div class="subpage_nav" role="navigation">' . '<strong>' . __('Pages', 'cmsmasters') . ':</strong>', 
			'after' => '</div>', 
			'link_before' => ' [ ', 
			'link_after' => ' ] ' 
		));
		
		echo '<div class="cl"></div>' . 
	'</div>';
	?>
</article>
<!--_________________________ Finish Standard Article _________________________ -->

