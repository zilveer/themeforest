<div class="eltd-two-columns-50-50 clearfix">
	<div class="eltd-two-columns-50-50-inner">
		<div class="eltd-column">
			<div class="eltd-column-inner">
				<?php if(is_active_sidebar('footer_column_1')) {
					dynamic_sidebar( 'footer_column_1' );
				} ?>
			</div>
		</div>
		<div class="eltd-column">
			<div class="eltd-column-inner">
				<?php if(is_active_sidebar('footer_column_2')) {
					dynamic_sidebar( 'footer_column_2' );
				} ?>
			</div>
		</div>
	</div>
</div>