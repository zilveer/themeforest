<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
 *
 * @package Wordpress
 * @subpackage Kleo
 * @since Kleo 1.0
 */

get_header(); ?>

<?php get_template_part( 'page-parts/general-before-wrap' ); ?>

<?php get_template_part( 'page-parts/page-title' ); ?>

<div class="main-content <?php echo Kleo::get_config('container_class'); ?>">

    <?php
    if ( have_posts() ) :
        // Start the Loop.
        while ( have_posts() ) : the_post();
        ?>

            <?php get_template_part( 'content','page' ); ?>

            <?php
            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
            comments_template();
            endif;
            ?>

        <?php
        endwhile;

    endif;
    ?>

</div>
        
<?php get_template_part( 'page-parts/general-after-wrap' ); ?>

<?php get_footer(); ?>