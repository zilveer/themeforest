<div class="mkd-two-columns-50-50 mkd-footer-top-columns clearfix">
	<div class="mkd-two-columns-50-50-inner">
		<div class="mkd-column">
			<div class="mkd-column-inner">
				<div class="mkd-two-columns-50-50 mkd-footer-top-columns clearfix">
					<div class="mkd-two-columns-50-50-inner">
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
					</div>
				</div>
			</div>
		</div>
		<div class="mkd-column footer_col3">
			<div class="mkd-column-inner">
				<?php if(is_active_sidebar('footer_column_3')) {
					dynamic_sidebar( 'footer_column_3' );
				} ?>
			</div>
		</div>
	</div>
</div>