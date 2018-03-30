<?php
/**
 * Df Mega menu class.
 *
 * inspired by http://www.wpexplorer.com/adding-custom-attributes-to-wordpress-menus/
 */
class Df_Mega_Menu {

	public $fat_menu = false;
	public $fat_columns = 3;

	function __construct() {

		// add custom menu fields to menu
		add_filter( 'wp_setup_nav_menu_item', array( $this, 'add_custom_nav_fields' ) );

		// save menu custom fields
		add_action( 'wp_update_nav_menu_item', array( $this, 'update_custom_nav_fields' ), 10, 3 );

		// replace menu walker
		add_filter( 'wp_edit_nav_menu_walker', array( $this, 'replace_walker_class' ), 90, 2 );

		// add admin css
		add_action( 'admin_print_styles-nav-menus.php', array( $this, 'add_admin_menu_inline_css' ), 15 );

		// add some javascript
		add_action( 'admin_print_footer_scripts', array( $this, 'javascript_magick' ), 99 );

		// add media uploader
		add_action( 'admin_enqueue_scripts', array( $this, 'uploader_scripts' ), 15 );
	}

	function add_custom_nav_fields( $menu_item ) {

		// common
		$menu_item->df_mega_menu_icon = get_post_meta( $menu_item->ID, '_menu_item_df_mega_menu_icon', true );
		$menu_item->df_mega_menu_iconfont = get_post_meta( $menu_item->ID, '_menu_item_df_mega_menu_iconfont', true );

		$menu_item->df_mega_menu_image = get_post_meta( $menu_item->ID, '_menu_item_df_mega_menu_image', true );
		$menu_item->df_mega_menu_image_width = get_post_meta( $menu_item->ID, '_menu_item_df_mega_menu_image_width', true );
		$menu_item->df_mega_menu_image_height = get_post_meta( $menu_item->ID, '_menu_item_df_mega_menu_image_height', true );

		// first level
		$menu_item->df_mega_menu_enabled = get_post_meta( $menu_item->ID, '_menu_item_df_mega_menu_enabled', true );
		$menu_item->df_mega_menu_fullwidth = get_post_meta( $menu_item->ID, '_menu_item_df_mega_menu_fullwidth', true );
		$menu_item->df_mega_menu_columns = get_post_meta( $menu_item->ID, '_menu_item_df_mega_menu_columns', true );
		$menu_item->df_mega_menu_position = get_post_meta( $menu_item->ID, '_menu_item_df_mega_menu_position', true );
		$menu_item->df_mega_menu_text_align = get_post_meta( $menu_item->ID, '_menu_item_df_mega_menu_text_align', true );

		$menu_item->df_mega_menu_width_header_fixed = get_post_meta( $menu_item->ID, '_menu_item_df_mega_menu_width_header_fixed', true );

		// second level
		$menu_item->df_mega_menu_hide_title = get_post_meta( $menu_item->ID, '_menu_item_df_mega_menu_hide_title', true );
		$menu_item->df_mega_menu_remove_link = get_post_meta( $menu_item->ID, '_menu_item_df_mega_menu_remove_link', true );
		$menu_item->df_mega_menu_new_row = get_post_meta( $menu_item->ID, '_menu_item_df_mega_menu_new_row', true );

		// third level
		$menu_item->df_mega_menu_new_column = get_post_meta( $menu_item->ID, '_menu_item_df_mega_menu_new_column', true );

		return $menu_item;
	}

