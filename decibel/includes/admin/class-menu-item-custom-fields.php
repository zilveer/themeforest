<?php
/**
 * Menu item custom fields example
 *
 * Copy this file into your wp-content/mu-plugins directory.
 *
 * @package Menu_Item_Custom_Fields
 * @version 0.1.0
 * @author Dzikri Aziz <kvcrvt@gmail.com>
 * @see https://github.com/kucrut/wp-menu-item-custom-fields
 *
 *
 * Plugin name: Menu Item Custom Fields Example
 * Plugin URI: https://github.com/kucrut/wp-menu-item-custom-fields
 * Description: Example usage of Menu Item Custom Fields in plugins/themes
 * Version: 0.1.0
 * Author: Dzikri Aziz
 * Author URI: http://kucrut.org/
 * License: GPL v2
 * Text Domain: wolf
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Sample menu item metadata
 *
 * This class demonstrate the usage of Menu Item Custom Fields in plugins/themes.
 *
 * @since 0.1.0
 */
class Wolf_Menu_Item_Custom_Fields {

	/**
	 * Initialize plugin
	 */
	public static function init() {
		require_once( dirname( __FILE__ ) . '/menu/class-menu-item-custom-fields.php' );
		add_action( 'menu_item_custom_fields', array( __CLASS__, '_fields' ), 10, 3 );
		add_action( 'wp_update_nav_menu_item', array( __CLASS__, '_save' ), 10, 3 );
		add_filter( 'manage_nav-menus_columns', array( __CLASS__, '_columns' ), 99 );
	}

	/**
	 * Save custom field value
	 *
	 * @wp_hook action wp_update_nav_menu_item
	 *
	 * @param int   $menu_id         Nav menu ID
	 * @param int   $menu_item_db_id Menu item ID
	 * @param array $menu_item_args  Menu item data
	 */
	public static function _save( $menu_id, $menu_item_db_id, $menu_item_args ) {
		// check_admin_referer( 'update-nav_menu', 'update-nav-menu-nonce' );

		$meta_keys = array(
			'_menu-item-icon',
			'_menu-item-icon-position',
			'_mega-menu',
			'_menu-item-hidden',
			'_menu-item-button-style',
			'_mega-menu-cols',
			'_menu-item-not-linked',
			'_menu-item-scroll',
			'_menu-item-external',
			'_menu-item-background',
			'_menu-item-background-repeat',
			'_sub-menu-skin'
		);

		foreach ( $meta_keys as $meta_key ) {
			// Sanitize
			if ( ! empty( $_POST[ $meta_key ][ $menu_item_db_id ] ) ) {
				// Do some checks here...
				$value = sanitize_title( $_POST[ $meta_key ][ $menu_item_db_id ] );
			} else {
				$value = '';
			}

			// Update
			if ( ! empty( $value ) ) {
				update_post_meta( $menu_item_db_id, $meta_key, $value );
			}
			else {
				delete_post_meta( $menu_item_db_id, $meta_key );
			}
		}
	}

