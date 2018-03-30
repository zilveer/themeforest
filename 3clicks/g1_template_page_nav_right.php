<?php
/**
 * Template Name: Page: Right Nav
 *
 * The navigation block is after the main content for SEO purposes.
 * This will be fixed via CSS rules.
 *
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Framework
 * @subpackage G1_Theme01
 * @since G1_Theme01 1.0.0
 */

// Prevent direct script access
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );
?>
<?php
// Add proper body classes
add_filter( 'body_class', array(G1_Theme(), 'secondary_narrow_body_class') );
add_filter( 'body_class', array(G1_Theme(), 'secondary_after_body_class') );
?>
<?php get_header(); ?>

    <?php get_template_part( 'template-parts/g1_primary_page'); ?>
    <?php get_template_part( 'template-parts/g1_secondary_page_nav'); ?>

<?php get_footer(); ?>