<div id="sidebar-wrap" class="left relative">
	<?php if ( is_home() || is_front_page() ) { ?>
		<?php if ( is_active_sidebar( 'sidebar-widget-home' ) ) { ?>
			<?php dynamic_sidebar( 'sidebar-widget-home' ); ?>
		<?php } ?>
	<?php } else if ( is_single() || is_page() ) { ?>
		<?php if ( is_active_sidebar( 'sidebar-widget-post' ) ) { ?>
			<?php dynamic_sidebar( 'sidebar-widget-post' ); ?>
		<?php } ?>
	<?php } else { ?>
		<?php if ( is_active_sidebar( 'sidebar-widget' ) ) { ?>
			<?php dynamic_sidebar( 'sidebar-widget' ); ?>
		<?php } ?>
	<?php } ?>
</div><!--sidebar-wrap-->