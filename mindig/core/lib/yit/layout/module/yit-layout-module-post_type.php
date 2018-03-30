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


class YIT_Layout_Module_Post_Type extends YIT_Layout_Module {


    /**
     * @var object The single instance of the class
     * @since 1.0
     */
    protected static $_instance = null;

    /**
     * @var object Static pages list
     * @since 1.0
     */
    private $static_pages = array();
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

        parent::__construct( 'post_type', __( 'Post Types', 'yit' ), true );

//        $this->post_type_object = get_post_type_object( $this->id );
        $this->static_pages = array(
            'front-page'  => __('Front Page','yit'),
            '404-page'    => __('404 Page','yit'),
            'search-page' => __('Search Page','yit'),
        );

        add_action( 'wp_ajax_yit-quick-search-' . $this->id, array( $this, 'search_suggest' ) );
    }


    public function search_suggest() {

        global $wpdb;
        if ( preg_match( '/yit-quick-search-' . $this->id . '-([a-zA-Z_-]*\b)/', $_REQUEST['type'], $matches ) ) {

            $type  = $matches[1];
          /*  $query = 'SELECT ID,post_title FROM ' . $wpdb->posts . '
                        WHERE post_title LIKE \'' . $search . '%\'
                        AND post_type = \'' . $type . '\'
                        AND post_status = \'publish\'
                        ORDER BY post_title ASC';
            */

            $posts = $wpdb->get_results( $wpdb->prepare( "
                        SELECT ID, post_title, post_type
                        FROM $wpdb->posts
                        WHERE post_type = '%s' AND (post_title LIKE '%s' OR post_name LIKE '%s') AND post_status IN('publish','private','future')
                        ORDER BY post_title ASC
                        LIMIT 0,20",
                $matches[1],
                "%" . $_REQUEST['q'] . "%",
                "%" . $_REQUEST['q'] . "%"
            ) );

            foreach ( $posts as $post ) {
                $suggestions[] = array(
                    'label'  => $post->post_title,
                    'value'  => $post->ID,
                    'id'     => $post->ID,
                    'model'  => 'post_type',
                    'module' => $type,
                    'name'   => $this->id,
                    'id2'    => $this->id . '-' . $post->post_type,
                    'elem'   => $post->post_type . '-' . $post->ID
                );
            }
        }


        echo json_encode( $suggestions );
        die();
    }


    protected function _get_content( $args = array() ) {
        $args = wp_parse_args( $args, array(
            'include'   => '',
            'post_type' => 'post',
            'orderby'   => 'date',
            'order'     => 'DESC',
            'paged'     => 1
        ) );

        extract( $args );

        $query = new WP_Query( array(
            'posts_per_page'      => 20,
            'post_type'           => $post_type,
            'post_status'         => 'publish,private,future',
            'orderby'             => $orderby,
            'order'               => $order,
            'paged'               => $paged,
            'ignore_sticky_posts' => true
        ) );

        $this->pagination = array(
            'paged'       => $paged,
            'per_page'    => 20,
            'total_pages' => $query->max_num_pages,
            'total_items' => $query->found_posts
        );

        wp_reset_postdata();

        return $query->posts;
    }


    public function get_box( $post_type ) {

        $recent_posts = $this->_get_content( array( 'post_type' => $post_type ) );

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
            $tabs['most-recent'] = array(
                'title'   => __( 'Most Recent', 'yit' ),
                'content' => $recent_posts
            );

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


        $obj = get_post_type_object( $post_type );
//var_dump($obj);
        $data = array(
            'model' => 'post_type',
            'type'  => $post_type,
            'tabs'  => $tabs,
            'label' => $obj->labels->name,
            'label_all' => $obj->labels->all_items,
            'static_pages' => $this->static_pages
        );

        yit_get_template( '/admin/layout/accordion-item.php', $data );

    }

    public function ajax_get_content() {

        $post_type = $_POST['item_object'];
        $paged     = isset( $_POST['paged'] ) ? $_POST['paged'] : 1;

        $posts = $this->_get_content( array( 'post_type' => $_POST['item_object'], 'orderby' => 'title', 'order' => 'ASC', 'paged' => $paged ) );

        $response = '';
        foreach ( $posts as $content_post ) {
            $response .= '<li><a href="#" data-model="post_type" data-type="' . esc_attr( $post_type ) . '" data-id="' . esc_attr( $content_post->ID ) . '">' . $content_post->post_title . '</a></li>';
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
            'add_args'  => array( 'item_object' => $post_type ),
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
function YIT_Layout_Module_Post_Type() {
    return YIT_Layout_Module_Post_Type::instance();
}

/**
 * Instantiate Sidebar class
 *
 * @since  1.0
 * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
 */
YIT_Layout_Module_Post_Type();
