<?php
global $post, $jaw_data;


$terms = get_the_category();


$ratingManager = ratingManager::getInstance();
$ratings = $ratingManager->getRatings($post->ID);
$rating = $ratingManager->getRatingsScore($ratings);
$rating = round($rating * 100);

$class = '';
if (is_sticky()) {
    $class = 'sticky';
}
?>

<article id="post-<?php the_ID(); ?>"  <?php post_class(array('element', $class, 'col-lg-4', 'content-small', 'format-image')); ?>   
         sort_name="<?php echo esc_attr(StrToLower(get_the_title())); ?>"  
         sort_date="<?php the_time("Y-m-d H:i:s"); ?>" 
         sort_rating="<?php echo esc_attr($rating); ?>" 
         sort_popular="<?php echo esc_attr(get_comments_number());     //if(jwOpt::get_option('fbcomments_switch','0')=='0'){echo get_comments_number(); }else{echo jwFacebook::get_fb_comments_count(get_the_ID()); }        ?>"
         sort_category="<?php echo esc_attr($terms[0]->slug); ?>">
    <div class="box ">




        <div class="image">
            <?php
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
            ?>
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

