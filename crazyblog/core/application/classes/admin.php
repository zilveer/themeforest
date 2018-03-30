<?php
if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_Admin {

	static public function crazyblog_Init() {
		add_action( 'init', array( 'crazyblog_Metabox', 'init' ) );
		crazyblog_Metabox::get_instance()->init();
		add_action( 'init', array( 'crazyblog_Panel', 'register' ) );
		add_action( 'widgets_init', array( 'crazyblog_Widgets', 'register' ) );
		add_action( 'widgets_init', array( 'crazyblog_Sidebars', 'register' ) );
		add_action( 'init', array( 'crazyblog_Admin', 'menus_init' ) );
		add_action( 'init', array( 'crazyblog_Shortcodes', 'init' ) );
		add_action( 'init', array( '_WST_UpdateSystem', '_wst_init' ) );
		add_action( 'admin_enqueue_scripts', array( crazyblog_View::get_instance(), 'crazyblog_admin_render_styles' ) );
		// add custom user profile meta
		add_action( 'show_user_profile', array( __CLASS__, 'crazyblog_show_extra_profile_fields' ) );
		add_action( 'edit_user_profile', array( __CLASS__, 'crazyblog_show_extra_profile_fields' ) );

		// save custom user profile meta
		add_action( 'personal_options_update', array( __CLASS__, 'crazyblog_save_extra_profile_fields' ) );
		add_action( 'edit_user_profile_update', array( __CLASS__, 'crazyblog_save_extra_profile_fields' ) );
		
		self::crazyblog_dummy();

		global $pagenow;
		if ( is_admin() ) {
			new crazyblogTaxonomy();
		}
	}

	public static function menus_init() {
		
	}

	public static function crazyblog_dummy() {
		if ( crazyblog_set( $_GET, 'page' ) == 'crazyblog_option' && crazyblog_set( $_GET, 'dummy_data_export' ) == true ) {
			locate_template( 'core/application/library/import_export.php', true );
			$obj = new crazyblog_import_export();
			$obj->export();
		}
	}

	static public function crazyblog_show_extra_profile_fields( $user ) {
		?>
		<h3><?php esc_html_e( 'Extra profile information', 'crazyblog' ) ?></h3>
		<table class="form-table">
			<?php
			$meta = array( esc_html__( 'Facebook', 'crazyblog' ) => 'crazyblog_fb', esc_html__( 'Twitter', 'crazyblog' ) => 'crazyblog_tw', esc_html__( 'Google Plus', 'crazyblog' ) => 'crazyblog_gp', esc_html__( 'Linkedin', 'crazyblog' ) => 'crazyblog_dr', esc_html__( 'Pinterest', 'crazyblog' ) => 'crazyblog_pint' );
			foreach ( $meta as $key => $t ) {
				$val = (get_the_author_meta( $t, $user->ID )) ? esc_attr( get_the_author_meta( $t, $user->ID ) ) : '';
				?>
				<tr>
					<th><label for="<?php echo esc_attr( $t ); ?>"><?php echo esc_html( $key ) ?></label></th>
					<td>
						<input type="text" name="<?php echo esc_attr( $t ) ?>" id="<?php echo esc_attr( $t ); ?>" value="<?php echo esc_attr( $val ); ?>" class="regular-text" /><br />
						<span class="description"><?php echo sprintf( esc_html__( 'Please enter your %s url.', 'crazyblog' ), $key ); ?></span>
					</td>
				</tr>
				<?php
			}
			?>
		</table>
		<?php
	}

	static public function crazyblog_save_extra_profile_fields( $user_id ) {
		if ( !current_user_can( 'edit_user', $user_id ) )
			return false;

		$meta = array( 'crazyblog_fb', 'crazyblog_tw', 'crazyblog_gp', 'crazyblog_dr', 'crazyblog_pint' );
		foreach ( $meta as $t ) {
			if ( $t ) {
				update_user_meta( $user_id, $t, crazyblog_set( $_POST, $t ) );
			}
		}
	}

}
