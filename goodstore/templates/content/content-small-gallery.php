<?php
global $post, $jaw_data;


$terms = get_the_category();


$ratingManager = ratingManager::getInstance();
$ratings = $ratingManager->getRatings($post->ID);
$rating = $ratingManager->getRatingsScore($ratings);
$rating = round($rating * 100);

$gallery = json_decode(get_post_meta($post->ID, '_post_gallery', true));

$class = '';
if (is_sticky()) {
    $class = 'sticky';
}
?>

<article id="post-<?php the_ID(); ?>"  <?php post_class(array('element', $class, 'col-lg-4', 'content-small', 'format-gallery')); ?>   
         sort_name="<?php echo esc_attr(StrToLower(get_the_title())); ?>"  
         sort_date="<?php the_time("Y-m-d H:i:s"); ?>" 
         sort_rating="<?php echo esc_attr($rating); ?>" 
         sort_popular="<?php echo esc_attr(get_comments_number());     //if(jwOpt::get_option('fbcomments_switch','0')=='0'){echo get_comments_number(); }else{echo jwFacebook::get_fb_comments_count(get_the_ID()); }       ?>"
         sort_category="<?php echo esc_attr($terms[0]->slug); ?>">
    <div class="box ">

        <div class="image">
            <?php
            if (jwUtils::has_post_thumbnail()) {
                switch (jwOpt::get_option('std_post_image_clickable', '0')) {
                    case '1': echo '<a href="' . esc_url(get_permalink()) . '"  title="' . esc_attr(jwUtils::crop_length(get_the_title(), jaw_template_get_var('letter_excerpt_title', 60))) . '">';
                        break;
                    case '2': echo '<a href="' . esc_url(jwUtils::get_thumbnail_link()) . '"  rel="prettyPhoto[posts-' . esc_attr(jaw_template_get_counter('pagination')) . '] title="' . esc_attr(jwUtils::crop_length(get_the_title(), jaw_template_get_var('letter_excerpt_title', 60))) . '">';
                        break;
                }


                jwUtils::the_post_thumbnail('post-size');


                if (jwOpt::get_option('std_post_image_clickable', '0') != '0') {
                    echo '</a>';
                }
            } else if (isset($gallery[0]) && !jaw_template_get_var('gallery', false)) {
                $first = 'active';
                ?>
                <div class="carousel horizontal slide">
                    <div class="carousel-inner">
                        <?php
                        foreach ((array) $gallery as $key => $image) {
                            if (isset($image->id)) {
                                $gallery_item = wp_get_attachment_metadata($image->id);
                                $url = wp_get_attachment_image_src($image->id, 'post-size');
                            }
                            if (isset($url[0])) {
                                $i['url'] = $url[0];

                                if (!isset($i['caption'])) {
                                    $i['caption'] = get_the_title();
                                } else if (isset($gallery_item['image_meta']['caption'])) {
                                    $i['caption'] = $gallery_item['image_meta']['caption'];
                                }
                                ?>
                                <div class="item <?php echo $first; ?>">
                                    <div class="carousel-caption row">
                                        <?php
                                        switch (jwOpt::get_option('std_post_image_clickable', '0')) {
                                            case '1': echo '<a href="' . esc_url(get_permalink()) . '"  title="' . esc_attr(jwUtils::crop_length(get_the_title(), jaw_template_get_var('letter_excerpt_title', 60))) . '">';
                                                break;
                                            case '2': echo '<a href="' . esc_url(jwUtils::get_thumbnail_link()) . '"  rel="prettyPhoto[posts-' . esc_attr(jaw_template_get_counter('pagination')) . '] title="' . esc_attr(jwUtils::crop_length(get_the_title(), jaw_template_get_var('letter_excerpt_title', 60))) . '">';
                                                break;
                                        }
                                        ?>
                                        <img src="<?php echo esc_url($i['url']); ?>" alt="<?php echo esc_attr($i['caption']); ?>" title="<?php echo esc_attr($i['caption']); ?>" width="125"  alt="<?php the_title(); ?>" />
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
                </div>
                <?php
            } else if (isset($gallery[0]) && jaw_template_get_var('gallery', false)) {
                $gallery_item = wp_get_attachment_metadata($gallery[0]->id);
                $url = wp_get_attachment_image_src($gallery[0]->id, 'post-size');
                if (isset($url[0])) {
                    $i['url'] = $url[0];

                    if (!isset($i['caption'])) {
                        $i['caption'] = get_the_title();
                    } else {
                        $i['caption'] = $gallery_item['image_meta']['caption'];
                    }

                    switch (jwOpt::get_option('std_post_image_clickable', '0')) {
                        case '1': echo '<a href="' . esc_url(get_permalink()) . '"  title="' . esc_attr(jwUtils::crop_length(get_the_title(), jaw_template_get_var('letter_excerpt_title', 60))) . '">';
                            break;
                        case '2': echo '<a href="' . esc_url(jwUtils::get_thumbnail_link()) . '"  rel="prettyPhoto[posts-' . esc_attr(jaw_template_get_counter('pagination')) . '] title="' . esc_attr(jwUtils::crop_length(get_the_title(), jaw_template_get_var('letter_excerpt_title', 60))) . '">';
                            break;
                    }
                    ?>
                    <img src="<?php echo esc_url($i['url']); ?>" alt="<?php echo esc_attr($i['caption']); ?>" title="<?php echo esc_attr($i['caption']); ?>" width="125"  alt="<?php the_title(); ?>" />
                    <?php
                    if (jwOpt::get_option('std_post_image_clickable', '0') != '0') {
                        echo '</a>';
                    }
                }
            }
            ?>
            <div class="clear"></div>
        </div>

        <div class="content-box">
            <header>
                <h2>
                    <a href="<?php the_permalink(); ?>" class="post_name">
                        <?php
                        echo jwUtils::crop_length(get_the_title(), jaw_template_get_var('letter_excerpt_title', 60));
                        ?>
                    </a>
                </h2>
            </header>

            <?php if ((jaw_template_get_var('blog_metadate', '1') == '1') || (jaw_template_get_var('blog_ratings', '1') == '1')) { ?>
                <div class="blog-meta-info">
                    <?php if (jaw_template_get_var('blog_metadate', '1') == '1') { ?>
                        <div class="date">
                            <span><?php echo jwRender::get_meta_date(); ?></span>
                        </div>
                    <?php } ?>
                    <?php if (jaw_template_get_var('blog_ratings', '1') == '1') { ?>
                        <div class="post-meta-rating rating">
                            <?php echo jwRender::metaRating(); ?>  <!-- RATING -->
                            <div class="clear"></div>
                        </div>
                    <?php } ?>
                    <div class="clear"></div>
                </div>
            <?php } ?>
        </div>

    </div>
</article>

