<?php
/**
 * tinymce
 */
?>

<div class="wpv-config-row editor <?php echo esc_attr( $class ) ?>">
	<div class="rtitle">
		<h4>
			<label for="<?php echo esc_attr( $id ) ?>"><?php echo $name // xss ok ?></label>
		</h4>

		<?php wpv_description( $id, $desc ) ?>
	</div>

	<div class="rcontent">
		<?php wp_editor(wpv_get_option($id, $default), $id) ?>
	</div>
</div>
