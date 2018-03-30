<?php 
// Prevent loading this file directly
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>

	<?php 
		if(is_singular() && is_active_sidebar( 'detail_sidebar' )){ ?>
			<aside id="sidebar">
				<div class="theiaStickySidebar">
					<div id="sidebar-inner">
						<?php dynamic_sidebar('detail_sidebar'); ?>
					</div>
				</div>
			</aside>
		<?php }
		else{
			if ( is_active_sidebar( 'sidebar' ) ) { ?>
			<aside id="sidebar">
				<div class="theiaStickySidebar">
					<div id="sidebar-inner">
						<?php dynamic_sidebar('sidebar'); ?>
					</div>
				</div>
			</aside>
		<?php }
		} ?>