<?php 
if(plsh_gs('blog_item_style') === 'compact')
{
    ?>
        <div <?php post_class('post-item'); ?>>
            <?php
            $thumb = plsh_get_thumbnail('blog_thumb_list_small', true, false);
            if($thumb)
            {
                ?>
                <div class="image">
					<?php plsh_get_rating_stars('block'); ?>
                    <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($thumb); ?>" alt="<?php esc_attr(the_title()); ?>"/></a>
                </div>
                <?php
            }
            ?>
            <div class="title<?php if(!$thumb) { echo ' no-thumb';} ?>">
                <h2>
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    <?php if(plsh_is_post_hot(get_the_ID())) : ?>
                        <span class="hotness"><?php _e('Hot', 'goliath'); ?></span>
                    <?php endif; ?>
                </h2>
                <?php get_template_part('theme/templates/title-legend'); ?>
            </div>
            <div class="intro">
                <?php
                    if(has_excerpt())
                    {
                        the_excerpt();
                    }
                    elseif(plsh_gs('force_post_excerpt') == 'on')
                    {
                        echo plsh_excerpt(50);
                    }
                    else 
                    {
                        the_content('');
                    }
                ?>
                <a href="<?php the_permalink(); ?>" class="more-link"><?php _e('Read more', 'goliath'); ?></a>
            </div>
        </div>
    <?php
}
else
{
    ?>
        <div <?php post_class('post-item'); ?>>
            <div class="image">
                <?php
                $thumb = plsh_get_thumbnail('blog_thumb_list_large', true, false);
                if($thumb)
                {
                    plsh_get_rating_stars();
                    ?><a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($thumb); ?>" alt="<?php esc_attr(the_title()); ?>"/></a><?php
                }
                ?>
            </div>
            <div class="title">
                <h2>
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    <?php if(plsh_is_post_hot(get_the_ID())) : ?>
                        <span class="hotness"><?php _e('Hot', 'goliath'); ?></span>
                    <?php endif; ?>
                </h2>
                <?php get_template_part('theme/templates/title-legend'); ?>
            </div>
            <div class="intro">
                <?php
                    if(has_excerpt())
                    {
                        the_excerpt();
                    }
                    elseif(plsh_gs('force_post_excerpt') == 'on')
                    {
                        echo plsh_excerpt(50);
                    }
                    else 
                    {
                        the_content('');
                    }
                ?>
                <a href="<?php the_permalink(); ?>" class="more-link"><?php _e('Read more', 'goliath'); ?></a>
            </div>
        </div>
    <?php
}

