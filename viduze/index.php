<?php
/*
 * This file is used to generate WordPress standard index pages.
 */
get_header ();
?>
								<?php
                                $sidebar = get_option ( THEME_NAME_S . '_search_archive_sidebar', 'no-sidebar' );
                                $left_sidebar = "Search-Archive Left Sidebar";
                                $right_sidebar = "Search-Archive Right Sidebar";
                                 get_option( 'date_format' );
								     
									$bcontainer_class = '';  
                                    $sidebar_class = '';
									global  $item_class,  $item_index;
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
		    					   echo '<div class="row-fluid '.$sidebar_class.' index-page">';
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
											 
											echo '<div id="blog-item-holder" class="blog-item-holder">';
															print_blog_full ( $item_class, $item_size, $item_index, $num_excerpt, $full_content );
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