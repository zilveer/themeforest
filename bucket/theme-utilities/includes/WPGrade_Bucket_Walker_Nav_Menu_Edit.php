<?php
require_once( ABSPATH . 'wp-admin/includes/nav-menu.php' );

if ( !class_exists( "WPGrade_Bucket_Walker_Nav_Menu_Edit" ) && class_exists( 'Walker_Nav_Menu_Edit' ) ):

class WPGrade_Bucket_Walker_Nav_Menu_Edit extends Walker_Nav_Menu_Edit {
	
	
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		
		// append next menu element to $output
		parent::start_el($output, $item, $depth, $args);
		
		set_error_handler("custom_warning_handler", E_WARNING);
		
		// now let's add the megamenu layout select box but only for the first level
		if ($depth == 0 && ($item->object == 'category' || $item->object == 'post_format')) {

			/*
			 * first we try to do it with the faster phpQuery
			 */
			if (class_exists('DOMDocument')) {

				if ( ! class_exists( 'phpQuery') ) {
					// load phpQuery at the last moment, to minimise chance of conflicts (ok, it's probably a bit too defensive)
					require_once 'vendor/phpQuery.php';
				}
				// enable debugging messages
				//phpQuery::$debug = 0;
				$_doc = phpQuery::newDocumentHTML( $output );
				$_li = phpQuery::pq( 'li.menu-item:last' ); // ":last" is important, because $output will contain all the menu elements before current element

				// if the last <li>'s id attribute doesn't match $item->ID something is very wrong, don't do anything
				// just a safety, should never happen...
				$menu_item_id = str_replace( 'menu-item-', '', $_li->attr( 'id' ) );
				if( $menu_item_id != $item->ID ) {
					return;
				}

				//somewhere to save the new HTML code
				$newHtml = '';

				// now let's add the megamenu layout select box but only for the first level
				if ($depth == 0 && ($item->object == 'category' || $item->object == 'post_format')) {

					// fetch previously saved meta for the post (menu_item is just a post type)
					$current_val = esc_attr( get_post_meta( $menu_item_id, 'wpgrade_megamenu_layout', TRUE ) );

					//let's make the HTML
					//go through the options values and titles
					$themeconfiguration = wpgrade::config();
					if (!empty($themeconfiguration['megamenu_layouts'])) {
						$newHtml .= '<p class="description description-wide wpgrade_custom_menu_meta"><label>'.__('Select MegaMenu Layout:','bucket').' <select name="wpgrade_megamenu_layout_'.$menu_item_id.'">';
						foreach ($themeconfiguration['megamenu_layouts'] as $key => $value) {
							$selected = '';
							if ($key == $current_val) $selected = 'selected';

							$newHtml .= '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
						}
						$newHtml .= '</select></label></p>';
					}

					// by means of phpQuery magic, inject a new input field
					$_li->find( '.menu-item-actions' )
					    ->before( $newHtml );
				}

				// swap the $output
				$output = $_doc->html();

			} else { //else us the slower but somewhat more reliable Ganon

				//load up the library
				if ( ! function_exists( 'wpgrade_str_get_dom' ) ) {
					require_once 'vendor/ganon/ganon.php';
				}

				// Create DOM from string
				$_doc = wpgrade_str_get_dom( $output );

				$_li = $_doc->select( '.menu-item-depth-0', - 1 ); // "-1" aka the last element is important, because $output will contain all the menu elements before current element

				// if the last <li>'s id attribute doesn't match $item->ID something is very wrong, don't do anything
				// just a safety, should never happen...
				$menu_item_id = str_replace( 'menu-item-', '', $_li->getAttribute( 'id' ) );

				if ( $menu_item_id != $item->ID ) {
					return;
				}

				//somewhere to save the new HTML code
				$newHtml = '';

				// fetch previously saved meta for the post (menu_item is just a post type)
				$current_val = esc_attr( get_post_meta( $item->ID, 'wpgrade_megamenu_layout', true ) );

				//let's make the HTML
				//go through the options values and titles
				$themeconfiguration = wpgrade::config();
				if ( ! empty( $themeconfiguration['megamenu_layouts'] ) ) {
					$newHtml .= '<p class="link-to-original wpgrade_custom_menu_meta"><label>' . __( 'Select MegaMenu Layout:', 'bucket' ) . ' <select name="wpgrade_megamenu_layout_' . $menu_item_id . '">';
					foreach ( $themeconfiguration['megamenu_layouts'] as $key => $value ) {
						$selected = '';
						if ( $key == $current_val )
							$selected = 'selected';

						$newHtml .= '<option value="' . $key . '" ' . $selected . '>' . $value . '</option>';
					}
					$newHtml .= '</select></label></p>';
				}

				// inject the new input field
				$whereto = $_li->select( '.menu-item-actions', 0 );
				//add it before
				$whereto->setInnerText( $newHtml . $whereto->getInnerText() );

				// swap the $output
				$output = $_doc->getInnerText();

				//cleanup
				//$_doc->__destruct();
				unset( $_doc );
			}
		}
		
		restore_error_handler();
		
	}

}

endif;
