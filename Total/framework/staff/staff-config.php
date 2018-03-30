<?php
/**
 * Staff Post Type Configuration file
 *
 * @package Total WordPress Theme
 * @subpackage Staff Functions
 * @version 3.5.3
 */

// The class
class WPEX_Staff_Config {

	/**
	 * Get things started.
	 *
	 * @since 2.0.0
	 */
	public function __construct() {

		// Helper functions
		require_once( WPEX_FRAMEWORK_DIR .'staff/staff-helpers.php' );

		// Adds the staff post type
		add_action( 'init', array( 'WPEX_Staff_Config', 'register_post_type' ), 0 );

		// Adds the staff taxonomies
		if ( wpex_is_mod_enabled( wpex_get_mod( 'staff_tags', 'on' ) ) ) {
			add_action( 'init', array( 'WPEX_Staff_Config', 'register_tags' ), 0 );
		}
		if ( wpex_is_mod_enabled( wpex_get_mod( 'staff_categories', 'on' ) ) ) {
			add_action( 'init', array( 'WPEX_Staff_Config', 'register_categories' ), 0 );
		}

		// Register staff sidebar
		if ( wpex_get_mod( 'staff_custom_sidebar', true ) ) {
			add_filter( 'widgets_init', array( 'WPEX_Staff_Config', 'register_sidebar' ), 10 );
		}

		// Add image sizes
		add_filter( 'wpex_image_sizes', array( 'WPEX_Staff_Config', 'add_image_sizes' ), 10 );

		// Create relations between users and staff members
		if ( apply_filters( 'wpex_staff_users_relations', true ) ) {
			add_action( 'personal_options_update', array( 'WPEX_Staff_Config', 'save_custom_profile_fields' ) );
			add_action( 'edit_user_profile_update', array( 'WPEX_Staff_Config', 'save_custom_profile_fields' ) );
			add_filter( 'personal_options', array( 'WPEX_Staff_Config', 'personal_options' ) );
			add_filter( 'wpex_post_author_bio_data', array( 'WPEX_Staff_Config', 'post_author_bio_data' ) );
		}

		// Add staff VC modules
		add_filter( 'vcex_builder_modules', array( 'WPEX_Staff_Config', 'vc_modules' ) );

		/*-------------------------------------------------------------------------------*/
		/* -  Admin only actions/filters
		/*-------------------------------------------------------------------------------*/
		if ( is_admin() ) {

			// Adds columns in the admin view for taxonomies
			add_filter( 'manage_edit-staff_columns', array( 'WPEX_Staff_Config', 'edit_columns' ) );
			add_action( 'manage_staff_posts_custom_column', array( 'WPEX_Staff_Config', 'column_display' ), 10, 2 );

			// Allows filtering of posts by taxonomy in the admin view
			add_action( 'restrict_manage_posts', array( 'WPEX_Staff_Config', 'tax_filters' ) );

			// Create Editor for altering the post type arguments
			add_action( 'admin_menu', array( 'WPEX_Staff_Config', 'add_page' ) );
			add_action( 'admin_init', array( 'WPEX_Staff_Config','register_page_options' ) );
			add_action( 'admin_notices', array( 'WPEX_Staff_Config', 'setting_notice' ) );
			add_action( 'admin_print_styles-staff_page_wpex-staff-editor', array( 'WPEX_Staff_Config','css' ) );

			// Add new image sizes tab
			add_filter( 'wpex_image_sizes_tabs', array( 'WPEX_Staff_Config', 'image_sizes_tabs' ), 10 );

			// Add gallery metabox to staff
			add_filter( 'wpex_gallery_metabox_post_types', array( 'WPEX_Staff_Config', 'add_gallery_metabox' ), 20 );
		
		}

		/*-------------------------------------------------------------------------------*/
		/* -  Front-End only actions/filters
		/*-------------------------------------------------------------------------------*/
		else {

			// Displays correct sidebar for staff posts
			if ( wpex_get_mod( 'staff_custom_sidebar', true ) ) {
				add_filter( 'wpex_get_sidebar', array( 'WPEX_Staff_Config', 'display_sidebar' ), 10 );
			}

			// Alter the post layouts for staff posts and archives
			add_filter( 'wpex_post_layout_class', array( 'WPEX_Staff_Config', 'layouts' ), 10 );

			// Add subheading for staff member if enabled
			add_action( 'wpex_post_subheading', array( 'WPEX_Staff_Config', 'add_position_to_subheading' ), 10 );

			// Posts per page & exclude from search
			add_action( 'pre_get_posts', array( 'WPEX_Staff_Config', 'pre_get_posts' ), 10 );

			// Single next/prev visibility
			add_filter( 'wpex_has_next_prev', array( 'WPEX_Staff_Config', 'next_prev' ) );

			// Tweak page header title
			add_filter( 'wpex_page_header_title_args', array( 'WPEX_Staff_Config', 'alter_title' ) );

			// Return true for social share check so it can use the builder
			add_filter( 'wpex_has_social_share', array( 'WPEX_Staff_Config', 'social_share' ) );

		}
		
	} // End __construct

