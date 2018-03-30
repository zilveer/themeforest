<?php
/**
Template Name: Contact(map content width)
 * The template for displaying Contact form.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

global $apollo13;

get_header();

the_post();

$map_on = $apollo13->get_option('contact','contact_map') === 'on';
?>

<?php a13_title_bar(); ?>

<article id="content" class="clearfix<?php echo $map_on? ' with-map' : '';?>">

    <div id="col-mask">

        <div id="post-<?php the_ID(); ?>" <?php post_class('post-content'); ?>>
            <?php
            a13_top_image_video();
            ?>

            <div class="real-content">
                <?php the_content(); ?>

                <div class="clear"></div>

                <?php
                wp_link_pages( array(
                        'before' => '<div id="page-links">'.__('Pages: ', 'fame' ),
                        'after'  => '</div>')
                );
                ?>
            </div>

            <?php get_template_part( 'parts/map' ); ?>
        </div>

        <?php get_sidebar(); ?>

    </div>
</article>

<?php get_footer(); ?>