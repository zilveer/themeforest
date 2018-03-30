<?php
$args = jaw_template_get_var('args');
$instance = jaw_template_get_var('instance');
$feedData = jaw_template_get_var('feedData');
$html_class = "";

$tab = array(
    'popular' => jaw_template_inc_counter('tab-posts'),
    'recent_posts' => jaw_template_inc_counter('tab-posts'),
    'recent_comments' => jaw_template_inc_counter('tab-posts'),
    'tags' => jaw_template_inc_counter('tab-posts'),
    'rating' => jaw_template_inc_counter('tab-posts')
);



extract($args);
echo $before_widget;
?>
<div class="jaw-tabs colored">
    <ul class="nav nav-tabs" >
        <?php
        $active = 1;
        ?>
        <?php if (!is_null($feedData->popular_posts)) { ?>
            <?php if ($active) { ?>
                <li class="active"><a data-toggle="tab" href="#tab_popular_posts_<?php echo $tab['popular']; ?>"><?php echo $instance["popular_title"]; ?></a></li>
                <?php $active = 0; ?>
            <?php } else { ?>
                <li><a data-toggle="tab" href="#tab_popular_posts_<?php echo $tab['popular']; ?>"><?php echo $instance["popular_title"]; ?></a></li>
            <?php } ?>
            <?php
        }
        if (!is_null($feedData->recent_posts)) {
            ?>
            <?php if ($active) { ?>
                <li class="active"><a data-toggle="tab" href="#tab_recent_posts_<?php echo $tab['recent_posts']; ?>"><?php echo $instance["recent_title"]; ?></a></li>
                <?php $active = 0; ?>
            <?php } else { ?>
                <li><a data-toggle="tab" href="#tab_recent_posts_<?php echo $tab['recent_posts']; ?>"><?php echo $instance["recent_title"]; ?></a></li>
            <?php } ?>                    
            <?php
        }
        if (!is_null($feedData->recent_comments)) {
            ?>
            <?php if ($active) { ?>
                <li class="active"><a data-toggle="tab" href="#tab_recent_comments_<?php echo $tab['recent_comments']; ?>"><?php echo $instance["comments_title"]; ?></a></li>
                <?php $active = 0; ?>
            <?php } else { ?>
                <li><a data-toggle="tab" href="#tab_recent_comments_<?php echo $tab['recent_comments']; ?>"><?php echo $instance["comments_title"]; ?></a></li>
            <?php } ?>   
            <?php
        }
        if (!is_null($feedData->tags)) {
            ?>
            <?php if ($active) { ?>
                <li class="active"><a data-toggle="tab" href="#tab_tags_<?php echo $tab['tags']; ?>"><?php echo $instance["tags_title"]; ?></a></li>
                <?php $active = 0; ?>
            <?php } else { ?>
                <li><a data-toggle="tab" href="#tab_tags_<?php echo $tab['tags']; ?>"><?php echo $instance["tags_title"]; ?></a></li>
            <?php } ?>     
            <?php
        }
        if (!is_null($feedData->ratings)) {
            ?>
            <?php if ($active) { ?>
                <li class="active"><a data-toggle="tab" href="#tab_ratings_<?php echo $tab['rating']; ?>"><?php echo $instance["ratings_title"]; ?></a></li>
                <?php $active = 0; ?>
            <?php } else { ?>
                <li><a data-toggle="tab" href="#tab_ratings_<?php echo $tab['rating']; ?>"><?php echo $instance["ratings_title"]; ?></a></li>
            <?php } ?>     
        <?php } ?>
    </ul>
    <div class="tab-content" >
        <?php
        $active = 1;
        ?>
        <?php if (!is_null($feedData->popular_posts)) { ?>
            <?php if ($active) { ?>
                <div class="tab-pane fade active in" id="tab_popular_posts_<?php echo $tab['popular']; ?>">
                    <?php $active = 0; ?>
                <?php } else { ?>
                    <div class="tab-pane fade" id="tab_popular_posts_<?php echo $tab['popular']; ?>">    
                    <?php } ?>
                    <?php
                    foreach ($feedData->popular_posts as $post) {
                        if (get_post_meta($post->ID, 'fw_rating_overal', true) == '1') {
                            $ratingManager = ratingManager::getInstance();
                            $ratings = $ratingManager->getRatings($post->ID);
                            $totalrat = $ratingManager->getRatingsScore($ratings);
                            $total = round($totalrat * 100);
                        }

                        setup_postdata($post);
                        ?>
                        <div class="tab-post-row">
                            <div class="tab-post-widget-img" >
                                <a href="<?php the_permalink(); ?>"><?php
                                    $class = '';
                                    if (has_post_thumbnail()) {
                                        jwUtils::the_post_thumbnail(array(75, 75));
                                        $html_class = 'has_image';
                                    } else if (get_post_format() == 'gallery') {
                                        ?>
                                        <div class="carousel horizontal slide">
                                            <div class="carousel-inner">
                                                <?php
                                                $first = 'active';
                                                $gallery = json_decode(get_post_meta($post->ID, '_post_gallery', true));
                                                foreach ((array) $gallery as $key => $image) {
                                                    if (isset($image->id)) {
                                                        $gallery_item = wp_get_attachment_metadata($image->id);
                                                        $url = wp_get_attachment_image_src($image->id, 'post-size');
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
                                                                <img src="<?php echo $i['url']; ?>" alt="<?php echo $i['caption']; ?>" title="<?php echo $i['caption']; ?>" width="125" />
                                                            </div>
                                                        </div>
                                                        <?php
                                                        $first = '';
                                                    }
                                                    $html_class = 'has_image';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <?php
                                    } else if (get_post_format() == 'video') {
                                        $video = jwUtils::get_video_info(get_post_meta(get_the_ID(), '_post_video_link', true));
                                        if (isset($video->thumbnails['thumbnail_medium'])) {
                                            echo '<img src="' . $video->thumbnails['thumbnail_medium'] . '"  width = "125" height="79"  alt="' . get_the_title() . '"/ >';
                                            $html_class = 'has_image';
                                        }
                                    }
                                    ?></a>
                            </div>
                            <div class="tab-post-widget-content <?php echo $html_class; ?>">
                                <h3><a href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a></h3>

                                <?php if (get_post_meta($post->ID, 'fw_rating_overal', true) == '1') { ?>
                                    <div class="rating">
                                        <?php echo jwRender::metaRating(); ?>  <!-- RATING -->
                                        <div class="clear"></div>
                                    </div>
                                <?php } else { ?>   

                                    <div class="date">
                                        <span>
                                            <?php echo get_the_time(jwOpt::get_option('element_blog_dateformat', 'M j, Y')); ?>
                                        </span>
                                    </div>
                                <?php } ?>
                            </div>

                            <div class="clear"></div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            <?php } ?>

            <?php if (!is_null($feedData->recent_posts)) { ?>
                <?php if ($active) { ?>
                    <div class="tab-pane fade active in" id="tab_recent_posts_<?php echo $tab['recent_posts']; ?>">
                        <?php $active = 0; ?>
                    <?php } else { ?>
                        <div class="tab-pane fade" id="tab_recent_posts_<?php echo $tab['recent_posts']; ?>">    
                        <?php } ?>
                        <?php
                        foreach ($feedData->recent_posts as $post) {
                            setup_postdata($post);
                            ?>
                            <div class="tab-post-row">

                                <div class="tab-post-widget-img" >
                                    <a href="<?php the_permalink(); ?>"><?php
                                        $class = '';
                                        if (has_post_thumbnail()) {
                                            jwUtils::the_post_thumbnail(array(75, 75));
                                            $html_class = 'has_image';
                                        } else if (get_post_format() == 'gallery') {
                                            ?>
                                            <div class="carousel horizontal slide">
                                                <div class="carousel-inner">
                                                    <?php
                                                    $first = 'active';
                                                    $gallery = json_decode(get_post_meta($post->ID, '_post_gallery', true));
                                                    foreach ((array) $gallery as $key => $image) {
                                                        if (isset($image->id)) {
                                                            $gallery_item = wp_get_attachment_metadata($image->id);
                                                            $url = wp_get_attachment_image_src($image->id, 'post-size');
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
                                                                    <img src="<?php echo $i['url']; ?>" alt="<?php echo $i['caption']; ?>" title="<?php echo $i['caption']; ?>" width="125" />
                                                                </div>
                                                            </div>
                                                            <?php
                                                            $first = '';
                                                        }
                                                        $html_class = 'has_image';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <?php
                                        } else if (get_post_format() == 'video') {
                                            $video = jwUtils::get_video_info(get_post_meta(get_the_ID(), '_post_video_link', true));
                                            if (isset($video->thumbnails['thumbnail_medium'])) {
                                                echo '<img src="' . $video->thumbnails['thumbnail_medium'] . '"  width = "125" height="79"  alt="' . get_the_title() . '"/ >';
                                                $html_class = 'has_image';
                                            }
                                        }
                                        ?></a>
                                </div>
                                <div class="tab-post-widget-content <?php echo $html_class; ?>">
                                    <h3>
                                        <a href="<?php the_permalink(); ?>">
                                            <?php if (strlen(get_the_title()) > 50) { ?>
                                                <?php echo mb_substr(get_the_title(), 0, 50, 'UTF-8') . ' ...'; ?>
                                            <?php } else { ?>
                                                <?php echo get_the_title(); ?>
                                            <?php }
                                            ?>
                                        </a>
                                    </h3>
                                    <div class="date">
                                        <span>
                                            <?php echo get_the_time(jwOpt::get_option('element_blog_dateformat', 'M j, Y')); ?>
                                        </span>
                                    </div>
                                </div>

                                <div class="clear"></div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                <?php } ?>

                <?php if (!is_null($feedData->recent_comments)) { ?>
                    <?php if ($active) { ?>
                        <div class="tab-pane fade active in" id="tab_recent_comments_<?php echo $tab['recent_comments']; ?>">
                            <?php $active = 0; ?>
                        <?php } else { ?>
                            <div class="tab-pane fade" id="tab_recent_comments_<?php echo $tab['recent_comments']; ?>">    
                            <?php } ?>
                            <?php foreach ($feedData->recent_comments as $comment) { ?>
                                <div class="tab-post-row">
                                    <div class="tab-post-widget-img">
                                        <a href="<?php echo get_comment_link($comment, $args) ?>"><?php echo get_avatar($comment->comment_author_email, 50); ?></a>
                                    </div>
                                    <div class="tab-post-widget-content">
                                        <h3>
                                            <a href="<?php echo get_comment_link($comment, $args) ?>">
                                                <?php if (strlen($comment->comment_content) > 50) { ?>
                                                    <?php echo mb_substr($comment->comment_content, 0, 50, 'UTF-8') . ' ...'; ?>
                                                <?php } else { ?>
                                                    <?php echo $comment->comment_content; ?>
                                                <?php }
                                                ?>
                                            </a>
                                        </h3>
                                        <span><?php comment_date(jwOpt::get_option('element_blog_dateformat', null), $comment->comment_ID); ?> </span>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>

                    <?php if (!is_null($feedData->tags)) { ?>
                        <?php if ($active) { ?>
                            <div class="tab-pane fade active in" id="tab_tags_<?php echo $tab['tags']; ?>">
                                <?php $active = 0; ?>
                            <?php } else { ?>
                                <div class="tab-pane fade" id="tab_tags_<?php echo $tab['tags']; ?>">    
                                <?php } ?>
                                <div class="tagcloud">    
                                    <?php foreach ($feedData->tags as $term) { ?>
                                        <a href="<?php echo get_tag_link($term->term_id); ?>"><?php echo $term->name ?></a>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>  


                        <?php if (!is_null($feedData->ratings)) {
                            ?>  

                            <?php if ($active) { ?>
                                <div class="tab-pane fade active in" id="tab_ratings_<?php echo $tab['rating']; ?>">
                                    <?php $active = 0; ?>
                                <?php } else { ?>
                                    <div class="tab-pane fade" id="tab_ratings_<?php echo $tab['rating']; ?>">   
                                    <?php } ?>
                                    <?php
                                    foreach ($feedData->ratings as $post) {
                                        $ratingManager = ratingManager::getInstance();
                                        $ratings = $ratingManager->getRatings($post->ID);
                                        $totalrat = $ratingManager->getRatingsScore($ratings);
                                        $total = round($totalrat * 100);
                                        ?>
                                        <div class="tab-post-row">

                                            <div class="tab-post-widget-img" >
                                                <a href="<?php the_permalink(); ?>"><?php
                                                    $class = '';
                                                    if (has_post_thumbnail()) {
                                                        jwUtils::the_post_thumbnail(array(75, 75));
                                                        $html_class = 'has_image';
                                                    } else if (get_post_format() == 'gallery') {
                                                        ?>
                                                        <div class="carousel horizontal slide">
                                                            <div class="carousel-inner">
                                                                <?php
                                                                $first = 'active';
                                                                $gallery = json_decode(get_post_meta($post->ID, '_post_gallery', true));
                                                                foreach ((array) $gallery as $key => $image) {
                                                                    if (isset($image->id)) {
                                                                        $gallery_item = wp_get_attachment_metadata($image->id);
                                                                        $url = wp_get_attachment_image_src($image->id, 'post-size');
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
                                                                                <img src="<?php echo $i['url']; ?>" alt="<?php echo $i['caption']; ?>" title="<?php echo $i['caption']; ?>" width="125" />
                                                                            </div>
                                                                        </div>
                                                                        <?php
                                                                        $first = '';
                                                                    }
                                                                    $html_class = 'has_image';
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <?php
                                                    } else if (get_post_format() == 'video') {
                                                        $video = jwUtils::get_video_info(get_post_meta(get_the_ID(), '_post_video_link', true));
                                                        if (isset($video->thumbnails['thumbnail_medium'])) {
                                                            echo '<img src="' . $video->thumbnails['thumbnail_medium'] . '"  width = "125" height="79"  alt="' . get_the_title() . '"/ >';
                                                            $html_class = 'has_image';
                                                        }
                                                    }
                                                    ?></a>
                                            </div>
                                            <div class="tab-post-widget-content <?php echo $html_class; ?>">
                                                <h3><a href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a></h3>

                                                <div class="rating">
                                                    <?php echo jwRender::metaRating(); ?>  <!-- RATING -->
                                                    <div class="clear"></div>
                                                </div>


                                            </div>

                                            <div class="clear"></div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                    wp_reset_postdata();
                    wp_reset_query();
                    echo $after_widget;
                    