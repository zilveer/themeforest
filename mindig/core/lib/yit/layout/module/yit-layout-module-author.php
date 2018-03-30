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


class YIT_Layout_Module_Author extends YIT_Layout_Module {


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

        parent::__construct( 'author', __( 'Author', 'yit' ), true );

        add_action( 'wp_ajax_yit-quick-search-' . $this->id, array( $this, 'search_suggest' ) );


    }


    public function search_suggest() {

        global $wpdb;

        $suggestions = array();

        $authors =$wpdb->get_results($wpdb->prepare("
			SELECT ID, display_name
			FROM $wpdb->users
			WHERE display_name
			LIKE '%s'
			ORDER BY display_name ASC
			LIMIT 0,10
		",
            '%'.$_REQUEST['q'].'%'));

        foreach($authors as $user) {
            $suggestions[] = array(
                'label' => $user->display_name,
                'value' => $user->ID,
                'id'	=> $user->ID,
                'module' => $this->id,
                'name' => $this->id,
                'id2' => $this->id,
                'elem' => $this->id.'-'.$user->ID
            );
        }

        echo json_encode($suggestions);
        die();
    }


    protected function _get_content( $args = array() ) {

        $args = wp_parse_args( $args, array(
            'offset'     => 0,
            'number'    => $this->pagination['per_page'],
            'orderby'   => 'display_name',
            'order' => 'ASC'
        ) );

        extract( $args );


        $user_query = new WP_User_Query(  $args );
       // print_r($user_query);
        $author_list = array();
        if($user_query->results) {
            foreach($user_query->results as $user) {
                //print_r($user);
                if( isset( $user->roles[0] ) && $user->roles[0] != 'subscriber'){
                    $author_list[$user->ID] = $user->display_name;
                }
            }
        }

        $total = $user_query->get_total();
        $this->pagination = array(
            'paged'       => $offset/$this->pagination['per_page'] + 1,
            'total_pages' => ceil( $total / $this->pagination['per_page'] ),
            'total_items' => $total
        );


        return $author_list;

    }


    public function get_box( $post_type ) {

        $recent_posts = $this->_get_content( );


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
            'add_args'  => array( 'item_object' => $post_type ),
        ) );

        if( ! empty($recent_posts)){


            $tabs['view-all'] = array(
                'title'    => __( 'View all', 'yit' ),
                'content'  => $recent_posts,
                'paginate' => $paginate
            );

            if ( $this->serchable ) {
                $tabs['search'] = array(
                    'title'   => __( 'Search', 'yit' ),
                    'content' => ''
                );
            }
        }




        $data = array(
            'model' => 'author',
            'type'  => 'author',
            'tabs'  => $tabs,
            'label' => __('Authors','yit'),
            'label_all' => __('All Authors','yit')
        );

        yit_get_template( '/admin/layout/accordion-item.php', $data );

    }

    public function ajax_get_content() {

        $paged     = isset( $_POST['paged'] ) ? $_POST['paged'] : 1;

        $posts = $this->_get_content( array( 'offset' => ($paged-1) * $this->pagination['per_page'] ));

        $response = '';
        foreach ( $posts as $key =>$content ) {
            $response .= '<li><a href="#" data-model="author" data-type="author" data-id="' . esc_attr( $key ) . '">' . $content . '</a></li>';
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
            'add_args'  => array( 'item_object' => 'author' ),
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
function YIT_Layout_Module_Author() {
    return YIT_Layout_Module_Author::instance();
}

/**
 * Instantiate Sidebar class
 *
 * @since  1.0
 * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
 */
YIT_Layout_Module_Author();
