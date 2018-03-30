<?php
/**
 * This special template is used only when a post is password protected and the correct password hasn't been provided.
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
<?php get_header(); ?>
    <?php get_template_part( 'template-parts/g1_primary_page'); ?>
<?php get_footer(); ?>