<?php
    
    // Global from "index.php" or "single.php"
    global $uxbarn_blog_thumbnail_size;

?>

<div class="thumbnail uxb-col large-12 columns no-padding">
                            
    <?php if(has_post_thumbnail()) : ?>
        
        <?php if(is_single()) : ?>
        
            <?php echo get_the_post_thumbnail($post->ID, $uxbarn_blog_thumbnail_size); ?>
        
        <?php else : // Posts page ?>
            
            <a href="<?php echo get_permalink(); ?>"><?php echo get_the_post_thumbnail($post->ID, $uxbarn_blog_thumbnail_size); ?></a>
        
        <?php endif; ?>
        
    <?php endif; ?>
    
</div>