            <?php wp_reset_query() ?>                  

            <?php if( yiw_layout_page() != 'sidebar-no' ) : ?>  
                <div id="sidebar" class="group one-fourth<?php if ( yiw_layout_page() == 'sidebar-right' ) echo ' last' ?>">

                    <?php do_action( 'yiw_before_sidebar' ) ?> 
                    <?php do_action( 'yiw_before_sidebar_' . yiw_get_current_pagename() ) ?> 
                    <?php
                        $portfolio = yiw_portfolio();
                        
                        $portfolio_name = is_page() ? get_post_meta( $post->ID, '_portfolio_post_type', true ) : $portfolio['title'];

                        if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar( $portfolio_name . ' Sidebar' ) )

                            get_sidebar( 'default' ) 

                    ?>

            

                    <?php do_action( 'yiw_after_sidebar' ) ?>       

                    <?php do_action( 'yiw_after_sidebar_' . yiw_get_current_pagename() ) ?> 

                </div>

                

            <?php endif ?>