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

if ( bp_is_register_page() || bp_is_activation_page()) {
    /* remove sidemenu */
    remove_action( 'kleo_after_body', 'kleo_show_side_menu' );

    /* remove header */
    remove_action( 'kleo_header', 'kleo_show_header', 12 );
}

get_header(); ?>

<?php
//create full width template
kleo_switch_layout('full');
?>

<?php get_template_part( 'page-parts/general-before-wrap' ); ?>

<?php
if ( bp_is_directory() || bp_is_single_activity() ||bp_is_activation_page() ) {
    get_template_part( 'page-parts/page-title' );
}
?>

<div class="main-content <?php echo Kleo::get_config('container_class'); ?>">

    <?php
    if ( have_posts() ) :
        // Start the Loop.
        while ( have_posts() ) : the_post();
        ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                <div class="entry-content">
                    <?php the_content(); ?>
                </div><!-- .entry-content -->

            </article><!-- #post-## -->

        <?php
        endwhile;

    endif;
    ?>

</div>
        
<?php get_template_part('page-parts/general-after-wrap'); ?>

<?php get_footer(); ?>