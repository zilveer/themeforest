<?php
global $post, $wp_query, $jaw_data, $content_width;


$terms = get_the_category();

$ratingManager = ratingManager::getInstance();
$ratings = $ratingManager->getRatings($post->ID);
$rating = $ratingManager->getRatingsScore($ratings);
$rating = round($rating * 100);

$class = '';
if(is_sticky()){
    $class = 'sticky';
}
?>



<article id="post-<?php the_ID(); ?>"  <?php post_class(array('element', 'col-lg-'.jaw_template_get_var('box_size','max'), $class, 'content-big', 'format-video')); ?>   
         sort_name="<?php echo esc_attr(StrToLower(get_the_title())); ?>"  
         sort_date="<?php the_time("Y-m-d H:i:s"); ?>" 
         sort_rating="<?php echo esc_attr($rating); ?>" 
         sort_popular="<?php echo esc_attr(get_comments_number());     //if(jwOpt::get_option('fbcomments_switch','0')=='0'){echo get_comments_number(); }else{echo jwFacebook::get_fb_comments_count(get_the_ID()); }     ?>"
         sort_category="<?php echo esc_attr($terms[0]->slug); ?>">
    <div class="box ">

        <div class="image">
            <?php
            $video_url = get_post_meta(get_the_ID(), '_post_video_link', true);
            $link = $video_url;
            $video = jwUtils::get_video_info($video_url);
            if ($video->domain == 'vine') {
                $link = $video->thumbnails['thumbnail_medium'];
            }
            if (jwUtils::has_post_thumbnail()) {
                switch (jwOpt::get_option('std_post_image_clickable', '0')) {
                    case '1': echo '<a href="' . esc_url(get_permalink()) . '"  title="' . esc_attr(jwUtils::crop_length(get_the_title(), jaw_template_get_var('letter_excerpt_title', 60))) . '" class="post-type-video-icon">';
                        break;
                    case '2': echo '<a href="' . esc_url($link) . '"  rel="prettyPhoto[posts-' . esc_attr(jaw_template_get_counter('pagination')) . '] title="' . esc_attr(jwUtils::crop_length(get_the_title(), jaw_template_get_var('letter_excerpt_title', 60))) . '" class="post-type-video-icon">';
                        break;
                }

                $img = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'post-size-big');
                $img_small = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'post-size');
                echo '<img class="lazy" data-original="' . esc_url($img[0]) . '" src="' . esc_url($img_small[0]) . '" width="' . esc_attr($img[1]) . '" height="' . esc_attr($img[2]) . '" alt="' . esc_attr(get_the_title()) . '">';


                if (jwOpt::get_option('std_post_image_clickable', '0') != '0') {
                    echo '</a>';
                }
            } else {
                echo jwRender::get_video_player($video_url, jwUtils::get_size(jwLayout::parseColWidth()));
            }
            ?>

        </div>

        <div class="content-box">
            <header>
                <h2>
                    <a href="<?php the_permalink(); ?>" class="post_name"><?php echo jwUtils::crop_length(get_the_title(), jaw_template_get_var('letter_excerpt_title', 60)); ?></a>
                </h2>
                
                <?php if ((jaw_template_get_var('blog_meta_author', '1') == '1') ||
                        (jaw_template_get_var('blog_comments_count', '1') == '1') ||
                        (jaw_template_get_var('blog_metadate', '1') == '1')) { ?>
                <ul class="blog-meta-info-top">                                        
                    <?php if (jaw_template_get_var('blog_meta_author', '1') == '1' || (jaw_template_get_var('blog_metadate', '1') == '1')) { ?>
                        <li class="post-meta-author-date">
                            <?php if (jaw_template_get_var('blog_meta_author', '1') == '1') { ?>                        
                            <?php 
                                $author = _e('Posted by: ','jawtemplates') . ' ' . jwRender::get_meta_author();
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
                        <span><?php _e('Posted in ','jawtemplates'); ?></span>
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

