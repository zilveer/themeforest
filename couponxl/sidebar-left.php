<?php 
	if ( is_active_sidebar( 'sidebar-left' ) ){
		?>
		<div class="col-md-3">
			<?php dynamic_sidebar( 'sidebar-left' ); ?>
		</div>
		<?php
	}
?>