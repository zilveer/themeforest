<?php
    global $post;
    $thumb = plsh_get_thumbnail('blog_thumb_single_large', true, false);
    $mobile_thumb = plsh_get_thumbnail('blog_thumb_single_mobile', true, false);
    
    if(get_post_type() == 'post')
    {
        if($thumb)
        {
            if($thumb)
            {
            ?>
                <div class="post-1-full-width-image" style="background: url(<?php echo esc_url($thumb); ?>) center center no-repeat;">
                    <img src="<?php echo esc_url($mobile_thumb); ?>" class="mobile-post-thumb" alt="<?php esc_attr(the_title()); ?>"/>
                <?php
            }
            else
            {
                ?>
                <div class="post-1-full-width-image no-image">   
                <?php
            }
            ?>

                <div>
                    <?php plsh_get_rating_stars(); ?>

                    <?php if(plsh_gs('show_post_share') == 'on') : ?>
                        <div class="social"><?php get_template_part( 'theme/templates/share'); ?></div>
                    <?php endif; ?>
                </div>
            </div>
            <?php
        }
    }
    else
    {
        if($thumb)
        {
            ?>
                <div class="post-1-full-width-image<?php if(plsh_gs('show_extended_post_image') == 'on') { echo ' extended'; } ?>" style="background: url(<?php echo esc_url($thumb); ?>) center center no-repeat;">
                    <img src="<?php echo esc_url($mobile_thumb); ?>" class="mobile-post-thumb" alt="<?php esc_attr(the_title()); ?>"/>
                </div>
            <?php
        }
    }
?>