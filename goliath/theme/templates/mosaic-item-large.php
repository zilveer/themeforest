<div class="item big touch-click" style="background-image: url(<?php echo esc_url(plsh_get_thumbnail('mosaic_large', true)); ?>);">
    <div class="overlay">
        <div class="title">
            <?php plsh_get_rating_stars(); ?>
            <h2>
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                <?php if(plsh_is_post_hot(get_the_ID())) : ?>
                    <span class="hotness"><?php _e('Hot', 'goliath'); ?></span>
                <?php endif; ?>
            </h2>
            <?php get_template_part('theme/templates/title-legend-mosaic'); ?>
            <div class="intro">
                <?php echo plsh_excerpt(40); ?>
                <a href="<?php the_permalink(); ?>" class="more-link"><?php _e('Read more', 'goliath'); ?></a>
            </div>
        </div>
    </div>
</div>