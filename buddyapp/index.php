<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Kleo
 * @author SeventhQueen <themesupport@seventhqueen.com>
 * @since Kleo 1.0
 */

get_header(); ?>

<?php get_template_part( 'page-parts/general-before-wrap' );?>

<?php get_template_part( 'page-parts/page-title' ); ?>

<div class="main-content <?php echo Kleo::get_config('container_class'); ?>">

    <div id="posts" class="small-thumbs">

    <?php
    if ( have_posts() ) :
        // Start the Loop.
        while ( have_posts() ) : the_post();

            /*
             * Include the post format-specific template for the content. If you want to
             * use this in a child theme, then include a file called called content-___.php
             * (where ___ is the post format) and that will be used instead.
             */
            get_template_part( 'page-parts/post-content-small' );

        endwhile;
        // Previous/next post navigation.
        kleo_pagination( 'pagination pag-type-1' );

    endif;
    ?>

    </div>


</div>

<?php get_template_part('page-parts/general-after-wrap'); ?>

<?php
get_footer();
