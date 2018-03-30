<?php
$args = jaw_template_get_var('args');
$instance = jaw_template_get_var('instance');
$postData = jaw_template_get_var('postData');

$random = rand(0, 1000);
extract($args);
$title = apply_filters('widget_title', empty($instance['latest_post_title']) ? '' : $instance['latest_post_title'], $instance, 'a');

echo $before_widget;
if (!empty($title)) {
    echo $before_title . $title . $after_title;
}
?>
<div class="latestpostwidget">
    <?php
    foreach ($postData as $post) {
        setup_postdata($post);
        ?>
        <div class="latest_posts_post">
            <?php if (has_post_thumbnail()) { ?>
                <div class="latestpostwidget-image">
                    <?php echo the_post_thumbnail(array(75, 75)); ?>
                </div>
            <?php } else { ?>
                <?php if (get_post_format() == "gallery") { ?>  
                    <?php
                    $gallery = json_decode(get_post_meta($post->ID, '_post_gallery', true));
                    if (isset($gallery[0])) {
                        $first = 'active';
                        ?>
                        <div id="jaw-carousel-<?php echo $random; ?>" class="carousel horizontal slide navigation-side">
                            <div class="carousel-inner">
                                <?php
                                foreach ((array) $gallery as $key => $image) {
                                    if (isset($image->id)) {
                                        $gallery_item = wp_get_attachment_metadata($image->id);
                                        $url = wp_get_attachment_image_src($image->id, 'post-size-middle');
                                    }
                                    if (isset($url[0])) {
                                        $i['url'] = $url[0];

                                        if (!isset($i['caption'])) {
                                            $i['caption'] = get_the_title();
                                        } else {
                                            $i['caption'] = $gallery_item['image_meta']['caption'];
                                        }
                                        ?>
                                        <div class="item <?php echo $first; ?>">
                                            <div class="carousel-caption row">
                                                <?php
                                                switch (jwOpt::get_option('std_post_image_clickable', '0')) {
                                                    case '1': echo '<a href="' . get_permalink() . '"  title="' . jwUtils::crop_length(get_the_title(), jaw_template_get_var('letter_excerpt_title', 60)) . '">';
                                                        break;
                                                    case '2': echo '<a href="' . $image->url . '"  rel="prettyPhoto[posts-' . jaw_template_get_counter('pagination') . ']" title="' . $i['caption'] . '">';
                                                        break;
                                                }
                                                ?>
                                                <img src="<?php echo $i['url']; ?>" alt="<?php echo $i['caption']; ?>" title="<?php echo $i['caption']; ?>" width="307"/>
                                                <?php
                                                if (jwOpt::get_option('std_post_image_clickable', '0') != '0') {
                                                    echo '</a>';
                                                }
                                                ?>
                                            </div>
                                        </div>

                                        <?php
                                        $first = '';
                                    }
                                }
                                ?>

                            </div>
                            <!-- Controls -->
                            <a class="left carousel-control" href="#jaw-carousel-<?php echo $random; ?>" data-slide="prev">
                                <span class="icon-prev"></span>
                            </a>
                            <a class="right carousel-control" href="#jaw-carousel-<?php echo $random; ?>" data-slide="next">
                                <span class="icon-next"></span>
                            </a>
                        </div>
                    <?php } ?>
                <?php } else if (get_post_format() == "video") { ?>
                    <?php
                    $video_url = get_post_meta(get_the_ID(), '_post_video_link', true);

                    $link = $video_url;
                    $video = jwUtils::get_video_info($video_url);
                    if ($video->domain == 'vine') {
                        $link = $video->thumbnails['thumbnail_medium'];
                    }
                    switch (jwOpt::get_option('std_post_image_clickable', '0')) {
                        case '1': echo '<a href="' . get_permalink() . '"  title="' . jwUtils::crop_length(get_the_title(), jaw_template_get_var('letter_excerpt_title', 60)) . '" class="post-type-video-icon">';
                            break;
                        case '2': echo '<a href="' . $link . '"  rel="prettyPhoto[posts-' . jaw_template_get_counter('pagination') . ']" title="' . jwUtils::crop_length(get_the_title(), jaw_template_get_var('letter_excerpt_title', 60)) . '" class="post-type-video-icon">';
                            break;
                    }
                    if (!jwUtils::has_post_thumbnail()) {
                        //obrázek videa
                        if (isset($video->thumbnails['thumbnail_medium'])) {
                            echo '<img src="' . $video->thumbnails['thumbnail_medium'] . '"  width = "' . (jwUtils::get_size('4') - 40) . '" height="193" alt="' . get_the_title() . '" / >';
                        }
                    } else {
                        jwUtils::the_post_thumbnail('post-size-middle');
                    }
                    if (jwOpt::get_option('std_post_image_clickable', '0') != '0') {
                        echo '</a>';
                    }
                    ?>
                <?php } ?>
            <?php } ?>
            <div class="latestpostwidget-content">
                <h3>
                    <a href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a>
                </h3>
                <div class="date">
                    <span>
                        <?php echo get_the_time(jwOpt::get_option('element_blog_dateformat', 'M j, Y')); ?>
                    </span>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    <?php } ?>
</div>
<?php
wp_reset_postdata();
wp_reset_query();
echo $after_widget;
