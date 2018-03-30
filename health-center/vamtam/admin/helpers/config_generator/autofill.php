<?php
/**
 * adds several links that allow the user to easily set several predefined options
 */
?>

<div class="wpv-config-row autofill <?php if ( isset( $class ) ) echo esc_attr( $class ) ?>">
	<?php if ( isset( $name ) && ! empty( $name ) ): ?>
	<div class="rtitle">
		<h4><?php echo $name // xss ok ?></h4>
		<?php wpv_description( "autofill-$name", $desc ) ?>
	</div>
	<?php endif ?>
	<div class="rcontent">
		<div>
			<?php if ( ! isset( $name ) || empty( $name ) ): ?>
				<p class="autofill-description"><?php echo $desc //xss ok ?></p>
			<?php endif ?>

			<div class="autofill-thumbs">
				<?php foreach ( $option_sets as $set ): ?>
					<?php
						if ( isset( $set['image'] ) ) {
							$content = "<img src='{$set['image']}' alt=''/>";
						} else {
							$content = $set['name'];
						}

						$fields = str_replace( '"', '&quot;', json_encode( $set['values'] ) );
					?>
					<a href="#" title="<?php echo esc_attr( $set['name'] ) ?>" class="wpv-autofill" data-fields="<?php echo esc_attr( $fields ) ?>"><?php echo $content // xss ok ?></a>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>
