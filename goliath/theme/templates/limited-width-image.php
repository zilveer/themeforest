<?php
    global $post;
    $type = get_post_image_width($post->ID);
    $post_style = get_post_meta(get_the_ID(), 'post_style', true );
    
    if($type == 'container_width' || ((plsh_gs('post_style') == 'no-sidebar' && $post_style == 'global') || $post_style == 'no-sidebar'))
    {
        $thumb = plsh_get_thumbnail('blog_thumb_single_medium', true, false);
        $type = 'container_width'; //force type
    }
    else
    {
        $thumb = plsh_get_thumbnail('blog_thumb_single_small', true, false);
    }
    
    $mobile_thumb = plsh_get_thumbnail('blog_thumb_single_mobile', true, false);
    
    
    if($thumb)
    {
        ?>
        <div class="image limited-width <?php echo esc_attr($type); ?>">
            <?php
            if($thumb)
            {
                ?>
                    <img src="<?php echo esc_url($thumb); ?>" class="full-post-thumb" alt="<?php esc_attr(the_title()); ?>"/>
                    <img src="<?php echo esc_url($mobile_thumb); ?>" class="mobile-post-thumb" alt="<?php esc_attr(the_title()); ?>"/>
                <?php
            }
            if(get_post_type() == 'post')
            {
                ?>
                <div>
                    <?php plsh_get_rating_stars(); ?>

                    <?php if(plsh_gs('show_post_share') == 'on') : ?>
                        <div class="social"><?php get_template_part( 'theme/templates/share'); ?></div>
                    <?php endif; ?>
                </div>
                <?php
            }
            ?>
        </div>
    <?php 
    }
?>