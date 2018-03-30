<script type="text/html" data-tpl="column_create">
	<div class="thb-column empty" data-size="{{ size }}" data-appearance="">
		<div class="thb-column-inner-wrapper">
			<header>
				<span class="thb-column-size">{{ fraction }}</span>

				<a href="#" class="thb-btn thb-small-btn thb-column-decrease-size tt" title="<?php _e( 'Make smaller', 'thb_text_domain' ); ?>">&lt;</a>
				<a href="#" class="thb-btn thb-small-btn thb-column-increase-size tt" title="<?php _e( 'Make bigger', 'thb_text_domain' ); ?>">&gt;</a>
				<a href="#" class="thb-btn thb-small-btn thb-column-clone tt" title="<?php _e( 'Clone', 'thb_text_domain' ); ?>">=</a>
				<a href="#" class="thb-btn thb-small-btn thb-column-appearance tt" title="<?php _e( 'Column appearance', 'thb_text_domain' ); ?>" data-title="<?php _e( 'Column appearance', 'thb_text_domain' ); ?>">$</a>
				<a href="#" class="thb-btn thb-small-btn thb-column-remove">&times;</a>
			</header>

			<p class="placeholder">
				<?php _e( 'You have no blocks in this column.', 'thb_text_domain' ); ?>
			</p>
			<div class="thb-blocks-container"></div>

			<div class="thb-column-block-description">
				<a href="#" class="thb-column-select-block-type" data-title="<?php _e( 'Select block type', 'thb_text_domain' ); ?>"><?php _e( 'Add', 'thb_text_domain' ); ?></a>
			</div>
		</div>
	</div>
</script>