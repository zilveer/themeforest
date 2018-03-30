<div class="mkdf-two-columns-50-50 clearfix">
	<div class="mkdf-two-columns-50-50-inner">
		<div class="mkdf-column">
			<div class="mkdf-column-inner">
				<?php if(is_active_sidebar('footer_bottom_left')) {
					dynamic_sidebar( 'footer_bottom_left' );
				} ?>
			</div>
		</div>
		<div class="mkdf-column">
			<div class="mkdf-column-inner">
				<?php if(is_active_sidebar('footer_bottom_right')) {
					dynamic_sidebar( 'footer_bottom_right' );
				} ?>
			</div>
		</div>
	</div>
</div>