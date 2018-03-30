<?php if ( isset( $block['data'] ) ) : ?>
	<?php
		$block_classes = array();

		if ( isset( $block['data']['is_title'] ) && $block['data']['is_title'] == '1' ) {
			$block_classes[] = 'title_block';
		}

		$data = htmlentities( json_encode( $block['data'] ), ENT_QUOTES );
	?>

	<div class="thb-block <?php thb_classes( $block_classes ); ?>" data-data="<?php echo $data; ?>" data-type="<?php echo $block['type']; ?>">
		<a href="#" class="thb-small-btn thb-block-clone tt" title="<?php _e( 'Clone', 'thb_text_domain' ); ?>">$</a>
		<a href="#" class="thb-small-btn thb-block-edit tt" title="<?php _e( 'Edit', 'thb_text_domain' ); ?>">$</a>
		<a href="#" class="thb-small-btn thb-block-remove">&times;</a>

		<div class="thb-block-description">
			<span><?php echo $title; ?></span>

			<?php if ( $nicetype != '' ) : ?>
				<em><?php echo $nicetype; ?></em>
			<?php endif; ?>
		</div>
	</div>
<?php endif; ?>