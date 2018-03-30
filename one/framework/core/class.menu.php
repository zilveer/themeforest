<?php

class THB_Menu {

	/**
	 * Custom fields array.
	 *
	 * @var array
	 */
	private $_fields = array();

	/**
	 * Public constructor.
	 */
	public function __construct()
	{
		add_filter( 'wp_setup_nav_menu_item', array( $this, 'addCustomFields' ) );
		add_action( 'wp_update_nav_menu_item', array( $this, 'saveCustomFields' ), 10, 3 );
		add_filter( 'wp_edit_nav_menu_walker', array( $this, 'registerCustomNavWalker' ), 10, 2 );
		add_action( 'thb_admin_menu_walker_custom_fields', array( $this, 'displayFields' ), 10, 2 );
	}

	/**
	 * Bind custom field values to the menu item object.
	 *
	 * @param stdClass $menu_item
	 * @return stdClass
	 */
	public function addCustomFields( $menu_item )
	{
		foreach ( $this->_fields as $field ) {
			$key = $field['key'];
			$menu_item->$key = get_post_meta( $menu_item->ID, '_thb_menu_item_' . $key, true );
		}

		return $menu_item;
	}

	/**
	 * Save custom field values.
	 *
	 * @param string $menu_id
	 * @param string $menu_item_db_id
	 * @param array $args
	 */
	public function saveCustomFields( $menu_id, $menu_item_db_id, $args )
	{
		foreach ( $this->_fields as $field ) {
			$key = $field['key'];

			if ( isset( $_REQUEST['menu-item-' . $key] ) && is_array( $_REQUEST['menu-item-' . $key] ) ) {
				$value = '';

				if ( isset( $_REQUEST['menu-item-' . $key][$menu_item_db_id] ) ) {
					$value = $_REQUEST['menu-item-' . $key][$menu_item_db_id];
				}

				update_post_meta( $menu_item_db_id, '_thb_menu_item_' . $key, $value );
			}
		}
	}

	/**
	 * Register the custom navigation walker for admin menus.
	 *
	 * @param $walker
	 * @param string $menu_id
	 * @return string
	 */
	public function registerCustomNavWalker( $walker, $menu_id )
	{
		return 'THB_AdminMenuNavWalker';
	}

	/**
	 * Add a custom field to the menu item.
	 *
	 * @param string $key
	 * @param string $type
	 * @param array $args
	 */
	private function addField( $key, $type, $args = array() )
	{
		$args = wp_parse_args( $args, array(
			'label'   => '',
			'help'    => '',
			'options' => array(),
			'depth'   => true
		) );

		$this->_fields[] = array(
			'key'     => $key,
			'type'    => $type,
			'label'   => $args['label'],
			'help'    => $args['help'],
			'options' => $args['options'],
			'depth'   => (array) $args['depth'],
		);
	}

	/**
	 * Add a custom text input field.
	 *
	 * @param boolean/integer $depth
	 * @param string $key
	 * @param string $label
	 * @param string $help
	 */
	public function addTextField( $depth, $key, $label = '', $help = '' )
	{
		$this->addField( $key, 'text', array(
			'label' => $label,
			'help'  => $help,
			'depth' => $depth
		) );
	}

	/**
	 * Add a custom checkbox input field.
	 *
	 * @param boolean/integer $depth
	 * @param string $key
	 * @param string $label
	 * @param string $help
	 */
	public function addCheckboxField( $depth, $key, $label = '', $help = '' )
	{
		$this->addField( $key, 'checkbox', array(
			'label' => $label,
			'help'  => $help,
			'depth' => $depth
		) );
	}

	/**
	 * Add a custom select input field.
	 *
	 * @param boolean/integer $depth
	 * @param string $key
	 * @param string $label
	 * @param array $options
	 * @param string $help
	 */
	public function addSelectField( $depth, $key, $label = '', $options = array(), $help = '' )
	{
		$this->addField( $key, 'select', array(
			'label'   => $label,
			'help'    => $help,
			'options' => $options,
			'depth'   => $depth
		) );
	}

