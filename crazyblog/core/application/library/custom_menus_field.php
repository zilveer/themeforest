<?php

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

class Custom_menu_field extends Walker_Nav_Menu_Edit {

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		// append next menu element to $output
		parent::start_el( $output, $item, $depth, $args );
		// now let's add a custom form field

		if ( !class_exists( 'phpQuery' ) ) {
			// load phpQuery at the last moment, to minimise chance of conflicts (ok, it's probably a bit too defensive)
			require_once WST_ROOT . 'core/application/library/phpQuery-onefile.php';
		}
		libxml_use_internal_errors( true );
		$_doc = phpQuery::newDocumentHTML( $output );
		$_li = phpQuery::pq( 'li.menu-item:last' );
		// ":last" is important, because $output will contain all the menu elements before current element
		// if the last <li>'s id attribute doesn't match $item->ID something is very wrong, don't do anything
		// just a safety, should never happen...
		$menu_item_id = str_replace( 'menu-item-', '', $_li->attr( 'id' ) );

		if ( $menu_item_id != $item->ID ) {
			return;
		}

		// fetch previously saved meta for the post (menu_item is just a post type)
		$mega_val = esc_attr( get_post_meta( $menu_item_id, 'wst_mega_menu_custom_field', TRUE ) );
		$wst_checked = ($mega_val == 'yes') ? 'checked="checked"' : '';

		// by means of phpQuery magic, inject a new input field
		if ( $depth == 0 ) {

			$_li->find( '.menu-item-actions.submitbox' )
					->before( '<p class=" description-wide checkbox-input"><label><input type="checkbox" ' . $wst_checked . ' value="yes" name="wst_mega_menu_custom_field_' . $menu_item_id . '" /> ' . esc_html__( 'Mega Menu', 'crazyblog' ) . '</label></p>' );
		}

		// swap the $output
		$output = $_doc->html();
	}

}

new Custom_menu_field();
