<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Extends classic WP_Nav_Menu_Edit
 *
 * @class YIT_Walker_Nav_Menu_Edit
 * @package	Yithemes
 * @since 1.0.0
 * @author Your Inspiration Themes
 */
class YIT_Walker_Nav_Menu extends Walker_Nav_Menu
{

    //TODO: Sistemare la PHPDoc in tutti i metodi della classe

    /**
     * @var array The array of custom fields to add
     */
    protected $_custom_fields = array();

    /**
     * Constructor
     *
     * @since 1.0.0
     * @author Simone D'Amico <simone.damico@yithemes.com>
     */
    public function __construct() {
        $this->_custom_fields = YIT_Registry::get_instance()->{'navmenu'}->fields;
    }

    /**
     * Display Menu Element
     *
     * @param $element
     * @param $children_elements
     * @param $max_depth
     * @param int $depth
     * @param $args
     * @param $output
     * @return mixed
     *
     * @since 1.0.0
     * @author Simone D'Amico <simone.damico@yithemes.com>
     */
    function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output )
    {
        $id_field = $this->db_fields['id'];
        if ( is_object( $args[0] ) ) {
            $args[0]->children_number = !empty( $children_elements[$element->$id_field] ) ? count($children_elements[$element->$id_field]) : 0;
        }
        return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }

    /**
     * Start elements
     *
     * @param $output
     * @param $item
     * @param int $depth
     * @param array $args
     * @param int $current_object_id
     * @return void
     *
     * @since 1.0.0
     * @author Simone D'Amico <simone.damico@yithemes.com>
     */
    function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0)
    {

        global $wp_query;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $this->_load_custom_fields( $item );

        $class_names = $value = '';
        $children_number = isset($args->children_number) ? $args->children_number : '0';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
        $class_names .= ' menu-item-children-' . $children_number;
        if($depth == 1 && $this->_is_custom_item( $item ) ) {
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
        if($depth == 1 && $this->_is_custom_item( $item ) ) {


            $item_output .= '<a'. $attributes .'>';
            $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $this->_parse_string($item->title), $item->ID ).$append;
            $item_output .= $args->link_after;
            $item_output .= '</a>';

            foreach( $this->_custom_fields as $id=>$field ) {
                if( !empty( $item->{$id} ) && $id != 'yiticon') {
                    $item_output .= $this->get_output( $item, $id, $field );
                }
            }
        } else {
            $item_output .= '<a'. $attributes .'>';
            $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $this->_parse_string($item->title), $item->ID ).$append;
            $item_output .= $args->link_after;
            $item_output .= '</a>';
        }

        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }

    /**
     * Load Custom Fields
     *
     * @param $item
     * @return void
     *
     * @since 1.0.0
     * @author Simone D'Amico <simone.damico@yithemes.com>
     */
    protected function _load_custom_fields( &$item ) {
        foreach( $this->_custom_fields as $field=>$data ) {
            $item->{$field} = get_post_meta( $item->ID, '_menu_item_' . $field, true ) ? get_post_meta( $item->ID, '_menu_item_' . $field, true ) : '';
        }
    }

    /**
     * Chek if is custom item
     *
     * @param $item
     * @return bool
     *
     * @since 1.0.0
     * @author Simone D'Amico <simone.damico@yithemes.com>
     */
    protected function _is_custom_item( $item ) {
        foreach( $this->_custom_fields as $field=>$data ) {

            if( !empty( $item->{$field} ) ) {
                return true;
            }
        }

        return false;
    }

    /**
     * Parse String
     *
     * @param $string
     * @return string
     *
     * @since 1.0.0
     * @author Simone D'Amico <simone.damico@yithemes.com>
     */
    protected function _parse_string( $string ) {
        $string = str_replace( array( '{{', '}}' ), array( '<span class="menu-label highlight-inverse">', '</span>' ), $string );
        $string = str_replace( array( '[[', ']]' ), array( '<span class="menu-label highlight">', '</span>' ), $string );
        $string = str_replace( array( '((', '))' ), array( '<span class="menu-label highlight-alternative">', '</span>' ), $string );
        $string = str_replace( array( '[', ']' ), array( '<span class="highlight">', '</span>' ), $string );
        $string = str_replace( array( '{', '}' ), array( '<span class="highlight-inverse">', '</span>' ), $string );
        return nl2br($string);
    }

    /**
     * Parse Output
     *
     * @param $item
     * @param $fieldId
     * @param $field
     * @return string
     *
     * @since 1.0.0
     * @author Simone D'Amico <simone.damico@yithemes.com>
     */

    public function get_output( $item, $fieldId, $field ) {
        if( $field['type'] == 'text' ) {
            return "<span class='custom-item-{$item->ID} custom-item-{$fieldId} custom-item-text'>" . $item->{$fieldId} . '</span>';
        } elseif( $field['type'] == 'textarea' ) {
            return "<p class='custom-item-{$item->ID} custom-item-{$fieldId} custom-item-textarea'>" . $this->_parse_string($item->{$fieldId}) . '</p>';
        }  elseif( $field['type'] == 'select-icon' && $item->{$fieldId}!='' ) {
            return do_shortcode('[icon icon_theme="'.esc_attr( $item->{$fieldId} ).'" color="inherit"]');
        } elseif( $field['type'] == 'text' && $item->{$fieldId}!='' ) {
            return "<p class='custom-item-{$item->ID} custom-item-{$fieldId} custom-item-text'>" . $this->_parse_string($item->{$fieldId}) . '</p>';
        } elseif( $field['type'] == 'upload' ) {
            $image_id = yit_get_attachment_id( $item->{$fieldId} );
            list( $thumbnail_url, $thumbnail_width, $thumbnail_height ) = wp_get_attachment_image_src( $image_id, "full" );

            return "<a class='custom-item-{$item->ID} custom-item-{$fieldId} custom-item-image' href='". esc_attr( $item->url ) ."'><img src='". esc_url( $thumbnail_url ) ."' alt='". esc_attr( apply_filters( 'the_title', $item->title, $item->ID ) ) ."' width='". esc_attr( $thumbnail_width ) ."' height='". esc_attr( $thumbnail_height ) ."' /></a>";
        }
    }
}
