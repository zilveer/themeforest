<?php

$items = plsh_get_featured_posts();

if($items['count'] > 0)
{
?>

<div class="post-block-3<?php if(plsh_gs('sidebar_position') === 'left') { echo ' right'; } ?>">

    <div class="title-default">
        <a href="<?php echo esc_url($items['url']); ?>" class="active"><?php echo esc_html($items['title']); ?></a>
        <?php if($items['url'] != '#') { ?>
            <a href="<?php echo esc_url($items['url']); ?>" class="view-all"><?php _e('View all', 'goliath'); ?></a>
        <?php } ?>
    </div>

    <div class="items">
        <?php
            global $post;
            $original_post = $post;
            foreach($items['posts'] as $post)
            {
                @setup_postdata($post);
                ?>
                <div class="post-item">
                    <?php
                    $thumb = plsh_get_thumbnail('blog_featured_small', true, false);
                    if($thumb)
                    {
                        ?>
                        <div class="image">
                            <?php plsh_get_rating_stars(); ?>
                            <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($thumb); ?>" alt="<?php esc_attr(the_title()); ?>"/></a>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="title">
                        <h2>
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            <?php if(plsh_is_post_hot(get_the_ID())) : ?>
                                <span class="hotness"><?php _e('Hot', 'goliath'); ?></span>
                            <?php endif; ?>
                        </h2>
                        <?php get_template_part('theme/templates/title-legend-mosaic'); ?>
                    </div>
                    <div class="intro">
                        <?php the_excerpt(); ?>
                    </div>
                </div>
                <?php
            }
            $post = $original_post;
        ?>
    </div>

</div>
<?php
}
?>