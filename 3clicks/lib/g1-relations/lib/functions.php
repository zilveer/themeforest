<?php
/**
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Theme03
 * @subpackage G1_Relations_Module
 * @since G1_Relations_Module 1.0.0
 */

// Prevent direct script access
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );
?>
<?php
/**
 * Relations Module
 *
 * Allows you to relate different content (posts, pages, etc.),
 * thus benefit from special shortcodes ([related_posts], [related_pages], etc.) or widgets
 *
 * @package G1_Theme03
 * @subpackage G1_Relations_Module
 * @since G1_Relations_Module 1.0.0
 */
class G1_Relations_Module extends G1_Module {
    protected $taxonomy;
    protected $feature;


    public function __construct() {
        parent::__construct();

        $this->set_version('1.0.0');

        $this->set_taxonomy( 'g1_relation_tag' );

        $this->feature = 'g1-relations';
    }

    public function get_module_uri() {
        $uri = trailingslashit( get_template_directory_uri() );
        $uri .= 'lib/g1-relations/';

        return $uri;
    }

    /**
     * Set up all hooks
     */
    protected function setup_hooks() {
        parent::setup_hooks();

        add_action( 'g1_extra_entry_blocks', array( $this, 'render_related_entries' ), 50 );

        add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue' ) );

        /* Notice the very low priority!
         * We want to register our custom taxonomy after all post types
         */
        add_action( 'init', array( $this, 'register_taxonomy' ), 9999 );

        add_action( 'init', array( $this, 'setup_shortcodes' ), 999 );

        add_action( 'g1_single_elements_register', array( $this, 'register_single_elements' ) );

        add_action( 'do_meta_boxes', array( $this, 'alter_relation_tags_meta_box') );
    }

    public function set_taxonomy( $val ) { $this->taxonomy = $val; }
    public function get_taxonomy() { return $this->taxonomy; }


    public function register_single_elements( $manager ) {
        $manager->add_element( 'related-entries', array(
            'label' => __( 'Related Entries', 'g1_theme' ),
            'priority' => 300,
        ));
    }

    /**
     *  Renders related entries for the current post type
     *
     * @return string
     */
    public function render_related_entries() {
        $post_type = get_post_type();

        if ( post_type_supports( $post_type, $this->feature ) ) {
            if ( false !== G1_Elements()->get('related-entries') ) {

                add_filter( 'g1_capture_entry_title_args', array( $this, 'filter_capture_entry_title_args' ) );

                // Capture the template part
                ob_start();
                get_template_part( '/lib/g1-relations/template-parts/related_entries', $post_type );
                echo ob_get_clean();

                remove_filter( 'g1_capture_entry_title_args', array( $this, 'filter_capture_entry_title_args' ) );
            }
        }

    }

    public function filter_capture_entry_title_args( $args ) {
        $args['before'] = '<h4>';
        $args['after'] = '</h4>';

        return $args;
    }

    public function setup_shortcodes() {
        foreach( $this->get_post_types( $this->feature ) as $post_type ) {
            // plural
            $id = $post_type . 's';

            // remove g1_ if needed
            if ( 0 === strpos( $id, 'g1_' ) )
                $id = substr( $id, strlen( 'g1_' ) );

            $args = array(
                'id' => $id,
            );

            G1_Related_Collection_Shortcode( $post_type, $args );
        }
    }


    /**
     * Gets all post types with support for our feature
     *
     * @param string $feature
     * @return array
     */
    public function get_post_types( $feature ) {
        $post_types = array();
        foreach ( get_post_types() as $post_type ) {
            if ( post_type_supports( $post_type, $feature ) ) {
                $post_types[ $post_type ] = $post_type;
            }
        }

        return $post_types;
    }

    /**
     * Enqueues all resources required for the admin site
     */
    public function admin_enqueue() {
        $uri = trailingslashit( $this->get_module_uri() );
        $uri .= 'admin/js/';

        wp_register_script( 'g1-relations-main', $uri . 'main.js', array( 'jquery' ) );

        wp_enqueue_script( 'jquery' );
        wp_enqueue_script( 'g1-relations-main' );
    }

