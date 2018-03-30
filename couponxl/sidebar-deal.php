<?php 
	if ( is_active_sidebar( 'sidebar-deal' ) ){
		?>
		<div class="col-md-3">
			<?php dynamic_sidebar( 'sidebar-deal' ); ?>
		</div>
		<?php
	}
?>