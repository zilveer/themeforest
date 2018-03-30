			
<?php $template_dir = dirname(get_bloginfo('stylesheet_url')); ?>

 
             <?php 
			 
			$args = array(
			'child_of' => 0,
			'order' => 'ASC',
			'orderby' => 'menu_order',
			'hierarchical' => 1,
			'post_type' => 'page',
			'post_status' => 'publish',
			'post_parent' => '0',
			'posts_per_page' => '100'
			); 

			

	  $wp_query = query_posts($args);
	  query_posts($args); // Query all published pages without parents
	  $first_loop = true;
			  
		if (have_posts()) :
		while (have_posts()) : the_post(); 
        
                if (!qs_get_meta('qs_onepage_remove', get_the_ID())) {  ?>
             <?php $temp_query = $wp_query; //store loop to revert back if another loop is called ?>
             <?php $withcomments = 1;  // Hack to display comments on index page ?>

             <div class="vertical-wrapper <?php the_ID(); ?>">

              	<div id="container-<?php the_ID(); ?>" data-name="<?php echo $post->post_name; ?>" class="container <?php if($first_loop) echo 'first'; ?>">
                         
                	<div class="clear-top"></div>
                	
              		<div class="content">
                    
                    	
                            
						<?php 
                                                
						//Determine template for page style
						$template = get_post_meta( get_the_ID(), '_wp_page_template', true );
						$parent_id = get_the_ID();
						
						 switch($template) {
							 
							 case 'default':
									
								get_template_part( 'includes/default' );
														
							 break;

							 case 'template-page-columnright.php':

								get_template_part( 'includes/columnright' );
														
							 break;
							 
							 case 'template-page-blog.php':
						
								get_template_part( 'includes/blog' );
									
							 break;
							 
							 case 'template-page-fullwidth.php':
						
								get_template_part( 'includes/fullwidth' );
									
							 break;
							 
							 case 'template-page-portfolio-3c.php':
						
								get_template_part( 'includes/portfolio-3c' );
									
							 break;
							 
							 case 'template-page-portfolio-4c.php':
						
								get_template_part( 'includes/portfolio-4c' );
									
							 break;
							 
							 case 'template-page-portfolio-5c.php':
						
								get_template_part( 'includes/portfolio-5c' );
									
							 break;
							 
							 case 'template-page-team.php':
						
								get_template_part( 'includes/team' );
									
							 break;
		 							 
							 default:
							 
								get_template_part( 'includes/fullwidth' );
							 
							 break; 						 
							 
						 }
								
								
						?>
                        
					</div>
                    <!-- End content -->
                    
                    </div>
					<!-- End container -->
                                        
                    <?php
					
						
						$child_args = array(
						'order' => 'ASC',
						'orderby' => 'menu_order',
						'hierarchical' => 0,
						'post_type' => 'page',
						'post_status' => 'publish',
						'post_parent' => $parent_id,
						'posts_per_page' => '100'
						); 
						
					  $wp_child_query = query_posts($child_args);
					  query_posts($child_args); // Query all published child pages of this page
							  
						if (have_posts()) :
						while (have_posts()) : the_post(); 
                                                if (!qs_get_meta('qs_onepage_remove', get_the_ID())){  ?>
					
						<?php $temp_child_query = $wp_child_query; //store loop to revert back if another loop is called ?>					
										
                            <div id="container-<?php the_ID(); ?>" data-name="<?php echo $post->post_name; ?>" class="container">
                                
                                <div class="clear-top"></div>
                     
                                <div class="content child">
                            
						<?php 
						
						//Determine template for page style
						$template = get_post_meta( get_the_ID(), '_wp_page_template', true );
						
						 switch($template) {
							 
							 case 'default':
									
								get_template_part( 'includes/default' );
														
							 break;

							 case 'template-page-columnright.php':

								get_template_part( 'includes/columnright' );
														
							 break;
							 
							 case 'template-page-blog.php':
						
								get_template_part( 'includes/blog' );
									
							 break;
							 
							 case 'template-page-fullwidth.php':
						
								get_template_part( 'includes/fullwidth' );
									
							 break;
							 
							 case 'template-page-portfolio-3c.php':
						
								get_template_part( 'includes/portfolio-3c' );
									
							 break;
							 
							 case 'template-page-portfolio-4c.php':
						
								get_template_part( 'includes/portfolio-4c' );
									
							 break;
							 
							 case 'template-page-portfolio-5c.php':
						
								get_template_part( 'includes/portfolio-5c' );
									
							 break;
							 
							 case 'template-page-team.php':
						
								get_template_part( 'includes/team' );
									
							 break;
		 							 
							 default:
							 
								get_template_part( 'includes/fullwidth' );
							 
							 break; 
							 
						 }
								
								
						?>
                                </div>
                                <!-- End child content -->
                                
                             </div>
                             <!-- End child container-->
                             
                     <?php 	
                        
                        } // End onepage remove child
                        endwhile; // End have post loop for children
                        endif; 
						
						if (isset($wp_query)) {$wp_query = $temp_query;} // Restore to original loop
                      ?>
								 
                    </div>
                    <!-- End vertical wrapper -->
                    
              <?php
			  $first_loop = false;
                          } // End onepage remove
			  endwhile; // End have post loop
			  endif;
			 ?>


	<div class="vertical-wrapper">
		<div id="dynamic" class="container">
                    <div class="row"><span id="dynamic-close"></span></div>
                    <div class="clear-top"></div>
			
                    <div class="content">

                    </div>
                </div>
        </div>