	function update_custom_nav_fields( $menu_id, $menu_item_db_id, $args ) {

		// icon
		if ( isset($_REQUEST['menu-item-df-icon']) && is_array( $_REQUEST['menu-item-df-icon'] ) ) {
			$icon = in_array( $_REQUEST['menu-item-df-icon'][$menu_item_db_id], array( 'image', 'iconfont' ) ) ? $_REQUEST['menu-item-df-icon'][$menu_item_db_id] : 'none';
			update_post_meta( $menu_item_db_id, '_menu_item_df_mega_menu_icon', $icon );
		}

		// iconfont
		if ( isset($_REQUEST['menu-item-df-iconfont']) && is_array( $_REQUEST['menu-item-df-iconfont'] ) ) {
			$iconfont = $_REQUEST['menu-item-df-iconfont'][$menu_item_db_id];
			update_post_meta( $menu_item_db_id, '_menu_item_df_mega_menu_iconfont', $iconfont );
		}

		// image
		if ( isset($_REQUEST['menu-item-df-image']) && is_array( $_REQUEST['menu-item-df-image'] ) ) {
			$image = esc_url($_REQUEST['menu-item-df-image'][$menu_item_db_id]);
			update_post_meta( $menu_item_db_id, '_menu_item_df_mega_menu_image', $image );

			// image width
			$image_width = $_REQUEST['menu-item-df-image-width'][$menu_item_db_id];
			update_post_meta( $menu_item_db_id, '_menu_item_df_mega_menu_image_width', absint($image_width) );

			// image height
			$image_height = $_REQUEST['menu-item-df-image-height'][$menu_item_db_id];
			update_post_meta( $menu_item_db_id, '_menu_item_df_mega_menu_image_height', absint($image_height) );
		}

		// mega menu enabled
		$enable_mega_menu = isset($_REQUEST['menu-item-df-enable-mega-menu'], $_REQUEST['menu-item-df-enable-mega-menu'][$menu_item_db_id]);
		update_post_meta( $menu_item_db_id, '_menu_item_df_mega_menu_enabled', $enable_mega_menu );

		// fullwidth
		$fullwidth = isset($_REQUEST['menu-item-df-fullwidth-menu'], $_REQUEST['menu-item-df-fullwidth-menu'][$menu_item_db_id]);
		update_post_meta( $menu_item_db_id, '_menu_item_df_mega_menu_fullwidth', $fullwidth );

		// columns
		if ( isset($_REQUEST['menu-item-df-columns']) && is_array( $_REQUEST['menu-item-df-columns'] ) ) {
			$columns = absint($_REQUEST['menu-item-df-columns'][$menu_item_db_id]);
			update_post_meta( $menu_item_db_id, '_menu_item_df_mega_menu_columns', $columns );
		}

		// position
		if ( isset($_REQUEST['menu-item-df-position']) && is_array( $_REQUEST['menu-item-df-position'] ) ) {
			$position = $_REQUEST['menu-item-df-position'][$menu_item_db_id];
			update_post_meta( $menu_item_db_id, '_menu_item_df_mega_menu_position', $position );
		}

		// text align
		if ( isset($_REQUEST['menu-item-df-text-align']) && is_array( $_REQUEST['menu-item-df-text-align'] ) ) {
			$text_align = $_REQUEST['menu-item-df-text-align'][$menu_item_db_id];
			update_post_meta( $menu_item_db_id, '_menu_item_df_mega_menu_text_align', $text_align );
		}

		// width header fixed
		if ( isset($_REQUEST['menu-item-df-width-header-fixed']) && is_array( $_REQUEST['menu-item-df-width-header-fixed'] ) ) {
			$header_fixed = $_REQUEST['menu-item-df-width-header-fixed'][$menu_item_db_id];
			update_post_meta( $menu_item_db_id, '_menu_item_df_mega_menu_width_header_fixed', $header_fixed );
		}

		// hide title
		$hide_title = isset($_REQUEST['menu-item-df-hide-title'], $_REQUEST['menu-item-df-hide-title'][$menu_item_db_id]);
		update_post_meta( $menu_item_db_id, '_menu_item_df_mega_menu_hide_title', $hide_title );

		// remove link
		$remove_link = isset($_REQUEST['menu-item-df-remove-link'], $_REQUEST['menu-item-df-remove-link'][$menu_item_db_id]);
		update_post_meta( $menu_item_db_id, '_menu_item_df_mega_menu_remove_link', $remove_link );

		// new row
		$new_row = isset($_REQUEST['menu-item-df-new-row'], $_REQUEST['menu-item-df-new-row'][$menu_item_db_id]);
		update_post_meta( $menu_item_db_id, '_menu_item_df_mega_menu_new_row', $new_row );

		// new column
		$new_column = isset($_REQUEST['menu-item-df-new-column'], $_REQUEST['menu-item-df-new-column'][$menu_item_db_id]);
		update_post_meta( $menu_item_db_id, '_menu_item_df_mega_menu_new_column', $new_column );
	}

