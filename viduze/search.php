<?php
/*
 * This file is used to generate WordPress standard archive/category pages.
 */
get_header ();
?>
								<?php
                                $sidebar = get_option ( THEME_NAME_S . '_search_archive_sidebar', 'no-sidebar' );
                                $left_sidebar = "Search-Archive Left Sidebar";
                                $right_sidebar = "Search-Archive Right Sidebar";
                                 get_option( 'date_format' );
								global $bcontainer_class;    
                                    $sidebar_class = '';
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
							
							
							   echo '<section id="content-holder" class="container-fluid container">';
		    					   echo '<div class="row-fluid '.$sidebar_class.'">';
		       	 					  echo "<div class='".$bcontainer_class." cp-page-float-left'>";
		     								echo "<div class='".$container_class. " page-item'>";
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
											echo '<div id="blog-item-holder" class="blog-item-holder">';
											 $post_format = get_post_format();
											  if ( have_posts() ) :
											  while ( have_posts() ) : the_post();
													   get_template_part( 'content');
											  endwhile;
										      else : ?>
											  
											  <div class="widget-bg">
                                                <article class="error-404">
                                                  <h3><?php echo __('ooops..... not found.','cp_front_end'); ?></h3>
                                                  <p><?php echo __("Search Term You Are Lookind did Not Found. Please Try With Another Search Term.",'cp_front_end'); ?></p>
                                                </article>
                                              </div>                                  <?php 
                                              endif;

											echo '</div>'; // blog-item-holder
										
											echo '<div class="clearfix"></div>';
												 echo '<div class="pagination blog-pager p-flio-pgr">';
										              pagination();
											     echo '</div>';
								    echo "</div>"; // cp-page-item
												 get_sidebar ( 'left' );
								echo "</div>"; // cp-page-float-left
							              	     get_sidebar ( 'right' );
										
								?>
						</div><!--content-wrapper-->
                   		
             </section>			
<?php get_footer(); ?>