<?php

/**
 * Skin management
 *
 * @package wpv
 */
/**
 * class WpvSkinManagement
 */
class WpvSkinManagement extends WpvAjax {
	/**
	 * Hook ajax actions
	 */
	public function __construct() {
		$this->actions = array(
			'save-skin' => 'save_skin',
			'available-skins' => 'available_skins',
			'delete-skin' => 'delete_skin',
			'load-skin' => 'load_skin',
		);

		parent::__construct();
	}

	/**
	 * Output HTML for the skin import <select>
	 */
	public function available_skins() {
		$skins_dir = opendir( WPV_SAVED_OPTIONS );

		if ( isset( $_POST['prefix'] ) ) {
			$prefix = $_POST['prefix'].'_';

			echo '<option value="">'.__( 'Available skins', 'health-center' ).'</option>';
			while ( $file = readdir( $skins_dir ) ):
				if ( $file != '.' && $file != '..' && strpos( $file, $prefix ) == 0 ):
					?>
					<option value="<?php echo esc_attr( $file ) ?>"><?php echo str_replace( $prefix, '', $file ) // xss ok ?></option>
					<?php
				endif;
			endwhile;

			closedir( $skins_dir );
		}

		exit;
	}

	/**
	 * Imports a skin
	 */
	public function load_skin() {
		$name = $_POST['name'];
		$file = $_POST['file'];
		wpv_update_option( 'last-active-skin', $name );

		$data = json_decode( file_get_contents( WPV_SAVED_OPTIONS.$file ) );

		foreach ( $data as $id => $val ) {
			if ( is_string( $val ) )
				$val = str_replace( '{WPV_SAMPLES_URI}', WPV_SAMPLES_URI, $val );

			wpv_update_option( $id, $val );
		}

		wpv_finalize_custom_css();

		echo json_encode(
			array(
				'data' => $data,
				'text' => '<span class="success">'.__( 'The skin has been imported successfully. Have fun!', 'health-center' ).'</span>',
			)
		);

		exit;
	}

	/**
	 * Deletes a skin
	 */
	public function delete_skin() {
		$_POST['file'] = trim( $_POST['file'] );

		if ( @unlink( WPV_SAVED_OPTIONS.$_POST['file'] ) )
			echo '<span class="success">'. __( 'Success.', 'health-center' ) . '</span>';
			exit;

		echo '<span class="error">'. __( 'Cannot delete file.', 'health-center' ) . '</span>';
		exit;
	}

	/**
	 * Saves the current theme options in a new skin
	 */
	public function save_skin() {
		$_POST['file'] = trim( $_POST['file'] );

		$pages     = array( 'general', 'layout', 'styles', 'import' );
		$skin_data = array();

		foreach ( $pages as $page_str ) {
			$tabs = include WPV_THEME_OPTIONS . $page_str . '/list.php';

			foreach ( $tabs as $tab ) {
				$tab_contents = include WPV_THEME_OPTIONS.$page_str."/$tab.php";

				foreach ( $tab_contents as $field ) {
					if ( ! isset( $field['static'] ) || ! $field['static'] ) {
						$type = $field['type'];
						if ( isset( $field['id'] ) ) {
							$skin_data = array_merge( $skin_data, $this->get_values( $this->process_option_id( $type, $field['id'] ) ) );
						} else {
							$skin_data = array_merge( $skin_data, $this->get_values( $this->process_option_noid( $type, $field ) ) );
						}
					}
				}
			}
		}

		if ( file_put_contents( WPV_SAVED_OPTIONS.$_POST['file'], json_encode( $skin_data ) ) )
			echo '<span class="success">'. __( 'Success.', 'health-center' ) . '</span>';
			exit;

		echo '<span class="error">'. __( 'Cannot save file.', 'health-center' ) . '</span>';
		exit;
	}

	/**
	 * Gets the values of a list of options
	 * @param  array $ids list of option names
	 * @return array      options with values
	 */
	private function get_values( $ids ) {
		$res = array();

		foreach ( $ids as $id ) {
			$res[$id] = wpv_get_option( $id );
		}

		return $res;
	}

	/**
	 * Maps the multiple-option rows to their individual keys
	 * @param  string $type option type
	 * @param  string $id   option id prefix
	 * @return array        list of option ids
	 */
	private function process_option_id( $type, $id ) {
		$suffixes = array(
			'font' => array(
				'size',
				'lheight',
				'face',
				'weight',
				'color',
			),
			'background' => array(
				'image',
				'opacity',
				'color',
				'position',
				'attachment',
				'repeat',
				'size',
			),
		);

		if ( isset( $suffixes[$type] ) )
			return array_map( create_function( '$a', "return '$id-' . \$a;" ), $suffixes[$type] );

		return array( $id );
	}

	/**
	 * Processes option rows which do not have IDs
	 *
	 * @param  string $type   option type
	 * @param  array  $option option row config
	 * @return array          option IDs after expansion
	 */
	private function process_option_noid( $type, $option ) {
		if ( $type == 'select_checkbox' )
			return array( $option['id_select'], $option['id_checkbox'] );

		if ( $type == 'social' ) {
			$res = array();

			$places   = array( 'post', 'page', 'portfolio', 'lightbox', 'product', 'tribe' );
			$networks = array( 'twitter', 'facebook', 'googleplus', 'pinterest' );

			foreach ( $places as $place ) {
				foreach ( $networks as $network ) {
					$res[] = "share-$place-$network";
				}
			}

			return $res;
		}

		if ( $option['type'] == 'horizontal_blocks' ) {
			$id  = $option['id_prefix'];
			$res = array( $id );

			for ( $i = 1; $i <= $option['max']; $i++ ) {
				$res[] = "$id-$i-width";
				$res[] = "$id-$i-last";
				$res[] = "$id-$i-empty";
			}

			return $res;
		}

		if ( $option['type'] == 'color-row' ) {
			return array_keys( $option['inputs'] );
		}

		if ( $option['type'] == 'select-row' ) {
			return array_keys( $option['selects'] );
		}

		return array();
	}
}
