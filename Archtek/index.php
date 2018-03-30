<?php get_header(); ?>

<?php
	
	$post_thumbnail_location = 'below-title';
	$sidebar_location = 'right';
	
	if ( function_exists( 'ot_get_option' ) ) {
			
	    $post_thumbnail_location = ot_get_option('uxbarn_to_setting_post_thumbnail_location');
	    
	    // Preparing blog sidebar variables
	    $sidebar_location = ot_get_option('uxbarn_to_setting_blog_sidebar');
	
	}
    
    $content_class ='';
    $sidebar_class = '';
    $content_column_class = ' large-9 ';
    
    global $uxbarn_blog_thumbnail_size;
    $uxbarn_blog_thumbnail_size = 'blog-thumbnail';
    
    if($sidebar_location != '') {
        if($sidebar_location == 'left') {
            
            $content_class =' push-3 ';
            $sidebar_class = ' pull-9 ';
            
        }
        
        $content_class .= ' with-sidebar ';
        
    } else {
        $content_column_class = ' large-12 ';
        $uxbarn_blog_thumbnail_size = 'blog-thumbnail-full-width';
    }
    
    
?>

<!-- Blog List -->
<div class="grey-bg row">
    <div class="uxb-col <?php echo $content_column_class; ?> columns for-nested <?php echo $content_class; ?>">
        
        <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
            
            <?php 
                
                $post_excerpt = uxbarn_get_array_value(get_post_meta($post->ID, 'uxbarn_post_excerpt'), 0);
                
            ?>
            
            <div <?php post_class(); ?> >
                
                <div class="blog-page blog-item row">
                    
                    <?php if($post_thumbnail_location == 'above-title') : ?>
                        
                        <?php get_template_part('template-blog-thumbnail'); ?>
                        
                    <?php endif; ?>
                    
                    <div class="uxb-col large-12 columns height-255">
                        
                        <?php get_template_part('template-blog-meta'); ?>
                        
                        <?php if(is_sticky() && !is_archive()) : ?>
                            
                            <div class="sticky-badge">
                                <i class="fa fa-map-pin" title="<?php _e('Sticky Post', 'uxbarn'); ?>" alt="<?php _e('Sticky Post', 'uxbarn'); ?>"></i>
                            </div>
                            
                        <?php endif; ?>
                        
                        <h2 class="blog-title"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <div class="excerpt">
                            <?php 
                            
                                if(trim($post_excerpt) != '') {
                                    echo uxbarn_get_html_validated_content(uxbarn_get_translated_text_from_qTranslate($post_excerpt));
                                
                                } else {
                                    /*echo uxbarn_the_excerpt_max_charlength(
                                            strip_shortcodes(preg_replace("~(?:\[/?)[^/\]]+/?\]~s", '', get_the_content())), 
                                            215);*/
                                    // Use WP excerpt function
                                    the_excerpt();
                                }
                                
                            ?> 
                        </div>
                        <a class="readmore-link" href="<?php echo get_permalink(); ?>"><?php _e('Read More', 'uxbarn'); ?></a>
                    </div>
                    
                    <?php if($post_thumbnail_location == 'below-title') : ?>
                        
                        <?php get_template_part('template-blog-thumbnail'); ?>
                        
                    <?php endif; ?>
                    
                </div>
                
            </div>
            
        <?php endwhile; ?>
        
        <?php get_template_part('template-pagination'); ?>
        
        <?php else : ?>
            
            <div class="blog-item row">
                <div class="uxb-col large-12 columns height-255">
                    <h3><?php _e('Sorry, there are no posts available.', 'uxbarn'); ?></h3>
                </div>
            </div>
            
        <?php endif; ?>
        
    </div>
    
    <?php if($sidebar_location != '') : ?>
        
        <div id="sidebar-wrapper" class="uxb-col large-3 columns for-nested <?php echo $sidebar_class; ?>">
            <?php get_sidebar(); ?>
        </div>
        
    <?php endif; ?>
    
</div>

<?php get_footer(); ?>