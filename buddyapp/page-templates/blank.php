<?php
/**
 * Template Name: Blank Page
 *
 * Description: Show a page without header/footer
 *
 *
 * @package WordPress
 * @subpackage BuddyApp
 * @author SeventhQueen <themesupport@seventhqueen.com>
 * @since BuddyApp 1.0
 */

/* remove sidemenu */
remove_action( 'kleo_after_body', 'kleo_show_side_menu' );

/* remove header */
remove_action( 'kleo_header', 'kleo_show_header', 12 );

get_header();
?>

    <?php
    if ( have_posts() ) :
        // Start the Loop.
        while ( have_posts() ) : the_post();
        ?>

        <?php get_template_part( 'content','page' ); ?>

        <?php
        endwhile;

    endif;
    ?>

<?php
get_footer();
?>