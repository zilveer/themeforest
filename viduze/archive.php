<?php
/*
 * This file is used to generate WordPress standard archive/category pages.
 */
get_header ();
?>
								<?php
								global $item_xml;
                                $sidebar = get_option ( THEME_NAME_S . '_search_archive_sidebar', 'no-sidebar' );
                                $left_sidebar = "Search-Archive Left Sidebar";
                                $right_sidebar = "Search-Archive Right Sidebar";
                                 get_option( 'date_format' );
								     
									$bcontainer_class = '';   
                                    $sidebar_class = '';
									$item_index = '';
                                if ($sidebar == "left-sidebar" || $sidebar == "right-sidebar") {
                                    $sidebar_class = "sidebar-included " . $sidebar;
                                    $container_class = "span8";
                                } else if ($sidebar == "both-sidebar") {
                                    $sidebar_class = "both-sidebar-included";
                                     $bcontainer_class ="span9";
                                     $container_class = "span8";
                                } else {
                                    $container_class = "span12";	
                                }
                                 
                               ?>
			
            
							<?php
							
							
							  
						
								 echo '<section id="content-holder" class="container-fluid">';
								  echo '<div class="row-fluid '.$sidebar_class.'">';
									 echo '<section class="container">';
											echo "<div class='".$bcontainer_class." cp-page-float-left'>";
													echo "<div class='".$container_class. " row-fluid page-item'>";
						
											//Check Plugin Active
											$item_type = get_option ( THEME_NAME_S . '_search_archive_item_size', '1/1 Full Thumbnail' );
											$num_excerpt = get_option ( THEME_NAME_S . '_search_archive_num_excerpt', 200 );
											$full_content = get_option ( THEME_NAME_S . '_search_archive_full_blog_content', 'No' );
										
											if( $sidebar == "left-sidebar" || $sidebar == "right-sidebar" ){
													$item_size = "850x250";
												}else if( $sidebar == "both-sidebar" ){
													$item_size = "560x200";
												}else{
													$item_size = "1170x440";
												} 
											 ?>

                                             <header class="span12 wrapper header-style">
													<?php if (is_category()) { ?>
														<?php _e('<h2 class="h-style">Categories: ', 'cp_front_end'); ?><span><?php echo single_cat_title(); ?></span>  </h2>
														<?php } elseif (is_day()) { ?>
														<?php _e('<h2 class="h-style">Archive for: ', 'cp_front_end'); ?><span><?php the_time('F jS, Y'); ?></span></h2>
														<?php } elseif (is_month()) { ?>
														<?php _e('<h2 class="h-style">Archive for: ', 'cp_front_end'); ?><span><?php the_time('F, Y'); ?></span></h2>
														<?php } elseif (is_year()) { ?>
														<?php _e('<h2 class="h-style">Archive for: ', 'cp_front_end'); ?><span><?php the_time('Y'); ?></span></h2>
														<?php } elseif (is_author()) { ?>
														<?php _e('<h2 class="h-style">Archive by Author:', 'cp_front_end'); ?><span></h2>
														<?php } elseif (is_search()) { ?>
														<?php _e('<h2 class="h-style">Search results for: ', 'cp_front_end'); ?><span><?php echo get_search_query() ?></span></h2>
														<?php } elseif (is_tag()) { ?>
														<?php _e('<h2 class="h-style">Tag Archives: ', 'cp_front_end'); ?><span><?php echo single_tag_title('', true); ?></span></h2>
													<?php } ?>
									         </header>
                                    
                                         <?php 
										 				
									   			        $post_format = get_post_format();
									     			    get_template_part( 'content', get_post_format() );
														
											 ?>
                                             
                                             
											<?php if( find_xml_value($item_xml, "pagination") == "Yes" ){	
														echo ' <div class="pagination blog-pager p-flio-pgr">';
														pagination();
														echo '</div>';
													}	
                
      
									
										
											echo '<div class="clearfix"></div>';
												 echo '<div class="pagination blog-pager p-flio-pgr">';
										            		  pagination();
											     echo '</div>';
								    echo "</div>"; // cp-page-item
												 get_sidebar ( 'left' );
								echo "</div>"; // cp-page-float-left
							              	     get_sidebar ( 'right' );
										
								?>
						  </div>
        </section>
      </section>
<?php get_footer(); ?>