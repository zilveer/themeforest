<?php if ( is_active_sidebar( 'bottom-sidebar' ) ) { ?>
<!-- BOTTOM PANEL : begin -->
<div id="bottom-panel" <?php if ( lsvr_get_image_field( 'bottom_panel_bg_image' ) ) { echo ' style="background-image: url(' . lsvr_get_image_field( 'bottom_panel_bg_image' ) . ');"'; } ?>>
	<div class="bottom-panel-inner">
		<div class="container">
			<div class="row widget-list">

				<?php dynamic_sidebar( 'bottom-sidebar' ); ?>

			</div>
		</div>
	</div>
</div>
<!-- BOTTOM PANEL : end -->
<?php } ?>