<?php 
	if ( is_active_sidebar( 'sidebar-offer' ) ){
		?>
		<div class="col-md-4">
			<?php dynamic_sidebar( 'sidebar-offer' ); ?>
		</div>
		<?php
	}
?>