	/*-------------------------------------------------------------------------------*/
	/* -  Start Class Functions
	/*-------------------------------------------------------------------------------*/
	
	/**
	 * Register post type.
	 *
	 * @since 2.0.0
	 */
	public static function register_post_type() {

		// Get values and sanitize
		$name          = wpex_get_staff_name();
		$singular_name = wpex_get_staff_singular_name();
		$slug          = wpex_get_mod( 'staff_slug' );
		$slug          = $slug ? esc_html( $slug ) : 'staff-member';
		$menu_icon     = wpex_get_staff_menu_icon();

		// Declare args and apply filters
		$args = apply_filters( 'wpex_staff_args', array(
			'labels' => array(
				'name' => $name,
				'singular_name' => $singular_name,
				'add_new' => esc_html__( 'Add New', 'total' ),
				'add_new_item' => esc_html__( 'Add New Item', 'total' ),
				'edit_item' => esc_html__( 'Edit Item', 'total' ),
				'new_item' => esc_html__( 'Add New Staff Item', 'total' ),
				'view_item' => esc_html__( 'View Item', 'total' ),
				'search_items' => esc_html__( 'Search Items', 'total' ),
				'not_found' => esc_html__( 'No Items Found', 'total' ),
				'not_found_in_trash' => esc_html__( 'No Items Found In Trash', 'total' )
			),
			'public' => true,
			'supports' => array(
				'title',
				'editor',
				'excerpt',
				'thumbnail',
				'comments',
				'custom-fields',
				'revisions',
				'author',
				'page-attributes',
			),
			'capability_type' => 'post',
			'rewrite' => array(
				'slug' => $slug,
			),
			'has_archive' => false,
			'menu_icon' => 'dashicons-'. $menu_icon,
			'menu_position' => 20,
		) );

		// Register the post type
		register_post_type( 'staff', $args );

	}

	/**
	 * Register Staff tags.
	 *
	 * @since 2.0.0
	 */
	public static function register_tags() {

		// Define and sanitize options
		$name = wpex_get_mod( 'staff_tag_labels');
		$name = $name ? esc_html( $name ) : esc_html__( 'Staff Tags', 'total' );
		$slug = wpex_get_mod( 'staff_tag_slug' );
		$slug = $slug ? esc_html( $slug ) : 'staff-tag';

		// Define args and apply filters for child theming
		$args = apply_filters( 'wpex_taxonomy_staff_tag_args', array(
			'labels' => array(
				'name' => $name,
				'singular_name' => $name,
				'menu_name' => $name,
				'search_items' => esc_html__( 'Search Staff Tags', 'total' ),
				'popular_items' => esc_html__( 'Popular Staff Tags', 'total' ),
				'all_items' => esc_html__( 'All Staff Tags', 'total' ),
				'parent_item' => esc_html__( 'Parent Staff Tag', 'total' ),
				'parent_item_colon' => esc_html__( 'Parent Staff Tag:', 'total' ),
				'edit_item' => esc_html__( 'Edit Staff Tag', 'total' ),
				'update_item' => esc_html__( 'Update Staff Tag', 'total' ),
				'add_new_item' => esc_html__( 'Add New Staff Tag', 'total' ),
				'new_item_name' => esc_html__( 'New Staff Tag Name', 'total' ),
				'separate_items_with_commas' => esc_html__( 'Separate staff tags with commas', 'total' ),
				'add_or_remove_items' => esc_html__( 'Add or remove staff tags', 'total' ),
				'choose_from_most_used' => esc_html__( 'Choose from the most used staff tags', 'total' ),
			),
			'public' => true,
			'show_in_nav_menus' => true,
			'show_ui' => true,
			'show_tagcloud' => true,
			'hierarchical' => false,
			'rewrite' => array(
				'slug' => $slug,
			),
			'query_var' => true
		) );

		// Register the staff tag taxonomy
		register_taxonomy( 'staff_tag', array( 'staff' ), $args );

	}

