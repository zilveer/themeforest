<?php
	$column_block_description_display = 'block';

	$sizes = array(
		'one-fifth'     => '1/5',
		'one-fourth'    => '1/4',
		'one-third'     => '1/3',
		'two-fifths'    => '2/5',
		'one-half'      => '1/2',
		'three-fifths'  => '3/5',
		'two-thirds'    => '2/3',
		'three-fourths' => '3/4',
		'four-fifths'   => '4/5',
		'full'          => __( 'Full', 'thb_text_domain' )
	);

	$column_class = '';

	if ( empty( $column['blocks'] ) ) {
		$column_class = 'empty';
	}

	$default_appearance = array(
		'class'                    => '',
		'carousel'                 => '',
		'carousel_module'          => '',
		'carousel_show_pagination' => '',
		'carousel_show_nav_arrows' => '',
		'carousel_autoplay'        => '',
		'carousel_transition_time' => '',
	);
	$appearance = thb_isset( $column, 'appearance', $default_appearance );
	$appearance = htmlentities( json_encode( $appearance ), ENT_QUOTES );

?>

<div class="thb-column <?php echo $column_class; ?>" data-size="<?php echo $column['size']; ?>" data-appearance="<?php echo $appearance; ?>">
	<div class="thb-column-inner-wrapper">
		<header>
			<span class="thb-column-size"><?php echo $sizes[$column['size']]; ?></span>
			<a href="#" class="thb-btn thb-small-btn thb-column-decrease-size tt" title="<?php _e( 'Make smaller', 'thb_text_domain' ); ?>">&lt;</a>
			<a href="#" class="thb-btn thb-small-btn thb-column-increase-size tt" title="<?php _e( 'Make bigger', 'thb_text_domain' ); ?>">&gt;</a>
			<a href="#" class="thb-btn thb-small-btn thb-column-clone tt" title="<?php _e( 'Clone', 'thb_text_domain' ); ?>">=</a>
			<a href="#" class="thb-btn thb-small-btn thb-column-appearance tt" title="<?php _e( 'Column appearance', 'thb_text_domain' ); ?>" data-title="<?php _e( 'Column appearance', 'thb_text_domain' ); ?>">$</a>
			<a href="#" class="thb-small-btn thb-column-remove">&times;</a>
		</header>

		<p class="placeholder">
			<?php _e( 'You have no blocks in this column.', 'thb_text_domain' ); ?>
		</p>
		<div class="thb-blocks-container">
			<?php
				if ( ! empty( $column['blocks'] ) ) {
					foreach ( $column['blocks'] as $block ) {
						$block_object = thb_builder_instance()->getBlock( $block['type'] );

						if ( $block_object !== false ) {
							$title = thb_theme()->getAdmin()->getModal( $block['type'] )->getTitle();
							$nicetype = "";

							if ( isset( $block['data']['title'] ) && $block['data']['title'] != "" ) {
								$title = $block['data']['title'];
								$nicetype = thb_theme()->getAdmin()->getModal( $block['type'] )->getTitle();
							}

							$title = strip_tags( $title );
							$nicetype = strip_tags( $nicetype );

							thb_get_framework_template_part( '/admin/fields/partials/builder/block', array(
								'block'    => $block,
								'title'    => $title,
								'nicetype' => $nicetype
							) );
						}
						else {
							$title = sprintf( __( 'Missing block of type: "%s"', 'thb_text_domain' ), $block['type'] );

							?>
							<div class="thb-block thb-block-disabled" data-data="{}" data-type="<?php echo $block['type']; ?>">
								<a href="#" class="thb-small-btn thb-block-remove">&times;</a>

								<div class="thb-block-description">
									<span><?php echo $title; ?></span>
								</div>
							</div>
							<?php
						}
					}
				}
			?>
		</div>

		<div class="thb-column-block-description" style="display: <?php echo $column_block_description_display; ?>">
			<a href="#" class="thb-column-select-block-type" data-title="<?php _e( 'Select block type', 'thb_text_domain' ); ?>"><?php _e( 'Add', 'thb_text_domain' ); ?></a>
		</div>
	</div>
</div>