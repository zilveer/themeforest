<?php
/**
 * This partial is used for displaying empty page content
 *
 * Search result page
 *
 */ ?>
<header class="section-title large">
    <?php do_action('layers_before_single_title'); ?>
    <h1 class="heading"><?php _e('Oops, This Page Could Not Be Found!', TL_DOMAIN); ?></h1>
    <?php do_action('layers_after_single_title'); ?>
</header>
<div class="story-wrapper">
    <div class="story">
        <p><?php _e('Use the search form below to find the page you\'re looking for:', TL_DOMAIN); ?></p>
        <?php get_search_form(); ?>
    </div>
</div>