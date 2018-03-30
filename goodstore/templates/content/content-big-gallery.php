<?php
global $post, $wp_query, $jaw_data, $content_width;

$terms = get_the_category();

$ratingManager = ratingManager::getInstance();
$ratings = $ratingManager->getRatings($post->ID);
$rating = $ratingManager->getRatingsScore($ratings);
$rating = round($rating * 100);

$random = rand(0, 1000);

$gallery = json_decode(get_post_meta($post->ID, '_post_gallery', true));
$class = '';
if (is_sticky()) {
    $class = 'sticky';
}
?>

<article id="post-<?php the_ID(); ?>"  <?php post_class(array('element', 'col-lg-' . jaw_template_get_var('box_size', 'max'), 'content-big', 'format-image', $class)); ?>   
         sort_name="<?php echo esc_attr(StrToLower(get_the_title())); ?>"  
         sort_date="<?php the_time("Y-m-d H:i:s"); ?>" 
         sort_rating="<?php echo esc_attr($rating); ?>" 
         sort_popular="<?php echo esc_attr(get_comments_number());     //if(jwOpt::get_option('fbcomments_switch','0')=='0'){echo get_comments_number(); }else{echo jwFacebook::get_fb_comments_count(get_the_ID()); }        ?>"
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

                $img = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'post-size-big');
                $img_small = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'post-size');
                echo '<img class="lazy" data-original="' . esc_attr($img[0]) . '" src="' . esc_url($img_small[0]) . '" width="' . esc_attr($img[1]) . '" height="' . esc_attr($img[2]) . '" alt="' . esc_attr(get_the_title()) . '">';

                if (jwOpt::get_option('std_post_image_clickable', '0') != '0') {
                    echo '</a>';
                }
            } else if (isset($gallery[0])) {
                $first = 'active';
                ?>
                <div id="jaw-carousel-<?php echo esc_attr($random); ?>" class="carousel horizontal slide navigation-side">
                    <div class="carousel-inner">
                        <?php
                        foreach ((array) $gallery as $key => $image) {
                            if (isset($image->id)) {
                                $gallery_item = wp_get_attachment_metadata($image->id);
                                $url = wp_get_attachment_image_src($image->id, 'post-size-big');
                                $url_small = wp_get_attachment_image_src($image->id, 'post-size');
                            }
                            if (isset($url[0])) {
                                $i['url'] = $url[0];
                                $i['url-small'] = $url_small[0];
                                $i['width'] = $url[1];
                                $i['height'] = $url[2];
                                if (!isset($i['caption'])) {
                                    $i['caption'] = get_the_title();
                                } else if (isset($gallery_item['image_meta']['caption'])) {
                                    $i['caption'] = $gallery_item['image_meta']['caption'];
                                }
                                ?>
                                <div class="item <?php echo esc_attr($first); ?>">
                                    <div class="carousel-caption row">
                                        <?php
                                        switch (jwOpt::get_option('std_post_image_clickable', '0')) {
                                            case '1': echo '<a href="' . esc_url(get_permalink()) . '"  title="' . esc_attr(jwUtils::crop_length(get_the_title(), jaw_template_get_var('letter_excerpt_title', 60))) . '">';
                                                break;
                                            case '2': echo '<a href="' . esc_url($image->url) . '"  rel="prettyPhoto[posts-' . esc_attr(jaw_template_get_counter('pagination')) . ']" title="' . esc_attr($i['caption']) . '">';
                                                break;
                                        }
                                        ?>

                                        <img class="lazy" data-original="<?php echo esc_url($i['url']); ?>" src="<?php echo esc_url($i['url-small']); ?>" alt="<?php echo esc_attr($i['caption']); ?>" title="<?php echo esc_attr($i['caption']); ?>" width="<?php echo esc_attr($i['width']); ?>" height="<?php echo esc_attr($i['height']); ?>"/>
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
                    <a class="left carousel-control" href="#jaw-carousel-<?php echo esc_attr($random); ?>" data-slide="prev">
                        <span class="icon-prev"></span>
                    </a>
                    <a class="right carousel-control" href="#jaw-carousel-<?php echo esc_attr($random); ?>" data-slide="next">
                        <span class="icon-next"></span>
                    </a>
                </div>
                <?php
            }
            ?>
        </div>

        <div class="content-box">
            <header>
                <h2>
                    <a href="<?php the_permalink(); ?>" class="post_name"><?php echo jwUtils::crop_length(get_the_title(), jaw_template_get_var('letter_excerpt_title', 60)); ?></a>
                </h2>

                <?php
                if ((jaw_template_get_var('blog_meta_author', '1') == '1') ||
                        (jaw_template_get_var('blog_comments_count', '1') == '1') ||
                        (jaw_template_get_var('blog_metadate', '1') == '1')) {
                    ?>
                    <ul class="blog-meta-info-top">                                        
                            <?php if (jaw_template_get_var('blog_meta_author', '1') == '1' || (jaw_template_get_var('blog_metadate', '1') == '1')) { ?>
                            <li class="post-meta-author-date">
                                <?php if (jaw_template_get_var('blog_meta_author', '1') == '1') { ?>                        
                                    <?php
                                    $author = _e('Posted by: ', 'jawtemplates') . ' ' . jwRender::get_meta_author();
                                    ?>
                                <?php } ?>
                                <?php if (jaw_template_get_var('blog_metadate', '1') == '1') { ?>
                                    <?php
                                    $date = jwRender::get_meta_date();
                                    ?>
                                <?php } ?>
                                <?php
                                $a[] = $author;
                                $a[] = $date;
                                echo implode(', ', $a);
                                ?>
                            </li>
                        <?php } ?>

                            <?php if (jaw_template_get_var('blog_comments_count', '1') == '1') { ?>
                            <li class="post-meta-comments">
                            <?php echo jwRender::get_meta_comments(); ?>
                            </li>
                    <?php } ?>

                    </ul>
<?php } ?>                
            </header> 

            <p> 
                <?php
                echo jwUtils::crop_length(jwRender::get_the_excerpt(), jaw_template_get_var('letter_excerpt', 300));
                ?>
            </p>

                <?php if ((jaw_template_get_var('blog_meta_category', '1') == '1') || (jaw_template_get_var('blog_ratings', '1') == '1')) { ?>
                <div class="blog-meta-info">
                        <?php if (jaw_template_get_var('blog_meta_category', '1') == '1') { ?>
                        <div class="post-meta-catagory">
                            <span><?php _e('Posted in ', 'jawtemplates'); ?></span>
                        <?php echo jwRender::get_meta_category(); ?>
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

