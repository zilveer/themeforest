<?php
/**
 * Functions and Hooks for customize menu item
 *
 * @package learn
 */

if( !defined( 'ABSPATH' ) ) {
	exit;
}

if( !class_exists( 'Walker_Nav_Menu_Edit' ) ) {
	require_once ABSPATH . 'wp-admin/includes/nav-menu.php';
}

/**
 * Class to add new custom fields to menu item
 *
 * @link https://github.com/kucrut/wp-menu-item-custom-fields
 *
 * @since 1.0
 */
class learn_Walker_Nav_Menu_Custom_Fields {
	/**
	 * Holds our custom fields
	 *
	 * @var    array
	 * @access protected
	 * @since  1.0.0
	 */
	protected $fields = array();

	/**
	 * Initialize
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_filter( 'wp_edit_nav_menu_walker', array( $this, 'menu_walker' ) );
		add_filter( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		//add_filter( 'manage_nav-menus_columns', array( $this, 'columns' ), 99 );

		$this->fields = array(
			'mega_menu'       => esc_html__( 'Mega Menu', 'learn' ),
			'mega_menu_width' => esc_html__( 'Mega Menu Width', 'learn' ),
			'column'          => esc_html__( 'Column Width', 'learn' ),
			'content'         => esc_html__( 'Content', 'learn' ),
			'hide_text'       => esc_html__( 'Hide Text', 'learn' ),
			'bg_image'        => esc_html__( 'Background Image', 'learn' ),
			'bg_h_position'   => esc_html__( 'Horizontal Position', 'learn' ),
			'bg_v_position'   => esc_html__( 'Vertical Position', 'learn' ),
			'bg_repeat'       => esc_html__( 'Repeat', 'learn' ),
			'bg_size'         => esc_html__( 'Size', 'learn' ),
		);

		add_action( 'wp_ajax_learn_mega_menu', array( $this, 'learn_save_mega_menu' ) );
		add_action( 'wp_ajax_nopriv_learn_mega_menu', array( $this, 'learn_save_mega_menu' ) );

		add_action( 'wp_ajax_learn_mega_fields', array( $this, 'learn_mega_fields' ) );
		add_action( 'wp_ajax_nopriv_learn__mega_fields', array( $this, 'learn_mega_fields' ) );
	}

	/**
	 * Enqueue scripts and styles
	 *
	 * @since  1.0.0
	 * @param  string $hook
	 */
	public function enqueue_scripts( $hook ) {
		if( 'nav-menus.php' != $hook ) {
			return;
		}
		wp_enqueue_media();

		wp_enqueue_style( 'learn-nav-menus', get_template_directory_uri() . '/css/nav-menus.css', array(), false );
		wp_enqueue_script( 'learn-nav-menus', get_template_directory_uri() . '/js/nav-menus.js', array(), false );
		wp_localize_script( 'learn-nav-menus', 'learn', array(
			'nonce'    => wp_create_nonce( '_learn_nonce' ),
			'megamenu' => esc_html__( 'Mega Menu', 'learn' ),
			'savemenu' => esc_html__( 'Save Menu', 'learn' )
		) );
	}

	/**
	 * Save custom field value
	 *
	 */
	public function learn_save_mega_menu() {
		check_ajax_referer( '_learn_nonce', 'lpnonce' );

		$menu_id = $_POST['menu_id'];

		foreach( $this->fields as $name => $label ) {
			$key = sprintf( 'menu-item-%s', $name );
			// Sanitize
			if( !empty($_POST[$name]) ) {
				$value = $_POST[$name];
			} else {
				$value = null;
			}
			// Update
			if( !is_null( $value ) ) {
				update_post_meta( $menu_id, $key, $value );
			} else {
				delete_post_meta( $menu_id, $key );
			}
		}

		echo $menu_id;

		die();
	}

