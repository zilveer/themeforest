<?php 
	if ( is_active_sidebar( 'sidebar-blog' ) ){
		?>
		<div class="col-md-3">
			<?php dynamic_sidebar( 'sidebar-blog' ); ?>
		</div>
		<?php
	}
?>