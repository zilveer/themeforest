<div class="mkdf-three-columns clearfix">
	<div class="mkdf-three-columns-inner">
		<div class="mkdf-column">
			<div class="mkdf-column-inner">
				<?php if(is_active_sidebar('footer_bottom_left')) {
					dynamic_sidebar( 'footer_bottom_left' );
				} ?>
			</div>
		</div>
		<div class="mkdf-column">
			<div class="mkdf-column-inner">
				<?php if(is_active_sidebar('footer_text')) {
					dynamic_sidebar( 'footer_text' );
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