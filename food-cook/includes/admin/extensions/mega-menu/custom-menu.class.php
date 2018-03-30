<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 *
 * @since DahzFramework 1.0
 */

class Df_Walker_Nav_Menu extends Walker_Nav_Menu {
	private $df_options = array();
	private $df_menu_parents = array();
	private $df_last_elem = 1;
	private $df_count = 1;
	private $df_is_first = true;
	private $df_parents_count = 1;
	private $df_fat_menu = false;
	private $df_fat_menu_columns = 3;
	private $df_fat_menu_position = 'none';
	private $df_parent_description = '';
	private $df_parent_mega_menu_hide_title = false;

	function __construct( $options = array() ) {
		if ( method_exists( 'Walker_Nav_Menu','__construct' ) ) {
			parent::__construct();
		}

		if ( is_array( $options ) ) {
			$this->df_options = $options;
		}
	}

	/**
	 * Traverse elements to create list from elements.
	 *
	 * Calls parent function in wp-includes/class-wp-walker.php
	 */
	function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {

		if ( !$element ) {
			return;
		}

		//Add indicators for top level menu items with submenus
		$id_field = $this->db_fields['id'];

		if ( !empty( $children_elements[ $element->$id_field ] ) ) {
			$this->df_menu_parents[] = $element->$id_field;
		}

		parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}

	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$output .= $args->df_submenu_wrap_start;
		$this->df_is_first = true;
	}

	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$output .= $args->df_submenu_wrap_end;
	}

	function start_el( &$output, $item, $depth = 0, $args = array(), $current_id = 0 ) {
			$item = apply_filters( 'df_nav_menu_item', $item, $args, $depth );
			$args = apply_filters( 'df_nav_menu_args', $args, $item, $depth );

			$class_names = $value = '';
			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;
			$first_class = '';
			$act_class = '';
			$item_icon = '';
			$if_parent_not_clickable = '';

			// mega menu part
			if ( !empty($args->please_be_mega_menu) ) {



				if ( 0 == $depth ) {

					if ( !empty($item->df_mega_menu_enabled) ) {
						$this->df_fat_menu = true;
						$this->df_fat_menu_columns = $item->df_mega_menu_columns;
						$this->df_fat_menu_position = $item->df_mega_menu_position;

					} else {
						$this->df_fat_menu = false;
						$this->df_fat_menu_columns = 3;
						$this->df_fat_menu_position = 'none';
					}
				}

				if ( $this->df_fat_menu && !empty($args->please_be_fat) ) {

					$columns_classes = array(
						1 => 'df_span-sm-12',
						2 => 'df_span-sm-6',
						3 => 'df_span-sm-4',
						4 => 'df_span-sm-3',
						5 => 'df_span-col5'
					);

					$position_classes = array(
						'none' => 'normal',
						'left' => 'left',
						'right' => 'right'
					);

					if ( 0 == $depth ) {

						$classes[] = 'df-mega-menu';

						if ( !empty($item->df_mega_menu_fullwidth) ) {
							$classes[] = 'mega-full-width';
						} else {
							$classes[] = 'mega-auto-width';
						}

						if ( !empty($item->df_mega_menu_columns) ) {
							$classes[] = 'mega-column-' . absint($item->df_mega_menu_columns);
						}

						if ( !empty($item->df_mega_menu_position) ) {
							$classes[] = 'mega-position-' . $item->df_mega_menu_position;
						}

						if ( !empty($item->df_mega_menu_text_align) ) {
							$classes[] = 'mega-text-align-' . $item->df_mega_menu_text_align;
						}

					} else if ( 1 == $depth ) {

						if ( !empty($item->df_mega_menu_hide_title) ) {
							$classes[] = 'hide-mega-title';
						}

						if ( !empty($item->df_mega_menu_remove_link) ) {
							$item->url = 'javascript: void(0);';
							$classes[] = 'no-link';
						}

						$classes[] = 'df-mega-parent';

						if ( !empty( $this->df_fat_menu_columns ) && isset($columns_classes[ $this->df_fat_menu_columns ]) ) {
							$classes[] = $columns_classes[ $this->df_fat_menu_columns ];
						}

						if ( !empty($item->df_mega_menu_new_row) ) {
							$classes[] = 'new-row';
						}

						$this->df_parent_description = $item->description;
						$this->df_parent_mega_menu_hide_title = $item->df_mega_menu_hide_title;
					} else if ( 2 == $depth ) {

						if ( !empty($item->df_mega_menu_new_column) ) {
							$fake_column_classes = array( 'menu-item', 'menu-item-has-children', 'df-mega-parent', 'has-children', 'new-column' );

							if ( !empty( $this->df_fat_menu_columns ) && isset($columns_classes[ $this->df_fat_menu_columns ]) ) {
								$fake_column_classes[] = $columns_classes[ $this->df_fat_menu_columns ];
							}

							if ( $this->df_parent_mega_menu_hide_title ) {
								$fake_column_classes[] = 'hide-mega-title';
							}

							$fake_column_classes = apply_filters( 'nav_menu_css_class', $fake_column_classes, null, $args, $depth-1 );

							$output .= $args->df_submenu_wrap_end . $args->df_item_wrap_end;
							$output .= str_replace(
								array(
									'%ITEM_HREF%',
									'%ITEM_TITLE%',
									'%ITEM_CLASS%',
									'%SPAN_DESCRIPTION%',
									'%ESC_ITEM_TITLE%',
									'%IS_FIRST%',
									'%BEFORE_LINK%',
									'%AFTER_LINK%',
									'%DEPTH%',
									'%ACT_CLASS%',
									'%RAW_ITEM_HREF%',
									'%IF_PARENT_NOT_CLICKABLE%',
									'%DESCRIPTION%',
									'%ICON%'
								),
								array(
									'javascript:void(0)" onclick="return false;" style="cursor: default;',
									'&nbsp;',
									join( ' ', $fake_column_classes ),
									$this->df_parent_description ? '<span class="menu-subtitle">&nbsp;</span>' : '',
									''
								),
								$args->df_item_wrap_start
							);
							$output .= $args->df_submenu_wrap_start;
							$this->df_is_first = true;
						}

					}

				}

				if ( !empty($item->df_mega_menu_icon) ) {

					switch ( $item->df_mega_menu_icon ) {

						case 'image' :

							if ( !empty($item->df_mega_menu_image) ) {

								// get icon size
								if ( !empty($item->df_mega_menu_image_widfh) && !empty($item->df_mega_menu_image_height) ) {
									$icon_size = image_hwstring( $item->df_mega_menu_image_widfh, $item->df_mega_menu_image_height );
								} else {
									$icon_size = '';
								}

								$item_icon = '<span class="mega-icon"><img src="' . esc_url($item->df_mega_menu_image) .'" alt="' . esc_attr( $item->title ) . '" ' . $icon_size . '/></span>';
							}
							break;

						case 'iconfont' :

							if ( !empty($item->df_mega_menu_iconfont) ) {
								$item_icon = wp_kses( $item->df_mega_menu_iconfont, array( 'i' => array( 'class' => array() ) ) );
							}
							break;
					} 
				}

			}
			// mega menu part ends

			// current element
			if ( in_array( 'current-menu-item',  $classes ) ||
				in_array( 'current-menu-parent',  $classes ) ||
				in_array( 'current-menu-ancestor',  $classes )
			) {
				$classes[] = 'act';
			}

			if ( $this->df_is_first ) {
				$classes[] = 'first';
				$first_class = 'class="first"';
			}

			if ( in_array( 'current-menu-item',  $classes ) ) {
				$act_class = isset( $args->act_class ) ? $args->act_class : 'act';
			}

			$df_is_parent = in_array( $item->ID, $this->df_menu_parents );

			// add parent class
			if ( $df_is_parent ) {
				$classes[] = 'has-children';
			}

			// nonclicable parent menu items
			$attributes = '';

			$attributes .= !empty( $item->target ) ? '" target="'. esc_attr( $item->target ) : '';
			$attributes .= !empty( $item->xfn ) ? '" rel="'. esc_attr( $item->xfn ) : '';

			if ( !$args->parent_clicable && $df_is_parent ) {
				$attributes .= '" onclick="return false;" style="cursor: default;';
				$if_parent_not_clickable = isset( $args->if_parent_not_clickable ) ? $args->if_parent_not_clickable : '';
				$classes[] = 'no-link';
			}

			$before_link = $after_link = '';

			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_unique( $classes ), $item, $args, $depth ) );
			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
			$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

			$df_title = apply_filters( 'the_title', $item->title, $item->ID );
			$df_title = apply_filters( 'df_nav_menu_title', $df_title, $item, $args, $depth );

			$output .= str_replace(
				array(
					'%ITEM_HREF%',
					'%ITEM_TITLE%',
					'%ESC_ITEM_TITLE%',
					'%ITEM_CLASS%',
					'%IS_FIRST%',
					'%BEFORE_LINK%',
					'%AFTER_LINK%',
					'%DEPTH%',
					'%ACT_CLASS%',
					'%RAW_ITEM_HREF%',
					'%IF_PARENT_NOT_CLICKABLE%',
					'%DESCRIPTION%',
					'%SPAN_DESCRIPTION%',
					'%ICON%'
				),
				array(
					esc_attr($item->url) . $attributes,
					$args->link_before . $df_title . $args->link_after,
					!empty($item->attr_title) ? ' title="'. esc_attr( $item->attr_title ). '"':'',
					esc_attr( $class_names ),
					$first_class,
					$before_link,
					$after_link,
					$depth + 1,
					$act_class,
					esc_attr($item->url),
					$if_parent_not_clickable,
					esc_html($item->description),
					$item->description ? '<span class="menu-subtitle">' . esc_html($item->description) . '</span>' : '',
					$item_icon
				),
				$args->df_item_wrap_start
			);
			$this->df_count++;
	}

	function end_el( &$output, $item, $depth = 0, $args = array() ) {
		$output .= $args->df_item_wrap_end;
		$this->df_is_first = false;
	}
}
