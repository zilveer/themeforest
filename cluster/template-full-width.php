<?php
/*
 * Template Name: Full Width
 *
 */
?>

<?php get_header(); ?>

<!--BEGIN #primary .hfeed-->
<div id="primary" class="hfeed full" role="main">

    <?php stag_page_before(); ?>
    <?php while ( have_posts() ) : the_post(); ?>

    <?php stag_page_before(); ?>
    <!--BEGIN .hentry-->
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php stag_page_start(); ?>

    <h1 class="entry-title"><?php the_title(); ?></h1>

    <!-- BEGIN .entry-content -->
    <div class="entry-content">
        <?php
            the_content( __('Continue Reading', 'stag') );
            wp_link_pages(array('before' => '<p><strong>'.__('Pages:', 'stag').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number'));
        ?>
    <!-- END .entry-content -->
    </div>

    <?php stag_page_end(); ?>
    <!--END .hentry-->
    </article>
    <?php stag_page_after(); ?>

    <?php endwhile; ?>
    <?php stag_page_after(); ?>

<!--END #primary .hfeed-->
</div>

<?php get_footer(); ?>
