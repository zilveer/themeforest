<?php
/*
 * The template for displaying Category Archive pages.
 */

get_header(); ?>

    <!--Main begin-->
<div id="main" class="round_8 clearfix row">
    <!-- Breadcrumbs begin-->
    <div class="pad-left-10">
        <?php if (function_exists('pkb_breadcrumbs')) pkb_breadcrumbs(); ?>
    </div>
    <!-- Breadcrumbs end-->

    <!-- Page Title begin-->
    <div class="large-12 columns">
        <div class="page_title round_6">
            <h1 class="replace"><?php printf(__('Category Archives: %s', 'peekaboo'), '' . single_cat_title('', false) . '');     ?></h1>
        </div>
    </div>
    <!-- Page Title end-->

    <!-- Content begin-->
    <div id="content" class="large-8 columns">
        <?php
        $category_description = category_description();
        if (!empty($category_description))
            echo '' . $category_description . '';

        get_template_part('loop', 'category');
        ?>
    </div>
    <!-- Content end-->

    <!-- Sidebar begin-->
    <div id="sidebar" class="large-4 columns">
        <?php get_sidebar(); ?>
    </div>
    <!-- Sidebar end-->

<?php get_footer(); ?>