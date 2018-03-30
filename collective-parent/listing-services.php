<?php
/**
 * The template for displaying services on archive pages.
 * To override this template in a child theme, copy this file 
 * to your child theme's folder.
 *
 * @since Collective 1.0
 */ 
?>

<div class="service_item span4">
    <?php if(tfuse_page_options('thumbnail_image','') != ''){ ?>
        <div class="service_img">
            <img src="<?php echo tfuse_page_options('thumbnail_image',''); ?>" alt="">
        </div>
    <?php } ?>
    <div class="service_title">
        <h3><?php the_title(); ?></h3>
    </div>
    <div class="service_desc">
        <?php if ( tfuse_options('post_content') == 'content' ) the_content(''); else the_excerpt(); ?>
    </div>
    <div class="service_meta">
        <a href="<?php the_permalink(); ?>" class="button small black alignleft"><span><?php _e('More','tfuse'); ?></span></a>
    </div>
</div>