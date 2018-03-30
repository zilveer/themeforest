		<?php if ( ! dynamic_sidebar( 'Default Sidebar' ) ) : ?>	
            
            <div class="widget">            
                <h3><?php _e( 'Search' ) ?></h3>
                <?php get_search_form() ?>
            </div>
            
            <div class="widget">
                <h3><?php _e( 'Archives' ) ?></h3>
                <ul>
                    <?php wp_get_archives('type=monthly&show_post_count=1'); ?>
                </ul>
            </div>
            
            <div class="widget">
                <h3><?php _e( 'Categories' ) ?></h3>
                <ul>
                    <?php 
            			$cat_params = Array(
            					'hide_empty'	=>	FALSE,
            					'title_li'		=>	''
            				);
            			if( strlen( trim( yiw_get_option( 'blog_cats_exclude_2' ) ) ) > 0 ){
            				$cat_params['exclude'] = trim( yiw_get_option( 'blog_cats_exclude_2' ) );
            			}
            			wp_list_categories( $cat_params ); 
                    ?>
                </ul>
            </div>
            
            <div class="widget">
                <h3><?php _e( 'Blogroll' ) ?></h3>
                <ul>
                    <?php wp_list_bookmarks( 'title_li=&categorize=0' ) ?>
                </ul>
            </div>
        
        <?php endif; ?>