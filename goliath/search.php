<?php get_header(); ?>

<?php
    $sidebar_output = false;
    
    $search = new WP_Query("s=$s & showposts=-1");
    $result_count = $search->post_count;
?>
	<!-- Homepage content -->
    <div class="container homepage-content">
        <?php
        
        if(plsh_gs('sidebar_position') === 'left')
        {
            get_sidebar();
            $sidebar_output = true;
        }
        ?>
        
        <div class="main-content-column-1<?php if(plsh_gs('sidebar_position') === 'left') { echo ' right'; } ?>">    
             
            <!-- Blog list 1 -->
            <div class="blog-block-1 search-results">
                <div class="title-default">
                    <a href="#" class="active"><?php _e('Search results', 'goliath'); ?></a>
                </div>
                <div class="search-query-1">
                    <div>
                        <p><?php _e('Searched for', 'goliath'); ?></p>
                        <span class="legend-default"><i class="fa fa-bars"></i><?php echo esc_html($result_count); echo ' ' .  _n( 'result found', 'results found', $result_count, 'goliath' ); ?></span>
                    </div>
                    <div>
                        <span><?php echo get_search_query(); ?></span>
                    </div>
                </div>
                <div class="items">
                    <?php get_template_part('theme/templates/loop'); ?>
                </div>
            </div>
            
            <?php get_template_part('theme/templates/pagination'); ?>
            
            <?php echo $banner = plsh_get_banner_by_location('blog_ad'); ?>
            
        </div>

        <?php
            if(plsh_gs('sidebar_position') === 'right' && !$sidebar_output)
            {
                get_sidebar();
            }
        ?>

    </div>
		
<?php get_footer(); ?>