<script type="text/html" data-tpl="row_create">
	<div class="thb-row empty">
		<div class="thb-row-inner-wrapper">
			<header>
				<span class="thb-row-label"><?php _e( 'Row', 'thb_text_domain' ); ?></span>

				<a href="#" class="thb-btn thb-small-btn thb-row-clone tt" title="<?php _e( 'Clone', 'thb_text_domain' ); ?>">&times;</a>

				<span class="thb-row-label thb-column-label"><?php _e( 'Add column', 'thb_text_domain' ); ?></span>

				<a href="#" class="thb-row-add-column" data-size="one-fifth">1/5</a>
				<a href="#" class="thb-row-add-column" data-size="one-fourth">1/4</a>
				<a href="#" class="thb-row-add-column" data-size="one-third">1/3</a>
				<a href="#" class="thb-row-add-column" data-size="one-half">1/2</a>
				<a href="#" class="thb-row-add-column" data-size="full"><?php _e( 'Full', 'thb_text_domain' ); ?></a>

				<a href="#" class="thb-btn thb-small-btn thb-row-remove">&times;</a>
			</header>

			<p class="placeholder">
				<?php _e( 'You have no columns in this row.', 'thb_text_domain' ); ?>
			</p>
			<div class="thb-columns-container"></div>
		</div>
	</div>
</script>