	function replace_walker_class( $walker, $menu_id ) {

		if ( 'Walker_Nav_Menu_Edit' == $walker ) {
			$walker = 'Df_Edit_Walker_Nav_Menu';
		}

		return $walker;
	}

	/**
	 * Add some beautiful inline css for admin menus.
	 *
	 */
	function add_admin_menu_inline_css() {
		$css = '
			.menu.ui-sortable .df-mega-menu-feilds p,
			.menu.ui-sortable .df-mega-menu-feilds .field-df-image,
			.menu.ui-sortable .menu-item-depth-2 .df-mega-menu-feilds.field-df-mega-menu-image-icon .field-df-image,
			.menu.ui-sortable .menu-item-depth-3 .df-mega-menu-feilds.field-df-mega-menu-image-icon .field-df-image {
				display: none;
			}

			.menu.ui-sortable .menu-item-depth-0 .df-mega-menu-feilds .field-df-enable-mega-menu,
			.menu.ui-sortable .df-mega-menu-feilds .field-df-icon,
			.menu.ui-sortable .menu-item-depth-0 .df-mega-menu-feilds.field-df-mega-menu-image-icon .field-df-image,
			.menu.ui-sortable .menu-item-depth-1 .df-mega-menu-feilds.field-df-mega-menu-image-icon .field-df-image,
			.menu.ui-sortable .df-mega-menu-feilds.field-df-mega-menu-iconfont-icon .field-df-iconfont {
				display: block;
			}

			.menu.ui-sortable .menu-item-depth-0.field-df-mega-menu-enabled .df-mega-menu-feilds .field-df-fullwidth-menu,
			.menu.ui-sortable .menu-item-depth-0.field-df-mega-menu-enabled .df-mega-menu-feilds .field-df-columns,
			.menu.ui-sortable .menu-item-depth-0.field-df-mega-menu-enabled .df-mega-menu-feilds .field-df-position,
			.menu.ui-sortable .menu-item-depth-0.field-df-mega-menu-enabled .df-mega-menu-feilds .field-df-text-align,
			.menu.ui-sortable .menu-item-depth-0.field-df-mega-menu-enabled .df-mega-menu-feilds .field-df-width-header-fixed,

			.menu.ui-sortable .menu-item-depth-1.field-df-mega-menu-enabled .df-mega-menu-feilds .field-df-hide-title,
			.menu.ui-sortable .menu-item-depth-1.field-df-mega-menu-enabled .df-mega-menu-feilds .field-df-remove-link,
			.menu.ui-sortable .menu-item-depth-1.field-df-mega-menu-enabled .df-mega-menu-feilds .field-df-new-row,

			.menu.ui-sortable .menu-item-depth-2.field-df-mega-menu-enabled .df-mega-menu-feilds .field-df-new-column {
				display: block;
			}

			.field-df-image {
				margin: 4px 0px 7px 0px;
			}

			.field-df-image .upload {
				border-spacing: 0;
				width: 80%;
				clear: both;
				margin: 0;
			}

			.field-df-image .remove-image {
				display: none;
			}

			.field-df-image .screenshot {
				margin-top: 4px;
				max-height: 60px;
			}

			.field-df-image .screenshot img {
				max-width: 60px;
				max-height: 60px;
			}
		';
		wp_add_inline_style( 'wp-admin', $css );
	}

	/**
	 * Enqueue uploader scripts.
	 *
	 */
	function uploader_scripts() {
		if ( function_exists( 'wp_enqueue_media' ) ) {
			wp_enqueue_media();
		}

		wp_localize_script( 'media-editor', 'optionsframework_l10n', array(
			'upload' => __( 'Upload', 'dahztheme' ),
			'remove' => __( 'Remove', 'dahztheme' )
		) );
	}

