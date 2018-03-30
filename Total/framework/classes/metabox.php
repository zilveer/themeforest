<?php
/**
 * Adds custom metaboxes to the WordPress categories
 * Developed & Designed exclusively for the Total WordPress theme
 *
 * @package Total WordPress Theme
 * @subpackage Framework
 * @version 3.5.3
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// The Metabox class
class WPEX_Post_Metaboxes {
	private $post_types;

	/**
	 * Register this class with the WordPress API
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		// Post types to add the metabox to
		$this->post_types = apply_filters( 'wpex_main_metaboxes_post_types', array(
			'post'         => 'post',
			'page'         => 'page',
			'portfolio'    => 'portfolio',
			'staff'        => 'staff',
			'testimonials' => 'testimonials',
			'page'         => 'page',
			'product'      => 'product',
		) );

		// Add metabox to corresponding post types
		if ( $this->post_types ) {

			foreach( $this->post_types as $key => $val ) {

				// Adds the metabox
				add_action( 'add_meta_boxes_'. $val, array( $this, 'post_meta' ), 11 );

			}
			
		}

		// Save meta
		add_action( 'save_post', array( $this, 'save_meta_data' ) );

		// Load scripts for the metabox
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );

		// Load custom css for metabox
		add_action( 'admin_print_styles-post.php', array( $this, 'metaboxes_css' ) );
		add_action( 'admin_print_styles-post-new.php', array( $this, 'metaboxes_css' ) );

		// Load custom js for metabox
		add_action( 'admin_footer-post.php', array( $this, 'metaboxes_js' ) );
		add_action( 'admin_footer-post-new.php', array( $this, 'metaboxes_js' ) );

	}

	/**
	 * The function responsible for creating the actual meta box.
	 *
	 * @since 1.0.0
	 */
	public function post_meta( $post ) {

		// Disable on footer builder
		$footer_builder_page = wpex_get_mod( 'footer_builder_page_id' );
		if ( 'page' == get_post_type( $post->ID ) && $footer_builder_page == $post->ID ) {
			return;
		}

		// Add metabox
		$obj = get_post_type_object( $post->post_type );
		add_meta_box(
			'wpex-metabox',
			$obj->labels->singular_name . ' '. esc_html__( 'Settings', 'total' ),
			array( $this, 'display_meta_box' ),
			$post->post_type,
			'normal',
			'high'
		);

	}

	/**
	 * Enqueue scripts and styles needed for the metaboxes
	 *
	 * @since 1.0.0
	 */
	public static function admin_enqueue_scripts() {
		wp_enqueue_media();
		wp_enqueue_script( 'jquery' );
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );
	}

	/**
	 * Renders the content of the meta box.
	 *
	 * @since 1.0.0
	 */
	public function display_meta_box( $post ) {

		// Add an nonce field so we can check for it later.
		wp_nonce_field( 'wpex_metabox', 'wpex_metabox_nonce' );

		// Get current post data
		$post_id   = $post->ID;
		$post_type = get_post_type();

		// Get tabs
		$tabs = $this->meta_array( $post );

		// Make sure tabs aren't empty
		if ( empty( $tabs ) ) {
			echo '<p>'. esc_html__( 'This page doesnt have any meta settings.', 'total' ) .'</p>';
			return;
		}

		// Store tabs that should display on this specific page in an array for use later
		$active_tabs = array();
		foreach ( $tabs as $tab ) {
			$tab_post_type = isset( $tab['post_type'] ) ? $tab['post_type'] : '';
			if ( ! $tab_post_type ) {
				$display_tab = true;
			} elseif ( in_array( $post_type, $tab_post_type ) ) {
				$display_tab = true;
			} else {
				$display_tab = false;
			}
			if ( $display_tab ) {
				$active_tabs[] = $tab;
			}
		} ?>

		<ul class="wp-tab-bar">
			<?php
			// Output tab links
			$wpex_count = '';
			foreach ( $active_tabs as $tab ) {
				$wpex_count++;
				// Define tab title
				$tab_title = $tab['title'] ? $tab['title'] : esc_html__( 'Other', 'total' ); ?>
				<li<?php if ( '1' == $wpex_count ) echo ' class="wp-tab-active"'; ?>>
					<a href="javascript:;" data-tab="#wpex-mb-tab-<?php echo $wpex_count; ?>"><?php echo $tab_title; ?></a>
				</li>
			<?php } ?>
		</ul><!-- .wpex-mb-tabnav -->

		<?php
		// Output tab sections
		$wpex_count = '';
		foreach ( $active_tabs as $tab ) {
			$wpex_count++; ?>
			<div id="wpex-mb-tab-<?php echo $wpex_count; ?>" class="wp-tab-panel clr">
				<table class="form-table">
					<?php
					// Loop through sections and store meta output
					foreach ( $tab['settings'] as $setting ) {

						// Vars
						$meta_id     = $setting['id'];
						$title       = $setting['title'];
						$hidden      = isset( $setting['hidden'] ) ? $setting['hidden'] : false;
						$type        = isset( $setting['type'] ) ? $setting['type'] : 'text';
						$default     = isset( $setting['default'] ) ? $setting['default'] : '';
						$description = isset( $setting['description'] ) ? $setting['description'] : '';
						$meta_value  = get_post_meta( $post_id, $meta_id, true );
						$meta_value  = $meta_value ? $meta_value : $default; ?>

						<tr<?php if ( $hidden ) echo ' style="display:none;"'; ?> id="<?php echo esc_attr( $meta_id ); ?>_tr">
							<th>
								<label for="wpex_main_layout"><strong><?php echo $title; ?></strong></label>
								<?php
								// Display field description
								if ( $description ) { ?>
									<p class="wpex-mb-description"><?php echo $description; ?></p>
								<?php } ?>
							</th>

							<?php
							// Text Field
							if ( 'text' == $type ) { ?>

								<td><input name="<?php echo esc_attr( $meta_id ); ?>" type="text" value="<?php echo esc_attr( $meta_value ); ?>"></td>

							<?php
							}

							// Date Field
							elseif ( 'date' == $type ) {
								wp_enqueue_script( 'jquery-ui' );
								wp_enqueue_script( 'jquery-ui-datepicker', array( 'jquery-ui' ) );
								wp_enqueue_style( 'jquery-ui-datepicker-style', '//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css' ); ?>

								<td><input class="wpex-date-meta" name="<?php echo esc_attr( $meta_id ); ?>" type="text" value="<?php echo esc_attr( $meta_value ); ?>"></td>

							<?php }

							// Number Field
							elseif ( 'number' == $type ) {
								
								$step = isset( $setting['step'] ) ? $setting['step'] : '1';
								$min  = isset( $setting['min'] ) ? $setting['min'] : '1';
								$max  = isset( $setting['max'] ) ? $setting['max'] : '10'; ?>

								<td>
									<input name="<?php echo esc_attr( $meta_id ); ?>" type="number" value="<?php echo esc_attr( $meta_value ); ?>" step="<?php echo floatval( $step ); ?>" min="<?php echo floatval( $min ); ?>" max="<?php echo floatval( $max ); ?>">
								</td>

							<?php }

							// HTML Text
							elseif ( 'text_html' == $type ) { ?>

								<td><input name="<?php echo esc_attr( $meta_id ); ?>" type="text" value="<?php echo esc_html( $meta_value ); ?>"></td>

							<?php }

							// Link field
							elseif ( 'link' == $type ) {

								// Sanitize
								$meta_value = ( 'home_url' == $meta_value ) ? esc_html( $meta_value ) : esc_url( $meta_value ); ?>

								<td><input name="<?php echo esc_attr( $meta_id ); ?>" type="text" value="<?php echo $meta_value; ?>"></td>

							<?php }

							// Textarea Field
							elseif ( 'textarea' == $type ) {
								$rows = isset ( $setting['rows'] ) ? $setting['rows'] : '4';?>

								<td>
									<textarea rows="<?php echo $rows; ?>" cols="1" name="<?php echo esc_attr( $meta_id ); ?>" type="text" class="wpex-mb-textarea"><?php echo $meta_value; ?></textarea>
								</td>

							<?php }

							// Code Field
							elseif ( 'code' == $type ) { ?>

								<td>
									<textarea rows="1" cols="1" name="<?php echo esc_attr( $meta_id ); ?>" type="text" class="wpex-mb-textarea-code"><?php echo $meta_value; ?></textarea>
								</td>

							<?php }

							// Checkbox
							elseif ( 'checkbox' == $type ) {

								$meta_value = ( 'on' != $meta_value ) ? false : true; ?>
								<td><input name="<?php echo esc_attr( $meta_id ); ?>" type="checkbox" <?php checked( $meta_value, true, true ); ?>></td>

							<?php }

							// Select
							elseif ( 'select' == $type ) {

								$options = isset ( $setting['options'] ) ? $setting['options'] : '';
								if ( ! empty( $options ) ) { ?>
									<td><select id="<?php echo esc_attr( $meta_id ); ?>" name="<?php echo esc_attr( $meta_id ); ?>">
									<?php foreach ( $options as $option_value => $option_name ) { ?>
										<option value="<?php echo $option_value; ?>" <?php selected( $meta_value, $option_value, true ); ?>><?php echo $option_name; ?></option>
									<?php } ?>
									</select></td>
								<?php }

							}

							// Select
							elseif ( 'color' == $type ) { ?>

								<td><input name="<?php echo esc_attr( $meta_id ); ?>" type="text" value="<?php echo esc_attr( $meta_value ); ?>" class="wpex-mb-color-field"></td>

							<?php }

							// Media
							elseif ( 'media' == $type ) {

								// Validate data if array - old Redux cleanup
								if ( is_array( $meta_value ) ) {
									if ( ! empty( $meta_value['url'] ) ) {
										$meta_value = $meta_value['url'];
									} else {
										$meta_value = '';
									}
								} ?>
								<td>
									<div class="uploader">
									<input type="text" name="<?php echo esc_attr( $meta_id ); ?>" value="<?php echo esc_attr( $meta_value ); ?>">
									<input class="wpex-mb-uploader button-secondary" name="<?php echo esc_attr( $meta_id ); ?>" type="button" value="<?php esc_html_e( 'Upload', 'total' ); ?>" />
									<?php /* if ( $meta_value ) {
											if ( is_numeric( $meta_value ) ) {
												$meta_value = wp_get_attachment_image_src( $meta_value, 'full' );
												$meta_value = $meta_value[0];
											} ?>
										<div class="wpex-mb-thumb" style="padding-top:10px;"><img src="<?php echo $meta_value; ?>" height="40" width="" style="height:40px;width:auto;max-width:100%;" /></div>
									<?php } */ ?>
									</div>
								</td>

							<?php }

							// Editor
							elseif ( 'editor' == $type ) {
								$teeny= isset( $setting['teeny'] ) ? $setting['teeny'] : false;
								$rows = isset( $setting['rows'] ) ? $setting['rows'] : '10';
								$media_buttons= isset( $setting['media_buttons'] ) ? $setting['media_buttons'] : true; ?>
								<td><?php wp_editor( $meta_value, $meta_id, array(
									'textarea_name' => $meta_id,
									'teeny'         => $teeny,
									'textarea_rows' => $rows,
									'media_buttons' => $media_buttons,
								) ); ?></td>
							<?php } ?>
						</tr>

					<?php } ?>
				</table>
			</div>
		<?php } ?>

		<div class="wpex-mb-reset">
			<a class="button button-secondary wpex-reset-btn"><?php esc_html_e( 'Reset Settings', 'total' ); ?></a>
			<div class="wpex-reset-checkbox"><input type="checkbox" name="wpex_metabox_reset"> <?php esc_html_e( 'Are you sure? Check this box, then update your post to reset all settings.', 'total' ); ?></div>
		</div>

		<div class="clear"></div>

	<?php }

	/**
	 * Save metabox data
	 *
	 * @since 1.0.0
	 */
	public function save_meta_data( $post_id ) {

		/*
		 * We need to verify this came from our screen and with proper authorization,
		 * because the save_post action can be triggered at other times.
		 */

		// Check if our nonce is set.
		if ( ! isset( $_POST['wpex_metabox_nonce'] ) ) {
			return;
		}

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $_POST['wpex_metabox_nonce'], 'wpex_metabox' ) ) {
			return;
		}

		// If this is an autosave, our form has not been submitted, so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		// Check the user's permissions.
		if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return;
			}

		} else {

			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return;
			}
		}

		/* OK, it's safe for us to save the data now. Now we can loop through fields */

		// Check reset field
		$reset = isset( $_POST['wpex_metabox_reset'] ) ? $_POST['wpex_metabox_reset'] : '';

		// Get array of settings to save
		$tabs = $this->meta_array();
		$settings = array();
		foreach( $tabs as $tab ) {
			foreach ( $tab['settings'] as $setting ) {
				$settings[] = $setting;
			}
		}

		// Loop through settings and validate
		foreach ( $settings as $setting ) {

			// Vars
			$value = '';
			$id    = $setting['id'];
			$type  = isset ( $setting['type'] ) ? $setting['type'] : 'text';

			// Make sure field exists and if so validate the data
			if ( isset( $_POST[$id] ) ) {

				// Validate text
				if ( 'text' == $type ) {
					$value = sanitize_text_field( $_POST[$id] );
				}

				// Validate textarea
				if ( 'textarea' == $type ) {
					$value = esc_html( $_POST[$id] );
				}

				// Links
				elseif ( 'link' == $type ) {
					$value = esc_url( $_POST[$id] );
				}

				// Validate select
				elseif ( 'select' == $type ) {
					if ( 'default' == $_POST[$id] ) {
						$value = '';
					} else {
						$value = $_POST[$id];
					}
				}

				// Validate media
				elseif ( 'media' == $type ) {

					// Sanitize
					$value = $_POST[$id];

					// Move old wpex_post_self_hosted_shortcode_redux to wpex_post_self_hosted_media
					if ( 'wpex_post_self_hosted_media' == $id && empty( $_POST[$id] ) && $old = get_post_meta( $post_id, 'wpex_post_self_hosted_shortcode_redux', true ) ) {
						$value = $old;
						delete_post_meta( $post_id, 'wpex_post_self_hosted_shortcode_redux' );
					}

				}

				// Validate editor
				if ( 'editor' == $type ) {

					$value = $_POST[$id];
					$value = ( '<p><br data-mce-bogus="1"></p>' == $value ) ? '' : $value;

				}

				// All else
				else {
					$value = $_POST[$id];
				}

				// Update meta if value exists
				if ( $value && 'on' != $reset ) {
					update_post_meta( $post_id, $id, $value );
				}

				// Otherwise cleanup stuff
				else {
					delete_post_meta( $post_id, $id );
				}
			}

		}

	}

	/**
	 * Helpers
	 *
	 * @since 1.0.0
	 */
	public static function helpers( $return = NULl ) {


		// Return array of WP menus
		if ( 'menus' == $return ) {
			$menus = array( esc_html__( 'Default', 'total' ) );
			$get_menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
			foreach ( $get_menus as $menu) {
				$menus[$menu->term_id] = $menu->name;
			}
			return $menus;
		}

		// Title styles
		elseif ( 'title_styles' == $return ) {
			return apply_filters( 'wpex_title_styles', array(
				''                 => esc_html__( 'Default', 'total' ),
				'centered'         => esc_html__( 'Centered', 'total' ),
				'centered-minimal' => esc_html__( 'Centered Minimal', 'total' ),
				'background-image' => esc_html__( 'Background Image', 'total' ),
				'solid-color'      => esc_html__( 'Solid Color & White Text', 'total' ),
			) );
		}

		// Widgets
		elseif ( 'widget_areas' == $return ) {
			$widget_areas = array( esc_html__( 'Default', 'total' ) );
			$widget_areas = $widget_areas + wpex_get_widget_areas();
			return $widget_areas;
		}

	}

	/**
	 * Settings Array
	 *
	 * @since 1.0.0
	 */
	private function meta_array( $post = null ) {

		// Prefix
		$prefix = 'wpex_';

		// Define array
		$array = array();

		// Store repeatable strings as vars
		$s_default = esc_html__( 'Default', 'total' );
		$s_enable  = esc_html__( 'Enable', 'total' );
		$s_disable = esc_html__( 'Disable', 'total' );

		// Main Tab
		$array['main'] = array(
			'title' => esc_html__( 'Main', 'total' ),
			'settings' => array(
				'post_link' => array(
					'title' => esc_html__( 'Redirect', 'total' ),
					'id' => $prefix . 'post_link',
					'type' => 'link',
					'description' => esc_html__( 'Enter a url to redirect this post or page.', 'total' ),
				),
				'main_layout' =>array(
					'title' => esc_html__( 'Site Layout', 'total' ),
					'type' => 'select',
					'id' => $prefix . 'main_layout',
					'description' => esc_html__( 'Select the layout for your site. This option should only be used in very specific cases such as landing.', 'total' ),
					'options' => array(
						'' => $s_default,
						'full-width' => esc_html__( 'Full-Width', 'total' ),
						'boxed' => esc_html__( 'Boxed', 'total' ),
					),
				),
				'post_layout' => array(
					'title' => esc_html__( 'Content Layout', 'total' ),
					'type' => 'select',
					'id' => $prefix . 'post_layout',
					'description' => esc_html__( 'Select your custom layout for this page or post content.', 'total' ),
					'options' => wpex_get_post_layouts(),
				),
				'sidebar' => array(
					'title' => esc_html__( 'Sidebar', 'total' ),
					'type' => 'select',
					'id' => 'sidebar',
					'description' => esc_html__( 'Select your a custom sidebar for this page or post.', 'total' ),
					'options' => $this->helpers( 'widget_areas' ),
				),
				'disable_toggle_bar' => array(
					'title' => esc_html__( 'Toggle Bar', 'total' ),
					'id' => $prefix . 'disable_toggle_bar',
					'type' => 'select',
					'description' => esc_html__( 'Enable or disable this element on this page or post.', 'total' ),
					'options' => array(
						'' => $s_default,
						'enable' => $s_enable,
						'on' => $s_disable,
					),
				),
				'disable_top_bar' => array(
					'title' => esc_html__( 'Top Bar', 'total' ),
					'id' => $prefix . 'disable_top_bar',
					'type' => 'select',
					'description' => esc_html__( 'Enable or disable this element on this page or post.', 'total' ),
					'options' => array(
						'' => $s_default,
						'enable' => $s_enable,
						'on' => $s_disable,
					),
				),
				'disable_breadcrumbs' => array(
					'title' => esc_html__( 'Breadcrumbs', 'total' ),
					'id' => $prefix . 'disable_breadcrumbs',
					'type' => 'select',
					'description' => esc_html__( 'Enable or disable this element on this page or post.', 'total' ),
					'options' => array(
						'' => $s_default,
						'enable' => $s_enable,
						'on' => $s_disable,
					),
				),
				'disable_social' => array(
					'title' => esc_html__( 'Social Share', 'total' ),
					'id' => $prefix . 'disable_social',
					'type' => 'select',
					'description' => esc_html__( 'Enable or disable this element on this page or post.', 'total' ),
					'options' => array(
						'' => $s_default,
						'enable' => $s_enable,
						'on' => $s_disable,
					),
				),
				'secondary_thumbnail' => array(
					'title' => esc_html__( 'Secondary Thumbnail', 'total' ),
					'id' => $prefix . 'secondary_thumbnail',
					'type' => 'media',
					'description' => esc_html__( 'The secondary thumbnail is used on the Secondary Image Swap overlay style.', 'total' ),
				),
			),
		);

		// Header Tab
		$array['header'] = array(
			'title' => esc_html__( 'Header', 'total' ),
			'settings' => array(
				'disable_header' => array(
					'title' => esc_html__( 'Header', 'total' ),
					'id' => $prefix . 'disable_header',
					'type' => 'select',
					'description' => esc_html__( 'Enable or disable this element on this page or post.', 'total' ),
					'options' => array(
						'' => $s_default,
						'enable' => $s_enable,
						'on' => $s_disable,
					),
				),
				'custom_menu' => array(
					'title' => esc_html__( 'Custom Menu', 'total' ),
					'type' => 'select',
					'id' => $prefix . 'custom_menu',
					'description' => esc_html__( 'Select a custom menu for this page or post.', 'total' ),
					'options' => $this->helpers( 'menus' ),
				),
				'overlay_header' => array(
					'title' => esc_html__( 'Overlay Header', 'total' ),
					'description' => esc_html__( 'Enable or disable this element on this page or post.', 'total' ),
					'id' => $prefix . 'overlay_header',
					'type' => 'select',
					'options' => array(
						'' => $s_disable,
						'on' => $s_enable,
					),
				),
				'overlay_header_style' => array(
					'title' => esc_html__( 'Overlay Header Style', 'total' ),
					'type' => 'select',
					'id' => $prefix . 'overlay_header_style',
					'description' => esc_html__( 'Select your overlay header style', 'total' ),
					'options' => wpex_header_overlay_styles(),
					'default' => '',
				),
				'overlay_header_dropdown_style' => array(
					'title' => esc_html__( 'Overlay Header Dropdown Style', 'total' ),
					'type' => 'select',
					'id' => $prefix . 'overlay_header_dropdown_style',
					'description' => esc_html__( 'Select your overlay header style', 'total' ),
					'options' => wpex_get_menu_dropdown_styles(),
					'default' => 'black',
				),
				'overlay_header_font_size' => array(
					'title' => esc_html__( 'Overlay Header Menu Font Size', 'total'),
					'id' => $prefix . 'overlay_header_font_size',
					'description' => esc_html__( 'Enter a size in px.', 'total' ),
					'type' => 'number',
					'max' => '99',
					'min' => '8',
				),
				'overlay_header_logo' => array(
					'title' => esc_html__( 'Overlay Header Logo', 'total'),
					'id' => $prefix . 'overlay_header_logo',
					'type' => 'media',
					'description' => esc_html__( 'Select a custom logo (optional) for the overlay header.', 'total' ),
				),
				'overlay_header_logo_retina' => array(
					'title' => esc_html__( 'Overlay Header Logo: Retina', 'total'),
					'id' => $prefix . 'overlay_header_logo_retina',
					'type' => 'media',
					'description' => esc_html__( 'Retina version for the overlay header custom logo.', 'total' ),
				),
				'overlay_header_retina_logo_height' => array(
					'title' => esc_html__( 'Overlay Header Retina Logo Height', 'total'),
					'id' => $prefix . 'overlay_header_logo_retina_height',
					'description' => esc_html__( 'Enter a size in px.', 'total' ),
					'type' => 'number',
					'max' => '999',
					'min' => '1',
				),
			),
		);

		// Title Tab
		$array['title'] = array(
			'title' => esc_html__( 'Title', 'total' ),
			'settings' => array(
				'disable_title' => array(
					'title' => esc_html__( 'Title', 'total' ),
					'id' => $prefix . 'disable_title',
					'type' => 'select',
					'description' => esc_html__( 'Enable or disable this element on this page or post.', 'total' ),
					'options' => array(
						'' => $s_default,
						'enable' => $s_enable,
						'on' => $s_disable,
					),
				),
				'post_title' => array(
					'title' => esc_html__( 'Custom Title', 'total' ),
					'id' => $prefix . 'post_title',
					'type' => 'text',
					'description' => esc_html__( 'Alter the main title display.', 'total' ),
				),
				'disable_header_margin' => array(
					'title' => esc_html__( 'Title Margin', 'total' ),
					'id' => $prefix . 'disable_header_margin',
					'type' => 'select',
					'description' => esc_html__( 'Enable or disable this element on this page or post.', 'total' ),
					'options' => array(
						'' => $s_enable,
						'on' => $s_disable,
					),
				),
				'post_subheading' => array(
					'title' => esc_html__( 'Subheading', 'total' ),
					'type' => 'text_html',
					'id' => $prefix . 'post_subheading',
					'description' => esc_html__( 'Enter your page subheading. Shortcodes & HTML is allowed.', 'total' ),
				),
				'post_title_style' => array(
					'title' => esc_html__( 'Title Style', 'total' ),
					'type' => 'select',
					'id' => $prefix . 'post_title_style',
					'description' => esc_html__( 'Select a custom title style for this page or post.', 'total' ),
					'options' => $this->helpers( 'title_styles' ),
				),
				'post_title_background_color' => array(
					'title' => esc_html__( 'Title: Background Color', 'total' ),
					'description' => esc_html__( 'Select a color.', 'total' ),
					'id' => $prefix .'post_title_background_color',
					'type' => 'color',
					'hidden' => true,
				),
				'post_title_background_redux' => array(
					'title' => esc_html__( 'Title: Background Image', 'total'),
					'id' => $prefix . 'post_title_background_redux',
					'type' => 'media',
					'description' => esc_html__( 'Select a custom header image for your main title.', 'total' ),
					'hidden' => true,
				),
				'post_title_height' => array(
					'title' => esc_html__( 'Title: Background Height', 'total' ),
					'type' => 'text',
					'id' => $prefix . 'post_title_height',
					'description' => esc_html__( 'Select your custom height for your title background. Default is 400px.', 'total' ),
					'hidden' => true,
				),
				'post_title_background_overlay' => array(
					'title' => esc_html__( 'Title: Background Overlay', 'total' ),
					'type' => 'select',
					'id' => $prefix . 'post_title_background_overlay',
					'description' => esc_html__( 'Select an overlay for the title background.', 'total' ),
					'options' => array(
						'' => esc_html__( 'None', 'total' ),
						'dark' => esc_html__( 'Dark', 'total' ),
						'dotted' => esc_html__( 'Dotted', 'total' ),
						'dashed' => esc_html__( 'Diagonal Lines', 'total' ),
						'bg_color' => esc_html__( 'Background Color', 'total' ),
					),
					'hidden' => true,
				),
				'post_title_background_overlay_opacity' => array(
					'id' => $prefix . 'post_title_background_overlay_opacity',
					'type' => 'text',
					'title' => esc_html__( 'Title: Background Overlay Opacity', 'total' ),
					'description' => esc_html__( 'Enter a custom opacity for your title background overlay.', 'total' ),
					'default' => '',
					'hidden' => true,
				),
			),
		);

		// Slider tab
		$array['slider'] = array(
			'title' => esc_html__( 'Slider', 'total' ),
			'settings' => array(
				'post_slider_shortcode' => array(
					'title' => esc_html__( 'Slider Shortcode', 'total' ),
					'type' => 'code',
					'id' => $prefix . 'post_slider_shortcode',
					'description' => esc_html__( 'Enter a slider shortcode here to display a slider at the top of the page.', 'total' ),
				),
				'post_slider_shortcode_position' => array(
					'title' => esc_html__( 'Slider Position', 'total' ),
					'type' => 'select',
					'id' => $prefix . 'post_slider_shortcode_position',
					'description' => esc_html__( 'Select the position for the slider shortcode.', 'total' ),
					'options' => array(
						'' => $s_default,
						'below_title' => esc_html__( 'Below Title', 'total' ),
						'above_title' => esc_html__( 'Above Title', 'total' ),
						'above_menu' => esc_html__( 'Above Menu (Header 2 or 3)', 'total' ),
						'above_header' => esc_html__( 'Above Header', 'total' ),
						'above_topbar' => esc_html__( 'Above Top Bar', 'total' ),
					),
				),
				'post_slider_bottom_margin' => array(
					'title' => esc_html__( 'Slider Bottom Margin', 'total' ),
					'description' => esc_html__( 'Enter a bottom margin for your slider in pixels', 'total' ),
					'id' => $prefix . 'post_slider_bottom_margin',
					'type' => 'text',
				),
				'disable_post_slider_mobile' => array(
					'title' => esc_html__( 'Slider On Mobile', 'total' ),
					'id' => $prefix . 'disable_post_slider_mobile',
					'type' => 'select',
					'description' => esc_html__( 'Enable or disable slider display for mobile devices.', 'total' ),
					'options' => array(
						'' => $s_enable,
						'on' => $s_disable,
					),
				),
				'post_slider_mobile_alt' => array(
					'title' => esc_html__( 'Slider Mobile Alternative', 'total' ),
					'type' => 'media',
					'id' => $prefix . 'post_slider_mobile_alt',
					'description' => esc_html__( 'Select an image.', 'total' ),
					'type' => 'media',
				),
				'post_slider_mobile_alt_url' => array(
					'title' => esc_html__( 'Slider Mobile Alternative URL', 'total' ),
					'id' => $prefix . 'post_slider_mobile_alt_url',
					'description' => esc_html__( 'URL for the mobile slider alternative.', 'total' ),
					'type' => 'text',
				),
				'post_slider_mobile_alt_url_target' => array(
					'title' => esc_html__( 'Slider Mobile Alternative URL Target', 'total' ),
					'id' => $prefix . 'post_slider_mobile_alt_url_target',
					'description' => esc_html__( 'Select your link target window.', 'total' ),
					'type' => 'select',
					'options' => array(
						'' => esc_html__( 'Same Window', 'total' ),
						'blank' => esc_html__( 'New Window', 'total' ),
					),
				),
			),
		);

		// Background tab
		$array['background'] = array(
			'title' => esc_html__( 'Background', 'total' ),
			'settings' => array(
				'page_background_color' => array(
					'title' => esc_html__( 'Background Color', 'total' ),
					'description' => esc_html__( 'Select a color.', 'total' ),
					'id' => $prefix . 'page_background_color',
					'type' => 'color',
				),
				'page_background_image_redux' => array(
					'title' => esc_html__( 'Background Image', 'total' ),
					'id' => $prefix . 'page_background_image_redux',
					'description' => esc_html__( 'Select an image.', 'total' ),
					'type' => 'media',
				),
				'page_background_image_style' => array(
					'title' => esc_html__( 'Background Style', 'total' ),
					'type' => 'select',
					'id' => $prefix . 'page_background_image_style',
					'description' => esc_html__( 'Select the style.', 'total' ),
					'options' => array(
						'' => $s_default,
						'repeat' => esc_html__( 'Repeat', 'total' ),
						'fixed' => esc_html__( 'Fixed', 'total' ),
						'stretched' => esc_html__( 'Streched', 'total' ),
					),
				),
			),
		);

		// Footer tab
		$array['footer'] = array(
			'title' => esc_html__( 'Footer', 'total' ),
			'settings' => array(
				'disable_footer' => array(
					'title' => esc_html__( 'Footer', 'total' ),
					'id' => $prefix . 'disable_footer',
					'type' => 'select',
					'description' => esc_html__( 'Enable or disable this element on this page or post.', 'total' ),
					'options' => array(
						'' => $s_default,
						'enable' => $s_enable,
						'on' => $s_disable,
					),
				),
				'disable_footer_widgets' => array(
					'title' => esc_html__( 'Footer Widgets', 'total' ),
					'id' => $prefix . 'disable_footer_widgets',
					'type' => 'select',
					'description' => esc_html__( 'Enable or disable this element on this page or post.', 'total' ),
					'options' => array(
						'' => $s_enable,
						'on' => $s_disable,
					),
				),
				'footer_reveal' => array(
					'title' => esc_html__( 'Footer Reveal', 'total' ),
					'description' => esc_html__( 'Enable the footer reveal style. The footer will be placed in a fixed postion and display on scroll. This setting is for the "Full-Width" layout only and desktops only.', 'total' ),
					'id' => $prefix . 'footer_reveal',
					'type' => 'select',
					'options' => array(
						'' => $s_default,
						'on' => $s_enable,
						'off' => $s_disable,
					),
				),
			),
		);

		// Callout Tab
		$array['callout'] = array(
			'title' => esc_html__( 'Callout', 'total' ),
			'settings' => array(
				'disable_footer_callout' => array(
					'title' => esc_html__( 'Callout', 'total' ),
					'id' => $prefix . 'disable_footer_callout',
					'type' => 'select',
					'description' => esc_html__( 'Enable or disable this element on this page or post.', 'total' ),
					'options' => array(
						'' => $s_default,
						'enable' => $s_enable,
						'on' => $s_disable,
					),
				),
				'callout_link' => array(
					'title' => esc_html__( 'Callout Link', 'total' ),
					'id' => $prefix . 'callout_link',
					'type' => 'link',
					'description' => esc_html__( 'Enter a valid link.', 'total' ),
				),
				'callout_link_txt' => array(
					'title' => esc_html__( 'Callout Link Text', 'total' ),
					'id' => $prefix . 'callout_link_txt',
					'type' => 'text',
					'description' => esc_html__( 'Enter your text.', 'total' ),
				),
				'callout_text' => array(
					'title' => esc_html__( 'Callout Text', 'total' ),
					'id' => $prefix . 'callout_text',
					'type' => 'editor',
					'rows' => '5',
					'teeny' => true,
					'media_buttons' => false,
					'description' => esc_html__( 'Override the default callout text and if your callout box is disabled globally but you have content here it will still display for this page or post.', 'total' ),
				),
			),
		);
		// Media tab
		$array['media'] = array(
			'title' => esc_html__( 'Media', 'total' ),
			'post_type' => array( 'post' ),
			'settings' => array(
				'post_media_position' => array(
					'title' => esc_html__( 'Media Display/Position', 'total' ),
					'id' => $prefix . 'post_media_position',
					'type' => 'select',
					'description' => esc_html__( 'Select your preferred position for your post\'s media (featured image or video).', 'total' ),
					'options' => array(
						'' => $s_default,
						'above' => esc_html__( 'Full-Width Above Content', 'total' ),
						'hidden' => esc_html__( 'None (Do Not Display Featured Image/Video)', 'total' ),
					),
				),
				'post_oembed' => array(
					'title' => esc_html__( 'oEmbed URL', 'total' ),
					'description' => esc_html__( 'Enter a URL that is compatible with WP\'s built-in oEmbed feature. This setting is used for your video and audio post formats.', 'total' ) .'<br /><a href="http://codex.wordpress.org/Embeds" target="_blank">'. esc_html__( 'Learn More', 'total' ) .' &rarr;</a>',
					'id' => $prefix . 'post_oembed',
					'type' => 'text',
				),
				'post_self_hosted_shortcode_redux' => array(
					'title' => esc_html__( 'Self Hosted', 'total' ),
					'description' => esc_html__( 'Insert your self hosted video or audio url here.', 'total' ) .'<br /><a href="http://make.wordpress.org/core/2013/04/08/audio-video-support-in-core/" target="_blank">'. esc_html__( 'Learn More', 'total' ) .' &rarr;</a>',
					'id' => $prefix . 'post_self_hosted_media',
					'type' => 'media',
				),
				'post_video_embed' => array(
					'title' => esc_html__( 'Embed Code', 'total' ),
					'description' => esc_html__( 'Insert your embed/iframe code.', 'total' ),
					'id' => $prefix . 'post_video_embed',
					'type' => 'textarea',
					'rows' => '2',
				),
			),
		);

		// Staff Tab
		if ( WPEX_STAFF_IS_ACTIVE ) {
			$staff_meta_array = wpex_staff_social_meta_array();
			$staff_meta_array['position'] = array(
				'title' => esc_html__( 'Position', 'total' ),
				'id' => $prefix .'staff_position',
				'type' => 'text',
			);
			$obj = get_post_type_object( 'staff' );
			$tab_title= $obj->labels->singular_name;
			$array['staff'] = array(
				'title' => $tab_title,
				'post_type' => array( 'staff' ),
				'settings' => $staff_meta_array,
			);
		}

		// Portfolio Tab
		if ( WPEX_PORTFOLIO_IS_ACTIVE ) {
			$obj= get_post_type_object( 'portfolio' );
			$tab_title = $obj->labels->singular_name;
			$array['portfolio'] = array(
				'title' => $tab_title,
				'post_type' => array( 'portfolio' ),
				'settings' => array(
					'featured_video' => array(
						'title' => esc_html__( 'oEmbed URL', 'total' ),
						'description' => esc_html__( 'Enter a URL that is compatible with WP\'s built-in oEmbed feature. This setting is used for your video and audio post formats.', 'total' ) .'<br /><a href="http://codex.wordpress.org/Embeds" target="_blank">'. esc_html__( 'Learn More', 'total' ) .' &rarr;</a>',
						'id' => $prefix .'post_video',
						'type' => 'text',
					),
					'post_video_embed' => array(
						'title' => esc_html__( 'Embed Code', 'total' ),
						'description' => esc_html__( 'Insert your embed/iframe code.', 'total' ),
						'id' => $prefix . 'post_video_embed',
						'type' => 'textarea',
						'rows' => '2',
					),
				),
			);
		}

		// Apply filter & return settings array
		return apply_filters( 'wpex_metabox_array', $array, $post );
	}

	/**
	 * Adds custom CSS for the metaboxes inline instead of loading another stylesheet
	 *
	 * @see assets/metabox.css
	 * @since 1.0.0
	 */
	public static function metaboxes_css() { ?>

		<style type="text/css">
			#wpex-metabox .wp-tab-panel{display:none;}#wpex-metabox .wp-tab-panel#wpex-mb-tab-1{display:block;}#wpex-metabox .wp-tab-panel{max-height:none !important;}#wpex-metabox ul.wp-tab-bar{-webkit-touch-callout:none;-webkit-user-select:none;-khtml-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;}#wpex-metabox ul.wp-tab-bar{padding-top:5px;}#wpex-metabox ul.wp-tab-bar:after{content:"";display:block;height:0;clear:both;visibility:hidden;zoom:1;}#wpex-metabox ul.wp-tab-bar li{padding:5px 12px;font-size:14px;}#wpex-metabox ul.wp-tab-bar li a:focus{box-shadow:none;}#wpex-metabox .inside .form-table tr{border-top:1px solid #dfdfdf;}#wpex-metabox .inside .form-table tr:first-child{border:none;}#wpex-metabox .inside .form-table th{width:240px;padding:10px 30px 10px 0;}#wpex-metabox .inside .form-table td{padding:10px 0;}#wpex-metabox .inside .form-table label{display:block;}#wpex-metabox .inside .form-table th label span{margin-right:7px;}#wpex-metabox .wpex-mb-uploader{margin-left:5px;}#wpex-metabox .inside .form-table th p.wpex-mb-description{font-size:12px;font-weight:normal;margin:0;padding:0;padding-top:4px;}#wpex-metabox .inside .form-table input[type="text"],#wpex-metabox .inside .form-table input[type="number"],#wpex-metabox .inside .form-table .wpex-mb-textarea-code{width:40%;}#wpex-metabox .inside .form-table textarea{width:100%}#wpex-metabox .inside .form-table select{min-width:40%;}#wpex-metabox .wpex-mb-reset{margin-top:7px;}#wpex-metabox .wpex-mb-reset .wpex-reset-btn{display:block;float:left;}#wpex-metabox .wpex-mb-reset .wpex-reset-checkbox{float:left;display:none;margin-left:10px;padding-top:5px;}#wpex-metabox ul.wp-tab-bar li .fa {margin-right: 6px;}
		</style>

	<?php

	}

	/**
	 * Adds custom js for the metaboxes inline instead of loading another js file
	 *
	 * @see assets/metabox.js
	 * @since 1.0.0
	 */
	public static function metaboxes_js() {
		$date_format = apply_filters( 'wpex_metabox_date_format', 'yy-mm-dd' ); ?>

		<script type="text/javascript">
			!function(a){"use strict";a(document).on("ready",function(){var b=a(".wpex-date-meta");b.length&&a.datepicker&&b.datepicker({dateFormat:"<?php echo esc_html( $date_format ); ?>"}),a("div#wpex-metabox ul.wp-tab-bar a").click(function(){var b=a("#wpex-metabox ul.wp-tab-bar li"),c=a(this).data("tab"),d=a("#wpex-metabox div.wp-tab-panel");return a(b).removeClass("wp-tab-active"),a(d).hide(),a(c).show(),a(this).parent("li").addClass("wp-tab-active"),!1}),a("div#wpex-metabox .wpex-mb-color-field").wpColorPicker();var c=!0,d=wp.media.editor.send.attachment;a("div#wpex-metabox .wpex-mb-uploader").click(function(b){var f=(wp.media.editor.send.attachment,a(this)),g=f.prev();return wp.media.editor.send.attachment=function(b,e){return c?void a(g).val(e.id):d.apply(this,[b,e])},wp.media.editor.open(f),!1}),a("div#wpex-metabox .add_media").on("click",function(){c=!1}),a("div#wpex-metabox div.wpex-mb-reset a.wpex-reset-btn").click(function(){var b=a("div.wpex-mb-reset div.wpex-reset-checkbox"),c=b.is(":visible")?"<?php esc_html_e(  'Reset Settings', 'total' ); ?>":"<?php esc_html_e(  'Cancel Reset', 'total' ); ?>";a(this).text(c),a("div.wpex-mb-reset div.wpex-reset-checkbox input").attr("checked",!1),b.toggle()});var f=(a("#wpex_disable_header_margin_tr, #wpex_post_subheading_tr,#wpex_post_title_style_tr"),a("div#wpex-metabox select#wpex_post_title_style")),g=f.val(),h=a("#wpex_post_title_background_color_tr, #wpex_post_title_background_redux_tr,#wpex_post_title_height_tr,#wpex_post_title_background_overlay_tr,#wpex_post_title_background_overlay_opacity_tr"),i=a("#wpex_post_title_background_color_tr");"background-image"===g?h.show():"solid-color"===g&&i.show(),f.change(function(){h.hide(),"background-image"==a(this).val()?h.show():"solid-color"===a(this).val()&&i.show()});var j=a("div#wpex-metabox select#wpex_overlay_header"),k=a("#wpex_overlay_header_style_tr, #wpex_overlay_header_font_size_tr,#wpex_overlay_header_logo_tr,#wpex_overlay_header_logo_retina_tr,#wpex_overlay_header_logo_retina_height_tr,#wpex_overlay_header_dropdown_style_tr");"on"===j.val()?k.show():k.hide(),j.change(function(){"on"===a(this).val()?k.show():k.hide()})})}(jQuery);
		</script>

	<?php }

}
$wpex_post_metaboxes = new WPEX_Post_Metaboxes();