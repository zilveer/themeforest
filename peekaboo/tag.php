<?php
/**
 * Tag Archive pages
 */

get_header(); ?>

    <!--Main begin-->
<div id="main" class="round_8 clearfix row">

    <!--Breadcrumbs begin-->
    <div class="large-12 columns">
        <?php if (function_exists('pkb_breadcrumbs')) {
            pkb_breadcrumbs();
        } ?>
    </div>
    <!--Breadcrumbs end-->

    <!-- Page Title begin -->
    <div class="large-12 columns">
        <div class="page_title round_6">
            <h1 class="replace">
                <?php
                printf(__('Tag Archives: %s', 'peekaboo'), '' . single_tag_title('', false) . '');
                ?>
            </h1>
        </div>
    </div>
    <!-- Page Title end -->

    <!-- Content begin-->
    <div id="content" class="large-8 columns">
        <?php get_template_part('loop', 'tag'); ?>
    </div>
    <!-- Content end-->

    <!-- Sidebar begin-->
    <div id="sidebar" class="large-4 columns">
        <?php get_sidebar(); ?>
    </div>
    <!-- Sidebar end-->

<?php get_footer(); ?>