	/**
	 * Register Staff category.
	 *
	 * @since 2.0.0
	 */
	public static function register_categories() {

		// Define and sanitize options
		$name = wpex_get_mod( 'staff_cat_labels');
		$name = $name ? esc_html( $name ) : esc_html__( 'Staff Categories', 'total' );
		$slug = wpex_get_mod( 'staff_cat_slug' );
		$slug = $slug ? esc_html( $slug ) : 'staff-category';

		// Define args and apply filters for child theming
		$args = apply_filters( 'wpex_taxonomy_staff_category_args', array(
			'labels' => array(
				'name' => $name,
				'singular_name' => $name,
				'menu_name' => $name,
				'search_items' => esc_html__( 'Search','total' ),
				'popular_items' => esc_html__( 'Popular', 'total' ),
				'all_items' => esc_html__( 'All', 'total' ),
				'parent_item' => esc_html__( 'Parent', 'total' ),
				'parent_item_colon' => esc_html__( 'Parent', 'total' ),
				'edit_item' => esc_html__( 'Edit', 'total' ),
				'update_item' => esc_html__( 'Update', 'total' ),
				'add_new_item' => esc_html__( 'Add New', 'total' ),
				'new_item_name' => esc_html__( 'New', 'total' ),
				'separate_items_with_commas' => esc_html__( 'Separate with commas', 'total' ),
				'add_or_remove_items' => esc_html__( 'Add or remove', 'total' ),
				'choose_from_most_used' => esc_html__( 'Choose from the most used', 'total' ),
			),
			'public' => true,
			'show_in_nav_menus' => true,
			'show_ui' => true,
			'show_tagcloud' => true,
			'hierarchical' => true,
			'rewrite' => array(
				'slug'  => $slug
			),
			'query_var' => true
		) );

		// Register the staff category taxonomy
		register_taxonomy( 'staff_category', array( 'staff' ), $args );

	}


	/**
	 * Adds columns to the WP dashboard edit screen.
	 *
	 * @since 2.0.0
	 */
	public static function edit_columns( $columns ) {
		if ( taxonomy_exists( 'staff_category' ) ) {
			$columns['staff_category'] = esc_html__( 'Category', 'total' );
		}
		if ( taxonomy_exists( 'staff_tag' ) ) {
			$columns['staff_tag'] = esc_html__( 'Tags', 'total' );
		}
		return $columns;
	}
	

	/**
	 * Adds columns to the WP dashboard edit screen.
	 *
	 * @since 2.0.0
	 */
	public static function column_display( $column, $post_id ) {

		switch ( $column ) :

			// Display the staff categories in the column view
			case 'staff_category':

				if ( $category_list = get_the_term_list( $post_id, 'staff_category', '', ', ', '' ) ) {
					echo $category_list;
				} else {
					echo '&mdash;';
				}

			break;

			// Display the staff tags in the column view
			case 'staff_tag':

				if ( $tag_list = get_the_term_list( $post_id, 'staff_tag', '', ', ', '' ) ) {
					echo $tag_list;
				} else {
					echo '&mdash;';
				}

			break;

		endswitch;

	}

	/**
	 * Adds taxonomy filters to the staff admin page.
	 *
	 * @since 2.0.0
	 */
	public static function tax_filters() {
		global $typenow;
		$taxonomies = array( 'staff_category', 'staff_tag' );
		if ( 'staff' == $typenow ) {
			foreach ( $taxonomies as $tax_slug ) {
				if ( ! taxonomy_exists( $tax_slug ) ) {
					continue;
				}
				$current_tax_slug = isset( $_GET[$tax_slug] ) ? $_GET[$tax_slug] : false;
				$tax_obj = get_taxonomy( $tax_slug );
				$tax_name = $tax_obj->labels->name;
				$terms = get_terms($tax_slug);
				if ( count( $terms ) > 0) {
					echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
					echo "<option value=''>$tax_name</option>";
					foreach ( $terms as $term ) {
						echo '<option value=' . $term->slug, $current_tax_slug == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>';
					}
					echo "</select>";
				}
			}
		}
	}

