<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'YIT' ) ) {
    exit;
} // Exit if accessed directly


class YIT_Layout_Module_Taxonomy extends YIT_Layout_Module {


    /**
     * @var object The single instance of the class
     * @since 1.0
     */
    protected static $_instance = null;


    /**
     * Main plugin Instance
     *
     * @static
     * @return object Main instance
     *
     * @since  1.0
     * @author Antonino Scarfi' <antonino.scarfi@yithemes.com>
     */
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     *
     * Constructor
     *
     */
    public function __construct() {
        parent::__construct( 'taxonomy', __( 'Taxonomy', 'yit' ), true );
        add_action( 'wp_ajax_yit-quick-search-' . $this->id, array( $this, 'search_suggest' ) );
    }


    public function search_suggest() {

        global $wpdb;

        if ( preg_match( '/yit-quick-search-' . $this->id . '-([a-zA-Z_-]*\b)/', $_REQUEST['type'], $matches ) ) {

            if ( ( $taxonomy = get_taxonomy( $matches[1] ) ) ) {
                $terms = get_terms( array(
                    'taxonomy'   => $taxonomy->name,
                    'number'     => 10,
                    'hide_empty' => false,
                    'search'     => $_REQUEST['q']
                ) );
                $name  = 'tax_input[' . $matches[1] . ']';
                $value = ( $taxonomy->hierarchical ? 'term_id' : 'slug' );
                foreach ( $terms as $term ) {
                    $suggestions[] = array(
                        'label'  => $term->name,
                        'value'  => $term->$value,
                        'id'     => $term->$value,
                        'model'  => 'taxonomy',
                        'module' => $term->taxonomy,
                        'name'   => $name,
                        'id2'    => $this->id . '-' . $term->taxonomy,
                        'elem'   => $term->taxonomy . '-' . $term->term_id
                    );
                }
            }

        }


        echo json_encode( $suggestions );
        die();
    }


    protected function _get_content( $args = array() ) {

        $args = wp_parse_args( $args, array(
            'include'  => '',
            'taxonomy' => 'category',
            'number'   => 20,
            'orderby'  => 'name',
            'order'    => 'ASC',
            'offset'   => 0
        ) );
        extract( $args );

        if( ! isset( $paged ) ) $paged = 1;

        $terms = get_terms( array(
            'taxonomy'   => $taxonomy,
            'number'     => $number,
            'hide_empty' => false,
            'include'    => $include,
            'offset'     => $number * ( $paged - 1 ),
            'orderby'    => $orderby,
            'order'      => $order
        ) );
        $total_items      = wp_count_terms( $taxonomy, array( 'hide_empty' => false ) );
        $per_page         = $number;
        $this->pagination = array(
            'paged'       => $offset + $paged,
            'per_page'    => $per_page,
            'total_pages' => ceil( $total_items / $per_page ),
            'total_items' => $total_items
        );

        return $terms;


    }


    public function get_box( $taxonomy ) {

        $most_used = $this->_get_content( array( 'taxonomy' => $taxonomy ) );
        $tabs = array();

        $paginate = paginate_links( array(
            'base'      => admin_url( 'admin-ajax.php' ) . '%_%',
            'format'    => '?paged=%#%',
            'total'     => $this->pagination['total_pages'],
            'current'   => $this->pagination['paged'],
            'mid_size'  => 2,
            'end_size'  => 1,
            'prev_next' => true,
            'prev_text' => 'prev',
            'next_text' => 'next',
            'add_args'  => array( 'item_object' => $taxonomy ),
        ) );

        if ( ! empty( $most_used ) ) {
            $tabs['most-recent'] = array(
                'title'   => __( 'Most Used', 'yit' ),
                'content' => $most_used
            );

            $tabs['view-all'] = array(
                'title'    => __( 'View all', 'yit' ),
                'content'  => $most_used,
                'paginate' => $paginate
            );

            if ( $this->serchable ) {
                $tabs['search'] = array(
                    'title'   => __( 'Search', 'yit' ),
                    'content' => ''
                );
            }
        }


        $obj = get_taxonomy( $taxonomy );


        $data = array(
            'model' => 'taxonomy',
            'type'  => $taxonomy,
            'tabs'  => $tabs,
            'label' => $obj->labels->name,
            'label_all' => $obj->labels->name
        );

        yit_get_template( '/admin/layout/accordion-item.php', $data );

    }

    public function ajax_get_content() {

        $taxonomy = $_POST['item_object'];
        $paged    = isset( $_POST['paged'] ) ? $_POST['paged'] : 1;

        $posts = $this->_get_content( array( 'taxonomy' => $_POST['item_object'], 'orderby' => 'name', 'order' => 'ASC', 'paged' => $paged ) );

        $response = '';
        foreach ( $posts as $content ) {
            $response .= '<li><a href="#" data-model="taxonomy" data-type="' . esc_attr( $taxonomy ) . '" data-id="' . esc_attr( $content->term_id ) . '">' . $content->name . '</a></li>';
        }

        $paginate = paginate_links( array(
            'base'      => admin_url( 'admin-ajax.php' ) . '%_%',
            'format'    => '?paged=%#%',
            'total'     => $this->pagination['total_pages'],
            'current'   => $this->pagination['paged'],
            'mid_size'  => 2,
            'end_size'  => 1,
            'prev_next' => true,
            'prev_text' => 'prev',
            'next_text' => 'next',
            'add_args'  => array( 'item_object' => $taxonomy ),
        ) );

        $response = '<li class="paginate">' . $paginate . '</li>' . $response;

        echo json_encode( $response );
        die();


    }
}

/**
 * Main instance of plugin
 *
 * @return object
 * @since  1.0
 * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
 */
function YIT_Layout_Module_Taxonomy() {
    return YIT_Layout_Module_Taxonomy::instance();
}

/**
 * Instantiate Sidebar class
 *
 * @since  1.0
 * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
 */
YIT_Layout_Module_Taxonomy();
