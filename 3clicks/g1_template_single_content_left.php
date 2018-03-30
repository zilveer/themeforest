<?php
/**
 * The Template with the content on the left side for displaying single post.
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
?><?php
// Add proper body classes
add_filter( 'body_class', array(G1_Theme(), 'secondary_none_body_class') );
add_filter( 'body_class', array(G1_Theme(), 'mediabox_narrow_body_class') );
add_filter( 'body_class', array(G1_Theme(), 'mediabox_after_body_class') );
?>
<?php get_header(); ?>
    <div id="primary">
        <div id="content" role="main">

            <?php while ( have_posts() ) : the_post(); ?>
                <?php get_template_part( 'template-parts/g1_entry_half', get_post_format() ); ?>
            <?php endwhile; ?>

        </div><!-- #content -->
    </div><!-- #primary -->
<?php get_footer(); ?>