	/**
	 * Add sub menu page for the Staff Editor.
	 *
	 * @since 2.0.0
	 */
	public static function add_page() {
		$wpex_staff_editor = add_submenu_page(
			'edit.php?post_type=staff',
			esc_html__( 'Post Type Editor', 'total' ),
			esc_html__( 'Post Type Editor', 'total' ),
			'administrator',
			'wpex-staff-editor',
			array( 'WPEX_Staff_Config', 'create_admin_page' )
		);
		add_action( 'load-'. $wpex_staff_editor, array( 'WPEX_Staff_Config', 'flush_rewrite_rules' ) );
	}

	/**
	 * Flush re-write rules
	 *
	 * @since 3.3.0
	 */
	public static function flush_rewrite_rules() {
		$screen = get_current_screen();
		if ( $screen->id == 'staff_page_wpex-staff-editor' ) {
			flush_rewrite_rules();
		}

	}

	/**
	 * Function that will register the staff editor admin page.
	 *
	 * @since 2.0.0
	 */
	public static function register_page_options() {
		register_setting( 'wpex_staff_options', 'wpex_staff_editor', array( 'WPEX_Staff_Config', 'sanitize' ) );
	}

	/**
	 * Displays saved message after settings are successfully saved.
	 *
	 * @since 2.0.0
	 */
	public static function setting_notice() {
		settings_errors( 'wpex_staff_editor_page_notices' );
	}

	/**
	 * Sanitizes input and saves theme_mods.
	 *
	 * @since 2.0.0
	 */
	public static function sanitize( $options ) {

		// Save values to theme mod
		if ( ! empty ( $options ) ) {

			// Checkboxes
			$checkboxes = array(
				'staff_categories',
				'staff_tags',
				'staff_custom_sidebar',
				'staff_search',
			);
			foreach ( $checkboxes as $checkbox ) {
				if ( ! empty( $options[$checkbox] ) ) {
					remove_theme_mod( $checkbox );
				} else {
					set_theme_mod( $checkbox, false );
				}
				unset( $options[$checkbox] );
			}

			// Not checkboxes
			foreach( $options as $key => $value ) {
				if ( $value ) {
					set_theme_mod( $key, $value );
				} else {
					remove_theme_mod( $key );
				}
			}

			// Add notice
			add_settings_error(
				'wpex_staff_editor_page_notices',
				esc_attr( 'settings_updated' ),
				esc_html__( 'Settings saved and rewrite rules flushed.', 'total' ),
				'updated'
			);

		}

		// Lets delete the options as we are saving them into theme mods
		$options = '';
		return $options;

	}

