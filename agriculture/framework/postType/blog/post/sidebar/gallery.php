<?php
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0
 * 
 * Blog Post with Sidebar Gallery Post Format Template
 * Created by CMSMasters
 * 
 */


$cmsms_option = cmsms_get_global_options();


$cmsms_heading = get_post_meta(get_the_ID(), 'cmsms_heading', true);

$cmsms_post_featured_image_show = get_post_meta(get_the_ID(), 'cmsms_post_featured_image_show', true);

$cmsms_post_images = explode(',', str_replace(' ', '', str_replace('img_', '', get_post_meta(get_the_ID(), 'cmsms_post_images', true))));

?>

<!--_________________________ Start Gallery Article _________________________ -->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php 
		if (!post_password_required()) {
			if (sizeof($cmsms_post_images) > 1) {
		?>
				<script type="text/javascript">
					jQuery(document).ready(function () { 
						jQuery('#cmsms_hover_slider_<?php the_ID(); ?>').cmsmsHoverSlider( { 
							sliderBlock : '#cmsms_hover_slider_<?php the_ID(); ?>', 
							sliderItems : '.cmsms_hover_slider_items', 
							thumbWidth : '110', 
							thumbHeight : '65'
						} );
					} );
				</script>
				<div class="cmsms_hover_slider" id="cmsms_hover_slider_<?php the_ID(); ?>">
					<ul class="cmsms_hover_slider_items">
						<?php 
							foreach ($cmsms_post_images as $cmsms_post_image) {
								echo "\t\t\t\t\t\t" . 
								'<li>' . "\n\t\t\t\t\t\t\t" . 
									'<figure class="cmsms_hover_slider_full_img">' . "\n\t\t\t\t\t\t\t\t" . 
										wp_get_attachment_image($cmsms_post_image, 'slider-thumb', false, array( 
											'class' => '', 
											'alt' => cmsms_title(get_the_ID(), false), 
											'title' => cmsms_title(get_the_ID(), false) 
										)) . "\r\t\t\t\t\t\t\t" . 
									'</figure>' . "\r\t\t\t\t\t\t" . 
								'</li>' . "\r";
							}
						?>
					</ul>
				</div>
			<?php 
			} else if (sizeof($cmsms_post_images) == 1 && $cmsms_post_images[0] != '') {
				cmsms_thumb(get_the_ID(), 'post-thumbnail', false, 'img_' . get_the_ID(), true, true, true, true, $cmsms_post_images[0]);
			} else if (has_post_thumbnail() && $cmsms_post_featured_image_show == 'true' && $cmsms_heading != 'parallax') {
				cmsms_thumb(get_the_ID(), 'post-thumbnail', false, 'img_' . get_the_ID(), true, true, true, true, false);
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
<!--_________________________ Finish Gallery Article _________________________ -->

