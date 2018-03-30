<?php
/**
 * Your Inspiration Themes
 *
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Extends classic WP_Nav_Menu_Edit
 *
 * @since 1.0.0
 */

class YIT_Walker_Nav_Menu extends Walker_Nav_Menu
{
	protected $_customFields = array();

	public function __construct() {
		$this->_customFields = yit_get_model('nav_menu')->fields;
	}

    function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output )
    {
        $id_field = $this->db_fields['id'];
        if ( is_object( $args[0] ) ) {
            $args[0]->children_number = !empty( $children_elements[$element->$id_field] ) ? count($children_elements[$element->$id_field]) : 0;
        }
        return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }

	function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0)
    {
    	global $wp_query;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$this->_loadCustomFields( $item );

        $class_names = $value = '';
		$children_number = isset($args->children_number) ? $args->children_number : '0';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names .= ' menu-item-children-' . $children_number;
		if($depth == 1 && $this->_isCustomItem( $item ) ) {
			$class_names .= ' menu-item-custom-content';
		}
        $class_names = ' class="'. esc_attr( $class_names ) . '"';

        $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

        $prepend = '';
        $append = '';
        $description  = ''; //! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';

        $item_output = $args->before;

        if($depth == 1 && $this->_isCustomItem( $item ) ) {

	        $item_output .= '<a'. $attributes .'>';
	        $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
	        $item_output .= $args->link_after;
	        $item_output .= '</a>';

			foreach( $this->_customFields as $id=>$field ) {
				if( !empty( $item->{$id} ) ) {
					$item_output .= $this->getOutput( $item, $id, $field );
				}
			}

		} else {
	        $item_output .= '<a'. $attributes .'>';
	        $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
	        $item_output .= $args->link_after;
	        $item_output .= '</a>';
		}

        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	protected function _loadCustomFields( &$item ) {
		foreach( $this->_customFields as $field=>$data ) {
			$item->{$field} = get_post_meta( $item->ID, '_menu_item_' . $field, true ) ? get_post_meta( $item->ID, '_menu_item_' . $field, true ) : '';
		}
	}

	protected function _isCustomItem( $item ) {
		foreach( $this->_customFields as $field=>$data ) {
			if( !empty( $item->{$field} ) ) {
				return true;
			}
		}

		return false;
	}

	protected function _parseString( $string ) {
		$string = str_replace( array( '[', ']' ), array( '<span class="highlight">', '</span>' ), $string );
		return nl2br($string);
	}

	public function getOutput( $item, $fieldId, $field ) {
		if( $field['type'] == 'text' ) {
			return "<span class='custom-item-{$item->ID} custom-item-{$fieldId} custom-item-text'>" . $item->{$fieldId} . '</span>';
		} elseif( $field['type'] == 'textarea' ) {
			return "<p class='custom-item-{$item->ID} custom-item-{$fieldId} custom-item-textarea'>" . $this->_parseString($item->{$fieldId}) . '</p>';
		} elseif( $field['type'] == 'upload' ) {
			$image_id   = yit_get_attachment_id( $item->{$fieldId} );
			$thumb_size = apply_filters( 'yit_nav_thumb_size', 'thumb_portfolio_4cols' );

            $image      = yit_image( "id=" . $image_id . "&size=" . $thumb_size . "&output=array" );
			if ( count( $image ) != 3 ) return;
            list( $thumbnail_url, $thumbnail_width, $thumbnail_height ) = $image;

			$img     = '<img src="' . yit_strip_protocol( $thumbnail_url ) . '" alt="' . apply_filters( 'the_title', $item->title, $item->ID ) . '" />';
			$classes = array( 'custom-item-' . $item->ID, 'custom-item-' . $fieldId, 'custom-item-image' );
			$output  = '<a class="' . implode(' ', $classes ) . '" href="' . esc_attr( $item->url ) . '">' . $img . '</a>';

			return $output;
		}
	}
}
