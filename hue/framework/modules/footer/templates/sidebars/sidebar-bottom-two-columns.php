<div class="mkd-grid-row mkd-footer-bottom-two-cols">
	<div class="mkd-grid-col-6">
		<?php if(is_active_sidebar('footer_bottom_left')) :
			dynamic_sidebar('footer_bottom_left');
		endif; ?>
	</div>
	<div class="mkd-grid-col-6">
		<?php if(is_active_sidebar('footer_bottom_right')) :
			dynamic_sidebar('footer_bottom_right');
		endif; ?>
	</div>
</div>