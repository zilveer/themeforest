<?php
/*
 * The template for displaying Author Archive pages.
 */

get_header(); ?>

    <!--Main begin-->
<div id="main" class="round_8 clearfix row">

    <!-- Breadcrumb begin -->
    <div class="large-12 columns">
        <?php if (function_exists('pkb_breadcrumbs')) pkb_breadcrumbs(); ?>
    </div>
    <!-- Breadcrumb end -->

    <?php if (have_posts()) the_post(); ?>

    <!-- Content begin-->
    <div id="content" class="large-8 columns">

        <h1 class="replace"><?php the_author(); ?></h1>

        <?php
        // If a user has filled out their description, show a bio on their entries.
        if (get_the_author_meta('description')) : ?>

            <div class="post">
                <div
                    class="author-img-thumb left"><?php echo get_avatar(get_the_author_meta('user_email'), apply_filters('pkb_author_bio_avatar_size', 80)); ?></div>
                <p><?php the_author_meta('description'); ?></p>
                <hr/>
            </div>

        <?php endif; ?>
        <div class="subhead"><h4><?php _e('Posts by', 'peekaboo'); ?><?php the_author(); ?></h4></div>

        <?php
        rewind_posts();
        get_template_part('loop', 'author');
        ?>

    </div>
    <!-- Content end-->

    <!-- Sidebar begin-->
    <div id="sidebar" class="large-4 columns">
        <?php get_sidebar(); ?>
    </div>
    <!-- Sidebar end-->

<?php get_footer(); ?>