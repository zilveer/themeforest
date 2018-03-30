<?php
/**
 * The template for displaying portfolio on archive pages.
 * To override this template in a child theme, copy this file 
 * to your child theme's folder.
 *
 * @since Collective 1.0
 */

$permalink = get_permalink();
$subtitle = tfuse_page_options('post_subtitle','');
$columns = tfuse_get_portfolio_columns();
if($columns == '3') $class = 'span4';
else $class = 'span6';
$likes = get_post_meta($post->ID,'tfuse_love_it', 1); if($likes=='')$likes = 0;
$views = get_post_meta($post->ID, TF_THEME_PREFIX . '_post_viewed', 1); if($views=='')$views = 0;
?>

<div class="portfolio_item_small <?php echo $class; ?>">
    <div class="portfolio_img"><?php tfuse_media(); ?></div>
    <div class="portfolio_meta">
        <a href="<?php echo $permalink; ?>" class="portfolio_title"><?php the_title(); ?></a>
        <?php if($subtitle!='') echo '<span>'.$subtitle.'</span>'; ?>
    </div>
    <?php if(tfuse_page_options('enable_post_meta',true)){ ?>
        <div class="portfolio_meta_bott clearfix">
            <?php if(tfuse_page_options('likes',true)){ ?>
                <span class="meta_like"><?php echo $likes; ?></span>
            <?php } ?>
            <?php if(tfuse_page_options('views',true)){ ?>
                <span class="meta_views"><?php echo $views; ?></span>
            <?php } ?>
        </div>
    <?php } ?>
</div>