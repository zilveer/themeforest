<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php if ( tmm_get_sidebar_position() != 'no_sidebar' ) { ?>
	<aside id="sidebar" class="col-md-3 col-sm-12">
		<?php TMM_Custom_Sidebars::show_custom_sidebars(); ?>
	</aside><!--/ #sidebar -->
<?php } ?>
