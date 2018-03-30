<?php

if ( !isset( $icon_color ) ) {
	$icon_color = '';
}

if ( !isset( $counter_styles ) ) {
	$counter_styles = '';
}

if ( $icon_color == '' ) {
	$icon_color = get_theme_mod( 'highlight_color', '#333' );
}

?>

<div class="thb-counter-wrapper">

	<?php if ( !empty( $icon ) ) : ?>
		<?php thb_icon( $icon, $icon_color ); ?>
	<?php endif; ?>

	<div class="thb-counter-inner-wrapper">

		<div class="thb-counter-value-wrapper">
			<?php if ( !empty( $counter_value ) ) : ?>
				<?php if ( !empty( $counter_unit_pre ) ) : ?><p class="thb-counter-unit"><?php echo $counter_unit_pre; ?></p><?php endif; ?><div class="thb-counter" data-value="<?php echo $counter_value; ?>"></div><?php if ( !empty( $counter_unit ) ) : ?><p class="thb-counter-unit"><?php echo $counter_unit; ?></p><?php endif; ?>
			<?php endif; ?>

		</div>

		<?php if ( !empty( $counter_label ) ) : ?>
			<div class="thb-counter-label-wrapper">
				<?php echo thb_text_format( $counter_label, true ); ?>
			</div>
		<?php endif; ?>

	</div>
</div>