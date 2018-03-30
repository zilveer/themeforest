<div class="mkd-three-columns clearfix">
	<div class="mkd-three-columns-inner">
		<div class="mkd-footer-btm-table-holder">
			<div class="mkd-column">
				<div class="mkd-column-inner">
					<?php if(is_active_sidebar('footer_bottom_left')) {
						dynamic_sidebar( 'footer_bottom_left' );
					} ?>
				</div>
			</div>
			<div class="mkd-column">
				<div class="mkd-column-inner">
					<?php if(is_active_sidebar('footer_text')) {
						dynamic_sidebar( 'footer_text' );
					} ?>
				</div>
			</div>
			<div class="mkd-column">
				<div class="mkd-column-inner">
					<?php if(is_active_sidebar('footer_bottom_right')) {
						dynamic_sidebar( 'footer_bottom_right' );
					} ?>
				</div>
			</div>
		</div>
	</div>
</div>