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
    global $wp_query;

    // Our tricky way to get variables that were passed to this template part
    $g1_data = g1_part_get_data();
    $g1_query = $g1_data['query'];
    $g1_query = $g1_query ? $g1_query : $wp_query;
    $g1_collection = $g1_data['collection'];
    $g1_elems = $g1_data['elems'];
    $g1_options = !empty($g1_data['options']) ? $g1_data['options'] : array();
?>

<?php do_action( 'g1_collection_before', $g1_collection, $g1_query); ?>

<!-- BEGIN: .g1-collection -->
<div class="<?php echo sanitize_html_classes( $g1_collection->get_classes() );?>">
    <ul><!-- --><?php while ( $g1_query->have_posts() ): $g1_query->the_post(); ?><li class="g1-collection__item">
        <?php
            // Our tricky way to pass variables to a template part
            g1_part_set_data( array(
                'collection' => $g1_collection,
                'elems'  => $g1_elems,
                'options' => $g1_options
            ));

            get_template_part( 'template-parts/g1_content_grid_item' );
        ?>
    </li><!-- --><?php endwhile; ?></ul>
</div>
<!-- END: .g1-collection -->
<?php wp_reset_postdata(); ?>

<?php do_action( 'g1_collection_after', $g1_collection, $g1_query ); ?>