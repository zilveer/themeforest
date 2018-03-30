<div class="post-item">
    <?php
    $thumb = plsh_get_thumbnail('blog_thumb_list_small', true, false);
    if($thumb)
    {
        ?>
        <div class="image">
            <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($thumb); ?>" alt="<?php esc_attr(the_title()); ?>"/></a>
        </div>
        <?php
    }
    ?>
    <div class="title<?php if(!$thumb) { echo ' no-thumb';} ?>">
        <h2>
            <a href="<?php the_permalink(); ?>"><?php search_title_highlight(); ?></a>
            <?php if(plsh_is_post_hot(get_the_ID())) : ?>
                <span class="hotness"><?php _e('Hot', 'goliath'); ?></span>
            <?php endif; ?>
        </h2>
        <?php get_template_part('theme/templates/title-legend'); ?>
    </div>
    <div class="intro">
        <?php search_excerpt_highlight(); ?>
        <a href="<?php the_permalink(); ?>" class="more-link"><?php _e('Read more', 'goliath'); ?></a>
    </div>
</div>