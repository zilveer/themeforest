<?php
/**
 * The template for displaying posts on archive pages.
 * To override this template in a child theme, copy this file 
 * to your child theme's folder.
 *
 * @since Collective 1.0
 */
?>
<?php
    $link = get_permalink();
    $post_type = tfuse_page_options('post_type','image');
    if($post_type == 'video') $class = 'post_video';
    elseif($post_type == 'gallery') $class = 'post_gallery';
    else $class = '';
    $meta_width = tfuse_meta_width($post_type);
    global $more;
    $more = apply_filters('tfuse_more_tag',0);
?>
<div class="post_item clearfix <?php echo $class; ?>">
    <?php if($post_type == 'gallery') tfuse_get_post_gallery();
    else { ?>
        <div class="post_img">
            <a href="<?php echo $link; ?>"><?php tfuse_media(); ?><span class="more_ico"></span></a>
        </div>
        <?php if(tfuse_page_options('enable_post_meta',true)){ ?>
            <div class="meta_info clearfix" <?php echo 'style="width:'.$meta_width.'px"'; ?>>
                <?php if(tfuse_page_options('enable_published_date',true)){ ?>
                    <span class="meta_date"><?php echo get_the_date(); ?></span>
                <?php } ?>
                <?php if(tfuse_page_options('enable_author_post',true)){ ?>
                    <span class="meta_author"><?php the_author_posts_link(); ?></span>
                <?php } ?>
                <a class="link_more" href="<?php echo $link; ?>"></a>
            </div>
    <?php }
    } ?>
    <div class="post_title"><h2><a href="<?php echo $link; ?>"><?php the_title(); ?></a></h2></div>
    <div class="post_desc clearfix"><div id="post-<?php the_ID(); ?>" <?php post_class(); ?>><?php if ( tfuse_options('post_content') == 'content' ) the_content(''); else the_excerpt(); ?></div></div>
    <div class="post_meta_bott clearfix">
        <a href="<?php echo $link; ?>"><?php _e('Read more','tfuse'); ?></a>
        <a href="<?php comments_link(); ?>" class="post_comments"><?php comments_number("(0)".__('comments','tfuse'), "(1)".__('comment','tfuse'), "(%)".__('comments','tfuse') ); ?></a>
    </div>
</div>