	/**
	 * Output for the actual Staff Editor admin page.
	 *
	 * @since 2.0.0
	 */
	public static function create_admin_page() {

		// Delete option as we are using theme_mods instead
		delete_option( 'wpex_staff_editor' ); ?>

		<div class="wrap">
			<h2><?php esc_html_e( 'Post Type Editor', 'total' ); ?></h2>
			<form method="post" action="options.php">
				<?php settings_fields( 'wpex_staff_options' ); ?>
				<table class="form-table">
					<tr valign="top">
						<th scope="row"><?php esc_html_e( 'Main Page', 'total' ); ?></th>
						<td><?php
						// Display dropdown of pages to select from
						wp_dropdown_pages( array(
							'echo'             => true,
							'selected'         => wpex_get_mod( 'staff_page' ),
							'name'             => 'wpex_staff_editor[staff_page]',
							'show_option_none' => esc_html__( 'None', 'total' ),
							'exclude'          => get_option( 'page_for_posts' ),
						) ); ?><p class="description"><?php esc_html_e( 'Used for breadcrumbs.', 'total' ); ?></p></td>
					</tr>
					<tr valign="top">
						<th scope="row"><?php esc_html_e( 'Admin Icon', 'total' ); ?></th>
						<td>
							<?php
							// Mod
							$mod = wpex_get_mod( 'staff_admin_icon', null );
							$mod = 'groups' == $mod ? '' : $mod;
							// Dashicons list
							$dashicons = wpex_get_dashicons_array(); ?>
							<div id="wpex-dashicon-select" class="wpex-clr">
								<?php foreach ( $dashicons as $key => $val ) :
									$value = 'groups' == $key ? '' : $key;
									$class = $mod == $value ? 'button-primary' : 'button-secondary'; ?>
									<a href="#" data-value="<?php echo esc_attr( $value ); ?>" class="<?php echo esc_attr( $class ); ?>" title="<?php echo esc_attr( $key ); ?>"><span class="dashicons dashicons-<?php echo $key; ?>"></span></a>
								<?php endforeach; ?>
							</div>
							<input type="hidden" name="wpex_staff_editor[staff_admin_icon]" id="wpex-dashicon-select-input" value="<?php echo esc_attr( $mod ); ?>"></td>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><?php esc_html_e( 'Enable Custom Sidebar', 'total' ); ?></th>
						<?php
						// Get checkbox value
						$mod = wpex_get_mod( 'staff_custom_sidebar', 'on' );
						$mod = ( $mod && 'off' != $mod ) ? 'on' : 'off'; // sanitize ?>
						<td><input type="checkbox" name="wpex_staff_editor[staff_custom_sidebar]" value="<?php echo esc_attr( $mod ); ?>" <?php checked( $mod, 'on' ); ?> /></td>
					</tr>
					<tr valign="top">
						<th scope="row"><?php esc_html_e( 'Include In Search', 'total' ); ?></th>
						<?php
						// Get checkbox value
						$mod = wpex_get_mod( 'staff_search', 'on' );
						$mod = ( $mod && 'off' != $mod ) ? 'on' : 'off'; // sanitize ?>
						<td><input type="checkbox" name="wpex_staff_editor[staff_search]" value="<?php echo esc_attr( $mod ); ?>" <?php checked( $mod, 'on' ); ?> /></td>
					</tr>
					<tr valign="top">
						<th scope="row"><?php esc_html_e( 'Post Type: Name', 'total' ); ?></th>
						<td><input type="text" name="wpex_staff_editor[staff_labels]" value="<?php echo wpex_get_mod( 'staff_labels' ); ?>" /></td>
					</tr>
					<tr valign="top">
						<th scope="row"><?php esc_html_e( 'Post Type: Singular Name', 'total' ); ?></th>
						<td><input type="text" name="wpex_staff_editor[staff_singular_name]" value="<?php echo wpex_get_mod( 'staff_singular_name' ); ?>" /></td>
					</tr>
					<tr valign="top">
						<th scope="row"><?php esc_html_e( 'Post Type: Slug', 'total' ); ?></th>
						<td><input type="text" name="wpex_staff_editor[staff_slug]" value="<?php echo wpex_get_mod( 'staff_slug' ); ?>" /></td>
					</tr>
					<tr valign="top" id="wpex-tags-enable">
						<th scope="row"><?php esc_html_e( 'Enable Tags', 'total' ); ?></th>
						<?php
						// Get checkbox value
						$mod = wpex_get_mod( 'staff_tags', 'on' );
						$mod = wpex_is_mod_enabled( $mod ) ? 'on' : 'off'; // sanitize ?>
						<td><input type="checkbox" name="wpex_staff_editor[staff_tags]" value="<?php echo esc_attr( $mod ); ?>" <?php checked( $mod, 'on' ); ?> /></td>
					</tr>
					<tr valign="top" id="wpex-tags-label">
						<th scope="row"><?php esc_html_e( 'Tags: Label', 'total' ); ?></th>
						<td><input type="text" name="wpex_staff_editor[staff_tag_labels]" value="<?php echo wpex_get_mod( 'staff_tag_labels' ); ?>" /></td>
					</tr>
					<tr valign="top" id="wpex-tags-slug">
						<th scope="row"><?php esc_html_e( 'Tags: Slug', 'total' ); ?></th>
						<td><input type="text" name="wpex_staff_editor[staff_tag_slug]" value="<?php echo wpex_get_mod( 'staff_tag_slug' ); ?>" /></td>
					</tr>
					<tr valign="top" id="wpex-categories-enable">
						<th scope="row"><?php esc_html_e( 'Enable Categories', 'total' ); ?></th>
						<?php
						// Get checkbox value
						$mod = wpex_get_mod( 'staff_categories', 'on' );
						$mod = wpex_is_mod_enabled( $mod ) ? 'on' : 'off'; // sanitize ?>
						<td><input type="checkbox" name="wpex_staff_editor[staff_categories]" value="<?php echo esc_attr( $mod ); ?>" <?php checked( $mod, 'on' ); ?> /></td>
					</tr>
					<tr valign="top" id="wpex-categories-label">
						<th scope="row"><?php esc_html_e( 'Categories: Label', 'total' ); ?></th>
						<td><input type="text" name="wpex_staff_editor[staff_cat_labels]" value="<?php echo wpex_get_mod( 'staff_cat_labels' ); ?>" /></td>
					</tr>
					<tr valign="top" id="wpex-categories-slug">
						<th scope="row"><?php esc_html_e( 'Categories: Slug', 'total' ); ?></th>
						<td><input type="text" name="wpex_staff_editor[staff_cat_slug]" value="<?php echo wpex_get_mod( 'staff_cat_slug' ); ?>" /></td>
					</tr>
				</table>
				<?php submit_button(); ?>
			</form>
			<script>
				( function( $ ) {
					"use strict";
					$( document ).ready( function() {
						// Dashicons
						var $buttons = $( '#wpex-dashicon-select a' ),
							$input   = $( '#wpex-dashicon-select-input' );
						$buttons.click( function() {
							var $activeButton = $( '#wpex-dashicon-select a.button-primary' );
							$activeButton.removeClass( 'button-primary' ).addClass( 'button-secondary' );
							$( this ).addClass( 'button-primary' );
							$input.val( $( this ).data( 'value' ) );
							return false;
						} );
						// Categories enable/disable
						var $catsEnable   = $( '#wpex-categories-enable input' ),
							$CatsTrToHide = $( '#wpex-categories-label, #wpex-categories-slug' );
						if ( 'off' == $catsEnable.val() ) {
							$CatsTrToHide.hide();
						}
						$( $catsEnable ).change(function () {
							if ( $( this ).is( ":checked" ) ) {
								$CatsTrToHide.show();
							} else {
								$CatsTrToHide.hide();
							}
						} );
						// Tags enable/disable
						var $tagsEnable   = $( '#wpex-tags-enable input' ),
							$tagsTrToHide = $( '#wpex-tags-label, #wpex-tags-slug' );
						if ( 'off' == $tagsEnable.val() ) {
							$tagsTrToHide.hide();
						}
						$( $tagsEnable ).change(function () {
							if ( $( this ).is( ":checked" ) ) {
								$tagsTrToHide.show();
							} else {
								$tagsTrToHide.hide();
							}
						} );
					} );
				} ) ( jQuery );
			</script>
		</div>
	<?php }

