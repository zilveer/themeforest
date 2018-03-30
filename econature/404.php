<?php
/**
 * @package 	WordPress
 * @subpackage 	EcoNature
 * @version 	1.1.0
 * 
 * 404 Error Page Template
 * Created by CMSMasters
 * 
 */


get_header();

$cmsms_option = cmsms_get_global_options();

?>

</section>

<!-- _________________________ Start Content _________________________ -->
<div class="entry">
	<div class="error">
		<div class="error_bg" style="background:rgba(<?php 
				$error_color = explode('|', $cmsms_option[CMSMS_SHORTNAME . '_error_bg_color']);
				
				echo hex2rgb($error_color[0]) . ', ' . ((int) $error_color[1] / 100);
			?>);">
			<div class="error_inner" style="<?php 
				if ($cmsms_option[CMSMS_SHORTNAME . '_error_bg_image'] != '') {
					$error_img = explode('|', $cmsms_option[CMSMS_SHORTNAME . '_error_bg_image']);
					
					if (is_numeric($error_img[0])) {
						$error_img_url = wp_get_attachment_image_src((int) $error_img[0], 'full');
					}
					
					
					echo 'background-image:url(' . ((is_numeric($error_img[0])) ? esc_url($error_img_url[0]) : esc_url($error_img[1])) . ');'; 
				}
			?>">
				<?php echo '<h1 class="error_title">404</h1>'; ?>
			</div>
		</div>
	</div>
</div>
<section class="content_wrap fullwidth">
	<div class="error">
		<?php 
			echo '<h2 class="error_subtitle">' . esc_html__("We're sorry, but the page you were looking for doesn't exist.", 'cmsmasters') . '</h2>';
			
			
			if ($cmsms_option[CMSMS_SHORTNAME . '_error_search']) { 
				get_search_form(); 
			}
			
			
			if ($cmsms_option[CMSMS_SHORTNAME . '_error_sitemap_button'] && $cmsms_option[CMSMS_SHORTNAME . '_error_sitemap_link'] != '') {
				echo '<div class="error_button_wrap"><a href="' . esc_url($cmsms_option[CMSMS_SHORTNAME . '_error_sitemap_link']) . '" class="cmsms_button">' . esc_html__('Sitemap', 'cmsmasters') . '</a></div>';
			}
		?>
	</div>
<!-- _________________________ Finish Content _________________________ -->


<?php 
get_footer();

