<?php
/**
 * Template Name: WooCommerce Page
 * @package commercegurus
 */
get_header();
?>
<?php cg_get_page_title(); ?>
<div class="content-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">

                <?php while ( have_posts() ) : the_post(); ?>
                    <?php get_template_part( 'content', 'wcfullwidthpage' ); ?>
                </div>
            </div>
        </div>
        <div class="container">
            <?php
            $cg_comments_status = $cg_options['cg_page_comments'];
            if ( $cg_comments_status == 'yes' ) {
                if ( comments_open() || '0' != get_comments_number() ) {
                    comments_template();
                }
            }
            ?>
        </div>
    <?php endwhile; // end of the loop. ?>
</div><!-- #primary -->
<?php get_footer(); ?>
