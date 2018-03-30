<?php
/**
 * Template Name: Shop Search Box Page Template
 *
 * A custom page template without sidebar.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage trizzy
 * @since trizzy 1.0
 */

get_header();
get_template_part( 'inc/woosearchbox' );
?>


<?php
while ( have_posts() ) : the_post(); ?>
<!-- 960 Container -->
<div class="container page-container">
    <div <?php post_class("sixteen columns full-width"); ?>>
                <?php the_content(); ?>
    </div><!-- #main -->
</div><!-- #primary -->

<?php endwhile; // end of the loop.

get_footer(); ?>