	/**
	 * Print fields
	 *
	 * @return string Form fields
	 */
	public function learn_mega_fields() {
		check_ajax_referer( '_learn_nonce', 'lpnonce' );

		$menu_id = $_POST['menu_id'];
		$mega = get_post_meta( $menu_id, 'menu-item-mega_menu', true );
		$width = get_post_meta( $menu_id, 'menu-item-mega_menu_width', true );
		$column = get_post_meta( $menu_id, 'menu-item-column', true );
		$content = get_post_meta( $menu_id, 'menu-item-content', true );
		$bg_image = get_post_meta( $menu_id, 'menu-item-bg_image', true );
		$bg_h_position = get_post_meta( $menu_id, 'menu-item-bg_h_position', true );
		$bg_v_position = get_post_meta( $menu_id, 'menu-item-bg_v_position', true );
		$bg_size = get_post_meta( $menu_id, 'menu-item-bg_size', true );
		$bg_repeat = get_post_meta( $menu_id, 'menu-item-bg_repeat', true );
		$hide_text = get_post_meta( $menu_id, 'menu-item-hide_text', true );

		$class_image = '';
		if( $bg_image ) {
			$class_image = 'has-image';
		}

		ob_start();
		?>

		<input type="hidden" id="edit-item-mega-menu-id" value="<?php echo esc_attr( $menu_id ) ?>"/>

		<div class="field-mega-menu">
			<label><?php echo $this->fields['mega_menu'] ?></label>
			<input type="checkbox" value="<?php echo esc_attr( $mega ); ?>"
				   id="edit-item-mega-menu" <?php checked( 1, $mega ) ?>/>
		</div>

		<div class="clear"></div>

		<div class="field-mega-menu field-mega-menu-hide-text field-not-mega-menu">
			<label><?php echo $this->fields['hide_text'] ?></label>
			<input type="checkbox" value="<?php echo esc_attr( $hide_text ); ?>"
				   id="edit-item-mega-menu-hide_text" <?php checked( 1, $hide_text ) ?>/>
		</div>

		<div class="field-mega-column field-mega-menu field-not-mega-menu">
			<label><?php echo $this->fields['column'] ?></label>
			<select id="edit-item-mega-menu-column">
				<option value="12" <?php selected( 12, $column ); ?>>1/1</option>
				<option value="6" <?php selected( 6, $column ); ?>>1/2</option>
				<option value="4" <?php selected( 4, $column ); ?>>1/3</option>
				<option value="3" <?php selected( 3, $column ); ?>>1/4</option>
				<option value="8" <?php selected( 8, $column ); ?>>2/3</option>
				<option value="9" <?php selected( 9, $column ); ?>>3/4</option>
			</select>
		</div>

		<div class="clear"></div>

		<div class="field-mega-menu-width field-mega-menu field-of-mega-menu">
			<label><?php echo $this->fields['mega_menu_width'] ?></label>
			<input type="text" id="edit-item-mega-menu-width" value="<?php echo esc_attr( $width ) ?>"
				   placeholder="100%"/>
		</div>

		<div class="clear"></div>

		<div class="field-mega-menu-bg_image field-mega-menu field-of-mega-menu">
			<label><?php echo $this->fields['bg_image'] ?></label>

			<div class="background-preview <?php echo esc_attr( $class_image ); ?>" id="background-preview"
				 style="background-image: url( <?php echo esc_url( $bg_image ); ?> )">
				<button type="button" id="upload-image"
						class="btn-select"><?php esc_html_e( 'Upload Image', 'learn' ); ?></button>
				<input type="hidden" id="edit-item-mega-menu-bg_image" value="<?php echo esc_url( $bg_image ); ?>">
				<button type="button" id="remove-image"
						class="btn-select btn-remove"><?php esc_html_e( 'Remove Image', 'learn' ); ?></button>
			</div>
		</div>

		<div class="field-mega-menu-bg_content field-mega-menu field-of-mega-menu">
			<p>
				<label><?php echo $this->fields['bg_h_position'] ?></label>
				<select id="edit-item-mega-menu-bg_h_position">
					<option
						value="left" <?php selected( 'left', $bg_h_position ); ?>><?php esc_html_e( 'Left', 'learn' ) ?></option>
					<option
						value="right" <?php selected( 'right', $bg_h_position ); ?>><?php esc_html_e( 'Right', 'learn' ) ?></option>
					<option
						value="center" <?php selected( 'center', $bg_h_position ); ?>><?php esc_html_e( 'Center', 'learn' ) ?></option>
				</select>
			</p>

			<p>
				<label><?php echo $this->fields['bg_v_position'] ?></label>
				<select id="edit-item-mega-menu-bg_v_position">
					<option
						value="top" <?php selected( 'top', $bg_v_position ); ?>><?php esc_html_e( 'Top', 'learn' ) ?></option>
					<option
						value="bottom" <?php selected( 'bottom', $bg_v_position ); ?>><?php esc_html_e( 'Bottom', 'learn' ) ?></option>
					<option
						value="center" <?php selected( 'center', $bg_v_position ); ?>><?php esc_html_e( 'Center', 'learn' ) ?></option>
				</select>
			</p>

			<p>
				<label><?php echo $this->fields['bg_repeat'] ?></label>
				<select id="edit-item-mega-menu-bg_repeat">
					<option
						value="no-repeat" <?php selected( 'no-repeat', $bg_repeat ); ?>><?php esc_html_e( 'No Repeat', 'learn' ) ?></option>
					<option
						value="repeat" <?php selected( 'repeat', $bg_repeat ); ?>><?php esc_html_e( 'Repeat', 'learn' ) ?></option>
					<option
						value="repeat-x" <?php selected( 'repeat-x', $bg_repeat ); ?>><?php esc_html_e( 'Repeat Horizontally', 'learn' ) ?></option>
					<option
						value="repeat-y" <?php selected( 'repeat-y', $bg_repeat ); ?>><?php esc_html_e( 'Repeat Vertically', 'learn' ) ?></option>
				</select>
			</p>
			<p>
				<label><?php echo $this->fields['bg_size'] ?></label>
				<select id="edit-item-mega-menu-bg_size">
					<option
						value="" <?php selected( '', $bg_size ); ?>><?php esc_html_e( 'Normal', 'learn' ) ?></option>
					<option
						value="contain" <?php selected( 'contain', $bg_size ); ?>><?php esc_html_e( 'Contain', 'learn' ) ?></option>
					<option
						value="cover" <?php selected( 'cover', $bg_size ); ?>><?php esc_html_e( 'Cover', 'learn' ) ?></option>
				</select>
			</p>

		</div>

		<div class="clear"></div>

		<div class="field-mega-content field-mega-menu field-not-mega-menu">
			<label><?php echo $this->fields['content'] ?></label>
			<textarea id="edit-item-mega-menu-content"><?php echo esc_html( $content ); ?></textarea><br>
			<span class="description"><?php _e( 'HTML and Shortcodes are allowed', 'learn' ); ?></span>
		</div>
		<?php
		$output = ob_get_clean();

		wp_send_json_success( $output );

		die();
	}