	/**
	 * Print field
	 *
	 * @param object $item  Menu item data object.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args  Menu item args.
	 * @param int    $id    Nav menu ID.
	 *
	 * @return string Form fields
	 */
	public static function _fields( $item, $depth, $args = array(), $id = 0 ) {
			$item_id = $item->ID;
			global $icons;
		?>
			<p>&nbsp;</p>
			<p class="field-_sub-menu-skin description description-wide">
				<label for="edit-_sub-menu-skin-<?php echo esc_attr( $item_id ) ?>"><?php _e( 'Sub menu skin (only for first level item)', 'wolf' ) ?></label>
					<br>
					<select name="_sub-menu-skin[<?php echo esc_attr( $item_id ); ?>]">
						<option value="sub-menu-dark" <?php selected( get_post_meta( $item_id, '_sub-menu-skin', true ), 'sub-menu-dark' ); ?>><?php _e( 'dark', 'wolf' ); ?></option>
						<option value="sub-menu-light" <?php selected( get_post_meta( $item_id, '_sub-menu-skin', true ), 'sub-menu-light' ); ?>><?php _e( 'light', 'wolf' ); ?></option>
					</select>
			</p>
			<p class="field-_mega-menu description description-wide">
				<label for="edit-_mega-menu-<?php echo esc_attr( $item_id ) ?>">
					<input name="_mega-menu[<?php echo esc_attr( $item_id ); ?>]" value="on" type="checkbox" <?php checked( get_post_meta( $item_id, '_mega-menu', true ), 'on' ); ?>>
					<?php _e( 'Mega Menu (only available for first level items)', 'wolf' ) ?>
				</label>
			</p>

			<p class="field-_menu-item-not-linked description description-wide">
				<label for="edit-_menu-item-not-linked-<?php echo esc_attr( $item_id ) ?>">
					<input name="_menu-item-not-linked[<?php echo esc_attr( $item_id ); ?>]" value="on" type="checkbox" <?php checked( get_post_meta( $item_id, '_menu-item-not-linked', true ), 'on' ); ?>>
					<?php _e( 'Mega Menu 2nd level or dropdown item', 'wolf' ) ?>
				</label>
			</p>

			<p class="field-_menu-item-hidden description description-wide">
				<label for="edit-_menu-item-hidden-<?php echo esc_attr( $item_id ) ?>">
					<input name="_menu-item-hidden[<?php echo esc_attr( $item_id ); ?>]" value="on" type="checkbox" <?php checked( get_post_meta( $item_id, '_menu-item-hidden', true ), 'on' ); ?>>
					<?php _e( 'Hide item on mega menu (for mega menu 2nd level only)', 'wolf' ) ?>
				</label>
			</p>

			<p class="field-_menu-item-button-style description description-wide">
				<label for="edit-_menu-item-button-style-<?php echo esc_attr( $item_id ) ?>">
					<input name="_menu-item-button-style[<?php echo esc_attr( $item_id ); ?>]" value="on" type="checkbox" <?php checked( get_post_meta( $item_id, '_menu-item-button-style', true ), 'on' ); ?>>
					<?php _e( 'Button Style (only available for first level items)', 'wolf' ) ?>
				</label>
			</p>

			<p class="field-_menu-item-scroll description description-wide">
				<label for="edit-_menu-item-scroll-<?php echo esc_attr( $item_id ) ?>">
					<input name="_menu-item-scroll[<?php echo esc_attr( $item_id ); ?>]" value="on" type="checkbox" <?php checked( get_post_meta( $item_id, '_menu-item-scroll', true ), 'on' ); ?>>
					<?php _e( 'Scroll to an anchor', 'wolf' ) ?>
				</label>
			</p>
			<p class="field-_menu-item-external description description-wide">
				<label for="edit-_menu-item-external-<?php echo esc_attr( $item_id ) ?>">
					<input name="_menu-item-external[<?php echo esc_attr( $item_id ); ?>]" value="on" type="checkbox" <?php checked( get_post_meta( $item_id, '_menu-item-external', true ), 'on' ); ?>>
					<?php _e( 'External link?', 'wolf' ) ?>
				</label>
			</p>
			<p class="field-background description description-wide">
				<?php
				$img_id = absint( get_post_meta( $item_id, '_menu-item-background', true ) );
				$img_url = wolf_get_url_from_attachment_id( $img_id );
				?>
				<label for="edit-_menu-item-background-<?php echo esc_attr( $item_id ) ?>">
					<?php _e( 'Background Image (only for 1rst level mega menu)', 'wolf' ) ?>
					<input type="hidden" name="_menu-item-background[<?php echo esc_attr( $item_id ); ?>]" id="_menu-item-background[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo absint( $img_id ); ?>">
					<img <?php if ( ! get_post_meta( $item_id, '_menu-item-background', true ) ) echo 'style="display:none;"'; ?> class="wolf-options-img-preview" src="<?php echo esc_url( $img_url ); ?>" alt="menu-bg">
					<br>
					<a href="#" class="button wolf-options-reset-img"><?php _e( 'Clear', 'wolf' ); ?></a>
					<a href="#" class="button wolf-options-set-img"><?php _e( 'Choose an image', 'wolf' ); ?></a>
				</label>
			</p>
			<p class="field-_menu-item-background-repeat description description-wide">
				<label for="edit-_menu-item-background-repeat-<?php echo esc_attr( $item_id ) ?>"><?php _e( 'Background repeat', 'wolf' ) ?></label><br>
					<select name="_menu-item-background-repeat[<?php echo esc_attr( $item_id ); ?>]">
						<option value="no-repeat" <?php selected( get_post_meta( $item_id, '_menu-item-background-repeat', true ), 'no-repeat' ); ?>><?php _e( 'no repeat', 'wolf' ); ?></option>
						<option value="repeat" <?php selected( get_post_meta( $item_id, '_menu-item-background-repeat', true ), 'repeat' ); ?>><?php _e( 'repeat', 'wolf' ); ?></option>
					</select>
			</p>
			<p class="field-custom description description-wide wolf-searchable-container">
				<label for="edit-_menu-item-icon-<?php echo esc_attr( $item_id ) ?>"><?php _e( 'Icon', 'wolf' ) ?></label><br />
					<span style="font-style:normal;"><?php printf(
						'<select data-placeholder="%1$s" name="_menu-item-icon[%2$d]" class="wolf-searchable edit-_menu-item-icon" id="edit-_menu-item-icon-%2$d">',
						__( 'None', 'wolf' ),
						$item_id
					);
					echo '<option value="">' . __( 'None', 'wolf' ) . '</option>';
					// esc_attr( get_post_meta( $item_id, '_menu-item-icon', true ) )
					foreach ( $icons as $key => $value ) {
						echo '<option value="' . esc_attr( $key ) . '"';
						selected( esc_attr( get_post_meta( $item_id, '_menu-item-icon', true ) ), $key );
						echo ">$value</option>";
					}
					echo '</select>'
					?></span>
			</p>

			<p class="field-_menu-item-icon-position description description-wide">
				<label for="edit-_menu-item-icon-position-<?php echo esc_attr( $item_id ) ?>"><?php _e( 'Icon position', 'wolf' ) ?></label>
					<br>
					<select name="_menu-item-icon-position[<?php echo esc_attr( $item_id ); ?>]">
						<option value="before" <?php selected( get_post_meta( $item_id, '_menu-item-icon-position', true ), 'before' ); ?>><?php _e( 'before', 'wolf' ); ?></option>
						<option value="after" <?php selected( get_post_meta( $item_id, '_menu-item-icon-position', true ), 'after' ); ?>><?php _e( 'after', 'wolf' ); ?></option>
					</select>
			</p>
		<?php
	}


	/**
	 * Add our field to the screen options toggle
	 *
	 * To make this work, the field wrapper must have the class 'field-custom'
	 *
	 * @param array $columns Menu item columns
	 * @return array
	 */
	public static function _columns( $columns ) {
		//$columns['_menu-item-icon'] = __( 'Icon', 'wolf' );
		//$columns['_mega-menu'] = __( 'Mega Menu', 'wolf' );
		//$columns['_menu-item-not-linked'] = __( 'Sub Menu title type', 'wolf' );
		//$columns['_menu-item-hidden'] = __( 'Sub Menu title type', 'wolf' );

		return $columns;
	}
}
Wolf_Menu_Item_Custom_Fields::init();
