<?php
$style = '';

if ( $margin_top != '' ) {
	$style .= 'margin-top:' . $margin_top . 'px;';
}

if ( $margin_bottom != '' ) {
	$style .= 'margin-bottom:' . $margin_bottom . 'px;';
}

?>

<div class="thb-divider-wrapper" style="<?php echo $style; ?>">
	<span class="thb-divider">
		<?php if ( $show_go_top == 1 ) : ?>
			<span class="thb-go-top"><?php _e( 'Go top', 'thb_text_domain' ); ?></span>
		<?php endif; ?>
	</span>
</div>