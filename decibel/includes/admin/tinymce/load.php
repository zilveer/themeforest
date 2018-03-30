<?php
$absolute_path = __FILE__;
$path_to_file = explode( 'wp-content', $absolute_path );

if ( count( $path_to_file ) > 1 ) {
	/*got wp-content dir*/
	$path_to_wp = $path_to_file[0];

} else {
	/* dev environement */
	$path_to_file = explode( 'content', $absolute_path );
	$path_to_wp = $path_to_file[0] .'/wp';
}
// Access WordPress
require_once( $path_to_wp . '/wp-load.php' );

function wolf_generate_tinymce_popup( $shortcode_id, $params = array(), $title = 'Shortcode', $wrap = false ) {

	$submit = $wrap ? __( 'Wrap selection', 'wolf' ) : __( 'Insert', 'wolf' );
	$output = "<script>
	jQuery( function( $ ) {
		$( '#wolf-insert' ).click( function() {
			var html = tinyMCE.activeEditor.selection.getContent();";

			foreach ( $params as $param ) {
				$param_id = $param['id'];
				$output .= 'var ' . esc_js( $param_id ) . ' = $( "#' . esc_js( $param_id ) . '" ).val();';
			}

			$output .= "output = '[" . esc_js( $shortcode_id ) . "';";

			foreach ( $params as $param ) {
				$param_id = $param['id'];
				$param_type = isset( $param['type'] ) ? $param['type'] : 'text';

				$output .= 'if ( "" !== ' . esc_js( $param_id ) . ' ) {';
				ob_start();
				if ( 'checkbox' == $param_type ) {
					$value = isset( $param['value'] ) ? $param['value'] : 'yes';
				?>
					if ( $( '#<?php echo esc_js( $param_id ); ?>' ).is( ':checked' ) ) { output += ' <?php echo esc_js( $param_id ); ?>="<?php echo esc_js( $value ); ?>"' ; }
				<?php
				} else {
				?>
					output += ' <?php echo esc_js( $param_id ); ?>="' + <?php echo esc_js( $param_id ); ?> + '"';
				<?php
				}
				$output .= ob_get_clean();
				$output .= '}';
			}

			if ( $wrap ) {
				ob_start();
				?>
				output += ']'+ html + '[/<?php echo esc_js( $shortcode_id ); ?>]';
				<?php
				$output .= ob_get_clean();
			} else {
				$output .= "output += ']';";
			}

			$output .= "if ( window.tinyMCE  ) {
				window.parent.send_to_editor( output );
				tb_remove();
				return false;
			}";

		$output .= " } );
	} );
	</script>";

	$output .= "<div id='wolf-popup-head'></div>";

	$output .= '<div id="wolf-popup">
		<form action="#" method="get">
			<table class="form-table">';

			foreach ( $params as $param ) {
				$label = isset( $param['label'] ) ? $param['label'] : __( 'Label', 'wolf' );
				$param_id = isset( $param['id'] ) ? $param['id'] : null;
				$type = isset( $param['type'] ) ? $param['type'] : 'text';
				$options = isset( $param['options'] ) ? $param['options'] : array();
				$desc = isset( $param['desc'] ) ? $param['desc'] : '';
				$value = isset( $param['value'] ) ? $param['value'] : '';
				$placeholder = isset( $param['placeholder'] ) ? $param['placeholder'] : '';

				$output .= "<tbody>
						<tr>
							<th><label for='services'>" . esc_attr( $label ) . "</label><br>
							<small>" . esc_attr( $desc ) . "</small>
							</th>
							<td>";

				if ( 'text' == $type ) {

					$output .= '<input placeholder="' . esc_attr( $placeholder ) . '" type="text" name="' . esc_attr( $param_id ) . '" id="' . esc_attr( $param_id ) . '" value="' . esc_attr( $value ) . '">';

				} elseif ( 'checkbox' == $type ) {

					$output .= '<input type="checkbox" name="' . esc_attr( $param_id ) . '" id="' . esc_attr( $param_id ) . '">';

				} elseif ( 'select' == $type ) {

					$output .= '<select name="' . esc_attr( $param_id ) . '" id="' . esc_attr( $param_id ) . '">';
					foreach ( $options as $key => $value ) {
						$output .= '<option value="' . esc_attr( $key ) . '">' . esc_attr( $value ) . '</option>';
					}
					$output .= "</select>";
				}

				$output .= "</td>
					</tr>
				</tbody>";
			}

	$output .= '</table>
			<p class="submit"><input type="submit" id="wolf-insert" class="button-primary" value="' . esc_attr( $submit ) . '"></p>
		</form>
	</div>';

	return $output;
}