<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 *
 * @package BTP_Flare_Theme
 */
?>
<?php get_header(); ?>
<?php get_template_part( 'precontent' ); ?>

    <div id="content" class="<?php echo btp_content_get_class(); ?>">
        <div id="content-inner">
            <?php woocommerce_content(); ?>

        </div><!-- #content-inner -->
        <div class="background"><div></div></div>
    </div><!-- #content -->

<?php get_footer(); ?>