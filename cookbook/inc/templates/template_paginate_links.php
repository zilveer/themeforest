                        <div class="clearfix">
                            <?php 
                                //wp_query is the gloabal var. If you put this in function remember to globalize var using: global $wp_query
                                $total_pages = $wp_query->max_num_pages;
                                if ($total_pages > 1) {
                                    $current_page = get_query_var('paged') ? get_query_var('paged') : 1;       
                                    echo paginate_links(array(
                                        'base'         => esc_url(add_query_arg('paged','%#%')), 
                                        'format'       => '',                           
                                        'total'        => $total_pages,                 
                                        'current'      => $current_page,                
                                        'show_all'     => false,                        
                                        'end_size'     => 1,                            
                                        'mid_size'     => 2,                            
                                        'prev_next'    => true,                         
                                        'prev_text'    => '<i class="fa fa-angle-left"></i> ' . __('Prev', 'loc_canon'),
                                        'next_text'    =>  __('Next', 'loc_canon') . ' <i class="fa fa-angle-right"></i>',
                                        'type'         => 'list',                       
                                    ));                 
                                }

                             ?>
                        </div>