	public function addUploadField( $depth, $key, $label = '', $options = array(), $help = '' )
	{
		$this->addField( $key, 'upload', array(
			'label'   => $label,
			'help'    => $help,
			'options' => $options,
			'depth'   => $depth
		) );
	}

	/**
	 * Display the menu item custom fields.
	 *
	 * @param stdClass $item
	 */
	public function displayFields( $item )
	{
		foreach ( $this->_fields as $field ) {
			$this->displayField( $field, $item, esc_attr( $item->ID ) );
		}
	}

	/**
	 * Display a custom field.
	 *
	 * @param array $field
	 * @param stdClass $item
	 * @param int $item_id
	 */
	public function displayField( $field, $item, $item_id )
	{
		$key = $field['key'];
		$label = isset( $field['label'] ) ? $field['label'] : '';
		$depth = isset( $field['depth'] ) ? $field['depth'] : array();
		$value = isset( $item->$key ) ? esc_attr( $item->$key ): '';

		$depth_classes = array();

		foreach ( $depth as $d ) {
			$depth_classes[] = 'thb-menu-item-field-depth-' . $d;
		}

		?>
		<p class="field-custom description description-wide thb-menu-item-field thb-menu-item-field-<?php echo $key; ?> <?php echo implode( ' ', $depth_classes ); ?>">
		    <label for="edit-menu-item-<?php echo $key; ?>-<?php echo $item_id; ?>">
		    	<?php echo $label; ?><br />
		    	<?php
		    		switch( $field['type'] ) {
						case 'select':
							$this->displaySelectField( $key, $item_id, $field['options'], $value );
							break;
		    			case 'checkbox':
		    				$this->displayCheckboxField( $key, $item_id, $value );
		    				break;
		    			case 'upload':
		    				$this->displayUploadField( $key, $item_id, $value );
		    				break;
		    			case 'text':
		    			default:
		    				$this->displayTextField( $key, $item_id, $value );
		    				break;
		    		}
		    	?>
		    	<span class="description"><?php echo $field['help']; ?></span>
		    </label>
		</p>
		<?php
	}

	/**
	 * Display a custom text input field.
	 *
	 * @param string $key
	 * @param int $item_id
	 * @param string $value
	 */
	private function displayTextField( $key, $item_id, $value )
	{
		printf( '<input type="text" id="edit-menu-item-%s-%s" class="widefat edit-menu-item-custom" name="menu-item-%s[%s]" value="%s" />', $key, $item_id, $key, $item_id, $value );
	}

	/**
	 * Display a custom checkbox input field.
	 *
	 * @param string $key
	 * @param int $item_id
	 * @param string $value
	 */
	private function displayCheckboxField( $key, $item_id, $value )
	{
		$checked = $value == '1' ? 'checked' : '';

		printf( '<input type="hidden" name="menu-item-%s[%s]" value="0" />', $key, $item_id );
		printf( '<input type="checkbox" id="edit-menu-item-%s-%s" class="widefat edit-menu-item-custom" name="menu-item-%s[%s]" value="1" %s />', $key, $item_id, $key, $item_id, $checked );
	}

	/**
	 * Display a custom upload input field.
	 *
	 * @param string $key
	 * @param int $item_id
	 * @param string $value
	 */
	private function displayUploadField( $key, $item_id, $value )
	{
		thb_partial_upload( array(
			'field_name'  => sprintf( 'menu-item-%s[%s]', $key, $item_id ),
			'field_value' => $value,
			'field_label' => ''
		) );
	}

	/**
	 * Display a custom select input field.
	 *
	 * @param string $key
	 * @param int $item_id
	 * @param array $options
	 * @param string $value
	 */
	private function displaySelectField( $key, $item_id, $options, $value )
	{
		printf( '<select name="menu-item-%s[%s]" class="widefat edit-menu-item-custom">', $key, $item_id );

		foreach ( $options as $v => $l ) {
			$selected = $value == $v ? 'selected' : '';
			printf( '<option value="%s" %s>%s</option>', $v, $selected, $l );
		}

		printf( '</select>' );
	}

}