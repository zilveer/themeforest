<?php 
	if ( is_active_sidebar( 'sidebar-coupon' ) ){
		?>
		<div class="col-md-3">
			<?php dynamic_sidebar( 'sidebar-coupon' ); ?>
		</div>
		<?php
	}
?>