<?php if ( ! empty( $slide['caption'] ) ) : ?>
	<div class="thb-slide-caption">
		<div class="thb-slide-caption-wrapper">
			<div class="thb-caption-inner-wrapper">

				<?php if ( ! empty( $slide['caption'] ) ) : ?>
					<div class="thb-caption">
						<?php echo thb_text_format( $slide['caption'], true ); ?>
					</div>
				<?php endif; ?>

			</div>
		</div>
	</div>
<?php endif; ?>