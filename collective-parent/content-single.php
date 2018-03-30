<?php
/**
 * The template for displaying content in the single.php template.
 * To override this template in a child theme, copy this file 
 * to your child theme's folder.
 *
 * @since Collective 1.0
 */
?>
<?php
$link = get_permalink();
$post_type = tfuse_page_options('post_type','image');
$meta_width = tfuse_meta_width($post_type);

if($post_type == 'gallery') tfuse_get_post_gallery();
else { ?>
    <div class="post_img"><?php tfuse_media(); ?></div>

    <?php if(tfuse_page_options('enable_post_meta',true)){ ?>
        <div class="meta_info clearfix" <?php echo 'style="width:'.$meta_width.'px"'; ?>>
            <?php if(tfuse_page_options('enable_published_date',true)){ ?>
                <span class="meta_date"><?php echo get_the_date(); ?></span>
            <?php } ?>
            <?php if(tfuse_page_options('enable_author_post',true)){ ?>
                <span class="meta_author"><?php the_author_posts_link(); ?></span>
            <?php } ?>
        </div>
    <?php }
} ?>

<div class="post_title"><h2><?php the_title(); ?></h2></div>
<div class="post_desc clearfix"><?php the_content(); ?></div>
<?php wp_link_pages(); ?>
<?php if(tfuse_page_options('enable_post_meta',true)){ $tag = get_the_tags();?>
	<?php if (!empty($tag)):?>
		<div class="tag_links"><?php _e('Tags: ','tfuse');?><?php the_tags( '', ', ', '' ); ?></div>
	<?php endif;?>
<?php } ?>