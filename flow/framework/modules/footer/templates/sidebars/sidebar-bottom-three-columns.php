<div class="eltd-three-columns clearfix">
	<div class="eltd-three-columns-inner">
		<div class="eltd-column">
			<div class="eltd-column-inner">
				<?php if(is_active_sidebar('footer_bottom_left')) {
					dynamic_sidebar( 'footer_bottom_left' );
				} ?>
			</div>
		</div>
		<div class="eltd-column">
			<div class="eltd-column-inner">
				<?php if(is_active_sidebar('footer_text')) {
					dynamic_sidebar( 'footer_text' );
				} ?>
			</div>
		</div>
		<div class="eltd-column">
			<div class="eltd-column-inner">
				<?php if(is_active_sidebar('footer_bottom_right')) {
					dynamic_sidebar( 'footer_bottom_right' );
				} ?>
			</div>
		</div>
	</div>
</div>