<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * In this theme we use it as home.php to reduce number of templates
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
get_header();
global $apollo13;
?>

<?php a13_title_bar(); ?>

<article id="content" class="clearfix <?php echo $apollo13->get_option('blog', 'blog_variant'); ?>">

    <div id="col-mask">

        <div id="post-list">

            <?php
            /* Run the loop to output the post.
             * If you want to overload this in a child theme then include a file
             * called loop-single.php and that will be used instead.
             */
            get_template_part( 'loop' );
            ?>
            <?php a13_blog_nav(); ?>

        </div>

        <?php get_sidebar(); ?>

    </div>

</article>

<?php get_footer(); ?>