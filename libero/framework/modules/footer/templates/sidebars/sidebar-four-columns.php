<div class="mkd-four-columns mkd-footer-top-columns clearfix">
	<div class="mkd-four-columns-inner">
		<div class="mkd-column">
			<div class="mkd-column-inner">
				<?php if(is_active_sidebar('footer_column_1')) {
					dynamic_sidebar( 'footer_column_1' );
				} ?>
			</div>
		</div>
		<div class="mkd-column">
			<div class="mkd-column-inner">
				<?php if(is_active_sidebar('footer_column_2')) {
					dynamic_sidebar( 'footer_column_2' );
				} ?>
			</div>
		</div>
		<div class="mkd-column">
			<div class="mkd-column-inner">
				<?php if(is_active_sidebar('footer_column_3')) {
					dynamic_sidebar( 'footer_column_3' );
				} ?>
			</div>
		</div>
		<div class="mkd-column">
			<div class="mkd-column-inner">
				<?php if(is_active_sidebar('footer_column_4')) {
					dynamic_sidebar( 'footer_column_4' );
				} ?>
			</div>
		</div>
	</div>
</div>