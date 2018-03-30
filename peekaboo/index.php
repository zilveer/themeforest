<?php
/**
 * The main template file.
 */
get_header(); ?>

<!--Main begin-->
<div id="main" class="round_8 clearfix row" role="main">

    <!-- Content begin-->
    <div id="content" class="large-8 columns">
        <?php get_template_part('loop', 'index'); ?>
    </div>
    <!-- Content end-->

    <!-- Sidebar begin-->
    <div id="sidebar" class="large-4 columns">
        <?php get_sidebar(); ?>
    </div>
    <!-- Sidebar end-->

<?php get_footer(); ?>