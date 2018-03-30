					<!-- NEWS SLIDE -->
                    <div class="slide clearfix">
						
                    	<div class="news-updates">
							
							<!-- NEWS HEADING -->
                        	<h1 class="page-title"><?php echo get_option('launch_news_title'); ?></h1>
                            
							<!-- NEWS LIST FOR INTERNAL SLIDER -->
                            <div id="news-list">
                            	
									<!-- TWO NEWS SLIDE FOR INTERNAL SLIDER -->
	                                <div class="news-slides">
									
										<?php 	
										
										query_posts( array('posts_per_page' => -1, 'post_type' => 'post', 'orderby' => 'date', 'order' => 'DESC' ) );								
										
										if (have_posts()) : 
											$i = 0;
											while (have_posts()) : 
												the_post(); 
												$i++;
												?>
			                                	<div class="news">
			                                        <h2><a rel="post-<?php echo $post->ID; ?>"  class="news-title single-on-click" href="#"><?php the_title(); ?></a></h2>			                                        
													<div class="date-comments">
			                                        	<span class="date"><?php _e('Date:','framework'); ?> <span><?php the_time('F j, Y'); ?></span></span>	                                        			
			                                        </div>
                                                    <p><?php
                                                        global $more;    // Declare global $more (before the loop).
                                                        $more = 0;
                                                        the_content('',FALSE,''); ?></p>
                                                    <div class="full-contents">
                                                        <?php
                                                        global $more;    // Declare global $more (before the loop).
                                                        $more = 1;
                                                        the_content();
                                                        ?>
                                                    </div>
                                                    <a rel="post-<?php echo $post->ID; ?>" class="more single-on-click" href="#"><?php _e('more','framework'); ?></a>
			                                    </div><!-- end of .news -->
												<?php 
												
												if(($i % 2 == 0) && ($wp_query->found_posts != $i) )
												{
													?>
													 </div><div class="news-slides">
													<?php
												}
												
										endwhile; 
										else: 										
											?>
											<div class="news">												
		                                        <p><strong><?php _e('No Results Found.','framework'); ?></strong></p>												
		                                    </div><!-- end of .news -->
											<?php 
										endif; 
										?>
	                                   										
	                                </div>
	                                <!-- END OF TWO NEWS SLIDE FOR INTERNAL SLIDER -->	                                	                               
									                                
                            </div>
                            <!-- END OF NEWS LIST FOR INTERNAL SLIDER -->
							
							<!-- PAGINATION FOR INTERNAL SLIDER -->
                            <div class="pagination"></div>
							
                        </div><!-- end of .news-updates -->
						
                    </div>
                    <!-- END OF NEWS SLIDE -->