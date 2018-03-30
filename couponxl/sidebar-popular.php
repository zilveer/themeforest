<?php 
	if ( is_active_sidebar( 'sidebar-popular' ) ){
		?>
		<div class="col-md-3">
			<?php dynamic_sidebar( 'sidebar-popular' ); ?>
		</div>
		<?php
	}
?>