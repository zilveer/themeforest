<div class="row">
    <div id="blog-pagination" class="uxb-col large-12 columns pagination-centered">
        
        <?php
        
            $big = 999999999;
            
            global $wp_query;
            $total_pages = $wp_query->max_num_pages;
            
            if(is_search()) {
                // Only for search page, there are 10 posts per page
                // And always round up the result
                $total_pages = ceil($wp_query->found_posts / 10); 
            }
            
            if ($total_pages > 1) {
                $current_page = max(1, get_query_var('paged'));
                echo paginate_links(array(  
                  'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                  'format' => '&page=%#%',  
                  'current' => $current_page,  
                  'total' => $total_pages,  
                  'prev_text' => '<i class="fa fa-angle-left"></i>',  
                  'next_text' => '<i class="fa fa-angle-right"></i>',
                  'type' => 'list'
                ));
            }
            
        ?>
        
    </div>
</div>