<?php get_header(); ?>

<?php global $ttso; ?>

<?php get_template_part( 'template-part-page-slider', 'childtheme' ); ?>

<section id="content-container" class="clearfix">
    <div id="main-wrap" class="main-wrap-slider clearfix">
        <div class="page-not-found clearfix">
            <?php echo stripslashes( html_entity_decode($ttso->st_404message) ); ?>
        </div><!-- end .page-not-found -->
    </div><!-- end #main-wrap -->

<?php get_footer(); ?>