<?php
/*
Template Name: Full Width Page
*/

get_header(); ?>

    <!--Main begin-->
<div id="main" class="round_8 clearfix row" role="main">

<?php if (have_posts()) while (have_posts()) : the_post(); ?>

    <!-- Breadcrumb begin -->
    <div class="pad-left-10">
        <?php if (function_exists('pkb_breadcrumbs')) pkb_breadcrumbs(); ?>
    </div>
    <!-- Breadcrumb end -->

    <!-- Page title begin -->
    <div class="large-12 columns">
        <div class="page_title round_6">
            <h1 class="replace"><?php the_title(); ?></h1>
        </div>
    </div>
    <!-- Page title end -->

    <!-- Content begin -->
    <div class="full">
        <?php the_content(); ?>
        <?php wp_link_pages(array('before' => '' . __('Pages:', 'peekaboo'), 'after' => '')); ?>
        <?php edit_post_link(__('Edit', 'peekaboo'), '', ''); ?>

    </div>
    <!-- Content end -->

<?php endwhile; ?>

<?php get_footer(); ?>