	/**
	 * Post Type Editor CSS
	 *
	 * @since 3.3.0
	 */
	public static function css() { ?>
	
		<style type="text/css">
			#wpex-dashicon-select { max-width: 800px; }
			#wpex-dashicon-select a { display: inline-block; margin: 2px; padding: 0; width: 32px; height: 32px; line-height: 32px; text-align: center; }
			#wpex-dashicon-select a .dashicons,
			#wpex-dashicon-select a .dashicons-before:before { line-height: inherit; }
		</style>

	<?php }

	/**
	 * Registers a new custom staff sidebar.
	 *
	 * @since 2.0.0
	 */
	public static function register_sidebar() {

		// Get heading tag
		$heading_tag = wpex_get_mod( 'sidebar_headings', 'div' );
		$heading_tag = $heading_tag ? $heading_tag : 'div';

		// Get post type object to name sidebar correctly
		$obj            = get_post_type_object( 'staff' );
		$post_type_name = $obj->labels->name;

		// Register staff_sidebar
		register_sidebar( array (
			'name'          => $post_type_name .' '. esc_html__( 'Sidebar', 'total' ),
			'id'            => 'staff_sidebar',
			'before_widget' => '<div class="sidebar-box %2$s clr">',
			'after_widget'  => '</div>',
			'before_title'  => '<'. $heading_tag .' class="widget-title">',
			'after_title'   => '</'. $heading_tag .'>',
		) );
	}

