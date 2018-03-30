<?php if(plsh_not_woocommerce_special_content()) : ?>
<p>
    <?php
    $cats = wp_get_post_categories(get_the_ID());

    if(!empty($cats))
    {
        foreach($cats as $cat )
        {
            $category = get_category($cat);
            $link = get_category_link($category);
            echo '<a href="' . esc_url( $link ) . '" title="' . esc_attr($category->name) . '" class="tag-default">' . $category->name . '</a>';
        }
    }
    ?>

    <span class="legend-default">
        <i class="fa fa-clock-o"></i><span class="updated" <?php if(plsh_is_review()) { echo 'itemprop="dtreviewed" datetime="' .  esc_attr(get_the_date('Y-m-d')) . '"'; } ?>><?php echo get_the_date(); ?></span>
        <?php
        
        if(is_single())
        {
            ?><i class="fa fa-user"></i><span <?php if(plsh_is_review()) { echo ' class="vcard" itemprop="reviewer"'; } ?>><a href="<?php echo get_the_author_meta('url'); ?>" class="author url fn"><?php echo get_the_author_meta('display_name'); ?></a></span><?php
        }
        
        if(comments_open())
        {
            ?> <a href="<?php comments_link(); ?>" class="comment-link"><i class="fa fa-comments"></i><?php comments_number('0', '1', '%'); ?></a> <?php
        }
        ?>
    </span>
</p>
<?php endif; ?>