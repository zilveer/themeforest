<div class="eltd-four-columns clearfix">
	<div class="eltd-four-columns-inner">
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
		<div class="eltd-column">
			<div class="eltd-column-inner">
				<?php if(is_active_sidebar('footer_column_3')) {
					dynamic_sidebar( 'footer_column_3' );
				} ?>
			</div>
		</div>
		<div class="eltd-column">
			<div class="eltd-column-inner">
				<?php if(is_active_sidebar('footer_column_4')) {
					dynamic_sidebar( 'footer_column_4' );
				} ?>
			</div>
		</div>
	</div>
</div>