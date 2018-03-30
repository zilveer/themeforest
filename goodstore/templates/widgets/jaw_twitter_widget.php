<?php 
$args = jaw_template_get_var('args');
$instance = jaw_template_get_var('instance');
$tweets = jaw_template_get_var('tweets');

extract($args);
echo $before_widget;

?>
<article id="jw-tweets-widgets" class="widget">
    <?php 
    $title = apply_filters('widget_title', empty($instance['widget_title']) ? '' : $instance['widget_title'], $instance, '');

    if (!empty($title)) {
        echo $before_title . $title . $after_title;
    }
    ?>
    <ul class="jw-tweets-widgets-tweets">
        <?php foreach ((array) $tweets as $tweet) { ?>
        <li>
            <div class="jw-tweets-widgets-icon">
                <span class="icon-twitter3"></span>
            </div>
            <div><?php echo $tweet->tweet; ?></div>
        </li>
        <?php } ?>
    </ul>
</article>
<?php
echo $after_widget;