    /**
     * Registers custom taxonomy
     */
    public function register_taxonomy() {
        $post_types = $this->get_post_types( $this->feature );

        $args = array(
            'hierarchical' 			=> false,
            'label' 				=> __('Relation Tag', 'g1_theme'),
            'labels'				=> array(
                'name' 					=> __( 'Relation Tags', 'g1_theme' ),
                'singular_name' 		=> __( 'Relation Tag', 'g1_theme' ),
                'search_items' 			=> __( 'Search Relation Tags', 'g1_theme' ),
                'all_items' 			=> __( 'All Relation Tags', 'g1_theme' ),
                'parent_item' 			=> __( 'Parent Relation Tag', 'g1_theme' ),
                'parent_item_colon' 	=> __( 'Parent Relation Tag:', 'g1_theme' ),
                'edit_item' 			=> __( 'Edit Relation Tag', 'g1_theme' ),
                'update_item' 			=> __( 'Update Relation Tag', 'g1_theme' ),
                'add_new_item' 			=> __( 'Add New Relation Tag', 'g1_theme' ),
                'new_item_name' 		=> __( 'New Relation Tag', 'g1_theme' ),
            ),
            'query_var' 			=> false,
            'rewrite' 				=> false,
            'show_tagcloud'			=> false,
            'show_in_nav_menus'		=> false
        );

        // Apply custom filters (this way Child Themes can change some arguments)
        $args = apply_filters( 'g1_pre_register_custonomy', $args, 'g1_relation_tag' );

        register_taxonomy( 'g1_relation_tag', $post_types, $args );
    }

    /**
     * Alternates the callback function which renders the meta box, so we can add some info there
     */
    public function alter_relation_tags_meta_box() {
        $post_types = $this->get_post_types( $this->feature );

        global $wp_meta_boxes;

        foreach ( $post_types as $post_type ) {
            if (
                isset ( $wp_meta_boxes[ $post_type ] ) &&
                isset ( $wp_meta_boxes[ $post_type ][ 'side' ] ) &&
                isset ( $wp_meta_boxes[ $post_type ][ 'side' ][ 'core' ] ) &&
                isset ( $wp_meta_boxes[ $post_type ][ 'side' ][ 'core' ][ 'tagsdiv-g1_relation_tag' ] )
            ) {
                $wp_meta_boxes[$post_type]['side']['core']['tagsdiv-g1_relation_tag']['callback'] = array( $this, 'render_relation_tags_meta_box' );
            }
        }
    }

    /**
     * Renderss the meta box
     *
     * @param unknown_type $post
     * @param unknown_type $box
     */
    public function render_relation_tags_meta_box($post, $box) {
        post_tags_meta_box($post, $box);
        ?>
    <p><strong><a id="how-to-use-relation-tags-title" href="#"><?php _e( 'How to use relation tags?', 'g1_theme'); ?></a></strong></p>
    <div id="how-to-use-relation-tags-content">
        <div style="padding: 9px 0;">
            <p>
                <?php
                echo
                    '<p>' . __( 'The relation tags are not displayed anywhere - use them to relate different content (posts, pages, etc.), so that you can benefit from special shortcodes ([related_posts], [related_pages], etc.) or widgets .', 'g1_theme' ) . '</p>' .
                    '<p>' . __( 'It is strongly advised to prepend every relation tag with the <strong>r-</strong> prefix, to clearly differentiate these tags, thus keep their slugs unique.', 'g1_theme' ) . '</p>' .
                    '<p><strong>' . __( 'Here is a sample usage:', 'g1_theme' ) . '</strong></p>' .
                    '<ol>' .
                    '<li>' . __( 'Assign the r-home tag to your home page.', 'g1_theme' ) . '</li>' .
                    '<li>' . __( 'Assign the r-home tag to some blog posts.', 'g1_theme' ) . '</li>' .
                    '<li>' . __( 'Insert the [related_posts] shortcode into the content editor, when editing the home page.', 'g1_theme' ) . '</li>' .
                    '<li>' . __( 'Save changes and all related posts will be on your home page.', 'g1_theme'  ) . '</li>' .
                    '</ol>' .
                    '<p>' . __( 'The relation tags are built using custom taxonomy functionality, so they are separated from the standard WordPress tags.', 'g1_theme' ) . '</p>' ;
                ?>
            </p>
        </div>
    </div>
    <?php
    }

