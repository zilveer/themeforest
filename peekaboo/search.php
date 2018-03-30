<?php
/*
 * Search results page
 */
get_header(); ?>
    <!--Main begin-->
<div id="main" class="round_8 clearfix row" role="main">

<?php if (have_posts()) : ?>

    <!--Page title begin-->
    <div class="large-12 columns">
        <div class="page_title round_6">
            <h1 class="replace">
                <?php printf(__('Search Results for: %s', 'peekaboo'), '' . get_search_query() . ''); ?>
            </h1>
        </div>
    </div>
    <!--Page title end-->

    <!-- Content begin-->
    <div id="content" class="large-8 columns">
        <?php get_template_part('loop', 'search'); ?>
    </div>
<?php else : ?>
    <div id="content" class="large-8 columns">
        <?php if ($smof_data['pkb_custom_search_title'] != '') {
            echo '<h2 class="replace">';
            echo $smof_data['pkb_custom_search_title'];
            echo '</h2>';
        } else {
            echo '<h2>';
            echo _e('Nothing Found', 'peekaboo');
            echo '</h2>';
        } ?>

        <?php if ($smof_data['pkb_custom_search_msg'] != '') {
            echo '<p>';
            echo $smof_data['pkb_custom_search_msg'];
            echo '</p>';
        } else {
            echo '<p>';
            echo _e('Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'peekaboo');
            echo '</p>';
        } ?>

        <div class="row">
            <div class="large-6 columns">
                <?php get_search_form(); ?>
            </div>
        </div>
    </div>
<?php endif; ?>
    <!-- Content end-->


    <!-- Sidebar begin-->
    <div id="sidebar" class="large-4 columns">
        <?php get_sidebar(); ?>
    </div>
    <!-- Sidebar end-->

<?php get_footer(); ?>