<?php
/**
 * The Sidebar containing the main widget areas.
 *
 */
if ( is_active_sidebar( 'sidebar-footer' ) ) : ?>
<section id="tertiary" class="sidebar-footer">
	<div class="sidebar-inner wrap">
		<div class="widget-area">
			<?php dynamic_sidebar( 'sidebar-footer' ); ?>
		</div>
	</div>
</section><!-- #tertiary .sidebar-footer -->
<?php endif; ?>