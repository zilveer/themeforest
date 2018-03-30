<?php
global $post, $wp_query, $jaw_data, $content_width;
$terms = get_the_category();

$class = '';
if (is_sticky()) {
    $class = 'sticky';
}
$ratingManager = ratingManager::getInstance();
$ratings = $ratingManager->getRatings($post->ID);
$rating = $ratingManager->getRatingsScore($ratings);
$rating = round($rating * 100);
?>
<article id="post-<?php the_ID(); ?>"  <?php post_class(array('element', 'col-lg-'.jaw_template_get_var('box_size','max'), $class, 'content-classical', 'format-quote')); ?>   
         sort_name="<?php echo esc_attr(StrToLower(get_the_title())); ?>"  
         sort_date="<?php echo esc_attr(get_the_time("Y-m-d H:i:s")); ?>" 
         sort_rating="<?php echo esc_attr($rating) ?>" 
         sort_popular="<?php echo esc_attr(get_comments_number());     //if(jwOpt::get_option('fbcomments_switch','0')=='0'){echo get_comments_number(); }else{echo jwFacebook::get_fb_comments_count(get_the_ID()); }       ?>"
         sort_category="<?php echo esc_attr((!empty($terms) && isset($terms[0]->slug)) ? $terms[0]->slug : ''); ?>">
    <div class="box ">
        <div class="content-box">
            <span class="blockquote-container">
                <span class="quote_i"><i class="icon-quotes-left"></i></span>
                <blockquote class="quote_icon"> 
                    <?php
                    echo jwUtils::crop_length(jwRender::get_the_excerpt(), jaw_template_get_var('letter_excerpt', 275));
                    ?>
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
            </span>
        </div>
    </div>
</article>

