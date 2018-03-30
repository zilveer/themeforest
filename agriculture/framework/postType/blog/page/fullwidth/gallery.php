<?php
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0
 * 
 * Blog Page Full Width Gallery Post Format Template
 * Created by CMSMasters
 * 
 */

 
$cmsms_option = cmsms_get_global_options();
 

$cmsms_post_featured_image_show = get_post_meta(get_the_ID(), 'cmsms_post_featured_image_show', true);

$cmsms_post_images = explode(',', str_replace(' ', '', str_replace('img_', '', get_post_meta(get_the_ID(), 'cmsms_post_images', true))));

?>

<!--_________________________ Start Gallery Article _________________________ -->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php 
		if (!post_password_required()) {
			if ($cmsms_post_featured_image_show == 'true' && has_post_thumbnail()) {
				cmsms_thumb(get_the_ID(), 'full-thumb', false, 'img_' . get_the_ID(), true, true, true, true, false);
			} elseif (sizeof($cmsms_post_images) > 1) {
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
										wp_get_attachment_image($cmsms_post_image, 'full-slider-thumb', false, array( 
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
			} elseif (sizeof($cmsms_post_images) == 1 && $cmsms_post_images[0] != '') {
				cmsms_thumb(get_the_ID(), 'full-thumb', false, 'img_' . get_the_ID(), true, true, true, true, $cmsms_post_images[0]);
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
<!--_________________________ Finish Gallery Article _________________________ -->

