<?php
/**
 * The template for displaying Archive pages.
 *
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Framework
 * @subpackage G1_Theme01
 * @since G1_Theme01 1.0.0
 */

// Prevent direct script access/
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );
?>
<?php get_header(); ?>
    <?php
        // Our tricky way to pass variables to a template part
        g1_part_set_data( array( 'collection' => 'max', 'summary-type' => 'cut-off' ) );

        get_template_part( 'template-parts/g1_primary_collection', 'max' );
    ?>
<?php get_footer(); ?>