<?php
if ( ! ( is_active_sidebar( 'sidebar-2' ) ) ) {
	return;
}
?>

<div id="my-panel" class="panel row scroller">
	<aside id="offsidebar">
		<?php dynamic_sidebar( 'sidebar-2' ); ?>
	</aside>

	<!-- end sidebar -->
</div>