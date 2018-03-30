<?php
$args = jaw_template_get_var('args');
$instance = jaw_template_get_var('instance');
$feedData = jaw_template_get_var('feedData');

extract($args);

echo $before_widget;
?>

<article id="rating-widget" class="widget">
    <?php
    $title = apply_filters('widget_title', empty($instance['ratings_title']) ? '' : $instance['ratings_title'], $instance, '');

    if (!empty($title)) {
        echo $before_title . $title . $after_title;
    }

    if ($feedData) {
        foreach ((array) $feedData->ratings as $post) {
            $ratingManager = ratingManager::getInstance();
            $ratings = $ratingManager->getRatings($post->ID);
            $totalrat = $ratingManager->getRatingsScore($ratings);
            $total = round($totalrat * 100);
            ?>
            <div class="rating-widget-row">
                <?php
                if (has_post_thumbnail()) {
                    ?>
                    <div class="tab-post-widget-img">
                        <a href="<?php the_permalink(); ?>"><?php echo the_post_thumbnail(array(75, 75)); ?></a>
                    </div>
                    <div class="tab-post-widget-content has_image">
                        <h3><a href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a></h3>
                        <div class="rating">
                            <?php echo jwRender::metaRating(); ?>  <!-- RATING -->
                            <div class="clear"></div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>    
            <?php } ?>
        <?php } ?>
    <?php } ?>
</article>
<?php
wp_reset_postdata();
wp_reset_query();
echo $after_widget;
