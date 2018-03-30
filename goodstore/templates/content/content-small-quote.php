<?php
global $post, $jaw_data;


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

<article id="post-<?php the_ID(); ?>"  <?php post_class(array('element', $class, 'col-lg-4', 'content-small', 'format-qote')); ?>   
         sort_name="<?php echo esc_attr(StrToLower(get_the_title())); ?>"  
         sort_date="<?php the_time("Y-m-d H:i:s"); ?>" 
         sort_rating="<?php echo esc_attr($rating); ?>" 
         sort_popular="<?php echo esc_attr(get_comments_number());     //if(jwOpt::get_option('fbcomments_switch','0')=='0'){echo get_comments_number(); }else{echo jwFacebook::get_fb_comments_count(get_the_ID()); }        ?>"
         sort_category="<?php echo esc_attr($terms[0]->slug); ?>">
    <div class="box ">

        <div class="content-box">
            <div class="blockquote-container">
                <span class="quote_i">
                    <i class="icon-quotes-left"></i>
                </span>
                <blockquote class="quote_icon">
                    <p>
                        <?php
                        echo jwUtils::crop_length(strip_tags(jwRender::get_the_excerpt()), jaw_template_get_var('letter_excerpt_title', 60));
                        ?>
                    </p>
                </blockquote>
                <?php if ((jaw_template_get_var('blog_metadate', '1') == '1') || (jaw_template_get_var('blog_meta_author', '1') == '1')) { ?>
                <div class="post-quote-meta-author">
                    <?php if (jaw_template_get_var('blog_meta_author', '1') == '1') { ?>
                    <span class="quote-author-name"><?php echo jwRender::get_meta_author(); ?></span>
                     <?php } ?>
                    <?php if (jaw_template_get_var('blog_metadate', '1') == '1') { ?>
                    <span class="quote-author-date"><?php echo jwRender::get_meta_date(); ?></span>
                    <?php } ?>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</article>

