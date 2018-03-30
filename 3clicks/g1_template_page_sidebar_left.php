<?php
/**
 * Template Name: Page: Left Sidebar
 *
 * The sidebar block is after the main content for SEO purposes.
 * This will be fixed via CSS rules.
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
add_filter( 'body_class', array(G1_Theme(), 'secondary_wide_body_class') );
add_filter( 'body_class', array(G1_Theme(), 'secondary_before_body_class') );
?>
<?php get_header(); ?>

    <?php get_template_part( 'template-parts/g1_primary_page'); ?>
    <?php get_sidebar(); ?>

<?php get_footer(); ?>