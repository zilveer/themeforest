<?php
/**
 * Create list of checkboxes for categories
 *
 * @package Organique
 * @since 2.2.1
 * @uses Walker
 */

class Product_Cat_Checkboxes_Walker extends Walker_Category {

	/**
	 * Starts the list before the elements are added.
	 *
	 * @see Walker::start_lvl()
	 *
	 * @since 2.1.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of category. Used for tab indentation.
	 * @param array  $args   An array of arguments. Will only append content if style argument value is 'list'.
	 *                       @see wp_list_categories()
	 */
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent<ul class='checkbox-children  js--categories-checkboxes'>\n";
	}

	/**
	 * Ends the list of after the elements are added.
	 *
	 * @see Walker::end_lvl()
	 *
	 * @since 2.1.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of category. Used for tab indentation.
	 * @param array  $args   An array of arguments. Will only append content if style argument value is 'list'.
	 *                       @wsee wp_list_categories()
	 */
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";
	}

	/**
	 * Start the element output.
	 *
	 * @see Walker::start_el()
	 *
	 * @since 2.1.0
	 *
	 * @param string $output   Passed by reference. Used to append additional content.
	 * @param object $category Category data object.
	 * @param int    $depth    Depth of category in reference to parents. Default 0.
	 * @param array  $args     An array of arguments. @see wp_list_categories()
	 * @param int    $id       ID of the current category.
	 */
	function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
		extract($args);

		$cat_name = esc_attr( $category->name );

		// echo '<pre>'; echo var_dump( $category ); echo '</pre>';

		/** This filter is documented in wp-includes/category-template.php */
		$cat_name = apply_filters( 'list_cats', $cat_name, $category );

		if ( isset( $_GET['product_cat'] ) ) {
			$is_checked = checked( in_array( $category->slug, explode( ',', $_GET['product_cat'] ) ), true, false );
		} else {
			$is_checked = '';
		}

		$checkbox = sprintf( '<input type="checkbox" class="js--cat" data-attribute="product_cat" value="%1$s" %3$s> %2$s', $category->slug, $cat_name, $is_checked );

		if ( ! empty( $show_count ) ) {
			$checkbox .= ' (' . number_format_i18n( $category->count ) . ')';
		}

		$output .= "\t<li";
		$class = 'cat-item cat-item-' . $category->term_id;
		if ( !empty($current_category) ) {
			$_current_category = get_term( $current_category, $category->taxonomy );
			if ( $category->term_id == $current_category )
				$class .=  ' current-cat';
			elseif ( $category->term_id == $_current_category->parent )
				$class .=  ' current-cat-parent';
		}
		$output .=  ' class="' . $class . '"';
		$output .= "><label class=\"checkbox\">$checkbox</label>\n";
	}

	/**
	 * Ends the element output, if needed.
	 *
	 * @see Walker::end_el()
	 *
	 * @since 2.1.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $page   Not used.
	 * @param int    $depth  Depth of category. Not used.
	 * @param array  $args   An array of arguments. Only uses 'list' for whether should append to output. @see wp_list_categories()
	 */
	function end_el( &$output, $page, $depth = 0, $args = array() ) {
		$output .= "</li>\n";
	}

}