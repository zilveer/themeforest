<?php
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0
 * 
 * 404 Error Page Template
 * Created by CMSMasters
 * 
 */


$cmsms_option = cmsms_get_global_options();


get_header();

?>
<!-- _________________________ Start Content _________________________ -->
<section id="middle_content" role="main" style="overflow:visible;">
	<div class="entry">
		<div class="error">
			<?php 
				echo '<h1>404</h1>' . 
				'<h3>' . __("We're sorry, but the page you were looking for doesn't exist.", 'cmsmasters') . '</h3>';

				if ($cmsms_option[CMSMS_SHORTNAME . '_error_search']) { 
					get_search_form(); 
				}
				
				if ($cmsms_option[CMSMS_SHORTNAME . '_error_sitemap_button'] && $cmsms_option[CMSMS_SHORTNAME . '_error_sitemap_link'] != '') {
					echo '<a href="' . $cmsms_option[CMSMS_SHORTNAME . '_error_sitemap_link'] . '" class="button">' . __('Sitemap', 'cmsmasters') . '</a>';
				}
			?>
		</div>
	</div>
</section>
<!-- _________________________ Finish Content _________________________ -->


<?php 
get_footer();

