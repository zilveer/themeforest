<?php
/*
 * The template for displaying Archive pages.
 */

get_header(); ?>

<!--Main begin-->
<div id="main" class="round_8 clearfix row" role="main">
    <!-- Breadcrumbs begin-->
    <div class="pad-left-10">
        <?php if (function_exists('pkb_breadcrumbs')) pkb_breadcrumbs(); ?>
    </div>
    <!-- Breadcrumbs end-->

    <?php if (have_posts()) the_post();    ?>

    <!-- Page Title begin-->
    <div class="large-12 columns">
        <div class="page_title round_6">
            <h1 class="replace">
                <?php if (is_day()) : ?>
                    <?php printf(__('Daily Archives: %s', 'peekaboo'), get_the_date()); ?>
                <?php elseif (is_month()) : ?>
                    <?php printf(__('Monthly Archives: %s', 'peekaboo'), get_the_date('F Y')); ?>
                <?php elseif (is_year()) : ?>
                    <?php printf(__('Yearly Archives: %s', 'peekaboo'), get_the_date('Y')); ?>
                <?php else : ?>
                    <?php __('Archives', 'peekaboo'); ?>
                <?php endif; ?>
            </h1>
        </div>
    </div>
    <!-- Page Title end-->


    <!-- Content begin-->
    <div id="content" class="large-8 columns" role="main">
        <?php
        rewind_posts();
        get_template_part('loop', 'archive');
        ?>
    </div>
    <!-- Content end-->

    <!-- Sidebar begin-->
    <div id="sidebar" class="large-4 columns">
        <?php get_sidebar(); ?>
    </div>
    <!-- Sidebar end-->

<?php get_footer(); ?>