	/**
	 * Add our fields to the screen options toggle
	 *
	 * @since 1.0.0
	 *
	 * @param array $columns Menu item columns
	 *
	 * @return array
	 */
	public function columns( $columns ) {
		$columns = array_merge( $columns, $this->fields );
		return $columns;
	}

	/**
	 * Replace default menu editor walker with theme's
	 *
	 * We don't actually replace the default walker. We're still using it and
	 * only injecting some HTMLs.
	 *
	 * @since   1.0.0
	 *
	 * @param   string $walker Walker class name
	 *
	 * @return  string Walker class name
	 */
	public function menu_walker( $walker ) {
		$walker = 'learn_Walker_Nav_Menu_Edit';

		return $walker;
	}

}

/**
 * Menu item custom fields walker
 *
 * @link https://github.com/kucrut/wp-menu-item-custom-fields
 *
 * @since 1.0
 */
class learn_Walker_Nav_Menu_Edit extends Walker_Nav_Menu_Edit {
	/**
	 * Start the element output.
	 *
	 * @see Walker_Nav_Menu::start_el()
	 * @since 1.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param array $args Not used.
	 * @param int $id Not used.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$item_output = '';
		parent::start_el( $item_output, $item, $depth, $args );

		$output .= preg_replace(
		// NOTE: Check this regex from time to time!
			'/(?=<p[^>]+class="[^"]*field-move)/',
			$this->get_fields( $item, $depth, $args ),
			$item_output
		);
	}

	/**
	 * Get custom fields
	 *
	 * @since 1.0.0
	 * @uses add_action() Calls 'menu_item_custom_fields' hook
	 *
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param array $args Menu item args.
	 * @param int $id Nav menu ID.
	 *
	 * @return string Form fields
	 */
	protected function get_fields( $item, $depth, $args = array(), $id = 0 ) {
		ob_start();

		/**
		 * Get menu item custom fields from plugins/themes
		 *
		 * @since 1.0.0
		 *
		 * @param object $item Menu item data object.
		 * @param int $depth Depth of menu item. Used for padding.
		 * @param array $args Menu item args.
		 * @param int $id Nav menu ID.
		 *
		 * @return string Custom fields
		 */
		do_action( 'wp_nav_menu_item_custom_fields', $id, $item, $depth, $args );

		return ob_get_clean();
	}
}
