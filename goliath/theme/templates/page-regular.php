<?php
//setup post in case its not there
if(!in_the_loop())
{
    if ( have_posts() ) 
    {
        the_post();
    }
}
?>
<?php
    global $post;
    
    $thumb = plsh_get_thumbnail('blog_thumb_single_small', true, false);
    $class = 'post-1 hentry ';
    $post_image_width = get_post_image_width($post->ID);
    
    if(plsh_is_review() && !$thumb)
    {
        $class .= ' no-image';
    }
    elseif(!$thumb || $post_image_width == 'no_image')
    {
        $class .= ' no-image-share-review';
    }
?>
<?php
    if($post_image_width == 'full_screen')
    {
        get_template_part( 'theme/templates/full-width-image');
    }
?>

<!-- Homepage content -->
<div class="container homepage-content hfeed thumb-<?php echo esc_attr($post_image_width); ?>">
    
    <?php
    if($post_image_width == 'container_width')
    {
        get_template_part( 'theme/templates/limited-width-image');
    }
    ?>

    <?php
        if(plsh_gs('sidebar_position') === 'left')
        {
            get_sidebar();
        }
    ?>
    
    <div class="main-content-column-1 <?php if(plsh_gs('sidebar_position') === 'left') { echo ' right'; } ?>">

        <!-- Post -->
        <div <?php post_class($class); ?> itemscope itemtype="http://data-vocabulary.org/<?php if(plsh_is_review()) { echo 'Review'; } else { echo 'NewsArticle'; } ?>">
            
            <?php
            if($post_image_width == 'text_width')
            {
                get_template_part( 'theme/templates/limited-width-image');
            }
			
			if($post_image_width == 'video' || $post_image_width == 'video_autoplay')
			{
				get_template_part( 'theme/templates/video-image');
			}
            ?>
                                    
            <div class="title">
                <h1 id="intro"><a href="<?php the_permalink(); ?>" class="entry-title" <?php if(plsh_is_review()) { echo ' itemprop="itemreviewed"'; } else { echo ' itemprop="headline"'; } ?>><?php the_title(); ?></a></h1>
                
                <?php if(!is_page()) : ?>
                <?php get_template_part( 'theme/templates/title-legend'); ?>
                <?php endif; ?>
                
                <?php get_template_part( 'theme/templates/post-tags'); ?>
            </div>
            
            <span class="item-summary-hidden" itemprop="<?php if(plsh_is_review()) { echo 'summary'; } else { echo 'description'; } ?>"><?php echo plsh_excerpt(25); ?></span>
            <?php if($thumb) { ?> <img class="item-image-hidden" itemprop="<?php if(plsh_is_review()) { echo 'photo'; } else { echo 'image'; } ?>" src="<?php echo esc_url($thumb); ?>" alt="<?php esc_attr(the_title()); ?>" /> <?php } ?>
                
            <div class="post" <?php if(plsh_is_review()) { echo ' itemprop="description"'; } else { echo ' itemprop="articleBody"'; } ?>><?php the_content(); ?></div>

            <?php get_template_part( 'theme/templates/link-pages'); ?>

        </div>

        <?php get_template_part( 'theme/templates/share-counter'); ?>
        
        <?php get_template_part( 'theme/templates/author'); ?>
                    
        <?php comments_template( '', true ); ?>
        
        <?php echo $banner = plsh_get_banner_by_location('post_ad'); ?>

    </div>
    
    <?php
        if(plsh_gs('sidebar_position') === 'right')
        {
            get_sidebar();
        }
    ?>
    
</div>
<?php get_template_part( 'theme/templates/post-navbar'); ?>