	/**
	 * Alter main sidebar to display staff sidebar.
	 *
	 * @since 2.0.0
	 */
	public static function display_sidebar( $sidebar ) {
		if ( is_singular( 'staff' ) || wpex_is_staff_tax() ) {
			$sidebar = 'staff_sidebar';
		}
		return $sidebar;
	}

	/**
	 * Alter the post layouts for staff posts and archives.
	 *
	 * @since 2.0.0
	 */
	public static function layouts( $class ) {
		if ( is_singular( 'staff' ) ) {
			$class = wpex_get_mod( 'staff_single_layout', 'right-sidebar' );
		} elseif ( wpex_is_staff_tax() && ! is_search() ) {
			$class = wpex_get_mod( 'staff_archive_layout', 'full-width' );
		}
		return $class;
	}

	/**
	 * Display position for page header subheading.
	 *
	 * @since 2.0.0
	 */
	public static function add_position_to_subheading( $subheading ) {

		// Display position for subheading under title
		if ( wpex_get_mod( 'staff_single_header_position', true )
			&& is_singular( 'staff' )
			&& ! in_array( 'title', wpex_staff_post_blocks() )
			&& $meta = get_post_meta( get_the_ID(), 'wpex_staff_position', true )
		) {
			$subheading = $meta;
		}
		
		// Return subheading
		return $subheading;

	}

	/**
	 * Alters posts per page for staff archives and exclude staff from search results
	 *
	 * @since 2.0.0
	 */
	public static function pre_get_posts( $query ) {

		// Main Checks
		if ( is_admin() || ! $query->is_main_query() ) {
			return;
		}

		// Alter posts per page
		if ( wpex_is_staff_tax() ) {
			$query->set( 'posts_per_page', wpex_get_mod( 'staff_archive_posts_per_page', '12' ) );
		}

		// Alter seearch query to exclude type
		if ( ! wpex_get_mod( 'staff_search', true ) && $query->is_search() ) {

			// Gather all searchable post types
			$types = get_post_types( array( 'exclude_from_search' => false ) );

			// Make sure you got the proper results, and that your post type is in the results
			if ( is_array( $types ) && in_array( 'staff', $types ) ) {

				// Remove the post type from the array
				unset( $types['staff'] );

				// Set the query to the remaining searchable post types
				$query->set( 'post_type', $types );

			}

		}

	}

	/**
	 * Adds a "staff" tab to the image sizes admin panel
	 *
	 * @since 3.3.2
	 */
	public static function image_sizes_tabs( $array ) {
		$array['staff'] = wpex_get_staff_name();
		return $array;
	}

	/**
	 * Adds image sizes for the staff to the image sizes panel.
	 *
	 * @since 2.0.0
	 */
	public static function add_image_sizes( $sizes ) {
		$obj            = get_post_type_object( 'staff' );
		$post_type_name = $obj->labels->singular_name;
		$sizes['staff_entry'] = array(
			'label'   => sprintf( esc_html__( '%s Entry', 'total' ), $post_type_name ),
			'width'   => 'staff_entry_image_width',
			'height'  => 'staff_entry_image_height',
			'crop'    => 'staff_entry_image_crop',
			'section' => 'staff',
		);
		$sizes['staff_post'] = array(
			'label'   => sprintf( esc_html__( '%s Post', 'total' ), $post_type_name ),
			'width'   => 'staff_post_image_width',
			'height'  => 'staff_post_image_height',
			'crop'    => 'staff_post_image_crop',
			'section' => 'staff',
		);
		$sizes['staff_related'] = array(
			'label'   => sprintf( esc_html__( '%s Post Related', 'total' ), $post_type_name ),
			'width'   => 'staff_related_image_width',
			'height'  => 'staff_related_image_height',
			'crop'    => 'staff_related_image_crop',
			'section' => 'staff',
		);
		return $sizes;
	}

	/**
	 * Disables the next/previous links if disabled via the customizer.
	 *
	 * @since 2.0.0
	 */
	public static function next_prev( $return ) {
		if ( is_singular( 'staff' ) && ! wpex_get_mod( 'staff_next_prev', true ) ) {
			$return = false;
		}
		return $return;
	}