    /**
     * Gets related records ids based on relation tags
     *
     * @param int $post_id
     * @param string $post_type
     * @param int $limit
     * @return array
     */
    public function get_related_ids( $post_id, $post_type, $limit ) {
        global $post, $wpdb;

        if( !$post_id )
            $post_id = $post ? $post->ID : 0;

        // Post ID must be positive number
        $post_id = absint($post_id);
        if($post_id <= 0)
            return array();

        $post_type = preg_replace('/[^0-9a-zA-Z_-]*/', '', $post_type);

        $limit = absint($limit);

        if ($limit === 0) {
            $limit = 12;
        }

        $relation_tags = get_the_terms($post_id, 'g1_relation_tag');

        if( $relation_tags && count( $relation_tags ) ) {
            // Prepare tag_ids for further query
            $tag_ids = array();
            foreach($relation_tags as $pt)
                $tag_ids[] = (int)$pt->term_taxonomy_id;

            $tag_ids = implode(',', $tag_ids);

            // Custom SQL query.
            // Standard query_posts function doesn't have enough power to produce results we need
            $g1_query =	"SELECT p.ID, COUNT(t_r.object_id) AS cnt " 			// get post ids and count
                ."FROM $wpdb->term_relationships AS t_r, $wpdb->posts AS p "
                ."WHERE t_r.object_id = p.id " 									// build relations
                ."AND t_r.term_taxonomy_id IN($tag_ids) " 					    // only with the same tags
                ."AND p.post_type='$post_type' "
                ."AND p.id != $post_id " 										// only other posts, not the post selfe
                ."AND p.post_status='publish' " 							    // only published posts
                ."GROUP BY t_r.object_id " 										// group by relation
                ."ORDER BY cnt DESC, p.post_date_gmt DESC " 					// order by count best matches first, and by date within same count
                ."LIMIT $limit "; 												// get only the top x


            // Run the query
            $g1_posts = $wpdb->get_results( $g1_query );

            if ( count( $g1_posts ) ) {
                $related_ids = array();
                foreach($g1_posts as $p)
                    $related_ids[] = (int)$p->ID;

                return $related_ids;
            }
        }

        return array();
    }
}


class G1_Related_Collection_Shortcode extends G1_Collection_Shortcode {
    /**
     * Constructor
     */
    public function __construct( $id, $args = array() ) {
        parent::__construct( $id, $args );

        $this->add_max_attribute();

        // entry_id
        $this->add_attribute( 'entry_id', array(
            'form_control'	=> 'Text',
            'hint'			=> __( 'Entry ID - leave empty to use the current entry ID', 'g1_theme' ),
        ));
    }

    public function set_details(){
        $post_obj = get_post_type_object( $this->get_post_type() );

        if ( $post_obj ) {
            $label = $post_obj->labels->name;
            $label = sprintf( __( '%s: Related', 'g1_theme'), $label );
            $this->set_label( $label );
        }
    }

    protected function get_query() {
        $max = $this->get_attribute( 'max' )->get_value();
        $entry_id = $this->get_attribute( 'entry_id' )->get_value();

        $related_ids = G1_Relations_Module()->get_related_ids( $entry_id, $this->get_post_type(), $max ) ;

        if ( count( $related_ids ) ) {
            $query_args = array(
                'posts_per_page'		=> 100,
                'post_type'				=> $this->get_post_type(),
                'post__in'				=> $related_ids,
                'orderby'				=> 'post__in',
                'ignore_sticky_posts'	=> true,
            );
        } else {
            $query_args = array();
        }

        $query = new WP_Query( $query_args );

        return $query;
    }
}


function G1_Related_Collection_Shortcode( $post_type, $args = array() ) {
    static $instances = array();

    if ( !isset( $instances[ $post_type ] ) ) {
        $id = isset( $args['id'] ) ? $args['id'] : '';

        if ( empty( $id ) ) {
            // Plural
            $id = $post_type . 's';
            $id = 'related_' . $id;
        } else if ( !empty( $id ) && strpos('related_', $id) === false ) {
            $id = 'related_' . $id;
        }

        $instances[ $post_type ] = new G1_Related_Collection_Shortcode( $id, array(
            'post_type' => $post_type,
        ));
    }

    return $instances[ $post_type ];
}