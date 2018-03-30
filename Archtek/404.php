<?php get_header(); ?>

<!-- Page Intro -->
<div id="intro" class="not-homepage not-found-404 row">
    <div class="large-9 large-centered columns">
        <h1>404 <strong><?php _e('Page Not Found', 'uxbarn'); ?></strong></h1>
        <p>
            <?php _e('Your requested page could not be found or it is currently unavailable.', 'uxbarn'); ?>
            <br/>
            <?php printf(__('Please <a href="%s">click here</a> to go back to our home page or use the search form below.', 'uxbarn'), home_url()); ?>
        </p>
    </div>
</div>
<div class="row no-margin no-bg">
    <div class="large-6 columns no-bg no-padding large-centered">
        <?php get_search_form(); ?>
    </div>
</div>

<?php get_footer(); ?>