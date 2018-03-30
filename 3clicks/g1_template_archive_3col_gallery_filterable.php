<?php
/**
 * The Template for displaying work archive|index.
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
    // Add proper body classes
    add_filter( 'body_class', array(G1_Theme(), 'secondary_none_body_class') );
?>
<?php get_header(); ?>
    <?php
        // Our tricky way to pass variables to a template part
        g1_part_set_data( array( 'collection' => 'one-third-gallery-filterable' ) );

        get_template_part( 'template-parts/g1_primary_collection', 'one-third-gallery-filterable' );
    ?>
<?php get_footer(); ?>