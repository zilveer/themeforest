<?php get_header(); ?>

<?php
    
    // From Codex
    global $query_string;

    $query_args = explode("&", $query_string);
    $search_query = array();
    
    foreach($query_args as $key => $string) {
        $query_split = explode("=", $string);
        $search_query[$query_split[0]] = urldecode($query_split[1]);
    } // foreach
    
    // Force to have 10 posts per page on this search page
    $search_query['posts_per_page'] = 10;
    
    $search = new WP_Query($search_query);
    
?>

<!-- Search Results -->
<div class="grey-bg row">
    <div class="uxb-col large-9 columns for-nested">
        
        <?php if($search->have_posts()) : while($search->have_posts()) : $search->the_post(); ?>
            
            <div class="blog-item search-result row">
                <div class="uxb-col large-12 columns">
                    <h2 class="blog-title"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <p class="excerpt">
                        <?php 
                        
                            // Strip any shortcodes and html out of the search result
                            echo strip_tags(uxbarn_the_excerpt_max_charlength(
                                    strip_shortcodes(preg_replace("~(?:\[/?)[^/\]]+/?\]~s", '', get_the_content())), 
                                    215));
                            
                        ?> 
                    </p>
                </div>
            </div>
            
        <?php endwhile; ?>
        
        <?php get_template_part('template-pagination'); ?>
        
        <?php else: ?>
            
            <div class="blog-item search-result row">
                <div class="uxb-col large-12 columns">
                    <h3><?php _e('Sorry, no posts matched your criteria.', 'uxbarn'); ?></h3>
                    <p>
                        <?php _e('Please try other categories or search again.', 'uxbarn'); ?>
                    </p>
                </div>
            </div>
            
        <?php endif; ?> 
        
        <?php wp_reset_postdata(); ?>
        
    </div>
    <div id="sidebar-wrapper" class="uxb-col large-3 columns for-nested">
        <?php get_sidebar(); ?>
    </div>
</div>

<?php get_footer(); ?>