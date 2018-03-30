<?php get_header(); ?>

<!--BEGIN #primary .hfeed-->
<div id="primary" class="hfeed" role="main">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <?php stag_post_before(); ?>
    <!--BEGIN .hentry-->
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php stag_post_start(); ?>

    <?php
        $format = get_post_format();
        get_template_part('content', $format);
    ?>

    <?php stag_post_end(); ?>
    <!--END .hentry-->
    </article>
    <?php stag_post_after(); ?>

<?php endwhile; ?>

<?php echo stag_paging_nav(); ?>

<?php else: ?>

    <!--BEGIN #post-0-->
    <div id="post-0" <?php post_class(); ?>>

        <h2 class="entry-title"><?php _e('Error 404 - Not Found', 'stag') ?></h2>

        <!--BEGIN .entry-content-->
        <div class="entry-content">
            <p><?php _e("Sorry, but you are looking for something that isn't here.", "stag") ?></p>
        <!--END .entry-content-->
        </div>

    <!--END #post-0-->
    </div>

<?php endif; ?>
<!--END #primary .hfeed-->
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>