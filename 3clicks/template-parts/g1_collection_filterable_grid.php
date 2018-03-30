<?php
/**
 * The Template for displaying work archive|index.
 *
 * The HTMl markup of our collection is a little weird,
 * but we need it to achieve a grid of inline-block items
 *
 * You can read more about it here:
 * http://blog.mozilla.org/webdev/2009/02/20/cross-browser-inline-block/
 *
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Framework
 * @subpackage G1_Theme03
 * @since G1_Theme03 1.0.0
 */

// Prevent direct script access
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );
?>
<?php
    global $wp_query, $post;

    // Our tricky way to get variables that were passed to this template part
    $g1_data = g1_part_get_data();
    $g1_query = $g1_data['query'];
    $g1_query = $g1_query ? $g1_query : $wp_query;
    $g1_collection = $g1_data['collection'];
    $g1_elems = $g1_data['elems'];
    $g1_options = !empty($g1_data['options']) ? $g1_data['options'] : array();

    // Include Isotope Plugin javascripts
    add_filter( 'wp_footer', 'g1_isotope_wp_footer' );

    // Compose filters (taxonomies to be exact)
    $g1_taxonomies = array();

    if ( is_post_type_archive() ) {
        $g1_post_type = get_query_var( 'post_type' );

        // Get available taxonomies for our post type
        $g1_taxonomies = get_taxonomies( array(
            'query_var'     => true,
            'object_type'   => array( $g1_post_type ),
        ));
    } elseif ( is_home() ) {
        $g1_post_type = 'post';

        // Get available taxonomies for our post type
        $g1_taxonomies = get_taxonomies( array(
            'query_var'     => true,
            'object_type'   => array( $g1_post_type ),
        ));
    } elseif( is_tax() ) {
        $g1_taxonomies[] = get_query_var( 'taxonomy' );
    } elseif( is_category() ) {
        $g1_taxonomies[] = 'category';
    } elseif( is_tag() ) {
        $g1_taxonomies[] = 'post_tag';
    }

    // Apply our custom filter
    $g1_taxonomies = apply_filters( 'g1_filterable_grid_filters', $g1_taxonomies );

    $g1_object_ids = array();
    while ( $g1_query->have_posts() ) {
        $g1_query->the_post();
        $g1_object_ids[] = $post->ID;
    }
    wp_reset_postdata();
?>

<?php do_action( 'g1_collection_before', $g1_collection, $g1_query ); ?>

<!-- BEGIN: .g1-isotope-wrapper -->
<div class="g1-isotope-wrapper">
    <nav class="isotope-toolbar">
    <?php foreach( $g1_taxonomies as $g1_taxonomy ): ?>
        <?php
            $g1_taxonomy_obj = get_taxonomy( $g1_taxonomy );

            // Compose the label
            $g1_label = __( 'Filter', 'g1_theme' );
            if ( 1 < count( $g1_taxonomies ) ) {
                $g1_label = $g1_taxonomy_obj->labels->name;

                // Apply custom filter
                $g1_label = apply_filters( 'g1_filterable_grid_filter_label', $g1_label, $g1_taxonomy );
            }

            $g1_args = array();

            // Get unique terms
            $g1_temp = wp_get_object_terms( $g1_object_ids, $g1_taxonomy, $g1_args );
            $g1_terms = array();
            foreach ( $g1_temp as $g1_temp_term ) {
                if ( !isset( $g1_terms[ $g1_temp_term->term_id ] ) ) {
                    $g1_terms[ $g1_temp_term->term_id ] = $g1_temp_term;
                }
            }
            unset( $g1_temp );
        ?>
        <?php if ( count( $g1_terms ) ): ?>
                <div class="g1-isotope-filters">
                    <p><strong><?php echo esc_html( $g1_label ); ?></strong></p>

                    <div>
                        <ul class="meta option-set" data-isotope-filter-group="<?php echo esc_attr( $g1_taxonomy ); ?>">
                            <li class="g1-isotope-filter g1-isotope-filter--current"><a href="#" data-isotope-filter-value=""><?php _e( 'Show all', 'g1_theme' ); ?></a></li>

                            <?php foreach ( $g1_terms as $g1_term ): ?>
                                <li class="g1-isotope-filter"><a href="#" data-isotope-filter-value=".filter-<?php echo $g1_term->term_id; ?>"><?php echo $g1_term->name; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
        <?php endif; ?>
    <?php endforeach; ?>
    </nav>

    <!-- BEGIN: .g1-collection -->
    <div class="<?php echo sanitize_html_classes( $g1_collection->get_classes() );?>">
        <ul><!-- --><?php while ( $g1_query->have_posts() ): $g1_query->the_post(); ?><li class="g1-collection__item <?php g1_render_entry_filters( $g1_taxonomies );?>">
            <?php
                // Our tricky way to pass variables to a template part
                g1_part_set_data( array(
                    'collection' => $g1_collection,
                    'elems'  => $g1_elems,
                    'options'  => $g1_options,
                ));

                get_template_part( 'template-parts/g1_content_grid_item' );
            ?>
        </li><!-- --><?php endwhile; ?></ul>
    </div>
    <!-- END: .g1-collection -->
</div>
<!-- END: .g1-isotope-wrapper -->
<?php wp_reset_postdata(); ?>

<?php do_action( 'g1_collection_after', $g1_collection, $g1_query ); ?>