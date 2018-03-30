<?php
/*
 * This file is used to generate different page layouts set from backend.
 */
get_header ();
?>

		<?php
		        $sidebar = get_option ( THEME_NAME_S.'bp_page_sidebars', 'no-sidebar' );
	            $sidebar = str_replace("bp-","",$sidebar);
				$sidebar_class = '';
				global $bcontainer_class;
				if ($sidebar == "left-sidebar" || $sidebar == "right-sidebar") {
					$sidebar_class = "sidebar-included " . $sidebar;
					$container_class = "span8";
				} else if ($sidebar == "both-sidebar") {
					$sidebar_class = "both-sidebar-included";
					 $bcontainer_class ="span8";
					 $container_class = "span8";
				} else {
					$container_class = "span12";	
					$sidebar_class = "no-sidebar";
				}
				 $left_sidebar = "Buddypress Left Sidebar";
                 $right_sidebar = "Buddypress Right Sidebar";	
		             
			
				  
				  // Quote banner Start
			
 echo '<section id="content-holder" class="container-fluid">';
								  echo '<div class="row-fluid '.$sidebar_class.'">';
									 echo '<section class="container">';
											echo "<div class='".$bcontainer_class." cp-page-float-left'>";
													echo "<div class='".$container_class. " row-fluid page-item'>";
								// Page title and content
								$cp_show_title = get_post_meta ( $post->ID, 'page-option-show-title', true );
							    $cp_show_content = get_post_meta ( $post->ID, 'page-option-show-content', true );
								
								if ($cp_show_title != "No") {
									while ( have_posts () ) {
										the_post ();
											if (! empty ( $cp_page_xml )) {	
													$page_xml_val = new DOMDocument ();
													$page_xml_val->loadXML ( $cp_page_xml );
													
											foreach ( $page_xml_val->documentElement->childNodes as $item_xml ) {
													$page_title = ($item_xml->nodeName);
													}
											}
										/*    if ($page_title !== 'Portfolio' && $page_title !== 'Products' ){*/
											   		
											$cp_show_title = get_post_meta ( $post->ID, 'page-option-show-title', true );
											$cp_show_content = get_post_meta ( $post->ID, 'page-option-show-content', true );
											if ($cp_show_title != "No") {
												echo '<section class="span12 wrapper column page-heading">';
										     	echo'<header class="header-style page-title">';
												echo '<h2 class="h-style">';
												the_title ();
												echo '</h2>';
												echo '</header>';
												echo '<div class="clearfix"></div>';
												echo '</section>';	
										 	}
											/*}*/
										$content = get_the_content ();
										if ($cp_show_content != 'No' /*&& ! empty ( $content )*/) {  
										
										
											echo '<div class="cp-page-wrapper widget-bg">';
												echo '<div class="cp-page-content">';
												the_content ();
														wp_link_pages ( array ('before' => '<div class="page-link"><span>' . __ ( 'Pages:', 'cp_front_end' ) . '</span>', 'after' => '</div>' ) );
												echo '</div>';
											echo '</div>';
											
										}
										
									}
								} else {
									while ( have_posts () ) {
										the_post ();
										$content = get_the_content ();
										if ($cp_show_content != 'No' && ! empty ( $content )) {
											echo '<section class="span12">';
											echo '<div class="cp-page-content">';
											the_content ();
											echo '</div>';
											echo '</section>';
										}
									}
								}
							 ?>
							 
							
                           <?php 
							
						echo "</div>"; // end of cp-page-item
		            	    get_sidebar ( 'left' );
					    echo "</div>"; // cp-page-float-left
		                	get_sidebar ( 'right' );
			?>
         </div>
        </section>
      </section>
<?php get_footer(); ?>