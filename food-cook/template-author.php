<?php 
/*
* Template Name: Author Template 
*/ 
get_header();
global $woo_options;
?>
       
    <!-- #content Starts -->
	<?php woo_content_before(); ?>
    <div id="content" class="col-full">
    	
    	<div id="main-sidebar-container">    
            <!-- #main Starts -->
            <?php woo_main_before(); ?>
            <div id="main" class="col-left"> 

				<div class="recipe-title">
					<h1 class="title"><?php the_title(); ?> </h1> 
            	</div>
	        
	        	<div class="fix"></div>
				
				<?php woo_loop_before();?>
		            
		            <?php 
		            $num = $woo_options['woo_auth_number'];
					// edit adit 4-4-2013
		            $role = $woo_options['woo_author_display_role'];
					//end edit adit 4-4-2013
		        	
		           
		            if ( get_query_var('paged') ) $paged = get_query_var('paged'); 
		            elseif ( get_query_var('page') ) $paged = get_query_var('page'); 
		             $paged = 1; 
		            

			            $user_list = woo_get_users( $num, $paged, $role );
						$count = 0;				
					
						foreach($user_list as $author) {
						
							if (get_the_author_meta('exclude',$author->ID) != 1) {
								$author_id = $author->ID;
								$author_name = $author->display_name;
								/* custom profile fields */
								$author_page_url = get_author_posts_url($author_id);
							
								$count++;
							 
							woo_post_before();
							woo_post_inside_before();	
					?>

							<div class="cookname content-full" itemscope itemtype="http://schema.org/Person">
								<div id="author-profile">
									<div class="auth-img">
										<a itemprop="image" href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>">			 
										<a class="url" href="<?php echo $author_page_url; ?>"><?php echo get_avatar( $author_id, '80' ); ?></a> 
										</a> 				
									</div>
																 
									<div class="auth-des">

										<h4 itemprop="name" class="fn given-name url"><a class="url" href="<?php echo $author_page_url; ?>">
											<?php echo get_the_author_meta( 'display_name', $author_id ); /* the_author_posts_link();*/ ?></a> 
										</h4>

										<p itemprop="description" ><?php echo woo_fnc_word_trim(get_the_author_meta( 'description',$author_id  ),30,' ...'); ?></p>
										<a itemprop="url" class="url" href="<?php echo $author_page_url; ?>"><?php _e('Read more about this chef..', 'woothemes');?></a> 
										
										<div class="auth">
											<?php
											$twitter_author_link = get_the_author_meta( 'twitter', $author_id );
											$facebook_author_link = get_the_author_meta( 'facebook', $author_id );
											$google_author_link = get_the_author_meta( 'google' ,$author_id);
											$pin_author_link = get_the_author_meta( 'pin' , $author_id);
											$linkdn_author_link = get_the_author_meta( 'linkdn', $author_id);
											$website = get_the_author_meta( 'url', $author_id);

											if(!empty($website))	
											{				
												?>
												<a class="fa fa-globe" href="<?php echo $website; ?>" target="_blank"></a>
												<?php
											}
											if(!empty($twitter_author_link))	
											{				
												?>
												<a class="fa fa-twitter" href="<?php echo $twitter_author_link; ?>" target="_blank"></a>
												<?php
											}
											
											if(!empty($facebook_author_link))	
											{				
												?>
												<a class="fa fa-facebook" href="<?php echo $facebook_author_link; ?>" target="_blank"></a>
												<?php
											}
											
										 
											if(!empty($linkdn_author_link))	
											{				
												?>
												<a class="fa fa-linkedin" rel="me" href="<?php echo $linkdn_author_link; ?>" target="_blank"></a>
												<?php
											}
											if(!empty($pin_author_link))	
											{				
												?>
												<a class="fa fa-pinterest" rel="me" href="<?php echo $pin_author_link; ?>" target="_blank"></a>
												<?php
											}

											if(!empty($google_author_link))	
											{				
												?>
												<a class="fa fa-google-plus" rel="me" href="<?php echo $google_author_link; ?>" target="_blank"></a>
												<?php
											}					
											?>
										</div>
									</div>																												
								</div>
							</div><!-- end of cookname div -->
			<?php
						} // End If Statement
					} // End For Loop
		           
					woo_post_inside_after();
			 
					woo_post_after();
					
					$comm = '';
					
					if( isset($woo_options[ 'woo_comments' ]) ) { $comm = $woo_options[ 'woo_comments' ]; }
					if ( ( $comm == 'post' || $comm == 'both' ) && is_single() ) { comments_template(); }
								             
					woo_loop_after();

					woo_pagenav();
			
			?>	 
            </div><!-- /#main -->
            
            <?php woo_main_after(); ?>
    
            <?php get_sidebar(); ?>

		</div><!-- /#main-sidebar-container -->         

        <?php dahz_get_sidebar( 'secondary' ); ?>

    </div><!-- /#content -->
	<?php woo_content_after(); ?>

<?php get_footer(); ?>