<?php
/*
Template Name: Blog
*/
?>

<?php
global $more;
$more = 0;
?>

<?php get_header(); ?>
   
    <div class="global_content_wrapper">
    
    <div class="container_12">
    
    	<div class="grid_8">

            <div id="primary" class="content-area page-blog">
                <div id="content" class="site-content" role="main">
    
                    <?php
                    $temp = $wp_query;
                    $wp_query= null;
                    $wp_query = new WP_Query();
                    //$wp_query->query('posts_per_page=1'.'&paged='.$paged);
					$wp_query->query('posts_per_page='.get_option('posts_per_page').'&paged='.$paged);				
                    while ($wp_query->have_posts()) : $wp_query->the_post();
                    ?>
                        
                        <?php get_template_part( 'content', get_post_format() ); ?>				
                    
                    <?php endwhile; // end of the loop. ?>
                
                    <?php 
                    if (function_exists("emm_paginate")) {
                        emm_paginate();
                    }				
                    ?>
                    
					<!--
                    <div class="pagination">
						<?php
                        global $wp_query;
                        
                        $big = 999999999; // need an unlikely integer
                        
                        echo paginate_links( array(
                            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                            'format' => '?paged=%#%',
                            'current' => max( 1, get_query_var('paged') ),
                            'total' => $wp_query->max_num_pages,
                            //'prev_next'    => True,
                            //'prev_text'    => __('«', 'theretailer'),
                            //'next_text'    => __('»', 'theretailer')
                        ) );
                        ?>
                    </div>
                    -->
                    
                    <?php $wp_query = null; $wp_query = $temp; ?>
    
                </div><!-- #content .site-content -->
            </div><!-- #primary .content-area -->
            
            
            
        </div>
    
        <div class="grid_4">
        
            <div class="gbtr_aside_column">
                <?php 
                get_sidebar();
                ?>
            </div>
            
        </div>
        
	</div>
    
    </div>

<?php get_template_part("light_footer"); ?>

<?php get_template_part("dark_footer"); ?>

<?php get_footer(); ?>