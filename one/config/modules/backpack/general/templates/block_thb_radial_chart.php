<?php
if ( $radial_size == '' ) {
	$radial_size = 120;
}

if ( $radial_color == '' ) {
	$radial_color = get_theme_mod( 'highlight_color', '#333' );
}

if ( $track_color == '' ) {
	$track_color = '#eee';
}

if ( $line_width == '' ) {
	$line_width = '8';
}

if ( $line_cap == '' ) {
	$line_cap = 'round';
}

$radial_attrs = array(
	'size'        => $radial_size,
	'percent'     => 0,
	'color'       => $radial_color,
	'track'       => $track_color,
	'width'		  => $line_width,
	'cap'		  => $line_cap,
	'disable-animation'	=> $disable_animation,
	'percent-end' => $radial_data
);

$font_size = $radial_size * 1.25;

$style = "style='";
	$style .= "width:" . $radial_size . "px;";
	$style .= "height:" . $radial_size . "px;";
	$style .= "line-height:" . $radial_size . "px;";

	if ( $radial_size >= 200 ) {
		$radial_size = 200;
	} else if ( $radial_size <= 80 ) {
		$radial_size = 80;
	}

	$style .= "font-size:" . $radial_size . "%;";

	$style .= "color:" . $radial_color . ";";
$style .= "'";

?>

<?php if ( $radial_data != '' || $radial_label != '' ) : ?>
	<div class="thb-radial-chart-wrapper">
		<?php if ( $radial_data != '' ) : ?>
			<div class="thb-radial-chart-data" <?php thb_data_attributes( $radial_attrs ); ?> <?php echo $style; ?>>
				<?php if ( ! empty( $icon ) ) : ?>
					<?php thb_icon( $icon, $radial_color ); ?>
				<?php else : ?>
					<?php if ( empty( $hide_radial_data ) ) : ?>
						<p class="thb-radial-chart-data-value">
							<span class="thb-radial-chart-step-value"><?php echo $radial_data; ?></span><span class="thb-radial-chart-unit"><?php echo $radial_unit; ?></span>
						</p>
					<?php endif; ?>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<?php if ( ! empty( $icon ) && $radial_data != '' ) : ?>
			<?php if ( empty( $hide_radial_data ) ) : ?>
				<p class="thb-radial-chart-data-value thb-outside">
					<span class="thb-radial-chart-step-value thb-outside"><?php echo $radial_data; ?></span><span class="thb-radial-chart-unit thb-outside"><?php echo $radial_unit; ?></span>
				</p>
			<?php endif; ?>
		<?php endif; ?>

		<?php if ( $radial_label != '' ) : ?>
			<div class="thb-radial-chart-label">
				<p><?php echo $radial_label; ?></p>
			</div>
		<?php endif; ?>
	</div>
<?php endif; ?>