	/**
	 * Tweak the page header
	 *
	 * @since 2.1.0
	 */
	public static function alter_title( $args ) {
		if ( is_singular( 'staff' ) ) {
			if ( ! in_array( 'title', wpex_staff_post_blocks() ) ) {
				$args['string']   = get_the_title();
				$args['html_tag'] = 'h1';
			}
		}
		return $args;
	}

	/**
	 * Adds the staff post type to the gallery metabox post types array.
	 *
	 * @since 2.0.0
	 */
	public static function add_gallery_metabox( $types ) {
		$types[] = 'staff';
		return $types;
	}

	/**
	 * Enables social sharings
	 *
	 * @since 2.1.0
	 */
	public static function social_share( $return ) {
		if ( is_singular( 'staff' ) ) {
			$return = true;
		}
		return $return;
	}

	/**
	 * Adds field to user dashboard to connect to staff member
	 *
	 * @since 2.1.0
	 */
	public static function personal_options( $user ) {

		// Get staff members
		$staff_posts = get_posts( array(
			'post_type'      => 'staff',
			'posts_per_page' => -1,
			'fields'         => 'ids',
		) );

		// Return if no staff
		if ( ! $staff_posts ) {
			return;
		}

		// Get staff meta
		$meta_value = get_user_meta( $user->ID, 'wpex_staff_member_id', true ); ?>

	    	<tr>
	    		<th scope="row"><?php esc_html_e( 'Connect to Staff Member', 'total' ); ?></th>
				<td>
					<fieldset>
						<select type="text" id="wpex_staff_member_id" name="wpex_staff_member_id">
							<option value="" <?php selected( $meta_value, '' ); ?>>&mdash;</option>
							<?php foreach ( $staff_posts as $id ) { ?>
								<option value="<?php echo $id; ?>" <?php selected( $meta_value, $id ); ?>><?php echo esc_attr( get_the_title( $id ) ); ?></option>
							<?php } ?>
						</select>
					</fieldset>
				</td>
			</tr>

	    <?php

	}

	/**
	 * Saves user profile fields
	 *
	 * @since 2.1.0
	 */
	public static function save_custom_profile_fields( $user_id ) {

		// Get meta
		$meta_value = isset( $_POST['wpex_staff_member_id'] ) ? $_POST['wpex_staff_member_id'] : '';

		// Get options
		$relations = get_option( 'wpex_staff_users_relations', array() );

		// Prevent staff ID's from being used more then 1x
		if ( is_array( $relations ) && array_search( $meta_value, $relations ) ) {
			return;
		}

		// Update option
		else {
			$relations[$user_id] = $meta_value;
			update_option( 'wpex_staff_users_relations', $relations );
		}

		// Update meta
		update_user_meta( $user_id, 'wpex_staff_member_id', $meta_value, get_user_meta( $user_id, 'update_user_meta', true ) );
		
	}

	/**
	 * Alters post author bio data based on staff item relations
	 *
	 * @since 2.1.0
	 */
	public static function post_author_bio_data( $data ) {
		$relations       = get_option( 'wpex_staff_users_relations' );
		$staff_member_id = isset( $relations[$data['post_author']] ) ? $relations[$data['post_author']] : '';
		if ( $staff_member_id ) {
			$data['author_name'] = get_the_title( $staff_member_id );
			$data['posts_url'] = get_the_permalink( $staff_member_id );
			$featured_image = wpex_get_post_thumbnail( array(
				'attachment' => get_post_thumbnail_id( $staff_member_id ),
				'size'       => 'wpex_custom',
				'width'      => $data['avatar_size'],
				'height'     => $data['avatar_size'],
				'alt'        => $data['author_name'],
			) );
			if ( $featured_image ) {
				$data['avatar'] = $featured_image;
			}
		}
		return $data;
	}

	/**
	 * Add custom VC modules
	 *
	 * @since 3.5.3
	 */
	public static function vc_modules( $modules ) {
		$modules[] = 'staff_grid';
		$modules[] = 'staff_carousel';
		$modules[] = 'staff_social';
		return $modules;
	}

}
new WPEX_Staff_Config;