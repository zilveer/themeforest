<?php
/**
 * button
 */

$data_str = '';

if ( isset( $data ) ) {
	foreach ( $data as $data_name => $data_value ) {
		$data_str .= "data-{$data_name}=\"" . esc_attr( $data_value ) . '"';
	}
}

?>

<div class="wpv-config-row <?php echo esc_attr( $class ) ?> clearfix">
	<div class="rtitle">
		<?php if ( isset( $name ) ): ?>
			<h4><?php echo $name // xss ok ?></h4>
			<?php wpv_description( '', $desc ) ?>
		<?php endif ?>
	</div>

	<div class="rcontent">
		<a href="<?php echo esc_attr( isset( $link ) ? $link : '#' )?>" title="<?php echo esc_attr( $title )?>" class="button <?php echo esc_attr( isset( $button_class ) ? $button_class : '' ) ?>" <?php echo $data_str // xss ok ?> ><?php echo $title // xss ok?></a>
	</div>
</div>
