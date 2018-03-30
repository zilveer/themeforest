<?php
/**
 * Sidebar Template
 *
 * @package Mysitemyway
 * @subpackage Template
 */
?>
<div id="sidebar">
	<span class="sidebar_top"></span>
		<div id="sidebar_inner">
		
			<?php mysite_sidebar_begin(); ?>

			<?php mysite_dynamic_sidebar(); ?>

			<?php mysite_sidebar_end(); ?>
		
		</div><!-- #sidebar_inner -->
	<span class="sidebar_bottom"></span>
</div><!-- #sidebar -->