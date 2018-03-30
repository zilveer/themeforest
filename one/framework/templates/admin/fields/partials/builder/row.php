<?php
	$row_class = '';

	if ( empty( $row['columns'] ) ) {
		$row_class = 'empty';
	}
	else {
		$sizes = array(
			'one-fifth'     => 0.2,
			'one-fourth'    => 0.25,
			'one-third'     => 0.333,
			'two-fifths'    => 0.4,
			'one-half'      => 0.5,
			'three-fifths'  => 0.6,
			'two-thirds'    => 0.666,
			'three-fourths' => 0.75,
			'four-fifths'   => 0.8,
			'full'          => 1,
		);

		$sum = 0;
		foreach ( $row['columns'] as $col ) {
			$sum += $sizes[$col['size']];
		}

		if ( $sum > 0.8 ) {
			$row_class = 'complete';
		}
	}
?>

<div class="thb-row <?php echo $row_class; ?>">
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
		<div class="thb-columns-container">
			<?php
				foreach ( $row['columns'] as $column ) {
					thb_get_framework_template_part( '/admin/fields/partials/builder/column', array(
						'column' => $column
					) );
				}
			?>
		</div>
	</div>
</div>
