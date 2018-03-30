<?php
    global $post;
    if($post->_is_large)
    {
        $image = plsh_get_thumbnail('dropdown-featured-post-item-large', true, false);
        $class = "big";
    }
    else
    {
        $image = plsh_get_thumbnail('dropdown-featured-post-item-small', true, false);
        $class = "small";
    }
?>    
<div class="item <?php echo esc_attr($class); ?>" <?php if($image) { echo 'style="background-image: url(' . esc_url($image) . ');"'; } ?> >
    <div class="overlay">
        <div class="title">
            <?php plsh_get_rating_stars('block'); ?>
            <h2>
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                <?php if(plsh_is_post_hot(get_the_ID())) : ?>
                    <span class="hotness"><?php _e('Hot', 'goliath'); ?></span>
                <?php endif; ?>
            </h2>
            <?php get_template_part('theme/templates/title-legend-mosaic'); ?>
            <div class="intro">
                <?php echo plsh_excerpt(15); ?>
                <a href="<?php the_permalink(); ?>" class="more-link"><?php _e('Read more', 'goliath'); ?></a>
            </div>
        </div>
    </div>
</div>