	/**
	 * Javascript magick.
	 *
	 */
	function javascript_magick() {
		?>
		<script type="text/javascript">
			jQuery(function(){

				var df_fat_menu = {
					reTimeout: false,

					recalc : function() {
						$menuItems = jQuery('.menu-item', '#menu-to-edit');

						$menuItems.each( function(i) {
							var $item = jQuery(this),
								$checkbox = jQuery('.menu-item-df-enable-mega-menu', this);

							if ( !$item.is('.menu-item-depth-0') ) {

								var checkItem = $menuItems.filter(':eq('+(i-1)+')');
								if ( checkItem.is('.field-df-mega-menu-enabled') ) {

									$item.addClass('field-df-mega-menu-enabled');
									$checkbox.attr('checked','checked');
								} else {

									$item.removeClass('field-df-mega-menu-enabled');
									$checkbox.attr('checked','');
								}
							}

						});

					},

					binds: function() {

						jQuery('#menu-to-edit').on('click', '.menu-item-df-enable-mega-menu', function(event) {
							var $checkbox = jQuery(this),
								$container = $checkbox.parents('.menu-item:eq(0)');

							if ( $checkbox.is(':checked') ) {
								$container.addClass('field-df-mega-menu-enabled');
							} else {
								$container.removeClass('field-df-mega-menu-enabled');
							}

							df_fat_menu.recalc();

							return true;
						});

						jQuery('#menu-to-edit').on('change', '.field-df-icon input[type="radio"]', function(event){
							var $this = jQuery(this),
								$parentContainer = $this.parents('.df-mega-menu-feilds');

							switch( $this.val() ) {
								case 'image': $parentContainer.addClass('field-df-mega-menu-image-icon').removeClass('field-df-mega-menu-iconfont-icon'); break;
								case 'iconfont': $parentContainer.addClass('field-df-mega-menu-iconfont-icon').removeClass('field-df-mega-menu-image-icon'); break;
								default: $parentContainer.removeClass('field-df-mega-menu-iconfont-icon field-df-mega-menu-image-icon');
							}

							return true;
						});

						jQuery('#menu-to-edit').on('click', '.uploader-button', function(event){
							var frame,
								$el = jQuery(this),
								selector = $el.parents('.upload-controls');

							event.preventDefault();

							if ( $el.hasClass('upload-button') ) {

								// If the media frame already exists, reopen it.
								if ( frame ) {
									frame.open();
									return;
								}

								// Create the media frame.
								frame = wp.media({
									// Set the title of the modal.
									title: $el.data('choose'),
									library: { type: 'image' },
									// Customize the submit button.
									button: {
										// Set the text of the button.
										text: $el.data('update'),
										// Tell the button not to close the modal, since we're
										// going to refresh the page when the image is selected.
										close: false
									}
								});

								// When an image is selected, run a callback.
								frame.on( 'select', function() {

									// Grab the selected attachment.
									var attachment = frame.state().get('selection').first();
									frame.close();

									selector.find('.upload').val(attachment.attributes.url);
									selector.find('.upload-id').val(attachment.attributes.id);
									if ( attachment.attributes.type == 'image' ) {
										selector.find('.screenshot').empty().hide().append('<img src="' + attachment.attributes.url + '"><a class="remove-image">Remove</a>').slideDown('fast');
										selector.find('.upload-image-width').val(attachment.attributes.width);
										selector.find('.upload-image-height').val(attachment.attributes.height);
									}
									$el.addClass('remove-file').removeClass('upload-button').val(optionsframework_l10n.remove);
									selector.find('.of-background-properties').slideDown();
								});

								// Finally, open the modal.
								frame.open();
							} else {
								selector.find('.remove-image').hide();
								selector.find('.upload').val('');
								selector.find('.of-background-properties').hide();
								selector.find('.screenshot').slideUp();
								$el.addClass('upload-button').removeClass('remove-file').val(optionsframework_l10n.upload);
								selector.find('.upload-id').val(0);
								selector.find('.upload-image-width').val(0);
								selector.find('.upload-image-height').val(0);
							}
						});

					},

					init: function() {
						df_fat_menu.binds();
						df_fat_menu.recalc();

						jQuery( ".menu-item-bar" ).live( "mouseup", function(event, ui) {
							if ( !jQuery(event.target).is('a') ) {
								clearTimeout(df_fat_menu.reTimeout);
								df_fat_menu.reTimeout = setTimeout(df_fat_menu.recalc, 700);
							}
						});
					},


				}

				df_fat_menu.init();
			});
		</script>
		<?php
	}
}

if ( !class_exists('Df_Edit_Walker_Nav_Menu') ) {
	include_once( 'custom-menu-edit.class.php' );
}
