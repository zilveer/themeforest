<div class="mkd-grid-row mkd-footer-bottom-three-cols">
	<div class="mkd-grid-col-4">
		<?php if(is_active_sidebar('footer_bottom_left')) :
			dynamic_sidebar('footer_bottom_left');
		endif; ?>
	</div>
	<div class="mkd-grid-col-4">
		<?php if(is_active_sidebar('footer_text')) :
			dynamic_sidebar('footer_text');
		endif; ?>
	</div>
	<div class="mkd-grid-col-4">
		<?php if(is_active_sidebar('footer_bottom_right')) :
			dynamic_sidebar('footer_bottom_right');
		endif; ?>
	</div>
</div>