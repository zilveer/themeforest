<?php global $smof_data;
    $dreamer_twitter_header = $smof_data['twitter_header'];
    $dreamer_twitter_page_title = $smof_data['twitter_page_title'];
    $dreamer_twitter_page_description = $smof_data['twitter_page_description'];
?>
<!-- Our Latest News Page -->
<div class="page-container pattern-2" id="tweets">
    <div class="row">
        <div class="twelve columns page-content">
            <h1 class="page-title"><?php echo $dreamer_twitter_page_title ?></h1>
            <h2 class="page-subtitle"><?php echo $dreamer_twitter_page_description ?></h2>
        </div>
        <!-- Twitter Feed -->
        <div class="twitter-section twelve columns" data-thumb="<?php echo get_template_directory_uri(); ?>/images/twitter-feed.png">
            <div id="jstwitter" class="clearfix"></div>
            <a class="readMorePosts followUs" target="_blank" href="<?php echo $dreamer_twitter_header; ?>">Follow Us on Twitter</a>
        </div>
    </div>
</div>