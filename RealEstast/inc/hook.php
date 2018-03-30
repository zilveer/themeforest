<?php

class PGL_Hook {
	static function init() {
		remove_action( 'wp_head', 'feed_links', 2 );
		remove_action( 'wp_head', 'feed_links_extra', 3 );

		add_action( 'admin_init', array( 'PGL_Hook', 'add_page_meta_box' ) );
		add_action( 'save_post', array( 'PGL_Hook', 'save_page_meta_box' ) );

		add_action( 'before_end_header', array( 'PGL_Hook', 'output_style_color' ) );
		add_action( 'before_end_header', array( 'PGL_Hook', 'output_header_code' ) );
		add_action( 'before_end_page', array( 'PGL_Hook', 'output_footer_code' ) );
	}

	static function add_page_meta_box() {
		add_meta_box( 'page-settings', __( 'RealEstast \'s page settings ', PGL ), array( 'PGL_Hook', 'page_setting_box' ), 'page', 'normal', 'high' );
		add_meta_box( 'page-settings', __( 'RealEstast \'s page settings ', PGL ), array( 'PGL_Hook', 'page_setting_box' ), 'post', 'normal', 'high' );
	}

	static function save_page_meta_box( $post_id ) {
		global $post;
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}
		if ( is_null( $post ) )
			return NULL;
		if ( isset ($_POST['page_setting_sidebar'])) {
			update_post_meta( $post->ID, 'page_setting_sidebar', $_POST['page_setting_sidebar'] );
			update_post_meta( $post->ID, 'page_setting_title', isset( $_POST['page_setting_title'] ) ? $_POST['page_setting_title'] : 0 );
			update_post_meta( $post->ID, 'page_setting_enable_slider', $_POST['page_setting_enable_slider'] );
		}

		return NULL;
	}

	static function page_setting_box() {
		global $post;
		$page_setting_sidebar = get_post_meta( $post->ID, 'page_setting_sidebar', TRUE );
		$show_title           = get_post_meta( $post->ID, 'page_setting_title', TRUE );
		$enable_slider        = get_post_meta( $post->ID, 'page_setting_enable_slider', TRUE );
		?>
		<div id="page_setting_box" class="realestast-metabox">
			<table>
				<tr>
					<th>
						<label for="page_setting_sidebar"><?php _e( 'Sidebar', PGL ) ?></label>
					</th>
					<td>
						<select name="page_setting_sidebar" id="page_setting_sidebar">
							<?php
							global $wp_registered_sidebars;
							foreach ( $wp_registered_sidebars as $sidebar ) {
								echo '<option value="' . $sidebar['id'] . '" ' . ( $sidebar['id'] == $page_setting_sidebar ? 'selected' : '' ) . '>' . $sidebar['name'] . '</option>';
							}
							?>
						</select>
					</td>
					<td>
						<span class="notice"><?php _e( 'This setting only affects template with sidebar support', PGL ) ?></span>
					</td>
				</tr>
				<tr>
					<th>
						<label for="page_setting_title"><?php _e( 'Show title', PGL ) ?></label>
					</th>
					<td>
						<select name="page_setting_title" id="page_setting_title">
							<option value="1"><?php _e( 'Yes', PGL ); ?></option>
							<option value="0" <?php if ( $show_title === '0' ) echo 'selected'; ?> ><?php _e( 'No', PGL ); ?></option>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<label for="page_setting_enable_slider"><?php _e( 'Enable top slider', PGL ); ?></label>
					</td>
					<td>
						<select name="page_setting_enable_slider" id="page_setting_enable_slider">
							<option value="1"><?php _e( 'Yes', PGL ) ?></option>
							<option value="0" <?php if ( $enable_slider === '0' ) echo 'selected'; ?> ><?php _e( 'No', PGL ); ?></option>
						</select>
					</td>
					<td></td>
				</tr>
			</table>
		</div>
	<?php
	}

	static function output_style_color() {
		/**
		 * @var PGL_Options $pgl_options
		 */
		global $pgl_options;
		$array = array(
			'color'  => $pgl_options->option( 'color' ),
			'color2' => $pgl_options->option( 'color2' ),
			'color3' => $pgl_options->option( 'color3' ),
			'color4' => $pgl_options->option( 'color4' ),
			'color5' => $pgl_options->option( 'color5' ),
			'color6' => $pgl_options->option( 'color6' ),
		);
		echo '<script type="text/javascript">
			document.realestast_color = JSON.parse(\'' . json_encode( $array ) . '\');
		</script>';
	}

	static function output_header_code() {
		global $pgl_options;
		echo $pgl_options->option( 'header_code' );
	}

	static function output_footer_code() {
		global $pgl_options;
		echo $pgl_options->option( 'footer_code' );
	}


}


