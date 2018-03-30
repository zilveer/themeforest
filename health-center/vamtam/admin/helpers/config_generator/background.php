<?php

$fields = array(
	'color' => __( 'Color:', 'health-center' ),
	'opacity' => __( 'Opacity:', 'health-center' ),
	'image' => __( 'Image / pattern:', 'health-center' ),
	'repeat' => __( 'Repeat:', 'health-center' ),
	'attachment' => __( 'Attachment:', 'health-center' ),
	'position' => __( 'Position:', 'health-center' ),
	'size' => __( 'Size:', 'health-center' ),
);

$sep = isset( $sep ) ? $sep : '-';

$current = array();

if ( ! isset( $only ) ) {
	if ( isset( $show ) ) {
		$only = explode( ',', $show );
	} else {
		$only = array();
	}
} else {
	$only = explode( ',', $only );
}

$show = array();

global $post;
foreach ( $fields as $field => $fname ) {
	if ( isset( $GLOBALS['wpv_in_metabox'] ) ) {
		$current[$field] = get_post_meta( $post->ID, "$id-$field", true );
	} else {
		$current[$field] = wpv_get_option( "$id-$field" );
	}
	$show[$field] = ( in_array( $field, $only ) || sizeof( $only ) == 0 );
}

$selects = array(
	'repeat' => array(
		'no-repeat' => __( 'No repeat', 'health-center' ),
		'repeat-x' => __( 'Repeat horizontally', 'health-center' ),
		'repeat-y' => __( 'Repeat vertically', 'health-center' ),
		'repeat' => __( 'Repeat both', 'health-center' ),
	),
	'attachment' => array(
		'scroll' => __( 'scroll', 'health-center' ),
		'fixed' => __( 'fixed', 'health-center' ),
	),
	'position' => array(
		'left center' => __( 'left center', 'health-center' ),
		'left top' => __( 'left top', 'health-center' ),
		'left bottom' => __( 'left bottom', 'health-center' ),
		'center center' => __( 'center center', 'health-center' ),
		'center top' => __( 'center top', 'health-center' ),
		'center bottom' => __( 'center bottom', 'health-center' ),
		'right center' => __( 'right center', 'health-center' ),
		'right top' => __( 'right top', 'health-center' ),
		'right bottom' => __( 'right bottom', 'health-center' ),
	),
);

?>

<div class="wpv-config-row background clearfix <?php echo esc_attr( $class ) ?>">

	<div class="rtitle">
		<h4><?php echo $name // xss ok ?></h4>

		<?php wpv_description( $id, $desc ) ?>
	</div>

	<div class="rcontent">
		<div class="bg-inner-row">
			<?php if ( $show['color'] ): ?>
				<div class="bg-block color">
					<div class="single-desc"><?php _e( 'Color:', 'health-center' ) ?></div>
					<input name="<?php echo esc_attr( $id.$sep ) ?>color" id="<?php echo esc_attr( $id ) ?>-color" type="color" data-hex="true" value="<?php echo esc_attr( $current['color'] ) ?>" class="" />
				</div>
			<?php endif ?>

			<?php if ( $show['opacity'] ): ?>
				<div class="bg-block opacity range-input-wrap clearfix">
					<div class="single-desc"><?php _e( 'Opacity:', 'health-center' ) ?></div>
					<span>
						<input name="<?php echo esc_attr( $id.$sep )?>opacity" id="<?php echo esc_attr( $id ) ?>-opacity" type="range" value="<?php echo esc_attr( $current['opacity'] )?>" min="0" max="1" step="0.05" class="wpv-range-input" />
					</span>
				</div>
			<?php endif ?>
		</div>

		<div class="bg-inner-row">
			<?php if ( $show['image'] ): ?>
				<div class="bg-block bg-image">
					<div class="single-desc"><?php _e( 'Image / pattern:', 'health-center' ) ?></div>
					<?php $_id = $id;	$id .= $sep.'image'; // temporary change the id so that we can reuse the upload field ?>
					<div class="image <?php wpv_static( $value ) ?>">
						<?php include 'upload-basic.php'; ?>
					</div>
					<?php $id = $_id; unset( $_id ); ?>
				</div>
			<?php endif ?>

			<?php if ( $show['size'] ): ?>
				<div class="bg-block bg-size">
					<div class="single-desc"><?php _e( 'Cover:', 'health-center' ) ?></div>
					<label class="toggle-radio">
						<input type="radio" name="<?php echo esc_attr( $id.$sep ) ?>size" value="cover" <?php checked( $current['size'], 'cover' ) ?>/>
						<span><?php _e( 'On', 'health-center' ) ?></span>
					</label>
					<label class="toggle-radio">
						<input type="radio" name="<?php echo esc_attr( $id.$sep ) ?>size" value="auto" <?php checked( $current['size'], 'auto' ) ?>/>
						<span><?php _e( 'Off', 'health-center' ) ?></span>
					</label>
				</div>
			<?php endif ?>

			<?php foreach ( $selects as $s => $options ): ?>
				<?php if ( $show[$s] ): ?>
					<div class="bg-block bg-<?php echo esc_attr( $s )?>">
						<div class="single-desc"><?php echo $fields[$s] // xss ok ?></div>
						<select name="<?php echo esc_attr( $id.$sep.$s ) ?>" class="bg-<?php echo esc_attr( $s ) ?>">
							<?php foreach ( $options as $val => $opt ): ?>
								<option value="<?php echo esc_attr( $val ) ?>" <?php selected( $val, $current[$s] ) ?>><?php echo $opt // xss ok ?></option>
							<?php endforeach ?>
						</select>
					</div>
				<?php endif ?>
			<?php endforeach ?>
		</div>
	</div>
</div>