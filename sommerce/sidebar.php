            <?php wp_reset_query();           
				
			    $post_id = isset( $post->ID ) ? $post->ID : 0;
            
            if( yiw_layout_page() != 'sidebar-no' ) : ?>  
		
				<div id="sidebar" class="group">
					<?php 
                        do_action( 'yiw_before_sidebar' );
                        do_action( 'yiw_before_sidebar_' . yiw_get_current_pagename() );
					
                        if ( is_home() )
                           $sidebar = 'Blog Sidebar';
                        else
                           $sidebar = get_post_meta( $post_id, '_sidebar_choose_page', true );
                        
                        if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar( $sidebar ) )
                            get_sidebar( 'default' ); 
	                
                        do_action( 'yiw_after_sidebar' );
                        do_action( 'yiw_after_sidebar_' . yiw_get_current_pagename() ); 
                    ?> 
				</div>
				
            <?php endif ?>