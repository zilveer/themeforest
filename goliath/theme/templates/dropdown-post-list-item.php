<div class="post-item" data-overlay="1" data-overlay-excerpt="<?php echo esc_attr(plsh_excerpt(50)); ?>" data-overlay-url="<?php the_permalink(); ?>">
    <div class="inner-wrapper">
    <?php
        $image = plsh_get_thumbnail('post-list-1-item', true, false);
        if($image)
        {
            ?>
                <div class="title-image-row">
                    <div class="image">
                        <?php plsh_get_rating_stars('block'); ?>
                        <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($image); ?>" alt="<?php esc_attr(the_title()); ?>" /></a>
                    </div>
                    <div class="title-excerpt-cell">
                        <div class="title">
                            <h2>
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                <?php if(plsh_is_post_hot(get_the_ID())) : ?>
                                    <span class="hotness"><?php _e('Hot', 'goliath'); ?></span>
                                <?php endif; ?>
                            </h2>
                            <?php get_template_part('theme/templates/title-legend-mosaic'); ?>
                        </div>
                        <div class="post-intro">
                            <?php echo plsh_excerpt(10); ?>
                        </div>
                    </div>
                </div>
            <?php
        }
        else
        {
            ?>
            <div class="title wide">
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <?php get_template_part('theme/templates/title-legend-mosaic'); ?>
            </div>
            <div class="post-intro">
                <?php echo plsh_excerpt(12); ?>
            </div>
            <?php
        }
    ?>
    </div>    
</div>