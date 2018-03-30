<div class="qodef-two-columns-50-50 clearfix">
	<div class="qodef-two-columns-50-50-inner">
		<div class="qodef-column">
			<div class="qodef-column-inner">
				<div class="qodef-two-columns-50-50 clearfix">
					<div class="qodef-two-columns-50-50-inner">
						<div class="qodef-column">
							<div class="qodef-column-inner">
								<?php if(is_active_sidebar('footer_column_1')) {
									dynamic_sidebar( 'footer_column_1' );
								} ?>
							</div>
						</div>
						<div class="qodef-column">
							<div class="qodef-column-inner">
								<?php if(is_active_sidebar('footer_column_2')) {
									dynamic_sidebar( 'footer_column_2' );
								} ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="qodef-column footer_col3">
			<div class="qodef-column-inner">
				<?php if(is_active_sidebar('footer_column_3')) {
					dynamic_sidebar( 'footer_column_3' );
				} ?>
			</div>
		</div>
	</div>
</div>