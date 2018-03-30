<?php 
    global $post;
    $thumb = plsh_get_thumbnail('blog_thumb_single_large', true, false);
    $post_image_width = get_post_image_width($post->ID);
    
    if($post_image_width  == 'full_screen')
    {
        get_template_part( 'theme/templates/full-width-image'); 
    }
?>
                    
<!-- Homepage content -->
<div class="container homepage-content hfeed">

    <?php
    if($post_image_width  == 'container_width' || $post_image_width  == 'text_width')
    {
        get_template_part( 'theme/templates/limited-width-image');
    }
	
	if($post_image_width == 'video' || $post_image_width == 'video_autoplay')
	{
		get_template_part( 'theme/templates/video-image');
	}
    ?>
    
    <div class="main-content-column-1 full-width">

        <!-- Post -->
        <div <?php post_class('post-1 hentry'); ?> itemscope itemtype="http://data-vocabulary.org/<?php if(plsh_is_review()) { echo 'Review'; } else { echo 'NewsArticle'; } ?>">
                        
        <?php    
            if(!in_the_loop())
            {
                if ( have_posts() ) : 
                    while ( have_posts() ) : the_post();
                        ?>                        
                        <div class="title <?php if(!$thumb || $post_image_width == 'no_image') { echo 'no-thumb'; }?>">
                            <h1 id="intro"><a class="entry-title" href="<?php the_permalink(); ?>" <?php if(plsh_is_review()) { echo ' itemprop="itemreviewed"'; } else { echo ' itemprop="headline"'; } ?>><?php the_title(); ?></a></h1>
                            
                            <?php if(!is_page()) : ?>
                            <?php get_template_part( 'theme/templates/title-legend'); ?>
                            <?php endif; ?>
                            
                            <?php get_template_part( 'theme/templates/post-tags'); ?>
                        </div>

                        <div class="post" <?php if(plsh_is_review()) { echo ' itemprop="description"'; } else { echo ' itemprop="articleBody"'; } ?>><?php the_content(); ?></div>

                        <?php get_template_part( 'theme/templates/link-pages'); ?>

                        <?php
                    endwhile;
                else :
                    echo _e('no posts found!', 'goliath');
                endif;
            }
            else
            {
                ?>                        
                    <div class="title <?php if(!$thumb) { echo 'no-thumb'; }?>">
                        <h1 id="intro"><a class="entry-title" href="<?php the_permalink(); ?>" <?php if(plsh_is_review()) { echo ' itemprop="itemreviewed"'; } else { echo ' itemprop="headline"'; } ?>><?php the_title(); ?></a></h1>
                        <?php get_template_part( 'theme/templates/title-legend'); ?>
                        <?php get_template_part( 'theme/templates/post-tags'); ?>
                    </div>

                    <span class="item-summary-hidden" itemprop="<?php if(plsh_is_review()) { echo 'summary'; } else { echo 'description'; } ?>"><?php echo plsh_excerpt(25); ?></span>
                    <?php if($thumb) { ?> <img class="item-image-hidden" itemprop="<?php if(plsh_is_review()) { echo 'photo'; } else { echo 'image'; } ?>" src="<?php echo esc_url($thumb); ?>" alt="<?php esc_attr(the_title()); ?>" /> <?php } ?>
                    
                    <?php if(plsh_is_review()) : ?>
                        <?php $stars = get_post_meta(get_the_ID(), 'rating_stars', true ); ?>
                        <span itemprop="rating" class="item-rating-hidden"><?php echo round($stars/10, 1); ?></span>
                    <?php endif; ?>
                        
                    <div class="post" <?php if(plsh_is_review()) { echo ' itemprop="description"'; } else { echo ' itemprop="articleBody"'; } ?>><?php the_content(); ?></div>

                    <?php get_template_part( 'theme/templates/link-pages'); ?>

                <?php
            }
        ?>

        </div>
        
        <?php get_template_part( 'theme/templates/share-counter'); ?>
        
        <?php get_template_part( 'theme/templates/author'); ?>
                    
        <?php comments_template( '', true ); ?>
        
        <?php echo $banner = plsh_get_banner_by_location('post_ad'); ?>

    </div>
        
</div>
<?php get_template_part('theme/templates/post-navbar'); ?>